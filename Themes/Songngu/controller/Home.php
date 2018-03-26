<?php
pzk_import_controller('Themes/Default', 'Home');
class PzkHomeController extends PzkThemesDefaultHomeController {
	public $masterPosition = 'wrapper';
	public function aboutAction(){
		$this->initPage();
		pzk_page()->set('title', 'Trang hướng dẫn mua phần mềm Full Look');
		pzk_page()->set('keywords', 'Giáo dục');
		pzk_page()->set('description', 'Hướng dẫn mua phần mềm Full Look');
		pzk_page()->set('img', '/Default/skin/nobel/Themes/Story/media/logo.png');
		pzk_page()->set('brief', 'Phần mềm Full Look, Phần mềm luyện thi vào lớp 6 Trần Đại Nghĩa');
		$this->append('home/about')
		->display();
	}
	
	public function detailAction(){
			$this->initPage();
			$page = pzk_page();
			$page->set('title', 'Chi tiết về phần mềm Full Look Song Ngữ');
			$page->set('keywords', 'Giáo dục');
			$page->set('description', 'Chi tiết về phần mềm Full Look Song Ngữ');
			$page->set('img', '/Default/skin/nobel/Themes/Story/media/logo.png');
			$page->set('brief', 'Chi tiết về phần mềm Full Look Song Ngữ');
			$this->append('home/detail')
			->display();
	}

	public function renderCodeAction(){
		
		$price = pzk_request('price');
		$languages = pzk_request('languages');
		$time = pzk_request('time');
		$class = pzk_request('class');
		$softwareId =pzk_request('softwareId');
		$siteId = pzk_request('siteId');
		$serial = pzk_request('serial');
		$quantity = pzk_request('quantity');
		$ettyCard = _db()->getEntity('Payment.Card_nextnobels');
		
		for ($i=0; $i < $quantity ; $i++) { 
			$codeId = md5(microtime().SECRETKEY.rand(100,9999))	;
			$codeId = substr($codeId , 0, 8 );
			$md5codeId = md5($codeId);
			
			$serial = $serial + 1;
			$row = array('pincard' => $md5codeId,
				'price' => $price,
				'serial' => $serial,
				'status'=> 1,
				'languages'=> $languages,
				'time' => $time,
				'class' => $class,
				'software'=> $softwareId,
				'site' => $siteId
			);
			$ettyCard->create($row);
			$File = BASE_DIR.'/3rdparty/thecao/cardflsn.txt'; 
					$Handle = fopen($File, 'a');
					$Data = "pincard: ".$codeId." |serial: ".$serial." |languages : ".$languages."|time: ".$time. "|class: ".$class."|software: ".$softwareId."|site: ".$siteId." \r\n";
					fwrite($Handle, $Data); 
					fclose($Handle);
		}
		
	}
	
