<?php
class PzkFilterConstant {
	
	public static $areacodeParent = array(
		ATTR_INDEX 		=> 'parent',
		ATTR_TYPE 			=> 'select',
		ATTR_LABEL 		=> 'Lọc theo địa điểm',
		ATTR_TABLE 		=> 'areacode',
		ATTR_SHOW_VALUE 	=> 'id',
		ATTR_SHOW_NAME 	=> 'name',
	);
	public static $categoryIds = array(
		ATTR_INDEX 		=> 'categoryIds',
		ATTR_TYPE 			=> 'select',
		ATTR_LABEL 		=> 'Dạng bài tập',
		ATTR_TABLE 		=> 'categories',
		ATTR_SHOW_VALUE 	=> 'id',
		ATTR_SHOW_NAME 	=> 'name',
		'like' 			=> true,
		ATTR_CONDITION		=> '`document`=1'
	);
	public static $subjectCategory = array(
		ATTR_INDEX 		=> 'categoryId',
		ATTR_TYPE 			=> 'select',
		ATTR_LABEL 		=> 'Theo danh mục',
		ATTR_TABLE 		=> 'categories',
		ATTR_SHOW_VALUE 	=> 'id',
		ATTR_SHOW_NAME 	=> 'name',
		ATTR_CONDITION		=> 'parent = \'47\''
	);
	public static $newsCategory = array(
		ATTR_INDEX 		=> 'categoryId',
		ATTR_TYPE 			=> 'select',
		ATTR_LABEL 		=> 'Theo danh mục',
		ATTR_TABLE 		=> 'categories',
		ATTR_SHOW_VALUE 	=> 'id',
		ATTR_SHOW_NAME 	=> 'name',
		ATTR_CONDITION		=> 'router like \'%news%\''
	);
	public static $featuredCategory = array(
		ATTR_INDEX 		=> 'categoryId',
		ATTR_TYPE 			=> 'select',
		ATTR_LABEL 		=> 'Theo danh mục',
		ATTR_TABLE 		=> 'categories',
		ATTR_SHOW_VALUE 	=> 'id',
		ATTR_SHOW_NAME 	=> 'name',
		ATTR_CONDITION		=> 'router like \'%featured%\''
	);
	public static $documentCategory = array(
		ATTR_INDEX 		=> 'categoryId',
		ATTR_TYPE 			=> 'select',
		ATTR_LABEL 		=> 'Theo danh mục',
		ATTR_TABLE 		=> 'categories',
		ATTR_SHOW_VALUE 	=> 'id',
		ATTR_SHOW_NAME 	=> 'name',
		ATTR_CONDITION		=> 'router like \'%document%\''
	);
	public static $campaign = array(
		ATTR_INDEX 		=> 'campaignId',
		ATTR_TYPE 			=> 'select',
		ATTR_LABEL 		=> 'Theo chiến dịch',
		ATTR_TABLE 		=> 'campaign',
		ATTR_SHOW_VALUE 	=> 'id',
		ATTR_SHOW_NAME 	=> 'campaignName',
	);
	
	public static $status = array(
		ATTR_INDEX			=>	'status',
		ATTR_TYPE 			=> 	'status',
		ATTR_LABEL 		=> 	'Trạng thái'
	);
	
	public static $trial = array(
		ATTR_INDEX			=>	'trial',
		ATTR_TYPE 			=> 	'status',
		ATTR_LABEL 		=> 	'Dùng thử'
	);
	
	public static $featuredId = array(
		ATTR_INDEX => 'featuredId',
		ATTR_TYPE => 'select',
		ATTR_LABEL => 'Theo bài viết',
		ATTR_TABLE => 'featured',
		ATTR_SHOW_VALUE => 'id',
		ATTR_SHOW_NAME => 'title',
	);
	
	public static $newsId = array(
		ATTR_INDEX => 'newsId',
		ATTR_TYPE => 'select',
		ATTR_LABEL => 'Theo bài viết',
		ATTR_TABLE => 'news',
		ATTR_SHOW_VALUE => 'id',
		ATTR_SHOW_NAME => 'title',
	);
	
	public static $positionOfModule = array(
		ATTR_INDEX => 'position',
		ATTR_TYPE => 'select',
		ATTR_LABEL => 'Vị trí',
		ATTR_TABLE => 'flat_module',
		ATTR_SHOW_VALUE => 'position',
		ATTR_SHOW_NAME => 'position',
	);
	
	public static function  get($field, $replace) {
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

function filter_fields($fields, $replace) {
	return PzkFilterConstant::gets($fields, $replace);
}