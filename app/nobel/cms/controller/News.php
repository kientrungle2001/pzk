<?php
require_once BASE_DIR . '/core/controller/Module.php';
class PzkNewsController extends PzkModuleController {
	public $masterPage = 'onepage';
	public function indexAction($id) {
		$this->initPage();
		$this->loadModules('newsList');
		$newsList = pzk_element()->getNewsList();
		if($newsList) {
			$newsList->setParentId( $id);
		}
		$this->display();
	}
	public function detailAction($id) {
		$this->initPage();
		$this->loadModules('newsDetail');
		$detail = pzk_element()->getNewsDetail();
		$detail->setItemId( $id);
		$breadcrumbs = pzk_element()->getBreadcrumbs();
		if($breadcrumbs) {
			$breadcrumbs->setItemId( $id);
		}
		$relatedNews = pzk_element()->getRelatedNews();
		if($relatedNews) {
			$item = $detail->getItem();
			$categoryId = $item['categoryId'];
			$relatedNews->setParentId( $categoryId);
		}
		$this->display();
	}
}