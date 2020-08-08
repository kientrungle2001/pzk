<?php

/**
 *
 */
class PzkHomeController extends PzkController{

	public $masterPage	=	"index";
	
	public function indexAction(){
		if(pzk_themes('story')) {
			$this->initPage()
			->append('home', 'wrapper')
			->display();
		} else {
			$this->initPage()
				->append('<home.content scriptable="true" cacheable="true" cacheParams="layout" layout="home/content_home" />')
				->display();	
		}
        
	}
	
	
	
	public function updateAction() {
		require_once BASE_DIR . '/lib/string.php';
		$categories = _db()->selectNone()->selectId()->fromCategories()->result();
		foreach($categories as $category) {
			$categoryEntity = _db()->getTableEntity('categories')->load($category['id']);
			echo $categoryEntity->getName() . '<br />';
			echo bodau(trim($categoryEntity->getName())) . '<br />';
			$categoryEntity->update(array('alias' => bodau(trim($categoryEntity->getName()))));
			//$categoryEntity->save();
		}
		$categories = _db()->selectNone()->selectId()->fromNews()->result();
		foreach($categories as $category) {
			$categoryEntity = _db()->getTableEntity('news')->load($category['id']);
			echo $categoryEntity->getTitle() . '<br />';
			echo bodau(trim($categoryEntity->getTitle())) . '<br />';
			$categoryEntity->update(array('alias' => bodau(trim($categoryEntity->getTitle()))));
			//$categoryEntity->save();
		}
	}

}
