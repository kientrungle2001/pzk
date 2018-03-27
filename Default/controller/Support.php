<?php
class PzkSupportController extends PzkController {
	public $masterPage 		= 'index';
	public $masterPosition	= 'left';
	public function subscribeAction() {
		$subscribe = _db()->getTableEntity('support_subscribe');
		$data = pzk_request()->getFilterData('name, phone, email, class');
		$data['created'] = date('Y-m-d H:i:s');
		$subscribe->setData($data);
		$subscribe->save();
		if($subscribe->get('id')){
			pzk_notifier_add_message('Cám ơn bạn đã đăng ký nhận tư vấn', 'success');
		} else {
			pzk_notifier_add_message('Bạn đã đăng ký nhận tư vấn rồi', 'danger');
		}
		$this->redirect('home/index');
	}
	
	public function registerAction() {
		$this->render('subscribe/register');
	}
}
