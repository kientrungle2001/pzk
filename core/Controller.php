<?php

class PzkController extends PzkSG
{
	/**
	 * @var String master layout page
	 */
	public $masterStructure 	= 'masterStructure';
	/**
	 * @var String master layout page
	 */
	public $masterPage 			= false;

	/**
	 * @var String default append position
	 */
	public $masterPosition 		= 'left';

	/**
	 * @var String sub layout page
	 */
	public $subMasterPage 		= false;

	/**
	 * @var String default append position in sub layout
	 */
	public $subMasterPosition	= false;

	public $xml 				= false;
	public $json 				= false;
	public $varexport 			= false;

	public function __construct()
	{
		$this->loadPropertiesFromXml();
		$this->loadPropertiesFromJson();
		$this->loadPropertiesFromPhp();
	}

	/**
	 * load configuration for controller from xml
	 * @return PzkCoreController
	 */
	public function loadPropertiesFromXml()
	{
		if ($this->getXml()) {
			$file = strtolower(pzk_app()->getUri('xml' . DS . str_replace(
				UNS,
				DS,
				pzk_request()->getController()
			) . DS . pzk_request()->getAction()) . '.xml');
			if (is_file(BASE_DIR . DS . $file)) {
				$arr = pzk_array();
				$arr->fromXml(file_get_contents($file));
				$arr = $arr->getData();
				foreach ($arr as $key => $val) {
					$this->set($key, $val);
				}
			}
		}
		return $this;
	}

	/**
	 * load configuration for controller from json
	 * @return PzkController
	 */
	public function loadPropertiesFromJson()
	{
		if ($this->getJson()) {
			$file = strtolower(pzk_app()->getUri('json' . DS . str_replace(UNS, DS, pzk_request()->getController()) . DS . pzk_request()->getAction()) . '.json');
			if (is_file(BASE_DIR . DS . $file)) {
				$content = file_get_contents($file);
				$arr = json_decode($content, true);
				foreach ($arr as $key => $val) {
					$this->set($key, $val);
				}
			}
		}
	}

	/**
	 * load configuration for controller from php
	 * @return PzkController
	 */
	public function loadPropertiesFromPhp()
	{
		if ($this->getVarexport()) {
			$file = strtolower(pzk_app()->getUri('var' . DS . str_replace(UNS, DS, pzk_request()->getController()) . DS . pzk_request()->getAction()) . '.php');
			if (is_file(BASE_DIR . DS . $file)) {
				$content = file_get_contents($file);
				$arr = array();
				eval('$arr = ' . $content . ';');
				foreach ($arr as $key => $val) {
					$this->set($key, $val);
				}
			}
		}
	}

	/**
	 * load module from database for controller action
	 * @return PzkController 
	 */
	public function loadLayout()
	{
		$controller = strtolower(pzk_request()->getController());
		$action = pzk_request()->getAction();
		$theme = pzk_request()->getDefaultTheme();
		$controller_layout = _db()->select('*')->from('site_controller_layout')
			->whereStatus('1')->whereController_name($controller)
			->whereAction_name($action)
			->where(array('in', 'theme', array("$theme", "''")))
			->result_one();
		if ($controller_layout) {
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
			foreach ($modules as $module) {
				$position = pzk_element($module['position']);
				if ($position) {
					$position->append($this->parse($module['code']));
				}
			}
			$this->setPage($masterPage);
		}
		return $this;
	}

