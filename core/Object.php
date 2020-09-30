<?php

/**
 * View object
 *
 */
class PzkObject extends PzkSG
{
	public $children;
	public $layout = 'empty';
	public $scriptable = false;
	public $scriptTo = 'head';
	public $cacheable = false;

	public $cacher = 'filecache';
	public $cacheScope = 'domainscope';
	public $xml = false;
	public $xpath = '';
	public $json = false;

	/**
	 * cac tham so dung de cache, viet cach nhau boi dau phay
	 */

	public $cacheParams = 'id';

	/**
	 * Cac tham so dung de cho ham toArray, viet cach nhau boi dau phay
	 */
	public $arrayParams = false;

	public $excludeParams = false;

	/**
	 * Cac tham so truyen vao tu request
	 */
	public $requestParams = false;

	/**
	 * Id cua parent element
	 */
	public $pzkParentId = false;

	/**
	 * Id lon nhat cua element
	 */
	public static $maxId = 0;

	/**
	 * Css lien quan den object, css nay se duoc cache lai
	 */
	public $css = false;

	/**
	 * Css nay khong can cache lai
	 */
	public $cssExternalLink = false;

	public $less = false;
	public $lessExternalLink = false;
	/**
	 * Js lien quan den object, js nay se duoc cache lai
	 */
	public $js = false;

	/**
	 * Js nay khong can cache lai
	 */
	public $jsExternalLink = false;

	public static $selectors = array();

	public $layoutCompiler = 'PzkParser';

	/**
	 * Ham khoi tao mot object voi cac attribute cua no truyen
	 * dang mang
	 * @param $attrs la cac thuoc tinh cua doi tuong
	 */
	public function __construct($attrs)
	{
		foreach ($attrs as $key => $value) $this->$key = $value;
		$this->children = array();
		if (!isset($this->id) || !$this->id) {
			$this->id = 'uniqueId' . self::$maxId;
			self::$maxId++;
		}
		$this->less();
		$this->css();
		$this->javascript();
		if ($this->xml) {
			$this->importXml();
		}
		if ($this->json) {
			$this->importJson();
		}

		if ($this->requestParams) {
			$this->importRequest();
		}
	}

	protected function importXml()
	{
		if (pzk_element('array')) {
			$file = BASE_DIR . '/' . pzk_app()->getUri('xml/' . $this->xml . '.xml');
			if (is_file($file)) {
				$content = file_get_contents($file);
				$arr = pzk_array();
				$arr->fromXml($content, $this->xpath);
				$data = $arr->getData();
				$arr->clear();
				foreach ($data as $key => $val) {
					$this->$key = $val;
				}
			}
		}
	}

	protected function importJson()
	{
		if (pzk_element('array')) {
			$file = BASE_DIR . '/' . pzk_app()->getUri('json/' . $this->json . '.json');
			if (is_file($file)) {
				$content = file_get_contents($file);
				$arr = pzk_array();
				$arr->fromJson($content);
				$data = $arr->getData();
				$arr->clear();
				foreach ($data as $key => $val) {
					$this->$key = $val;
				}
			}
		}
	}

	protected function importRequest()
	{
		$request = pzk_request();
		$data = $request->getFilterData($this->requestParams);
		foreach ($data as $key => $val) {
			$this->$key = $val;
		}
	}

	/**
	 * Ham them less cho trang
	 */
	protected function less()
	{

		if ($this->less != false) {
			if ($this->scriptTo) {
				$elem = pzk_element($this->scriptTo);
				if (is_file('Default/skin/' . pzk_app()->getPathByName() . '/less/' . $this->less . '.less'))
					$elem->append(pzk_parse('<Html.Less src="/Default/skin/'
						. pzk_app()->getPathByName() . '/less/' . $this->less . '.less" />'));
				else if (is_file('Default/skin/' . pzk_app()->getPackageByName() . '/less/' . $this->less . '.less')) {
					$elem->append(pzk_parse('<Html.Less src="/Default/skin/'
						. pzk_app()->getPackageByName() . '/less/' . $this->less . '.less" />'));
				}

				$elem = pzk_element($this->scriptTo);
				$elem->append(pzk_parse('<script src="/3rdparty/less.min.js"></script>'));
			} else {
			}
		}
		if ($this->lessExternalLink != false) {
			if ($this->scriptTo) {
				$elem = pzk_element($this->scriptTo);
				$elem->append(pzk_parse('<Html.Less src="' . $this->lessExternalLink . '" />'));
			} else {
				if ($page = pzk_page()) {
					$page->addExternalLess($this->lessExternalLink);
				}
			}
		}
	}


