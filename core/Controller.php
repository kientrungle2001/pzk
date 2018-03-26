<?php

class PzkController extends PzkSG{
	public $masterStructure 	= 'masterStructure';
	public $masterPage 			= false;
	public $masterPosition 		= 'left';
	
	public $subMasterPage 		= false;
	public $subMasterPosition	= false;
	
	public $xml 				= false;
	public $json 				= false;
	public $varexport 			= false;
	
	public function __construct() {
		$this->loadPropertiesFromXml();
		$this->loadPropertiesFromJson();
		$this->loadPropertiesFromPhp();
		
	}
	public function loadPropertiesFromXml() {
		if($this->get('xml')) {
			$file = strtolower(pzk_app()->getUri('xml/' . str_replace('_', '/', pzk_request()->get('controller')) . '/' . pzk_request()->get('action')) . '.xml');
			if(is_file(BASE_DIR . '/' . $file)) {
				$arr = pzk_array();
				$arr->fromXml(file_get_contents($file));
				$arr = $arr->getData();
				foreach($arr as $key => $val) {
					$this->set($key, $val);
				}
			}
		}
	}
	public function loadPropertiesFromJson() {
		if($this->get('json')) {
			$file = strtolower(pzk_app()->getUri('json/' . str_replace('_', '/', pzk_request()->get('controller')) . '/' . pzk_request()->get('action')) . '.json');
			if(is_file(BASE_DIR . '/' . $file)) {
				$content = file_get_contents($file);
				$arr = json_decode($content, true);
				foreach ($arr as $key => $val) {
					$this->set($key, $val);
				}
			}
		}
	}
	
	public function loadPropertiesFromPhp() {
		if($this->get('varexport')) {
			$file = strtolower(pzk_app()->getUri('var/' . str_replace('_', '/', pzk_request()->get('controller')) . '/' . pzk_request()->get('action')) . '.php');
			if(is_file(BASE_DIR . '/' . $file)) {
				$content = file_get_contents($file);
				$arr = array();
				eval('$arr = ' . $content . ';');
				foreach ($arr as $key => $val) {
					$this->set($key, $val);
				}
			}
		}
	}
	
