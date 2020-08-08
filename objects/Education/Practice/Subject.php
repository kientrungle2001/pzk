<?php
class PzkEducationPracticeSubject extends PzkObject {
	public $layout = 'education/practice/subject';
	public function getCategory(){
		$categoryId = $this->getCategoryId();
		$category 	= _db()->selectAll()->fromCategories()->whereId($categoryId)->result_one();
		return $category;
	}
	
	public function getTopicTree() {
		$categoryId = $this->getCategoryId();
		$items = array();
		
		$class 		= 3;
		
		$items3 		= _db()->selectAll()->fromCategories()->likeParents('%,'.$categoryId.',%')->orderBy('ordering asc, id asc')->likeClasses('%,'.$class.',%')->whereDocument(0)
		->whereDisplay(1)->whereStatus(1)
		->result();
		$items3 = treefy($items3);

		foreach($items3 as $item) {
			if($item['hidden']) continue;
			if(($item['displayAtSite'] != 0) && ($item['displayAtSite'] != pzk_request()->getSiteId()))
				continue;
			$items[] = $item;
		}
		
		$class 		= 4;
		
		$items4 		= _db()->selectAll()->fromCategories()->likeParents('%,'.$categoryId.',%')->orderBy('ordering asc, id asc')->likeClasses('%,'.$class.',%')->whereDocument(0)
		->whereDisplay(1)->whereStatus(1)
		->result();
		$items4 = treefy($items4);
		
		foreach($items4 as $item) {
			if($item['hidden']) continue;
			if(($item['displayAtSite'] != 0) && ($item['displayAtSite'] != pzk_request()->getSiteId()))
				continue;
			$items[] = $item;
		}		
		
		$class 		= 5;
		
		$items5 		= _db()->selectAll()->fromCategories()->likeParents('%,'.$categoryId.',%')->orderBy('ordering asc, id asc')->likeClasses('%,'.$class.',%')->whereDocument(0)
		->whereDisplay(1)->whereStatus(1)
		->result();
		$items5 = treefy($items5);

		foreach($items5 as $item) {
			if($item['hidden']) continue;
			if(($item['displayAtSite'] != 0) && ($item['displayAtSite'] != pzk_request()->getSiteId()))
				continue;
			$items[] = $item;
		}
		return $items;
	}
}