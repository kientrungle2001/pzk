<?php 
class PzkCoreThemesThemes extends PzkObject{
	public $layout = 'themes/themes';
	public $cacheable	=	'true';
	public $cacheParams	=	'layout';
	public function getThemes(){
		$this->initRoute();
		
		if($this->isAdminRoute()) {
			return null;
		}
		
		$today	= 	date('Y-m-d');
		if(!($themes = pzk_cache_themes()->getAllThemeNames())) {
			$themes	=	_db()->select("name")
					->useCache(1800)
					->useCacheKey('themes-today-asc')
					->from("themes")
					->setConds('1')
					->and_("`startDate` <= '$today'")
					->and_("`endDate` >= '$today'")
					//->lteStartDate($today)
					//->gteEndDate($today)
					->and_('status=' . ENABLED);
					//->whereStatus(ENABLED);
			$themes =
					$themes->orderBy('startDate asc')->result();
			foreach($themes as &$theme) {
				$theme['name'] = ucfirst($theme['name']);
			}
			pzk_cache_themes()->setAllThemeNames( $themes);
		}
		
		return($themes);
	}
	
	public function initRoute() {
		$request = pzk_request();
		$this->route = preg_replace('/^[\/]/', '', $request->route);
	}
	
	public function isAdminRoute() {
		return substr($this->route, 0, 5) == 'admin';
	}
}
 ?>