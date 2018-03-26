<?php 
class PzkGameController extends PzkController {
	public $masterPage = 'index';
	public $masterPosition = 'wrapper';
	public function familyAction() {
		$this->initPage();
		$this->append('game/family', 'wrapper');
		$this->display();
	}
	public function getQuestionAction() {
		$ids = Pzk_request()->get('ids');
		if($ids) {
			$this->parse('game/getNewQuestion');
			$getNewQuestion = pzk_element('getNewQuestion');
			$getNewQuestion->set('ids', trim($ids, ','));
			$getNewQuestion->display();
		}else {
			$this->parse('game/getQuestion');
			$getQuestion = pzk_element('getQuestion');	
			$getQuestion->display();
		}
		
		
	}
	public function getNewQuestionAction() {
		$ids = Pzk_request()->get('ids');
		
		if($ids){
			$this->parse('game/getNewQuestion');
			$getNewQuestion = pzk_element('getNewQuestion');
			$getNewQuestion->set('ids', trim($ids, ','));
			$getNewQuestion->display();
		}
		
	}
	public function checkAnswerAction() {
		$questionId = Pzk_request()->get('questionId');
		$answer = Pzk_request()->get('answer');
		if($questionId and $answer) {
			$frontendmodel = Pzk_model('Frontend');
			$checkAnswerTrue = $frontendmodel->getAnswerTrueByContent($answer, $questionId, "choice");
			if($checkAnswerTrue) {
				echo 1;
			}
			
		}
	}
}
?>