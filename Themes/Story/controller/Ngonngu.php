<?php
/**
 *
 */
class PzkNgonnguController extends PzkController{
	
    public $masterPage	=	"index";
    public $masterPosition = "left";
    
    public function questionAction(){
    	
    	$category_id = pzk_request()->getSegment(3);
    	
    	$this->initPage();
    	
    	$this->append('question/ngonnguParent', 'left');
    	
    	$ngonnguParent = pzk_element('ngonnguParent');
    	
    	$data_category = pzk_model('Category');
    	
    	$category = $data_category->get_category_all($category_id);
    	
    	$ngonnguParent->setCategory($category);
    	
    	$ngonnguParent->setCategoryId($category_id);
    	
    	$this->display();
    }
    
    public function chidQuestionAction(){
    	 
    	$category_id = pzk_request()->getSegment(3);
    	 
    	$this->initPage();
    	 
    	$this->append('question/ngonngu', 'left');
    	 
    	$ngonngu = pzk_element()->getNgonngu();
    	 
    	$keybook	= uniqid();
    
    	$s_keybook	=	pzk_session('keybook', $keybook);
    	 
    	$data_category = pzk_model('Category');
    	 
    	$category = $data_category->get_category_all($category_id);
    	 
    	$ngonngu->setCategory($category);
    	 
    	$ngonngu->setCategoryId($category_id);
    	 
    	$question_types = explode(',', $category['question_types']);
    	 
    	$data_question = pzk_model('AdminQuestion');
    	 
    	$data_topics = $data_question->get_topics();
    	 
    	$ngonngu->setData_topics($data_topics);
    	 
    	$this->display();
    }
    
    public function doQuestionAction(){
    	
    	$this->initPage();
    	
    	if( pzk_request()->is('POST')){
    		
    		$keybook	= uniqid();
    		
    		$s_keybook	=	pzk_session('keybook', $keybook);
    		
	    	$this->append('question/showQuestion', 'left');
	    	
	    	$data_AdminQuestion_model = pzk_model('AdminQuestion');
	    	
	    	(int)$category_type = pzk_request()->getCategory_type();
	    	
	    	$category_type_name = $data_AdminQuestion_model->get_category_type_name($category_type);
	    	
	    	$data_criteria = array(
	    		'category_id'		=> pzk_request()->getCategory_id(),
	    		'category_name'		=> pzk_request()->getCategory_name(),
		    	'category_type' 	=> pzk_request()->getCategory_type(),
		    	'question_limit' 	=> pzk_request()->getNumber_question(),
		    	'question_time'		=> pzk_request()->getWork_time(),
		    	'question_topic' 	=> pzk_request()->getTopic(),
	    		'keybook'			=> $keybook,
	    		'category_type_name'=> $category_type_name['name'],
	    		'num_exercise'		=> pzk_request()->getExercise_no(),
	    	);
	    	
	    	$data_question_model = pzk_model('Question');
	    	
	    	$data_AdminQuestion_model = pzk_model('AdminQuestion');
	    	
	    	$data_question_topic 	= $data_AdminQuestion_model->get_topics($data_criteria['question_topic']);
	    	
	    	$result_search = $data_question_model->search_criteria($data_criteria);
	    	
	    	$data_showQuestion	= pzk_element()->getShowQuestion();
	    	
	    	$data_showQuestion->setData_showQuestion($result_search);
	    	
	    	$data_showQuestion->setData_question_topic($data_question_topic);
	    	
	    	$data_showQuestion->setData_criteria($data_criteria);
    	}
    	
    	$this->display();
    }
    
    public function getExerciseAction(){
    	
    	$request 			= pzk_request();
    	 
    	$category_type		= $request->getCategory_type();
    	 
    	$topic				= $request->getTopic();
    	
    	$data_criteria = array(
    			'category_type'		=> $category_type,
    			'question_topic'	=> $topic
    	);
    	
    	$data_question_model = pzk_model('Question');
    	
    	$num_questions = $data_question_model->getQuestionByTopic($data_criteria);
    	
    	(int)$num_exercise  = ceil($num_questions/NUM_QUESTION);
    	echo json_encode($num_exercise);
    }
    
