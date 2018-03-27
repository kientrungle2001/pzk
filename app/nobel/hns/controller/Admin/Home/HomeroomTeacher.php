<?php
class PzkAdminHomeHomeroomTeacherController extends PzkBackendController {
	public function indexAction() {
		
		$this->render('admin/homeroomteacher/teacher');
		
	}
	public function studentsAction($classroomId) {
		$this->initPage();
		$frame 		= 	$this->parse('admin/homeroomteacher/teacher');
		$students 	= 	$this->parse('admin/homeroomteacher/students');
		$students->set('classroomId', $classroomId);
		$frame->append($students);
		$this->append($frame);
		$this->display();
	}
	public function studentAction($classroomId, $classroomStudentId, $studentId) {
		$this->initPage();
		$frame 		= 	$this->parse('admin/homeroomteacher/teacher');
		$frame->set('classroomId', $classroomId);
		$student 	= 	$this->parse('admin/homeroomteacher/student');
		$student->set('classroomId', $classroomId);
		$student->set('classroomStudentId', $classroomStudentId);
		$student->set('studentId', $studentId);
		
		$frame->append($student);
		$this->append($frame);
		$this->display();
	}
	public function pointAction($classroomId) {
		$this->initPage();
		$frame 		= 	$this->parse('admin/homeroomteacher/teacher');
		$point 	= 	$this->parse('admin/homeroomteacher/point');
		$point->set('classroomId', $classroomId);
		$frame->append($point);
		$this->append($frame);
		$this->display();
	}
	public function homeworksAction($classroomId) {
		$this->initPage();
		$frame 		= 	$this->parse('admin/homeroomteacher/teacher');
		$homeworks 	= 	$this->parse('admin/homeroomteacher/homeworks');
		$homeworks->set('classroomId', $classroomId);
		$frame->append($homeworks);
		$this->append($frame);
		$this->display();
	}
	public function getPointAction(){
		$classes = pzk_request('classes');
		$classroomId = pzk_request('classroomId');
		$subjectId = pzk_request('subjectId');
		$weeks = pzk_request('weeks');
		$months = pzk_request('months');
		$semesters = pzk_request('semesters');
		$schoolYear = pzk_request('schoolYear');
		/*echo '$classroomId: '.$classroomId.'$subjectId: '.$subjectId. '$weeks: '. $weeks. '$months: '. $months. '$semeters'. $semeters;*/
		if($subjectId== 'all'){
			$homework 	= 	$this->parse('admin/homeroomteacher/allpointajax');
		}else $homework 	= 	$this->parse('admin/homeroomteacher/pointajax');
		
		$homework->set('classes', $classes);
		$homework->set('subjectId', $subjectId);
		$homework->set('weeks', $weeks);
		$homework->set('months', $months);
		$homework->set('semesters', $semesters);
		$homework->set('classroomId', $classroomId);
		$homework->set('schoolYear', $schoolYear);
		$homework->display();

	}
	// Teacher
	public function teachersAction($classroomId) {
		$this->initPage();
		$frame 		= 	$this->parse('admin/homeroomteacher/teacher');
		$frame->set('classroomId', $classroomId);
		$teachers = $this->parse('admin/homeroomteacher/teachers');
		$teachers->set('classroomId', $classroomId);
		$frame->append($teachers);
		$this->append($frame);
		$this->display();
	}
}