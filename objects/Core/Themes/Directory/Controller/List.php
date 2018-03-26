<?php
pzk_import('Core.Db.List');
class PzkCoreThemesDirectoryControllerList extends PzkCoreDbList {
	public $table = 'site_controller_layout';
	public $layout = 'admin/directory/theme/controller/list';
	public $parentMode = true;
	public $parentField = 'theme';
	public $orderBy = 'controller_name asc, action_name asc';
}