<?php

class PzkCoreApplication extends PzkObjectLightWeight {

	/**
	 * Tên ứng dụng
	 * @var string
	 */
    public $name = false;
    public $libraries = array();
    public $controller = false;
	
    /**
     * Chạy controller
     */
	public function run() {
		if($ref = pzk_request()->getRef() || $ref = pzk_session()->getRefId()) {
			pzk_session()->setRefId( $ref);
		}
		if(($coupon = pzk_request()->getCoupon()) || ($coupon = pzk_session()->getCoupon())) {
			// tim xem co ma coupon khong
			// luu refId va discount
			$model = pzk_model('Service.Coupon');
			$model->checkCode($coupon);
		}
		$request = pzk_request();
		$controller = $request->getController('Home');
		$action =  $request->getAction('index');
		$controllerObject = $this->_getController($controller);
		if(!$controllerObject) pzk_system()->halt('No controller ' .$controller);
		pzk_global()->setController( $controllerObject);
		if(method_exists($controllerObject, $action . 'Action')) {
			$method = new ReflectionMethod($controllerObject, $action . 'Action');
			$params = $method->getParameters();
			$paramsArray = array();
			foreach($params as $index => $param) {
				$paramValue = pzk_request()->getSegment(3+$index);
				$paramsArray[] = $paramValue;
			}
			call_user_func_array(array($controllerObject, $action . 'Action'), $paramsArray);
			pzk_system()->halt();
		}
		else {
			pzk_system()->halt('No route ' . $action);
		}
	}
	
	/**
	 * Trả về instance của controller
	 * @param string $controller tên controller, dạng user, hoặc admin_user
	 * @return PzkController
	 */
	public function _getController($controller) {
		$layoutcache = pzk_layoutcache();
		// neu da cache
		if(CACHE_MODE && $layoutcache->get($controller. 'path')) {
			$path = $layoutcache->get($controller. 'path');
			$class = $layoutcache->get($controller.'class');
			if(!class_exists($class)) {
				require_once $path;
			}
			return new $class();
		}
		
		$parts = $this->getParts($controller);
		
		$controllerFileName = implode('/', $parts) . '.php';
		
		$controllerFindPaths = array();
		
		$fileName = null;
		
		// tim kiem controller trong themes
		$themes = pzk_request()->getThemes();
		if($themes) {
			foreach($themes as $theme) {
				$controllerFindPaths[]	=	'Themes/' . $theme. '/controller/';
			}
		}
		
		// tim kiem trong app va package hoac default
		$controllerFindPaths[]	= 	$this->getUri('controller/');
		$controllerFindPaths[]	= 	$this->getPackageUri('controller/');
		$controllerFindPaths[]	= 	'Default/controller/';
		
		// xem controller load o dau
		foreach($controllerFindPaths as $path) {
			if(is_file(BASE_DIR . '/' . ($tmp = $path . $controllerFileName))) {
				$fileName 		=	$tmp;
				break;
			}
		}
		
		// neu khong thay file controller
		if(null === $fileName) {
			pzk_system()->halt('Controller không tồn tại');
		}
		
		// lay ten class cua controller
		$controllerClass = $this->getControllerClass($parts);
		
		// lay ten class cua controller khi da compile
		$fileNameCompiled = str_replace('/', '_', $fileName);
		$controllerClassCompiled = str_replace('.php', '', $fileNameCompiled);
		
		$partsCompiled = $this->getParts($controllerClassCompiled);
		if(		@$partsCompiled[1] 	== 'controller') 	{ 	array_splice($partsCompiled, 1, 1); } 
		else if(@$partsCompiled[2] 	== 'controller') 	{ 	array_splice($partsCompiled, 2, 1); } 
		else if(@$partsCompiled[3] 	== 'controller') 	{ 	array_splice($partsCompiled, 3, 1); } 
		else if(@$partsCompiled[4] 	== 'controller') 	{ 	array_splice($partsCompiled, 4, 1); }
		
		$controllerClassCompiled = $this->getControllerClass($partsCompiled);
		
		// kiem tra xem da compile chua hoac file controller co thay doi
		if(!is_file(BASE_DIR . '/compile/controllers/' . $fileNameCompiled)  
				|| (filemtime(BASE_DIR . '/compile/controllers/' . $fileNameCompiled) < filemtime((BASE_DIR .  '/' . $fileName )))) {
			// noi dung file controller
			$fileContent 			= file_get_contents(BASE_DIR . '/' . $fileName);
			
			// noi dung duoc compile
			$fileContentCompiled 	= str_replace($controllerClass, $controllerClassCompiled, $fileContent);
			
			file_put_contents('compile/controllers/' . $fileNameCompiled, $fileContentCompiled);
		}
		
		// cache lai path va class
		if(CACHE_MODE) {
			$layoutcache->set($controller.'path', BASE_DIR . '/compile/controllers/' . $fileNameCompiled);
			$layoutcache->set($controller.'class', $controllerClassCompiled);
		}
		// ket qua
		require_once BASE_DIR . '/compile/controllers/' . $fileNameCompiled;
		return new $controllerClassCompiled();
		
	}
	
	public function getParts($controller) {
		$parts = explode('_', $controller);
		$parts[count($parts)-1] = ($parts[count($parts)-1]);
		return $parts;
	}
	
	public function getControllerClass($parts) {
		return PzkParser::getClass($parts) . 'Controller';
	}
	