	public function paymentAction(){
			$this->initPage();
			pzk_page()->set('title', 'Trang hướng dẫn mua phần mềm Full Look');
			pzk_page()->set('keywords', 'Giáo dục');
			pzk_page()->set('description', 'Hướng dẫn mua phần mềm Full Look');
			pzk_page()->set('img', '/Default/skin/nobel/Themes/Story/media/logo.png');
			pzk_page()->set('brief', 'Phần mềm Full Look, Phần mềm luyện thi vào lớp 6 Trần Đại Nghĩa');
			$this->append('home/payment')
			->display();
	}
	
	
	public function listTestAction() {
        $this->initPage();
		
			$this->append('education/question/listTest', 'wrapper');
			
        $this->display();
    }
    public function ratingAction() {
		if(pzk_request('clearTestId') == 1) {
			 pzk_session()->del('userBookTestId');
		}
		$week= pzk_request('week');
        $de= pzk_request('examination');
        $practice = pzk_request('practice');
        $clearTestId = pzk_request('clearTestId');
        $this->initPage();
		pzk_page()->set('title', 'Bảng xếp hạng');
		pzk_page()->set('keywords', 'Giáo dục');
		pzk_page()->set('description', 'Bảng xếp hạng cá nhân');
		pzk_page()->set('img', '/Default/skin/nobel/Themes/Story/media/logo.png');
		pzk_page()->set('brief', 'Bảng xếp hạng cá nhân các em sử dụng phần mềm Full Look');
		/*if(pzk_themes('default')) {
				$this->append('education/question/rating', 'wrapper');
			} else {
				$this->append('education/question/rating', 'left');
		}*/
		if(pzk_session('servicePackage') && pzk_session('servicePackage') == 'classroom' && pzk_session('checkUser') == 1){
			$this->append('education/question/ratingclassroom', 'wrapper');
			$userBook	= pzk_model('Frontend');

	        $showRating	= pzk_element('ratingClassroom');

	        $dataTest = $userBook->getAllTest(pzk_request()->get('practice'));
	        //var_dump($dataTest);die;
	        $showRating->set('dataTest', $dataTest);
		}else {
			$this->append('education/question/rating', 'wrapper');
			$userBook	= pzk_model('Frontend');

	        $showRating	= pzk_element('rating');

	        $dataTest = $userBook->getAllTest(pzk_request()->get('practice'));
	        //var_dump($dataTest);die;
	        $showRating->set('dataTest', $dataTest);
        }
        

        $this->display();
    }
    public function showRatingAction() {
        
        if(pzk_request('clearTestId') == 1) {
             pzk_session()->set('userBookTestId', NULL);
        }
        
        $this->initPage();
        pzk_page()->set('title', 'Bảng xếp hạng');
        pzk_page()->set('keywords', 'Giáo dục');
        pzk_page()->set('description', 'Bảng xếp hạng cá nhân');
        pzk_page()->set('img', '/Default/skin/nobel/Themes/Story/media/logo.png');
        pzk_page()->set('brief', 'Bảng xếp hạng cá nhân các em sử dụng phần mềm Full Look');
        /*if(pzk_themes('default')) {
                $this->append('education/question/showRating', 'wrapper');
            } else {
                $this->append('education/question/showRating', 'left');
        }*/
        if(pzk_session('servicePackage') && pzk_session('servicePackage') == 'classroom' && pzk_session('checkUser') == 1){
			$this->append('education/question/showRatingclassroom', 'wrapper');
			$userBook   = pzk_model('Frontend');
        
	        $showRating = pzk_element('showRatingClassroom');

	        $dataTest = $userBook->getAllTest(pzk_request()->get('practice'));

	        $showRating->set('dataTest', $dataTest);
		}else {
			$this->append('education/question/showRating', 'wrapper');
        	$userBook   = pzk_model('Frontend');
        
	        $showRating = pzk_element('showRating');

	        $dataTest = $userBook->getAllTest(pzk_request()->get('practice'));

	        $showRating->set('dataTest', $dataTest);	
		}
        $this->display();
    }
	public function saveTlAction() {
		if(!pzk_session('userId')){
			pzk_system()->halt();
		}
		$request 			= pzk_element('request');
    	
    	$data_answers 		= $request->get('answers');
		
		
		$answers 		= array();
    	
    	if(isset($data_answers['answers'])){
    		
    		$answers 		= $data_answers['answers'];
    	}
		
		
    	
		$question_id 	= $data_answers['questions'];
		
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
		
		$topicPost	= $request->get('topicPost');
    	$subjectPost	= $request->get('subjectPost');

       
    	$row	= 	array(
    			'userId'			=> $userId,
				'categoryId'		=> $subjectPost,
				'topic'				=> $topicPost,
    			'quantity_question'	=> $quantity_question,
    			'startTime'			=> $start_time,
    			'stopTime'			=> $stop_time,
				'school'			=> pzk_session('school'),
				'class'				=> pzk_session('class'),
				'classname'			=> pzk_session('classname'),
				'created'			=> date('Y-m-d H:i:s'),
				'lang'			=> pzk_session('language'),
				'software'		=> pzk_request()->get('softwareId'),
				'practiceType' => 'TL',
    			'duringTime'		=> $duringTime
    	);
    	
    	
    			
		$userBook->setData($row);
		
		$userBook->save();

		$userbookId = $userBook->get('id');
		
		
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
	
    function saveQuestionAction(){
		
		$userId	=	pzk_session('userId');
		$lang = 'en';
		if(pzk_session('language')){
			$lang = pzk_session('language');
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
		
    	$request 			= pzk_element('request');
    	
    	$data_answers 		= $request->get('answers');
		
		$user_book_key	= $request->get('keybook');
    	
    	$question_id 	= $data_answers['questions'];
		$topicPost	= $request->get('topicPost');
    	$subjectPost	= $request->get('subjectPost');
		
    	$answers 		= array();
    	
    	if(isset($data_answers['answers'])){
    		
    		$answers 		= $data_answers['answers'];
    	}
		$exercise_number = 0;
    	
		if(isset($data_answers['exercise_number'])){
    		
    		$exercise_number	= $data_answers['exercise_number'];
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
    			'categoryId'		=> $subjectPost,
    			'quantity_question'	=> $quantity_question,
    			'startTime'			=> $start_time,
    			'stopTime'			=> $stop_time,
    			'keybook'			=> $user_book_key,
                'mark'              => $totaltrue,
				'exercise_number'   => $exercise_number,
				'software' 			=> pzk_request()->get('softwareId'),
				'created'			=> date(DATEFORMAT, $_SERVER['REQUEST_TIME']),
    			'duringTime'		=> $duringTime,
    			'topic'				=> $topicPost,
				'lang'				=> $lang
    	);
    	$s_keybook	=	pzk_session('keybook');
		
    	if(isset($s_keybook)){
    		
    		$isKeyBook = $userBook->checkKeybook($s_keybook);
    		
    		$s = pzk_session();
    		
    		$s->del('keybook');
    		
    		if($s_keybook == $user_book_key && !$isKeyBook){
    			
    			$userBook->setData($row);
    			
    			$userBook->save();

               
				$userbookId=$userBook->get('id');

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
    				
    			}
    			$frontendmodel->insertManyDatas('user_answers', array('user_book_id', 'questionId', 'answerId'), $rowAnswers);
    			$lang = 'vn';
				if(pzk_session('language')){
					$lang = pzk_session('language');	
				}
				
				//log questions
				pzk_stat()->logPracticeQuestion($userId, $username, $name, $totaltrue, $quantity_question, $areacode, $district, $school, $class, $className, $checkUser, $subjectPost, $quantity_question, $lang); // 5 10
				//pzk_stat()->get($userId);
				
    			
    			echo 1;
    			
				//echo base64_encode(encrypt($userbookId, SECRETKEY));
    		}
    	}
    }

    public function userVoteAction(){
    	$answerId = pzk_request('answer');
    	$pollId = pzk_request('pollId');
    	$ip = $_SERVER['REMOTE_ADDR'];    	
	    $poll= _db()-> getEntity('Cms.Poll.Result');
	    $row = array(
	    	'pollId'    => $pollId,
	    	'answerId'  => $answerId,
	    	'userIp'	=> $ip,
	    	'site'		=> pzk_request('siteId'),
	    	'software'	=> pzk_request('softwareId'),
	    	'created'			=> date(DATEFORMAT, $_SERVER['REQUEST_TIME']),
	    	
	    );
	    $poll->setData($row);
	    $poll->save();
	    echo 1;
    }

	public function filterDataByWeekAction() {
		$val = pzk_request('val');
		$tam = explode('-', $val);
		$week = $tam[0];
		$year = $tam[1];
		pzk_session('weekHistory', $week);
		pzk_session('yearHistory', $year);
        $this->redirect('profile/detail');
	}
	public function filterAchievementByWeekAction() {
		$val = pzk_request('val');
		$tam = explode('-', $val);
		$week = $tam[0];
		$year = $tam[1];
		pzk_session('weekAchievement', $week);
		pzk_session('yearAchievement', $year);
        $this->redirect('home/achievement');
	}
	public function resultAchievementByWeekAction(){
		$val = pzk_request('val');
		$tam = explode('-', $val);
		$week = $tam[0];
		$year = $tam[1];
		pzk_session('resWeekAchievement', $week);
		pzk_session('resYearAchievement', $year);
        $this->redirect('profile/detail');
	}
	public function sortAchievementAction(){
		$val = pzk_request('val');
		pzk_session('sortAchievement', $val);
		
        $this->redirect('home/achievement');
	}
	public function ajaxHistoryAction() {
		$practice = pzk_request()->get('practice');
		$idResult = pzk_request()->get('idResult');
		$page = pzk_request()->get('page');
		$userId = pzk_request()->get('userId');
		$startDate = pzk_request()->get('startDate');
		$endDate = pzk_request()->get('endDate');
		$pageSize = 20;
		$this->parse('history/testHistory');
			
		$testHistory = pzk_element('testHistory');
		$testHistory->set('practice', $practice);
		$testHistory->set('idResult', $idResult);
		$testHistory->set('page', $page);
		$testHistory->set('userId', $userId);
		$testHistory->set('startDate', $startDate);
		$testHistory->set('endDate', $endDate);
		$testHistory->set('pageSize', $pageSize);
		$testHistory->display();
			
	}
	public function ajaxPracticeAction() {
		$page = pzk_request()->get('page');
		$userId = pzk_request()->get('userId');
		$startDate = pzk_request()->get('startDate');
		$endDate = pzk_request()->get('endDate');
		$pageSize = 20;
		$this->parse('history/practiceHistory');
			
		$practiceHistory = pzk_element('practiceHistory');
		$practiceHistory->set('page', $page);
		$practiceHistory->set('userId', $userId);
		$practiceHistory->set('startDate', $startDate);
		$practiceHistory->set('endDate', $endDate);
		$practiceHistory->set('pageSize', $pageSize);
		$practiceHistory->display();
	}
	
	public function achievementAction(){
		$this->initPage();
		pzk_page()->set('title', 'Trang hướng dẫn mua phần mềm Full Look');
		pzk_page()->set('keywords', 'Giáo dục');
		pzk_page()->set('description', 'Hướng dẫn mua phần mềm Full Look');
		pzk_page()->set('img', '/Default/skin/nobel/Themes/Story/media/logo.png');
		pzk_page()->set('brief', 'Phần mềm Full Look, Phần mềm luyện thi vào lớp 6 Trần Đại Nghĩa');
		$checkUser = pzk_session('checkUser');
		$servicePackage = pzk_session('servicePackage');
		if($checkUser == 1 && $servicePackage == 'classroom'){
			$areacode = pzk_session('areacode');
			$district = pzk_session('district');
			$school = pzk_session('school');
			$class = pzk_session('class');
			$className = pzk_session('classname');
			$this->append('home/achievementclass');
	
			$achievementClass = pzk_element('achievementclass');
			
			$achievementClass->set('areacode', $areacode);
			$achievementClass->set('district', $district);
			$achievementClass->set('school', $school);
			$achievementClass->set('class', $class);
			$achievementClass->set('classname', $className);
			
			
		}else{
			$this->append('home/achievement');
		}
		
		$this->display();
	}
	public function getDistrictAction(){
		$provinceId = pzk_request('provinceId');	
		
		$this->parse('user/register/district');
		$district = pzk_element('pagDistrict');	
		$district->set('provinceId', $provinceId);	
		$district->display();
			
		
	}
	public function getSchoolAction(){
		$districtId = pzk_request('districtId');
		$this->parse('user/register/school');
		$school = pzk_element('pagSchool');	
		$school->set('districtId', $districtId);	
		$school->display();
	}
	
	public function getDistrict2Action(){
		$provinceId = pzk_request('provinceId');	
		
		$this->parse('home/district');
		$district = pzk_element('district');	
		$district->set('provinceId', $provinceId);	
		$district->display();
			
		
	}
	public function getSchool2Action(){
		$districtId = pzk_request('districtId');
		$this->parse('home/school');
		$school = pzk_element('school');	
		$school->set('districtId', $districtId);	
		$school->display();
	}
	
	public function changeServiceAction(){
		$serviceName = pzk_request('serviceName');
		$this->parse('user/register/service');
		$service = pzk_element('pagService');	
		$service->set('serviceName', $serviceName);	
		$service->display();
		
	}
	public function getRatingAction(){
		$provinceId = pzk_request('provinceId');
		$districtId = pzk_request('districtId');
		$schoolId   = pzk_request('schoolId');
		$classId    = pzk_request('classId');
		$classname  = pzk_request('classname');
		
		$classname  = strtolower($classname);
		$classname  = trim($classname);
		$rating  = "";
		pzk_session()->set('provinceId', $provinceId);
		pzk_session()->set('districtId', $districtId);
		pzk_session()->set('schoolId', $schoolId);
		pzk_session()->set('classId', $classId);
		pzk_session()->set('classnameId', $classname);
		
		if(pzk_session('provinceId')){
			$rating .= " and areacode = '".pzk_session('provinceId')."'";
		}
		
		if(pzk_session('provinceId') && pzk_session('districtId')){
			$rating .= " and district = '".pzk_session('districtId')."'";
		}
		if(pzk_session('provinceId') && pzk_session('districtId') && pzk_session('schoolId')){
			$rating .= " and school = '".pzk_session('schoolId')."'";
		}
		if(pzk_session('provinceId') && pzk_session('districtId') && pzk_session('classId')){
			$rating .= " and class = '".pzk_session('classId')."'";
		}
		if(pzk_session('provinceId') && pzk_session('districtId') && pzk_session('classnameId')){
			$rating .= " and classname = '".pzk_session('classnameId')."'". " and checkUser = '1'";
		}
		pzk_session()->set('condirating', $rating);
		echo $rating;
	}
	
	public function getallRatingAction(){
		$s = pzk_session();
		$s->del('provinceId');
		$s->del('districtId');
		$s->del('schoolId');
		$s->del('classId');
		$s->del('classnameId');
		$s->del('condirating');
		echo '1';
	}
	public function setAreacodeAction() {
		$city = pzk_request('city');
		$district = pzk_request('district');
		$school   = pzk_request('school');
		$class    = pzk_request('classId');
		$classname  = pzk_request('classname');
		$classall = pzk_request('classall');
		$classname  = strtolower($classname);
		$classname  = trim($classname);
		
		pzk_session()->set('cityAchievement', $city);
		pzk_session()->set('districtAchievement', $district);
		pzk_session()->set('schoolAchievement', $school);
		pzk_session()->set('classAchievement', $class);
		pzk_session()->set('classnameAchievement', $classname);
		pzk_session()->set('classall', $classall);
		
		$condition = '';
		if(pzk_session('cityAchievement') && pzk_session('cityAchievement') != 'all'){
			$condition .= " and areacode = '".pzk_session('cityAchievement')."'";
		}else{
			$condition = 'all';
		}
		
		if(pzk_session('districtAchievement') && pzk_session('districtAchievement') != 'all'){
			$condition .= " and district = '".pzk_session('districtAchievement')."'";
		}
		if(pzk_session('schoolAchievement') && pzk_session('schoolAchievement') != 'all'){
			$condition .= " and school = '".pzk_session('schoolAchievement')."'";
		}
		if(pzk_session('classAchievement') && pzk_session('classAchievement') != 'all'){
			$condition .= " and class = '".pzk_session('classAchievement')."'";
		}
		if(pzk_session('classnameAchievement') && pzk_session('classall')!= 'all'){
			$condition .= " and classname = '".pzk_session('classnameAchievement')."'". " and checkUser = '1'";
		}
		if($condition != '' && $condition != 'all'){
			$condition = substr($condition, 4);
		}
		pzk_session()->set('conditionAchievement', $condition);
	}
	
	public function scienceAction() {
		$folders 			= _db()->query("select id, name, parent from categories where parents like '%,52,%' and status=1 and document=0 and classes like ',5,' order by parent asc");
		//debug($folders);
		
		$questions 		= 	_db()->select('id,categoryIds')->fromQuestions();
		$conds 			=	array('or');
		$folderMaps 	=	array();
		
		foreach($folders as $folder) {
			// $conds[]	=	array('like', 'categoryIds', '%,'.$folder['id'].',%');
			$folderMaps[$folder['id']]	=	0;
		}
		$questions->likeCategoryIds('%,52,%');
		$questions->whereStatus(1);
		$questions->whereDeleted(0);
		$questions->likeClasses('%,5,%');
		//debug($questions->getSelectQuery());
		$questions 		=	$questions->result();
		$total 			=	0;
		foreach($questions as $question) {
			$categoryIds	=	explode(',', trim($question['categoryIds'], ','));
			foreach($categoryIds as $categoryId) {
				if(isset($folderMaps[$categoryId])) {
					$folderMaps[$categoryId]++;
					$total++;
				}
			}
		}
		//debug($questions);
		debug($folders);
		debug($total);
		debug(count($questions));
		debug($folderMaps);
	}
	/*function updateAnswersAction(){
		$userAnswer	= pzk_model('adminQuestion');
		$answers = $userAnswer->createQuestion();
		var_dump($answers);die;
	}*/
	
	function dangkiAction() {
		$name = pzk_request('name');
		$email   = pzk_request('email');
		$phone    = pzk_request('phone');
		if($name && $email && $phone){
			$row = array(
				'name' => $name,
				'email' => $email,
				'phone' => $phone,
				'created' => date(DATEFORMAT, $_SERVER['REQUEST_TIME'])
			);
			$frontendmodel = pzk_model('Frontend');
			$frontendmodel->save($row, 'consultant');
			echo 1;
		}
	}
	function voteAction() {
		
		$content = pzk_request('content');
		if($content && pzk_session('userId')){
			$userId = pzk_session('userId');
			$username = pzk_session('username');
			$row = array(
				'content' => $content,
				'userId' => $userId,
				'username' => $username,
				'created' => date(DATEFORMAT, $_SERVER['REQUEST_TIME'])
			);
			$frontendmodel = pzk_model('Frontend');
			$frontendmodel->save($row, 'vote');
			echo 1;
		}
	}
	
	function emptyAction() {
		$collection = pzk_model('Entity.Collection.Questions');
		$collection->filterEnabled();
		$collection->filterCategoryId(288);
		$collection->isOrdering();
		$query = $collection->query();
		$result = $query->result();
		debug($result);
	}
	function saveSnAction(){
		if(pzk_request()){
			$row = array(
				'userId' => pzk_request('userId'),
				'content' => pzk_request('text'),
				'senderId' => pzk_request('userchuc'),
				'created' => date(DATEFORMAT, $_SERVER['REQUEST_TIME'])
			);
			$frontendmodel = pzk_model('Frontend');
			$frontendmodel->save($row, 'user_birdth');
			echo 1;
		}
	}
}