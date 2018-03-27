<?php 
/**
* 
*/
class PzkEntityPaymentHistorypaymentviewtestModel extends PzkEntityModel
{
	public $table="history_view_test";
	
	function CheckPaymentViewTest(){
		$username = pzk_session('username');		
		if(!$username) return 0;
		$total = 0;
		// check thanh toan dot 1
		
		$ttdot1 = _db()->select('count(*) as count')
			->from('history_view_test')
			->where(array('username',$username))
			->where(array('paymentStatus','1'))
			->where(array('test','1'))
			->result_one();
		if($ttdot1['count']>0) {
			$total += 1;
		}
		// check thanh toan dot 2
		$ttdot2 = _db()->select('count(*) as count')
			->from('history_view_test')->where(array('username',$username))
			->where(array('paymentStatus','1'))
			->where(array('test','2'))
			->result_one();
		if($ttdot2['count']>0) {
			$total += 2;
		}
		return $total;
	}
}
 ?>