<?php

namespace App\Influencer\Influencer;

use App\Infrastructure\Repository\BaseRepository;

class InfluencerRepository extends BaseRepository
{
	public function __construct()
	{
		parent::__construct(new Influencer);
	}
}
