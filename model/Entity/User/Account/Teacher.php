<?php 
/**
* 
*/
class PzkEntityUserAccountTeacherModel extends PzkEntityModel
{
	public $table="teacher_schedule";
	public function create($lessonData) {
		$this->setData($lessonData);
		$this->save();
	}
	
	//check bai luyen tap
	public function checkTime($subject, $topicId, $exercise_number){
		$query = _db()-> select('teacher_schedule.openDate')
								-> from('teacher_schedule')
								-> where(array('areacode',pzk_session('areacode')))
								-> where(array('district',pzk_session('district')))
								-> where(array('school',pzk_session('school')))
								-> where(array('class',pzk_session('class')))
								-> where(array('className',pzk_session('classname')))
								-> where(array('subject',$subject))
								-> where(array('topic',$topicId))
								-> where(array('exercise_number',$exercise_number))
								-> where(array('status',1))
								->result_one();
		if($query){
			
			/*$paymentDate=date('d/m/Y', strtotime($query['paymentDate'])); 
			$expiredDate=date('d/m/Y', strtotime($query['expiredDate'])); */
			return $query['openDate'];
		}else return 0;
		
	}
	//check de thi
	/*public function checkTimeTest($subject, $weekId, $testId){
		$query = _db()->useCache(300)->useCB()-> select('teacher_schedule.openDate')
								-> from('teacher_schedule')
								-> where(array('areacode',pzk_session('areacode')))
								-> where(array('district',pzk_session('district')))
								-> where(array('school',pzk_session('school')))
								-> where(array('class',pzk_session('class')))
								-> where(array('className',pzk_session('classname')))
								-> where(array('subject',$subject))
								-> where(array('topic',$topicId))
								-> where(array('exercise_number',$exercise_number))
								-> where(array('status',1))
								->result_one();
		if($query){
			return $query['openDate'];
		}else return 0;
	}*/
	
	public function viewSchedule($subject){
		return  _db()-> select('*')
								-> from('teacher_schedule')
								-> where(array('areacode',pzk_session('adminAreacode')))
								-> where(array('district',pzk_session('adminDistrict')))
								-> where(array('school',pzk_session('adminSchool')))
								-> where(array('class',pzk_session('adminClass')))
								-> where(array('className',pzk_session('adminClassname')))
								-> where(array('subject',$subject))
								->result();
		
	}
	
}
 ?>