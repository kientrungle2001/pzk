<?php
class PzkMetadataModel {
	public function fromTest($testEntity) {
		pzk_page()->set('title', 		$testEntity->get('name'));
		pzk_page()->set('keywords', 	$testEntity->get('name'));
		pzk_page()->set('description', 	$testEntity->get('name'));
		pzk_page()->set('img', 			$testEntity->get('img'));
		pzk_page()->set('brief', 		$testEntity->get('name'));
	}
}