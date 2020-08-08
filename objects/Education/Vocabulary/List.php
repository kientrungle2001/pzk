<?php 
pzk_import('Core.Db.List');
/**
 * @author Admin
 *
 * Mar 9, 2015
 * 
 * Object Question Ngonngu 
 *
 */
class PzkEducationVocabularyList extends PzkCoreDbList{
	
	public $scriptable = false;
	function getLevelDocument($subjectId){		
		$query = _db()->useCache(1800)
		->useCacheKey('education_vocabulary_list_get_level_document_'.$subjectId)
		->select('categories.documentLevel as documentLevel')
		->from('categories')
		->where(array('id', $subjectId))
		->where(array('document', 1))
		->result_one();			
		return $query['documentLevel'];
	}
	function getChildSN($subjectId, $check, $class){
		
		$query = _db()->useCache(1800)
		->useCacheKey('education_vocabulary_list_get_child_sn_'.$subjectId.'_' .$check . '_' . $class)
		->select('*')
			->from('categories')
			->where(array('parent', $subjectId))
			->where(array('document', 1))
			->whereStatus(1)
			->likeClasses("%,$class,%")
			->orderBy('ordering asc')
			->result();
		return $query;
	}
	function getChild($subjectId, $check){
		
		$query = _db()->useCache(1800)
			->useCacheKey('education_vocabulary_getChild_'.$subjectId.'_' .$check)
			->select('*')
			->from('categories')
			->where(array('parent', $subjectId))
			->where(array('document', 1))
			->whereStatus(1)
			->orderBy('ordering asc')
			->result();
		return $query;
		if(isset($check ) && ($check == 1)){			
			return $query->result();
		}else{		
			return  $query->where(array('trial',1))->result();
		}
	}
	function getItemsVocabularySN($subjectId, $check, $class){
		$check = pzk_session()->getCheckPayment();
		$query = _db()->useCache(1800)
			->useCacheKey('education_vocabulary_getItemsVocabularySN_'.$subjectId.'_' .$check . '_' . $class)
			->select('*')
			->fromDocument()
			->likeCategoryIds("%,$subjectId,%")
			->whereType("vocabulary")
			->whereStatus(1)
			->likeClasses("%,$class,%")
			->orderBy('ordering asc')
			->result();
		return $query;
	}
	function getItemsVocabulary($subjectId, $check){
		$check = pzk_session()->getCheckPayment();
		$query = _db()->useCache(1800)->select('*')
			->fromDocument()
			->likeCategoryIds("%,$subjectId,%")
			->whereType("vocabulary")
			->whereStatus(1)
			->orderBy('ordering asc')
			->result();
		return $query;
		if(isset($check ) && ($check == 1)){
			return $query->result();
		}else{
			return  $query->whereTrial("1")->result();
		}
	}
	function getItemsSN($subjectId, $check, $class){
		
		$query = _db()->useCache(1800)
			->useCacheKey('education_vocabulary_list_get_items_sn_'.$subjectId.'_'.$check . '_' . $class)
			->select('*')
			->fromDocument()
			->whereCategoryId($subjectId)
			->whereType("vocabulary")
			->whereStatus(1)
			->likeClasses("%,$class,%")
			->orderBy('ordering asc')
			->result();
		return $query;
	}
	function getItems($subjectId = false, $check = array()){
		
		$query = _db()->useCache(1800)->select('*')
			->fromDocument()
			->whereCategoryId($subjectId)
			->whereType("vocabulary")
			->whereStatus(1)
			->orderBy('ordering asc')
			->whereTrial("0")
			->result();
		return $query;
		if(isset($check ) && ($check == 1)){
			return $query->result();
		}else{
			return  $query->whereTrial("1")->result();
		}
	}
	function getItemstrial($subjectId, $check){
		
		$query = _db()->useCache(1800)->select('*')
			->fromDocument()
			->whereCategoryId($subjectId)
			->whereType("vocabulary")
			->whereStatus(1)
			->orderBy('ordering asc')
			->whereTrial("1")
			->result();
		return $query;
		/*if(isset($check ) && ($check == 1)){
			return $query->result();
		}else{
			return  $query->whereTrial("1")->result();
		}*/
	}
	function getItemstrialSN($subjectId, $check, $class){
		
		$query = _db()->useCache(1800)->select('*')
			->fromDocument()
			->whereCategoryId($subjectId)
			->whereType("vocabulary")
			->whereStatus(1)
			->likeClasses("%,$class,%")
			->whereTrial("1")
			->orderBy('ordering asc')
			->result();
		return $query;
		/*if(isset($check ) && ($check == 1)){
			return $query->result();
		}else{
			return  $query->whereTrial("1")->result();
		}*/
	}
	public function hash() {
		return md5(pzk_session()->getLogin().pzk_user()->checkPayment('full'). parent::hash());
	}
}
 ?>