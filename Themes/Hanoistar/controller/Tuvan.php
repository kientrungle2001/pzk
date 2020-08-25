<?php
pzk_import_controller('Themes/Default', 'Home');
class PzkTuvanController extends PzkThemesDefaultHomeController{
	
	public function indexAction(){
		$this->initPage();
		pzk_page()->setTitle('Tư vấn');
		pzk_page()->setKeywords('Giáo dục');
		pzk_page()->setDescription('Tư vấn');
		pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
		pzk_page()->setBrief('Tư vấn');
		$this->append('tuvan/tuvan')
		->display();
	}
	public function saveAction(){
		$frontendmodel = pzk_model('Frontend');
		$userId	=	pzk_session('userId');
		$rows = array(
				'content' => clean_value(pzk_request()->getContent()),
				'type'  => clean_value(pzk_request()->getType()),
				'userId'  => $userId,
				'created' => date(DATEFORMAT, $_SERVER['REQUEST_TIME'])
				
			);
			
		$frontendmodel->save($rows, 'tuvan');
		echo 1;
	}
}
?>