<?php
class PzkTransactionModel {
	function loadUsername($userId){
		$username = _db()->select('username')->fromUser()->whereId($userId)->result_one();
		return $username['username'];
	}
	//Trừ tiền vào tài khoản ví
	function payService1($userId,$service, $amount, $reason, $userbookId = NULL) {
		//$reason='trừ tiền gửi chấm điểm'
		//$service='Chấm điểm bài về từ'
		$datetime=date("Y-m-d H:i:s");
		$wallets=_db()->getEntity('User.Account.Wallets');
		$wallets->loadWhere(array('userId',$userId));
		if($wallets->get('id')){
			$wal_amount=$wallets->getAmount();
			if($amount < $wal_amount){
				$wal_amount= $wal_amount- $amount;
				$wallets->update(array('amount'=>$wal_amount));
				// Lưu vào transaction
				$transaction=_db()->getEntity('Payment.Transaction');
				$row_=array('userId'=>$userId,'paymentType'=>'wallets','amount'=>$amount,'paymentDate'=>$datetime,'reason'=>$reason,'service'=>$service,'userbookId'=>$userbookId,'status'=>1);		
				$transaction->setData($row_);			
				$transaction->save();
				return true;
			}else return false; // số tiền trong ví ko đủ để thực hiện
		}else{
			$username=$this->loadUsername($userId);
			$row=array('userId'=>$userId,'username'=>$username,'amount'=>0);				
			$wallets->setData($row);
			$wallets->save();
			return false;// số tiền ko đủ để thực hiện
		}
	}
	//Cộng tiền vào tài khoản Ví
	function payService2($userId,$service, $amount, $reason) {	
		//$reason='Cộng tiền chấm điểm'
		//$service='Chấm bài về từ'	
		$datetime=date("Y-m-d H:i:s");
		$wallets=_db()->getEntity('User.Account.WalletsAdmin');
		$wallets->loadWhere(array('userId',$userId));
		// User đã có ví
		if($wallets->get('id')){
			$wal_amount=$wallets->getAmount();			
			$wal_amount= $wal_amount+ $amount;
			$wallets->update(array('amount'=>$wal_amount));
			// Lưu vào order_transaction
			$transaction=_db()->getEntity('Payment.Transaction');
			$row_=array('userId'=>$userId,'paymentType'=>'wallets','amount'=>$amount,'paymentDate'=>$datetime,'reason'=>$reason,'service'=>$service,'status'=>1);		
			$transaction->setData($row_);			
			$transaction->save();
			return true;
		}else{
			// User chưa có ví
			$username=$this->loadUsername($userId);
			$row=array('userId'=>$userId,'username'=>$username,'amount'=>$amount);				
			$wallets->setData($row);
			$wallets->save();
			// Lưu vào order_transaction
			$transaction=_db()->getEntity('Payment.Transaction');
			$row_=array('userId'=>$userId,'paymentType'=>'wallets','amount'=>$amount,'paymentDate'=>$datetime,'reason'=>$reason,'service'=>$service,'status'=>1);		
			$transaction->setData($row_);			
			$transaction->save();
			return true;
		}
	}
	// Mua gói dịch vụ học
	function buyService($userId,$serviceId,$typePayment,$orderId=true){
// Cap nhat du lieu vao bang history_buyservice
		$buyService= _db()->getEntity('Service.Buyservice');
		$dateActive= date("y-m-d");
		$dateY= date('y', strtotime($dateActive));				
		$dateM= date('m', strtotime($dateActive));				
		$dateD= date('d', strtotime($dateActive));
		$dateY= intval($dateY)+1;
		$dateEnd= $dateY.'-'.$dateM.'-'.$dateD;
		//Kiểm tra xem là gói học hay gói chấm
		$service= _db()->getEntity('Service.Service');
		$service->loadWhere(array('id',$serviceId));
		if($service->get('id')){
			$serviceType= $service->getServiceType();
			// nếu là gói học
			if($serviceType=='goihoc'){				
				$row=array('userId'=>$userId,'serviceId'=>$serviceId,'typePayment'=>$typePayment,'dateActive'=>$dateActive,'dateEnd'=>$dateEnd,'orderId'=>$orderId,'status'=>1 );
			}
			// nếu là gói chấm
			if($serviceType=='goicham'){				
				$row=array('userId'=>$userId,'serviceId'=>$serviceId,'typePayment'=>$typePayment,'dateActive'=>$dateActive,'orderId'=>$orderId,'status'=>1 );
				//Cộng tiền vào tài khoản ví cho user
				$amountService= $service->getamount();
				$wallets=_db()->getEntity('User.Account.Wallets');
				$wallets->loadWhere(array('userId',$userId));
				if($wallets->get('id')){
					$wal_amount=$wallets->getAmount();			
					$wal_amount= $wal_amount+ $amountService;
					$wallets->update(array('amount'=>$wal_amount));
			
				}else{
					// User chưa có ví
					$username=$this->loadUsername($userId);
					$row_=array('userId'=>$userId,'username'=>$username,'amount'=>$amountService);				
					$wallets->setData($row_);
					$wallets->save();			
				}
			}
		}
		
		$buyService->setData($row);
		$buyService->save();		
	}
	//Chuyển trạng thái của order => chuyển trạng thái của buyservice and order_transaction
	function denyService($userId,$serviceId,$orderId,$newStatus){

		//Huỷ dịch vụ của user
		$buyservice= _db()->getEntity('Service.Buyservice');
		$buyservice->loadWhere(array('orderId',$orderId));
		$datetime= date("y-m-d");
		if($buyservice->get('id')){
			$buyservice->update(array('status'=>$newStatus,'modified'=>$datetime,'modifiedId'=>pzk_session('userId')));
		}
		// Nếu là gói chấm thì trừ tiền trong tài khoản của user
		$service= _db()->getEntity('Service.Service');
		$service->loadWhere(array('id',$serviceId));
		if($service->get('id')){
			$serviceType= $service->getServiceType();
			if($serviceType='goicham'){
				$amountService= $service->getAmount();
				$wallets=_db()->getEntity('User.Account.Wallets');
				$wallets->loadWhere(array('userId',$userId));
				if($wallets->get('id')){
					$wal_amount=$wallets->getAmount();			
					if($newStatus != 1){
						$wal_amount= $wal_amount- $amountService;
					}else if($newStatus == 1){
						$wal_amount= $wal_amount+ $amountService;
					}
					$wallets->update(array('amount'=>$wal_amount));
			
				}
			}
		}
		// Đổi trạng thái của order_transaction
		$transaction= _db()->getEntity('Payment.Transaction');
		$transaction->loadWhere(array('orderId',$orderId));
		if($transaction->get('id')){
			$transaction->update(array('status'=>$newStatus,'modified'=>$datetime,'modifiedId'=>pzk_session('userId')));
		}
		// Đổi trạng thái order_shipping 
		$shipping=_db()->getEntity('Service.Ordershipping');
		$shipping->loadWhere(array('orderId',$orderId));
		if($shipping->get('id')){
			$shipping->update(array('status'=>$newStatus));
		}
		// Đổi trạng thái order_item
		$orderItems=_db()->UseCB()->select('order_item.status')->from('order_item')->where(array('orderId',$orderId))->result('Service.Orderitem');
		foreach ($orderItems as $item) {
			$item->update(array('status'=>$newStatus));
		}
	}
	//Chuyển trạng thái của order khi không có serviceId, userId
	public function Change($orderId,$newStatus){
		// Đổi trạng thái của order_transaction
		$transaction= _db()->getEntity('Payment.Transaction');
		$transaction->loadWhere(array('orderId',$orderId));
		if($transaction->get('id')){
			$transaction->update(array('status'=>$newStatus,'modified'=>$datetime,'modifiedId'=>pzk_session('userId')));
		}
		// Đổi trạng thái order_shipping 
		$shipping=_db()->getEntity('Service.Ordershipping');
		$shipping->loadWhere(array('orderId',$orderId));
		if($shipping->get('id')){
			$shipping->update(array('status'=>$newStatus));
		}
		// Đổi trạng thái order_item
		$orderItems=_db()->UseCB()->select('order_item.*')->from('order_item')->where(array('orderId',$orderId))->result('Service.Orderitem');
		
		foreach ($orderItems as $item) {
			$item->update(array('status'=>$newStatus));
		}
	}
	// Chuyển trạng thái
	public function changeStatus($transactionEntity, $newStatus) {
		$transactionId=$transactionEntity->get('id');
		$amount=$transactionEntity->getAmount();
		$cardAmount=$transactionEntity->getcardAmount();
		$userId=$transactionEntity->getuserId();
		$username=$transactionEntity->getusername();
		if($cardAmount== 0){
			$amountService= $amount;
		}else $amountService=$cardAmount;
		// nạp tiền vào tài khoản cho user
                $wallets=_db()->getEntity('User.Account.Wallets');
                $wallets->loadWhere(array('userId',$userId));
                if($wallets->get('id')){
                    $wal_amount=$wallets->getAmount();          
                    if($newStatus== 1){
                        $wal_amount= $wal_amount + $amountService;
                    }else $wal_amount= $wal_amount - $amountService;
                    $wallets->update(array('amount'=>$wal_amount));      
                }else{
                    $row_=array('userId'=>$userId,'username'=>$username,'amount'=>$amountService);              
                    $wallets->setData($row_);
                    $wallets->save();
                }	         
	}
	
