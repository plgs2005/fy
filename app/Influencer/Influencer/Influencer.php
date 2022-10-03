<?php

namespace App\Influencer\Influencer;

use App\Influencer\User\Interfaces\IUserType;
use Illuminate\Database\Eloquent\Model;

class Influencer extends Model implements IUserType 
{
	public function getModule()
	{
		return App\Influencer\Influencer;
	}
}