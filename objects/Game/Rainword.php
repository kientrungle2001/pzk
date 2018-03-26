<?php
class PzkGameRainword extends PzkObject
{
    public function getWordGame($gameType, $topic) {
        $data = _db()->select('*')
            ->from($this->table)
            ->where(array('gamecode', $gameType))
            ->where(array('game_topic_id', $topic));
        return $data->result_one();
    }
		
}

?>