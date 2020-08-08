<?php
class PzkFormController extends PzkController {
	public $masterPage = "index";
	Public $masterPosition = "left";
	
	public function indexAction() {
		if(pzk_themes('olympic')) {
			$this->setMasterPage('index');
			$this->setMasterPosition('wrapper');
		}
		$keybook	= uniqid();
    		
		$s_keybook	=	pzk_session()->setKeybook( $keybook);
		
		
		$subTopicId = pzk_request()->getSegment(3);
		$this->initPage();
		/*$header = pzk_element()->getHeader();
		if($header) {
			$header->setLayout('home/header2');
		}*/
		if(pzk_session('userId')) {
			
			$check = pzk_user()->checkPayment('full');
			//tai khoan da active
			if( 1==1 or isset($check) && $check == 1) {
			
				$this->append('education/form/lesson');
				$mcate = pzk_model('Category');
				//list lesson
				$dataLessons = $mcate->get_category_all($subTopicId); 
				$formLesson = pzk_element()->getFormLesson();
				//define 
				$formLesson->setLessonTime(QUESTIONTIME);
				$formLesson->setKeybook($keybook);
				$formLesson->setSubTopicId($subTopicId);
				$formLesson->setDataLessons($dataLessons);
			}else {
				$this->append('education/form/testerLesson');
				$mcate = pzk_model('Category');
				//list lesson
				$dataLessons = $mcate->get_category_all($subTopicId); 
				$formLesson = pzk_element()->getFormLesson();
				//define 
				$formLesson->setLessonTime(QUESTIONTIME);
				$formLesson->setKeybook($keybook);
				$formLesson->setSubTopicId($subTopicId);
				$formLesson->setDataLessons($dataLessons);
			}
		}else{
			$this->append('education/guide/nologin');
		}
		
		
		$this->display();
	}
	public function dragdropAction() {
		if(pzk_themes('olympic')) {
			$this->setMasterPage('index');
			$this->setMasterPosition('wrapper');
		}
		$this->initPage();
		$this->append('education/form/dragdrop');
		$this->display();
	}
	//get questions
	public function setLessonAction() {
		
		if(pzk_session('userId')) {
			$lessonId = pzk_request()->getLessonId();
			$category_root = pzk_request()->getCategory_root();
		
			$check = pzk_user()->checkPayment('full');
			//tai khoan da active
			$mQues = pzk_model('Question');
			if(isset($check) && $check == 1) {
				//xu ly loai cau hoi
				$lessonType = $mQues->getTypeByCateId($lessonId);	
				//debug($lessonType);die();	
				if(isset($lessonType)) {
					if($lessonType == 'DT' or $lessonType == 'Q0') {
						
						$obj = $this->parse('education/form/listquestion');
						
						$obj->setLessonId($lessonId);
						$obj->setLessonType($lessonType);
						$obj->setRootCateId($category_root);
					}elseif($lessonType == 'clickWord') {
						
						$obj = $this->parse('education/form/listClickWord');
						
						$obj->setLessonId($lessonId);
						$obj->setLessonType($lessonType);
						$obj->setRootCateId($category_root);
					}elseif($lessonType == 'dragWord') {	
						$obj = $this->parse('education/form/listDragWord');
						
						$obj->setLessonId($lessonId);
						//echo 1; die();
						$obj->setLessonType($lessonType);
						$obj->setRootCateId($category_root);
					}else {
						die('sory baby');
					}
					
				}
				
			}else {
				
				$education = Pzk_model('education');
				$lessontester = $education->getLessonTester($category_root);
				
				if($lessonId == $lessontester['id']) {
					$lessonType = $mQues->getTypeByCateId($lessonId);	
					//debug($lessonType);die();	
					if(isset($lessonType)) {
						if($lessonType == 'DT' or $lessonType == 'Q0') {
							
							$obj = $this->parse('education/form/listquestion');
							
							$obj->setLessonId($lessonId);
							$obj->setLessonType($lessonType);
							$obj->setRootCateId($category_root);
						}elseif($lessonType == 'clickWord') {
							
							$obj = $this->parse('education/form/listClickWord');
							
							$obj->setLessonId($lessonId);
							$obj->setLessonType($lessonType);
							$obj->setRootCateId($category_root);
						}elseif($lessonType == 'dragWord') {	
							$obj = $this->parse('education/form/listDragWord');
							
							$obj->setLessonId($lessonId);
							//echo 1; die();
							$obj->setLessonType($lessonType);
							$obj->setRootCateId($category_root);
						}else {
							die('sory baby');
						}
						
					}
				}else {
					$obj = $this->parse('education/guide/noactive');
				}
				
			}
		}else {
			$obj = $this->parse('education/guide/nologin');
		}
		
		
		
		
		
		
		
		$obj->display();
		
	}
	//show answers
	public function showAnswersChoiceAction(){
    	
    	$request 			= pzk_request();
    	 
    	$data_answers 		= $request->getAnswers();
    	
    	//debug($data_answers);die;
    	
    	$question_id 		= $data_answers['questions'];
		
    	$question_type	= $data_answers['questionType'];
    	
    	$totalQuestion = count($question_id);
    	 
    	$category_root	= $data_answers['category_root'];
    	
    	$frontendmodel 	= pzk_model('Frontend');
    	
    	$result_answer = array();
    	//<-- more code to process total mark 
    	$answers 		= array();
    	if(isset($data_answers['answers'])){
    		$answers 		= $data_answers['answers'];
    	}
    	
    	$totaltrue = 0;
    	//-->
    	foreach($question_id as $key => $value){
    		
	    	if(setSuperType($question_type[$key]) == "choice"){
	    		//<-- process equal content answers
	    		if(!empty($answers[$key])){
	    			$checkAnswerTrue = $frontendmodel->getAnswerTrueByContent($answers[$key], $value, "choice");
	    			if($checkAnswerTrue) {
	    				$totaltrue = $totaltrue + 1;
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
	    				$totaltrue = $totaltrue + 1;
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
    	
    	$result_answer['total'] = $totaltrue;
    	$result_answer['totalQuestions'] = $totalQuestion;
    	$result_answer['category_root'] = $category_root;
    	echo json_encode($result_answer);
    }
	//luu vao vo bai tap
	public function saveChoiceAction(){
    	//check dang nhap
    	$userId	=	pzk_session('userId');
    	 
    	if($userId == 0 || empty($userId)){
    	
    		echo "0";
    		die;
    	}
    	
    	$request 			= pzk_request();
    	
    	$data_answers 		= $request->getAnswers();
    	//debug($data_answers);die();
    	if(!isset($data_answers)){
    		die;
    	}
    	
    	$user_book_key	= $request->getKeybook();
    	
    	$question_id 	= $data_answers['questions'];
    	
    	//$exercise_number	= $data_answers['num_exercise'];
    	
    	$totaltrue      = $request->getTotaltrue();
    	
    	$question_types = $data_answers['questionType'];
    	$question_type  = '';
    	foreach($question_types as $key=>$value){
    		
    		$question_type = $value;
    		break;
    	}
    	
    	$testId = 0;
    	
    	if(isset($data_answers['testId'])){
    	
    		$testId = $data_answers['testId'];
    	}
    	
    	$answers = array();
    	
    	if(isset($data_answers['answers'])){
    		
    		$answers = $data_answers['answers'];
    	}
    	
    	$category_id	= $data_answers['lessonId'];
    	
    	$quantity_question	= count($data_answers['questions']);
    	
    	$userBook	= _db()->getEntity('userbook.Userbook');
    	
    	$userAnswer	= _db()->getEntity('userbook.Useranswer');
    	
    	$userAnswerText	= _db()->getEntity('userbook.Useranswertext');
    	
    	if(isset($data_answers['start_time'])) {
    	
    		$start_time	= date('Y:m:d H:i:s', $data_answers['start_time']);
    	}else{
    		 
    		$start_time = '';
    	}
    	
    	$stop_time 	= date('Y:m:d H:i:s', $_SERVER['REQUEST_TIME']);
    	
    	if(isset($data_answers['during_time'])) {
    		$duringTime = $data_answers['during_time'];
    	}else {
    		$duringTime = 0;
    	}
    	
    	/**
    	 * Create new user book
    	 *
    	 */
    	
    	$row	= 	array(
    			'userId'			=> $userId,
    			'categoryId'		=> $category_id,
    			'quantity_question'	=> $quantity_question,
    			'startTime'			=> $start_time,
    			'stopTime'			=> $stop_time,
    			'created'			=> $stop_time,
    			'keybook'			=> $user_book_key,
    			'mark'              => $totaltrue,
    			'testId'			=> $testId,
    			'duringTime'		=> $duringTime,
				'software' 			=> pzk_request()->getSoftwareId(),
    			//'exercise_number'	=> $exercise_number,
    			'question_type'		=> $question_type,
    	);
    	
    	$s_keybook	=	pzk_session('keybook');
    	
    	if(isset($s_keybook)){
    		
	    	$isKeyBook = $userBook->checkKeybook($s_keybook);
	    	
	    	$s = pzk_session();
	    	
	    	$s->delKeybook();
	    	
	    	if($s_keybook == $user_book_key && !$isKeyBook){
	    		
		    	$userBook->setData($row);
		    	
		    	$userBook->save();
		    	
		    	$userbookId=$userBook->getId();
		    	
		    	if(setSuperType($question_type) == "choice"){
		    		
			    	foreach($question_id as $key => $value){
			    		if(empty($answers[$key])){
			    			$answers[$key] = '';
			    		}
			    		$questionId		=	$question_id[$key];
			    		$questionType	=	$question_type;
			    		
			    		$rowAnswer=array('user_book_id'=>$userbookId, 'questionId'=>$questionId, 'question_type'=>$questionType, 'content'=>$answers[$key]);
			    		$userAnswer->setData($rowAnswer);
			    		$userAnswer->save();
			    	}
		    	}elseif(setSuperType($question_type) == "fill_word"){
		    		
		    		foreach($question_id as $key => $value){
		    			$questionId		=	$question_id[$key];
		    			$questionType	=	$question_type;
		    			
		    			$rowAnswer=array('user_book_id'=>$userbookId,'questionId'=>$questionId,'question_type'=>$questionType,'content'=>$answers[$key]);
		    			$userAnswer->setData($rowAnswer);
		    			$userAnswer->save();
		    		}
		    	}
	    		echo base64_encode($userbookId);
	    	}
    	}
    }
	
    public function saveWordAction() {
		//check dang nhap
    	$userId	=	pzk_session('userId');
    	 
    	/*if($userId == 0 || empty($userId)){
    	
			echo "0";
    		die;
    	}*/
    	
		$lessonId = pzk_request()->getLessonId();
		$time = pzk_request()->getTime();
		$score = pzk_request()->getScore();
		$lessonType = pzk_request()->getLessonType();
		$startTime = pzk_request()->getStartTime();
		$endTime = pzk_request()->getEndTime();
		
		
		if($lessonId && $time) {
			$row	= 	array(
    			'userId'			=> $userId,
    			'categoryId'		=> $lessonId,
    			//'quantity_question'	=> $quantity_question,
    			'startTime'			=> date('Y-m-d H:i:s', $startTime),
    			'stopTime'			=> date('Y-m-d H:i:s', $endTime),
    			'created'			=> date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']),
    			'mark'              => $score,
    			//'testId'			=> $testId,
    			'duringTime'		=> $time,
				'software' 			=> pzk_request()->getSoftwareId(),
    			//'exercise_number'	=> $exercise_number,
    			'question_type'		=> $lessonType,
				'status' => 1
			);
			$userBook	= _db()->getEntity('userbook.Userbook');
			$userBook->setData($row);
		    	
			$userBook->save();
			echo 1;
		}else {
			die();
		}
		
	} 
}
 ?>