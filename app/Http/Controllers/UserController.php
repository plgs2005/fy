<?php

namespace App\Http\Controllers;

use Auth;
use App\Influencer\User\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Influencer\Address\Address;
use App\Influencer\Category\Category;
use App\Clothing;
use App\Infrastructure\API\Stripe\StripeApi;
use App\Infrastructure\API\Countries\Countries;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use App\Enums\InfluencerEnum;
use App\Influencer\UserCategory\UserCategory;

use Illuminate\Support\Facades\Http;
use App\Infrastructure\Repository\SocialMediaRepository;

use App\Infrastructure\API\SocialMedia\Facebook\Facebook as FacebookAPI;
use App\Infrastructure\API\SocialMedia\Facebook\FacebookPage as FacebookPageAPI;
use App\Infrastructure\API\SocialMedia\Facebook\Instagram as InstagramAPI;

use App\Influencer\SocialMedia\Facebook\User as FacebookUser;
use App\Influencer\SocialMedia\FacebookPage\User as FacebookPageUser;
use App\Influencer\SocialMedia\InstagramBusiness\User as InstagramBusinessUser;

use App\Influencer\User\UserStatus;
use App\Influencer\Payout\Payout;

class UserController extends Controller
{
    /**
     * @var App\Influencer\Category\Category
     */
    private Category $categoryModel;


    /**
     * @var App\Influencer\UserCategory\UserCategory
     */
    private UserCategory $userCategoryModel;

    public function __construct(
        Category $category,
        UserCategory $userCategory
    ) {
        $this->categoryModel = $category;
        $this->userCategoryModel = $userCategory;

        $this->middleware('auth')->except(['receiveProducts']);
    }

    /**
     * Account Settings
     *
     * @return 
     */
    // public function settings()
    // {
    //     $user = Auth::user();
    //     $stripe = new StripeApi;

    //     $viewData['stripeAccount'] = false;
    //     $viewData['onboarded'] = false;
    //     $viewData['onboardLink'] = false;

    //     $stripeAccount = $stripe->getAccount($user);
    //     // dump($stripe->loginLink($stripeAccount));die;
    //     // dd($stripeAccount);

    //     if ($stripeAccount) {
    //         $onboarded = $stripe->onboardingComplete($stripeAccount);

    //         $viewData['stripeAccount'] = $stripeAccount;
    //         $viewData['onboarded'] = $onboarded;

    //         if ($onboarded == false) {
    //             $onboardLink = $stripe->onboardingLink($stripeAccount);
    //             $viewData['onboardLink'] = $onboardLink;
    //         }
    //     }
    //     return view('app/user/influencer/user_settings', compact('user'))->with($viewData);
    // }

    public function brandSettings(Request $request)
    {
        $user = $request->user();

        if ($user->stripeCustomer()) {

            $stripe = new StripeApi;
            $res = $stripe->getCharges($user);
            $cards = $stripe->getPaymentMethods($user);

            if(!empty($res['data'])) {
                foreach ($res['data'] as $value) {
                    $date = Carbon::parse($value['created']);
                    $payments[$date->format('M-j-Y')][] = $value;
                }
            } else {
                $payments = '';
            }

            return view('app/user/brand/brand_settings', ['user' => $user, 'payments' => $payments, 'cards' => $cards]);
        } else {
            dd('error');
        }
        // return view('app/user/brand/brand_settings', compact('user'))->with($viewData);
        return view('app/user/brand/brand_settings', ['user' => $user]);
    }

    public function storeBrandSettings(Request $request)
    {
        $user = $request->user();
        $validated = $request->validate(
            [
                'brand_name' => 'required',
            ]
        );

        $user->update($validated);
        return redirect()->back();
    }

    public function updateBrandLogo(Request $request)
    {
        $user = $request->user();
        $request->validate(
            [
                'brand_logo' => 'required|image|mimes:jpeg,png,bmp|max:10240',
            ]
        );
        if ($request->brand_logo->isValid()) {
            $user->deleteBrandLogo();
            $img = $request->brand_logo->storeAs('brand_logo', $user->id . '.' . $request->brand_logo->extension(), 'public');
            $user->brand_logo = $img;
            $user->save();
        }

        return redirect()->back();
    }

