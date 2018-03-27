<?php 
/**
* 
*/
class PzkEntityServiceOrdercardModel extends PzkEntityModel
{
	public $table="order_card";
	public function create($userData) {
		$this->setData($userData);
		$this->save();
	}
}
 ?>