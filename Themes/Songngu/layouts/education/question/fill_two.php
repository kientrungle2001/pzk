<?php $items = $data->get('question'); $answers = $items->get('answers');?>
<div class="nobel-list-md choice">
	
	<p><i><?=$items->get('request')?></i></p>
	<p><span class="ptnn-title"> <?=$items->get('name')?></span></p>
	<?php $explanation = ""; ?>
	<?php foreach($answers as $key =>$value):?>
		<?php if($value->get('status') == 0):?>
			<div class="col-xs-6">
				<label for="answers_<?=$items->get('id')?>_<?=$value->get('id')?>" class="control-label answers_<?=$items->get('id')?>_<?=$value->get('id')?>">Lỗi sai trong câu</label>
				<div class="fill_true">
					<div>
						<input type="text" class="form-control input-sm fill_two_false_<?=$items->get('id')?>_<?=$value->get('id')?>" name="answers[<?=$items->get('id')?>][<?=$value->get('id')?>]" id="answers_<?=$items->get('id')?>_<?=$value->get('id')?>"/>
					</div>
					<div class="has-success hidden check_<?=$items->get('id')?>_<?=$value->get('id')?>">
						<span class="glyphicon glyphicon-ok"></span>
					</div>
				</div>
			</div>
		<?php elseif($value->get('status') == 1):?>
			<div class="col-xs-6">
				<label for="answers_<?=$items->get('id')?>_<?=$value->get('id')?>" class="control-label answers_<?=$items->get('id')?>_<?=$value->get('id')?>"> Đáp án đúng </label>
			 	<div class="fill_true">
			 		<div>
						<input type="text" class="form-control input-sm fill_two_true_<?=$items->get('id')?>_<?=$value->get('id')?>" name="answers[<?=$items->get('id')?>][<?=$value->get('id')?>]" id="answers_<?=$items->get('id')?>_<?=$value->get('id')?>"/>
					</div>
					<div class="has-success hidden check_<?=$items->get('id')?>_<?=$value->get('id')?>">
						<span class="glyphicon glyphicon-ok"></span>
					</div>
				</div>
				<input type="hidden" name="answers[<?=$items->get('id')?>][status]" value="<?=$value->get('id')?>"/>
			</div>
		<?php endif;?>
		<?php 
		
			if($value->get('status') == 1){
				$content_true = $value->get('content');
				$explanation = $value->get('recommend');
			}else{
				$content_false = $value->get('content');
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
	<a href="javascript:void(0)" id="explanation_<?=$items->get('id')?>" class="btn btn-default btn-show-exp" ><?=$recommentSoftware;?></a>
</div>

<div id="explanation_title_<?=$items->get('id')?>" style="display: none;">
	<b>Giải thích</b>
	<span onclick="$('#explanation_<?=$items->get('id')?>').popover('hide');" class="glyphicon glyphicon-remove btn-ptnn-remove"></span>
</div>

<div id="explanation_content_<?=$items->get('id')?>" style="display: none;">
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
	$('#explanation_<?=$items->get('id')?>').popover(
			{'html':true,
			'trigger':'click',
			'title':$('#explanation_title_<?=$items->get('id')?>').html(),
			'content':$('#explanation_content_<?=$items->get('id')?>').html()}
	);
</script>