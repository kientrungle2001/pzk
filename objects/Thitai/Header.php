<?php
	/**
	 * Object Home/Header for header of themes vnwomen
	 */
	class PzkThitaiHeader extends PzkObject{
		public $layout 		= 	'thitai/header';
		public $cacheable	=	true;
		public $cacheParams = 'id,layout';
		public function getContest() {
			$data = _db()->useCache(1800)
				->useCacheKey('getAllContest')
				->select('id, name')
				->from('contest')
				->result();
			return $data;
		}
		
		public function hash() {
			return md5(parent::hash(). '_' . pzk_session()->getUsername());
		}
	}
 ?>