    public function brandProfile(Request $request)
    {
        $user = $request->user();
        return view('app/user/brand/brand_profile', ['user' => $user, 'headerTitle' => 'Hello ' . $user->name]);
    }

    public function brandProfileUpdate(Request $request)
    {
        $user = $request->user();
        $validated = $request->validate(
            [
                'name' => 'required',
                'phone' => ['required', 'max:17', 'regex:/^\+[1] (\([0-9]{3}\) |[0-9]{3}-)[0-9]{3}-[0-9]{4}$/'],
                'email' => 'required',
            ]
        );

        $user->update($validated);
        return redirect()->back();
    }

    public function storeChangePassword(Request $request)
    {
        $user = $request->user();
        $validated = $request->validate(
            [
                'password' => 'required|confirmed',
            ]
        );

        $user->changePassword($validated['password']);

        if (!$request->ajax()) {
            return redirect()->back();
        }

        $response = [
            'status' => Response::HTTP_OK,
            'data' => $validated
        ];

        return response()->json($response, $response['status']);
    }

    public function avatarUpdate(Request $request)
    {
        $user = $request->user();
        $request->validate(
            [
                'avatarImg' => 'required|image|mimes:jpeg,png,bmp|max:10240',
            ]
        );

        $img = '';
        if ($request->avatarImg->isValid()) {
            $user->deleteAvatarImg();
            $img = $request->avatarImg->storeAs('avatar', $user->id . '.' . $request->avatarImg->extension(), 'public');
            $user->avatarImg = $img;
            $user->save();
        }

        if (!$request->ajax()) {
            return redirect()->back();
        }

        $response = [
            'status' => Response::HTTP_OK,
            'data' => $img
        ];

        return response()->json($response, $response['status']);
    }

    /**
     * Brand complete profile page
     */
    public function completeProfileBrand(Request $request)
    {
        return view('app.user.brand.complete_profile', ['completeProfile' => true]);
    }

