<?php $items = $data->getQuestion(); $answers = $items->getAnswers();?>
<div class="nobel-list-md choice">
	<p><i><?=$items->get('request')?></i></p>
	<p><span class="ptnn-title"> <?=$items->get('name')?></span></p>
	<div class="col-xs-10">
		<textarea class="form-control" name="answers[<?=$items->get('id')?>]" rows="2"></textarea>
	</div>
	
	<div class="answer_full_<?=$items->get('id')?>" style="display:none; clear:both; padding-top: 15px;"><b>Đáp án :</b> </div>
	<div class="line_question pd-top-10"></div>
</div>