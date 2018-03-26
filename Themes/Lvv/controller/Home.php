<?php
pzk_import_controller('Themes/Default', 'Home');
class PzkHomeController extends PzkThemesDefaultHomeController {
	public $masterPosition = 'wrapper';
	public function indexAction(){
		$this->initPage();
		$this->append('home/content');
		$this->display();
	}
}
?>