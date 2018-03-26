<?php
class PzkGamePlaygame extends PzkObject
{
	public function getWord()
	{
		$word=_db()->useCB()->select("game_title")->from("game_rainword")->result();
		return($word);
	}
		
}

?>