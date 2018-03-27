<?php
class PzkEntityAttributeAttributeModel extends PzkEntityModel {
	public $table = 'attribute_attribute';
	public function getFilters() {
		return _db()->selectAll()->from('attribute_filter')->whereAtributeId($this->get('id'))->result('Attribute.Filter');
	}
}