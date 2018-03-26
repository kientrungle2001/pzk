<?php $item = $data->getItem();
$lang = pzk_session('language');
$questions = $data->getQuestions();

$test = null;
if($item['testId']) {
	$test = _db()->selectAll()->fromTests()->whereId($item['testId'])->result_one();
}
//debug($questions);
?>
<div class="container">
<hr />
<h1 class="text-center">Chi tiết vở bài tập</h1>
<?php if($test): ?><h2 class="text-center">Đề thi: {test[name]}</h2><?php endif;?>
<p class="text-center"><a href="/Profile/detail">Quay lại</a></p>
<?php $index = 1;?>
<div class="row">
		<div class="col-xs-8 col-xs-offset-2">
			<table class="table table-bordered">
				<tr>
					<th>Số câu đúng</th>
					<td>{item[mark]}</td>
				</tr>
				<tr>
					<th>Tổng số câu</th>
					<td>{item[quantity_question]}</td>
				</tr>
			</table>
		</div>
</div>
{each $questions as $question}
	<div class="row">
		<div class="col-xs-8 col-xs-offset-2">
			<strong> <?php if($lang == 'vn'){ echo 'Câu'; }else{ echo 'Question';} ?> {index}</strong>
		</div>
		<div class="col-xs-8 col-xs-offset-2">
		<?php 
		if($lang == 'vn'){ 
			echo getLatex($question['name_vn']); 
		} else { 
			echo getLatex($question['questionName']);
		} ?>
		
		</div>
		<div class="col-xs-8 col-xs-offset-2">
			<strong>Đáp án đã chọn</strong>
		</div>
		<div class="col-xs-8 col-xs-offset-2">
		<?php 
		$answers = $data->getAnswers($question['questionId']);
		
		 
		?>
		{each $answers as $answer}
		<div>
			<input type="radio" name="answer_question_{question[questionId]}" 
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
		{/each}
		</div>
	</div>
	<hr />
<?php $index++;?>
{/each}
</div>