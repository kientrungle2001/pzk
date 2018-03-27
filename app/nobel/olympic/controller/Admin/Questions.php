<?php
class PzkAdminQuestionsController extends PzkGridAdminController {
	public $title = "Quản lí câu hỏi";
	public $table = "questions";
	public $listFieldSettings = array(
		array(
			"index" => "name",
			"type" => "text",
			"label" => "Câu hỏi",
			"link" => "/admin_questions/detail/"
		),
		array(
			"index" => "categoryIds",
			"type" => "nameid",
			"label" => "Danh mục",
			"table" => "categories",
			"findField" => "id",
			"showField" => "name"	
		),
		array(
			"index" => "classes",
			"type" => 'ordering',
			"label" => "Lớp"
		),
		array(
			'index' => 'testId',
			'type' => 'nameid',
			'label' => 'Đề thi',
			'table' => 'tests',
			'findField' => 'id',
			'showField' => 'name'
		),
		array(
			"index" => "type_id",
			"type" => "nameid",
			"table" => "questiontype",
			"findField" => "id",
			"showField" => "name",
			"label" => "Loại câu hỏi"
		),
		array(
			"index" => "type",
			"type" => "text",
			"label" => "Type"
		),
		array(
			"index" => "odering",
			"type" => 'ordering',
			"label" => "Ordering"
		),
		array(
			"index" => "creatorId",
			"type" => "nameid",
			"table" => "admin",
			"findField" => "id",
			"showField" => "name",
			"label" => "Người tạo"
		),
		array(
			"index" => "created",
			"type" => "datetime",
			'label' => 'Ngày tạo'
		),
		array(
			"index" => "check",
			"type" => "status",
			"label" => "Check"
		),
		array(
			"index" => "status",
			"type" => "status",
			"label" => "Trạng thái"
		),
		array(
			"index" => "deleted",
			"type" => "status",
			"label" => "Deleted"
		)
	);
	
	//search
	public $searchFields = array('id', 'name');
	public $searchLabel = "Tìm theo id hoặc tên";
	//filter
	public $filterFields = array(
		array(
			"index" => "categoryIds",
			'type' => "select",
			"label" => "Danh mục",
			"table" => "categories",
			'show_value' => "id",
			"show_name" => 'name',
			'like' => 'true'	
		),
		array(
			"index" => 'type_id',
			'type' => 'select',
			'label' => 'Loại câu hỏi',
			'table' => 'questiontype',
			'show_value' => 'id',
			'show_name' => 'name'
		),
		array(
			"index" => 'testId',
			'type' => 'select',
			'label' => 'Đề thi',
			'table' => 'tests',
			'show_value' => 'id',
			'show_name' => 'name',
			'like' => true
		),
		array(
			'index' => 'creatorId',
			'type' => 'select',
			'label' => 'Người tạo',
			'table' => 'admin',
			'show_value' => 'id',
			'show_name' => 'name'
		),
		array(
			'index' => 'check',
			'type' => 'status',
			'label' => 'Check'
		),
		array(
			'index' => 'deleted',
			'type' => 'status',
			'label' => 'Deleted'
		),
		array(
			'index' => 'status',
			'type' => 'status',
			'label' => 'Status'
		)
	);
	
	//update data on curent table
	public $updateMenu = true;
    public $updateData = array(
        array(
            'index' => 'categoryIds',
            'type' => 'mutiSelect',
            'label' => 'Cập danh mục',
            'selectLabel' =>'Chọn danh mục',
            'nameField'=>"Danh mục",
            'table' => 'categories',
            'show_value' => 'id',
            'show_name' => 'name',
        ),
        array(
            'index' => 'testId',
            'type' => 'mutiSelect',
            'label' => 'Cập nhật đề',
            'selectLabel' =>'Chọn đề',
            'nameField'=>"Đề thi",
            'table' => 'tests',
            'show_value' => 'id',
            'show_name' => 'name',
        )
    );
	
