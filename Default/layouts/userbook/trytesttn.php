<?php 
	$items = $data->getQuestion(); 
	$answers = $data->getAnswers();
	$userAnswer = $data->getUserAnswer();
	//$userAnswer = '';
?>
<div class="nobel-list-md choice">
	
	<p><i class="ptnn-title"><?=$items->getRequest()?></i></p>
	<p><span class="ptnn-title"> <?=getLatex($items->getName())?></span></p>
	<table>
	<?php $explanation = ""; ?>
	<?php foreach($answers as $key =>$value):?>
	<tr>
		<td>
			<input <?php if($userAnswer == $value->getContent()) { echo 'checked'; } ?>  type="radio" style="font-weight: normal; float:left" name="answers[<?=$items->getId()?>]" id="answers_<?=$items->getId()?>_<?=$value->getId()?>" value="<?php if($value->getContent() == NULL) echo "0"; else echo htmlentities($value->getContent(), ENT_QUOTES, "UTF-8");?>"/>
			<span  class="answers_<?=$items->getId()?>_<?=$value->getId()?>  <?php if($value->getStatus() == 1){ echo ' answerTrue '; }?>" style="padding-left:10px;"><?php if($value->getContent() == NULL) echo "0"; else echo getLatex(strip_tags($value->getContent(), '<img>'));?>
				<?php if($value->getStatus() == 1){ ?>  <span class="has-success glyphicon glyphicon-ok"></span> <?php } ?>
			</span>
		</td>
	</tr>
	<?php if($value->getStatus() == 1){$explanation = $value->getRecommend();}?>
	<?php endforeach;?>
	</table>
	<?php 
		$recommentSoftware = "Bấm vào đây để xem lí giải";
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
	<div class="explanation">
		<a href="javascript:void(0)" id="explanation_<?=$items->getId()?>" class="btn btn-default btn-show-exp" ><?=$recommentSoftware;?></a>
	</div>
	
	<div id="explanation_title_<?=$items->getId()?>" style="display: none;">
		<b>Giải thích</b>
		<span onclick="$('#explanation_<?=$items->getId()?>').popover('hide');" class="glyphicon glyphicon-remove btn-ptnn-remove"></span>
	</div>
	
	<div id="explanation_content_<?=$items->getId()?>" style="display: none;">
		<?=getLatex(nl2br($explanation))?>
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