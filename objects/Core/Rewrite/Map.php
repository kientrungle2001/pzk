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
				$request->setController( 'Game');
				$request->setAction( 'ptnn');
			break;
			case 'rating':
				$request->setController( 'Home');
				$request->setAction( 'rating');
			break;
			case 'gift':
				$request->setController( 'Relax');
				$request->setAction( 'home');
			break;
			default:
				
			break;
		}
	}
}