<?php 
/**
* 
*/
class PzkEntityUserNewMessageModel extends PzkEntityModel
{
	public $table="new_message";
	public function create($data) {
		$this->setData($data);
		$this->save();
	}
	
}
 ?>