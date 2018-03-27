<?php
class PzkAdminServicePackagesController extends PzkGridAdminController {
	public $title = 'Gói dịch vụ';
	public $addFields = 'serviceName, amount,serviceType,status';
	public $editFields = 'serviceName, amount,serviceType,status';
	public $table='service_packages';
	public $logable = true;
	public $logFields = 'serviceName, amount,serviceType,status';
	public $sortFields = array(
		'id asc' => 'ID tăng',
		'id desc' => 'ID giảm',
		'serviceName asc' => 'Tên dịch vụ tăng',
		'serviceName desc' => 'Tên dịch vụ giảm',
		'serviceType asc' => 'Loại dịch vụ tăng',
		'serviceType desc' => 'Loại dịch vụ giảm'
		
	);
	public $joins = array(
		array(
			'table' => 'campaign',
			'condition' => 'service_packages.campaignId = campaign.id',
			'type' => 'left'
		),
		array(
			'table' => '`admin` as `creator`',
			'condition' => 'service_packages.creatorId = creator.id',
			'type' => 'left'
		),
		array(
			'table' => '`admin` as `modifier`',
			'condition' => 'service_packages.modifiedId = modifier.id',
			'type' => 'left'
		),
	);
	public $selectFields = 'service_packages.*, campaign.campaignName as campaignName,creator.name as creatorName, modifier.name as modifiedName';
	public $searchFields = array('serviceName','amount','serviceType');
	public $filterFields = array(

        array(
            'index' => 'serviceType',
            'type' => 'selectoption',
            'option' => array(
  
                'goihoc' => 'Gói học',
                'goicham' => 'Gói chấm'
            ),
            'label' =>'Gói dịch vụ'
        )
    );
	public $listFieldSettings = array(
		array(
			'index' => 'serviceName',
			'type' => 'text',
			'label' => 'Tên dịch vụ'
		),
		array(
			'index' => 'serviceType',
			'type' => 'text',
			'label' => 'Loại dịch vụ'
		),
		array(
			'index' => 'amount',
			'type' => 'price',
			'label' => 'Đơn giá'
		),
		array(
			'index' => 'status',
			'type' => 'workflow',
			'label' => 'Trạng thái',
			'states' => array(
				'0' => 'Không hoạt động',
				'1' => 'Hoạt động',
				'-1' => 'Dừng hoạt động'
			),
			'rules' => array(
				'0' => array('1' => array('action' => 'Kích hoạt')),
				'1' => array(
					'0' => array('action' => 'Khóa'),
					'-1' => array('action' =>  'Tạm dừng')),
				'-1' => array(
					'1' => array('action' => 'Mở lại')
				)
			),
			'bgcolor' => '',
			'color' => ''
		),
		array(
            'index' => 'campaignName',
            'type' => 'text',
            'label' => 'Tên chiến dịch'
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
	public $addLabel = 'Thêm mới';
	public $addFieldSettings = array(
		array(
			'index' => 'serviceName',
			'type' => 'text',
			'label' => 'Tên dịch vụ'
		),
		array(
			'index' => 'serviceType',
			'type' => 'selectoption',
			'option'=>array(
				'goihoc'=>'Gói học',
				'goicham'=>'Gói chấm'
				),
			'label' => 'Loại dịch vụ'
		),
		array(
			'index' => 'amount',
			'type' => 'text',
			'label' => 'Đơn giá'
		),
		array(
			'index' => 'status',
			'type' => 'status',
			'options'=>array(
				'0'=> 'Chưa kích hoạt',
				'1'=> 'Kích hoạt'
			),
			'label' => 'Trạng thái'
		)
	);
	public $editFieldSettings = array(
		array(
			'index' => 'serviceName',
			'type' => 'text',
			'label' => 'Tên dịch vụ'
		),
		array(
			'index' => 'serviceType',
			'type' => 'selectoption',
			'option'=>array(
				'goihoc'=>'Gói học',
				'goicham'=>'Gói chấm'
				),
			'label' => 'Loại dịch vụ'
		),
		array(
			'index' => 'amount',
			'type' => 'text',
			'label' => 'Đơn giá'
		),
		array(
			'index' => 'status',
			'type' => 'status',
			'label' => 'Trạng thái',
			'options'=>array(
				'0'=>'Chưa kích hoạt',
				'1'=>'Đã kích hoạt'
			)
		),
	);
	public $addValidator = array(
		'rules' => array(
			'serviceName' => array(
				'required' => true
			),
			'serviceType' => array(
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
			'serviceType' => array(
				'required' => 'Loại dịch vụ không được để trống'
				
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
			'serviceType' => array(
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
			'serviceType' => array(
				'required' => 'Loại dịch vụ không được để trống'
				
			),
			'amount' => array(
				'required' => 'Đơn giá không được để trống'
				
			)
		)
	);
    public function editPostAction() {
        $row = $this->getEditData();
        if($this->validateEditData($row)) {
            $row['modified'] = date("y-m-d h:i:s");
            $row['modifiedId'] = pzk_session('userId');
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
            $row['creatorId'] = pzk_session('userId');
            $row['created'] =date("y-m-d h:i:s");
                $this->add($row);
				pzk_notifier()->addMessage('Cập nhật thành công');
				$this->redirect('index');
           
        } else {
            pzk_validator()->setEditingData($row);
            $this->redirect('add');
        }
    }

}