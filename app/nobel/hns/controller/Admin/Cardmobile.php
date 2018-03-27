<?php
class PzkAdminCardmobileController extends PzkGridAdminController {
	public $addFields = 'id, username, typecard, pincard,serialcard,cardAmount,amount,date,status';
	public $editFields = 'id, username, typecard, pincard,serialcard,cardAmount,amount,date,status';
	public $table='cardmobile';
	public $sortFields = array(
		'id asc' => 'ID tăng',
		'id desc' => 'ID giảm',
		'username asc' => 'Tên đăng nhập tăng',
		'username desc' => 'Tên đăng nhập giảm',
		'date asc' => 'Ngày nhập tăng',
		'date desc' => 'Ngày nhập giảm',
		
	);
	public $searchFields = array('username', 'id', 'date', 'pincard', 'typecard', 'cardAmount');
	public $listFieldSettings = array(
		array(
			'index' => 'username',
			'type' => 'text',
			'label' => 'Tên đăng nhập'
		),
		array(
			'index' => 'pincard',
			'type' => 'text',
			'label' => 'PinCard'
		),
		array(
			'index' => 'serialcard',
			'type' => 'text',
			'label' => 'serialCard'
		),
		array(
			'index' => 'typecard',
			'type' => 'text',
			'label' => 'Loại thẻ'
		),
		array(
			'index' => 'cardAmount',
			'type' => 'text',
			'label' => 'Mệnh giá thẻ'
		),
		array(
			'index' => 'date',
			'type' => 'text',
			'label' => 'Thời gian nạp'
		)
	);


}