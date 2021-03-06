<?php
require_once BASE_DIR . '/model/Entity.php';
class PzkEntityQueryTableModel extends PzkEntityModel {
	public $table = 'attribute_catalog';
	public function getFields() {
		if(!isset($this->_fields)) {
			$this->_fields = $this->getRelateds('attribute_catalog', 'query.field', 'parentId', array('type', 'QueryJoinTableField'));
		}
		return $this->_fields;
	}
	public function getSet() {
		if(!isset($this->_set)) {
		$this->_set = _db()->getEntity('Attribute.Set')->load($this->getSetId());
		}
		return $this->_set;
	}
	public function getImplodedFields() {
		$rs = array();
		$fields = $this->getFields();
		if(!$fields) return '';
		if($alias = $this->get('code', $this->getSet()->getCode())) {
			if($fields)
			foreach($fields as $field) {
				$rs[] = $alias . '.' . $field->getLeftField() . ' as ' . $field->getCode();
			}
			if(!count($rs)) {
				return $alias.'.*';
			}
			return implode(', ', $rs);
		} else {
			if($fields)
			foreach($fields as $field) {
				$rs[] = $field->getLeftField() . ' as ' . $field->getCode();
			}
			if(!count($rs)) {
				return '*';
			}
			return implode(', ', $rs);
		}
	}
}
