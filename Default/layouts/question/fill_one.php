<?php $items = $data->getQuestion();?>
<div class="nobel-list-md choice">
	
	<p><i><?=$items->getRequest()?></i></p>
	<p><span class="ptnn-title"> <?=$items->getName()?></span></p>
	<div class="col-xs-3">
		<input class="form-control" name="answers[<?=$items->getId()?>]" rows="2"/>
	</div>
	<div class="answer_full_<?=$items->getId()?>" style="display:none; clear:both; padding-top: 15px;"><b>Đáp án :</b> </div>
	<div class="line_question pd-top-10"></div>
</div>