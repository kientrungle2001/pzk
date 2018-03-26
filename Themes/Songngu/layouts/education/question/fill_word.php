<?php $items = $data->get('question');?>
<div class="nobel-list-md typedt">
	
	<p class='dt-request'><i><?=$items->get('request')?></i></p>
	<?php $input = "<input class='input_dt' name='answers[".$items->get('id')."]'/>"; ?>
	<p><span class="ptnn-title"> <?=  str_replace('...', $input, $items->get('name'))?></span></p>
	
	<div class="answer_full_<?=$items->get('id')?>" style="display:none; clear:both; padding-top: 15px;">
	<b>Đáp án :</b> </div>
	<div class="line_question pd-top-10"></div>
</div>