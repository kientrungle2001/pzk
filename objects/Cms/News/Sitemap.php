<?php 

/**
* 
*/
class PzkCmsNewsSitemap extends PzkObject
{
    public $layout = 'cms/news/sitemap';
	public function getNews()
	{
		$data=_db()->useCB()->select("*")
            ->from("news")
            ->orderBy('id desc')
            ->result();
		return($data);
		
	}
}
 ?>