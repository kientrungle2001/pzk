<?php
class PzkIndexingRankModel {
	public $rankTests = array();
	public function index($bookItem) {
		$rankTest = null;
		if(isset($this->rankTests[$bookItem->getUserId()][$bookItem->gettestId()])) {
			$rankTest = $this->rankTests[$bookItem->getUserId()][$bookItem->gettestId()];
		} else {
			$this->rankTests[$bookItem->getUserId()][$bookItem->gettestId()] = $rankTest = _db()->getEntity('Indexing.Rank')
				->loadByIndex($bookItem->getUserId(), $bookItem->gettestId());
		}
		
		if($rankTest && $rankTest->get('id')) {
			if($rankTest->getMark() < $bookItem->getMark()) {
				$rankTest->update(array(
					'startTime' => $bookItem->getStartTime(),
					'duration' => $bookItem->getDuringTime(),
					'mark' => $bookItem->getMark()
				));
			} else if($rankTest->getMark() == $bookItem->getMark()) {
				if ($rankTest->getDuration() > $bookItem->getDuringTime()) {
					$rankTest->update(array(
						'startTime' => $bookItem->getStartTime(),
						'duration' => $bookItem->getDuringTime(),
						'mark' => $bookItem->getMark()
					));
				}
			}
		} else {
			$rankTest->setData(array(
				'userId' => $bookItem->getUserId(),
				'testId' => $bookItem->gettestId(),
				'startTime' => $bookItem->getStartTime(),
				'duration' => $bookItem->getDuringTime(),
				'mark' => $bookItem->getMark()
			));
			$rankTest->save();
		}
	}
}