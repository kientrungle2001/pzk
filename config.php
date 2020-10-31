<?php

// Version của hệ thống
define('PZK_VERSION', '2.7');

// Bật thông báo lỗi
ini_set('error_reporting', E_ALL);

// Bật bộ đệm dữ liệu
ob_start();

// set timezone default: đặt timezone Việt Nam
date_default_timezone_set('Asia/Ho_Chi_Minh');

// encoding mặc định là utf-8
mb_language('uni');
mb_internal_encoding('UTF-8');

// Khởi tạo SESSION
// Thời gian sống của session
$lifetime = 60000;

// Sử dụng local mode cho session (session không theo sub domain)
define('SESSION_LOCAL_MODE', true);
define('LOCAL_MODE', false);
/*
$explodedHttpHosts = explode('.', $_SERVER['HTTP_HOST']);
$ext = array_pop($explodedHttpHosts);
$name = array_pop($explodedHttpHosts);
$mainHost = $name . '.' . $ext;
ini_set('session.cookie_domain', '.'.$mainHost);
*/

// session id
$a = session_id();

// Khởi tạo session theo domain và subdomain
if(!SESSION_LOCAL_MODE && !$a)
{
	$currentCookieParams = session_get_cookie_params();

	function get_root_domain() {
		static $root_domain = null;
		if(null !== $root_domain) return $root_domain;
		$host 		= $_SERVER['HTTP_HOST'];
		$names 		= explode('.', $host);
		$ext 		= array_pop($names);
		$tld 		= array_pop($names);
		return $root_domain = $tld. '.' . $ext;
	}
	$rootDomain = '.' . get_root_domain();

	session_name('mysessname');
	session_set_cookie_params(0, '/', $rootDomain);
	@session_start();
} else {
    @session_start();
}


// Bắt quyền truy cập cho các file php của hệ thống
define('PZK_ACCESS', true);

// Separator
define('DS', DIRECTORY_SEPARATOR);
define('UNS', '_');
define('DOT', '.');

// Extensions
define ('PHP_EXT', '.php');
define ('HTML_EXT', '.html');
define ('PHTML_EXT', '.phtml');
define ('CSS_EXT', '.css');
define ('XML_EXT', '.xml');
define ('JSON_EXT', '.json');
define ('JS_EXT', '.js');

// Thư mục hệ thống
define('SYSTEM_DIR', dirname(__FILE__));

// Thư mục gốc
define('BASE_DIR', SYSTEM_DIR);

// Đường dẫn gốc
define('BASE_URL', "http://{$_SERVER['HTTP_HOST']}");

// tên thư mục app
define('APP_FOLDER', 'app');

// thư mục app
define('APP_DIR', BASE_DIR . DS . APP_FOLDER);

// tên thư mục default
define('DEFAULT_FOLDER', 'Default');

// thư mục default
define('DEFAULT_DIR', BASE_DIR . DS . DEFAULT_FOLDER);

// tên thư mục themes
define('THEMES_FOLDER', 'Themes');

// thư mục themes
define('THEMES_DIR', BASE_DIR . DS . THEMES_FOLDER);

// tên thư mục controller
define('CONTROLLER_FOLDER', 'controller');

// tên thư mục controller
define('PAGES_FOLDER', 'pages');

// tên thư mục model
define('MODEL_FOLDER', 'model');

// tên thư mục layouts
define('LAYOUTS_FOLDER', 'layouts');

// tên thư mục skin
define('SKIN_FOLDER', 'skin');

// tên thư mục compile
define('COMPILE_FOLDER', 'compile');

// thư mục compile
define('COMPILE_DIR', BASE_DIR . DS . COMPILE_FOLDER);

define('CACHE_FOLDER', 'cache');

define('CACHE_DIR', BASE_DIR . DS . CACHE_FOLDER);

// tên thư mục compile
define('OBJECTS_FOLDER', 'objects');

// thư mục compile
define('OBJECTS_DIR', BASE_DIR . DS . OBJECTS_FOLDER);

// Chế độ rewrite không có index.php
define('REWRITE_MODE', true);

// Script khởi chạy
define('STARTUP_SCRIPT', 'index.php');

