<?php $items = $data->getQuestion(); $answers = $items->getAnswers();?>
<div class="nobel-list-md choice">
	<p><i><?=$items->getRequest()?></i></p>
	<p><span class="ptnn-title"> <?=$items->getName()?></span></p>
	<div class="col-xs-10">
		<textarea class="form-control" name="answers[<?=$items->getId()?>]" rows="2"></textarea>
	</div>
	
	<div class="answer_full_<?=$items->getId()?>" style="display:none; clear:both; padding-top: 15px;"><b>Đáp án :</b> </div>
	<div class="line_question pd-top-10"></div>
</div>