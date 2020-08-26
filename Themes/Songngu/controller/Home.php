<?php
pzk_import_controller('Themes/Default', 'Home');
class PzkHomeController extends PzkThemesDefaultHomeController
{
	public $masterPosition = 'wrapper';
	public function aboutAction()
	{
		$this->initPage();
		pzk_page()->setTitle('Trang hướng dẫn mua phần mềm Full Look');
		pzk_page()->setKeywords('Giáo dục');
		pzk_page()->setDescription('Hướng dẫn mua phần mềm Full Look');
		pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
		pzk_page()->setBrief('Phần mềm Full Look, Phần mềm luyện thi vào lớp 6 Trần Đại Nghĩa');
		$this->append('home/about')
			->display();
	}

	public function detailAction()
	{
		$this->initPage();
		$page = pzk_page();
		$page->setTitle('Chi tiết về phần mềm Full Look Song Ngữ');
		$page->setKeywords('Giáo dục');
		$page->setDescription('Chi tiết về phần mềm Full Look Song Ngữ');
		$page->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
		$page->setBrief('Chi tiết về phần mềm Full Look Song Ngữ');
		$this->append('home/detail')
			->display();
	}

	public function renderCodeAction()
	{

		$price = pzk_request()->getPrice();
		$languages = pzk_request()->getLanguages();
		$time = pzk_request()->getTime();
		$class = pzk_request()->getClass();
		$softwareId = pzk_request()->getSoftwareId();
		$siteId = pzk_request()->getSiteId();
		$serial = pzk_request()->getSerial();
		$quantity = pzk_request()->getQuantity();
		$ettyCard = _db()->getEntity('Payment.Card_nextnobels');

		for ($i = 0; $i < $quantity; $i++) {
			$codeId = md5(microtime() . SECRETKEY . rand(100, 9999));
			$codeId = substr($codeId, 0, 8);
			$md5codeId = md5($codeId);

			$serial = $serial + 1;
			$row = array(
				'pincard' => $md5codeId,
				'price' => $price,
				'serial' => $serial,
				'status' => 1,
				'languages' => $languages,
				'time' => $time,
				'class' => $class,
				'software' => $softwareId,
				'site' => $siteId
			);
			$ettyCard->create($row);
			$File = BASE_DIR . '/3rdparty/thecao/cardflsn.txt';
			$Handle = fopen($File, 'a');
			$Data = "pincard: " . $codeId . " |serial: " . $serial . " |languages : " . $languages . "|time: " . $time . "|class: " . $class . "|software: " . $softwareId . "|site: " . $siteId . " \r\n";
			fwrite($Handle, $Data);
			fclose($Handle);
		}
	}

	public function paymentAction()
	{
		$this->initPage();
		pzk_page()->setTitle('Trang hướng dẫn mua phần mềm Full Look');
		pzk_page()->setKeywords('Giáo dục');
		pzk_page()->setDescription('Hướng dẫn mua phần mềm Full Look');
		pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
		pzk_page()->setBrief('Phần mềm Full Look, Phần mềm luyện thi vào lớp 6 Trần Đại Nghĩa');
		$this->append('home/payment')
			->display();
	}


