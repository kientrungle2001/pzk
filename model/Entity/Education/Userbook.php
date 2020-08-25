<?php 
class PzkEntityEducationUserbookModel extends PzkEntityModel
{
	public $table = 'user_book';
	public function getTest(){
		return _db()->getEntity('Education.Test')->load($this->getTestId());
	}
	public function mark() {
		$userAnswers = $this->getUserAnswers();
		
		$totalTn 		= 0;
		$totalAutoTl 	= 0;
		
		$totalAuto 		= 0;
		$totalTl 		= 0;
		
		$total 			= 0;
		
		$tnMark 		= 0;
		$autoTlMark 	= 0;
		
		$autoMark 		= 0;
		$tlMark 		= 0;
		
		$totalMark 		= 0;
		
		$test 			= $this->getTest();
		
		foreach($userAnswers as $userAnswer) {
			$question = $userAnswer->getQuestion();
			if(!$question) continue;
			if($question->isTn()) { // trắc nghiệm
				$tnQuestion = $question->getTnQuestion();
				$mark = $tnQuestion->mark($userAnswer);
				if($mark) {
					$mark = pzk_or($test->getScore(), $mark);
					$totalTn++;
					$totalAuto++;
					$total++;
					$tnMark 		+= $mark;
					$autoMark 		+= $mark;
					$totalMark 		+= $mark;
					$userAnswer->updateMark($mark);
					$userAnswer->updateMarked();
				}
			} else {	// tự luận
				if($question->isAuto()) {	// auto
					$autoTlQuestion = $question->getAutoTlQuestion();
					$mark = $autoTlQuestion->mark($userAnswer);
					if($mark) {
						$totalAutoTl++;
						$totalAuto++;
						$total++;
						$autoTlMark 	+= $mark;
						$autoMark 		+= $mark;
						$totalMark 		+= $mark;
						$userAnswer->updateMark($mark);
						$userAnswer->updateMarked();
					}
				} else {	// giáo viên chấm
					$tlQuestion = $question->getTlQuestion();
					$mark = $tlQuestion->mark($userAnswer);
					if($mark) {
						$totalTl++;
						$total++;
						$tlMark 		+= $mark;
						$totalMark 		+= $mark;
					}
				}
			}
		}
		if(0):
		echo '<br />';
		echo '$totalTn='. $totalTn;
		echo '<br />';
		echo '$totalAutoTl='. $totalAutoTl;
		echo '<br />';
		echo '$totalAuto='. $totalAuto;
		echo '<br />';
		echo '$totalTl='. $totalTl;
		echo '<br />';
		echo '$total='. $total;
		echo '<br />';
		echo '$tnMark='. $tnMark;
		echo '<br />';
		echo '$autoTlMark='. $autoTlMark;
		echo '<br />';
		echo '$autoMark='. $autoMark;
		echo '<br />';
		echo '$tlMark='. $tlMark;
		echo '<br />';
		echo '$totalMark='. $totalMark;
		endif;
		
		$this->updateField('totalTn', $tnMark);
		$this->updateField('autoMark', $autoMark);
		$this->updateField('teacherMark', $tlMark);
		$this->updateField('totalMark', $totalMark);
	}
	
	public function updateField($field, $value) {
		_db()->update($this->table)->set(array($field => $value))->whereId($this->getId())->result();
	}
	
	public function getUserAnswers() {
		return _db()->selectAll()->fromUser_answers()->whereUser_book_id($this->getId())->result('Education.Useranswer');
	}
}