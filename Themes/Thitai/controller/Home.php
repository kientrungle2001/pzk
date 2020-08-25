<?php
class PzkHomeController extends PzkController{
	public $masterPage	=	"masterPage";
	public $masterPosition = 'wrapper';
	public function indexAction() {
		$this->initPage();
		pzk_page()->setTitle('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
		pzk_page()->setKeywords('Giáo dục');
		pzk_page()->setDescription('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
		pzk_page()->setImg('/Default/skin/nobel/Themes/Story/media/logo.png');
		pzk_page()->setBrief('Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
		$this->append('content', 'wrapper');
		$this->display();
	}
}