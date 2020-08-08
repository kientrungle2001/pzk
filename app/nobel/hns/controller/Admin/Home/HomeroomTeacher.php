<?php
class PzkAdminHomeHomeroomTeacherController extends PzkBackendController {
	public function indexAction() {
		
		$this->render('admin/homeroomteacher/teacher');
		
	}
	public function studentsAction($classroomId) {
		$this->initPage();
		$frame 		= 	$this->parse('admin/homeroomteacher/teacher');
		$students 	= 	$this->parse('admin/homeroomteacher/students');
		$students->setClassroomId( $classroomId);
		$frame->append($students);
		$this->append($frame);
		$this->display();
	}
	public function studentAction($classroomId, $classroomStudentId, $studentId) {
		$this->initPage();
		$frame 		= 	$this->parse('admin/homeroomteacher/teacher');
		$frame->setClassroomId( $classroomId);
		$student 	= 	$this->parse('admin/homeroomteacher/student');
		$student->setClassroomId( $classroomId);
		$student->setClassroomStudentId( $classroomStudentId);
		$student->setStudentId( $studentId);
		
		$frame->append($student);
		$this->append($frame);
		$this->display();
	}
	public function pointAction($classroomId) {
		$this->initPage();
		$frame 		= 	$this->parse('admin/homeroomteacher/teacher');
		$point 	= 	$this->parse('admin/homeroomteacher/point');
		$point->setClassroomId( $classroomId);
		$frame->append($point);
		$this->append($frame);
		$this->display();
	}
	public function homeworksAction($classroomId) {
		$this->initPage();
		$frame 		= 	$this->parse('admin/homeroomteacher/teacher');
		$homeworks 	= 	$this->parse('admin/homeroomteacher/homeworks');
		$homeworks->setClassroomId( $classroomId);
		$frame->append($homeworks);
		$this->append($frame);
		$this->display();
	}
	public function getPointAction(){
		$classes = pzk_request()->getClasses();
		$classroomId = pzk_request()->getClassroomId();
		$subjectId = pzk_request()->getSubjectId();
		$weeks = pzk_request()->getWeeks();
		$months = pzk_request()->getMonths();
		$semesters = pzk_request()->getSemesters();
		$schoolYear = pzk_request()->getSchoolYear();
		/*echo '$classroomId: '.$classroomId.'$subjectId: '.$subjectId. '$weeks: '. $weeks. '$months: '. $months. '$semeters'. $semeters;*/
		if($subjectId== 'all'){
			$homework 	= 	$this->parse('admin/homeroomteacher/allpointajax');
		}else $homework 	= 	$this->parse('admin/homeroomteacher/pointajax');
		
		$homework->setClasses( $classes);
		$homework->setSubjectId( $subjectId);
		$homework->setWeeks( $weeks);
		$homework->setMonths( $months);
		$homework->setSemesters( $semesters);
		$homework->setClassroomId( $classroomId);
		$homework->setSchoolYear( $schoolYear);
		$homework->display();

	}
	// Teacher
	public function teachersAction($classroomId) {
		$this->initPage();
		$frame 		= 	$this->parse('admin/homeroomteacher/teacher');
		$frame->setClassroomId( $classroomId);
		$teachers = $this->parse('admin/homeroomteacher/teachers');
		$teachers->setClassroomId( $classroomId);
		$frame->append($teachers);
		$this->append($frame);
		$this->display();
	}
}