	/**
	 * Parse mot file hoac xml text va tra ve object
	 * @return PzkObject
	 */
	public function parse($uri)
	{
		if ($uri instanceof PzkObject) return $uri;
		if (strpos($uri, '<') !== false) return pzk_parse($uri);
		if ($realUri = pzk_cache_pages()->get($uri)) {
			return pzk_parse($realUri);
		}
		$themes = pzk_request()->getThemes();

		# tim kiem trong themes xem co file xml ko, file xml nay kem theo ca ten package/application
		if ($themes) {
			# @example: Themes/Songngu/nobel/test/pages/index.php
			foreach ($themes as $theme) {
				$themeUri = str_replace(APP_FOLDER . DS, THEMES_FOLDER . DS . $theme . DS, pzk_app()->getPageUri($uri));

				if (is_file($file = BASE_DIR . DS . $themeUri . PHP_EXT)) {
					pzk_cache_pages()->set($uri, $themeUri);
					return pzk_parse($themeUri);
				}
			}

			# @example: Themes/Songngu/pages/index.php
			foreach ($themes as $theme) {
				$themeUri = THEMES_FOLDER . DS . $theme . DS . PAGES_FOLDER . DS . $uri;
				if (is_file($file = BASE_DIR . DS . $themeUri . PHP_EXT)) {
					pzk_cache_pages()->set($uri, $themeUri);
					return pzk_parse($themeUri);
				}
			}
		}

		if ($themes) {
			# @example: app/nobel/test/pages/Songngu/index.php
			foreach ($themes as $theme) {
				$themeUri = pzk_app()->getPageUri($theme . DS . $uri);
				if (is_file($file = BASE_DIR . DS . $themeUri . PHP_EXT)) {
					pzk_cache_pages()->set($uri, $themeUri);
					return pzk_parse($themeUri);
				}
			}
		}


		# @example: app/nobel/test/pages/index.php
		if (is_file(BASE_DIR . DS . ($pageUri = pzk_app()->getPageUri($uri)) . PHP_EXT)) {
			pzk_cache_pages()->set($uri, $pageUri);
			return pzk_parse($pageUri);
		}


		// package
		if ($themes) {
			# @example: app/nobel/pages/Songngu/index.php
			foreach ($themes as $theme) {
				$themeUri = pzk_app()->getPackagePageUri($theme . DS . $uri);
				if (is_file(BASE_DIR . DS . $themeUri . PHP_EXT)) {
					pzk_cache_pages()->set($uri, $themeUri);
					return pzk_parse($themeUri);
				}
			}

			# @example: Themes/Songngu/nobel/pages/index.php
			foreach ($themes as $theme) {
				$themeUri = str_replace(
					APP_FOLDER . DS,
					THEMES_FOLDER . DS . $theme . DS,
					pzk_app()->getPackagePageUri($uri)
				);
				if (is_file($file = BASE_DIR . DS . $themeUri . PHP_EXT)) {
					pzk_cache_pages()->set($uri, $themeUri);
					return pzk_parse($themeUri);
				}
			}
		}

		# @example: app/nobel/pages/index.php
		if (is_file(BASE_DIR . DS . ($pageUri = pzk_app()->getPackagePageUri($uri)) . PHP_EXT)) {
			pzk_cache_pages()->set($uri, $pageUri);
			return pzk_parse($pageUri);
		}

		# @example: Default/pages/index.php
		$pageUri = DEFAULT_FOLDER . DS . PAGES_FOLDER . DS . $uri;
		if (is_file(BASE_DIR . DS . $pageUri . PHP_EXT)) {
			pzk_cache_pages()->set($uri, $pageUri);
			return pzk_parse(DEFAULT_FOLDER . DS . PAGES_FOLDER . DS . $uri);
		}

		die('Không tìm thấy pages ' . $uri);
	}

	/**
	 * Khởi tạo model
	 * @param String $model: tên model cần load, dạng account.user  
	 * @return Object: instance của model
	 */
	public function getModel($model)
	{
		return pzk_loader()->getModel($model);
	}

	/**
	 * Khởi tạo model và gắn vào controller
	 * @param String $model: model cần khởi tạo
	 * @param String|null $name: Gắn vào controller với tên là $name
	 * @return Object: model vừa khởi tạo
	 */
	public function model($model, $name = null)
	{
		if (!$name)
			return pzk_model($model);
		else {
			return $this->$name = pzk_model($model);
		}
	}

	/**
	 * Load một entity theo id
	 * @param String $entity: entity cần khởi tạo
	 * @param int $id: id của entity
	 * @return PzkEntityModel
	 */
	public function entity($entity, $id = null)
	{
		$entityInstance = _db()->getEntity($entity);
		if ($id) {
			$entityInstance->load($id);
		}
		return $entityInstance;
	}

