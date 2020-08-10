<?php
$item = $data->getItem();
$itemAnswers = $data->getItemAnswers();$controller = pzk_controller();
?>
<div class="row"><div class="col-xs-12"><span class="title-ptnn">Yêu cầu :</span> <?php echo @$item['request']?></div></div>

<div class="row"><div class="col-xs-12"><span class="title-ptnn">Câu hỏi :<br/></span> <?php echo @$item['name']?></div></div>

<div class="row title-ptnn"><div class="col-xs-12"> Đáp án :</div></div>
	 
<form role="form" method="post" action="<?php echo BASE_REQUEST . '/admin_' ?><?php echo @$controller->module?>/edit_tn20Post">
 	<input type="hidden" name="id" value="<?php echo @$item['id']?>" />
  	
  	<div class="form-group col-xs-3 margin-top-10">
		<input type="text" name="content" class="form-control" <?php if(isset($itemAnswers)):?>  value="<?=$itemAnswers[0]['content']?> <?php endif;?>"/>
	</div>	 
  	<div class="row title-ptnn"><div class="col-xs-12 margin-top-10">Đáp án hoàn chỉnh  : </div></div>
	<div class="form-group col-xs-12">
		<textarea id="content_full" class="form-control" rows="3" name="content_full" aria-required="true" aria-invalid="false"><?php if(isset($itemAnswers)):?> <?=$itemAnswers[0]['content_full']?> <?php endif;?></textarea>
    </div>
  	<div id="answers_invalid" class="color-warning col-xs-12 margin-top-10">
	</div>
	<div class="row title-ptnn"><div class="col-xs-12 margin-top-10">Giải thích  : </div></div>
  	<div class="form-group col-xs-12">
  		<textarea id="recommend" class="form-control" rows="2" name="recommend" aria-required="true" aria-invalid="false"><?=$itemAnswers[0]['recommend']?></textarea>
  	</div>
  	<div class="margin-top-20">
	  	<div class="col-xs-4">
			<button type="submit" class="btn btn-primary" onclick = "return validate_answers()"><span class="glyphicon glyphicon-save"></span> Cập nhật</button>
			<a class="btn btn-default" href="<?php echo BASE_REQUEST . '/admin_' ?><?php echo @$controller->module?>/<?php echo @$item['questionId']?>">Quay Lại</a>
		</div>
	</div>
</form>

<script>
	function validate_answers(){

		var content = $("form input[name='content']").val();
		$('#answers_invalid').html("");
		if(content.trim() ==''/*  || content_full.trim() =='' */){
			$('#answers_invalid').show();
		  	$('#answers_invalid').append("<span class='glyphicon glyphicon-warning-sign'></span> <b>Giá trị nhập không được để trống</b><br/>");
		  	return false;
		}else{
			return true;
		}
	}
</script>

<style>
	#answers_invalid{display:none;}
</style>