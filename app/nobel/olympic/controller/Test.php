<?php 
class PzkTestController extends PzkController {
	public function indexAction() {
		if(pzk_themes('olympic')) {
			$this->setMasterPage('index');
			$this->setMasterPosition('wrapper');
		}
		
		$this->initPage();
		$subTopicId = pzk_request()->getSegment(3);
		
		if(pzk_session('userId')) {
		
			$check = pzk_user()->checkPayment('full');
			//tai khoan da active
			if(isset($check) && $check == 1) {
		
				$this->append('education/test/test');
				$mcate = pzk_model('Category');
				//list lesson
				$dataLessons = $mcate->get_category_all($subTopicId); 
				$formLesson = pzk_element()->getTest();
				//define time
				$formLesson->setSubTopicId($subTopicId);
				$formLesson->setDataLessons($dataLessons);
			}else {
				$this->append('education/test/testerTest');
				$mcate = pzk_model('Category');
				//list lesson
				$dataLessons = $mcate->get_category_all($subTopicId); 
				$formLesson = pzk_element()->getTest();
				//define time
				$formLesson->setSubTopicId($subTopicId);
				$formLesson->setDataLessons($dataLessons);
			}
		}else {
			$this->append('education/guide/nologin');
		}
		
		
		
		$this->display();
	}
	public function setTestAction() {
		$testId = pzk_request()->getTestId();
		if($testId) {
			if(pzk_themes('olympic')) {
				$this->setMasterPage('index');
				$this->setMasterPosition('wrapper');
			}
			if(pzk_session('userId')) {
		
				$check = pzk_user()->checkPayment('full');
				//tai khoan da active
				if(isset($check) && $check == 1) {
					$obj = $this->parse('education/test/setTest');
					$obj->setTestId($testId);
				}else {
					$education = pzk_model('Education');
					$class = pzk_request()->getCurrentclass();
					$testIdTester = $education->getTestByTester($class);
					if($testId == $testIdTester['id']){
						$obj = $this->parse('education/test/setTest');
						$obj->setTestId($testId);
					}else {
						
						$obj = $this->parse('education/guide/noactive');
					}
				}
			}else{
				
				$obj = $this->parse('education/guide/nologin');
			}
			
			$obj->display();
			
		}
		
	}
	
	function getTimeAction() {
		$testId = pzk_request()->getTestId();
		$test = $data = _db()->selectAll()
			->fromTests()
			->where(array('id', $testId))
			->result_one();
		echo $data['time'];
		
	}
	
	public function getTestAction() {
		if(pzk_themes('olympic')) {
			$this->setMasterPage('index');
			$this->setMasterPosition('wrapper');
		}
		
		$this->initPage();
		$testId = pzk_request()->getSegment(3);
		if(pzk_session('userId')) {
		
			$check = pzk_user()->checkPayment('full');
			//tai khoan da active
			if(isset($check) && $check == 1) {
				$this->append('education/test/getTest');
				$mcate = pzk_model('Category');
				 
				$formLesson = pzk_element()->getGetTest();
				//define time
				$formLesson->setTestId($testId);
			}else {
				$this->append('education/test/testerGetTest');
				$mcate = pzk_model('Category');
				 
				$formLesson = pzk_element()->getGetTest();
				//define time
				$formLesson->setTestId($testId);
			}
		}else {
			$this->append('education/guide/nologin');
		}
		
		
		$this->display();
	}
	
	public function finishAction() {
		
		//check dang nhap
    	$userId	=	pzk_session('userId');
    	 
    	if($userId == 0 || empty($userId)){
    	
    		echo "0";
    		die;
    	}
		
		$request 			= pzk_request();
    	 
    	$data_answers 		= $request->getAnswers();
    	
    	//debug($data_answers);die;
    	
    	$question_id 		= $data_answers['questions'];
		
    	$question_type	= $data_answers['questionType'];
    	
    	
    	$frontendmodel 	= pzk_model('Frontend');
    	
    	$result_answer = array();
    	//<-- more code to process total mark 
    	$answers 		= array();
    	if(isset($data_answers['answers'])){
    		$answers 		= $data_answers['answers'];
    	}
    	
    	$totalTrueQ0 = 0;
		$totalTrueDt = 0;
    	//-->
    	foreach($question_id as $key => $value){
    		
	    	if(setSuperType($question_type[$key]) == "choice"){
	    		//<-- process equal content answers
	    		if(!empty($answers[$key])){
	    			$checkAnswerTrue = $frontendmodel->getAnswerTrueByContent($answers[$key], $value, "choice");
	    			if($checkAnswerTrue) {
	    				$totalTrueQ0 = $totalTrueQ0 + 1;
	    			}
	    		}
	    		//-->
    			$answersTrue = $frontendmodel->getAnswerTrue($value);
    			
    			$result_answer[] = array(
    					'superType' 	=> "choice",
    					'questionId' 	=> $value,
    					'value' 		=> $answersTrue['id'],
	    				'value_fill' 	=> $answersTrue['content'],
	    				'recommend'		=> $answersTrue['recommend'],
    			);
	    	}elseif (setSuperType($question_type[$key]) == "fill_word"){
	    		
    			$answersTrue = $frontendmodel->getAnswerByQuestionId($value);
				
				//<-- process equal content answers
	    		if(!empty($answers[$key])){
	    			$checkAnswerTrue = $frontendmodel->getAnswerTrueByContent($answers[$key], $value, "fill_word");
	    			if($checkAnswerTrue) {
	    				$totalTrueDt = $totalTrueDt + 1;
	    			}
	    		}
	    		//-->
    		
    			$result_answer[] = array(
    					'superType' 	=> "fill_word",
    					'questionId' 	=> $value,
    					'value' 		=> $answersTrue
    			);
	    	}
    	}
    	
    	$result_answer['totalTrueDt'] = $totalTrueDt;
		
		$result_answer['totalTrueQ0'] = $totalTrueQ0;
		
		if($data_answers['clickScore']) {
			$clickScore = $result_answer['clickScore'];
		}else {
			$clickScore = 0;
		}
		
		if($data_answers['dragScore']) {
			$dragScore = $result_answer['dragScore'];
		}else {
			$dragScore = 0;
		}
		
		
		$questionTrue = $totalTrueDt + $totalTrueQ0 + $clickScore + $dragScore;
		
		$result_answer['testScore'] = $questionTrue * 2.5;
		
		$duringTime = $data_answers['during_time'];
		$start_time	= date('Y:m:d H:i:s', $data_answers['start_time']);
		$testId = $data_answers['testId'];
		$stop_time = date('Y:m:d H:i:s', $_SERVER['REQUEST_TIME']);;
		//save
		$userBook	= _db()->getEntity('userbook.Userbook');
		$row	= 	array(
    			'userId'			=> $userId,
    			'testId'		=> $testId,
    			'startTime'			=> $start_time,
    			'stopTime'			=> $stop_time,
    			'created'			=> $stop_time,
    			'mark'              => $questionTrue,
    			'duringTime'		=> $duringTime,
				'status'			=> 1,
				'software' 			=> pzk_request()->getSoftwareId()
    	);
		$userBook->setData($row);
		    	
		$userBook->save();
    	echo json_encode($result_answer);
	}
}
?>