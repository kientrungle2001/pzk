<?php
class PzkAdminDirectoryController extends PzkBackendController {
	public function indexAction() {
		$directory = $this->parse('admin/directory/index');
		$directory->set('parentId', pzk_request()->getSegment(3));
		$this->render($directory);
	}
}