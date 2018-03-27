<?php 
/**
* 
*/
class PzkEntityPaymentCard_nextnobelsModel extends PzkEntityModel
{
	public $table="card_nextnobels";
	public function create($cardData) {
		$this->setData($cardData);
		$this->save();
	}
}
 ?>