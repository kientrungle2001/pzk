<?php
class PzkAdminServicePolicyController extends PzkGridAdminController {
	public $addFields = 'serviceId, discount, note, startDate, endDate,modifiedUser,modifileDate,addUser,addDate';
	public $editFields ='serviceId, discount, note, startDate, endDate,modifiedUser,modifileDate,addUser,addDate';
	public $table='service_policy';
	public $joins = array(
     
        array(
            'table' => 'service_packages',
            'condition' => 'service_policy.serviceId = service_packages.id',
            'type' =>''
        )
    );
    public $selectFields = 'service_policy.*,service_packages.serviceName as serviceName';
	public $sortFields = array(
		'id asc' => 'ID tăng',
		'id desc' => 'ID giảm',
		'serviceId asc' => 'serviceId tăng',
		'serviceId desc' => 'serviceId giảm',
		'note asc' => 'note tăng',
		'note desc' => 'note giảm',
		'startDate asc' => 'startDate tăng',
		'startDate desc' => 'startDate giảm',
		'endDate asc' => 'endDate tăng',
		'endDate desc' => 'endDate giảm',
		'modifiedUser asc' => 'modifiedUser tăng',
		'modifiedUser desc' => 'modifiedUser giảm',
		'modifileDate asc' => 'modifileDate tăng',
		'modifileDate desc' => 'modifileDate giảm'
	);
	public $searchFields = array('id,serviceId, startDate, endDate,modifiedUser, modifileDate,note, addUser, addDate ');
	public $listFieldSettings = array(
	
		array(
			'index' => 'serviceId',
			'type' => 'text',
			'label' => 'Mã dịch vụ '
		),
		array(
			'index' => 'serviceName',
			'type' => 'text',
			'label' => 'Tên dịch vụ'
		),
		array(
			'index' => 'discount',
			'type' => 'text',
			'label' => 'Giảm giá(tính theo %) '
		),
		
		array(
			'index' => 'note',
			'type' => 'text',
			'label' => 'Ghi chú'
		),
		array(
			'index' => 'startDate',
			'type' => 'text',
			'label' => 'Ngày bắt đầu '
		),
		array(
			'index' => 'endDate',
			'type' => 'text',
			'label' => 'Ngày kết thúc'
		)
	);
	public $addLabel = 'Thêm mới';
	public $addFieldSettings = array(
		
		array(
			'index' => 'serviceId',
			'type' => 'text',
			'label' => 'Mã dịch vụ '
		),
	
		array(
			'index' => 'discount',
			'type' => 'text',
			'label' => 'Giảm giá(tính theo %) '
		),
	
		array(
			'index' => 'note',
			'type' => 'text',
			'label' => 'Ghi chú'
		),
		array(
			'index' => 'startDate',
			'type' => 'text',
			'label' => 'Ngày bắt đầu '
		),
		array(
			'index' => 'endDate',
			'type' => 'text',
			'label' => 'Ngày kết thúc'
		)
	);
	public $editFieldSettings = array(
		
		array(
			'index' => 'serviceId',
			'type' => 'text',
			'label' => 'Mã dịch vụ '
		),
		
		array(
			'index' => 'discount',
			'type' => 'text',
			'label' => 'Giảm giá(tính theo %) '
		),
	
		array(
			'index' => 'note',
			'type' => 'text',
			'label' => 'Ghi chú'
		),
		array(
			'index' => 'startDate',
			'type' => 'text',
			'label' => 'Ngày bắt đầu '
		),
		array(
			'index' => 'endDate',
			'type' => 'text',
			'label' => 'Ngày kết thúc'
		)
	);
	public $addValidator = array(
		'rules' => array(
			'serviceId' => array(
				'required' => true
			),
			
			'discount' => array(
				'required' => true
				
			),
			'startDate' => array(
				'required' => true
				
			),
			'endDate' => array(
				'required' => true
				
			)

		),
		'messages' => array(
			'serviceId' => array(
				'required' => 'Mã dịch vụ không được để trống'
				
			),
			'discount' => array(
				'required' => 'Giảm giá không được để trống'
				
			),
			'startDate' => array(
				'required' => 'Ngày bắt đầu không được để trống'
				
			),
			'starEnd' => array(
				'required' => 'Ngày kết thúc không được để trống'
				
			)
		)
	);
	public $editValidator = array(
		'rules' => array(
			'serviceId' => array(
				'required' => true
			),
			
			'discount' => array(
				'required' => true
				
			),
			'startDate' => array(
				'required' => true
				
			),
			'endDate' => array(
				'required' => true
				
			)

		),
		'messages' => array(
			'serviceId' => array(
				'required' => 'Mã dịch vụ không được để trống'
				
			),
			'discount' => array(
				'required' => 'Giảm giá không được để trống'
				
			),
			'startDate' => array(
				'required' => 'Ngày bắt đầu không được để trống'
				
			),
			'starEnd' => array(
				'required' => 'Ngày kết thúc không được để trống'
				
			)
		)
	);
    public function editPostAction() {
        $row = $this->getEditData();
       
        if($this->validateEditData($row)) {
        	
            $row['modifiedUser']=pzk_session('adminId');
            $row['modifiedDate']=date("Y-m-d H:i:s");
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
           	$row['addUser']=pzk_session('adminId');
            $row['addDate']=date("Y-m-d H:i:s");
            $this->add($row);
            pzk_notifier()->addMessage('Cập nhật thành công');
            $this->redirect('index');
        
        } else {
            pzk_validator()->setEditingData($row);
            $this->redirect('add');
        }
    }

}