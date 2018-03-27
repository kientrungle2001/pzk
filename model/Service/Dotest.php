<?php
class PzkServiceDotestModel {
    
    function checkPayment($contestId){
        
        $username = pzk_session('username');
        if(!$username) return false;
        $datenow= date('Y-m-d');
        $query = _db()->useCB()-> select('contestIds')
                                -> from('history_payment')
                                -> where(array('username',$username))
                                -> where(array('paymentStatus', 1))
                                ->where(array('serviceType', 'dotest'))
                                ->where(array('like', 'contestIds', '%,'.$contestId.',%'))
                                ->where(array('gte','expiredDate',$datenow))
                                ->result_one();
        $arr = array();
        if($query){            
            foreach ($query as $item) {
                $arr[] =$item['contestIds'];
            }            
        }
        return $arr;
    }
    function insertPayment($contestIds, $amount,$paymentType,$bank,$expiredDate, $serviceId){
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
            'software'      =>  pzk_request('softwareId'),
            'expiredDate'   =>  $expiredDate,
            'serviceType'   =>  'dotest',
            'contestIds'     =>  $contestIds,
			'serviceId'		=>	$serviceId,
            'site'          =>  pzk_request('siteId')

        );
        $historyPayment->setData($row);
        $historyPayment->save();
    }
}
?>