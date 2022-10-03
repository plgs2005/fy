<?php

namespace App\Influencer\SocialMedia;

use Illuminate\Database\Eloquent\Model;

use Auth;

use App\Influencer\SocialMedia\Facebook\User as FacebookUser;
use App\Infrastructure\API\SocialMedia\Facebook\Facebook as FacebookAPI;

use Http;

class SocialMedia extends Model
{
    protected $table = 'social_medias';
    protected $fillable = [
        'user_id',
        'social_media',
        'handler',
        'media_user_id',
        'media_username',
        'profile_picture_url',
        'token',
        'url',
        'impressions',
        'avgImpressions',
        'reach',
        'avgReach',
        'avgEngagement',
        'avgEngagementPercent',
        'postQuant',
        'followers',
        'active',
        'page_name',
    ];

    public function user()
    {
        return $this->belongsTo('App\Influencer\User\User');
    }

    public function posts()
    {
        return $this->hasMany('App\Influencer\Post\Post');
    }

    public function verifyFb()
    {
        $user  = Auth::user();
        $facebookUser = FacebookUser::make($user);
        $facebookApi = new FacebookAPI($facebookUser);
        $fb_pages = $facebookApi->getFacebookPages()->Json();
        
        if (empty($fb_pages['data'])) {
            return false;
        }

        return true;
    }

    public function verifyToken()
    {
        switch ($this->social_media) {
        case 'facebook':
            $res = Http::get("https://graph.facebook.com/v10.0/me?fields=gender&access_token={$this->token}")->Json();
            break;
        case 'facebook_page':
            $res =  Http::get("https://graph.facebook.com/v10.0/{$this->media_user_id}?fields=name,username,picture,engagement,fan_count,link&access_token={$this->token}")->Json();
            break;
        case 'instagram_business':
            $res = Http::get("https://graph.facebook.com/v10.0/{$this->media_user_id}?access_token={$this->token}&fields=username")->Json();
            break;
        default:
            // code...
            break;
        }

        if (isset($res['error'])) {
            $this->token_valid = 0;
            $this->save();
            return false;
        } else {
            $this->token_valid = 1;
            $this->save();
            return true;
        }
            
    }

    public static function updateData($social_media_id = null)
    {
        
        if (is_null($social_media_id)) {
            $socialMedias = \App\Influencer\SocialMedia\SocialMedia::get();
        } else {
            $socialMedias = \App\Influencer\SocialMedia\SocialMedia::where('id', $social_media_id)->get();
        }
        
        foreach ($socialMedias as $socialMedia) {
            if ($socialMedia->token_valid) {
                $posts = $socialMedia->posts;
                $postCount=0;
                $impressions=0;
                $reach=0;
                $engagement=0;

                if ($posts->count()) {
                    foreach ($posts as $post) {
                        $dadosPost = $post->metrics;
                        foreach ($dadosPost as $dadoPost) {
                            
                            switch ($dadoPost->tipo) {
                            case 'impressions':
                                $impressions = $impressions+$dadoPost->valor;
                                break;

                            case 'reach':
                                $reach = $reach+$dadoPost->valor;
                                break;

                            case 'engagement':
                                $engagement = $engagement+$dadoPost->valor;
                                break;
                                
                            default:
                                break;
                            }
                            
                        }
                        $postCount++;
                    }
                }

                if ($impressions !== 0) {
                    $socialMedia->avgImpressions = $impressions/$postCount;
                    $socialMedia->impressions = $impressions;
                }
                if ($reach !== 0) {
                    $socialMedia->avgReach = $reach/$postCount;
                    $socialMedia->reach = $reach;
                }
                if ($engagement !== 0) {
                    $socialMedia->avgEngagement = $engagement/$postCount;
                }
                $socialMedia->postQuant = $postCount;

                if ($socialMedia->social_media == 'instagram_business') {
                    $user = $socialMedia->user;

                    $instagramUser = \App\Influencer\SocialMedia\InstagramBusiness\User::make($user);
                    $userInstagramApi = new \App\Infrastructure\API\SocialMedia\Facebook\Instagram($instagramUser);

                    $instaData = $userInstagramApi->getInstagramUser()->Json();
                    if (isset($instaData['error'])) {
                        continue;
                    }

                    $socialMedia->followers = $instaData['followers_count'];
                    $socialMedia->avgEngagementPercent = ($socialMedia->avgEngagement/$instaData['followers_count'])*100;
                }

                $socialMedia->update();

            }
        }
    }

    //verifica cada social media e atualiza campo token_valid
    public static function verifyAllTokens()
    {
        $socialMedias = \App\Influencer\SocialMedia\SocialMedia::get();
        foreach ($socialMedias as $socialMedia) {
            switch ($socialMedia->social_media) {
            case 'facebook':
                $res = Http::get("https://graph.facebook.com/v10.0/me?fields=gender&access_token={$socialMedia->token}")->Json();
                break;
            case 'facebook_page':
                $res =  Http::get("https://graph.facebook.com/v10.0/{$socialMedia->media_user_id}?fields=name,username,picture,engagement,fan_count,link&access_token={$socialMedia->token}")->Json();
                break;
            case 'instagram_business':
                $res = Http::get("https://graph.facebook.com/v10.0/{$socialMedia->media_user_id}?access_token={$socialMedia->token}&fields=username")->Json();
                break;
            default:
                // code...
                break;
            }

            if (isset($res['error'])) {
                $socialMedia->token_valid = 0;
            } else {
                $socialMedia->token_valid = 1;
            }
            $socialMedia->save();
        }
    }
}
