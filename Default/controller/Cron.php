<?php
/**
*
*/
class PzkCronController extends PzkController {
	public function paycardAction() {
		$serial = 102000;
		echo '<h2>Toàn bộ 1 năm</h2>';
		echo '<table>';
		echo '<tr><td>Code</td><td>Serial</td></tr>';
		for($i = 0; $i < 100; $i++) {
			$code = rand(1000, 9999) . '' . rand(1000, 9999);
			$serial++;
			echo '<tr><td>'.$code.'</td><td>'.$serial.'</td></tr>';
		}
		echo '</table>';
		echo '<br />';echo '<br />';
		echo '<h2>Toàn bộ nửa năm</h2>';
		echo '<table>';
		echo '<tr><td>Code</td><td>Serial</td></tr>';
		for($i = 0; $i < 100; $i++) {
			$code = rand(1000, 9999) . '' . rand(1000, 9999);
			$serial++;
			echo '<tr><td>'.$code.'</td><td>'.$serial.'</td></tr>';
		}
		echo '</table>';
		echo '<br />';echo '<br />';
		echo '<h2>Chỉ bài giảng 1 năm</h2>';
		echo '<table>';
		echo '<tr><td>Code</td><td>Serial</td></tr>';
		for($i = 0; $i < 100; $i++) {
			$code = rand(1000, 9999) . '' . rand(1000, 9999);
			$serial++;
			echo '<tr><td>'.$code.'</td><td>'.$serial.'</td></tr>';
		}
		echo '</table>';
		echo '<br />';echo '<br />';
		echo '<h2>Chỉ bài tập 1 năm</h2>';
		echo '<table>';
		echo '<tr><td>Code</td><td>Serial</td></tr>';
		for($i = 0; $i < 100; $i++) {
			$code = rand(1000, 9999) . '' . rand(1000, 9999);
			$serial++;
			echo '<tr><td>'.$code.'</td><td>'.$serial.'</td></tr>';
		}
		echo '</table>';
		echo '<br />';echo '<br />';
		/*
		echo '<table>';
		echo '<tr><td>Code</td><td>Serial</td></tr>';
		for($i = 0; $i < 500; $i++) {
			$code = rand(1000, 9999) . '' . rand(1000, 9999);
			$serial = rand(1000, 9999) . '' . rand(10, 99);
			echo '<tr><td>'.$code.'</td><td>'.$serial.'</td></tr>';
		}
		echo '</table>';*/
	}
	public function deleteCacheAction() {
		$time_cache_web 		= pzk_config('time_cache_web');
		$time_cache_session 	= pzk_config('time_cache_session');
		if(!$time_cache_web) die('no time_cache_web');
		if(!$time_cache_session) die('no time_cache_session');
		echo $time_cache_web . '<br />';
		echo $time_cache_session . '<br />';
		$cachefiles = glob('cache/*.txt*');
		foreach($cachefiles as $file) {
			$timefile = filemtime($file);
			$timedelete = $timefile + $time_cache_web;

			if(time() > $timedelete) {
				unlink('cache/'.basename($file));
				echo 'cache/'.basename($file) . '<br />';
			}
		}

		$cachesission = glob('cache/session/*.txt*');
		foreach($cachesission as $file) {
			$timefile = filemtime($file);
			$timedelete = $timefile + $time_cache_session;

			if(time() > $timedelete) {
				unlink('cache/session/'.basename($file));
				echo 'cache/session/'.basename($file) . '<br />';
			}
		}
	}
	public function updatePaymentHistoryForUserAction() {
		_db()->query('update user set paid_id=0, paid_1_id=0, paid_2_id=0 where 1');
		_db()->query('update user, history_payment set user.paid_id = history_payment.id where user.username = history_payment.username and history_payment.paymentStatus=1');
		_db()->query('update user, history_payment_test set user.paid_1_id = history_payment_test.id where user.username = history_payment_test.username and history_payment_test.test=1 and history_payment_test.paymentStatus=1');
		_db()->query('update user, history_payment_test set user.paid_2_id = history_payment_test.id where user.username = history_payment_test.username and history_payment_test.test=2 and history_payment_test.paymentStatus=1');
	}
	
	public function updatePaidIdForUserAction() {
		_db()->query('update user set paid_id=0 where 1');
		_db()->query('update user, history_payment set user.paid_id = history_payment.id where user.username = history_payment.username and history_payment.paymentStatus=1');
	}
	public function statAction() {
		$stat 	= 	pzk_stat();
		$stat->updateIntoDatabase();
	}
	
