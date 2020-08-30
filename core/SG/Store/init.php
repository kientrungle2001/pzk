<?php

/**
 * 
 * @param string $key
 * @param string $value
 * @param string $timeout
 * @return PzkSGStoreSession
 */
function pzk_session($key = NULL, $value = NULL, $timeout = NULL)
{
	static $session;
	if (!$session)
		$session = new PzkSGStoreSession(new PzkSGStoreFormatJson(new PzkSGStoreDomain(new PzkSGStoreDriverFile('cache/session'))));
	if ($key === NULL) {
		return $session;
	} else {
		if ($value === NULL) {
			return $session->get($key, $timeout);
		} else {
			return $session->set($key, $value);
		}
	}
	return $session;
}

/**
 *
 * @return PzkSGStoreFormatSerialize
 */
function pzk_memcache($key = NULL, $value = NULL, $timeout = NULL)
{
	static $memcache;
	if (!$memcache)
		$memcache = new PzkSGStoreDomain(new PzkSGStoreDriverMemcache());
	if ($key === NULL) {
		return $memcache;
	} else {
		if ($value === NULL) {
			return $memcache->get($key, $timeout);
		} else {
			return $memcache->set($key, $value);
		}
	}
	return $memcache;
}

/**
 *
 * @param string $key        	
 * @param string $value        	
 * @return PzkSGStoreDriverPhp
 */
function pzk_element($key = NULL, $value = NULL)
{
	static $store;
	if (!$store)
		$store = new PzkSGStoreDriverPhp();
	if ($key === NULL) {
		return $store;
	} else {
		if ($value === NULL) {
			return $store->get($key);
		} else {
			return $store->set($key, $value);
		}
	}
	return $store;
}

/**
 *
 * @param string $key        	
 * @param string $value        	
 * @return PzkSGStoreDriverPhp
 */
function pzk_global($key = NULL, $value = NULL)
{
	static $store;
	if (!$store)
		$store = new PzkSGStoreDriverPhp();
	if ($key === NULL) {
		return $store;
	} else {
		if ($value === NULL) {
			return $store->get($key);
		} else {
			return $store->set($key, $value);
		}
	}
	return $store;
}
function pzk_store_instance($storeName)
{
	static $stores = array();

	if (!isset($stores[$storeName])) {
		$store = new PzkSGStoreDriverPhp();
		$stores[$storeName] = $store;
	}
	return $stores[$storeName];
}
function pzk_app_store()
{
	return pzk_store_instance(pzk_request()->getAppPath());
}
function pzk_package_store()
{
	return pzk_store_instance(pzk_request()->getPackagePath());
}
function pzk_site_store()
{
	return pzk_store_instance(pzk_request()->getAppPath() . '/' . pzk_request()->get('softwareId'));
}

/**
 *
 * @param string $key        	
 * @param string $value        	
 * @param string $timeout        	
 * @return PzkSGStoreDomain
 */
function pzk_filecache($key = NULL, $value = NULL, $timeout = null)
{
	static $store;
	if (!$store) {
		//$store = pzk_memcache();
		$store = new PzkSGStoreDomain(new PzkSGStoreDriverFile('cache'));
	}
	if ($key === NULL) {
		return $store;
	} else {
		if ($value === NULL) {
			return $store->get($key, $timeout);
		} else {
			return $store->set($key, $value);
		}
	}
	return $store;
}
/**
 *
 * @param string $key        	
 * @param string $value        	
 * @param string $timeout        	
 * @return PzkSGStoreDomain
 */
function pzk_rediscache($key = NULL, $value = NULL, $timeout = null)
{
	static $store;
	if (!$store) {
		//$store = pzk_memcache();
		$store = new PzkSGStoreDomain(new PzkSGStoreDriverRedis());
	}
	if ($key === NULL) {
		return $store;
	} else {
		if ($value === NULL) {
			return $store->get($key, $timeout);
		} else {
			return $store->set($key, $value);
		}
	}
	return $store;
}