	/**
	 * Ham them css cho trang
	 */
	protected function css()
	{
		if ($this->css != false) {
			if ($this->scriptTo) {
				$elem = pzk_element($this->scriptTo);
				if ($cssPath = pzk_cache_css($this->css . '.css.path')) {
					$elem->append(pzk_obj('Html.Css', array(
						'id'			=>	$this->id . '-css',
						'cacheable'		=>	'true',
						'cacheParams'	=>	'id',
						'src'			=>	$cssPath
					)));
				} else {
					$request = pzk_request();
					$app = pzk_app();
					if (is_file('Default/skin/' . $app->getPathByName() . '/themes/' . $request->get('defaultTheme') . '/css/' . $this->css . '.css')) {
						$elem->append(pzk_obj('Html.Css', array(
							'id'			=>	$this->id . '-css',
							'cacheable'		=>	'true',
							'cacheParams'	=>	'id',
							'src'			=> ($cssPath = '/Default/skin/' . $app->getPathByName() . '/themes/' . $request->get('defaultTheme') . '/css/' . $this->css . '.css')
						)));
						pzk_cache_css($this->css . '.css.path', $cssPath);
					} else if (is_file('Default/skin/' . $app->getPathByName() . '/css/' . $this->css . '.css')) {
						$elem->append(pzk_obj('Html.Css', array(
							'id'			=>	$this->id . '-css',
							'cacheable'		=>	'true',
							'cacheParams'	=>	'id',
							'src'			=> ($cssPath = '/Default/skin/' . $app->getPathByName() . '/css/' . $this->css . '.css')
						)));
						pzk_cache_css($this->css . '.css.path', $cssPath);
					} else if (is_file('Default/skin/' . $app->getPackageByName() . '/css/' . $this->css . '.css')) {
						$elem->append(pzk_obj('Html.Css', array(
							'id'			=>	$this->id . '-css',
							'cacheable'		=>	'true',
							'cacheParams'	=>	'id',
							'src'			=> ($cssPath = '/Default/skin/' . $app->getPackageByName() . '/css/' . $this->css . '.css')
						)));
						pzk_cache_css($this->css . '.css.path', $cssPath);
					}
				}
			} else {
				if ($page = pzk_page())
					$page->addObjCss($this->css);
			}
		}
		if ($this->cssExternalLink != false) {
			if ($this->scriptTo) {
				$elem = pzk_element($this->scriptTo);
				$elem->append(pzk_obj('Html.Css', array(
					'id'	=>	$this->id . '-css-ext',
					'cacheable' => 'true',
					'cacheParams' => 'id',
					'src'	=>	$this->cssExternalLink
				)));
			} else {
				if ($page = pzk_page()) {
					$page->addExternalCss($this->cssExternalLink);
				}
			}
		}
	}

	/**
	 * Add javascript tag for object
	 */
	protected function javascript()
	{
		if ($this->scriptable === true || $this->scriptable === 'true') {

			if (isset($this->scriptTo) && $this->scriptTo) {
				$element = pzk_element($this->scriptTo);
				if ($element) {
					$themes = pzk_request()->get('themes');
					if ($themes)
						foreach ($themes as $theme) {
							$fileName = '';
						}
					$element->append(pzk_obj('Html.Js', array(
						'id'			=> 	$this->id . '-js',
						'cacheable'		=>	"true",
						'cacheParams'	=>	"id",
						'src'			=> 	'/js/' . implode('/', $this->fullNames) . '.js'
					)));
				}
			} else {
				$page = pzk_page();
				if ($page) {
					$page->addObjJs($this->tagName);
				}
			}
		}

		if ($this->js != false) {
			if ($this->scriptTo) {
				$elem = pzk_element($this->scriptTo);
				if ($jsPath = pzk_cache_js($this->js . '.js.path')) {
					$elem->append(pzk_obj(
						'Html.Js',
						array(
							'id'			=>	$this->id . '-js-themes',
							'cacheable'		=>	'true',
							'cacheParams'	=>	'id',
							'src'			=>	$jsPath
						)
					));
				} else {
					if (is_file('Default/skin/' . pzk_app()->getPathByName() . '/js/' . $this->js . '.js')) {
						$elem->append(pzk_obj(
							'Html.Js',
							array(
								'id'			=>	$this->id . '-js-themes',
								'cacheable'		=>	'true',
								'cacheParams'	=>	'id',
								'src'			=> ($jsPath = '/Default/skin/' . pzk_app()->getPathByName() . '/js/' . $this->js . '.js')
							)
						));
						pzk_cache_js($this->js . '.js.path', $jsPath);
					} else if (is_file('Default/skin/' . pzk_app()->getPackageByName() . '/js/' . $this->js . '.js')) {
						$elem->append(pzk_obj(
							'Html.Js',
							array(
								'id'			=>	$this->id . '-js-themes',
								'cacheable'		=>	'true',
								'cacheParams'	=>	'id',
								'src'			=> ($jsPath = '/Default/skin/' . pzk_app()->getPackageByName() . '/js/' . $this->js . '.js')
							)
						));
						pzk_cache_js($this->js . '.js.path', $jsPath);
					}
				}
			} else {
				if ($page = pzk_page())
					$page->addObjCss($this->css);
			}
		}
		if ($this->jsExternalLink != false) {
			if ($this->scriptTo) {
				$elem = pzk_element($this->scriptTo);
				$elem->append(pzk_obj('Html.Js', array('src' => $this->jsExternalLink)));
			} else {
				if ($page = pzk_page()) {
					$page->addExternalCss($this->jsExternalLink);
				}
			}
		}
	}

