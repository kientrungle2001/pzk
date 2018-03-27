<?php
$item = $data->getItem();
$itemAnswers = $data->getItemAnswers();
?>
<div class="row"><div class="col-xs-12"><span class="title-ptnn">Yêu cầu :</span> {item[request]}</div></div>

<div class="row"><div class="col-xs-12"><span class="title-ptnn">Câu hỏi :<br/></span> {item[name]}</div></div>

<div class="row title-ptnn"><div class="col-xs-12"> Đáp án :</div></div>
<button type="button" class="btn btn-primary margin-top-10" id="add-input-test" style="margin-left: 15px;"><span class="glyphicon glyphicon-plus-sign"></span> Add</button>
<form role="form" method="post" action="{url /Admin_Question2/edit_tn20Post}">
 	<input type="hidden" name="id" value="{item[id]}" />
  	<div id="content">
	<?php 
	if($itemAnswers):
	foreach($itemAnswers as $answer):?>
  	<div class="form-group col-xs-3 margin-top-10">
		
		<input type="text" name="content[]" class="form-control" value="<?=html_escape($answer['content']);?>"/>
		<div class="remove-input"><a href="javascript:void(0)" class="color_delete" title="Xóa"><span class="glyphicon glyphicon-remove-circle"></span></a></div>
	</div>
	
	<?php endforeach;?>
	<?php else:?>
	<div class="form-group col-xs-3 margin-top-10">
		
		<input type="text" name="content[]" class="form-control" />
		<div class="remove-input"><a href="javascript:void(0)" class="color_delete" title="Xóa"><span class="glyphicon glyphicon-remove-circle"></span></a></div>
	</div>
	<?php endif;?>
	</div>
  	<div id="answers_invalid" class="color-warning col-xs-12 margin-top-10">
	</div>
	<div class="row title-ptnn"><div class="col-xs-12 margin-top-10">Giải thích  : </div></div>
  	<div class="form-group col-xs-12">
  		<textarea id="explaination" class="form-control" rows="2" name="explaination" aria-required="true" aria-invalid="false"><?= html_escape($item['explaination']);?></textarea>
  	</div>
  	<div class="margin-top-20">
	  	<div class="col-xs-4">
			<button type="submit" class="btn btn-primary" onclick = "return validate_answers()"><span class="glyphicon glyphicon-save"></span> Cập nhật</button>
			<a class="btn btn-default" href="{url /Admin_Question2}/{item[questionId]}">Quay Lại</a>
		</div>
	</div>
</form>

<script>
	<?php if(isset($i)):?>
		var i = <?=$i;?>;
	<?php else:?>
		var i = 0;
	<?php endif;?>
	$("#add-input-test" ).click(function() {
		i++;
		addRow(i);
	});

	function addRow(i) {

	    var div = document.createElement('div');

	    div.className = 'form-group col-xs-3 margin-top-10';

	    div.innerHTML = '<input type="text" name="content[]" class="form-control" />\
		<div class="remove-input"><a href="javascript:void(0)" class="color_delete" title="Xóa"><span class="glyphicon glyphicon-remove-circle"></span></a></div>';

	     document.getElementById('content').appendChild(div);
	     setInputTinymce();
	}
	
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
	$("#content").on("click", '.remove-input', function(e){
		 $(this).parent().remove();
	});
</script>

<style>
	#answers_invalid{display:none;}
</style>