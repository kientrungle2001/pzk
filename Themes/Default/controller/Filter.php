<?php
define('QUESTION_FILTER_TYPE_HAS_TRANSLATE_AND_EXPLAINATION', 'has_translate_and_explaination');
define('QUESTION_FILTER_TYPE_HAS_TRANSLATE_IN_SECOND_LINE', 'has_translate_in_second_line');
define('QUESTION_FILTER_TYPE_HAS_TRANSLATE_AND_ANSWER_TRANSLATE', 'has_translate_and_answer_translate');
define('QUESTION_FILTER_TYPE_HAS_TRANSLATE_ON_FIRST_LINE', 'has_translate_on_first_line');
define('QUESTION_FILTER_TYPE_HAS_TRANSLATE_AND_EXPLAINATION_ON_FIRST_LINE', 'has_translate_and_explaination_on_first_line');
class PzkFilterController extends PzkController{
	public function translateAction() {
		$answers = _db()->selectAll()->fromAnswers_question_tn()->whereStatus(1);
		echo $answers->getQuery() . '<br />';
		$answers = $answers->result();
		$sql = '';
		foreach($answers as $answer) {
			$answerDetector = new PzkAnswerDetector($answer);
			$answerDetector->run();
			$type = $answerDetector->type;
			$updateQuery = $answerDetector->getUpdateQuery();
			
			continue;
			if($answer['recommend']) {
				$type = $this->getTypeOfRecommend($answer['recommend']);
				
				$lines = explodetrim('<br />', $answer['recommend']);
				$index = 0;
				$count = count($lines);
				while(($index < $count) && (!@$lines[$index] || (preg_match('/:/', strip_tags($lines[$index])) && count(explode(' ', strip_tags($lines[$index]))) < 5))) {
					$index++;
				}
				
				
				if(1 && $type == QUESTION_FILTER_TYPE_HAS_TRANSLATE_ON_FIRST_LINE) {
					continue;
					echo '#' . $answer['question_id'] . '<br />';
					echo $type . '<br />';
					echo '------RECOMMEND------<br />';
					echo $answer['recommend'] . '<br />';
					if($index < $count) {
						echo '------FIRST LINE------<br />';
						echo strip_tags($lines[$index]) . '<br />';
						echo '---------------------------------<br />';
					}
					$updation = _db()->update('questions')->set(array('translation' => strip_tags(@$lines[$index])))->whereId($answer['question_id']);
					$sql .= $updation->getQuery() . ';' . "\r\n";
				} elseif($type == QUESTION_FILTER_TYPE_HAS_TRANSLATE_AND_ANSWER_TRANSLATE){
					//continue;
					echo '#' . $answer['question_id'] . '<br />';
					echo $type . '<br />';
					echo '------RECOMMEND------<br />';
					echo $answer['recommend'] . '<br />';
					$translation = '';
					while($index < $count) {
						$line = trim($lines[$index]);
						$secondLine = trim(@$lines[$index+1]);
						if(@$line[0] == 'A' && @$secondLine[0] == 'B') {
							break;
						}
						
						$translation.= $lines[$index] . '<br />';
						$index++;
					}
					$answerTranslation = '';
					while($index < $count) {
						$line = trim($lines[$index]);
						if(@$line[0] !== 'A' && @$line[0] !== 'B' && @$line[0] !== 'C' && @$line[0] !== 'D' && @$line[0] !== 'E') {
							break;
						}
						$answerTranslation .= $line . '<br />';
						$index++;
					}
					echo '------TITLE TRANSLATION------<br />';
					echo $translation;
					echo '------ANSWER TRANSLATION------<br />';
					echo $answerTranslation;
					echo '---------------------------------<br />';
					$updation = _db()->update('questions')->set(array('translation' => strip_tags($translation), 'answerTranslation' => $answerTranslation))->whereId($answer['question_id']);
					$sql .= $updation->getQuery() . ';' . "\r\n";
					
				}
			}
			
		}
		file_put_contents(BASE_DIR . '/update_translation_and_answers.sql', $sql);
	}
	