	/**
	 * Ham nay chay khi doi tuong vua duoc khoi tao,
	 * cac doi tuong con cua no chua duoc khoi tao
	 */
	public function init()
	{
	}

	/**
	 * Ham nay dung de hien thi doi tuong
	 */
	public function display()
	{
		$this->script();
		$this->html();
	}

	/**
	 * Ham nay tao 1 instance javascript cho doi tuong hien thi
	 */
	protected function script()
	{
		if ($this->scriptable === true || $this->scriptable === 'true') {
			$page = pzk_page();
			if ($page) {
				$page->addJsInst($this->toArray());
			}
		}
	}

	/**
	 * Ham nay tra ve html cua doi tuong can hien thi
	 * Neu request no cache hoac cau hinh cua doi tuong
	 * co cacheable = false thi se ko cache
	 * nguoc lai thi se cache
	 */
	public function html()
	{
		if (CACHE_MODE && ($this->cacheable === true
			|| $this->cacheable === 'true')) {
			if (DEBUG_MODE) {
				// echo get_class($this) . ' - ' . $this->id . ' - ' . $this->layout . ' cached<br />';
			}
			$this->cache();
		} else {
			if (DEBUG_MODE) {
				// echo get_class($this) . ' - ' . $this->id . ' - ' . $this->layout . ' not cached<br />';
			}
			echo $this->getContent();
		}
		return true;
	}

	/**
	 *	Ham cache lai noi dung hien thi
	 * 	Dua tren cac tham so dua vao de cache
	 * 	Cache nay theo 1 loai cacher nao do:
	 * 	file cache hay memcache hoac db cache, session cache,... 
	 */
	public function cache()
	{
		$key = $this->hash();
		$store = $this->getCacheStore();
		if (!($content = $store->get($key, 900))) {
			$content = $this->getContent();
			$store->set($key, $content);
		}
		echo $content;
	}
	public $_cacheStore = NULL;
	protected function getCacheStore()
	{
		if (NULL === $this->_cacheStore) {
			$cacher = 'pzk_' . $this->cacher;
			$cacheScope = 'pzk_' . $this->cacheScope;
			$store = $cacheScope($cacher());
			$this->_cacheStore = $store;
		}

		return $this->_cacheStore;
	}

	protected function isCached()
	{
		$key = $this->hash();
		if ($this->getCacheStore()->has($key)) {
			return true;
		}
		return false;
	}

	/**
	 *	Tra ve html cua doi tuong can hien thi
	 * 	truong hop nay la truong hop khi khong co cache
	 */
	public function getContent()
	{
		$content = '';
		$layout = $this->getLayoutRealPath();
		$compiler = $this->layoutCompiler;
		if (!$compiler) {
			ob_start();
			require BASE_DIR . '/' . $layout . '.php';
			$content = ob_get_contents();
			ob_end_clean();
		} else {
			$content = $compiler::parseLayout($layout, $this, true);
		}
		return $content;
	}

