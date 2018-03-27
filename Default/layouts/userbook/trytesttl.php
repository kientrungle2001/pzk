<?php
	$items 		= $data->getQuestion ();
	//debug($items);
	/*$questionId = $data->getQuestionId();
	$question 	= _db()->getTableEntity('questions')->load($questionId);*/

	$itemsAnswers = $data->get('userAnswer');
	
	if($itemsAnswers['content_edit'] != '') {
		$answer = unserialize($itemsAnswers['content_edit']);
	}else {
		$answer = unserialize($itemsAnswers['content']);
	}
	
	
	pzk_global()->set('answerTmp', $answer);
	pzk_global()->set('itemsTmp', $items);
	
	$pattern = '/\[(input|i)([\d]+)(\[([\d]+)\])?\]/';
	
	$content = preg_replace_callback($pattern, function($matches) {
		$answer	=	pzk_global()->get('answerTmp');
		$item		=	pzk_global()->get('itemsTmp');
		
		if(isset($answer['checkfalse'][@$matches[2]])) {
			$style = 'color: red;';
		}else{
			$style = '';
		}
		
		return '
		<input style="'.$style.'"  size="' . @$matches[4] . '" value="'.$answer['i'][$matches[2]].'" name="answers['.$item['user_answers_id'].'_i]['.$matches[2].']" />';
	}, $items['name']);

	
	$pattern = '/\[(textarea|t)([\d]+)\]/';
	
	$content = preg_replace_callback($pattern, function($matches) {
		$answer	=	pzk_global()->get('answerTmp');
		$item		=	pzk_global()->get('itemsTmp');
		return '<textarea class="item tinymce_input" name="answers['.$item['user_answers_id'].'_t]['.$matches[2].']">'
		.
		nl2br($answer['t'][$matches[2]])
		.
		'</textarea>';
	}, $content);
	
		
?>
<style>
	.content table{
		width: 100% !important;
	}
</style>

<div class="panel-body" style="min-height: 350px">
	<div class='row'>
		<div class="col-md-6 col-xs-12">
			<div class="order"><b>Câu <?=$items['order']?> </b></div>
			<i class='item'><?=$items['request']?> : </i>
			<div class='item content'><?=$content?></div>
			
		</div>
		
		<div style='border-left: 1px solid #cccccc;' class="col-md-6 col-xs-12">
		<div class="table-responsive">
			<?php if(!$data->get('showTeacher')) { ?>
			<table class='table table-bordered'>
				<tr>
					<td><label class="control-label red" >Điểm</label></td>
					<td><label class="control-label red" >Nhận xét giáo viên</label></td>
				</tr>
				<tr>
					<td><b class='red'><?php if($items['mark'] != 0) { echo ' '.$items['mark'];} else{ echo '0'; }?> đ</b></td>
					<td>
						<textarea style='height: 200px;' id="recommend_mark_<?=$items['user_answers_id']?>"
						style="background-color: #EEEEEE" class="form-control tinymce_input"
						rows="2" name="recommend_mark[<?=$items['user_answers_id']?>]"
						aria-required="true" aria-invalid="false"><?=$items['recommend_mark']?></textarea>
					</td>
				</tr>
			</table>
			<?php } ?>
			<label class="control-label red" >Lý giải</label>
			<div class="item content">
			<?php if(isset($items['teacher_answers'])) {
				$content = json_decode($items['teacher_answers'], true);
				if(isset($content['content_full'])) {
					echo $content['content_full'];
				}
					
			} ?>
			
			</div>
		</div>	
			
		</div>
	</div>
	<div class="line_question pd-top-10"></div>
</div>













