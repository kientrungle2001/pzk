<?php
class PzkAdminHistoryBuyserviceController extends PzkGridAdminController {
	public $title = 'Dịch vụ đang dùng';
	public $addFields = 'userId, serviceId, orderId,typePayment,dateActive,dateEnd,status';
	public $editFields ='userId, serviceId, orderId,typePayment,dateActive,dateEnd,status';
	public $table='history_buyservice';
	public $logable = true;
	public $logFields = 'userId, serviceId, orderId,typePayment,dateActive,dateEnd,status';
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
        ),
		array(
			'table' => '`admin` as `creator`',
			'condition' => '`history_buyservice`.creatorId = creator.id',
			'type' => 'left'
		),
		array(
			'table' => '`admin` as `modifier`',
			'condition' => '`history_buyservice`.modifiedId = modifier.id',
			'type' => 'left'
		)
    );
    public $selectFields = 'history_buyservice.*, user.username as username,service_packages.serviceName as serviceName, creator.name as creatorName, modifier.name as modifiedName';
	public $sortFields = array(
		'id asc' => 'ID tăng',
		'id desc' => 'ID giảm'
	);
	public $searchFields = array('userId','serviceId');
	public $listFieldSettings = array(
		
		array(
			'index' => 'username',
			'type' => 'text',
			'label' => 'Tên đăng nhập '
		),
		array(
			'index' => 'orderId',
			'type' => 'text',
			'label' => 'Mã đơn hàng'
		),
		array(
			'index' => 'serviceName',
			'type' => 'text',
			'label' => 'Tên dịch vụ '
		),
		array(
			'index' => 'typePayment',
			'type' => 'text',
			'label' => 'Kiểu thanh toán'
		),
		array(
			'index' => 'dateActive',
			'type' => 'datetime',
			'format'	=> 'd/m/Y',
			'label' => 'Ngày kích hoạt'
		),
		array(
			'index' => 'dateEnd',
			'type' => 'datetime',
			'format'	=> 'd/m/Y',
			'label' => 'Ngày kết thúc'
		),
		array(
			'index' => 'status',
			'type' => 'workflow',
			'states'=>array(
				'1' =>'Thành công',
				'0'=>'Thất bại',
				'-1'=>'Đã huỷ'
			),
			'label' => 'Trạng thái '
		),
		array(
			'index'	=> 'none4',
			'type'	=> 'group',
			'label'	=> '<br />Người tạo<br />Người sửa',
			'delimiter'	=> '<br />',
			'fields'	=> array(
				array(
					'index' => 'creatorName',
					'type' => 'text',
					'label' => 'Người tạo'
				),
				array(
					'index' => 'modifiedName',
					'type' => 'text',
					'label' => 'Người sửa'
				),
			)
		),
		array(
			'index'	=> 'none5',
			'type'	=> 'group',
			'label'	=> '<br />Ngày tạo<br />Ngày sửa',
			'delimiter'	=> '<br />',
			'fields'	=> array(
				array(
					'index' => 'created',
					'type' => 'datetime',
					'label' => 'Ngày tạo',
					'format'	=> 'H:i d/m'
				),
				array(
					'index' => 'modified',
					'type' => 'datetime',
					'label' => 'Ngày sửa',
					'format'	=> 'H:i d/m'
				),
			)
		),
	);
	/*public $addLabel = 'Thêm mới';
	public $addFieldSettings = array(
		array(
			'index' => 'userId',
			'type' => 'text',
			'label' => 'userId '
		),
		array(
			'index' => 'orderId',
			'type' => 'text',
			'label' => 'orderId'
		),
		array(
			'index' => 'serviceId',
			'type' => 'text',
			'label' => 'serviceId '
		),
		array(
			'index' => 'typePayment',
			'type' => 'text',
			'label' => 'Kiểu thanh toán'
		),
		array(
			'index' => 'dateActive',
			'type' => 'text',
			'label' => 'Ngày kích hoạt'
		),
		array(
			'index' => 'dateEnd',
			'type' => 'text',
			'label' => 'Ngày kết thúc'
		),
		array(
			'index' => 'status',
			'type' => 'text',
			'label' => 'Trạng thái '
		)
	);
	public $editFieldSettings = array(
		array(
			'index' => 'userId',
			'type' => 'text',
			'label' => 'userId '
		),
		array(
			'index' => 'orderId',
			'type' => 'text',
			'label' => 'orderId'
		),
		array(
			'index' => 'serviceId',
			'type' => 'text',
			'label' => 'serviceId '
		),
		array(
			'index' => 'typePayment',
			'type' => 'text',
			'label' => 'Kiểu thanh toán'
		),
		array(
			'index' => 'dateActive',
			'type' => 'text',
			'label' => 'Ngày kích hoạt'
		),
		array(
			'index' => 'dateEnd',
			'type' => 'text',
			'label' => 'Ngày kết thúc'
		),
		array(
			'index' => 'status',
			'type' => 'text',
			'label' => 'Trạng thái '
		)
	);
	public $addValidator = array(
		'rules' => array(
			'userId' => array(
				'required' => true
			),
			'serviceId' => array(
				'required' => true
				
			)
		),
		'messages' => array(
			'userId' => array(
				'required' => 'Mã người dùng không được để trống'
				
			),
			'serviceId' => array(
				'required' => 'Mã dịch vụ không được để trống'
				
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
				
			)
		),
		'messages' => array(
			'userId' => array(
				'required' => 'Mã người dùng không được để trống'
				
			),
			'serviceId' => array(
				'required' => 'Mã dịch vụ không được để trống'
				
			)
		)
	);
    public function editPostAction() {
        $row = $this->getEditData();
       
        if($this->validateEditData($row)) {
        	$row['userId']=pzk_request('userId');
        	$row['serviceId']=pzk_request('serviceId');
            
            $row['modifiedId']=pzk_session('userId');
            $row['modified']=date("Y-m-d H:i:s");
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
            $row['creatorId']=pzk_session('userId');
            $row['created']=date("Y-m-d H:i:s");
            $this->add($row);
            pzk_notifier()->addMessage('Cập nhật thành công');
            $this->redirect('index');
        
        } else {
            pzk_validator()->setEditingData($row);
            $this->redirect('add');
        }
    }*/

}