	public function getLayoutRealPath()
	{
		if (pzk_cache_layout()->has($this->layout)) {
			$path = pzk_cache_layout()->get($this->layout);
			return $path;
		}
		$layout = null;
		$request = pzk_request();
		$themes = $request->get('themes');
		if ($themes) {

			foreach ($themes as $theme) {
				if (!$layout && is_file(BASE_DIR . '/app/' . $request->getAppPath() . '/layouts/' . $theme . '/' . $this->layout . '.php')) {
					$layout = 'app/' . $request->getAppPath() . '/layouts/' . $theme . '/' . $this->layout;
					break;
				}
			}
			foreach ($themes as $theme) {
				if (!$layout && is_file(BASE_DIR . '/app/' . $request->getPackagePath() . '/layouts/' . $theme . '/' . $this->layout . '.php')) {
					$layout = 'app/' . $request->getPackagePath() . '/layouts/' . $theme . '/' . $this->layout;
					break;
				}
			}

			foreach ($themes as $theme) {
				if (!$layout && is_file(BASE_DIR . '/Themes/' . $theme . '/' . $request->getAppPath() . '/layouts/' . $this->layout . '.php')) {
					$layout = 'Themes/' . $theme . '/' . $request->getAppPath() . '/layouts/' . $this->layout;
					break;
				}
			}
			foreach ($themes as $theme) {
				if (!$layout && is_file(BASE_DIR . '/Themes/' . $theme . '/' . $request->getPackagePath() . '/layouts/' .  $this->layout . '.php')) {
					$layout = 'Themes/' . $theme . '/' . $request->getPackagePath() . '/layouts/' . $this->layout;
					break;
				}
			}

			foreach ($themes as $theme) {
				if (!$layout && is_file(BASE_DIR . '/Themes/' . $theme .  '/layouts/' .  $this->layout . '.php')) {
					$layout = 'Themes/' . $theme . '/layouts/' . $this->layout;
					break;
				}
			}
		}
		if (!$layout && is_file(BASE_DIR . '/app/' . $request->getAppPath() . '/layouts/' . $this->layout . '.php')) {
			$layout = 'app/' . $request->getAppPath() . '/layouts/' . $this->layout;
		} else if (!$layout && is_file(BASE_DIR . '/app/' . $request->getPackagePath() . '/layouts/' . $this->layout . '.php')) {
			$layout = 'app/' . $request->getPackagePath() . '/layouts/' . $this->layout;
		} else if (!$layout) {
			$layout = 'Default/layouts/' . $this->layout;
		}

		if (CACHE_MODE) {
			pzk_cache_layout()->set($this->layout, $layout);
		}

		return $layout;
	}

	public function getCssRealPath()
	{
		if (CACHE_MODE && pzk_cache_css()->has($this->css)) {
			$path = pzk_cache_css()->get($this->css);
			return $path;
		}
		$css = null;
		$request = pzk_request();
		$themes = $request->getThemes();
		if ($themes) {

			foreach ($themes as $theme) {
				if (!$css && is_file(BASE_DIR . '/Default/skin/' . $request->getAppPath() . '/themes/' . $theme . '/css/' . $this->css . '.css')) {
					$css = 'Default/skin/' . $request->getAppPath() . '/themes/' . $theme . '/css/' . $this->css;
					break;
				}
			}
			foreach ($themes as $theme) {
				if (!$css && is_file(BASE_DIR . '/Default/skin/' . $request->getPackagePath() . '/themes/' . $theme . '/css/' . $this->css . '.css')) {
					$css = 'Default/skin/' . $request->getPackagePath() . '/themes/' . $theme . '/css/' . $this->css;
					break;
				}
			}
		}
		if (!$css && is_file(BASE_DIR . '/Default/skin/' . $request->getAppPath() . '/css/' . $this->css . '.css')) {
			$css = 'Default/skin/' . $request->getAppPath() . '/css/' . $this->css;
		} else if (!$css && is_file(BASE_DIR . '/Default/skin/' . $request->getPackagePath() . '/css/' . $this->css . '.css')) {
			$css = 'Default/skin/' . $request->getPackagePath() . '/css/' . $this->css;
		} else if (!$css) {
			$css = 'Default/skin/css/' . $this->css;
		}
		if (CACHE_MODE) {
			pzk_cache_css()->set($this->css, $css);
		}
		return $css;
	}