function pzk_cache_layout($key = NULL, $value = NULL, $timeout = null)
{
	static $store;
	if (!$store) {
		// if(CACHE_MODE) {
		$store = new PzkSGStoreLazy(new PzkSGStoreFormatJson(
			new PzkSGStoreDomain(new PzkSGStoreDriverFile(CACHE_FOLDER . DS . LAYOUTS_FOLDER))));
		// } else {
		// $store = new PzkSGStoreDriverPhp();
		// }
	}
	if ($key === NULL) {
		return $store;
	} else {
		if ($value === NULL) {
			return $store->get($key, $timeout);
		} else {
			return $store->set($key, $value);
		}
	}
	return $store;
}

function pzk_cache_controller($key = NULL, $value = NULL, $timeout = null)
{
	static $store;
	if (!$store) {
		// if(CACHE_MODE) {
		$store = new PzkSGStoreLazy(new PzkSGStoreFormatJson(new PzkSGStoreDomain(
			new PzkSGStoreDriverFile( CACHE_FOLDER . DS . CONTROLLER_FOLDER ))));
		// } else {
		// $store = new PzkSGStoreDriverPhp();
		// }
	}
	if ($key === NULL) {
		return $store;
	} else {
		if ($value === NULL) {
			return $store->get($key, $timeout);
		} else {
			return $store->set($key, $value);
		}
	}
	return $store;
}

function pzk_cache_model($key = NULL, $value = NULL, $timeout = null)
{
	static $store;
	if (!$store) {
		// if(CACHE_MODE) {
		$store = new PzkSGStoreLazy(new PzkSGStoreFormatJson(new PzkSGStoreDomain(
			new PzkSGStoreDriverFile( CACHE_FOLDER . DS . MODEL_FOLDER ))));
		// } else {
		// $store = new PzkSGStoreDriverPhp();
		// }
	}
	if ($key === NULL) {
		return $store;
	} else {
		if ($value === NULL) {
			return $store->get($key, $timeout);
		} else {
			return $store->set($key, $value);
		}
	}
	return $store;
}

function pzk_cache_pages($key = NULL, $value = NULL, $timeout = null)
{
	static $store;
	if (!$store) {
		$store = new PzkSGStoreLazy(new PzkSGStoreFormatJson(
			new PzkSGStoreDomain(new PzkSGStoreDriverFile(CACHE_FOLDER . DS . PAGES_FOLDER))));
	}
	if ($key === NULL) {
		return $store;
	} else {
		if ($value === NULL) {
			return $store->get($key, $timeout);
		} else {
			return $store->set($key, $value);
		}
	}
	return $store;
}

function pzk_cache_objects($key = NULL, $value = NULL, $timeout = null)
{
	static $store;
	if (!$store) {
		// if(CACHE_MODE) {
		$store = new PzkSGStoreLazy(new PzkSGStoreFormatJson(new PzkSGStoreDomain(new PzkSGStoreDriverFile(CACHE_FOLDER . DS . OBJECTS_FOLDER))));
		// } else {
		// $store = new PzkSGStoreDriverPhp();
		// }
	}
	if ($key === NULL) {
		return $store;
	} else {
		if ($value === NULL) {
			return $store->get($key, $timeout);
		} else {
			return $store->set($key, $value);
		}
	}
	return $store;
}

function pzk_cache_table($key = NULL, $value = NULL, $timeout = null)
{
	static $store;
	if (!$store) {
		// if(CACHE_MODE) {
		$store = new PzkSGStoreLazy(new PzkSGStoreFormatJson(new PzkSGStoreDomain(new PzkSGStoreDriverFile('cache/table'))));
		// } else {
		// $store = new PzkSGStoreDriverPhp();
		// }
	}
	if ($key === NULL) {
		return $store;
	} else {
		if ($value === NULL) {
			return $store->get($key, $timeout);
		} else {
			return $store->set($key, $value);
		}
	}
	return $store;
}

