<?php 
/**
* 
*/
class PzkEntityPaymentHistoryPaymentTestModel extends PzkEntityModel
{
	public $table="history_payment_test";
	
	function CheckPaymentTest(){
		$username = pzk_session('username');		
		if(!$username) return 0;
		$total = 0;
		// check thanh toan dot 1
		$ttdot1 = _db()->selectAll()
			->fromHistory_payment_test()->whereUsername($username)->wherePaymentstatus('1')
			->whereTest('1')->result_one();
		if($ttdot1) {
			$total += 1;
		}
		// check thanh toan dot 2
		$ttdot2 = _db()->selectAll()
			->fromHistory_payment_test()->whereUsername($username)->wherePaymentstatus('1')
			->whereTest('2')->result_one();
		if($ttdot2) {
			$total += 2;
		}
		return $total;
	}
	
	function checkContest($contestId){
		$username = pzk_session('username');		
		if(!$username) return 0;
		
		$result = _db()->selectAll()
					   ->fromHistory_payment()
					   ->whereUsername($username)
					   ->wherePaymentStatus('1')
					   ->whereContestId($contestId)
					   ->whereServiceType('contest')
					   ->result_one();
		if($result){
			return true;
		}
		return false;
		
	}
}
 ?>