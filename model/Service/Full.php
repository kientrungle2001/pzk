<?php
class PzkServiceFullModel {
    function checkPayment($resourceId){
        
        $username = pzk_session('username');
        if(!$username) return false;
        $datenow 	= date('Y-m-d');
        $query 		= _db()->useCB()-> select('history_payment.categoryIds as categoryIds, history_payment.languages as languages')
                                -> from('history_payment')
                                -> where(array('username', $username))
                                -> where(array('paymentStatus', 1))
                                ->where(array('serviceType', 'full'))
                                ->where(array('gte','expiredDate', $datenow));
        if(pzk_session('lop')){
            $query->where(array('or',array('class', pzk_session('lop')), array('class', 0)));		
        }
        $data = $query->result();

        if($data){
            if(count($data)> 1) {
                $languages ='ev';
            }else {
                foreach ($data as $item) {
                    if($item['languages'] == ''){
                        $languages ='ev';
                    }else {
                        $languages = $item['languages'];        
                    }
                }
            }
            pzk_session('paymentLanguages',$languages);
			if($languages == 'ev' || $languages == 'vn'){
				if(!pzk_session('language'))
					pzk_session('language','vn');
			}else{
				if(!pzk_session('language'))
					pzk_session('language','en');
			}
			
            /*pzk_session('categoryIds',$categoryIds);*/
            return 1;
        }
        return 0;
    }
    function insertPayment($amount,$paymentType,$categoryIds,$bank,$expiredDate, $paymentOption, $transactioncode,$className, $languages, $coupon = ''){
        $username = pzk_session('username');
        if(!$username) return false;
        $historyPayment= _db()->getEntity('Payment.History_payment');
        $row= array(
            
            'username'      =>   pzk_session('username'),
            'amount'        =>  $amount,
            'paymentType'   =>  $paymentType,
            'categoryIds'   =>  '',
            'paymentOption' =>  $paymentOption,
            'bank'          =>  $bank,
            'transactioncode'=> $transactioncode,
            'billcode'      =>  '',
            'paymentStatus' =>  1,
            'paymentDate'   =>  Date('Y-m-d'),
            'status'        =>  1,
            'software'      =>  pzk_request('software'),
            'expiredDate'   =>  $expiredDate,
            'serviceType'   =>  'full',
            'contestId'     =>  0,
            'site'          =>  pzk_request('siteId'),
            'class'         => $className,
            'languages'     => $languages,
			'refId'			=> pzk_session('refId'),
			'coupon'		=> $coupon
        );
        $historyPayment->setData($row);
        $historyPayment->save();
		if($coupon) {
			$couponUser 	=	_db()->getTableEntity('coupon_user');
			$couponEntity 	= 	_db()->getTableEntity('coupon');
			$couponEntity->loadWhere(array('code', $coupon));
			if($couponEntity->get('id')) {
				$couponUser->setData(array(
					'userId'	=>	pzk_session('userId'),
					'username'	=>	pzk_session('username'),
					'code'		=>	$coupon,
					'resellerId'=>	$couponEntity->getResellerId(),
					'status'	=>	1,
					'activated'	=> 	date('Y-m-d H:i:s'),
					'amount'	=>	$amount,
					'class'		=>	$className,
					'languages'	=>	$languages
				));
				$couponUser->save();
			}
		}
    }
    
}
?>