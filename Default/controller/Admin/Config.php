<?php
/**
 *
 * @author: Huunv
 * date: 21/4
 */
class PzkAdminConfigController extends PzkConfigAdminController {
	public $menuLinks = array (
			array (
					'name' => 'Website',
					'href' => '/Admin_Config/edit?config=site' 
			),
			array (
					'name' => 'Database',
					'href' => '/Admin_Config/edit?config=database' 
			),
			array (
					'name' => 'Email',
					'href' => '/Admin_Config/edit?config=email' 
			),
			/*
			array (
					'name' => 'Ngân Lượng',
					'href' => '/Admin_Config/edit?config=nganluong' 
			),
			*/
			array (
					'name' => 'Checkmo',
					'href' => '/Admin_Config/edit?config=office' 
			),
			array (
					'name' => 'Bank Transfer',
					'href' => '/Admin_Config/edit?config=bankTransfer' 
			),
			array (
					'name' => 'Customer Support',
					'href' => '/Admin_Config/edit?config=support' 
			),
			array (
					'name' => 'Visitor Stats',
					'href' => '/Admin_Config/edit?config=stat' 
			),
			array (
					'name' => 'Register Active',
					'href' => '/Admin_Config/edit?config=registerActive' 
			),
			/*
			array (
					'name' => 'Xóa cache',
					'href' => '/Admin_Config/deletecache' 
			),
			array (
					'name' => 'Backup',
					'href' => '/Admin_Config/backupImage' 
			),*/
			array (
					'name' => 'Cache',
					'href' => '/Admin_Config/edit?config=cache' 
			),
			array (
					'name' => 'Facebook Login',
					'href' => '/Admin_Config/edit?config=loginFb' 
			),
			array (
					'name' => 'Google Login',
					'href' => '/Admin_Config/edit?config=loginG' 
			),
			array (
					'name' => 'Custom Fields',
					'href' => '/Admin_Config/edit?config=customFields' 
			),
			array (
					'name' => 'Color & Background',
					'href' => '/Admin_Config/edit?config=color' 
			),
			array (
					'name' => 'Sidebar',
					'href' => '/Admin_Config/edit?config=sidebar' 
			),
			array (
					'name' => 'Article',
					'href' => '/Admin_Config/edit?config=article' 
			),
			array (
					'name' => 'Slideshow',
					'href' => '/Admin_Config/edit?config=slideshow' 
			),
			array (
					'name' => 'Sections',
					'href' => '/Admin_Config/edit?config=section' 
			),
			array (
					'name' => 'Testimontals',
					'href' => '/Admin_Config/edit?config=testimontal' 
			),
			array (
					'name' => 'Team',
					'href' => '/Admin_Config/edit?config=team' 
			),
			array (
					'name' => 'Stats',
					'href' => '/Admin_Config/edit?config=stats' 
			),
	);
	public $siteFields = array (
			'site_name',
			'site_slogan',
			'site_brief',
			'site_logo',
			'site_header',
			'site_url',
			'site_keywords',
			'site_description',
			'site_footer',
			'site_notification',
			'site_payment_message',
			'site_payment_bank',
			'site_payment_service',
	);
	public $siteFieldSettings = array (
			array (
					'index' 		=> 'site_name',
					'type' 			=> EDIT_TYPE_TEXT,
					'label' 		=> 'Tên trang web' 
			),
			array (
					'index' 		=> 'site_slogan',
					'type' 			=> EDIT_TYPE_TEXT,
					'label' 		=> 'Khẩu hiệu(slogan)' 
			),
			array (
					'index' 		=> 'site_brief',
					'type' 			=> EDIT_TYPE_TEXT_AREA,
					'label' 		=> 'Mô tả' 
			),
			array (
					'index' 		=> 'site_logo',
					'type' 			=> EDIT_TYPE_FILE_MANAGER,
					'uploadtype'	=> EDIT_TYPE_UPLOAD_TYPE_IMAGE,
					'label' 		=> 'Logo' 
			),
			array (
					'index' 		=> 'site_header',
					'type' 			=> EDIT_TYPE_FILE_MANAGER,
					'uploadtype'	=> EDIT_TYPE_UPLOAD_TYPE_IMAGE,
					'label' 		=> 'Header' 
			),
			array (
					'index' 		=> 'site_url',
					'type' 			=> EDIT_TYPE_TEXT,
					'label' 		=> 'Đường dẫn'
			),
			array (
					'index' 		=> 'site_keywords',
					'type' 			=> EDIT_TYPE_TEXT_AREA,
					'label' 		=> 'Từ khóa SEO'
			),
			array (
					'index' 		=> 'site_description',
					'type' 			=> EDIT_TYPE_TEXT_AREA,
					'label' 		=> 'Mô tả SEO'
			),
			array (
					'index' 		=> 'site_footer',
					'type' 			=> EDIT_TYPE_TINYMCE,
					'label' 		=> 'Footer Code'
			),
			array (
					'index' 		=> 'site_notification',
					'type' 			=> EDIT_TYPE_TEXT_AREA,
					'label' 		=> 'Thông báo của website'
			),
			array (
					'index' 		=> 'site_payment_message',
					'type' 			=> EDIT_TYPE_TINYMCE,
					'label' 		=> 'Mô tả thanh toán'
			),
			array (
					'index' 		=> 'site_payment_bank',
					'type' 			=> EDIT_TYPE_TINYMCE,
					'label' 		=> 'Mô tả thanh toán chuyển khoản'
			),
			array (
					'index' 		=> 'site_payment_service',
					'type' 			=> EDIT_TYPE_TINYMCE,
					'label' 		=> 'Mô tả thanh toán thẻ cào'
			),
	);
	public $databaseFields = array (
			'db_host',
			'db_user',
			'db_password',
			'db_database' 
	);
	public $databaseFieldSettings = array (
			array (
					'index' => 'db_host',
					'type' => 'text',
					'label' => 'Tên host' 
			),
			array (
					'index' => 'db_user',
					'type' => 'text',
					'label' => 'Tên user' 
			),
			array (
					'index' => 'db_password',
					'type' => 'password',
					'label' => 'Password' 
			),
			array (
					'index' => 'db_database',
					'type' => 'text',
					'label' => 'Tên database' 
			) 
	);
	public $emailFields = array (
			'email_host',
			'email_user',
			'email_password',
			'email_port' 
	);
	public $emailFieldSettings = array (
			array (
					'index' => 'email_host',
					'type' => 'text',
					'label' => 'Tên host' 
			),
			array (
					'index' => 'email_user',
					'type' => 'text',
					'label' => 'Tên user' 
			),
			array (
					'index' => 'email_password',
					'type' => 'password',
					'label' => 'Password' 
			),
			array (
					'index' => 'email_port',
					'type' => 'text',
					'label' => 'Port' 
			) 
	);
	public $nganluongFields = array (
			'nganluong_merchant' 
	);
	public $nganluongFieldSettings = array (
			array (
					'index' => 'nganluong_merchant',
					'type' => 'text',
					'label' => 'Merchant' 
			) 
	);
	public $bankTransferFields = array (
			'bank_number1',
			'bank_user1',
			'bank_name1',
			'bank_place1',
			'bank_content1',
			'bank_number2',
			'bank_user2',
			'bank_name2',
			'bank_place2',
			'bank_content2',
			'bank_number3',
			'bank_user3',
			'bank_name3',
			'bank_place3',
			'bank_content3',
			'bank_number4',
			'bank_user4',
			'bank_name4',
			'bank_place4',
			'bank_content4',
			'bank_number5',
			'bank_user5',
			'bank_name5',
			'bank_place5',
			'bank_content5',
			'bank_number6',
			'bank_user6',
			'bank_name6',
			'bank_place6',
			'bank_content6',
			'note1',
			'note2',
			'note3' 
	);
	public $bankTransferFieldSettings = array (
			
			array (
					'index' => 'bank_number1',
					'type' => 'text',
					'label' => 'Số tài khoản 1' 
			),
			array (
					'index' => 'bank_user1',
					'type' => 'text',
					'label' => 'Chủ tài khoản 1' 
			),
			array (
					'index' => 'bank_name1',
					'type' => 'text',
					'label' => 'Ngân hàng 1' 
			),
			array (
					'index' => 'bank_place1',
					'type' => 'text',
					'label' => 'Chi nhánh' 
			),
			array (
					'index' => 'bank_content1',
					'type' => 'text',
					'label' => 'Nội dung' 
			),
			array (
					'index' => 'bank_number2',
					'type' => 'text',
					'label' => 'Số tài khoản 2' 
			),
			array (
					'index' => 'bank_user2',
					'type' => 'text',
					'label' => 'Chủ tài khoản 2' 
			),
			array (
					'index' => 'bank_name2',
					'type' => 'text',
					'label' => 'Ngân hàng 2' 
			),
			array (
					'index' => 'bank_place2',
					'type' => 'text',
					'label' => 'Chi nhánh' 
			),
			array (
					'index' => 'bank_content2',
					'type' => 'text',
					'label' => 'Nội dung' 
			),
			array (
					'index' => 'bank_number3',
					'type' => 'text',
					'label' => 'Số tài khoản 3' 
			),
			array (
					'index' => 'bank_user3',
					'type' => 'text',
					'label' => 'Chủ tài khoản 3' 
			),
			array (
					'index' => 'bank_name3',
					'type' => 'text',
					'label' => 'Ngân hàng 3' 
			),
			array (
					'index' => 'bank_place3',
					'type' => 'text',
					'label' => 'Chi nhánh' 
			),
			array (
					'index' => 'bank_content3',
					'type' => 'text',
					'label' => 'Nội dung' 
			),
			array (
					'index' => 'bank_number4',
					'type' => 'text',
					'label' => 'Số tài khoản 4' 
			),
			array (
					'index' => 'bank_user4',
					'type' => 'text',
					'label' => 'Chủ tài khoản 4' 
			),
			array (
					'index' => 'bank_name4',
					'type' => 'text',
					'label' => 'Ngân hàng 4' 
			),
			array (
					'index' => 'bank_place4',
					'type' => 'text',
					'label' => 'Chi nhánh' 
			),
			array (
					'index' => 'bank_content4',
					'type' => 'text',
					'label' => 'Nội dung' 
			),
			array (
					'index' => 'bank_number5',
					'type' => 'text',
					'label' => 'Số tài khoản 5' 
			),
			array (
					'index' => 'bank_user5',
					'type' => 'text',
					'label' => 'Chủ tài khoản 5' 
			),
			array (
					'index' => 'bank_name5',
					'type' => 'text',
					'label' => 'Ngân hàng 5' 
			),
			array (
					'index' => 'bank_place5',
					'type' => 'text',
					'label' => 'Chi nhánh' 
			),
			array (
					'index' => 'bank_content5',
					'type' => 'text',
					'label' => 'Nội dung' 
			),
			array (
					'index' => 'bank_number6',
					'type' => 'text',
					'label' => 'Số tài khoản 6' 
			),
			array (
					'index' => 'bank_user6',
					'type' => 'text',
					'label' => 'Chủ tài khoản 6' 
			),
			array (
					'index' => 'bank_name6',
					'type' => 'text',
					'label' => 'Ngân hàng 6' 
			),
			array (
					'index' => 'bank_place6',
					'type' => 'text',
					'label' => 'Chi nhánh' 
			),
			array (
					'index' => 'bank_content6',
					'type' => 'text',
					'label' => 'Nội dung' 
			),
			array (
					'index' => 'note1',
					'type' => 'text',
					'label' => 'Ghi chú chuyển tiền qua máy ATM' 
			),
			array (
					'index' => 'note2',
					'type' => 'text',
					'label' => 'Ghi chú giữ lại biên nhận chuyển khoản' 
			),
			array (
					'index' => 'note3',
					'type' => 'text',
					'label' => 'Ghi chú kiểm tra giao dịch' 
			) 
	);
	public $officeFields = array (
			'name_office',
			'address_office',
			'phone_office',
			'note_office' 
	);
	public $officeFieldSettings = array (
			array (
					'index' => 'name_office',
					'type' => 'text',
					'label' => 'Tên văn phòng' 
			),
			array (
					'index' => 'address_office',
					'type' => 'text',
					'label' => 'Địa chỉ' 
			),
			array (
					'index' => 'phone_office',
					'type' => 'text',
					'label' => 'Điện thoại' 
			),
			array (
					'index' => 'note_office',
					'type' => 'text',
					'label' => 'Ghi chú' 
			) 
	);
	public $supportFields = array (
			'hotline',
			'email',
			'yahoo',
			'skype',
			'vn_hotline',
			'vn_email',
			'vn_yahoo',
			'vn_skype',
			'support_en_link',
			'support_vn_link' 
	);
	public $supportFieldSettings = array (
			array (
					'index' => 'support_en_link',
					'type' => 'text',
					'label' => 'Đường dẫn phần mềm tiếng Anh' 
			),
			array (
					'index' => 'hotline',
					'type' => 'text',
					'label' => 'Số hotline (hỗ trợ phần mềm tiếng Anh)' 
			),
			array (
					'index' => 'email',
					'type' => 'text',
					'label' => 'Email hỗ trợ (hỗ trợ phần mềm tiếng Anh)' 
			),
			array (
					'index' => 'yahoo',
					'type' => 'text',
					'label' => 'Yahoo hỗ trợ (hỗ trợ phần mềm tiếng Anh)' 
			),
			array (
					'index' => 'skype',
					'type' => 'text',
					'label' => 'Skype hỗ trợ (hỗ trợ phần mềm tiếng Anh)' 
			),
			array (
					'index' => 'support_vn_link',
					'type' => 'text',
					'label' => 'Đường dẫn phần mềm tiếng Việt' 
			),
			array (
					'index' => 'vn_hotline',
					'type' => 'text',
					'label' => 'Số hotline (hỗ trợ phần mềm tiếng Việt)' 
			),
			array (
					'index' => 'vn_email',
					'type' => 'text',
					'label' => 'Email hỗ trợ (hỗ trợ phần mềm tiếng Việt)' 
			),
			array (
					'index' => 'vn_yahoo',
					'type' => 'text',
					'label' => 'Yahoo hỗ trợ (hỗ trợ phần mềm tiếng Việt)' 
			),
			array (
					'index' => 'vn_skype',
					'type' => 'text',
					'label' => 'Skype hỗ trợ (hỗ trợ phần mềm tiếng Việt)' 
			) 
	);
	public $statFields = array (
			'stat_show_member',
			'stat_show_today',
			'stat_show_yesterday',
			'stat_show_month',
			'stat_show_lastmonth',
			'stat_show_birthday',
			'stat_show_online',
			'stat_show_total' 
	);
	public $statFieldSettings = array (
			array (
					'index' => 'stat_show_member',
					'type' => 'status',
					'label' => 'Hiển thị số thành viên' 
			),
			array (
					'index' => 'stat_show_today',
					'type' => 'status',
					'label' => 'Hiển thị số truy cập trong ngày' 
			),
			array (
					'index' => 'stat_show_yesterday',
					'type' => 'status',
					'label' => 'Hiển thị số truy cập hôm trước' 
			),
			array (
					'index' => 'stat_show_month',
					'type' => 'status',
					'label' => 'Hiển thị số truy cập trong tháng' 
			),
			array (
					'index' => 'stat_show_lastmonth',
					'type' => 'status',
					'label' => 'Hiển thị số truy cập tháng trước' 
			),
			array (
					'index' => 'stat_show_online',
					'type' => 'status',
					'label' => 'Hiển thị số người online' 
			),
			array (
					'index' => 'stat_show_total',
					'type' => 'status',
					'label' => 'Hiển thị tổng cộng' 
			) 
	);
	public $registerActiveFields = array (
			'register_active' 
	);
	public $registerActiveFieldSettings = array (
			array (
					'index' => 'register_active',
					'type' => 'status',
					'label' => 'Kích hoạt đăng ký' 
			) 
	);
	// config time cache
	public $cacheFields = array (
			'time_cache_web',
			'time_cache_session' 
	);
	public $cacheFieldSettings = array (
			array (
					'index' => 'time_cache_web',
					'type' => 'text',
					'label' => 'Thời gian cache' 
			),
			array (
					'index' => 'time_cache_session',
					'type' => 'text',
					'label' => 'Thời gian cache session' 
			) 
	);
	public function deletecacheAction() {
		$this->initPage ()->append ( 'admin/' . pzk_or ( $this->customModule, $this->module ) . '/index' )->append ( 'admin/' . pzk_or ( $this->customModule, $this->module ) . '/menu', 'right' );
		$cachefiles = glob ( 'cache/*.txt*' );
		foreach ( $cachefiles as $file ) {
			unlink ( 'cache/' . basename ( $file ) );
		}
		$defaultCacher = CACHE_DEFAULT_CACHER;
		$defaultCacher()->clear();
		$this->display ();
	}
	public $loginFbFields = array (
			'AppID',
			'AppSecret' 
	);
	public $loginFbFieldSettings = array (
			array (
					'index' => 'AppID',
					'type' => 'text',
					'label' => 'App ID' 
			),
			array (
					'index' => 'AppSecret',
					'type' => 'text',
					'label' => 'App Secret' 
			) 
	);
	public $loginGFields = array (
			'client_id',
			'client_secret',
			'developer_key',
			'redirect_url' 
	);
	public $loginGFieldSettings = array (
			array (
					'index' => 'client_id',
					'type' => 'text',
					'label' => 'Client ID' 
			),
			array (
					'index' => 'client_secret',
					'type' => 'text',
					'label' => 'Client Secret' 
			),
			array (
					'index' => 'developer_key',
					'type' => 'text',
					'label' => 'API Key' 
			),
			array (
					'index' => 'redirect_url',
					'type' => 'text',
					'label' => 'Redirect URIs' 
			) 
	);
	
