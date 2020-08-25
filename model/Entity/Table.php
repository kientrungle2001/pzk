<?php 
class PzkEntityTableModel extends PzkEntityModel {
	public $table = false;
	public function setTable($table) {
		$this->table = $table;
		return $this;
	}
	public function getAlias() {
		return $this->getalias();
	}
	public function getName_vn() {
		return $this->getName_vn();
	}
	public function getName_en() {
		return $this->getName_en();
	}
	public function getName() {
		return $this->getName();
	}
	
}