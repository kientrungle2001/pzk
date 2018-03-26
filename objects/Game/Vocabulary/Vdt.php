<?php
class PzkGameVocabularyVdt extends PzkObject
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
				$rs = explode('-----', strip_tags($item,'<a>'));
				//img
				preg_match('/href=[\'"]([^\'"]*)[\'"]/', $rs[0], $match);
				$tam = trim(@$match[1]);
				$arrWord[$key]['hreffix'] = "'".str_replace(BASE_REQUEST, '', $tam)."'";
				$arrWord[$key]['href'] = str_replace(BASE_REQUEST, '', $tam);
				//datatrue
				$arrWord[$key]['trueWord'] = trim(strtolower($rs[1]));
				
			}
			
			
		}else {
			$arrWord = FALSE;
		}
		//debug($arrWord);die();
		return $arrWord;
	}
	
}

?>