// Đường dẫn cho thư viện bên thứ 3
define('BASE_3RDPARTY_DIR', BASE_DIR);
define('BASE_3RDPARTY_URL', BASE_URL);

// Đường dẫn cho media
define('BASE_MEDIA_DIR', BASE_DIR);
define('BASE_MEDIA_URL', BASE_URL);

// Đường dẫn cho skin
define('BASE_SKIN_DIR', BASE_DIR);
define('BASE_SKIN_URL', BASE_URL);

// Đường dẫn khởi chạy vào hệ thống
if(REWRITE_MODE) {
	// Trường hợp có rewrite bỏ index.php
	define('BASE_REQUEST', "http://{$_SERVER['HTTP_HOST']}");
} else {
	// Trường hợp không có rewrite
	define('BASE_REQUEST', "http://{$_SERVER['HTTP_HOST']}/" . STARTUP_SCRIPT);
}

// Chế độ SEO | url thân thiện. Bỏ chế độ này đi sẽ chạy dạng controller/action
define('SEO_MODE', true);

// Thêm include path để php tìm kiếm file
set_include_path(get_include_path() . BASE_DIR . ';');

// Chế độ cache. Trường hợp vào trong admin chế dộ cache = false
if(strpos($_SERVER['REQUEST_URI'], 'admin') !== false || strpos($_SERVER['REQUEST_URI'], 'Admin') !== false) {
	// trong admin
	define('CACHE_MODE', false);
	define('ADMIN_MODE', true);
} else {
	// ngoài front-end
	if(isset($_SESSION['CACHE_MODE'])) {
		if($_SESSION['CACHE_MODE']) {
			define('CACHE_MODE', true);
		} else {
			define('CACHE_MODE', false);
		}
	} else {
		define('CACHE_MODE', false);
	}


	define('ADMIN_MODE', false);
}

// Engine cache mặc định
define('CACHE_DEFAULT_CACHER', 'pzk_filecache');

// Chế độ cache câu hỏi
define('CACHE_QUESTION_MODE', false);

// Chế độ cache câu trả lời
define('CACHE_ANSWER_MODE', false);

// Chế độ debug
define('DEBUG_MODE', false);

// Mức debug: 1 thì chỉ hiển thị query của mysql, 2 thì hiển thị luồng chạy
define('DEBUG_LEVEL', 2);

// Chế độ phar: Gói tất cả các file vào trong một file phar
define('PHAR_MODE', false);

// Chế độ compile: Compile các file ra thư mục compile để chạy nhanh hơn
define('COMPILE_MODE', true);

// Chế độ compile nối các file require trong include.php thành một file
define('COMPILE_INCLUDE_MODE', true);

// Chế độ compile các file model ra thư mục compile/models
define('COMPILE_MODEL_MODE', true);

// Chế độ compile các file object ra thư mục compile/objects
define('COMPILE_OBJECT_MODE', true);

// Chế độ compile các file pages ra thư mục compile/pages
define('COMPILE_PAGE_MODE', true);

// Chế độ compile các file layout ra thư mục compile/layouts
define('COMPILE_LAYOUT_MODE', true);


// Chế độ compile client
// Chế độ compile css: nối và nén các file css thành một file
define('COMPILE_CSS_MODE', false);

// Chế độ compile js: nối và nén các file js thành một file
define('COMPILE_JS_MODE', false);

//	MENU
define('MENU', 'MENU');

//	SEARCH
define('ACTION_SEARCH', '1');

define('ACTION_RESET', '0');

//	ACTIVE
define('ENABLED',	1);
define('DISABLED',	0);

//	QUESTION TYPE

define('QUESTION_WORDS',	'Dạng về từ');
define('QUESTION_PHRASE',	'Dạng về câu');
define('QUESTION_PASSAGE',	'Dạng bài về đoạn văn');
define('QUESTION_CITATION',	'Dạng bài về bài văn');

$type_level = array(
    'index' 	=> 	'Xem',
    'add'		=> 	'Thêm',
    'edit'		=>	'Sửa',
    'del'		=>	'Xóa',
    'import'	=>	'Thêm dữ liệu',
    'export'	=>	'Xuất dữ liệu'
);
define('TYPE_LEVEL', 		json_encode($type_level));
$type_software = array(
    '1' 		=> 	'Phần mềm 1',
    '2'			=> 	'Phần mềm 2',
    '3'			=> 	'Phần mềm 3'
);
define('TYPE_SOFTWARE', 	json_encode($type_software));

