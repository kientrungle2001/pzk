<?php 
/**
* 
*/
class PzkEntityUserWalletsModel extends PzkEntityModel
{
	public $table="wallets";
	public function executeTransaction($transaction) {
		$this->addAmount($transaction->get('amount'));
		$this->save();
	}
	
	public function addAmount($amount) {
		$this->set('amount', $amount + $this->get('amount'));
	}
}
 ?>