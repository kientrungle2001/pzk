<?php
class PzkHtmlBody extends PzkObject {
	public $boundable = false;
	public function display() {
		foreach($this->children as $child) {
			$child->display();
		}
	}
}
?>