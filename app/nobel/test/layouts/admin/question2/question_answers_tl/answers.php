<style>
	.input_dt{
		border: none;
    border-bottom: 1px dotted #09F;
    padding: 0px 5px;
    text-align: center;
	}
</style>
<?php
$item = $data->getItem();
$controller = pzk_controller();

$teacher_answers = null;
if($item['teacher_answers']) {
	$teacher_answers = json_decode($item['teacher_answers'], true);
}
pzk_global()->set('teacher_answers', $teacher_answers);

$pattern = '/\[(input|i)([\d]+)(\[([\d]+)\])?\]/';
$content = preg_replace_callback($pattern, function($matches) {
		$teacher_answers = pzk_global()->get('teacher_answers');		
		return '<input size="' . @$matches[4] . '" name="answers[i]['.$matches[2].']" value="'.@$teacher_answers['i'][$matches[2]].'" />'.'<input placeholder="Điểm" size="' . @$matches[4] . '" name="answers[i_m]['.$matches[2].']" value="'.@$teacher_answers['i_m'][$matches[2]].'" />';
	}, $item['name']);
	
	$pattern = '/\[(tput|tp)([\d]+)(\[([\d]+)\])?\]/';
$content = preg_replace_callback($pattern, function($matches) {
		$teacher_answers = pzk_global()->get('teacher_answers');		
		return '<input class="input_dt" size="' . @$matches[4] . '" name="answers[i]['.$matches[2].']" value="'.@$teacher_answers['i'][$matches[2]].'" />'.'<input placeholder="Điểm" size="' . @$matches[4] . '" name="answers[i_m]['.$matches[2].']" value="'.@$teacher_answers['i_m'][$matches[2]].'" />';
	}, $content);


	
	$pattern = '/\[(textarea|t)([\d]+)\]/';
	
	$content = preg_replace_callback($pattern, function($matches) {
		$teacher_answers = pzk_global()->get('teacher_answers');
		return '<textarea class="item tinymce_input" name="answers[t]['.$matches[2].']">'.@$teacher_answers['t'][$matches[2]].'</textarea>';
	}, $content);

?>
<div class="row"><div class="col-xs-12"><span class="title-ptnn">Yêu cầu :</span> {item[request]}</div></div>


<form role="form" method="post" action="{url /admin_}{controller.module}/edit_tlPost">
 	<div class="row"><div class="col-xs-12"><span class="title-ptnn">Câu hỏi :</span> {content}</div></div>
	
	<input type="hidden" name="id" value="{item[id]}" />
	<blockquote>
  	<div class="row title-ptnn"><div class="col-xs-12 margin-top-10">Đáp án  : </div></div>
	<div class="form-group col-xs-12">
		<textarea id="content_full" class="form-control tinymce_input" rows="2" name="answers[content_full]" aria-required="true" aria-invalid="false">{teacher_answers[content_full]}</textarea>
    </div>
	</blockquote>

  	<div id="answers_invalid" class="color-warning col-xs-12 margin-top-10">
	</div>
  	<div class="margin-top-20">
	  	<div class="col-xs-4">
			<button type="submit" class="btn btn-primary" onclick = "return validate_answers()" ><span class="glyphicon glyphicon-save"></span> Cập nhật</button>
			<a class="btn btn-default" href="{url /}{? echo pzk_request()->get('controller'); ?}/{item[questionId]}">Quay Lại</a>
		</div>
	</div>
</form>

<script>
    <?php if(pzk_request('softwareId') == 1) { ?>
	    setInputTinymce(2);
    <?php } else { ?>
        setInputTinymce();
    <?php } ?>

</script>