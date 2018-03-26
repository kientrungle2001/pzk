<?php
pzk_import('Core.Db.Detail');
class PzkCoreDbGridEdit extends PzkCoreDbDetail {
	public $layout = 'admin/grid/form/edit';
	public function getFormObject() {
		if(!$this->get('form')) {
			$this->set('form', pzk_obj('Core.Form'));
		}
		return $this->get('form');
	}
}