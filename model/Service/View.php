<?php
class PzkServiceViewModel {
    function checkPayment($contestId){
        
        $username 	= pzk_session('username');
        if(!$username) return false;
        $datenow	= date('Y-m-d');
        $data 		= _db()->useCB()
							->select('contestId')
							->from('history_payment')	
							->where(array('username',$username))
							->where(array('paymentStatus',1))
							->where(array('serviceType','view'))
							->where(array('contestId',$contestId))
							->where(array('gte','expiredDate',$datenow));
				
		$data = $data->result_one();
       
        if($data){            
            return true;          
        }
		return false;
		
        
    }
    function insertPayment($contestId,$amount,$paymentType,$bank,$expiredDate){
        $username = pzk_session('username');
        if(!$username) return false;
        $historyPayment= _db()->getEntity('Payment.History_payment');
        $row= array(
            
            'username'      =>   pzk_session('username'),
            'amount'        =>  $amount,
            'paymentType'   =>  $paymentType,
            'paymentOption' =>  '',
            'bank'          =>  $bank,
            'transactioncode'=> '',
            'billcode'      =>  '',
            'paymentStatus' =>  1,
            'paymentDate'   =>  Date('Y-m-d'),
            'status'        =>  1,
            'software'      =>  pzk_request()->getSoftware(),
            'expiredDate'   =>  $expiredDate,
            'serviceType'   =>  'view',
            'contestId'     =>  $contestId,
            'site'          =>  pzk_request()->getSiteId()

        );
        $historyPayment->setData($row);
        $historyPayment->save();
    }
    
}
?>