function pzk_cache_css($key = NULL, $value = NULL, $timeout = null)
{
	static $store;
	if (!$store) {
		// if(CACHE_MODE) {
		$store = new PzkSGStoreLazy(new PzkSGStoreFormatJson(
			new PzkSGStoreDomain(new PzkSGStoreDriverFile('cache/css'))));
		// } else {
		// $store = new PzkSGStoreDriverPhp();
		// }
	}
	if ($key === NULL) {
		return $store;
	} else {
		if ($value === NULL) {
			return $store->get($key, $timeout);
		} else {
			return $store->set($key, $value);
		}
	}
	return $store;
}

function pzk_cache_js($key = NULL, $value = NULL, $timeout = null)
{
	static $store;
	if (!$store) {
		// if(CACHE_MODE) {
		$store = new PzkSGStoreLazy(new PzkSGStoreFormatJson(
			new PzkSGStoreDomain(new PzkSGStoreDriverFile('cache/js'))));
		// } else {
		// $store = new PzkSGStoreDriverPhp();
		// }
	}
	if ($key === NULL) {
		return $store;
	} else {
		if ($value === NULL) {
			return $store->get($key, $timeout);
		} else {
			return $store->set($key, $value);
		}
	}
	return $store;
}

function pzk_cache_themes($key = NULL, $value = NULL, $timeout = null)
{
	static $store;
	if (!$store) {
		// if(CACHE_MODE) {
		$store = new PzkSGStoreLazy(new PzkSGStoreFormatJson(
			new PzkSGStoreDomain(new PzkSGStoreDriverFile('cache/themes'))));
		// } else {
		// $store = new PzkSGStoreDriverPhp();
		// }
	}
	if ($key === NULL) {
		return $store;
	} else {
		if ($value === NULL) {
			return $store->get($key, $timeout);
		} else {
			return $store->set($key, $value);
		}
	}
	return $store;
}

function pzk_cache_user($key = NULL, $value = NULL, $timeout = null)
{
	static $store;
	if (!$store) {
		// if(CACHE_MODE) {
		$store = new PzkSGStoreLazy(new PzkSGStoreFormatJson(
			new PzkSGStoreDomain(new PzkSGStoreDriverFile('cache/user'))));
		// } else {
		// $store = new PzkSGStoreDriverPhp();
		// }
	}
	if ($key === NULL) {
		return $store;
	} else {
		if ($value === NULL) {
			return $store->get($key, $timeout);
		} else {
			return $store->set($key, $value);
		}
	}
	return $store;
}

function pzk_cache_route($key = NULL, $value = NULL, $timeout = null)
{
	static $store;
	if (!$store) {
		// if(CACHE_MODE) {
		$store = new PzkSGStoreLazy(new PzkSGStoreFormatJson(
			new PzkSGStoreDomain(new PzkSGStoreDriverFile('cache/route'))));
		// } else {
		// $store = new PzkSGStoreDriverPhp();
		// }
	}
	if ($key === NULL) {
		return $store;
	} else {
		if ($value === NULL) {
			return $store->get($key, $timeout);
		} else {
			return $store->set($key, $value);
		}
	}
	return $store;
}

/**
 *
 * @param string $key        	
 * @param string $value        	
 * @param string $timeout        	
 * @return PzkSGStoreFormatSerialize
 */
function pzk_filevar($key = NULL, $value = NULL, $timeout = null)
{
	static $store;
	if (!$store)
		$store = new PzkSGStoreFormatJson(new PzkSGStoreDomain(new PzkSGStoreDriverFile('cache')));
	if ($key === NULL) {
		return $store;
	} else {
		if ($value === NULL) {
			return $store->get($key, $timeout);
		} else {
			return $store->set($key, $value);
		}
	}
	return $store;
}

function pzk_varexport($key = NULL, $value = NULL, $timeout = null)
{
	static $store;
	if (!$store)
		$store = new PzkSGStoreDriverVarexportFile('cache/varexport');
	if ($key === NULL) {
		return $store;
	} else {
		if ($value === NULL) {
			return $store->get($key, $timeout);
		} else {
			return $store->set($key, $value);
		}
	}
	return $store;
}

