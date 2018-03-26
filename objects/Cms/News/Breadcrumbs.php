<?php
pzk_import('Core.Db.Detail');
class PzkCmsNewsBreadcrumbs extends PzkCoreDbDetail {
	public $layout = 'cms/news/breadcrumbs';
	public $css = 'news';
	public $categoryTag = 'h2';
	public $newsTag = 'h3';
	public $delimiter = '&gt;';
	public $table = 'news';
	public function getCategories() {
		$item = $this->getItem();
		$category = _db()->getEntity('Cms.Category')->load($item['categoryId']);
		if($category->get('parents')) {
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
			'label'		=> 'Tin tức',
			'table'		=> 'news',
			'show_name'	=> 'title',
			'show_value'=> 'id'
		),
		array(
			'index' 	=> 'categoryTag',
			'type'		=> 'text',
			'label'		=> 'Thẻ Danh mục'
		),
		array(
			'index' 	=> 'newsTag',
			'type'		=> 'text',
			'label'		=> 'Thẻ Tin tức'
		),
		array(
			'index' 	=> 'delimiter',
			'type'		=> 'text',
			'label'		=> 'Phân cách'
		),
	);
	
}