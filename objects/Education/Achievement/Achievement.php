<?php
class PzkEducationAchievementAchievement extends PzkObject {
	public $table = 'achievement';
	public $week;
	public $year;
	public $areacode;
	public $district;
	public $school;
	public $classId;
	public $className;
	public $checkUser = 1;
	public $orderBy = 'tree desc';
	public $conditionAchievement;
	public $cacheable = true;
	public $cacheParams = 'layout';
	
	public function getAchievement($class){
		$useradmin =  _db()->select('name')->from('admin')->where('usertype_id = 19')->result();
		$usenames = array();
		foreach($useradmin as $usename) {
			$usenames[] = $usename['name'];
		}
		
		$data = _db()->useCache(1800)
			->useCacheKey('getAchievement_' . $class . '_' . $this->week . '_' . $this->year)
            ->select('tree, flower, apple, week, year, name, username')
            ->from('achievement')
			->where(array('notin', 'username', $usenames))
			->where(array('week', $this->week))
			->where(array('year', $this->year))
			->where(array('class', $class))
            ->orderBy($this->orderBy)
			->limit(10)
            ->result();
		return $data;
	}
	public function getAchievementByClass(){
		$useradmin =  _db()->select('name')->from('admin')->where('usertype_id = 19')->result();
		$usenames = array();
		foreach($useradmin as $usename) {
			$usenames[] = $usename['name'];
		}
		
		$data = _db()->useCache(1800)
			->useCacheKey('getAchievementByClass_' . $this->classId . '_' . $this->week . '_' . $this->year)
            ->select('tree, flower, apple, week, year, name, username')
            ->from('achievement a')
			->where(array('notin', 'username', $usenames))
			->where(array('week', $this->week))
			->where(array('year', $this->year))
			->where(array('areacode', $this->areacode))
			->where(array('district', $this->district))
			->where(array('school', $this->school))
			->where(array('class', $this->classId))
			->where(array('classname', $this->className))
			->where(array('checkUser', $this->checkUser))
			->where('userId != 95')
            ->orderBy($this->orderBy)
			->limit(10);
            //echo $data->getQuery();
		return $data->result();
	}
	public function getAchievemenAll() {
		$data = _db()->useCache(1800)
			->useCacheKey('getAchievementAll_' . '_' . $this->week . '_' . $this->year)
            ->select('tree, flower, apple, week, year, name, username')
            ->from('achievement a')
			->where(array('week', $this->week))
			->where(array('year', $this->year))
			->where('userId != 95')
            ->orderBy($this->orderBy)
			->limit(10);
			echo $data->getQuery();
            return $data->result();
	}
	public function getAchievementByCondition(){
		$data = _db()->useCache(1800)
            ->select('tree, flower, apple, week, year, name, username')
            ->from('achievement a')
			->where(array('week', $this->week))
			->where(array('year', $this->year))
			->where('userId != 95')
			->where($this->conditionAchievement)
            ->orderBy($this->orderBy)
			->limit(10);
			echo $data->getQuery();
            return $data->result();
		
	}
	public function getOneAchievement($week, $year, $class, $orderBy){
		$useradmin =  _db()->select('name')->from('admin')->where('usertype_id = 19')->result();
		$usenames = array();
		foreach($useradmin as $usename) {
			$usenames[] = $usename['name'];
		}
		$data = _db()->useCache(1800)
			->useCacheKey('getOneAchievement_' . $week . '_' . $year . '_' . $class . '_' . $orderBy)
            ->select('name, username')
            ->from('achievement')
			->where(array('notin', 'username', $usenames))
			->where(array('week', $week))
			->where(array('year', $year))
			->where(array('class', $class))
            ->orderBy($orderBy)
            ->result_one();
		return $data;
	}
	public function getThreeAchievement($week, $year, $class, $orderBy){
		$useradmin =  _db()->select('name')->from('admin')->where('usertype_id = 19')->result();
		$usenames = array();
		foreach($useradmin as $usename) {
			$usenames[] = $usename['name'];
		}
		$data = _db()->useCache(1800)
			->useCacheKey('getThreeAchievement_' . $week . '_' . $year . '_' . $class . '_' . $orderBy)
            ->select('name, username')
            ->from('achievement')
			->where(array('notin', 'username', $usenames))
			->where(array('week', $week))
			->where(array('year', $year))
			->where(array('class', $class))
            ->orderBy($orderBy)
			->limit(3)
            ->result();
		return $data;
	}
	public function getCities() {
		$data = _db()->useCache(1800)
			->useCacheKey('getCities')
			->select('id, name')
			->from('areacode')
			->where('parent = 0')
			->result();
		return $data;	
	}
	public function getAreaByParent($parent){
		if($parent != 'all'){
			$data = _db()->useCache(1800)
			->useCacheKey('getAreaByParent_' . $parent)
			->select('id, name')
			->from('areacode')
			->where("parent = $parent")
			->result();
			return $data;	
		}else{
			return array();
		}
		
	}
}