//	FORMAT DATE
define('DATEFORMAT',		'Y-m-d H:i:s');

// Mã bảo mật
define('SECRETKEY', 		'onghuu');

// Số lượng câu hỏi
define('NUMBER_QUESTION5',	5);

// Mười câu hỏi
define('NUMBER_QUESTION10',	10);

define('NUMBER_QUESTION15',	15);

define('NUMBER_QUESTION20',	20);


// Thời gian làm bài
define('WORK_TIME15', 		15);

define('WORK_TIME30', 		30);

define('WORK_TIME45', 		45);

define('WORK_TIME60', 		60);

define('NUM_QUESTION', 		10);


// Độ khó
define('EASY', 				1);

define('NORMAL', 			2);

define('HARD', 				3);

define('VERYHARD', 			4);

define('SUPERHARD', 		5);


// Loại câu hỏi
define('QUESTION_TYPE_CHOICE', 				1);

define('QUESTION_TYPE_FILL', 				2);

define('QUESTION_TYPE_FILL_JOIN', 			3);

define('QUESTION_TYPE_TULUAN', 				4);

define('QUESTION_TYPE_TULUAN_DIENTU', 		5);

// Giới hạn số câu hỏi
define('QUESTION_LIMIT', 			20);

define('QUESTION_LIMIT_FULL', 		1000);

define('LIMIT_TEST', 				10);

define('LIMIT_NEWS', 				50);

define('PRACTICE_CACHE_LIMIT', 		100);


// trạng thái câu hỏi
define('QUESTION_DISABLE', 			0);

define('QUESTION_ENABLE', 			1);


// Kiểm duyệt câu hỏi
define('QUESTION_CHECKED', 			1);

define('QUESTION_UNCHECKED', 		0);

// Câu hỏi đã xóa hay đang được yêu cầu
define('DELETED', 					1);

define('ISREQUEST', 				1);

// ADMIN

// Tên các nút edit
// Tên nút Sửa và đóng sau khi sửa
define('BTN_EDIT_AND_CLOSE', 		'edit_and_close');

// Tên nút Sửa và Tiếp tục
define('BTN_EDIT_AND_CONTINUE', 	'edit_and_continue');

// Tên nút Sửa và xem chi tiết sau khi sửa
define('BTN_EDIT_AND_DETAIL', 		'edit_and_detail');

// Tên các nút add
// Tên nút Thêm và đóng
define('BTN_ADD_AND_CLOSE', 		'add_and_close');

// Tên nút Thêm và tiếp tục thêm
define('BTN_ADD_AND_CONTINUE', 		'add_and_continue');

// Tên nút Thêm và sửa sau khi thêm
define('BTN_ADD_AND_EDIT', 			'add_and_edit');

define('MARK_NO',					0);		// chua cham
define('MARKED',					1);		// da cham
define('MARK_CHECKED',				2);	// da check
define('MARK_FALSE',				3); // loi

define('PAYMENT_USER_1', 	100);
define('PAYMENT_USER_2', 	5000);
define('PAYMENT_USER_3', 	10000);
define('PAYMENT_USER_4', 	15000);

define('PAYMENT_ADMIN_1', 	50);
define('PAYMENT_ADMIN_2', 	2500);
define('PAYMENT_ADMIN_3', 	5000);
define('PAYMENT_ADMIN_4', 	7500);

define('PACKAGE_SUCCESS', 		1);
define('PACKAGE_ERROR_FILE', 	2);
define('PACKAGE_ERROR_VERSION', 3);
define('PACKAGE_DEPEN', 		4);

define('SIGN_SUM',	0);
define('SIGN_SUB',	1);

//define class
define('CLASS3', 	3);
define('CLASS4', 	4);
define('CLASS5', 	5);

// Thời gian làm bài mặc định
define('QUESTIONTIME', 15);

