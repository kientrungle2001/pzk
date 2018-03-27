<?php
class PzkAdminCategoryController extends PzkGridAdminController {
	public $table = 'categories';
	public $addFields = 'name, name_vn, name_en, parent, router, img, trial, status, display, software, content, recommend, isSort, alias, img, level, classes, video, video1, video2, video3, video4, video5, video6, video_title, video1_title, video2_title, video3_title,video4_title,video5_title,video6_title, video_image, video1_image, video2_image, video3_image, video4_image, video5_image, video6_image';
	public $editFields = 'name, name_vn, name_en, parent, router, img, trial, status, display, software, content, recommend, isSort, alias, img, level, classes, video, video1, video2, video3, video4, video5, video6, video_title, video1_title, video2_title, video3_title,video4_title,video5_title,video6_title, video_image, video1_image, video2_image, video3_image, video4_image, video5_image, video6_image';

	public $filterFields = array(
	
			array(
					'index' 		=> 'parents',
					'type' 			=> 'select',
					'label' 		=> 'Lọc theo danh mục',
					'table' 		=> 'categories',
					'show_value' 	=> 'id',
					'show_name' 	=> 'name',
					'like'			=> true
			),
			array(
				'index' => 'classes',
				'type' => 'selectoption',
				'label' => 'Lớp',
				'option' => array(
					CLASS3 => "Lớp 3",
					CLASS4 => "Lớp 4",
					CLASS5 => "Lớp 5"
				),
				'like' => true
			),
			array(
					'index' 		=> 'status',
					'type' 			=> 'status',
					'option' 		=> array(
							'' 			=>'Tất cả',
							'0' 		=> ' Chưa kích hoạt',
							'1' 		=> 'Đã kích hoạt'
					),
					'label' 		=>'Trạng thái kích hoạt'
			),
			array(
					'index' 		=> 'trial',
					'type' 			=> 'status',
					'option' 		=> array(
							'' 			=>'Tất cả',
							'0' 		=> ' Chưa kích hoạt',
							'1' 		=> 'Đã kích hoạt'
					),
					'label' 		=>'Trạng thái dùng thử'
			)
	);
	public $listFieldSettings = array(
			
			array(
					'index' 		=> 'name',
					'type' 			=> 'parent',
					'label' 		=> 'Tên danh mục',
					'link' 			=> '/admin_category/view/'
			),
			array(
					'index' 		=> 'alias',
					'type' 			=> 'text',
					'label' 		=> 'Bí danh'
			),
			array(
					'index' 		=> 'router',
					'type' 			=> 'text',
					'label' 		=> 'Đường dẫn'
			),
			array(
					'index' => "import_question",
					'type' => 'link',
					'label' => 'Nhập dữ liệu',
					'link' => '/admin_category/importQuestions/'
			),
			array(
					'index' => "add_child",
					'type' => 'link',
					'label' => 'Thêm con',
					'link' => '/admin_category/add?status=1&display=1&isSort=1&hidden_status=1&hidden_display=1&hidden_isSort=1&hidden_img=1&hidden_keywords=1&hidden_description=1&hidden_content=1&hidden_recommend=1&parent='
			),
			
			array(
                'index' => 'trial',
                'type' => 'status',
                'label' => 'T'
            ),
			
            array(
                'index' => 'status',
                'type' => 'status',
                'label' => 'S'
            ),
			array(
					'index' => 'display',
					'type' => 'status',
					'label' => 'D'
			),
			array(
					'index' => 'ordering',
					'type' => 'ordering',
					'label' => 'O'
			),
	);

    public $searchFields = array('name');
    public $Searchlabels = 'Tên';

    //sort by
    public $sortFields = array(
        'id asc' => 'ID tăng',
        'id desc' => 'ID giảm',
    	'ordering asc' => 'Thứ tự tăng',
    	'ordering desc' => 'Thứ tự giảm',
    		'name asc' => 'Tên tăng',
    		'name desc' => 'Tên giảm',
    );

	public $logable = true;
	public $logFields = 'name, alias, router';
	public $addLabel = 'Thêm Menu';

