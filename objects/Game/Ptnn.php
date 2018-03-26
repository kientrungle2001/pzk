<?php
class PzkGamePtnn extends PzkObject
{
    public function getGameType() {
        $data = _db()->select('*')
            ->from($this->table1)
			->where('vocabulary = 0')
            ->result();
			
        return $data;
    }
    public function getGameTopic() {
        $data = _db()->select('*')
            ->from($this->table2)
            ->result();
        return $data;
    }
    public function getWordGame($gameType, $topic, $table) {
        $data = _db()->select('*')
            ->from($table)
            ->where(array('gamecode', $gameType))
            ->where(array('game_topic_id', $topic));
        return $data->result_one();
    }
	
	public function getRate($gamecode, $topic) {
		$sql = "SELECT g.live, g.score, g.userId, u.username FROM gamescore as g
		LEFT JOIN `user` as u ON g.userId = u.id
		WHERE gamecode = '{$gamecode}' and gametopic = {$topic} 
		GROUP BY userId 
		ORDER BY score desc, live desc 
		limit 10";
		$data = _db()->query($sql);
		return $data;
	}
	
	public function countDragWord() {
		$data = _db()->query("select id from game where gamecode = 'dragWord'");
		
		return $data;
			
	}
	
	public function getPairWords($id) {
	$lesson = _db()->query("select * from game where id = {$id}");
		
		
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