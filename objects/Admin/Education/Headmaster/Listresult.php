<?php
class PzkAdminEducationHeadmasterListresult extends PzkObject {
	public $layout = 'admin/education/headmaster/listresult';
	public function getResult(){
		  
	}
	public function getSubject(){
		$subjects = _db()->select('id, name')->from('categories')->whereType('subject')->whereStatus(1)->result();
		$arr_subjects = array();
		if($subjects){
			foreach($subjects as $subject){
				$arr_subjects[$subject['id']] = $subject['name'];
			}
		}
		return $arr_subjects;
	}
	public function getTotalPracticeByCategoryId(){
		$query = _db()->select('categoryId, count(id) as totalPractice')->from('user_book')->groupBy('categoryId');
		
		if($this->get('schoolYear')){
			$query->whereSchoolYear($this->get('schoolYear'));
		}
		
		if($this->get('week')){
			$query->whereWeek($this->get('week'));
		}
		
		if($this->get('grade')){
			$query->whereClass($this->get('grade'));
		}
		if($this->get('nameOfClass')){
			$query->likeClassname('%,'.$this->get('nameOfClass').',%');
		}
		if($this->get('subject')){
			$query->whereCategoryId($this->get('subject'));
		}
		
		$query->whereStatus(1);
		$query->where('categoryId != 0');
		$practiceTotal = $query->result();
		
		$totalPracticeByCate = array();
		if($practiceTotal){
			foreach($practiceTotal as $val){
				$totalPracticeByCate[$val['categoryId']] = $val['totalPractice'];
			}
		}
		return $totalPracticeByCate;
	}
	public function getGoodSudent(){
	
		$query = _db()->select('categoryId, (totalMark/testMark) as total, count(id) as totalGood')->from('user_book')->where('(totalMark/testMark) >= 0.8')->groupBy('categoryId');
		
		if($this->get('schoolYear')){
			$query->whereSchoolYear($this->get('schoolYear'));
		}
		
		if($this->get('week')){
			$query->whereWeek($this->get('week'));
		}
		
		if($this->get('grade')){
			$query->whereClass($this->get('grade'));
		}
		if($this->get('nameOfClass')){
			$query->likeClassname('%,'.$this->get('nameOfClass').',%');
		}
		if($this->get('subject')){
			$query->whereCategoryId($this->get('subject'));
		}
		$query->whereStatus(1);
		$practiceTotal = $query->result();
		
		$totalGood = array();
		if($practiceTotal){
			foreach($practiceTotal as $val){
				$totalGood[$val['categoryId']] = $val['totalGood'];
			}
		}
		
		return $totalGood;
	}
	public function getQuiteSudent(){
	
		$query = _db()->select('categoryId, (totalMark/testMark) as total, count(id) as totalGood')->from('user_book')->where('(totalMark/testMark) >= 0.7 and (totalMark/testMark) < 0.8')->groupBy('categoryId');
		
		if($this->get('schoolYear')){
			$query->whereSchoolYear($this->get('schoolYear'));
		}
		
		if($this->get('week')){
			$query->whereWeek($this->get('week'));
		}
		
		if($this->get('grade')){
			$query->whereClass($this->get('grade'));
		}
		if($this->get('nameOfClass')){
			$query->likeClassname('%,'.$this->get('nameOfClass').',%');
		}
		if($this->get('subject')){
			$query->whereCategoryId($this->get('subject'));
		}
		$query->whereStatus(1);
		$practiceTotal = $query->result();
		
		$totalGood = array();
		if($practiceTotal){
			foreach($practiceTotal as $val){
				$totalGood[$val['categoryId']] = $val['totalGood'];
			}
		}
		
		return $totalGood;
	}
	public function getTbSudent(){
	
		$query = _db()->select('categoryId, (totalMark/testMark) as total, count(id) as totalGood')->from('user_book')->where('(totalMark/testMark) >= 0.5 and (totalMark/testMark) < 0.7')->groupBy('categoryId');
		
		if($this->get('schoolYear')){
			$query->whereSchoolYear($this->get('schoolYear'));
		}
		
		if($this->get('week')){
			$query->whereWeek($this->get('week'));
		}
		
		if($this->get('grade')){
			$query->whereClass($this->get('grade'));
		}
		if($this->get('nameOfClass')){
			$query->likeClassname('%,'.$this->get('nameOfClass').',%');
		}
		if($this->get('subject')){
			$query->whereCategoryId($this->get('subject'));
		}
		$query->whereStatus(1);
		$practiceTotal = $query->result();
		
		$totalGood = array();
		if($practiceTotal){
			foreach($practiceTotal as $val){
				$totalGood[$val['categoryId']] = $val['totalGood'];
			}
		}
		
		return $totalGood;
	}
	public function getYeuSudent(){
	
		$query = _db()->select('categoryId, (totalMark/testMark) as total, count(id) as totalGood')->from('user_book')->where('(totalMark/testMark) < 0.5')->groupBy('categoryId');
		
		if($this->get('schoolYear')){
			$query->whereSchoolYear($this->get('schoolYear'));
		}
		
		if($this->get('week')){
			$query->whereWeek($this->get('week'));
		}
		
		if($this->get('grade')){
			$query->whereClass($this->get('grade'));
		}
		if($this->get('nameOfClass')){
			$query->likeClassname('%,'.$this->get('nameOfClass').',%');
		}
		if($this->get('subject')){
			$query->whereCategoryId($this->get('subject'));
		}
		$query->whereStatus(1);
		$practiceTotal = $query->result();
		
		$totalGood = array();
		if($practiceTotal){
			foreach($practiceTotal as $val){
				$totalGood[$val['categoryId']] = $val['totalGood'];
			}
		}
		
		return $totalGood;
	}
}
?>