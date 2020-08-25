<?php $items = $data->getQuestion(); $answers = $items->getAnswers();?>
<div class="nobel-list-md choice">
	
	<p><i><?=$items->getRequest()?></i></p>
	<p><span class="ptnn-title"> <?=$items->getName()?></span></p>
	<?php $explanation = ""; ?>
	<?php foreach($answers as $key =>$value):?>
		<?php if($value->getStatus() == 0):?>
			<div class="col-xs-6">
				<label for="answers_<?=$items->getId()?>_<?=$value->getId()?>" class="control-label answers_<?=$items->getId()?>_<?=$value->getId()?>">Lỗi sai trong câu</label>
				<div class="fill_true">
					<div>
						<input type="text" class="form-control input-sm fill_two_false_<?=$items->getId()?>_<?=$value->getId()?>" name="answers[<?=$items->getId()?>][<?=$value->getId()?>]" id="answers_<?=$items->getId()?>_<?=$value->getId()?>"/>
					</div>
					<div class="has-success hidden check_<?=$items->getId()?>_<?=$value->getId()?>">
						<span class="glyphicon glyphicon-ok"></span>
					</div>
				</div>
			</div>
		<?php elseif($value->getStatus() == 1):?>
			<div class="col-xs-6">
				<label for="answers_<?=$items->getId()?>_<?=$value->getId()?>" class="control-label answers_<?=$items->getId()?>_<?=$value->getId()?>"> Đáp án đúng </label>
			 	<div class="fill_true">
			 		<div>
						<input type="text" class="form-control input-sm fill_two_true_<?=$items->getId()?>_<?=$value->getId()?>" name="answers[<?=$items->getId()?>][<?=$value->getId()?>]" id="answers_<?=$items->getId()?>_<?=$value->getId()?>"/>
					</div>
					<div class="has-success hidden check_<?=$items->getId()?>_<?=$value->getId()?>">
						<span class="glyphicon glyphicon-ok"></span>
					</div>
				</div>
				<input type="hidden" name="answers[<?=$items->getId()?>][status]" value="<?=$value->getId()?>"/>
			</div>
		<?php endif;?>
		<?php 
		
			if($value->getStatus() == 1){
				$content_true = $value->getContent();
				$explanation = $value->getRecommend();
			}else{
				$content_false = $value->getContent();
			}
		?>
	<?php endforeach;?>
	
</div>

<?php 
	$recommentSoftware = "Bấm vào đây để xem giải thích";
	if($explanation == ""){
		$explanation = "Không có giải thích";
	}
?>

<div class="explanation pd-top-20 hidden">
	<a href="javascript:void(0)" id="explanation_<?=$items->getId()?>" class="btn btn-default btn-show-exp" ><?=$recommentSoftware;?></a>
</div>

<div id="explanation_title_<?=$items->getId()?>" style="display: none;">
	<b>Giải thích</b>
	<span onclick="$('#explanation_<?=$items->getId()?>').popover('hide');" class="glyphicon glyphicon-remove btn-ptnn-remove"></span>
</div>

<div id="explanation_content_<?=$items->getId()?>" style="display: none;">
	<?php 
	echo "Lỗi sai : ".$content_false."<br/>";
	echo "Đáp án đúng : ".$content_true."<br/>";
	echo nl2br($explanation);
	?>
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