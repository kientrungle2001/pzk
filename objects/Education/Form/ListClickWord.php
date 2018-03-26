<?php 
class PzkEducationFormListClickWord extends PzkObject {
	public $scriptable = false;
	public $lessonId = '';
	public $lessonType = '';
	public $rootCateId = '';
	public function getPairWords() {
		$lesson = _db()->selectAll()->fromWord()->likeCategoryIds('%,'.$this->getLessonId().',%')->result_one();
		$content = $lesson['content'];
		if($content) {
			$words = preg_split('/\r\n|\r|\n|\<br \/\>|\<br\/\>/', $content);
			$pairs = array();
			foreach($words as $word) {
				$pairs[] = explodetrim(',', $word);
			}
		}else {
			$pairs = false;
		}
		
		return $pairs;
	}
}
?>