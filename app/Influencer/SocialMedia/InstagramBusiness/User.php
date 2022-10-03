<?php

namespace App\Influencer\SocialMedia\InstagramBusiness;

use App\Influencer\SocialMedia\contracts\ISocialMediaUser;
use App\Influencer\SocialMedia\contracts\SocialMediaUserTrait;

class User implements ISocialMediaUser
{
	use SocialMediaUserTrait;

	public static $type='instagram_business';
}