<?php $items = $data->getQuestion(); $answers = $items->getAnswers();?>
<div class="nobel-list-md choice">
	
	<p><i class="ptnn-title"><?=$items->getRequest()?></i></p>
	<p><span class="ptnn-title"> <?=$items->getName()?></span></p>
	<?php $explanation = ""; ?>
	<?php $content_full= "";?>
	<?php foreach($answers as $key =>$value):?>
		<div class="input-choice">
			<input type="radio" name="answers[<?=$items->getId()?>][]" id="answers_<?=$items->getId()?>_<?=$value->getId()?>" value="<?php if($value->getContent() == NULL) echo "0"; else echo htmlentities($value->getContent(), ENT_QUOTES, "UTF-8");?>"/>
		</div>
		<div class="col-xs-2">
			<label class="answers_<?=$items->getId()?>_<?=$value->getId()?>" for="answers_<?=$items->getId()?>_<?=$value->getId()?>"><?php if($value->getContent() == NULL) echo "0"; else echo getLatex(strip_tags($value->getContent(), '<img>'));?></label>
		</div>
		<?php if($value->getStatus() == 1){$explanation = $value->getRecommend(); $content_full = $value->getContent_full();}?>
	<?php endforeach;?>
	<?php 
		$recommentSoftware = "Bấm vào đây để xem đáp án";
		if($explanation == ""){
			$explanation = "Không có giải thích";
		}
		
		if(pzk_request()->getSoftwareId() == 1){
			$recommentSoftware = "View explanation";
			if($explanation == ""){
				$explanation = "Have not explanation";
			}
		}
	?>
	<div style="clear:both; padding-top: 15px;">
		<span class="ptnn-title">Viết lại câu : </span>
		<textarea class="form-control" name="answers[<?=$items->getId()?>][content_full]" rows="2"></textarea>
	</div>
	
	<div class="explanation hidden">
		<a href="javascript:void(0)" id="explanation_<?=$items->getId()?>" class="btn btn-default btn-show-exp" ><?=$recommentSoftware;?></a>
	</div>
	
	<div id="explanation_title_<?=$items->getId()?>" style="display: none;">
		<b>Giải thích</b>
		<span onclick="$('#explanation_<?=$items->getId()?>').popover('hide');" class="glyphicon glyphicon-remove btn-ptnn-remove"></span>
	</div>
	
	<div id="explanation_content_<?=$items->getId()?>" style="display: none;">
		<?=nl2br($explanation);?> <br/>
		<?php if($content_full !== "") echo "<b>Câu đầy đủ:</b><br/>". $content_full;?>
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