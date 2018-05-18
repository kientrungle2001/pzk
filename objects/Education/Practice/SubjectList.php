<?php 
pzk_import('Core.Db.List');

class PzkEducationPracticeSubjectList extends PzkCoreDbList{
	
	public function hash() {
		return md5(pzk_session('login').pzk_user()->checkPayment('full'). parent::hash());
	}
	public $table ='categories';
	public $cacheable ='true';
	public $cacheParams ='layout, table,position';
	public $orderBy = 'categories.ordering asc';
	public function getSubject($class){
		$data = _db()->selectAll()->fromCategories()->likeClasses('%,'.$class.',%')->whereStatus('1')->whereDisplay('1')->orderBy('ordering asc')->whereParent('1457')->result();
		return $data;
	}
}
?>	