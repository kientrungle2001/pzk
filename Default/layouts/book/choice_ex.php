<?php
$items = $data->getQuestion ();
//debug($items);
$itemsAnswers = $data->getQuestionAnswers ();
?>

<div class="panel-body" style="min-height: 350px">
	<div class="col-xs-6">
		<div class="order"><b>Câu <?=$items['order']?> </b></div>
		<i><?=$items['request']?> : </i>
    	<p><?=$items['name']?></p>
    	<p><b>Bài làm của học sinh : </b></p>
    	<?php  $content = setContentType($items['content']);?>
    	<p><b>Đáp án đúng :</b> <?=$content['main'];?></p>
    	<p><b>Câu đầy đủ :</b> <?=$content['extra'];?></p>
    	
    	<div class="dapan text-center">
			<a href="javascript:void(0)" id="dapan_<?=$items['id']?>">Đáp án trung tâm <span class="glyphicon glyphicon-folder-open"></span></a>
		</div>
    	<div id="dapan_title_<?=$items['id']?>" style="display: none;">
			<b>Đáp án</b>
			<span onclick="$('#dapan_<?=$items['id']?>').popover('hide');" class="glyphicon glyphicon-remove btn-ptnn-remove"></span>
		</div>
		<div id="dapan_content_<?=$items['id']?>" style="display: none;">
			<?php
			foreach($itemsAnswers as $key => $answers){
				if($answers['status'] == 1){
					echo "  Đáp án đúng : " .$answers['content']." <br/>";
					echo "  Câu đầy đủ : " .$answers['content_full']." <br/>";
					echo "  Giải thích : " .$answers['recommend']." <br/>"; 
					break;
				}
			}
			?>
		</div>
	</div>
	<div class="col-xs-6">
		<div class="col-xs-2 col-xs-offset-6">
			<label class="control-label" for="mark_<?=$items['user_answers_id']?>">Điểm :</label>
		</div>
		<div class="col-xs-4">
			<input class="form-control input-sm" type="text" 
				name="mark[<?=$items['user_answers_id']?>]" 
				id="mark_<?=$items['user_answers_id']?>"
				value="<?php if($items['mark'] != 0) echo $items['mark'];?>" />
		</div>
		<div class="col-xs-12">
			<label class="control-label" for="recommend_mark_<?=$items['user_answers_id']?>">Nhận
				xét giáo viên :</label><br />
			<textarea id="recommend_mark_<?=$items['user_answers_id']?>"
				style="background-color: #EEEEEE" class="form-control tinymce_input"
				rows="2" name="recommend_mark[<?=$items['user_answers_id']?>]"
				aria-required="true" aria-invalid="false">
    			<?=$items['recommend_mark']?>
    		</textarea>
		</div>
	</div>
<script>
	$('#dapan_<?=$items['id']?>').popover(
			{'html':true,
			'trigger':'click',
			'placement':'bottom',
			'title':$('#dapan_title_<?=$items['id']?>').html(),
			'content':$('#dapan_content_<?=$items['id']?>').html()}
	);
</script>

</div>