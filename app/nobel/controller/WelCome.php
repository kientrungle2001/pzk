<?php 
	/**
	* 
	*/
	class PzkWelComeController extends PzkController{
		
		public $masterPage	=	"home";
		
		public function indexAction(){
			
			$this->initPage()->display();
		}
	}
	
	
	
?>