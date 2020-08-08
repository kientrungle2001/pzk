<?php
class PzkAdminBookController extends PzkGridAdminController {
	
	public $table = 'user_book';
	public function __construct(){
		parent::__construct();
	
		$adminLevel = pzk_session('adminLevel');
	
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
					'table' => 'user',
					'condition' => 'user_book.userId = user.id',
					'type' =>''
			),
			array(
					'table' => 'categories',
					'condition' => 'user_book.categoryId = categories.id',
					'type' =>''
			),
			array(
					'table' => 'admin',
					'condition' => 'user_book.teacherId = admin.id',
					'type' =>'left'
			)
	);
	
	//select table
	public $selectFields = 'user_book.*, user.username as username, categories.name as name, admin.name as teacherName';
	
	public $listFieldSettings = array(
			array(
					'index' => 'username',
					'type' 	=> 'text',
					'label' => 'Học sinh'
			),
			array(
					'index' => 'name',
					'type' 	=> 'text',
					'label' => 'Danh mục',
					'link'	=> '/admin_book/details/'
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
					'index' => 'teacherName',
					'type' 	=> 'text',
					'label' => 'Giáo viên'
			),
	);
	
	//search fields co type la text
	public $searchFields = array('`categories`.`name`', 'username', '`admin`.`name`');
	public $Searchlabels = 'Tìm kiếm';
	
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
					'index'			=> 'status',
					'type' 			=> 'selectoption',
					'option' 		=> array(
                        	MARK_NO 	 => 'Chưa chấm',
                        	MARKED	 	 => 'Đã chấm',
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
	
	public function prepareListDisplay() {
		$list = pzk_element ( 'list' );
		
		$adminLevel = pzk_session('adminLevel');
		
		if ($list) {
			if($adminLevel !== 'Administrator'){
				
				$list->addFilter( array('column', $this->getTable(), 'teacherId') , pzk_session()->getAdminId());
			}
			
			$list->addFilter( array('column', $this->getTable(), 'isRequest') , ISREQUEST);
		}
		
		
		parent::prepareListDisplay();
	}
	
	public function detailsAction() {
		
		$userBookId		=	pzk_request()->getSegment(3);
		
		$this->initPage()->append('admin/book/details');
		
		$user_book_view	= pzk_element()->getUser_book();
		
		$userBookModel 	= pzk_model('Userbook');
		
		$adminId = pzk_session('adminId');
		
		$adminLevel = pzk_session('adminLevel');
		
		if($userBookModel->isOwner($userBookId, 'teacherId', $adminId, $this->table ) || $adminLevel == 'Administrator'){
			
			$this->initPage()->append('admin/book/details');
				
			$user_book_view	= pzk_element()->getUser_book();
				
			$adminQuestionModel 	= pzk_model('AdminQuestion');
				
			$dataUserBook	= $userBookModel->getUserBook($userBookId);
				
			$dataShowUserBook 	= array(
					'user_book_id'		=> $dataUserBook['id'],
					'category_name'		=> $adminQuestionModel->get_category_type_name($dataUserBook['categoryId']),
					'exercise_number'	=> $dataUserBook['exercise_number'],
					'question_type'		=> $dataUserBook['question_type'],
					'teacher_name'		=> $userBookModel->getAdminName($dataUserBook['teacherId']),
					'student_name'		=> $userBookModel->getUserName($dataUserBook['userId']),
					'start_time'		=> date('Y-m-d', strtotime($dataUserBook['startTime'])),
					'during_time'		=> $dataUserBook['duringTime'],
					'status'			=> $dataUserBook['status'],
					'teacher_mark'		=> $dataUserBook['teacherMark'],
						
			);
				
			$dataUserAnswers 	= $userBookModel->getUserAnswers($userBookId);
				
			$user_book_view->setDataShowUserBook($dataShowUserBook);
				
			$user_book_view->setDataUserAnswers($dataUserAnswers);
		}
		$this->display();
	}
	
	public function updatePostAction(){
		
		$row = pzk_request()->getFilterData('user_book_id, mark, recommend_mark, answers, answers_level, question_id, save, check');
		
		$userBook	= _db()->getEntity('userbook.UserBook');
		 
		$userAnswer	= _db()->getEntity('userbook.UserAnswer');
		
		$answerChoiceAdmin = _db()->getEntity('education.question.Choice.Answer');
		
		$userBookModel 	= pzk_model('Userbook');
		
		$statusUserbook = $userBook->get('status'$row['user_book_id']);
		
		$condition = ($statusUserbook == '0' || $statusUserbook == '1') ? ($userBookModel->isOwner($row['user_book_id'], 'teacherId', pzk_session('adminId'), $this->table ) || pzk_session('adminLevel') === 'Administrator'):(pzk_session('adminLevel') === 'Administrator');
		
		if($condition){
			
			if(isset($row['mark']) && is_array($row['mark']) && isset($row['recommend_mark']) && is_array($row['recommend_mark'])){
				
				$total_mark = 0;
				
				foreach($row['mark'] as $key => $value){
					
					if($value != null){
						if(isset($row['answers_level'][$key]) && !empty($row['answers_level'][$key])){
							$answers_level =  implode("|",$row['answers_level'][$key]);
						}else{
							$answers_level = '';
						}
						
						if($row['recommend_mark'][$key] != null){
							
							$dataUserAnswer = array(
									'id'				=>	$key,
									'mark'				=>	$value,
									'recommend_mark'	=> 	$row['recommend_mark'][$key],
									'accept'			=>	$answers_level,
							);
						}else{
							
							$dataUserAnswer = array(
									'id'		=>  $key,
									'mark'		=>	$value,
									'accept'	=>	$answers_level,
							);
						}
						$userAnswer->setData($dataUserAnswer);
						$userAnswer->save();
					}
					
					$total_mark = $total_mark + $value;
				}
				
				$dataUserBook = array(
						'id'			=> $row['user_book_id'],
						'teacherMark'	=> $total_mark,
						'status'		=> (isset($row['check']) && $row['check'] == 1) ? MARK_CHECKED : MARKED, // đã chấm
						'modified'		=> date(DATEFORMAT,$_SERVER['REQUEST_TIME']),
						'modifiedId'	=> pzk_session('adminId'),
				);
				
				$userBook->setData($dataUserBook);
				$userBook->save();
				// insert table new_message
				$userBook->loadWhere(array('id',$row['user_book_id']));
				$userId_mess= $userBook->getUserId();
				$mess=array('userId'=>$userId_mess,'messageType'=>'mark','userBookId'=>$row['user_book_id'],'date'=>date("Y-m-d H:i:s"),'status'=>0);
				$newmessage= _db()->getEntity('user.NewMessage');
				$newmessage->create($mess);
				
				if(pzk_session('adminLevel') === 'Administrator' && isset($row['answers']) && !empty($row['answers'])){
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
								
								$checkTransaction = $userBookModel->adminTransactionUserbook($adminTeacherId, $service, $amount, $reason, $dataUserBook['id'], pzk_session('adminId'), $sign);
							}
						}
						
					}
				}
				pzk_notifier()->addMessage('Cập nhật thành công');
				$this->redirect('details/' . $row['user_book_id']);
			}
		}else{
			
			echo "Bài đã được duyệt hoặc Bạn không có quyền chấm bài này!";die;
		}
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
	
}