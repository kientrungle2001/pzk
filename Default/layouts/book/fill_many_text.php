<?php
$items = $data->getQuestion ();
$itemsAnswers = $data->getQuestionAnswers ();
$itemsAnswersAccepts = $data->getAnswersAccepts();
$itemsAnswersAcceptsArr = explode('|', $itemsAnswersAccepts['accept']);
?>

<div class="panel-body" style="min-height: 350px">
	<div class="col-xs-6">
		<div class="order"><b>Câu <?=$items['order']?> </b></div>
		<input type="hidden"  value="<?=$items['id'];?>" name="question_id[<?=$items['id']?>]"/>
		<i><?=$items['request']?> : </i>
    	<p><?=$items['name']?></p>
    	<p><b>Bài làm của học sinh : </b></p>
    	<?php  $content = setContentType($items['content']);?>
    	<?php if($content !== NULL):?>
	    	<?php foreach($content as $key =>$value):?>
	    		<?php if($key !== 'extra'):?>
	    		<div class="checkbox">
			    	<label class="col-xs-12">
				    	<div class="col-xs-10">
				    		<?=$value;?>
				    	</div>
				    	<div class="col-xs-1">
				    		<input type="checkbox" value="<?=$value;?>" name="answers_level[<?=$items['user_answers_id']?>][]"  <?php if(in_array($value, $itemsAnswersAcceptsArr)) echo "checked ='1'"?>  />
				    		<span class="pd-top-3 blue glyphicon glyphicon-star"></span>
				    	</div>
				    	<div class="col-xs-1">
				    		<input type="checkbox" value="<?=$value;?>" name="answers[<?=$items['id']?>][]"  <?php if(checkArray($value, $itemsAnswers)) echo "checked ='1'"?> <?php if(pzk_session("adminLevel") !== "Administrator"):?> disabled = "1" <?php endif;?> />
				    		<span class="pd-top-3 red glyphicon glyphicon-star"></span>
				    	</div>
			    	</label>
	    		</div>
	    		<div class="clearfix"></div>
		    	<?php endif;?>
			<?php endforeach;?>
		<?php endif;?>
		
    	<div class="dapan text-center">
			<a href="javascript:void(0)" id="dapan_<?=$items['id']?>">Đáp án trung tâm <span class="glyphicon glyphicon-folder-open"></span></a>
		</div>
    	<div id="dapan_title_<?=$items['id']?>" style="display: none;">
			<b>Đáp án</b>
			<span onclick="$('#dapan_<?=$items['id']?>').popover('hide');" class="glyphicon glyphicon-remove btn-ptnn-remove"></span>
		</div>
		<div id="dapan_content_<?=$items['id']?>" style="display: none;">
			<?php
			$answersContent = "";
			$answersRecommend = "";
			foreach($itemsAnswers as $key => $answers){
				$answersContent = $answersContent."<br/> - ".$answers['content'];
				if($key == '0'){
					$answersRecommend = $answers['recommend'];
				}
			}
			echo "<p>  <b>Đáp án đúng :</b> " .$answersContent." </p>";
			echo "<p>  <b>Giải thích :</b> " .$answersRecommend." </p>";
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