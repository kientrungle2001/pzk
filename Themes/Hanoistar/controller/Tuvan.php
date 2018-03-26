<?php
pzk_import_controller('Themes/Default', 'Home');
class PzkTuvanController extends PzkThemesDefaultHomeController{
	
	public function indexAction(){
		$this->initPage();
		pzk_page()->set('title', 'Tư vấn');
		pzk_page()->set('keywords', 'Giáo dục');
		pzk_page()->set('description', 'Tư vấn');
		pzk_page()->set('img', '/Default/skin/nobel/Themes/Story/media/logo.png');
		pzk_page()->set('brief', 'Tư vấn');
		$this->append('tuvan/tuvan')
		->display();
	}
	public function saveAction(){
		$frontendmodel = pzk_model('Frontend');
		$userId	=	pzk_session('userId');
		$rows = array(
				'content' => pzk_request()->get('content'),
				'type'  => pzk_request()->get('type'),
				'userId'  => $userId,
				'created' => date(DATEFORMAT, $_SERVER['REQUEST_TIME'])
				
			);
			
		$frontendmodel->save($rows, 'tuvan');
		echo 1;
	}
}
?>