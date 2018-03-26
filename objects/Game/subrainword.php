<?php
class PzkGameSubRainword extends PzkObject
{
	public function getGames($id)
	{
		$games=_db()->useCB()->select("*")->from("game_rainword")->where(array('parent',$id))->result();
		return($games);
	}
		
}

?>