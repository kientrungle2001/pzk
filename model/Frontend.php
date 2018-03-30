<?php
class PzkFrontendModel {
    public function getTypeByQuestionId($questionId) {
        $data = _db()->useCache(1800)->select('type')
            ->from('questions')
            ->where(array('id', $questionId))
            ->result_one();
        return $data['type'];
    }
	public function insertManyDatas($table, $fields, $datas) {
		_db()->insert($table)->fields($fields)->values($datas)->result();
				
	}
	public function getAll($table) {
		$data = _db()->useCache(1800)->selectAll()
            ->from($table)
            ->result();
        return $data;
	}
    public function save($row, $table, $id=null) {
        $entity = _db()->useCb()->getEntity('Table')->setTable($table);
        if($id) {
            $entity->load($id);
            $entity->update($row);
            $entity->save();
        }else {
            $entity->setData($row);
            $entity->save();
        }
        return $entity->get('id');
    }
	public function getOne($id, $table) {
		$data = _db()->useCache(1800)->useCB()->select('*')->from($table)
            ->where(array('id', $id))->result_one();
        return $data;
	}
    public function getAnswerByQuestionId($questionId) {
        $data = _db()->useCB()->select('*')->from('answers_question_tn')
            ->where(array('question_id', $questionId))->result();
        return $data;
    }
	public function getAnswerByQuesId($questionId, $value) {
        $data = _db()->useCache(1800)
			->select('*')
			->from('answers_question_tn')
            ->where(array('question_id', $questionId))
			->where(array('content', $value))
			->result();
        if(count($data) > 0) {
			return true;
		}else {
			return false;
		}
    }
    public function getAnswerTopicByQuestionId($questionId) {
    	
    	$data = _db()->useCache(1800)->select('*')->from('answers_question_tn')
    	->where(array('question_id', $questionId))->result();
    	
    	foreach($data as $key => $value){
    		
    		$data_result = _db()->useCache(1800)->select('content')->from('answers_question_topic')
    		->where(array('answers_question_tn_id', $value['id']))->result();
    		
    		$data[$key]['value_topic'] = $data_result;
    	}
    	return $data;
    	
    }
    public function getAnswerTrue($questionId){
        $data = _db()->useCache(1800)->select('id, content, recommend')->from('answers_question_tn')
            ->where(array('question_id', $questionId))
            ->where(array('status', 1))
            ->result_one();
        return $data;
    }
	
	public function getAllAnswerTrue($questionIds){
        $data = _db()->useCache(1800)->select('id, question_id, content, recommend')->from('answers_question_tn')
            ->where(array('in', 'question_id', $questionIds))
            ->where(array('status', 1))
            ->result();
        return $data;
    }
	
	public function getAllTrueAnswerByQuestionIds($questionIds) {
		$data = _db()->useCache(1800)->select('id,question_id, content')->from('answers_question_tn')
	        	->where(array('in', 'question_id', $questionIds))
	            ->where(array('status', '1'))
	            ->result();
		return $data;			
	}
	
