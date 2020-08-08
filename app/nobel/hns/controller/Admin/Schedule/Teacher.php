<?php
class PzkAdminScheduleTeacherController extends PzkBackendController {
	public function indexAction() {
		$this->render('admin/schedule/teacher');
	}
	
	public function studentsAction($classroomId) {
		$this->initPage();
		$frame 		= 	$this->parse('admin/schedule/teacher');
		$frame->setClassroomId( $classroomId);
		$students 	= 	$this->parse('admin/schedule/students');
		$students->setClassroomId( $classroomId);
		$frame->append($students);
		$this->append($frame);
		$this->display();
	}
	
	public function searchStudentAction() {
		$username = pzk_request()->getUsername();
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

		$txtName 	= 	pzk_request()->getTxtName();
		$txtUsername 	= 	pzk_request()->getTxtUsername();
		$txtEmail 	= 	pzk_request()->getTxtEmail();
		$txtPhone 	= 	pzk_request()->getTxtPhone();
		$txtBirthday 	= 	pzk_request()->getTxtBirthday();
		$txtSex 	= 	pzk_request()->getTxtSex();
		$txtPassword 	= 	pzk_request()->getTxtPassword();

		$classroomId 	= 	pzk_request()->getClassroomId();
		$gradeNum 	= 	pzk_request()->getGradeNum();
		//$className 	= 	pzk_request()->getClassName();
		$schoolYear 	= 	pzk_request()->getSchoolYear();		
		//add user table
		$entityUser = _db()->getTableEntity('user');
		$entityUser->loadWhere(array('username', $txtUsername));
		if($entityUser->getId()) {
			echo "-1"; // ten dang nhap da ton tai
		}else{
			$entityUser->setData(array(
				'name' 			=> 	$txtName,
				'username'		=>	$txtUsername,
				'password'		=>	md5($txtPassword),
				'email'			=>	$txtEmail,
				'phone'			=>	$txtPhone,
				'birthday'		=>	$txtBirthday,
				'sex'			=>	$txtSex,
				'class'			=>	$gradeNum,
				//'classname'		=>	$className,
				'status'		=> 	1,
				'software'		=> 	pzk_request()->getSoftwareId(),
				'site'			=> pzk_request()->getSiteId()
			));
			$entityUser->save();
			$studentIdNew = $entityUser->getId();			
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
				'software'		=> 	pzk_request()->getSoftwareId(),
				'site'			=> pzk_request()->getSiteId(),
				'paymentStatus'		=> 1,
				'serviceType'		=>	'full',
				'languages'			=>	'ev'
			));
			$entityPayment->save();

