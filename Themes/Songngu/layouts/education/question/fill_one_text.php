<?php $items = $data->getQuestion(); $answers = $items->getAnswers();?>
<div class="nobel-list-md choice">
	<p><i><?=$items->getRequest()?></i></p>
	<p><span class="ptnn-title"> <?=$items->getName()?></span></p>
	<div class="col-xs-10">
		<textarea class="form-control" name="answers[<?=$items->getId()?>]" rows="2"></textarea>
	</div>
	
	<div class="answer_full_<?=$items->getId()?>" style="display:none; clear:both; padding-top: 15px;"><b>Đáp án :</b> </div>
	<?php 
		$explanation = '';
		if($answers[0]->getStatus() == 1){$explanation = $value->getRecommend();}
	?>
	
	<?php 
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