<?php
pzk_import('Core.Db.Detail');
class PzkCoreThemesDirectoryLayout extends PzkCoreDbDetail {
	public $layout = 'admin/directory/theme/layout';
	public $table = 'site_layout';
	public function getPositionObject() {
		$positionObject = pzk_parse('<core.themes.directory.layout.position.list id="positionList" />');
		$item = $this->getItem();
		$positionObject->setLayoutName($item['name']);
		$positionObject->setThemeName($item['theme']);
		$positionObject->setLayoutId($item['id']);
		$positionObject->addFilter('theme', $item['theme']);
		$positionObject->addFilter('layout', $item['name']);
		return $positionObject;
	}
}