<?php

class PzkCoreApplication extends PzkObjectLightWeight
{

	/**
	 * Tên ứng dụng
	 * @var string
	 */
	public $name = false;
	public $libraries = array();
	public $controller = false;

	/**
	 * Chạy application
	 */
	public function run()
	{
		# check người giới thiệu
		if ($ref = pzk_request()->getRef() || $ref = pzk_session()->getRefId()) {
			pzk_session()->setRefId($ref);
		}

		#check coupon
		if (($coupon = pzk_request()->getCoupon()) || ($coupon = pzk_session()->getCoupon())) {
			// tim xem co ma coupon khong
			// luu refId va discount
			$model = pzk_model('Service.Coupon');
			$model->checkCode($coupon);
		}

		# lấy controller instance
		$request = pzk_request();
		$controller = $request->getController('Home');
		$action =  $request->getAction('index');
		$controllerObject = $this->getControllerInstance($controller);

		# controller instance không tồn tại
		if (!$controllerObject) pzk_system()->halt('No controller ' . $controller);

		# lưu controller vào global
		pzk_global()->setController($controllerObject);

		# nếu tồn tại action
		if (method_exists($controllerObject, $action . 'Action')) {
			$method = new ReflectionMethod($controllerObject, $action . 'Action');
			$params = $method->getParameters();
			$paramsArray = array();
			foreach ($params as $index => $param) {
				$paramValue = pzk_request()->getSegment(3 + $index);
				$paramsArray[] = $paramValue;
			}

			# gọi action
			call_user_func_array(array($controllerObject, $action . 'Action'), $paramsArray);

			# dừng hệ thống
			pzk_system()->halt();
		} else {
			pzk_system()->halt('No route ' . $action);
		}
	}

	/**
	 * Trả về instance của controller
	 * @param string $controller tên controller, dạng user, hoặc admin_user
	 * @return PzkController
	 */
	public function getControllerInstance($controller)
	{
		$layoutcache = pzk_cache_controller();

		# nếu đã cache
		if (CACHE_MODE && $layoutcache->has($controller . 'path')) {
			$path = $layoutcache->get($controller . 'path');
			$class = $layoutcache->get($controller . 'class');
			if (!class_exists($class)) {
				require_once $path;
			}
			return new $class();
		}

		# chưa cache
		# Tách các thư mục của controller theo dấu _
		$parts = $this->getParts($controller);

		# tên file controller
		$controllerFileName = implode(DS, $parts) . PHP_EXT;

		# thư mục để tìm controller
		$controllerFindPaths = array();

		$fileName = null;

		# tim kiem controller trong themes
		$themes = pzk_request()->getThemes();
		foreach (array_cast($themes) as $theme) {
			$controllerFindPaths[]	=	THEMES_FOLDER . DS . $theme . DS . CONTROLLER_FOLDER . DS;
		}

		# tim kiem trong app va package hoac default
		$controllerFindPaths[]	= 	$this->getUri(CONTROLLER_FOLDER . DS);
		$controllerFindPaths[]	= 	$this->getPackageUri(CONTROLLER_FOLDER . DS);
		$controllerFindPaths[]	= 	DEFAULT_FOLDER . DS . CONTROLLER_FOLDER . DS;

		# xem controller load o dau
		foreach ($controllerFindPaths as $path) {
			if (is_file(BASE_DIR . DS . ($tmp = $path . $controllerFileName))) {
				$fileName 		=	$tmp;
				break;
			}
		}

		// neu khong thay file controller
		if (null === $fileName) {
			pzk_system()->halt("Controller $controllerFileName không tồn tại");
		}

		// lay ten class cua controller
		$controllerClass = $this->getControllerClass($parts);

		// lay ten class cua controller khi da compile
		$fileNameCompiled = str_replace(DS, UNS, $fileName);
		$controllerClassCompiled = str_remove(PHP_EXT, $fileNameCompiled);

		$partsCompiled = $this->getParts($controllerClassCompiled);

		// bỏ thư mục controller ra khỏi tên controller
		array_remove($partsCompiled, CONTROLLER_FOLDER);
		array_remove($partsCompiled, ucfirst(CONTROLLER_FOLDER));

		$controllerClassCompiled = $this->getControllerClass($partsCompiled);

		// kiem tra xem da compile chua hoac file controller co thay doi
		if (
			!is_file(COMPILE_DIR . DS . CONTROLLER_FOLDER . DS . $fileNameCompiled)
			|| (filemtime(COMPILE_DIR . DS . CONTROLLER_FOLDER . DS . $fileNameCompiled) < filemtime((BASE_DIR .  '/' . $fileName)))
		) {
			// noi dung file controller
			$fileContent 			= file_get_contents(BASE_DIR . DS . $fileName);

			// noi dung duoc compile
			$fileContentCompiled 	= str_replace($controllerClass, $controllerClassCompiled, $fileContent);

			file_put_contents(COMPILE_DIR . DS . CONTROLLER_FOLDER . DS . $fileNameCompiled, $fileContentCompiled);
		}

		// cache lai path va class
		if (CACHE_MODE) {
			$layoutcache->set($controller . 'path', COMPILE_DIR . DS . CONTROLLER_FOLDER . DS . $fileNameCompiled);
			$layoutcache->set($controller . 'class', $controllerClassCompiled);
		}
		// ket qua
		require_once COMPILE_DIR . DS . CONTROLLER_FOLDER . DS . $fileNameCompiled;
		return new $controllerClassCompiled();
	}

	public function getParts($controller)
	{
		$parts = explode(UNS, $controller);
		$parts = array_map(function ($p) {
			return ucfirst($p);
		}, $parts);
		return $parts;
	}