if(LOCAL_MODE) {
	// Các đường dẫn đến ứng dụng
	define('FL_URL', 	'http://test1.vn');
	define('FLSN_URL', 	'http://test1sn.vn');
	define('NOBEL_URL', 'http://nobel.vn');
	define('HW_URL', 'http://pmtv.vn');
	define('PMTV3_URL', 'http://pmtv3.vn');
	define('PMTV4_URL', 'http://pmtv4.vn');
	define('PMTV5_URL', 'http://pmtv5.vn');

	//ngay show dap an dot 1
	define('DATEFINISH1', '2016/06/01 08:00:00');
	//ngay show dap an dot 2
	define('DATEFINISH2', '2016/06/14 08:00:00');
	//ngay thi dot 1
	define('DATECAMP1', '2016/05/05 08:00:00');
	//ngay thi dot 2
	define('DATECAMP2', '2016/06/12 08:00:00');
} else {
	define('FL_URL', 'http://s1.nextnobels.com');
	define('FLSN_URL', 'http://fulllooksongngu.com');
	define('NOBEL_URL', 'http://nextnobels.com');
	if(strpos($_SERVER['HTTP_HOST'], 'tiengviettieuhoc.vn') !== false) {
		define('HW_URL', 'http://tiengviettieuhoc.vn');
		define('PMTV3_URL', 'http://pmtv3.tiengviettieuhoc.vn');
		define('PMTV4_URL', 'http://pmtv4.tiengviettieuhoc.vn');
		define('PMTV5_URL', 'http://pmtv5.tiengviettieuhoc.vn');
	} else {
		define('HW_URL', 'http://tiengviettieuhoc.net');
		define('PMTV3_URL', 'http://pmtv3.tiengviettieuhoc.net');
		define('PMTV4_URL', 'http://pmtv4.tiengviettieuhoc.net');
		define('PMTV5_URL', 'http://pmtv5.tiengviettieuhoc.net');
	}

	//ngay show dap an dot 1
	define('DATEFINISH1', '2016/06/08 16:00:00');
	//ngay show dap an dot 2
	define('DATEFINISH2', '2016/06/15 15:00:00');
	//ngay thi dot 1
	define('DATECAMP1', '2016/06/05 08:00:00');
	//ngay thi dot 2
	define('DATECAMP2', '2016/06/12 08:00:00');

}

if(LOCAL_MODE){
  define('ROOT_WEEK_CATEGORY_ID','227');
}else define('ROOT_WEEK_CATEGORY_ID','354');

if(!function_exists('mysql_escape_string')) {
	function mysql_escape_string($str) {
		return preg_replace('~[\x00\x0A\x0D\x1A\x22\x27\x5C]~u', '\\\$0', $str);
	}
}

if(LOCAL_MODE){
  define('ROOT_TEST_CATEGORY_ID','243');
}else define('ROOT_TEST_CATEGORY_ID','529');
if(LOCAL_MODE){
  define('ROOT_PRATEST_CATEGORY_ID','242');
}else define('ROOT_PRATEST_CATEGORY_ID','528');

define('SPECIAL_USERS', 'maiphuong,hungd,long123,hungdoan,kienle,dungnau,kienle31052016,longlu92,HungD,thuyngaparis,kieuanh,dungthu50,loccocduoi,tranhuuhieu,dungthu');

function pzk_user_special() {
	static $rs;
	if($rs !== null) return $rs;
	if($username = pzk_session('username')) {
		if(strpos(SPECIAL_USERS, $username) !== false) {
			$rs = true;
		} else {
			$rs = false;
		}
		return $rs;
	} else {
		$rs = false;
	}
	return $rs;
}

define('USERS_NS', 'maiphuong');

function pzk_user_ns() {
	static $rs;
	if($rs !== null) return $rs;
	if($username = pzk_session('username')) {
		if(strpos(USERS_NS, $username) !== false) {
			$rs = true;
		} else {
			$rs = false;
		}
		return $rs;
	} else {
		$rs = false;
	}
	return $rs;
}

define('NS', 1183);
define('LECTURE_SCOPE_ALL', 			0);
define('LECTURE_SCOPE_LECTURE_ONLY', 	1);
define('LECTURE_SCOPE_EXERCISE_ONLY', 	2);
