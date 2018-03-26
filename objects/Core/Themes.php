<?php
class PzkCoreThemes extends PzkObjectLightWeight {
	
	public $id = 'themes';
	
	public function init() {
		
		
		$this->initRoute();
		
		if($this->isAdminRoute()) {
			return true;
		}
		
		$this->initThemes();
		
	}
	
	public function initThemes() {
		$request = pzk_element('request');
		$allThemes 	= array();
		$layoutcache = pzk_layoutcache();
		if(!($themes = $layoutcache->get('themes'))) {
			$themes = $this->getThemesOnToday();
			foreach($themes as &$t) {
				$t['name'] = ucfirst($t['name']);
			}
			$layoutcache->set('themes', $themes);
		}
		
		
		$default = '';
		if($themes)
		foreach($themes as $theme) {
			$allThemes[] = $theme['name'];
			if($theme['default']) {
				$default = $theme['name'];
			}
			
			if(null === ($allClasses = $layoutcache->get('cssClasses'))) {
				$allClasses = pzk_or(pzk_global()->get('cssClasses'), array());
				$fileName = BASE_DIR . '/Themes/' . $theme['name'] . '/skin/css/maps.json';
				if(is_file($fileName)) {
					$content = file_get_contents(BASE_DIR . '/Themes/' . $theme['name'] . '/skin/css/maps.json');
					$classes = json_decode($content, true);
					$allClasses = merge_array($allClasses, $classes);
				}
				$layoutcache->set('cssClasses', $allClasses);
			}
			pzk_global()->set('cssClasses', $allClasses);
			
			if(null === ($allTags = $layoutcache->get('htmlTags'))) {
				$allTags = pzk_or(pzk_global()->get('htmlTags'), array());
				$fileName = BASE_DIR . '/Themes/' . $theme['name'] . '/skin/css/html.json';
				if(is_file($fileName)) {
					$content = file_get_contents(BASE_DIR . '/Themes/' . $theme['name'] . '/skin/css/html.json');
					$tags = json_decode($content, true);
					$allTags = merge_array($allTags, $tags);
				}
				$layoutcache->set('htmlTags', $allTags);
			}
			pzk_global()->set('htmlTags', $allTags);
		}
		$request->set('themes', $allThemes);
		$request->set('defaultTheme', $default);
	}
	
	public function getThemesOnToday() {
		$today		= date('Y-m-d');
		$themes		=_db()->useCache(1800)->useCacheKey('themes-today')->select("name, `default`")
			->from("themes")
			->setConds('1')
				->and_("`startDate` <= '$today'")
				->and_("`endDate` >= '$today'")
				->and_('status=' . ENABLED)
			->orderBy('startDate desc');
		$themes		=	$themes->result();
		return $themes;
	}
	
	public function themes($name = ''){
		
		$themes = pzk_request()->get('themes');
		
		if(in_array($name, $themes)){
			
			return true;
		}
		return false;
	}
	
	public function initRoute() {
		$request = pzk_element('request');
		$this->route = preg_replace('/^[\/]/', '', $request->route);
	}
	
	public function isAdminRoute() {
		return substr($this->route, 0, 5) == 'admin';
	}
}

function pzk_themes($name = ''){
	
	$obj = pzk_element('themes');
	
	return $obj->themes($name);
}

function pzk_hook($path) {
	$themes = pzk_request()->get('themes');
	foreach($themes as $theme) {
		if(is_file($fileName = BASE_DIR . '/themes/'. $theme . '/hook/' . $path. '.'.pzk_request('softwareId'). '.'.pzk_request('siteId').'.php')) {
			return $fileName;
		}
		if(is_file($fileName = BASE_DIR . '/themes/'. $theme . '/hook/' . $path. '.'.pzk_request('softwareId').'.php')) {
			return $fileName;
		}
		if(is_file($fileName = BASE_DIR . '/themes/'. $theme . '/hook/' . $path. '.php')) {
			return $fileName;
		}
	}
	return null;
}

function pzk_theme_css_class($class) {
	$classes = pzk_global()->get('cssClasses');
	if(isset($classes[$class])) {
		return $classes[$class];
	}
	return $class;
}

function pzk_theme_html_open_tag($tag) {
	$tags = pzk_global()->get('htmlTags');
	if(isset($tags[$tag])) {
		$config =  $tags[$tag];
		$str = '<' . $config['tagName'] . ' ';
		foreach($config['attrs'] as $key => $val) {
			$str .=	$key . '="'.$val.'" ';
		}
		$str .= '>';
		if(isset($config['openHtml'])){
			$str .= $config['openHtml'];
		}
		return $str;
	}
	return '<' . $tag . '>';
}

function pzk_theme_html_close_tag($tag) {
	$tags = pzk_global()->get('htmlTags');
	if(isset($tags[$tag])) {
		$config =  	$tags[$tag];
		$str	=	'';
		if(isset($config['closeHtml'])){
			$str .= $config['closeHtml'];
		}
		$str 	.= 	'</' . $config['tagName'] . '>';
		return $str;
	}
	return '</' . $tag . '>';
}