	/**
	 * 
	 * @param unknown $controller
	 * @param unknown $package
	 * @return multitype:string
	 */
	public function generateController($controller, $package) {
		if($className = pzk_layoutcache()->get($controller . '-' . $package . '-class')) {
			$classPath = pzk_layoutcache()->get($controller . '-' . $package . '-path');
			return array(
				'filePath' 	=> $classPath,
				'className'	=> $className
			);
		}
		$parts = $this->getParts($controller);
		if(is_file(BASE_DIR . '/' . ($tmp = $package . '/controller/' . implode('/', $parts) . '.php'))) {
			$fileName = $tmp;
			$fileNameCompiled = str_replace('/', '_', $fileName);
			$controllerClass = $this->getControllerClass( $parts );
			$controllerClassCompiled = str_replace('.php', '', $fileNameCompiled);
			$partsCompiled = explode('_', $controllerClassCompiled);
			if(		@$partsCompiled[1] == 'controller') { 	array_splice($partsCompiled, 1, 1); } 
			else if(@$partsCompiled[2] == 'controller') { 	array_splice($partsCompiled, 2, 1); } 
			else if(@$partsCompiled[3] == 'controller') { 	array_splice($partsCompiled, 3, 1); }
			$controllerClassCompiled = $this->getControllerClass($partsCompiled);
			if(!is_file(BASE_DIR . '/compile/controllers/' . $fileNameCompiled) 
					|| (filemtime(BASE_DIR . '/compile/controllers/' . $fileNameCompiled) < filemtime((BASE_DIR .  '/' . $fileName )))) {
				$fileContent = file_get_contents(BASE_DIR . '/' . $fileName);
				$fileContentReplaced = str_replace($controllerClass, $controllerClassCompiled, $fileContent);
				file_put_contents('compile/controllers/' . $fileNameCompiled, $fileContentReplaced);
			}
			
			$result = array(
				'filePath' 	=> BASE_DIR . '/compile/controllers/' . $fileNameCompiled,
				'className'	=> $controllerClassCompiled
			);
			pzk_layoutcache()->set($controller . '-' . $package . '-class', $result['className']);
			pzk_layoutcache()->set($controller . '-' . $package . '-path', $result['filePath']);
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
    public function getUri($path) {
        return 'app/' . $this->getPathByName() . '/' . $path;
    }

    /**
     * Trả về đường dẫn của page
     * @param string $page tên page, dạng index,user/info
     * @return string đường dẫn dạng app/ptnn/pages/index
     */
    public function getPageUri($page) {
		$page = preg_replace('/^\//', '', $page);
        return $this->getUri('pages/' . $page);
    }
    
    /**
     * Trả về đường dẫn theo ứng dụng
     * @param string $path đường dẫn, dạng application
     * @return string đường dẫn trả về, dạng app/ptnn/application
     */
    public function getPackageUri($path) {
    	return 'app/' . $this->getPackageByName() . '/' . $path;
    }
    
    /**
     * Trả về đường dẫn của page
     * @param string $page tên page, dạng index,user/info
     * @return string đường dẫn dạng app/ptnn/pages/index
     */
    public function getPackagePageUri($page) {
    	$page = preg_replace('/^\//', '', $page);
    	return $this->getPackageUri('pages/' . $page);
    }
    
    /**
     * Kiểm tra xem có tồn tại uri không
     * @param unknown $path
     * @return boolean
     */
    public function existsUri($path) {
    	return is_file(BASE_DIR. '/'. $this->getUri($path) . '.php');
    }
    
    /**
     * Có tồn tại page không
     * @param unknown $path
     * @return boolean
     */
    public function existsPageUri($path) {
    	return is_file(BASE_DIR. '/'. $this->getPageUri($path) . '.php');
    }
    
    /**
     * Lấy đường dẫn của ứng dụng theo tên
     * @return unknown|mixed
     */
    public function getPathByName() {
    	static $path;
    	if($path) return $path;
    	$path = str_replace('_', '/', $this->name);
    	return $path;
    }
    
    /**
     * Lấy đường dẫn của gói theo tên
     * @return unknown|string
     */
    public function getPackageByName() {
    	static $package;
    	if($package) return $package;
    	$packages = explode('_', $this->name);
    	array_pop($packages);
    	$package = implode('/', $packages);
    	return $package;
    }

}
/**
 * Return application element
 *
 * @return PzkCoreApplication
 */
function pzk_app() {
	return pzk_element()->getApp();
}

/**
 * Trả về controller đang chạy
 * @return PzkController
 */
function pzk_controller() {
	return pzk_global()->getController();
}

/**
 * Trả về admin controller đang chạy
 * @return PzkAdminController
 */
function pzk_admin_controller() {
	return pzk_global()->getController();
}
/**
 * Trả về grid admin controller đang chạy
 * @return PzkGridAdminController
 */
function pzk_grid_admin_controller() {
	return pzk_global()->getController();
}

/**
 * Import controller trong package đã 
 * @param String $package gói
 * @param String $controller tên controller
 * @return String tên class
 */
function pzk_import_controller ($package, $controller) {
	$arr = pzk_app()->generateController($controller, $package);
	require_once $arr['filePath'];
	return $arr['className'];
}

if(!is_dir(BASE_DIR . '/compile/controllers')) {
	mkdir(BASE_DIR . '/compile/controllers');
}

?>