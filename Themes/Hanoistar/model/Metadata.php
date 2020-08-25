<?php
class PzkMetadataModel {
	public function fromTest($testEntity) {
		pzk_page()->setTitle(		$testEntity->getName());
		pzk_page()->setKeywords(	$testEntity->getName());
		pzk_page()->setDescription(	$testEntity->getName());
		pzk_page()->setImg(			$testEntity->getImg());
		pzk_page()->setBrief(		$testEntity->getName());
	}
}