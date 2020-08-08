<?php
class PzkDocumentController extends PzkController{

	public $masterPage		=	'index';
	public $masterPosition 	= 	'left';
	
	public function homeAction(){
		$this->initPage()
		->append('education/document/home');
		pzk_page()->set('title', 'Tài liệu học tập');
		pzk_page()->set('keywords', 'Tài liệu học tập');
		pzk_page()->set('description', 'Các tài liệu giúp học sinh ôn tập các môn học bằng tiếng Anh');
		pzk_page()->set('img', BASE_URL . '/default/skin/nobel/Themes/story/media/logo.png');
		pzk_page()->set('brief', 'Các tài liệu giúp học sinh ôn tập các môn học bằng tiếng Anh');
		$this->display();
	}
	
	public function indexAction(){
		$class 		= pzk_request('class');
		$categoryId = pzk_request()->getSegment(3);
		$this->initPage()
		->append('education/document/index');
		
		$catEntity 	= _db()->getTableEntity('categories')->load($categoryId, 1800);
		
		pzk_page()->set('title', 'Tài liệu: ' . $catEntity->get('name'));
		pzk_page()->set('keywords', $catEntity->get('meta_keywords'));
		pzk_page()->set('description', $catEntity->get('meta_description'));
		pzk_page()->set('img', $catEntity->get('img'));
		pzk_page()->set('brief', $catEntity->get('brief'));
		
		$document 	= pzk_element('document');
		$document->set('class', $class);
		$document->set('categoryId', $categoryId);
		$document->set('parentMode', true);
		$document->set('parentId', $categoryId);
		$document->set('parentField', 'categoryId');
		$document->addFilter('classes', $class, 'like');
		$this->display();
	}
	
	public function detailAction(){
		$class 		= pzk_request('class');
		$categoryId = pzk_request()->getSegment(3);
		$this->initPage()
			->append('education/document/detail');
			
		$documentId = pzk_request('id');
		
		$documentEntity = _db()->getTableEntity('document')->load($documentId, 1800);
		
		pzk_page()->set('title', $documentEntity->get('title'));
		pzk_page()->set('keywords', $documentEntity->get('meta_keywords'));
		pzk_page()->set('description', $documentEntity->get('meta_description'));
		pzk_page()->set('img', $documentEntity->get('img'));
		pzk_page()->set('brief', $documentEntity->get('	brief'));
		
		
		$detail 	= pzk_element()->getDetail();
		
		if($detail) {
			$detail->set('itemId', pzk_request()->get('id'));
			pzk_stat()->log('document', $documentId);
		}

		$this->display();
	}
	
}
