<?php
class PzkCoreSystem extends PzkObjectLightWeight {
	public $boundable = false;
	public $libs = array(); 
	public $bootstrap = 'application';
	public $app = false;
	public $hosts = array(
		'nextnobels.com' 	=> 'nobel',
		'www.nextnobels.com' 	=> 'nobel',
		'nobel.vn' 			=> 'nobel',
		'nobel' 			=> array(
			'app'			=> 	'nobel',
			'softwareId'	=> 	'4'
		),
		'phanmemfulllook.com' 		=> 'test1.vn',
		'www.phanmemfulllook.com' 	=> 'test1.vn',
		's1.nextnobels.com' => 'test1.vn',
		'test1.vn' 			=> array(
			'app'			=> 	'nobel_test',
			'softwareId'	=> 	'1',
			'siteId'		=> 	'1'
		),
		'fulllook.vn' => 'test1sn.vn',
		'fulllook.com.vn' => 'test1sn.vn',
		'fulllooksongngu.com' => 'test1sn.vn',
		'beta.fulllooksongngu.com' => 'test1sn.vn',
		'www.fulllooksongngu.com' => 'test1sn.vn',
		'beta.flsn.nextnobels.com' => 'test1sn.vn',
		'test1sn.vn' 		=> array(
			'app'			=> 	'nobel_test',
			'softwareId'	=> 	'1',
			'siteId'		=> 	'2',
			'language'		=> 	true
		),
		'ltdh.nextnobels.com' 		=> array(
			'app'			=> 	'nobel_test',
			'softwareId'	=> 	'100001',
			'siteId'		=> 	'1',
			'language'		=> 	false
		),
		'tiengviettieuhoc.net' => 'pmtv.vn',
		'www.tiengviettieuhoc.net' => 'pmtv.vn',
		'tiengviettieuhoc.vn' => 'pmtv.vn',
		'www.tiengviettieuhoc.vn' => 'pmtv.vn',
		'pmtv.vn' 			=> array(
			'app'			=> 	'nobel_test_pmtv',
			'softwareId'	=> 	'101',
			'siteId'		=> 	'1'
		),
		'pmtv3.tiengviettieuhoc.net' => 'pmtv3.vn',
		'pmtv3.tiengviettieuhoc.vn' => 'pmtv3.vn',
		'pmtv3.vn' 			=> array(
			'app'			=> 	'nobel_test_pmtv',
			'softwareId'	=> 	'103',
			'siteId'		=> 	'1'
		),
		'pmtv4.tiengviettieuhoc.net' => 'pmtv4.vn',
		'pmtv4.tiengviettieuhoc.vn' => 'pmtv4.vn',
		'pmtv4.vn' 			=> array(
			'app'			=> 	'nobel_test_pmtv',
			'softwareId'	=> 	'104',
			'siteId'		=> 	'1'
		),
		'pmtv5.tiengviettieuhoc.net'	=> 'pmtv5.vn',
		'pmtv5.tiengviettieuhoc.vn' => 'pmtv5.vn',
		'pmtv5.vn' 			=> array(
			'app'			=> 	'nobel_test_pmtv',
			'softwareId'	=> 	'105',
			'siteId'		=> 	'1'
		),
		'thitai.vn' 			=> array(
			'app'			=> 	'nobel_test',
			'softwareId'	=> 	'7'
		),
		'nb.thitai.vn' 			=> array(
			'app'			=> 	'nobel_test',
			'softwareId'	=> 	'8'
		),
		'tdn.thitai.vn' 			=> array(
			'app'			=> 	'nobel_test',
			'softwareId'	=> 	'9',
			'controller'	=> 	'contest',
			'action'		=>	'index'
		),
		'cms.vn' 			=> array(
			'app'			=> 	'nobel_cms',
			'softwareId'	=> 	'5',
			'controller'	=> 	'home',
			'action'		=>	'index'
		),
		'ptnn.nextnobels.com'	=>	'ptnn.vn',
		'www.ptnn.nextnobels.com'	=>	'ptnn.vn',
		'ptnn.vn' 			=> array(
			'app'			=> 	'nobel_ptnn',
			'softwareId'	=> 	'3',
			'controller'	=> 	'home',
			'action'		=>	'index'
		),
		'olympic.vn' 			=> array(
			'app'			=> 	'nobel_olympic',
			'softwareId'	=> 	'6',
			'controller'	=> 	'Home',
			'action'		=>	'Index'
		),
		'thinangluc.vn' 		=> array(
			'app'			=> 	'nobel_test',
			'softwareId'	=> 	'10',
			'siteId'		=> 	'1',
			'language'		=> 	true
		),
		'course.fun' 		=> array(
			'app'			=> 	'course_fun',
			'softwareId'	=> 	'3001',
			'siteId'		=> 	'1',
			'language'		=> 	false
		),
	);
	
