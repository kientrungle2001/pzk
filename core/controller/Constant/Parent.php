<?php
class PzkParentConstant {
	public static $creator = array(
		ATTR_INDEX	=> 'creator',
		ATTR_TABLE	=> 'admin',
		'title'	=> 'Người tạo',
		ATTR_LABEL	=> 'Người tạo',
		'referenceField'	=> 'creatorId',
		'fieldSettings' => array(
			array(
			ATTR_INDEX => 'name',
			ATTR_TYPE => 'text',
			ATTR_LABEL => 'Tên người tạo'
			)
		)
	
	);
	public static $modifier = array(
		ATTR_INDEX	=> 'modifier',
		ATTR_TABLE	=> 'admin',
		'title'	=> 'Người sửa',
		ATTR_LABEL	=> 'Người sửa',
		'referenceField'	=> 'modifiedId',
		'fieldSettings' => array(
			array(
			ATTR_INDEX => 'name',
			ATTR_TYPE => 'text',
			ATTR_LABEL => 'Tên người sửa'
			)
		)
	
	);
	
	public static $category = array(
		ATTR_INDEX	=> 'category',
		ATTR_TABLE	=> 'categories',
		'module'	=> 'category',
		'selectFields'	=> '*',
		'title'	=> 'Danh mục',
		ATTR_LABEL	=> 'Danh mục',
		'referenceField'	=> 'categoryId',
		'fieldSettings' => false
	);
	
	public static $parent = array(
		ATTR_INDEX	=> 'category',
		ATTR_TABLE	=> 'categories',
		'module'	=> 'category',
		'selectFields'	=> '*',
		'title'	=> 'Danh mục',
		ATTR_LABEL	=> 'Danh mục',
		'referenceField'	=> 'parent',
		'fieldSettings' => false
	);
	
	public static function  get($field, $replace, $fieldSettings = false) {
		$dom = pzk_parse_selector($field);
		$tagName = $dom['tagName'];
		$result = self::$$tagName;
		foreach ($dom['attrs'] as $attr) {
			$result[$attr['name']] = $attr['value'];
		}
		foreach($result as $key => $val) {
			if(is_string($val))
				$result[$key] = str_replace('{replace}', $replace, $val);
		}
		if($fieldSettings) {
			$result['fieldSettings'] = $fieldSettings;
		}
		return $result;
	}
	
	public static function  gets($fields, $replace) {
		if(is_string($fields))
		$fields = explodetrim(',', $fields);
		$result = array();
		foreach($fields as $field) {
			$result[] = self::get($field, $replace);
		}
		return $result;
	}
}
?>