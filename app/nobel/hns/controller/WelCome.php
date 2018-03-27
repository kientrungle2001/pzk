<?php 
	/**
	* 
	*/
	class PzkWelComeController extends PzkController{
		
		public $masterPage	=	"home";
		/*
		public function __construct() {
			
			$login = pzk_session()->get('login');
		
			if($login) {
				$this->redirect('Home/index');
			}
		}*/
		
		public function emptyAction() {
			
		}
		
		public function indexAction(){
				
			$this->initPage()->display();
		}
	}
	
?>