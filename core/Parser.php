<?php
class PzkParser
{

	public static $rules = array();
	public static $layoutcache = null;

	/**
	 * 	parse mot dom document
	 * 	thanh cac object va init cac object do
	 * 	@param String|DOMDocument|DOMElement $obj doi tuong can parse: co the la domdocument,
	 * 	domelement, string, filepath, dom node
	 * 	@return PzkObject
	 */
	public static function parse($obj)
	{

		// neu obj la mot dom document
		if (is_a($obj, DOMDocument::class)) {
			return self::parse($obj->documentElement);

			// neu obj la mot dom node
		} else if (is_a($obj, DOMElement::class)) {
			return self::parseNode($obj);

			// neu obj la mot string
		} else if (is_string($obj)) {
			// neu obj la mot duong dan den file
			if (!preg_match('/[\<\>]/', $obj) && $filePath = BASE_DIR . DS . $obj . PHP_EXT) {
				return self::parseFile($obj);
			}
			return self::parseDocument($obj);
		} else if (is_array($obj)) {
			return self::parseArray($obj);
		}
	}

	/**
	 * Chuyển một file thành một object
	 * @param String $obj tên file, không có đuôi
	 * @return PzkObject
	 */
	public static function parseFile($obj)
	{
		$fileName = BASE_DIR . '/compile/pages/' . str_replace(DS, UNS, $obj . PHP_EXT);
		require $fileName;
		return $obj0;
	}

	/**
	 * Parse một chuỗi xml thành PzkObject
	 * @param String $source xml string
	 * @return PzkObject
	 */
	public static function parseDocument($source)
	{
		$pageDom = new DOMDocument('1.0', 'utf-8');
		$pageDom->preserveWhiteSpace = false;
		$pageDom->formatOutput = true;
		try {
			$pageDom->loadXML($source);
			return self::parseNode($pageDom->documentElement);
		} catch (Exception $err) {
			echo $source;
			if (function_exists('pzk_system'))
				pzk_system()->halt($err->getMessage());
			else
				die($err->getMessage());
			return NULL;
		}
	}

	/**
	 * Parse mot doi tuong tu array
	 * @param Array $attrs các thuộc tính của object
	 * @return PzkObject
	 * 
	 */
	public static function parseArray($attrs)
	{
		$name = $attrs['tagName'];
		$package = $attrs['package'];
		require_once 'objects/' . $package . DS . ($name) . PHP_EXT;
		$className = self::getClass($attrs['className']);
		$obj = new $className($attrs);
		pzk_element()->set($obj->id, $obj);
		return $obj;
	}

