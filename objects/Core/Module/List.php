<?php
pzk_import('Core.Db.List');
class PzkCoreModuleList extends PzkCoreDbList {
	public $table = 'flat_module';
	public $orderBy = 'ordering asc';
	public $layout = 'empty';
	public function finish() {
		$this->addFilter('status', 1);
		$items = $this->getItems();
		foreach($items as $item) {
			$elem = null;
			if($item['xml']) {
				$elem = pzk_parse($item['xml']);
			} else {
				$elem = pzk_parse($item['page']);
			}
			if($item['script']) {
				eval($item['script']);
			}
			if($elem) {
				$this->append($elem);
			}
		}
	}
}