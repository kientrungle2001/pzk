<?php
class PzkHomeController extends PzkController{
	public $masterPage	=	"masterPage";
	public $masterPosition = 'wrapper';
	public function indexAction() {
		$this->initPage();
		pzk_page()->set('title', 'Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
		pzk_page()->set('keywords', 'Giáo dục');
		pzk_page()->set('description', 'Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
		pzk_page()->set('img', '/Default/skin/nobel/Themes/Story/media/logo.png');
		pzk_page()->set('brief', 'Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ Và Sáng Tạo Next Nobels');
		$this->append('content', 'wrapper');
		$this->display();
	}
}