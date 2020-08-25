<?php $items = $data->getQuestion();?>
<div class="nobel-list-md choice">
	
	<p><i><?=$items->getRequest()?></i></p>
	<p><span class="ptnn-title"> <?=$items->getName()?></span></p>
	<div class="col-xs-3">
		<input class="form-control" name="answers[<?=$items->getId()?>]" rows="2"/>
		<div class="remove-input remove-input_<?=$items->getId()?>"></div>
	</div>
	<div class="col-xs-9">
		<div class="answers_full_<?=$items->getId()?>" style="padding-top:5px"></div>
	</div>
	<div class="line_question pd-top-10"></div>
</div>