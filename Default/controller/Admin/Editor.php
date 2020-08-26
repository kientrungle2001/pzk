<?php
class PzkAdminEditorController extends PzkBackendController {
	public $masterPage = 'admin/home/index';
	public $masterPosition = JOIN_TYPE_LEFT;
	public function indexAction() {
		$this->render('admin/editor/index');
	}
	
	public function addAction() {
		$this->render('admin/editor/add');
	}
	
	public function addPostAction() {
		$package = pzk_request()->getPackage();
		$name = pzk_request()->getName();
		var_dump($package);
		var_dump($name);
	}
	
	public function editAction() {
		$object = pzk_request()->getObject();
		$type = pzk_request()->getType();
		$package = trim(preg_replace('/[^\/]*$/','', $object), '/');
		pzk_request()->setPackage($package);
		$this->initPage();
		$module = $this->parse('admin/editor/edit');
		$editor = pzk_element('editor');
		if($editor) {
			$editor->setObject($object);
			$editor->setType($type);
		}
		$this->append($module);
		$this->display();
	}
	
	
	public function saveAction() {
		$object = urldecode(pzk_request()->getObject());
		$type = pzk_request()->getType();
		$fileName = pzk_request()->getFileName();
		$fileContent = pzk_request()->getFileContent();
		if(file_exists($fileName)) {
			file_put_contents($fileName, $fileContent);
		}
		$this->redirect(pzk_request()->buildAction('edit', array('object' => $object, 'type' => $type)));
	}
	
	public function pageAction() {
		$page = $this->parse('index');
		$xml = pzk_request()->getXml();
		$obj = $this->parse($xml);
		$position = pzk_element('wrapper');
		if($position) {
			$position->append($obj);
		}
		$page->display();
	}
	
	public function layoutAction() {
		$content = pzk_request()->getContent();
		echo $content;
	}
	
	public function openAction() {
		$file 		= pzk_request()->getFile();
		$type 		= pzk_request()->getType();
		$backHref 	= pzk_request()->getBackHref();
		$this->initPage();
		$module = $this->parse('admin/editor/file');
		$editor = pzk_element('editor');
		if($editor) {
			$editor->setFile($file);
			$editor->setType($type);
			$editor->setBackHref($backHref);
		}
		$this->append($module);
		$this->display();
	}
	
	public function filePostAction() {
		$backHref 		= pzk_request()->getBackHref();
		$fileName 		= pzk_request()->getFile();
		$fileContent 	= pzk_request()->getFileContent();
		
		file_put_contents(BASE_DIR . $fileName, $fileContent);
		header('Location: ' . $backHref);
		pzk_system()->halt();
	}
}