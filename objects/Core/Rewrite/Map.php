<?php
class PzkCoreRewriteMap extends PzkObjectLightweight{
	public function init() {
		if(self::$matched) return true;
		$request = pzk_request();
		
		if($request->isAdminRoute()) {
			return true;
		}
		
		$route = $request->getStrippedSlashRoute();
		switch($route) {
			case 'game':
				$request->set('controller', 'Game');
				$request->set('action', 'ptnn');
			break;
			case 'rating':
				$request->set('controller', 'Home');
				$request->set('action', 'rating');
			break;
			case 'gift':
				$request->set('controller', 'Relax');
				$request->set('action', 'home');
			break;
			default:
				
			break;
		}
	}
}