<?php
class PzkGameVocabulary extends PzkObject
{
    public function getPairWords($documenId, $type) {
	$lesson = _db()->query("select * from game where documentId = {$documenId} and gamecode ='{$type}'");
		
		
		if($lesson[0]['question'] != '') {
			$content = $lesson[0]['question'];
			$words = preg_split('/\r\n|\r|\n|\<br \/\>|\<br\/\>/', $content);
		}else {
			$words = false;
		}
		
		return $words;
	}
	public function setTopics($arWords) {
		
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
	public function setWords($arWords) {
		
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