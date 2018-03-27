<?php
class PzkEntityAttributeSetGroupAttributeModel extends PzkEntityModel {
	public $table = 'attribute_set_attributes';
	public function getEntity() {
		return _db()->getEntity('Attribute.Attribute')->load($this->get('attributeId'));
	}
}