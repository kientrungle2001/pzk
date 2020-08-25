<?php
class PzkAdminBookController extends PzkGridAdminController {
	
	public $table = 'user_book';
	public function __construct(){
		parent::__construct();
	
		$adminLevel = pzk_session()->getAdminLevel();
	
		if($adminLevel === 'Administrator'){
				
			$this->updateData = array(
					array(
							'index' => 'teacherId',
							'type' 	=> 'select',
							'label' => '',
							'table' 		=> 'admin',
							'show_value' 	=> 'id',
							'show_name' 	=> 'name',
							'condition'		=> 'usertype_id = 5',
							'selectLabel'	=>	'Chọn giáo viên',
							'nameField'		=>	'Cập nhận giáo viên',
					),
			);
		}
	}
	
	public $joins = array(
			array(
					'table' 	=> 	'user',
					'condition' => 	'user_book.userId = user.id',
					'type' 		=>	'left'
			),
			array(
					'table' 	=> 'tests',
					'condition' => 'user_book.testId = tests.id',
					'type' 		=>'left'
			)
	);
	
	//select table
	public $selectFields = 'user_book.*, user.username as username, tests.name as testName, tests.practice, tests.trial';

	public $quickFieldSettings = array(
			array(
					'index' => 'username',
					'type' 	=> 'text',
					'label' => 'Học sinh'
			)
	);
	
	public $listFieldSettings = array(
			array(
					'index' => 'username',
					'type' 	=> 'text',
					'label' => 'Học sinh'
			),
			array(
					'index' => 'testName',
					'type' 	=> 'text',
					'label' => 'Đề',
					'link'	=> '/Admin_Book/details/'
			),
			
			array(
				'label' 	=> "Các GV chấm",
				'index' 	=> "teacherIds",
				'type' 		=> "nameid",
				'table' 	=> 'admin',
				'findField' => 'id',
				'showField' => 'name',
			),
			array(
					'index' => 'practice',
					'type' 	=> 'text',
					'label' => 'Luyện tập',
					'maps'	=> array(
						0		=>	'Đề thi',
						1 		=>	'Bài luyện tập'
					)
			),
			array(
					'index' => 'trial',
					'type' 	=> 'text',
					'label' => 'Hình thức',
					'maps'	=> array(
						0		=>	'Trả phí',
						1 		=>	'Dùng thử'
					)
			),
			array(
					'index' => 'exercise_number',
					'type' 	=> 'text',
					'label' => 'Bài'
			),
			array(
					'index' => 'quantity_question',
					'type' 	=> 'text',
					'label' => 'Số câu'
			),
			array(
					'index' => 'mark',
					'type' 	=> 'text',
					'label' => 'Số điểm'
			),
			array(
					'index' => 'teacherMark',
					'type' 	=> 'text',
					'label' => 'Điểm GV'
			),
			array(
					'index' => 'duringTime',
					'type' 	=> 'text',
					'label' => 'Thời gian'
			),
			array(
					'index' => 'created',
					'type' 	=> 'datetime',
					'format'=> 'H:i d/m/Y',
					'label' => 'Thời gian làm'
			),
	);
	
	//search fields co type la text
	public $searchFields = array('`user_book`.`id`', '`user_book`.`school`' , 'username');
	public $searchLabel = 'Tìm kiếm';
	
