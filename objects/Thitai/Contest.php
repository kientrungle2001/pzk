<?php
/**
 * Object Home/Header for header of themes vnwomen
 */
class PzkThitaiContest extends PzkObject{
	public function getContest(){
		$data = _db()->useCache(1800)
			->selectAll()
			->from('contest')
			->whereId($this->get('contestId'))
			->result_one();
		return $data;
	}
	
	public $cacheable = true;
	public $cacheParams = 'id,contestId,finish';
}