<?php 
		$camp = $data->getCamp();
		$scoreTn = $data->getScoretn();
		$scoreTl = $data->getScoretl();
		$score = $scoreTn + $scoreTl;
		$showQuestions 	= $data->getShowQuestionTn();
		
		if(count($showQuestions) > 0) { 
		
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
		
		
		
		$userInfo = $data->getUserInfo();
		$userBookIdTn = $data->getUserBookIdTn();	
		
		
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
				<b>Điểm 2 bài thi của bạn: </b> <b style='color:red;font-size: 18px;'><?php echo $score;?> điểm</b> <br/>
				<span style='color: red; font-weight:bold;'>( <?php $rate = $data->getRate(); echo 'Xếp hạng: '.implode('/', $rate); ?> )</span>
			</div>
		</div>

	
	<p class="t-weight text-center btn-custom8 textcl">Đề thi thử dạng trắc nghiệm vào lớp 6 Trần Đại Nghĩa</p>
	
	<div class='well'>
		<div class='text-center'>
			<b>Điểm bài thi trắc nghiệm của bạn: </b> <b style='color:red;font-size: 18px;'><?php echo $scoreTn;?> điểm</b><br>
			<span>(Mỗi câu trả lời đúng bạn được 2 điểm)</span>
		</div>
	</div>
	
	<div class="item">
		
			<div class="item bd-div bgclor form_search_test top10 bot20">
						
				<?php 
					$i	= 1;
					$page	= 1;
					$numpage	= numPage(count($showQuestions));
					
					$user_answers = _db()->select('*')
					->useCache(1800)
					->useCacheKey('user_answer_ubid_'. $userBookIdTn)
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
								$QuestionObj->setQuestionId($value['id']);
								
								$questionChoice = _db()->getEntity('Question.Choice');
								$questionChoice->setData($value);
								
								$QuestionObj->setQuestion($questionChoice);
								$QuestionObj->setType($questionChoice->getType());
								$QuestionObj->setUserBookIdTn($userBookIdTn);
								//user answer
								$QuestionObj->setUserAnswer($user_answers_by_question_id[$value['id']]);
								
								//answer
								$answerEntitys = array();
								foreach($processAnswer[$value['id']] as $val) {
										$answerEntity = _db()->getEntity('Question.Choice.Answer');
										$answerEntity->setData($val);
										$answerEntitys[] = $answerEntity;
								}
								$QuestionObj->setAnswers($answerEntitys);
								
								$QuestionObj->setCacheable('false');
								$QuestionObj->setCacheParams('layout, questionId');
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


<?php 
	//bai tu luan
	$dataUserAnswers = $data->getDataUserAnswers();
	if($dataUserAnswers) {
?>
<div class='container robotofont'>
	<p class="t-weight text-center btn-custom8 textcl">Đề thi thử dạng tự luận vào lớp 6 Trần Đại Nghĩa</p>
		<div class='well'>
			<div class='text-center'>
				<b>Điểm bài thi tự luận của bạn: </b> <b style='color:red;font-size: 18px;'><?php echo $scoreTl;?> điểm</b><br>
				<span>(Mỗi bài đúng bạn được 4 điểm)</span>
			</div>
		</div>
		<div class="item bd-div bgclor form_search_test top10 bot20">
		
  
			<?php foreach($dataUserAnswers as $key =>$value):?>
				<?php
				$BookObj = pzk_obj_once ( 'Education.Userbook.Type.Trytesttl' );
				$BookObj->set ('id', $value ['id'] );
				$BookObj->set ('questionId', $value ['questionId'] );
				$BookObj->set ('question_type', $value ['question_type'] );
				$BookObj->setUserAnswer($value);
				$BookObj->setContent($value['content'] );
				$BookObj->setMark($value['mark'] );
				$BookObj->setRecommend_mark($value['recommend_mark'] );
				$BookObj->setOrder($key + 1 );
				$BookObj->display ();
				?>
			<?php endforeach;?>
		</div>
	
</div>
<script>
	
$(document).ready(function() {
	setInputTinymceClient();
})
	

	
</script>
	<?php } ?>






