<?php
class PzkAdminEditorController extends PzkBackendController {
	public $masterPage = 'admin/home/index';
	public $masterPosition = 'left';
	public function indexAction() {
		$this->render('admin/editor/index');
	}
	
	public function addAction() {
		$this->render('admin/editor/add');
	}
	
	public function addPostAction() {
		$package = pzk_request('package');
		$name = pzk_request('name');
		var_dump($package);
		var_dump($name);
	}
	
	public function editAction() {
		$object = pzk_request()->get('object');
		$type = pzk_request()->get('type');
		$package = trim(preg_replace('/[^\/]*$/','', $object), '/');
		pzk_request()->set('package', $package);
		$this->initPage();
		$module = $this->parse('admin/editor/edit');
		$editor = pzk_element('editor');
		if($editor) {
			$editor->set('object', $object);
			$editor->set('type', $type);
		}
		$this->append($module);
		$this->display();
	}
	
	
	public function saveAction() {
		$object = urldecode(pzk_request()->get('object'));
		$type = pzk_request()->get('type');
		$fileName = pzk_request()->get('fileName');
		$fileContent = pzk_request()->get('fileContent');
		if(file_exists($fileName)) {
			file_put_contents($fileName, $fileContent);
		}
		$this->redirect(pzk_request()->buildAction('edit', array('object' => $object, 'type' => $type)));
	}
	
	public function pageAction() {
		$page = $this->parse('index');
		$xml = pzk_request('xml');
		$obj = $this->parse($xml);
		$position = pzk_element('wrapper');
		if($position) {
			$position->append($obj);
		}
		$page->display();
	}
	
	public function layoutAction() {
		$content = pzk_request('content');
		echo $content;
	}
	
	public function openAction() {
		$file 		= pzk_request('file');
		$type 		= pzk_request('type');
		$backHref 	= pzk_request('backHref');
		$this->initPage();
		$module = $this->parse('admin/editor/file');
		$editor = pzk_element('editor');
		if($editor) {
			$editor->set('file', $file);
			$editor->set('type', $type);
			$editor->set('backHref', $backHref);
		}
		$this->append($module);
		$this->display();
	}
	
	public function filePostAction() {
		$backHref 		= pzk_request('backHref');
		$fileName 		= pzk_request('file');
		$fileContent 	= pzk_request('fileContent');
		
		file_put_contents(BASE_DIR . $fileName, $fileContent);
		header('Location: ' . $backHref);
		pzk_system()->halt();
	}
}