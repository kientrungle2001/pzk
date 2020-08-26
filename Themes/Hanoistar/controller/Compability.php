<?php
define('TN', 1);
define('TL', 2);

class PzkCompabilityController extends PzkController{
	public $masterPage	=	"index";
	public $masterPosition = 'wrapper';
	public function testAction(){
		if(pzk_session('userId')){
				$user = pzk_user();
				$check 			= 	$user->checkPayment('full');
				if($check){
					$parentId = intval(pzk_request()->getSegment(4));
					
					$checkAccess = pzk_user()->checkHomeworkAccess($parentId);
					//check quyen lam de thang
					if(!$checkAccess) {
						$this->showMessageAndHalt('Bạn không được quyền xem phiếu bài tập này');
					}
					
					$sClass = pzk_session('class');
					
					$frontend = pzk_model('Frontend');
					
					$userId = pzk_session('userId');
					
					$checkTestNsTn = $frontend->checkTestNsTn($userId, $parentId);
					$checkMark = $frontend->checkMarkTl($userId, $parentId);
					
					if($checkMark != false || $checkTestNsTn == false) {
					
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
							//cham chua
							$showResult = false;
							if($checkMark){
								$showResult = 1;
							}
							$compability->setShowResult($showResult);
							$compability->setParentId($parentId);
							$compability->setClass($sClass);
							$compability->setData_criteria($data_criteria);	
						$this->display();
						pzk_system()->halt();
					}else{
						$checkTestNsTl = $frontend->checkTestNsTl($userId, $parentId);
						if($checkTestNsTl == false) {
							
							$frontend = pzk_model('Frontend');
								
							$userId = pzk_session('userId');
							$testTn = $frontend->getChildCompability(TN, $parentId);
							$testTl = $frontend->getChildCompability(TL, $parentId);
							
							$this->initPage();
								pzk_page()->setTitle('Đề khảo sát tìm kiếm học bổng');
								pzk_page()->setKeywords('Đề khảo sát tìm kiếm học bổng');
								pzk_page()->setDescription('Đề khảo sát tìm kiếm học bổng');
								pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
								pzk_page()->setBrief('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
								$this->append('education/test/againTestTl', 'wrapper');
										
						
								$compabilityTl = pzk_element('compabilityTl');
								
								
								$sSchool = pzk_session('school');
								$checkTestNsTn = $frontend->checkTestNsTn($userId, $parentId);
								
								$time = $testTn['time'] * 60 - $checkTestNsTn['duringTime'];
								$compabilityTl->setShowResult(false);
								
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
								$alert->setTitle('Đang chờ giáo viên chấm bài! <br> Học sinh làm bài lại khi giáo viên chấm bài xong.');
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
			$camp = intval(pzk_request()->getSegment(3));
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
			
			$parentId = intval(pzk_request()->getParentId());
			if(!pzk_request()->getParentId()){
				$parentId = intval(pzk_request()->getSegment(4));
			}
			
			
			$frontend = pzk_model('Frontend');
				
			$userId = pzk_session('userId');
			
			$testTl = $frontend->getChildCompability(TL, $parentId);
		
			$compabilityTl=$this->parse('education/test/compabilityTl');
		
			$compabilityTl = pzk_element('compabilityTl');
			
			
			$sSchool = pzk_session('school');
			
			$time = intval(pzk_request()->getTimeTl());
			//cham chua
			$checkMark = $frontend->checkMarkTl($userId, $parentId);						
			$showResult = false;
			if($checkMark){
				$showResult = 1;
			}
			
			$compabilityTl->setShowResult($showResult);
			
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
				$parentId = intval(pzk_request()->getSegment(4));
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
				
				
				$sSchool = pzk_session('school');
				
				$time = intval(pzk_request()->getTimeTl());
				$compabilityTl->setShowResult(false);
				
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
		
		$mustMark = 0;
		$checkTestNsTn = $frontendmodel->checkTestNsTn($userId, $parentTest);	
		if($checkTestNsTn == false) {
			$mustMark = 1;
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
		$markOne = $frontendmodel->getOne($testId, 'tests');
		$totalTn = 0;
		if($markOne){
			$totalTn = $totaltrue*$markOne['score'];
		}
		
		//cac lop
		$className 					= 	'';
		$classNames					=	array();
		$classrooms					=	pzk_user()->getClassrooms();
		$testClassrooms				=	_db()->selectAll()->from('education_classroom_homework')
				->whereHomeworkId($parentTest)->result();
		foreach($classrooms as $classroom) {
			foreach($testClassrooms as $testClassroom) {
				if($classroom['classroomId'] == $testClassroom['classroomId']) {
					$classNames[] = $classroom['className'];
				}
			}
		}
		$className					=	','.implode(',', $classNames).',';
		
		//nien khoa
		$schoolYear					= 	date('Y');
		if(date('m') < 7) $schoolYear = date('Y') - 1;
		
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
				'mustMark'			=> $mustMark,
				'class'				=> pzk_session('lop'),
				'parentTest'		=> $parentTest,
				'created'			=> date('Y-m-d H:i:s'),
				'week'					=> $test['week'],
				'month'					=> $test['month'],
				'semester'				=> $test['semester'],
				'classname'			=> $className,
				'schoolYear'			=>	$schoolYear,
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
		
		$test =	_db()->selectAll()->from('tests')->whereId($parentTest)->result_one();
		
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
		
		$mustMark = 0;
		$checkTestNsTl = $frontendmodel->checkTestNsTl($userId, $parentTest);	
		if($checkTestNsTl == false) {
			$mustMark = 1;
		}
		
		//cac lop
		$className 					= 	'';
		$classNames					=	array();
		$classrooms					=	pzk_user()->getClassrooms();
		$testClassrooms				=	_db()->selectAll()->from('education_classroom_homework')
				->whereHomeworkId($parentTest)->result();
		foreach($classrooms as $classroom) {
			foreach($testClassrooms as $testClassroom) {
				if($classroom['classroomId'] == $testClassroom['classroomId']) {
					$classNames[] = $classroom['className'];
				}
			}
		}
		$className					=	','.implode(',', $classNames).',';
		
		//nien khoa
		$schoolYear					= 	date('Y');
		if(date('m') < 7) $schoolYear = date('Y') - 1;
       
    	$row	= 	array(
    			'userId'			=> $userId,
    			'quantity_question'	=> $quantity_question,
    			'startTime'			=> $start_time,
    			'stopTime'			=> $stop_time,
    			'compability' 		=> 1,
    			'testId'			=> $testId,
				'mustMark'			=> $mustMark,
				'trytest'			=> TL,
				'week'					=> $test['week'],
				'month'					=> $test['month'],
				'semester'				=> $test['semester'],
				'classname'			=> $className,
				'schoolYear'			=>	$schoolYear,
				'class'				=> pzk_session('lop'),
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
	
	public function rankAction() {
		$parentId = intval(pzk_request()->getSegment(4));
		$this->initPage();
		$this->append('education/test/compabilityrating');
		$compabilityRating = pzk_element('compabilityRating');
		$compabilityRating->setJoins(array(
			array('table' => 'user', 'condition' => 'user_contest.userId=user.id')
		));
		$compabilityRating->setFields('user_contest.*, user.username, user.name');
		$compabilityRating->setParentId($parentId);
		$compabilityRating->setPageNum(intval(pzk_request()->getPage()));
		$this->display();
	}
	public function showMessageAndHalt($message = null) {
		$this->initPage();
		$this->append('home/login');
		if($message) {
			pzk_element()->getLogin()->setMessage($message);
		}
		$this->display();
		pzk_system()->halt();
	}
}
?>