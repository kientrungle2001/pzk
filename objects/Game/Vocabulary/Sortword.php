<?php
class PzkGameVocabularySortword extends PzkObject
{
	public $documentId;
	public $gameCode;
	public function getGame() {
		return _db()->select('*')->from('game')->whereGamecode($this->get('gameCode'))
			->whereDocumentId($this->get('documentId'))->result_one();
	}
	public function getWords () {
		$result = array();
		$game = $this->getGame();
		if(!$game) return $result;
		$content = $game['question'];
		$words = explode('-----', $content);
		foreach ($words as $word) {
			$parts = explode('===', $word);
			if(count($parts) == 2) {
				$result[]	= array(
					strtoupper(trim(strip_tags($parts[1]))),
					trim($parts[0])
				);
			}
		}
		return $result;
	}
}