	public function loadLayout() {
		$controller = strtolower(pzk_request('controller'));
		$action = pzk_request('action');
		$theme = pzk_request('defaultTheme');
		$controller_layout = _db()->select('*')->from('site_controller_layout')
			->whereStatus('1')->whereController_name($controller)
			->whereAction_name($action)
			->where(array('in', 'theme', array("$theme", "''")))
			->result_one();
		if($controller_layout) {
			$layout = $controller_layout['name'];
			$base_controller = @$controller_layout['base_controller'];
			$base_action = @$controller_layout['base_action'];
			$base_theme = @$controller_layout['base_theme'];
			$masterPage = $this->parse($layout);
			$modules = _db()->selectAll()->fromSite_module()
				->whereStatus('1')->whereModule_controller($controller)
				->where(array('in', 'module_controller', array("$controller", "$base_controller")))
				->where(array('in', 'module_action', array("$action", "$base_action")))
				->where(array('in', 'module_theme', array("$theme", "$base_theme")))
				->whereModule_layout($layout)->orderBy('ordering asc')
				->result();
			foreach($modules as $module) {
				$position = pzk_element($module['position']);
				if($position) {
					$position->append($this->parse($module['code']));
				}
			}
			$this->setPage($masterPage);
		}
	}
	public function parse($uri) {
		if($uri instanceof PzkObject) return $uri;
		if(strpos($uri, '<') !==false) return pzk_parse($uri);
		if($realUri = pzk_layoutcache()->get($uri.'pages')) {
			return pzk_parse($realUri);
		}
		$themes = pzk_request()->get('themes');
		
		if($themes) {
			foreach($themes as $theme) {
				$themeUri = str_replace('app/', 'Themes/' . $theme . '/', pzk_app()->getPageUri($uri));
				
				if(is_file($file = BASE_DIR . '/' . $themeUri . '.php')) {
					pzk_layoutcache()->set($uri.'pages', $themeUri);
					return pzk_parse($themeUri);
				}
			}
			
			foreach($themes as $theme) {
				$themeUri = 'Themes/' . $theme . '/pages/'.$uri;
				if(is_file($file = BASE_DIR . '/' . $themeUri . '.php')) {
					pzk_layoutcache()->set($uri.'pages', $themeUri);
					return pzk_parse($themeUri);
				}
				
			}
		}
		
		if($themes) {
			foreach($themes as $theme) {
				$themeUri = pzk_app()->getPageUri($theme . '/' . $uri);
				if(is_file($file = BASE_DIR . '/' . $themeUri . '.php')) {
					pzk_layoutcache()->set($uri.'pages', $themeUri);
					return pzk_parse($themeUri);
				}
				
				
			}
		}
		
		
		// app page
		if(is_file($file = BASE_DIR . '/' . pzk_app()->getPageUri($uri) . '.php')) {
			pzk_layoutcache()->set($uri.'pages', pzk_app()->getPageUri($uri));
			return pzk_parse(pzk_app()->getPageUri($uri));	
		}
		
		
		// package
		if($themes) {
			// package theme folder
			foreach($themes as $theme) {
				$themeUri = pzk_app()->getPackagePageUri($theme . '/' . $uri);
				if(is_file($file = BASE_DIR . '/' . $themeUri . '.php')) {
					pzk_layoutcache()->set($uri.'pages', $themeUri);
					return pzk_parse($themeUri);
				}
				
			}
			
			// themes folder
			foreach($themes as $theme) {
				$themeUri = str_replace('app/', 'Themes/' . $theme . '/', pzk_app()->getPackagePageUri($uri));
					if(is_file($file = BASE_DIR . '/' . $themeUri . '.php')) {
						pzk_layoutcache()->set($uri.'pages', $themeUri);
						return pzk_parse($themeUri);
					}
				
			}
		}
		
		// default
		if(is_file($file = BASE_DIR . '/' . pzk_app()->getPackagePageUri($uri) . '.php')) {
			pzk_layoutcache()->set($uri.'pages', pzk_app()->getPackagePageUri($uri));
			return pzk_parse(pzk_app()->getPackagePageUri($uri));
		}
		pzk_layoutcache()->set($uri.'pages', 'Default/pages/' . $uri);
		return pzk_parse('Default/pages/' . $uri);
	}
	
	public function getModel($model) {
		return pzk_loader()->getModel($model);
	}
	
	public function model($model, $name = null) {
		if(!$name)
			return pzk_model($model);
		else {
			return $this->$name = pzk_model($model);
		}
	}
	
	public function entity($entity, $id = null) {
		$entityInstance = _db()->getEntity($entity);
		if($id) {
			$entityInstance->load($id);
		}
		return $entityInstance;
	}
	
	public function tableEntity($table, $id = null) {
		$entityInstance = _db()->getTableEntity($table);
		if($id) {
			$entityInstance->load($id);
		}
		return $entityInstance;
	}
	
	public function initPage() {
		$page = $this->parse(pzk_or($this->get('masterPage'), $this->get('masterStructure')));
		if($this->get('subMasterPage')) {
			$this->append($this->get('subMasterPage'), $this->get('masterPosition'));
		}
		$this->set('page', $page);
		return $this;
	}
	
	public function append($obj, $position = NULL) {
		$obj = $this->parse($obj);
		if($position){
			pzk_element($position)->append($obj);
		} else {
			pzk_element(pzk_or($this->get('subMasterPosition'), $this->get('masterPosition')))->append($obj);
		}
		return $this;
	}
	
	public function display() {
		if(!$this->get('isPreventingDisplay'))
			$this->get('page')->display();
		return $this;
	}
	public function render($page) {
		$this->initPage();
		$this->append($page);
		$this->display();
		return $this;
	}
	public function redirect($action, $query = false) {
		if(strpos($action, 'http') !== false) {
			pzk_request()->redirect($action);
		}
		$parts = explode('/', $action);
		if(!@$parts[1] || is_numeric(@$parts[1])) {
			pzk_request()->redirect(pzk_request()->buildAction($action, $query));
		} else {
			pzk_request()->redirect(pzk_request()->build($action, $query));
		}
	}
	
