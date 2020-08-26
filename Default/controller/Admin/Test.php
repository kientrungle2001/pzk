<?php
class PzkAdminTestController extends PzkGridAdminController {
    public $moduleDetail = 'test';
    public $titleController = 'Đề thi';
    public $table = 'tests';
    public $listFieldSettings = array(
        array(
            'index' => 'id',
            'type' => 'text',
            'label' => 'ID'
        ),
		array(
            'index' => 'name',
            'type' => 'text',
        	'link' => '/admin_test/detail/',
            'label' => "Tên đề thi"
        ),
		array(
            'index' => 'name_sn',
            'type' => 'text',
        	'link' => '/admin_test/detail/',
            'label' => "Tên đề thi(Song ngữ)"
        ),
		array(
            'index' => 'name_en',
            'type' => 'text',
        	'link' => '/admin_test/detail/',
            'label' => "Tên đề thi tiếng Anh"
        ),
		array(
            'index' => 'score',
            'type' => 'text',
            'label' => 'Điểm'
        ),
        array(
            'index'     => 'categoryIds',
            'type'      => 'nameid',
            'table'     => 'categories',
            'findField' => 'id',
            'showField' => 'name',
            'label'     => 'Tuần',
            
        ),
		array(
					'index' => 'classes',
					'type' => 'ordering',
					'label' => 'Lớp'
		),
        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái'
        ),
        array(
            'index' => 'trial',
            'type' => 'status',
            'label' => 'Dùng thử'
        ),
		 array(
            'index' => 'practice',
            'type' => 'status',
            'label' => 'Luyện tập'
        ),
        array(
            'index' => 'ordering',
            'type' => 'ordering',
            'label' => 'Thứ tự'
        ),
		array(
            'index' => 'displayAtSite',
            'type' => 'ordering',
            'label' => 'Hiển thị ở site'
        ),
        array(
            'index' => 'isSort',
            'type' => 'status',
            'label' => 'Đề ngẫu nhiên'
        ),
		array(
            'index' => 'isNew',
            'type' => 'status',
            'label' => 'Đề mới'
        ),
		array(
            'index' => 'duplicate',
            'type' => 'link',
        	'link' => '/admin_test/duplicate/',
            'label' => "Sao chép"
        )
    );

    public $searchFields = array('name');
    public $searchLabel = 'Tên đề thi';
	//filter
	public $filterFields = array(
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
            'index' 	=> 'categoryIds',
            'type' 		=> 'select',
            'label' 	=> 'Tuần',
            'table' 	=> 'categories',
			'condition'	=> 'parent=354',
			'show_name'	=> 'name',
			'show_value'=> 'id',
			'like' 		=> true
        ),
		array(
            'index' 	=> 'categoryIds',
            'type' 		=> 'select',
            'label' 	=> 'Đề khảo sát năng lực',
            'table' 	=> 'categories',
			'condition'	=> 'parent=1410',
			'show_name'	=> 'name',
			'show_value'=> 'id',
			'like' 		=> true
        ),
		array(
            'index'=>'trial',
            'type' => 'status',
            'label' => 'Dùng thử'
        ),
		array(
            'index'=>'practice',
            'type' => 'status',
            'label' => 'Luyện tập'
        ),
		array(
            'index'=>'status',
            'type' => 'status',
            'label' => 'Trạng thái'
        ),
		
		array(
            'index'=>'isSort',
            'type' => 'status',
            'label' => 'Ngẫu nhiên'
        )
	);

    public $addFields = 'name, name_en, score, camp, classes,categoryIds,trytest, time, quantity, status, practice, createdId, created, modifiedId, modified, software, isSort, trial, name_sn, parent, compability, school';
    public $addLabel = 'Thêm Đề thi';

    public $addFieldSettings = array(
        array(
            'index' => 'name',
            'type' => 'text',
            'label' => 'Tên đề thi'
        ),
		array(
            'index' => 'name_sn',
            'type' => 'text',
            'label' => 'Tên đề thi(Song ngữ)'
        ),
		array(
            'index' => 'name_en',
            'type' => 'text',
            'label' => 'Tên đề thi tiếng Anh'
        ),
		array(
			 'index' => 'score',
			'type' => 'text',
            'label' => 'Điểm mỗi câu'
		),
		array(
            'index' => 'school',
            'type' => 'text',
            'label' => 'Id trường'
        ),
		array(
			'index' => 'classes',
			'type' => 'multiselectoption',
			'option' => array(
				CLASS3 => "Lớp 3",
                CLASS4 => "Lớp 4",
                CLASS5 => "Lớp 5",
			),
			'label' => 'Chọn lớp'
		),
        array(
            'index' => 'categoryIds',
            'type' => "multiselect",
            'label' => "Chọn tuần",
            'table' => "categories",
            'show_value' => "id",
            'show_name' => 'name',
            'condition'     => 'router like \'%ngonngu%\' or router like \'%test%\'',
            'mdsize'    => 12
        ),
		array(
			'index' => 'camp',
			'type' => 'select',
			'table' => 'contest',
			'show_name' => 'name',
			'show_value' => 'id',
			'label' => 'Chọn đợt thi'
		),
		array(
			'index' => 'trytest',
			'type' => 'selectoption',
			'option' => array(
				'1' => "Đề trặc nghiệm",
                '2' => "Đề tự luận"
			),
			'label' => 'Chọn loại đề thi thử'
		),
        array(
            'index' => 'time',
            'type' => 'text',
            'label' => 'Thời gian làm bài'
        ),
        array(
            'index' => 'quantity',
            'type' => 'text',
            'label' => 'Số câu'
        ),
		 array(
            'index' => 'compability',
            'type' => 'status',
            'label' => 'Đề khảo sát năng lực',
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
            'index' => 'parent',
            'type' => 'select',
            'label' => 'Menu cha',
            'table' => 'tests',
            'show_value' => 'id',
            'show_name' => 'name'
        ),
        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái',
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
            'index' => 'trial',
            'type' => 'status',
            'label' => 'Dùng thử',
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
            'index' => 'practice',
            'type' => 'status',
            'label' => 'Luyện tập',
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
            'index' => 'isSort',
            'type' => 'status',
            'label' => 'Đề ngẫu nhiên',
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
            )
        ),
        'messages' => array(
            'name' => array(
                'required' => 'Tên đề thi không được để trống',
                'minlength' => 'Tên đề thi phải dài 2 ký tự trở lên',
                'maxlength' => 'Tên đề thi chỉ dài tối đa 255 ký tự'
            )
        )
    );

    public $editLabel = 'Sửa đề thi';
    public $editFields = 'name, name_en, score, camp, classes,categoryIds,trytest, time, status, quantity, practice, createdId, created, modifiedId, modified, software, isSort, trial, name_sn, parent, compability, school';

    public $editFieldSettings = array(
        array(
            'index' => 'name',
            'type' => 'text',
            'label' => 'Tên đề thi'
        ),
		array(
            'index' => 'name_sn',
            'type' => 'text',
            'label' => 'Tên đề thi(Song ngữ)'
        ),
		array(
            'index' => 'name_en',
            'type' => 'text',
            'label' => 'Tên đề thi tiếng Anh'
        ),
		array(
			 'index' => 'score',
			'type' => 'text',
            'label' => 'Điểm mỗi câu'
		),
		array(
            'index' => 'school',
            'type' => 'text',
            'label' => 'Id trường'
        ),
		array(
			'index' => 'classes',
			'type' => 'multiselectoption',
			'option' => array(
				CLASS3 => "Lớp 3",
                CLASS4 => "Lớp 4",
                CLASS5 => "Lớp 5",
			),
			'label' => 'Chọn lớp'
		),
        array(
            'index' => 'categoryIds',
            'type' => "multiselect",
            'label' => "Chọn tuần",
            'table' => "categories",
            'show_value' => "id",
            'show_name' => 'name',
            'condition'     => 'router like \'%ngonngu%\' or router like \'%test%\'',
            'mdsize'    => 12
        ),
		array(
			'index' => 'camp',
			'type' => 'select',
			'table' => 'contest',
			'show_name' => 'name',
			'show_value' => 'id',
			'label' => 'Chọn đợt thi'
		),
		
		array(
			'index' => 'trytest',
			'type' => 'selectoption',
			'option' => array(
				'1' => "Đề trặc nghiệm",
                '2' => "Đề tự luận"
			),
			'label' => 'Chọn loại đề thi thử'
		),
        array(
            'index' => 'time',
            'type' => 'text',
            'label' => 'Thời gian làm bài'
        ),
        array(
            'index' => 'quantity',
            'type' => 'text',
            'label' => 'Số câu'
        ),
		array(
            'index' => 'compability',
            'type' => 'status',
            'label' => 'Đề khảo sát năng lực',
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
            'index' => 'parent',
            'type' => 'select',
            'label' => 'Menu cha',
            'table' => 'tests',
            'show_value' => 'id',
            'show_name' => 'name'
        ),

        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái',
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
            'index' => 'trial',
            'type' => 'status',
            'label' => 'Dùng thử',
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
            'index' => 'practice',
            'type' => 'status',
            'label' => 'Luyện tập',
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
            'index' => 'isSort',
            'type' => 'status',
            'label' => 'Đề ngẫu nhiên',
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
            )
        ),
        'messages' => array(
            'name' => array(
                'required' => 'Tên đề thi không được để trống',
                'minlength' => 'Tên đề thi phải dài 2 ký tự trở lên',
                'maxlength' => 'Tên đề thi chỉ dài tối đa 1000 ký tự'
            )
        )

    );


    public function saveDetailOrderingsAction(){
        $orderings = pzk_request()->getOrderings();
        $field = pzk_request()->getField();
        foreach($orderings as $id => $val) {
            $entity = _db ()->getTableEntity ('questions')->load ( $id );
            $entity->update ( array (
                $field => $val
            ) );
        }
    }

    public function searchPostAction() {
        $action	=	pzk_request()->getSubmit_action();
        if($action != ACTION_RESET){
            pzk_session('detailTestKeyword', pzk_request()->getKeyword());
        }else{
            pzk_session('detailTestKeyword', '');
            pzk_session('testQuestionOrderBy', '');

        }
        $this->redirect('admin_test/detail/'.pzk_request()->getTestId());
    }

    public function delTestAction() {
        $questionId = pzk_request()->getQuestionId();
        $testId = pzk_request()->getTestId();
        $testIds = pzk_request()->getTestIds();
        $trimTestId = trim($testIds, ',');

        if(is_numeric($trimTestId)) {
            $newTestId = '';
        }else {
            $newTestId = str_replace(','.$testId.',', ',', $testIds);
        }
        _db()->update('questions')->set(array('testId' => $newTestId))->where(array('id', $questionId))->result();

        echo 1;
    }

    public function addTestAction() {
        $questionId = pzk_request()->getQuestionId();
        $testId = pzk_request()->getTestId();
        $testIds = pzk_request()->getTestIds();
        if($testIds) {
            $newTestId = ','.$testId.$testIds;
        }else {
            $newTestId = ','.$testId.',';
        }

        _db()->update('questions')->set(array('testId' => $newTestId))->where(array('id', $questionId))->result();

        echo 1;
    }

    public function resultQuestionAction() {

        $obj = $this->parse('admin/grid/test/questionResult');
        $obj->setParentId(pzk_request()->getSegment(3));
        $obj->display();
    }

    public function changeOrderByAction() {
        pzk_session('testQuestionOrderBy', pzk_request()->getOrderBy());

        $this->redirect('admin_test/detail/'.pzk_request()->getTestId());
    }
    public function onchangeStatusTestAction() {
        $id = pzk_request ('id');
        $field = pzk_request()->getField();
        $entity = _db ()->getTableEntity ('questions')->load ( $id );
        $entity->update ( array (
            $field => 1 - $entity->get($field)
        ) );
        $this->redirect('admin_test/detail/'.pzk_request()->getTestId());
    }

    public function printAction() {
        $obj = $this->parse('admin/grid/test/textQuestion');

        $obj->display();
    }
}