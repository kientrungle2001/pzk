<?php
class PzkHtmlTag extends PzkObject {
	public $boundable = false;
	public $layout = 'htmlTag';
	public function display() {
		echo $this->getContent();
	}
}