    /**
     * Completes the brand profile with information from form.
     */
    public function storeCompleteProfileBrand(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required',
                'phone' => ['required', 'max:17', 'regex:/^\+[1] (\([0-9]{3}\) |[0-9]{3}-)[0-9]{3}-[0-9]{4}$/'],
                'brand_name' => 'required',
            ]
        );
        $user = $request->user();
        $user->update($validated);
        return redirect('/home');
    }

    public function subscribe(Request $request)
    {
        $stripe = new StripeApi;
        $user = $request->user();

        if ($user->stripeCustomer()) {
            $subscription = $stripe->getCustomerSubscription($user);

            $stripeApi = new StripeApi;
            $cards = $stripeApi->getPaymentMethods($user);
        } else {
            dd('An error occured');
        }
        return view('app/user/brand/subscribe', compact('subscription', 'user', 'cards'));
    }

    public function payments(Request $request)
    {
        $user = $request->user();
        $stripe = new StripeApi;

        $campaigns = $user->influencerCampaigns;

        $stripeAcc = $stripe->getAccount($user);

        if ($stripeAcc) {
            if ($user->stripeOnboardingComplete()) {
                $balance = $stripe->getBalance($user->stripe_acc);
                $accounts = $stripe->bankAccounts($user);

                $delay_days = $stripeAcc->settings->payouts->schedule->delay_days;

                $payout = new Payout();
                $payouts = $payout->where('user_id', $user->id)->get();
                foreach ($payouts as $value) {
                    $date = Carbon::parse($value['created']);
                    $date = $date->format('M-j-Y');
                    $payouts_history[$date][] = $value;
                    $history[$date][] = $value;
                }

                $transfers = $stripe->listTransfers('user_id-' . $user->id);
                if (!empty($transfers['data'])) {
                    foreach ($transfers['data'] as $value) {
                        $date = Carbon::parse($value['created']);
                        $history[$date->format('M-j-Y')][] = $value;
                    }
                } else {
                    $history = null;
                }
                
                return view('app/user/influencer/payments', compact('balance', 'accounts', 'campaigns', 'history', 'delay_days'));
            } else {
                return view('app/user/influencer/payments');
            }
        } else {
            return view('app/user/influencer/payments');
        }
    }

    public function bankInfo(Request $request)
    {
        $user = $request->user();
        $stripe = new StripeApi;
        $stripeAcc = $stripe->getAccount($user);

        if ($stripeAcc) {
            if ($user->stripeOnboardingComplete()) {
                $accounts = $stripe->bankAccounts($user);
                if ($accounts) {
                    return view('app/user/influencer/bank_info', compact('accounts'));
                }
            } else {
                $loginLink = $stripe->loginLink($stripeAcc);

                if ($loginLink) {
                    return view('app/user/influencer/bank_info', ['loginLink' => $loginLink]);
                } else {
                    $onboardLink = $stripe->onboardingLink($stripeAcc);
                    return view('app/user/influencer/bank_info', ['onboardLink' => $onboardLink]);
                }
            }
        } 
        return view('app/user/influencer/bank_info');
    }

    public function withdraw(Request $request)
    {
        $user = $request->user();
        $stripe = new StripeApi;

        $accounts = $stripe->bankAccounts($user);

        $balance = $stripe->getBalance($user->stripe_acc);
        if ($balance->instant_available[0]->amount == 0) {
            $response_array['status'] = 'error';
            $response_array['message'] = 'Your balance is 0';
            return new JsonResponse([$response_array], 201);
        }
        $max = $balance->instant_available[0]->amount;

        $validated = $request->validate(
            [
                // 'bank' => 'required',
                'amount' => "required|integer|min:100|max:$max",
            ]
        );

        try {
            $res = $user->withdraw($accounts[0]->id, $validated['amount']);
            $arrival_date = Carbon::createFromTimestamp($res->arrival_date);
            $arrival_date = $arrival_date->format('M j Y');
            $response_array['status'] = 'success';
            $response_array['message'] = 'You should receive the value on your bank account on ' . $arrival_date;
            return new JsonResponse([$response_array], 201);
        } catch (\Throwable $th) {
            $response_array['status'] = 'error';
            $response_array['message'] = $th->getMessage();
            return new JsonResponse([$response_array], 201);
        }
    }

    public function influencerProfile()
    {
        $user = Auth::User();

        return view('app/user/influencer/profile', ['user' => $user, 'headerTitle' => 'Hello ' . $user->name]);
    }

    public function influencerProfileUpdate(Request $request)
    {
        $user = $request->user();

        $oldEmail = Auth::user()->email;

        $validated = $request->validate(
            [
                'name' => 'required',
                'phone' => ['required', 'max:17', 'regex:/^\+[1] (\([0-9]{3}\) |[0-9]{3}-)[0-9]{3}-[0-9]{4}$/'],
                'email' => 'required|email:rfc,dns',
            ]
        );

        $user->update($validated);

        if (!$request->ajax()) {
            return redirect()->back();
        }

        $changedEmail = '';
        if ($request->input('email') !== $oldEmail) {
            $request->user()->sendEmailVerificationNotification();
            $changedEmail = 'We sent you an email, please check your email for a verification link.';
        }

        $response = [
            'status' => Response::HTTP_OK,
            'data' => $validated,
            'changedEmail' => $changedEmail
        ];

        return response()->json($response, $response['status']);
    }

    public function storeInfluencerProfile(Request $request)
    {
    }

    public function influencerAddress(Request $request)
    {
        $influencerAddress = $request->user()
            ->address()
            ->first();

        $countries = new Countries();

        return view('app/user/influencer/address', compact('influencerAddress', 'countries'));
    }

    public function storeInfluencerAddress(Request $request)
    {

        $response = [
            'status' => Response::HTTP_OK,
            'data' => []
        ];

        $validatorHasErrors = \App\Validations\InfluencerAddressValidation::formValidate($request->all());

        if (!empty($validatorHasErrors)) {
            $response['data'] = $validatorHasErrors;
            $response['status'] = Response::HTTP_BAD_REQUEST;
            return response()->json($response, $response['status']);
        }

        try {

            $influencerAddress = Address::updateOrCreate(
                [
                    'user_id' => $request->user()->id,
                ],
                [
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
                ]
            );

            $response['data'] = $influencerAddress;
        } catch (\Exception $exception) {
            $response['data'] = "An error ocurred while saving influencer address";
            //$response['data'] = $exception->getMessage();
            $response['status'] = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return response()->json($response, $response['status']);
    }

    public function influencerCategories(Request $request)
    {
        $categories = $this->categoryModel->getAllCategories();
        $userCategories = $this->generateUserCategories($request->user());
        $measurementsCount = Auth::user()->clothing()->count();

        return view('app/user/influencer/categories', compact('categories', 'userCategories', 'measurementsCount'));
    }

    //Salva categorias do influencer
    public function storeInfluencerCategories(Request $request)
    {
        $response = [
            'status' => Response::HTTP_OK,
            'data' => []
        ];

        $validatorHasErrors = \App\Validations\InfluencerCategoryValidation::formValidate($request->all());

        if (!empty($validatorHasErrors)) {
            $response['data'] = $validatorHasErrors;
            $response['status'] = Response::HTTP_BAD_REQUEST;
            return response()->json($response, $response['status']);
        }

        try {

            $category = $this->prepareStoreCategories($request->input('category_id'));

            if ($category === false) {
                $response['data'] = InfluencerEnum::messageExceededLimit();
                $response['status'] = Response::HTTP_BAD_REQUEST;
                return response()->json($response, $response['status']);
            }

            $response['data'] = $category;
        } catch (\Exception $exception) {
            $response['data'] = "A error ocurred while saving influencer categories and niches";
            $response['data'] = $exception->getMessage();
            $response['status'] = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return response()->json($response, $response['status']);
    }

    public function destroyInfluencerCategories(Request $request, $id)
    {
        $response = [
            'status' => Response::HTTP_OK,
            'data' => []
        ];

        if (!$id) {
            $response['data'] = 'User category id is required for deletion';
            $response['status'] = Response::HTTP_BAD_REQUEST;
            return response()->json($response, $response['status']);
        }

        try {
            $userCategory = UserCategory::where([
                'user_id' => $request->user()->id,
                'category_id' => $id
            ]);

            $response['data'] = $userCategory;

            if (!$userCategory->delete()) {
                $response['data'] = 'An error occured while deleting the category';
            }
        } catch (\Exception $exception) {
            $response['data'] = "An error occured while deleting the category";
            //$response['data'] = $exception->getMessage();
            $response['status'] = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return response()->json($response, $response['status']);
    }

    public function generateUserCategories(object $user): array
    {
        $result = [
            'categories' => [],
            'categoriesId' => []
        ];

        if (!$user || !$user->categoriesIds()) {
            return $result;
        }

        $userCategories = [];
        foreach ($user->categoriesIds() as $category) {
            foreach ($this->categoryModel->createCatoriesAndChildrens($category, $this->categoriesIdToArrayValues()) as $cat) {
                $userCategories[] = $cat;
            }
        }

        $result['categories'] = $userCategories;
        $result['categoriesId'] = $this->categoriesIdToArrayValues();

        return $result;
    }

    public function categoriesIdToArrayValues(): array
    {
        return array_values((array) Auth::user()->categoriesIds())[0];
    }

    //Deleta/desativa a conta do usuário
    public function deleteAccount()
    {
        $response = [
            'status' => Response::HTTP_OK,
            'data' => []
        ];

        try {
            User::where('id', Auth::user()->id)->update([
                'active' => 'N'
            ]);

            Auth::logout();
        } catch (\Exception $exception) {
            $response['status'] = Response::HTTP_INTERNAL_SERVER_ERROR;
            $response['data'] = 'An error occured while deleting the user account';
        }

        return response()->json($response, $response['status']);
    }

    //Exibe view de desativar/deletar conta
    public function deleteAccountView()
    {
        return view('app/user/delete-account');
    }

    public function socialAccounts(Request $request)
    {
        $minFollowers = config('app.min_followers');
        $analytics_period = config('app.max_post_age');
        $user = $request->user();
        $socialMediaRepository = new SocialMediaRepository();

        $facebook = $socialMediaRepository->getSocialMediaFromUser('facebook', $user->id)->first();
        if ($facebook->verifyFb() === false) {
            $request->session()->flash('error', "An error occured please reconect your facebook account.");
            return view('app/user/influencer/social_accounts', ['error' => 'error']);
        }
        $fbPage = $socialMediaRepository->getSocialMediaFromUser('facebook_page', $user->id)->first();
        $instagram = $socialMediaRepository->getSocialMediaFromUser('instagram_business', $user->id)->first();
        if ($fbPage['followers'] < $minFollowers) {
            $fbPage['elegible'] = false;
        } else {
            $fbPage['elegible'] = true;
        }
        if ($instagram['followers'] < $minFollowers) {
            $instagram['elegible'] = false;
        } else {
            $instagram['elegible'] = true;
        }

        return view('app/user/influencer/social_accounts', ['fbPage' => $fbPage, 'instagram' => $instagram, 'analytics_period' =>$analytics_period]);
    }

    public function connectFacebook(Request $request)
    {
        $user = $request->user();
        $socialMediaRepository = new SocialMediaRepository();
        $facebook = $socialMediaRepository->getSocialMediaFromUser('facebook', $user->id);
        if ($facebook->count() > 0) {
            return redirect('/select-fb-page');
        } else {
            return view('app.user.influencer.complete_profile_connect_fb');
        }
    }

    //Influencer Onboarding - Exibe view com as paginas e instagram vinculados para serem selecionados
    public function selectFbPage(Request $request)
    {
        $user = $request->user();
        $minFollowers = config('app.min_followers');
        $socialMediaRepository = new SocialMediaRepository();
        $facebook = $socialMediaRepository->getSocialMediaFromUser('facebook', $user->id);
        if ($facebook->count() == 0) {
            return redirect('/connect-facebook');
        }

        if ($facebook->count() > 0) {

            $facebookPage = $socialMediaRepository->getSocialMediaFromUser('facebook_page', $user->id);
            if ($facebookPage->count() > 0) {
                return redirect('/receive-products');
            }

            $facebookUser = FacebookUser::make($user);
            $facebookApi = new FacebookAPI($facebookUser);
            $fb_pages = $facebookApi->getFacebookPages()->Json();

            if (empty($fb_pages['data'])) {
                $request->session()->flash('error', "You dont have any facebook page or you didn't provide permission to access it.");
                return redirect('/connect-facebook');
            }
            if (count($fb_pages['data']) >= 1) {
                foreach ($fb_pages['data'] as $key => $page) {
                    // dump($page);
                    if ($page['fan_count'] < $minFollowers) {
                        $page['elegible'] = false;
                    } else {
                        $page['elegible'] = true;
                    }
                    $facebookPage = new FacebookPageUser($page['id'], $page['access_token']);
                    $facebookPageApi = new FacebookPageApi($facebookPage);
                    $igBiz = $facebookPageApi->getInstagramBusinessAccount()->Json();
                    // dump($igBiz);
                    if (isset($igBiz['instagram_business_account'])) {
                        $insta = Http::get("https://graph.facebook.com/v7.0/{$igBiz['instagram_business_account']['id']}?access_token={$page['access_token']}&fields=username,profile_picture_url,followers_count")->Json();
                        if ($insta['followers_count'] < $minFollowers) {
                            $insta['elegible'] = false;
                        } else {
                            $insta['elegible'] = true;
                        }
                        $page['insta'] = $insta;
                    }
                    $pages[$key] = $page;
                }
            }
        }
        // dump($pages);
        return view('app.user.influencer.complete_profile_fb_select_page', ['pages' => $pages]);
    }

    //Influencer onboarding - Grava em banco a pagina e instagram vinculado
    public function storeFbPage(Request $request)
    {
        $minFollowers = config('app.min_followers');
        $request->validate(
            [
                'fb_page_id' => 'required',
                'fb_active' => 'required',
                'insta_active' => 'required',
            ]
        );
        $user = $request->user();

        $facebookUser = FacebookUser::make($user);
        $facebookApi = new FacebookAPI($facebookUser);
        $fb_page = $facebookApi->getFacebookPages()->Json();

        foreach ($fb_page['data'] as $page) {

            if ($page['id'] == $request['fb_page_id']) {

                $fb_active = ($page['fan_count'] >= $minFollowers and $request['fb_active'] == 'true') ? true : false;
                $facebookPage = new FacebookPageUser($page['id'], $page['access_token']);
                $facebookPageApi = new FacebookPageApi($facebookPage);

                $socialMediaRepository = new SocialMediaRepository();
                // insere facebook_page
                $object = [
                    'user_id' => $user->id,
                    'social_media' => FacebookPageUser::$type,
                    'media_user_id' => $page['id'],
                    'media_username' => (isset($page['username'])) ? $page['username'] : null,
                    'page_name' => $page['name'],
                    'profile_picture_url' => $page['picture']['data']['url'],
                    'followers' => $page['fan_count'],
                    'token' => $page['access_token'],
                    'url' => $page['link'],
                    'active' => $fb_active,
                ];

                $socialMediaRepository->insertIfNew($object);

                //verifica se possui instagram vinculado à pagina
                $igBiz = $facebookPageApi->getInstagramBusinessAccount()->json();
                // dd($igBiz);

                if (isset($igBiz['instagram_business_account']) and $igBiz['id'] == $request->input('fb_page_id')) {
                    $igUsername = Http::get("https://graph.facebook.com/v11.0/{$igBiz['instagram_business_account']['id']}?access_token={$page['access_token']}&fields=username,profile_picture_url,followers_count")->Json();
                    $insta_active = ($igUsername['followers_count'] >= $minFollowers and $request['insta_active'] == 'true') ? true : false;

                    $profile_picture_url = (isset($igUsername['profile_picture_url'])) ? $igUsername['profile_picture_url'] : null;

                    //insere instagram
                    $object = [
                        'user_id' => $user->id,
                        'social_media' => InstagramBusinessUser::$type,
                        'media_user_id' => $igBiz['instagram_business_account']['id'],
                        'media_username' => $igUsername['username'],
                        'page_name' => $igUsername['username'],
                        'profile_picture_url' => $profile_picture_url,
                        'followers' => $igUsername['followers_count'],
                        'token' => $page['access_token'],
                        'url' => 'https://instagram.com/' . $igUsername['username'],
                        'active' => $insta_active,
                    ];
                    $socialMediaRepository->insertIfNew($object);
                }
            }
        }

        $status = new UserStatus();
        $status->user_id = $user->id;
        $status->status = 'get_initial_data';
        $status->save();

        return redirect('/receive-products');
    }

    public function registerComplete(Request $request)
    {
        $user = $request->user();
        $categories = $user->categories;
        if ($categories->count() == 0) {
            return redirect('/receive-products');
        }
        if ($user->profile_completed != 1) {
            return redirect('/receive-products');
        }
        $user->updateSocialMediasData();
        return view('auth/register-complete');
    }

    //Exibe view receive products e selecionar social medias no influencer onboarding
    public function receiveProducts()
    {
        $categories = $this->categoryModel->getAllCategories();

        return view('app/user/influencer/complete_profile_receive_products', compact('categories'));
    }

    //Botão de ativar/desativar social media
    public function toggleSocialMedia(Request $request)
    {
        $request->validate(
            [
                'social_media_id' => 'required|integer',
                'action' => 'required|string',
            ]
        );

        $user = $request->user();
        $social_media = $user->social_medias()->where('id', $request['social_media_id'])->first();
        if ($social_media and $request['action'] == 'deactivate') {
            $social_media->active = 0;
            $social_media->save();
        } elseif ($social_media and $request['action'] == 'activate') {
            $social_media->active = 1;
            $social_media->save();
        }
    }

    //Influencer Onboarding
    public function storeProductsAndMeasurements(Request $request)
    {

        $response = [
            'status' => Response::HTTP_CREATED,
            'data' => []
        ];

        $categoryValidator = \App\Validations\InfluencerCategoryValidation::formValidate($request->only(['category_id']));
        $measurementsCategoryValidator = \App\Validations\InfluencerMeasurementsValidation::formValidate($request->only(['measurements']));

        if (!empty($categoryValidator)) {
            $response['data'] = $categoryValidator;
            $response['status'] = Response::HTTP_BAD_REQUEST;
            return response()->json($response, $response['status']);
        }

        if (!empty($measurementsCategoryValidator)) {
            $response['data'] = $measurementsCategoryValidator;
            $response['status'] = Response::HTTP_BAD_REQUEST;
            return response()->json($response, $response['status']);
        }

        try {

            if (!empty($request->input('measurements.unit')) || empty(!$request->input('measurements.gender'))) {
                $measurements = Clothing::updateOrCreate(
                    [
                        'user_id' => Auth::user()->id
                    ],
                    [
                        'gender' => $request->input('measurements.gender'),
                        'tshirt' => $request->input('measurements.tshirt'),
                        'shoes' => $request->input('measurements.shoes'),
                        'pants' => $request->input('measurements.pants'),
                        'unit' => $request->input('measurements.unit'),
                        'dress' => $request->input('measurements.dress'),
                    ]
                );

                if (!$measurements) {
                    $response['data'] = 'Unable to save measurements';
                    $response['status'] = Response::HTTP_BAD_REQUEST;
                }
            }

            $categories = $this->prepareStoreCategories($request->input('category_id'));

            if (!$categories) {
                $response['data'] = 'Unable to save categories';
                $response['status'] = Response::HTTP_BAD_REQUEST;
            }

            //$facebookInDatabase = (new SocialMediaRepository())->getSocialMediaFromUser('facebook_page', Auth::user()->id);

            //if ($facebookInDatabase && $categories) {
            //    User::where('id', Auth::user()->id)->update(['profile_completed' => 'Y']);
            //}

            $response['data'] = array_merge($request->only(['category_id']), $request->only(['measurements']));
        } catch (\Exception $exception) {
            $response['data'] = "A error ocurred while save influencer measurements";
            $response['data'] = $exception->getMessage();
            $response['status'] = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        $user = Auth::user();
        $user->profile_completed = 1;
        $user->save();
        return response()->json($response, $response['status']);
    }

    public function prepareStoreCategories(string $categories): UserCategory
    {
        $category = [];
        $splitCategories = explode('|', $categories);
        $splitCategories = array_unique($splitCategories);

        $userId = Auth::user()->id;

        foreach ($splitCategories as $category) {
            $dataToInsert = [
                'user_id' => $userId,
                'category_id' => $category
            ];

            $findCategory = $this->userCategoryModel->checkExistsParentCategory($userId, $category)->count();

            if ($findCategory >= 1) {
                $category = UserCategory::where($dataToInsert)->update($dataToInsert);
            } else {
                $countCategories = $this->userCategoryModel->getCategoriesByUser($userId);

                if (
                    count($this->categoryModel->getFirstLevelCategories($category)) > 0 &&
                    $countCategories === InfluencerEnum::LIMIT_CATEGORIES
                ) {
                    return false;
                }

                $category = UserCategory::updateOrCreate($dataToInsert, $dataToInsert);
            }
        }

        return $category;
    }

    public function setReceiveProducts()
    {
        User::where('id', Auth::user()->id)->update([
            'receive_products' => 'Y'
        ]);

        $response = [
            'status' => Response::HTTP_OK,
            'data' => true
        ];

        return response()->json($response, $response['status']);
    }

    public function influencerMeasurements()
    {
        $userMeasurements = Auth::user()->clothing;

        return view('app/user/influencer/measurements', compact('userMeasurements'));
    }

    public function updateMeasurements(Request $request)
    {

        $response = [
            'status' => Response::HTTP_OK,
            'data' => []
        ];

        $measurementsValidator = \App\Validations\InfluencerMeasurementsValidation::formValidate($request->only(['measurements']));

        if (!empty($measurementsValidator)) {
            $response['data'] = $measurementsValidator;
            $response['status'] = Response::HTTP_BAD_REQUEST;
            return response()->json($response, $response['status']);
        }

        try {

            if (!empty($request->input('measurements.unit')) || empty(!$request->input('measurements.gender'))) {
                Clothing::updateOrCreate(
                    [
                        'user_id' => Auth::user()->id
                    ],
                    [
                        'gender' => $request->input('measurements.gender'),
                        'tshirt' => $request->input('measurements.tshirt'),
                        'shoes' => $request->input('measurements.shoes'),
                        'pants' => $request->input('measurements.pants'),
                        'unit' => $request->input('measurements.unit'),
                        'dress' => $request->input('measurements.dress'),
                    ]
                );
            }

            $response['data'] = $request->only(['measurements']);
        } catch (\Exception $exception) {
            $response['data'] = "A error ocurred while save influencer measurements";
            $response['data'] = $exception->getMessage();
            $response['status'] = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return response()->json($response, $response['status']);
    }

    public function notificationsRead()
    {
        $user  = Auth::user();
        $user->unreadNotifications->markAsRead();
    }

    public function giftOnlyCampaigns()
    {
        $user = Auth::user();
        return view('app/user/influencer/gift_only_campaigns', compact('user'));
    }

    public function storeGiftOnlyCampaigns(Request $request)
    {
        $user = $request->user();
        if ($request->accept_gift_only == "true") {
            $user->receive_products = 'Y';
        } else {
            $user->receive_products = 'N';
        }
        $user->save();
    }
}
