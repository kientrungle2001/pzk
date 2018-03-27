<?php
class PzkAdminHomeroomTeacherTeacherController extends PzkBackendController {
	
	public function studentsAction($classroomId) {
		$this->initPage();
		$frame 		= 	$this->parse('admin/schedule/teacher');
		$frame->set('classroomId', $classroomId);
		$students 	= 	$this->parse('admin/schedule/students');
		$students->set('classroomId', $classroomId);
		$frame->append($students);
		$this->append($frame);
		$this->display();
	}
	
	public function searchStudentAction() {
		$username = pzk_request('username');
		$students = _db()->select('*')->from('user')->likeUsername('%'.$username.'%')->limit(0, 10)->result();
		$str = '<table class="table">';
		foreach($students as $student):
			$str .= '<tr><td>'.$student['username'].'</td><td>'.$student['name'].'</td><td>'.date('d/m/Y', strtotime($student['birthday'])).'</td><td class="text-right"><button onclick="addStudentToClassroom('.$student['id'].')" class="btn btn-primary">+</button></td></tr>';
		endforeach;
		$str .= '</table>';
		echo $str;
	}
	//add hocj sinh moi
	public function addNewStudentAction(){

		$txtName 	= 	pzk_request('txtName');
		$txtUsername 	= 	pzk_request('txtUsername');
		$txtEmail 	= 	pzk_request('txtEmail');
		$txtBirthday 	= 	pzk_request('txtBirthday');
		$txtSex 	= 	pzk_request('txtSex');
		$txtPassword 	= 	pzk_request('txtPassword');

		$classroomId 	= 	pzk_request('classroomId');
		$gradeNum 	= 	pzk_request('gradeNum');
		//$className 	= 	pzk_request('className');
		$schoolYear 	= 	pzk_request('schoolYear');		
		//add user table
		$entityUser = _db()->getTableEntity('user');
		$entityUser->loadWhere(array('username', $txtUsername));
		if($entityUser->get('id')) {
			echo "-1"; // ten dang nhap da ton tai
		}else{
			$entityUser->setData(array(
				'name' 			=> 	$txtName,
				'username'		=>	$txtUsername,
				'password'		=>	md5($txtPassword),
				'email'			=>	$txtEmail,
				'birthday'		=>	$txtBirthday,
				'sex'			=>	$txtSex,
				'class'			=>	$gradeNum,
				//'classname'		=>	$className,
				'software'		=> 	pzk_request('softwareId'),
				'site'			=> pzk_request('siteId')
			));
			$entityUser->save();
			$studentIdNew = $entityUser->get('id');			
			// insert to historypayment
			$datePayment= date("Y-m-d");
			
			$date 			= date("d",	strtotime($datePayment));
			$month 			= date("m",	strtotime($datePayment));
			$year 			= date("Y",	strtotime($datePayment));
			$expiredYear = $year + (6- $gradeNum ); 
			if($month == '02' && $date == '29') {
				$date = '28';
			}
			$expriedDate	= $expiredYear.'-'.$month.'-'.$date . ' 00:00:00';			

			$entityPayment = _db()->getTableEntity('history_payment');
			$entityPayment->setData(array(
				'username' 	=> 	$txtUsername,
				'paymentDate'		=>	$datePayment,
				'expiredDate'		=>	$expriedDate,
				'software'		=> 	pzk_request('softwareId'),
				'site'			=> pzk_request('siteId')
			));
			$entityPayment->save();

			// insert to education_classroom_student
			$entityClassroom = _db()->getTableEntity('education_classroom_student');
			$entityClassroom->loadWhere(array('and',
				array('classroomId', $classroomId),
				array('studentId', $studentIdNew)
			));
			if(!$entityClassroom->get('id')) {
				$entityClassroom->setData(array(
					'classroomId' 	=> 	$classroomId,
					'studentId'		=>	$studentIdNew,
					'software'		=> 	pzk_request('softwareId'),
					'site'			=> pzk_request('siteId')
				));
				$entityClassroom->save();
				$ttuser = $entityClassroom->get('id');		
				$dateBirthday = date('d/m/Y', strtotime($txtBirthday));
				$str = '<tr> <td><input class="student_checkbox" type="checkbox" name="students[]" value="'.$ttuser.'" /></td><td>'.$studentIdNew.'</td><td>'.$txtUsername.'</td><td>'.$txtName.'</td><td>'.$dateBirthday.'</td><td><a class="btn btn-primary btn-xs" href="/Admin_Schedule_Teacher/student/'.$classroomId.'/'.$ttuser.'/'.$studentIdNew.'">Chi tiết</a></td><td><button class="btn btn-danger btn-xs" onclick="removeStudentFromClassroom('.$ttuser.'); return false;">Xóa</button></td> </tr>';
				echo $str;
			} else {
				echo '2';// da ton tai trong lop
			}
		}
	}
	public function addStudentAction() {
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
	
	public function removeStudentAction() {
		$entity = _db()->getTableEntity('education_classroom_student');
		$entity->set('id', pzk_request('id'));
		$entity->delete();
		echo '1';
	}
	
	public function studentAction($classroomId, $classroomStudentId, $studentId) {
		$this->initPage();
		$frame 		= 	$this->parse('admin/schedule/teacher');
		$frame->set('classroomId', $classroomId);
		$student 	= 	$this->parse('admin/schedule/student');
		$student->set('classroomId', $classroomId);
		$student->set('classroomStudentId', $classroomStudentId);
		$student->set('studentId', $studentId);
		$frame->append($student);
		$this->append($frame);
		$this->display();
	}
	
	public function changeStudentClassroomAction() {
		$entity = _db()->getTableEntity('education_classroom_student');
		$entity->load(pzk_request('id'));		
		$entity->set('classroomId', pzk_request('classroomId'));
		$entity->save();
		echo 1;
			
	}
	
	
	public function teachersAction($classroomId) {
		$this->initPage();
		$frame 		= 	$this->parse('admin/schedule/teacher');
		$frame->set('classroomId', $classroomId);
		$teachers = $this->parse('admin/schedule/teachers');
		$teachers->set('classroomId', $classroomId);
		$frame->append($teachers);
		$this->append($frame);
		$this->display();
	}
	
	public function teacherAction($classroomId, $classroomTeacherId, $teacherId, $subjectId) {
		$this->initPage();
		$frame 		= 	$this->parse('admin/homeroomTeacher/teacher');
		$frame->set('classroomId', $classroomId);
		$teacher 	= 	$this->parse('admin/homeroomTeacher/teacher/detail');
		$teacher->set('classroomId', $classroomId);
		$teacher->set('classroomTeacherId', $classroomTeacherId);
		$teacher->set('teacherId', $teacherId);
		$teacher->set('subjectId', $subjectId);
		$frame->append($teacher);
		$this->append($frame);
		$this->display();
	}
	
	public function searchTeacherAction() {
		$username = pzk_request('username');
		$teacherRole = _db()->select('*')->from('admin_level')->whereLevel('Teacher')->result_one();
		$teachers = _db()->select('*')->from('admin')->likeName('%'.$username.'%')
		->whereUsertype_id($teacherRole['id'])
		->limit(0, 10)->result();
		$subjects = _db()->select('*')->from('categories')->whereType('subject')->result();
		
		$str = '<table class="table">';
		foreach($teachers as $teacher):
			$subjectOptions = '<select name="subjects" id="subject-for-teacher-'.$teacher['id'].'" class="form-control">';
			foreach($subjects as $subject) {
				$subjectOptions .= '<option value="' . $subject['id'] . '">' . $subject['name'] . '</option>';
			}
			$subjectOptions .= '</select>';
			$str .= '<tr><td>'.$teacher['name'].'</td><td>'.$teacher['fullName'].'</td><td>'.$subjectOptions.'</td><td><button onclick="addTeacherToClassroom('.$teacher['id'].')" class="btn btn-primary">+</button></td></tr>';
		endforeach;
		$str .= '</table>';
		echo $str;
	}
	
	public function addTeacherAction() {
		$classroomId 	= 	pzk_request('classroomId');
		$teacherId 		= 	pzk_request('teacherId');
		$subjectId 		= 	pzk_request('subjectId');
		
		$entity = _db()->getTableEntity('education_classroom_teacher');
		$entity->loadWhere(array('and',
			array('classroomId', $classroomId),
			array('teacherId', $teacherId),
			array('subjectId', $subjectId),
		));
		if(!$entity->get('id')) {
			$entity->setData(array(
				'classroomId' 	=> 	$classroomId,
				'teacherId'		=>	$teacherId,
				'subjectId'		=>	$subjectId,
				'software'		=> 	pzk_request('softwareId'),
				'site'			=> pzk_request('siteId')
			));
			$entity->save();
			echo '1';
		} else {
			echo '-1';
		}
	}
	
	public function removeTeacherAction() {
		$entity = _db()->getTableEntity('education_classroom_teacher');
		$entity->set('id', pzk_request('id'));
		$entity->delete();
		echo '1';
	}
	
	public function changeTeacherClassroomAction() {
		$entity = _db()->getTableEntity('education_classroom_teacher');
		$entity->load(pzk_request('id'));
		$entity->set('classroomId', pzk_request('classroomId'));
		$entity->save();
		echo '1';
	}
	//add giao vien chu nhiem
	public function changeHomeroomTeacherAction() {
		
		$entity = _db()->getTableEntity('education_classroom');
		$entity->load(pzk_request('classroomId'));
		debug($entity);
		if($entity->get('id')){	

			$entity->set('homeroomTeacherId', pzk_request('teacherId'));
			$entity->save();
		}else{
			$entity->setData(array(
				'classroomId' 	=> 	pzk_request('classroomId'),
				'gradeNum'		=>	pzk_request('gradeNum'),
				'className'		=>	pzk_request('className'),
				'schoolYear'		=>	pzk_request('schoolYear'),
				'homeroomTeacherId' => pzk_request('teacherId'),
				'software'		=> 	pzk_request('softwareId'),
				'site'			=> pzk_request('siteId')
			));
			$entity->save();
		}
		
		echo '1';			
	}
	
	public function homeworksAction($classroomId) {
		$this->initPage();
		$frame 		= 	$this->parse('admin/schedule/teacher');
		$frame->set('classroomId', $classroomId);
		$homeworks = $this->parse('admin/schedule/homeworks');
		$homeworks->set('classroomId', $classroomId);
		$frame->append($homeworks);
		$this->append($frame);
		$this->display();
	}
	
	public function homeworkAction($classroomId, $classroomHomeworkId, $homeworkId) {
		$this->initPage();
		$frame 		= 	$this->parse('admin/schedule/teacher');
		$frame->set('classroomId', $classroomId);
		$homework = $this->parse('admin/schedule/homework/detail');
		$homework->set('classroomId', $classroomId);
		$homework->set('classroomHomeworkId', $classroomHomeworkId);
		$homework->set('homeworkId', $homeworkId);
		$frame->append($homework);
		$this->append($frame);
		$this->display();
	}

	public function searchHomeworkAction() {
		$username = pzk_request('username');
		$homeworks = _db()->select('*')->from('tests')
			->where(array(
				'or',
				array('like', 'name', '%'.$username.'%'),
				array('like', 'name_en', '%'.$username.'%'),
				array('like', 'name_sn', '%'.$username.'%'),
			))
			->limit(0, 10)->result();
		$str = '<table class="table">';
		foreach($homeworks as $homework):
			$str .= '<tr><td>'.$homework['name'].'</td><td><button onclick="addHomeworkToClassroom('.$homework['id'].')" class="btn btn-primary">+</button></td></tr>';
		endforeach;
		$str .= '</table>';
		echo $str;
	}
	
	public function addHomeworkAction() {
		$classroomId 	= 	pzk_request('classroomId');
		$homeworkId 		= 	pzk_request('homeworkId');
		$entity = _db()->getTableEntity('education_classroom_homework');
		$entity->loadWhere(array('and',
			array('classroomId', $classroomId),
			array('homeworkId', $homeworkId)
		));
		if(!$entity->get('id')) {
			$entity->setData(array(
				'classroomId' 	=> 	$classroomId,
				'homeworkId'		=>	$homeworkId,
				'software'		=> 	pzk_request('softwareId'),
				'site'			=> pzk_request('siteId')
			));
			$entity->save();
			echo '1';
		} else {
			echo '-1';
		}
	}
	
	
	public function removeHomeworkAction() {
		$entity = _db()->getTableEntity('education_classroom_homework');
		$entity->set('id', pzk_request('id'));
		$entity->delete();
		echo '1';
	}
	
	
	public function changeHomeworkClassroomAction() {
		$entity = _db()->getTableEntity('education_classroom_homework');
		$entity->load(pzk_request('id'));
		$entity->set('classroomId', pzk_request('classroomId'));
		$entity->save();
		echo '1';
	}
	
	
	public function subjectAction($teacherScheduleId) {
		$this->initPage();
		$frame 		= 	$this->parse('admin/schedule/teacher');
		$frame->set('classroomId', $classroomId);
		$request = pzk_request();
		$subject = $this->parse('admin/schedule/subject');
		$subject->set('teacherId', $request->get('teacherId'));
		$subject->set('subjectId', $request->get('subjectId'));
		$subject->set('classroomId', $request->get('classroomId'));
		$subject->set('teacherScheduleId', $request->get('teacherScheduleId'));
		$frame->append($subject);
		$this->append($frame);
		$this->display();
	}
	
	public function saveLectureScheduleAction() {
		$request 			= 	pzk_request();
		$teacherScheduleId 	= 	$request->get('teacherScheduleId');
		$topicId 			= 	$request->get('topicId');
		$exerciseNum 		= 	$request->get('exerciseNum');
		$expiredDate 		= 	$request->get('expiredDate');
		$type				=	$request->get('type');
		$scheduled = _db()->select('*')->from('education_lecture_schedule')->where(array(
			'and',
			array('teacherScheduleId', 	$teacherScheduleId),
			array('topicId', 			$topicId),
			array('exerciseNum', 		$exerciseNum),
			array('type', 				$type),
		))->result_one();
		$teacherSchedule = _db()->select('*')->from('education_classroom_teacher')->whereId($teacherScheduleId)->result_one();
		if(!$scheduled) {
			$entity = _db()->getTableEntity('education_lecture_schedule');
			$entity->set('teacherScheduleId', $teacherScheduleId);
			$entity->set('topicId', $topicId);
			$entity->set('exerciseNum', $exerciseNum);
			$entity->set('expiredDate', $expiredDate);
			$entity->set('type', $type);
			$entity->set('software', $request->get('softwareId'));
			$entity->set('site', $request->get('siteId'));
			$entity->set('teacherId', $teacherSchedule['teacherId']);
			$entity->set('subjectId', $teacherSchedule['subjectId']);
			$entity->set('classroomId', $teacherSchedule['classroomId']);
			$entity->save();
			echo 'inserted';
		} else {
			_db()->update('education_lecture_schedule')->set(array(
				'teacherScheduleId'	=> $teacherScheduleId,
				'topicId'			=> $topicId,
				'exerciseNum'		=> $exerciseNum,
				'expiredDate'		=> $expiredDate,
				'teacherId'			=> $teacherSchedule['teacherId'],
				'subjectId'			=> $teacherSchedule['subjectId'],
				'classroomId'		=> $teacherSchedule['classroomId'],
			))->whereId($scheduled['id'])->result();
			echo 'updated';
		}
	}
	
	public function booksAction($classroomId) {
		$this->initPage();
		$frame 		= 	$this->parse('admin/schedule/teacher');
		$frame->set('classroomId', $classroomId);
		$books = $this->parse('admin/schedule/books');
		$books->set('classroomId', $classroomId);
		$frame->append($books);
		$this->append($frame);
		$this->display();
	}
	
	public function showHomeworkAction($classroomId, $homeworkId) {
		$this->initPage();
		
		$frame 		= 	$this->parse('admin/schedule/teacher');
		$frame->set('classroomId', $classroomId);
		$homework 	= 	$this->parse('admin/schedule/homework');
		$homework->set('classroomId', $classroomId);
		$homework->set('homeworkId', $homeworkId);
		$frame->append($homework);
		
		$this->append($frame);
		
		$this->display();
	}
	public function showHomeworkDetailAction($classroomId, $homeworkId) {
		
		$homework 	= 	$this->parse('admin/schedule/homework');
		$homework->set('classroomId', $classroomId);
		$homework->set('homeworkId', $homeworkId);
		$homework->display();
	}
	
	public function addHomeworkToClassroomAction($classroomId) {
		if(pzk_request('lastItemId')) {
			$entity = _db()->getTableEntity('education_classroom_homework');
			$entity->set('classroomId', $classroomId);
			$entity->set('homeworkId', pzk_request('lastItemId'));
			$entity->set('software', pzk_request('softwareId'));
			$entity->set('site', pzk_request('siteId'));
			$entity->save();
		}
		$this->redirect('homeworks/' . $classroomId);
	}
	
}
