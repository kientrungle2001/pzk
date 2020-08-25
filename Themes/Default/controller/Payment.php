<?php 
class PzkPaymentController extends PzkController 
{
	public $masterPage		=	'index';
	public $masterPosition	=	'wrapper';

	public function paymentAction()
	{
		$this->layout();
		$this->append('payment/left')->append('payment/payment','left');
		$this->display();
		//$this->render('user/payment/payment');		
	}
	
	public function nganluongAction()
	{
		//$scriptable=false;
		
		$this->layout();
		$this->append('payment/nganluong','left');
		$this->pzk_element('paynganluong');
		$modelNL=  pzk_model('Transaction');
		$nganluongUrl= $modelNL->PayNganLuong();
		
		$this->setUrlNL($nganluongUrl);
		$this->display();	
	}
	public function officeAction()
	{
		$this->layout();
		$this->append('payment/left')->append('payment/office','left');
		$this->display();	
	}
	public function bankAction()
	{
		$this->layout();
		$this->append('ecommerce/payment/bank','left');
		$this->display();
	}
	public function moneyAction()
	{
		$this->layout();
		$this->append('ecommerce/payment/money','left');
		$this->display();
	}
	public function paycardAction()
	{
		$this->layout();
		$this->append('ecommerce/payment/paycard','left');
		$this->display();
	}
	public function paycardflsnAction()
	{
		$this->layout();
		$this->append('ecommerce/payment/paycardflsn','left');
		$this->display();
	}
	public function paycardflAction()
	{
		$this->layout();
		$this->append('ecommerce/payment/paycardfl','left');
		$this->display();
	}
	public function cardflPostAction()
	{
		$flcardId= clean_value(pzk_request('flcardId'));		
		$flcardId= trim($flcardId);
		$flcardId=md5($flcardId);
		if(pzk_session('userId') ==''){
			return false;
		}
		$userActive=pzk_session('userId');
		$dateActive= date("Y-m-d H:i:s");
		$serviceCardModel= pzk_model('Service.Card.Activate');
		echo $serviceCardModel->checkCard($flcardId);
	}
	
