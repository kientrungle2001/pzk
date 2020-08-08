<?php
class PzkAdminCategoryController extends PzkGridAdminController {
	public $table = 'categories';
	public $addFields = 'name, parent, router, img, catetype, color, status, display, software, content, questiontype, recommend, isSort, alias';
	public $editFields = 'name, parent, router, img, catetype, color, status, display, software, content, questiontype, recommend, isSort, alias';

	public $filterFields = array(
	
			array(
					'index' => 'parent',
					'type' => 'select',
					'label' => 'Lọc theo danh mục',
					'table' => 'categories',
					'show_value' => 'id',
					'show_name' => 'name',
			),
			array(
					'index' => 'status',
					'type' => 'status',
					'option' => array(
							'' =>'Tất cả',
							'0' => ' Chưa kích hoạt',
							'1' => 'Đã kích hoạt'
					),
					'label' =>'Trạng thái kích hoạt'
			)
	);
	public $listFieldSettings = array(
		array(
				'index' => 'ordering',
				'type' => 'ordering',
				'label' => 'Thứ tự'
		),
		array(
				'index' => 'name',
				'type' => 'text',
				'label' => 'Tên danh mục',
				'link' => '/admin_category/filter?type=select&index=parent&select='
		),
		array(
			'index' => 'questiontype',
			'type' => 'text',
			'label' => 'Dạng bài',
		),
		array(
				'index' => 'alias',
				'type' => 'text',
				'label' => 'Bí danh'
		),
		array(
				'index' => 'router',
				'type' => 'text',
				'label' => 'Đường dẫn'
		),
		array(
				'index' => "id",
				'type' => 'link',
				'label' => 'Nhập dữ liệu',
				'link' => '/admin_category/importQuestions/'
		),

		array(
			'index' => 'status',
			'type' => 'status',
			'label' => 'Trạng thái'
		),
		array(
			'index' => 'isSort',
			'type' => 'status',
			'label' => 'Sắp xếp'
		),
		array(
				'index' => 'display',
				'type' => 'status',
				'label' => 'Hiển thị'
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
	public $logFields = 'name, alias, router, keywords, description';
	public $addLabel = 'Thêm Menu';

	public $addFieldSettings = array (
			array (
					'index' => 'name',
					'type' => 'text',
					'label' => 'Tên Category'
			),
			array (
					'index' => 'color',
					'type' => 'text',
					'label' => 'Color'
			),
			array (
					'index' => 'catetype',
					'type' => 'text',
					'label' => 'Kiểu danh mục'
			),
			array(
				'index' => 'questiontype',
				'type' => 'select',
				'label' => 'Dạng bài',
				'table' => 'questiontype',
				'show_value' => 'question_type',
				'show_name' => 'name'
			),
			array (
					'index' => 'alias',
					'type' => 'text',
					'label' => 'Bí danh'
			),
			array (
					'index' => 'router',
					'type' => 'text',
					'label' => 'Đường dẫn gốc'
			),
			array (
					'index' => 'parent',
					'type' => 'select',
					'table' => 'categories',
					'label' => 'Danh mục cha',
					'show_name' => 'name',
					'show_value' => 'id'
			),
           
           
           array(
            'index' => 'img',
            'type' => 'filemanager',
            'label' => 'Chọn ảnh',

        ),
			array (
					'index' => 'status',
					'type' => 'status',
					'label' => 'Trạng thái',
					'options' => array (
							'0' => 'Không hoạt động',
							'1' => 'Hoạt động'
					),
					'actions' => array (
							'0' => 'mở',
							'1' => 'dừng'
					)
			),
            array (
                'index' => 'isSort',
                'type' => 'status',
                'label' => 'Sắp xếp',
                'options' => array (
                    '0' => 'Không hoạt động',
                    '1' => 'Hoạt động'
                ),
                'actions' => array (
                    '0' => 'mở',
                    '1' => 'dừng'
                )
            ),
			array(
					'index' => 'display',
					'type' => 'status',
					'label' => 'display',
					'options' => array (
							'0' => 'Không hoạt động',
							'1' => 'Hoạt động'
					),
					'actions' => array (
							'0' => 'mở',
							'1' => 'dừng'
					)
			), array (
					'index' => 'keywords',
					'type' => 'text',
					'label' => 'Từ khóa'
			),
			array (
					'index' => 'description',
					'type' => 'text',
					'label' => 'Mô tả'
			)
	);
	public $editFieldSettings = array (
			array (
					'index' => 'name',
					'type' => 'text',
					'label' => 'Tên Category'
			),
			array (
					'index' => 'color',
					'type' => 'text',
					'label' => 'Color'
			),
			array (
					'index' => 'catetype',
					'type' => 'text',
					'label' => 'Kiểu danh mục'
			),
			array(
				'index' => 'questiontype',
				'type' => 'select',
				'label' => 'Dạng bài',
				'table' => 'questiontype',
				'show_value' => 'question_type',
				'show_name' => 'name'
			),
			array (
					'index' => 'alias',
					'type' => 'text',
					'label' => 'Bí danh'
			),
			array (
					'index' => 'router',
					'type' => 'text',
					'label' => 'Đường dẫn gốc'
			),
			array (
					'index' => 'parent',
					'type' => 'select',
					'table' => 'categories',
					'label' => 'Danh mục cha',
					'show_name' => 'name',
					'show_value' => 'id'
			),
            array(
            'index' => 'img',
            'type' => 'filemanager',
            'label' => 'Chọn ảnh',

        ),

			array (
					'index' => 'status',
					'type' => 'status',
					'label' => 'Trạng thái',
					'options' => array (
							'0' => 'Không hoạt động',
							'1' => 'Hoạt động'
					),
					'actions' => array (
							'0' => 'mở',
							'1' => 'dừng'
					)
			),
            array (
                'index' => 'isSort',
                'type' => 'status',
                'label' => 'Sắp xếp',
                'options' => array (
                    '0' => 'Không hoạt động',
                    '1' => 'Hoạt động'
                ),
                'actions' => array (
                    '0' => 'mở',
                    '1' => 'dừng'
                )
            ),
			array(
					'index' => 'display',
					'type' => 'status',
					'label' => 'display',
					'options' => array (
							'0' => 'Không hoạt động',
							'1' => 'Hoạt động'
					),
					'actions' => array (
							'0' => 'mở',
							'1' => 'dừng'
					)
			),
			array (
					'index' => 'keywords',
					'type' => 'text',
					'label' => 'Từ khóa'
			),
			array (
					'index' => 'description',
					'type' => 'text',
					'label' => 'Mô tả'
			)
	);

	public $addValidator = array(
		'rules' => array(
			'name' => array(
				'required' => true,
				'minlength' => 2,
				'maxlength' => 255
			)
		),
		'messages' => array(
			'name' => array(
				'required' => 'Tên danh mục không được để trống',
				'minlength' => 'Tên danh mục phải dài 2 ký tự trở lên',
				'maxlength' => 'Tên danh mục chỉ dài tối đa 255 ký tự'
			)
		)
	);
	public $editValidator = array(
		'rules' => array(
			'name' => array(
				'required' => true,
				'minlength' => 2,
				'maxlength' => 255
			)
		),
		'messages' => array(
			'name' => array(
				'required' => 'Tên danh mục không được để trống',
				'minlength' => 'Tên danh mục phải dài 2 ký tự trở lên',
				'maxlength' => 'Tên danh mục chỉ dài tối đa 255 ký tự'
			)
		)
	);
	public $listSettingType = 'parent';
	public $fixedPageSize = 200;

    public function editPostAction() {
        $row = $this->getEditData();
        $id = pzk_request()->getId();
        if($this->validateEditData($row)) {
            $data = _db()->useCB()->select('img')->from('categories')->where(array('id', $id))->result_one();
            if(($row['img'] != $data['img']) and !empty($data['img'])) {
                $url = BASE_DIR.$data['img'];
                unlink($url);
            }
            $this->edit($row);
            pzk_notifier()->addMessage('Cập nhật thành công');
            $this->redirect('index');
        } else {
            pzk_validator()->setEditingData($row);
            $this->redirect('edit/' . pzk_request()->getId());
        }
    }

    public function delPostAction() {
        $id = pzk_request()->getId();
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
        if(pzk_request()->getIds()) {
            $arrIds = json_decode(pzk_request()->getIds());
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
		$content = pzk_request()->getContent();
		file_put_contents(BASE_DIR . '/tmp/cauhoi.txt', $content);
		echo 'Import dữ liệu<br />';
		$categoryId = pzk_request()->getSegment(3);
		$model = _db()->getEntity('import.category');
		$model->load($categoryId);
		$model->setFilePath(BASE_DIR . '/tmp/cauhoi.txt');
		$model->import();
		//$this->assertEqual(count($model->getQuestions()), 15);
		$questions = $model->getQuestions();
		$totalAnswers = 0;
		$categoryIds = $model->getCategoryIds();
		foreach($questions as $question) {
			$question->import();
			$answers = $question->getAnswers();
			if(!count($answers)) continue;
			//$existed = $question->getOne(array('name', $question->getName()));
			$answerQuestion1 = _db()->select('*')->from('answers_question_tn')
				->join('questions', 'answers_question_tn.question_id = questions.id')
				->where(array('and', 
					array('equal', array('column', 'questions', 'name'), $question->getName()), 
					array('equal', array('column', 'answers_question_tn', 'content'), $answers[0]->getContent())));
			$answerQuestion1 = $answerQuestion1->result_one('table');
			$answerQuestion2 = _db()->select('*')->from('answers_question_tn')
				->join('questions', 'answers_question_tn.question_id = questions.id')
				->where(array('and', 
					array('equal', array('column', 'questions', 'name'), $question->getName()), 
					array('equal', array('column', 'answers_question_tn', 'content'), $answers[0]->getContent())));
			$answerQuestion2 = $answerQuestion2->result_one('table');
			if($answerQuestion1 && $answerQuestion1->getId() && $answerQuestion2 && $answerQuestion2->getId()) {				
				echo $answerQuestion1->getName() . ' đã tồn tại<br />';
				continue;
			}
			$question->setCategoryIds($categoryIds);
			$question->setCreated(date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']));
			$question->setCreatedId(pzk_session()->getAdminId());			
			$question->setSoftware(pzk_request()->getSoftwareId());			
			$question->setQuestionType('1');
			$question->save();
						
			if($question->getId()) {
				echo 'Question imported: ' . $question->getName() . '<br />';			
			}
			foreach($answers as $answer) {
				$answer->setQuestion_id($question->getId());
				$answer->setDate_modify(date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']));
				$answer->setAdmin_modify(pzk_session()->getAdminId());
				$answer->save();
			}
			$totalAnswers += count($answers);
		}
		//$this->assertEqual($totalAnswers, 60);
		echo '<a href="/admin_category/index">Danh mục</a><br />';
		echo '<a href="/admin_questions/index">Câu hỏi</a><br />';
		echo '<a href="/admin_category/importQuestions/'.$categoryId.'">Tiếp tục import vào danh mục</a>';
	}
	
	public function importQuestionsAction() {
		$this->initPage()
			->append('admin/category/importQuestions')
			->append('admin/'.pzk_or($this->customModule, $this->module).'/menu', 'right')
			->display();
	}
}