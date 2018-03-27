<style>
.input_dt{
	border: none;
    border-bottom: 1px dotted #09F;
    padding: 0px 5px;
    text-align: center;
}
</style>
<?php
	$items = $data->get('question');

	$itemsAnswers = $data->get('studentAnswers');
	
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
			$check = 'checked="checked"';
			$style = 'color: red;';
		}else{
			$check = '';
			$style = '';
		}
		
		return '
		<input '.$check.'  type="checkbox" name="checkfalse['.$item['user_answers_id'].']['.$matches[2].']" value="1" class="checkfalse" />
		<input style="'.$style.'" size="' . @$matches[4] . '" value="'.$answer['i'][$matches[2]].'" name="answers['.$item['user_answers_id'].'_i]['.$matches[2].']" />';
	}, $items['name']);
	
	$pattern = '/\[(tput|tp)([\d]+)(\[([\d]+)\])?\]/';
	
	$content = preg_replace_callback($pattern, function($matches) {
		$answer	=	pzk_global()->get('answerTmp');
		$item		=	pzk_global()->get('itemsTmp');
		
		if(isset($answer['checkfalse'][@$matches[2]])) {
			$check = 'checked';
			$style = 'color: red;';
		}else{
			$check = '';
			$style = '';
		}
		
		return '
		<input '.$check.'  type="checkbox" name="checkfalse['.@$item['user_answers_id'].']['.@$matches[2].']" value="1" class="checkfalse" />
		<input style="'.$style.'" class="input_dt" size="' . @$matches[4] . '" value="'.@$answer['i'][@$matches[2]].'" name="answers['.$item['user_answers_id'].'_i]['.@$matches[2].']" />';
	}, $content);

	
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


<div class="panel-body" style="min-height: 350px">
	<div class="col-xs-12">
		<div class="order"><b>Câu <?=$items['order']?> </b></div>
		<i><?=$items['request']?> : </i>
    	<p><?= preg_replace('/<img[^>]*>/', '', $content)?></p>
    	
	</div>
	<div class="col-xs-12">
		<div class="col-xs-2 col-xs-offset-6">
			<label class="control-label" for="mark_<?=$items['user_answers_id']?>">Điểm :</label>
		</div>
		<div class="col-xs-4">
			<input class="form-control input-sm" type="text" 
				name="mark[<?=$items['user_answers_id']?>]" 
				id="mark_<?=$items['user_answers_id']?>"
				value="<?php if($items['mark'] != 0) { echo $items['mark']; }else { echo '0';} ?>" />
		</div>
		<div class="col-xs-12">
			<label class="control-label" for="recommend_mark_<?=$items['user_answers_id']?>">Nhận
				xét giáo viên :</label><br />
			<select onchange="return selectRecommend(this, '<?=$items['user_answers_id'];?>')" class='form-control'>
				<option value='Bài làm tốt!'>Bài làm tốt!</option>
				<option value='Bài làm khá!'>Bài làm khá!</option>
				<option value='Cần cố gắng hơn!'>Cần cố gắng hơn!</option>
				<option value='Kết quả chưa đúng, học sinh xem thêm phần lí giải để có kết quả đúng!'>Kết quả chưa đúng, học sinh xem thêm phần lí giải để có kết quả đúng!</option>
				<option value='Cần đọc kĩ đề hơn. Học sinh xem thêm phần lí giải để có đáp án đúng!'>Cần đọc kĩ đề hơn. Học sinh xem thêm phần lí giải để có đáp án đúng!</option>
			</select>
			<textarea id="recommend_mark_<?=$items['user_answers_id']?>"
				style="background-color: #EEEEEE" class="form-control tinymce_input"
				rows="2" name="recommend_mark[<?=$items['user_answers_id']?>]"
				aria-required="true" aria-invalid="false"><?=$items['recommend_mark']?></textarea>
			
		</div>
		
	</div>

</div>













