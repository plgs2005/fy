<?php

namespace App\Influencer\Audience;

use App\Components\MenuComponentInterface;
use App\Components\NewCampaignComponentInterface;

class AudienceComponent implements MenuComponentInterface, NewCampaignComponentInterface
{
	private $model;

	public function __construct()
	{
		$this->model = new Audience;
	}

	public function getMenuIcon()
	{
		return 'audience.png';
	}

	public function getMenuName($lang='eng')
	{
		return 'Audience';
	}

	public function getMenuHint($lang='eng')
	{
		return 'Manage your audience';
	}

	public function getNewCampaignView()
	{
		return 'components.audience.new_campaign';
	}
}