			// insert to education_classroom_student
			$entityClassroom = _db()->getTableEntity('education_classroom_student');
			$entityClassroom->loadWhere(array('and',
				array('classroomId', $classroomId),
				array('studentId', $studentIdNew)
			));
			if(!$entityClassroom->getId()) {
				$entityClassroom->setData(array(
					'classroomId' 	=> 	$classroomId,
					'studentId'		=>	$studentIdNew,
					'software'		=> 	pzk_request()->getSoftwareId(),
					'site'			=> pzk_request()->getSiteId()
				));
				$entityClassroom->save();
				$ttuser = $entityClassroom->getId();		
				$dateBirthday = date('d/m/Y', strtotime($txtBirthday));
				$str = '<tr> <td><input class="student_checkbox" type="checkbox" name="students[]" value="'.$ttuser.'" /></td><td>'.$studentIdNew.'</td><td>'.$txtUsername.'</td><td>'.$txtName.'</td><td>'.$dateBirthday.'</td><td>'.$txtPhone.'</td><td><a target="blank" class="btn btn-primary btn-xs" href="/Admin_Schedule_Teacher/student/'.$classroomId.'/'.$ttuser.'/'.$studentIdNew.'">Chi tiết</a></td><td><button class="btn btn-danger btn-xs" onclick="removeStudentFromClassroom('.$ttuser.'); return false;">Xóa</button></td> </tr>';
				echo $str;
			} else {
				echo '2';// da ton tai trong lop
			}
		}
	}
	public function addStudentAction() {
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
	
	public function removeStudentAction() {
		$entity = _db()->getTableEntity('education_classroom_student');
		$entity->setId( pzk_request()->getId());
		$entity->delete();
		echo '1';
	}
	
	public function studentAction($classroomId, $classroomStudentId, $studentId) {
		$this->initPage();
		$frame 		= 	$this->parse('admin/schedule/teacher');
		$frame->setClassroomId( $classroomId);
		$student 	= 	$this->parse('admin/schedule/student');
		$student->setClassroomId( $classroomId);
		$student->setClassroomStudentId( $classroomStudentId);
		$student->setStudentId( $studentId);
		$frame->append($student);
		$this->append($frame);
		$this->display();
	}
	
	public function changeStudentClassroomAction() {
		$entity = _db()->getTableEntity('education_classroom_student');
		$entity->load(pzk_request()->getId());		
		$entity->setClassroomId( pzk_request()->getClassroomId());
		$entity->save();
		echo 1;
			
	}
	
	public function gotoStudentAction($bookId) {
		$userId = pzk_request()->getUserId();
		$user = _db()->getEntity('User.Account.User')->load($userId);
		$user->login();
		$book = _db()->getTableEntity('user_book')->load($bookId);
		$class = $book->getClass();
		$subject = _db()->getTableEntity('categories')->load($book->getCategoryId());
		$topic 	= _db()->getTableEntity('categories')->load($book->getTopic());
		$homework = $book->getTestId();
		
		$this->redirect(BASE_REQUEST . '/practice/class-'.$class.'/subject-' . $subject->getAlias() . '-' . $subject->getId() . '/topic-'.$topic->getAlias() . '-' .$topic->getId() . '/homework-'.$homework);
	}
	
	
	public function teachersAction($classroomId) {
		$this->initPage();
		$frame 		= 	$this->parse('admin/schedule/teacher');
		$frame->setClassroomId( $classroomId);
		$teachers = $this->parse('admin/schedule/teachers');
		$teachers->setClassroomId( $classroomId);
		$frame->append($teachers);
		$this->append($frame);
		$this->display();
	}
	
	public function teacherAction($classroomId, $classroomTeacherId, $teacherId) {
		$this->initPage();
		$frame 		= 	$this->parse('admin/schedule/teacher');
		$frame->setClassroomId( $classroomId);
		$teacher 	= 	$this->parse('admin/schedule/teacher/detail');
		$teacher->setClassroomId( $classroomId);
		$teacher->setClassroomTeacherId( $classroomTeacherId);
		$teacher->setTeacherId( $teacherId);
		$frame->append($teacher);
		$this->append($frame);
		$this->display();
	}
	
	public function searchTeacherAction() {
		$username = pzk_request()->getUsername();
		$teacherRole = _db()->select('*')->from('admin_level')->whereLevel('Teacher')->result_one();
		$hoomroomTeacherRole = _db()->select('*')->from('admin_level')->whereLevel('HomeroomTeacher')->result_one();
		$teachers = _db()->select('*')->from('admin')->likeName('%'.$username.'%')
		->inUsertype_id(array($teacherRole['id'], $hoomroomTeacherRole['id']))
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
		$classroomId 	= 	pzk_request()->getClassroomId();
		$teacherId 		= 	pzk_request()->getTeacherId();
		$subjectId 		= 	pzk_request()->getSubjectId();
		
		$entity = _db()->getTableEntity('education_classroom_teacher');
		$entity->loadWhere(array('and',
			array('classroomId', $classroomId),
			array('teacherId', $teacherId),
			array('subjectId', $subjectId),
		));
		if(!$entity->getId()) {
			$entity->setData(array(
				'classroomId' 	=> 	$classroomId,
				'teacherId'		=>	$teacherId,
				'subjectId'		=>	$subjectId,
				'software'		=> 	pzk_request()->getSoftwareId(),
				'site'			=> pzk_request()->getSiteId()
			));
			$entity->save();
			echo '1';
		} else {
			echo '-1';
		}
	}
	
	public function removeTeacherAction() {
		$entity = _db()->getTableEntity('education_classroom_teacher');
		$entity->setId( pzk_request()->getId());
		$entity->delete();
		echo '1';
	}
	
	public function changeTeacherClassroomAction() {
		$entity = _db()->getTableEntity('education_classroom_teacher');
		$entity->load(pzk_request()->getId());
		$entity->setClassroomId( pzk_request()->getClassroomId());
		$entity->save();
		echo '1';
	}
	//add giao vien chu nhiem
	public function changeHomeroomTeacherAction() {
		
		$entity = _db()->getTableEntity('education_classroom');
		$entity->load(pzk_request()->getClassroomId());
		debug($entity);
		if($entity->getId()){	

			$entity->setHomeroomTeacherId( pzk_request()->getTeacherId());
			$entity->save();
		}else{
			$entity->setData(array(
				'classroomId' 	=> 	pzk_request()->getClassroomId(),
				'gradeNum'		=>	pzk_request()->getGradeNum(),
				'className'		=>	pzk_request()->getClassName(),
				'schoolYear'		=>	pzk_request()->getSchoolYear(),
				'homeroomTeacherId' => pzk_request()->getTeacherId(),
				'software'		=> 	pzk_request()->getSoftwareId(),
				'site'			=> pzk_request()->getSiteId()
			));
			$entity->save();
		}
		
		echo '1';			
	}
	
	public function homeworksAction($classroomId) {
		$this->initPage();
		$frame 		= 	$this->parse('admin/schedule/teacher');
		$frame->setClassroomId( $classroomId);
		$homeworks = $this->parse('admin/schedule/homeworks');
		$homeworks->setClassroomId( $classroomId);
		$frame->append($homeworks);
		$this->append($frame);
		$this->display();
	}
	
	public function homeworkAction($classroomId, $classroomHomeworkId, $homeworkId) {
		$this->initPage();
		$frame 		= 	$this->parse('admin/schedule/teacher');
		$frame->setClassroomId( $classroomId);
		$homework = $this->parse('admin/schedule/homework/detail');
		$homework->setClassroomId( $classroomId);
		$homework->setClassroomHomeworkId( $classroomHomeworkId);
		$homework->setHomeworkId( $homeworkId);
		$frame->append($homework);
		$this->append($frame);
		$this->display();
	}

	public function searchHomeworkAction($gradeNum, $subjectId) {
		$username = pzk_request()->getUsername();
		$homeworks = _db()->select('*')->from('tests')
			->where(array(
				'or',
				array('like', 'name', '%'.$username.'%'),
				array('like', 'name_en', '%'.$username.'%'),
				array('like', 'name_sn', '%'.$username.'%'),
			))
			->limit(0, 10);
		if($gradeNum) {
			$homeworks->likeClasses('%,'.$gradeNum.',%');
		}
		if($subjectId) {
			$homeworks->whereSubjectId($subjectId);
		}
		$homeworks->orderBy('id desc');
		$homeworks = $homeworks->result();
		$str = '<table class="table">';
		foreach($homeworks as $homework):
			$str .= '<tr><td>'.$homework['name'].'</td><td><button onclick="addHomeworkToClassroom('.$homework['id'].')" class="btn btn-primary">+</button></td></tr>';
		endforeach;
		$str .= '</table>';
		echo $str;
	}
	
	public function addHomeworkAction() {
		$classroomId 	= 	pzk_request()->getClassroomId();
		$homeworkId 		= 	pzk_request()->getHomeworkId();
		$entity = _db()->getTableEntity('education_classroom_homework');
		$entity->loadWhere(array('and',
			array('classroomId', $classroomId),
			array('homeworkId', $homeworkId)
		));
		if(!$entity->getId()) {
			$entity->setData(array(
				'classroomId' 	=> 	$classroomId,
				'homeworkId'		=>	$homeworkId,
				'software'		=> 	pzk_request()->getSoftwareId(),
				'site'			=> pzk_request()->getSiteId()
			));
			$entity->save();
			echo '1';
		} else {
			echo '-1';
		}
	}
	
	
	public function removeHomeworkAction() {
		$entity = _db()->getTableEntity('education_classroom_homework');
		$entity->setId( pzk_request()->getId());
		$entity->delete();
		echo '1';
	}
	
	
	public function changeHomeworkClassroomAction() {
		$entity = _db()->getTableEntity('education_classroom_homework');
		$entity->load(pzk_request()->getId());
		$entity->setClassroomId( pzk_request()->getClassroomId());
		$entity->save();
		echo '1';
	}
	
	
	public function subjectAction($teacherScheduleId) {
		$this->initPage();
		$frame 		= 	$this->parse('admin/schedule/teacher');
		$frame->setClassroomId( $classroomId);
		$request = pzk_request();
		$subject = $this->parse('admin/schedule/subject');
		$subject->setTeacherId( $request->getTeacherId());
		$subject->setSubjectId( $request->getSubjectId());
		$subject->setClassroomId( $request->getClassroomId());
		$subject->setTeacherScheduleId( $request->getTeacherScheduleId());
		$frame->append($subject);
		$this->append($frame);
		$this->display();
	}
	
	public function saveLectureScheduleAction() {
		$request 			= 	pzk_request();
		$teacherScheduleId 	= 	$request->getTeacherScheduleId();
		$topicId 			= 	$request->getTopicId();
		$exerciseNum 		= 	$request->getExerciseNum();
		$expiredDate 		= 	$request->getExpiredDate();
		$type				=	$request->getType();
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
			$entity->setTeacherScheduleId( $teacherScheduleId);
			$entity->setTopicId( $topicId);
			$entity->setExerciseNum( $exerciseNum);
			$entity->setExpiredDate( $expiredDate);
			$entity->setType( $type);
			$entity->setSoftware( $request->getSoftwareId());
			$entity->setSite( $request->getSiteId());
			$entity->setTeacherId( $teacherSchedule['teacherId']);
			$entity->setSubjectId( $teacherSchedule['subjectId']);
			$entity->setClassroomId( $teacherSchedule['classroomId']);
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
		$frame->setClassroomId( $classroomId);
		$books = $this->parse('admin/schedule/books');
		$books->setClassroomId( $classroomId);
		$frame->append($books);
		$this->append($frame);
		$this->display();
	}
	
	public function showHomeworkAction($classroomId, $homeworkId) {
		$this->initPage();
		
		$frame 		= 	$this->parse('admin/schedule/teacher');
		$frame->setClassroomId( $classroomId);
		$homework 	= 	$this->parse('admin/schedule/homework');
		$homework->setClassroomId( $classroomId);
		$homework->setHomeworkId( $homeworkId);
		$frame->append($homework);
		
		$this->append($frame);
		
		$this->display();
	}
	public function showHomeworkDetailAction($classroomId, $homeworkId) {
		
		$homework 	= 	$this->parse('admin/schedule/homework');
		$homework->setClassroomId( $classroomId);
		$homework->setHomeworkId( $homeworkId);
		$homework->display();
	}
	
	public function addHomeworkToClassroomAction($classroomId) {
		if(pzk_request()->getLastItemId()) {
			$entity = _db()->getTableEntity('education_classroom_homework');
			$entity->setClassroomId( $classroomId);
			$entity->setHomeworkId( pzk_request()->getLastItemId());
			$entity->setSoftware( pzk_request()->getSoftwareId());
			$entity->setSite( pzk_request()->getSiteId());
			$entity->save();
		}
		$this->redirect('homeworks/' . $classroomId);
	}
	
	public function addHomeworkToClassroomsAction($classroomId, $classroomHomeworkId, $homeworkId) {
		$classroomIds = pzk_request()->getClassroomIds();
		_db()->delete()->fromEducation_classroom_homework()->whereHomeworkId($homeworkId)->result();
		foreach($classroomIds as $clrId) {
			$classroomEntity = _db()->getTableEntity('education_classroom_homework');
			$classroomEntity->setData(array(
				'classroomId'	=>	$clrId,
				'homeworkId'	=>	$homeworkId,
				'software'		=>	pzk_request()->getSoftwareId(),
				'site'			=>	pzk_request()->getSiteId()
			));
			$classroomEntity->save();
		}
	}
	
	public function renderLayoutAction() {
		$this->renderLayout('admin/renderLayout', null, array(
			'name'	=>	'Kien'
		));
	}
	
	public function remarkAction($classroomId, $homeworkId, $bookId) {
		$userbook = _db()->getEntity('Education.Userbook')->load($bookId);
		$userbook->mark();
		$this->redirect('showHomework/' . $classroomId . '/' . $homeworkId);
	}
	
	public function remarkAllAction($classroomId, $homeworkId) {
		$classroom = _db()->getEntity('Education.Classroom')->load($classroomId);
		$userbooks = $classroom->getUserbooks($homeworkId);
		foreach($userbooks as $userbook) {
			$userbook->mark();
		}
		$this->redirect('showHomework/' . $classroomId . '/' . $homeworkId);
	}
	
	public function remarkFullAction() {
		$userbooks = _db()->selectAll()->fromUser_book()->result('Education.Userbook');
		foreach($userbooks as $userbook) {
			$userbook->mark();
			echo '<br />';
			echo $userbook->getId();
			echo '<br />';
		}
	}
}
