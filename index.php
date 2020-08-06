<?php
$startTime = microtime(true);
require_once __DIR__ . '/config.php';

// Chạy chế độ compile
if(COMPILE_MODE) {
	// include các thư viện và file hệ thống
	// require_once __DIR__ . '/compile/includes.php';
	require_once __DIR__ . '/include.php';
	// chạy hệ thống
	require_once __DIR__ . '/compile/pages/system_full.php';

	$request = pzk_request();
	// include các cấu hình tùy chỉnh của gói
	if($request->getPackagePath() && is_file(BASE_DIR . '/app/'.$request->getPackagePath().'/configuration.php'))
		require_once BASE_DIR . '/app/'.$request->getPackagePath().'/configuration.php';

	// include cấu hình tùy chỉnh của ứng dụng
	if(is_file(BASE_DIR . '/app/'.$request->getAppPath().'/configuration.php'))
		require_once BASE_DIR . '/app/'.$request->getAppPath().'/configuration.php';

	// include cấu hình tùy chỉnh của phần mềm
	if(is_file(BASE_DIR . '/app/'.$request->getAppPath().'/configuration.'.$request->get('softwareId').'.php'))
		require_once BASE_DIR . '/app/'.$request->getAppPath().'/configuration.'.$request->get('softwareId').'.php';


	// chạy ứng dụng
	$sys = pzk_element('system');
	$application = $request->get('app');
	require_once __DIR__ . '/compile/pages/app_'.$application.'_'.$sys->bootstrap.'.php';

	$app = pzk_app();

	// Chạy controller action
	$controller = $request->get('controller');
	$controller = ucfirst($controller);
	$request->set('controller', $controller);
	$action = $request->get('action');
	// Khởi tạo controller
	$controllerObject = $app->_getController($controller);
	if(!$controllerObject) die('No controller ' .$controller);
	pzk_global()->set('controller', $controllerObject);

	// Tìm action của controller và chạy
	$actionMethod = $action.'Action';
	if(method_exists($controllerObject, $actionMethod)){

		$result = $controllerObject->$actionMethod($request->getSegment(3), $request->getSegment(4), $request->getSegment(5), $request->getSegment(6), $request->getSegment(7));
		if($request->get('isService')) {
			echo json_encode($result);
		}
		$endTime = microtime(true);
		if(isset($_REQUEST['showTime']))  {
			echo (($endTime-$startTime) * 1000);
			echo '<br />';
			echo_memory_usage() . "\n"; // 36640
		}

		$sys->halt();
	} else {

		// không có action trong hệ thống
		$sys->halt('No route ' . $action);
	}
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
