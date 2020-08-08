<?php
class PzkEducationTestTest extends PzkObject {
	public $layout = 'test/test';
	public $testId = false;
	public $lessonId = '';

	public function getTest() {
		return _db()->getEntity('Test.Test')->load($this->getTestId());
	}
	
	/* public function getDoTest(){
		
		$query =  _db()->select('*')->from('user_book')->where(array('and', array('testId','1'), array('userId',pzk_session()->getUserId()) ))->result();
		
		return $query;
	} */
	
	public function numPage($quantity){
		$numpage= ceil($quantity/3);
		return $numpage;
	}
	
	public function getAllTest() {
		$data = _db()->selectAll()->fromTests()->result();
		return $data;
	}
	public function getTestByClass($class) {
		$data = _db()->selectAll()->fromTests()->likeClasses('%,'.$class.',%')->result();
		return $data;
	}
	public function getCurentTest($id) {
		$data = _db()->selectAll()->fromTests()->where(array('id', $id))->result_one();
		return $data;
	}
	public function getTestOtherByClass($class, $id) {
		$data = _db()->selectAll()->fromTests()->likeClasses('%'.$class.'%')->where("id != $id");
		//echo $data->getQuery();
		return $data->result();
	}
	public function getQuestionsByType($type) {
		$data = _db()->selectAll()
			->fromQuestions()
			->likeTestId('%,'.$this->getTestId().',%')
			->where(array('type', $type))
			->result();
		return $data;
	}
	
	public function getClickWord() {
		$lesson = _db()->selectAll()
			->fromWord()
			->likeTestId('%,'.$this->getTestId().',%')
			->where(array('type', 'clickWord'))
			->result_one();
		$content = $lesson['content'];
		if($content) {
			$words = preg_split('/\r\n|\r|\n|\<br \/\>|\<br\/\>/', $content);
			$pairs = array();
			foreach($words as $word) {
				$pairs[] = explodetrim(',', $word);
			}
		}else {
			$pairs = false;
		}
		
		return $pairs;
	}
	
	public function getPairWords() {
		$lesson = _db()->selectAll()
			->fromWord()
			->likeTestId('%,'.$this->getTestId().',%')
			->where(array('type', 'dragWord'))
			->result_one();
		if($lesson['content'] != '') {
			$content = $lesson['content'];
			$words = preg_split('/\r\n|\r|\n|\<br \/\>|\<br\/\>/', $content);
		}else {
			$words = false;
		}
		
		return $words;
	}
	public function setTopics() {
		$arWords = $this->getPairWords();
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
	public function setWords() {
		$arWords = $this->getPairWords();
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