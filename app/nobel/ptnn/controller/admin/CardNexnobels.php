<?php
class PzkAdminCardNexnobelsController extends PzkGridAdminController {
    public $title = 'Quản lý Thẻ cào';
	public $addFields = 'serviceId,pincard, serial, price,discount,status';
    public $editFields = 'serviceId, serial, price,discount,status';
    public $table='card_nextnobels';
    public $sortFields = array(
        'id asc' => 'ID tăng',
        'id desc' => 'ID giảm'
       
    );
	public $joins = array(
     
        array(
            'table' => 'service_packages',
            'condition' => 'card_nextnobels.serviceId = service_packages.id',
            'type' =>''
        ),
		array(
			'table' => 'campaign',
			'condition' => 'card_nextnobels.campaignId = campaign.id',
			'type' => 'left'
		),
		array(
			'table' => '`admin` as `creator`',
			'condition' => 'card_nextnobels.creatorId = creator.id',
			'type' => 'left'
		),
		array(
			'table' => '`admin` as `modifier`',
			'condition' => 'card_nextnobels.modifiedId = modifier.id',
			'type' => 'left'
		),
    );
	public $selectFields = 'card_nextnobels.*, service_packages.serviceName as serviceName, service_packages.serviceType as serviceType, campaign.campaignName as campaignName,creator.name as creatorName, modifier.name as modifiedName';
	public $logable = true;
	public $logFields = 'serviceId, serial, price,discount,status';
    public $searchFields = array('pincard,serial,serviceId,price,discount,status');
    public $listFieldSettings = array(
        array(
            'index' => 'serviceName',
            'type' => 'text',
            'label' => 'Mã dịch vụ'
        ),
        array(
            'index' => 'pincard',
            'type' => 'text',
            'label' => 'Mã thẻ'
        ),
        array(
            'index' => 'serial',
            'type' => 'text',
            'label' => 'Serial '
        ),
        array(
            'index' => 'price',
            'type' => 'price',
            'label' => 'Giá '
        ),
        array(
            'index' => 'discount',
            'type' => 'text',
            'label' => 'Giảm giá (%)'
        ),
        array(
            'index' => 'status',
            'type' => 'text',
            'label' => 'Trạng thái',
			'maps'	=> array(
				'0'	=> 'Chưa dùng',
				'1'	=> 'Đã dùng'
			)
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
            'index' => 'serviceId',
            'type' => 'select',            
            'table'=>'service_packages',
            'show_value'=>'id',
            'show_name'=>'serviceName',
            'label' => 'Mã dịch vụ'
        ),
        array(
            'index' => 'pincard',
            'type' => 'text',
            'label' => 'Mã thẻ'
        ),
        array(
            'index' => 'serial',
            'type' => 'text',
            'label' => 'Serial '
        ),
        array(
            'index' => 'price',
            'type' => 'text',
            'label' => 'Giá '
        ),
        array(
            'index' => 'discount',
            'type' => 'text',
            'label' => 'Giảm giá (%) '
        ),
        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái '
        )
    );
    public $editFieldSettings = array(
        array(
            'index' => 'serviceId',
            'type' => 'select',
            'table'=>'service_packages',
            'show_value'=>'id',
            'show_name'=>'serviceName',
            'label' => 'Mã dịch vụ'
        ),
        
        array(
            'index' => 'serial',
            'type' => 'text',
            'label' => 'Serial '
        ),
        array(
            'index' => 'price',
            'type' => 'text',
            'label' => 'Giá '
        ),
        array(
            'index' => 'discount',
            'type' => 'text',
            'label' => 'Giảm giá (%)'
        ),
        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái '
        )
    );
    public $addValidator = array(
        'rules' => array(
            'serviceId' => array(
                'required' => true
            ),
            'pincard' => array(
                'required' => true
            ),
            'serial' => array(
                'required' => true
               
            ),
            'price' => array(
                'required' => true
               
            )
        ),
        'messages' => array(
            'serviceId' => array(
                'required' => 'Mã dịch vụ không được để trống'
                
            ),
            'pincard' => array(
                'required' => 'Pincard không được để trống'
                
            ),
            'serial' => array(
                'required' => 'Serial không được để trống'
                
            ),
            'price' => array(
                'required' => ' price không được để trống'
               
            )
        )
    );
    public $editValidator = array(
        'rules' => array(
            'serviceId' => array(
                'required' => true
            ),
            'serial' => array(
                'required' => true
               
            ),
            'price' => array(
                'required' => true
               
            )

        ),
        'messages' => array(
            'serviceId' => array(
                'required' => 'Mã dịch vụ không được để trống'
                
            ),
            'serial' => array(
                'required' => 'Serial không được để trống'
                
            ),
            'price' => array(
                'required' => ' price không được để trống'
               
            )
        )
    );
    public function editPostAction() {
        $row = $this->getEditData();
        //$pincard=trim(pzk_request('pincard'));
        if($this->validateEditData($row)) {       
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
            $pincard = trim(pzk_request('pincard'));
            if($pincard) {
                $row['pincard'] = md5($pincard);
                $row['creatorId']=pzk_session('userId');
                $row['created']=date("Y-m-d H:i:s");
                
                $this->add($row);

                pzk_notifier()->addMessage('Cập nhật thành công');
                $this->redirect('index');
            } else {
                pzk_validator()->setEditingData($row);
                $this->redirect('add');
            }
        } else {
            pzk_validator()->setEditingData($row);
            $this->redirect('add');
        }
    }

}