	/**
	 * 	Tao key cho doi tuong can hien thi (de cache)
	 */
	public function hash()
	{
		$cacheParams = explode(',', $this->cacheParams);
		$hash = '';
		foreach ($cacheParams as $param) {
			$param = trim($param);
			$hash .= isset($this->$param) ? (is_array($this->$param) ? json_encode($this->$param) : $this->$param) : '';
		}
		$session = pzk_session();
		$language = $session->get('language');
		//$lang = $session->get('language');
		//debug($session);
		//die();
		$hash = $hash . '_language_' . $language;
		$language = $session->get('language_tdn');
		$hash = $hash . '_language_tdn_' . $language;

		$request = pzk_request();
		$hash .= '_software_' . $request->get('softwareId') . '_site_' . $request->get('siteId') . '_mobile_' . $request->isMobile() . '_tablet_' . $request->isTablet() . '_class_' . $session->get('lop') . '_login_' . ($session->get('userId') ? '1' : '0');
		$hash .= '_paid_' . pzk_user()->checkPayment('full');
		return md5($hash);
	}

	/**
	 *	Append mot child object 
	 */
	public function append($obj)
	{
		$obj->pzkParentId = isset($this->id) ? $this->id : null;
		$this->children[] = $obj;
	}

	/**
	 * Prepend mot child object
	 */
	public function prepend($obj)
	{
		$obj->pzkParentId = isset($this->id) ? $this->id : null;
		array_unshift($this->children, $obj);
	}

	/**
	 * Insert mot child object vao vi tri index
	 */
	public function insert($obj, $index)
	{
		$obj->pzkParentId = isset($this->id) ? $this->id : null;
		array_splice($this->children, $index, 0, $obj);
	}

	/**
	 * Tra ve vi tri cua doi tuong trong danh sach anh em cua no
	 */
	public function index()
	{
		if ($parent = $this->getParent()) {
			return array_search($this, $parent->children);
		}
		return -1;
	}

	/**
	 * Insert mot doi tuong vao ngay truoc doi tuong
	 */
	public function before(&$obj)
	{
		if ($parent = $this->getParent()) {
			$parent->insert($obj, $this->index());
		}
	}

	/**
	 * Insert mot doi tuong vao ngay sau doi tuong
	 */
	public function after(&$obj)
	{
		if ($parent = $this->getParent()) {
			$parent->insert($obj, $this->index() + 1);
		}
	}

	/**
	 * Lay ra cha cua doi tuong do
	 */
	public function getParent()
	{
		if ($this->pzkParentId) {
			return pzk_element($this->pzkParentId);
		}
		return NULL;
	}

	/**
	 * Lay ra tat ca cac con cua doi tuong theo selector
	 * @param $selector: selector can chon dua theo cau truc
	 * 	tagName[name=value][name=value]
	 */
	public function getChildren($selector = 'all')
	{
		if ($selector == 'all') return $this->children;
		$rslt = array();
		$attrs = $this->parseSelector($selector);
		foreach ($this->children as $child) {
			if ($child->matchAttrs($attrs)) {
				$rslt[] = $child;
			}
		}
		return $rslt;
	}

	/**
	 * Tim mot element la con cua doi tuong goc, theo 1 selector
	 */
	public function findElement($selector = 'all')
	{
		$attrs = $this->parseSelector($selector);
		foreach ($this->children as $child) {
			if ($child->matchAttrs($attrs)) {
				return $child;
			} else {
				if ($elem = $child->findElement($selector)) {
					return $elem;
				}
			}
		}
		return null;
	}

	/**
	 * Tim cac elements theo selectors
	 */
	public function findElements($selector = 'all')
	{
		$attrs = $this->parseSelector($selector);
		$result = array();
		foreach ($this->children as $child) {
			if ($child->matchSelector($attrs)) {
				$result[] = $child;
			}
			$childElements = $child->findElements($selector);
			foreach ($childElements as $elem) {
				$result[] = $elem;
			}
		}
		return $result;
	}

	/**
	 * tim parent theo selector
	 */
	public function findParent($selector)
	{
		if ($parent = $this->getParent()) {
			if ($parent->matchSelector($selector)) {
				return $parent;
			}
		}
		return null;
	}

	/**
	 * Tim cac parent theo selector
	 */
	public function findParents($selector)
	{
		$parents = array();
		$cur = $this->getParent();
		while ($cur) {
			if ($cur->matchSelector($selector)) {
				$parents[] = $cur;
			}
			$cur = $cur->getParent();
		}
		return $parents;
	}

