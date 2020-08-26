<?php
pzk_import_controller('Default', 'Document');
class PzkDocumentController extends PzkDefaultDocumentController{

	public $masterPage		=	'index';
	public $masterPosition 	= 	'wrapper';
	
	public function onthiAction(){
		$this->initPage()
		->append('education/document/onthi');
		pzk_page()->setTitle('Kinh nghiệm ôn thi');
		pzk_page()->setKeywords('Kinh nghiệm ôn thi');
		pzk_page()->setDescription('Các kinh nghiệm giúp học sinh ôn tập các môn học bằng tiếng Anh');
		pzk_page()->setImg(BASE_URL . '/Default/skin/nobel/Themes/Story/media/logo.png');
		pzk_page()->setBrief('Các kinh nghiệm giúp học sinh ôn tập các môn học bằng tiếng Anh');
		$this->display();
	}
	public function chitietAction(){
		$this->initPage();
		
		$newsId = intval(pzk_request()->getId());
		
		if(!$newsId) $newsId = intval(pzk_request()->getSegment(3));
		
		pzk_request()->setId($newsId);
		
		$newsEntity = _db()->getTableEntity('news')->load($newsId);
		
		pzk_page()->setTitle($newsEntity->getTitle());
		pzk_page()->setKeywords($newsEntity->getMeta_keywords());
		pzk_page()->setDescription($newsEntity->getMeta_description());
		pzk_page()->setImg($newsEntity->getImg());
		pzk_page()->setBrief($newsEntity->getBrief());
		
		$news = $this->parse('education/document/chitiet');
		$detail = pzk_element()->getDetail();
		
		if($detail) {
			$detail->setItemId($newsId);
			pzk_stat()->log('news', $newsId);
			$this->append($news);
		}
		
		$this->display();
	}
}
