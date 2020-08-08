<?php
pzk_import('Core.Db.Detail');
class PzkCmsCategoryBreadcrumbs extends PzkCoreDbDetail {
	public $layout = 'cms/category/breadcrumbs';
	public $css = 'news';
	public $categoryTag = 'h2';
	public $delimiter = '&gt;';
	public $table = 'categories';
	public function getCategories() {
		$category = _db()->getEntity('Cms.Category')->load($this->getItemId());
		if($category->getParents()) {
			return $category->getParentCategories();
		} else {
			return array();
		}
		
	}
	public static $settings = array(
		array(
			'index' 	=> 'id',
			'type'		=> 'text',
			'label'		=> 'ID'
		),
		array(
			'index' 	=> 'itemId',
			'type'		=> 'select',
			'label'		=> 'Danh mục',
			'table'		=> 'categories',
			'show_name'	=> 'name',
			'show_value'=> 'id'
		),
		array(
			'index' 	=> 'categoryTag',
			'type'		=> 'text',
			'label'		=> 'Thẻ Danh mục'
		),
		array(
			'index' 	=> 'delimiter',
			'type'		=> 'text',
			'label'		=> 'Phân cách'
		),
	);
	
}