<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Infrastructure\API\SocialMedia\Facebook\Facebook as FacebookAPI;
use App\Infrastructure\API\SocialMedia\Facebook\FacebookPage as FacebookPageAPI;
use App\Infrastructure\API\SocialMedia\Facebook\Instagram as InstagramAPI;

use App\Influencer\SocialMedia\Facebook\User as FacebookUser;
use App\Influencer\SocialMedia\FacebookPage\User as FacebookPageUser;
use App\Influencer\SocialMedia\InstagramBusiness\User as InstagramBusinessUser;

use App\Influencer\SocialMedia\SocialMedia;

use App\Influencer\User\UserStatus;

use Socialite;
use Auth;
use Exception;
use App\Influencer\User\User;
use Illuminate\Support\Facades\Http;

use App\Infrastructure\Repository\SocialMediaRepository;

class SocialMediaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->scopes(
            ['email','instagram_basic','pages_show_list','pages_read_user_content','pages_read_engagement', 'pages_manage_posts','instagram_manage_insights', 'read_insights']
        )->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
            $finduser = Auth::user();
            $social_media = SocialMedia::where('social_media', 'facebook')->where('media_user_id', $user->id)->first();
            //se ja existe registro da conta facebook no banco apenas atualiza o token
            if ($finduser AND $social_media) {
                $social_media->token = $user->token;
                $finduser->social_medias()->save($social_media);
                return redirect('/select-fb-page');
                //se nao existe registro do facebook do usuario no banco salva novo registro    
            } else {  
                $social_media = new SocialMedia(['social_media'=>'facebook','media_user_id'=>$user->id,'token'=>$user->token]);
                $social_media = $finduser->social_medias()->save($social_media);

                $facebookUser = FacebookUser::make($finduser);
                $facebookApi = new FacebookAPI($facebookUser);
                $fb_pages = $facebookApi->getFacebookPages()->Json();
                //verifica se existe alguma pagina criada na conta facebook
                if (empty($fb_pages['data'])) {
                    $social_media->delete();
                    return redirect('/connect-facebook')->with('error', "You dont have any facebook page or you didn't provide permission to access it.");
                } else {
                    return redirect('/select-fb-page');
                }
            }
        }
        catch(\Throwable $th) {
            return redirect('/connect-facebook')->with('error', 'An error occured');
        }
    }

    public function updateData()
    {
        \App\Influencer\SocialMedia\SocialMedia::updateData();
    }
    
}
