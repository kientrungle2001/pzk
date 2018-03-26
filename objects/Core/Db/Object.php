<?php
class PzkCoreDbObject extends PzkObject {
	public $layoutId = '';
	public function getLayoutRealPath() {
		$layout = _db()->selectAll()->fromLayout()->whereId($this->getLayoutId())->result_one();
		if($layout) {
			$this->layout = $layout['content'];
		}
	}
}