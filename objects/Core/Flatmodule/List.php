<?php
pzk_import('Core.Db.List');
class PzkCoreFlatmoduleList extends PzkCoreDbList {
	public $table = 'flat_module';
	public $orderBy = 'ordering asc';
	public $layout = 'flatmodule/list';
}