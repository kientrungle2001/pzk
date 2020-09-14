<?php 
class PzkEntityTableModel extends PzkEntityModel {
	public $table = false;
	public function setTable($table) {
		$this->table = $table;
		return $this;
	}
	public function getAlias() {
		return $this->get('alias');
	}
	public function getName_vn() {
		return $this->get('name_vn');
	}
	public function getName_en() {
		return $this->get('name_en');
	}
	public function getName() {
		return $this->get('name');
	}
	
}