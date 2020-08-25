<?php 
class PzkEntityEducationQuestionTuluanModel extends PzkEntityModel
{
	public $table = 'questions';
	public function mark($userAnswer) {
		return $userAnswer->getMark();
	}
}