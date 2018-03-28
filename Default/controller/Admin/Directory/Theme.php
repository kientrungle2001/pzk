<?php
class PzkAdminDirectoryThemeController extends PzkBackendController {
	public function indexAction() {
		$directory = $this->parse('admin/directory/theme/index');
		$this->render($directory);
	}
	public function detailAction() {
		$theme = $this->parse('admin/directory/theme/detail');
		$this->initPage();
		$this->append($theme);
		$theme->set('itemId', pzk_request()->getSegment(3));
		$this->display();
	}
	public function delAction($id) {
		// delete theme
		// delete layout
		// delete position
		// delete controller
		// delete module
		echo 'not implemented';
	}
	public function layoutDetailAction($id) {
		// show theme > layout name
		// show positions
		$layout = $this->parse('admin/directory/theme/layout');
		$this->initPage();
		$this->append($layout);
		$layout->set('itemId', $id);
		$this->display();
	}
	
	public function designAction($id) {
		$theme 	= pzk_request('theme');
		$page	= pzk_request('page');
	}
}