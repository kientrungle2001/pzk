<?php
class PzkCoreRewriteTable extends PzkObjectLightweight{
	public $table = 'catalog_category';
	public $field = 'alias';
	public $routeField = 'code';
	public $action = '';
	public static $matched = false;
	public function init() {
		if(self::$matched) return true;
		$request = pzk_request();
		
		if($request->isAdminRoute()) {
			return true;
		}
		
		$route = $request->getStrippedSlashRoute();
		
		if($route) {
			$item = $this->getItem($route);
			
			if($item) {
				self::$matched = true;
				
				$request->routeTable = $this->table;
				$request->routeData = $item;
				if($this->routeField && isset($item[$this->routeField]) && $item[$this->routeField]) {
					// replace request route
					$request->route = '/' .$item[$this->routeField] . '/' . $item['id'];
				} else if($this->action) {
					// replace request route
					$request->route = '/' .$this->action . '/' . $item['id'];
				}
			}
		}
	}
	
	public function getItem($route) {
		if(NULL !== ($item = pzk_cache_route()->get(md5('route-'.$route.'-'.$this->table)))) {
			return $item;
		} else {
			$item = _db()->useCache(3600)->useCacheKey('route-'.$route.'-'.$this->table)->select('*')->from($this->table)->where(array($this->field, $route))->result_one();
			if($item === NULL) $item = false;
			pzk_cache_route()->set(md5('route-'.$route.'-'.$this->table), $item);
			return $item;
		}
		
	}
}