<?php
class PzkEntityCmsCategoryModel extends PzkEntityModel{
	public $table = 'categories';
	public function getParentCategories() {
		$parentIds = trim($this->get('parents'), ',');
		$parentIds = explode(',', $parentIds);
		if(count($parentIds)) {
			return _db()->select('*')->from('categories')->where(array('in', 'id', $parentIds))->orderBy('parents asc')->result('Cms.Category');
		} else {
			return array();
		}
	}
}