<?php
pzk_import('Core.Db.Detail');
class PzkEducationPracticeHomework extends PzkCoreDbDetail {
	public $table 	= 	'tests';
	
	public function getQuestions() {
		$questions 	=	_db()->selectAll()->from('questions')
			->likeTestId('%,'.$this->getItemId().',%')
			->whereStatus(1)
			->whereDeleted(0)
			->orderBy('ordering asc, id asc')
			->result();
		return $questions;
	}
	
	public function getQuestionsAnswers($questionIds) {
		$answers = _db()->useCache(1800)
			->selectAll()
			->from('answers_question_tn')
			->where(array('in', 'question_id', $questionIds))
			->result();
		$processAnswer = array();
		foreach($answers as $val) {
			$processAnswer[$val['question_id']][] = $val;
		}
		return $processAnswer;
	}
	
	public function getTestParts($content) {
		if(strpos($content,'-----') === false) {
			return null;
		} else {
			$contents = explode('*****', $content);
			$parts = array();
			foreach($contents as $content) {
				$pair = explode('-----', $content);
				$parts[] = array(
					'content'	=>	$pair[0],
					'position'	=>	trim(strip_tags($pair[1]))
				);
			}
			return $parts;
		}
	}
	
	public function displayTestPart($parts, $index, $question) {
		if(!$parts) return null;
		foreach($parts as $part) {
			if($part['position'] == $index || $part['position'] == $question['id']) {
				echo $part['content'];
			}
		}
	}
}