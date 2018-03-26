<?php 
pzk_import('Cms.Detail');
class PzkCmsNewsDetail extends PzkCmsDetail {
    public $layout 	= 'cms/news/detail';
	public $table 	= 'news';
	
	public function getNews() {
		return $this->getItem();
	}
	
	public function getRelatedNews() {
		return $this->getRelateds();
	}
	public function getCategories() {
		$item = $this->getItem();
		$category = _db()->getEntity('Cms.Category')->load($item['categoryId']);
		if($category->getParents()) {
			return $category->getParentCategories();
		} else {
			return array();
		}
	}
}
 ?>