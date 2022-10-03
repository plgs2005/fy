<?php

namespace App\Infrastructure\API\SocialMedia\Facebook;

use App\Influencer\SocialMedia\Facebook\User as FacebookUser;

use Http;

class Facebook extends API
{
    public function getFacebookPages()
    {
        return Http::get($this->completeUrl."/me/accounts?fields=access_token,category,category_list,name,username,id,link,fan_count,picture&access_token={$this->user->getToken()}");
    }

    public function getLocation()
    {
        return Http::get($this->completeUrl."/me?fields=location{location{city,state,country}}&access_token={$this->user->getToken()}")->Json();
    }

    public function getGender()
    {
        return Http::get($this->completeUrl."/me?fields=gender&access_token={$this->user->getToken()}")->Json();
    }
}
