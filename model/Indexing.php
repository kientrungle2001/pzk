<?php
class PzkIndexingModel {
	public function rank($bookItem) {
		$rankModel = pzk_model('Indexing.Rank');
		$rankModel->index($bookItem);
	}
	
	public function rankAll() {
		$rankModel = pzk_model('Indexing.Rank');
		$bookItems = _db()->selectAll()->fromUser_book()->result('Userbook.UserBook');
		foreach($bookItems as $bookItem) {
			$rankModel->index($bookItem);
		}
	}
}