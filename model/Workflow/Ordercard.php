<?php
class PzkWorkflowOrdercardModel {
	public function cancel($entity, $value) {
		
	}
	public function active($entity, $value) {
		// them vao bang coupon user
		$couponEntity	=	_db()->getTableEntity('coupon');
		$couponEntity->loadWhere(array('code', $entity->getCoupon()));
		$couponUser		=	_db()->getTableEntity('coupon_user');
		$couponUser->setData(array(
			'username'	=>	$entity->getFullname(),
			'name'		=>	$entity->getFullname(),
			'phone'		=>	$entity->get('phone'),
			'email'		=>	$entity->get('email'),
			'code'		=>	$entity->getCoupon(),
			'serviceId' =>	$entity->getCardId(),
			'resellerId'=>	$couponEntity->getResellerId(),
			'status'	=>	1,
			'actived'	=>	date('Y-m-d H:i:s'),
			'software'	=>	pzk_request('softwareId'),
			'site'		=>	pzk_request('siteId'),
			'amount'	=>	$entity->getAmount(),
			'class'		=>	$entity->getClass(),
			'languages'	=>	$entity->getLanguages()
		));
		$couponUser->save();
	}
}