	public $customFieldsFields = array (
			'customUserRegisterFields',
			'customUserLoginFields'
	);
	public $customFieldsFieldSettings = array (
			array (
					'index' 	=> 'customUserRegisterFields',
					'type' 		=> 'table',
					'label' 	=> 'Các trường để đăng ký',
					'settings' => array(
						array(
							'type'	=> 	'text',
							'index'	=>	'name',
							'label'	=>	'Tên trường'
						)
					)
			),
			array (
					'index' 	=> 'customUserLoginFields',
					'type' 		=> 'table',
					'label' 	=> 'Các trường để đăng nhập',
					'settings' 	=> array(
						array(
							'type'	=> 	'text',
							'index'	=>	'name',
							'label'	=>	'Tên trường'
						)
					)
			)
	);
	
	public $colorFields = array (
			'color_background_color',
			'color_background_image',
			'color_primary_color',
			'color_sub_color',
			'color_other_color',
	);
	public $colorFieldSettings = array (
			array (
					'index' => 'color_background_color',
					'type' => EDIT_TYPE_TEXT,
					'label' => 'Màu nền' 
			),
			array (
					'index' => 'color_background_image',
					'type' => EDIT_TYPE_FILE_MANAGER,
					'label' => 'Ảnh nền'
			),
			array (
					'index' => 'color_primary_color',
					'type' => EDIT_TYPE_TEXT,
					'label' => 'Màu chính' 
			),
			array (
					'index' => 'color_sub_color',
					'type' => EDIT_TYPE_TEXT,
					'label' => 'Màu phụ' 
			),
			array (
					'index' => 'color_other_color',
					'type' => EDIT_TYPE_TEXT,
					'label' => 'Màu khác'
			),
	);
	
