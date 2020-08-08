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
		pzk_page()->set('title', 'Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
		pzk_page()->set('keywords', 'Giáo dục');
		pzk_page()->set('description', 'Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
		pzk_page()->set('img', '/Default/skin/nobel/Themes/Story/media/logo.png');
		pzk_page()->set('brief', 'Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
		$this->display();
        
	}
	public function pageAction(){
		$obj = $this->parse('home/index');
		$obj->set('isAjax', true);
		$obj->set('page', pzk_request()->get('page'));
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
			$id = pzk_request('id');
			$parentid = pzk_request('parentid');
			$detail = pzk_element()->getDetail();
			$detail->set('itemId', $id);
			$parent = pzk_element('parent');
			$parent->set('parentId', $parentid);
			$breadcrumbs = pzk_element('breadcrumbs');
			$breadcrumbs->set('itemId', $id);
			$newsEntity = _db()->getTableEntity('news')->load($id);
		
			pzk_page()->set('title', $newsEntity->get('title'));
			pzk_page()->set('keywords', $newsEntity->get('meta_keywords'));
			pzk_page()->set('description', $newsEntity->get('meta_description'));
			pzk_page()->set('img', $newsEntity->get('img'));
			pzk_page()->set('brief', $newsEntity->get('brief'));
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
