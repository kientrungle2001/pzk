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
			
			if($sSchool == NS){
				$sClass = pzk_session('class');
				
				//$class = pzk_request()->getSegment(3);
				
				//if($sClass == $class){
					$frontend = pzk_model('Frontend');
					
					$parentId = intval(pzk_request()->getSegment(4));
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
				$parentId = intval(pzk_request()->getSegment(4));
				$class = intval(pzk_request()->getSegment(3));
			
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
			
			$parentId 		= 	intval(pzk_request()->getParentId());
			
			$frontend 		= 	pzk_model('Frontend');
				
			$userId 		= 	pzk_session('userId');
			
			$testTl 		= 	$frontend->getChildCompability(TL, $parentId);
		
			$compabilityTl	=	$this->parse('education/test/compabilityTl');
		
			$compabilityTl 	= 	pzk_element('compabilityTl');
			
			
			$sSchool 		= 	pzk_session('school');
			$time 			= 	$testTl['time'];
			if($sSchool == NS){
				$time = intval(pzk_request()->getTimeTl());
				$compabilityTl->setNgoisao(1);
			}
			
			$data_criteria = array(
				'time' 			=> $time,
				'quantity' 		=> $testTl['quantity'],
				'name' 			=> $testTl['name'],
				'id' 			=> $testTl['id'],
				'parentTest' 	=> $testTl['parent']
			);
			
			$compabilityTl->setParentId(		$parentId);
			$compabilityTl->setData_criteria(	$data_criteria);
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
		
		$parentTest 		= $data_answers['parentTest'];
		
    	$question_id 		= $data_answers['questions'];
		
    	$testId 			= $data_answers['testId'];
    
    	$answers 			= array();
    	
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
		
		$parentTest 	= $data_answers['parentTest'];
    	
		$questions 	= $data_answers['questions'];
		
    	$testId 		= intval($data_answers['testId']);
		
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
		
		
		foreach($questions as $key => $value){
			if(empty($answers[$key])){
				$answers[$key] = '';
			}
			$questionId		=	$questions[$key];
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