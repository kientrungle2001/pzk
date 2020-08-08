<?php
class PzkAdminQuestionsController extends PzkAdminController {
	public $masterStructure = 'admin/home/index';
	public $masterPosition = 'left';
	public $addFields = 'name,  request, level, categoryIds, trial, questionType, testId';
	public $editFields = 'name, request, level, categoryIds, trial, questionType, testId';
	
	public $addValidator = array(
		'rules' => array(
			'name' => array(
				'required' => true,
				'minlength' => 2,
				'maxlength' => 1000
			),
		),
		'messages' => array(
			'name' => array(
				'required' => 'Tên câu hỏi không được để trống',
				'minlength' => 'Tên câu hỏi phải dài 2 ký tự trở lên',
				'maxlength' => 'Tên câu hỏi chỉ dài tối đa 255 ký tự'
			),
		)
	);
	
	public $editValidator = array(
		'rules' => array(
			'name' => array(
				'required' => true,
				'minlength' => 2,
				'maxlength' => 1000
			)
		),
		'messages' => array(
			'name' => array(
				'required' => 'Tên câu hỏi không được để trống',
				'minlength' => 'Tên câu hỏi phải dài 2 ký tự trở lên',
				'maxlength' => 'Tên câu hỏi chỉ dài tối đa 255 ký tự'
			)
		)
	);
	
	function indexAction(){
		
		$this->initPage()->append('admin/'.pzk_or($this->customModule, $this->module).'/index')
						 ->append('admin/'.pzk_or($this->customModule, $this->module).'/menu', 'right');
		$this->fireEvent('index.after', $this);
		
		$this->display();
	}
	public function onchangeTrialAction() {
        $id = pzk_request ('id');
        $field = pzk_request()->getField();
        $value = pzk_request()->getValue();
        $entity = _db ()->getTableEntity ( $this->table )->load ( $id );
        $entity->update ( array (
            $field => $value
        ) );
        $this->redirect('index');
    }
	public function addAction() {
		
		$this->initPage()
		->append('admin/'.pzk_or($this->customModule, $this->module).'/add')
		->append('admin/'.pzk_or($this->customModule, $this->module).'/menu', 'right');
		
		$this->display();
	}
    public function add($row) {
        $row['createdId'] = pzk_session('adminId');
        $row['created'] = date(DATEFORMAT,$_SERVER['REQUEST_TIME']);
        if(isset($row['testId']) && is_array($row['testId'])) {
            $testId = $row['testId'];
            foreach($testId as $item) {
                $quantityTest = _db()->useCB()->select('quantity')->from('tests')->where(array('id', $item))->result_one();
                $quantityQuestion = _db()->useCB()->select('id')->from('questions')->where(array('testId', $item))->result();
                if(count($quantityQuestion) > $quantityTest['quantity']) {
                    pzk_notifier()->addMessage('<div class="color_delete">Đề của bạn đã vượt quá số câu quy định!</div>');
                    $this->redirect('index');
                }
            }
        }

        $entity = _db()->getEntity('table')->setTable($this->table);
        $entity->setData($row);
        $entity->save();
        if($this->logable) {
            $logEntity = _db()->getTableEntity('admin_log');
            $logFields = explodetrim(',', $this->logFields);
            $brief = pzk_session()->getAdminUser() . ' Thêm mới bản ghi: ' . $this->getModule();
            foreach ($logFields as $field) {
                $brief .= '[' . $field . ': ' . @$row[$field] . ']';
            }
            $logEntity->setUserId( pzk_session()->getAdminId());
            $logEntity->setCreated(date('Y-m-d H:i:s'));
            $logEntity->setActionType('add');
            $logEntity->setAdmin_controller('admin_'.$this->getModule());
            $logEntity->setBrief($brief);
            $logEntity->save();
        }

    }