    public function getAnswerTrueByContent($content, $question_id, $question_type = ""){
		if($question_type == "choice" || $question_type == ""){
			$data = _db()->useCache(1800)->select('content')->from('answers_question_tn')
	        	->where(array('question_id', $question_id))
	            ->where(array('content', $content))
	            ->where(array('status', '1'))
	            ->result_one();
	        if(count($data)>0){
	        	
	        	if($data['content'] == $content){
	        		
	        		return true;
	        	}
	        }
    	}else if($question_type == "fill_word") {
			$data = _db()->useCache(1800)->select('content')->from('answers_question_tn')
	        	->where(array('question_id', $question_id))
	            ->where(array('content', $content))
	            ->result_one();
	        if(count($data)>0){
	        	
	        	if($data['content'] == $content){
	        		
	        		return true;
	        	}
	        }
		}
		
		else if($question_type == "fill_two"){
    		$data = _db()->useCache(1800)->select('content, status')->from('answers_question_tn')
    		->where(array('question_id', $question_id))
    		->result();
    		
    		if(count($data)>0){
    			
    			if(is_array($content)){
    				$content_true  = trim($content[$content['status']]);
    				foreach($content as $key =>$value){
    					if($key != 'status' && $key != $content['status']){
    						
    						$key_false = $key;
    					}
    				}
    				if(isset($key_false)){
    					$content_false = trim($content[$key_false]);
    				}else{
    					$content_false = "";
    				}
    				
    				$check_content_true = 0;
    				$check_content_false = 0;
    				
    				foreach($data as $k => $value_data){
    					
    					if($value_data['status'] == 1 && $value_data['content'] == $content_true){
    						
    						$check_content_true = 1;
    					}
    					
    					if($value_data['status'] != 1 && $value_data['content'] == $content_false){
    						
    						$check_content_false = 1;
    					}
    				}
    				
    				if($check_content_true && $check_content_false){
    					
    					return true;
    				}
    			}
    		}
    	}else if($question_type == "fill_many"){
    		$data = _db()->useCache(1800)->select('content')->from('answers_question_tn')
    		->where(array('question_id', $question_id))
    		->result();
    		
    		if(count($data)>0){
    			$data_value = array();
    			foreach($data as $k =>$value){
    				$data_value[] = $value['content'];
    			}
    			if(is_array($content)){
    				
    				$num_true = 0;
    				foreach($content as $key => $value){
    					
    					if(in_array(trim($value), $data_value)){
    						
    						$num_true ++;
    					}
    				}
    				
    				return $num_true/count($data);
    			}
    		}
    	}
        return false;
    }
    public function getAnswerChoice($questionId){
        $data = _db()->useCache(1800)->select('*')->from('answers_question_tn')
            ->where(array('question_id', $questionId))
            ->where(array('status', 1))
            ->result_one();
        return $data['content'];
    }
    public function getTopic($questionId){
        $data = _db()->useCache(1800)->select('*')->from('answers_question_tn')
            ->where(array('question_id', $questionId))
            ->result();
        return $data;
    }
    public function getAnswerTopic($questionId,$topicId) {
        $data = _db()->useCache(1800)->select('*')->from('answers_question_topic')
            ->where(array('question_id', $questionId))
            ->where(array('answers_question_tn_id', $topicId))
            ->result();
        return $data;
    }
    public function getChoiceRepair($questionId){
        $data = _db()->useCache(1800)->select('*')->from('answers_question_tn')
            ->where(array('question_id', $questionId))
            ->where(array('status', 1))
            ->result_one();
        return $data;
    }

    public function getAnswer($questionId) {
        $data = _db()->useCache(1800)->select('*')->from('answers_question_tn')
            ->where(array('question_id', $questionId))->result_one();
        return $data;
    }

    public function checkUserActiveCode($userId) {
        $data = _db()->useCB()->select('*')->from('user')
            ->where(array('id', $userId))
            ->where(array('signActive', 1))
            ->result();
        if($data){
            return true;
        }else {
            return false;
        }
    }
    
    public function getAllTest($practice = '0', $class = '5') {
        $check = pzk_session('checkPayment');

        $data = _db()->useCache(1800)->select('*')
            ->from('tests');
        if($check) {
            $data->where('trial = 0');
        }else {
            $data->where('trial = 1');
        }
		$data->where('status = 1');
		$data->wherePractice($practice);
		if($practice == '1') {
			$data->likeClasses("%,$class,%");
		}
        $data->orderBy('ordering asc');
        return $data->result();
    }
    
    function getRatingUserBookId($userId, $userbookId, $testId, $duringTime){
    	
    	$dataListUser = $this->getMarkUserBookId($testId);
    	
    	$rating = array(
    			'rating'	=> 1,
    			'total'		=> 0,
    	);
    	
    	$total = "";
    	foreach($dataListUser as $key =>$value){
    		
    		if($value['userId'] == $userId && $value['duringTime'] = $duringTime && $value['id'] == $userbookId){
    			
    			$rating['rating'] 	= $key+1;
    		}
    		
    		$rating['total']	= $key + 1;
    		
    	}
    	
    	return $rating;
    	
    }
    
