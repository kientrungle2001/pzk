<?php

/**
 *
 */
class PzkHomeController extends PzkController{

	public $masterPage	=	"index";
	public $masterPosition = 'wrapper';
	
	public function indexAction(){
		$this->initPage();
		
		$this->append('home', 'wrapper');
		$this->display();
        
	}
	public function pageAction(){
		$obj = $this->parse('home/index');
		$obj->setIsAjax(true);
		$obj->setPage(pzk_request()->getPage());
		$obj->display();
		
	}
	public function aboutAction(){
			$this->initPage()
			->append('about', 'wrapper')
			->display();
	}
	public function practiceAction(){
			$this->initPage()
			->append('practice', 'wrapper')
			->display();
	}
	public function detailAction(){
			$this->initPage()
			->append('detail', 'wrapper')
			->display();
	}
	public function userAction(){
			$this->initPage()
			->append('user', 'wrapper')
			->display();
	}
	public function profileAction(){
			$this->initPage()
			->append('user/profile/detail')
			->display();
	}
	public function documentAction(){
			$this->initPage()
			->append('document', 'wrapper')
			->display();
	}
	public function documentdetailAction(){
			$this->initPage()
			->append('documentdetail', 'wrapper')
			->display();
	}
	public function documentsubjectAction(){
			$this->initPage()
			->append('documentsubject', 'wrapper')
			->display();
	}
	public function relaxAction(){
			$this->initPage()
			->append('relax', 'wrapper')
			->display();
	}

}