	public $addFieldSettings 	= array (
			array (
					'index' 	=> 	'name',
					'type' 		=> 	'text',
					'label' 	=> 	'Tên Category',
					'mdsize'	=>	4
			),
			
			array (
					'index' 	=> 'alias',
					'type' 		=> 'text',
					'label' 	=> 'Bí danh',
					'mdsize'	=>	6
			),
			array (
					'index' 	=> 'router',
					'type' 		=> 'text',
					'label' 	=> 'Đường dẫn gốc',
					'mdsize'	=>	6
			),
			array (
					'index' 		=> 'parent',
					'type' 			=> 'select',
					'table' 		=> 'categories',
					'label' 		=> 'Danh mục cha',
					'show_name' 	=> 'name',
					'show_value' 	=> 'id',
			),
            array(
                'index' 			=> 'content',
                'type' 				=> 'tinymce',
                'label' 			=> 'Nhập audio',
				'mdsize'			=> 12
            ),
            array(
                'index' 			=> 'img',
                'type' 				=> EDIT_TYPE_FILE_MANAGER,
                'uploadtype'		=>'image',
                'label' 			=> 'Chọn ảnh',
				'mdsize'			=> 12
            ),
			array(
                'index' 			=> 'video',
                'type' 				=> EDIT_TYPE_FILE_MANAGER,
                'uploadtype'		=>'image',
                'label' 			=> 'Video',
				'mdsize'			=> 12
            ),
			array(
                'index' 			=> 'video_image',
                'type' 				=> EDIT_TYPE_FILE_MANAGER,
                'uploadtype'		=>'image',
                'label' 			=> 'Video Image',
				'mdsize'			=> 12
            ),
			array(
                'index' 			=> 'video_title',
                'type' 				=> EDIT_TYPE_TEXT,
                'uploadtype'		=>'image',
                'label' 			=> 'Video Title',
				'mdsize'			=> 12
            ),
			array(
                'index' 			=> 'video1',
                'type' 				=> EDIT_TYPE_FILE_MANAGER,
                'uploadtype'		=>'image',
                'label' 			=> 'Video 1',
				'mdsize'			=> 12
            ),
			array(
                'index' 			=> 'video1_image',
                'type' 				=> EDIT_TYPE_FILE_MANAGER,
                'uploadtype'		=>'image',
                'label' 			=> 'Video 1 Image',
				'mdsize'			=> 12
            ),
			array(
                'index' 			=> 'video1_title',
                'type' 				=> EDIT_TYPE_TEXT,
                'uploadtype'		=>'image',
                'label' 			=> 'Video 1 Title',
				'mdsize'			=> 12
            ),
			array(
                'index' 			=> 'video2',
                'type' 				=> EDIT_TYPE_FILE_MANAGER,
                'uploadtype'		=>'image',
                'label' 			=> 'Video 2',
				'mdsize'			=> 12
            ),
			array(
                'index' 			=> 'video2_image',
                'type' 				=> EDIT_TYPE_FILE_MANAGER,
                'uploadtype'		=>'image',
                'label' 			=> 'Video 2 Image',
				'mdsize'			=> 12
            ),
			array(
                'index' 			=> 'video2_title',
                'type' 				=> EDIT_TYPE_TEXT,
                'uploadtype'		=>'image',
                'label' 			=> 'Video 2 Title',
				'mdsize'			=> 12
            ),
			array(
                'index' 			=> 'video3',
                'type' 				=> EDIT_TYPE_FILE_MANAGER,
                'uploadtype'		=>'image',
                'label' 			=> 'Video 3',
				'mdsize'			=> 12
            ),
			array(
                'index' 			=> 'video3_image',
                'type' 				=> EDIT_TYPE_FILE_MANAGER,
                'uploadtype'		=>'image',
                'label' 			=> 'Video 3 Image',
				'mdsize'			=> 12
            ),
			array(
                'index' 			=> 'video3_title',
                'type' 				=> EDIT_TYPE_TEXT,
                'uploadtype'		=>'image',
                'label' 			=> 'Video 3 Title',
				'mdsize'			=> 12
            ),
			array(
                'index' 			=> 'video4',
                'type' 				=> EDIT_TYPE_FILE_MANAGER,
                'uploadtype'		=>'image',
                'label' 			=> 'Video 4',
				'mdsize'			=> 12
            ),
			array(
                'index' 			=> 'video4_image',
                'type' 				=> EDIT_TYPE_FILE_MANAGER,
                'uploadtype'		=>'image',
                'label' 			=> 'Video 4 Image',
				'mdsize'			=> 12
            ),
			array(
                'index' 			=> 'video4_title',
                'type' 				=> EDIT_TYPE_TEXT,
                'uploadtype'		=>'image',
                'label' 			=> 'Video 4 Title',
				'mdsize'			=> 12
            ),
			array(
                'index' 			=> 'video5',
                'type' 				=> EDIT_TYPE_FILE_MANAGER,
                'uploadtype'		=>'image',
                'label' 			=> 'Video 5',
				'mdsize'			=> 12
            ),
			array(
                'index' 			=> 'video5_image',
                'type' 				=> EDIT_TYPE_FILE_MANAGER,
                'uploadtype'		=>'image',
                'label' 			=> 'Video 5 Image',
				'mdsize'			=> 12
            ),
			array(
                'index' 			=> 'video5_title',
                'type' 				=> EDIT_TYPE_TEXT,
                'uploadtype'		=>'image',
                'label' 			=> 'Video 5 Title',
				'mdsize'			=> 12
            ),
			array(
                'index' 			=> 'video6',
                'type' 				=> EDIT_TYPE_FILE_MANAGER,
                'uploadtype'		=>'image',
                'label' 			=> 'Video 6',
				'mdsize'			=> 12
            ),
			array(
                'index' 			=> 'video6_image',
                'type' 				=> EDIT_TYPE_FILE_MANAGER,
                'uploadtype'		=>'image',
                'label' 			=> 'Video 6 Image',
				'mdsize'			=> 12
            ),
			array(
                'index' 			=> 'video6_title',
                'type' 				=> EDIT_TYPE_TEXT,
                'uploadtype'		=>'image',
                'label' 			=> 'Video 6 Title',
				'mdsize'			=> 12
            ),
			array (
					'index' 		=> 'status',
					'type' 			=> 'status',
					'label' 		=> 'Trạng thái',
					'mdsize'		=> 4
			),
			
			
			array (
					'index' 		=> 'trial',
					'type' 			=> 'status',
					'label' 		=> 'Dùng thử',
					'mdsize'		=> 4
			),
			
			array(
					'index' 		=> 'display',
					'type' 			=> 'status',
					'label' 		=> 'display',
					'mdsize'		=> 4
			),
	);
	public $editFieldSettings = array (
			array (
					'index' 	=> 	'name',
					'type' 		=> 	'text',
					'label' 	=> 	'Tên Category',
					'mdsize'	=>	4
			),
			array (
					'index' 	=> 'alias',
					'type' 		=> 'text',
					'label' 	=> 'Bí danh',
					'mdsize'	=>	6
			),
			array (
					'index' 	=> 'router',
					'type' 		=> 'text',
					'label' 	=> 'Đường dẫn gốc',
					'mdsize'	=>	6
			),
			array (
					'index' 		=> 'parent',
					'type' 			=> 'select',
					'table' 		=> 'categories',
					'label' 		=> 'Danh mục cha',
					'show_name' 	=> 'name',
					'show_value' 	=> 'id',
			),
            array(
                'index' 			=> 'content',
                'type' 				=> 'tinymce',
                'label' 			=> 'Nhập audio',
				'mdsize'			=> 12
            ),
            array(
                'index' 			=> 'img',
                'type' 				=> EDIT_TYPE_FILE_MANAGER,
                'uploadtype'		=>'image',
                'label' 			=> 'Chọn ảnh',
				'mdsize'			=> 12
            ),
			array(
                'index' 			=> 'video',
                'type' 				=> EDIT_TYPE_FILE_MANAGER,
                'uploadtype'		=>'image',
                'label' 			=> 'Video',
				'mdsize'			=> 12
            ),
			array(
                'index' 			=> 'video_image',
                'type' 				=> EDIT_TYPE_FILE_MANAGER,
                'uploadtype'		=>'image',
                'label' 			=> 'Video Image',
				'mdsize'			=> 12
            ),
			array(
                'index' 			=> 'video_title',
                'type' 				=> EDIT_TYPE_TEXT,
                'uploadtype'		=>'image',
                'label' 			=> 'Video Title',
				'mdsize'			=> 12
            ),
			array(
                'index' 			=> 'video1',
                'type' 				=> EDIT_TYPE_FILE_MANAGER,
                'uploadtype'		=>'image',
                'label' 			=> 'Video 1',
				'mdsize'			=> 12
            ),
			array(
                'index' 			=> 'video1_image',
                'type' 				=> EDIT_TYPE_FILE_MANAGER,
                'uploadtype'		=>'image',
                'label' 			=> 'Video 1 Image',
				'mdsize'			=> 12
            ),
			array(
                'index' 			=> 'video1_title',
                'type' 				=> EDIT_TYPE_TEXT,
                'uploadtype'		=>'image',
                'label' 			=> 'Video 1 Title',
				'mdsize'			=> 12
            ),
			array(
                'index' 			=> 'video2',
                'type' 				=> EDIT_TYPE_FILE_MANAGER,
                'uploadtype'		=>'image',
                'label' 			=> 'Video 2',
				'mdsize'			=> 12
            ),
			array(
                'index' 			=> 'video2_image',
                'type' 				=> EDIT_TYPE_FILE_MANAGER,
                'uploadtype'		=>'image',
                'label' 			=> 'Video 2 Image',
				'mdsize'			=> 12
            ),
			array(
                'index' 			=> 'video2_title',
                'type' 				=> EDIT_TYPE_TEXT,
                'uploadtype'		=>'image',
                'label' 			=> 'Video 2 Title',
				'mdsize'			=> 12
            ),
			array(
                'index' 			=> 'video3',
                'type' 				=> EDIT_TYPE_FILE_MANAGER,
                'uploadtype'		=>'image',
                'label' 			=> 'Video 3',
				'mdsize'			=> 12
            ),
			array(
                'index' 			=> 'video3_image',
                'type' 				=> EDIT_TYPE_FILE_MANAGER,
                'uploadtype'		=>'image',
                'label' 			=> 'Video 3 Image',
				'mdsize'			=> 12
            ),
			array(
                'index' 			=> 'video3_title',
                'type' 				=> EDIT_TYPE_TEXT,
                'uploadtype'		=>'image',
                'label' 			=> 'Video 3 Title',
				'mdsize'			=> 12
            ),
			array(
                'index' 			=> 'video4',
                'type' 				=> EDIT_TYPE_FILE_MANAGER,
                'uploadtype'		=>'image',
                'label' 			=> 'Video 4',
				'mdsize'			=> 12
            ),
			array(
                'index' 			=> 'video4_image',
                'type' 				=> EDIT_TYPE_FILE_MANAGER,
                'uploadtype'		=>'image',
                'label' 			=> 'Video 4 Image',
				'mdsize'			=> 12
            ),
			array(
                'index' 			=> 'video4_title',
                'type' 				=> EDIT_TYPE_TEXT,
                'uploadtype'		=>'image',
                'label' 			=> 'Video 4 Title',
				'mdsize'			=> 12
            ),
			array(
                'index' 			=> 'video5',
                'type' 				=> EDIT_TYPE_FILE_MANAGER,
                'uploadtype'		=>'image',
                'label' 			=> 'Video 5',
				'mdsize'			=> 12
            ),
			array(
                'index' 			=> 'video5_image',
                'type' 				=> EDIT_TYPE_FILE_MANAGER,
                'uploadtype'		=>'image',
                'label' 			=> 'Video 5 Image',
				'mdsize'			=> 12
            ),
			array(
                'index' 			=> 'video5_title',
                'type' 				=> EDIT_TYPE_TEXT,
                'uploadtype'		=>'image',
                'label' 			=> 'Video 5 Title',
				'mdsize'			=> 12
            ),
			array(
                'index' 			=> 'video6',
                'type' 				=> EDIT_TYPE_FILE_MANAGER,
                'uploadtype'		=>'image',
                'label' 			=> 'Video 6',
				'mdsize'			=> 12
            ),
			array(
                'index' 			=> 'video6_image',
                'type' 				=> EDIT_TYPE_FILE_MANAGER,
                'uploadtype'		=>'image',
                'label' 			=> 'Video 6 Image',
				'mdsize'			=> 12
            ),
			array(
                'index' 			=> 'video6_title',
                'type' 				=> EDIT_TYPE_TEXT,
                'uploadtype'		=>'image',
                'label' 			=> 'Video 6 Title',
				'mdsize'			=> 12
            ),
			array (
					'index' 		=> 'status',
					'type' 			=> 'status',
					'label' 		=> 'Trạng thái',
					'mdsize'		=> 4
			),
			
			array (
					'index' 		=> 'trial',
					'type' 			=> 'status',
					'label' 		=> 'Dùng thử',
					'mdsize'		=> 4
			),
			
			array(
					'index' 		=> 'display',
					'type' 			=> 'status',
					'label' 		=> 'display',
					'mdsize'		=> 4
			)
	);

