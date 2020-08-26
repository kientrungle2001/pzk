<?php
define('TN', 1);
define('TL', 2);
//1885
class PzkTrytestController extends PzkController{
	public $masterPage	=	"thitai/index";
	public $masterPosition = 'wrapper';
	public function doAction() {
		$contestId = intval(pzk_request()->getSegment(3));
		
		$this->initPage();
			pzk_page()->setTitle('Bắt đầu thi thử trường Trần Đại Nghĩa');
			pzk_page()->setKeywords('Bắt đầu thi thử trường Trần Đại Nghĩa');
			pzk_page()->setDescription('Bắt đầu thi thử vao trường Trần Đại nghĩa với phần mềm Full Look');
			pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
			pzk_page()->setBrief('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
			$this->append('trytest/do', 'wrapper');
			$do = pzk_element('do');
			
			$do->setContestId($contestId);
		$this->display();
		
		
	}
	public function showtnAction(){
		if(pzk_session('userId')){
			$cuserId = pzk_session('userId');
			$contestId = intval(pzk_request()->getSegment(3));
			$camp = $contestId;
			$check = pzk_user()->checkContest($contestId);
			$frontend = pzk_model('Frontend');
			
			$contest = $frontend->getContestById($contestId);
			
			if(time() < strtotime($contest['startDate']) && !pzk_request()->getShowDebug()){
				//chua toi ngay thi
				$this->initPage();
					pzk_page()->setTitle('Chưa đến ngày thi thử trường Trần Đại Nghĩa');
					pzk_page()->setKeywords('Chưa đến ngày thi thử trường Trần Đại Nghĩa');
					pzk_page()->setDescription('Chưa đến ngày thi thử vao trường Trần Đại nghĩa với phần mềm Full Look');
					pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
					pzk_page()->setBrief('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
					$this->append('trytest/datetest', 'wrapper');
					$finish = pzk_element('datetest');
					$finish->setDateCamp($contest['startDate']);
					$finish->setTitle('Chưa đến ngày thi thử. Ngày thi ');
				$this->display();
				pzk_system()->halt();
			}else if(time() > strtotime($contest['expiredDate']) && !pzk_request()->getShowDebug()){
				//het thoi gian thi
				$this->initPage();
				pzk_page()->setTitle('Hết thời gian thi thử trường Trần Đại Nghĩa');
				pzk_page()->setKeywords('Hết thời gian thi thử trường Trần Đại Nghĩa');
				pzk_page()->setDescription('Hết thời gian thi thử vao trường Trần Đại nghĩa với phần mềm Full Look');
				pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
				pzk_page()->setBrief('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
				$this->append('trytest/do', 'wrapper');
				$do = pzk_element('do');
				$do->setFinish(1);
				$this->display();
				pzk_system()->halt();
			}else{
				//check tra tien
			
				if($check) {
					$userId = pzk_session('userId');
					
					$testTn = $frontend->getTrytest(TN, $camp);
					$testTl = $frontend->getTrytest(TL, $camp);
					$checkTrytestTn = $frontend->checkTrytest($userId, $testTn['id'], $camp);
					$checkTrytestTl = $frontend->checkTrytest($userId, $testTl['id'], $camp);
					
					if($checkTrytestTn == false){
						$this->initPage();
							pzk_page()->setTitle('Thi thử trường Trần Đại Nghĩa');
							pzk_page()->setKeywords('Thi thử trường Trần Đại Nghĩa');
							pzk_page()->setDescription('Thi thử vao trường Trần Đại nghĩa với phần mềm Full Look');
							pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
							pzk_page()->setBrief('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
							$this->append('trytest/showtn', 'wrapper');
						
							$keybook	= uniqid();		    	
							$s_keybook	=	pzk_session('keybook', $keybook);
						
							$showtn = pzk_element('showtn');
							
							$data_criteria = array(
								'time' => $testTn['time'],
								'quantity' => $testTn['quantity'],
								'name' => $testTn['name'],
								'id' => $testTn['id'],
								'camp' => $testTn['camp'],
								'keybook' => $keybook,
							);
							
							$userInfo = $frontend->getOne($userId, 'user');
							$showtn->setUserInfo($userInfo);
							$showtn->setCamp($camp);
							$showtn->setData_criteria($data_criteria);	
						$this->display();
						pzk_system()->halt();
					}else{
						if($checkTrytestTl == false) {
							//thi xong trac nghiem chuyen sang thi tu luan
							$this->redirect('trytest/showtl/' . $camp);
						}else{
							//da thi xong
							$this->initPage();
								pzk_page()->setTitle('Thi thử trường Trần Đại Nghĩa');
								pzk_page()->setKeywords('Thi thử trường Trần Đại Nghĩa');
								pzk_page()->setDescription('Thi thử vao trường Trần Đại nghĩa với phần mềm Full Look');
								pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
								pzk_page()->setBrief('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
								
								$this->append('trytest/alert', 'wrapper');
								$alert = pzk_element()->getAlert();
								$alert->setTitle('Bạn đã hoàn thành bài thi! <br> Mỗi tài khoản chỉ được thi một lần.');
								$this->display();
							pzk_system()->halt();
						}
						
					}
				}else {
					//mua goi thi thu dot 1
					$this->initPage();
						pzk_page()->setTitle('Mua gói thi thử trường Trần Đại Nghĩa');
						pzk_page()->setKeywords('Mua gói thi thử trường Trần Đại Nghĩa');
						pzk_page()->setDescription('Mua gói thi thử vao trường Trần Đại nghĩa với phần mềm Full Look');
						pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
						pzk_page()->setBrief('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
						$this->append('trytest/buy', 'wrapper');
						$login = pzk_element('buy');
						$alert = 'Bạn phải mua gói thi thử '.$contest['name'].' thì mới được thi';
						$login->setTitle($alert);
					$this->display();
					pzk_system()->halt();	
				}
			}

		}else{
			//chua dang nhap
			$camp = intval(pzk_request()->getSegment(3));
			$this->initPage();
				pzk_page()->setTitle('Đăng nhập thi thử trường Trần Đại Nghĩa');
				pzk_page()->setKeywords('Đăng nhập thi thử trường Trần Đại Nghĩa');
				pzk_page()->setDescription('Đăng nhập thi thử vao trường Trần Đại nghĩa với phần mềm Full Look');
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
			$cuserId = pzk_session('userId');
			$contestId = intval(pzk_request()->getSegment(3));
			$camp = $contestId;
			$check = pzk_user()->checkContest($contestId);
			
			$frontend = pzk_model('Frontend');
			$contest = $frontend->getContestById($contestId);
			
			if(time() < strtotime($contest['startDate']) && !pzk_request()->getShowDebug()){
				//chua den ngay thi
				
				$this->initPage();
					pzk_page()->setTitle('Chưa đến ngày thi thử trường Trần Đại Nghĩa');
					pzk_page()->setKeywords('Chưa đến ngày thi thử trường Trần Đại Nghĩa');
					pzk_page()->setDescription('Chưa đến ngày thi thử vao trường Trần Đại nghĩa với phần mềm Full Look');
					pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
					pzk_page()->setBrief('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
					$this->append('trytest/datetest', 'wrapper');
					$finish = pzk_element('datetest');
					$finish->setDateCamp($contest['startDate']);
					$finish->setTitle('Chưa đến ngày thi thử. Ngày thi ');
				$this->display();
				pzk_system()->halt();
						
			}else if(time() > strtotime($contest['expiredDate']) && !pzk_request()->getShowDebug()){
				//het thoi gian thi dot 1
				$this->initPage();
				pzk_page()->setTitle('Hết thời gian thi thử trường Trần Đại Nghĩa');
				pzk_page()->setKeywords('Hết thời gian thi thử trường Trần Đại Nghĩa');
				pzk_page()->setDescription('Hết thời gian thi thử vao trường Trần Đại nghĩa với phần mềm Full Look');
				pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
				pzk_page()->setBrief('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
				$this->append('trytest/do', 'wrapper');
				$do = pzk_element('do');
				$do->setFinish(1);
				$this->display();
				pzk_system()->halt();
			}else{
				
				//check tra tien
				if($check) {
					
					$userId = pzk_session('userId');
					
					$testTn = $frontend->getTrytest(TN, $camp);
					$testTl = $frontend->getTrytest(TL, $camp);
					$checkTrytestTn = $frontend->checkTrytest($userId, $testTn['id'], $camp);
					$checkTrytestTl = $frontend->checkTrytest($userId, $testTl['id'], $camp);
					
					if($checkTrytestTn == false) {
						//chua thi trac nghiem
						$this->redirect('trytest/showtn/' . $camp);		
					}else{
						
						if($checkTrytestTl == false){
							$this->initPage();
								pzk_page()->setTitle('Thi thử trường Trần Đại Nghĩa');
								pzk_page()->setKeywords('Thi thử trường Trần Đại Nghĩa');
								pzk_page()->setDescription('Thi thử vao trường Trần Đại nghĩa với phần mềm Full Look');
								pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
								pzk_page()->setBrief('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
								$this->append('trytest/showtl', 'wrapper');
							
								$showtl = pzk_element('showtl');
								
								
								
								$data_criteria = array(
									'time' => $testTl['time'],
									'quantity' => $testTl['quantity'],
									'name' => $testTl['name'],
									'id' => $testTl['id'],
									'camp' => $testTl['camp']
								);
								$userInfo = $frontend->getOne(pzk_session('userId'), 'user');
								$showtl->setUserInfo($userInfo);
								$showtl->setCamp($camp);
								$showtl->setData_criteria($data_criteria);
							$this->display();
							pzk_system()->halt();
						}else{
							//da thi xong
							$this->initPage();
								pzk_page()->setTitle('Thi thử trường Trần Đại Nghĩa');
								pzk_page()->setKeywords('Thi thử trường Trần Đại Nghĩa');
								pzk_page()->setDescription('Thi thử vao trường Trần Đại nghĩa với phần mềm Full Look');
								pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
								pzk_page()->setBrief('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
								/*$this->append('trytest/finish', 'wrapper');
								$finish = pzk_element('finish');
								$finish->setCamp($camp);
								$finish->setDateFinish(DATEFINISH1);*/
								$this->append('trytest/alert', 'wrapper');
								$alert = pzk_element()->getAlert();
								$alert->setTitle('Bạn đã hoàn thành bài thi! <br> Mỗi tài khoản chỉ được thi một lần.');
								$this->display();
							
							pzk_system()->halt();
						}	
					}
				}else {
					//mua goi thi thu dot 1
					$this->initPage();
						pzk_page()->setTitle('Mua gói thi thử trường Trần Đại Nghĩa');
						pzk_page()->setKeywords('Mua gói thi thử trường Trần Đại Nghĩa');
						pzk_page()->setDescription('Mua gói thi thử vao trường Trần Đại nghĩa với phần mềm Full Look');
						pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
						pzk_page()->setBrief('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
						$this->append('trytest/buy', 'wrapper');
						$login = pzk_element('buy');
						$alert = 'Bạn phải mua gói thi thử '.$contest['name'].' thì mới được thi';
						$login->setTitle($alert);
					$this->display();
					pzk_system()->halt();
				}
			}
		}else {
			//chua dang nhap
			$camp = intval(pzk_request()->getSegment(3));
			$this->initPage();
				pzk_page()->setTitle('Đăng nhập thi thử trường Trần Đại Nghĩa');
				pzk_page()->setKeywords('Đăng nhập thi thử trường Trần Đại Nghĩa');
				pzk_page()->setDescription('Đăng nhập thi thử vao trường Trần Đại nghĩa với phần mềm Full Look');
				pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
				pzk_page()->setBrief('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
				$this->append('trytest/login', 'wrapper');
				$login = pzk_element()->getLogin();
				$login->setRel("/trytest/showtl/".$camp);
				$login->setTitle('thì mới được vào thi thử');
			$this->display();
			pzk_system()->halt();
		}
	}
	public function saveChoiceAction(){
		if(!pzk_session('userId')){
			pzk_system()->halt();
		}
		
    	$request 			= pzk_request();
    	
    	$data_answers 		= $request->getanswers();
    	
    	$user_book_key	= $request->getKeybook();
		
		$camp = $data_answers['camp'];
		
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
        foreach($question_id as $key => $value){

            if(@$answers[$key]){
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
    			'quantity_question'	=> $quantity_question,
    			'startTime'			=> $start_time,
    			'stopTime'			=> $stop_time,
    			// 'keybook'			=> $user_book_key,
                'mark'              => $totaltrue,
    			'testId'			=> $testId,
				'trytest'			=> TN,
				'camp'				=> $camp,
				'created'			=> date('Y-m-d H:i:s'),
				'software'		=> pzk_request()->getSoftwareId(),
    			'duringTime'		=> $duringTime
    	);
    	
    	$s_keybook	=	pzk_session('keybook');
    	
    	if(1 || isset($s_keybook)){
    		
    		// $isKeyBook = $userBook->checkKeybook($s_keybook);
    		$isKeyBook = true;
    		$s = pzk_session();
    		
    		$s->delKeybook();
    		
    		if( 1 || ($s_keybook == $user_book_key && !$isKeyBook)){
    			
    			$userBook->setData($row);
    			
    			$userBook->save();

                //hight score

    			 
    			$userbookId=$userBook->getId();

    			foreach($question_id as $key => $value){
    				if(empty($answers[$key])){
    					$answers[$key] = '';
    				}
    				$questionId		=	$question_id[$key];
    				$rowAnswer=array(
						'user_book_id' => $userbookId,
						'questionId' => $questionId,
						'content' => $answers[$key],
						'question_type' => 'Q0'
					);
    				$userAnswer->setData($rowAnswer);
    				$userAnswer->save();
    			}
    			echo base64_encode(encrypt($userbookId, SECRETKEY));
    		}
    	}
    }
	public function showAnswersChoiceAction(){
		if(!pzk_session('userId')){
			pzk_system()->halt();
		}
    	 
    	$request 			= pzk_request();
    
    	$data_answers 		= $request->getanswers();
    	 
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
    public function saveTlAction() {
		if(!pzk_session('userId')){
			pzk_system()->halt();
		}
		$request 			= pzk_request();
    	
    	$data_answers 		= $request->getanswers();
		
		$answers 		= $data_answers['answers'];
		
    	$user_book_key	= $request->getKeybook();
		
		$camp = $data_answers['camp'];
    	
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

        if(isset($data_answers['during_time'])) {
            $duringTime = $data_answers['during_time'];
        }else {
            $duringTime = 0;
        }

       
    	$row	= 	array(
    			'userId'			=> $userId,
    			'quantity_question'	=> $quantity_question,
    			'startTime'			=> $start_time,
    			'stopTime'			=> $stop_time,
    			// 'keybook'			=> $user_book_key,
    			'testId'			=> $testId,
				'trytest'			=> TL,
				'created'			=> date('Y-m-d H:i:s'),
				'camp'				=> $camp,
				'software'		=> pzk_request()->getSoftwareId(),
    			'duringTime'		=> $duringTime
    	);
    	
    	$s_keybook	=	pzk_session('keybook');
    	
    	if(1 || isset($s_keybook)){
    		
    		// $isKeyBook = $userBook->checkKeybook($s_keybook);
    		$isKeyBook = true;
    		$s = pzk_session();
    		
    		$s->delKeybook();
    		
    		if(1 || ($s_keybook == $user_book_key && !$isKeyBook)){
    			
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

    			echo base64_encode(encrypt($userbookId, SECRETKEY));
    		}
    	}
	}
	
	public function showResultAction() {
		
		
		if(pzk_session('userId')){
			$userId = pzk_session('userId');
			
			$contestId = intval(pzk_request()->getSegment(3));
			$camp = $contestId;
			$check = pzk_user()->checkContest($contestId);
			
			$frontend = pzk_model('Frontend');
			$dataContest = $frontend->getContestById($contestId);
			
			if(time() < strtotime($dataContest['showResultDate']) && !pzk_request(showDebug)){
				//chua den ngay xem ket qua
				$this->initPage();
					pzk_page()->setTitle('Chưa đến ngày xem kết quả thi thử trường Trần Đại Nghĩa');
					pzk_page()->setKeywords('Chưa đến ngày xem kết quả thi thử trường Trần Đại Nghĩa');
					pzk_page()->setDescription('Chưa đến ngày xem kết quả thi thử vao trường Trần Đại nghĩa với phần mềm Full Look');
					pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
					pzk_page()->setBrief('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
					$this->append('trytest/datetest', 'wrapper');
					$finish = pzk_element('datetest');
					$finish->setDateCamp($dataContest['showResultDate']);
					$finish->setTitle('Chưa đến ngày công bố kết quả thi. Kết quả thi được công bố ngày ');
				$this->display();
				pzk_system()->halt();
			}else if(time() > strtotime($dataContest['endShowResult']) && !pzk_request(showDebug)){
				//het thoi gian xem ket qua
				$this->initPage();
					pzk_page()->setTitle('Hãy thi tự luận trường Trần Đại Nghĩa');
					pzk_page()->setKeywords('Hãy thi tự luận trường Trần Đại Nghĩa');
					pzk_page()->setDescription('Hãy thi tự luận vào trường Trần Đại nghĩa với phần mềm Full Look');
					pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
					pzk_page()->setBrief('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
					$this->append('trytest/alert', 'wrapper');
					$alert = pzk_element()->getAlert();
					$alert->setTitle('Đã hết thời gian xem kết quả thi');
					
				$this->display();
				pzk_system()->halt();
			}else{
				//xu li show dap an
				
				$userBookModel 	= pzk_model('Userbook');
				
				$testTn = $frontend->getTrytest(TN, $camp);
				$testTl = $frontend->getTrytest(TL, $camp);
				
				$userInfo = $frontend->getOne($userId, 'user');
				
				$userbookTn = $frontend->checkTrytest($userId, $testTn['id'], $camp);
				$userbookTl = $frontend->checkTrytest($userId, $testTl['id'], $camp);
				
				$dataUserAnswers 	= $userBookModel->getUserAnswers($userbookTl['id']);
				
				if($check){
					//chua thi trac nghiem
					if(!$userbookTn) {
						$this->initPage();
							pzk_page()->setTitle('Hãy thi tự luận trường Trần Đại Nghĩa');
							pzk_page()->setKeywords('Hãy thi tự luận trường Trần Đại Nghĩa');
							pzk_page()->setDescription('Hãy thi tự luận vào trường Trần Đại nghĩa với phần mềm Full Look');
							pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
							pzk_page()->setBrief('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
							$this->append('trytest/alert', 'wrapper');
							$alert = pzk_element()->getAlert();
							$html = 'Bạn chưa thi thử! <br/> <br/>Phải hoàn thành xong 2 bài thi(trắc nghiệm và tự luận) mới được xem đáp án!<br/><br/> Click <a href="/trytest/showtn/'.$contestId.'">vào đây</a> để thi thử!';
							$alert->setTitle($html);
							
						$this->display();
						pzk_system()->halt();
						//chua thi tu luan
					}elseif(!$userbookTl) {
						$this->initPage();
							pzk_page()->setTitle('Hãy thi tự luận trường Trần Đại Nghĩa');
							pzk_page()->setKeywords('Hãy thi tự luận trường Trần Đại Nghĩa');
							pzk_page()->setDescription('Hãy thi tự luận vào trường Trần Đại nghĩa với phần mềm Full Look');
							pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
							pzk_page()->setBrief('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
							$this->append('trytest/alert', 'wrapper');
							$alert = pzk_element()->getAlert();
							$html = 'Bạn chưa thi thử tự luận! <br/> <br/>Phải hoàn thành xong 2 bài thi(trắc nghiệm và tự luận) mới được xem đáp án!<br/><br/> Click <a href="/trytest/showtl/'.$contestId.'">vào đây</a> để thi thử tự luận';
							$alert->setTitle($html);
							
						$this->display();
						pzk_system()->halt();
					}else{
						$checkUserBook = $frontend->checkTryResult($userId, $testTl['id'] ,$camp);
					
						if($checkUserBook == 1) {
							//da cham xong
							$this->initPage();
									pzk_page()->setTitle('Kết quả thi thử trường Trần Đại Nghĩa');
									pzk_page()->setKeywords('Kết quả thi thử trường Trần Đại Nghĩa');
									pzk_page()->setDescription('Kêt quả thi thử vao trường Trần Đại nghĩa với phần mềm Full Look');
									pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
									pzk_page()->setBrief('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
									$this->append('trytest/showresult', 'wrapper');
									//check rating
									//get contest id
									$contest = $frontend->getContestRate($userId, $camp);
									//get rate
									$rate = $frontend->trytestRate($camp, $contest['id']);
									//data cau trac nghiem
									$showQuestionTn = $userBookModel->getQuestionByTrytestId($testTn['id']);
									
									$showresult = pzk_element('showresult');
									//set showQuestionTn
									$showresult->setShowQuestionTn($showQuestionTn);
									//set rate
									$showresult->setRate($rate);
									//xu li bai trac nghiem
									$showresult->setUserBookIdTn($userbookTn['id']);
									//du lieu cho bai tu luan
									$showresult->setDataUserAnswers($dataUserAnswers);
									//dulieu hoc sinh
									$showresult->setUserInfo($userInfo);
									//diem thi trac nghiem
									$scoreTn = $userbookTn['mark'] * 2;
									$showresult->setScoretn($scoreTn);
									//diem bai thi tu luan 
									$scoreTl = $userbookTl['teacherMark'];
									$showresult->setScoretl($scoreTl);
									$showresult->setCamp($camp);
										
								$this->display();
								pzk_system()->halt();
						}elseif($checkUserBook == 2){
							//dang cho cham
								$this->initPage();
									pzk_page()->setTitle('Thi thử trường Trần Đại Nghĩa');
									pzk_page()->setKeywords('Thi thử trường Trần Đại Nghĩa');
									pzk_page()->setDescription('Thi thử vao trường Trần Đại nghĩa với phần mềm Full Look');
									pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
									pzk_page()->setBrief('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
									$this->append('trytest/finish', 'wrapper');
									$finish = pzk_element('finish');
									$finish->setCamp($dataContest['name']);
									$finish->setDateFinish($dataContest['showResultDate']);
								$this->display();
								pzk_system()->halt();
						}	
					}
					
				}else{
					//mua goi thi thu dot 1
					$this->initPage();
						pzk_page()->setTitle('Mua gói thi thử trường Trần Đại Nghĩa');
						pzk_page()->setKeywords('Mua gói thi thử trường Trần Đại Nghĩa');
						pzk_page()->setDescription('Mua gói thi thử vao trường Trần Đại nghĩa với phần mềm Full Look');
						pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
						pzk_page()->setBrief('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
						$this->append('trytest/buy', 'wrapper');
						$login = pzk_element('buy');
						$alert = 'Bạn chưa mua gói thi thử hoặc chưa làm đề thi thử '.$dataContest['name'].'<br/>';
						$login->setTitle($alert);
					$this->display();
					pzk_system()->halt();
				}
			}
			
		}else{
			//chua dang nhap
			$camp = intval(pzk_request()->getSegment(3));
			$this->initPage();
				pzk_page()->setTitle('Đăng nhập thi thử trường Trần Đại Nghĩa');
				pzk_page()->setKeywords('Đăng nhập thi thử trường Trần Đại Nghĩa');
				pzk_page()->setDescription('Đăng nhập thi thử vao trường Trần Đại nghĩa với phần mềm Full Look');
				pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
				pzk_page()->setBrief('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
				$this->append('trytest/login', 'wrapper');
				$login = pzk_element()->getLogin();
				$login->setRel("/trytest/showresult/".$camp);
				$login->setTitle('thì mới xem được kết quả!');
			$this->display();
			pzk_system()->halt();
		}
	}
	
	public function showTestAnswerAction() {
		if(pzk_session('userId')){
			$userId = pzk_session('userId');
            $frontend = pzk_model('Frontend');
			$contestId = intval(pzk_request()->getSegment(3));
			$dataContest = $frontend->getContestById($contestId);
			//check ngay thi
			
			if(time() < strtotime($dataContest['showResultDate']) && !pzk_request()->getShowDebug()) {
			
				$this->initPage();
					pzk_page()->setTitle('Chưa đến ngày xem kết quả thi thử trường Trần Đại Nghĩa');
					pzk_page()->setKeywords('Chưa đến ngày xem kết quả thi thử trường Trần Đại Nghĩa');
					pzk_page()->setDescription('Chưa đến ngày xem kết quả thi thử vao trường Trần Đại nghĩa với phần mềm Full Look');
					pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
					pzk_page()->setBrief('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
					$this->append('trytest/datetest', 'wrapper');
					$finish = pzk_element('datetest');
					$finish->setDateCamp($dataContest['showResultDate']);
					$finish->setTitle('Chưa đến ngày công bố đề thi và đáp án. Đề thi và đáp án được công bố ngày ');
				$this->display();
				pzk_system()->halt();
			}else {
				$check = pzk_user()->checkPayment('view', $contestId);
				//debug($check);die();
				if($check){

					$userBookModel 	= pzk_model('Userbook');
					
					$testTn = $frontend->getTrytest(TN, $contestId);
					$testTl = $frontend->getTrytest(TL, $contestId);
					
					//da cham xong
					$this->initPage();
						pzk_page()->setTitle('Kết quả thi thử trường Trần Đại Nghĩa');
						pzk_page()->setKeywords('Kết quả thi thử trường Trần Đại Nghĩa');
						pzk_page()->setDescription('Kêt quả thi thử vao trường Trần Đại nghĩa với phần mềm Full Look');
						pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
						pzk_page()->setBrief('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
						$this->append('trytest/showtestanswer', 'wrapper');
						//data cau trac nghiem
						$showQuestionTn = $userBookModel->getQuestionByTrytestId($testTn['id']);
						$showQuestionTl = $userBookModel->getQuestionByTrytestId($testTl['id']);
						$showresult = pzk_element('showtestanswer');
						//set showQuestionTn
						$showresult->setShowQuestionTn($showQuestionTn);
						
						//du lieu cho bai tu luan
						$showresult->setShowQuestionTl($showQuestionTl);
						
						$showresult->setCamp($contestId);
							
					$this->display();
					pzk_system()->halt();	
				}else{
					//mua goi xem thu dot 1
					$this->initPage();
						pzk_page()->setTitle('Mua gói xem đề thi thử trường Trần Đại Nghĩa');
						pzk_page()->setKeywords('Mua gói xem đề thi thử trường Trần Đại Nghĩa');
						pzk_page()->setDescription('Mua gói xem đề thi thử vao trường Trần Đại nghĩa với phần mềm Full Look');
						pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
						pzk_page()->setBrief('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
						$this->append('trytest/alert', 'wrapper');
						$login = pzk_element()->getAlert();
						$contestname = strtolower($dataContest['name']);
						$alert = 'Bạn chưa mua gói xem đề '. $contestname .' <br/>';
						$login->setTitle($alert);
					$this->display();
					pzk_system()->halt();
				}	
			}
				
					
			
		}else{
			//chua dang nhap
			$contestId = intval(pzk_request()->getSegment(3));
			$this->initPage();
				pzk_page()->setTitle('Đăng nhập thi thử trường Trần Đại Nghĩa');
				pzk_page()->setKeywords('Đăng nhập thi thử trường Trần Đại Nghĩa');
				pzk_page()->setDescription('Đăng nhập thi thử vao trường Trần Đại nghĩa với phần mềm Full Look');
				pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
				pzk_page()->setBrief('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
				$this->append('trytest/login', 'wrapper');
				$login = pzk_element()->getLogin();
				$login->setRel("/trytest/showtestanswer/".$contestId);
				$login->setTitle('thì mới xem được đáp án');
			$this->display();
			pzk_system()->halt();
		}
	}
	
	public function showTestAction() {
		if(pzk_session('userId')){
			$userId = pzk_session('userId');
			$frontend = pzk_model('Frontend');
			$contestId = intval(pzk_request()->getSegment(3));
			$dataContest = $frontend->getContestById($contestId);
			//check ngay thi
			
			if(time() < strtotime($dataContest['showResultDate']) && !pzk_request(showDebug)) {
			
				$this->initPage();
					pzk_page()->setTitle('Chưa đến ngày xem kết quả thi thử trường Trần Đại Nghĩa');
					pzk_page()->setKeywords('Chưa đến ngày xem kết quả thi thử trường Trần Đại Nghĩa');
					pzk_page()->setDescription('Chưa đến ngày xem kết quả thi thử vao trường Trần Đại nghĩa với phần mềm Full Look');
					pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
					pzk_page()->setBrief('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
					$this->append('trytest/datetest', 'wrapper');
					$finish = pzk_element('datetest');
					$finish->setDateCamp($dataContest['showResultDate']);
					$finish->setTitle('Chưa đến ngày công bố đề thi. Đề thi được công bố ngày ');
				$this->display();
				pzk_system()->halt();
			}else {
				$check = pzk_user()->checkPayment('view', $contestId);
				
				if($check){
					
					$userBookModel 	= pzk_model('Userbook');
					
					$testTn = $frontend->getTrytest(TN, $contestId);
					$testTl = $frontend->getTrytest(TL, $contestId);
					
					//da cham xong
					$this->initPage();
						pzk_page()->setTitle('Kết quả thi thử trường Trần Đại Nghĩa');
						pzk_page()->setKeywords('Kết quả thi thử trường Trần Đại Nghĩa');
						pzk_page()->setDescription('Kêt quả thi thử vao trường Trần Đại nghĩa với phần mềm Full Look');
						pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
						pzk_page()->setBrief('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
						$this->append('trytest/showtest', 'wrapper');
						//data cau trac nghiem
						$showQuestionTn = $userBookModel->getQuestionByTrytestId($testTn['id']);
						$showQuestionTl = $userBookModel->getQuestionByTrytestId($testTl['id']);
						$showresult = pzk_element('showtest');
						//set showQuestionTn
						$showresult->setShowQuestionTn($showQuestionTn);
						
						//du lieu cho bai tu luan
						$showresult->setShowQuestionTl($showQuestionTl);
						
						$showresult->setCamp($contestId);
							
					$this->display();
					pzk_system()->halt();	
				}else{
					//mua goi xem thu dot 1
					$this->initPage();
						pzk_page()->setTitle('Mua gói xem đề thi thử trường Trần Đại Nghĩa');
						pzk_page()->setKeywords('Mua gói xem đề thi thử trường Trần Đại Nghĩa');
						pzk_page()->setDescription('Mua gói xem đề thi thử vao trường Trần Đại nghĩa với phần mềm Full Look');
						pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
						pzk_page()->setBrief('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
						$this->append('trytest/alert', 'wrapper');
						$login = pzk_element()->getAlert();
						$contestname = strtolower($dataContest['name']);
						$alert = '<div class="bg bg-success padding-10">Bạn chưa mua gói xem đề '. $contestname .' <br/><br/> <a href="/contest/about">Vào đây</a> để mua</a>';
						$login->setTitle($alert);
					$this->display();
					pzk_system()->halt();
				}	
			}
				
					
			
		}else{
			//chua dang nhap
			$contestId = intval(pzk_request()->getSegment(3));
			$this->initPage();
				pzk_page()->setTitle('Đăng nhập thi thử trường Trần Đại Nghĩa');
				pzk_page()->setKeywords('Đăng nhập thi thử trường Trần Đại Nghĩa');
				pzk_page()->setDescription('Đăng nhập thi thử vao trường Trần Đại nghĩa với phần mềm Full Look');
				pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
				pzk_page()->setBrief('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
				$this->append('trytest/login', 'wrapper');
				$login = pzk_element()->getLogin();
				$login->set('rel',"/trytest/showtest/".$contestId);
				$login->setTitle('thì mới xem được đề!');
			$this->display();
			pzk_system()->halt();
		}
	}
	
	
}
?>