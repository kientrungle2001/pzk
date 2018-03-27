<?php
class PzkEntityAttributeSetModel extends PzkEntityModel {
	public $table = 'attribute_set';
	public function getGroups() {
		return _db()->selectAll()->from('attribute_set_groups')->where(array('setId', $this->get('id')))->result('Attribute.Set.Group');
	}
	public function getAttributes() {
		$attributes = array();
		$groups = $this->getGroups();
		foreach($groups as $group) {
			$groupAttributes = $group->getAttributes();
			foreach ($groupAttributes as $attribute) {
				$attributes[] = $attribute;
			}
		}
		return $attributes;
	}
}