	function checkTransactionbyUserbookId( $userbookId = ""){
		
		if($userbookId !=""){
			
			$countTransaction = _db()->select(count('*'))->fromOrder_transaction()->whereUserbookId($userbookId)->result();
			
			if(count($countTransaction) >0){
				return true;
			}
		}
		return false;
		
	}
	public function PayNganLuong($service,$amount)
	{

	    require(BASE_DIR.'/3rdparty/nganluong/include/nganluong.microcheckout.class.php');
    	require(BASE_DIR.'/3rdparty/nganluong/include/lib/nusoap.php');
    	require(BASE_DIR.'/3rdparty/nganluong/config.php');
    	/*$inputs = array(
    					'receiver'    => RECEIVER,
    					'order_code'  => pzk_session('username').'/'.date("Y-m-d H:i:s"),
    					'return_url'  => BASE_URL.'/payment/confirmpayment',
    					'cancel_url'  => BASE_URL.'/payment/nganluong',
    					'language'    => 'vn'
    					);*/
		$inputs = array(
			'receiver'		=> RECEIVER,
			'order_code'	=> pzk_session('username'),
			'amount'		=> $amount,
			'currency_code'	=> 'vnd',
			'tax_amount'	=> '0',
			'discount_amount'	=> '0',
			'fee_shipping'	=> '0',
			'request_confirm_shipping'	=> '0',
			'no_shipping'	=> '1',
			'return_url'	=> BASE_URL.'/home/confirm',
			'cancel_url'	=> '',
			'language'		=> 'vi',
			'items'			=> array('service'=>$service)
		);
    	$link_checkout = '';
    	$obj = new NL_MicroCheckout(MERCHANT_ID, MERCHANT_PASS, URL_WS);
    	$result = $obj->setExpressCheckoutPayment($inputs);

    	if ($result != false) 
    	{	
      		if ($result['result_code'] == '00') 
      		{
        		$token_key = $result['token'];
        		$link_checkout = $result['link_checkout'];
        		$link_checkout = str_replace('micro_checkout.php?token=', 'index.php?portal=checkout&page=micro_checkout&token_code=', $link_checkout);
       			 $link_checkout .='&payment_option=nganluong';
        		return $link_checkout;

      		} 
      		else 
      		{
        		//die('Ma loi '.$result['result_code'].' ('.$result['result_description'].') ');
        		return $result['result_description'];
      		}
    	}
    	else
    	{
    		$error= 'Loi ket noi toi cong thanh toan ngan luong';
    		return $error;
    	}
 
	}
}
?>