	public function validate($row, $validator) {
		if(isset($validator) && $validator) {
			$result = pzk_validate($row, $validator);
			if($result !== true) {
				foreach($result as $field => $messages) {
					foreach($messages as $message) {
						pzk_notifier()->addMessage($message, 'warning');
					}
				}
				return false;
			}
		}
		return true;
	}
	
	public $events = array();
	public function fireEvent($event, $data = NULL) {
		$eventHandlers = isset($this->events[$event]) ? $this->events[$event]: array();
		foreach ($eventHandlers as $handler) {
			$tmp = explode('.', $handler);
			$action = 'handle';
			if(isset($tmp[1])) { 
				$action = $tmp[1]; 
			}
			$obj = isset($tmp[0]) ? $tmp[0] : null;
			if($obj == 'this') {
				$h = $this;
			} else {
				$h = pzk_element($obj);
				if(!$h) {
					if(strpos($obj, '<') !== false) {
						$h = $this->parse($obj);
					} else {
						$obj = implode('.', explode('_', $obj));
						$h = pzk_model($obj);
					}
					
				}
			}
			if($h) {
				$h->$action($event, $data);
			}
		}
	}
	
	public function addEventListener($event, $handler){
		if(!isset($this->events[$event])) {
			$this->events[$event] = array();
		}
		$this->events[$event][] = $handler;
	}
	/*
	public function __call($name, $arguments) {	
		$prefix = substr($name, 0, 3);
		$property = strtolower($name[3]) . substr($name, 4);
		switch ($prefix) {
			case 'get':
				return $this->$property;
				break;
			case 'set':
				//Always set the value if a parameter is passed
				if (count($arguments) != 1) {
					throw new \Exception("Setter for $name requires exactly one parameter.");
				}
				$this->$property = $arguments[0];
				//Always return this (Even on the set)
				return $this;
		}
		
		$prefix5 = substr($name, 0, 5);
		$property5 = strtolower($name[5]) . substr($name, 6);
		switch ($prefix5) {
			case 'parse':
				return $this->parse(str_replace('_', '/', $property5));
				break;
		}
		
		$prefix6 = substr($name, 0, 6);
		$property6 = strtolower($name[6]) . substr($name, 7);
		switch ($prefix6) {
			case 'append':
				return $this->append(str_replace('_', '/', $property6));
				break;
			case 'render':
				return $this->render(str_replace('_', '/', $property6));
				break;
			default:
				throw new \Exception("Property $name doesn't exist.");
				break;
		}
	}
	*/
	
	public function obj($obj, $data = null) {
		$objInstance = null;
		if($obj) {
			$objInstance = pzk_obj($obj);
		} else {
			$objInstance = pzk_obj('Block');
		}
		if($data) {
			foreach($data as $key => $val) {
				$objInstance->set($key, $val);
			}
		}
		return $objInstance;
	}
	
	public function layout() {
		$this->initPage();
	}
	
	public $isPreventingDisplay = false;
	public function preventDisplay() {
		$this->setIsPreventingDisplay(true);
	}
	public function unpreventDisplay() {
		$this->setIsPreventingDisplay(false);
	}
	public function load($name, $type = 'lib') {
		require_once BASE_DIR . '/' . $type . '/' . $name . '.php';
	}
	
	public function renderLayout($layout, $obj = null, $data = null) {
		$objInstance = null;
		if($obj) {
			$objInstance = $this->obj($obj);
		} else {
			$objInstance = $this->obj('Block');
		}
		$objInstance->set('layout', $layout);
		if($data) {
			foreach($data as $key => $val) {
				$objInstance->set($key, $val);
			}
		}
		$this->render($objInstance);
	}
	
	public function renderObj($obj, $data = null) {
		$this->render($this->obj($obj, $data));
	}
	
	public function renderDetail($layout, $data = null) {
		return $this->renderLayout($layout, 'Core.Db.Detail', $data);
	}
	
	public function renderListing($layout, $data = null) {
		return $this->renderLayout($layout, 'Core.Db.List', $data);
	}
}
