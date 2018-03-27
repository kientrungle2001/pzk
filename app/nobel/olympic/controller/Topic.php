<?php 
class PzkTopicController extends PzkController {
	public $masterPage = "index";
	public $masterPosition = "left";
	
	public function indexAction() {
		if(pzk_themes('olympic')) {
			$this->setMasterPage('index');
			$this->setMasterPosition('wrapper');
		}
		$topicId = pzk_request()->getSegment(3);
    	
    	$this->initPage();
		$header = pzk_element('header');
		if($header) {
			$header->setLayout('home/header2');
		}
    	$this->append('education/topic/subTopicList');
    	
    	$subTopicList = pzk_element('subTopicList');
    	
    	$mCate = pzk_model('Category');
    	
    	$dataTopics = $mCate->get_category_all($topicId);
    	
    	$subTopicList->setDataTopics($dataTopics);
    	
    	$subTopicList->setTopicId($topicId);
    	
    	$this->display();
	}
}
?>