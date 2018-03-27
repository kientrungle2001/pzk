<?php 
/**
* 
*/
class PzkEntityImportQuestionSplitModel extends PzkEntityModel
{
	public $table = "questions";
	public function import() {
		$answers = array();
		$content = $this->get('content');
		$contents = explode('===', $content);
		$nameRegion = $contents[0];
		$answersRegion = $contents[1];
		$rightRegion = $contents[2];
		$levelRegion = @$contents[3];
		$request = nl2br(@$contents[4]);
		preg_match_all('/[\r\n][\s\t]*[ABCDEF][\s\t]*\.[\s\t]*([^\r\n]*)/', $answersRegion, $matches);
		$answerContents = $matches[1];
		preg_match('/án[\s\t]*:[\s\t]*([ABCDEF])/', $rightRegion, $match);
		$rightIndex = -1;
		if(@$match[1]) {
			$rightIndex = ord(@$match[1]) - ord('A');
		}
		preg_match('/khó[\s\t]*:[\s\t]*([\d]+)/', $levelRegion, $levelMatch);
		$level = @$levelMatch[1];
		$nameRepaired = preg_replace('/^[^\:\.]*[\:\.]\s*/', '', $nameRegion);
		$nameRepaired = trim(nl2br($nameRepaired));
		//$this->set('name', trim($name));
		$this->set('name', $nameRepaired);
		foreach($answerContents as $answerContent) {
			$answer = _db()->getEntity('Import.Answer');
			$answer->set('content', $answerContent);
			$answers[] = $answer;
		}
		if($rightIndex != -1) {
			$answers[$rightIndex]->set('recommend', $request);
			$answers[$rightIndex]->set('status', '1');
		} else {
			if(!pzk_request('isAjax'))
			pzk_notifier_add_message('Câu hỏi: '. $name . ' chưa có câu trả lời đúng', 'danger');
		}
		if(!$level) {
			if(!pzk_request('isAjax'))
			pzk_notifier_add_message('Câu hỏi: '. $name . ' chưa có độ khó', 'danger');
		}
		$this->set('level', $level);
		$this->set('answers', $answers);
		if(!count($answers)) {
			if(!pzk_request('isAjax'))
			pzk_notifier_add_message('Câu hỏi: '. $name . ' chưa có câu trả lời nào', 'danger');
		}
	}
}
 ?>