    function getMarkUserBookId($testId){
    	
    	$data = _db()->useCache(1800)->select('id, userId, mark, duringTime')->from('user_book');
    	
    	$data->where(array('testId', $testId));
    	
    	$data->orderBy('mark  DESC, duringTime ASC');
    	
    	return $data->result();
    }
    
    function gameRate($table, $id, $topicid, $gameCode) {
        $data = _db()->useCache(1800)
            ->select('id')
            ->from($table)
            ->where(array('gametopic', $topicid))
            ->where(array('gamecode', $gameCode))
            ->orderBy('score DESC, live DESC')
            ->result();

        $rating = array(
            'rating'	=> 1,
            'total'		=> 0,
        );

        foreach($data as $key =>$value){

            if($value['id'] == $id){

                $rating['rating'] 	= $key+1;
            }

            $rating['total']	= $key + 1;

        }

        return $rating;
    }
	//contest
	function getContestRate($userId, $camp) {
		$data = _db()->useCache(1800)
            ->select('id, userId, camp, duringTime, totalMark')
            ->from('user_contest')
            ->where(array('camp', $camp))
			->where(array('userId', $userId))
            ->result_one();
		return $data;
	}
	function trytestRate($camp, $id) {
        $data = _db()->useCache(1800)
            ->select('count(*) as total')
            ->from('user_contest')
            ->where(array('camp', $camp))
            ->orderBy('totalMark DESC, duringTime ASC')
            ->result_one();
		
		$contest = _db()->useCache(1800)->selectAll()->fromUser_contest()->whereId($id)->result_one();
		
        $rating = array(
            'rating'	=> 1,
            'total'		=> $data['total'],
        );
		
		$data = _db()->useCache(1800)
            ->select('count(*) as total')
            ->from('user_contest')
            ->where(array('camp', $camp))
			->gteTotalMark($contest['totalMark'])
            ->orderBy('totalMark DESC, duringTime ASC')
            ->result_one();
		
		$rating['rating']	= $data['total'];

        return $rating;
    }
	
	public function getGameTopic() {
        $data = _db()->useCache(1800)->select('*')
            ->from('game_topic')
            ->result();
        return $data;
    }
	public function checkTrytestLogin($username, $pass) {
		$data = _db()->useCache(1800)->select('*')->from('user')
            ->where(array('username', $username))
			->where(array('password', md5($pass)))
            ->where(array('trytest', 1))
            ->result_one();
        if($data){
            return $data;
        }else {
            return false;
        }
	}
	
	//trytest
	public function getTrytest($trytest, $camp){
		$test = _db()->useCache(1800)
			->useCacheKey('getTrytest_' . $trytest . '_' . $camp)
			->select('*')
			->from('tests')
			->whereTrytest($trytest)
			->whereCamp($camp);
			
		return $test->result_one();
	}
	public function checkTrytest($userId, $testId, $camp) {
		$data = _db()->select('*')
			->from('user_book')
			->where(array('userId', $userId))
			->where(array('testId', $testId))
			->where(array('camp', $camp))
			->result_one();
			
		if($data) {
			return $data;
		}else{
			return false;
		}	
	}
	public function getTestTl($userId, $testId){
		$data = _db()->select('*')
			->from('user_book')
			->where(array('userId', $userId))
			->where(array('testId', $testId))
			->result_one();
		return $data;
	}
	
	public function checkTryResult($userId, $testid, $camp) {
		$data = _db()->select('*')
			->from('user_book')
			->where(array('userId', $userId))
			->where(array('testId', $testid))
			->where(array('camp', $camp))
			->result_one();
			
		if(count($data) >0 ) {
			if($data['status'] == 1){
				return 1;
			}else{
				return 2;
			}
		}else{
			return false;
		}	
	}
	
