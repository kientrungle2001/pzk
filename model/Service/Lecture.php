<?php
class PzkServiceLectureModel {
    function checkPayment($scope){
        
        $username = pzk_session('username');
        if(!$username) return false;
        $datenow 	= date('Y-m-d');
        $query 		= _db()->useCB()-> select('*')
                                -> from('history_payment')
                                -> where(array('username', $username))
                                -> where(array('paymentStatus', 1))
                                ->where(array('serviceType', 'lecture'))
                                ->where(array('gte','expiredDate', $datenow));
		if($scope == LECTURE_SCOPE_ALL) {
			$query->whereScope(0);
		} else if($scope == LECTURE_SCOPE_LECTURE_ONLY) {
			$query->where(array(
				'or',
				array('equal', 'scope', LECTURE_SCOPE_LECTURE_ONLY),
				array('equal', 'scope', LECTURE_SCOPE_ALL)
			));
		} else if($scope == LECTURE_SCOPE_EXERCISE_ONLY) {
			$query->where(array(
				'or',
				array('equal', 'scope', LECTURE_SCOPE_EXERCISE_ONLY),
				array('equal', 'scope', LECTURE_SCOPE_ALL)
			));
		}
        $data = $query->result_one();

        if($data){
            return 1;
        }
        return 0;
    }
    function insertPayment($paymentOptions){
        $username = pzk_session('username');
        if(!$username) return false;
        $historyPayment= _db()->getEntity('Payment.History_payment');
        $row = array(
            'serviceType'   =>  'lecture',
			'serviceId'		=>	$paymentOptions['serviceId'],
			'username'      =>   pzk_session('username'),
            'amount'        =>  $paymentOptions['amount'],
            'paymentType'   =>  $paymentOptions['paymentType'],
            'paymentOption' =>  $paymentOptions['paymentOption'],
            'bank'          =>  $paymentOptions['bank'],
            'transactioncode'=> $paymentOptions['transactioncode'],
			'expiredDate'   =>  $paymentOptions['expiredDate'],
			'scope'			=>	$paymentOptions['scope'],
			'coupon'		=>	$paymentOptions['coupon'],
            'billcode'      =>  '',
            'paymentStatus' =>  1,
            'paymentDate'   =>  date('Y-m-d'),
            'status'        =>  1,
            'software'      =>  pzk_request('software'),
            'site'          =>  pzk_request('siteId')
        );
        $historyPayment->setData($row);
        $historyPayment->save();
		$coupon 			=	$paymentOptions['coupon'];
		if($coupon) {
			$couponUser 	=	_db()->getTableEntity('coupon_user');
			$couponEntity 	= 	_db()->getTableEntity('coupon');
			$couponEntity->loadWhere(array('code', $coupon));
			if($couponEntity->get('id')) {
				$couponUser->setData(array(
					'userId'	=>	pzk_session('userId'),
					'username'	=>	pzk_session('username'),
					'code'		=>	$coupon,
					'serviceId'	=>	$paymentOptions['serviceId'],
					'resellerId'=>	$couponEntity->getResellerId(),
					'status'	=>	1,
					'actived'	=> 	date('Y-m-d H:i:s'),
					'amount'	=>	$paymentOptions['amount'],
					'software'  =>  pzk_request('software'),
					'site'      =>  pzk_request('siteId')
				));
				$couponUser->save();
			}
		}
    }
    
}
?>