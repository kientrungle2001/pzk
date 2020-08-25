<?php $items = $data->getQuestion();?>
<div class="nobel-list-md choice">
	
	<p><i><?=$items->getRequest()?></i></p>
	<p><span class="ptnn-title"> <?=str_replace('___', 
			'<input class="form-control join" name="answers['.$items->getId().']"/> ',  $items->getName())?></span></p> 
	<div class="remove-input remove-input_<?=$items->getId()?>"></div> 
	<div class="col-xs-9">
		<div class="answers_full_<?=$items->getId()?>" style="padding-top:5px"></div>
	</div>
	<div class="line_question pd-top-10"></div>
</div>