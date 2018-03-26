<?php 

/**
* 
*/
class PzkCmsNewsRssfeed extends PzkObject
{
    public $layout = 'cms/news/rssfeed';
	public function getInfo()
	{
		$data=_db()->useCB()->select("*")
            ->from("news")
            ->limit(30)
            ->orderBy('id desc')
            ->result();
		return($data);
		
	}
}
 ?>