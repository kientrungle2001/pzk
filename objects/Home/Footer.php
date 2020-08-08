<?php 
	/**
	 * Object Home/Footer default
	 * Object Home/Footer for footer of themes vnwomen
	 */
	class PzkHomeFooter extends PzkObject{
		public $layout 		= 'home/footer';
		public $cacheable 	= false;
		public $cacheParams	= 'layout';
		
		public function hash() {
			$addInfo = (pzk_session()->getUserId() && (pzk_request()->getSoftwareId() ==1) && (pzk_session()->getEmail() =='' || pzk_session()->getPhone() == ''));
			return md5($addInfo . parent::hash());
		}
	}
 ?>