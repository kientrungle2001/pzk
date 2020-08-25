<?php
class PzkAdminTestController extends PzkGridAdminController {
    public $moduleDetail = 'test';
    public $titleController = 'Đề thi';
	public $title = 'Đề thi';
    public $table = 'tests';
	
	public $exportFields = array(
				array(
					'label' 	=> "Id",
					'index' 	=> "id",
					'type' 		=> "text"
				),
				array(
					'label' 	=> "Câu hỏi",
					'index' 	=> "name",
					'type' 		=> "text"
				),
				array(
					'label' 	=> "Danh mục",
					'index' 	=> "categoryIds",
					'type' 		=> "nameid",
					'table' 	=> 'categories',
					'findField' => 'id',
					'showField' => 'name',
				)
	);

    public $listFieldSettings = array(
        array(
            'index' => 'id',
            'type' => 'text',
            'label' => 'ID'
        ),
		array(
            'index' => 'name',
            'type' => 'text',
        	'link' => '/Admin_Test/detail/',
            'label' => "Tên đề thi"
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
            'showField' => 'name_vn',
            'label'     => 'Danh mục',
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
            'index' => 'homework',
            'type' => 'status',
            'label' => 'Phiếu bài tập'
        ),
		array(
			'label' 	=> "Người chấm",
			'index' 	=> "teacherIds",
			'type' 		=> "nameid",
			'table' 	=> 'admin',
			'findField' => 'id',
			'showField' => 'name',
		),
        array(
            'index' => 'ordering',
            'type' => 'ordering',
            'label' => 'Thứ tự'
        ),
		array(
            'index' => 'week',
            'type' => 'text',
            'label' => 'Tuần'
        ),
		array(
            'index' => 'month',
            'type' => 'text',
            'label' => 'Tháng'
        ),
		array(
            'index' => 'semester',
            'type' => 'text',
            'label' => 'Học kỳ'
        ),
		array(
            'index' => 'startDate',
            'type' 	=> 'datetime',
            'label' => 'Ngày bắt đầu',
			'format'=>	'H:m:s d/m/Y'
        ),
		array(
            'index' => 'endDate',
            'type' 	=> 'datetime',
            'label' => 'Ngày kết thúc',
			'format'=>	'H:m:s d/m/Y'
        ),
		array(
            'index' => 'duplicate',
            'type' => 'link',
        	'link' => '/Admin_Test/duplicate/',
            'label' => "Sao chép"
        ),
		array(
            'index' => 'question',
            'type' => 'link',
         	'link' => '/Admin_Test/addQuestion/',
            'label' => "Thêm câu hỏi"
        )
    );

