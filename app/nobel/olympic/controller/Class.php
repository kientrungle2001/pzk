<?php
class PzkClassController extends PzkController {
	public $masterPage = 'index';
	public $masterPositon = 'left';
	public function indexAction() {
		if(pzk_themes('olympic')) {
			$this->setMasterPage('index');
			$this->setMasterPosition('wrapper');
		}
		$classId = pzk_request()->getSegment(3);
    	
    	$this->initPage();
    	if(pzk_session('userId')){
			
			$check = pzk_user()->checkPayment('full');
			//tai khoan da active
			
			if(isset($check) && $check == 1) {
				$this->append('education/class/topiclist');
				$topicList = pzk_element()->getTopicList();
    	
				$mCate = pzk_model('Category');
    	
				$dataClass = $mCate->get_category_all($classId);
    	
				$topicList->setDataClass( $dataClass);
    	
				$topicList->setClassId( $classId);
			
			}else{
				//tai khoan dung thu
				$this->append('education/class/tester');
				$topicList = pzk_element()->getTopicList();
    	
				$mCate = pzk_model('Category');
    	
				$dataClass = $mCate->get_category_all($classId);
    	
				$topicList->setDataClass( $dataClass);
    	
				$topicList->setClassId( $classId);
			}
			
			
    	}else{
			$this->append('home');
		}
    	
    	
    	$this->display();
	}
}
?>