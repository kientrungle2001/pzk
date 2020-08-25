<?php 
		$camp = $data->getCamp();
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
		
	?>
	<div class='container robotofont'>
		<h3 class="text-center"> Đề thi thử đợt <?php echo $camp; ?>  </h3>
		
	
	<p class="t-weight text-center btn-custom8 textcl">Đề thi thử dạng trắc nghiệm vào lớp 6 Trần Đại Nghĩa</p>
	
	<div class='well'>
		<div class='text-center'>
			
			<span>(Mỗi câu trả lời đúng bạn được 2 điểm)</span>
		</div>
	</div>
	
	<div class="item">
		
			<div class="item bd-div bgclor form_search_test top10 bot20">
						
				<?php 
					$i	= 1;
					$page	= 1;
					$numpage	= numPage(count($showQuestions));
					
					
					
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
								
								$QuestionObj->setUserAnswer(false);
								
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
	$showQuestionTl = $data->getShowQuestionTl();
	//debug($dataUserAnswers);
	if($showQuestionTl) {
?>
<div class='container robotofont'>
	<p class="t-weight text-center btn-custom8 textcl">Đề thi thử dạng tự luận vào lớp 6 Trần Đại Nghĩa</p>
		<div class='well'>
			<div class='text-center'>
				
				<span>(Mỗi bài đúng bạn được 4 điểm)</span>
			</div>
		</div>
		<div class="item bd-div bgclor form_search_test top10 bot20">
		
  
			<?php foreach($showQuestionTl as $key =>$value):?>
				<?php
				$BookObj = pzk_obj_once('Education.Userbook.Type.Trytesttl');
				$BookObj->set ('id', false);
				$BookObj->set ('questionId', $value['id']);
				
				$BookObj->setContent($value['teacher_answers'] );
				$BookObj->setShowTeacher(1);
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






