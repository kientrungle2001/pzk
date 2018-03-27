<?php
class PzkNewsController extends PzkController {
	public function indexAction($id) {
		$this->loadLayout();
		$this->display();
	}
	public function detailAction($id) {
		$this->loadLayout();
		$detail = pzk_element('detail');
		$detail->setItemId($id);
		$breadcrumbs = pzk_element('breadcrumbs');
		if($breadcrumbs) {
			$breadcrumbs->setItemId($id);
		}
		$this->display();
	}
}