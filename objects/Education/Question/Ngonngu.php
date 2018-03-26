<?php 

/**
 * @author Admin
 *
 * Mar 9, 2015
 * 
 * Object Question Ngonngu 
 *
 */
class PzkEducationQuestionNgonngu extends PzkObject{
	
	public $scriptable = false;
	public $cacheable	=	'true';
	public $cacheParams	=	'layout';
	public function init() {
		parent::init();
	}
	public function hash() {
		$id			= 	pzk_request('id');
		$class		=	pzk_request('class');
		return parent::hash() . '_id_' . $id . '_class_' .$class.'_check_' . pzk_user()->checkPayment('full');
	}
	function getPractices($class = '', $subject='',$check = 0, $questionType = 1){
		if(isset($check ) && ($check == 1)){
			$query = _db()->useCache(1800)
				->useCacheKey('ngonngu_getPractices_class_' . $class.'_subject_' . $subject . '_' . $check)
				->select('count(*) as c')
				->fromQuestions()
				->whereQuestionType($questionType)
				->likeCategoryIds("%,$subject,%")
				->likeClasses("%,$class,%");
			$data = $query->result_one();
		}else{
			$query = _db()->useCache(1800)->select('count(*) as c')
				->useCacheKey('ngonngu_getPractices_class_' . $class.'_subject_' . $subject . '_0')
				->fromQuestions()
				->whereQuestionType($questionType)
				->likeCategoryIds("%,$subject,%")
				->likeClasses("%,$class,%")
				->whereTrial("1")
				->orderBy('ordering asc');
			$data = $query->result_one();
		}
		
		if($data['c']){
			return ceil($data['c']/ 5);
		}else{
			return false;
		}	
	}
	function getPracticesSN($class = '', $subject='', $questionType = 1){
		$query = _db()->useCache(1800)->select('count(*) as c')
		->fromQuestions()
		->whereQuestionType($questionType)
		->likeCategoryIds("%,$subject,%")
		->likeClasses("%,$class,%");
		$data = $query->result_one();
		
		if($data['c']){
			return ceil($data['c']/ 5);
		}else{
			return false;
		}
	}
	function getTopics($subjectId,$check){
		if(isset($check ) && ($check == 1)){
			$query = _db()->useCache(1800)
			->useCacheKey('education_question_ngonngu_get_topics_'.$subjectId . '_' . $check)
			->select('*')
			->fromCategories()
			->whereParent($subjectId)
			->whereDisplay(1)
			->whereDocument(0)
			->likeClasses("%,5,%")
			->orderBy('ordering asc');
			return $query->result();
		}else{
			$query = _db()->useCache(1800)
			->useCacheKey('education_question_ngonngu_get_topics_'.$subjectId . '_' . $check)
			->select('*')
			->fromCategories()
			->whereParent($subjectId)
			->whereTrial("1")
			->whereDisplay(1)
			->whereDocument(0)
			->likeClasses("%,5,%")
			->orderBy('ordering asc');
			return  $query->result();
		}
	}
	function getTopicsSN($subjectId, $class){
			$query = _db()->useCache(1800)
			->useCacheKey('education_question_ngonngu_get_topics_sn_'.$subjectId . '_' . $class)
			->select('*')
			->fromCategories()
			->whereParent($subjectId)
			->likeClasses("%,$class,%")
			->whereDisplay(1)
			->whereDocument(0)
			->orderBy('ordering asc');
			return $query->result();
	}
	function getTopicsName($topic, $class){
			$query = _db()->useCache(1800)->select('*')
			->fromCategories()
			->whereId($topic)
			->likeClasses("%,$class,%")
			->whereDisplay(1)
			->whereDocument(0)
			->orderBy('ordering asc');
			return $query->result_one();
	}
	function getLevel($subjectId){		
		$query = _db()->useCache(1800)
		->useCacheKey('education_question_ngonngu_get_level_'.$subjectId)
		->select('categories.level')
		
		->fromCategories()
		->whereId($subjectId)
		->whereDisplay(1) ->result_one();
		return $query['level'];
	}
	function getCatetype($subjectId){		
		$query = _db()->useCache(1800)->select('categories.trial')
		->fromCategories()
		->whereId($subjectId)
		->whereDisplay(1) ->result_one();			
		return $query['trial'];
	}
	function getTrial($class = '', $subject=''){
			$query = _db()->useCache(1800)->select('count(*) as c')
			->fromQuestions()
			->likeCategoryIds("%,$subject,%")
			->likeClasses("%,$class,%")
			->whereTrial("1")
			->orderBy('ordering asc');
			$data = $query->result_one();	
			
		if($data['c']){
			return ceil($data['c']/ 5);
		}else{
			return false;
		}
	}
	
	function getMedias($subjectId){
			$query = _db()->useCache(1800)->select('*')
			->fromMedia()
			->likeCategoryIds("%,$subjectId,%")
			->whereStatus(1)
			->orderBy('ordering asc');
			return $query->result();
	}
	private $_homeworkIds = false;
	public function getHomeworkIds() {
		if($this->_homeworkIds) return $this->_homeworkIds;
		$classroomIds = pzk_user()->getClassroomIds();
		$homeworks = _db()->selectAll()->from('education_classroom_homework')
			->inClassroomId($classroomIds)
			->result();
		return $this->_homeworkIds = array_map(function($homework) {
			return $homework['homeworkId'];
		}, $homeworks);
	}
	function getHomeworks($subjectId){
			$homeworkIds  = $this->getHomeworkIds();
			$query = _db()->useCache(1800)->select('*')
			->fromTests()
			->likeCategoryIds("%,$subjectId,%")
			->inId($homeworkIds)
			->whereStatus(1)
			->orderBy('ordering asc');
			$items = $query->result();
			return $items;
	}
}
 ?>