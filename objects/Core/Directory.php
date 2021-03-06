<?php
pzk_import('Core.Db.List');
class PzkCoreDirectory extends PzkCoreDbList {
	public $layout 			= 'admin/directory/index';
	public $table 			= 'categories';
	public $parentMode 		= true;
	public $parentId 		= '0';
	public $parentField 	= 'parent';
	public $parentWhere 	= 'equal';
	public $orderBy			= 'ordering asc, id asc';
	public function getParentItem() {
		if($this->getParentId())
			return _db()->selectAll()->from($this->getTable())->whereId($this->getParentId())->result_one();
		return NULL;
	}
	public function getAllNews (){
		return _db()->selectAll()->from('news')->whereCategoryId($this->getParentId())->orderBy('ordering asc, id asc')->result();
	}
	public function getAllQuestions() {
		return _db()->selectAll()->from('questions')->likeCategoryIds('%,'.$this->getParentId().',%%')->orderBy('ordering asc, id asc')->result();
	}
}