	public $addValidator 		= array(
		'rules' 				=> array(
			'name' 					=> array(
				'required' 				=> true,
				'minlength' 			=> 2,
				'maxlength' 			=> 255
			)
		),
		'messages' 				=> array(
			'name' 					=> array(
				'required' 				=> 'Tên danh mục không được để trống',
				'minlength' 			=> 'Tên danh mục phải dài 2 ký tự trở lên',
				'maxlength' 			=> 'Tên danh mục chỉ dài tối đa 255 ký tự'
			)
		)
	);
	public $editValidator 		= array(
		'rules' 				=> array(
			'name' 					=> array(
				'required' 				=> true,
				'minlength' 			=> 2,
				'maxlength' 			=> 255
			)
		),
		'messages' 				=> array(
			'name' 					=> array(
				'required' 				=> 'Tên danh mục không được để trống',
				'minlength' 			=> 'Tên danh mục phải dài 2 ký tự trở lên',
				'maxlength' 			=> 'Tên danh mục chỉ dài tối đa 255 ký tự'
			)
		)
	);
	public $listSettingType 	= 'parent';
	public $fixedPageSize 		= 1000;

    public function editPostAction() {
        $row = $this->getEditData();
        $id = pzk_request()->get('id');
		$backHref 	= pzk_request('backHref');

        if($this->validateEditData($row)) {
            $data = _db()->useCB()->select('img')->from('categories')->where(array('id', $id))->result_one();
            if(($row['img'] != $data['img']) and !empty($data['img'])) {
                $url = BASE_DIR.$data['img'];
                unlink($url);
            }
            $this->edit($row);
            pzk_notifier()->addMessage('Cập nhật thành công');
			if($backHref) {
				$this->redirect($backHref);
			} else {
				$this->redirect('index');
			}
        } else {
            pzk_validator()->setEditingData($row);
            $this->redirect('edit/' . pzk_request('id'), array('backHref' => $backHref));
        }
    }

