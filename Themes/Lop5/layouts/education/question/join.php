<?php $items = $data->get('question');?>
<div class="nobel-list-md choice">
	
	<p><i><?=$items->get('request')?></i></p>
	<p><span class="ptnn-title"> <?=str_replace('___', 
			'<input class="form-control join" name="answers['.$items->get('id').']"/> ',  $items->get('name'))?></span></p> 
	<div class="remove-input remove-input_<?=$items->get('id')?>"></div> 
	<div class="col-xs-9">
		<div class="answers_full_<?=$items->get('id')?>" style="padding-top:5px"></div>
	</div>
	<div class="line_question pd-top-10"></div>
</div>