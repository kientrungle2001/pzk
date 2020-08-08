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
		
		pzk_request()->set('id', $newsId);
		
		$newsEntity = _db()->getTableEntity('news')->load($newsId, 1800);
		
		pzk_page()->set('title', $newsEntity->get('title'));
		pzk_page()->set('keywords', $newsEntity->get('meta_keywords'));
		pzk_page()->set('description', $newsEntity->get('meta_description'));
		pzk_page()->set('img', $newsEntity->get('img'));
		pzk_page()->set('brief', $newsEntity->get('brief'));
		
		$news = $this->parse('cms/news/detail');
		$detail = pzk_element()->getDetail();
		
		if($detail) {
			$detail->set('itemId', $newsId);
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