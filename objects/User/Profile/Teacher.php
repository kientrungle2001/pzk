<?php 

/**
* 
*/
class PzkUserProfileTeacher extends PzkObject
{
	
	public $layout = 'user/profile/teacher';
	
	public function checkSex($sex){
		if($sex=='1'){
			echo "Nam";
		}else if($sex=='0'){
			echo "Nữ";
		}
	}
	function getLesson($subject = '', $class=''){
	
		if(!empty($subject)){				
			$query = _db()->useCache(3600)
			->select('*') ->fromCategories()
			->whereParent($subject)
			->whereDisplay('1')			
			->likeClasses("%,$class,%")
			->result();
			if($query){
	
				return $query;
			}
		}
		return NULL;
	}
	function getPracticesSN($class = '', $subject=''){
		$query = _db()->useCache(1800)->select('count(*) as c')
		->fromQuestions()
		->likeCategoryIds("%,$subject,%")
		->likeClasses("%,$class,%");
		$data = $query->result_one();
		
		if($data['c']){
			return ceil($data['c']/ 5);
		}else{
			return false;
		}
		
	}
	function getTopicsSN($class = '',$subjectId){
			$query = _db()->useCache(1800)->select('*')
			->fromCategories()
			->whereParent($subjectId)
			->likeClasses("%,$class,%")
			->whereDisplay(1)
			->whereDocument(0)
			->orderBy('ordering asc');
			return $query->result();
	}
	function getLevel($class = '', $subjectId){		
		$query = _db()->useCache(1800)->select('categories.level')
		->fromCategories()
		->whereId($subjectId)
		->likeClasses("%,$class,%")
		->whereDisplay(1) ->result_one();			
		return $query['level'];
	}
	function getCatetype($class, $subjectId){		
		$query = _db()->useCache(1800)->select('categories.trial')
		->fromCategories()
		->whereId($subjectId)
		->likeClasses("%,$class,%")
		->whereDisplay(1) ->result_one();			
		return $query['trial'];
	}
	function getWeekTest($class, $subjectId, $practice){
		$query = _db()->useCache(1800)->select('*')
			->fromCategories()
			->whereParent($subjectId)
			->likeClasses("%,$class,%")
			->whereDisplay(1)
			->wherePractice($practice)			
			->orderBy('ordering asc');
		return $query->result();
	}
	public function getTestSN($class, $weekId=0, $practice){
	
		$listTest = _db()->useCache(1800)->select('*')->fromTests();
		/*if(pzk_session()->getLop()) $listTest->likeClasses("%,pzk_session()->getLop(),%");*/
		$listTest->likeCategoryIds("%,$weekId,%");
		$listTest->likeClasses("%,$class,%");
		$listTest->whereStatus(1);
		$listTest->wherePractice($practice);
		$listTest->where(array("or", array('displayAtSite', '0'), array('displayAtSite', pzk_request()->getSiteId())));
        
        $listTest->orderBy('ordering asc');
        return $listTest->result();
	}
}
 ?>