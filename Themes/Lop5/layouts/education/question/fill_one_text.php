<?php $items = $data->get('question'); $answers = $items->get('answers');?>
<div class="nobel-list-md choice">
	<p><i><?=$items->get('request')?></i></p>
	<p><span class="ptnn-title"> <?=$items->get('name')?></span></p>
	<div class="col-xs-10">
		<textarea class="form-control" name="answers[<?=$items->get('id')?>]" rows="2"></textarea>
	</div>
	
	<div class="answer_full_<?=$items->get('id')?>" style="display:none; clear:both; padding-top: 15px;"><b>Đáp án :</b> </div>
	<?php 
		$explanation = '';
		if($answers[0]->get('status') == 1){$explanation = $value->get('recommend');}
	?>
	
	<?php 
		$recommentSoftware = "Bấm vào đây để xem giải thích";
		if($explanation == ""){
			$explanation = "Không có giải thích";
		}
	?>
	
	<div class="explanation hidden">
		<a href="javascript:void(0)" id="explanation_<?=$items->get('id')?>" class="btn btn-default btn-show-exp" ><?=$recommentSoftware;?></a>
	</div>
	
	<div id="explanation_title_<?=$items->get('id')?>" style="display: none;">
		<b>Giải thích</b>
		<span onclick="$('#explanation_<?=$items->get('id')?>').popover('hide');" class="glyphicon glyphicon-remove btn-ptnn-remove"></span>
	</div>
	
	<div id="explanation_content_<?=$items->get('id')?>" style="display: none;">
		<?=nl2br($explanation)?>
	</div>
	
	<div class="line_question pd-top-10"></div>
</div>

<style>
	.popover{max-width: 800px}
</style>
<script>
	$('#explanation_<?=$items->get('id')?>').popover(
			{'html':true,
			'trigger':'click',
			'title':$('#explanation_title_<?=$items->get('id')?>').html(),
			'content':$('#explanation_content_<?=$items->get('id')?>').html()}
	);
</script>