	public $sidebarFields = array (
			'sidebar_display',
			'sidebar_position',
			'sidebar_width_type',
			'sidebar_width_size'
	);
	public $sidebarFieldSettings = array (
			array (
					'index' => 'sidebar_display',
					'type' => EDIT_TYPE_STATUS,
					'label' => 'Hiển thị sidebar' 
			),
			array (
					'index' => 'sidebar_position',
					'type' => EDIT_TYPE_TEXT,
					'label' => 'Vị trí'
			),
			array (
					'index' => 'sidebar_width_type',
					'type' => EDIT_TYPE_TEXT,
					'label' => 'Kiểu kích cỡ' 
			),
			array (
					'index' => 'sidebar_width_size',
					'type' => EDIT_TYPE_TEXT,
					'label' => 'Kích cỡ' 
			)
	);
	
	public $articleFields = array (
			'article_list_column',
			'article_list_display_type',
			'article_list_thumbnail_height',
			'article_list_brief_words',
			'article_list_brief_height',
			'article_list_show_info_type',	// ngay tao, tac gia, danh muc
			'article_list_show_readmore',
			'article_list_readmore_text'
	);
	public $articleFieldSettings = array (
			array (
					'index' => 'article_list_column',
					'type' => EDIT_TYPE_TEXT,
					'label' => 'Số cột hiển thị' 
			),
			array (
					'index' => 'article_list_display_type',
					'type' => EDIT_TYPE_TEXT,
					'label' => 'Cách hiển thị'
			),
			array (
					'index' => 'article_list_thumbnail_height',
					'type' => EDIT_TYPE_TEXT,
					'label' => 'Chiều cao của ảnh thumbnail' 
			),
			array (
					'index' => 'article_list_brief_words',
					'type' => EDIT_TYPE_TEXT,
					'label' => 'Số từ trong mô tả ngắn gọn' 
			),
			array (
					'index' => 'article_list_brief_height',
					'type' => EDIT_TYPE_TEXT,
					'label' => 'Độ cao của mục mô tả ngắn gọn' 
			),
			array (
					'index' => 'article_list_show_info_type',
					'type' => EDIT_TYPE_TEXT,
					'label' => 'Kiểu hiển thị thông tin tác giả, ngày tạo, danh mục' 
			),
			array (
					'index' => 'article_list_show_readmore',
					'type' => EDIT_TYPE_STATUS,
					'label' => 'Hiển thị link đọc thêm' 
			),
			array (
					'index' => 'article_list_readmore_text',
					'type' => EDIT_TYPE_TEXT,
					'label' => 'Text cho link đọc thêm' 
			),
	);
	
