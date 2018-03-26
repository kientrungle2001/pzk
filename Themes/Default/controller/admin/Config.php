<?php
pzk_import_controller('Default', 'Admin_Config');
class PzkAdminConfigController extends PzkDefaultAdminConfigController {
	public function getMenuLinks() {
		static $menuLinks;
		if(!$menuLinks) {
			$parentMenuLinks = parent::get('menuLinks');
			$newMenuLinks = $this->get('newMenuLinks');
			foreach ($newMenuLinks as $link) {
				$parentMenuLinks[] = $link;
			}
			$menuLinks = $parentMenuLinks;
		}
		return $menuLinks;
	}
	public $newMenuLinks = array(
			array (
					'name' => 'Trang tài liệu',
					'href' => '/Admin_Config/edit?config=document' 
			),
			array (
					'name' => 'Trang quà tặng',
					'href' => '/Admin_Config/edit?config=relax'
			),
			array (
					'name' => 'Trang Game',
					'href' => '/Admin_Config/edit?config=game'
			),
	);
}