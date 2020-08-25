<?php
define('TN', 1);
define('TL', 2);

class PzkCompabilityController extends PzkController{
	public $masterPage	=	"index";
	public $masterPosition = 'wrapper';
	public function testAction(){
		if(pzk_session('userId')){
			$check 		= pzk_session('checkPayment');
			$sSchool = pzk_session('school');
			
			if($sSchool !== NS){
				$sClass = pzk_session('class');
				
				//$class = pzk_request()->getSegment(3);
				
				//if($sClass == $class){
					$frontend = pzk_model('Frontend');
					
					$parentId = pzk_request()->getSegment(4);
					$userId = pzk_session('userId');
					
					$checkTestNsTn = $frontend->checkTestNsTn($userId, $parentId);
					
					if($checkTestNsTn == false) {
					
						$testTn = $frontend->getChildCompability(TN, $parentId);

						$this->initPage();
							pzk_page()->setTitle('Đề khảo sát tìm kiếm học bổng');
							pzk_page()->setKeywords('Đề khảo sát tìm kiếm học bổng');
							pzk_page()->setDescription('Đề khảo sát tìm kiếm học bổng');
							pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
							pzk_page()->setBrief('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
							$this->append('education/test/compability', 'wrapper');
							
						
							$compability = pzk_element('compability');
							
							$data_criteria = array(
								'time' => $testTn['time'],
								'quantity' => $testTn['quantity'],
								'name' => $testTn['name'],
								'id' => $testTn['id'],
								'parentTest' => $testTn['parent']
								
							);
							$compability->setNgoisao(1);
							$compability->setParentId($parentId);
							$compability->setClass($sClass);
							$compability->setData_criteria($data_criteria);	
						$this->display();
						pzk_system()->halt();
					}else{
						//da thi xong
							$this->initPage();
								pzk_page()->setTitle('Đề khảo sát tìm kiếm học bổng');
								pzk_page()->setKeywords('Đề khảo sát tìm kiếm học bổng');
								pzk_page()->setDescription('Đề khảo sát tìm kiếm học bổng với phần mềm Full Look');
								pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
								pzk_page()->setBrief('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
								
								$this->append('trytest/alert', 'wrapper');
								$alert = pzk_element()->getAlert();
								$alert->setTitle('Bạn đã hoàn thành bài thi! <br> Mỗi tài khoản chỉ được thi một lần.');
								$this->display();
							pzk_system()->halt();
					}
				/*}else{
					//can chon dung khoi thi
					$this->initPage();
					$this->append('education/test/noclass', 'wrapper');
					$this->display();
					pzk_system()->halt();
				}*/
			}else if($check){
				$parentId = pzk_request()->getSegment(4);
				$class = pzk_request()->getSegment(3);
			
				$frontend = pzk_model('Frontend');
				$userId = pzk_session('userId');
				
				$testTn = $frontend->getChildCompability(TN, $parentId);
				
				
				$this->initPage();
					pzk_page()->setTitle('Đề khảo sát tìm kiếm học bổng');
					pzk_page()->setKeywords('Đề khảo sát tìm kiếm học bổng');
					pzk_page()->setDescription('Đề khảo sát tìm kiếm học bổng');
					pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
					pzk_page()->setBrief('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
					$this->append('education/test/compability', 'wrapper');
					
				
					$compability = pzk_element('compability');
					
					$data_criteria = array(
						'time' => $testTn['time'],
						'quantity' => $testTn['quantity'],
						'name' => $testTn['name'],
						'id' => $testTn['id'],
						'parentTest' => $testTn['parent']
						
					);
					
					$compability->setParentId($parentId);
					$compability->setClass($class);
					$compability->setData_criteria($data_criteria);	
				$this->display();
				pzk_system()->halt();
			}
			else{
				//cam mua tai khoan
				$this->initPage();
				$this->append('education/test/nouser', 'wrapper');
				$this->display();
				pzk_system()->halt();
			}
			

		}else{
			//chua dang nhap
			$camp = pzk_request()->getSegment(3);
			$this->initPage();
				pzk_page()->setTitle('Đăng nhập');
				pzk_page()->setKeywords('Đăng nhập');
				pzk_page()->setDescription('Đăng nhập với phần mềm Full Look');
				pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
				pzk_page()->setBrief('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
				$this->append('trytest/login', 'wrapper');
				$login = pzk_element()->getLogin();
				$login->setRel("/trytest/showtn/".$camp);
				$login->setTitle('thì mới được vào thi thử');
			$this->display();			
			pzk_system()->halt();
		}		
	}
	public function showtlAction(){
		if(pzk_session('userId')){
			
			$parentId = pzk_request('parentId');
			
			
			$frontend = pzk_model('Frontend');
				
			$userId = pzk_session('userId');
			
			$testTl = $frontend->getChildCompability(TL, $parentId);
		
			$compabilityTl=$this->parse('education/test/compabilityTl');
		
			$compabilityTl = pzk_element('compabilityTl');
			
			
			$sSchool = pzk_session('school');
			$time = $testTl['time'];
			if($sSchool == NS){
				$time = pzk_request('timeTl');
				$compabilityTl->setNgoisao(1);
			}
			
			$data_criteria = array(
				'time' => $time,
				'quantity' => $testTl['quantity'],
				'name' => $testTl['name'],
				'id' => $testTl['id'],
				'parentTest' => $testTl['parent']
			);
			
			$compabilityTl->setParentId($parentId);
			$compabilityTl->setData_criteria($data_criteria);
			$compabilityTl->display();
			
		}
	}
	public function saveChoiceAction(){
		
		if(!pzk_session('userId')){
			pzk_system()->halt();
		}
		
    	$frontendmodel = pzk_model('Frontend');
		$request 			= pzk_request();
    	
    	$data_answers 		= $request->getanswers();
		
		$parentTest = $data_answers['parentTest'];
		
    	$question_id 	= $data_answers['questions'];
		
    	$testId = $data_answers['testId'];
    
    	$answers 		= array();
    	
    	if(isset($data_answers['answers'])){
    		
    		$answers 		= $data_answers['answers'];
    	}
    	
    	$quantity_question	= count($data_answers['questions']);
    	
    	$userBook	= _db()->getEntity('Userbook.Userbook');
    	
    	$userAnswer	= _db()->getEntity('Userbook.Useranswer');
    	
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
    			'quantity_question'	=> $quantity_question,
    			'startTime'			=> $start_time,
    			'stopTime'			=> $stop_time,
                'mark'              => $totaltrue,
    			'testId'			=> $testId,
				'trytest'			=> TN,
				'compability' 		=> 1,
				'school'			=> pzk_session('school'),
				'class'				=> pzk_session('class'),
				'classname'			=> pzk_session('classname'),
				'parentTest'		=> $parentTest,
				'created'			=> date('Y-m-d H:i:s'),
				'software'		=> pzk_request()->getSoftwareId(),
				'lang'			=> pzk_session('language'),
    			'duringTime'		=> $duringTime
    	);
 	
		$userBook->setData($row);
		$userBook->save();
		
		$userbookId=$userBook->getId();
		
		foreach($question_id as $key => $value){
			if(empty($answers[$key])){
				$answers[$key] = '';
			}
			$questionId		=	$question_id[$key];
			$rowAnswers[] = array(
				'user_book_id'	=>	$userbookId,
				'questionId'	=>	$questionId,
				'question_type' => 'Q0',
				'answerId'		=>	$answers[$key]
			);
			
		}
		$frontendmodel->insertManyDatas('user_answers', array('user_book_id', 'questionId', 'answerId'), $rowAnswers);	
		echo 1;
    		
    	
    }
	
    public function saveTlAction() {
		if(!pzk_session('userId')){
			pzk_system()->halt();
		}
		$request 			= pzk_request();
    	
    	$data_answers 		= $request->getanswers();
		
		
		$answers 		= array();
    	
    	if(isset($data_answers['answers'])){
    		
    		$answers 		= $data_answers['answers'];
    	}
		
		
    	$user_book_key	= $request->getKeybook();
		
		$parentTest = $data_answers['parentTest'];
    	
		$question_id 	= $data_answers['questions'];
		
    	$testId = $data_answers['testId'];
		
    	$quantity_question	= count($data_answers['questions']);
    	
    	$userBook	= _db()->getEntity('Userbook.Userbook');
    	
    	$userAnswer	= _db()->getEntity('Userbook.Useranswer');
    	
    	$userId	=	pzk_session('userId');
    	
    	if(isset($data_answers['start_time'])) {
    		
            $start_time	= date('Y:m:d H:i:s', $data_answers['start_time']);
        }else{
        	
            $start_time = '';
        }
    		
        $stop_time 	= date('Y:m:d H:i:s', $_SERVER['REQUEST_TIME']);

        if(isset($data_answers['during_timetl'])) {
            $duringTime = $data_answers['during_timetl'];
        }else {
            $duringTime = 0;
        }

       
    	$row	= 	array(
    			'userId'			=> $userId,
    			'quantity_question'	=> $quantity_question,
    			'startTime'			=> $start_time,
    			'stopTime'			=> $stop_time,
    			'compability' 		=> 1,
    			'testId'			=> $testId,
				'trytest'			=> TL,
				'school'			=> pzk_session('school'),
				'class'				=> pzk_session('class'),
				'classname'			=> pzk_session('classname'),
				'created'			=> date('Y-m-d H:i:s'),
				'lang'			=> pzk_session('language'),
				'parentTest'				=> $parentTest,
				'software'		=> pzk_request()->getSoftwareId(),
    			'duringTime'		=> $duringTime
    	);
    	
    	
    			
		$userBook->setData($row);
		
		$userBook->save();

		$userbookId = $userBook->getId();
		
		
		foreach($question_id as $key => $value){
			if(empty($answers[$key])){
				$answers[$key] = '';
			}
			$questionId		=	$question_id[$key];
			//xu li input textarea
			$arAnswer = array();
			if(isset($answers[$key.'_i'])){
				$arAnswer['i'] = $answers[$key.'_i'];
			}
			if(isset($answers[$key.'_t'])){
				$arAnswer['t'] = $answers[$key.'_t'];
			}
			$rowAnswer=array(
				'user_book_id'=>$userbookId,
				'questionId'=>$questionId,
				'content'=>serialize($arAnswer),
				'question_type' => 'TL'
			);
			$userAnswer->setData($rowAnswer);
			$userAnswer->save();
		}

    	echo 1;
	}
	
	public function rankAction() {
		$parentId = pzk_request()->getSegment(4);
		$this->initPage();
		$this->append('education/test/compabilityrating');
		$compabilityRating = pzk_element('compabilityRating');
		$compabilityRating->setJoins(array(
			array('table' => 'user', 'condition' => 'user_contest.userId=user.id')
		));
		$compabilityRating->setFields('user_contest.*, user.username, user.name');
		$compabilityRating->setParentId($parentId);
		$compabilityRating->setPageNum(pzk_request('page'));
		$this->display();
	}
	
	public function resultAction($class, $testId) {
		$testTnId 	= null;
		$testTlId 	= null;
		$testTn = _db()->select('id')->fromTests()->whereParent($testId)->whereTrytest(1)->result_one();
		$testTl   = _db()->select('id')->fromTests()->whereParent($testId)->whereTrytest(2)->result_one();
		
		if($testTn) {
			$testTnId = $testTn['id'];
		}
		if($testTl) {
			$testTlId = $testTl['id'];
		}
		
		$userId 	= pzk_session('userId');
		if(!$userId) {
			return 0;
		}
		$userbookTn = _db()->select('*')->fromUser_book()->whereUserId($userId)->whereTestId($testTnId)->result_one();
		$userbookTl = _db()->select('*')->fromUser_book()->whereUserId($userId)->whereTestId($testTlId)->result_one();
		$this->initPage();
		
		$this ->append('education/practice/book');
		$book = pzk_element('book');
		if($book) {
			$book->setItemId($userbookTn['id']);
		}
						
		if($userbookTl['status'] == 1) {
			//da cham xong
			
			$this->append('education/test/resultTestTl', 'wrapper');
			
			$userBookModel 	= pzk_model('Userbook');
			
			$resultTestTl = pzk_element('resultTestTl');
			
			//du lieu cho bai tu luan
			$dataUserAnswers 	= $userBookModel->getUserAnswers($userbookTl['id']);
			
			$resultTestTl->setDataUserAnswers($dataUserAnswers);
			
			//diem bai thi tu luan 
			$scoreTl = $userbookTl['teacherMark'];
			$resultTestTl->setScoreTl($scoreTl);
				
		} else {
			
			$this->append('education/test/resultTestTl', 'wrapper');
			
			$userBookModel 	= pzk_model('Userbook');
			
			$resultTestTl = pzk_element('resultTestTl');
			
			//du lieu cho bai tu luan
			$dataUserAnswers 	= $userBookModel->getUserAnswers($userbookTl['id']);
			
			$resultTestTl->setDataUserAnswers($dataUserAnswers);
			
			//diem bai thi tu luan 
			$scoreTl = $userbookTl['teacherMark'];
			$resultTestTl->setScoreTl($scoreTl);
		}
		
		$this->display();
	}
	
	public function dsthiAction() {
		$this->renderLayout('education/contest/dsthi');
	}
}
?>