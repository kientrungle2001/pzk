<?php
class PzkHomeController extends PzkController {
	public $masterPage = 'onepage';
	public function indexAction() {
		$this->initPage();
		$this->display();
	}
	
	public function multiAction() {
		partial('themes/cms/layouts/multi');
	}
}