	/**
	 * Parse mot doi tuong tu mot node
	 * @param DOMElement $node node can parse
	 * @param PzkObject $parent la parent cua node can parse
	 * @return PzkObject
	 */
	public static function parseNode($node, $parent = false)
	{
		if ($node->nodeType == XML_ELEMENT_NODE) {

			$nodeName = $node->nodeName;

			// xet xem co phai html tag binh thuong khong
			if (self::isHtmlTag($nodeName)) {
				$nodeName = 'HtmlTag';
			}

			// xet xem co ten rut gon khong
			$shorts = explode('.', $nodeName);
			if (count($shorts) == 2) {
				$shortRs = pzk_global()->get('shorty_' . $shorts[0]);
				if ($shortRs) {
					$nodeName = $shortRs . '.' . $shorts[1];
				}
			}

			// tách tagName theo dấu .
			$names 							= 	explode('.', $nodeName);
			$className 						= 	self::getClass($names);
			$object							=	implode(DS,	$names);

			// tìm kiếm object trong objectPaths
			$objectPaths 					= 	array();
			$themes							= 	null;
			if (function_exists('pzk_request')) {
				$request = pzk_request();
				if ($request)
					$themes 					= 	$request->get('themes');
			}

			// tìm kiếm trong theme
			if ($themes) {
				foreach ($themes as $theme) {
					$objectPaths[]			=	'Themes/' . $theme . '/objects';
				}
			}

			// tìm kiếm trong app và package
			if (function_exists('pzk_app')) {
				$app = pzk_app();
				if ($app) {
					$objectPaths[]				=	$app->getUri('objects');
					$objectPaths[]				=	$app->getPackageUri('objects');
				}
			}

			// tìm kiếm mặc định trong /objects
			$objectPaths[]					=	'objects';
			$fileName 						=	null;
			foreach ($objectPaths as $objectPath) {
				if (is_file(BASE_DIR . DS . ($tmp = $objectPath . DS . $object . PHP_EXT))) {
					$fileName 				=	$tmp;
					break;
				}
			}

			// nếu không tìm thấy object
			if (null === $fileName) {
				if (function_exists('pzk_system')) {
					echo '<pre>';
					debug_print_backtrace();
					pzk_system()->halt('object ' . $object . ' not found');
				} else {
					echo '<pre>';
					debug_print_backtrace();
					die('object ' . $object . ' not found');
				}
			}

			// truong hop compile: class and path
			// chuyen class sang compile class
			// chuyen path sang compile path

			// lay ten class cua object
			$objectClass = $className;

			// lay ten class cua object khi da compile
			$fileNameCompiled = str_replace(DS, '.', $fileName);
			$objectClassCompiled = str_replace(PHP_EXT, '', $fileNameCompiled);

			$partsCompiled = explode('.', $objectClassCompiled);
			$partsCompiled = array_remove($partsCompiled, 'objects');

			$objectClassCompiled = self::getClass($partsCompiled);

			// kiem tra xem da compile chua hoac file objects co thay doi
			if (
				!is_file(BASE_DIR . '/compile/objects/' . $fileNameCompiled)
				|| (filemtime(BASE_DIR . '/compile/objects/' . $fileNameCompiled) < filemtime((BASE_DIR .  DS . $fileName)))
			) {
				// noi dung file object
				$fileContent 			= file_get_contents(BASE_DIR . DS . $fileName);

				// noi dung duoc compile
				$fileContentCompiled 	= str_replace($objectClass, $objectClassCompiled, $fileContent);

				file_put_contents('compile/objects/' . $fileNameCompiled, $fileContentCompiled);
			}

			// cache lai path va class
			if (CACHE_MODE) {
				pzk_cache_layout()->set($node->nodeName . 'path', BASE_DIR . '/compile/objects/' . $fileNameCompiled);
				pzk_cache_layout()->set($node->nodeName . 'class', $objectClassCompiled);
			}


			// echo 'required: ' . BASE_DIR . '/compile/objects/' . $fileNameCompiled . '<br />';
			// ket qua
			require_once BASE_DIR . '/compile/objects/' . $fileNameCompiled;

			// require_once $fileObjectPath;

			// lay cac thuoc tinh
			$attrs = array();
			if (function_exists('pzk_request')) {
				$request = pzk_request();
				foreach ($node->attributes as $attr) {
					$nodeName = $attr->nodeName;
					$nodeValue = $attr->nodeValue;
					if (preg_match('/rq-([\w][\w\d]*)/', $nodeName, $match)) {
						if (preg_match('/rseg([\d]+)/', $nodeValue, $rq)) {
							$attrs[$match[1]] = $request->getSegment($rq[1]);
						} else {
							$attrs[$match[1]] = $request->get($nodeValue);
						}
					} else {
						$attrs[$attr->nodeName] = $attr->nodeValue;
					}
				}
			}
			$attrs['tagName'] = $node->nodeName;
			$attrs['className'] = $className;
			$attrs['pzkParentId'] = $parent ? $parent->getId() : null;
			$attrs['fullNames'] = $names;

			// Tao ra obj
			$obj = new $objectClassCompiled($attrs);
			pzk_element($obj->getId(), $obj);

			$obj->init();

			$obj->text = '';

			// duyet qua cac node con
			$childNodes = $node->childNodes;
			foreach ($childNodes as $childNode) {
				// neu la mot node con binh thuong
				if ($childNode->nodeType == XML_ELEMENT_NODE) {
					$childObj = self::parseNode($childNode, $obj);
					$obj->append($childObj);

					// neu la mot text node
				} else if ($childNode->nodeType == XML_TEXT_NODE) {
					if (trim($childNode->nodeValue))
						$obj->append(self::parse('<textLabel value="' . html_escape($childNode->nodeValue) . '" />', $obj));

					// neu la mot cdata node
				} else if ($childNode->nodeType == XML_CDATA_SECTION_NODE) {
					if (trim($childNode->nodeValue))
						$obj->append(self::parse('<textLabel value="' . html_escape($childNode->nodeValue) . '" />', $obj));
				}
			}

			$obj->finish();

			return $obj;
		}
	}