    public function delPostAction() {
        $id = pzk_request()->get('id');
        $data = _db()->useCB()->select('img')->from($this->table)->where(array('id', $id))->result_one();
        if($data['img']) {
            unlink($data['img']);
        }
        _db()->useCB()->delete()->from($this->table)
            ->where(array('id', $id))->result();

        pzk_notifier()->addMessage('Xóa thành công');
        $this->redirect('index');
    }

    public function delAllAction() {
        if(pzk_request('ids')) {
            $arrIds = json_decode(pzk_request('ids'));
            if(count($arrIds) >0) {
                _db()->useCB()->delete()->from($this->table)
                    ->where(array('in', 'id', $arrIds))->result();

                foreach($arrIds as $item) {
                    $data = _db()->useCB()->select('img')->from($this->table)->where(array('id', $item))->result_one();
                    if($data['img']) {
                        $tam = explode("/",$data['img']);
                        $url2 = end($tam);
                        $url = BASE_DIR.$data['img'];
                        unlink($url);
                        unlink(BASE_DIR.'/tmp/'.$url2);
                    }
                }

                echo 1;
            }
        }else {
            die();
        }
    }

	public function assertEqual($val, $expected) {
		static $index = 1;
		echo $index . '. ';
		if($val == $expected) {
			echo "Passed<br />";
		} else {
			echo "Not Passed: $val != $expected<br />";
		}
		$index++;
	}

