<?php

namespace App\Influencer\Audience;

use App\Infrastructure\Repository\BaseRepository;

class AudienceRepository extends BaseRepository
{
	public function __construct()
	{
		parent::__construct(new Audience);
	}
}
