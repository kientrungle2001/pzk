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
			
			pzk_page()->set('title', 'Luyện tập: ' . $catEntity->get('name'));
			pzk_page()->set('keywords', $catEntity->get('meta_keywords'));
			pzk_page()->set('description', $catEntity->get('meta_description'));
			pzk_page()->set('img', $catEntity->get('img'));
			pzk_page()->set('brief', $catEntity->get('brief'));
			
			
			# render page content
			$this->append('education/practice/detail', 'wrapper');
			
			$course = pzk_element()->getCourse();
			
			if($course) {
				$course->set('itemId', $courseId);
			}
			
		$this->display();
	}
}