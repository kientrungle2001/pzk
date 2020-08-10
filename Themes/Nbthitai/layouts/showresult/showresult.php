<?php 
		
		$testId = $data->get('testId');
		switch ($testId) {
			case 95:
				$testName = 'toán lớp 3 lên 4';
				break;
			case 94:
				$testName = 'toán lớp 4 lên 5';
				break;
			case 93:
				$testName = 'toán lớp 2 lên 3';
				break;
			case 92:
				$testName = 'tiếng việt lớp 3 lên 4';
				break;
			case 91:
				$testName = 'tiếng việt lớp 4 lên 5';
				break;
			default:
				$testName = '';
		}
		
		$scoreTn = $data->get('scoretn');
		if($scoreTn > 0) {
			$scoreTn = $scoreTn;
		}else{
			$scoreTn = 0;
		}
		
		$showQuestions 	= $data->get('showQuestionTn');
		
		if(count($showQuestions) > 0) { 
		$totalQuestion = count($showQuestions);
		// xu li questions
		$arrQuestionIds = array();
		
		foreach($showQuestions as $question) {
			$arrQuestionIds[] = $question['id'];
		}
		//xu li cau tra loi
		$answers = _db()->useCache(1800)
			->selectAll()
			->from('answers_question_tn')
			->where(array('in', 'question_id', $arrQuestionIds))
			->result();
		$processAnswer = array();
		foreach($answers as $val) {
			$processAnswer[$val['question_id']][] = $val;
		}	
		
		
		
		$userInfo = $data->get('userInfo');
		$userBookIdTn = $data->get('userBookIdTn');	
		
		
	?>
	<div class='container robotofont'>
		<h3 class="text-center"> Thông tin chi tiết của thí sinh </h3>
		<div class='well'>
			<div class='row'>
				<div class='col-md-3 col-xs-12'>Họ và tên: <?php echo @$userInfo['name']?></div>
				<div class='col-md-3 col-xs-12'>Username: <?php echo @$userInfo['username']?></div>
				<div class='col-md-3 col-xs-12'>Email: <?php echo @$userInfo['email']?></div>
				<div class='col-md-3 col-xs-12'>Phone: <?php echo @$userInfo['phone']?></div>
			</div>
			<div class='text-center box-score'>
				<b>Số câu đúng: </b> <b style='color:red;font-size: 18px;'><?php echo $scoreTn.' / '.$totalQuestion; ?> </b> </br>
				<span style='color: red; font-weight:bold;'>( <?php $rate = $data->get('rate'); echo 'Xếp hạng: '.implode('/', $rate); ?> )</span>
			</div>
		</div>

	<div class="row t-weight text-center btn-custom8 textcl">
       Kết quả bài thi  <?php echo $testName; ?>
    </div> 
	
	
	<div class="item">
		
			<div class="item bd-div bgclor form_search_test top10 bot20">
						
				<?php 
					$i	= 1;
					$page	= 1;
					$numpage	= numPage(count($showQuestions));
					
					$user_answers = _db()->select('*')
					->from('user_answers')
					->where(array('user_book_id', $userBookIdTn));
					
					$user_answers = $user_answers->result();
					
					$user_answers_by_question_id = array();
					foreach($user_answers as $user_answer) {
						$user_answers_by_question_id[$user_answer['questionId']] = $user_answer['content'];
					}
					
				?>
				
				<fieldset id="idFieldset">  <!-- disabled="1"  -->
				<?php foreach($showQuestions as $key =>$value):?>
					<div class="row step_ answer_box question_page_<?php echo $page?> top20 left20">
						<?php $i++; $page=ceil($i/30);?>
						
							<div class="order col-md-12">Câu : <?=$key+1;?></div>
							<div class="col-md-12 top10">
							
							<?php
								//goi object
								$QuestionObj = pzk_obj_once('Education.Userbook.Type.Trytesttn');
								$QuestionObj->set('questionId', $value['id']);
								
								$questionChoice = _db()->getEntity('Question.Choice');
								$questionChoice->setData($value);
								
								$QuestionObj->set('question', $questionChoice);
								$QuestionObj->set('type', $questionChoice->get('type'));
								$QuestionObj->set('userBookIdTn', $userBookIdTn);
								//user answer
								$QuestionObj->set('userAnswer', $user_answers_by_question_id[$value['id']]);
								
								//answer
								$answerEntitys = array();
								foreach($processAnswer[$value['id']] as $val) {
										$answerEntity = _db()->getEntity('Question.Choice.Answer');
										$answerEntity->setData($val);
										$answerEntitys[] = $answerEntity;
								}
								$QuestionObj->set('answers', $answerEntitys);
								
								$QuestionObj->set('cacheable', 'false');
								$QuestionObj->set('cacheParams', 'layout, questionId');
								$QuestionObj->display();
							?>
							</div>
					</div>
				<?php endforeach;?>
				</fieldset>
					
				
			</div>
			
		
	</div>


	</div>

<?php } ?>