<?php 
class PzkServiceController extends PzkController 
{
	public $masterPage		=	'index';
	public $masterPosition	=	'wrapper';


	public function serviceAction() 
	{
		$this->layout();
		$this->append('ecommerce/service/service');
		$this->display();
	
	}
	public function orderAction() 
	{
		$this->layout();
		if(pzk_request('softwareId') == 1 && pzk_request('siteId') == 1 ){
			$this->append('ecommerce/service/ordercard');
		}else $this->append('ecommerce/service/ordercardsn');
		$this->display();
	}
	public function servicetestAction() 
	{
		$this->layout();
		$this->append('ecommerce/service/servicetest');
		$this->display();
	
	}
	public function BuyServiceAction()
	{

		$username= pzk_session('username');
		if(!$username){
			return false;
		}
		$serviceSelect	= 	pzk_request('serviceId');
		$serviceSelect = explode("/",$serviceSelect);
		$serviceId = $serviceSelect[0];
		$price  = $serviceSelect[1];
		$coupon = pzk_request('coupon');
		$className	= 	pzk_request('className');
		$service= _db()->getEntity('Service.Service');
		$service->load($serviceId);
		
		/*$price = $service->getAmount();*/
		$wallets		=	_db()->getEntity('User.Account.Wallets');
		$wallets->loadWhere(array('username',	pzk_session('username')));
		if($wallets->get('id')){
			$amount			=	$wallets->get('amount');
			if($price <= $amount)
			{
				// cập nhật database
				$amount 			= 	$amount - $price;
				$wallets->update(array('amount' 	=> $amount));
				$serviceType = $service->get('serviceType');
				$serviceName = $service->get('serviceName');
				$time = $service->get('duration');
				$languages = $service->get('languages');
				
				$paymentDate = Date('Y-m-d');
				$date = date_create($paymentDate);
				date_add($date, date_interval_create_from_date_string("'".$time." days'"));
				$expriedDate = date_format($date, 'Y-m-d 00:00:00');
				
				$serviceModel= pzk_model('Service.'.ucfirst($serviceType));
								
				$serviceModel->insertPayment($price,'wallets','','',$expriedDate,'','', $className,$languages, $coupon);
				$order_transaction		=	_db()->getEntity('Payment.Transaction');
				$order_row				= array(
						'userId'			=> pzk_session('userId'),
						'paymentType'		=> 'wallets',
						'amount'			=> $price,
						'paymentDate'		=> date("Y-m-d H:i:s"),
						'transactionStatus' => 1,
						'username'			=> pzk_session('username'),
						'software'			=> pzk_request('softwareId'),
						'status'			=> 1
					);
				$order_transaction->setData($order_row);			
				$order_transaction->save();
				echo $serviceName.'/'.product_price($amount);
				
			}
		}//else echo '0';
	}
	public function BuyTestAction()
	{
		$opt_service	= 	pzk_request('opt_service_type');
		$opt_service	= 	explode(" ",$opt_service);
		$opt_service_id	= 	$opt_service[0];
		$price			= 	$opt_service[1];
		
		$price			= 	trim($price);
		$price			= 	(double)$price;
		$datetime		=	date("Y-m-d H:i:s");
		$wallets		=	_db()->getEntity('User.Account.Wallets');
		$wallets->loadWhere(array('username',	pzk_session('username')));
		$amount			=	$wallets->get('amount');
		if($price <= $amount)
		{
			// cập nhật database
			$paymentDate		= date('Y-m-d 00:00:00');
			
			$amount 			= 	$amount - $price;
			$wallets->update(array('amount' 	=> $amount));
			if(pzk_request('app') == 'nobel_test') {
				$insert				=	_db()->getEntity('table');
				$insert->setTable('history_payment_test');
				$row 				=	array(
					'userId'		=>	pzk_session('userId'), 
					'paymentDate'	=>	$paymentDate,
					'paymentStatus'	=> 1,
					'status'		=> 1,
					
					'amount'		=>	$price,
					'username'		=>	pzk_session('username'),
					
					'paymentOption'	=>	'Ví điện tử',
					'created'		=>	date('Y-m-d 00:00:00'),
				);
				$insert->setData($row);
				$insert->save();
			} else {
				$insert					=	_db()->getEntity('Service.History_buyservice');
				$row =array(
						'userId'	=>	pzk_session('userId'), 
						'serviceId'	=>	$opt_service_id, 
						'amount'	=>	$price, 
						'date'		=>	$datetime);
				$insert->setData($row);
				$insert->save();	
			}
			
			echo 1;

		}
		else echo 0;

	}
	public function ordercardAction() 
	{
		$this->layout();
		$this->append('ecommerce/service/ordercard');
		$this->append('user/profile/profileuser','right');
		$this->display();
	
	}
	/*public function OrderCardNexnobelsAction()
	{
		
		$ordercard_txtname= pzk_request('ordercard_txtname');
		$ordercard_txtphone= pzk_request('ordercard_txtphone');
		$ordercard_txtaddress= pzk_request('ordercard_txtaddress');
		$ordercard_quantity= pzk_request('ordercard_quantity');
		$ordercard_selectcard= pzk_request('ordercard_selectcard');
		$opt_service= explode(" ",$ordercard_selectcard);
		$opt_service_id= $opt_service[0];
		$price= $opt_service[1];
		if($ordercard_quantity >=1){
			$price=$price*$ordercard_quantity;
		}else $ordercard_quantity=1;
		
		$price= trim($price);
		$price=(double)$price;
		$datetime=date("Y-m-d H:i:s");
		$ordercard=_db()->getEntity('service.order_card');
		$row=array('cardId'=>$opt_service_id,'fullname'=>$ordercard_txtname,'phone'=>$ordercard_txtphone, 'address'=>$ordercard_txtaddress,'quantity'=>$ordercard_quantity, 'amount'=>$price, 'date'=>$datetime);
		$ordercard->setData($row);
		$ordercard->save();
		echo 1;
	}*/
	public function orderFLSNAction()
	{
		$txtcoupon= clean_value(pzk_request('txtcoupon'));
		$txtname= clean_value(pzk_request('txtname'));
		$txtphone= clean_value(pzk_request('txtphone'));
		$txtaddress= clean_value(pzk_request('txtaddress'));
		$txtquantity= intval(pzk_request('txtquantity'));
		$serviceId= intval(pzk_request('serviceId'));
		$className = clean_value(pzk_request('className'));
		
		$opt_service= explode("/",$serviceId);
		$opt_service_id= $opt_service[0];
		$price= $opt_service[1];
		$price= trim($price);
		/*$price=(double)$price;*/
		$amount = $price * $txtquantity;
		$datetime=date("Y-m-d H:i:s");
		$ordercard=_db()->getEntity('Service.Ordercard');
		$row=array('cardId'=>$opt_service_id, 'coupon' => $txtcoupon, 'fullname'=>$txtname,'phone'=>$txtphone, 'address'=>$txtaddress,'quantity'=>$txtquantity, 'amount'=>$amount,'class' =>$className, 'date'=>$datetime, 'software'=>pzk_request('softwareId'),  'site'=>pzk_request('siteId'));
		$ordercard->create($row);
		echo 1;
	}
	public function orderFullookAction()
	{
		
		$txtname= clean_value(pzk_request('txtname'));
		$txtphone= clean_value(pzk_request('txtphone'));
		$txtaddress= clean_value(pzk_request('txtaddress'));
		$txtquantity= intval(pzk_request('txtquantity'));
		$datetime=date("Y-m-d H:i:s");
		$ordercard=_db()->getEntity('Service.Ordercard');
		$row=array('cardId'=>0,'fullname'=>$txtname,'phone'=>$txtphone, 'address'=>$txtaddress,'quantity'=>$txtquantity, 'amount'=> 0,'class' => 0, 'date'=>$datetime, 'software'=>pzk_request('softwareId'),  'site'=>pzk_request('siteId'));
		$ordercard->create($row);
		echo 1;
	}
	public function updateExpiredDateAction() {
		echo 2;
		$payment = _db()->getEntity('Payment.History_payment');
		$payment->updateExpriedDate();
	}
	public function BuyServiceTestAction()
	{
		$username= pzk_session('username');
		if(!$username){
			return false;
		}
		$serviceId	= 	pzk_request('serviceId');
		$service= _db()->getEntity('Service.Service');
		$service->load($serviceId);
		$contestId= $service->get('contestId');
		$contestIds = $service->get('contestIds');
		$price = $service->get('amount');
		$serviceType = $service->get('serviceType');

		$serviceName = $service->get('serviceName');
		$wallets		=	_db()->getEntity('User.Account.Wallets');
		$wallets->loadWhere(array('username',	pzk_session('username')));
		if($wallets->get('id')){
			$amount			=	$wallets->get('amount');
			if($price <= $amount)
			{
				// cập nhật database
				$amount 			= 	$amount - $price;
				$wallets->update(array('amount' 	=> $amount));
				//tinh ngay het han san pham			
				$serviceModel= pzk_model('Service.'.ucfirst($serviceType));
				if($serviceType=='view'){
					
					$date=date_create(date("Y-m-d"));
					$expriedDate = date_add($date,date_interval_create_from_date_string($service->get('duration') ." days"));
					$expriedDate =date_format($date,"Y-m-d");
					$serviceModel->insertPayment($contestId,$price,'wallets','',$expriedDate);
				}
				if($serviceType=='contest'){
					$date=date_create(date("Y-m-d"));
					$expriedDate = date_add($date,date_interval_create_from_date_string($service->get('duration') ." days"));
					$expriedDate =date_format($date,"Y-m-d");
					$serviceModel->insertPayment($contestId,$price,'wallets','',$expriedDate);
				}
				
				if($serviceType=='doview'){
					
					$date=date_create(date("Y-m-d"));
					$expriedDate = date_add($date,date_interval_create_from_date_string($service->get('duration') ." days"));
					$expriedDate =date_format($date,"Y-m-d");
					$serviceModel->insertPayment($contestIds,$price,'wallets','',$expriedDate, $service->get('id'));
				}
				if($serviceType=='dotest'){
					$date=date_create(date("Y-m-d"));
					$expriedDate = date_add($date,date_interval_create_from_date_string($service->get('duration') ." days"));
					$expriedDate =date_format($date,"Y-m-d");
					$serviceModel->insertPayment($contestIds,$price,'wallets','',$expriedDate, $service->get('id'));
				}
				
				/*
				$order_transaction		=	_db()->getEntity('Payment.Transaction');
				$order_row				= array(
						'userId'			=> pzk_session('userId'),
						'paymentType'		=> 'wallets',
						'amount'			=> $price,
						'paymentDate'		=> date("Y-m-d H:i:s"),
						'transactionStatus' => 1,
						'username'			=> pzk_session('username'),
						'software'			=> pzk_request('softwareId'),
						'status'			=> 1
					);
				$order_transaction->setData($order_row);			
				$order_transaction->save();*/
				echo $serviceName.'/'.product_price($amount);
			}
		}else echo 0;
	}
}
 ?>