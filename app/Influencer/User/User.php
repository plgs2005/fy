<?php

namespace App\Influencer\User;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use App\Casts\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Notifications\ResetPassword;

use Spatie\Permission\Traits\HasRoles;
use App\Infrastructure\API\Stripe\StripeApi;
use App\Infrastructure\API\ClickMeter\ClickMeterApi;

use Illuminate\Support\Facades\Storage;

use App\Influencer\Payout\Payout;
use Exception;
use Http;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'brand_name',
        'email',
        'password',
        'phone',
        'birth',
        'stripe_acc',
        'stripe_cus_id',
        'stripe_subscription_id',
        'checkout_session',
        'referrer',
        'avatarImg',
        'clickmeter_tag',
        'active',
        'receive_products',
        'time_zone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birth' => Date::class,
    ];

    protected $dates = [
        'birth',
    ];


    public function socialMediasId()
    {
        $temp = DB::table('social_medias')->select('id')->where('user_id', $this->id)->get();

        if ($temp->count()) {
            foreach ($temp as $social_media) {
                $ar[] = $social_media->id;
            }
            return $ar;
        } else {
            return false;
        }
    }

    public function socialMediaNames()
    {
        $temp = DB::table('social_medias')->select('social_media')->where('user_id', $this->id)->get();

        if ($temp->count()) {
            foreach ($temp as $social_media) {
                $ar[] = $social_media->social_media;
            }
            $ar = collect($ar);
            return $ar;
        } else {
            return false;
        }
    }

    public function social_medias()
    {
        return $this->hasMany('App\Influencer\SocialMedia\SocialMedia');
    }

    public function getSocialMediaId($socialMedia)
    {
        return $this->social_medias()->where('social_media', $socialMedia)->first()->media_user_id;
    }

    public function getSocialMediaToken($socialMedia)
    {
        return $this->social_medias()->where('social_media', $socialMedia)->first()->token;
    }

    public function getSocialMediaUsername($socialMedia)
    {
        return $this->social_medias()->where('social_media', $socialMedia)->first()->media_username;
    }

    public function address()
    {
        return $this->hasOne('App\Influencer\Address\Address');
    }

    public function withdrawal()
    {
        return $this->hasMany('App\Influencer\Withdrawal\Withdrawal');
    }

    public function clothing()
    {
        return $this->hasOne('App\Clothing');
    }

    /**
     * Campaigns owned by the user with the brand role.
     * 
     * @return colllection
     */
    public function brandCampaigns()
    {
        return $this->hasMany('App\Influencer\Campaign\Campaign', 'brand_id');
    }

    public function brandAudiences()
    {
        return $this->hasMany('App\Influencer\Audience\Audience', 'brand_id');
    }

    //Campaigns the user with influencer role was selected to run
    public function influencerCampaigns()
    {
        return $this->belongsToMany('App\Influencer\Campaign\Campaign', 'users_campaigns')->withPivot('brand_accept', 'influencer_accept', 'influencer_decline_motive', 'rating', 'value', 'score', 'manual_add', 'impressions', 'paid', 'tracking_link_url', 'tracking_link_id', 'startingNotification', 'startedNotification')->withTimestamps();
    }

    public function influencerCampaignPosts($id)
    {
        $ids = $this->socialMediasId();

        $posts =  DB::table('post')->select('permalink')->where('campaign_id', $id)->whereIn('social_media_id', $ids)->get();
        if ($posts->count()) {
            return $posts;
        } else {
            return false;
        }
    }

    public function posts()
    {
        return $this->hasManyThrough('App\Influencer\Post\Post', 'App\Influencer\SocialMedia\SocialMedia');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Influencer\Category\Category', 'users_categories');
    }

    public function categoriesIds()
    {
        $categories = $this->categories;
        if ($categories->count()) {
            foreach ($categories as $category) {
                $ar[] = $category->id;
            }
            $ar = collect($ar);
            return $ar;
        }
        return false;
    }

    //Campaigns the user with influencer role was selected to run and he has accepted
    public function influencerCampaignsAccepted()
    {
        return $this->belongsToMany('App\Influencer\Campaign\Campaign', 'users_campaigns')->withPivot('brand_accept', 'influencer_accept', 'rating', 'value')->wherePivot('influencer_accept', 1);
    }

    /**
     * Send the password reset notification.
     *
     * @param string $token
     * 
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function activateSubscription($sub_id)
    {
        $this->stripe_subscription_id = $sub_id;
        $this->save();
    }
    
    public function cancelSubscription()
    {
        $stripe = new StripeApi;
        $stripe->cancelSubscription($this->stripe_subscription_id);
    }

    public function subscriptionActive()
    {
        $stripe = new StripeApi;
        $sub = $stripe->getCustomerSubscription($this);
        if ($sub) {
            if ($sub->status == 'active') {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function withdraw($bank, $amount)
    {
        $stripe = new StripeApi;
        $balance = $stripe->getBalance($this->stripe_acc);

        if ($amount <= $balance->instant_available[0]->amount) {
            try {
                $res = $stripe->payout($bank, $this->stripe_acc, $amount);
            } catch (\Throwable $th) {
                throw new Exception('An error occurred');
            }
            
            $payout = new Payout;
            $payout->user_id = $this->id;
            $payout->stripe_payout_id = $res->id;
            $payout->balance = $balance->instant_available[0]->amount;
            $payout->amount = $res->amount;
            $payout->stripe_created = $res->created;
            $payout->stripe_arrival_date = $res->arrival_date;
            $payout->save();

            return $res;
        } else {
            throw new Exception('Amount is greather than you available balance');
        }
    }

    public function changePassword($password)
    {
        $this->password = Hash::make($password);
        $this->save();
        event(new PasswordReset($this));
    }

    public function deleteAvatarImg()
    {
        return Storage::disk('public')->delete("/$this->avatarImg");
    }
    public function deleteBrandLogo()
    {
        return Storage::disk('public')->delete("/$this->brand_logo");
    }

    public function avatarImg()
    {
        if ($this->avatarImg) {
            return asset("/storage/$this->avatarImg");
        }
        foreach ($this->social_medias as $social_media) {
            if ($social_media->social_media == 'instagram_business') {
                if ($social_media->profile_picture_url == null) {
                    return asset("/assets/images/avatar.png");
                } else {
                    $res = Http::get($social_media->profile_picture_url);
                    if ($res->successful()) {
                        //get the image saves to disk and update user->avatarImg path;
                        $url = $social_media->profile_picture_url;
                        $contents = file_get_contents($url);
                        $name = '/public/avatar/'.$this->id.'.jpeg';
                        Storage::put($name, $contents);
                        $this->avatarImg = "avatar/$this->id.jpeg";
                        $this->save();
                        return asset("/storage/$this->avatarImg");
                    } elseif ($res->clientError()) {
                        //update instagram picture url onsocial media table
                        $instagramUser = \App\Influencer\SocialMedia\InstagramBusiness\User::make($this);
                        $userInstagramApi = new \App\Infrastructure\API\SocialMedia\Facebook\Instagram($instagramUser);
                        $res = $userInstagramApi->getInstagramUser()->Json();
                        $social_media->profile_picture_url = $res['profile_picture_url'];
                        $social_media->save();
                        //get the image saves to disk and update user->avatarImg path;
                        $url = $social_media->profile_picture_url;
                        $contents = file_get_contents($url);
                        $name = '/public/avatar/'.$this->id.'.jpeg';
                        Storage::put($name, $contents);
                        $this->avatarImg = "avatar/$this->id.jpeg";
                        $this->save();
                        return asset("/storage/$this->avatarImg");
                    }
                }
            }
        }
    }

    /**
     * Clickmeter Tag used for grouping brand campaigns or influencer links on clickmeter
     * 
     * @return array $tag
     */
    public function clickmeterTag()
    {
        if ($this->clickmeter_tag) {
            return json_decode($this->clickmeter_tag);
        } else {

            if ($this->hasRole('Brand')) {
                $name = $this->brand_name;
            } elseif ($this->hasRole('Influencer')) {
                $name = $this->name;
            }

            $clickMeter = new ClickMeterApi;
            $tag = $clickMeter->createTag($name . '-id' . $this->id);
            $tag = $clickMeter->getTag($tag['id']);
            $tag = (object) $tag;

            $this->clickmeter_tag = json_encode($tag);
            $this->save();
            return $tag;
        }
    }

    public function StripeCustomer()
    {
        if ($this->hasRole('Brand')) {
            if ($this->stripe_cus_id) {
                return $this->stripe_cus_id;
            } else {
                $stripe = new StripeApi;
                // $customer = $stripe->getCustomer($this);

                $customer = $stripe->createCustomer($this);
                
                $data['stripe_cus_id'] = $customer;
                $this->update($data);
                return $this->stripe_cus_id;
            }
        } elseif ($this->hasRole('Influencer')) {
            return false;
        }
    }

    /**
     * Atualiza todos os dados relacionados as social medias ativas do influencer
     * Puxa posts e monta medias de impressoes likes engajamento etc
     */
    public function updateSocialMediasData()
    {
        \App\Jobs\UpdatePostData::dispatch($this->id);
        // \App\Influencer\Post\Post::updatePosts($this->id);
        $active_social_medias = $this->social_medias()->where('active',1)->get();
        foreach ($active_social_medias as $social_media) {
            \App\Influencer\Post\Post::updateInsights('feed', $social_media->id);
            \App\Influencer\SocialMedia\SocialMedia::updateData($social_media->id);
        }
    }

    public function stripeOnboardingComplete()
    {
        $stripe = new StripeApi;
        $stripeAcc = $stripe->getAccount($this);
        $res = $stripe->onboardingComplete($stripeAcc);
        if($res){
            $this->stripe_onboarding_complete = 1;
            $this->save();
        } else {
            $this->stripe_onboarding_complete = 0;
            $this->save();
        }
        return $res;
    }
}