	public function getUserBook($userbookId) {
		$data = _db()->select('*')
			->from('user_book')
			->where(array('id', $userbookId))
			->result_one();
		return $data;	
	}
	//cham bai trung tam
	public function getUserbookTt($userId, $testId){
		$data = _db()->useCache(1800)->select('*')
			->from('user_book')
			->where(array('userId', $userId))
			->where(array('testId', $testId))
			->orderBy('id ASC')
			->result_one();
		return $data;
	}
	function getRateTt($userbookId, $testId) {
        $data = _db()->useCache(1800)
            ->select('count(*) as total')
            ->from('user_book')
			->where(array('testId', $testId))
            ->orderBy('mark DESC, duringTime ASC')
            ->result_one();
		
        $rating = array(
            'rating'	=> 1,
            'total'		=> $data['total'],
        );
		
		$contest = _db()->useCache(1800)->selectAll()->fromUser_book()->whereId($userbookId)->result_one();
		$data = _db()->useCache(1800)
            ->select('count(*) as total')
            ->from('user_book')
			->where(array('testId', $testId))
			->gteMark($contest['mark'])
            ->orderBy('mark DESC, duringTime ASC')
            ->result_one();
		
		$rating['rating']	= $data['total'];

        return $rating;
    }
	//rate song ngu
	
	public function checkPracticeByTestId($testId){
		$test = _db()->useCache(1800)
            ->select('practice')
            ->from('tests')
			->where(array('id', $testId))
            ->result_one();
		if(isset($test['practice']) && $test['practice'] == 1){
			return true;
		}else{
			return false;
		}
	}
	//check index ranking
	public function checkSnUserBookRanking($userId, $testId) {
		$data = _db()->useCache(1800)
            ->select('id, mark, duringTime')
			->from('user_book_rating')
			->where(array('userId', $userId))
			->where(array('testId', $testId))
			->result_one();
		if(count($data) > 0) {
			
			return $data;
		}else{
			return false;
		}	 
	}
	public function getRateSnByClass($testId, $class, $className, $mark, $duringTime) {
		$data = _db()
            ->select('count(*) as total')
            ->from('user_book_rating')
			->where(array('testId', $testId))
			->where(array('class', $class))
			->where(array('className', $className))
			->where(array('checkUser', 1))
            ->orderBy('mark DESC, duringTime ASC')
            ->result_one();
		
        $rating = array(
            'rating'	=> 1,
            'total'		=> $data['total'],
        );
		
		$data = _db()
            ->select('count(*) as total')
            ->from('user_book_rating')
			->where(array('testId', $testId))
			->where(array('class', $class))
			->where(array('className', $className))
			->where(array('checkUser', 1))
			->where("mark > $mark or (mark = $mark and duringTime <= $duringTime)")
            ->result_one();
		
		$rating['rating']	= $data['total'];

        return $rating;
	}
	public function getRateSnBySchool($testId, $school, $mark, $duringTime) {
		$data = _db()
            ->select('count(*) as total')
            ->from('user_book_rating')
			->where(array('testId', $testId))
			->where(array('school', $school))
            ->orderBy('mark DESC, duringTime ASC')
            ->result_one();
		
        $rating = array(
            'rating'	=> 1,
            'total'		=> $data['total'],
        );
		
		$data = _db()
            ->select('count(*) as total')
            ->from('user_book_rating')
			->where(array('testId', $testId))
			->where(array('school', $school))
			->where("mark > $mark or (mark = $mark and duringTime <= $duringTime)")
            ->result_one();
		
		$rating['rating']	= $data['total'];

        return $rating;
	}
	public function getRateSnByDistrict($testId, $district, $mark, $duringTime) {
		$data = _db()
            ->select('count(*) as total')
            ->from('user_book_rating')
			->where(array('testId', $testId))
			->where(array('district', $district))
            ->orderBy('mark DESC, duringTime ASC')
            ->result_one();
		
        $rating = array(
            'rating'	=> 1,
            'total'		=> $data['total'],
        );
		
		$data = _db()
            ->select('count(*) as total')
            ->from('user_book_rating')
			->where(array('testId', $testId))
			->where(array('district', $district))
			->where("mark > $mark or (mark = $mark and duringTime <= $duringTime)")
            ->result_one();
		
		$rating['rating']	= $data['total'];

        return $rating;
	}
	public function getRateSnByCity($testId, $city, $mark, $duringTime) {
		$data = _db()
            ->select('count(*) as total')
            ->from('user_book_rating')
			->where(array('testId', $testId))
			->where(array('areacode', $city))
            ->orderBy('mark DESC, duringTime ASC')
            ->result_one();
		
        $rating = array(
            'rating'	=> 1,
            'total'		=> $data['total'],
        );
		
		$data = _db()
            ->select('count(*) as total')
            ->from('user_book_rating')
			->where(array('testId', $testId))
			->where(array('areacode', $city))
			->where("mark > $mark or (mark = $mark and duringTime <= $duringTime)")
            ->result_one();
		
		$rating['rating']	= $data['total'];

        return $rating;
	}
	public function getRateSnByAll($testId, $mark, $duringTime) {
		$data = _db()
            ->select('count(*) as total')
            ->from('user_book_rating')
			->where(array('testId', $testId))
            ->orderBy('mark DESC, duringTime ASC')
            ->result_one();
		
        $rating = array(
            'rating'	=> 1,
            'total'		=> $data['total'],
        );
		
		$data = _db()
            ->select('count(*) as total')
            ->from('user_book_rating')
			->where(array('testId', $testId))
			->where("mark > $mark or (mark = $mark and duringTime <= $duringTime)")
            ->result_one();
		
		$rating['rating']	= $data['total'];

        return $rating;
	}

