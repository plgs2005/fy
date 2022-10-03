<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Influencer\User\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Http\Requests\CreateUserBrand;

use Illuminate\Auth\Events\Registered;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        $cookie = json_decode(getVisitorCookie());
        $cookie = (array) $cookie;
        $register = true;
        return view('auth.register', ['cookie' => $cookie, 'register' => $register]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make(
            $data,
            [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:3', 'confirmed'],
                'referrer' => [],
            ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     * 
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $timezone = $data['time_zone'];

        $user =  User::create(
            [
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'referrer' => $data['referrer'],
                'time_zone' => $timezone,
            ]
        );

        $user->assignRole('Influencer');

        return $user;
    }

    public function registerType()
    {
        return view('auth.register_user_type');
    }

    public function showBrandRegistrationForm()
    {
        $register = true;
        return view('auth.register_brand', ['register' => $register]);
    }

    public function registerBrand(CreateUserBrand $request)
    {
        $validated = $request->validated();

        event(new Registered($user = $this->createBrand($request->all())));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath());
    }

    protected function createBrand(array $data)
    {
        // dd($data);

        $timezone = $data['time_zone'];


        //server

        $user =  User::create(
            [
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'time_zone' => $timezone,
            ]
        );
     
        $user->assignRole('Brand');

        return $user;
    }

    public function registerInfluencer(Request $request)
    {
        $response = [
            'status' => Response::HTTP_OK,
            'data' => []
        ];

        $validatorHasErrors = \App\Validations\InfluencerRegisterValidation::formValidate($request->all());

        if (!empty($validatorHasErrors)) {
            $response['data'] = $validatorHasErrors;
            $response['status'] = Response::HTTP_BAD_REQUEST;
            return response()->json($response, $response['status']);
        }

        try {

            $influencerData = [
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'name' => $request->input('first_name'),
                'phone' => $request->input('phone'),
                'time_zone' => 'America/Sao_Paulo,' 
            ];

            $influencerAddressData = [
                'address' => $request->input('street_address'),
                'apartment' => $request->input('apartment'),
                'apartment_unit' => $request->input('apartment_unit'),
                'city' => $request->input('city'),
                'state' => $request->input('province_state'),
                'postal_code' => $request->input('zip_code'),
                'country' => $request->input('country'),
                'po_box' => $request->input('po_box'),
                'number' => $request->input('number'),
                'formatted_address' => $request->input('address'),
                'lat' => $request->input('lat'),
                'lng' => $request->input('lng'),
            ];

            $resultInfluencer = User::create($influencerData);

            if ($resultInfluencer) {

                $resultInfluencer->assignRole('Influencer');
                $this->guard()->login($resultInfluencer);

                $influencerAddressData['user_id'] = $resultInfluencer->id;
                $resultInfluencerAddress =  \App\Influencer\Address\Address::insert($influencerAddressData);

                if ($resultInfluencerAddress && Auth::attempt($request->only('email', 'password'))) {
                    $response['data'] = array_merge($influencerData, $influencerAddressData);
                }
            }
            $resultInfluencer->sendEmailVerificationNotification();
        } catch (\Exception $exception) {
            $response['data'] = "An error ocurred while creating your account";
            $response['data'] = $exception->getMessage();
            $response['status'] = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return response()->json($response, $response['status']);
    }
}
