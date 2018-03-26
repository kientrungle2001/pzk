<?php
pzk_import('Core.Db.Detail');
class PzkCoreThemesDirectoryDetail extends PzkCoreDbDetail {
	public $layout = 'admin/directory/theme/detail';
	public $table = 'themes';
	public function getLayoutObject() {
		$layoutObject = pzk_parse('<core.themes.directory.layout.list id="layoutList" />');
		$item = $this->getItem();
		$layoutObject->setParentId($item['name']);
		$layoutObject->setThemeId($item['id']);
		return $layoutObject;
	}
	public function getControllerObject() {
		$controllerObject = pzk_parse('<core.themes.directory.controller.list id="controllerList" />');
		$item = $this->getItem();
		$controllerObject->setParentField('theme');
		$controllerObject->setParentId($item['name']);
		$controllerObject->setThemeId($item['id']);
		return $controllerObject;
	}
}