	/**
	 * Load một entity tổng quát theo tên bảng
	 * @param String $table: tên table
	 * @param int $id: id của entity
	 * @return PzkEntityTableModel
	 */
	public function tableEntity($table, $id = null)
	{
		$entityInstance = _db()->getTableEntity($table);
		if ($id) {
			$entityInstance->load($id);
		}
		return $entityInstance;
	}

	/**
	 * Init master page từ $masterPage và $subMasterPage
	 * @return PzkController
	 */
	public function initPage()
	{
		$page = $this->parse(pzk_or($this->getMasterPage(), $this->getMasterStructure()));
		if ($this->getSubMasterPage()) {
			$this->append($this->getSubMasterPage(), $this->getMasterPosition());
		}
		$this->setPage($page);
		return $this;
	}

	/**
	 * Append một đối tượng vào vị trí trong page
	 * @param String|PzkObject $object đối tượng cần append
	 * @param String $position vị trí đặt đối tượng
	 * @return PzkController $this
	 */
	public function append($obj, $position = NULL)
	{
		$obj = $this->parse($obj);
		if ($position) {
			pzk_element($position)->append($obj);
		} else {
			pzk_element(pzk_or($this->getSubMasterPosition(), $this->getMasterPosition()))->append($obj);
		}
		return $this;
	}

	/**
	 * Hiển thị page
	 * @return PzkController $this
	 */
	public function display()
	{
		if (!$this->getIsPreventingDisplay())
			$this->getPage()->display();
		return $this;
	}

	/**
	 * Hiển thị cả trang có đặt đối tượng
	 * @return PzkController $this
	 */
	public function render($page)
	{
		$this->initPage();
		$this->append($page);
		$this->display();
		return $this;
	}

	/**
	 * Redirect theo một đường dẫn kèm theo query string
	 * @param String $action dạng index, hoặc Home/index, hoặc http://example.com/route[?key=value&...]
	 * @param Array|Boolean $query query params
	 */
	public function redirect($action, $query = false)
	{
		if (strpos($action, 'http') !== false) {
			pzk_request()->redirect($action);
		}
		$parts = explode(DS, $action);
		if (!@$parts[1] || is_numeric(@$parts[1])) {
			pzk_request()->redirect(pzk_request()->buildAction($action, $query));
		} else {
			pzk_request()->redirect(pzk_request()->build($action, $query));
		}
	}

	/**
	 * Validate dữ liệu row theo validator, đẩy lỗi ra notifier
	 * @param Array $row dữ liệu
	 * @param Array $validator để validate
	 * @return Boolean kết quả validate 
	 */
	public function validate($row, $validator)
	{
		if (isset($validator) && $validator) {
			$result = pzk_validate($row, $validator);
			if ($result !== true) {
				foreach ($result as $field => $messages) {
					foreach ($messages as $message) {
						pzk_notifier()->addMessage($message, 'warning');
					}
				}
				return false;
			}
		}
		return true;
	}

	public $events = array();

	/**
	 * Đẩy ra một event theo tên và dữ liệu
	 * @param String $event sự kiện
	 * @param Array|Object $data dữ liệu của sự kiện
	 * @return PzkController $this
	 */
	public function fireEvent($event, $data = NULL)
	{
		$eventHandlers = isset($this->events[$event]) ? $this->events[$event] : array();
		foreach ($eventHandlers as $handler) {
			$tmp = explode('.', $handler);
			$action = 'handle';
			if (isset($tmp[1])) {
				$action = $tmp[1];
			}
			$obj = isset($tmp[0]) ? $tmp[0] : null;
			if ($obj == 'this') {
				$h = $this;
			} else {
				$h = pzk_element($obj);
				if (!$h) {
					if (strpos($obj, '<') !== false) {
						$h = $this->parse($obj);
					} else {
						$obj = implode('.', explode(UNS, $obj));
						$h = pzk_model($obj);
					}
				}
			}
			if ($h) {
				$h->$action($event, $data);
			}
		}
		return $this;
	}

