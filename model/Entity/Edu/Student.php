<?php
require_once BASE_DIR . '/model/Entity.php';
class PzkEntityEduStudentModel extends PzkEntityModel {
	public $table = 'student';
	
	public function getAttendance($classperiodAttendance, $state) {
	}
	
	public function getClasses() {
		$classes = _db()->select('classes.*, class_student.note, class_student.startClassDate, class_student.endClassDate')
		->from('classes')
		->join('class_student', 'classes.id = class_student.classId')
		->where("class_student.studentId=$this->getId()")
		->result();
		
		$result = array();
		foreach($classes as $class) {
			$obj = _db()->getEntity('edu.class');
			$obj->setData($class);
			$result[] = $obj;
		}
		return $result;
	}
	
	public function search($name, $phone, $classId, $periodId, $paymentState){
		$cond = "1";
		if($name) {
			$name = @mysql_escape_string($name);
			$cond .= " and name like '%$name%'";
		}
		if($phone) {
			$phone = @mysql_escape_string($phone);
			$cond .= " and phone like '%$phone%'";
		}
		if($classId) {
			$cond .= " and id in (select studentId from class_student where classId=$classId)";
		}
		if($periodId) {
			$periodId = intval($periodId);
			$period = _db()->select('*')->from('payment_period')->whereId($periodId)->result_one();
			$classCond = "select id from classes where startDate < '" . date('Y-m-d', strtotime($period['startDate']) + 30 * 24 * 3600) . "'";
			$cond .= " and id in (select studentId from class_student where classId in ($classCond))";
			if($paymentState) {
				if($paymentState == 2) {
					$paymentCond = "select studentId from payment_state where periodId=$periodId group by studentId having count(*) * $paymentState = sum(paymentState)";
					$cond .= " and id in ($paymentCond)";
				}
			}
		}
		
		$students = _db()->select('*')->from($this->table)->where($cond)->result('Edu.Student');
		return $students;
	}
	
	public function getPeriods() {
		$conds = array('and');
		if($this->getStartClassDate() !== '0000-00-00') {
			$conds[] = array('or', array('gte', 'startDate', $this->getStartClassDate()), array('gt', 'endDate', $this->getStartClassDate()));
		}
		if($this->getEndClassDate() !== '0000-00-00') {
			$conds[] = array('or', array('lte', 'startDate', $this->getEndClassDate()), array('lt', 'endDate', $this->getEndClassDate()));
		}
		if($this->getStartDate() !== '0000-00-00') {
			$conds[] = array('or', array('gte', 'startDate', $this->getStartDate()), array('gt', 'endDate', $this->getStartDate()));
		}
		if($this->getEndDate() !== '0000-00-00') {
			$conds[] = array('or', array('lte', 'startDate', $this->getEndDate()), array('lt', 'endDate', $this->getEndDate()));
		}
		$conds[] = array('status', '1');
		return _db()->useCB()->select('payment_period.*, class_student_period_mark.marks, class_student_period_mark.note')->from('payment_period
			left join class_student_period_mark 
				on class_student_period_mark.periodId = payment_period.id
					and class_student_period_mark.studentId='.$this->getId() . '
					and class_student_period_mark.classId='.$this->getClassId().'
					')
			->where($conds)->orderBy('startDate asc')->result('Edu.Period');
	}
	
	public function getStudyDates() {
		$periods =  _db()->useCB()->select('class_student_period_mark.periodId, class_student_period_mark.marks, class_student_period_mark.note')
			->from('class_student_period_mark')
			->where('class_student_period_mark.studentId', $this->getId())
			->where('class_student_period_mark.classId', $this->getClassId())
			->orderBy('periodId asc')->result('Edu.Period');
		$result = array();
		foreach($periods as $period) {
			$result[$period->getPeriodId()] = $period;
		}
		
		for($i = 1; $i < 17; $i++) {
			if(!isset($result[$i])) {
				$p = _db()->getEntity('edu.period');
				$p->setPeriodId($i);
				$result[$i] = $p;
			}
		}
		
		return $result;
	}
	
	public function gridIndex() {
		$id = $this->getId();
		$query = "select student.*, group_concat(distinct(classes.name), ' ') as currentClassNames,
			group_concat('[', classes.name, ' ', case when student_order.payment_periodId = 0 then 'Cả khóa' else payment_period.name end, ']<br />' order by classes.name) as periodNames,
				group_concat('[', payment_period.id, ']') as periodIds from student 
					left join `class_student` on student.id = class_student.studentId
					left join `classes` on class_student.classId = classes.id
					left join `student_order` on student.id = student_order.studentId
						and classes.id = student_order.classId and student_order.status='' or student_order.status is null
					left join payment_period on student_order.payment_periodId = payment_period.id where student.id=$id AND 1 AND 1 group by student.id order by student.id desc";
		$item = _db()->query_one($query);
		if($item) {
			$this->setCurrentClassNames($item['currentClassNames']);
			$this->setPeriodNames($item['periodNames']);
			$this->setPeriodIds($item['periodIds']);
			$this->save();
		}
	}
}
