<?php
class PzkNewsController extends PzkController {
	public $masterPage 		= 'index';
	public $masterPosition 	= 'left';
	
	public function landingAction(){
		$this->initPage();
		$this->append('cms/news/landingpage');
		$this->display();
	}
	
	public function indexAction(){
		$this->initPage();
		$this->append('cms/news/index');
		$this->display();
	}
	
	public function detailAction()
	{	
		$this->initPage();
		
		$newsId = pzk_request('id');
		
		if(!$newsId) $newsId = pzk_request()->getSegment(3);
		
		pzk_request()->setId($newsId);
		
		$newsEntity = _db()->getTableEntity('news')->load($newsId, 1800);
		
		pzk_page()->setTitle($newsEntity->getTitle());
		pzk_page()->setKeywords($newsEntity->getMeta_keywords());
		pzk_page()->setDescription($newsEntity->getMeta_description());
		pzk_page()->setImg($newsEntity->getImg());
		pzk_page()->setBrief($newsEntity->getBrief());
		
		$news = $this->parse('cms/news/detail');
		$detail = pzk_element()->getDetail();
		
		if($detail) {
			$detail->setItemId($newsId);
			//$detail->statVisitor();
			$stat = pzk_stat();
			$stat->log('news', $newsId);
			$this->append($news);
		}
		
		$this->display();
	}
	public function contactAction(){
		$this->initPage();
		$news = pzk_parse('<cms.news.contact table="news" layout="cms/news/contact" />');
		$this->append($news);
		$this->display();
	}
	public function rssfeedAction() {
		header("Content-type: text/xml");
		$news = pzk_parse('<cms.news.rssfeed table="news" layout="cms/news/rssfeed" />');
		$news->display();
	}
	public function sitemapAction()
	{
		$sitemap = pzk_parse('<cms.news.sitemap table="news" layout="cms/news/sitemap" />');
		$sitemap->display();		
	}
		
		

}
?>