	public function getControllerClass($parts)
	{
		return PzkParser::getClass($parts) . 'Controller';
	}

	/**
	 * Generate ra file controller theo package cố định
	 * @param String $controller
	 * @param String $package
	 * @return array(string filePath, string className)
	 */
	public function generateController($controller, $package)
	{
		if ($className = pzk_cache_controller()->get($controller . '-' . $package . '-class')) {
			$classPath = pzk_cache_controller()->get($controller . '-' . $package . '-path');
			return array(
				'filePath' 	=> $classPath,
				'className'	=> $className
			);
		}
		$parts = $this->getParts($controller);
		if (is_file($filePath = BASE_DIR . DS . ($fileName
			= $package . DS . CONTROLLER_FOLDER . DS . implode(DS, $parts) . PHP_EXT))) {
			$fileNameCompiled = str_replace(DS, UNS, $fileName);
			$controllerClass = $this->getControllerClass($parts);
			$controllerClassCompiled = str_remove(PHP_EXT, $fileNameCompiled);
			$partsCompiled = explode(UNS, $controllerClassCompiled);
			array_remove($partsCompiled, CONTROLLER_FOLDER);
			array_remove($partsCompiled, ucfirst(CONTROLLER_FOLDER));
			$controllerClassCompiled = $this->getControllerClass($partsCompiled);
			if (
				!is_file($fileNameCompiledPath = COMPILE_DIR . DS . CONTROLLER_FOLDER . DS . $fileNameCompiled)
				|| (filemtime($fileNameCompiledPath) < filemtime($filePath))
			) {
				$fileContent = file_get_contents(BASE_DIR . '/' . $fileName);
				$fileContentReplaced = str_replace($controllerClass, $controllerClassCompiled, $fileContent);
				file_put_contents($fileNameCompiledPath, $fileContentReplaced);
			}

			$result = array(
				'filePath' 	=> $fileNameCompiledPath,
				'className'	=> $controllerClassCompiled
			);
			pzk_cache_controller()->set($controller . '-' . $package . '-class', $result['className']);
			pzk_cache_controller()->set($controller . '-' . $package . '-path', $result['filePath']);
			return $result;
		} else {
			pzk_system()->halt('No controller ' . $controller . ' found in ' . $package . '!');
		}
	}

	/**
	 * Trả về đường dẫn theo ứng dụng
	 * @param string $path đường dẫn, dạng application
	 * @return string đường dẫn trả về, dạng app/ptnn/application
	 */
	public function getUri($path)
	{
		return APP_FOLDER . DS . $this->getPathByName() . DS . $path;
	}

	/**
	 * Trả về đường dẫn của page
	 * @param string $page tên page, dạng index,user/info
	 * @return string đường dẫn dạng app/ptnn/pages/index
	 */
	public function getPageUri($page)
	{
		$page = preg_replace('/^\//', '', $page);
		return $this->getUri(PAGES_FOLDER . DS . $page);
	}

	/**
	 * Trả về đường dẫn theo ứng dụng
	 * @param string $path đường dẫn, dạng application
	 * @return string đường dẫn trả về, dạng app/ptnn/application
	 */
	public function getPackageUri($path)
	{
		return APP_FOLDER . DS . $this->getPackageByName() . DS . $path;
	}

	/**
	 * Trả về đường dẫn của page
	 * @param string $page tên page, dạng index,user/info
	 * @return string đường dẫn dạng app/ptnn/pages/index
	 */
	public function getPackagePageUri($page)
	{
		$page = preg_replace('/^\//', '', $page);
		return $this->getPackageUri(PAGES_FOLDER . DS . $page);
	}

	/**
	 * Kiểm tra xem có tồn tại uri không
	 * @param unknown $path
	 * @return boolean
	 */
	public function existsUri($path)
	{
		return is_file(BASE_DIR . DS . $this->getUri($path) . PHP_EXT);
	}

	/**
	 * Có tồn tại page không
	 * @param unknown $path
	 * @return boolean
	 */
	public function existsPageUri($path)
	{
		return is_file(BASE_DIR . DS . $this->getPageUri($path) . PHP_EXT);
	}

	/**
	 * Lấy đường dẫn của ứng dụng theo tên
	 * @return unknown|mixed
	 */
	public function getPathByName()
	{
		static $path;
		if ($path) return $path;
		$path = str_replace(UNS, DS, $this->name);
		return $path;
	}

	/**
	 * Lấy đường dẫn của gói theo tên
	 * @return unknown|string
	 */
	public function getPackageByName()
	{
		static $package;
		if ($package) return $package;
		$packages = explode(UNS, $this->name);
		array_pop($packages);
		$package = implode(DS, $packages);
		return $package;
	}

	public function getTemplateUri($uri) {
		return $uri;
	}
}
/**
 * Return application element
 *
 * @return PzkCoreApplication
 */
function pzk_app()
{
	return pzk_element()->getApp();
}

/**
 * Trả về controller đang chạy
 * @return PzkController
 */
function pzk_controller()
{
	return pzk_global()->getController();
}

/**
 * Trả về admin controller đang chạy
 * @return PzkAdminController
 */
function pzk_admin_controller()
{
	return pzk_global()->getController();
}
/**
 * Trả về grid admin controller đang chạy
 * @return PzkGridAdminController
 */
function pzk_grid_admin_controller()
{
	return pzk_global()->getController();
}

/**
 * Import controller trong package đã 
 * @param String $package gói
 * @param String $controller tên controller
 * @return String tên class
 */
function pzk_import_controller($package, $controller)
{
	$arr = pzk_app()->generateController($controller, $package);
	require_once $arr['filePath'];
	return $arr['className'];
}