	/**
	 * Thêm xử lý sự kiện
	 * @param String $event tên sự kiện
	 * @param Function $handler hàm xử lý sự kiện
	 * @return PzkController $this
	 */
	public function addEventListener($event, $handler)
	{
		if (!isset($this->events[$event])) {
			$this->events[$event] = array();
		}
		$this->events[$event][] = $handler;
		return $this;
	}

	/**
	 * Hàm ảo
	 * @param String $name tên hàm ảo
	 * @param Array $arguments các đối số truyền vào
	 * @return mixed|PzkController
	 */
	public function __call($name, $arguments)
	{
		$prefix = substr($name, 0, 3);
		$property = strtolower($name[3]) . substr($name, 4);
		switch ($prefix) {
			case 'get':
				return isset($this->$property) ? $this->$property : null;
				break;
			case 'has':
				return isset($this->$property);
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
				return $this->parse(str_replace(UNS, DS, $property5));
				break;
		}

		$prefix6 = substr($name, 0, 6);
		$property6 = strtolower($name[6]) . substr($name, 7);
		switch ($prefix6) {
			case 'append':
				return $this->append(str_replace(UNS, DS, $property6));
				break;
			case 'render':
				return $this->render(str_replace(UNS, DS, $property6));
				break;
			default:
				throw new \Exception("Property $name doesn't exist.");
				break;
		}
	}

	/**
	 * Khởi tạo một object với dữ liệu của object ấy
	 * @param String $obj tên object cần khởi tạo, dạng Core.Db.List
	 * @param Array|null $data dữ liệu của object
	 * @return PzkObject object được khởi tạo
	 */
	public function obj($obj, $data = null)
	{
		$objInstance = null;
		if ($obj) {
			$objInstance = pzk_obj($obj);
		} else {
			$objInstance = pzk_obj('Block');
		}
		if ($data) {
			foreach ($data as $key => $val) {
				$objInstance->set($key, $val);
			}
		}
		return $objInstance;
	}

	/**
	 * @inheritdoc initPage
	 */
	public function layout()
	{
		$this->initPage();
	}

	public $isPreventingDisplay = false;
	/**
	 * Ngăn trang hiển thị trong hàm render
	 * @return PzkController $this 
	 */
	public function preventDisplay()
	{
		$this->setIsPreventingDisplay(true);
		return $this;
	}
	/**
	 * Bỏ ngăn hiển thị
	 * @return PzkController $this
	 */
	public function unpreventDisplay()
	{
		$this->setIsPreventingDisplay(false);
		return $this;
	}

	/**
	 * Load thư viện bên ngoài
	 * @param $name tên thư viện
	 * @param $type loại thư viện
	 */
	public function load($name, $type = 'lib')
	{
		require_once BASE_DIR . DS . $type . DS . $name . PHP_EXT;
	}

	/**
	 * Render layout với object và data
	 * @param String $layout tên layout cần hiển thị
	 * @return PzkController $this
	 */
	public function renderLayout($layout, $obj = null, $data = null)
	{
		$objInstance = null;
		if ($obj) {
			$objInstance = $this->obj($obj);
		} else {
			$objInstance = $this->obj('Block');
		}
		$objInstance->set('layout', $layout);
		if ($data) {
			foreach ($data as $key => $val) {
				$objInstance->set($key, $val);
			}
		}
		return $this->render($objInstance);
	}

	/**
	 * Render object và data
	 * @param String $obj đối tượng
	 * @param Array $data dữ liệu
	 * @return PzkController $this
	 */
	public function renderObj($obj, $data = null)
	{
		return $this->render($this->obj($obj, $data));
	}

	/**
	 * Render trang chi tiết
	 * @param String $layout
	 * @param Array|null $data
	 * @return PzkController $this
	 */
	public function renderDetail($layout, $data = null)
	{
		return $this->renderLayout($layout, 'Core.Db.Detail', $data);
	}

	/**
	 * Render trang danh sách
	 * @param String $layout
	 * @param Array $data
	 * @return PzkController $this
	 */
	public function renderListing($layout, $data = null)
	{
		return $this->renderLayout($layout, 'Core.Db.List', $data);
	}
}
