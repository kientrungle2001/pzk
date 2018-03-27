<?php
class PzkServicecontestModel {
    
    function checkPayment($contestId){
        
        $username = pzk_session('username');
        if(!$username) return false;
        $datenow= date('Y-m-d');
        $query = _db()->useCB()-> select('count(*) as total')
                                -> from('history_payment')
                                -> where(array('username',$username))
                                -> where(array('paymentStatus', 1))
                                ->where(array('serviceType', 'contest'))
                                ->where(array('contestId', $contestId))
                                ->where(array('gte','expiredDate',$datenow))
                                ->result_one();
        if($query['total']){
            return 1;
        }
        return 0;
    }
}
?>