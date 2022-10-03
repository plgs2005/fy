<?php

namespace App\Influencer\Product;

use App\Infrastructure\Repository\BaseRepository;

class ProductRepository extends BaseRepository
{
	public function __construct()
	{
		parent::__construct(new Product);
	}
}
