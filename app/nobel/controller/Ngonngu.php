<?php
class PzkNgonnguController extends PzkFrontendController{
	
    public $masterPage	=	"index";
    public $masterPosition = "left";
    

    public function questionAction(){
        $check = pzk_session('signActive');
        $category_id = pzk_request()->getSegment(3);

    	$this->initPage();
    	if(isset($check) && $check == 1) {
            $this->append('question/ngonngu', 'left');

            $ngonngu = pzk_element('ngonngu');

            $data_category = pzk_model('Category');

            $category = $data_category->get_category_all_display($category_id);

            $ngonngu->setCategory($category);

            $ngonngu->setCategoryId($category_id);
        }else {
            $keybook	= uniqid();

            $s_keybook	=	pzk_session('keybook', $keybook);
            $this->append('question/lessonTest', 'left');

        }

    	$this->display();
    }
    
    public function doQuestionAction(){
    	
    	$this->initPage();
    	
    	if( pzk_request()->is('POST')){
    		
    		$keybook	= uniqid();
    		
    		$s_keybook	=	pzk_session('keybook', $keybook);
    		
	    	$this->append('question/showQuestion', 'left');

	    	$data_AdminQuestion_model = pzk_model('AdminQuestion');
	    	
	    	(int)$category_type = $category_type = pzk_request()->get('category_type');
	    	
	    	$category_type_name = $data_AdminQuestion_model->get_category_type_name($category_type);
	    	
	    	$data_criteria = array(
	    		'category_id'		=> pzk_request()->get('category_id'),
	    		'category_name'		=> pzk_request()->get('category_name'),
		    	'question_limit' 	=> pzk_request()->get('number_question'),
		    	'question_time'		=> pzk_request()->get('work_time'),
		    	'question_level' 	=> pzk_request()->get('level'),
	    		'keybook'			=> $keybook,
	    		'category_type'		=> $category_type,
	    		'category_type_name'=> $category_type_name['name']
	    	);
	    	
	    	$data_cache = array(
	    			'category_id'		=> pzk_request()->get('category_id'),
	    			'category_name'		=> pzk_request()->get('category_name'),
	    			'question_limit' 	=> pzk_request()->get('number_question'),
	    			'question_time'		=> pzk_request()->get('work_time'),
	    			'question_level' 	=> pzk_request()->get('level'),
	    			'category_type'		=> $category_type,
	    			'category_type_name'=> $category_type_name['name']
	    	);
	    	
	    	$data_question_model = pzk_model('Question');
	    	$key = md5(json_encode($data_cache). rand(1, PRACTICE_CACHE_LIMIT));
	    	if($result_search = pzk_filevar($key)){

	    	} else {
	    		$result_search = $data_question_model->search_criteria($data_criteria);
	    		pzk_filevar($key, $result_search);
	    	}
	    	
	    	
	    	
	    	$data_showQuestion	= pzk_element('showQuestion');
	    	
	    	$data_showQuestion->setData_showQuestion($result_search);
	    	
	    	$data_showQuestion->setData_criteria($data_criteria);
    	}
    	
    	$this->display();
    }
    
    public function saveChoiceAction(){
    	
    	$request 			= pzk_element('request');
    	
    	$data_answers 		= $request->get('answers');
    	
    	$user_book_key	= $request->get('keybook');
    	
    	$question_id 	= $data_answers['questions'];
    	
    	$testId = 0;

    	if(isset($data_answers['testId'])){
    		
    		$testId = $data_answers['testId'];
    	}
    	
    	$answers 		= array();
    	
    	if(isset($data_answers['answers'])){
    		
    		$answers 		= $data_answers['answers'];
    	}
    	$category_id = '';
    	
    	if(isset($data_answers['category_id'])){
    		
    		$category_id	= $data_answers['category_id'];
    	}
    	
    	$quantity_question	= count($data_answers['questions']);
    	
    	$userBook	= _db()->getEntity('userbook.userbook');
    	
    	$userAnswer	= _db()->getEntity('userbook.useranswer');
    	
    	$userId	=	pzk_session('userId');
    	
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

        //tong so cau dung
        $totaltrue = 0;
        foreach($question_id as $key => $value){

            if(!empty($answers[$key])){
                $frontendmodel = pzk_model('Frontend');
                $checkAnswerTrue = $frontendmodel->getAnswerTrueByContent($answers[$key], $value);
                if($checkAnswerTrue) {
                    $totaltrue++;
                }
            }
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
    			'keybook'			=> $user_book_key,
                'mark'              => $totaltrue,
    			'testId'			=> $testId,
    			'duringTime'		=> $duringTime
    	);
    	
    	$s_keybook	=	pzk_session('keybook');
    	
    	if(isset($s_keybook)){
    		
    		$isKeyBook = $userBook->checkKeybook($s_keybook);
    		
    		$s = pzk_session();
    		
    		$s->delKeybook();
    		
    		if($s_keybook == $user_book_key && !$isKeyBook){
    			
    			$userBook->setData($row);
    			
    			$userBook->save();

                //hight score

    			 
    			$userbookId=$userBook->get('id');

    			foreach($question_id as $key => $value){
    				if(empty($answers[$key])){
    					$answers[$key] = '';
    				}
    				$questionId		=	$question_id[$key];
    				$rowAnswer=array('user_book_id'=>$userbookId,'questionId'=>$questionId,'content'=>$answers[$key]);
    				$userAnswer->setData($rowAnswer);
    				$userAnswer->save();
    			}
    			echo base64_encode(encrypt($userbookId, SECRETKEY));
    		}
    	}
    }
    
