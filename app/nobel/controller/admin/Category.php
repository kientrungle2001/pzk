<?php
class PzkAdminCategoryController extends PzkGridAdminController {
	
	public $table = 'categories';
	public $addFields = 'name, parent, router, img, status, display, software, alias';
	public $editFields = 'name, parent, router, img, status, display, software, alias';
	public $events = array(
			'index.after' => array('this.indexAfter')
	);
	public $listFieldSettings = array(
			array(
					'index' => 'name',
					'type' => 'parent',
					'label' => 'Tên danh mục'
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
					'index' => "name",
					'type' => 'link',
					'label' => 'Nhập dữ liệu',
					'link' => '/admin_category/importQuestions/'
			),

            array(
                'index' => 'status',
                'type' => 'status',
                'label' => 'status'
            ),
			array(
					'index' => 'display',
					'type' => 'status',
					'label' => 'display'
			),
			array(
					'index' => 'ordering',
					'type' => 'ordering',
					'label' => 'Thứ tự'
			),
			array(
					'index' => 'parents',
					'type' => 'text',
					'label' => 'Parents'
			)
	);

    public $searchFields = array('name', 'router');
    public $Searchlabels = 'Tên';
   	
    public $sortFields = array(
        'id asc' => 'ID tăng',
        'id desc' => 'ID giảm',

    );

	public $logable = true;
	public $logFields = 'name, alias, router';
	public $addLabel = 'Thêm Menu';

	public $addFieldSettings = array (
			array (
					'index' => 'name',
					'type' => 'text',
					'label' => 'Tên Category'
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
                'type' => 'upload',
                'uploadtype'=>'image',
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
			array(
					'index' => 'display',
					'type' => 'status',
					'label' => 'Display',
					'options' => array (
							'0' => 'Không hoạt động',
							'1' => 'Hoạt động'
					),
					'actions' => array (
							'0' => 'mở',
							'1' => 'dừng'
					)
			)
			/*, array (
					'index' => 'keywords',
					'type' => 'text',
					'label' => 'Từ khóa'
			),
			array (
					'index' => 'description',
					'type' => 'text',
					'label' => 'Mô tả'
			)*/
	);
	public $editFieldSettings = array (
			array (
					'index' => 'name',
					'type' => 'text',
					'label' => 'Tên Category'
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
                'type' => 'upload',
                'uploadtype'=>'image',
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
			array(
					'index' => 'display',
					'type' => 'status',
					'label' => 'Display',
					'options' => array (
							'0' => 'Không hoạt động',
							'1' => 'Hoạt động'
					),
					'actions' => array (
							'0' => 'mở',
							'1' => 'dừng'
					)
			)
			/*array (
					'index' => 'keywords',
					'type' => 'text',
					'label' => 'Từ khóa'
			),
			array (
					'index' => 'description',
					'type' => 'text',
					'label' => 'Mô tả'
			)*/
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
	public $listSettingType = true;

    public function editPostAction() {
        $row = $this->getEditData();
        $id = pzk_request()->get('id');

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
            $this->redirect('edit/' . pzk_request('id'));
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

	public function importQuestionsAction() {
		echo 'Import dữ liệu';
		echo $this->getModule() . '<br />';
		$categoryId = pzk_request()->getSegment(3);
		$model = _db()->getEntity('import.category');
		$model->load($categoryId);
		$model->setFilePath(BASE_DIR . '/tmp/cauhoi.txt');
		$model->import();
		$this->assertEqual(count($model->getQuestions()), 17);
		$questions = $model->getQuestions();
		$totalAnswers = 0;
		$categoryIds = $model->getCategoryIds();
		foreach($questions as $question) {
			$question->import();
			$existed = $question->getOne(array('name', $question->get('name')));
			if($existed && $existed->get('id')) {
				continue;
			}
			$question->setCategoryIds($categoryIds);
			$question->setCreated(date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']));
			$question->setCreatedId(pzk_session()->getAdminId());
			$question->save();
			$answers = $question->getAnswers();
			foreach($answers as $answer) {
				$answer->setQuestion_id($question->get('id'));
				$answer->setDate_modify(date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']));
				$answer->setAdmin_modify(pzk_session()->getAdminId());
				$answer->save();
			}
			$totalAnswers += count($answers);
		}
		$this->assertEqual($totalAnswers, 0);
	}
}