	public function listTestAction()
	{
		$this->initPage();

		$this->append('education/question/listTest', 'wrapper');

		$this->display();
	}
	public function ratingAction()
	{
		if (pzk_request()->getClearTestId() == 1) {
			pzk_session()->del('userBookTestId');
		}
		$week = pzk_request()->getWeek();
		$de = pzk_request()->getExamination();
		$practice = pzk_request()->getPractice();
		$clearTestId = pzk_request()->getClearTestId();
		$this->initPage();
		pzk_page()->setTitle('Bảng xếp hạng');
		pzk_page()->setKeywords('Giáo dục');
		pzk_page()->setDescription('Bảng xếp hạng cá nhân');
		pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
		pzk_page()->setBrief('Bảng xếp hạng cá nhân các em sử dụng phần mềm Full Look');
		/*if(pzk_themes('default')) {
				$this->append('education/question/rating', 'wrapper');
			} else {
				$this->append('education/question/rating', 'left');
		}*/
		if (pzk_session('servicePackage') && pzk_session('servicePackage') == 'classroom' && pzk_session('checkUser') == 1) {
			$this->append('education/question/ratingclassroom', 'wrapper');
			$userBook	= pzk_model('Frontend');

			$showRating	= pzk_element('ratingClassroom');

			$dataTest = $userBook->getAllTest(pzk_request()->getPractice());
			//var_dump($dataTest);die;
			$showRating->setDataTest($dataTest);
		} else {
			$this->append('education/question/rating', 'wrapper');
			$userBook	= pzk_model('Frontend');

			$showRating	= pzk_element('rating');

			$dataTest = $userBook->getAllTest(pzk_request()->getPractice());
			//var_dump($dataTest);die;
			$showRating->setDataTest($dataTest);
		}


		$this->display();
	}
	public function showRatingAction()
	{

		if (pzk_request()->getClearTestId() == 1) {
			pzk_session()->setUserBookTestId(NULL);
		}

		$this->initPage();
		pzk_page()->setTitle('Bảng xếp hạng');
		pzk_page()->setKeywords('Giáo dục');
		pzk_page()->setDescription('Bảng xếp hạng cá nhân');
		pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
		pzk_page()->setBrief('Bảng xếp hạng cá nhân các em sử dụng phần mềm Full Look');
		/*if(pzk_themes('default')) {
                $this->append('education/question/showRating', 'wrapper');
            } else {
                $this->append('education/question/showRating', 'left');
        }*/
		if (pzk_session('servicePackage') && pzk_session('servicePackage') == 'classroom' && pzk_session('checkUser') == 1) {
			$this->append('education/question/showRatingclassroom', 'wrapper');
			$userBook   = pzk_model('Frontend');

			$showRating = pzk_element('showRatingClassroom');

			$dataTest = $userBook->getAllTest(pzk_request()->getPractice());

			$showRating->setDataTest($dataTest);
		} else {
			$this->append('education/question/showRating', 'wrapper');
			$userBook   = pzk_model('Frontend');

			$showRating = pzk_element()->getShowRating();

			$dataTest = $userBook->getAllTest(pzk_request()->getPractice());

			$showRating->setDataTest($dataTest);
		}
		$this->display();
	}
	public function saveTlAction()
	{
		if (!pzk_session('userId')) {
			pzk_system()->halt();
		}
		$request 			= pzk_request();

		$data_answers 		= $request->getanswers();


		$answers 		= array();

		if (isset($data_answers['answers'])) {

			$answers 		= $data_answers['answers'];
		}



		$question_id 	= $data_answers['questions'];

		$quantity_question	= count($data_answers['questions']);

		$userBook	= _db()->getEntity('Userbook.Userbook');

		$userAnswer	= _db()->getEntity('Userbook.Useranswer');

		$userId	=	pzk_session('userId');

		if (isset($data_answers['start_time'])) {

			$start_time	= date('Y:m:d H:i:s', $data_answers['start_time']);
		} else {

			$start_time = '';
		}

		$stop_time 	= date('Y:m:d H:i:s', $_SERVER['REQUEST_TIME']);

		if (isset($data_answers['during_time'])) {
			$duringTime = $data_answers['during_time'];
		} else {
			$duringTime = 0;
		}

		$topicPost	= $request->getTopicPost();
		$subjectPost	= $request->getSubjectPost();


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
			'software'		=> pzk_request()->getSoftwareId(),
			'practiceType' => 'TL',
			'duringTime'		=> $duringTime
		);



		$userBook->setData($row);

		$userBook->save();

		$userbookId = $userBook->getId();


		foreach ($question_id as $key => $value) {
			if (empty($answers[$key])) {
				$answers[$key] = '';
			}
			$questionId		=	$question_id[$key];
			//xu li input textarea
			$arAnswer = array();
			if (isset($answers[$key . '_i'])) {
				$arAnswer['i'] = $answers[$key . '_i'];
			}
			if (isset($answers[$key . '_t'])) {
				$arAnswer['t'] = $answers[$key . '_t'];
			}
			$rowAnswer = array(
				'user_book_id' => $userbookId,
				'questionId' => $questionId,
				'content' => serialize($arAnswer),
				'question_type' => 'TL'
			);
			$userAnswer->setData($rowAnswer);
			$userAnswer->save();
		}

