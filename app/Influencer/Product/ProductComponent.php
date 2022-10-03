<?php

namespace App\Influencer\Product;

use App\Components\MenuComponentInterface;
use App\Components\NewCampaignComponentInterface;

class ProductComponent implements MenuComponentInterface, NewCampaignComponentInterface
{
	private $model;

	public function __construct()
	{
		$this->model = new Product;
	}

	public function getMenuIcon()
	{
		return 'product.png';
	}

	public function getMenuName($lang='eng')
	{
		return 'Product';
	}

	public function getMenuHint($lang='eng')
	{
		return 'Manage your products';
	}

	public function getNewCampaignView()
	{
		return 'components.product.new_campaign';
	}
}
