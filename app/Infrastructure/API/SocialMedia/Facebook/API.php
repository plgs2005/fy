<?php

namespace App\Infrastructure\API\SocialMedia\Facebook;

use Socialite;
use Http;

use App\Influencer\SocialMedia\contracts\ISocialMediaUser;

abstract class API
{

    private $baseUrl = "https://graph.facebook.com";
    private $apiVersion = "v10.0";

    protected $completeUrl;
    protected $user;

    public function __construct(ISocialMediaUser $user)
    {
        $this->completeUrl = $this->baseUrl . "/" . $this->apiVersion;
        $this->user = $user;
    }

}
