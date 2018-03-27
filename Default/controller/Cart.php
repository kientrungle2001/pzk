<?php
class PzkCartController extends PzkController{

	public $masterPage		=	'index';
	public $masterPosition 	= 	'left';
	
	public function indexAction() {
		$this->initPage()
		->append('ecommerce/cart');
		pzk_page()->set('title', 'Giỏ hàng');
		pzk_page()->set('keywords', 'Giỏ hàng');
		pzk_page()->set('description', 'Giỏ hàng');
		pzk_page()->set('img', BASE_URL . '/default/skin/nobel/Themes/story/media/logo.png');
		pzk_page()->set('brief', 'Giỏ hàng');
		$this->display();
	}
}