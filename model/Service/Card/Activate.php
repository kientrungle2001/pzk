<?php
class PzkServiceCardActivateModel {
	
	function activate($code) {
		$card 	=	_db()->getEntity('service.card')->loadWhere(array('code', $code));
		if($card->get('id')) {
			if($serviceId = $card->get('serviceId')){
				$service 		= 	_db()->getEntity('Service.Package')->load($serviceId);
				$startDate 		=	$service->get('startDate');
				$endDate		=	$service->get('endDate');
				$duration		=	$service->get('duration');
				$expiredDate	=	$service->get('expiredDate');
				$price			=	$service->get('price');
			}
			if($card->get('startDate'))		$startDate		=	$card->get('startDate');
			if($card->get('endDate'))			$endDate		=	$card->get('endDate');
			if($card->get('expiredDate'))		$expiredDate	=	$card->get('expiredDate');
			if($card->get('time'))			$duration		=	$card->get('time');
			if($card->get('price'))			$price			=	$card->get('price');
			
			if(!$expiredDate) {
				$expiredDate 			= 	date_create(new date('Y-m-d'));
                date_add($expiredDate, date_interval_create_from_date_string("'".$duration." days'"));
                $expriedDate 	= 	date_format($expiredDate, 'Y-m-d 00:00:00');
			}
			
			if($tableCard->get('promotion') == 1) {
				if($tableCard->get('startDate')) {
					if(date('Y-m-d H:i:s') < $tableCard->get('startDate')) {
						return 0;
					}
				}
				if($tableCard->get('endDate')) {
					if(date('Y-m-d H:i:s') > $tableCard->get('endDate')) {
						$row	=	array( 'status'=>2 );
						$tableCard->update($row);
						return 0;
					}
				}
				$quantity = $tableCard->get('quantity') - 1;
				if($quantity < 0) {
					$row=array( 'status'=>2 );
					$tableCard->update($row);
					return 0;
				} else {
					$row	=	array(
							'userActive' 	=>	pzk_session('userId'),
							'dateActive'	=>	$paymentDate, 
							'status'		=>	1, 
							'quantity' 		=> 	$quantity );
					$tableCard->update($row);	
				}
				
			} else {
				$row	=	array(
					'userActive'	=>	pzk_session('userId'),	
					'dateActive'	=>	$paymentDate, 
					'status'		=>	2 
				);
				$tableCard->update($row);
			}
		} else {
			// return false;
		}
	}
	
	function checkCoupon($coupon) {
		$tableCard	= 	_db()->getEntity('Payment.Card_nextnobels');
        $tableCard->loadWhere(array('pincard_normal',	$coupon));
		if($tableCard->get('id'))
        {
			pzk_session()->set('coupon', $coupon);
			pzk_session()->set('refId', $tableCard->get('resellerId'));
			pzk_session()->set('discount', $tableCard->get('discount'));
		}
	}
	
    function checkCard($cardId){
        $datenow 	= 	date('Y-m-d');
        $tableCard	= 	_db()->getEntity('Payment.Card_nextnobels');
        $tableCard->loadWhere(array('pincard',	$cardId));
        if($tableCard->get('id'))
        {
            if($tableCard->get('status')==1){
                $paymentDate = Date('Y-m-d');
				if($tableCard->get('promotion') == 1) {
					if($tableCard->get('startDate') && $tableCard->get('startDate') != '0000-00-00 00:00:00') {
						if(date('Y-m-d H:i:s') < $tableCard->get('startDate')) {
							return 0;
						}
					}
					if($tableCard->get('endDate') && $tableCard->get('endDate') != '0000-00-00 00:00:00') {
						if(date('Y-m-d H:i:s') > $tableCard->get('endDate')) {
							$row	=	array( 'status'=>2 );
							$tableCard->update($row);
							return 0;
						}
					}
					$quantity = $tableCard->get('quantity') - 1;
					if($quantity < 0) {
						$row=array( 'status'=>2 );
						$tableCard->update($row);
						return 0;
					} else {
						$row	=	array(
								'userActive' 	=>	pzk_session('userId'),
								'dateActive'	=>	$paymentDate, 
								'status'		=>	1, 
								'quantity' 		=> 	$quantity );
						$tableCard->update($row);	
					}
					
				} else {
					$row	=	array(
						'userActive'	=>	pzk_session('userId'),	
						'dateActive'	=>	$paymentDate, 
						'status'		=>	2 
					);
					$tableCard->update($row);
				}
                
                $languages 		= 	$tableCard->get('languages');
                $className 		= 	$tableCard->get('class');
                $price 			= 	$tableCard->get('price');
                $time 			= 	$tableCard->get('time');
                $date 			= 	date_create($paymentDate);
                date_add($date, date_interval_create_from_date_string("'".$time." days'"));
                $expriedDate 	= 	date_format($date, 'Y-m-d 00:00:00');
                if($tableCard->get('promotion') == 1) {
					if($tableCard->get('expiredDate') && $tableCard->get('expiredDate') != '0000-00-00 00:00:00') {
						$expriedDate 	=	$tableCard->get('expiredDate');
					}
				}
				$serviceModel	= 	pzk_model('Service.Full');
                $serviceModel->insertPayment($price,'paycardfl','','',$expriedDate,'','',$className,$languages);
                pzk_session('checkPayment',1);
                if(pzk_request('softwareId') == 1 && pzk_request('siteId')== 2){
                    pzk_session('paymentLanguages',	$languages);
                    pzk_session('lop',				$className);
                }
                return 1;
            }else if($tableCard->get('status')==2){
                return 2;
            }else return 0;
        }else return 0;
        
    }
    