/**
 *
 * @param string $key        	
 * @param string $value        	
 * @param string $timeout        	
 * @return PzkSGStoreFormatSerialize
 */
function pzk_stat($key = NULL, $value = NULL, $timeout = null)
{
	static $store;
	if (!$store)
		$store = new PzkSGStoreStat(new PzkSGStoreFormatSerialize(new PzkSGStoreDomain(new PzkSGStoreDriverFile('cache/stat'))));
	if ($key === NULL) {
		return $store;
	} else {
		if ($value === NULL) {
			return $store->get($key, $timeout);
		} else {
			return $store->set($key, $value);
		}
	}
	return $store;
}

/**
 *
 * @param string $key        	
 * @param string $value        	
 * @param string $timeout        	
 * @return PzkSGStoreFormatSerialize
 */
function pzk_uservar($key = NULL, $value = NULL, $timeout = null)
{
	static $store;
	if (!$store)
		$store = new PzkSGStoreFormatJson(new PzkSGStoreDomain(new PzkSGStoreDriverFile('cache/user')));
	if ($key === NULL) {
		return $store;
	} else {
		if ($value === NULL) {
			return $store->get($key, $timeout);
		} else {
			return $store->set($key, $value);
		}
	}
	return $store;
}
function pzk_cachetag($store, $tag, $key)
{
	$cacheTags = pzk_filevar()->get('cacheTags');
	if (!is_array($cacheTags))
		$cacheTags = array();
	if (!isset($cacheTags[$store]))
		$cacheTags[$store] = array();
	if (!isset($cacheTags[$store][$tag]))
		$cacheTags[$store][$tag] = array();
	$cacheTags[$store][$tag][$key] = true;
	pzk_filevar()->setCacheTags($cacheTags);
}
function pzk_cachetag_clear($store, $tag)
{
	$cacheTags = pzk_filevar()->get('cacheTags');
	if (!is_array($cacheTags))
		$cacheTags = array();
	if (isset($cacheTags[$store]) && isset($cacheTags[$store][$tag])) {
		$storeObj = $store();
		foreach ($cacheTags[$store][$tag] as $key => $existed) {
			$storeObj->del($key);
			unset($cacheTags[$store][$tag][$key]);
		}
		pzk_filevar()->setCacheTags($cacheTags);
	}
}

/**
 *
 * @return PzkEntityUserAccountUserModel
 */
function pzk_user()
{
	static $user;
	if ($user)
		return $user;
	$user = _db()->getEntity('User.Account.User');
	$session = pzk_session();
	$message = "Hệ thống phát hiện đang có người sử dụng phần mềm bằng tài khoản của bạn. 
	Để bảo vệ quyền lợi của bạn và tính pháp lí của việc sử dụng sản phẩm phần mềm này, bạn hãy đổi mật khẩu khác. 
	Tài khoản của bạn không được chia sẻ với người khác. 
	Nếu tài khoản của bạn không được bảo mật hệ thống sẽ khóa tài khoản của bạn.
	Liên hệ với chúng tôi để được trợ giúp theo số điện thoại : 04.8585.2525";
	if ($userId = $session->get('userId')) {
		$login_ip = getIPAndAgent();
		$logined_ip = pzk_uservar()->get($_SERVER['HTTP_HOST'] . $session->get('username') . '_login_ip');

		if ($logined_ip !== NULL && $login_ip !== $logined_ip) {
			$user->logout();
			pzk_notifier()->addMessage($message, 'danger');
		} else {
			$user->set('id', $userId);
			$user->set('username', $session->get('username'));
			$user->set('avatar', $session->get('avatar'));
			$user->set('ipClient', $session->get('ipClient'));
			$user->set('login_id', $session->get('login_id'));
		}
	} else {
		$login_ip = getIPAndAgent();
		$logined_ip = pzk_uservar()->get($session->get('username') . '_login_ip');
		if ($logined_ip !== NULL && $login_ip !== $logined_ip) {
			$user->logout();
			///pzk_notifier()->addMessage($message, 'danger');
		}
	}
	return $user;
}

