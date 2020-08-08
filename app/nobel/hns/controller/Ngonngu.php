<?php
class PzkNgonnguController extends PzkController{
	
    public $masterPage	=	"index";
    public $masterPosition = "wrapper";
    
    public function practiceHomeAction(){
    	
		if(pzk_themes('default')) {
			$this->initPage()
			->append('practice', 'wrapper')
			->display();
		} else {
			$this->initPage();
			$this->append('question/questionHome', 'left');
			$this->display();	
		}
    }

    public function questionAction(){
        $check = pzk_user()->checkPayment('full');
        $category_id = pzk_request()->getSegment(3);

    	$this->initPage();
    	if(isset($check) && $check == 1) {
			if(pzk_themes('default')) {
				$this->append('practice', 'wrapper');
			} else {
				$this->append('question/ngonngu', 'left');
			}

				$ngonngu = pzk_element()->getNgonngu();

				$data_category = pzk_model('Category');
				
				// get category child of practice
				
				$categoryOrgin_id = 47;
				
				$categoryName = $data_category->get_category($category_id);
				
				$categoryCurrent = $data_category->get_category_all_display(87);
				
				$ngonngu->setCategoryCurrent($categoryCurrent);
				
				$ngonngu->setCategoryName($categoryName);

				$category = $data_category->get_category_all_display($categoryOrgin_id);

				$ngonngu->setCategory($category);

				$ngonngu->setCategoryId($category_id);
			}else {
				$keybook	= uniqid();

				$s_keybook	=	pzk_session()->setKeybook( $keybook);
				if(pzk_themes('default')) {
					$this->append('detail', 'wrapper');
				} else {
					$this->append('question/lessonTest', 'left');
				}

        }

    	$this->display();
    }
    
    public function doQuestionAction(){
    	
    	$this->initPage();
    	
    	if( pzk_request()->is('POST')){
    		
    		$keybook	= uniqid();
    		
    		$s_keybook	=	pzk_session()->setKeybook( $keybook);
    		
	    	$this->append('question/showQuestion', 'left');

	    	$data_AdminQuestion_model = pzk_model('AdminQuestion');
	    	
	    	(int)$category_type = pzk_request()->getCategory_type();
	    	
	    	$category_type_name = $data_AdminQuestion_model->get_category_type_name($category_type);
	    	
	    	
	    	$question_limit = pzk_request()->getNumber_question();
	    	
	    	if(pzk_request()->getNumber_question() == 0){
	    		
	    		$question_limit = NUMBER_QUESTION20;
	    	}
	    	
	    	$data_criteria = array(
	    		'category_id'		=> pzk_request()->getCategory_id(),
	    		'category_name'		=> pzk_request()->getCategory_name(),
		    	'question_limit' 	=> $question_limit,
		    	'question_time'		=> pzk_request()->getWork_time(),
		    	'question_level' 	=> pzk_request()->getLevel(),
	    		'keybook'			=> $keybook,
	    		'category_type'		=> $category_type,
	    		'category_type_name'=> $category_type_name['name']
	    	);
	    	
	    	$data_cache = array(
	    			'category_id'		=> pzk_request()->getCategory_id(),
	    			'category_name'		=> pzk_request()->getCategory_name(),
	    			'question_limit' 	=> $question_limit,
	    			'question_time'		=> pzk_request()->getWork_time(),
	    			'question_level' 	=> pzk_request()->getLevel(),
	    			'category_type'		=> $category_type,
	    			'category_type_name'=> $category_type_name['name']
	    	);
	    	
	    	$dataCategoryRow = pzk_model('Category');
	    	
	    	$dataRow = $dataCategoryRow->get_category($category_type);
	    	
	    	
	    	
	    	$data_question_model = pzk_model('Question');
	    	
	    	if(CACHE_MODE && CACHE_QUESTION_MODE){
	    	
	    	
		    	$key = md5(json_encode($data_cache). rand(1, PRACTICE_CACHE_LIMIT));
		    	if($result_search = pzk_filevar($key)){
	
		    	} else {
		    		$result_search = $data_question_model->search_criteria($data_criteria);
		    		pzk_filevar($key, $result_search);
		    	}
	    	}else{
	    		
	    		$result_search = $data_question_model->search_criteria($data_criteria);
	    	}
	    	
	    	$data_criteria['question_limit'] = count($result_search);
	    	
	    	$data_showQuestion	= pzk_element()->getShowQuestion();
	    	
	    	$data_showQuestion->setDataRow($dataRow);
	    	
	    	$data_showQuestion->setData_showQuestion( $result_search);
	    	
	    	$data_showQuestion->setData_criteria( $data_criteria);
    	}
    	
    	$this->display();
    }
    
