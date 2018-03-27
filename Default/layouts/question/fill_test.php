<?php $items = $data->getQuestion();?>
<div class="nobel-list-md choice">
	
	<p><i><?=$items->get('request')?></i></p>
	<p><span class="ptnn-title"> <?=$items->get('name')?></span></p>
	<div class="col-xs-3">
		<input class="form-control" name="answers[<?=$items->get('id')?>]" rows="2"/>
		<div class="remove-input remove-input_<?=$items->get('id')?>"></div>
	</div>
	<div class="col-xs-9">
		<div class="answers_full_<?=$items->get('id')?>" style="padding-top:5px"></div>
	</div>
	<div class="line_question pd-top-10"></div>
</div>