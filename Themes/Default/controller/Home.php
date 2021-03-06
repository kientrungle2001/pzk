<?php
class PzkHomeController extends PzkController
{

	public $masterPage	=	"index";
	public $masterPosition = 'wrapper';

	public function indexAction()
	{
		$this->initPage();
		pzk_page()->setTitle('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
		pzk_page()->setKeywords('Giáo dục');
		pzk_page()->setDescription('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
		if (pzk_request()->getSiteId() == 2) {
			pzk_page()->setImg('/Themes/songngu3/skin/images/slider3.png');
		} else {
			pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
		}

		pzk_page()->setBrief('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
		$this->append('education/practice/practice', 'wrapper');
		$this->display();
	}
	public function registermobileAction()
	{
		$this->initPage();
		pzk_page()->setTitle('Trang hướng dẫn mua phần mềm Full Look');
		pzk_page()->setKeywords('Giáo dục');
		pzk_page()->setDescription('Hướng dẫn mua phần mềm Full Look');
		if (pzk_request()->getSiteId() == 2) {
			pzk_page()->setImg('/Themes/songngu3/skin/images/slider3.png');
		} else {
			pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
		}
		pzk_page()->setBrief('Phần mềm Full Look, Phần mềm luyện thi vào lớp 6 Trần Đại Nghĩa');
		$this->append('user/account/registermobile', 'wrapper')
			->display();
	}
	function updateexpiredAction()
	{
		$pay = _db()->getEntity('Payment.History_payment');
		$pay->updateExpriedDate();
	}
	function updateServiceTypeAction()
	{
		$querys = _db()->getEntity('Payment.History_payment');
		$querys->updateServiceType();
	}
	function insertPaymentTestAction()
	{
		$querys = _db()->getEntity('Payment.History_payment');
		$querys->insertPaymentTest();
	}
	function insertPaymentViewTestAction()
	{
		$viewtest = _db()->getEntity('Payment.History_payment');
		$viewtest->insertPaymentViewTest();
	}
	/*function updatePaymentViewTestAction(){
        $viewtest= _db()->getEntity('Payment.History_payment');
        $viewtest->updatePaymentViewTest();
    }*/
	function updatePaymentTypeMoneyAction()
	{
		$viewtest = _db()->getEntity('Payment.History_payment');
		$viewtest->updatePaymentTypeMoney();
	}
	function updatePaymentTypeBankAction()
	{
		$viewtest = _db()->getEntity('Payment.History_payment');
		$viewtest->updatePaymentTypeBank();
	}
	function CheckPaymentThithuAction()
	{
		$check = _db()->getEntity('Payment.History_payment');
		$check->CheckPaymentThithu();
	}
	public function pageAction()
	{
		$obj = $this->parse('home/index');
		$obj->setIsAjax(true);
		$obj->setPage(intval(pzk_request()->getPage()));
		$obj->display();
	}
	public function renderCodeFLAction()
	{

		$price = pzk_request()->getPrice();
		$languages = '';
		$time = pzk_request()->getTime();
		$class = 0;
		$softwareId = pzk_request()->getSoftwareId();
		$siteId = pzk_request()->getSiteId();
		$ettyCard = _db()->getEntity('Payment.Card_nextnobels');
		$serial = 110000;
		for ($i = 0; $i < 200; $i++) {
			$codeId = md5(microtime() . SECRETKEY . rand(100, 9999));
			$codeId = substr($codeId, 0, 8);
			$md5codeId = md5($codeId);
			$serial++;
			$row = array(
				'pincard_normal'	=> $codeId,
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
			$File = BASE_DIR . '/3rdparty/thecao/cardfl_tdn.csv';
			$Handle = fopen($File, 'a');
			$Data = $codeId . "," . $serial . " \r\n";
			fwrite($Handle, $Data);
			fclose($Handle);
		}
	}
	public function aboutAction()
	{
		$this->initPage();
		pzk_page()->setTitle('Trang hướng dẫn mua phần mềm Full Look');
		pzk_page()->setKeywords('Giáo dục');
		pzk_page()->setDescription('Hướng dẫn mua phần mềm Full Look');
		pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
		pzk_page()->setBrief('Phần mềm Full Look, Phần mềm luyện thi vào lớp 6 Trần Đại Nghĩa');
		$this->append('about', 'wrapper')
			->display();
	}
	public function ratingAction()
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
		if (pzk_themes('default')) {
			$this->append('education/question/showRating', 'wrapper');
		} else {
			$this->append('education/question/showRating', 'left');
		}
		$userBook	= pzk_model('Frontend');

		$showRating	= pzk_element('showRatings');

		$dataTest = $userBook->getAllTest(intval(pzk_request()->getPractice()));

		$showRating->setDataTest($dataTest);

		$this->display();
	}
	public function onchangeTestIdAction()
	{
		pzk_session('userBookTestId', intval(pzk_request()->getTestId()));
		$this->redirect('rating', array('practice' => intval(pzk_request()->getPractice())));
	}
	public function listTestAction()
	{
		$this->initPage();
		if (pzk_themes('default')) {
			$this->append('education/question/listTest', 'wrapper');
		} else {
			$this->append('education/question/listTest', 'left');
		}
		$this->display();
	}
	public function changePageSizeAction()
	{

		$userId = intval(pzk_request()->getUserId());
		if (!empty($userId)) {
			pzk_session('listPageSize', intval(pzk_request()->getPageSize()));
			$this->redirect('listTest/' . $userId);
		} else {
			pzk_session('ratingPageSize', intval(pzk_request()->getPageSize()));
			$this->redirect('rating');
		}
	}
	public function showtestnumberAction()
	{
		$this->parse('education/practice/showTestnumber');
		$class = intval(pzk_request()->getClass());
		$detail = pzk_element('testlist');
		$detail->addFilter('classes', $class, 'like');
		$detail->display();
	}

	public function showtesttlAction()
	{
		$this->parse('education/practice/showTestTl');
		$class = intval(pzk_request()->getClass());
		$detail = pzk_element('testtllist');
		$detail->addFilter('classes', $class, 'like');
		$detail->display();
	}

	public function showpracticenumberAction()
	{
		$this->parse('education/practice/showPracticenumber');
		$class = intval(pzk_request()->getClass());
		$detail = pzk_element('practicelist');
		$detail->addFilter('classes', $class, 'like');
		$detail->display();
	}

	public function checkIsLoggedInAction()
	{
		if (pzk_session('userId')) {
			echo '1';
		} else {
			echo '0';
		}
	}
	function saveQuestionAction()
	{

		$userId	=	pzk_session('userId');

		if ($userId == 0) {

			echo "notuserid";

			return;
		}
		$lang = 'en';
		if (pzk_session('language_tdn')) {
			$lang = pzk_session('language_tdn');
		}
		$request 			= pzk_request();

		$data_answers 		= $request->getanswers();

		$user_book_key	= $request->getKeybook();

		$question_id 	= $data_answers['questions'];


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
			'categoryId'		=> $category_id,
			'quantity_question'	=> $quantity_question,
			'startTime'			=> $start_time,
			'stopTime'			=> $stop_time,
			'keybook'			=> $user_book_key,
			'mark'              => $totaltrue,
			'exercise_number'   => $exercise_number,
			'software' 			=> pzk_request()->getSoftwareId(),
			'created'			=> date(DATEFORMAT, $_SERVER['REQUEST_TIME']),
			'duringTime'		=> $duringTime,
			'lang'				=> $lang
		);
		$s_keybook	=	pzk_session('keybook');
		//debug($row);pzk_system()->halt();

		if (isset($s_keybook)) {

			$isKeyBook = $userBook->checkKeybook($s_keybook);

			$s = pzk_session();

			$s->del('keybook');

			if ($s_keybook == $user_book_key && !$isKeyBook) {

				$userBook->setData($row);

				$userBook->save();

				//hight score


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

				echo 1;

				//echo base64_encode(encrypt($userbookId, SECRETKEY));
			}
		}
	}
	public function ajaxHistoryAction()
	{
		$practice = intval(pzk_request()->getPractice());
		$idResult = intval(pzk_request()->getIdResult());
		$page = intval(pzk_request()->getPage());
		$userId = intval(pzk_request()->getUserId());
		$pageSize = 20;
		$this->parse('history/testHistory');

		$testHistory = pzk_element('testHistory');
		$testHistory->setPractice($practice);
		$testHistory->setIdResult($idResult);
		$testHistory->setPage($page);
		$testHistory->setUserId($userId);
		$testHistory->setPageSize($pageSize);
		$testHistory->display();
	}
	public function ajaxPracticeAction()
	{
		$page = intval(pzk_request()->getPage());
		$userId = intval(pzk_request()->getUserId());
		$pageSize = 20;
		$this->parse('history/practiceHistory');

		$practiceHistory = pzk_element('practiceHistory');
		$practiceHistory->setPage($page);
		$practiceHistory->setUserId($userId);
		$practiceHistory->setPageSize($pageSize);
		$practiceHistory->display();
	}

	public function createUserAction()
	{
		for ($i = 1; $i < 101; $i++) {
			$password = substr(md5('flsn' . $i), 0, 8);
			$userData = array(
				'username' => 'flsn0' . $i,
				'name'	=> 'fl sn ' . $i,
				'password' => md5($password),
				'status'	=> 1
			);
			$user = _db()->getTableEntity('user');
			$user->setData($userData);
			$user->save();
			file_put_contents(BASE_DIR . '/create_user_2.txt', $userData['username'] . ':' . $password . "\r\n", FILE_APPEND);
			$history_payment = _db()->getTableEntity('history_payment');
			$history_payment->setData(array(
				'username' => 'flsn0' . $i,
				'status' => 1,
				'paymentStatus' => 1,
				'serviceType' => 'full',
				'software' => 1,
				'site' => 2,
				'paymentDate' => date('Y-m-d 00:00:00'),
				'expiredDate' => date('2018-07-14 00:00:00')
			));
			$history_payment->save();
		}
	}
}
