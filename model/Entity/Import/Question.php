<?php 
/**
* 
*/
class PzkEntityImportQuestionModel extends PzkEntityModel
{
	public $table = "questions";
	public function import() {
		$answers = array();
		$content = $this->get('content');
		$contents = explode('===', $content);
		$content = $contents[0];
		$request = @$contents[1];
		preg_match_all('/[\r\n][\s\t]*[ABCDEF][\s\t]*\.[\s\t]*([^\r\n]*)/', $content, $matches);
		$answerContents = $matches[1];
		preg_match('/[\s\t]*:[\s\t]*([ABCDEF])/', $content, $match);
		$rightIndex = -1;
		if(@$match[1]) {
			$rightIndex = ord(@$match[1]) - ord('A');
		}
		preg_match('/[\s\t]*:[\s\t]*([\d]+)/', $content, $levelMatch);
		$level = @$levelMatch[1];
		preg_match('/[^\:\.][:\.]([^\r\n]+)/', $content, $contentMatch);
		$name = trim(@$contentMatch[1]);
		if(!$name) {
			pzk_notifier_add_message('Chưa có nội dung câu hỏi', 'danger');
		}
		$this->set('name', $name);
		foreach($answerContents as $answerContent) {
			$answer = _db()->getEntity('Import.Answer');
			$answer->set('content', $answerContent);
			$answers[] = $answer;
		}
		if($rightIndex != -1) {
			$answers[$rightIndex]->set('request', $request);
			$answers[$rightIndex]->set('status', '1');
		} else {
			pzk_notifier_add_message('Câu hỏi: '. $name . ' chưa có câu trả lời đúng', 'danger');
		}
		if(!$level) {
			pzk_notifier_add_message('Câu hỏi: '. $name . ' chưa có độ khó', 'danger');
		}
		$this->set('level', $level);
		$this->set('answers', $answers);
		if(!count($answers)) {
			pzk_notifier_add_message('Câu hỏi: '. $name . ' chưa có câu trả lời nào', 'danger');
		}
	}
}
 ?>