	/**
	 * Tạo ra className của object từ tên và đường dẫn
	 * @param String $nodeName tên object
	 * @param String $objectPath đường dẫn chứa object
	 * @return String tên class của object
	 */
	public static function generateObject($nodeName, $objectPath = '')
	{
		if ($objectPath)
			$objectPath 	.= 	'/objects';
		else $objectPath	=	'objects';
		$oldName 	=	$nodeName;
		$names = explode('.', $nodeName);
		$namesCountLastIndex 			= 	count($names) - 1;
		$names[$namesCountLastIndex] 	= 	($names[$namesCountLastIndex]);
		$objectClass 						= 	self::getClass($names);
		$object							=	implode(DS,	$names);

		$fileObjectPath = BASE_DIR . DS . ($fileName = $objectPath . DS . $object . PHP_EXT);
		if (!is_file($fileObjectPath)) {
			return null;
		}
		// lay ten class cua object khi da compile
		$fileNameCompiled = str_replace(DS, '.', $fileName);
		$objectClassCompiled = str_replace(PHP_EXT, '', $fileNameCompiled);

		$partsCompiled = explode('.', $objectClassCompiled);
		$partsCompiled = array_remove($partsCompiled, 'objects');

		$objectClassCompiled = self::getClass($partsCompiled);

		// kiem tra xem da compile chua hoac file objects co thay doi
		if (
			!is_file(BASE_DIR . '/compile/objects/' . $fileNameCompiled)
			|| (filemtime(BASE_DIR . '/compile/objects/' . $fileNameCompiled) < filemtime((BASE_DIR .  DS . $fileName)))
		) {
			// noi dung file object
			$fileContent 			= file_get_contents(BASE_DIR . DS . $fileName);

			// noi dung duoc compile
			$fileContentCompiled 	= str_replace($objectClass, $objectClassCompiled, $fileContent);

			file_put_contents(BASE_DIR . '/compile/objects/' . $fileNameCompiled, $fileContentCompiled);
		}

		// cache lai path va class
		if (null === self::$layoutcache) {
			self::$layoutcache = $layoutcache = pzk_cache_layout();
		} else {
			$layoutcache = self::$layoutcache;
		}
		$layoutcache->set($oldName . 'path', BASE_DIR . '/compile/objects/' . $fileNameCompiled);
		$layoutcache->set($oldName . 'class', $objectClassCompiled);
		// ket qua
		// echo 'generated: ' . BASE_DIR . '/compile/objects/' . $fileNameCompiled . '<br />';
		if (!class_exists($objectClassCompiled))
			require_once BASE_DIR . '/compile/objects/' . $fileNameCompiled;
		return $objectClassCompiled;
	}

	/**
	 * Import object theo themes, app hoặc package
	 * @param String $nodeName tên object
	 * @return String object class name
	 */
	public static function importObject($nodeName)
	{
		if (null === self::$layoutcache) {
			self::$layoutcache = $layoutcache = pzk_cache_layout();
		} else {
			$layoutcache = self::$layoutcache;
		}
		if ($className = $layoutcache->get($nodeName . 'class')) {
			if (!class_exists($className)) {
				require $layoutcache->get($nodeName . 'path');
			}
			return $className;
		}
		if (self::isHtmlTag($nodeName)) {
			$nodeName 	= 'HtmlTag';
		}
		$themes			= null;
		if (function_exists('pzk_request')) {
			$request 	=	pzk_request();
			if ($request)
				$themes 	= 	$request->getThemes();
		}

		if ($themes) {
			foreach ($themes as $theme) {
				$className = self::generateObject($nodeName, 'Themes/' . $theme);
				if ($className) {
					return $className;
				}
			}
		}

		if (function_exists('pzk_app')) {
			if ($app = pzk_app()) {
				$className = self::generateObject($nodeName, $app->getUri('objects'));
				if ($className) {
					return $className;
				}
				$className = self::generateObject($nodeName, $app->getPackageUri('objects'));
				if ($className) {
					return $className;
				}
			}
		}

		$className = self::generateObject($nodeName, '');
		if ($className) {
			return $className;
		}

		if (function_exists('pzk_system')) {
			if ($sys = pzk_system()) {
				echo '<pre>';
				debug_print_backtrace();
				$sys->halt('object ' . $nodeName . ' not found');
			}
		} else {
			echo '<pre>';
			debug_print_backtrace();
			die('object ' . $node->nodeName . ' not found');
		}
		return null;
	}

	/**
	 * lay ten class cua tagName
	 * @param Array $fullNames ['Core', 'Db', 'List']
	 * @return String $className PzkCoreDbList
	 */
	public static function getClass($fullNames)
	{
		$className = 'Pzk';
		foreach ($fullNames as $name) {
			$className .= ($name);
		}
		return $className;
	}

