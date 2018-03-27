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
		$grade = pzk_request('grade');
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
			$students->set('schoolYear', pzk_request('schoolYear'));
			$students->set('class', pzk_request('class'));
			$students->set('className', pzk_request('className'));
			$frame->append($students);
			$this->append($frame);
		$this->display();
	}
	public function studyAction(){
		$this->initPage();
			$frame 	= 	$this->parse('admin/home/headmaster/student');
			$listresults = $this->parse('admin/home/headmaster/listresult');
			$listresults->set('schoolYear', pzk_request('schoolYear'));
			$listresults->set('week', pzk_request('week'));
			$listresults->set('grade', pzk_request('grade'));
			$listresults->set('nameOfClass', pzk_request('nameOfClass'));
			$listresults->set('subject', pzk_request('subject'));

			$frame->append($listresults);
			$this->append($frame);
		$this->display();
	}
	public function completeAction(){
		$this->initPage();
			$frame 	= 	$this->parse('admin/home/headmaster/student');
			$listcompletes = $this->parse('admin/home/headmaster/listcomplete');
			
			$listcompletes->set('schoolYear', pzk_request('schoolYear'));
			$listcompletes->set('grade', pzk_request('grade'));
			$listcompletes->set('nameOfClass', pzk_request('nameOfClass'));
		
			
			$frame->append($listcompletes);
			$this->append($frame);
		$this->display();
	}
	public function workCompleteAction(){
		$this->initPage();
			$workcomplete 	= 	$this->parse('admin/home/headmaster/workcomplete');
			
			$workcomplete->set('schoolYear', pzk_request('schoolYear'));
			$workcomplete->set('grade', pzk_request('grade'));
			$workcomplete->set('nameOfClass', pzk_request('nameOfClass'));
			
			$this->append($workcomplete);
		$this->display();
	}
	public function listTeacherAction(){
		$this->initPage();
			$frame 	= 	$this->parse('admin/home/headmaster/contentteacher');
			$frame->set('schoolYear', pzk_request('schoolYear'));
			$frame->set('class', pzk_request('class'));
			$frame->set('nameOfClass', pzk_request('className'));
			$frame->set('subject', pzk_request('subject'));
			
			
			$listteachers = $this->parse('admin/home/headmaster/listteacher');
			$listteachers->set('schoolYear', pzk_request('schoolYear'));
			$listteachers->set('class', pzk_request('class'));
			$listteachers->set('nameOfClass', pzk_request('className'));
			$listteachers->set('subject', pzk_request('subject'));
			$frame->append($listteachers);
			$this->append($frame);
		$this->display();
	}
}