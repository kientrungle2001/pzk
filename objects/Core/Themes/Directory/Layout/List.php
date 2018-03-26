<?php
pzk_import('Core.Db.List');
class PzkCoreThemesDirectoryLayoutList extends PzkCoreDbList {
	public $table = 'site_layout';
	public $layout = 'admin/directory/theme/layout/list';
	public $parentMode = true;
	public $parentField = 'theme';
}