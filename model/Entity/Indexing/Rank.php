<?php
require_once BASE_DIR . '/model/Entity.php';
class PzkEntityIndexingRankModel extends PzkEntityModel {
	public $table = 'rank_test';
	public function loadByIndex($userId, $testId) {
		return $this->loadWhere(array('and', array('userId' => $userId), array('testId' => $testId)));
	}
}