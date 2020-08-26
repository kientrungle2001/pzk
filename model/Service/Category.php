<?php
class PzkServiceCategoryModel {
	
    function checkPayment($categoryId, $user){
        $username = pzk_session('username');
        if(!$username) return false;
        $datenow= date('Y-m-d');
        $query = _db()->useCB()-> select('count(*) as total')
                                ->from('history_payment')
                                ->where(array('username',$username))
                                ->where(array('paymentStatus', 1))
                                ->where(array('serviceType', 'category'))
                                ->where(array('like', 'categoryIds', '%,'.$categoryId.',%'))
                                ->where(array('gte','expiredDate',$datenow))
                                ->result_one();
        if($query['total']){
            return 1;
        }
        return 0;
    }
	
    function insertPayment($categoryIds, $amount,$paymentType,$bank,$expiredDate){
        $username = pzk_session('username');
        if(!$username) return false;
        $historyPayment = _db()->getEntity('Payment.History_payment');
        $row = array(
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
            'serviceType'   =>  'category',
            'categoryIds'   =>  $categoryIds,
            'site'          =>  pzk_request()->getSiteId()

        );
        $historyPayment->setData($row);
        $historyPayment->save();
    }
}
?>