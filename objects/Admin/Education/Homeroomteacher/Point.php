<?php
class PzkAdminEducationHomeroomteacherPoint extends PzkObject {
	public $layout = 'admin/homeroomteacher/point';
	public $classroomId;
	private $_classroom = false;
	public function getClassroom() {
		if($this->_classroom) return $this->_classroom;
		return $this->_classroom = _db()->select('*')->from('education_classroom')->where(array('id', $this->get('classroomId')))->result_one();
	}
	
	public function getClassrooms() {
		return _db()->select('*')->from('education_classroom')->result();
	}
	public function getSubjects() {
		return _db()->select('categories.id as subjectId, categories.name as subjectName')->from('categories')->whereType('subject')->likeClasses('%'.$this->get('classes').'%')->result();
	}
	public function getSubject($classes) {
		return _db()->select('categories.id as subjectId, categories.name as subjectName')->from('categories')->whereType('subject')->likeClasses('%'.$classes.'%')->result();
	}
	public function getStudents() {
		return  _db()->select('education_classroom_student.id,user.id as studentId, user.name, user.username, user.birthday')->from('education_classroom_student')
		->join('user', 'education_classroom_student.studentId=user.id')
		->whereClassroomId($this->get('classroomId'))->result();
		
	}
	// lay diem cua tat ca bai test trong lop
	public function getPointTestHomework() {
		return  _db()->select('education_classroom_homework.homeworkId as testId,tests.testMark as testMark')->from('education_classroom_homework')
		->join('tests', 'education_classroom_homework.homeworkId=tests.id')
		->whereClassroomId($this->get('classroomId'))->result();
		
	}
	//Lay diem tu testId
	public function getPointTestId($testId)
	{
		return _db()->select('tests.id, tests.testMark')->from('tests')->whereId($testId)->result_one();
	}
	// Lấy điểm các HS
	public function getPoint($studentIds){
		$getPoints =  _db()->select('user_book. userId as userId,user_book. testId as testId,user_book. created as created, user_book. id as userBookId, user_book. totalMark as totalMark, user_book.status as status, user_book.homeworkStatus as homeworkStatus, user_book.homework as homework')->from('user_book')-> inUserId ($studentIds)->whereHomeworkStatus(1); 
		$getPoints->whereSchoolYear($this->get('schoolYear'));
		if($this->get('subjectId')){
			$getPoints-> whereCategoryId($this->get('subjectId'));
		}

		if($this->get('weeks')){
			$getPoints-> whereHomework(1) -> whereWeek($this->get('weeks'));
		}else if($this->get('months')) {
			$getPoints-> whereHomework(2) -> whereMonth($this->get('months'));
		}else if($this->get('semesters')){
			$getPoints-> whereHomework(3) -> whereSemester($this->get('semesters'));
		}
		/*echo $getPoints->getQuery();*/
		return $getPoints->result();
	}
	public function showPoint() {
		$studentIds= array();
		$studentsAll= array();
		$students = $this-> getStudents();
		foreach ($students as $student) {
				$studentIds[]= $student['studentId'];
				$studentsAll[$student['studentId']]= $student;
			}
		$quantityStudents = count($studentsAll);// so luong hoc sinh
		$marks = $this-> getPoint($studentIds);
		//return $marks;
		$tamp = 0;
		$dtb = 0; // diem trung binh
		$gioi =0; // so hs gioi
		$kha =0; // so hs kha
		$trungbinh =0; // so hs tb
		$yeu =0; // so hs yeu
		$dacham = 0; // so bai da cham
		$chuacham = 0; // so bai chua cham
		$studentHomework = array();
		$testMarkTotal = 0;
		if($marks){
			
			foreach ($marks as $mark) {				
				if($mark['userId']){
					$tamp ++;

					$totalMarkTest = $this->getPointTestId($mark['testId']);

					if(($mark['status'] == 1) && (floatval($totalMarkTest['testMark'] >0)) ){
						$dacham ++;
						$testMarkTotal = $totalMarkTest['testMark']; 
						$dtb = ($mark['totalMark'] / floatval($totalMarkTest['testMark']))*100;
						if($dtb >= 80 ){
						$gioi ++;
						}else if(($dtb < 80) && ($dtb >= 70)){
							$kha ++ ;
						}else if(($dtb < 70) && ($dtb >= 50)){
							$trungbinh ++ ;
						}else if($dtb < 50){
							$yeu ++ ;
						}
					} 					
					
					$studentsAll[$mark['userId']]['totalMark'] = $mark['totalMark']; 
					$studentsAll[$mark['userId']]['status'] = $mark['status']; 
					$studentsAll[$mark['userId']]['homeworkStatus'] = $mark['homeworkStatus'];

					$studentsAll[$mark['userId']]['created'] = $mark['created']; 
					$studentsAll[$mark['userId']]['userBookId'] = $mark['userBookId']; 

					$studentHomework[$mark['userId']] =$studentsAll[$mark['userId']];

					
				}
			}
		}/*else{
			$studentsAll[$mark['userId']]['totalMark'] = $mark['totalMark']; 
			$studentsAll[$mark['userId']]['status'] = $mark['status']; 
			$studentsAll[$mark['userId']]['homeworkStatus'] = $mark['homeworkStatus']; 
			$studentsAll[$mark['userId']]['created'] = $mark['created']; 
			$studentsAll[$mark['userId']]['userBookId'] = $mark['userBookId']; 
		}*/
		$studentHomework['quantityExercies']= $tamp;// so luong hs da lam bai tap
		$quantityNotExercies = $quantityStudents - $tamp; //so luong hs chua lam bai tap
		$studentHomework['quantityNotExercies'] = $quantityNotExercies ;
		$studentHomework['quantityStudents'] = $quantityStudents ;
		$studentHomework['dacham']= $dacham;
		$studentHomework['testMarkTotal'] = $testMarkTotal;
		$studentHomework['kq']= array();
		$studentHomework['kq']['gioi']= $gioi;
		$studentHomework['kq']['kha']= $kha;
		$studentHomework['kq']['trungbinh']= $trungbinh;
		$studentHomework['kq']['yeu']= $yeu;

		return $studentHomework;
	}
	// Lấy điểm của tất cả các môn
	public function getPointSubjectId($studentIds, $subjectId){
	
	
					
			$getPoints =  _db()->select('user_book. userId as userId, user_book. categoryId, user_book. totalMark as totalMark, user_book.status as status, user_book. testId as testId, user_book.homeworkStatus as homeworkStatus, user_book.homework as homework')->from('user_book')-> inUserId ($studentIds)->whereHomeworkStatus(1); 
			$getPoints-> whereCategoryId($subjectId)->whereSchoolYear($this->get('schoolYear'));
			if($this->get('weeks')){
				$getPoints-> whereHomework(1)-> whereWeek($this->get('weeks'));
			}else if($this->get('months')) {
				$getPoints-> whereHomework(2)-> whereMonth($this->get('months'));
			}else if($this->get('semesters')){
				$getPoints-> whereHomework(3)-> whereSemester($this->get('semesters'));
			}
			
			$arrayPoints= array();
			/*echo $getPoints->getQuery();*/
			$getPoints = $getPoints->result();
			foreach ($getPoints as $point) {
				$arrayPoints[$point['userId']]= $point;
				//$studentsAll[$student['studentId']]= $student;
			}
			return $arrayPoints;
	}
	public function showAllPoint() {
		
		$marks = array();
		$subjectIds = $this->getSubjects($this->get('classes')); 
		//$points = array();
		$studentIds= array();
		
		$students = $this-> getStudents();
		foreach ($students as $student) {
				$studentIds[]= $student['studentId'];
				//$studentsAll[$student['studentId']]= $student;
		}
				
		//$quantityStudents = count($studentsAll);// so luong hoc sinh
		foreach ($subjectIds as $subject) {
			$subjectId = $subject['subjectId'];
			$marks[$subjectId]= $this-> getPointSubjectId($studentIds, $subjectId);
			/*if(isset($marks[$subjectId])){
				foreach ($marks[$subjectId] as $sub) {
					
						$points[$subjectId][$sub['userId']]= $sub['mark'];
					
				}
			}*/
		}		
		
		
		return $marks;
	}
}