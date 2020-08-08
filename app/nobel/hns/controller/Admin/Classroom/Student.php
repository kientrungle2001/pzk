<?php
class PzkAdminClassroomStudentController extends PzkBackendController {
	public function indexAction($classroomId) {
		$this->initPage();
		$classroom = $this->parse('admin/classroom/student');
		$classroom->setClassroomId( $classroomId);
		$this->append($classroom);
		$this->display();
	}
	
	public function searchAction() {
		$username = pzk_request()->getUsername();
		$students = _db()->select('*')->from('user')->likeUsername('%'.$username.'%')->limit(0, 10)->result();
		$str = '<table class="table">';
		foreach($students as $student):
			$str .= '<tr><td>'.$student['username'].'</td><td><button onclick="addStudentToClassroom('.$student['id'].')" class="btn btn-default">Thêm vào lớp</button></td></tr>';
		endforeach;
		$str .= '</table>';
		echo $str;
	}
	
	public function addAction() {
		$classroomId 	= 	pzk_request()->getClassroomId();
		$studentId 		= 	pzk_request()->getStudentId();
		$entity = _db()->getTableEntity('education_classroom_student');
		$entity->loadWhere(array('and',
			array('classroomId', $classroomId),
			array('studentId', $studentId)
		));
		if(!$entity->getId()) {
			$entity->setData(array(
				'classroomId' 	=> 	$classroomId,
				'studentId'		=>	$studentId,
				'software'		=> 	pzk_request()->getSoftwareId(),
				'site'			=> pzk_request()->getSiteId()
			));
			$entity->save();
			echo '1';
		} else {
			echo '-1';
		}
	}
	public function delAction() {
		$entity = _db()->getTableEntity('education_classroom_student');
		$entity->setId( pzk_request()->getId());
		$entity->delete();
		echo '1';
	}
	
	public function changeAction() {
		$entity = _db()->getTableEntity('education_classroom_student');
		$entity->load(pzk_request()->getId());
		$entity->setClassroomId( pzk_request()->getClassroomId());
		$entity->save();
		echo '1';
	}
}