    function checkCardAndSerial($cardId, $serialId) {
		$datenow 	= 	date('Y-m-d');
        $tableCard	= 	_db()->getEntity('Payment.Card_nextnobels');
        $tableCard->loadWhere(array('and',
			array('serial',$serialId),
			array('or',
				array('pincard',	$cardId),
				array('pincard',	md5($cardId))
			)
		));
        if($tableCard->get('id'))
        {
			// mã chưa được sử dụng
            if($tableCard->get('status')==1){
				$paymentDate 	= 	date('Y-m-d');
				$actived		=	date('Y-m-d H:i:s');
				if($tableCard->get('promotion')) {
					$quantity	=	$tableCard->get('quantity');
					if($quantity > 0) {
						$historyPayment = _db()
							->selectAll()
							->from('history_payment')
							->where(array('username', pzk_session('username')))
							->where(array('serviceId', $tableCard->get('serviceId')))
							->result_one();
						if($historyPayment) {
							return 0;
						}
						$tableCard->set('quantity', $quantity - 1);
						$tableCard->save();
					} else {
						$row			=	array(
							'userActive'	=>	pzk_session('userId'),	
							'dateActive'	=>	$actived,
							'activedId'		=>	pzk_session('userId'),	
							'actived'		=>	$actived,					
							'status'		=>	2 
						);
						$tableCard->update($row);	
						return 0;
					}
				} else {
					$row			=	array(
						'userActive'	=>	pzk_session('userId'),	
						'dateActive'	=>	$actived,
						'activedId'		=>	pzk_session('userId'),	
						'actived'		=>	$actived,					
						'status'		=>	2 
					);
					$tableCard->update($row);	
				}
                
                
				$servicePackage = _db()->getTableEntity('service_packages')->load($tableCard->get('serviceId'));
                $price 			= 	$servicePackage->get('amount');
				$discount		=	pzk_session('discount');
				if($discount) {
					$price		=	$price * ( 1 - $discount / 100 );
				}
                $time 			= $servicePackage->get('duration');
				if(!$time) $time= 365;
                $date 			= date_create($paymentDate);
                date_add($date, date_interval_create_from_date_string("'".$time." days'"));
                $expriedDate 	= date_format($date, 'Y-m-d 00:00:00');
                $serviceModel	= pzk_model('Service.' . ucfirst($servicePackage->get('serviceType')));
                $serviceModel->insertPayment(array(
					'amount' 			=> 	$price,
					'paymentType' 		=> 	'scratchcard',
					'serviceId'			=>	$tableCard->get('serviceId'),
					'paymentOption'		=> 	'',
					'bank'				=> 	'',
					'transactioncode' 	=>	'',
					'expiredDate'		=>	$expriedDate,
					'scope'				=> 	$servicePackage->get('scope'),
					'coupon'			=>	pzk_session('coupon')
				));
                pzk_session('checkPayment',	1);
                return 1;
            }	else if($tableCard->get('status')	==	2){
                return 2;
            }	else return 0;
        }else return 0;
	}
}
?>