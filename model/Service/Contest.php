<?php
class PzkServiceContestModel {
    
    function checkPayment($resources){
        
        $username = pzk_session('username');
        if(!$username) return false;
        $datenow= date('Y-m-d');
        $query = _db()->useCB()-> select('contestId')
                                -> from('history_payment')
                                -> where(array('username',$username))
                                -> where(array('paymentStatus', 1))
                                ->where(array('serviceType', 'contest'))
                                ->where(array('contestId', $resources))
                                ->where(array('gte','expiredDate',$datenow))
                                ->result_one();
        $arr = array();
        if($query){            
            foreach ($query as $item) {
                $arr[] =$item['contestId'];
            }            
        }
        return $arr;
    }
    function insertPayment($contestId, $amount,$paymentType,$bank,$expiredDate){
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
            'serviceType'   =>  'contest',
            'contestId'     =>  $contestId,
            'site'          =>  pzk_request('siteId')

        );
        $historyPayment->setData($row);
        $historyPayment->save();
    }
}
?>