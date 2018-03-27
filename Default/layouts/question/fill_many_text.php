<?php $items = $data->getQuestion();?>
<div class="nobel-list-md choice">
	
	<p><i><?=$items->get('request')?></i></p>
	<p><span class="ptnn-title"> <?=$items->get('name')?></span></p>
	<div class="col-xs-10 element-input">
		<textarea type="text" class="form-control input-sm" name="answers[<?=$items->get('id')?>][]"></textarea>
	</div>
	<div class="add_row_answer">
     	<div class="itemAnswer_<?=$items->get('id');?>"  ></div>
    </div>
	<div class="btt_add_answer">
		<button class="btn btn-primary add-sub-input-test" style="margin-left: 15px;" onclick="addInputRowText(<?=$items->get('id')?>)" type="button" title="Thêm đáp án">
			<span class="glyphicon glyphicon-plus-sign"></span>
		</button>
	</div>
	
	<div class="answer_full_<?=$items->get('id')?>" style="display:none; clear:both; padding-top: 15px;"><b>Đáp án trung tâm :</b> </div>
	<div class="line_question pd-top-10"></div>
</div>