	//filter cho cac truong co type la select
	public $filterFields = array(
			
			array(
					'index'			=>'categoryId',
					'type' 			=> 'select',
					'label' 		=> 'Danh mục',
					'table' 		=> 'categories',
					'show_value' 	=> 'id',
					'show_name' 	=> 'name',
			),
			array(
					'index'			=>'testId',
					'type' 			=> 'select',
					'label' 		=> 'Đề thi',
					'table' 		=> 'tests',
					'show_value' 	=> 'id',
					'show_name' 	=> 'name',
			),
			array(
					'index'			=> 'teacherId',
					'type' 			=> 'select',
					'label' 		=> 'Tên giáo viên',
					'table' 		=> 'admin',
					'show_value' 	=> 'id',
					'show_name' 	=> 'name',
					'condition'		=> 'usertype_id = 5',
					'notAccept'		=>	'1',
			),
			array(
					'index'			=> 'trytest',
					'type' 			=> 'selectoption',
					'option' 		=> array(
                        1 	 => 'Thi trắc nghiệm',
                        2	 	 => 'Thi tự luận'
                    ),
					'label'			=> 'Đề thi thử',
			),
			array(
					'index'			=> 'camp',
					'type' 			=> 'selectoption',
					'option' 		=> array(
                        1 	 => 'Thi đợt 1',
                        2	 	 => 'Thi đợt 2'
                    ),
					'label'			=> 'Đề thi thử',
			),
			
			array(
					'index'			=> 'status',
					'type' 			=> 'selectoption',
					'option' 		=> array(
                        	MARK_NO 	 => 'Chưa chấm',
                        	MARKED	 	 => 'Đã chấm xong',
							MARK_CHECKED => 'Đã duyệt',
							MARK_FALSE	 => 'Lỗi',
                    ),
					'label'			=> 'Trạng thái',
			),
			array(
					'index'			=> 'created',
					'type' 			=> 'datetime',
					'label'			=> 'Thời gian',
					'option' 		=> array(
							1	 	=> 'Hôm nay',
							2 		=> 'Hôm qua',
					),
			),
	);
	
	//edit table
	public $editFields = 'teacherId';
	//edit theo dang binh thuong
	public $editFieldSettings = array(
			array(
					'index' => 'teacherId',
					'type' 	=> 'select',
					'label' => 'Giáo viên chấm',
					'table' 		=> 'admin',
					'show_value' 	=> 'id',
					'show_name' 	=> 'name',
					'condition'		=> 'usertype_id = 5',
					'selectLabel'	=>	'Chọn giáo viên',
			),
	);
	
	
	public function changeLangAction() {
		$this->getSession()->setLang( pzk_request()->getLang());
		$this->redirect('admin_book/details/'.pzk_request()->getId());
	}
	public function detailsAction() {
		
		$userBookId		=	pzk_request()->getSegment(3);
		$this->initPage();
		$user_book_view = $this->parse('admin/book/details');
		
		$this->append($user_book_view);
		
		$user_book_view	= pzk_element()->getUser_book();
		
		$userBookModel 	= pzk_model('Userbook');
		
		$adminId = pzk_session()->getAdminId();
		
		$adminLevel = pzk_session()->getAdminLevel();
		
				
		$adminQuestionModel 	= pzk_model('AdminQuestion');
			
		$dataUserBook	= $userBookModel->getUserBook($userBookId);
		
		$dataShowUserBook 	= array(
				'user_book_id'		=> $dataUserBook['id'],
				'question_type'		=> @$dataUserBook['question_type'],
				'start_time'		=> date('Y-m-d', strtotime($dataUserBook['startTime'])),
				'during_time'		=> $dataUserBook['duringTime'],
				'status'			=> $dataUserBook['status'],
				'teacher_mark'		=> $dataUserBook['teacherMark'],
				'quantity_question' => $dataUserBook['quantity_question'],
				'marked'			=> $dataUserBook['marked'],
				'trytest'			=> $dataUserBook['trytest']
					
		);
			
		$dataUserAnswers 	= $userBookModel->getUserAnswerAdmin($userBookId);	
		
		$user_book_view->setDataShowUserBook( $dataShowUserBook);
			
		$user_book_view->setDataUserAnswers( $dataUserAnswers);
		
		if(pzk_request()->getIsAjax()) {
			$user_book_view->display();
		} else {
			$this->display();
		}
		
	}
	
