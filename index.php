<?php
$startTime = microtime(true);
require_once __DIR__ . '/config.php';

// Chạy chế độ compile
if(COMPILE_MODE) {
	// include các thư viện và file hệ thống
	// require_once __DIR__ . '/compile/includes.php';
	require_once BASE_DIR . '/include.php';
	// chạy hệ thống
	require_once BASE_DIR . '/compile/pages/system_full.php';

	// load configuration & application instance
	pzk_loader()->importApplication();

	// run application
	pzk_app()->run();
} else {
	// include các thư viện và file hệ thống
	require_once __DIR__ . '/include.php';

	// Chạy hệ thống
	$sys = pzk_parse('system/full');


	// Include các cấu hình tùy chỉnh của gói
	if(pzk_request()->getPackagePath() && is_file(BASE_DIR . '/app/'.pzk_request()->getPackagePath().'/configuration.php'))
		require_once BASE_DIR . '/app/'.pzk_request()->getPackagePath().'/configuration.php';

	// Include các cấu hình tùy chỉnh của ứng dụng
	if(is_file(BASE_DIR . '/app/'.pzk_request()->getAppPath().'/configuration.php'))
		require_once BASE_DIR . '/app/'.pzk_request()->getAppPath().'/configuration.php';

	// Include các cấu hình tùy chỉnh của phần mềm
	if(is_file(BASE_DIR . '/app/'.pzk_request()->getAppPath().'/configuration.'.pzk_request()->get('softwareId').'.php'))
		require_once BASE_DIR . '/app/'.pzk_request()->getAppPath().'/configuration.'.pzk_request()->get('softwareId').'.php';


	// Chạy ứng dụng
	$app = $sys->getApp();
	$app->run();

	$endTime = microtime(true);
	if(isset($_REQUEST['showTime'])) echo (($endTime-$startTime) * 1000);

	// shutdown hệ thống
	pzk_system()->halt();
}
