<?php
class PzkGameVocabularyDragToPart extends PzkObject
{
	public $documentId;
	public $gameCode;
	public function getGame() {
		return _db()->select('*')->from('game')->whereGamecode($this->getGameCode())
			->whereDocumentId($this->getDocumentId())->result_one();
	}
	public function getImagesAndWords () {
		$result = array();
		$game = $this->getGame();
		if(!$game) return $result;
		$content = $game['question'];
		$words = explode('-----', $content);
		foreach ($words as $word) {
			$parts = explode('===', $word);
			if(count($parts) == 2) {
				$words = json_decode(trim(strip_tags($parts[1])), true);
				preg_match('/src="([^"]+)"/', $parts[0], $match);
				$src = $match[1];
				$result[] = array(
					'words'	=> $words,
					'src'	=> $src
				);
			}
		}
		return $result;
	}
}