	public function paymentAction() {
		$payments = _db()->select('history_payment.id, history_payment.username, user.name, user.email, user.phone, history_payment.paymentDate, history_payment.amount, history_payment.paymentType, history_payment.status')->fromHistory_payment()->join('user', 'history_payment.username = user.username', 'inner')->wherePaymentstatus(1)->result();
		$index = 1;
		$output = '<table border="1">';
		$output .= '<tr>';
		$output.= '<th>Index</th>';
		$output.= '<th>ID</th>';
		$output.= '<th>Username</th>';
		$output.= '<th>Name</th>';
		$output.= '<th>Email</th>';
		$output.= '<th>Phone</th>';
		$output.= '<th>Date</th>';
		$output.= '<th>Amount</th>';
		$output.= '<th>Formatted Amount</th>';
		$output.= '<th>Type</th>';
		$output.= '<th>Status</th>';
		$output .= '</tr>';
		foreach($payments as $payment) {
			$output .= '<tr>';
				$output.= '<td>' . ($index++) . '</td>';
				$output.= '<td>' . $payment['id'] . '</td>';
				$output.= '<td>' . $payment['username'] . '</td>';
				$output.= '<td>' . $payment['name'] . '</td>';
				$output.= '<td>' . $payment['email'] . '</td>';
				$output.= '<td>' . $payment['phone'] . '</td>';
				$output.= '<td>' . date('Y/m/d', strtotime($payment['paymentDate'])) . '</td>';
				$output.= '<td>' . $payment['amount'] . '</td>';
				$output.= '<td>' . product_price($payment['amount']) . '</td>';
				$output.= '<td>' . $payment['paymentType'] . '</td>';
				$output.= '<td>' . $this->getStatusName($payment['status']) . '</td>';
			$output .= '</tr>';
		}
		$output .= '</table>';
		echo $output;
	}
	
	public function getStatusName($status) {
		if($status == '1') {
			return 'Đang kích hoạt';
		} else if($status == '2') {
			return 'Thành công';
		} else if($status == '0') {
			return 'Chưa kích hoạt';
		} else {
			return $status;
		}
	}
	
	public function getTypeOfRecommend($recommend) {
		$lines = explodetrim('<br />', $recommend);
		$index = 0;
		$count = count($lines);
		while(($index < $count) && (!@$lines[$index] || (preg_match('/:[\s]*$/', $lines[$index]) && count(explode(' ', $lines[$index])) < 5))) {
			$index++;
		}
		
		if((preg_match('/[Aa1][\s]*[\.]/', $recommend) && preg_match('/[Bb2][\s]*[\.]/', $recommend) && preg_match('/[Cc3][\s]*[\.]/', $recommend))
			|| (preg_match('/[Aa][\s]*[\.\)]/', $recommend) && preg_match('/[Bb][\s]*[\.\)]/', $recommend) && preg_match('/[Cc][\s]*[\.\)]/', $recommend))
		) {
			return QUESTION_FILTER_TYPE_HAS_TRANSLATE_AND_ANSWER_TRANSLATE;
		} else {
			if($index < $count) {			
				if(preg_match('/[Dd]ịch[\s]*:/', $lines[$index])) {
					if(preg_match('/[Ll][íý] giải[\s]*:/', $lines[$index])) {
						return QUESTION_FILTER_TYPE_HAS_TRANSLATE_AND_EXPLAINATION_ON_FIRST_LINE;
					}
					if(@$lines[$index+1][0] == 'A' && @$lines[$index+2][0] == 'B' && @$lines[$index+3][0] == 'C') {
						return QUESTION_FILTER_TYPE_HAS_TRANSLATE_AND_ANSWER_TRANSLATE;
					}
					return QUESTION_FILTER_TYPE_HAS_TRANSLATE_ON_FIRST_LINE;
				}
			}
		}
		
		return QUESTION_FILTER_TYPE_HAS_TRANSLATE_AND_EXPLAINATION;
	}
	