	public $logable = true;
	public $logFields = 'name, type, type_id, request, classes, topic_id, level, categoryIds, software, check, status';
	//add
	public $addLabel = "Thêm câu hỏi";
	public $addFields 	= 'name, type, classes, type_id, request, categoryIds, software, check, status';
	public $addFieldSettings = array(
		array(
			'index' => 'name',
			'type' => 'tinymce',
			'label' => 'Câu hỏi'
		),
		array(
			'index' => 'type_id',
			'type' => 'selectmultiinput',
			'label' => 'Chọn loại câu hỏi',
			'hiddenData' => array(
				array(
					'index' => 'type',
					'type' => 'hidden',
					'value' => 'question_type',
				),
				array(
					'index' => 'request',
					'type' => 'text',
					'value' => 'request',
					'label' => 'request'
				)
			),
			'table' => 'questiontype',
			'show_value' => 'id',
			'show_name' => 'name'
		),
		array(
			'index' => 'classes',
			'type' => 'multiselectoption',
			'option' => array(
                CLASS4 => "Lớp 4",
                CLASS5 => "Lớp 5",
			),
			'label' => 'Chọn lớp'
		),
		array(
			'index' => 'categoryIds',
			'type' => 'multiselect',
			'label' => 'Danh mục',
			'table' => 'categories',
			'show_value' => 'id',
			'show_name' => 'name'
		),
		 array(
            'index' => 'check',
            'type' => 'status',
            'label' => 'Check',
            'options' => array(
                '0' => 'Không hoạt động',
                '1' => 'Hoạt động'
            ),
            'actions' => array(
                '0' => 'mở',
                '1' => 'dừng'
            )
        ),
		 array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Status',
            'options' => array(
                '0' => 'Không hoạt động',
                '1' => 'Hoạt động'
            ),
            'actions' => array(
                '0' => 'mở',
                '1' => 'dừng'
            )
        )
	);
	
	public $addValidator = array(
		'rules' => array(
			'name' => array(
				'required' => true,
				'minlength' => 2,
				'maxlength' => 1000
			),
			'type_id' => array(
				'required' => true,
			),
		),
		'messages' => array(
			'name' => array(
				'required' => 'Tên câu hỏi không được để trống',
				'minlength' => 'Tên câu hỏi phải dài 2 ký tự trở lên',
				'maxlength' => 'Tên câu hỏi chỉ dài tối đa 255 ký tự'
			),
			'type_id' => array(
				'required' => 'Yêu cầu chọn loại câu hỏi',
			)
		)
	);
	
	//edit
	public $editFields 	= 'name, classes, type, type_id, request, categoryIds, software, check, status';
	public $editFieldSettings =  array(
		array(
			'index' => 'name',
			'type' => 'tinymce',
			'label' => 'Câu hỏi'
		),
		array(
			'index' => 'type_id',
			'type' => 'selectmultiinput',
			'label' => 'Chọn loại câu hỏi',
			'hiddenData' => array(
				array(
					'index' => 'type',
					'type' => 'hidden',
					'value' => 'question_type',
				),
				array(
					'index' => 'request',
					'type' => 'text',
					'value' => 'request',
					'label' => 'request'
				)
			),
			'table' => 'questiontype',
			'show_value' => 'id',
			'show_name' => 'name'
		),
		array(
			'index' => 'classes',
			'type' => 'multiselectoption',
			'option' => array(
                CLASS4 => "Lớp 4",
                CLASS5 => "Lớp 5",
			),
			'label' => 'Chọn lớp'
		),
		array(
			'index' => 'categoryIds',
			'type' => 'multiselect',
			'label' => 'Danh mục',
			'table' => 'categories',
			'show_value' => 'id',
			'show_name' => 'name'
		),
		 array(
            'index' => 'check',
            'type' => 'status',
            'label' => 'Check',
            'options' => array(
                '0' => 'Không hoạt động',
                '1' => 'Hoạt động'
            ),
            'actions' => array(
                '0' => 'mở',
                '1' => 'dừng'
            )
        ),
		 array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Status',
            'options' => array(
                '0' => 'Không hoạt động',
                '1' => 'Hoạt động'
            ),
            'actions' => array(
                '0' => 'mở',
                '1' => 'dừng'
            )
        )
	);
	public $editValidator = array(
		'rules' => array(
			'name' => array(
				'required' => true,
				'minlength' => 2,
				'maxlength' => 1000
			),
			'type_id' => array(
				'required' => true,
			),
		),
		'messages' => array(
			'name' => array(
				'required' => 'Tên câu hỏi không được để trống',
				'minlength' => 'Tên câu hỏi phải dài 2 ký tự trở lên',
				'maxlength' => 'Tên câu hỏi chỉ dài tối đa 255 ký tự'
			),
			'type_id' => array(
				'required' => 'Yêu cầu chọn loại câu hỏi',
			)
		)
	);
	
	
	function delAction($id){
	
		$question_id = pzk_request()->getSegment(3);
		if($this->childTable) {
			foreach($this->childTable as $val) {
				_db()->useCB()->delete()->from($val['table'])
				->where(array($val['findField'], $question_id))->result();
			}
	
		}
		_db()->useCB()->delete()->from($this->table)
		->where(array('id', $question_id))->result();
	
		pzk_notifier()->addMessage('Xóa thành công');
		$this->redirect('index');
	}
	
	function detailAction($id) {
		
		$question_id	=	pzk_request()->getSegment(3);
		
		$item	=	pzk_model('AdminQuestion');
		
		$type	=	$item->get_question_type_of_question($question_id);
		
		if($type == 'Q0' || $type == 'gameQuestion'){
			
			$module = pzk_parse(pzk_app()->getPageUri('admin/questions/question_answers_tn/answers'));
			$module->setItemId(pzk_request()->getSegment(3));
			$this->initPage() ->append($module);
			
			$question	= pzk_element('question_answers');
			
			$question_answers = pzk_model('AdminQuestion');
			
			$itemAnswers = $question_answers->get_question_answers($question_id);
			
			$question->setItemAnswers($itemAnswers);
			
			$this->display();
			
		}elseif($type == 'DT'){
			
			$module = pzk_parse(pzk_app()->getPageUri('admin/questions/question_answers_dt/answers9'));
			$module->setItemId(pzk_request()->getSegment(3));
			$this->initPage() ->append($module);
				
			$question	= pzk_element('question_answers');
				
			$question_answers = pzk_model('AdminQuestion');
				
			$itemAnswers = $question_answers->get_question_answers($question_id);
				
			$question->setItemAnswers($itemAnswers);
			
			$this->display();
			
		}
	}
	
	function edit_tnPostAction() {
		
		$row = $this->getEditData();
		
		if(isset($row['content']) && isset($row['status']) && !empty($row['content']) && isset($row['id'])){
			
			if(is_array($row['content'])){
				
				$question_answers	=	pzk_model('AdminQuestion');
				
				$question_answers->del_question_answers($row['id'], 'answers_question_tn');
				
				$status = $row['status'];
				
				$data_answers = array();
				
				foreach( $row['content'] as $key => $content ){
					
					$content = trim($content);
					
					if($key == $status){
						$value = 1;
						$content_full	=	trim($row['content_full']);
						$recommend		= 	trim($row['recommend']);
					}else{
						$value = 0;
						$content_full	=	NULL;
						$recommend		= 	NULL;
					}
					$data_answers[$key] = array(
						'question_id'	=> $row['id'],
						'content'		=> $content,
						'status'		=> $value,
						'content_full'	=> $content_full,
						'recommend'		=> $recommend,
					);
					
					$result	=	$question_answers->question_answers_add($data_answers[$key]);
				}
				if($result !=false){
					
					pzk_notifier()->addMessage('Cập nhật thành công');
					$this->redirect('detail/' . pzk_request('id'));
				}else{
					
					pzk_notifier()->addMessage('<div class="color_delete">Cập nhật không thành công !</div>');
					$this->redirect('detail/' . pzk_request('id'));
				}
			}
		}
	}
	
	function edit_tn20PostAction() {
		
		$row = $this->getEditData();
		
		if(isset($row['content']) && isset($row['content_full'])){
			
			$question_answers	=	pzk_model('AdminQuestion');
			
			$question_answers->del_question_answers($row['id'], 'answers_question_tn');
			
			$data_answers = array(
				'question_id'	=>	$row['id'],
				'content'		=>	trim($row['content']),
				'content_full'	=>	trim($row['content_full']),
				'recommend'		=>	trim($row['recommend']),
			);
			
			$status = $question_answers->check_question_answers($row['id']);
			
			if($status){
				
				$result = 	$question_answers->update_question_answers($data_answers, 'answers_question_tn');
			}else{
				
				$result	=	$question_answers->question_answers_add($data_answers);
			}
			if($result !=false){
					
				pzk_notifier()->addMessage('Cập nhật thành công');
				$this->redirect('detail/' . pzk_request('id'));
			}else{
					
				pzk_notifier()->addMessage('<div class="color_delete">Cập nhật không thành công !</div>');
				$this->redirect('detail/' . pzk_request('id'));
			}
		}
	}
	
	function edit_tn2PostAction() {
	
		$row = $this->getEditData();
	
		if(isset($row['content']) && !empty($row['content']) && isset($row['id'])){
				
			if(is_array($row['content'])){
	
				$question_answers	=	pzk_model('AdminQuestion');
	
				$question_answers->del_question_answers($row['id'], 'answers_question_tn');
				
				$data_answers = array();
				
				foreach( $row['content'] as $key => $content ){
						
					$content = trim($content);
						
					if($key == 0){
						$content_full	=	trim($row['content_full']);
						$recommend		= 	trim($row['recommend']);
					}else{
						$content_full	=	NULL;
						$recommend		= 	NULL;
					}
					$data_answers[$key] = array(
							'question_id'	=> $row['id'],
							'content'		=> $content,
							'status'		=> 0,
							'content_full'	=> $content_full,
							'recommend'		=> $recommend,
					);
						
					$result	=	$question_answers->question_answers_add($data_answers[$key]);
				}
				if($result !=false){
						
					pzk_notifier()->addMessage('Cập nhật thành công');
					$this->redirect('detail/' . pzk_request('id'));
				}else{
						
					pzk_notifier()->addMessage('<div class="color_delete">Cập nhật không thành công !</div>');
					$this->redirect('detail/' . pzk_request('id'));
				}
			}
		}
	}
	
	function edit_tn7PostAction() {
	
		$row = $this->getEditData();
		
		if(isset($row['content']) && !empty($row['content']) && isset($row['id'])){
	
			if(is_array($row['content'])){
				
				$question_answers	=	pzk_model('AdminQuestion');
	
				$question_answers->del_question_answers($row['id'], 'answers_question_tn');
				
				$question_answers->del_question_answers($row['id'], 'answers_question_topic');
				
				if(isset($row['answers'])){
					
					$answers	=	$row['answers'];
				}
				
				$data_answers = array();
	
				foreach( $row['content'] as $key => $content ){
					$status = 0;
					if(isset($row['status'])){
						if($key == 0 ){
							$status = 1;
						}
					}
					$content = trim($content);
					
					if($key == 0){
						
						$recommend		= 	trim($row['recommend']);
					}else{
						
						$recommend 		= null;
					}
					
					$data_answers[$key] = array(
						'question_id'	=> $row['id'],
						'content'		=> $content,
						'status'		=> $status,
						'recommend'		=> $recommend,
					);
	
					$result	=	$question_answers->question_answers_add($data_answers[$key]);
					
					$data_answers_topic = array();
					
					if($result != false){
						
						$answers_question_tn_id = $result;
						
						if(isset($answers[$key]) && is_array($answers[$key])){
							
							foreach($answers[$key] as $a => $value){
								
								$data_answers_topic = array(
								
										'question_id'				=> $row['id'],
										'answers_question_tn_id'	=> $answers_question_tn_id,
										'content'					=> $value
								);
								
								$result_answers = $question_answers->question_answers_topic_add($data_answers_topic);
							}
						}
					}
				}
				
				if($result != false){
					
					pzk_notifier()->addMessage('Cập nhật thành công');
					$this->redirect('detail/' . pzk_request('id'));
				}else{
	
					pzk_notifier()->addMessage('<div class="color_delete">Cập nhật không thành công !</div>');
					$this->redirect('detail/' . pzk_request('id'));
				}
			}
		}
	}
	
	function getEditData() {
		
		return pzk_request()->getFilterData();
	}
	
	
}