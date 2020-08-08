<?php
define('TRY_TEST', 'trytest/index');
define('Login','');
define('Payment','payment/cardmobile');
class PzkContestController extends PzkController{

	public $masterPage	=	"thitai/index";
	public $masterPosition = 'wrapper';
	public function indexAction() {
		$this->initPage();
		pzk_page()->set('title', 'Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
		pzk_page()->set('keywords', 'Giáo dục');
		pzk_page()->set('description', 'Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
		pzk_page()->set('img', '/Default/skin/nobel/Themes/Story/media/logo.png');
		pzk_page()->set('brief', 'Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
		$this->append('thitai/content', 'wrapper')->display();
        
		//$this->redirect(TRY_TEST);
		// da dang nhap tai khoan
		//$this->redirect('thitai/user');
		/*if(pzk_session('userId')){

			// da mua tai khoan
			$user= _db()->getEntity('payment.HistoryPaymentTest');
			if($user->CheckPaymentTest()){
				$this->redirect();
			}else{
				$this->redirect(Payment);
				// chua mua tai khoan
			}
		}else {
			// hien thi form dang ky dang nhap

		}*/
	}
	
	public function testAction(){
		$class = intval(pzk_request('class'));
		$type= intval(pzk_request('practice'));
		$check = pzk_user()->checkPayment('full');
    	$this->initPage();
    	$testId = intval(pzk_request()->getSegment(3));
		$catEntity = _db()->getTableEntity('tests')->load($testId);
			
		pzk_page()->set('title', $catEntity->get('name'));
		pzk_page()->set('keywords', $catEntity->get('name'));
		pzk_page()->set('description', $catEntity->get('name'));
		pzk_page()->set('img', $catEntity->get('img'));
		pzk_page()->set('brief', $catEntity->get('name'));
    	if(isset($check) && $check == 1) {
			$this->append('thitai/test');
    		$test = pzk_element()->getTest();
			$test->set('class', $class);
			$test->set('type', $type);
    		if($testId !== 0){
    			$testModel = pzk_model('Question');
    			$testDetail = $testModel->getTestById($testId);
    			$test->set('testDetail', $testDetail);
    		}else{
    			$test->set('testDetail', 0);
    		}
    	}else {
    		$keybook	= uniqid();
    		$s_keybook	=	pzk_session('keybook', $keybook);
			if(pzk_themes('default')) {
				$this->append('thitai/test');
			}else {
				$this->append('question/lessonTest');
			}
    	}
    	$this->display();
    }
	
	function showTestAction(){
    	$class = intval(pzk_request('class'));
		$type= intval(pzk_request('practice'));
    	if( pzk_request()->is('POST')){
	    	$testId = (int) pzk_request()->get('test');
	    	if(isset($testId)){
		    	$testModel = pzk_model('Question');
		    	$test_detail = $testModel->getTestById($testId);
		    	$this->initPage();
				$catEntity = _db()->getTableEntity('tests')->load($testId);
					
				pzk_page()->set('title', $catEntity->get('name'));
				pzk_page()->set('keywords', $catEntity->get('name'));
				pzk_page()->set('description', $catEntity->get('name'));
				pzk_page()->set('img', $catEntity->get('img'));
				pzk_page()->set('brief', $catEntity->get('name'));
		    	$keybook	= uniqid();		    	
		    	$s_keybook	=	pzk_session('keybook', $keybook);
		    	
				$this->append('thitai/showTest');
				
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
		    	$data_showQuestion->set('data_showQuestion', $result_search);		    	
		    	$data_showQuestion->set('data_criteria', $test_detail);		    	 
		    	$this->display();
	    	}
    	}
    }
	
	public function aboutAction(){
			$this->initPage();
			pzk_page()->set('title', 'trang hướng dẫn mua tài khoản thi thử');
			pzk_page()->set('keywords', 'Giáo dục');
			pzk_page()->set('description', 'hướng dẫn mua tài khoản thi thử');
			pzk_page()->set('img', '/Default/skin/nobel/Themes/Story/media/logo.png');
			pzk_page()->set('brief', 'Phần mềm Full Look, Phần mềm luyện thi vào lớp 6 Trần Đại Nghĩa');
			$this->append('thitai/about', 'wrapper')
			->display();
	}
	public function listuserAction(){
			$this->initPage();
			
			$this->append('thitai/listuser', 'wrapper')
			->display();
	}
	public function dotestAction(){
			$this->initPage();
			pzk_page()->set('title', 'trang hướng dẫn mua tài khoản thi thử');
			pzk_page()->set('keywords', 'Giáo dục');
			pzk_page()->set('description', 'hướng dẫn mua tài khoản thi thử');
			pzk_page()->set('img', '/Default/skin/nobel/Themes/Story/media/logo.png');
			pzk_page()->set('brief', 'Phần mềm Full Look, Phần mềm luyện thi vào lớp 6 Trần Đại Nghĩa');
			$this->append('thitai/dotest', 'wrapper')
			->display();
	}
	
	// Nap the cao thitai.vn
	public function cardmobileAction()
	{
		if(pzk_session('userId')) {
			$this->layout();
			pzk_page()->set('title', 'Thanh toán online qua thẻ cào điện thoại và ví điện tử');
			pzk_page()->set('keywords', 'Giáo dục');
			pzk_page()->set('description', 'Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
			pzk_page()->set('img', '/Default/skin/nobel/Themes/Story/media/logo.png');
			pzk_page()->set('brief', 'Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
			$this->append('payment/cardmobile');
			$this->display();	
		} else {
			$this->redirect('contest/index');
		}	
	}
	// Xử lý kết quả gạch thẻ cào thitai.vn
	public function cardPostAction()
	{
		$username= pzk_session('username');
		if(!$username){
			return false;
		}
		$request		=	pzk_request();
		$type_card		=	clean_value($request->get('pm_typecard'));
		$card_serial	=	clean_value($request->get('pm_txt_serialcard'));
		$pin_card		=	clean_value($request->get('pm_txt_pincard'));
		
		require(BASE_DIR.'/3rdparty/thecao/includes/MobiCard.php');
    	$call 			= 	new MobiCard();		
		$ref_code		= 	pzk_session('username');

		$client_fullname=	pzk_session('username');
		$client_mobile	=	date("Y-m-d H:i:s");
		$client_email	=	"";
		$arr_result		=	$call->CardPay($pin_card,$card_serial,$type_card,$ref_code,$client_fullname,$client_mobile,$client_email);
		
			if($arr_result->error_code == '00')
			{
				// Nạp thẻ thành công

				$merchant_id		=	$arr_result->merchant_id;
				$merchant_account	=	$arr_result->merchant_account;
				$pin_card			=	$arr_result->pin_card;
				$card_serial		=	$arr_result->card_serial;
				$type_card			=	$arr_result->type_card;
				$ordernl_id			=	$arr_result->order_id;
				$client_fullname	=	$arr_result->client_fullname;
				$client_email		=	$arr_result->client_email;
				$client_mobile		=	$arr_result->client_mobile;
				$card_amount		=	$arr_result->card_amount;
				$amount				=	$arr_result->amount;
				$transaction_id		=	$arr_result->transaction_id;
				// ghi log file
				$File 				= 	BASE_DIR.'/3rdparty/thecao/thitai_log.txt'; 
				$Handle 			= 	fopen($File, 'a');
				$Data 				= 	"Ma giao dich: ".$transaction_id." |username: ".$client_fullname."|thoi gian: ".$client_mobile. "|Tien nhan duoc: ".$amount."|menh gia the: ".$card_amount." | type: ".$type_card." | serial: ".$card_serial." | ma the: ".$pin_card."| order_id: ".$ordernl_id."| ref_code: ".$ref_code."\n";
				fwrite($Handle, $Data); 
				fclose($Handle);
				
				$transaction			=	_db()->getEntity('Payment.Cardmobile');
				$row_					=	array(
						'typecard'			=>	$type_card,
						'username'			=>	pzk_session('username'),
						'pincard'			=>	$pin_card,
						'serialcard'		=>	$card_serial,
						'amount'			=>	$amount,
						'cardAmount'		=>	$card_amount,
						'date'				=>	$client_mobile,
						'status'			=>	1
				);		
				$transaction->setData($row_);			
				$transaction->save();
				$order_transaction		=	_db()->getEntity('Payment.Transaction');
				$order_row				= array(
						'userId'			=> pzk_session('userId'),
						'paymentType'		=> 'paycard',
						'amount'			=> $amount,
						'paymentDate'		=> $client_mobile,
						'transactionStatus' => 1,
						'username'			=> pzk_session('username'),
						'cardType'			=> $type_card,
						'cardAmount'		=> $card_amount,
						'software'			=> 1,
						'status'			=> 1,
						'created'			=> date('Y-m-d H:i:s')
					);
				$order_transaction->setData($order_row);			
				$order_transaction->save();
			// insert table wallets
				$wallets =	_db()->getEntity('User.Account.Wallets');
				$wallets->loadWhere(array('username',$client_fullname));
				if($wallets->get('id'))
				{
					//$card_amount= 10000;
					$amountWall			= $wallets->get('amount');
					$price				= $card_amount+ $amountWall;
					$wallets->update(array('amount'=>$price));
				}
				else
				{
					$rowWallets 		= array(
						'userId'		=>	pzk_session('userId'),
						'username' 		=>	$client_fullname,
						'amount'		=>	$card_amount);
					$wallets->setData($rowWallets);
					$wallets->save();
					$price				= $card_amount;
				}
				echo product_price($card_amount).'/ok/'.product_price($price);
			}
			else
			{
				
				//Nạp thất bại
				$error_code				=	$arr_result->error_code;
				$error					=	$call->GetErrorMessage($error_code);
				echo $error.'/error/0';
				
			}
		
		
	}
	public function BuyTestAction()
	{
		$username= pzk_session('username');
		if(!$username){
			return false;
		}
		$serviceId	= 	intval(pzk_request('serviceId'));
		$service= _db()->getEntity('Service.Service');
		$service->load($serviceId);
		$price = $service->get('amount');
		$serviceType = $service->get('serviceType');
		$serviceName = $service->get('serviceName');
		$wallets		=	_db()->getEntity('User.Account.Wallets');
		$wallets->loadWhere(array('username',	pzk_session('username')));
		$amount			=	$wallets->get('amount');
		if($price <= $amount)
		{
			// cập nhật database
			$amount 			= 	$amount - $price;
			$wallets->update(array('amount' 	=> $amount));
			$test = 0;
			$viewTest = 0;
			if($serviceType=='thithu1' || $serviceType=='thithu-1'){
				$test = 1;
			}else if($serviceType=='thithu2' || $serviceType=='thithu-2'){
				$test = 2;
			}else if($serviceType=='thithu3' || $serviceType=='thithu-3'){
				$viewTest = 1;
			}else if($serviceType=='thithu4' || $serviceType=='thithu-4'){
				$viewTest = 2;
			} 
			if(pzk_request('app') == 'nobel_test') {
				
				//insert table history_view_test
				if($viewTest>0){
					$view				=	_db()->getEntity('Payment.Historypaymentviewtest');
					$view->setTable('history_view_test');
					$rowview 				=	array(
						'userId'		=>	pzk_session('userId'), 
						'paymentDate'	=>	date('Y-m-d 00:00:00'),
						'paymentStatus'	=> 1,
						'status'		=> 2,
						'test'			=> $viewTest,
						'amount'		=>	$price,
						'username'		=>	pzk_session('username'),
						
						'paymentOption'	=>	'wallets',
						'created'		=>	date('Y-m-d H:i:s'),
					);
					$view->setData($rowview);
					$view->save();
				}else{
					$insert				=	_db()->getEntity('table');
					$insert->setTable('history_payment_test');
					$row 				=	array(
						'userId'		=>	pzk_session('userId'), 
						'paymentDate'	=>	date('Y-m-d 00:00:00'),
						'paymentStatus'	=> 1,
						'status'		=> 2,
						'test'			=> $test,
						'amount'		=>	$price,
						'username'		=>	pzk_session('username'),
						
						'paymentOption'	=>	'wallets',
						'created'		=>	date('Y-m-d H:i:s'),
					);
					$insert->setData($row);
					$insert->save();
				}
				
				$order_transaction		=	_db()->getEntity('Payment.Transaction');
				$order_row				= array(
						'userId'			=> pzk_session('userId'),
						'paymentType'		=> 'wallets',
						'amount'			=> $price,
						'paymentDate'		=> date("Y-m-d H:i:s"),
						'transactionStatus' => 1,
						'username'			=> pzk_session('username'),
						'software'			=> 1,
						'status'			=> 1
					);
				$order_transaction->setData($order_row);			
				$order_transaction->save();
			}
			
			echo $serviceName.'/'.product_price($amount);

		}
		else echo 0;

	}
	public function ratingAction() {
        $this->initPage();
        $this->append('thitai/testrating', 'wrapper');
		$rank = pzk_element('testRating');
		$camp = intval(pzk_request()->get('camp'));
		
		$rank->set('camp', $camp);
		
		$frontend = pzk_model('Frontend');
		$contest = $frontend->getAll('contest');
		
		$dataContest = $frontend->getContestById($camp);
		$rank->set('dataContest', $dataContest);
		
		$rank->set('contest', $contest);
		
		if(pzk_session('ratingPageSize')){
			$rank->set('pageSize', pzk_session('ratingPageSize'));
		}else $rank->set('pageSize', 20);
		
		$this->display();
    }
    public function changePageSizeAction() {
        pzk_session('ratingPageSize', intval(pzk_request('pageSize')));
		$camp = intval(pzk_request('camp'));
        //pzk_session('camp', pzk_request('camp'));
        $this->redirect('rating?camp='.$camp);
    }
	public function newsAction() {
        $this->initPage();
		
		$newsId = intval(pzk_request('id'));
		
		if(!$newsId) $newsId = intval(pzk_request()->getSegment(3));
		
		pzk_request()->set('id', $newsId);
		
		$newsEntity = _db()->getTableEntity('news')->load($newsId, 1800);
		
		pzk_page()->set('title', $newsEntity->get('title'));
		pzk_page()->set('keywords', $newsEntity->get('meta_keywords'));
		pzk_page()->set('description', $newsEntity->get('meta_description'));
		pzk_page()->set('img', $newsEntity->get('img'));
		pzk_page()->set('brief', $newsEntity->get('brief'));
		
		$news = $this->parse('cms/news/chitiet');
		$detail = pzk_element()->getDetail();
		
		if($detail) {
			$detail->set('itemId', $newsId);
			//$detail->statVisitor();
			$this->append($news);
		}
		
		$this->display();
    }
	public function onthiAction(){
		$this->initPage()
		->append('thitai/onthi');
		pzk_page()->set('title', 'Kinh nghiệm ôn thi');
		pzk_page()->set('keywords', 'Kinh nghiệm ôn thi');
		pzk_page()->set('description', 'Các kinh nghiệm giúp học sinh ôn tập các môn học bằng tiếng Anh');
		pzk_page()->set('img', BASE_URL . '/Default/skin/nobel/Themes/Story/media/logo.png');
		pzk_page()->set('brief', 'Các kinh nghiệm giúp học sinh ôn tập các môn học bằng tiếng Anh');
		$this->display();
	}
	
	public function profileAction()	{	
		$this->initPage();
		pzk_page()->set('title', 'Trang cá nhân');
		pzk_page()->set('keywords', 'Giáo dục');
		pzk_page()->set('description', 'Trang cá nhân thành viên');
		pzk_page()->set('img', '/Default/skin/nobel/Themes/Story/media/logo.png');
		pzk_page()->set('brief', 'Phần mềm Full Look, Phần mềm luyện thi vào lớp 6 Trần Đại Nghĩa');
		$this ->append('thitai/profile')
		->display();
	}
	
	public function dsthiAction()	{	
		$this->initPage();
		pzk_page()->set('title', 'Trang cá nhân');
		pzk_page()->set('keywords', 'Giáo dục');
		pzk_page()->set('description', 'Trang cá nhân thành viên');
		pzk_page()->set('img', '/Default/skin/nobel/Themes/Story/media/logo.png');
		pzk_page()->set('brief', 'Phần mềm Full Look, Phần mềm luyện thi vào lớp 6 Trần Đại Nghĩa');
		$this ->append('thitai/dsthi')
		->display();
	}
	public function getUserTestAction() {
		$dataUserTestReal = _db()->select('userId')->from('user_book')->whereTrytest(2)->whereCamp(1)->result();
		$arrIds = array();
		foreach($dataUserTestReal as $val) {
			$arrIds[] = $val['userId'];
		}
		
		$arrNotIN =  implode($arrIds, ',');
		
		$sql = "
		select history_payment_test.*, user.id as userId, user.name, user.phone, user.email, group_concat(test) as tests 
		from `history_payment_test` 
		inner join user 
		on history_payment_test.username	= user.username 
		where 1 AND (1) 
		and userId NOT IN($arrNotIN)
		group by history_payment_test.username 
		order by user.username asc 
		limit 0, 1000";
		
		$dataUserTestList = _db()->query($sql);
		
		$this->initPage();
				pzk_page()->set('title', 'Bắt đầu thi thử trường Trần Đại Nghĩa');
				pzk_page()->set('keywords', 'Bắt đầu thi thử trường Trần Đại Nghĩa');
				pzk_page()->set('description', 'Bắt đầu thi thử vao trường Trần Đại nghĩa với phần mềm Full Look');
				pzk_page()->set('img', '/Default/skin/nobel/Themes/Story/media/logo.png');
				pzk_page()->set('brief', 'Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
				$this->append('thitai/dschuathi', 'wrapper');
				$dschuathi = pzk_element('dschuathi');
				
				$dschuathi->set('users', $dataUserTestList);
			$this->display();
		
	}
}