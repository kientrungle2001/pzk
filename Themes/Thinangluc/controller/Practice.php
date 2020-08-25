<?php
class PzkPracticeController extends PzkController{

	public $masterPage	=	"index";
	public $masterPosition = 'wrapper';
	
	public function detailAction(){
		$courseId = pzk_request()->getSegment(3);
		$this->initPage();
			
			# session
			$class= pzk_session('lop');
			
			# head meta data
			$catEntity = _db()->getTableEntity('categories')->load($courseId, 1800);
			
			pzk_page()->setTitle('Luyện tập: ' . $catEntity->getName());
			pzk_page()->setKeywords($catEntity->getMeta_keywords());
			pzk_page()->setDescription($catEntity->getMeta_description());
			pzk_page()->setImg($catEntity->getImg());
			pzk_page()->setBrief($catEntity->getBrief());
			
			
			# render page content
			$this->append('education/practice/detail', 'wrapper');
			
			$course = pzk_element()->getCourse();
			
			if($course) {
				$course->setItemId($courseId);
			}
			
		$this->display();
	}
}