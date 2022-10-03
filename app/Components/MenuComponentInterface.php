<?php

namespace App\Components;

interface MenuComponentInterface extends ComponentInterface
{
	public function getMenuIcon();

	public function getMenuName($lang='eng');

	public function getMenuHint($lang='eng');
}
