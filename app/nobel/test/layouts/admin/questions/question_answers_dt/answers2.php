<?php
$item = $data->getItem();
$itemAnswers = $data->getItemAnswers();
?>
<div class="row"><div class="col-xs-12"><span class="title-ptnn">Yêu cầu :</span> <?php echo @$item['request']?></div></div>

<div class="row"><div class="col-xs-12"><span class="title-ptnn">Câu hỏi :</span> <?php echo @$item['name']?></div></div>

<div class="row title-ptnn"><div class="col-xs-12"> Đáp án : </div></div>
<button type="button" class="btn btn-primary margin-top-10" id="add-input-test" style="margin-left: 15px;"><span class="glyphicon glyphicon-plus-sign"></span> Add</button>	 
<form role="form" method="post" action="<?php echo BASE_REQUEST . '/admin_questions/edit_tn2Post' ?>">
 	<input type="hidden" name="id" value="<?php echo @$item['id']?>" />
  	<?php if($itemAnswers == NULL):?>
  	<div id="content">
  		<div class="col-xs-3 margin-top-10">
		    <div class="input-group">
		      	<input type="text" name="content[]" class="form-control content_value"/>
		    </div>
		</div>
  	</div>
  	<div class="row title-ptnn"><div class="col-xs-12 margin-top-10">Câu hoàn chỉnh  : </div></div>
	<div class="form-group col-xs-12">
		<textarea id="content_full" class="form-control" rows="2" name="content_full" aria-required="true" aria-invalid="false"></textarea>
    </div>
  	
  	<div class="row title-ptnn"><div class="col-xs-12 margin-top-10">Giải thích  : </div></div>
	<div class="form-group col-xs-12">
		<textarea id="recommend" class="form-control" rows="2" name="recommend" aria-required="true" aria-invalid="false"></textarea>
    </div>
  	<?php else:?>
  		<div id="content">
  			<?php foreach($itemAnswers as $key =>$value):?>
	  		<div class="col-xs-3 margin-top-10 element-input">
			    <div class="input-group">
			      	<input type="text" name="content[]" class="form-control content_value" value="<?=$value['content']?>"/>
			    </div>
			    <div class="remove-input"><a href="javascript:void(0)" class="color_delete" title="Xóa"><span class="glyphicon glyphicon-remove-circle"></span></a></div>		    
			</div>
			<?php $i = $key;?>
  			<?php endforeach;?>
  		</div>
  		
  		<div class="row title-ptnn"><div class="col-xs-12 margin-top-10">Câu hoàn chỉnh  : </div></div>
		<div class="form-group col-xs-12">
			<textarea id="content_full" class="form-control" rows="2" name="content_full" aria-required="true" aria-invalid="false"><?=$itemAnswers[0]['content_full']?></textarea>
	    </div>
	    
	    <div class="row title-ptnn"><div class="col-xs-12 margin-top-10">Giải thích  : </div></div>
	  	<div class="form-group col-xs-12">
	  		<textarea id="recommend" class="form-control" rows="2" name="recommend" aria-required="true" aria-invalid="false"><?=$itemAnswers[0]['recommend']?></textarea>
	  	</div>
  	<?php endif;?>
  	
  	<div id="answers_invalid" class="color-warning col-xs-12 margin-top-10">
	</div>
	
  	<div class="margin-top-20">
	  	<div class="col-xs-4">
			<button type="submit" class="btn btn-primary" onclick = "return validate_answers()" ><span class="glyphicon glyphicon-save"></span> Cập nhật</button>
			<a class="btn btn-default" href="<?php echo BASE_REQUEST . '/admin_questions' ?>/<?php echo @$item['questionId']?>">Quay Lại</a>
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

	    div.className = 'col-xs-3 margin-top-10 element-input';
		
	    div.innerHTML = '<div class="input-group">\
	    					<input type="text" name="content[]" class="form-control content_value"/>\
	        			</div>\
	        			<div class="remove-input"><a href="javascript:void(0)" class="color_delete" title="Xóa"><span class="glyphicon glyphicon-remove-circle"></span></a></div>';
		
	     document.getElementById('content').appendChild(div);
	}

	function validate_answers(){
		
		var content = [];
		var content_validate = true;
		
		$(".content_value").each(function() {
			content.push(($(this).val()).trim());
		});
		
		$('#answers_invalid').html("");
		$.each(content, function(key, value) {
		  	if(value ==''){
			  	$('#answers_invalid').show();
			  	$('#answers_invalid').append("<span class='glyphicon glyphicon-warning-sign'></span> <b>Giá trị nhập không được để trống ở vị trí số "+(key+1)+"</b><br/>");
			  	content_validate = false;
			}
		});
		
		if(content_validate == true){
			return true;
		}
		
		return false;
	}
	
	$("#content").on("click", '.remove-input', function(e){
		 $(this).parent().remove();
	});

	
</script>
<style>
	#answers_invalid{display:none;}
	#content .input-group .form-control {width:91%}
	.element-input{position:relative;}
	.remove-input{position: absolute;top:0;right:15px;padding-top:6px;}
</style>