<?php 
/**
* 
*/
class PzkEntityPaymentHistory_paymentModel extends PzkEntityModel
{
	public $table="history_payment";
	
	function updateExpriedDate(){
		$querys = _db()->select('*')->from('history_payment')->whereExpireddate('0000-00-00 00:00:00')->result('Payment.History_payment');
		foreach ($querys as $key) {
			// cập nhật database
			$paymentDate	= $key->getPaymentDate();
			
			if($paymentDate == '0000-00-00 00:00:00') {
				continue;
			}
			$date 			= date("d",	strtotime($paymentDate));
			$month 			= date("m",	strtotime($paymentDate));
			$year 			= date("Y",	strtotime($paymentDate));
			$expriedYear	= $year + 1;
			if($month == '02' && $date == '29') {
				$date = '28';
			}
			$expriedDate	= $expriedYear.'-'.$month.'-'.$date . ' 00:00:00';
			echo $expriedDate. '<br />';
			$key->update(array('expiredDate'	=>	$expriedDate));
			
		}

		
	}
	function updateServiceType(){
		$querys = _db()->select('*')
				->from('history_payment')
				->where(array('gt','buySoftware',0))
				->result('Payment.History_payment');
		
		foreach ($querys as $key) {
			$key->update(array('serviceType'	=>	'full'));
		}
	}
	function insertPaymentTest(){
		$querys = _db()->select('*')
				->from('history_payment_test')
				->result();
		foreach ($querys as $key) {
				$serviceType	=	'contest';
				$contestId = $key['test'];
				$insert	=	_db()->getEntity('Payment.History_payment');
				$row 				=	array(
					'userId'			=>	$key['userId'], 
					'paymentDate'		=>	$key['paymentDate'],
					'paymentStatus'		=> 	$key['paymentStatus'],
					'status'			=> 	$key['status'],					
					'amount'			=>	$key['amount'],
					'username'			=>	$key['username'],
					'software'			=>	1,
					'serviceType'		=> 	$serviceType,
					'paymentOption' 	=>  '',
					'paymentType'		=>	$key['paymentOption'],
					'created'			=>	$key['created'],
					'creatorId'			=>	$key['creatorId'],
					'modifiedId'		=>	$key['modifiedId'],
					'modified'			=>	$key['modified'],
					'bank'				=>	$key['bank'],
					'billcode'			=>	$key['billcode'],
					'expiredDate'		=>	'2016-06-25',
					'transactioncode'	=> 	''

				);
				$insert->setData($row);
				$insert->save();
		}
	}

