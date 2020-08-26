<?php
class PzkBannerController extends PzkController {
	public $masterPage		=	'index';
	public $masterPosition	=	'right';
	
	public function bannerPostAction()
	{
		$ip 			= 	getRealIPAddress();
		$id				=	pzk_request()->getId();
		$utm_source		=	pzk_request()->getUtm_source();
		$utm_campaign	=	pzk_request()->getUtm_campaign();
		$time			=	date("Y-m-d");		
		$testclick =_db()->useCB()->select('id')
				->from('banner_click')
				->where(array('ip', $ip))
				->where(array('timeclick', $time))
				->where(array('bannerId', $id))
				->where(array('utm_source', $utm_source))
				->where(array('utm_campaign', $utm_campaign))
				->result_one();
		if(!$testclick)
		{
			$addclick =	array(
				'bannerId'		=>	$id,
				'ip'			=>	$ip,
				'utm_source'	=>	$utm_source,
				'timeclick' 	=> 	$time, 
				'utm_campaign'	=> 	$utm_campaign);
				$entity = _db()
						->getEntity('Table')
						->setTable('banner_click');
				$entity->setData($addclick);
				$entity->save();	
		}
		$banner	=	_db()
				->select("count(*) as total")
				->from("banner_click")
				->where(array('bannerId',$id))
				->result_one();
		$click	=	$banner['total'];
		_db()
				->update('banner')
				->set(array('click' => $click))
				->where(array('id',$id))->result();
		$url	=	_db()
				->select("url")
				->from("banner")
				->where(array('id',$id))
				->result_one();
		$this->redirect($url['url']);
	}
	
	public function statviewAction() {
		$files = glob(BASE_DIR . '/cache/data/banner-*.txt');
		foreach($files as $file) {
			$id 		= str_replace(BASE_DIR . '/cache/data/banner-', '', $file);
			$id 		= str_replace('.txt', '', $id);
			$views 		= file_get_contents($file);
			$entity 	= _db()->getTableEntity('banner');
			$entity->load($id);
			if($entity->getId()) {
				@unlink($file);
				$entity->setViews($entity->getViews() + $views);
				$entity->save();
			}
			
		}
	}
}
?>