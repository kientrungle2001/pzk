<?php 
class PzkEntityEducationQuestionModel extends PzkEntityModel
{
	public $table = 'questions';
	public $_answers = null;
	
	public function setAnswers($answers) {
		$this->_answers = $answers;
	}
	
	public function getAnswers() {
		return $this->_answers;
	}
	
	public function getChoiceAnswers() {
	}
	
	public function isTn() {
		return $this->getQuestionType() == 1;
	}
	
	public function isTl() {
		return $this->getQuestionType() == 4;
	}
	
	public function isAuto() {
		return $this->getauto() == 1;
	}
	
	public function getTnQuestion() {
		return $this;
	}
	
	public function mark($userAnswer) {
		if($userAnswer->getanswerId() == $this->getAnswerId()) {
			return 1;
		} else {
			return 0;
		}
		return $userAnswer->getMark();
	}
	
	public function getAnswerId() {
		$answer = _db()->selectAll()->fromAnswers_question_tn()->whereQuestion_id($this->getId())->whereStatus(1)->result_one();
		if($answer) {
			return $answer['id'];
		}
		return null;
	}
	
	public function getAutoTlQuestion() {
		return _db()->selectAll()->fromQuestions()->whereId($this->getId())->result_one('Education.Question.Tuluan.Auto');
	}
	
	public function getTlQuestion() {
		return _db()->selectAll()->fromQuestions()->whereId($this->getId())->result_one('Education.Question.Tuluan');
	}
	
	public function getQuestionAnswers() {
		return _db()->selectAll()->fromAnswers_question_tn()->whereQuestion_id($this->getId())->result('Education.Question.Answer');
	}
	
	public function mix($answer) {
		$user_answer = unserialize($answer->getContent());
		$teacher_answers = json_decode($this->getTeacher_answers());
		$content = $this->getName_vn();
		$pattern = '/\[(input|i)([\d]+)(\[([\d]+)\])?\]/';
		$replacement =	"<input size='$4' class='answers_".$this->getId()."_i_$2' name='answers[".$this->getId()."_i][$2]'/>";
		$content = preg_replace($pattern, $replacement, $content);
		
		$pattern2 = '/\[(tput|tp)([\d]+)(\[([\d]+)\])?\]/';
		$replacement2 =	"<input class='input_dt answers_".$this->getId()."_i_$2' size='$4' name='answers[".$this->getId()."_i][$2]'/>";
		$content = preg_replace($pattern2, $replacement2, $content);
		
		$pattern3 = '/\[(upload|u)([\d]+)(\[([\d]+)\])?\]/';
		$replacement3 =	"<input type=\"file\" class='input_upload' size='$4' name='answers[".$this->getId()."_u][$2]'/>";
		$content = preg_replace($pattern3, $replacement3, $content);
		
		$pTextarea = '/\[(textarea|t)([\d]+)\]/';
		$reTextarea = "<textarea class='w100p tinymce_input' name='answers[".$this->getId()."_t][$2]'></textarea>";	
		$content = preg_replace($pTextarea, $reTextarea, $content);
		$content .= '<script>
		var teacher_answers_'.$this->getId().' = '.json_encode($teacher_answers).';
		var answers_'.$this->getId().' = '.json_encode($user_answer).';
		for(var type_of_input in answers_'.$this->getId().'){
			var arr = answers_'.$this->getId().'[type_of_input];
			for(var k in arr) {
				$(".answers_'.$this->getId().'_"+type_of_input+"_" + k).val(arr[k]);
				$(".answers_'.$this->getId().'_"+type_of_input+"_" + k).attr("disabled", "disabled");
				$(".answers_'.$this->getId().'_"+type_of_input+"_" + k).after("(<strong>Đáp án: "+(teacher_answers_'.$this->getId().' && teacher_answers_'.$this->getId().'[type_of_input] && teacher_answers_'.$this->getId().'[type_of_input][k]?teacher_answers_'.$this->getId().'[type_of_input][k]:"")+"</strong>)");
			}
		}
		</script>';
		return $content;
	}
}