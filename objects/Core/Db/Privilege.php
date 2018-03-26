<?php
class PzkCoreDbPrivilege extends PzkObject {
	public $layout = 'admin/privilege/index';
	
	public function getRoles()	{
		return _db()->selectAll()->fromAdmin_level()->whereStatus(1)->result();
	}
	
	public function	getPrivileges()	{
		return array('index', 'indexOwner', 'add', 'edit', 'editOwner', 'del', 'details');
	}
	
	public function getMenus()	{
		$items = _db()->selectAll()->fromAdmin_menu()->whereStatus(1)->result();
		return $items;
	}
}