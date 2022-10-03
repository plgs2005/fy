<?php

namespace App\Influencer\SocialMedia\Facebook;

use App\Influencer\SocialMedia\contracts\ISocialMediaUser;
use App\Influencer\SocialMedia\contracts\SocialMediaUserTrait;

class User implements ISocialMediaUser
{
	use SocialMediaUserTrait;

	public static $type='facebook';
}