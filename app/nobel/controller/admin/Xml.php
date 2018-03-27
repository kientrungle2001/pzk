<?php
class PzkAdminXmlController extends PzkXmlAdminController {
	public $menuLinks = array(
			array(
					'name' => 'Tạo Database',
					'href' => '/admin_xml/edit?config=core_database'
			),
			array(
					'name' => 'Tạo email sender',
					'href' => '/admin_xml/edit?config=core_mailer'
			),
			array(
					'name' => 'Tạo Ngân Lượng',
					'href' => '/admin_xml/edit?config=nganluong'
			),
			array(
					'name' => 'Tạo Chuyển Khoản',
					'href' => '/admin_xml/edit?config=bankTransfer'
			),
			array(
					'name' => 'Tạo hỗ trợ khách hàng',
					'href' => '/admin_xml/edit?config=support'
			),
			array(
					'name' => 'Tạo thống kê truy cập',
					'href' => '/admin_xml/edit?config=stat'
			)
	);
	public $core_databaseFields = array('host', 'user', 'password', 'dbName');
	public $core_databaseFieldSettings = array(
			array(
					'index' => 'host',
					'type' => 'text',
					'label' => 'Tên host'
			),
			array(
					'index' => 'user',
					'type' => 'text',
					'label' => 'Tên user'
			),
			array(
					'index' => 'password',
					'type' => 'password',
					'label' => 'Password'
			),
			array(
					'index' => 'dbName',
					'type' => 'text',
					'label' => 'Tên database'
			)
	);
	
	public $core_mailerFields = array('host', 'user', 'password', 'port');
	public $core_mailerFieldSettings = array(
			array(
					'index' => 'host',
					'type' => 'text',
					'label' => 'Tên host'
			),
			array(
					'index' => 'user',
					'type' => 'text',
					'label' => 'Tên user'
			),
			array(
					'index' => 'password',
					'type' => 'password',
					'label' => 'Password'
			),
			array(
					'index' => 'port',
					'type' => 'text',
					'label' => 'Port'
			)
	);
	public $nganluongFields = array('nganluong_merchant');
	public $nganluongFieldSettings = array(
			array(
					'index' => 'nganluong_merchant',
					'type' => 'text',
					'label' => 'Merchant'
			)
	);
	public $bankTransferFields = array('bank_number','bank_user','bank_name','bank_place','bank_content');
	public $bankTransferFieldSettings = array(
			array(
					'index' => 'bank_number',
					'type' => 'text',
					'label' => 'Số tài khoản'
			),
			array(
					'index' => 'bank_user',
					'type' => 'text',
					'label' => 'Chủ tài khoản'
			),
			array(
					'index' => 'bank_name',
					'type' => 'text',
					'label' => 'Ngân hàng'
			),
			array(
					'index' => 'bank_place',
					'type' => 'text',
					'label' => 'Chi nhánh'
			),
			array(
					'index' => 'bank_content',
					'type' => 'text',
					'label' => 'Nội dung'
			)
	);
	public $supportFields = array('hotline','email','yahoo','skype','vn_hotline','vn_email','vn_yahoo','vn_skype');
	public $supportFieldSettings = array(
			array(
					'index' => 'hotline',
					'type' => 'text',
					'label' => 'Số hotline (hỗ trợ phần mềm tiếng Anh)'
			),
			array(
					'index' => 'email',
					'type' => 'text',
					'label' => 'Email hỗ trợ (hỗ trợ phần mềm tiếng Anh)'
			),
			array(
					'index' => 'yahoo',
					'type' => 'text',
					'label' => 'Yahoo hỗ trợ (hỗ trợ phần mềm tiếng Anh)'
			),
			array(
					'index' => 'skype',
					'type' => 'text',
					'label' => 'Skype hỗ trợ (hỗ trợ phần mềm tiếng Anh)'
			),
			array(
					'index' => 'vn_hotline',
					'type' => 'text',
					'label' => 'Số hotline (hỗ trợ phần mềm tiếng Việt)'
			),
			array(
					'index' => 'vn_email',
					'type' => 'text',
					'label' => 'Email hỗ trợ (hỗ trợ phần mềm tiếng Việt)'
			),
			array(
					'index' => 'vn_yahoo',
					'type' => 'text',
					'label' => 'Yahoo hỗ trợ (hỗ trợ phần mềm tiếng Việt)'
			),
			array(
					'index' => 'vn_skype',
					'type' => 'text',
					'label' => 'Skype hỗ trợ (hỗ trợ phần mềm tiếng Việt)'
			)
	);
	
	public $statFields = array('stat_show_member','stat_show_today', 'stat_show_yesterday','stat_show_month','stat_show_lastmonth' ,'stat_show_birthday','stat_show_online','stat_show_total');
	public $statFieldSettings = array(
			array(
					'index' => 'stat_show_member',
					'type' => 'status',
					'label' => 'Hiển thị số thành viên'
			),
			array(
					'index' => 'stat_show_today',
					'type' => 'status',
					'label' => 'Hiển thị số truy cập trong ngày'
			),
			array(
					'index' => 'stat_show_yesterday',
					'type' => 'status',
					'label' => 'Hiển thị số truy cập hôm trước'
			),
			array(
					'index' => 'stat_show_month',
					'type' => 'status',
					'label' => 'Hiển thị số truy cập trong tháng'
			),
			array(
					'index' => 'stat_show_lastmonth',
					'type' => 'status',
					'label' => 'Hiển thị số truy cập tháng trước'
			),
			array(
					'index' => 'stat_show_online',
					'type' => 'status',
					'label' => 'Hiển thị số người online'
			),
			array(
					'index' => 'stat_show_total',
					'type' => 'status',
					'label' => 'Hiển thị tổng cộng'
			)
	);
}