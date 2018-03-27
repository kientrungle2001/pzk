<?php
class PzkNewsletterModel {
	public function getSubscribers() {
		$subscribers = _db()->selectAll()
				->fromNewsletter_subscriber()
				->whereStatus('1')->result();
		return $subscribers;
	}
	
	public function getNewsletter() {
		$entity = _db()->getTableEntity('newsletter_newsletter');
		$entity->loadWhere(array('status', '1'));
		if($entity->get('id')) {
			return $entity;
		}
		return null;
	}
}