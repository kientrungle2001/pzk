<?php
class PzkAdminHomeHeadmasterController extends PzkBackendController {
	public function indexAction(){
		$this->initPage();
		$this->append('admin/home/headmaster/index');
		$this->display();
	}
	public function studentAction(){
		$this->initPage();
		$this->append('admin/home/headmaster/student');
		$this->display();
	}
	public function teacherAction(){
		$this->initPage();
		$this->append('admin/home/headmaster/teacher');
		$this->display();
	}
	public function getSubjectAction(){
		$grade = pzk_request()->getGrade();
		$subjects = _db()->select('*')->from('categories')->whereType('subject')->likeClasses('%,'.$grade. ',%')->result();
		$html = '';
		if($subjects){
			$html .= '<select id="subjects" class="form-control" name="subject">';
			$html .= '<option value="">Chọn tất cả</option>';
			foreach($subjects as $subject){
				$html .= '<option value="'.$subject['id'].'">'.$subject['name'].'</option>';
				
			}
			$html .= '</select>';
		}
		echo $html;
	}
	public function listStudentAction(){
		$this->initPage();
			$frame 	= 	$this->parse('admin/home/headmaster/student');
			$students = $this->parse('admin/home/headmaster/listStudent');
			$students->setSchoolYear( pzk_request()->getSchoolYear());
			$students->setClass( pzk_request()->getClass());
			$students->setClassName( pzk_request()->getClassName());
			$frame->append($students);
			$this->append($frame);
		$this->display();
	}
	public function studyAction(){
		$this->initPage();
			$frame 	= 	$this->parse('admin/home/headmaster/student');
			$listresults = $this->parse('admin/home/headmaster/listresult');
			$listresults->setSchoolYear( pzk_request()->getSchoolYear());
			$listresults->setWeek( pzk_request()->getWeek());
			$listresults->setGrade( pzk_request()->getGrade());
			$listresults->setNameOfClass( pzk_request()->getNameOfClass());
			$listresults->setSubject( pzk_request()->getSubject());

			$frame->append($listresults);
			$this->append($frame);
		$this->display();
	}
	public function completeAction(){
		$this->initPage();
			$frame 	= 	$this->parse('admin/home/headmaster/student');
			$listcompletes = $this->parse('admin/home/headmaster/listcomplete');
			
			$listcompletes->setSchoolYear( pzk_request()->getSchoolYear());
			$listcompletes->setGrade( pzk_request()->getGrade());
			$listcompletes->setNameOfClass( pzk_request()->getNameOfClass());
		
			
			$frame->append($listcompletes);
			$this->append($frame);
		$this->display();
	}
	public function workCompleteAction(){
		$this->initPage();
			$workcomplete 	= 	$this->parse('admin/home/headmaster/workcomplete');
			
			$workcomplete->setSchoolYear( pzk_request()->getSchoolYear());
			$workcomplete->setGrade( pzk_request()->getGrade());
			$workcomplete->setNameOfClass( pzk_request()->getNameOfClass());
			
			$this->append($workcomplete);
		$this->display();
	}
	public function listTeacherAction(){
		$this->initPage();
			$frame 	= 	$this->parse('admin/home/headmaster/contentteacher');
			$frame->setSchoolYear( pzk_request()->getSchoolYear());
			$frame->setClass( pzk_request()->getClass());
			$frame->setNameOfClass( pzk_request()->getClassName());
			$frame->setSubject( pzk_request()->getSubject());
			
			
			$listteachers = $this->parse('admin/home/headmaster/listteacher');
			$listteachers->setSchoolYear( pzk_request()->getSchoolYear());
			$listteachers->setClass( pzk_request()->getClass());
			$listteachers->setNameOfClass( pzk_request()->getClassName());
			$listteachers->setSubject( pzk_request()->getSubject());
			$frame->append($listteachers);
			$this->append($frame);
		$this->display();
	}
}