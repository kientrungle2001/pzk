<?php
class PzkAdminServiceServicepackagesController extends PzkGridAdminController {
	public $addFields 	= 	'id, serviceName,serviceType,testDate, amount, software,site,contestId,categoryIds,duration,languages';
	public $editFields 	= 	'id, serviceName,serviceType,testDate, amount,software,site,contestId,categoryIds,duration,languages';
	public $table		=	'service_packages';
	public $sortFields 	= 	array(
		'id asc' 			=> 'ID tăng',
		'id desc' 			=> 'ID giảm',
		'serviceName asc' 	=> 'Tên dịch vụ tăng',
		'serviceName desc' 	=> 'Tên dịch vụ giảm',
		'amount asc' 		=> 'Đơn giá tăng',
		'amount desc' 		=> 'Đơn giá giảm'
	);
	/*public $joins = array(
					'table' 	=> 	'contest',
					'condition' => 	'service_packages.contestId = contest.id',
					'type' 		=>	'left'
	);*/
	/*public $selectFields = 'service_packages.*, contest.id,contest.name as contestName';*/
	public $searchFields 	= array('serviceName, id,serviceType, amount, languages');
	public $listFieldSettings 	= array(
		array(
			'index' 		=> 'contestId',
			'type' 			=> 'text',
			'label' 		=> 'Mã cuộc thi'
		),
		array(
			'index' 		=> 'serviceName',
			'type' 			=> 'text',
			'label' 		=> 'Tên dịch vụ'
		),
		array(
			'index' 		=> 'serviceType',
			'type' 			=> 'text',
			'label' 		=> 'Loại dịch vụ'
		),
		array(
			'index' 		=> 'amount',
			'type' 			=> 'text',
			'label' 		=> 'Đơn giá'
		),
		array(
			'index' 		=> 'categoryIds',
			'type' 			=> 'text',
			'label' 		=> 'Danh muc'
		),
		array(
			'index' 		=> 'languages',
			'type' 			=> 'text',			
			'label' 		=> 'Ngôn ngữ'
		),
		array(
			'index' 		=> 'duration',
			'type' 			=> 'text',
			'label' 		=> 'Thời gian'
		),
		array(
			'index' 		=> 'software',
			'type' 			=> 'text',
			'label' 		=> 'Phần mềm'
		),
		array(
			'index' 		=> 'expiredDate',
			'type' 			=> 'text',
			'label' 		=> 'Ngày hết hạn'
		),
		array(
			'index' 		=> 'created',
			'type' 			=> 'text',
			'label' 		=> 'Ngày nhập'
		),
		array(
			'index' 		=> 'dateModified',
			'type' 			=> 'text',
			'label' 		=> 'Ngày sửa'
		)
	);
	public $addLabel = 'Thêm mới';
	public $addFieldSettings = array(
		array(
			'index' 		=> 'contestId',
			'type' 			=> 'select',
			'label' 		=> 'Tên cuộc thi',
			'table' 		=> 'contest',
			'show_value' 	=> 'id',
			'show_name'  	=> 'name'
		),
		array(
			'index' 		=> 'serviceName',
			'type' 			=> 'text',
			'label' 		=> 'Tên dịch vụ(gói dịch vụ)'
		),
		array(
			'index' 		=> 'serviceType',
			'type' 			=> 'selectoption',
			'option'		=> array(
				'full'		=> 'Full Look hoặc FullLook song ngữ',
				
				'contest'	=> 'Gói thi',
				'view'		=>  'Gói xem đề'
			),

			'label' 		=> 'Loại dịch vụ'
		),
		array(
			'index' 		=> 'amount',
			'type' 			=> 'text',
			'label' 		=> 'Đơn giá'
		),
		array(
			'index' 		=> 'languages',
			'type' 			=> 'selectoption',
			'option'        => array(
				'en'		=> 'Tiếng Anh',
				'vn'		=> 'Tiếng Việt',
				'ev'		=> 'Song ngữ Anh- Việt'
			),
			
			'label' 		=> 'Ngôn ngữ'
		),
		array(
			'index' 		=> 'duration',
			'type' 			=> 'selectoption',
			'option'		=> array(
				'30'		=> '1 tháng',
				'150'		=> '5 tháng',
				'180'		=> '6 tháng',
				'365'		=> '1 năm'
			),
			'label' 		=> 'Thời gian'
		),
		array(
			'index' 		=> 'software',
			'type' 			=> 'text',
			'label' 		=> 'Phần mềm'
		),
		array(
			'index' 		=> 'expiredDate',
			'type' 			=> 'date',
			'label' 		=> 'Ngày hết hạn'
		),
		array(
			'index' 		=> 'categoryIds',
			'type' 			=> "multiselect",
			'label' 		=> "Chọn danh mục",
			'table' 		=> "categories",
			'show_value' 	=> "id",
			'show_name' 	=> 'name',
			'mdsize'		=> 12
		),
	);
	public $editFieldSettings = array(
		array(
			'index' 		=> 'contestId',
			'type' 			=> 'select',
			'label' 		=> 'Tên cuộc thi',
			'table' 		=> 'contest',
			'show_value' 	=> 'id',
			'show_name'  	=> 'name'
		),
		array(
			'index' 		=> 'serviceName',
			'type' 			=> 'text',
			'label' 		=> 'Tên dịch vụ(gói dịch vụ)'
		),
		array(
			'index' 		=> 'serviceType',
			'type' 			=> 'selectoption',
			'option'		=> array(
				'full'		=> 'Full Look hoặc FullLook song ngữ',
				
				'contest'	=> 'Gói thi',
				'view'		=>  'Gói xem đề'
			),

			'label' 		=> 'Loại dịch vụ'
		),
		array(
			'index' 		=> 'amount',
			'type' 			=> 'text',
			'label' 		=> 'Đơn giá'
		),
		array(
			'index' 		=> 'languages',
			'type' 			=> 'selectoption',
			'option'        => array(
				'en'		=> 'Tiếng Anh',
				'vn'		=> 'Tiếng Việt',
				'ev'		=> 'Song ngữ Anh- Việt'
			),
			
			'label' 		=> 'Ngôn ngữ'
		),
		
		array(
			'index' 		=> 'duration',
			'type' 			=> 'selectoption',
			'option'		=> array(
				'30'		=> '1 tháng',
				'150'		=> '5 tháng',
				'180'		=> '6 tháng',
				'365'		=> '1 năm'
			),
			'label' 		=> 'Thời gian'
		),
		array(
			'index' 		=> 'software',
			'type' 			=> 'text',
			'label' 		=> 'Phần mềm'
		),
		array(
			'index' 		=> 'expiredDate',
			'type' 			=> 'date',
			'label' 		=> 'Ngày hết hạn'
		),
		array(
			'index' 		=> 'categoryIds',
			'type' 			=> "multiselect",
			'label' 		=> "Chọn danh mục",
			'table' 		=> "categories",
			'show_value' 	=> "id",
			'show_name' 	=> 'name',
			'mdsize'		=> 12
		),
	);
	public $addValidator = array(
		'rules' => array(
			'serviceName' 	=> array(
				'required' 		=> true
			),
			'amount' 		=> array(
				'required' 		=> true
				
			)

		),
		'messages' => array(
			'serviceName' 	=> array(
				'required' 		=> 'Tên dịch vụ không được để trống'
				
			),
			'amount' 		=> array(
				'required' 		=> 'Đơn giá không được để trống'
				
			)
		)
	);
	public $editValidator = array(
		'rules' => array(
			'serviceName' 	=> array(
				'required' 		=> true
			),
			'amount' 		=> array(
				'required' 		=> true
				
			)

		),
		'messages' 			=> array(
			'serviceName' 		=> array(
				'required' 			=> 'Tên dịch vụ không được để trống'
				
			),
			'amount' 		=> array(
				'required' 		=> 'Đơn giá không được để trống'
				
			)
		)
	);
    public function editPostAction() {
        $row 		= $this->getEditData();
        if($this->validateEditData($row)) {
        	if(pzk_request('siteId')){
        		$row['site']	= pzk_request('siteId');
        	}
			$row['modified'] 	= date("Y-m-d h:i:s");            
			$this->edit($row);
			pzk_notifier()->addMessage('Cập nhật thành công');
			$this->redirect('index');
        } else {
            pzk_validator()->setEdittingData($row);
            $this->redirect('edit/' . pzk_request('id'));
        }
    }
    public function addPostAction() {
        $row = $this->getAddData();
        if($this->validateAddData($row)) {
        	if(pzk_request('siteId')){
        		$row['site']	= pzk_request('siteId');
        	}
        		$row['created'] = date("Y-m-d h:i:s");
            	$row['status'] 	=1;
            	
                $this->add($row);
                pzk_notifier()->addMessage('Cập nhật thành công');
           		$this->redirect('index');
        	
        } else {
            pzk_validator()->setEdittingData($row);
            $this->redirect('add');
        }
    }

}