    public function edit($row) {
        $row['modifiedId'] = pzk_session('adminId');
        $row['modified'] = date(DATEFORMAT,$_SERVER['REQUEST_TIME']);
        if(isset($row['testId']) && is_array($row['testId'])) {
            $testId = $row['testId'];
            foreach($testId as $item) {
                $quantityTest = _db()->useCB()->select('quantity')->from('tests')->where(array('id', $item))->result_one();
                $quantityQuestion = _db()->useCB()->select('id')->from('questions')->where(array('testId', $item))->result();
                if(count($quantityQuestion) > $quantityTest['quantity']) {
                    pzk_notifier()->addMessage('<div class="color_delete">Đề của bạn đã vượt quá số câu quy định!</div>');
                    $this->redirect('index');
                }
            }
        }

        $entity = _db()->getEntity('table')->setTable($this->table);
        $entity->load(pzk_request()->getId());
        if($this->logable) {
            $logEntity = _db()->getTableEntity('admin_log');
            $logFields = explodetrim(',', $this->logFields);
            $brief = pzk_session()->getAdminUser() . ' Sửa bản ghi: ' . $this->getModule();
            foreach ($logFields as $field) {
                $brief .= '[' . $field . ': ' . $entity->get($field) . ']';
            }
            $brief .= ' thành ';
            foreach ($logFields as $field) {
                $brief .= '[' . $field . ': ' . @$row[$field] . ']';
            }
            $logEntity->setUserId( pzk_session()->getAdminId());
            $logEntity->setCreated(date('Y-m-d H:i:s'));
            $logEntity->setActionType('edit');
            $logEntity->setAdmin_controller('admin_'.$this->getModule());
            $logEntity->setBrief($brief);
            $logEntity->save();
        }
        $entity->update($row);
        $entity->save();

    }
	public function editAction() {
		$module = pzk_parse(pzk_app()->getPageUri('admin/'.pzk_or($this->customModule, $this->module).'/edit'));
		$module->setItemId(pzk_request()->getSegment(3));
		$this->initPage()
		->append($module)
		->append('admin/'.pzk_or($this->customModule, $this->module).'/menu', 'right');
		
		$this->display();
	}
	
	function delAction(){
	
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
	
	function detailAction() {
		
		$question_id	=	pzk_request()->getSegment(3);
		
		$item	=	pzk_model('AdminQuestion');
		
		$type	=	$item->get_questionType_of_question($question_id);
		
		if($type == QUESTION_TYPE_CHOICE){
		
	        $module = pzk_parse(pzk_app()->getPageUri('admin/'.pzk_or($this->customModule, $this->module).'/question_answers_tn/answers'));
	        $module->setItemId(pzk_request()->getSegment(3));
	        $this->initPage() ->append($module);
	
	        $question	= pzk_element()->getQuestion_answers();
	
	        $question_answers = pzk_model('AdminQuestion');
	
	        $itemAnswers = $question_answers->get_question_answers_test($question_id);
	
	        $question->setItemAnswers($itemAnswers);
	
	        $this->display();
		}elseif($type == QUESTION_TYPE_FILL || $type == QUESTION_TYPE_FILL_JOIN){
			
			$module = pzk_parse(pzk_app()->getPageUri('admin/'.pzk_or($this->customModule, $this->module).'/question_answers_tn/answersFill'));
			$module->setItemId(pzk_request()->getSegment(3));
			$this->initPage() ->append($module);
				
			$question	= pzk_element()->getQuestion_answersFill();
				
			$question_answers = pzk_model('AdminQuestion');
				
			$itemAnswers = $question_answers->get_question_answersFill($question_id);
				
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
					$this->redirect('detail/' . pzk_request()->getId());
				}else{
					
					pzk_notifier()->addMessage('<div class="color_delete">Cập nhật không thành công !</div>');
					$this->redirect('detail/' . pzk_request()->getId());
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
                    'status'=>1
			);
				
			$status = $question_answers->check_question_answers($row['id']);
				
			if($status){
	
				$result = 	$question_answers->update_question_answers($data_answers, 'answers_question_tn');
			}else{
	
				$result	=	$question_answers->question_answers_add($data_answers);
			}
			if($result !=false){
					
				pzk_notifier()->addMessage('Cập nhật thành công');
				$this->redirect('detail/' . pzk_request()->getId());
			}else{
					
				pzk_notifier()->addMessage('<div class="color_delete">Cập nhật không thành công !</div>');
				$this->redirect('detail/' . pzk_request()->getId());
			}
		}
	}

	public function updateCategoryAction() {
        if(pzk_request()->getIds()) {
            $arrIds = json_decode(pzk_request()->getIds());
            $categories = json_decode(pzk_request()->getCategories());
            if(!empty($categories)) {
                $strCateIds = ','.implode(',', $categories).',';
            }else{
                $strCateIds = '';
            }

            if(count($arrIds) >0) {
                _db()->update($this->table)->set(array('categoryIds' => $strCateIds))->where(array('in', 'id', $arrIds))->result();

                echo 1;
            }

        }else {
            die();
        }
    }
	function getEditData() {
		
		return pzk_request()->getFilterData();
	}
}