	public function answerAction() {
		file_put_contents(BASE_DIR . '/update_answers_question_tn_translation.sql', '');
		$questions = _db()->selectAll()->fromQuestions()->result();
		$all_question_answers = _db()->selectAll()->fromAnswers_question_tn()->result();
		$question_answers_by_ids = array();
		foreach($all_question_answers as $answer) {
			if(!isset($question_answers_by_ids[$answer['question_id']])) {
				$question_answers_by_ids[$answer['question_id']] = array();
			}
			$question_answers_by_ids[$answer['question_id']][] = $answer;
		}
		foreach($questions as $question) {
			$answerTranslation = @$question['answerTranslation'];
			$translation_answers = $this->parseAnswerTranslation($answerTranslation);
			$question_answers = @$question_answers_by_ids[$question['id']];
			$this->matchAnswerTranslation($question_answers, $translation_answers, '/update_answers_question_tn_translation.sql');
		}
	}
	
	public function translatedAction() {
		file_put_contents(BASE_DIR . '/update_questions_translated.sql', '');
		$questions = _db()->selectAll()->fromQuestions()->result();
		$all_question_answers = _db()->selectAll()->fromAnswers_question_tn()->result();
		$question_answers_by_ids = array();
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
					if($answer['translation']) {
						$total_translated++;
					}
				}
				if($total_translated == $total_answers) {
					// question translated 
					$updation = _db()->updateQuestions()->set(array('translated' => 1))
						->whereId($question['id']);
					$query = $updation->getQuery();
					file_put_contents(BASE_DIR . '/update_questions_translated.sql', $query . ";\r\n", FILE_APPEND);
				}
			}
			
		}
	}
	
	public function answerbylineAction() {
		file_put_contents(BASE_DIR . '/update_answers_question_tn_translation_line.sql', '');
		$questions = _db()->selectAll()->fromQuestions()->result();
		$all_question_answers = _db()->selectAll()->fromAnswers_question_tn()->result();
		$question_answers_by_ids = array();
		foreach($all_question_answers as $answer) {
			if(!isset($question_answers_by_ids[$answer['question_id']])) {
				$question_answers_by_ids[$answer['question_id']] = array();
			}
			$question_answers_by_ids[$answer['question_id']][] = $answer;
		}
		foreach($questions as $question) {
			$answerTranslation = @$question['answerTranslation'];
			$translation_answers = $this->parseAnswerTranslationByLine($answerTranslation);
			$question_answers = @$question_answers_by_ids[$question['id']];
			$this->matchAnswerTranslation($question_answers, $translation_answers, '/update_answers_question_tn_translation_line.sql');
		}
	}
	public function parseAnswerTranslationByLine($answerTranslation) {
		if($answerTranslation = trim($answerTranslation)) {
			if(strpos($answerTranslation, '<ul') === false && strpos($answerTranslation, '<ol') === false) {
				$answers = array();
				$lines = explodetrim('<br />', $answerTranslation);
				foreach($lines as $line) {
					if($line = trim($line)) {
						$line = preg_replace('/^[A-Za-z][\s]*\.[\s]*/', '', $line);
						$answers[] = $line;
					}
				}
				return $answers;
			}
		}
		return null;
	}
	public function parseAnswerTranslation($answerTranslation) {
		
		if(strpos($answerTranslation, '<ul') !== false || strpos($answerTranslation, '<ol') !== false) {
			//echo $answerTranslation . '<br />';
			$answerTranslation = str_replace('<li>', '~', $answerTranslation);
			$answerTranslation = str_replace('</li>', '~', $answerTranslation);
			preg_match_all('/\~([^~]*)\~/', $answerTranslation, $match);
			return ($match[1]);
		}
		return null;
	}
	
	public function matchAnswerTranslation($question_answers, $translation_answers, $filename) {
		if($question_answers && $translation_answers) {
			if(count($question_answers) == count($translation_answers)) {
				foreach($question_answers as $index => $answer) {
					$updation = _db()->update('answers_question_tn')->set(array('translation' => $translation_answers[$index]))->whereId($answer['id']);
					$query = $updation->getQuery() . ';';
					file_put_contents(BASE_DIR . $filename, $query . "\r\n", FILE_APPEND);
				}
			}
			
		}
		//debug($question_answers);
	}
	
	public function testentityAction() {
		$test = _db()->getEntity('Education.Test');
		$test->load(58);
		$test->deliverAnswersToQuestions();
		$questions = $test->getQuestions();
		foreach($questions as $question) {
			$answers = $question->getAnswers();
			echo '<h2>'.$question->get('name') . '</h2><br />';
			foreach($answers as $answer) {
				echo $answer->getContent() . '<br />';
			}
			echo '<hr />';
		}
	}
	
	public function redisAction() {
		$cacher = pzk_rediscache();
		if($somekey = $cacher->get('somekey')) {
			echo $somekey;
			$cacher->clear();
		} else {
			$cacher->set('somekey', 'Không thấy được');
		}
	}
	
	public function memcacheAction() {
		$cacher = pzk_memcache();
		if($somekey = $cacher->get('somekey')) {
			echo $somekey;
			$cacher->clear();
		} else {
			$cacher->set('somekey', 'Không thấy được');
		}
	}
	
	public function multiUpdateAction() {
		$db = _db();
		$db->multiUpdate('news')->setField('views', true);
		$db->addToUpdate(1, 1)->addToUpdate(2, 4);
		$query = $db->getQuery();
		echo $query;
	}
	
	public function getFieldsAction() {
		$db = _db();
		$fields = $db->getFields('user_book');
		debug($fields);
	}
	
	public function searchAction() {
		$tables = array(
			/*'admin_log',*/
			'answers_question_tn',
			'categories',
			'document',
			'game',
			'news',
			'questions'
		);
		$total = 0;
		echo '<table border="1">';
		echo '<tr>
			<td>Bảng</td>
			<td>Câu hỏi</td>
			<td>ID</td>
			<td>Trường</td>
			<td>Lỗi</td>
		</tr>';
		foreach($tables as $table) {
			
			$rows = _db()->selectAll()->from($table)->result();
			foreach($rows as $row) {
				foreach($row as $field => $value) {
					$content = $value;
					if(preg_match_all('/src="[^"]+"/', $value, $matches)) {
						
						$srcs = $matches[0];
						$found = false;
						
						foreach($srcs as $index => $src) {
							if(mb_detect_encoding(rawurldecode( $src )) === 'UTF-8'){
								$found = true;
								echo '<tr data-id="'.$row['id'].'" data-table="'.$table.'" data-field="'.$field.'">';
								if($table == 'answers_question_tn') {
									echo '<td>'.$table.'</td><td>'.$row['question_id'].'</td><td>'.$row['id'].'</td><td>'.$field.'</td>';
								} else {
									echo '<td>'.$table.'</td><td>&nbsp;</td><td>'.$row['id'].'</td><td>'.$field.'</td>';
								}
								echo '<td><a href="#" onclick="editRow(\''.$table.'\', \''.$field.'\', \''.$row['id'].'\','.$index.');return false;">Edit</a>|<a href="#" onclick="updateRow(\''.$table.'\', \''.$field.'\', \''.$row['id'].'\','.$index.');return false;">Update</a>: <span id="src-editing-'.$table.'-'.$field.'-'.$row['id'].'-'. $index.'">'. rawurldecode( $src ). '</span></td>';
								echo '</tr>';
								echo '<tr><td colspan="5">'.str_replace(' ', '%20',bodau_giucach(rawurldecode( $src ))).'</td></tr>';
								$total++;
								$content = str_replace($src,str_replace(' ', '%20',bodau_giucach(rawurldecode( $src ))),$content);
								file_put_contents(BASE_DIR . '/srcs.txt', $src."\r\n", FILE_APPEND);
								file_put_contents(BASE_DIR . '/srcs.txt', rawurldecode($src)."\r\n", FILE_APPEND);
							}
						}
						if($found) {
							_db()->update($table)->set(array($field=>$content))->whereId($row['id'])->result();
						}
					}
				}
			}
		}
		echo '</table>
		<script>
		function editRow(table, field, id, index, src) {
			var elem = document.getElementById(\'src-editing-\'+table+\'-\'+field+\'-\'+id+\'-\'+index);
			var inputUser = prompt(\'Sửa lại nội dung\',elem.textContent);
			elem.textContent = inputUser;
		}
		function updateRow(table, field, id, index, src) {
			var elem = document.getElementById(\'src-editing-\'+table+\'-\'+field+\'-\'+id+\'-\'+index);
			console.log(elem.textContent);
		}
		</script>
		';
		echo 'Tổng số src: ' . $total . '<br />';
		
		if(1){
		$files = glob(BASE_DIR . '/3rdparty/Filemanager/source/*');
		foreach($files as $file) {
			if(mb_detect_encoding($file) === 'UTF-8')
				echo $file  . '<br />';
		}
		$files = glob(BASE_DIR . '/3rdparty/Filemanager/source/*/*');
		foreach($files as $file) {
			if(mb_detect_encoding($file) === 'UTF-8')
				echo $file  . '<br />';
		}
		$files = glob(BASE_DIR . '/3rdparty/Filemanager/source/*/*/*');
		foreach($files as $file) {
			if(mb_detect_encoding($file) === 'UTF-8')
				echo $file  . '<br />';
		}
		$files = glob(BASE_DIR . '/3rdparty/Filemanager/source/*/*/*/*');
		foreach($files as $file) {
			if(mb_detect_encoding($file) === 'UTF-8')
				echo $file  . '<br />';
		}
		$files = glob(BASE_DIR . '/3rdparty/Filemanager/source/*/*/*/*/*');
		foreach($files as $file) {
			if(mb_detect_encoding($file) === 'UTF-8')
				echo $file  . '<br />';
		}
		$files = glob(BASE_DIR . '/3rdparty/Filemanager/source/*/*/*/*/*/*');
		foreach($files as $file) {
			if(mb_detect_encoding($file) === 'UTF-8')
				echo $file  . '<br />';
		}
		$files = glob(BASE_DIR . '/3rdparty/Filemanager/source/*/*/*/*/*/*/*');
		foreach($files as $file) {
			if(mb_detect_encoding($file) === 'UTF-8')
				echo $file  . '<br />';
		}
		$files = glob(BASE_DIR . '/3rdparty/Filemanager/source/*/*/*/*/*/*/*/*');
		foreach($files as $file) {
			if(mb_detect_encoding($file) === 'UTF-8')
				echo $file  . '<br />';
		}
		$files = glob(BASE_DIR . '/3rdparty/Filemanager/source/*/*/*/*/*/*/*/*/*');
		foreach($files as $file) {
			if(mb_detect_encoding($file) === 'UTF-8')
				echo $file  . '<br />';
		}
		$files = glob(BASE_DIR . '/3rdparty/Filemanager/source/*/*/*/*/*/*/*/*/*/*');
		foreach($files as $file) {
			if(mb_detect_encoding($file) === 'UTF-8')
				echo $file  . '<br />';
		}
		$files = glob(BASE_DIR . '/3rdparty/Filemanager/source/*/*/*/*/*/*/*/*/*/*/*');
		foreach($files as $file) {
			if(mb_detect_encoding($file) === 'UTF-8')
				echo $file  . '<br />';
		}
		$files = glob(BASE_DIR . '/3rdparty/Filemanager/source/*/*/*/*/*/*/*/*/*/*/*/*');
		foreach($files as $file) {
			if(mb_detect_encoding($file) === 'UTF-8')
				echo $file  . '<br />';
		}
		$files = glob(BASE_DIR . '/3rdparty/Filemanager/source/*/*/*/*/*/*/*/*/*/*/*/*/*');
		foreach($files as $file) {
			if(mb_detect_encoding($file) === 'UTF-8')
				echo $file  . '<br />';
		}
		$files = glob(BASE_DIR . '/3rdparty/Filemanager/source/*/*/*/*/*/*/*/*/*/*/*/*/*/*');
		foreach($files as $file) {
			if(mb_detect_encoding($file) === 'UTF-8')
				echo $file  . '<br />';
		}
		$files = glob(BASE_DIR . '/3rdparty/Filemanager/source/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*');
		foreach($files as $file) {
			if(mb_detect_encoding($file) === 'UTF-8')
				echo $file  . '<br />';
		}
		$files = glob(BASE_DIR . '/3rdparty/Filemanager/source/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*');
		foreach($files as $file) {
			if(mb_detect_encoding($file) === 'UTF-8')
				echo $file  . '<br />';
		}
		$files = glob(BASE_DIR . '/3rdparty/Filemanager/source/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*');
		foreach($files as $file) {
			if(mb_detect_encoding($file) === 'UTF-8')
				echo $file  . '<br />';
		}
		}
	}
}

class PzkAnswerDetector {
	public $answer;
	public $lines;
	public $index;
	public $line;
	public $type;
	public function __construct($answer) {
		$this->answer = $answer;
	}
	public function run() {
		$this->trimEmptyLines();
		$this->type = $this->getType();
		if($this->type == QUESTION_FILTER_TYPE_HAS_TRANSLATE_ON_FIRST_LINE) {
			$this->importQuestionHasTranslateOnFirstLine();
		}
	}
	
	public function trimEmptyLines() {
		$this->lines = explodetrim('<br />', $this->answer['recommend']);
		$this->index = 0;
		$count = count($this->lines);
		while(($this->index < $count) && (!@$this->lines[$this->index] || (preg_match('/:/', strip_tags($this->lines[$this->index])) && count(explode(' ', strip_tags($this->lines[$this->index]))) < 5))) {
			$this->index++;
		}
	}
	
	public function getType() {
		$count = count($this->lines);
		$recommend = $this->answer['recommend'];
		if((preg_match('/[Aa1][\s]*[\.]/', $recommend) && preg_match('/[Bb2][\s]*[\.]/', $recommend) && preg_match('/[Cc3][\s]*[\.]/', $recommend))
			|| (preg_match('/[Aa][\s]*[\.\)]/', $recommend) && preg_match('/[Bb][\s]*[\.\)]/', $recommend) && preg_match('/[Cc][\s]*[\.\)]/', $recommend))
		) {
			return QUESTION_FILTER_TYPE_HAS_TRANSLATE_AND_ANSWER_TRANSLATE;
		} else {
			if($this->index < $count) {			
				if(preg_match('/[Dd]ịch[\s]*:/', $this->lines[$this->index])) {
					if(preg_match('/[Ll][íý] giải[\s]*:/', $this->lines[$this->index])) {
						return QUESTION_FILTER_TYPE_HAS_TRANSLATE_AND_EXPLAINATION_ON_FIRST_LINE;
					}
					if(@$this->lines[$this->index+1][0] == 'A' && @$this->lines[$this->index+2][0] == 'B' && @$this->lines[$this->index+3][0] == 'C') {
						return QUESTION_FILTER_TYPE_HAS_TRANSLATE_AND_ANSWER_TRANSLATE;
					}
					return QUESTION_FILTER_TYPE_HAS_TRANSLATE_ON_FIRST_LINE;
				}
			}
		}
		
		return QUESTION_FILTER_TYPE_HAS_TRANSLATE_AND_EXPLAINATION;
	}
	
	public function importQuestionHasTranslateOnFirstLine() {
		$count = count($this->lines);
		echo '#' . $this->answer['question_id'] . '<br />';
		echo $this->type . '<br />';
		echo '------RECOMMEND------<br />';
		echo $this->answer['recommend'] . '<br />';
		if($this->index < $count) {
			echo '------FIRST LINE------<br />';
			echo strip_tags($this->lines[$this->index]) . '<br />';
			echo '---------------------------------<br />';
		}
		$updation = _db()->update('questions')->set(array('translation' => strip_tags(@$this->lines[$this->index])))->whereId($this->answer['question_id']);
		$this->sql = $updation->getQuery() . ';' . "\r\n";
	}
	
	public function getUpdateQuery() {
		return $this->sql;
	}
	
	public function zeroAction() {
		$items = _db()->query("select id, user_book_id, mark, teacherMark from user_answers where user_book_id in (SELECT id FROM `user_book` WHERE `software` = '9' AND `camp` = '4' AND `testId` = '120' ORDER BY `id` DESC) and mark = 0 limit 0, 1000");
	}
	
}