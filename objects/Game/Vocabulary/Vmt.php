<?php
class PzkGameVocabularyVmt extends PzkObject
{
    public $documenId;
	public $gameCode;
	
	public function getDataWords() {
		
		$lesson = _db()->select('*')->from('game')->whereGamecode($this->get('gameCode'))
			->whereDocumentId($this->get('documentId'))->result_one();
		
		if($lesson['question'] != '') {
			$content = explode('*****', $lesson['question']);
			foreach($content as $key => $item) {
				if(!$item){
					continue;
				}
				$rs = explode('-----', strip_tags($item,'<img>'));
				//img
				preg_match('/src=[\'"]([^\'"]*)[\'"]/', $rs[0], $match);
				$arrWord[$key]['img'] = trim(@$match[1]);
				//datatrue
				$arrWord[$key]['allWords'] = $rs[1];
				$arrWord[$key]['trueWord'] = $rs[2];
				
			}
			
			
		}else {
			$arrWord = false;
		}
		//debug($arrWord);die();
		return $arrWord;
	}
	
}

?>