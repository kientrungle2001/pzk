<?php
class PzkCoreLoader extends PzkObjectLightWeight{
	public $models;
	
	public function init() {
		$this->models = array();
	}

	/**
	 * Lấy đối tượng model 
	 * @param string $model tên model
	 * @return Model
	 */
	public function getModel($model){
		if (!isset($this->models[$model])) {
			$this->models[$model] = $this->createModel($model);
		}
		return $this->models[$model];
	}
	
	/**
	 * Tạo model
	 * @param string $model tên model
	 * @return Model
	 */
	public function createModel($model) {
		// neu da cache
		if(CACHE_MODE && pzk_cache_layout()->get($model. 'path')) {
			$path = pzk_cache_layout()->get($model. 'path');
			$class = pzk_cache_layout()->get($model.'class');
			require_once $path;
			return new $class();
		}
		
		$parts = $this->getParts($model);
		
		$modelFileName = implode('/', $parts) . '.php';
		
		$modelFindPaths = array();
		
		$fileName = null;
		
		// tim kiem model trong themes
		$themes = pzk_request()->getThemes();
		if($themes) {
			foreach($themes as $theme) {
				$modelFindPaths[]	=	'Themes/' . $theme. '/model/';
			}
		}
		
		// tim kiem trong app va package hoac default
		$modelFindPaths[]	= 	pzk_app()->getUri('model/');
		$modelFindPaths[]	= 	pzk_app()->getPackageUri('model/');
		$modelFindPaths[]	= 	'model/';
		
		// xem model load o dau
		foreach($modelFindPaths as $path) {
			if(is_file(BASE_DIR . '/' . ($tmp = $path . $modelFileName))) {
				$fileName 		=	$tmp;
				break;
			}
		}
		
		// neu khong thay file model
		if(null === $fileName) {
			echo '<pre>';
			debug_print_backtrace();
			echo '</pre>';
			pzk_system()->halt('Model '.$model.' không tồn tại');
		}
		
		// lay ten class cua model
		$modelClass = $this->getModelClass($parts);
		
		// lay ten class cua model khi da compile
		$fileNameCompiled = str_replace('/', '.', $fileName);
		$modelClassCompiled = str_replace('.php', '', $fileNameCompiled);
		
		$partsCompiled = $this->getParts($modelClassCompiled);
		if(			@$partsCompiled[0] 	== 'model') 	{ 	array_splice($partsCompiled, 0, 1); }
		else if(	@$partsCompiled[1] 	== 'model') 	{ 	array_splice($partsCompiled, 1, 1); } 
		else if(	@$partsCompiled[2] 	== 'model') 	{ 	array_splice($partsCompiled, 2, 1); } 
		else if(	@$partsCompiled[3] 	== 'model') 	{ 	array_splice($partsCompiled, 3, 1); } 
		else if(	@$partsCompiled[4] 	== 'model') 	{ 	array_splice($partsCompiled, 4, 1); }
		
		$modelClassCompiled = $this->getModelClass($partsCompiled);
		
		// kiem tra xem da compile chua hoac file model co thay doi
		if(!is_file(BASE_DIR . '/compile/model/' . $fileNameCompiled)  
				|| (filemtime(BASE_DIR . '/compile/model/' . $fileNameCompiled) < filemtime((BASE_DIR .  '/' . $fileName )))) {
			// noi dung file model
			$fileContent 			= file_get_contents(BASE_DIR . '/' . $fileName);
			
			// noi dung duoc compile
			$fileContentCompiled 	= str_replace($modelClass, $modelClassCompiled, $fileContent);
			
			file_put_contents('compile/model/' . $fileNameCompiled, $fileContentCompiled);
		}
		
		// cache lai path va class
		if(CACHE_MODE) {
			pzk_cache_layout()->set($model.'path', BASE_DIR . '/compile/model/' . $fileNameCompiled);
			pzk_cache_layout()->set($model.'class', $modelClassCompiled);
		}
		
		// ket qua
		require_once BASE_DIR . '/compile/model/' . $fileNameCompiled;
		return new $modelClassCompiled();
	}
	
	public function getParts($model) {
		$parts = explode('.', $model);
		$parts[count($parts)-1] = ucfirst($parts[count($parts)-1]);
		return $parts;
	}
	
	public function getModelClass($parts) {
		return PzkParser::getClass($parts) . 'Model';
	}
	
