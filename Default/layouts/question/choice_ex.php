<?php $items = $data->getQuestion(); $answers = $items->getAnswers();?>
<div class="nobel-list-md choice">
	
	<p><i class="ptnn-title"><?=$items->get('request')?></i></p>
	<p><span class="ptnn-title"> <?=$items->get('name')?></span></p>
	<?php $explanation = ""; ?>
	<?php $content_full= "";?>
	<?php foreach($answers as $key =>$value):?>
		<div class="input-choice">
			<input type="radio" name="answers[<?=$items->get('id')?>][]" id="answers_<?=$items->get('id')?>_<?=$value->get('id')?>" value="<?php if($value->get('content') == NULL) echo "0"; else echo htmlentities($value->get('content'), ENT_QUOTES, "UTF-8");?>"/>
		</div>
		<div class="col-xs-2">
			<label class="answers_<?=$items->get('id')?>_<?=$value->get('id')?>" for="answers_<?=$items->get('id')?>_<?=$value->get('id')?>"><?php if($value->get('content') == NULL) echo "0"; else echo getLatex(strip_tags($value->get('content'), '<img>'));?></label>
		</div>
		<?php if($value->get('status') == 1){$explanation = $value->get('recommend'); $content_full = $value->getContent_full();}?>
	<?php endforeach;?>
	<?php 
		$recommentSoftware = "Bấm vào đây để xem đáp án";
		if($explanation == ""){
			$explanation = "Không có giải thích";
		}
		
		if(pzk_request('softwareId') == 1){
			$recommentSoftware = "View explanation";
			if($explanation == ""){
				$explanation = "Have not explanation";
			}
		}
	?>
	<div style="clear:both; padding-top: 15px;">
		<span class="ptnn-title">Viết lại câu : </span>
		<textarea class="form-control" name="answers[<?=$items->get('id')?>][content_full]" rows="2"></textarea>
	</div>
	
	<div class="explanation hidden">
		<a href="javascript:void(0)" id="explanation_<?=$items->get('id')?>" class="btn btn-default btn-show-exp" ><?=$recommentSoftware;?></a>
	</div>
	
	<div id="explanation_title_<?=$items->get('id')?>" style="display: none;">
		<b>Giải thích</b>
		<span onclick="$('#explanation_<?=$items->get('id')?>').popover('hide');" class="glyphicon glyphicon-remove btn-ptnn-remove"></span>
	</div>
	
	<div id="explanation_content_<?=$items->get('id')?>" style="display: none;">
		<?=nl2br($explanation);?> <br/>
		<?php if($content_full !== "") echo "<b>Câu đầy đủ:</b><br/>". $content_full;?>
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