	public function updatePostAction(){
		
		$row = pzk_request()->getFilterData('user_book_id, mark, checkfalse, recommend_mark, trytest, answers, answers_level, question_id, save, check');
		//debug($row);die();
		$adminId = pzk_session()->getAdminId();
		$userBook	= _db()->getEntity('Userbook.Userbook');
		 
		$userAnswer	= _db()->getEntity('Userbook.Useranswer');
		
		$answerChoiceAdmin = _db()->getEntity('Education.Question.Choice.Answer');
		
		$userBookModel 	= pzk_model('Userbook');
		
			
			if(isset($row['mark']) && is_array($row['mark']) ){
				
				//id vo bai tap va diem
				
				foreach($row['mark'] as $key => $value){
					
					//neu la dang thi thu
					if(isset($row['trytest']) && $row['trytest'] == 2 ){
						
						$arAnswer = array();
						if(isset($row['answers'][$key.'_i'])){
							$arAnswer['i'] = $row['answers'][$key.'_i'];
						}
						if(isset($row['answers'][$key.'_t'])){
							$arAnswer['t'] = $row['answers'][$key.'_t'];
						}			
						if(isset($row['checkfalse'][$key])) {
							$arAnswer['checkfalse'] = $row['checkfalse'][$key];
						}
						$dataCheckFalse = array(
							'id'		=>  $key,
							'content_edit' => serialize($arAnswer)
						);
						//debug($dataCheckFalse);die();
						$userAnswer->setData($dataCheckFalse);
						$userAnswer->save();
					}
						
					if($row['recommend_mark'][$key] != null){
						$dataUserAnswer = array(
								'id'				=>	$key,
								'mark'				=>	$value,
								'recommend_mark'	=> 	$row['recommend_mark'][$key],
								'isMark'			=> 1,
								'teacherIdMark' => $adminId
								
						);
					}else{
						
						//diem cua bai tu luan
						$dataUserAnswer = array(
								'id'		=>  $key,
								'mark'		=>	$value,
								'isMark'			=> 1,
								'recommend_mark'	=> 	'',
								'teacherIdMark' => $adminId
								
						);
					}
					
					$userAnswer->setData($dataUserAnswer);
					$userAnswer->save();
										
				}
				//debug($testData);die();
				//update cac giao vien cham bai
				$databook = $userBook->userBook($row['user_book_id']);
				$teacherIds = $databook['teacherIds'];
				if($teacherIds != '') {
						
					$tam = trim($teacherIds, ',');
					
					$arrTeacher = explode(',', $tam);
					
					if(in_array($adminId, $arrTeacher)){
						$addTeacher = $teacherIds;
					}else{
						$addTeacher = $teacherIds.$adminId.',';
					}
				}else{
					$addTeacher = ','.$adminId.',';
				}
				
				//updae diem vao vo bai tap
				$checkMarkAll = $userAnswer->checkFullMark($row['user_book_id']);
				//update so cau da dc cham
				if($checkMarkAll == 'ok') {
					
					$marked = $userAnswer->countAnswer($row['user_book_id']);
					//da cham het cac cau hoi trong bai
					$total_mark = $userAnswer->totalMark($row['user_book_id']);
					$dataUserBook = array(
						'id'			=> $row['user_book_id'],
						'marked' => $marked,
						'teacherIds'	=> $addTeacher,
						'teacherMark'	=> $total_mark,
						'status'		=>  MARKED,
						'modified'		=> date(DATEFORMAT,$_SERVER['REQUEST_TIME']),
					);
				
					$userBook->setData($dataUserBook);
					$userBook->save();

					
				}else{
					$marked = $checkMarkAll;
					$dataUserBook = array(
						'id'			=> $row['user_book_id'],
						'modified'		=> date(DATEFORMAT,$_SERVER['REQUEST_TIME']),
						'teacherIds'	=> $addTeacher,
						'marked' => $marked
					);
				
					$userBook->setData($dataUserBook);
					$userBook->save();
				}
				//update vao bang user contest
				if($row['trytest'] == 2 && $checkMarkAll == 'ok') {
					//update vao bang user content
					$dataUserBook = $userBook->userBook($row['user_book_id']);
					$userId = $dataUserBook['userId'];
					
					$camp = $dataUserBook['camp'];
					$parentTest = $dataUserBook['parentTest'];
					if($camp != 0){
						$dataUserBookTn = $userBook->getUserbookTn($userId, 1, $camp);
					}else{
						
						$dataUserBookTn = $userBook->getNsTn($userId, 1, $parentTest);
					}
					
					
					if($camp != 0){
						$totalMark =($dataUserBookTn['mark'] * 2) + $dataUserBook['teacherMark']; 
					}else{
						//hack ngoi sao
						if(($dataUserBookTn['testId'] == 146) || ($dataUserBookTn['testId'] == 144)){
							$totalMark =($dataUserBookTn['mark'] * 4) + $dataUserBook['teacherMark']; 
						}else if(($dataUserBookTn['testId'] == 137) || ($dataUserBookTn['testId'] == 140)){
							$totalMark =($dataUserBookTn['mark'] * 3) + $dataUserBook['teacherMark']; 
						}else{
							$totalMark =($dataUserBookTn['mark'] * 2) + $dataUserBook['teacherMark']; 
						}
						
						
					}
					$duringTime = $dataUserBookTn['duringTime'] + $dataUserBook['duringTime'];
					//check xem da updat vao bang user contest chua
					$userContest	= _db()->getEntity('Userbook.Usercontest');
					
					if($camp != 0){
						$checkContest = $userContest->checkContest($userId, $camp);
					}else{
						$checkContest = $userContest->checkContestCompability($userId, $parentTest);
					}
					
					if($checkContest) {
						$dataUserContest = array(
							'id'=> $checkContest['id'],
							'camp' => $camp,
							'parentTest' => $parentTest,
							'mark' => $dataUserBookTn['mark'],
							'teacherMark' => $dataUserBook['teacherMark'],
							'totalMark' => $totalMark,
							'duringTime' => $duringTime,
							'choiceId' => $dataUserBookTn['id'],
							'writeId' => $dataUserBook['id'],
							'software' =>  pzk_request()->getSoftwareId(),
							'modified' => date(DATEFORMAT,$_SERVER['REQUEST_TIME']),
							'modifiedId'	=> pzk_session()->getAdminId()
						);
						
						$userContest->setData($dataUserContest);
						$userContest->save();
					}else{
						
						$dataUserContest = array(
							'userId' => $userId,
							'camp' => $camp,
							'parentTest' => $parentTest,
							'mark' => $dataUserBookTn['mark'],
							'teacherMark' => $dataUserBook['teacherMark'],
							'totalMark' => $totalMark,
							'duringTime' => $duringTime,
							'choiceId' => $dataUserBookTn['id'],
							'writeId' => $dataUserBook['id'],
							'software' =>  pzk_request()->getSoftwareId(),
							'created' => date(DATEFORMAT,$_SERVER['REQUEST_TIME']),
							'modifiedId'	=> pzk_session()->getAdminId()
						);
						$userContest->setData($dataUserContest);
						$userContest->save();
						
					}
					//them thong bao vao bang thong bao
				}
				
				pzk_notifier()->addMessage('Cập nhật thành công');
				if(pzk_request()->getBtn_update_and_close()) {
					$this->redirect('index', array('selectedId' => $row['user_book_id']));
				} else {
					$this->redirect('details/' . $row['user_book_id']);
				}
				
			}
		
	}
	