	public $slideshowFields = array (
			'slideshow_display',
			'slideshow_images',
	);
	public $slideshowFieldSettings = array (
			array (
				'index' => 'slideshow_display',
				'type' => EDIT_TYPE_STATUS,
				'label' => 'Hiển thị slideshow' 
			),
			array (
				'index' => 'slideshow_images',
				'type' => 'table',
				'label' => 'Ảnh trong slideshow',
				'settings' => array(
					array(
						'type'	=> 	'text',
						'index'	=>	'title',
						'label'	=>	'Tên ảnh',
						'mdsize'=>	12
					),
					array(
						'type'	=> 	'filemanager',
						'index'	=>	'image',
						'label'	=>	'Ảnh',
						'mdsize'=>	12
					),
					array(
						'type'	=> 	'text',
						'index'	=>	'link',
						'label'	=>	'Liên kết',
						'mdsize'=>	12
					),
					array(
						'type'	=> 	'textarea',
						'index'	=>	'description',
						'label'	=>	'Mô tả',
						'mdsize'=>	12
					),
				)
			),
	);
	
	public $testimontalFields = array (
			'testimontal_display',
			'testimontal_items',
	);
	public $testimontalFieldSettings = array (
			array (
				'index' => 'testimontal_display',
				'type' => EDIT_TYPE_STATUS,
				'label' => 'Hiển thị Testimontals' 
			),
			array (
				'index' => 'testimontal_items',
				'type' => 'table',
				'label' => 'Nội dung',
				'settings' => array(
					array(
						'type'	=> 	'text',
						'index'	=>	'name',
						'label'	=>	'Tên người',
						'mdsize'=>	12
					),
					array(
						'type'	=> 	'filemanager',
						'index'	=>	'image',
						'label'	=>	'Ảnh',
						'mdsize'=>	12
					),
					array(
						'type'	=> 	'text',
						'index'	=>	'position',
						'label'	=>	'Chức vụ',
						'mdsize'=>	12
					),
					array(
						'type'	=> 	'textarea',
						'index'	=>	'description',
						'label'	=>	'Mô tả',
						'mdsize'=>	12
					),
					array(
						'type'	=> 	'text',
						'index'	=>	'address',
						'label'	=>	'Nơi ở/công tác',
						'mdsize'=>	12
					),
				)
			),
	);
	
