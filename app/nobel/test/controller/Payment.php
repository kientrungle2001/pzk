<?php 
class PzkPaymentController extends PzkController 
{
	public $masterPage='index';
	public $masterPosition='left';

	public function paymentAction()
	{
		$this->layout();
		$this->append('user/profile/profileuserleft1')->append('payment/payment','left');
		
		$this->display();
		//$this->render('user/payment/payment');		
	}
	public function bankAction()
	{
		$this->layout();
		$this->append('payment/bank','left');
		
		$this->display();
		//$this->render('user/payment/payment');		
	}
	public function bank2Action()
	{
		$this->layout();
		$this->append('payment/bank2','left');
		
		$this->display();
		//$this->render('user/payment/payment');		
	}
	public function paycardmobileAction()
	{
		$this->layout();
		$this->append('payment/paycardmobile','left');
		
		$this->display();
		//$this->render('user/payment/payment');		
	}
// Xử lý kết quả gạch thẻ cào 
	public function paycardPostAction()
	{
		require(BASE_DIR.'/3rdparty/thecao/includes/MobiCard.php');
    	$call = new MobiCard();
		$request=pzk_request();
		$type_card=$request->get('pm_typecard');
		$card_serial=$request->get('pm_txt_serialcard');
		$pin_card=$request->get('pm_txt_pincard');
		$ref_code= pzk_session('username').' '.date("Y-m-d H:i:s");

		$client_fullname=pzk_session('username');
		$client_mobile=date("Y-m-d H:i:s");
		$client_email="";
		$arr_result=$call->CardPay($pin_card,$card_serial,$type_card,$ref_code,$client_fullname,$client_mobile,$client_email);

			if($arr_result->error_code=='00')
			{
				// Nạp thẻ thành công

				$merchant_id=$arr_result->merchant_id;
				$merchant_account=$arr_result->merchant_account;
				$pin_card=$arr_result->pin_card;
				$card_serial=$arr_result->card_serial;
				$type_card=$arr_result->type_card;
				$order_id=$arr_result->order_id;
				$client_fullname=$arr_result->client_fullname;
				$client_email=$arr_result->client_email;
				$client_mobile=$arr_result->client_mobile;
				$card_amount=$arr_result->card_amount;
				$amount=$arr_result->amount;
				$transaction_id=$arr_result->transaction_id;
				// ghi log file
				$File = BASE_DIR.'/3rdparty/thecao/thecao_log.txt'; 
				$Handle = fopen($File, 'a');
				$Data = "Ma gia dich: ".$transaction_id." |username".$client_fullname."|thoi gian: ".$client_mobile. "|menh gia the: ".$amount." | type: ".$type_card." | serial: ".$card_serial." | ma the: ".$pin_card." ref_code: ".$ref_code."\n";
				fwrite($Handle, $Data); 
				fclose($Handle);
				// update database
			// insert table wallets
				$wallets=_db()->getEntity('user.account.wallets');
				$wallets->loadWhere(array('username',$client_fullname));
				if($wallets->get('id'))
				{
					$amount= $wallets->getAmount();
					$price= $card_amount+ $amount;
					$wallets->update(array('amount'=>$price));
				}
				else
				{
					$rowWallets = array('username' =>$client_fullname,'amount'=>$card_amount);
					$wallets->setData($rowWallets);
					$wallets->save();
				}
				echo "ok";
			}
			else
			{
				
				//Nạp thất bại
				$error_code=$arr_result->error_code;
				$error=$call->GetErrorMessage($error_code);
				echo $error;
				
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
			if ($result['result_code'] != '00')
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

				// Xử lý cập nhật database
				$datetime= date("Y-m-d H:i:s");
				$username=$order_code;
				$price=$amount;
			
				// Kiểm tra xem giao dịch đã tồn tại hay chưa
				$history_payment=_db()->getEntity('payment.history_payment');
				$history_payment->loadWhere(array('username',$username));
				if(!$history_payment->getTransactionid())
				{
	
					//insert table history_payment
					$row = array('username' =>$username,'amount'=>$price,'paymentType'=>$method_payment_name,'paymentDate'=>$datetime,'paymentoption'=>'nganluong','transaction'=>$transaction_id,'transactionstatus'=>$transaction_status);
					//$history_payment=_db()->getEntity('user.history_payment');
					$history_payment->setData($row);
					$history_payment->save();
					// insert table wallets
					$wallets=_db()->getEntity('user.account.wallets');
					$wallets->loadWhere(array('username',$username));
					if($wallets->get('id'))
					{
						$itme= $wallets->getAmount();
						$price= $price+ $wallets->getAmount();
						$wallets->update(array('amount'=>$price));
					}
					else
					{
						$rowWallets = array('username' =>$username,'amount'=>$price);
						$wallets->setData($rowWallets);
						$wallets->save();
					}
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
	
		pzk_notifier_add_message($error, 'danger');
		$payment = pzk_parse(pzk_app()->getPageUri('user/payment/confirmpayment'));
		$payment->setAmount($price);
		$payment->setMessage($message_nl);
		$this->layout();
		$this->append('user/profileuserleft1')->append($payment);
		$this->append('user/profileuser','right');
		$this->display();
		//$this->render($payment);	
	}
		public function PaymentNganLuongAction()
	{
		$nganluong= pzk_request('username');
		echo "ok".$nganluong;
	}
	public function PaymentNextNobelsAction()
	{
		$nextnobels_card= pzk_request('nextnobels_card');
		$nextnobels_serial= pzk_request('nextnobels_serial');
		$nextnobels_card=md5($nextnobels_card);
		$userActive=pzk_session('userId');
		$dateActive= date("y-m-d h:i:s");
		$card_nextnobels= _db()->getEntity('payment.card_nextnobels');
		$card_nextnobels->loadWhere(array('and',array('pincard',$nextnobels_card),array('serial',$nextnobels_serial)));
		

		if($card_nextnobels->get('id'))
		{
			if($card_nextnobels->get('status')==1){
				// Cap nhat du lieu
				$row=array('userActive'=>$userActive,'dateActive'=>$dateActive, 'status'=>0 );
				$card_nextnobels->update($row);
				echo 1;
			}else{
				echo 2;
			}
			
		}
		else echo 0;
	
		// Kiem tra du lieu
	}
}
 ?>