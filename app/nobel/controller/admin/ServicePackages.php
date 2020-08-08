<?php
class PzkAdminServicePackagesController extends PzkGridAdminController {
	public $addFields = 'id, serviceName, amount, date';
	public $editFields = 'id, serviceName, amount,dateModified';
	public $table='service_packages';
	public $sortFields = array(
		'id asc' => 'ID tăng',
		'id desc' => 'ID giảm',
		'serviceName asc' => 'Tên dịch vụ tăng',
		'serviceName desc' => 'ên dịch vụ giảm',
		'date asc' => 'Ngày nhập tăng',
		'date desc' => 'Ngày nhập giảm',
		'amount asc' => 'Đơn giá tăng',
		'amount desc' => 'Đơn giá giảm'
	);
	public $searchFields = array('serviceName, id, date, amount');
	public $listFieldSettings = array(
		array(
			'index' => 'serviceName',
			'type' => 'text',
			'label' => 'Tên dịch vụ'
		),
		array(
			'index' => 'amount',
			'type' => 'text',
			'label' => 'Đơn giá'
		),
		array(
			'index' => 'date',
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
			'index' => 'serviceName',
			'type' => 'text',
			'label' => 'Tên dịch vụ'
		),
		array(
			'index' => 'amount',
			'type' => 'text',
			'label' => 'Đơn giá'
		)
	);
	public $editFieldSettings = array(
		array(
			'index' => 'serviceName',
			'type' => 'text',
			'label' => 'Tên dịch vụ'
		),
		array(
			'index' => 'amount',
			'type' => 'text',
			'label' => 'Đơn giá'
		),

	);
	public $addValidator = array(
		'rules' => array(
			'serviceName' => array(
				'required' => true
			),
			'amount' => array(
				'required' => true
				
			)

		),
		'messages' => array(
			'serviceName' => array(
				'required' => 'Tên dịch vụ không được để trống'
				
			),
			'amount' => array(
				'required' => 'Đơn giá không được để trống'
				
			)
		)
	);
	public $editValidator = array(
		'rules' => array(
			'serviceName' => array(
				'required' => true
			),
			'amount' => array(
				'required' => true
				
			)

		),
		'messages' => array(
			'serviceName' => array(
				'required' => 'Tên dịch vụ không được để trống'
				
			),
			'amount' => array(
				'required' => 'Đơn giá không được để trống'
				
			)
		)
	);
    public function editPostAction() {
        $row = $this->getEditData();
        if($this->validateEditData($row)) {
            $row['dateModified'] = date("y-m-d h:i:s");
            
            $this->edit($row);
            pzk_notifier()->addMessage('Cập nhật thành công');
            $this->redirect('index');
           
        } else {
            pzk_validator()->setEditingData($row);
            $this->redirect('edit/' . pzk_request()->getId());
        }
    }
    public function addPostAction() {
        $row = $this->getAddData();
        if($this->validateAddData($row)) {
            $row['date'] = date("y-m-d h:i:s");
                $this->add($row);
                pzk_notifier()->addMessage('Cập nhật thành công');
           
        } else {
            pzk_validator()->setEditingData($row);
            $this->redirect('add');
        }
    }

}