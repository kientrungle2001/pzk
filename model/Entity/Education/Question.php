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
		return $this->get('questionType') == 1;
	}
	
	public function isTl() {
		return $this->get('questionType') == 4;
	}
	
	public function isAuto() {
		return $this->get('auto') == 1;
	}
	
	public function getTnQuestion() {
		return $this;
	}
	
	public function mark($userAnswer) {
		if($userAnswer->get('answerId') == $this->getAnswerId()) {
			return 1;
		} else {
			return 0;
		}
		return $userAnswer->get('mark');
	}
	
	public function getAnswerId() {
		$answer = _db()->selectAll()->fromAnswers_question_tn()->whereQuestion_id($this->get('id'))->whereStatus(1)->result_one();
		if($answer) {
			return $answer['id'];
		}
		return null;
	}
	
	public function getAutoTlQuestion() {
		return _db()->selectAll()->fromQuestions()->whereId($this->get('id'))->result_one('Education.Question.Tuluan.Auto');
	}
	
	public function getTlQuestion() {
		return _db()->selectAll()->fromQuestions()->whereId($this->get('id'))->result_one('Education.Question.Tuluan');
	}
	
	public function getQuestionAnswers() {
		return _db()->selectAll()->fromAnswers_question_tn()->whereQuestion_id($this->get('id'))->result('Education.Question.Answer');
	}
	
	public function mix($answer) {
		$user_answer = unserialize($answer->get('content'));
		$teacher_answers = json_decode($this->get('teacher_answers'));
		$content = $this->get('name_vn');
		$pattern = '/\[(input|i)([\d]+)(\[([\d]+)\])?\]/';
		$replacement =	"<input size='$4' class='answers_".$this->get('id')."_i_$2' name='answers[".$this->get('id')."_i][$2]'/>";
		$content = preg_replace($pattern, $replacement, $content);
		
		$pattern2 = '/\[(tput|tp)([\d]+)(\[([\d]+)\])?\]/';
		$replacement2 =	"<input class='input_dt answers_".$this->get('id')."_i_$2' size='$4' name='answers[".$this->get('id')."_i][$2]'/>";
		$content = preg_replace($pattern2, $replacement2, $content);
		
		$pattern3 = '/\[(upload|u)([\d]+)(\[([\d]+)\])?\]/';
		$replacement3 =	"<input type=\"file\" class='input_upload' size='$4' name='answers[".$this->get('id')."_u][$2]'/>";
		$content = preg_replace($pattern3, $replacement3, $content);
		
		$pTextarea = '/\[(textarea|t)([\d]+)\]/';
		$reTextarea = "<textarea class='w100p tinymce_input' name='answers[".$this->get('id')."_t][$2]'></textarea>";	
		$content = preg_replace($pTextarea, $reTextarea, $content);
		$content .= '<script>
		var teacher_answers_'.$this->get('id').' = '.json_encode($teacher_answers).';
		var answers_'.$this->get('id').' = '.json_encode($user_answer).';
		for(var type_of_input in answers_'.$this->get('id').'){
			var arr = answers_'.$this->get('id').'[type_of_input];
			for(var k in arr) {
				$(".answers_'.$this->get('id').'_"+type_of_input+"_" + k).val(arr[k]);
				$(".answers_'.$this->get('id').'_"+type_of_input+"_" + k).attr("disabled", "disabled");
				$(".answers_'.$this->get('id').'_"+type_of_input+"_" + k).after("(<strong>Đáp án: "+(teacher_answers_'.$this->get('id').' && teacher_answers_'.$this->get('id').'[type_of_input] && teacher_answers_'.$this->get('id').'[type_of_input][k]?teacher_answers_'.$this->get('id').'[type_of_input][k]:"")+"</strong>)");
			}
		}
		</script>';
		return $content;
	}
}