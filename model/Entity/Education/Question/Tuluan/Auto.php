<?php 
class PzkEntityEducationQuestionTuluanAutoModel extends PzkEntityModel
{
	public $table = 'questions';
	public function mark($userAnswer) {
		$answer = unserialize($userAnswer->get('content'));
		if($this->get('auto')) {
			$teacher_answers = json_decode($this->get('teacher_answers'), true);
			$total = 0;
			foreach($answer as $type => $ans) {
				foreach($ans as $index => $value)  {
					if(isset($teacher_answers[$type][$index])) {
						$t_answers = explode('|', $teacher_answers[$type][$index]);
						foreach($t_answers as $t_answer) {
							if(strtolower(trim($t_answer)) == strtolower(trim($value))) {
								$total+= $teacher_answers[$type.'_m'][$index];
							}
						}
					}
				}
			}
			return $total;
		}
		return 0;
	}
}