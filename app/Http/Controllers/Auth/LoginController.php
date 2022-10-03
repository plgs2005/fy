<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Socialite;
use Auth;
use Exception;
use App\Influencer\User\User;
use App\Influencer\SocialMedia\SocialMedia;
use App\Influencer\Role\Role;

use Jenssegers\Agent\Agent;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the application's login form.
     * Overwrites trait method
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        $agent = new Agent();
        if ($agent->isDesktop()) {
            return view('auth.login', ['login'=>true]);
        } else {
            return 'mobile view';
        }
    }

}
