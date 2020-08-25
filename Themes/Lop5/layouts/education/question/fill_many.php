<?php $items = $data->getQuestion(); $answers = $data->getanswers();?>
<div class="nobel-list-md choice">
	
	<p><i><?=$items->getRequest()?></i></p>
	<p><span class="ptnn-title"> <?=$items->getName()?></span></p>
	<div class="col-xs-3 element-input">
		<input type="text" class="form-control input-sm" name="answers[<?=$items->getId()?>][]"/>
	</div>
	<div class="add_row_answer">
     	<div class="itemAnswer_<?=$items->getId();?>"  ></div>
    </div>
	<div class="btt_add_answer">
		<button class="btn btn-primary add-sub-input-test" style="margin-left: 15px;" onclick="addInputRow(<?=$items->getId()?>)" type="button" title="Thêm đáp án">
			<span class="glyphicon glyphicon-plus-sign"></span>
		</button>
	</div>
	
	<div class="answer_full_<?=$items->getId()?>" style="display:none; clear:both; padding-top: 15px;"><b>Đáp án trung tâm :</b> </div>
	<?php
		
		$explanation = $answers[0]['recommend'];
		
		$recommentSoftware = "Bấm vào đây để xem giải thích";
		if($explanation == ""){
			$explanation = "Không có giải thích";
		}
	?>
	<div class="explanation hidden">
		<a href="javascript:void(0)" id="explanation_<?=$items->getId()?>" class="btn btn-default btn-show-exp" ><?=$recommentSoftware;?></a>
	</div>
	
	<div id="explanation_title_<?=$items->getId()?>" style="display: none;">
		<b>Giải thích</b>
		<span onclick="$('#explanation_<?=$items->getId()?>').popover('hide');" class="glyphicon glyphicon-remove btn-ptnn-remove"></span>
	</div>
	
	<div id="explanation_content_<?=$items->getId()?>" style="display: none;">
		<?=nl2br($explanation)?>
	</div>
	
	
	<div class="line_question pd-top-10"></div>
</div>

<style>
	.popover{max-width: 800px}
</style>
<script>
	$('#explanation_<?=$items->getId()?>').popover(
			{'html':true,
			'trigger':'click',
			'title':$('#explanation_title_<?=$items->getId()?>').html(),
			'content':$('#explanation_content_<?=$items->getId()?>').html()}
	);
</script>