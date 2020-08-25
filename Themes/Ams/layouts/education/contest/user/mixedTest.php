<?php $book = $data->getBook();
$answers = $book->getUserAnswers();
?>
<h2 class="text-left">Kết quả bài thi: {data.test[name]}</h2>
<h3 class="text-center">Kết quả</h3>
<div class="row">
	<div class="col-md-4">
		<table	class="table table-bordered">
		<tr>
			<th class="col-md-6"><div class="pull-right">Điểm</div></th>
			<td class="col-md-6"><?php echo $book->getTotalMark()?></td>
		</tr>
		<tr>
			<th class="col-md-6"><div class="pull-right">Thời gian làm bài</div></th>
			<td class="col-md-6">100</td>
		</tr>
	</table>
	</div>
	<div class="col-md-8">
		Lời phê
	</div>
</div>
<hr />
<h3 class="text-center">Bài làm</h3>
<?php foreach($answers as $index => $answer): ?>
	<?php $question = $answer->getQuestion(); ?>
	<span class="text text-primary">Câu hỏi <?php echo ($index + 1)?></span>: 
	<?php if($question->isTn()):?>
	<?php echo $question->getName_vn()?>
	<?php else:?>
	<?php  echo $question->mix($answer); ?>
	<?php endif;?>
	<br />
	<?php if($question->isTn()):
	$tn = $question->getTnQuestion();
	$questionAnswers = $tn->getQuestionAnswers();
	$answerId = $question->getAnswerId();
	$userAnswerTrue = false;
	if($answerId == $answer->getanswerId()) {
		$userAnswerTrue = true;
	}
	$answerTrue = null;
	?>
	<?php foreach($questionAnswers as $questionAnswer): ?>
		<input type="radio" name="questionAnswers[<?php echo $question->getId()?>][]" value="<?php echo $questionAnswer->getId()?>" <?php if($questionAnswer->getId() == $answer->getanswerId()): $answerTrue = $questionAnswer;?>checked<?php endif;?> disabled />
			<span <?php if($questionAnswer->getStatus()):?>class="bg-success"<?php endif;?>><?php echo $questionAnswer->getContent()?></span>
			<br />
	<?php endforeach; ?>
	<?php if($userAnswerTrue):?>
		<strong class="text text-success"> <span class="glyphicon glyphicon-ok"></span> Bạn đã làm đúng</strong>
	<?php else:?>
		<strong class="text text-danger"> <span class="glyphicon glyphicon-remove"></span> Bạn đã làm sai</strong>
	<?php endif;?>
	<br />
	<blockquote>
	<?php echo $question->getExplaination()?>
	<?php echo $answerTrue->getRecommend()?>
	</blockquote>
	<?php else:?>
	<br />
	<blockquote>
	<strong class="text text-success">Lý giải: </strong>
	<?php  $teacher_answers = json_decode($question->getTeacher_answers(), true);?>
		<?php if(isset($teacher_answers['content_full'])):?>
		<?php echo @$teacher_answers['content_full']?>
		<?php else:?>
		<?php echo $question->getExplaination()?>
		<?php endif;?>
	</blockquote>
	<?php endif;?>
	<hr style="width: 50%; text-align: center" />
<?php endforeach; ?>