	public function indexRankingAction() {
		_db()->query('truncate table user_book_rating');
		_db()->query('insert into user_book_rating(userId, startTime, mark, duringTime, testId, username, name, name_sn, software) 
      select userId, startTime, mark, duringTime, testId, username, name, name_sn, software
            from (
               select ub.startTime, ub.userId as userId, ub.id, mark , ub.duringTime, ub.testId, u.username, t.name, t.name_sn, ub.software
               FROM user_book ub
               INNER JOIN user u ON ub.userId = u.id
               INNER JOIN tests t ON ub.testId = t.id
               where 1
               ORDER BY ub.mark DESC, ub.duringTime ASC
            ) as subQuery
       GROUP BY userId, software, testId
       ORDER BY mark desc, duringTime ASC;');
	}
	
	public function updateDataToAchievementAction() {
		$stat 	= 	pzk_stat();
		$stat->updateToAchievement();
	}
	
	public function updateAchievementByWeekAction() {
		$week = date("W", strtotime('-2 day'));
		$year = date("Y");
		$data = _db()->select('*')
				->from('achievement')
				->where(array('week', $week))
				->where(array('year', $year))
				->result();
		if($data){
			foreach($data as $item){
				$tree = 0;			
				$totalPracticeQuestion = $item['totalPracticeQuestion'];
				if($totalPracticeQuestion >= 50 && $totalPracticeQuestion < 60){
					$tree = 1;
				}elseif($totalPracticeQuestion >= 60 && $totalPracticeQuestion < 70){
					$tree = 2;
				}elseif($totalPracticeQuestion >= 70 && $totalPracticeQuestion < 80){
					$tree = 3;
				}
				elseif($totalPracticeQuestion >= 80){
					$add = floor(($totalPracticeQuestion - 70)/10);
					$tree = 3 + $add;
				}
				
				if($item['total']>0){
					$centTrueGame = floor($item['rights']*100 / $item['total']);
					if($centTrueGame >= 50 && $centTrueGame < 70){
						$tree = $tree + 1;
					}elseif($centTrueGame >= 70 && $centTrueGame < 90){
						$tree = $tree + 2;
					}elseif($centTrueGame >= 90){
						$tree = $tree + 3;
					}
				}
				
				
				//phan lam luyen tap
				$flower = 0;
				if($item['totalPracticeQuestion'] > 0){
					$centTruePractice = floor($item['truePracticeQuestion']*100 / $item['totalPracticeQuestion']);
					if($centTruePractice >= 50 && $centTruePractice < 70){
						$flower = 1;
					}elseif($centTruePractice >= 70 && $centTruePractice < 80){
						$flower = 2;
					}elseif($centTruePractice >= 80){
						$flower = 3;
					}
				}
				
				//phan de thi, de luyen tap
				$apple = 0;
				if($item['totalTestPrQuestion'] > 0){
					$centTrueTestPr = floor($item['trueTestPrQuestion']*100 / $item['totalTestPrQuestion']);
					if($centTrueTestPr >= 50 && $centTrueTestPr < 70){
						$apple = 1;
					}elseif($centTrueTestPr >= 70 && $centTrueTestPr < 80){
						$apple = 2;
					}elseif($centTrueTestPr >= 80){
						$apple = 3;
					}
				}
				
				if($item['totalTestQuestion'] > 0){
					$centTrueTest = floor($item['trueTestQuestion']*100 / $item['totalTestQuestion']);
					if($centTrueTest >= 50 && $centTrueTest < 70){
						$apple = $apple + 1;
					}elseif($centTrueTest >= 70 && $centTrueTest < 80){
						$apple = $apple + 2;
					}elseif($centTrueTest >= 80){
						$apple = $apple + 3;
					}
				}
				
				$dataUpdate = array(
					'tree' => $tree,
					'flower' => $flower,
					'apple' => $apple
				);
				_db()->update('achievement')->set($dataUpdate)->whereId($item['id'])->result();
				
			}	
		}		
			
	}
	
	public function checkTranslatedAction() {
		set_time_limit(0);
		$questions = _db()->selectAll()->fromQuestions()->result();
		$all_question_answers = _db()->selectAll()->fromAnswers_question_tn()->result();
		$question_answers_by_ids = array();
		$translatedIds = array();
		foreach($all_question_answers as $answer) {
			if(!isset($question_answers_by_ids[$answer['question_id']])) {
				$question_answers_by_ids[$answer['question_id']] = array();
			}
			$question_answers_by_ids[$answer['question_id']][] = $answer;
		}
		foreach($questions as $question) {
			$question_answers = @$question_answers_by_ids[$question['id']];
			if($total_answers = count($question_answers)) {
				$total_translated = 0;
				foreach($question_answers as $answer) {
					if($answer['content_vn']) {
						$total_translated++;
					}
				}
				if($total_translated == $total_answers) {
					// question translated 
					$translatedIds[]	= 	$question['id'];
					
				}
			}
			
		}
		
		$updation = _db()->unlock()->updateQuestions()->set(array('translated' => 1))
						->where('in', 'id', $translatedIds);
		$updation->result();
	}
	
	public function checkHasAudioAction() {
		set_time_limit(0);
		$questions = _db()->selectAll()->fromQuestions()->result();
		
		$hasAudioIds 	= array();
		$hasNotAudioIds = array();
		foreach($questions as $question) {
			$hasAudio = false;
			if(file_exists(BASE_DIR . '/3rdparty/Filemanager/source/practice/all/' . $question['id'] . '.mp3')) {
				$hasAudio = true;
			}
			
			if($hasAudio) {
				// question translated 
				
				$hasAudioIds[]		= $question['id'];
			} else {
				
				$hasNotAudioIds[] 	= $question['id'];
			}
		}
		
		// has audio
		$updation = _db()->unlock()->updateQuestions()->set(array('hasAudio' => 1))
					->where(array('in', 'id', $hasAudioIds));
		$updation->result();
		
		// has not audio
		$updation = _db()->unlock()->updateQuestions()->set(array('hasAudio' => 0))
					->where(array('in', 'id', $hasNotAudioIds));
		$updation->result();
	}
	
	public function checkHasImageAction() {
		set_time_limit(0);
		$questions = _db()->selectAll()->fromQuestions()->result();
		$all_question_answers = _db()->selectAll()->fromAnswers_question_tn()->result();
		$question_answers_by_ids = array();
		foreach($all_question_answers as $answer) {
			if(!isset($question_answers_by_ids[$answer['question_id']])) {
				$question_answers_by_ids[$answer['question_id']] = array();
			}
			$question_answers_by_ids[$answer['question_id']][] = $answer;
		}
		$hasImageIds 	= array();
		$hasNotImageIds = array();
		foreach($questions as $question) {
			$hasImage = false;
			if($question['name'] && strpos($question['name'], 'img') !== false) {
				$hasImage = true;
			}
			$question_answers = @$question_answers_by_ids[$question['id']];
			foreach($question_answers as $answer) {
				if($answer['content'] && strpos($answer['content'], 'img') !== false) {
					$hasImage = true;
					break;
				}
			}
			
			if($hasImage) {
				// question translated 
				
				$hasImageIds[]		= $question['id'];
			} else {
				
				$hasNotImageIds 	= $question['id'];
			}
		}
		
		// has image
		$updation = _db()->unlock()->updateQuestions()->set(array('hasImage' => 1))
					->where(array('in', 'id', $hasImageIds));
		$updation->result();
		
		// has not image
		$updation = _db()->unlock()->updateQuestions()->set(array('hasImage' => 0))
					->where(array('in', 'id', $hasNotImageIds));
		$updation->result();
		
	}
	
	public function updateAgainAchievementAction() {
		$data = _db()->select('id, userId')
				->from('achievement')
				->result();
		foreach($data as $item) {
			$dataUser = _db()->select('username, name')
				->from('user')
				->where(array('id' => $item['userId']))
				->result_one();
				$dataUpdate = array(
					'username' => $dataUser['username'],
					'name' => $dataUser['name']
				);
			_db()->update('achievement')->set($dataUpdate)->whereId($item['id'])->result();
		}		
		echo 'done';
	}
	
	public function fixParentsAction() {
		$this->_fixParents(0);
	}
	
	public function _fixParents($parent) {
		echo $parent .'<br />';
		if($parent == 0) {
			_db()->query("update categories set parents = concat(',', id, ',') where parent=0");
			$parents = _db()->select('id')->fromCategories()->whereParent('0')->result();
			foreach($parents as $parentCat) {
				$this->_fixParents($parentCat['id']);
			}
		} else {
			$parentCategory = _db()->selectAll()->fromCategories()->whereId($parent)->result_one();
			if($parentCategory) {
				$parentsStr = $parentCategory['parents'];
				_db()->query("update categories set parents = concat('$parentsStr', id, ',') where parent=$parent");
				$parents = _db()->select('id')->fromCategories()->whereParent($parent)->result();
				foreach($parents as $parentCat) {
					$this->_fixParents($parentCat['id']);
				}
			}
		}
	}
	
	public function syncEnglishAction() {
		$categories = _db()->selectAll()->fromCategories()->likeParents('%,164,%')->result();
		foreach($categories as $cat) {
			_db()->query("update questions set name_vn = name where name_vn='' and categoryIds like '%,".$cat['id'].",%'");
			_db()->query("update answers_question_tn set content_vn = content where content_vn='' and question_id in (select id from questions where categoryIds like '%,".$cat['id'].",%')");	
		}
		
	}
	
	public function exportAction() {
		$areacode = _db()->selectAll()->fromAreacode()->whereParent(0)->result();
		file_put_contents(BASE_DIR . '/default/skin/areacode.json', json_encode($areacode));
	}
	
	public function hideaudioAction() {
		echo BASE_DIR.'/anloa.txt' . '<br />';
		$lines = file(BASE_DIR.'/anloa.txt');
		debug($lines);
		foreach($lines as $line) {
			$line	=	trim($line);
			if(file_exists($file = BASE_DIR . '/3rdparty/Filemanager/source/practice/all/' . $line . '.mp3')) {
				echo 'An loa file ' . $file . '<br />';
				rename($file, $file.'.bak');
			} else {
				echo 'file ' . $file . ' khong ton tai<br />';
			}
		}
	}
	
	public function updateExercisesAction() {
		echo 'update exercises for categories';
	}
}