    public function saveChoiceAction(){
    	
    	$userId	=	pzk_session('userId');
    	 
    	if($userId == 0 || empty($userId)){
    	
    		echo "0";
    		die;
    	}
    	
    	$request 			= pzk_request();
    	
    	$data_answers 		= $request->getanswers();
    	
    	if(!isset($data_answers)){
    		die;
    	}
    	
    	$user_book_key	= $request->getKeybook();
    	
    	$question_id 	= $data_answers['questions'];
    	
    	$exercise_number	= $data_answers['num_exercise'];
    	
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
    	
    	$category_id	= $data_answers['category_id'];
    	
    	$quantity_question	= count($data_answers['questions']);
    	
    	$userBook	= _db()->getEntity('Userbook.Userbook');
    	
    	$userAnswer	= _db()->getEntity('Userbook.Useranswer');
    	
    	$userAnswerText	= _db()->getEntity('Userbook.Useranswertext');
    	
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
    			'exercise_number'	=> $exercise_number,
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
		    	}elseif(setSuperType($question_type) == "fill_two"){
					
		    		foreach($question_id as $key => $value){
		    			$questionId		=	$question_id[$key];
		    			$questionType	=	$question_type;
		    			
		    			$answer = "";
		    			$status = $answers[$key]['status'];
		    			
		    			$i = 0;
		    			foreach($answers[$key] as $k => $ans){
		    				
		    				if($status == $k){
		    					
		    					$ans = $ans."_";
		    				}
		    				
		    				if($k != 'status'){
		    					if($i ==0){
		    						$answer = $ans;
		    					}else{
		    						$answer = $answer.'|'.$ans;
		    					}
		    				}
		    				$i++;
		    			}
		    			$rowAnswer=array('user_book_id'=>$userbookId,'questionId'=>$questionId,'question_type'=>$questionType,'content'=>$answer);
		    			$userAnswer->setData($rowAnswer);
		    			$userAnswer->save();
		    		}
		    	}elseif(setSuperType($question_type) == "fill_many"){
		    		
		    		foreach($question_id as $key => $value){
		    			$questionId		=	$question_id[$key];
		    			$questionType	=	$question_type;
		    			
		    			$answer = "";
		    			$i = 0;
		    			foreach($answers[$key] as $k => $ans){
		    				
	    					if($i ==0){
	    						$answer = $ans;
	    					}else{
	    						$answer = $answer.'|'.$ans;
	    					}
		    				$i++;
		    			}
		    			$rowAnswer=array('user_book_id'=>$userbookId,'questionId'=>$questionId,'question_type'=>$questionType,'content'=>$answer);
		    			$userAnswer->setData($rowAnswer);
		    			$userAnswer->save();
		    		}
		    	}elseif(setSuperType($question_type) == "fill_many_text"){
		    		
		    		foreach($question_id as $key => $value){
		    			$questionId		=	$question_id[$key];
		    			$questionType	=	$question_type;
		    			
		    			$answer = "";
		    			$i = 0;
		    			foreach($answers[$key] as $k => $ans){
		    				
	    					if($i ==0){
	    						$answer = $ans;
	    					}else{
	    						$answer = $answer.'|'.$ans;
	    					}
		    				$i++;
		    			}
		    			$rowAnswerText=array('content'=>$answer);
		    			$userAnswerText->setData($rowAnswerText);
		    			$userAnswerText->save();
		    			$userAnswerTextId = $userAnswerText->getId();
		    			
		    			$rowAnswer=array('user_book_id'=>$userbookId,'questionId'=>$questionId,'question_type'=>$questionType,'content'=>'', 'user_answers_text_id'=>$userAnswerTextId);
		    			$userAnswer->setData($rowAnswer);
		    			$userAnswer->save();
		    		}
		    	}elseif(setSuperType($question_type) == "choice_ex"){
		    		
		    		foreach($question_id as $key => $value){
		    			$questionId		=	$question_id[$key];
		    			$questionType	=	$question_type;
		    			
		    			$answer = "";
		    			$i = 0;
		    			foreach($answers[$key] as $k => $ans){
		    				if($k !== 'content_full'){
		    					$ans = $ans.'_';
		    				}
		    				
	    					if($i ==0){
	    						$answer = $ans;
	    					}else{
	    						$answer = $answer.'|'.$ans;
	    					}
		    				$i++;
		    			}
		    			$rowAnswerText=array('content'=>$answer);
		    			$userAnswerText->setData($rowAnswerText);
		    			$userAnswerText->save();
		    			$userAnswerTextId = $userAnswerText->getId();
		    			
		    			$rowAnswer=array('user_book_id'=>$userbookId,'questionId'=>$questionId,'question_type'=>$questionType,'content'=>'', 'user_answers_text_id'=>$userAnswerTextId);
		    			$userAnswer->setData($rowAnswer);
		    			$userAnswer->save();
		    		}
		    	}elseif(setSuperType($question_type) == "fill_one_text"){
		    		
		    		foreach($question_id as $key => $value){
		    			$questionId		=	$question_id[$key];
		    			$questionType	=	$question_type;
		    			
		    			$rowAnswerText=array('content'=>$answers[$key]);
		    			$userAnswerText->setData($rowAnswerText);
		    			$userAnswerText->save();
		    			$userAnswerTextId = $userAnswerText->getId();
		    			
		    			$rowAnswer=array('user_book_id'=>$userbookId,'questionId'=>$questionId,'question_type'=>$questionType,'content'=>'', 'user_answers_text_id'=>$userAnswerTextId);
		    			$userAnswer->setData($rowAnswer);
		    			$userAnswer->save();
		    		}
		    	}elseif(setSuperType($question_type) == "fill_one"){
		    		
		    		foreach($question_id as $key => $value){
		    			$questionId		=	$question_id[$key];
		    			$questionType	=	$question_type;
		    			
		    			$rowAnswer=array('user_book_id'=>$userbookId,'questionId'=>$questionId,'question_type'=>$questionType,'content'=>$answers[$key]);
		    			$userAnswer->setData($rowAnswer);
		    			$userAnswer->save();
		    		}
		    	}elseif(setSuperType($question_type) == "fill_table" || setSuperType($question_type) == "fill_table_text"){
		    		
		    		foreach($question_id as $key => $value){
		    			$questionId		=	$question_id[$key];
		    			$questionType	=	$question_type;
		    			
		    			$answer_full = '';
		    			$j = 0;
		    			foreach($answers[$key] as $k => $ans){
		    				$answer = '';
		    				$i = 0;
		    				foreach($ans as $key_ans =>$value_ans){
		    					if($value_ans ==''){
		    						
		    						$answer = $answer;
		    					}else{
		    						
				    				if($key_ans === 'status'){
				    					
				    					$value_ans = $value_ans.'_';
				    				}
			    					if($i ==0){
			    						
			    						$answer = $value_ans;
			    					}else{
			    						
			    						$answer = $answer.'|'.$value_ans;
			    					}
			    					$i++;
		    					}
		    				}
		    				
		    				if($j == 0){
		    					$answer_full = $answer;
		    					
		    				}else{
		    					$answer_full = $answer_full.'@'.$answer;
		    				}
		    				$j++;
		    			}
		    			$rowAnswerText=array('content'=>$answer_full);
		    			$userAnswerText->setData($rowAnswerText);
		    			$userAnswerText->save();
		    			$userAnswerTextId = $userAnswerText->getId();
		    			
		    			$rowAnswer=array('user_book_id'=>$userbookId,'questionId'=>$questionId,'question_type'=>$questionType,'content'=>'', 'user_answers_text_id'=>$userAnswerTextId);
		    			$userAnswer->setData($rowAnswer);
		    			$userAnswer->save();
		    		}
		    	}
	    		echo base64_encode($userbookId);
	    	}
    	}
    }
    
    public function showAnswersChoiceAction(){
    	
    	$request 			= pzk_request();
    	 
    	$data_answers 		= $request->getanswers();
    	
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
	    	}elseif (setSuperType($question_type[$key]) == "fill_two"){
	    		//<-- process equal content answers
	    		if(!empty($answers[$key])){
	    			$checkAnswerTrue = $frontendmodel->getAnswerTrueByContent($answers[$key], $value, "fill_two");
	    			if($checkAnswerTrue) {
	    				$totaltrue = $totaltrue + 1;
	    			}
	    		}
	    		//-->
    			$answersTrue = $frontendmodel->getAnswerByQuestionId($value);
    			
    			$result_answer[] = array(
    					'superType' 	=> "fill_two",
    					'questionId' 	=> $value,
    					'value' 		=> $answersTrue
    			); 
	    	}elseif (setSuperType($question_type[$key]) == "fill_many"){
	    		//<-- process equal content answers
	    		if(!empty($answers[$key])){
	    			$checkAnswerTrue = $frontendmodel->getAnswerTrueByContent($answers[$key], $value, "fill_many");
	    			if($checkAnswerTrue !== false) {
	    				$totaltrue = $totaltrue + round($checkAnswerTrue, 2);
	    			}
	    		}
	    		//-->
    			$answersTrue = $frontendmodel->getAnswerByQuestionId($value);
    			 
    			$result_answer[] = array(
    					'superType' 	=> "fill_many",
    					'questionId' 	=> $value,
    					'value' 		=> $answersTrue
    			);
	    	}elseif (setSuperType($question_type[$key]) == "fill_many_text"){
	    		
    			$answersTrue = $frontendmodel->getAnswerByQuestionId($value);
    			
    			$result_answer[] = array(
    					'superType' 	=> "fill_many_text",
    					'questionId' 	=> $value,
    					'value' 		=> $answersTrue
    			);
	    	}elseif (setSuperType($question_type[$key]) == "choice_ex"){
	    		
    			$answersTrue = $frontendmodel->getAnswerByQuestionId($value);
    		
    			$result_answer[] = array(
    					'superType' 	=> "choice_ex",
    					'questionId' 	=> $value,
    					'value' 		=> $answersTrue
    			);
	    	}elseif (setSuperType($question_type[$key]) == "fill_one_text" || setSuperType($question_type[$key]) == "fill_one"){
	    		
    			$answersTrue = $frontendmodel->getAnswerByQuestionId($value);
    		
    			$result_answer[] = array(
    					'superType' 	=> "fill_one_text",
    					'questionId' 	=> $value,
    					'value' 		=> $answersTrue
    			);
	    	}elseif (setSuperType($question_type[$key]) == "fill_table" || setSuperType($question_type[$key]) == "fill_table_text"){
	    		
    			$answersTrue = $frontendmodel->getAnswerTopicByQuestionId($value);
    		
    			$result_answer[] = array(
    					'superType' 	=> "fill_table",
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
    
    function requestChoiceAction(){
    	
    	$userId	=	pzk_session('userId');
    	 
    	if($userId != 0 || !empty($userId)){
    	
	    	$request 			= pzk_request();
	    	
	    	$user_book_id 		= $request->getUser_book_id();
	    	
	    	$key_book 			= $request->getKeybook();
	    	
	    	$book_id =  base64_decode($user_book_id);
	    	
	    	$userBook	= _db()->getEntity('Userbook.Userbook');
	    	
	    	$dataBook = array();
	    	
	    	if(isset($user_book_id) && !empty($user_book_id)){
	    		
	    		$dataBook = array(
	    				'id'			=> $book_id,
	    				'isRequest'		=> ISREQUEST
	    		);
	    	}else{
	    		
	    		$userBookModel	= pzk_model('Userbook');
	    		
	    		$id = $userBookModel->getUserbookId($key_book);
	    		
	    		$dataBook = array(
	    				'id'			=> $id,
	    				'isRequest'		=> ISREQUEST
	    		);
	    	}
	    	
	    	$transactionModel 	= pzk_model('Transaction');
	    	
	    	$categoryModel		= pzk_model('Category');
	    	
	    	$userbookModel  	= pzk_model('Userbook');
	    	
	    	$service = "Chấm bài";
	    	
	    	$reason = "Yêu cầu chấm";
	    	
	    	$userbookData = $userbookModel->getUserBook($dataBook['id']);
	    	
	    	$catId =  $categoryModel->get_category_parent($userbookData['categoryId']);
	    	
	    	$price = "";
	    	
	    	if($catId == '96'){
	    		$price = PAYMENT_USER_1;
	    	}
	    	if($catId == '97'){
	    		$price = PAYMENT_USER_2;
	    	}
	    	if($catId == '98'){
	    		$price = PAYMENT_USER_3;
	    	}
	    	if($catId == '99'){
	    		$price = PAYMENT_USER_4;
	    	}
	    	
	    	$checkTransaction = false;
	    	
	    	if($price != ""){
	    		
		    	$amount = $userbookData['quantity_question'] * $price;
		    	
		    	if(!$transactionModel->checkTransactionbyUserbookId($dataBook['id'])){
		    		
		    		$checkTransaction = $transactionModel->payService1($userId, $service, $amount, $reason, $dataBook['id']);
		    	}
	    	}
	    	
	    	if($checkTransaction){
	    		
	    		$userBook->setData($dataBook);
	    		 
	    		$userBook->save();
	    		
	    		echo 1;
	    	}else{
	    		echo 0;
	    	}
    	}else{
    		echo 0;
    	}
    }
    
   /*
   public function update_type_idAction(){
    	
    	$admin_question_model	=	pzk_model('AdminQuestion');
    	$result_question 		=	$admin_question_model->get_question();
    	
    	foreach($result_question as $key =>$value){
    		
    		$type_id = $admin_question_model->get_question_type_id($value['type']);
    		
    		$result_update_id = $admin_question_model->update_question_type_id($type_id, $value);
    	}
    } 
    */
    
    
    
    
}