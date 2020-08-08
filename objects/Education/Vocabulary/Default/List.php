<?php 
pzk_import('Education.Vocabulary.List');

class PzkEducationVocabularyDefaultList extends PzkEducationVocabularyList{
	
	public function hash() {
		return md5(pzk_session()->getLogin().pzk_user()->checkPayment('full'). parent::hash());
	}
	public $cacheable 	=	'true';
	public $cacheParams =	'layout,table,position,parentId';
	public function showDocument($check, $subjectId){
		if(isset($check ) && ($check == 1)){
			$query = _db()->useCache(1800)->select('*')
			->fromDocument()
			->whereCategoryId($subjectId)
			->whereStatus(1)
			->whereType('vocabulary')
			->likeClasses("%,5,%")
			->orderBy('ordering asc');
			return $query->result();
		}else{
			$query = _db()->useCache(1800)->select('*')
			->fromDocument()
			->whereCategoryId($subjectId)
			->whereTrial(1)			
			->whereStatus(1)
			->whereType('vocabulary')
			->likeClasses("%,5,%")
			->orderBy('ordering asc');
			return $query->result();
		}
	}
}
?>