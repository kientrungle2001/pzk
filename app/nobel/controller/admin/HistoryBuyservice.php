<?php
class PzkAdminHistoryBuyserviceController extends PzkGridAdminController {
	public $addFields = 'userId, serviceId, amount';
	public $editFields ='userId, serviceId, amount';
	public $table='history_buyservice';
	public $joins = array(
        array(
            'table' => 'user',
            'condition' => 'user.id = history_buyservice.userId',
            'type' =>''
        ),
        array(
            'table' => 'service_packages',
            'condition' => 'service_packages.id = history_buyservice.serviceId',
            'type' =>''
        )
    );
    public $selectFields = 'history_buyservice.*, user.username,service_packages.serviceName';
	public $sortFields = array(
		'id asc' => 'ID tăng',
		'id desc' => 'ID giảm'
	);
	public $searchFields = array('userId,serviceId');
	public $listFieldSettings = array(
		array(
			'index' => 'id',
			'type' => 'text',
			'label' => 'Id'
		),
		array(
			'index' => 'userId',
			'type' => 'text',
			'label' => 'userId '
		),
		array(
			'index' => 'username',
			'type' => 'text',
			'label' => 'Username'
		),
		array(
			'index' => 'serviceId',
			'type' => 'text',
			'label' => 'serviceId '
		),
		array(
			'index' => 'serviceName',
			'type' => 'text',
			'label' => 'Tên gói dịch vụ '
		),
		array(
			'index' => 'amount',
			'type' => 'text',
			'label' => 'Tổng tiền '
		),
		array(
			'index' => 'date',
			'type' => 'text',
			'label' => 'date '
		)
	);
	public $addLabel = 'Thêm mới';
	public $addFieldSettings = array(
		array(
			'index' => 'userId',
			'type' => 'text',
			'label' => 'UserId'
		),
		array(
			'index' => 'serviceId',
			'type' => 'text',
			'label' => 'ServiceId'
			
		),
		array(
			'index' => 'amount',
			'type' => 'text',
			'label' => 'Tổng tiền'
			
		)
	);
	public $editFieldSettings = array(
		array(
			'index' => 'userId',
			'type' => 'text',
			'label' => 'UserId'
		),
		array(
			'index' => 'serviceId',
			'type' => 'text',
			'label' => 'ServiceId'
			
		),
		array(
			'index' => 'amount',
			'type' => 'text',
			'label' => 'Tổng tiền'
			
		)
	);
	public $addValidator = array(
		'rules' => array(
			'userId' => array(
				'required' => true
			),
			'serviceId' => array(
				'required' => true
				
			),
			'amount' => array(
				'required' => true
				
			)

		),
		'messages' => array(
			'userId' => array(
				'required' => 'Mã user không được để trống'
				
			),
			'serviceId' => array(
				'required' => 'Mã dịch vụ không được để trống'
				
			),
			'amount' => array(
				'required' => 'Tổng tiền thanh toán không được để trống'
				
			)
		)
	);
	public $editValidator = array(
		'rules' => array(
			'userId' => array(
				'required' => true
			),
			'serviceId' => array(
				'required' => true
				
			),
			'amount' => array(
				'required' => true
				
			)

		),
		'messages' => array(
			'userId' => array(
				'required' => 'Mã user không được để trống'
				
			),
			'serviceId' => array(
				'required' => 'Mã dịch vụ không được để trống'
				
			),
			'amount' => array(
				'required' => 'Tổng tiền thanh toán không được để trống'
				
			)
		)
	);
    public function editPostAction() {
        $row = $this->getEditData();
       
        if($this->validateEditData($row)) {
        	$row['userId']=pzk_request('userId');
        	$row['serviceId']=pzk_request('serviceId');
            $row['userModified']=pzk_session('adminId');
            $row['dateModified']=date("Y-m-d H:i:s");
            $this->edit($row);
            pzk_notifier()->addMessage('Cập nhật thành công');
            $this->redirect('index');          
        
        } else {
            pzk_validator()->setEditingData($row);
            $this->redirect('edit/' . pzk_request('id'));
        }
    }
    public function addPostAction() {
        $row = $this->getAddData();
        if($this->validateAddData($row)) {
           	$row['userId']=pzk_request('userId');
        	$row['serviceId']=pzk_request('serviceId');
            $row['userAdd']=pzk_session('adminId');
            $row['dateAdd']=date("Y-m-d H:i:s");
            $this->add($row);
            pzk_notifier()->addMessage('Cập nhật thành công');
            $this->redirect('index');
        
        } else {
            pzk_validator()->setEditingData($row);
            $this->redirect('add');
        }
    }

}