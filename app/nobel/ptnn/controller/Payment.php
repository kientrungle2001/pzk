<?php 
class PzkPaymentController extends PzkFrontendController 
{
	public $masterPage='index';
	public $masterPosition='left';

	public function paymentAction()
	{
		$this->layout();
		$this->append('payment/left')->append('payment/payment','left');
		$this->display();
		//$this->render('user/payment/payment');		
	}
	public function nganluongAction()
	{
		$scriptable=false;
		$this->layout();
		$this->append('payment/left')->append('payment/nganluong','left');
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
		$this->append('payment/bank','left');
		$this->display();
	}
	public function paycardmobileAction()
	{
		$this->layout();
		$this->append('payment/left')->append('payment/paycardmobile','left');
		$this->display();
		//$this->render('user/payment/payment');		
	}
// Xử lý kết quả gạch thẻ cào 
	public function paycardPostAction()
	{
		$request=pzk_request();
		$type_card=$request->get('pm_typecard');
		$card_serial=$request->get('pm_txt_serialcard');
		$pin_card=$request->get('pm_txt_pincard');
		if($type_card=='' || $card_serial=='' || $pin_card==''){
			return false;
		}
		require(BASE_DIR.'/3rdparty/thecao/includes/MobiCard.php');
    	$call = new MobiCard();		
		$ref_code= pzk_session('username');

		$client_fullname=pzk_session('username');
		$client_mobile=date("Y-m-d h:i:s");
		$client_email="";
		$arr_result=$call->CardPay($pin_card,$card_serial,$type_card,$ref_code,$client_fullname,$client_mobile,$client_email);
		
			if($arr_result->error_code =='00')
			{
				// Nạp thẻ thành công

				$merchant_id=$arr_result->merchant_id;
				$merchant_account=$arr_result->merchant_account;
				$pin_card=$arr_result->pin_card;
				$card_serial=$arr_result->card_serial;
				$type_card=$arr_result->type_card;
				$ordernl_id=$arr_result->order_id;
				$client_fullname=$arr_result->client_fullname;
				$client_email=$arr_result->client_email;
				$client_mobile=$arr_result->client_mobile;
				$card_amount=$arr_result->card_amount;
				$amount=$arr_result->amount;
				$transaction_id=$arr_result->transaction_id;
				// ghi log file
				$File = BASE_DIR.'/3rdparty/thecao/thecao_log.txt'; 
				$Handle = fopen($File, 'a');
				$Data = "Ma giao dich: ".$transaction_id." |username: ".$client_fullname."|thoi gian: ".$client_mobile. "|Tien nhan duoc: ".$amount."|menh gia the: ".$card_amount." | type: ".$type_card." | serial: ".$card_serial." | ma the: ".$pin_card."| order_id: ".$ordernl_id."| ref_code: ".$ref_code."\n";
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
				//$orderId= $history_payment->get('id');
				$transaction=_db()->getEntity('payment.transaction');
				$row_=array('userId'=>pzk_session('userId'),'paymentType'=>'thecaodienthoai','cardType'=>$type_card,'amount'=>$amount,'cardAmount'=>$card_amount,'paymentDate'=>$client_mobile,'transactionStatus'=>1,'transactionId'=>$transaction_id,'reason'=>$client_fullname.'/'.$type_card.'/'.$card_serial.'/'.$pin_card,'status'=>1);		
				$transaction->setData($row_);			
				$transaction->save();
			// insert table wallets
				$wallets=_db()->getEntity('user.account.wallets');
				$wallets->loadWhere(array('username',$client_fullname));
				if($wallets->get('id'))
				{
					//$card_amount= 10000;
					$amountWall= $wallets->getAmount();
					$price= $card_amount+ $amountWall;
					$wallets->update(array('amount'=>$price));
				}
				else
				{
					$rowWallets = array('userId'=>pzk_session('userId'),'username' =>$client_fullname,'amount'=>$card_amount);
					$wallets->setData($rowWallets);
					$wallets->save();
				}
				// insert table new_message
				$mess=array('userId'=>pzk_session('userId'),'messageType'=>'deposit','amount'=>$card_amount,'date'=>date("Y-m-d H:i:s"),'status'=>0);
				$message=_db()->getEntity('user.NewMessage');
				$message->create($mess);
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
				$transaction=_db()->getEntity('payment.transaction');
				$transaction->loadWhere(array('and',array('username',$username),array('paymentDate',$datePay)));
				if(!$transaction->get('id'))
				{
					$row_=array('userId'=>pzk_session('userId'),'username'=>$username,'paymentType'=>'nganluong','amount'=>$amount,'paymentDate'=>$datePay,'status'=>1,'transactionId'=>$transaction_id,'paymentOption'=>$method_payment_name,'transactionStatus'=>1,'reason'=>'naptien_nganluong','cardType'=>$card_type,'cardAmount'=>$card_amount);		
					$transaction->setData($row_);			
					$transaction->save();
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
						$rowWallets = array('userId'=>pzk_session('userId'),'username' =>$username,'amount'=>$price);
						$wallets->setData($rowWallets);
						$wallets->save();
					}
					// insert table new_message
					$mess=array('userId'=>pzk_session('userId'),'messageType'=>'deposit','amount'=>$result['amount'],'date'=>date("Y-m-d H:i:s"),'status'=>0);
					$message=_db()->getEntity('user.NewMessage');
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
		$nganluong= pzk_request('username');
		echo "ok".$nganluong;
	}
	public function PaymentNextNobelsAction()
	{
		$nextnobels_card= pzk_request('nextnobels_card');
		$nextnobels_serial= pzk_request('nextnobels_serial');
		$nextnobels_card= trim($nextnobels_card);
		$nextnobels_card=md5($nextnobels_card);
		$userActive=pzk_session('userId');
		$dateActive= date("y-m-d h:i:s");
		$card_nextnobels= _db()->getEntity('payment.card_nextnobels');
		$card_nextnobels->loadWhere(array('and',array('pincard',$nextnobels_card),array('serial',$nextnobels_serial)));
		if($card_nextnobels->get('id'))
		{
			if($card_nextnobels->get('status')==1){
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
				$message=_db()->getEntity('user.NewMessage');
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