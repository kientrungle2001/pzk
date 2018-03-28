<?php
pzk_import_controller('Default', 'Document');
class PzkDocumentController extends PzkDefaultDocumentController{

	public $masterPage		=	'index';
	public $masterPosition 	= 	'wrapper';
	
	public function onthiAction(){
		$this->initPage()
		->append('education/document/onthi');
		pzk_page()->set('title', 'Kinh nghiệm ôn thi');
		pzk_page()->set('keywords', 'Kinh nghiệm ôn thi');
		pzk_page()->set('description', 'Các kinh nghiệm giúp học sinh ôn tập các môn học bằng tiếng Anh');
		pzk_page()->set('img', BASE_URL . '/Default/skin/nobel/Themes/Story/media/logo.png');
		pzk_page()->set('brief', 'Các kinh nghiệm giúp học sinh ôn tập các môn học bằng tiếng Anh');
		$this->display();
	}
	public function chitietAction(){
		$this->initPage();
		
		$newsId = intval(pzk_request('id'));
		
		if(!$newsId) $newsId = intval(pzk_request()->getSegment(3));
		
		pzk_request()->set('id', $newsId);
		
		$newsEntity = _db()->getTableEntity('news')->load($newsId);
		
		pzk_page()->set('title', $newsEntity->get('title'));
		pzk_page()->set('keywords', $newsEntity->get('meta_keywords'));
		pzk_page()->set('description', $newsEntity->get('meta_description'));
		pzk_page()->set('img', $newsEntity->get('img'));
		pzk_page()->set('brief', $newsEntity->get('brief'));
		
		$news = $this->parse('education/document/chitiet');
		$detail = pzk_element('detail');
		
		if($detail) {
			$detail->set('itemId', $newsId);
			pzk_stat()->log('news', $newsId);
			$this->append($news);
		}
		
		$this->display();
	}
}