    public function showAnswersChoiceAction(){
    	 
    	$request 			= pzk_element('request');
    
    	$data_answers 		= $request->get('answers');
    	 
    	$question_id 		= $data_answers['questions'];
    	
    	$questionType		= $data_answers['questionType'];

        $totalQuestion = count($question_id);

        $category_id = '';
        
		if(isset($data_answers['category_id'])){
    
    		$category_id	= $data_answers['category_id'];
		}
    	$frontendmodel = pzk_model('Frontend');
    	 
    	$result_answer = array();

        $answers 		= array();
        if(isset($data_answers['answers'])){
            $answers 		= $data_answers['answers'];
        }

        $totaltrue = 0;
    	foreach($question_id as $key => $value){
            if(!empty($answers[$key])){
                $checkAnswerTrue = $frontendmodel->getAnswerTrueByContent($answers[$key], $value);
                if($checkAnswerTrue) {
                    $totaltrue = $totaltrue + 1;
                }
            }

    		$answersTrue = $frontendmodel->getAnswerTrue($value);
    		$result_answer[] = array(
    				'superType' 	=> $questionType[$key],
    				'questionId' 	=> $value,
    				'value' 		=> $answersTrue['id'],
    				'value_fill' 	=> $answersTrue['content'],
    		);
    	}
        $result_answer['total'] = $totaltrue;
        $result_answer['totalQuestions'] = $totalQuestion;
    	
    	echo json_encode($result_answer);
    	 
    }
    
    
    function testAction(){
    	
    	$check = pzk_session('signActive');
    	
    	$this->initPage();
    	
    	if(isset($check) && $check == 1) {
    		
    		$this->append('question/test', 'left');
    	
    		$test = pzk_element('test');
    		
    	}else {
    		$keybook	= uniqid();
    	
    		$s_keybook	=	pzk_session('keybook', $keybook);
    		
    		$this->append('question/test', 'left');
    	}
    	
    	$this->display();
    	
    }
    
    
    function doTestAction(){
    	
    	if( pzk_request()->is('POST')){
    		
	    	$testId = (int) pzk_request()->get('test');
	    	
	    	if(isset($testId)){
	    		
		    	$testModel = pzk_model('Question');
		    	
		    	$test_detail = $testModel->getTestById($testId);
		    	
		    	$this->initPage();
		    	
		    	$keybook	= uniqid();
		    	
		    	$s_keybook	=	pzk_session('keybook', $keybook);
		    	
		    	$this->append('question/showTest', 'left');
		    	
		    	$test_detail['keybook'] = $keybook;
		    	
		    	$key = md5('test'.json_encode($testId));
		    	if($result_search = pzk_filevar($key)){
		    	
		    	} else {
		    		$result_search = $testModel->getQuestionByTest($testId, $test_detail['quantity']);
		    		pzk_filevar($key, $result_search);
		    	}
		    	
		    	$data_showQuestion	= pzk_element('showTest');
		    	
		    	$data_showQuestion->setData_showQuestion($result_search);
		    	
		    	$data_showQuestion->setData_criteria($test_detail);
		    	 
		    	$this->display();
	    	}
    	}
    }
    
   /*  public function update_type_idAction(){
    	
    	$admin_question_model	=	pzk_model('AdminQuestion');
    	$result_question 		=	$admin_question_model->get_question();
    	
    	foreach($result_question as $key =>$value){
    		
    		$type_id = $admin_question_model->get_question_type_id($value['type']);
    		
    		$result_update_id = $admin_question_model->update_question_type_id($type_id, $value);
    	}
    	
    } */
    
    public function ratingAction() {
        $this->initPage();
        $this->append('question/showRating', 'left');

        $userBook	= pzk_model('Frontend');

        $showRating	= pzk_element('showRatings');

        $dataTest = $userBook->getAllTest();

        $showRating->setDataTest($dataTest);

        $this->display();
    }
    public function onchangeTestIdAction() {
        pzk_session('userBookTestId', pzk_request('testId'));
        $this->redirect('rating');
    }
    public function listTestAction() {
        $this->initPage();
        $this->append('question/listTest', 'left');

        $this->display();
    }

    public function changePageSizeAction() {

        $userId = pzk_request('userId');
        if(!empty($userId)) {
            pzk_session('listPageSize', pzk_request('pageSize'));
            $this->redirect('listTest/'.$userId);
        }else{
            pzk_session('ratingPageSize', pzk_request('pageSize'));
            $this->redirect('rating');

        }
    }
    
}