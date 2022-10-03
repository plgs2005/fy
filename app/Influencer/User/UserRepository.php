<?php

namespace App\Influencer\User;

use App\Infrastructure\Repository\BaseRepository;

class UserRepository extends BaseRepository
{
	public function __construct()
	{
		parent::__construct(new User);
	}

	public function fakeReturn()
	{
		return 'fake user';
	}
}