	public function paycardmobileAction()
	{
		if(pzk_session('userId')) {
			$this->layout();
			pzk_page()->setTitle('Thanh toán online qua thẻ cào điện thoại và ví điện tử');
			pzk_page()->setKeywords('Giáo dục');
			pzk_page()->setDescription('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
			pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
			pzk_page()->setBrief('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
			$this->append('ecommerce/payment/paycardmobile');
			$this->display();	
		} else {
			$this->redirect('home/index');
		}
		
		//$this->render('user/payment/payment');		
	}
// Xử lý kết quả gạch thẻ cào 
	public function paycardPostAction()
	{
		$request		=	pzk_request();
		$type_card		=	clean_value($request->getPm_typecard());
		$card_serial	=	clean_value($request->getPm_txt_serialcard());
		$pin_card		=	clean_value($request->getPm_txt_pincard());
		if($type_card=='' || $card_serial=='' || $pin_card==''){
			return false;
		}

		require(BASE_DIR.'/3rdparty/thecao/includes/MobiCard.php');
    	$call 			= 	new MobiCard();		
		$ref_code		= 	pzk_session('username');

		$client_fullname=	pzk_session('username');
		$client_mobile	=	date("Y-m-d h:i:s");
		$client_email	=	"";
		$arr_result		=	$call->CardPay($pin_card,$card_serial,$type_card,$ref_code,$client_fullname,$client_mobile,$client_email);
		
			if($arr_result->error_code === '00')
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
				$card_amount		=	pzk_or($arr_result->card_amount, 0);
				$amount				=	pzk_or($arr_result->amount, 0);
				$transaction_id		=	$arr_result->transaction_id;
				// ghi log file
				$File 				= 	BASE_DIR.'/3rdparty/thecao/thecao_log.txt'; 
				$Handle 			= 	fopen($File, 'a');
				$Data 				= 	"Ma giao dich: ".$transaction_id." |username: ".$client_fullname."|thoi gian: ".$client_mobile. "|Tien nhan duoc: ".$amount."|menh gia the: ".$card_amount." | type: ".$type_card." | serial: ".$card_serial." | ma the: ".$pin_card."| order_id: ".$ordernl_id."| ref_code: ".$ref_code."\r\n";
				fwrite($Handle, $Data); 
				fclose($Handle);
				// update database
				/*$hisPayment=_db()->getEntity('payment.HistoryPayMobile');
				$hisRow= array('userId'=>pzk_session('userId'),'username' =>$client_fullname,'amount'=>$amount,'timeActive'=>$client_mobile,'orderId'=>$ordernl_id,'refCode'=>$ref_code,'typeCard'=>$type_card,'serialCard'=>$card_serial,'pinCard'=>$pin_card,'cardAmount'=>$card_amount);
				$hisPayment->setData($hisRow);
				$hisPayment->save();*/
				//isert table order
				/*$history_payment=_db()->getEntity('service.order');
				//$hisRow= array('userId'=>pzk_session('userId'),'username' =>$client_fullname,'amount'=>$amount,'timeActive'=>$client_mobile,'orderId'=>$ordernl_id,'refCode'=>$ref_code,'typeCard'=>$type_card,'serialCard'=>$card_serial,'pinCard'=>$pin_card,'cardAmount'=>$card_amount);
				$row=array('userId'=>pzk_session('userId'),'username'=>$client_fullname,'software'=>'3','amount'=>$card_amount,'dateOrder'=>$client_mobile,'paymentType'=>'thecaodienthoai','status'=>1);				
				$history_payment->setData($row);
				$history_payment->save();*/
				//isert table order_transaction
				//$orderId= $history_payment->getId();
				$transaction			=	_db()->getEntity('Payment.Transaction');
				$row_					=	array(
						'userId'			=>	pzk_session('userId'),
						'paymentType'		=>	'thecaodienthoai',
						'cardType'			=>	$type_card,
						'amount'			=>	$amount,
						'cardAmount'		=>	$card_amount,
						'paymentDate'		=>	$client_mobile,
						'transactionStatus'	=>	1,
						'transactionId'		=>	$transaction_id,
						'reason'			=>	$client_fullname.'/'.$type_card.'/'.$card_serial.'/'.$pin_card,
						'status'			=>	1,
						'software'			=>	pzk_request('softwareId')
				);		
				$transaction->setData($row_);			
				$transaction->save();
			// insert table wallets
				$wallets				=	_db()->getEntity('User.Account.Wallets');
				$wallets->loadWhere(array('username',$client_fullname));
				if($wallets->getId())
				{
					//$card_amount= 10000;
					$amountWall			= $wallets->getamount();
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
				}
				// insert table new_message
				/*$mess					=	array(
					'userId'			=>	pzk_session('userId'),
					'messageType'		=>	'deposit',
					'amount'			=>	$card_amount,
					'date'				=>	date("Y-m-d H:i:s"),
					'status'			=>	0
				);
				$message				=	_db()->getEntity('User.NewMessage');
				$message->create($mess);*/
				//echo "ok";
				echo $card_amount.'/ok/'.product_price($price);
				
			}
			else
			{
				
				//Nạp thất bại
				$error_code				=	$arr_result->error_code;
				$error					=	$call->GetErrorMessage($error_code);
				echo $error.'/error/0';
				
			}
		
		
	}
// the cao fullook-songngu
public function cardPostAction()
	{
		$username= pzk_session('username');
		if(!$username){
			return false;
		}
		$request		=	pzk_request();
		$type_card		=	clean_value($request->getPm_typecard());
		$card_serial	=	clean_value($request->getPm_txt_serialcard());
		$pin_card		=	clean_value($request->getPm_txt_pincard());
		
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
				if($wallets->getId())
				{
					//$card_amount= 10000;
					$amountWall			= $wallets->getamount();
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

// Nhận kết quả trả về từ Popup Ngân Lượng
	public function confirmpaymentAction()
	{
		$message_nl=0;
		$price=0;
		$error="";
		// Nạp tiền bằng popup Ngân Lượng
		require(BASE_DIR.'/3rdparty/nganluong/include/nganluong.microcheckout.class.php');
    	require(BASE_DIR.'/3rdparty/nganluong/include/lib/nusoap.php');
   	 	require(BASE_DIR.'/3rdparty/nganluong/config.php');
		
   	 	$obj = new NL_MicroCheckout(MERCHANT_ID, MERCHANT_PASS, URL_WS);

		if ($obj->checkReturnUrlAuto()) {

			$inputs = array(
							'token'	=> $obj->getTokenCode(),//$token_code,
							);
			$result = $obj->getExpressCheckout($inputs);
			
			if ($result != false) 
			{
				if ($result['result_code'] != '00') 
				{
					$error='Mã lỗi '.$result['result_code'].$result['result_description'];
				}
			} else 
			{
				$error='Lỗi kết nối tới cổng thanh toán Ngân Lượng';
			}
		} else 
		{
				$error='Tham số truyền không đúng';
	  	}
	  	// kết quả trả về từ Ngân Lượng là đúng
	  	if (isset($result) && !empty($result)) 
	  	{
			if ($result['result_code'] == '00')
			{				
				// mã hóa đơn
				$order_code=@$_GET['order_code'];
				// mã giao dịch phát sinh tại Ngân Lượng
				$transaction_id= $result['transaction_id'];
				// Loại giao dịch '1. Thanh toán ngay' : '2. Thanh toán tạm giữ'
				$transaction_type=$result['transaction_type'];
				// Trạng thái
				$transaction_status=$result['transaction_status'];
				// Số tiền thanh toán 
				$amount= $result['amount'];
				// Hình thức thanh toán ( qua ví NL, thẻ cào, ngân hàng)
				$method_payment_name=$result['method_payment_name'];
				// Tên người thanh toán 
				$payer_name=$result['payer_name'];
				// Email
				$payer_email=$result['payer_email'];
				// Điện thoại
				$payer_mobile=$result['payer_mobile'];
				// Loại thẻ
				$card_type=$result['card_type'];
				// Mệnh giá thẻ nạp
				$card_amount=$result['card_amount'];
				// Tên người nhận tiền
				$receiver_name=$result['receiver_name'];
				// Số điện thoại người nhận tiền
				$receiver_mobile=$result['receiver_mobile'];
				$order_code1=explode("/",$order_code);
				$username=$order_code1[0];
				$datePay= $order_code1[1];
				// ghi log file
				$File = BASE_DIR.'/3rdparty/nganluong/nganluong_log.txt'; 
				$Handle = fopen($File, 'a');
				$Data = "mã hóa đơn: ".$order_code."username: ".$username."Time: ".$datePay." |mã giao dịch: ".$transaction_id."|transaction_type: ".$transaction_type. "|Tien nhan duoc: ".$amount."|transaction_status: ".$transaction_status." | method_payment_name: ".$method_payment_name." | payer_name: ".$payer_name." | payer_mobile: ".$payer_mobile."| card_type: ".$card_type."| card_amount: ".$card_amount."\n";
				fwrite($Handle, $Data); 
				fclose($Handle);
				// Xử lý cập nhật database
				$datetime= date("Y-m-d H:i:s");
				$price=$amount;
				if($card_amount !=''){
					$price=$card_amount;
				}			
				// Kiểm tra xem giao dịch đã tồn tại hay chưa trong banng order_transaction
				$transaction=_db()->getEntity('Payment.Transaction');
				$transaction->loadWhere(array('and',array('username',$username),array('paymentDate',$datePay)));
				if(!$transaction->getId())
				{
					$row_=array('userId'=>pzk_session('userId'),'username'=>$username,'paymentType'=>'nganluong','amount'=>$amount,'paymentDate'=>$datePay,'status'=>1,'transactionId'=>$transaction_id,'paymentOption'=>$method_payment_name,'transactionStatus'=>1,'reason'=>'naptien_nganluong','cardType'=>$card_type,'cardAmount'=>$card_amount);		
					$transaction->setData($row_);			
					$transaction->save();
					$wallets=_db()->getEntity('User.Account.Wallets');
					$wallets->loadWhere(array('username',$username));
					if($wallets->getId())
					{
						$itme= $wallets->getamount();
						$price= $price+ $wallets->getamount();
						$wallets->update(array('amount'=>$price));
					}
					else
					{
						$rowWallets = array('userId'=>pzk_session('userId'),'username' =>$username,'amount'=>$price);
						$wallets->setData($rowWallets);
						$wallets->save();
					}
					// insert table new_message
					$mess=array('userId'=>pzk_session('userId'),'messageType'=>'deposit','amount'=>$result['amount'],'date'=>date("Y-m-d H:i:s"),'status'=>0);
					$message=_db()->getEntity('User.NewMessage');
					$message->create($mess);
					$message_nl=1;
				}
				else
				{
					$message_nl=2;
				}
			}
			else
			{
				$error='Mã lỗi '.$result['result_code'].$result['result_description'];
			}
		}
	
		//pzk_notifier_add_message($error, 'danger');
		$payment = pzk_parse(pzk_app()->getPageUri('/payment/confirmpayment'));
		$payment->setAmount($price);
		$payment->setMessage($message_nl);
		$this->layout();
		$this->append('payment/left')->append($payment);		
		$this->display();
	}
	public function PaymentNganLuongAction()
	{
		$nganluong= clean_value(pzk_request('username'));
		echo "ok".$nganluong;
	}
	public function PaymentNextNobelsAction()
	{
		$nextnobels_card= clean_value(pzk_request('nextnobels_card'));
		$nextnobels_serial= clean_value(pzk_request('nextnobels_serial'));
		$nextnobels_card= trim($nextnobels_card);
		$nextnobels_card=md5($nextnobels_card);
		$userActive=pzk_session('userId');
		$dateActive= date("Y-m-d h:i:s");
		$card_nextnobels= _db()->getEntity('Payment.Card_nextnobels');
		$card_nextnobels->loadWhere(array('and',array('pincard',$nextnobels_card),array('serial',$nextnobels_serial)));
		if($card_nextnobels->getId())
		{
			if($card_nextnobels->getStatus()==1){
				// Cap nhat du lieu
				$serviceId=$card_nextnobels->getServiceId();
				$row=array('userActive'=>$userActive,'dateActive'=>$dateActive, 'status'=>0 );
				$card_nextnobels->update($row);
				// ghi log file
				$File = BASE_DIR.'/3rdparty/thecao/theNextnobels.txt'; 
				$Handle = fopen($File, 'a');
				$Data = "UserId: ".$userActive." |username: ".pzk_session('username')." |serviceId : ".$serviceId."|thoi gian: ".$dateActive. "|Ma the: ".pzk_request('nextnobels_card')."|Serial: ".$nextnobels_serial."\n";
				fwrite($Handle, $Data); 
				fclose($Handle);
				//Cập nhật bảng history_service				
				$model = pzk_model('Transaction');
				$model->buyService($userActive,$serviceId,'naptheNextnobels');
				// insert table new_message
				$serviceId=$card_nextnobels->getServiceId();
				$mess=array('userId'=>pzk_session('userId'),'messageType'=>'paycardNextnobels','serviceId'=>$serviceId,'date'=>date("Y-m-d H:i:s"),'status'=>0);
				$message=_db()->getEntity('User.NewMessage');
				$message->create($mess);
				echo 1;
			}else{
				echo 2;
			}
		}
		else echo 0;
	}
}
 ?>