    public $searchFields = array('name');
    public $searchLabel = 'Tên đề thi';
	//filter
	public $filterFields = array(
		array(
            'index' => 'classes',
            'type' => 'select',
            'label' => 'Lớp',
            'table'	=> 'education_grade',
			'show_name'	=> 'gradeNum',
			'show_value'=> 'gradeNum',
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
            'index'=>'homework',
            'type' => 'status',
            'label' => 'Bài tập về nhà'
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

    public $addFields = 'name, testMark, score, classes, categoryIds, content, trytest, time, quantity, status, practice, createdId, created, modifiedId, modified, software, isSort, parent, compability, homework, week, month, semester, teacherIds, subjectId, startDate, showDate, endDate';

    public $addLabel = 'Thêm Đề thi';

    public $addFieldSettings = array(
                array(
            'index' => 'name',
            'type' => 'text',
            'label' => 'Tên đề thi',
			'mdsize'    => 6
        ),
		
		array(
			 'index' => 'score',
			'type' => 'text',
            'label' => 'Điểm mỗi câu',
			'mdsize'    => 6
		),
		array(
			 'index' => 'testMark',
			'type' => 'text',
            'label' => 'Điểm bài',
			'mdsize'    => 6
		),
		
		array(
			'index' => 'classes',
			'type' => 'multiselect',
			'table' => "education_grade",
            'show_value' => "gradeNum",
            'show_name' => 'gradeNum',
			'label' => 'Chọn lớp',
			'mdsize'    => 12
		),
        array(
            'index' => 'categoryIds',
            'type' => "multiselect",
            'label' => "Chọn môn học, bài học",
            'table' => "categories",
            'show_value' => "id",
            'show_name' => 'name',
            'condition'     => 'type like \'%subject%\' or type like \'%topic%\' or type like \'%lesson%\'  or type like \'%section%\'',
            'mdsize'    => 12
        ),
		array(
			'index' => 'subjectId',
            'type' => "select",
            'label' => "Chọn môn học",
            'table' => "categories",
            'show_value' => "id",
            'show_name' => 'name',
            'condition'     => 'type like \'%subject%\'',
            'mdsize'    => 12
		),
		array(
			'index' 	=> 	'content',
			'type' 		=> 	'tinymce',
			'label'		=>	'Nội dung',
			'mdsize'    => 	12
		),
		array(
			'index' => 'trytest',
			'type' => 'selectoption',
			'option' => array(
				'1' => "Đề trặc nghiệm",
                '2' => "Đề tự luận"
			),
			'label' => 'Chọn loại đề thi thử',
			'mdsize'    => 3
		),
        array(
            'index' => 'time',
            'type' => 'text',
            'label' => 'Thời gian làm bài',
			'mdsize'    => 3
        ),
        array(
            'index' => 'quantity',
            'type' => 'text',
            'label' => 'Số câu',
			'mdsize'    => 3
        ),
		 array(
            'index' => 'compability',
            'type' => 'status',
            'label' => 'Đề khảo sát năng lực',
			'mdsize'    => 3
        ),
		 array(
            'index' => 'parent',
            'type' => 'select',
            'label' => 'Đề cha',
            'table' => 'tests',
            'show_value' => 'id',
            'show_name' => 'name'
        ),
        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái',
			'mdsize'	=> 6,
        ),
		array(
            'index' => 'homework',
            'type' => 'status',
            'label' => 'Phiếu bài tập',
			'mdsize'	=> 6,
        ),
		array(
            'index' => 'teacherIds',
            'type' => "multiselect",
            'label' => "Người chấm",
            'table' => "admin",
            'show_value' => "id",
            'show_name' => 'name',
            'condition'     => 'usertype_id = 5',
            'mdsize'    => 12
        ),
		array(
            'index' => 'week',
            'type' => 'text',
            'label' => 'Tuần',
			'mdsize'	=> 2,
        ),
		array(
            'index' => 'month',
            'type' => 'text',
            'label' => 'Tháng',
			'mdsize'	=> 2,
        ),
		array(
            'index' => 'semester',
            'type' => 'text',
            'label' => 'Học kỳ',
			'mdsize'	=> 2,
        ),
		array(
            'index' => 'startDate',
            'type' => 'datetimepicker',
            'label' => 'Ngày bắt đầu',
			'mdsize'	=> 3,
        ),
		array(
            'index' => 'showDate',
            'type' => 'datetimepicker',
            'label' => 'Ngày xem đáp án',
			'mdsize'	=> 3,
        ),
		array(
            'index' => 'endDate',
            'type' => 'datetimepicker',
            'label' => 'Ngày kết thúc',
			'mdsize'	=> 3,
        ),
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
    public $editFields = 'name, score, testMark, classes, categoryIds, content, trytest, time, status, quantity, practice, createdId, created, modifiedId, modified, software, isSort, parent, compability, homework, subjectId, week, month, semester, teacherIds, startDate, showDate, endDate';


    public $editFieldSettings = array(
        array(
            'index' => 'name',
            'type' => 'text',
            'label' => 'Tên đề thi',
			'mdsize'    => 6
        ),
		
		array(
			 'index' => 'score',
			'type' => 'text',
            'label' => 'Điểm mỗi câu',
			'mdsize'    => 6
		),
		array(
			 'index' => 'testMark',
			'type' => 'text',
            'label' => 'Điểm bài',
			'mdsize'    => 6
		),
		
		array(
			'index' => 'classes',
			'type' => 'multiselect',
			'table' => "education_grade",
            'show_value' => "gradeNum",
            'show_name' => 'gradeNum',
			'label' => 'Chọn lớp',
			'mdsize'    => 12
		),
        array(
            'index' => 'categoryIds',
            'type' => "multiselect",
            'label' => "Chọn môn học, bài học",
            'table' => "categories",
            'show_value' => "id",
            'show_name' => 'name',
            'condition'     => 'type like \'%subject%\' or type like \'%topic%\' or type like \'%lesson%\'  or type like \'%section%\'',
            'mdsize'    => 12
        ),
		array(
			'index' => 'subjectId',
            'type' => "select",
            'label' => "Chọn môn học",
            'table' => "categories",
            'show_value' => "id",
            'show_name' => 'name',
            'condition'     => 'type like \'%subject%\'',
            'mdsize'    => 12
		),
		array(
			'index' 	=> 	'content',
			'type' 		=> 	'tinymce',
			'label'		=>	'Nội dung',
			'mdsize'    => 	12
		),
		array(
			'index' => 'trytest',
			'type' => 'selectoption',
			'option' => array(
				'1' => "Đề trặc nghiệm",
                '2' => "Đề tự luận"
			),
			'label' => 'Chọn loại đề thi thử',
			'mdsize'    => 3
		),
        array(
            'index' => 'time',
            'type' => 'text',
            'label' => 'Thời gian làm bài',
			'mdsize'    => 3
        ),
        array(
            'index' => 'quantity',
            'type' => 'text',
            'label' => 'Số câu',
			'mdsize'    => 3
        ),
		 array(
            'index' => 'compability',
            'type' => 'status',
            'label' => 'Đề khảo sát năng lực',
			'mdsize'    => 3
        ),
		 array(
            'index' => 'parent',
            'type' => 'select',
            'label' => 'Đề cha',
            'table' => 'tests',
            'show_value' => 'id',
            'show_name' => 'name'
        ),
        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái',
			'mdsize'	=> 6,
        ),
		array(
            'index' => 'homework',
            'type' => 'status',
            'label' => 'Phiếu bài tập',
			'mdsize'	=> 6,
        ),
		array(
            'index' => 'teacherIds',
            'type' => "multiselect",
            'label' => "Người chấm",
            'table' => "admin",
            'show_value' => "id",
            'show_name' => 'name',
            'condition'     => 'usertype_id = 5',
            'mdsize'    => 12
        ),
		array(
            'index' => 'week',
            'type' => 'text',
            'label' => 'Tuần',
			'mdsize'	=> 2,
        ),
		array(
            'index' => 'month',
            'type' => 'text',
            'label' => 'Tháng',
			'mdsize'	=> 2,
        ),
		array(
            'index' => 'semester',
            'type' => 'text',
            'label' => 'Học kỳ',
			'mdsize'	=> 2,
        ),
		array(
            'index' => 'startDate',
            'type' => 'datetimepicker',
            'label' => 'Ngày bắt đầu',
			'mdsize'	=> 3,
        ),
		array(
            'index' => 'showDate',
            'type' => 'datetimepicker',
            'label' => 'Ngày xem đáp án',
			'mdsize'	=> 3,
        ),
		array(
            'index' => 'endDate',
            'type' => 'datetimepicker',
            'label' => 'Ngày kết thúc',
			'mdsize'	=> 3,
        ),
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
            pzk_session()->setDetailTestKeyword( pzk_request()->getKeyword());
        }else{
            pzk_session()->setDetailTestKeyword( '');
            pzk_session()->setTestQuestionOrderBy( '');

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
        $obj->setParentId( pzk_request()->getSegment(3));
        $obj->display();
    }

    public function changeOrderByAction() {
        pzk_session()->setTestQuestionOrderBy( pzk_request()->getOrderBy());

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
	public function addQuestionAction(){
		
		$this->initPage();
        $this->append('admin/'.pzk_or($this->getCustomModule(), $this->getModule()).'/imports')
            ->append('admin/'.pzk_or($this->getCustomModule(), $this->getModule()).'/menu', 'right');
			
			$testId = pzk_request()->getSegment(3);	
			$testInfo = _db()->selectAll()->fromTests()->whereId($testId)->result_one();
			
			$allowed = array('csv','xlsx','xls');
			$dir = BASE_DIR."/tmp/";

			if(!empty($_FILES['file']['name'])){
				$fileParts = pathinfo($_FILES['file']['name']);
				// Kiem tra xem file upload co nam trong dinh dang cho phep
				if(in_array($fileParts['extension'], $allowed)) {
					// Neu co trong dinh dang cho phep, tach lay phan mo rong
					$tam = explode('.', $_FILES['file']['name']);
					$ext = end($tam);
					$renamed = md5(rand(0,200000)).'.'."$ext";
					//upload file
					move_uploaded_file($_FILES['file']['tmp_name'], $dir.$renamed);
					//xu li import
					$path = $dir.$renamed;
					
			
					require_once BASE_DIR . '/3rdparty/phpexcel/PHPExcel.php';
					$objPHPExcel = new PHPExcel();
						
					require_once BASE_DIR.'/3rdparty/phpexcel/PHPExcel/Reader/Excel2007.php';
					$objReader = new PHPExcel_Reader_Excel2007();
					//$objReader->setReadDataOnly(true);
					$data = $objReader->load($path);
					$objWorksheet = $data->getActiveSheet();
					
					$objPHPExcel = PHPExcel_IOFactory::load($path);
					
					$sheet = $objPHPExcel->getSheet(0);
					$highestRow = $sheet->getHighestRow();
					$highestColumn = $sheet->getHighestColumn();

					//  Loop through each row of the worksheet in turn
					for ($row = 1; $row <= $highestRow; $row++){
						//  Read a row of data into an array
						$rowData[] = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
							NULL,
							TRUE,
							FALSE);

					}
					//insert to db
					
					$classes = $testInfo['classes'];
					if(count($rowData) > 2){
						array_splice($rowData, 0, 2);
						
						foreach($rowData as $item){
							$item = $item[0];
							if($item[0]){
								$code = $item[0];
								//neu chua co cau hoi
								if(!$this->existQuestion($code)){
									if($item[2]){
										$type = strtolower(trim($item[2]));
										$question = array(
											'name_vn' => $item[1],
											'code' =>  $code,
											'testId' => ','.$testId.',',
											'status' => 1,
											'classes' => $classes,
											'created' => date(DATEFORMAT, $_SERVER['REQUEST_TIME']),
											'software' => 1,
											'thu' => 1,
										);
										if($type == 'tl'){
											//dang tu luan
											$question['questionType'] = 4;
											$question['explaination'] = $item[6];
											$teacher_answers = array(
												'content_full' => $item[6]
											);
											$question['teacher_answers'] = json_encode($teacher_answers);
											
											_db()->getTableEntity('questions')->setData($question)->save();
										}else if($type == 'tn'){
											//dang trac nghiem
											$question['questionType'] = 1;
											$question['explaination'] = $item[6];
											$entity = _db()->getTableEntity('questions');
											$entity->setData($question)->save();
											$questionId = $entity->getId();
											//chon dap an dung
											$dapan = strtolower(trim($item[3]));
											$checkDa = 0;
											if($dapan == 'a'){
												$checkDa = 7;
											}else if($dapan == 'b'){
												$checkDa = 8;
											}else if($dapan == 'c'){
												$checkDa = 9;
											}else if($dapan == 'd'){
												$checkDa = 10;
											}
											for($i = 7; $i < 11; $i++){
												if($item[$i] != ''){
													$status = 0;
													if($i == $checkDa){
														$status = 1;
													}
													
													$anserTn = array(
														'question_id' => $questionId,
														'content' => $item[$i],
														'content_vn' => $item[$i],
														'recommend' => $item[6],
														'thu' => 1,
														'status' => $status	
													);
													_db()->getTableEntity('answers_question_tn')
													->setData($anserTn)->save();
												}	
											}
											
										}else if($type == 'dk'){
											//dang dien khuyet
											$question['questionType'] = 4;
											$question['auto'] = 1;
											$question['explaination'] = $item[6];
											
											$arrInput = explode('#', $item[3]);
											$arrScore = explode('#', $item[11]);
											
											$teacher_answers = array(
												'i' => array(
													'1' => $item[3]
												),
												'i_m' => array(
													'1' => $item[11]
												),
												'content_full' => $item[6]
											);
											
											foreach($arrInput as $i=>$input){
												$teacher_answers['i'][$i+1] = $input;
												$teacher_answers['i_m'][$i+1] = $arrScore[$i];
											}
											
											$question['teacher_answers'] = json_encode($teacher_answers);
											_db()->getTableEntity('questions')->setData($question)->save();
										}
										
									}
								}else{
									//co cau hoi roi
									$dataQuestion = $this->existQuestion($code);
									$testIds = $dataQuestion['testId'];
									if($testIds != ''){
										if(strpos($testId, $testIds) === false){
											$testIds .= $testId.',';
											_db()->update('questions')
											->set(array('testId' => $testIds))
											->whereId($dataQuestion['id'])->result();
											
										}
									}else{
										_db()->update('questions')
											->set(array('testId' => ','.$testId.','))
											->whereId($dataQuestion['id'])->result();
									}
									
								}	
							}	
						}
					}	
					//update du lieu xong
					if(file_exists($path)) {
						unlink($path);
					}
					//them thong bao
					pzk_notifier()->addMessage('Đã thêm xong câu hỏi');
					$this->redirect('index');
					
				} else {
					// FIle upload khong thuoc dinh dang cho phep
				   die("File upload không thuộc định dạng cho phép!");
				}
			}
		$imports = pzk_element()->getImports();
		$imports->setTestName( $testInfo['name']);
        $this->display();
		
	}
	public function existQuestion($code){
		$data = _db()->select('id, testId')->fromQuestions()->whereCode($code)->result_one();
		if(count($data) > 0){
			return $data;
		}else{
			return false;
		}
	}
	
}?>