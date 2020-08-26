<?php

/**
 *
 */
class PzkHomeController extends PzkController{

	public $masterPage	=	"index";
	public $masterPosition = 'wrapper';
	
	public function indexAction(){
		$this->initPage()
		->append('home', 'wrapper');
		pzk_page()->setTitle('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
		pzk_page()->setKeywords('Giáo dục');
		pzk_page()->setDescription('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
		pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
		pzk_page()->setBrief('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
		$this->display();
        
	}
	public function pageAction(){
		$obj = $this->parse('home/index');
		$obj->setIsAjax(true);
		$obj->setPage(pzk_request()->getPage());
		$obj->display();
		
	}
	public function newsAction(){
			$this->initPage()
			->append('news', 'wrapper')
			->display();
	}
	public function newsdetailAction(){
			$this->initPage()
			->append('newsdetail', 'wrapper');
			$id = pzk_request()->getId();
			$parentid = pzk_request()->getParentid();
			$detail = pzk_element()->getDetail();
			$detail->setItemId($id);
			$parent = pzk_element('parent');
			$parent->setParentId($parentid);
			$breadcrumbs = pzk_element('breadcrumbs');
			$breadcrumbs->setItemId($id);
			$newsEntity = _db()->getTableEntity('news')->load($id);
		
			pzk_page()->setTitle($newsEntity->getTitle());
			pzk_page()->setKeywords($newsEntity->getMeta_keywords());
			pzk_page()->setDescription($newsEntity->getMeta_description());
			pzk_page()->setImg($newsEntity->getImg());
			pzk_page()->setBrief($newsEntity->getBrief());
			$this->display();
	}
	
	public function checkIsLoggedInAction () {
		if(pzk_session('userId')) {
			echo '1';
		} else {
			echo '0';
		}
	}
	

}
