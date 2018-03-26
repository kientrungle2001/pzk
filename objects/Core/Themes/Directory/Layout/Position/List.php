<?php
pzk_import('Core.Db.List');
class PzkCoreThemesDirectoryLayoutPositionList extends PzkCoreDbList {
	public $table = 'site_layout_position';
	public $layout = 'admin/directory/theme/layout/position/list';
	public $parentMode = false;
}