	/**
	 * Kiểm tra một thẻ là html tag hay không
	 * @param String $tagName
	 * @return Boolean là html tag hay không
	 */
	public static function isHtmlTag($tagName)
	{
		static $tags = array(
			'h1' => true, 'h2' => true, 'h3' => true, 'h4' => true, 'h5' => true, 'h6' => true,
			'marquee' => true, 'br' => true,
			'p' => true, 'em' => true, 'strong' => true, 'a' => true, 'style' => true,
			'div' => true, 'span' => true, 'label' => true, 'b' => true,
			'hr' => true,
			'script' => true, 'link' => true,
			'select' => true, 'option' => true,
			'ul' => true, 'li' => true,
			'table' => true, 'tr' => true, 'td' => true, 'thead' => true, 'tbody' => true, 'caption' => true,
			'input' => true, 'textarea' => true,
			'img' => true, 'pre' => true, 'header' => true
		);
		return isset($tags[strtolower($tagName)]) ? $tags[strtolower($tagName)] : FALSE;
	}

	/**
	 * parse layout
	 */
	public static function parseLayout($layout, $data, $return = false, $cache = true)
	{
		static $allLayouts = array();
		if (!preg_match('/</', $layout)) {

			if ($fileName = pzk_cache_layout()->get($layout . 'layout')) {

				if ($return) {
					ob_start();
					require $fileName;
					$content = ob_get_contents();
					ob_end_clean();
					return $content;
				} else {
					require $fileName;
					return;
				}
			}
			$filePath = BASE_DIR . DS . $layout . PHP_EXT;
			$fileName = BASE_DIR . '/compile/layouts/' . str_replace(DS, UNS, $layout) . PHP_EXT;
			if (!is_file($fileName) || filemtime($fileName) < filemtime($filePath)) {
				$content = self::parseTemplateFile($filePath, $data);
				file_put_contents($fileName, $content);
				pzk_cache_layout()->set($layout . 'layout', $fileName);
			}
			if ($return) {
				ob_start();
				require $fileName;
				$content = ob_get_contents();
				ob_end_clean();
				return $content;
			} else {
				require $fileName;
			}
		} else {
			$template = $this->parseTemplate($layout, $data);
			if ($return) {
				ob_start();
				eval('?' . '>' . $template . '<' . '?php ');
				$content = ob_get_contents();
				ob_end_clean();
				return $content;
			} else {
				eval('?' . '>' . $template . '<' . '?php ');
			}
		}
	}

	public function compileLayout($layout)
	{
		$filePath = BASE_DIR . DS . $layout . PHP_EXT;
		$fileName = BASE_DIR . '/compile/layouts/' . str_replace(DS, UNS, $layout) . PHP_EXT;
		if (!is_file($fileName) || filemtime($fileName) < filemtime($filePath)) {
			$content = self::parseTemplateFile($filePath);
			file_put_contents($fileName, $content);
		}
	}

	/**
	 * parse layout cho mot file
	 */
	public static function parseTemplateFile($filePath)
	{
		return self::parseTemplate(file_get_contents($filePath));
	}

	/**
	 * parse template, chua require
	 * @param $content noi dung template can parse
	 * @param $data du lieu can parse
	 */
	public static function parseTemplate($content)
	{
		return $content;
	}
}

/**
 * 
 * @param unknown $xml
 * @return PzkObject
 */
function pzk_parse($xml)
{
	return PzkParser::parse($xml);
}

function pzk_obj($obj, $arr = array())
{
	$pzk_element = pzk_element();
	$className = PzkParser::importObject($obj);
	$attrs = array(
		'tagName' => $obj,
		'className' => $className,
		'fullNames' => explode('.', $obj),
	);
	foreach ($arr as $key => $val) {
		$attrs[$key] = $val;
	}
	$attrs['className'] = $className;
	$obj0 = new $className($attrs);
	$pzk_element->set($obj0->id, $obj0);

	$obj0->init();
	$obj0->finish();

	return $obj0;
}

function pzk_obj_once($obj, $arr = array())
{
	static $objs = array();
	if (is_string($obj)) {
		if (isset($objs[$obj])) {
			return $objs[$obj];
		} else {
			$objs[$obj] = pzk_obj($obj, $arr);
			return $objs[$obj];
		}
	} elseif (is_array($obj)) {
		$objName = $obj[0];
		$objPool = $obj[1];
		if (isset($objs[$objPool])) {
			return $objs[$objPool];
		} else {
			$objs[$objPool] = pzk_obj($objName, $arr);
			return $objs[$objPool];
		}
	}
}

function partial($layout, $data = false, $return = false)
{
	return PzkParser::parseLayout($layout, $data, $return);
}
