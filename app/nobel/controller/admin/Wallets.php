<?php
class PzkAdminWalletsController extends PzkGridAdminController {
	public $addFields = 'username, amount';
	public $editFields ='username, amount';
	public $table='wallets';
	public $sortFields = array(
		'id asc' => 'ID tăng',
		'id desc' => 'ID giảm',
		'username asc' => 'Tên đăng nhập tăng',
		'username desc' => 'Tên đăng nhập giảm'
	);
	public $searchFields = array('username');
	public $listFieldSettings = array(
		array(
			'index' => 'username',
			'type' => 'text',
			'label' => 'Tên đăng nhập'
		),
		array(
			'index' => 'amount',
			'type' => 'text',
			'label' => 'Tổng số tiền '
		)
	);
	public $addLabel = 'Thêm vào ví';
	public $addFieldSettings = array(
		array(
			'index' => 'username',
			'type' => 'text',
			'label' => 'Tên đăng nhập'
		),
		array(
			'index' => 'amount',
			'type' => 'text',
			'label' => 'Tổng số tiền '
		)
	);
	public $editFieldSettings = array(
		array(
			'index' => 'username',
			'type' => 'text',
			'label' => 'Tên đăng nhập'
		),
		array(
			'index' => 'amount',
			'type' => 'text',
			'label' => 'Tổng số tiền '
		)
	);
	public $addValidator = array(
		'rules' => array(
			'username' => array(
				'required' => true
			),
			'amount' => array(
			'required' => true
			
			)

		),
		'messages' => array(
			'username' => array(
				'required' => 'Tên người dùng không được để trống'
				
			),
			'amount' => array(
				'required' => 'Yêu cầu nhập tổng số tiền',
				
			)
		)
	);
	public $editValidator = array(
		'rules' => array(
			'username' => array(
				'required' => true
			),
			'amount' => array(
			'required' => true
			
			)

		),
		'messages' => array(
			'username' => array(
				'required' => 'Tên người dùng không được để trống'
				
			),
			'amount' => array(
				'required' => 'Yêu cầu nhập tổng số tiền',
				
			)
		)
	);
}