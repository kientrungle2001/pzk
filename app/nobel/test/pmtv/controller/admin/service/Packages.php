<?php
class PzkAdminServicePackagesController extends PzkGridAdminController {
	public $addFields 	= 'id, serviceName, serviceType, duration, amount, software, scope, status';
	public $editFields 	= 'id, serviceName, serviceType, duration, amount, software, scope, status';
	public $table		=	'service_packages';
	public $sortFields 	= array(
		'id asc' 			=> 'ID tăng',
		'id desc' 			=> 'ID giảm',
		'serviceName asc' 	=> 'Tên dịch vụ tăng',
		'serviceName desc' 	=> 'Tên dịch vụ giảm',
		'amount asc' 		=> 'Đơn giá tăng',
		'amount desc' 		=> 'Đơn giá giảm'
	);
	public $searchFields = array('serviceName, id, amount');
	public $listFieldSettings = array(
		array(
			'index' 		=> 'serviceName',
			'type' 			=> 'text',
			'label' 		=> 'Tên dịch vụ'
		),
		array(
			'index' 		=> 'serviceType',
			'type' 			=> 'text',
			'label' 		=> 'Tên dịch vụ'
		),
		array(
			'index' 		=> 'duration',
			'type' 			=> 'text',
			'label' 		=> 'Số ngày dùng'
		),
		array(
			'index' 		=> 'import',
			'type' 			=> 'link',
			'label'			=> 'Nhập thẻ cào',
			'link' 			=> '/admin_service_packages/importCards/'
		),
		array(
			'index' 		=> 'scope',
			'type' 			=> 'text',
			'maps'        	=> array(
				'0'			=> 'Toàn bộ',
				'1'			=> 'Chỉ bài giảng',
				'2'			=> 'Chỉ bài tập'
			),
			
			'label' 		=> 'Phạm vi'
		),
		array(
			'index' 		=> 'amount',
			'type' 			=> 'price',
			'label' 		=> 'Đơn giá'
		),
		array(
			'index' 		=> 'created',
			'type' 			=> 'datetime',
			'label' 		=> 'Ngày nhập',
			'format'		=> 'd/m/Y H:i:s'
		),
		array(
			'index' 		=> 'modified',
			'type' 			=> 'datetime',
			'label' 		=> 'Ngày sửa',
			'format'		=> 'd/m/Y H:i:s'
		),
		array(
			'index' 		=> 'status',
			'type' 			=> 'status',
			'label' 		=> 'Trạng thái'
		),
	);
	public $addLabel = 'Thêm mới';
	public $addFieldSettings = array(
		array(
			'index' 		=> 'serviceName',
			'type' 			=> 'text',
			'label' 		=> 'Tên dịch vụ'
		),
		array(
			'index' 		=> 'serviceType',
			'type' 			=> 'text',
			'label' 		=> 'Loại'
		),
		array(
			'index' 		=> 'duration',
			'type' 			=> 'text',
			'label' 		=> 'Số ngày dùng'
		),
		array(
			'index' 		=> 'amount',
			'type' 			=> 'text',
			'label' 		=> 'Đơn giá'
		),
		array(
			'index' 		=> 'scope',
			'type' 			=> 'selectoption',
			'option'        => array(
				'0'		=> 'Toàn bộ',
				'1'		=> 'Chỉ bài giảng',
				'2'		=> 'Chỉ bài tập'
			),
			
			'label' 		=> 'Phạm vi'
		)
	);
	public $editFieldSettings = array(
		array(
			'index' 		=> 'serviceName',
			'type' 			=> 'text',
			'label' 		=> 'Tên dịch vụ'
		),
		array(
			'index' 		=> 'serviceType',
			'type' 			=> 'text',
			'label' 		=> 'Loại'
		),
		array(
			'index' 		=> 'duration',
			'type' 			=> 'text',
			'label' 		=> 'Số ngày dùng'
		),
		array(
			'index' 		=> 'amount',
			'type' 			=> 'text',
			'label' 		=> 'Đơn giá'
		),
		array(
			'index' 		=> 'scope',
			'type' 			=> 'selectoption',
			'option'        => array(
				'0'		=> 'Toàn bộ',
				'1'		=> 'Chỉ bài giảng',
				'2'		=> 'Chỉ bài tập'
			),
			
			'label' 		=> 'Phạm vi'
		)

	);
	public $addValidator = array(
		'rules' => array(
			'serviceName' 	=> array(
				'required' 	=> true
			),
			'amount' => array(
				'required' 	=> true
				
			),
		),
		'messages' => array(
			'serviceName' 	=> array(
				'required' 	=> 'Tên dịch vụ không được để trống'
				
			),
			'amount' => array(
				'required' 	=> 'Đơn giá không được để trống'
				
			)
		)
	);
	public $editValidator = array(
		'rules' => array(
			'serviceName' 	=> array(
				'required' 	=> true
			),
			'amount' 		=> array(
				'required' 	=> true
				
			),

		),
		'messages' => array(
			'serviceName' 	=> array(
				'required' 	=> 'Tên dịch vụ không được để trống'
				
			),
			'amount' => array(
				'required' 	=> 'Đơn giá không được để trống'
				
			)
		)
	);
	
	public function importCardsAction() {
		$this->render('admin/service_packages/import');
	}
	public function importCardPostAction($id) {
		$content 			= pzk_request()->getContent();
		$lines 				= preg_split('/[\r\n]+/', $content);
		foreach($lines as $line) {
			$line 			= trim($line);
			if($line) {
				$card 		= preg_split('/[\s\t,]+/', $line);
				$pincard 	= $card[0];
				$serial 	= $card[1];
				$entity 	= _db()->getTableEntity('card_nextnobels');
				$entity->setData(array(
					'serviceId'		=>	$id,
					'pincard'		=> 	$pincard,
					'serial'		=> 	$serial,
					'status'		=> 	1
				));
				$entity->save();
			}
		}
		$this->redirect('admin_cardnexnobels/index');
	}
}