		echo 1;
	}

	function saveQuestionAction()
	{

		$userId	=	pzk_session('userId');
		$lang = 'en';
		if (pzk_session('language')) {
			$lang = pzk_session('language');
		}


		if ($userId == 0) {

			echo "notuserid";

			return;
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

		$data_answers 		= $request->getanswers();

		$user_book_key	= $request->getKeybook();

		$question_id 	= $data_answers['questions'];
		$topicPost	= $request->getTopicPost();
		$subjectPost	= $request->getSubjectPost();

		$answers 		= array();

		if (isset($data_answers['answers'])) {

			$answers 		= $data_answers['answers'];
		}
		$exercise_number = 0;

		if (isset($data_answers['exercise_number'])) {

			$exercise_number	= $data_answers['exercise_number'];
		}

		$category_id = '';

		if (isset($data_answers['category_id'])) {

			$category_id	= $data_answers['category_id'];
		}

		$quantity_question	= count($data_answers['questions']);

		$userBook	= _db()->getEntity('Userbook.Userbook');

		$userAnswer	= _db()->getEntity('Userbook.Useranswer');

		if (isset($data_answers['start_time'])) {

			$start_time	= date('Y:m:d H:i:s', $data_answers['start_time']);
		} else {

			$start_time = '';
		}

		$stop_time 	= date('Y:m:d H:i:s', $_SERVER['REQUEST_TIME']);

		if (isset($data_answers['during_time'])) {
			$duringTime = $data_answers['during_time'];
		} else {
			$duringTime = 0;
		}


		//tong so cau dung
		$totaltrue = 0;
		$frontendmodel = pzk_model('Frontend');

		$dataAnswerTrue = $frontendmodel->getAllTrueAnswerByQuestionIds($question_id);
		$customAnswerTrue = array();
		foreach ($dataAnswerTrue as $val) {
			$customAnswerTrue[$val['question_id']] = trim($val['id']);
		}


		foreach ($question_id as $key => $value) {

			if (!empty($answers[$key])) {

				if (trim($answers[$key]) == $customAnswerTrue[$key]) {
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
			'software' 			=> pzk_request()->getSoftwareId(),
			'created'			=> date(DATEFORMAT, $_SERVER['REQUEST_TIME']),
			'duringTime'		=> $duringTime,
			'topic'				=> $topicPost,
			'lang'				=> $lang
		);
		$s_keybook	=	pzk_session('keybook');

		if (isset($s_keybook)) {

			$isKeyBook = $userBook->checkKeybook($s_keybook);

			$s = pzk_session();

			$s->del('keybook');

			if ($s_keybook == $user_book_key && !$isKeyBook) {

				$userBook->setData($row);

				$userBook->save();


				$userbookId = $userBook->getId();

				foreach ($question_id as $key => $value) {
					if (empty($answers[$key])) {
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
				if (pzk_session('language')) {
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

	public function userVoteAction()
	{
		$answerId = pzk_request()->getAnswer();
		$pollId = pzk_request()->getPollId();
		$ip = $_SERVER['REMOTE_ADDR'];
		$poll = _db()->getEntity('Cms.Poll.Result');
		$row = array(
			'pollId'    => $pollId,
			'answerId'  => $answerId,
			'userIp'	=> $ip,
			'site'		=> pzk_request()->getSiteId(),
			'software'	=> pzk_request()->getSoftwareId(),
			'created'			=> date(DATEFORMAT, $_SERVER['REQUEST_TIME']),

		);
		$poll->setData($row);
		$poll->save();
		echo 1;
	}

	public function filterDataByWeekAction()
	{
		$val = pzk_request()->getVal();
		$tam = explode('-', $val);
		$week = $tam[0];
		$year = $tam[1];
		pzk_session('weekHistory', $week);
		pzk_session('yearHistory', $year);
		$this->redirect('profile/detail');
	}
	public function filterAchievementByWeekAction()
	{
		$val = pzk_request()->getVal();
		$tam = explode('-', $val);
		$week = $tam[0];
		$year = $tam[1];
		pzk_session('weekAchievement', $week);
		pzk_session('yearAchievement', $year);
		$this->redirect('home/achievement');
	}
	public function resultAchievementByWeekAction()
	{
		$val = pzk_request()->getVal();
		$tam = explode('-', $val);
		$week = $tam[0];
		$year = $tam[1];
		pzk_session('resWeekAchievement', $week);
		pzk_session('resYearAchievement', $year);
		$this->redirect('profile/detail');
	}
	public function sortAchievementAction()
	{
		$val = pzk_request()->getVal();
		pzk_session('sortAchievement', $val);

		$this->redirect('home/achievement');
	}
	public function ajaxHistoryAction()
	{
		$practice = pzk_request()->getPractice();
		$idResult = pzk_request()->getIdResult();
		$page = pzk_request()->getPage();
		$userId = pzk_request()->getUserId();
		$startDate = pzk_request()->getStartDate();
		$endDate = pzk_request()->getEndDate();
		$pageSize = 20;
		$this->parse('history/testHistory');

		$testHistory = pzk_element('testHistory');
		$testHistory->setPractice($practice);
		$testHistory->setIdResult($idResult);
		$testHistory->setPage($page);
		$testHistory->setUserId($userId);
		$testHistory->setStartDate($startDate);
		$testHistory->setEndDate($endDate);
		$testHistory->setPageSize($pageSize);
		$testHistory->display();
	}
	public function ajaxPracticeAction()
	{
		$page = pzk_request()->getPage();
		$userId = pzk_request()->getUserId();
		$startDate = pzk_request()->getStartDate();
		$endDate = pzk_request()->getEndDate();
		$pageSize = 20;
		$this->parse('history/practiceHistory');

		$practiceHistory = pzk_element('practiceHistory');
		$practiceHistory->setPage($page);
		$practiceHistory->setUserId($userId);
		$practiceHistory->setStartDate($startDate);
		$practiceHistory->setEndDate($endDate);
		$practiceHistory->setPageSize($pageSize);
		$practiceHistory->display();
	}

	public function achievementAction()
	{
		$this->initPage();
		pzk_page()->setTitle('Trang hướng dẫn mua phần mềm Full Look');
		pzk_page()->setKeywords('Giáo dục');
		pzk_page()->setDescription('Hướng dẫn mua phần mềm Full Look');
		pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
		pzk_page()->setBrief('Phần mềm Full Look, Phần mềm luyện thi vào lớp 6 Trần Đại Nghĩa');
		$checkUser = pzk_session('checkUser');
		$servicePackage = pzk_session('servicePackage');
		if ($checkUser == 1 && $servicePackage == 'classroom') {
			$areacode = pzk_session('areacode');
			$district = pzk_session('district');
			$school = pzk_session('school');
			$class = pzk_session('class');
			$className = pzk_session('classname');
			$this->append('home/achievementclass');

			$achievementClass = pzk_element('achievementclass');

			$achievementClass->setAreacode($areacode);
			$achievementClass->setDistrict($district);
			$achievementClass->setSchool($school);
			$achievementClass->setClass($class);
			$achievementClass->setClassname($className);
		} else {
			$this->append('home/achievement');
		}

		$this->display();
	}
	public function getDistrictAction()
	{
		$provinceId = pzk_request()->getProvinceId();

		$this->parse('user/register/district');
		$district = pzk_element('pagDistrict');
		$district->setProvinceId($provinceId);
		$district->display();
	}
	public function getSchoolAction()
	{
		$districtId = pzk_request()->getDistrictId();
		$this->parse('user/register/school');
		$school = pzk_element('pagSchool');
		$school->setDistrictId($districtId);
		$school->display();
	}

	public function getDistrict2Action()
	{
		$provinceId = pzk_request()->getProvinceId();

		$this->parse('home/district');
		$district = pzk_element('district');
		$district->setProvinceId($provinceId);
		$district->display();
	}
	public function getSchool2Action()
	{
		$districtId = pzk_request()->getDistrictId();
		$this->parse('home/school');
		$school = pzk_element('school');
		$school->setDistrictId($districtId);
		$school->display();
	}

	public function changeServiceAction()
	{
		$serviceName = pzk_request()->getServiceName();
		$this->parse('user/register/service');
		$service = pzk_element('pagService');
		$service->setServiceName($serviceName);
		$service->display();
	}
	public function getRatingAction()
	{
		$provinceId = pzk_request()->getProvinceId();
		$districtId = pzk_request()->getDistrictId();
		$schoolId   = pzk_request()->getSchoolId();
		$classId    = pzk_request()->getClassId();
		$classname  = pzk_request()->getClassname();

		$classname  = strtolower($classname);
		$classname  = trim($classname);
		$rating  = "";
		pzk_session()->setProvinceId($provinceId);
		pzk_session()->setDistrictId($districtId);
		pzk_session()->setSchoolId($schoolId);
		pzk_session()->setClassId($classId);
		pzk_session()->setClassnameId($classname);

		if (pzk_session('provinceId')) {
			$rating .= " and areacode = '" . pzk_session('provinceId') . "'";
		}

		if (pzk_session('provinceId') && pzk_session('districtId')) {
			$rating .= " and district = '" . pzk_session('districtId') . "'";
		}
		if (pzk_session('provinceId') && pzk_session('districtId') && pzk_session('schoolId')) {
			$rating .= " and school = '" . pzk_session('schoolId') . "'";
		}
		if (pzk_session('provinceId') && pzk_session('districtId') && pzk_session('classId')) {
			$rating .= " and class = '" . pzk_session('classId') . "'";
		}
		if (pzk_session('provinceId') && pzk_session('districtId') && pzk_session('classnameId')) {
			$rating .= " and classname = '" . pzk_session('classnameId') . "'" . " and checkUser = '1'";
		}
		pzk_session()->setCondirating($rating);
		echo $rating;
	}

	public function getallRatingAction()
	{
		$s = pzk_session();
		$s->del('provinceId');
		$s->del('districtId');
		$s->del('schoolId');
		$s->del('classId');
		$s->del('classnameId');
		$s->del('condirating');
		echo '1';
	}
	public function setAreacodeAction()
	{
		$city = pzk_request()->getCity();
		$district = pzk_request()->getDistrict();
		$school   = pzk_request()->getSchool();
		$class    = pzk_request()->getClassId();
		$classname  = pzk_request()->getClassname();
		$classall = pzk_request()->getClassall();
		$classname  = strtolower($classname);
		$classname  = trim($classname);

		pzk_session()->setCityAchievement($city);
		pzk_session()->setDistrictAchievement($district);
		pzk_session()->setSchoolAchievement($school);
		pzk_session()->setClassAchievement($class);
		pzk_session()->setClassnameAchievement($classname);
		pzk_session()->setClassall($classall);

		$condition = '';
		if (pzk_session('cityAchievement') && pzk_session('cityAchievement') != 'all') {
			$condition .= " and areacode = '" . pzk_session('cityAchievement') . "'";
		} else {
			$condition = 'all';
		}

		if (pzk_session('districtAchievement') && pzk_session('districtAchievement') != 'all') {
			$condition .= " and district = '" . pzk_session('districtAchievement') . "'";
		}
		if (pzk_session('schoolAchievement') && pzk_session('schoolAchievement') != 'all') {
			$condition .= " and school = '" . pzk_session('schoolAchievement') . "'";
		}
		if (pzk_session('classAchievement') && pzk_session('classAchievement') != 'all') {
			$condition .= " and class = '" . pzk_session('classAchievement') . "'";
		}
		if (pzk_session('classnameAchievement') && pzk_session('classall') != 'all') {
			$condition .= " and classname = '" . pzk_session('classnameAchievement') . "'" . " and checkUser = '1'";
		}
		if ($condition != '' && $condition != 'all') {
			$condition = substr($condition, 4);
		}
		pzk_session()->setConditionAchievement($condition);
	}

	public function scienceAction()
	{
		$folders 			= _db()->query("select id, name, parent from categories where parents like '%,52,%' and status=1 and document=0 and classes like ',5,' order by parent asc");
		//debug($folders);

		$questions 		= 	_db()->select('id,categoryIds')->fromQuestions();
		$conds 			=	array('or');
		$folderMaps 	=	array();

		foreach ($folders as $folder) {
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
		foreach ($questions as $question) {
			$categoryIds	=	explode(',', trim($question['categoryIds'], ','));
			foreach ($categoryIds as $categoryId) {
				if (isset($folderMaps[$categoryId])) {
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

	function dangkiAction()
	{
		$name = pzk_request()->getName();
		$email   = pzk_request()->getEmail();
		$phone    = pzk_request()->getPhone();
		if ($name && $email && $phone) {
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
	function voteAction()
	{

		$content = pzk_request()->getContent();
		if ($content && pzk_session('userId')) {
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

	function emptyAction()
	{
		$collection = pzk_model('Entity.Collection.Questions');
		$collection->filterEnabled();
		$collection->filterCategoryId(288);
		$collection->isOrdering();
		$query = $collection->query();
		$result = $query->result();
		debug($result);
	}
	function saveSnAction()
	{
		if (pzk_request()) {
			$row = array(
				'userId' => pzk_request()->getUserId(),
				'content' => pzk_request()->getText(),
				'senderId' => pzk_request()->getUserchuc(),
				'created' => date(DATEFORMAT, $_SERVER['REQUEST_TIME'])
			);
			$frontendmodel = pzk_model('Frontend');
			$frontendmodel->save($row, 'user_birdth');
			echo 1;
		}
	}
}
