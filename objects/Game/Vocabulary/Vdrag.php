<?php
class PzkGameVocabularyVdrag extends PzkObject
{
    public $documenId;
	public $gameCode;
	
	public function getPairWords() {
		
		$lesson = _db()->select('*')->from('game')->where(array('gamecode', $this->getGameCode()))
			->where(array('documentId', $this->getDocumentId()))->result_one();
		
		if($lesson['question'] != '') {
			$content = explode('*****', $lesson['question']);
			foreach($content as $item) {
				if(!$item){
					continue;
				}
				$rs = preg_split('/\r\n|\r|\n|\<br \/\>|\<br\/\>/', $item);
				if($rs[0] == '') {
					array_shift($rs);
				}
				if($rs[count($rs)-1] == '') {
					array_pop($rs);
				}
				$arrWord[] = $rs;
			}
			
			
		}else {
			$arrWord = false;
		}
		//debug($arrWord);die();
		return $arrWord;
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
	public function getAllTopic($arWords) {
		
		if(is_array($arWords)) {
			$topics = array();
			
			foreach($arWords as $val) {
				$tam = explode(':', $val);
				
				$topics[] = $tam[0];
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
				$tamWord = @explode(',', $tam[1]);
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