	public function finish() {
		$request = pzk_request();
		$host = $request->host;
		if(isset($this->hosts[$host])) {
			$config = $this->hosts[$host];
			if(is_string($config)) {
				$config = $this->hosts[$config];
			}
			if(!isset($config['controller'])) {
				$config['controller'] 	= 	'Home';
			}
			if(!isset($config['action'])) {
				$config['action'] 		= 	'index';
			}
			foreach($config as $key => $val) {
				$request->set($key, $val);
			}
			if(isset($config['language']) && $config['language']) {
				$language = pzk_session()->getLanguage();
				if($language == 'vn' || $language == '') {
					require_once BASE_DIR .'/Themes/Songngu/language/vn.php';
				} else if($language == 'ev'){
					require_once BASE_DIR .'/Themes/Songngu/language/ev.php';
				} else {
					require_once BASE_DIR .'/Themes/Songngu/language/en.php';
				}
			}
		}
		
	}
	
	/**
	 * Trả về ứng dụng đang chạy
	 * @return PzkCoreApplication
	 */
	public function getApp() {
		if($this->app) return $this->app;
		$request 	= 	pzk_request();
		$software 	= 	$request->getSoftwareId();
		$site 		= 	$request->getSiteId();
		$app 		= 	null;
		if(is_file(BASE_DIR . '/' . ($bootstrap = 'app/'. $request->getAppPath() . '/' . $this->bootstrap . '.' . $software . '.' . $site) . '.php' )) {
			$app 		= 	PzkParser::parse($bootstrap);
		} elseif(is_file(BASE_DIR . '/' . ($bootstrap = 'app/'. $request->getAppPath() . '/' . $this->bootstrap . '.' . $software) . '.php' )) {
			$app 		= 	PzkParser::parse($bootstrap);
		} else {
			$app 		= 	PzkParser::parse('app/'. $request->getAppPath() . '/' . $this->bootstrap);
		}
		$this->app = $app;
		return $app;
	}
	
	/**
	 * Trả về đường dẫn theo ứng dụng đang chạy
	 * @param string $path đường dẫn
	 * @return string
	 */
	public static function appPath($path) {
		return 'app/' . pzk_request()->getAppPath() . '/' . $path;
	}
	
	/**
	 * Đường dẫn theo hệ thống
	 * @param unknown $path
	 * @return string
	 */
	public function path($path) {
		return BASE_DIR . '/' . $path;
	}
	
	/**
	 * Shutdown hệ thống kèm theo message
	 * Dùng để thay thế cho hàm die thông thường của php
	 * @param string $message
	 */
	public function halt($message = null) {
		if($db = pzk_element()->getDb()) {
			$db->close();
		}
		if(function_exists('pzk_session')) {
			pzk_session()->saveSession();
		}
		if(function_exists('pzk_stat')) {
			pzk_stat()->saveSession();
		}
		if(function_exists('pzk_cache_layout')) {
			pzk_cache_layout()->saveSession();
		}

		if(function_exists('pzk_cache_objects')) {
			pzk_cache_objects()->saveSession();
		}
		if(function_exists('pzk_cache_pages')) {
			pzk_cache_pages()->saveSession();
		}
		if(function_exists('pzk_cache_controller')) {
			pzk_cache_controller()->saveSession();
		}
		if(function_exists('pzk_cache_model')) {
			pzk_cache_model()->saveSession();
		}
		if(function_exists('pzk_cache_table')) {
			pzk_cache_table()->saveSession();
		}
		if(function_exists('pzk_cache_themes')) {
			pzk_cache_themes()->saveSession();
		}
		if(function_exists('pzk_cache_css')) {
			pzk_cache_css()->saveSession();
		}
		if(function_exists('pzk_cache_js')) {
			pzk_cache_js()->saveSession();
		}

		if(function_exists('pzk_cache_user')) {
			pzk_cache_user()->saveSession();
		}

		if(function_exists('pzk_cache_route')) {
			pzk_cache_route()->saveSession();
		}
		
		die($message);
	}
	
}
/**
 * Trả về đối tượng hệ thống
 * @return PzkCoreSystem
 */
function pzk_system() {
	return pzk_element()->getSystem();
}
?>