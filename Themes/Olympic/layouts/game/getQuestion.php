
<?php
	
	$question = $data->getQuestion();
	
	
	$data->set ('questionId', $question['id']);
	
?>

<?php $items = $data->detailQuestion(); $answers = $items->getanswers();?>
<div class="nobel-list-md choice">
	<input type='hidden' name='questionId' value='<?php echo $question['id'];?>'/>
	<p><i class="ptnn-title"><?=$items->getRequest()?></i></p>
	<p><span class="ptnn-title"> <?=getLatex($items->getName())?></span>
	<?php if($items->getaudio()): ?>
		<span class="glyphicon glyphicon-volume-up" onclick="read_question(this, '<?php echo $items->getaudio()?>');"></span>
	<?php endif; ?>
	</p>
	<table>
	<?php $explanation = ""; ?>
	<?php foreach($answers as $key =>$value):?>
	<tr>
		<td>
			<input type="radio" style="font-weight: normal; float:left" name="answers[<?=$items->getId()?>]" id="answers_<?=$items->getId()?>_<?=$value->getId()?>" value="<?php if($value->getContent() == NULL) echo "0"; else echo htmlentities($value->getContent(), ENT_QUOTES, "UTF-8");?>"/>
			<span  class="answers_<?=$items->getId()?>_<?=$value->getId()?>" style="padding-left:10px;"><?php if($value->getContent() == NULL) echo "0"; else echo getLatex(strip_tags($value->getContent(), '<img>'));?></span>
		</td>
	</tr>
	<?php if($value->getStatus() == 1){$explanation = $value->getRecommend();}?>
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

<div class='row'>
	
	<div onclick = 'getQuestion();' class='btn btn-info'>
		Gửi
	</div>
	<div class='btn btn-info' onclick = 'nextQuestion();'>
		Bỏ qua
	</div>

	
</div>