    public function saveChoiceAction(){
    	
    	$userId	=	pzk_session('userId');
		
		$lang = 'en';
		$domain = $_SERVER['SERVER_NAME'];
		if($domain == 'fulllooksongngu.com' or $domain == 'test1sn.vn'){
			if(pzk_session('language')){
				$lang = pzk_session('language');
			}
		}else{
			if(pzk_session('language_tdn')){
				$lang = pzk_session('language_tdn');
			}
		}
    	
    	if($userId == 0){
    		
    		echo "notuserid";
    		
    		return ;
    	}
    	//session user
		$username = pzk_session('username');
		$name = pzk_session('name');
		$areacode = pzk_session('areacode');
		$district = pzk_session('district');
		$school = pzk_session('school');
		$class = pzk_session('class');
		$className = pzk_session('classname');
		$checkUser = pzk_session('checkUser');
		$servicePackage = pzk_session('servicePackage');
		
		
    	$request 			= pzk_request();
    	
    	$data_answers 		= $request->getAnswers();
    	
    	$user_book_key	= $request->getKeybook();
    	$week = $request->getWeek();
    	$question_id 	= $data_answers['questions'];
		//debug($data_answers['answers']);
    	//debug($question_id);die();
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
    	
    	$userBook	= _db()->getEntity('Userbook.Userbook');
    	
    	$userAnswer	= _db()->getEntity('Userbook.Useranswer');
    	
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
		$frontendmodel = pzk_model('Frontend');
		
		$dataAnswerTrue = $frontendmodel->getAllTrueAnswerByQuestionIds($question_id);
		$customAnswerTrue = array();
		foreach($dataAnswerTrue as $val) {
			$customAnswerTrue[$val['question_id']] = trim($val['id']);
		}
		
		
        foreach($question_id as $key => $value){

            if(!empty($answers[$key])){

                if(trim($answers[$key]) == $customAnswerTrue[$key]) {
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
                'categoryId'        => $week,
				'software' 			=> pzk_request()->getSoftwareId(),
				'created'			=> date(DATEFORMAT, $_SERVER['REQUEST_TIME']),
    			'duringTime'		=> $duringTime,
				'lang' 				=> $lang
    	);
    	
    	$s_keybook	=	pzk_session('keybook');
    	//debug($row);die();
    	if(isset($s_keybook)){
    		
    		$isKeyBook = $userBook->checkKeybook($s_keybook);
    		
    		$s = pzk_session();
    		
    		$s->del('keybook');
    		
    		if($s_keybook == $user_book_key && !$isKeyBook){
    			
    			$userBook->setData($row);
    			
    			$userBook->save();

                //hight score

    			 
    			$userbookId=$userBook->getId();

    			foreach($question_id as $key => $value){
    				if(empty($answers[$key])){
    					$answers[$key] = '';
    				}
    				$questionId		=	$question_id[$key];
    				$rowAnswers[] = array(
						'user_book_id'	=>	$userbookId,
						'questionId'	=>	$questionId,
						'answerId'		=>	$answers[$key]
					);
    				//$userAnswer->setData($rowAnswer);
    				//$userAnswer->save();
    			}
    			$frontendmodel->insertManyDatas('user_answers', array('user_book_id', 'questionId', 'answerId'), $rowAnswers);
				
				//log achievement
				//check test 
				//fulllock song ngu moi luu log
				$domain = $_SERVER['SERVER_NAME'];
				if($domain == 'fulllooksongngu.com' or $domain == 'test1sn.vn'){
					$checkPractice = $frontendmodel->checkPracticeByTestId($testId);
					if($checkPractice){
						pzk_stat()->logTestPrQuestion($userId, $username, $name, $totaltrue, $quantity_question, $areacode, $district, $school, $class, $className, $checkUser);	
					}else{
						pzk_stat()->logTestQuestion($userId, $username, $name, $totaltrue, $quantity_question, $areacode, $district, $school, $class, $className, $checkUser);
					}
				}
				
				//check ranking
				$checkSnUserBookRanking = $frontendmodel->checkSnUserBookRanking($userId, $testId);
					
				
				if($checkSnUserBookRanking === false){
						
						$dataTest = $frontendmodel->getOne($testId, 'tests');
						//update user book ranking
						$dataUserBookRanking	= 	array(
								'userId'			=> $userId,
								'startTime'			=> $start_time,
								'mark'			=> $totaltrue,
								'duringTime'              => $duringTime,
								'testId'			=> $testId,
								'username'        => pzk_session('username'),
								'name' 			=> $dataTest['name'],
								'name_sn'			=> $dataTest['name_sn'],
								'software'		=> pzk_request()->getSoftwareId(),
								'areacode' => $areacode,
								'district' => $district,
								'school' => $school,
								'class' => $class,
								'classname' => $className,
								'checkUser' => 1
						);
						//update
						$frontendmodel->save($dataUserBookRanking, 'user_book_rating');
					}else{
						$markUserbookRanking = $checkSnUserBookRanking['mark'];
						$duringTimeUserbookRanking = $checkSnUserBookRanking['duringTime'];
						if($totaltrue > $markUserbookRanking or ($totaltrue == $markUserbookRanking && $duringTime < $duringTimeUserbookRanking)){
							$dataUserBookRanking	= 	array(
								'mark'			=> $totaltrue,
								'duringTime'              => $duringTime,
							);
							$frontendmodel->save($dataUserBookRanking, 'user_book_rating', $checkSnUserBookRanking['id']);
						}
						
					}
					
				//all rank
				$rankByAll = $frontendmodel->getRateSnByAll($testId, $totaltrue, $duringTime);
					
				$rank = $rankByAll['rating']. ' / '. $rankByAll['total'];
				$frontendmodel->save(array('rank'=> $rank), 'user_book', $userbookId);
				
				//neu la user class room
				if($checkUser == 1 && $servicePackage == 'classroom'){ 
					//class rank
					$rankByclass = $frontendmodel->getRateSnByClass($testId, $class, $className, $totaltrue, $duringTime);
					$classRank = $rankByclass['rating']. ' / '. $rankByclass['total'];
					//school rank
					$rankBySchool = $frontendmodel->getRateSnBySchool($testId, $school, $totaltrue, $duringTime);
					$schoolRank = $rankBySchool['rating']. ' / '. $rankBySchool['total'];
					//district
					$rankByDistrict = $frontendmodel->getRateSnByDistrict($testId, $district, $totaltrue, $duringTime);
					$districtRank = $rankByDistrict['rating']. ' / '. $rankByDistrict['total'];
					//areacode
					$rankByareacode = $frontendmodel->getRateSnByCity($testId, $areacode, $totaltrue, $duringTime);
					$areacodeRank = $rankByareacode['rating']. ' / '. $rankByareacode['total'];
					
					$dataRank = array(
						'classRank' => $classRank,
						'schoolRank' => $schoolRank,
						'districtRank' => $districtRank,
						'areacodeRank' => $areacodeRank
					);
					$frontendmodel->save($dataRank, 'user_book', $userbookId);
					
					echo json_encode($rankByclass);
					
				}else{
					
					echo json_encode($rankByAll);
				}
		
    		}
    	}
    }
    
    function saveQuestionAction(){
    	
    	$request 			= pzk_request();
    	
    	$data_answers 		= $request->getAnswers();
    	
    	$question_id 		= $data_answers['questions'];
    	
    	$check = pzk_user()->checkPayment('full');
    	
    	if(isset($check) && $check == 1){
    		pzk_user()->appendQuestions($question_id);
    	}
    }
    
    
    
    public function showAnswersChoiceAction(){
    	 
    	$request 			= pzk_request();
    
    	$data_answers 		= $request->getAnswers();
    	 
    	$question_id 		= $data_answers['questions'];
    	
    	$questionType		= $data_answers['questionType'];

        $totalQuestion = count($question_id);

        $category_id = '';
        
		if(isset($data_answers['category_id'])){
    
    		$category_id	= $data_answers['category_id'];
		}
    	
    	$result_answer = array();

        $answers 		= array();
        if(isset($data_answers['answers'])){
            $answers 		= $data_answers['answers'];
        }

		
		//tong so cau dung
        $totaltrue = 0;
		$frontendmodel = pzk_model('Frontend');
		
		$dataAnswerTrue = $frontendmodel->getAllTrueAnswerByQuestionIds($question_id);
		$customAnswerTrue = array();
		foreach($dataAnswerTrue as $val) {
			$customAnswerTrue[$val['question_id']] = trim($val['id']);
		}
		
		
        foreach($question_id as $key => $value){

            if(!empty($answers[$key])){

                if(trim($answers[$key]) == $customAnswerTrue[$key]) {
                    $totaltrue++;
                }
            }
        }
		
		//xu ly phan show giai thich
		$dataExplant = $frontendmodel->getAllAnswerTrue($question_id);
		
    	foreach($dataExplant as $key => $value){
            
    		$result_answer[] = array(
    				'superType' 	=> $questionType[$value['question_id']],
    				'questionId' 	=> $value['question_id'],
    				'value' 		=> $value['id'],
    				'value_fill' 	=> $value['content'],
    				'recommend'		=> $value['recommend'],
    		);
    	}
        $result_answer['total'] = $totaltrue;
        $result_answer['totalQuestions'] = $totalQuestion;
    	
    	echo json_encode($result_answer);
    	 
    }
    
    
    function testAction(){
    	$position = 'left';
		if(pzk_themes('story') || pzk_themes('default')) {
			$position = 'wrapper';
		}
    	$check = pzk_user()->checkPayment('full');
    	
    	$this->initPage();
    	
    	$testId = pzk_request()->getSegment(3);
    	
    	if(isset($check) && $check == 1) {
    		
    		$this->append('question/test', $position);
    	
    		$test = pzk_element()->getTest();
    		
    		if($testId !== 0){
    			$testModel = pzk_model('Question');
    			$testDetail = $testModel->getTestById($testId);
    			$test->setTestDetail($testDetail);
    		}else{
    			$test->setTestDetail(0);
    		}
    	}else {
    		$keybook	= uniqid();
    	
    		$s_keybook	=	pzk_session()->setKeybook( $keybook);
			
			if(pzk_request()->getSoftwareId() == 1) {
				
				$this->append('question/test', $position);
				
				$test = pzk_element()->getTest();
				
				if($testId !== 0){
					
					$testModel = pzk_model('Question');
					$testDetail = $testModel->getTestById($testId);
					$test->setTestDetail($testDetail);
				}else{
					
					$test->setTestDetail(0);
				}
			} else {
				
				$this->append('question/lessonTest', $position);
			}
            
    	}
    	
    	$this->display();
    	
    }
    
    
    function doTestAction(){
    	$position = 'left';
		if(pzk_themes('story') || pzk_themes('default')) {
			$position = 'wrapper';
		}
    	if( pzk_request()->is('POST')){
    		
	    	$testId = (int) pzk_request()->getTest();
	    	
	    	if(isset($testId)){
	    		
		    	$testModel = pzk_model('Question');
		    	
		    	$test_detail = $testModel->getTestById($testId);
		    	
		    	$this->initPage();
		    	
		    	$keybook	= uniqid();
		    	
		    	$s_keybook	=	pzk_session()->setKeybook( $keybook);
		    	
		    	$this->append('question/showTest', $position);
		    	
		    	$test_detail['keybook'] = $keybook;
		    	
		    	if(CACHE_MODE && CACHE_QUESTION_MODE){
		    	
			    	$key = md5('test'.json_encode($testId));
			    	if($result_search = pzk_filevar($key)){
			    	
			    	} else {
			    		$result_search = $testModel->getQuestionByTest($testId, $test_detail['quantity']);
			    		pzk_filevar($key, $result_search);
			    	}
		    	}else{
		    		
		    		$result_search = $testModel->getQuestionByTest($testId, $test_detail['quantity']);
		    	}
		    	
		    	$data_showQuestion	= pzk_element()->getShowTest();
		    	
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

        $showRating	= pzk_element()->getShowRatings();

        $dataTest = $userBook->getAllTest();

        $showRating->setDataTest($dataTest);

        $this->display();
    }
    public function onchangeTestIdAction() {
        pzk_session()->setUserBookTestId( pzk_request()->getTestId());
        $this->redirect('rating');
    }
    public function listTestAction() {
        $this->initPage();
        $this->append('question/listTest', 'left');

        $this->display();
    }

    public function changePageSizeAction() {

        $userId = pzk_request()->getUserId();
        if(!empty($userId)) {
            pzk_session()->setListPageSize( pzk_request()->getPageSize());
            $this->redirect('listTest/'.$userId);
        }else{
            pzk_session()->setRatingPageSize( pzk_request()->getPageSize());
            $this->redirect('rating');

        }
    }
    
    /**
     *
     * Create Account VIP 1 - 100
     */
    
    function createAccountAction(){
		return false;
    	//$usernameRoot = "trandainghia";
    	$usernameRoot = "onthitdn";
    	
    	$account = '';
    	
    	//$n = 100;
    	
    	$n = 5;
    	
    	for($i = 1; $i <= $n; $i ++){
    		
    		$username = $usernameRoot.$i;
    		
    		$password = rand(100000, 999999);
    		
    		$data_user = array(
    				
    				'username'		=>$username,
    				'password'		=>md5($password),
    				'status'		=>1,
    				'registered'	=>date(DATEFORMAT),
    				'creatorId'		=>pzk_session('adminId')
    		);
    		
    		$data_payment = array(
    				
    				'username'			=>$username,
    				'amount'			=>280000,
    				'paymentStatus'		=>1,
    				'status'			=>1,
    				'software'			=>1,
    				'buySoftware'		=>1,
    				'created'			=>date(DATEFORMAT),
    				'creatorId'			=>pzk_session('adminId')
    		);
    		
    		$query_user			= _db()->insert('user')->fields('username, password, status, registered, creatorId')->values(array($data_user))->result();
    		$query_payment		= _db()->insert('history_payment')->fields('username, amount, paymentStatus, status, software, buySoftware, created, creatorId')->values(array($data_payment))->result();
    		
    		$account .= $username ." : ". $password."\n";
    	}
    	
    	$fileData = $account;

    	//file_put_contents(BASE_DIR.'/account.txt', $fileData);
    	
    	file_put_contents(BASE_DIR.'/accountnews.txt', $fileData);
    	
    }
}
?>