/**
 *
 * @param unknown $key        	
 * @return unknown|NULL
 */
function pzk_config($key = NULL)
{
	static $loaded;
	if (!$loaded) {
		$request = pzk_request();
		// include các cấu hình tùy chỉnh của gói
		if ($request->getPackagePath() && is_file(BASE_DIR . '/app/' . $request->getPackagePath() . '/configuration.php'))
			require_once BASE_DIR . '/app/' . $request->getPackagePath() . '/configuration.php';

		// include cấu hình tùy chỉnh của ứng dụng
		if (is_file(BASE_DIR . '/app/' . $request->getAppPath() . '/configuration.php'))
			require_once BASE_DIR . '/app/' . $request->getAppPath() . '/configuration.php';

		// include cấu hình tùy chỉnh của phần mềm
		if (is_file(BASE_DIR . '/app/' . $request->getAppPath() . '/configuration.' . $request->get('softwareId') . '.php'))
			require_once BASE_DIR . '/app/' . $request->getAppPath() . '/configuration.' . $request->get('softwareId') . '.php';
		$loaded = true;
	}
	static $siteConfig;
	static $appConfig;
	static $packageConfig;
	if (!$siteConfig)
		$siteConfig = pzk_site_store()->get('config');
	if (!$appConfig)
		$appConfig = pzk_app_store()->get('config');
	if (!$packageConfig)
		$packageConfig = pzk_package_store()->get('config');
	if ($key === NULL) {

		return merge_array(array(), $packageConfig, $appConfig, $siteConfig);
	}
	if (isset($siteConfig[$key])) {
		if ($siteConfig[$key] !== 'default-config' && $siteConfig[$key] !== '') {
			return $siteConfig[$key];
		} else if (isset($appConfig[$key])) {
			if ($appConfig[$key] !== 'default-config' && $appConfig[$key] !== '') {
				return $appConfig[$key];
			} else if (isset($packageConfig[$key])) {
				return $packageConfig[$key];
			}
		}
	}
	return NULL;
}
function pzk_js($src = NULL)
{
	static $jsStore;
	if (!$jsStore) {
		$jsStore = pzk_filevar()->get(pzk_app()->name . 'jsStore');
		if (!$jsStore) {
			$jsStore = array();
		}
	}
	if ($src) {
		if (isset($jsStore[$src])) {
			return true;
		} else {
			if (is_file(BASE_DIR . $src)) {
				$commonJsFile = BASE_DIR . '/default/skin/' . pzk_app()->name . '.js';
				if (!is_file($commonJsFile)) {
					file_put_contents($commonJsFile, '');
				}
				$content = file_get_contents($commonJsFile);
				$content .= "\r\n" . file_get_contents(BASE_DIR . $src);
				file_put_contents($commonJsFile, $content);
				$jsStore[$src] = true;
				pzk_filevar()->set(pzk_app()->name . 'jsStore', $jsStore);
			}
			return false;
		}
	}
}

/**
 *
 * @param unknown $subStore        	
 * @return PzkSGStoreApp
 */
function pzk_appscope($subStore)
{
	static $store;
	if (!$store)
		$store = new PzkSGStoreApp(null);
	$store->storage = $subStore;
	return $store;
}

/**
 *
 * @param unknown $subStore        	
 * @return PzkSGStoreDomain
 */
function pzk_domainscope($subStore)
{
	static $store;
	if (!$store)
		$store = new PzkSGStoreDomain(null);
	$store->storage = $subStore;
	return $store;
}

/**
 *
 * @param unknown $subStore        	
 * @return PzkSGStore
 */
function pzk_globalscope($subStore)
{
	static $store;
	if (!$store)
		$store = new PzkSGStore(null);
	$store->storage = $subStore;
	return $store;
}
