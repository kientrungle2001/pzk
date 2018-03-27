<?php
class PzkServiceCouponModel {
	public function checkCode($code) {
		// check va luu lai session
		$today	=	date('Y-m-d H:i:s');
		
		$coupon = _db()->select('*')->from('coupon')
		->where('status', 1)
		->where('code', $code)
		->where( array(
			'or', 
			array('startDate', '0000-00-00 00:00:00'), 
			array('lte', 'startDate', $today)
		))
		->where( array(
			'or', 
			array('endDate', '0000-00-00 00:00:00'), 
			array('gte', 'endDate', $today)
		))
		->result_one();
		
		if($coupon) {
			pzk_session()->set('coupon', $code);
			pzk_session()->set('discount', $coupon['discount']);
		} else {
		}
		
	}
}