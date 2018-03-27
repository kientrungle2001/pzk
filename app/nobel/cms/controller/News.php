<?php
require_once BASE_DIR . '/core/controller/Module.php';
class PzkNewsController extends PzkModuleController {
	public $masterPage = 'onepage';
	public function indexAction($id) {
		$this->initPage();
		$this->loadModules('newsList');
		$newsList = pzk_element('newsList');
		if($newsList) {
			$newsList->set('parentId', $id);
		}
		$this->display();
	}
	public function detailAction($id) {
		$this->initPage();
		$this->loadModules('newsDetail');
		$detail = pzk_element('newsDetail');
		$detail->set('itemId', $id);
		$breadcrumbs = pzk_element('breadcrumbs');
		if($breadcrumbs) {
			$breadcrumbs->set('itemId', $id);
		}
		$relatedNews = pzk_element('relatedNews');
		if($relatedNews) {
			$item = $detail->getItem();
			$categoryId = $item['categoryId'];
			$relatedNews->set('parentId', $categoryId);
		}
		$this->display();
	}
}