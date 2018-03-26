<?php
pzk_import('Core.Db.List');
class PzkCmsMenu extends PzkCoreDbList {
	public $layout 			= 'cms/menu';
	public $table 			= 'categories';
	public $fields 			= '*';
	public $orderBy 		= 'ordering asc';
	public $cacheable 		= 'false';
	public $cacheParams		= 'id,layout';
	public function init() {
		$this->addFilter('display', '1');
		$this->addFilter('status', '1');
	}
}
?>