	public function getTestIdTry($class){
		$data = _db()->useCache(1800)
            ->select('id')
			->from('tests')
			->where(array('trial', 1))
			->likeClasses("%,$class,%")
			->result();
		return $data;	
	}
	
	public function getContestById($id) {
		$data = _db()->useCache(1800)
			->useCacheKey('getContestById_'. $id)
			->select('*')
			->fromContest()
			->whereId($id)
			->result_one();
		return $data;
	}
	public function getChildCompability($testtype, $parentId){
		
		$test = _db()->select('*')
			->from('tests')
			->where("trytest = $testtype")
			->where("parent = $parentId");
			
		return $test->result_one();
	}
	public function checkDoCompability($userId, $testId) {
		$data = _db()->select('*')
			->from('user_book')
			->where(array('userId', $userId))
			->where(array('testId', $testId))
			->whereCompability(1)
			->result_one();
			
		if($data) {
			return $data;
		}else{
			return false;
		}	
	}
	
	public function checkTestNsTn($userId, $parentId){
		$data = _db()->select('*')
			->from('user_book')
			->where(array('userId', $userId))
			->where(array('parentTest', $parentId))
			->where('trytest = 1')
			->whereCompability(1)
			->result_one();
			
		if($data) {
			return $data;
		}else{
			return false;
		}	
	}
	public function checkTestNsTl($userId, $parentId){
		$data = _db()->select('*')
			->from('user_book')
			->where(array('userId', $userId))
			->where(array('parentTest', $parentId))
			->where('trytest = 2')
			->whereCompability(1)
			->result_one();
			
		if($data) {
			return $data;
		}else{
			return false;
		}	
	}
	public function checkMarkTl($userId, $parentId){
		$data = _db()->select('*')
			->from('user_book')
			->where(array('userId', $userId))
			->where(array('parentTest', $parentId))
			->where('trytest = 2')
			->where('mustMark = 1')
			->where('status = 1')
			->whereCompability(1)
			->result_one();
			
		if($data) {
			return $data;
		}else{
			return false;
		}	
	}
	public function checkMarkTlAms($userId, $parentId){
		$data = _db()->select('*')
			->from('user_book')
			->where(array('userId', $userId))
			->where(array('parentTest', $parentId))
			->where('trytest = 2')
			->where('status = 1')
			->whereCompability(1)
			->result_one();
			
		if($data) {
			return $data;
		}else{
			return false;
		}	
	}
	
	public function checkExtraTest($userId, $parentId, $order){
		$data = _db()->select('*')
			->from('user_book')
			->where(array('userId', $userId))
			->where(array('parentTest', $parentId))
			->whereOrdering($order)
			->whereCompability(1)
			->whereExtraCompability(1)
			->result_one();
			
		if($data) {
			return $data;
		}else{
			return false;
		}	
	}
}
?>