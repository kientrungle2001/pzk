<?php $items = $data->get('question');?>
<div class="nobel-list-md choice">
	
	<p><i><?=$items->get('request')?></i></p>
	<p><span class="ptnn-title"> <?=$items->get('name')?></span></p>
	<div class="col-xs-3">
		<input class="form-control" name="answers[<?=$items->get('id')?>]" rows="2"/>
	</div>
	<div class="answer_full_<?=$items->get('id')?>" style="display:none; clear:both; padding-top: 15px;"><b>Đáp án :</b> </div>
	<div class="line_question pd-top-10"></div>
</div>