	function insertPaymentViewTest(){
		$querys = _db()->select('*')
				->from('history_view_test')
				->result();
		
		foreach ($querys as $key) {
			$serviceType = 'xemthithu-'.$key['test'];
			$insert		 =	_db()->getEntity('Payment.History_payment');
			$row 				=	array(
					'userId'		=>	$key['userId'], 
					'paymentDate'	=>	$key['paymentDate'],
					'paymentStatus'	=> $key['paymentStatus'],
					'status'		=> $key['status'],					
					'amount'		=>	$key['amount'],
					'username'		=>	$key['username'],
					'software'		=>	1,
					'serviceType'	=> $serviceType,
					'paymentOption' =>  '',
					'paymentType'	=>	$key['paymentOption'],
					'created'		=>	$key['created'],
					'creatorId'		=>	$key['creatorId'],
					'modifiedId'	=>	$key['modifiedId'],
					'modified'		=>	$key['modified'],
					'bank'			=>	$key['bank'],
					'billcode'		=>	$key['billcode'],
					'expiredDate'	=>	'0000-00-00',
					'transactioncode'=> '',
					'buySoftware'	=>0

				);
			$insert->setData($row);
			$insert->save();
		}
	}
	/*function updatePaymentViewTest(){
		$viewtests = _db()->useCB()->select('*')
      				->from('history_payment')
      				->where(array('like', 'serviceType','%xemthithu%'))
      				->result('Payment.History_payment');

      	foreach ($viewtests as $item) {
      		$serviceType = $item->getServiceType();
      		$serviceType = str_replace('xemthithu', 'viewtest', $serviceType);
      		$item->update(array('serviceType'	=>	$serviceType));
      	}
	}*/
	function updatePaymentTypeBank(){
		$querys = _db()->select('*')
				->from('history_payment')
				->where(array('paymentType','chuyển khoản ngân hàng'))
				->result('Payment.History_payment');
		
		foreach ($querys as $key) {
			$key->update(array('paymentType'	=>	'bank'));
		}
	}
	function updatePaymentTypeMoney(){
		$querys = _db()->select('*')
				->from('history_payment')
				->where(array('paymentType','tiền mặt'))
				->result('Payment.History_payment');
		
		foreach ($querys as $key) {
			$key->update(array('paymentType'	=>	'money'));
		}
	}
	// check user mua fullook
	function CheckPayment(){
		
		$username = pzk_session('username');
		$softwareId = pzk_request('softwareId');
		if(!$username) return false;
		$datenow= date('Y-m-d');
		$query = _db()->useCB()-> select('count(*) as total')
								-> from('history_payment')
								-> where(array('username',$username))
								-> where(array('paymentStatus',1))
								->where(array('serviceType','fullook'))
								//->where(array('buySoftware',$softwareId))
								->where(array('gt','expiredDate',$datenow))
								->result_one();
		if($query['total']){
			return 1;
		}
		return 0;
	}
	// check user mua fullook-songngu
	function CheckPaymentFLSongngu(){
		
		$username = pzk_session('username');
		$softwareId = pzk_request('softwareId');
		if(!$username) return false;
		$datenow= date('Y-m-d');
		$query = _db()->useCB()-> select('count(*) as total')
								-> from('history_payment')
								-> where(array('username',$username))
								-> where(array('paymentStatus',1))
								->where(array('serviceType','fullook-songngu'))
								->where(array('gt','expiredDate',$datenow))
								->result_one();
		if($query['total']){
			return true;
		}
		return false;
	}
	// check user mua goi thithu
	function CheckPaymentThithu(){
		
		$username = pzk_session('username');
		$softwareId = pzk_request('softwareId');
		if(!$username) return false;
		$datenow= date('Y-m-d');
		$query = _db()->useCB()-> select('count(*) as total')
								-> from('history_payment')
								-> where(array('username',$username))
								-> where(array('paymentStatus',1))
								->where(array('like','serviceType','thithu'))
								//->where(array('gt','expiredDate',$datenow))
								->result_one();
		if($query['total']){
			/*return true;*/
			echo $query['total'];
		}else {
			echo $query['total'];
		}
		/*return false;*/
	}
	public $usingDays = false;
	function getUsingDays() {
		if($this->usingDays) return $this->usingDays;
		$date1=date_create(date('Y-m-d', strtotime($this->getPaymentDate())));
		$date2=date_create(date('Y-m-d'));
		$diff=date_diff($date1,$date2);
		return $this->usingDays = $diff->format("%a");
	}
	public function formatDate($date) {
		$dt = strtotime($date); 
		return date("d/m/Y", $dt);		
	}
	function getDate($serviceType = 'full'){
		$username = pzk_session('username');
		$softwareId = pzk_request('softwareId');
		if(!$username) return false;		
		$datenow= date('Y-m-d');
		$query = _db()->select('history_payment.paymentDate, history_payment.expiredDate , history_payment.languages, history_payment.class')
								-> from('history_payment')
								-> where(array('username',$username))
								-> where(array('paymentStatus',1))
								-> where(array('serviceType',$serviceType))
								->where(array('gte','expiredDate',$datenow))
								//-> where(array('class',pzk_session('lop')))
								->result();
		if(count($query) > 0){
			return $query;
			
		}
		
	}
	function getDateFL(){
		$username = pzk_session('username');
		$softwareId = pzk_request('softwareId');
		if(!$username) return false;		
		$datenow= date('Y-m-d');
		$query = _db()->useCache(300)->useCB()-> select('history_payment.paymentDate, history_payment.expiredDate')
								-> from('history_payment')
								-> where(array('username',$username))
								-> where(array('paymentStatus',1))
								-> where(array('serviceType','full'))
								->where(array('gte','expiredDate',$datenow))
								->result_one();
		if($query){
			
			$paymentDate=date('d/m/Y', strtotime($query['paymentDate'])); 
			$expiredDate=date('d/m/Y', strtotime($query['expiredDate'])); 
			return $paymentDate.' đến '.$expiredDate;
		}
		
	}
}
 ?>