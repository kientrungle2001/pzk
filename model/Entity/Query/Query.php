<?php
require_once BASE_DIR . '/model/Entity.php';
class PzkEntityQueryQueryModel extends PzkEntityModel {
	public $table = 'attribute_catalog';
	public $type = 'Query';
	public function getTables() {
		if(!isset($this->_tables)) {
			$this->_tables = $this->getRelateds('attribute_catalog', 'query.table', 'parentId', array('type', 'QueryJoinTable'));
		}
		return $this->_tables;
	}
	public function getFields() {
		if(!isset($this->_fields)) {
			$this->_fields = $this->getRelateds('attribute_catalog', 'query.field', 'parentId', array('type', 'QueryField'));
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
		if($alias = $this->getCode()) {
			if($fields)
			foreach($fields as $field) {
				$rs[] = $alias . '.' . $field->getLeftField() . ($field->getCode()? ' as ' . $field->getCode() : '');
			}
			if(!count($rs)) {
				return $alias.'.*';
			}
			return implode(', ', $rs);
		} else {
			if($fields)
			foreach($fields as $field) {
				$rs[] = $field->getLeftField() . ($field->getCode() ? ' as ' . $field->getCode() : '');
			}
			if(!count($rs)) {
				return '*';
			}
			return implode(', ', $rs);
		}
	}
	public function getSQL() {
		$query = $this;
		$querySet = $query->getSet();
		$fields = array();
		$fields[] = $query->getImplodedFields();
		$tables = $query->getTables();
		foreach($tables as $table) {
			$fields[] = $table->getImplodedFields();
		}
		$querySql = 'select ' . implode(', ',$fields) . ' from ' . $querySet->getCode() . ' as ' . $query->getCode();

		if($tables) {
			foreach($tables as $table) {
				$tableSet = $table->getSet();
				$querySql .= "\n".' inner join ' . $tableSet->getCode() . ' as ' . $table->get('code', $tableSet->getCode()) . ' on ' . 
					$query->get('code', $querySet->getCode()) . '.' .  $table->getRightField() . '=' . $table->get('code', $tableSet->getCode()) 
						. '.' . $table->get('leftField', 'id');
				if($table->getadditionConditions()) {
					$querySql .= ' and ' . $table->getadditionConditions();
				}
			}
		}

		if($query->getConditions()) {
			$querySql .= ' where ' . $query->getConditions();
		}
		if($query->getGroupBy()) {
			$querySql .= ' group by ' . $query->getGroupBy();
		}
		if($query->getHavingConditions()) {
			$querySql .= ' having ' . $query->getHavingConditions();
		}
		if($query->getOrderBy()) {
			$querySql .= ' order by ' . $query->getOrderBy();
		}
		return $querySql;
	}
	
	public function getTableSQL() {
		$query = $this;
		$querySet = $query->getSet();
		$tables = $query->getTables();
		$querySql = $querySet->getCode() . ' as ' . $query->getCode();
		if($tables) {
			foreach($tables as $table) {
				$tableSet = $table->getSet();
				$querySql .= "\n".' '.$table->get('joinType', 'inner').' join ' . $tableSet->getCode() . ' as ' . $table->get('code', $tableSet->getCode()) . ' on ' . 
					$query->get('code', $querySet->getCode()) . '.' .  $table->get('rightField', 'id') . '=' . $table->get('code', $tableSet->getCode()) 
						. '.' . $table->get('leftField', 'id');
				if($table->getadditionConditions()) {
					$querySql .= ' and ' . $table->getadditionConditions();
				}
			}
		}
		return $querySql;
	}
	
	public function getFieldsSQL() {
		$query = $this;
		$querySet = $query->getSet();
		$fields = array();
		$fields[] = $query->getImplodedFields();
		$tables = $query->getTables();
		foreach($tables as $table) {
			$fields[] = $table->getImplodedFields();
		}
		return implode(', ', $fields);
	}
}
