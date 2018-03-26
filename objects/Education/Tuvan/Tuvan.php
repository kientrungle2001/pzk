<?php 
pzk_import('Core.Db.List');

class PzkEducationTuvanTuvan extends PzkCoreDbList {
	public function getTuvan($userId){
		$data = _db()->select('*')
            ->from('tuvan')
			->whereUserId($userId)
			->result();
           
		return $data;
	}
	public function getChucSn($userId){
		$data = _db()->select('*')
            ->from('user_birdth')
			->whereUserId($userId)
			->result();
           
		return $data;
	}
	
}
?>