	public function updatePostTungSonAction(){
		
		$row = pzk_request()->getFilterData('user_book_id, mark, checkfalse, recommend_mark, trytest, answers, answers_level, question_id, save, check');
		//debug($row);die();
		$adminId = pzk_session()->getAdminId();
		$userBook	= _db()->getEntity('userbook.userbook');
		 
		$userAnswer	= _db()->getEntity('userbook.useranswer');
		
		$answerChoiceAdmin = _db()->getEntity('education.question.choice.Answer');
		
		$userBookModel 	= pzk_model('Userbook');
		//tra ve status trong bang userbook
		//$statusUserbook = $userBook->get('status'$row['user_book_id']);
		//
		//$condition = ($statusUserbook == '0' || $statusUserbook == '1') ? ($userBookModel->isOwner($row['user_book_id'], 'teacherId', pzk_session()->getAdminId(), $this->table ) || pzk_session()->getAdminLevel() === 'Administrator'):(pzk_session()->getAdminLevel() === 'Administrator');
		
		//if($condition){
			
			if(isset($row['mark']) && is_array($row['mark']) && isset($row['recommend_mark']) && is_array($row['recommend_mark'])){
				
				
				
				//$total_mark = 0;
				
				//id vo bai tap va diem
				foreach($row['mark'] as $key => $value){
					
					if($value != null){
						
						/*if(isset($row['answers_level'][$key]) && !empty($row['answers_level'][$key])){
							$answers_level =  implode("|",$row['answers_level'][$key]);
						}else{
							$answers_level = '';
						}*/
						
						//neu la dang thi thu
						if(isset($row['trytest']) && $row['trytest'] == 2 ){
							
							$arAnswer = array();
							if(isset($row['answers'][$key.'_i'])){
								$arAnswer['i'] = $row['answers'][$key.'_i'];
							}
							if(isset($row['answers'][$key.'_t'])){
								$arAnswer['t'] = $row['answers'][$key.'_t'];
							}			
							if(isset($row['checkfalse'][$key])) {
								$arAnswer['checkfalse'] = $row['checkfalse'][$key];
							}
							$dataCheckFalse = array(
								'id'		=>  $key,
								'content_edit' => serialize($arAnswer)
							);
							//debug($dataCheckFalse);die();
							$userAnswer->setData($dataCheckFalse);
							$userAnswer->save();
						}
						
						if($row['recommend_mark'][$key] != null){
							$dataUserAnswer = array(
									'id'				=>	$key,
									'mark'				=>	$value,
									'recommend_mark'	=> 	$row['recommend_mark'][$key],
									//'accept'			=>	$answers_level,
									'isMark'			=> 1,
									'teacherIdMark' => $adminId
									
							);
						}else{
							
							//diem cua bai tu luan
							$dataUserAnswer = array(
									'id'		=>  $key,
									'mark'		=>	$value,
									//'accept'	=>	$answers_level,
									'isMark'			=> 1,
									'recommend_mark'	=> 	'',
									'teacherIdMark' => $adminId
									
							);
						}
						
						$userAnswer->setData($dataUserAnswer);
						$userAnswer->save();
					}
					//diem bai tu luan
					//$total_mark = $total_mark + $value;
				}
				
				//update cac giao vien cham bai
				$databook = $userBook->userBook($row['user_book_id']);
				$teacherIds = $databook['teacherIds'];
				if($teacherIds != '') {
						
					$tam = trim($teacherIds, ',');
					
					$arrTeacher = explode(',', $tam);
					
					if(in_array($adminId, $arrTeacher)){
						$addTeacher = $teacherIds;
					}else{
						$addTeacher = $teacherIds.$adminId.',';
					}
				}else{
					$addTeacher = ','.$adminId.',';
				}
				
				//updae diem vao vo bai tap
				$checkMarkAll = $userAnswer->checkFullMark($row['user_book_id']);
				//update so cau da dc cham
				if($checkMarkAll == 'ok') {
					
					$marked = $userAnswer->countAnswer($row['user_book_id']);
					//da cham het cac cau hoi trong bai
					$total_mark = $userAnswer->totalMark($row['user_book_id']);
					$dataUserBook = array(
						'id'			=> $row['user_book_id'],
						'marked' => $marked,
						'teacherIds'	=> $addTeacher,
						'teacherMark'	=> $total_mark,
						'status'		=>  MARKED,//(isset($row['check']) && $row['check'] == 1) ? MARK_CHECKED : MARKED, // đã chấm
						'modified'		=> date(DATEFORMAT,$_SERVER['REQUEST_TIME']),
					);
				
					$userBook->setData($dataUserBook);
					$userBook->save();

					
				}else{
					$marked = $checkMarkAll;
					$dataUserBook = array(
						'id'			=> $row['user_book_id'],
						'modified'		=> date(DATEFORMAT,$_SERVER['REQUEST_TIME']),
						'teacherIds'	=> $addTeacher,
						'marked' => $marked
					);
				
					$userBook->setData($dataUserBook);
					$userBook->save();
				}
				//update vao bang user contest
				if($row['trytest'] == 2 && $checkMarkAll == 'ok') {
					//update vao bang user content
					$dataUserBook = $userBook->userBook($row['user_book_id']);
					$userId = $dataUserBook['userId'];
					$camp = $dataUserBook['camp'];
					
					$dataUserBookTn = $userBook->getUserbookTn($userId, 1, $camp);
					
					$totalMark =($dataUserBookTn['mark'] * 2) + $dataUserBook['teacherMark']; 
					$duringTime = $dataUserBookTn['duringTime'] + $dataUserBook['duringTime'];
					//check xem da updat vao bang user contest chua
					$userContest	= _db()->getEntity('userbook.Usercontest');
					$checkContest = $userContest->checkContest($userId, $camp);
					if($checkContest) {
						$dataUserContest = array(
							'id'=> $checkContest['id'],
							'camp' => $camp,
							'mark' => $dataUserBookTn['mark'],
							'teacherMark' => $dataUserBook['teacherMark'],
							'totalMark' => $totalMark,
							'duringTime' => $duringTime,
							'choiceId' => $dataUserBookTn['id'],
							'writeId' => $dataUserBook['id'],
							'software' =>  pzk_request()->getSoftwareId(),
							'modified' => date(DATEFORMAT,$_SERVER['REQUEST_TIME']),
							'modifiedId'	=> pzk_session()->getAdminId()
						);
						
						$userContest->setData($dataUserContest);
						$userContest->save();
					}else{
						
						$dataUserContest = array(
							'userId' => $userId,
							'camp' => $camp,
							'mark' => $dataUserBookTn['mark'],
							'teacherMark' => $dataUserBook['teacherMark'],
							'totalMark' => $totalMark,
							'duringTime' => $duringTime,
							'choiceId' => $dataUserBookTn['id'],
							'writeId' => $dataUserBook['id'],
							'software' =>  pzk_request()->getSoftwareId(),
							'created' => date(DATEFORMAT,$_SERVER['REQUEST_TIME']),
							'modifiedId'	=> pzk_session()->getAdminId()
						);
						$userContest->setData($dataUserContest);
						$userContest->save();
						
					}
					//them thong bao vao bang thong bao
				}else{
					$userId_mess= $userBook->getUserId();
					$mess=array('userId'=>$userId_mess,'messageType'=>'mark','userBookId'=>$row['user_book_id'],'date'=>date("Y-m-d H:i:s"),'status'=>0);
					$newmessage= _db()->getEntity('user.NewMessage');
					$newmessage->create($mess);
					
					//cham khong co questionid
					if(pzk_session()->getAdminLevel() === 'Administrator' && isset($row['answers']) && !empty($row['answers'])){
						foreach( $row['question_id'] as $kq => $vq ){
							foreach( $row['answers'][$kq] as $ka => $va ){
								$dataAnswerAdmin = array(
										'question_id'	=> $vq,
										'content'		=> $va,
								);
								if($userBookModel->checkContentQuestion($dataAnswerAdmin)){
									
									$answerChoiceAdmin->setData($dataAnswerAdmin);
									$answerChoiceAdmin->save();
								}
							}
						}
						
						/*Payment for teacher point after checked by admin*/
						if($dataUserBook['status'] === MARK_CHECKED){
							
							if(!$userBookModel->checkAdminTransactionbyUserbookId($dataUserBook['id'])){
								
								$categoryModel		= pzk_model('Category');
								
								$getUserbook	= $userBookModel->getUserBook($dataUserBook['id']);
								$catId 		=  $categoryModel->get_category_parent($getUserbook['categoryId']);
								$service 	= "Chấm bài";
								$amount		= "";
								$reason 	= "Công chấm bài";
								
								$price = "";
								
								if($catId == '96'){
									$price = PAYMENT_ADMIN_1;
								}
								if($catId == '97'){
									$price = PAYMENT_ADMIN_2;
								}
								if($catId == '98'){
									$price = PAYMENT_ADMIN_3;
								}
								if($catId == '99'){
									$price = PAYMENT_ADMIN_4;
								}
								
								$checkTransaction = false;
								
								if($price != ""){
									 
									$amount = $getUserbook['quantity_question'] * $price;
									
									$adminTeacherId	=	$getUserbook['teacherId'];
									
									$sign = SIGN_SUM;
									
									$checkTransaction = $userBookModel->adminTransactionUserbook($adminTeacherId, $service, $amount, $reason, $dataUserBook['id'], pzk_session()->getAdminId(), $sign);
								}
							}
						}	
					}
				}
				pzk_notifier()->addMessage('Cập nhật thành công');
				if(pzk_request()->getBtn_update_and_close()) {
					$this->redirect('index', array('selectedId' => $row['user_book_id']));
				} else {
					$this->redirect('details/' . $row['user_book_id']);
				}
				
			}
		//}else{
			
			//echo "Bài đã được duyệt hoặc Bạn không có quyền chấm bài này!";die;
		//}
	}
	
