<?php 
		$camp = $data->get('camp');
		$showQuestions 	= $data->get('showQuestionTn');
		
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
	
	<div class='text-center'>
		(Đề thi gồm: 30 câu. Thời gian làm bài: 45 phút. Làm đúng mỗi câu được 2 điểm)
		
	</div>
	
		<div class="item bd-div bgclor form_search_test top10 bot20">
			<div class="col-xs-12 text-center form-group  top20">

				<span><b>Thời gian:</b> </span>
				
				<div id="countdown" class="num-time title-red">45:00</div>

			</div>
				
			<div class="col-xs-12 border-question" style="z-index: 9">
					<div class="col-xs-12 margin-top-20">
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
										$QuestionObj = pzk_obj_once('Education.Question.Type.Choice2');
										
										$questionChoice = _db()->getEntity('Question.Choice');
										$questionChoice->setData($value);
										
										$QuestionObj->set('question', $questionChoice);
										
										$QuestionObj->set('type', $questionChoice->get('type'));
										
										//answer
										$answerEntitys = array();
										foreach($processAnswer[$value['id']] as $val) {
											$answerEntity = _db()->getEntity('Question.Choice.Answer');
											$answerEntity->setData($val);
											$answerEntitys[] = $answerEntity;
										}
										$QuestionObj->set('answers', $answerEntitys);
										
										$QuestionObj->set('questionId', $value['id']);
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


	</div>

<?php } ?>


<?php 
	//bai tu luan
	$showQuestionTl = $data->get('showQuestionTl');
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
			<div class="col-xs-12 text-center form-group  top20">
			
				<span><b>Thời gian:</b> </span>
				<div id="countdown" class="num-time title-red">45:00</div>
				
				<div class='item red'>
					Học sinh điền câu trả lời vào các ô trống. Với bài điền ô chữ thì học sinh điền câu trả lời vào ô chữ.
				</div>
		
			</div>
				
			<div class="col-xs-12 border-question" style="z-index: 9">
					<div class="col-xs-12 margin-top-20">
						<?php 
							$i	= 1;
							$page	= 1;
							$numpage	= numPage(count($showQuestionTl));
						?>
						
						<fieldset id="idFieldset">  <!-- disabled="1"  -->
						<?php foreach($showQuestionTl as $key =>$value):?>
							<div class="row step_ answer_box question_page_<?php echo $page?> top20 left20">
								<?php $i++; $page=ceil($i/30);?>
								
									<div class="order col-md-12">Câu : <?=$key+1;?></div>
									<div class="col-md-12 top10">
									
									<?php 
										$QuestionObj = pzk_obj_once('Education.Question.Type.'.ucfirst(questionTypeOjb($value['questionType'])));
										
										$questionChoice = _db()->getEntity('Question.Choice');
										$questionChoice->setData($value);
										
										$QuestionObj->set('question', $questionChoice);
										
										$QuestionObj->set('type', $questionChoice->get('type'));
										
										$QuestionObj->set('questionId', $value['id']);
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
	
</div>
<script>
	
$(document).ready(function() {
	setInputTinymceClient();
})
	

	
</script>
	<?php } ?>






