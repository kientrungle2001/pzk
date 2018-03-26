<?php
class PzkGameBuy extends PzkObject
{
    public function getGames()
    {
        $games=_db()->useCB()->select("*")->from("game")->result();
        return($games);
    }
}
?>