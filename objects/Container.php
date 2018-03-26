<?php 
class PzkContainer extends PzkObject {
	public function display() {
		foreach($this->children as $child) {
			$child->display();
		}
	}
}