<?php
class PzkCartController extends PzkController{

	public $masterPage		=	'index';
	public $masterPosition 	= 	'left';
	
	public function indexAction() {
		$this->initPage()
		->append('ecommerce/cart');
		pzk_page()->setTitle('Giỏ hàng');
		pzk_page()->setKeywords('Giỏ hàng');
		pzk_page()->setDescription('Giỏ hàng');
		pzk_page()->setImg(BASE_URL . '/default/skin/nobel/Themes/story/media/logo.png');
		pzk_page()->setBrief('Giỏ hàng');
		$this->display();
	}
}