	/**
	 * Hien thi tat ca cac children theo selector
	 */
	public function displayChildren($selector = 'all')
	{
		$children = $this->getChildren($selector);
		if (is_array($children)) {
			foreach ($children as $child) {
				$child->display();
			}
		} else {
			$children->display();
		}
	}

	protected function matchSelector($selector)
	{
		$attrs = $this->parseSelector($selector);
		if ($this->matchAttrs($attrs)) {
			return true;
		}
		return false;
	}

	/**
	 * khop cac thuoc tinh
	 */
	protected function matchAttrs($attrs)
	{
		foreach ($attrs as $key => $attr) {
			if (!isset($attr['comparator'])) continue;
			switch ($attr['comparator']) {
				case '=':
					if (isset($this->$key) && $this->$key != $attr['value']) {
						return false;
					}
					break;
				case '!=':
				case '<>':
					if (isset($this->$key) && $this->$key == $attr['value']) {
						return false;
					}
					break;
				case '^=':
					if (isset($this->$key) && strpos($this->$key, $attr['value']) !== 0) {
						return false;
					}
					break;
				case '*=':
					if (isset($this->$key) && strpos($this->$key, $attr['value']) === FALSE) {
						return false;
					}
					break;
			}
		}
		return true;
	}

	/**
	 * Parse selector tra ve 1 mang cac dieu kien loc
	 *
	 * @param $selector
	 * @return mang kieu kien
	 */
	protected function parseSelector($selector)
	{
		if (isset(self::$selectors[$selector])) return self::$selectors[$selector];
		$pattern = '/^([\w\.\d]+)?((\[[^\]]+\])*)?$/';
		$subPattern = '/\[([^=\^\$\*\!\<]+)(=|\^=|\$=|\*=|\!=|\<\>)([^\]]+)\]/';
		if (preg_match($pattern, $selector, $match)) {
			preg_match_all($subPattern, $match[2], $matches);
			$attrs = array();

			$tagName = $match[1];
			if ($tagName) {
				$attrs['tagName'] = $tagName;
			}

			for ($i = 0; $i < count($matches[1]); $i++) {
				$attrs[$matches[1][$i]] = array('comparator' => $matches[2][$i], 'value' => $matches[3][$i]);
			}

			self::$selectors[$selector] = $attrs;

			return $attrs;
		}
		self::$selectors[$selector] = array();
		return array();
	}

	/**
	 * Ham nay chay khi tat ca cac child object cua no da duoc khoi tao
	 */
	public function finish()
	{
	}

	/**
	 * Ham nay tra ve array mo ta doi tuong dua theo arrayParams
	 */
	public function toArray()
	{
		$result = (array)$this;
		unset($result['children']);
		if (isset($this->excludeParams) && $this->excludeParams) {
			$arrayParams = explodetrim(',', $this->excludeParams);
			foreach ($arrayParams as $param) {
				$param = trim($param);
				if (isset($this->$param)) {
					unset($result[$param]);
				}
			}
		}
		if (isset($this->arrayParams) && $this->arrayParams) {
			$rs2 = array();
			$arrayParams = explodetrim(', ', $this->arrayParams);
			$arrayParams[] = 'id';
			$arrayParams[] = 'tagName';
			$arrayParams[] = 'package';
			$arrayParams[] = 'className';
			$arrayParams[] = 'fullNames';
			foreach ($arrayParams as $param) {
				if (isset($this->$param)) {
					$rs2[$param] = $result[$param];
				}
			}
			return $rs2;
		}
		return $result;
	}

	public function translate($text)
	{
		if (pzk_language()) {
			return pzk_language()->translateText(implode('/', $this->fullNames), $text);
		} else {
			return $text;
		}
	}

	public function getProp($prop, $default = null)
	{
		if (isset($this->$prop)) return $this->$prop;
		return $default;
	}

	public function getModel($model)
	{
		return pzk_loader()->getModel($model);
	}

	public function __toString()
	{
		return $this->getContent();
	}

	public function model($model, $name = null)
	{
		if (!$name)
			return pzk_model($model);
		else {
			return $this->$name = pzk_model($model);
		}
	}

	public function entity($entity, $id = null)
	{
		$entityInstance = _db()->getEntity($entity);
		if ($id) {
			$entityInstance->load($id);
		}
		return $entityInstance;
	}

	public function tableEntity($table, $id = null)
	{
		$entityInstance = _db()->getTableEntity($table);
		if ($id) {
			$entityInstance->load($id);
		}
		return $entityInstance;
	}
}
