<?php
class PzkQuestionModel {
	
	function search_criteria($data = array()){
		
		$categoryTypeRow = _db()->useCache(1800)->select('*')->from('categories')->whereId($data['category_type'])->result_one();
		
		if(($data)){
			
			$query = _db()->useCache(1800)->select('q.*')->from('questions q');
			if(isset($data['class']) && ($data['class'])){
				$query->where( array('like','classes','%,'.$data['class'].',%'));
			}
			
			if(isset($data['media'])){
				$query->where( array('like','medias','%,'.$data['media'].',%'));
			} else {
				if(isset($data['category_type']) && ($data['category_type'])){
					$query->where( array('like','categoryIds','%,'.$data['category_type'].',%'));
				}else{
					$query->where( array('and', array('like','categoryIds','%,'.$data['category_id'].',%') ) );
				}
			}
			
			
			if(isset($data['question_type_id']) && ($data['question_type_id'])){
				$query->where(array('type_id','%'.$data['question_type_id']));
			}
			
			//them tuluan
			if(isset($data['questionType']) && ($data['questionType'])){
				$query->where(array('questionType', $data['questionType']));
			}else{
				$query->whereQuestionType(1);
			}
			
			if(!empty($data['question_level'])){
				$query->where(array('level', $data['question_level']));
			}
			
			if(isset($data['de']) && $data['de'] && is_numeric($data['de'])){
				if ($data['class'] == 3){
					$question_limit = 10;
				}if($data['class'] == 4){
					$question_limit = 20;
				}if($data['class'] == 5){
					$question_limit = 30;
				}
				$query->limit($question_limit,$data['de']-1);
			} else {
				$query->limit(QUESTION_LIMIT);
			}
			if(isset($data['trial']) && $data['trial'] == 0){
				$query->where(array('trial', 1));
			}
			
			if(($data['question_limit']) && $data['question_limit'] <= QUESTION_LIMIT){
				$query->limit($data['question_limit']);
			}
			
			if((@$data['num_exercise']) && $data['num_exercise'] <= QUESTION_LIMIT){
				
				$query->limit($data['num_exercise']* NUM_QUESTION);
			}
			
			if(isset($data['question_topic']) && ($data['question_topic'])){
				$query->where(array('like','topic_id','%,'.$data['question_topic'].',%'));
			}
			
			if(pzk_session('username') === 'maiphuong' || pzk_session('username') === 'HungD' || pzk_session('username') === 'dungnau' || pzk_session('username') === 'longlu92'){
				
				$query->orderby('id ASC');
				$query->limit(QUESTION_LIMIT_FULL);
			}else{
				
				if($categoryTypeRow['isSort'] == 1){
					
					$query->orderby('ordering ASC');
					
				}else{
					if(isset($data['de'])) {
						$query->orderby('ordering asc, id asc');
						$query->limit(5, $data['de']-1);
					} else {
						$query->orderby('rand()');
					}
				}
			}
			
			$query->where(array('status', QUESTION_ENABLE));
			
			$query->where(array('ne', 'deleted', DELETED));
			
			//echo $query -> getQuery();
			//die();
			
			$results = $query->result();
			
			return $results;
		}
		return NULL;
	}
	
	function getQuestionByTopic($data = array()){
		if(!empty($data)){
			
			$query = _db()->useCache(1800)->select('q.*')->from('questions q');
			$query->where(array('like','categoryIds','%,'.$data['category_type'].',%'));
			$query->where(array('like','topic_id','%,'.$data['question_topic'].',%'));
			$query->where(array('status', QUESTION_ENABLE));
			$query->where(array('ne', 'deleted', DELETED));
			$results = count($query->result());
			return $results;
		}
		return false;
	}
	
	function getTestById($testId){
		$query = _db()->useCache(1800)->select('*') 
					->from('tests') 
					->where(array('id', $testId));
		$results = $query->result_one();
		
		return $results;
	}
	
	function getQuestionByTest($testId, $limitTest){

        $isSort = $this->checkIsSort($testId);

		$query = _db()->useCache(1800)->select('*')
			->from('questions')
			->where(array('like','testId', '%,'.$testId.',%'))
			->where(array('ne','deleted', DELETED))
			->where(array('status', QUESTION_ENABLE))
			->limit($limitTest);
        if($isSort) {
            $query->orderBy('rand()');
        }
        $data = $query->result();
		return $data;
	}

    //check issort random

    function checkIsSort($testId) {
        $query = _db()->useCache(1800)->select('id, isSort')
            ->from('tests')
            ->where(array('id', $testId))
            ->result_one();
        if($query['isSort'] == 1) {
            return true;
        }else {
            return false;
        }
    }
	
	//get type lesson
	public function getTypeByCateId($lessonId) {
		
		$data =_db()->useCache(1800)
            ->select('*')
            ->from('categories')
            ->where("id = $lessonId")
            ;
		//echo $data->getQuery();
		$arLessonType = $data->result_one();
		$lessonType = $arLessonType['questiontype'];
		return $lessonType;
        
	}
    
}
?>