	function updateCreateTimeAction(){
		
		$condition1 = date(DATEFORMAT);
		$condition2 = date(DATEFORMAT);
		$condition2_int 	= $_SERVER['REQUEST_TIME'] - 12*60*60;
		$condition2_date 	= date(DATEFORMAT, $condition2_int);
 		debug($_SERVER['REQUEST_TIME']);
		debug($condition1);
		debug($condition2);
		debug($condition2_int);
		debug($condition2_date);
	}
	
	function getTestMarkAction() {
		$userId = pzk_request()->getSegment(3);
		if(isset($userId)) {
			$dataUserTestReal = _db()->select('id')
			->from('user_book')
			->whereTrytest(2)
			->whereCamp(1)
			->likeTeacherIds("%,31,%")
			->likeTeacherIds("%,30,%")
			->likeTeacherIds("%,27,%")
			->result();
			
			debug($dataUserTestReal);
		}
	}
	
	function getMarkTaAction() {
		$sql = "SELECT id FROM user_book
				WHERE teacherIds NOT LIKE '%31%' and teacherIds NOT LIKE '%30%' and trytest = 2 and camp = 1
		";
		$data = _db()->query($sql);
		$count = count($data);
		echo "so cau con cham: $count";	
		debug($data);
		
	}
	
	public function verifyAction() {
		$arr = array();
		$adminId = pzk_session()->getAdminId();
		//check chua cham cho pham thi thu
		$dataBookTl = _db()->selectAll()->from('user_book')->whereTrytest(2)->result();
		if($dataBookTl) {
			foreach($dataBookTl as $val) {
				//check bai da cham xong chua
				//if($val['status'] != 1){
					if($val['teacherIds'] != '') {
						$tam = trim($val['teacherIds'], ',');
						$arrTeacherId = explode(',', $tam);
						if(!in_array($adminId, $arrTeacherId)){
							$arr[] = array(
								'error'		=> true,
								'id'		=> $val['id'],
								'message'	=> 'Chưa chấm'
							);
						}
					}else{
						$arr[] = array(
							'error'		=> true,
							'id'		=> $val['id'],
							'message'	=> 'Chưa chấm'
						);
					}
				//}
				
			}
			
		}
		
		echo json_encode($arr);		
	}
	
	public function viewAction($id, $gridIndex) {
		$this->detailsAction();
	}
	
}