	public function importQuestionsPostAction() {
		set_time_limit(0);
		$content = pzk_request()->get('content');
		file_put_contents(BASE_DIR . '/tmp/cauhoi.txt', $content);
		echo 'Import dữ liệu<br />';
		$categoryId = pzk_request()->getSegment(3);
		$model = _db()->getEntity('import.category');
		$model->load($categoryId);
		$model->set('filePath', BASE_DIR . '/tmp/cauhoi.txt');
		$model->import();
		//$this->assertEqual(count($model->getQuestions()), 15);
		$questions = $model->get('questions');
		$totalAnswers = 0;
		$categoryIds = $model->get('categoryIds');
		foreach($questions as $question) {
			$question->import();
			$answers = $question->get('answers');
			if(!count($answers)) continue;
			//$existed = $question->getOne(array('name', $question->get('name')));
			$answerQuestion1 = _db()->select('*')->from('answers_question_tn')
				->join('questions', 'answers_question_tn.question_id = questions.id')
				->where(array('and', 
					array('equal', array('column', 'questions', 'name'), $question->get('name')), 
					array('equal', array('column', 'answers_question_tn', 'content'), $answers[0]->get('content'))));
			$answerQuestion1 = $answerQuestion1->result_one('table');
			$answerQuestion2 = _db()->select('*')->from('answers_question_tn')
				->join('questions', 'answers_question_tn.question_id = questions.id')
				->where(array('and', 
					array('equal', array('column', 'questions', 'name'), $question->get('name')), 
					array('equal', array('column', 'answers_question_tn', 'content'), $answers[0]->get('content'))));
			$answerQuestion2 = $answerQuestion2->result_one('table');
			if($answerQuestion1 && $answerQuestion1->get('id') && $answerQuestion2 && $answerQuestion2->get('id')) {				
				echo $answerQuestion1->get('name') . ' đã tồn tại<br />';
				continue;
			}
			$question->set('categoryIds', $categoryIds);
			$question->set('created', date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']));
			$question->set('createdId', pzk_session()->get('adminId'));			
			$question->set('software', pzk_request()->get('softwareId'));			
			$question->set('questionType', '1');
			$question->save();
						
			if($question->get('id')) {
				echo 'Question imported: ' . $question->get('name') . '<br />';			
			}
			foreach($answers as $answer) {
				$answer->set('question_id', $question->get('id'));
				$answer->set('date_modify', date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']));
				$answer->set('admin_modify', pzk_session()->get('adminId'));
				$answer->save();
			}
			$totalAnswers += count($answers);
		}
		//$this->assertEqual($totalAnswers, 60);
		echo '<a href="/admin_category/index">Danh mục</a><br />';
		echo '<a href="/Admin_Question2/index">Câu hỏi</a><br />';
		echo '<a href="/admin_category/importQuestions/'.$categoryId.'">Tiếp tục import vào danh mục</a>';
	}
	
	public function importQuestionsAction() {
		$this->initPage()
			->append('admin/category/importQuestions')
			->append('admin/'.pzk_or($this->customModule, $this->module).'/menu', 'right')
			->display();
	}
	
	public function previewImportQuestionsAction() {
		set_time_limit(0);
		$content = pzk_request()->get('content');
		$categoryId = pzk_request()->getSegment(3);
		$model = _db()->getEntity('import.category');
		$model->load($categoryId);
		$model->set('filePath', BASE_DIR . '/tmp/cauhoi.txt');
		$model->import($content);
		//$this->assertEqual(count($model->getQuestions()), 15);
		$questions = $model->get('questions');
		$totalAnswers = 0;
		$questionIndex = 1;
		$answerAlphas = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I');
		foreach($questions as $question) {
			$question->import();
			$answers = $question->get('answers');
			if(!count($answers)) continue;
			$recommend = '';
			echo '<h2>'.$questionIndex . '. ' . $question->get('name') .'</h2>';
			echo '<blockquote>';
			foreach($answers as $answerIndex => $answer) {
				if($answer->get('status')) {
					echo '<strong>' . $answerAlphas[$answerIndex] . '. ' . $answer->get('content') . '</strong><br />';
					$recommend = $answer->get('recommend');
				} else {
					echo  $answerAlphas[$answerIndex] . '. ' . $answer->get('content') . '<br />';
				}
				
			}
			echo '</blockquote>';
			echo '<div>' . $recommend . '</div>';
			$totalAnswers += count($answers);
			$questionIndex ++;
		}
	}
}