<?php
class PzkDocumentController extends PzkController{

	public $masterPage		=	'index';
	public $masterPosition 	= 	'left';
	
	public function homeAction(){
		$this->initPage()
		->append('education/document/home');
		pzk_page()->setTitle('Tài liệu học tập');
		pzk_page()->setKeywords('Tài liệu học tập');
		pzk_page()->setDescription('Các tài liệu giúp học sinh ôn tập các môn học bằng tiếng Anh');
		pzk_page()->setImg(BASE_URL . '/default/skin/nobel/Themes/story/media/logo.png');
		pzk_page()->setBrief('Các tài liệu giúp học sinh ôn tập các môn học bằng tiếng Anh');
		$this->display();
	}
	
	public function indexAction(){
		$class 		= pzk_request('class');
		$categoryId = pzk_request()->getSegment(3);
		$this->initPage()
		->append('education/document/index');
		
		$catEntity 	= _db()->getTableEntity('categories')->load($categoryId, 1800);
		
		pzk_page()->setTitle('Tài liệu: ' . $catEntity->getName());
		pzk_page()->setKeywords($catEntity->getMeta_keywords());
		pzk_page()->setDescription($catEntity->getMeta_description());
		pzk_page()->setImg($catEntity->getImg());
		pzk_page()->setBrief($catEntity->getBrief());
		
		$document 	= pzk_element('document');
		$document->setClass($class);
		$document->setCategoryId($categoryId);
		$document->setParentMode(true);
		$document->setParentId($categoryId);
		$document->setParentField('categoryId');
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
		
		pzk_page()->setTitle($documentEntity->getTitle());
		pzk_page()->setKeywords($documentEntity->getMeta_keywords());
		pzk_page()->setDescription($documentEntity->getMeta_description());
		pzk_page()->setImg($documentEntity->getImg());
		pzk_page()->setBrief($documentEntity->get	brief());
		
		
		$detail 	= pzk_element()->getDetail();
		
		if($detail) {
			$detail->setItemId(pzk_request()->getId());
			pzk_stat()->log('document', $documentId);
		}

		$this->display();
	}
	
}