	/**
	 * Import một object
	 * @param string $uri đường dẫn dạng core/db/List
	 */
	public function importObject($uri, $package = '') {
		return PzkParser::generateObject($uri, $package);
	}
	
	/**
	 * Import một 3rdparty
	 * @param string $uri đường dẫn dạng core/db/List
	 */
	public function import3rdparty($uri) {
			require_once BASE_DIR . '/3rdparty/' . $uri . '.php';
	}
	
	public function generateModel($model, $package = '') {
		$parts = $this->getParts($model);
		if(is_file(BASE_DIR . '/' . ($tmp = ($package? $package. '/': '') . 'model/' . implode('/', $parts) . '.php'))) {
			$fileName = $tmp;
			$fileNameCompiled = str_replace('/', '_', $fileName);
			$modelClass = $this->getModelClass( $parts );
			$modelClassCompiled = str_replace('.php', '', $fileNameCompiled);
			$partsCompiled = explode('_', $modelClassCompiled);
			if(		@$partsCompiled[1] == 'model') { 	array_splice($partsCompiled, 1, 1); } 
			else if(@$partsCompiled[2] == 'model') { 	array_splice($partsCompiled, 2, 1); } 
			else if(@$partsCompiled[3] == 'model') { 	array_splice($partsCompiled, 3, 1); }
			$modelClassCompiled = $this->getModelClass($partsCompiled);
			if(!is_file(BASE_DIR . '/compile/model/' . $fileNameCompiled) 
					|| (filemtime(BASE_DIR . '/compile/model/' . $fileNameCompiled) < filemtime((BASE_DIR .  '/' . $fileName )))) {
				$fileContent = file_get_contents(BASE_DIR . '/' . $fileName);
				$fileContentReplaced = str_replace($modelClass, $modelClassCompiled, $fileContent);
				file_put_contents('compile/model/' . $fileNameCompiled, $fileContentReplaced);
			}
			
			return array(
				'filePath' 	=> BASE_DIR . '/compile/model/' . $fileNameCompiled,
				'className'	=> $modelClassCompiled
			);
		} else {
			pzk_system()->halt('No model ' . $model . ' found in ' . $package . '!');
		}
	}

	/**
	 * Import application configuration
	 */
	public function importApplicationConfigurations() {
		$request = pzk_request();
		// include các cấu hình tùy chỉnh của gói
		if($request->getPackagePath() 
			&& is_file($configFile = BASE_DIR . '/app/'.$request->getPackagePath().'/configuration.php'))
			require_once $configFile;

		// include cấu hình tùy chỉnh của ứng dụng
		if(is_file($configFile = BASE_DIR . '/app/'.$request->getAppPath().'/configuration.php'))
			require_once $configFile;

		// include cấu hình tùy chỉnh của phần mềm
		if(is_file($configFile = BASE_DIR . '/app/'.$request->getAppPath().'/configuration.'.$request->getSoftwareId().'.php'))
			require_once $configFile;
	}

	/**
	 * Import application instance
	 */
	public function createApplicationInstance() {
		// chạy ứng dụng
		$application = pzk_request()->getApp();
		$sys = pzk_element()->getSystem();
		require_once BASE_DIR . '/compile/pages/app_'.$application.'_'.$sys->bootstrap.'.php';
	}

	/**
	 * Import application: configuration & instance
	 */
	public function loadApplication() {
		$this->importApplicationConfigurations();
		$this->createApplicationInstance();
	}

}

/**
 * Trả về đối tượng PzkCoreLoader
 * @return PzkCoreLoader
 */
function pzk_loader() {
	return pzk_element()->getLoader();
}

/**
 * Lấy đối tượng model
 * @param string $name tên model dưới dạng edu.student
 * @return object
 */
function pzk_model($name, $newInstance = false) {
	if(is_array($name)) {
		$name = implode(DOT, $name);
	}
	if($newInstance) {
		return pzk_loader()->createModel($name);
	}
	return pzk_loader()->getModel($name);
}

function pzk_import_model($model, $package = '') {
	return pzk_loader()->generateModel($model, $package);
}
/**
 * Import một object theo đường dẫn
 * @param string $object đường dẫn dạng: Core.Db.List
 */
function pzk_import($object) {
	//$object = str_replace('.', '/', $object);
	return PzkParser::importObject($object);
}
