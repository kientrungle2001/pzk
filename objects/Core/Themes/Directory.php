<?php
pzk_import('Core.Db.List');
class PzkCoreThemesDirectory extends PzkCoreDbList {
	public $layout = 'admin/directory/theme/index';
	public $table = 'themes';
}