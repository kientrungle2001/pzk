<?php
class PzkAdminClassroomStudentController extends PzkBackendController {
	public function indexAction($classroomId) {
		$this->initPage();
		$classroom = $this->parse('admin/classroom/student');
		$classroom->set('classroomId', $classroomId);
		$this->append($classroom);
		$this->display();
	}
	
	public function searchAction() {
		$username = pzk_request('username');
		$students = _db()->select('*')->from('user')->likeUsername('%'.$username.'%')->limit(0, 10)->result();
		$str = '<table class="table">';
		foreach($students as $student):
			$str .= '<tr><td>'.$student['username'].'</td><td><button onclick="addStudentToClassroom('.$student['id'].')" class="btn btn-default">Thêm vào lớp</button></td></tr>';
		endforeach;
		$str .= '</table>';
		echo $str;
	}
	
	public function addAction() {
		$classroomId 	= 	pzk_request('classroomId');
		$studentId 		= 	pzk_request('studentId');
		$entity = _db()->getTableEntity('education_classroom_student');
		$entity->loadWhere(array('and',
			array('classroomId', $classroomId),
			array('studentId', $studentId)
		));
		if(!$entity->get('id')) {
			$entity->setData(array(
				'classroomId' 	=> 	$classroomId,
				'studentId'		=>	$studentId,
				'software'		=> 	pzk_request('softwareId'),
				'site'			=> pzk_request('siteId')
			));
			$entity->save();
			echo '1';
		} else {
			echo '-1';
		}
	}
	public function delAction() {
		$entity = _db()->getTableEntity('education_classroom_student');
		$entity->set('id', pzk_request('id'));
		$entity->delete();
		echo '1';
	}
	
	public function changeAction() {
		$entity = _db()->getTableEntity('education_classroom_student');
		$entity->load(pzk_request('id'));
		$entity->set('classroomId', pzk_request('classroomId'));
		$entity->save();
		echo '1';
	}
}