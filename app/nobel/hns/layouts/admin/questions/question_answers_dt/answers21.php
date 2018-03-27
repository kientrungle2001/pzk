<?php
$item = $data->getItem();
$itemAnswers = $data->getItemAnswers();
?>
<div class="row"><div class="col-xs-12"><span class="title-ptnn">Yêu cầu :</span> {item[request]}</div></div>

<div class="row"><div class="col-xs-12"><span class="title-ptnn">Câu hỏi :<br/></span> {item[name]}</div></div>

<div class="row title-ptnn"><div class="col-xs-12"> Đáp án : </div></div>
	 
<form role="form" method="post" action="{url /admin_questions/edit_tn20Post}">
 	<input type="hidden" name="id" value="{item[id]}" />
  	
  	<div class="form-group col-xs-12 margin-top-10">
		<textarea id="content" class="form-control tinymce" rows="3" name="content" aria-required="true" aria-invalid="false"><?php if(isset($itemAnswers)):?> <?=$itemAnswers[0]['content']?> <?php endif;?></textarea>
	</div>
	
	<div class="row title-ptnn" style="display:none"><div class="col-xs-12 margin-top-10">Câu hoàn chỉnh  : </div></div>
	<div class="form-group col-xs-12" style="display:none">
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
			<a class="btn btn-default" href="{url /admin_questions}/{item[questionId]}">Quay Lại</a>
		</div>
	</div>
</form>

<script>
	function validate_answers(){
		var content = tinymce.get('content').getContent();
		$('#answers_invalid').html("");
		if(content.trim() == ''){
			$('#answers_invalid').show();
		  	$('#answers_invalid').append("<span class='glyphicon glyphicon-warning-sign'></span> <b>Giá trị nhập không được để trống</b><br/>");
		  	return false;
		}else{
			return true;
		}
	}
	setTinymce();
</script>

<style> #answers_invalid{display:none;}</style>