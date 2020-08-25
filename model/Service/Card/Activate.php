<?php
class PzkServiceCardActivateModel {
	
	function activate($code) {
		$card 	=	_db()->getEntity('service.card')->loadWhere(array('code', $code));
		if($card->getId()) {
			if($serviceId = $card->getServiceId()){
				$service 		= 	_db()->getEntity('Service.Package')->load($serviceId);
				$startDate 		=	$service->getStartDate();
				$endDate		=	$service->getEndDate();
				$duration		=	$service->getDuration();
				$expiredDate	=	$service->getExpiredDate();
				$price			=	$service->getPrice();
			}
			if($card->getStartDate())		$startDate		=	$card->getStartDate();
			if($card->getEndDate())			$endDate		=	$card->getEndDate();
			if($card->getExpiredDate())		$expiredDate	=	$card->getExpiredDate();
			if($card->getTime())			$duration		=	$card->getTime();
			if($card->getPrice())			$price			=	$card->getPrice();
			
			if(!$expiredDate) {
				$expiredDate 			= 	date_create(new date('Y-m-d'));
                date_add($expiredDate, date_interval_create_from_date_string("'".$duration." days'"));
                $expriedDate 	= 	date_format($expiredDate, 'Y-m-d 00:00:00');
			}
			
			if($tableCard->getPromotion() == 1) {
				if($tableCard->getStartDate()) {
					if(date('Y-m-d H:i:s') < $tableCard->getStartDate()) {
						return 0;
					}
				}
				if($tableCard->getEndDate()) {
					if(date('Y-m-d H:i:s') > $tableCard->getEndDate()) {
						$row	=	array( 'status'=>2 );
						$tableCard->update($row);
						return 0;
					}
				}
				$quantity = $tableCard->getQuantity() - 1;
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
		if($tableCard->getId())
        {
			pzk_session()->setCoupon($coupon);
			pzk_session()->setRefId($tableCard->getResellerId());
			pzk_session()->setDiscount($tableCard->getDiscount());
		}
	}
	
    function checkCard($cardId){
        $datenow 	= 	date('Y-m-d');
        $tableCard	= 	_db()->getEntity('Payment.Card_nextnobels');
        $tableCard->loadWhere(array('pincard',	$cardId));
        if($tableCard->getId())
        {
            if($tableCard->getStatus()==1){
                $paymentDate = Date('Y-m-d');
				if($tableCard->getPromotion() == 1) {
					if($tableCard->getStartDate() && $tableCard->getStartDate() != '0000-00-00 00:00:00') {
						if(date('Y-m-d H:i:s') < $tableCard->getStartDate()) {
							return 0;
						}
					}
					if($tableCard->getEndDate() && $tableCard->getEndDate() != '0000-00-00 00:00:00') {
						if(date('Y-m-d H:i:s') > $tableCard->getEndDate()) {
							$row	=	array( 'status'=>2 );
							$tableCard->update($row);
							return 0;
						}
					}
					$quantity = $tableCard->getQuantity() - 1;
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
                
                $languages 		= 	$tableCard->getLanguages();
                $className 		= 	$tableCard->getClass();
                $price 			= 	$tableCard->getPrice();
                $time 			= 	$tableCard->getTime();
                $date 			= 	date_create($paymentDate);
                date_add($date, date_interval_create_from_date_string("'".$time." days'"));
                $expriedDate 	= 	date_format($date, 'Y-m-d 00:00:00');
                if($tableCard->getPromotion() == 1) {
					if($tableCard->getExpiredDate() && $tableCard->getExpiredDate() != '0000-00-00 00:00:00') {
						$expriedDate 	=	$tableCard->getExpiredDate();
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
            }else if($tableCard->getStatus()==2){
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
        if($tableCard->getId())
        {
			// mã chưa được sử dụng
            if($tableCard->getStatus()==1){
				$paymentDate 	= 	date('Y-m-d');
				$actived		=	date('Y-m-d H:i:s');
				if($tableCard->getPromotion()) {
					$quantity	=	$tableCard->getQuantity();
					if($quantity > 0) {
						$historyPayment = _db()
							->selectAll()
							->from('history_payment')
							->where(array('username', pzk_session('username')))
							->where(array('serviceId', $tableCard->getServiceId()))
							->result_one();
						if($historyPayment) {
							return 0;
						}
						$tableCard->setQuantity($quantity - 1);
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
                
                
				$servicePackage = _db()->getTableEntity('service_packages')->load($tableCard->getServiceId());
                $price 			= 	$servicePackage->getamount();
				$discount		=	pzk_session('discount');
				if($discount) {
					$price		=	$price * ( 1 - $discount / 100 );
				}
                $time 			= $servicePackage->getDuration();
				if(!$time) $time= 365;
                $date 			= date_create($paymentDate);
                date_add($date, date_interval_create_from_date_string("'".$time." days'"));
                $expriedDate 	= date_format($date, 'Y-m-d 00:00:00');
                $serviceModel	= pzk_model('Service.' . ucfirst($servicePackage->getServiceType()));
                $serviceModel->insertPayment(array(
					'amount' 			=> 	$price,
					'paymentType' 		=> 	'scratchcard',
					'serviceId'			=>	$tableCard->getServiceId(),
					'paymentOption'		=> 	'',
					'bank'				=> 	'',
					'transactioncode' 	=>	'',
					'expiredDate'		=>	$expriedDate,
					'scope'				=> 	$servicePackage->getScope(),
					'coupon'			=>	pzk_session('coupon')
				));
                pzk_session('checkPayment',	1);
                return 1;
            }	else if($tableCard->getStatus()	==	2){
                return 2;
            }	else return 0;
        }else return 0;
	}
}
?>