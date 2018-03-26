<?php $items = $data->get('question');$answers = $items->get('answers');?>
<div class="nobel-list-md choice">
	
	<p><i><?=$items->get('request')?></i></p>
	<p><span class="ptnn-title"> <?=$items->get('name')?></span></p>
	<?php foreach($answers as $key => $value):?>
		<div class="ptnn-title"><b><?=$value->get('content');?></b></div>
		<input type="hidden" class="form-control input-sm" name="answers[<?=$items->get('id')?>][<?=$value->get('id')?>][status]" value="<?=$value->get('content');?>"/>
		<div class="col-xs-4 element-input">
			<input type="text" class="form-control input-sm" name="answers[<?=$items->get('id')?>][<?=$value->get('id')?>][]" />
		</div>
		<div class="add_row_answer">
	     	<div class="itemAnswer_<?=$items->get('id');?>_<?=$value->get('id');?>"></div>
	    </div>
		<div class="btt_add_answer">
			<button class="btn btn-primary" style="margin-left: 15px;" onclick="addInputRowTableText(<?=$items->get('id')?>, <?=$value->get('id')?>)" type="button" title="Thêm đáp án">
				<span class="glyphicon glyphicon-plus-sign"></span>
			</button>
		</div>
	<?php endforeach;?>
	<div class="answer_full_<?=$items->get('id')?>" style="display:none; clear:both; padding-top: 15px;"><b>Đáp án trung tâm :</b> </div>
	<div class="line_question pd-top-10"></div>
</div>