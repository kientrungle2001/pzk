<?php $items = $data->getQuestion();?>
<div class="nobel-list-md typedt">
	
	<p class='dt-request'><i><?=$items->getRequest()?></i></p>
	<?php $input = "<input class='input_dt' name='answers[".$items->getId()."]'/>"; ?>
	<p><span class="ptnn-title"> <?=  str_replace('...', $input, $items->getName())?></span></p>
	
	<div class="answer_full_<?=$items->getId()?>" style="display:none; clear:both; padding-top: 15px;">
	<b>Đáp án :</b> </div>
	<div class="line_question pd-top-10"></div>
</div>