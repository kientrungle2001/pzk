<?php $items = $data->getQuestion();$answers = $items->getanswers();?>
<div class="nobel-list-md choice">
	
	<p><i><?=$items->getRequest()?></i></p>
	<p><span class="ptnn-title"> <?=$items->getName()?></span></p>
	<?php foreach($answers as $key => $value):?>
		<div class="ptnn-title"><b><?=$value->getContent();?></b></div>
		<input type="hidden" class="form-control input-sm" name="answers[<?=$items->getId()?>][<?=$value->getId()?>][status]" value="<?=$value->getContent();?>"/>
		<div class="col-xs-4 element-input">
			<input type="text" class="form-control input-sm" name="answers[<?=$items->getId()?>][<?=$value->getId()?>][]" />
		</div>
		<div class="add_row_answer">
	     	<div class="itemAnswer_<?=$items->getId();?>_<?=$value->getId();?>"></div>
	    </div>
		<div class="btt_add_answer">
			<button class="btn btn-primary" style="margin-left: 15px;" onclick="addInputRowTableText(<?=$items->getId()?>, <?=$value->getId()?>)" type="button" title="Thêm đáp án">
				<span class="glyphicon glyphicon-plus-sign"></span>
			</button>
		</div>
	<?php endforeach;?>
	<div class="answer_full_<?=$items->getId()?>" style="display:none; clear:both; padding-top: 15px;"><b>Đáp án trung tâm :</b> </div>
	<div class="line_question pd-top-10"></div>
</div>