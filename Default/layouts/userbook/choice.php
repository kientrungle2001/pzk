<style>
.answerTrue{
	color: rgb(92, 184, 92);
    font-weight: bold;
}
</style>
<?php 
	$items = $data->getQuestion(); 
	$answers = $items->getAnswers();
	$userAnswer = $data->getUserAnswer();
?>
<div class="nobel-list-md choice">
	
	<p><i class="ptnn-title"><?=$items->get('request')?></i></p>
	<p><span class="ptnn-title"> <?=getLatex($items->get('name'))?></span></p>
	<table>
	<?php $explanation = ""; ?>
	<?php foreach($answers as $key =>$value):?>
	<tr>
		<td>
			<input <?php if($userAnswer == $value->get('content')) { echo 'checked'; } ?>  type="radio" style="font-weight: normal; float:left" name="answers[<?=$items->get('id')?>]" id="answers_<?=$items->get('id')?>_<?=$value->get('id')?>" value="<?php if($value->get('content') == NULL) echo "0"; else echo htmlentities($value->get('content'), ENT_QUOTES, "UTF-8");?>"/>
			<span  class="answers_<?=$items->get('id')?>_<?=$value->get('id')?>  <?php if($value->get('status') == 1){ echo ' answerTrue '; }?>" style="padding-left:10px;"><?php if($value->get('content') == NULL) echo "0"; else echo getLatex(strip_tags($value->get('content'), '<img>'));?>
				<?php if($value->get('status') == 1){ ?>  <span class="has-success glyphicon glyphicon-ok"></span> <?php } ?>
			</span>
		</td>
	</tr>
	<?php if($value->get('status') == 1){$explanation = $value->get('recommend');}?>
	<?php endforeach;?>
	</table>
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
	<div class="explanation">
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