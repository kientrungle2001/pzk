<?php
class PzkCoreDbGridAdd extends PzkObject {
	public $layout = 'admin/grid/form/add';
	public function getFormObject() {
		if(!$this->get('form')) {
			$this->set('form', pzk_obj('Core.Form'));
		}
		return $this->get('form');
	}
}