	public $teamFields = array (
			'team_display',
			'team_items',
	);
	public $teamFieldSettings = array (
			array (
				'index' => 'team_display',
				'type' => EDIT_TYPE_STATUS,
				'label' => 'Hiển thị Đội' 
			),
			array (
				'index' => 'team_items',
				'type' => 'table',
				'label' => 'Các thành viên',
				'settings' => array(
					array(
						'type'	=> 	'text',
						'index'	=>	'name',
						'label'	=>	'Tên người',
						'mdsize'=>	3
					),
					array(
						'type'	=> 	'filemanager',
						'index'	=>	'image',
						'label'	=>	'Ảnh',
						'mdsize'=>	2
					),
					array(
						'type'	=> 	'text',
						'index'	=>	'position',
						'label'	=>	'Chức vụ',
						'mdsize'=>	2
					),
					array(
						'type'	=> 	'textarea',
						'index'	=>	'description',
						'label'	=>	'Mô tả',
						'mdsize'=>	3
					)
				)
			),
	);
	
	public $sectionFields = array (
			'section_display',
			'section_items',
	);
	public $sectionFieldSettings = array (
		array (
			'index' => 'section_display',
			'type' => EDIT_TYPE_STATUS,
			'label' => 'Hiển thị Đội' 
		),
		array (
			'index' => 'section_items',
			'type' => 'table',
			'label' => 'Các thành viên',
			'settings' => array(
				array(
					'type'	=> 	'text',
					'index'	=>	'name',
					'label'	=>	'Tên người',
					'mdsize'=>	12
				),
				array(
					'type'	=> 	'filemanager',
					'index'	=>	'image',
					'label'	=>	'Ảnh',
					'mdsize'=>	12
				),
				array(
					'type'	=> 	'text',
					'index'	=>	'position',
					'label'	=>	'Chức vụ',
					'mdsize'=>	12
				),
				array(
					'type'	=> 	'textarea',
					'index'	=>	'description',
					'label'	=>	'Mô tả',
					'mdsize'=>	12
				)
			)
		),
	);
	
