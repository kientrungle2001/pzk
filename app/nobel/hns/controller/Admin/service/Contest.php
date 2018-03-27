<?php
class PzkAdminServiceContestController extends PzkGridAdminController {
	public $addFields = 'id, name,startDate,expiredDate, showResultDate, endShowResult, siteId, software';
	public $editFields ='id, name,startDate,expiredDate, showResultDate, endShowResult, siteId,software';
	public $table='contest';
	public $sortFields = array(
		'id asc' => 'ID tăng',
		'id desc' => 'ID giảm',
		'name asc' => 'Tên cuộc thi tăng',
		'name desc' => 'Tên cuộc thi giảm',
		
		'startDate asc' => 'Ngày bắt đầu tăng',
		'startDate desc' => 'Ngày bắt đầu giảm'
	);
	public $searchFields = array('name, id,startDate,expiredDate, showResultDate');
	public $listFieldSettings = array(
		array(
			'index' => 'name',
			'type' => 'text',
			'label' => 'Tên cuộc thi'
		),
		array(
			'index' => 'startDate',
			'type' => 'text',
			'label' => 'Ngày bắt đầu'
		),
		array(
			'index' => 'expiredDate',
			'type' => 'text',
			'label' => 'Ngày kết thúc thi'
		),
		array(
			'index' => 'endShowResult',
			'type' => 'text',
			'label' => 'Ngày kết thúc xem đáp án'
		),
		array(
			'index' => 'showResultDate',
			'type' => 'text',
			'label' => 'Ngày trả kết quả'
		),
		array(
			'index' => 'software',
			'type' => 'text',
			'label' => 'Phần mềm'
		),
		array(
			'index' => 'created',
			'type' => 'text',
			'label' => 'Ngày nhập'
		),
		array(
			'index' => 'dateModified',
			'type' => 'text',
			'label' => 'Ngày sửa'
		)
	);
	public $addLabel = 'Thêm mới';
	public $addFieldSettings = array(
		array(
			'index' => 'name',
			'type' => 'text',
			'label' => 'Tên cuộc thi'
		),
		array(
			'index' => 'startDate',
			'type' => 'datetimepicker',
			'label' => 'Ngày bắt đầu'
		),
		array(
			'index' => 'expiredDate',
			'type' => 'datetimepicker',
			'label' => 'Ngày kết thúc thi'
		),
		array(
			'index' => 'endShowResult',
			'type' => 'datetimepicker',
			'label' => 'Ngày kết thúc xem đáp án'
		),
		array(
			'index' => 'showResultDate',
			'type' => 'datetimepicker',
			'label' => 'Ngày trả kết quả'
		)
	);
	public $editFieldSettings = array(
		array(
			'index' => 'name',
			'type' => 'text',
			'label' => 'Tên cuộc thi'
		),
		array(
			'index' => 'startDate',
			'type' => 'datetimepicker',
			'label' => 'Ngày bắt đầu'
		),
		array(
			'index' => 'expiredDate',
			'type' => 'datetimepicker',
			'label' => 'Ngày kết thúc thi'
		),
		array(
			'index' => 'endShowResult',
			'type' => 'datetimepicker',
			'label' => 'Ngày kết thúc xem đáp án'
		),
		array(
			'index' => 'showResultDate',
			'type' => 'datetimepicker',
			'label' => 'Ngày trả kết quả'
		)

	);
	public $addValidator = array(
		'rules' => array(
			'name' => array(
				'required' => true
			),
			'startDate' => array(
				'required' => true
				
			),
			'expiredDate' => array(
				'required' => true
				
			),
			'showResultDate' => array(
				'required' => true
				
			)

		),
		'messages' => array(
			'name' => array(
				'required' => 'Tên cuộc thi không được để trống'
				
			),
			'startDate' => array(
				'required' => 'Phải nhập ngày bắt đầu'
				
			),
			'expiredDate' => array(
				'required' => 'Phải nhập ngày kết thúc'
				
			),
			'showResultDate' => array(
				'required' => 'Phải nhập ngày trả kết quả'
				
			)
		)
	);
	public $editValidator = array(
		'rules' => array(
			'name' => array(
				'required' => true
			),
			'startDate' => array(
				'required' => true
				
			),
			'expiredDate' => array(
				'required' => true
				
			),
			'showResultDate' => array(
				'required' => true
				
			)

		),
		'messages' => array(
			'name' => array(
				'required' => 'Tên cuộc thi không được để trống'
				
			),
			'startDate' => array(
				'required' => 'Phải nhập ngày bắt đầu'
				
			),
			'expiredDate' => array(
				'required' => 'Phải nhập ngày kết thúc'
				
			),
			'showResultDate' => array(
				'required' => 'Phải nhập ngày trả kết quả'
				
			)
		)
	);
    public function editPostAction() {
        $row = $this->getEditData();
        if($this->validateEditData($row)) {
        	if(pzk_request('softwareId')){
	            $row['modified'] = date("Y-m-d h:i:s");
	            
	            $this->edit($row);
	            pzk_notifier()->addMessage('Cập nhật thành công');
	            $this->redirect('index');
	        }
           
        } else {
            pzk_validator()->setEdittingData($row);
            $this->redirect('edit/' . pzk_request('id'));
        }
    }
    public function addPostAction() {
        $row = $this->getAddData();
        if($this->validateAddData($row)) {
        	if(pzk_request('softwareId')){
        		$row['created'] = date("Y-m-d h:i:s");
            	$row['status'] =1;
            	$row['software']= pzk_request('softwareId');
                $this->add($row);
                pzk_notifier()->addMessage('Cập nhật thành công');
           		$this->redirect('index');
        	}
            
        } else {
            pzk_validator()->setEdittingData($row);
            $this->redirect('add');
        }
    }

}