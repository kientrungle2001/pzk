<?php 
class PzkEducationFormListDragWord extends PzkObject {
	public $scriptable = false;
	public $lessonId = '';
	public $lessonType = '';
	public $rootCateId = '';
	public function getPairWords() {
		$lesson = _db()->selectAll()->fromWord()->likeCategoryIds('%,'.$this->getLessonId().',%')->result_one();
		if($lesson['content'] != '') {
			$content = $lesson['content'];
			$words = preg_split('/\r\n|\r|\n|\<br \/\>|\<br\/\>/', $content);
		}else {
			$words = false;
		}
		
		return $words;
	}
	public function setTopics() {
		$arWords = $this->getPairWords();
		if(is_array($arWords)) {
			$topics = array();
			$i = 0;
			foreach($arWords as $val) {
				$tam = explode(':', $val);
				$topics[$i]['type'] = $tam[0];
				$topics[$i]['name'] = $tam[0];
				$i++;
			}
		}else {
			$topics = false;
		}
		
		return $topics;
	}
	public function setWords() {
		$arWords = $this->getPairWords();
		if(is_array($arWords)) {
			$words = array();
			$i = 0;
			foreach($arWords as $val) {
				$tam = explode(':', $val);
				$typeWrod = $tam[0];
				$tamWord = explode(',', $tam[1]);
				$j=0;
				foreach($tamWord as $val) {
					$array[$i][$j]['type'] = $typeWrod;
					$array[$i][$j]['name'] = $val;
					$j++;
				}
				
				$i++;
				
			}
		
			foreach($array as $val) {
				foreach($val as $word) {
					$words[] = $word;
				}
			}
		}else {
			$words = false;
		}
		return $words;
	}
}
?>