	public function backupImageAction() {
		$this->initPage ()->append ( 'admin/' . pzk_or ( $this->customModule, $this->module ) . '/index' )->append ( 'admin/' . pzk_or ( $this->customModule, $this->module ) . '/menu', 'right' );
		
		// Create Backup image Folder
		$folder = 'backupfilemedia/';
		if (! is_dir ( $folder ))
			mkdir ( $folder, 0777, true );
		chmod ( $folder, 0777 );
		// get all file in tinymce
		$parent_files = glob ( '3rdparty/Filemanager/source/*' );
		$sub_files1 = glob ( '3rdparty/Filemanager/source/*/*' );
		$sub_files2 = glob ( '3rdparty/Filemanager/source/*/*/*' );
		
		// get all file in upload
		$parentUploadFiles = glob ( '3rdparty/uploads/*' );
		$subUploadFiles = glob ( '3rdparty/uploads/*/*' );
		
		$allfile = array_merge ( $parent_files ? $parent_files : array (), $sub_files1 ? $sub_files1 : array (), $sub_files2 ? $sub_files2 : array (), $parentUploadFiles ? $parentUploadFiles : array (), $subUploadFiles ? $subUploadFiles : array () );
		// increase script timeout value
		ini_set ( 'max_execution_time', 5000 );
		
		// create object
		$zip = new ZipArchive ();
		// set date
		if ($zip->open ( 'backupfilemedia/filebackup.zip', ZIPARCHIVE::CREATE ) !== TRUE) {
			die ( "Could not open archive" );
		}
		
		foreach ( $allfile as $key => $value ) {
			if (is_file ( $value )) {
				$zip->addFile ( $value );
			}
		}
		
		$zip->close ();
		pzk_notifier ()->addMessage ( 'Nén thành công' );
		$this->display ();
	}
}