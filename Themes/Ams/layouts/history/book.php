<?php $item = $data->getItem();
$lang = pzk_session('language');
$questions = $data->getQuestions();

$test = null;
if($item['testId']) {
	$test = _db()->selectAll()->fromTests()->whereId($item['testId'])->result_one();
}
//debug($questions);
$totalMark = $data->getTeacherMark() + $item['totalTn'];
?>
<div class="container">
<br/>
<div class="well">
	<div class="text-center">
		<b>Tổng điểm: </b> <b style="color:red;font-size: 18px;"><?php echo $totalMark ?> điểm</b><br>
	</div>
</div>

<?php $index = 1;?>
<div class="well">
	<div class="text-center">
		<b>Điểm bài thi trắc nghiệm: </b> <b style="color:red;font-size: 18px;"><?php echo @$item['totalTn']?> điểm</b><br>
	</div>
</div>
<?php foreach($questions as $question): ?>
	<div class="row">
		<div class="col-xs-12">
			<strong> <?php if($lang == 'vn'){ echo 'Câu'; }else{ echo 'Question';} ?> <?php echo $index ?></strong>
		</div>
		<div class="col-xs-12">
		<?php 
		if($lang == 'vn'){ 
			echo getLatex($question['name_vn']); 
		} else { 
			echo getLatex($question['questionName']);
		} ?>
		
		</div>
		<div class="col-xs-12">
			<strong>Đáp án đã chọn</strong>
		</div>
		<div class="col-xs-12">
		<?php 
		$answers = $data->getAnswers($question['questionId']);
		
		 
		?>
		<?php foreach($answers as $answer): ?>
		<div>
			<input type="radio" name="answer_question_<?php echo @$question['questionId']?>" 
			<?php 
			if($question['answerId'] == $answer['id']){ echo 'checked'; }
			?>
			
			disabled />
				<?php if($lang == 'vn'){ 
					echo getLatex($answer['content_vn']);
				} else { 
					echo getLatex($answer['content']);
				} ?>
				<?php if($answer['status']):?><span class="glyphicon glyphicon-ok text-success"></span><?php endif;?></div>
		<?php endforeach; ?>
		</div>
	</div>
	<hr />
<?php $index++;?>
<?php endforeach; ?>
</div>