<?php
class PzkBlock extends PzkObject {
	public $boundable = false;
	public $layout = 'empty';
	public function display()
	{
		echo $this->getContent();
	}
}
?>