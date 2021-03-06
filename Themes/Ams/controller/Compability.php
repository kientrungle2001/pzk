<?php
define('TN', 1);
define('TL', 2);

class PzkCompabilityController extends PzkController{
	public $masterPage	=	"index";
	public $masterPosition = 'wrapper';
	
	public function extraTestAction(){
		if(pzk_session('userId')){
			$parentId = intval(pzk_request()->getSegment(3));
			$check 		= pzk_user()->checkCompabilityTestAccess($parentId);
			//thanh toan
			if($check){
	
					$frontend = pzk_model('Frontend');
					
					$userId = pzk_session('userId');
					
					$dataParentTest = $frontend->getOne($parentId, 'tests');
					
					
					//chua den ngay thi
					if(time() < strtotime($dataParentTest['startDate'])){
						$this->showMessageAndHalt('Chưa đến ngày thi! Thời gian thi '.date('H:s d/m/Y', strtotime($dataParentTest['startDate'])));
					}
				
					//da het thoi gian thi
					if(time() > strtotime($dataParentTest['endDate'])){
						$this->showMessageAndHalt('Đã hết thời gian thi!');
					}
					//check extra test 1
					$test1 = $frontend->getExtraTest($parentId, 1);
					$checkExtraTest1 = $frontend->checkExtraTest($userId, $parentId, 1, $test1);
					//check lam de 1
					if($checkExtraTest1 == false) {
					
						$testTn = $frontend->getChildCompability(TN, $parentId);

						$this->initPage();
							pzk_page()->setTitle('Đề khảo sát tìm kiếm học bổng');
							pzk_page()->setKeywords('Đề khảo sát tìm kiếm học bổng');
							pzk_page()->setDescription('Đề khảo sát tìm kiếm học bổng');
							pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
							pzk_page()->setBrief('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
							if($test1) {
								$request 	=	pzk_request();
								$request->setHomework(		$test1['id']);
								$request->setSubject(		52);
								$request->setTopic(			52);
								$this->append('education/practice/mixedTest');
								
								$homework					= 	pzk_element()->getShowTest();
								$homework->setLayout('education/contest/mixedTest');
								$homework->setItemId(		$test1['id']);
								$homework->setParentTestId($parentId);
								$homework->setParentTest($dataParentTest);
								$homework->setOrdering(		1);
							}
						$this->display();
						pzk_system()->halt();
					}else{
						$test2 = $frontend->getExtraTest($parentId, 2);
						$checkExtraTest2 = $frontend->checkExtraTest($userId, $parentId, 2, $test2);
						//check lam de 2
						if($checkExtraTest2 == false) {
							
							$this->initPage();
								pzk_page()->setTitle('Đề khảo sát tìm kiếm học bổng');
								pzk_page()->setKeywords('Đề khảo sát tìm kiếm học bổng');
								pzk_page()->setDescription('Đề khảo sát tìm kiếm học bổng');
								pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
								pzk_page()->setBrief('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
								
							if($test2) {
								$request 	=	pzk_request();
								$request->setHomework(		$test2['id']);
								$request->setSubject(		52);
								$request->setTopic(			52);
								$this->append('education/practice/mixedTest');
								
								$homework					= 	pzk_element()->getShowTest();
								$homework->setLayout('education/contest/mixedTest');
								$homework->setItemId(		$test2['id']);
								$homework->setParentTestId($parentId);
								$homework->setParentTest($dataParentTest);
								$homework->setOrdering(		2);
							}
								
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
								$alert->setTitle('Bạn đã hoàn thành bài thi. Kết quả được công bố '.date('H:s d/m/Y', strtotime($dataParentTest['resultDate'])));
								$this->display();
							pzk_system()->halt();
						} 
					}
				}else{
						//cam mua tai khoan
						$this->initPage();
						$this->append('education/test/nouser', 'wrapper');
						$this->display();
						pzk_system()->halt();
					
			 }
		}else{
			//chua dang nhap
			$parentId = intval(pzk_request()->getSegment(3));
			$this->initPage();
				pzk_page()->setTitle('Đăng nhập');
				pzk_page()->setKeywords('Đăng nhập');
				pzk_page()->setDescription('Đăng nhập với phần mềm Full Look');
				pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
				pzk_page()->setBrief('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
				$this->append('user/login', 'wrapper');
				$login = pzk_element()->getLogin();
				$login->setRel("/Compability/test/".$parentId);
				$login->setTitle('thì mới được vào thi');
			$this->display();			
			pzk_system()->halt();
		}		
	}
	
	public function testAction(){
		if(pzk_session('userId')){
			$parentId = intval(pzk_request()->getSegment(3));
			$check 		= pzk_user()->checkCompabilityTestAccess($parentId);
			//thanh toan
			if($check){
	
					$frontend = pzk_model('Frontend');
					
					$userId = pzk_session('userId');
					
					$dataParentTest = $frontend->getOne($parentId, 'tests');
					
					
					//chua den ngay thi
					if(time() < strtotime($dataParentTest['startDate'])){
						$this->showMessageAndHalt('Chưa đến ngày thi! Thời gian thi '.date('H:s d/m/Y', strtotime($dataParentTest['startDate'])));
					}
				
					//da het thoi gian thi
					if(time() > strtotime($dataParentTest['endDate'])){
						$this->showMessageAndHalt('Đã hết thời gian thi!');
					}
					
					$checkTestNsTn = $frontend->checkTestNsTn($userId, $parentId);
					//check lam trac nghiem
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
								'time' => $dataParentTest['time'],
								'quantity' => $testTn['quantity'],
								'name' => $testTn['name'],
								'id' => $testTn['id'],
								'parentTest' => $testTn['parent']
								
							);
							
							$compability->setParentId($parentId);
							$compability->setData_criteria($data_criteria);	
						$this->display();
						pzk_system()->halt();
					}else{
						$checkTestNsTl = $frontend->checkTestNsTl($userId, $parentId);
						//check lam tu luan
						if($checkTestNsTl == false) {
								
							$testTl = $frontend->getChildCompability(TL, $parentId);
							
							$this->initPage();
								pzk_page()->setTitle('Đề khảo sát tìm kiếm học bổng');
								pzk_page()->setKeywords('Đề khảo sát tìm kiếm học bổng');
								pzk_page()->setDescription('Đề khảo sát tìm kiếm học bổng');
								pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
								pzk_page()->setBrief('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
								$this->append('education/test/againTestTl', 'wrapper');
										
						
								$compabilityTl = pzk_element('compabilityTl');
								
								$checkTestNsTn = $frontend->checkTestNsTn($userId, $parentId);
								
								$time = $dataParentTest['time'] * 60 - $checkTestNsTn['duringTime'];
								
								$data_criteria = array(
									'time' => $time,
									'quantity' => $testTl['quantity'],
									'name' => $testTl['name'],
									'id' => $testTl['id'],
									'parentTest' => $testTl['parent']
								);
								
								$compabilityTl->setParentId($parentId);
								$compabilityTl->setData_criteria($data_criteria);
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
								$alert->setTitle('Bạn đã hoàn thành bài thi. Kết quả được công bố '.date('H:s d/m/Y', strtotime($dataParentTest['resultDate'])));
								$this->display();
							pzk_system()->halt();
						} 
					}
				}else{
						//cam mua tai khoan
						$this->initPage();
						$this->append('education/test/nouser', 'wrapper');
						$this->display();
						pzk_system()->halt();
					
			 }
		}else{
			//chua dang nhap
			$parentId = intval(pzk_request()->getSegment(3));
			$this->initPage();
				pzk_page()->setTitle('Đăng nhập');
				pzk_page()->setKeywords('Đăng nhập');
				pzk_page()->setDescription('Đăng nhập với phần mềm Full Look');
				pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
				pzk_page()->setBrief('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
				$this->append('user/login', 'wrapper');
				$login = pzk_element()->getLogin();
				$login->setRel("/Compability/test/".$parentId);
				$login->setTitle('thì mới được vào thi');
			$this->display();			
			pzk_system()->halt();
		}		
	}
	public function showtlAction(){
		if(pzk_session('userId')){
			
			$parentId = intval(pzk_request()->getParentId());
			if(!pzk_request()->getParentId()){
				$parentId = intval(pzk_request()->getSegment(3));
			}
			
			
			$frontend = pzk_model('Frontend');
				
			$userId = pzk_session('userId');
			
			$testTl = $frontend->getChildCompability(TL, $parentId);
		
			$compabilityTl=$this->parse('education/test/compabilityTl');
		
			$compabilityTl = pzk_element('compabilityTl');
			
			
			$time = pzk_request()->getTimeTl();
			
			
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
	
	public function showTestTlAction(){
		if(pzk_session('userId')){
			
			$parentId = intval(pzk_request()->getParentId());
			if(!pzk_request()->getParentId()){
				$parentId = intval(pzk_request()->getSegment(3));
			}
			
			
			$frontend = pzk_model('Frontend');
				
			$userId = pzk_session('userId');
			
			$testTl = $frontend->getChildCompability(TL, $parentId);
			
			$this->initPage();
				pzk_page()->setTitle('Đề khảo sát tìm kiếm học bổng');
				pzk_page()->setKeywords('Đề khảo sát tìm kiếm học bổng');
				pzk_page()->setDescription('Đề khảo sát tìm kiếm học bổng');
				pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
				pzk_page()->setBrief('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
				$this->append('education/test/compabilityTl', 'wrapper');
						
		
				$compabilityTl = pzk_element('compabilityTl');
			
				$time = pzk_request()->getTimeTl();
				
				$data_criteria = array(
					'time' => $time,
					'quantity' => $testTl['quantity'],
					'name' => $testTl['name'],
					'id' => $testTl['id'],
					'parentTest' => $testTl['parent']
				);
				
				$compabilityTl->setParentId($parentId);
				$compabilityTl->setData_criteria($data_criteria);
			$this->display();
			pzk_system()->halt();
			
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
		
		$test =	_db()->selectAll()->from('tests')->whereId($parentTest)->result_one();
    
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
		
		$totalTn = $totaltrue*$test['score'];
		
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
				'totalTn'			=> $totalTn,
    			'testId'			=> $testId,
				'trytest'			=> TN,
				'compability' 		=> 1,
				'parentTest'		=> $parentTest,
				'created'			=> date('Y-m-d H:i:s'),
				'software'		=> pzk_request()->getSoftwareId(),
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
		$frontendmodel = pzk_model('Frontend');
    	
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
				'created'			=> date('Y-m-d H:i:s'),
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
	
	public function extraTestRankAction(){
		$parentId = intval(pzk_request()->getSegment(3));
		$this->initPage();
		$this->append('education/test/rankExtra');
		$compabilityRating = pzk_element('rankExtra');
		$compabilityRating->setJoins(array(
			array('table' => 'user', 'condition' => 'user_contest.userId=user.id')
		));
		$compabilityRating->setFields('user_contest.*, user.username, user.name');
		$compabilityRating->setParentId($parentId);
		$compabilityRating->setPageNum(pzk_request()->getPage());
		$this->display();
	}
	public function rankAction() {
		$parentId = intval(pzk_request()->getSegment(3));
		$this->initPage();
		$this->append('education/test/compabilityrating');
		$compabilityRating = pzk_element('compabilityRating');
		$compabilityRating->setJoins(array(
			array('table' => 'user', 'condition' => 'user_contest.userId=user.id')
		));
		$compabilityRating->setFields('user_contest.*, user.username, user.name');
		$compabilityRating->setParentId($parentId);
		$compabilityRating->setPageNum(pzk_request()->getPage());
		$this->display();
	}
	
	public function resultAction($testId) {
		$userId 	= pzk_session('userId');
		if(!$userId) {
			return 0;
		}
		$testTnId 	= null;
		$testTlId 	= null;
		$frontend = pzk_model('Frontend');
		$dataParentTest = $frontend->getOne($testId, 'tests');
		//chua den ngay thi
		if(strtotime($dataParentTest['resultDate']) > time()){
			$this->showMessageAndHalt('Chưa đến thời gian xem kết quả!');
		}
		
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
		
		//lay phan trac nghiem 
		$this ->append('education/practice/book');
		$book = pzk_element('book');
		if($book) {
			$book->setItemId($userbookTn['id']);
			$book->setTeacherMark($userbookTl['teacherMark']);
		}
		//show phan tu luan				
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
	
	public function extraTestResultAction($testId) {
		$userId 	= pzk_session('userId');
		if(!$userId) {
			$this->showMessageAndHalt('Bạn chưa đăng nhập');
		}
		$test1Id 	= null;
		$test2Id 	= null;
		$frontend = pzk_model('Frontend');
		$dataParentTest = $frontend->getOne($testId, 'tests');
		//chua den ngay thi
		if(strtotime($dataParentTest['resultDate']) > time()){
			$this->showMessageAndHalt('Chưa đến thời gian xem kết quả!');
		}
		
		$test1 = _db()->select('*')->fromTests()->whereParent($testId)->whereOrdering(1)->result_one();
		$test2   = _db()->select('*')->fromTests()->whereParent($testId)->whereOrdering(2)->result_one();
		
		if($test1) {
			$test1Id = $test1['id'];
		}
		if($test2) {
			$test2Id = $test2['id'];
		}
		
		$userId 	= pzk_session('userId');
		if(!$userId) {
			return 0;
		}
		
		$userbook1 = _db()->select('*')->fromUser_book()->whereUserId($userId)->whereTestId($test1Id)->result_one('Education.Userbook');
		
		$userbook2 = _db()->select('*')->fromUser_book()->whereUserId($userId)->whereTestId($test2Id)->result_one('Education.Userbook');
		
		$this->initPage();
		$testResult = $this->parse('education/contest/user/mixedTestResult');
		
		$testResult->setTest($dataParentTest);
		
		$test1Obj = pzk_element('test1');
		$test2Obj = pzk_element('test2');
		
		$test1Obj->setTestId($test1Id);
		$test1Obj->setTest($test1);
		$test1Obj->setBook($userbook1);
		
		$test2Obj->setTestId($test2Id);
		$test2Obj->setTest($test2);
		$test2Obj->setBook($userbook2);
		
		$this->append($testResult);
		$this->display();
	}
	
	public function dsthiAction() {
		//goi luon layout
		$this->renderLayout('education/contest/dsthi');
	}
	
	public function showMessageAndHalt($message = null) {
		$this->initPage();
		$this->append('trytest/alert', 'wrapper');
			$alert = pzk_element()->getAlert();
			$alert->setTitle($message);
			$this->display();
		pzk_system()->halt();
	}

	public function mixedTestAction($testId, $subject, $topic) {
		// làm đề thi
		$test = _db()->selectAll()->fromTests()->whereId($testId)->result_one();
		if(pzk_session('userId')){ # đã đăng nhập
			$check 		= pzk_user()->checkCompabilityTestAccess($testId);
			if($check || ($test && $test['trial'])) { # đã thanh toán
				# trường hợp chưa đến thời gian thi
				# trường hợp đã hết thời gian thi
				# trường hợp đc vào thi
				
				if($test) {
					$request 	=	pzk_request();
					$request->setHomework(		$testId);
					$request->setSubject(		$subject);
					$request->setTopic(			$topic);
					//chua den ngay thi
					if(time() < strtotime($test['startDate'])){
						$this->showMessageAndHalt('Chưa đến ngày thi! Thời gian thi '.date('H:s d/m/Y', strtotime($test['startDate'])));
					}
				
					//da het thoi gian thi
					if(time() > strtotime($test['endDate'])){
						$this->showMessageAndHalt('Đã hết thời gian thi!');
					}
					$this->initPage();
					$this->append('education/practice/mixedTest');
					
					$homework					= 	pzk_element()->getShowTest();
					
					$homework->setItemId(		$testId);
					$this->display();
				}
			} else { # chưa thanh toán
				# can mua tai khoan
				$this->initPage();
				$this->append('education/test/nouser');
				$this->display();
				pzk_system()->halt();
			}
			
		} else { # chưa đăng nhập
			$this->initPage();
				pzk_page()->setTitle('Đăng nhập');
				pzk_page()->setKeywords('Đăng nhập');
				pzk_page()->setDescription('Đăng nhập với phần mềm Full Look');
				pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
				pzk_page()->setBrief('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
				$this->append('user/login');
				$login = pzk_element()->getLogin();
				$login->setRel("/Compability/mixedTest/".$testId);
				$login->setTitle('thì mới được vào thi');
			$this->display();			
			pzk_system()->halt();
		}
	}
	
	public function saveMixedTestAction() {
		$request 			= 	pzk_request();
		$session 			=	pzk_session();
		
		$userId 			=	$session->getUserId();
		
		$subject 			=	intval($request->getSubject());
		$topic				=	intval($request->getTopic());
		$testId				=	intval($request->getHomework());
		$userData 			= 	$request->getUserData();
		$questionIds 		= 	$userData['questionIds'];
		$questionTypes 		= 	$userData['questionTypes'];
		$answers			=	isset($userData['answers'])?$userData['answers']: array();
		$bookId 			=	isset($userData['bookId'])?$userData['bookId']:0;
		$totalMark			=	0;
		$totalTn			=	0;
		$autoMark			=	0;
		$total 				=	0;
		$startTime 			=	$userData['start_time'];
		$duringTime			=	$userData['during_time'];
		$stopTime			=	$startTime + $duringTime;
		$user_answers		=	array();
		$test				=	_db()->selectAll()->from('tests')->whereId($testId)->result_one();
		
		foreach($questionIds as $questionIndex => $questionId) {
			$question 		=	_db()->getTableEntity('questions')->load($questionId);
			$questionType = $questionTypes[$questionIndex];
			$action = 'mark' . ucfirst($questionType);
			# kiểu bài trắc nghiệm
			if($questionType == 'choice') {
				$mark = $this->$action($question, $answers, $test);
				$totalMark 	+= 	$mark;
				$autoMark 	+=	$mark;
				$totalTn	+=	$mark;
				$total++;
				$user_answer 		=	array(
					'questionId'	=>	$questionId,
					'answerId'		=>	isset($answers[$questionId])?$answers[$questionId]: 0,
					'user_book_id'	=>	$bookId,
					'question_type'	=>	'Q0',
					'mark'			=>	$mark,
					'isMark'		=>	1,
					'testId'		=>	$testId,
					'auto'			=>	1
				);
				$user_answers[]		=	$user_answer;
			} else {
			# kiểu bài tự luận
				
				# bóc tách dữ liệu
				$arAnswer = array();
				if(isset($answers[$questionIndex.'_i'])){
					$arAnswer['i'] = $answers[$questionIndex.'_i'];
				}
				if(isset($answers[$questionIndex.'_t'])){
					$arAnswer['t'] = $answers[$questionIndex.'_t'];
				}
				
				# chấm điểm
				$mark = $this->$action($question, $arAnswer, $test);
				$totalMark += $mark;
				if($question->getauto()) {
					$autoMark += $mark;
				}
				
				# lưu vào user answer
				$user_answer 		=	array(
					'questionId'	=>	$questionId,
					'answerId'		=>	'',
					'content'		=>	serialize($arAnswer),
					'user_book_id'	=>	$bookId,
					'question_type'	=>	'TL',
					'testId'		=>	$testId,
					'auto'			=>	$question->getauto(),
					'isMark'		=> 	$question->getauto() ? 1 : 0,
					'mark'			=>	$mark
				);
				$user_answers[]		=	$user_answer;
			}
		}
		
		# lấy tên lớp học của học sinh và tên lớp học của đề thi giao nhau
		$className 					= 	'';
		
		# lưu vào bảng user_book
		# niên khóa
		$schoolYear					= 	date('Y');
		if(date('m') < 7) $schoolYear = date('Y') - 1;
		
		# tạo bản ghi user_book
		$user_book = array(
			'id'					=> 	$bookId,
			'userId'				=> 	$userId,
			'categoryId'			=> 	$subject,
			'topic'					=> 	$topic,
			'quantity_question'		=> 	count($questionIds),
			'startTime'				=> 	date('Y-m-d H:i:s', $startTime),
			'stopTime'				=> 	date('Y-m-d H:i:s', $stopTime),
			'duringTime'			=> 	$duringTime,
			'testId'				=> 	$testId,
			'keybook'				=> 	uniqid(),
			'software'				=> 	$request->getSoftwareId(),
			'created'				=> 	date('Y-m-d H:i:s'),
			'mustMark'				=> 	1,
			'homework'				=> 	1,
			'week'					=> 	isset($test['week'])?$test['week']:0,
			'month'					=> 	isset($test['month'])?$test['month']:0,
			'semester'				=> 	isset($test['semester'])?$test['semester']:0,
			'class'					=> 	pzk_session('lop'),
			'classname'				=>	$className,
			'schoolYear'			=>	$schoolYear,
			'homeworkStatus'		=>	1,
			'autoMark'				=>	$autoMark,
			'totalMark'				=>	$totalMark,
			'totalTn'				=> 	$totalTn,
			'testMark'				=>  isset($test['testMark'])? $test['testMark']: 0
		);
		
		# lưu
		$userBookEntity =	_db()->getTableEntity('user_book');
		$userBookEntity->setData($user_book);
		$userBookEntity->save();
		
		# Lưu các đáp án
		foreach($user_answers as $user_answer) {
			$user_answer['user_book_id']	=	$userBookEntity->getId();
			$userAnswerEntity 	= 	_db()->getTableEntity('user_answers');
			/*
			# kiểm tra đáp án đã có chưa
			
			$userAnswerExisted 	= 	_db()->select('id')->from('user_answers')
				->whereUser_book_id($bookId)
				->whereQuestionId($user_answer['questionId'])
				->result_one();
				
			# đáp án đã tồn tại
			if($userAnswerExisted) {
				$user_answer['id'] = $userAnswerExisted['id'];
			}
			*/
			
			# lưu
			$userAnswerEntity->setData($user_answer);
			$userAnswerEntity->save();
		}
	}
	
	public function saveContestMixedTestAction() {
		$request 			= 	pzk_request();
		$session 			=	pzk_session();
		
		$userId 			=	$session->getUserId();
		
		$subject 			=	intval($request->getSubject());
		$topic				=	intval($request->getTopic());
		$testId				=	intval($request->getHomework());
		
		$userData 			= 	$request->getUserData();
		$parentTestId		=	intval($userData['parentTestId']);
		$questionIds 		= 	$userData['questionIds'];
		$questionTypes 		= 	$userData['questionTypes'];
		$answers			=	isset($userData['answers'])?$userData['answers']: array();
		$bookId 			=	isset($userData['bookId'])?$userData['bookId']:0;
		$totalMark			=	0;
		$totalTn			=	0;
		$autoMark			=	0;
		$total 				=	0;
		$startTime 			=	$userData['start_time'];
		$duringTime			=	$userData['during_time'];
		$stopTime			=	$startTime + $duringTime;
		$user_answers		=	array();
		$test				=	_db()->selectAll()->from('tests')->whereId($testId)->result_one();
		
		foreach($questionIds as $questionIndex => $questionId) {
			$question 		=	_db()->getTableEntity('questions')->load($questionId);
			$questionType = $questionTypes[$questionIndex];
			$action = 'mark' . ucfirst($questionType);
			# kiểu bài trắc nghiệm
			if($questionType == 'choice') {
				$mark = $this->$action($question, $answers, $test);
				$totalMark 	+= 	$mark;
				$autoMark 	+=	$mark;
				$totalTn	+=	$mark;
				$total++;
				$user_answer 		=	array(
					'questionId'	=>	$questionId,
					'answerId'		=>	isset($answers[$questionId])?$answers[$questionId]: 0,
					'user_book_id'	=>	$bookId,
					'question_type'	=>	'Q0',
					'mark'			=>	$mark,
					'isMark'		=>	1,
					'testId'		=>	$testId,
					'auto'			=>	1
				);
				$user_answers[]		=	$user_answer;
			} else {
			# kiểu bài tự luận
				
				# bóc tách dữ liệu
				$arAnswer = array();
				if(isset($answers[$questionIndex.'_i'])){
					$arAnswer['i'] = $answers[$questionIndex.'_i'];
				}
				if(isset($answers[$questionIndex.'_t'])){
					$arAnswer['t'] = $answers[$questionIndex.'_t'];
				}
				
				# chấm điểm
				$mark = $this->$action($question, $arAnswer, $test);
				$totalMark += $mark;
				if($question->getauto()) {
					$autoMark += $mark;
				}
				
				# lưu vào user answer
				$user_answer 		=	array(
					'questionId'	=>	$questionId,
					'answerId'		=>	'',
					'content'		=>	serialize($arAnswer),
					'user_book_id'	=>	$bookId,
					'question_type'	=>	'TL',
					'testId'		=>	$testId,
					'auto'			=>	$question->getauto(),
					'isMark'		=> 	$question->getauto() ? 1 : 0,
					'mark'			=>	$mark
				);
				$user_answers[]		=	$user_answer;
			}
		}
		
		# lấy tên lớp học của học sinh và tên lớp học của đề thi giao nhau
		$className 					= 	'';
		
		# lưu vào bảng user_book
		# niên khóa
		$schoolYear					= 	date('Y');
		if(date('m') < 7) $schoolYear = date('Y') - 1;
		
		# tạo bản ghi user_book
		$user_book = array(
			'id'					=> 	$bookId,
			'userId'				=> 	$userId,
			'categoryId'			=> 	$subject,
			'topic'					=> 	$topic,
			'quantity_question'		=> 	count($questionIds),
			'startTime'				=> 	date('Y-m-d H:i:s', $startTime),
			'stopTime'				=> 	date('Y-m-d H:i:s', $stopTime),
			'duringTime'			=> 	$duringTime,
			'testId'				=> 	$testId,
			'keybook'				=> 	uniqid(),
			'software'				=> 	$request->getSoftwareId(),
			'created'				=> 	date('Y-m-d H:i:s'),
			'mustMark'				=> 	1,
			'homework'				=> 	1,
			'week'					=> 	isset($test['week'])?$test['week']:0,
			'month'					=> 	isset($test['month'])?$test['month']:0,
			'semester'				=> 	isset($test['semester'])?$test['semester']:0,
			'class'					=> 	pzk_session('lop'),
			'classname'				=>	$className,
			'schoolYear'			=>	$schoolYear,
			'homeworkStatus'		=>	1,
			'autoMark'				=>	$autoMark,
			'totalMark'				=>	$totalMark,
			'totalTn'				=> 	$totalTn,
			'testMark'				=>  isset($test['testMark'])? $test['testMark']: 0,
			'compability'			=> 	1,
			'extraCompability'		=>	1,
			'parentTest'			=>	$parentTestId,
			'camp'					=> 	$test['ordering'],
		);
		
		# lưu
		$userBookEntity =	_db()->getTableEntity('user_book');
		$userBookEntity->setData($user_book);
		$userBookEntity->save();
		
		# Lưu các đáp án
		foreach($user_answers as $user_answer) {
			$user_answer['user_book_id']	=	$userBookEntity->getId();
			$userAnswerEntity 	= 	_db()->getTableEntity('user_answers');
			/*
			# kiểm tra đáp án đã có chưa
			
			$userAnswerExisted 	= 	_db()->select('id')->from('user_answers')
				->whereUser_book_id($bookId)
				->whereQuestionId($user_answer['questionId'])
				->result_one();
				
			# đáp án đã tồn tại
			if($userAnswerExisted) {
				$user_answer['id'] = $userAnswerExisted['id'];
			}
			*/
			
			# lưu
			$userAnswerEntity->setData($user_answer);
			$userAnswerEntity->save();
		}
	}
	
	public function markChoice($question, $answers, $test) {
		if(!isset($answers[$question->getId()])) return 0;
		$right = _db()->select('id')->from('answers_question_tn')
			->whereQuestion_id($question->getId())
			->whereId($answers[$question->getId()])
			->whereStatus(1)
			->result_one();
		if($right) {
			return $test['score']?$test['score'] : 1;
		}
		return 0;
	}
	
	public function markTuluan($question, $answer, $test) {
		if($question->getauto()) {
			$teacher_answers = json_decode($question->getTeacher_answers(), true);
			$total = 0;
			foreach($answer as $type => $ans) {
				foreach($ans as $index => $value)  {
					if(isset($teacher_answers[$type][$index])) {
						$t_answers = explode('|', $teacher_answers[$type][$index]);
						foreach($t_answers as $t_answer) {
							if(strtolower(trim($t_answer)) == strtolower(trim($value))) {
								$total+= $teacher_answers[$type.'_m'][$index];
							}
						}
					}
				}
			}
			return $total;
		}
		return 0;
	}
	
	public function showMixedTestResultAction($testId, $subject, $topic) {
		// làm đề thi
		$test = _db()->selectAll()->fromTests()->whereId($testId)->result_one();
		if(pzk_session('userId')){ # đã đăng nhập
			$check 		= pzk_user()->checkCompabilityTestAccess($testId);
			if($check || ($test && $test['trial'])) { # đã thanh toán
				# trường hợp chưa đến thời gian thi
				# trường hợp đã hết thời gian thi
				# trường hợp đc vào thi
				
				if($test) {
					$request 	=	pzk_request();
					$request->setHomework(		$testId);
					$request->setSubject(		$subject);
					$request->setTopic(			$topic);
					//chua den ngay thi
					if(time() < strtotime($test['resultDate'])){
						$this->showMessageAndHalt('Chưa đến ngày công bố kết quả! Ngày công bố: '.date('H:s d/m/Y', strtotime($test['resultDate'])));
					}
					$testEntity = _db()->getEntity('Education.Test')->load($testId);
					$education 	=	$this->model('Education');
					$book		=	_db()->selectAll()->fromUser_book()->whereUserId(pzk_session('userId'))->whereTestId($testId)->result_one();
					
					if(!$book || !$book['id']) {
						$this->showMessageAndHalt('Bạn chưa hoàn thành bài thi');
					}
					
					$bookEntity = _db()->getEntity('Education.Userbook')->load($book['id']);
					$bookEntity->mark();
					
					$this->initPage();
					$this->append('education/practice/showMixedTestResult');
					
					$homework					= 	pzk_element()->getShowTest();
					
					$homework->setItemId(		$testId);
					$homework->setBookId($book['id']);
					$homework->setBook($book);
					$this->display();
				}
			} else { # chưa thanh toán
				# can mua tai khoan
				$this->initPage();
				$this->append('education/test/nouser');
				$this->display();
				pzk_system()->halt();
			}
			
		} else { # chưa đăng nhập
			$this->initPage();
				pzk_page()->setTitle('Đăng nhập');
				pzk_page()->setKeywords('Đăng nhập');
				pzk_page()->setDescription('Đăng nhập với phần mềm Full Look');
				pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
				pzk_page()->setBrief('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
				$this->append('user/login');
				$login = pzk_element()->getLogin();
				$login->setRel("/Compability/mixedTest/".$testId);
				$login->setTitle('thì mới được vào xem kết quả');
			$this->display();
			pzk_system()->halt();
		}
	}
	
	
	public function showMixedTestResultDialogAction() {
		$answers 		= 	pzk_request()->getAnswers();
		
		$questionIds 	= 	$answers['questionIds'];
		$questionTypes 	= 	$answers['questionTypes'];
		$user_answers 	=	$answers['answers'];
		$startTime		=	$answers['start_time'];
		$duringTime		=	$answers['during_time'];
		$questionTime	=	$answers['question_time'];
		$testId			=	$answers['testId'];
		$bookId			=	$answers['bookId'];
		$user_book		=	_db()->selectAll()->fromUser_book()->whereId($bookId)->result_one();
		
		$num_auto 		=	_db()->select('count(*) as c')
					->fromQuestions()
					->where('status=1 and deleted=0 and (questionType=1 or (questionType=4 and auto=1))')
					->inId($questionIds)
					->result_one();
		$num_auto 		= 	$num_auto['c'];
		
		$questionsAuto	=	_db()->select('id')
					->fromQuestions()
					->where('status=1 and deleted=0 and (questionType=1 or (questionType=4 and auto=1))')
					->inId($questionIds)
					->result();
		
		$questionAutoIds	=	array_map(function($question) {
			return $question['id'];
		}, $questionsAuto);
		$questionTeacherIds = array_diff($questionIds, $questionAutoIds);
		
		$num_total		=	count($questionIds);
		$num_teacher	=	$num_total	-	$num_auto;
		$book_true 		=	_db()->select('count(*) as c, sum(mark) as s')
					->fromUser_answers()
					->where('isMark=1 and mark!=0')
					->whereUser_book_id($bookId)
					->inQuestionId($questionAutoIds)
					->result_one();
		$num_true		=	$book_true['c'];
		$mark_auto		=	$book_true['s'];
		$num_false		=	$num_auto	-	$num_true;
		
		$teacher_true 		=	_db()->select('count(*) as c, sum(mark) as s')
					->fromUser_answers()
					->where('isMark=1')
					->whereUser_book_id($bookId)
					->inQuestionId($questionTeacherIds)
					->result_one();
		
		$mark_teacher		=	is_null($teacher_true['s']) ? 0 : $teacher_true['s'];
		
		echo json_encode( array(
			'num_total'				=>	intval($num_total),
			'num_auto'				=>	intval($num_auto),
			'num_true'				=>	intval($num_true),
			'num_false'				=>	intval($num_false),
			'num_teacher'			=>	intval($num_teacher),
			'mark_auto'				=>	floatval($mark_auto),
			'mark_teacher'			=>	floatval($mark_teacher),
			'mark_teacher_status'	=>	intval($user_book['status']),
			'otherIds'				=>	$questionTeacherIds
		));
	}
	
	public function showMixedTestAnswersChoiceAction() {
		$request 			= pzk_request();
    
    	$data_answers 		= $request->getanswers();
    	 
    	$questionIds 		= $data_answers['questionIds'];
    	
    	$questionTypes		= $data_answers['questionTypes'];
		    	
		$choiceQuestionIds 	= array();
		foreach($questionTypes as $questionId => $questionType) {
			if($questionType == 'choice') {
				$choiceQuestionIds[] = $questionId;
			}
		}
		
    	$result_answer = array();
		
		//xu ly phan show giai thich
		$education			=	$this->model('Education');
		$choiceAnswers 		= 	$education->getChoiceAnswers($choiceQuestionIds);
		
		
    	foreach($choiceAnswers as $answer){
            
    		$result_answer[] = array(
    				'superType' 	=> $questionTypes[$answer['question_id']],
    				'questionId' 	=> $answer['question_id'],
    				'value' 		=> $answer['id']
    		);
    	}
		
		#
		$tuluanAutoQuestionIds 	=	array();
		$tuluanQuestionIds		=	array();
		foreach($questionTypes as $questionId => $questionType) {
			if($questionType == 'tuluan') {
				$tuluanQuestionIds[] = $questionId;
			}
		}
    	if($tuluanQuestionIds) {
			$tuluanAutoQuestions 	=	_db()->select('id,teacher_answers')->fromQuestions()->inId($tuluanQuestionIds)->whereAuto(1)->result();
		} else {
			$tuluanAutoQuestions 	=	array();
		}
		$tuluanAutoQuestionIds	=	array_map(function($question) {
			return $question['id'];
		}, $tuluanAutoQuestions);
		foreach($tuluanAutoQuestions as $question) {
			$teacher_answers	=	json_decode($question['teacher_answers'], true);
			$result_answer[] = array(
    				'superType' 	=> $questionTypes[$question['id']],
    				'questionId' 	=> $question['id'],
    				'value' 		=> $teacher_answers,
					'auto'			=>	1
    		);
		}
    	echo json_encode($result_answer);
	}
}
?>