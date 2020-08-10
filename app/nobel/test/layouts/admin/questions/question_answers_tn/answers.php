<style>
.row-no-padding > [class*="col-"] {
    padding-left: 0 !important;
    padding-right: 0 !important;
}
</style>
<?php
$item = $data->getItem();
$itemAnswers = $data->getItemAnswers();
$backHref = pzk_request()->getBackHref();

?>
<div class="row"><div class="col-xs-12"><span class="title-ptnn">Yêu cầu :</span> <?php echo @$item['request']?></div></div>

<div class="row"><div class="col-xs-12"><span class="title-ptnn">Câu hỏi :</span> <?php echo @$item['name']?></div></div>

<div class="row title-ptnn"><div class="col-xs-12"> Đáp án : </div></div>
<button type="button" class="btn btn-primary margin-top-10" id="add-input-test" style="margin-left: 15px;"><span class="glyphicon glyphicon-plus-sign"></span> Add</button>
<form id="formAnswers" role="form" method="post" action="<?php echo BASE_REQUEST . '/Admin_Question2/edit_tnPost' ?>">
 	<input type="hidden" name="id" value="<?php echo @$item['id']?>" />
 	
  	<?php if($itemAnswers == NULL):?>
  	<div id="content">
  		<div class="col-xs-6 margin-top-10">
		    <div class="input-group">
		      	<span class="input-group-addon">
		      		<input class="status_value" type="radio" name="status" value="0"/>
		      	</span>
				<div class="row-no-padding">
					<div class="col-xs-6">
						<textarea class="content_value tinymce_input" name="content[]"  aria-required="true" aria-invalid="false"></textarea>
					</div>
					<div class="col-xs-6">
						<textarea class="content_value tinymce_input" name="content_vn[]"  aria-required="true" aria-invalid="false"></textarea>
					</div>
				</div>
				<input type="hidden" name="addAnswer[]" value="0" />
		    </div>
		</div>
  	</div>
	<div class="hidden">
  	<div class="row title-ptnn"><div class="col-xs-12 margin-top-10">Câu hoàn chỉnh  : </div></div>
	<div class="form-group col-xs-12">
		<textarea id="content_full" class="form-control" rows="2" name="content_full" aria-required="true" aria-invalid="false"></textarea>
    </div>
	</div>

    <div class="row title-ptnn"><div class="col-xs-12 margin-top-10">Giải thích  : </div></div>
	<div class="form-group col-xs-12">
		<textarea id="recommend" class="form-control tinymce_input" rows="2" name="recommend" aria-required="true" aria-invalid="false"></textarea>
    </div>

  	<?php else:?>
  		<div id="content">
  			<?php foreach($itemAnswers as $key =>$value):?>
	  		<div class="col-xs-6 margin-top-10 element-input">
			    <div class="input-group">
			      	<span class="input-group-addon">
			      		<input class="status_value" type="radio" name="status" <?php if($value['status'] == 1){ echo 'checked = "1"';}?> value="<?php echo @$value['id']?>"/>
			      	</span>
					<div class="row-no-padding">
						<div class="col-xs-6">
							<textarea class="form-control content_value tinymce_input" name="content[<?php echo @$value['id']?>]"  aria-required="true" aria-invalid="false"><?=$value['content']?></textarea>
						</div>
						<div class="col-xs-6">
							<textarea class="form-control content_value tinymce_input" name="content_vn[<?php echo @$value['id']?>]"  aria-required="true" aria-invalid="false"><?=@$value['content_vn']?></textarea>
						</div>
					</div>
			    </div>
			    <div class="remove-input"><a href="javascript:void(0)" class="color_delete" title="Xóa" onclick="remove(<?php echo @$value['id']?>);"><span class="glyphicon glyphicon-remove-circle"></span></a></div>
			</div>
			<?php $i = $value['id'];?>
  			<?php endforeach;?>
  		</div>

  		<?php foreach($itemAnswers as $key =>$value):?>
  			<?php if($value['status'] ==1):?>
	  		<div class="row title-ptnn"><div class="col-xs-12 margin-top-10">Giải thích  : </div></div>
		  	<div class="form-group col-xs-12">
		  		<textarea id="recommend" class="form-control tinymce_input" rows="2" name="recommend" aria-required="true" aria-invalid="false"><?=$value['recommend']?></textarea>
		  	</div>
			<div class="row title-ptnn hidden"><div class="col-xs-12 margin-top-10">Câu hoàn chỉnh  : </div></div>
			<div class="form-group col-xs-12 hidden">
				<textarea id="content_full" class="form-control" rows="2" name="content_full" aria-required="true" aria-invalid="false"><?=$value['content_full']?></textarea>
		    </div>
		    <?php endif;?>
	    <?php endforeach;?>
  	<?php endif;?>

  	<div id="answers_invalid" class="color-warning col-xs-12 margin-top-10">
	</div>
	
  	<div class="row margin-top-20" style="position: fixed; bottom: 50px; background: #555; width: 100%; padding: 10px;">
	  	<div class="col-xs-12">
			<button type="submit" class="btn btn-primary" onclick = "return validate_answers()" ><span class="glyphicon glyphicon-save"></span> Cập nhật</button>
			<?php if(${'backHref'}): ?>
			<a class="btn btn-default" href="<?php echo $backHref ?>">Quay Lại</a>
			<?php else: ?>
			<a class="btn btn-default" href="<?php echo BASE_REQUEST . '/' ?><?php  echo pzk_request()->getController(); ?>/<?php echo @$item['questionId']?>">Quay Lại</a>
			<?php endif; ?>
		</div>
	</div>
</form>

<script>
	<?php if(isset($i)):?>
		var i = <?=$i;?>;
	<?php else:?>
		var i = 0;
	<?php endif;?>
	var add = 0;
	
	$("#add-input-test" ).click(function() {
		i++;
		addRow(i);
		
	});

	function addRow(i) {
		/*var valueId = <?php if($itemAnswers != NULL) echo $value['id']; else echo -1;?>;
		add++;
		valueId = valueId +add;*/
		//$('#formAnswers').append('<input type="hidden" name="addAnswer[]" value="'+valueId+'" />');
	    var div = document.createElement('div');

	    div.className = 'col-xs-6 margin-top-10 element-input';

	    div.innerHTML = '<div class="input-group">\
	    					<span class="input-group-addon">\
	    						<input class="status_value" type="radio" name="status" value="'+i+'"/>\
	    					</span>\
							<div class="row-no-padding">\
							<div class="col-xs-6">\
	    					<textarea class="form-control content_value tinymce_input" name="content['+i+']"  aria-required="true" aria-invalid="false"></textarea>\
							</div>\
							<div class="col-xs-6">\
							<textarea class="form-control content_value tinymce_input" name="content_vn['+i+']"  aria-required="true" aria-invalid="false"></textarea>\
							</div>\
							</div>\
	        			</div><input type="hidden" name="addAnswer[]" value="'+i+'" />\
	        			<div class="remove-input"><a href="javascript:void(0)" class="color_delete" title="Xóa" onclick="remove('+i+')"><span class="glyphicon glyphicon-remove-circle"></span></a></div>';

	     document.getElementById('content').appendChild(div);
	     setInputTinymce();
	}
	function remove(row){
		$('#formAnswers').append('<input type="hidden" name="delAnswer[]" value="'+row+'" />');
		row--;
	}
	function validate_answers(){

		var content = [];
		var content_validate = true;
		var status = true;

		/* $(".content_value").each(function() {
			content.push(($(this).val()).trim());
		}); */
		$(".content_value").each(function() {
			content.push(tinyMCE.activeEditor.getContent({format : 'text'}));
		});
		$('#answers_invalid').html("");
		status = $('input[name=status]:checked').val();

		if(status == undefined){
			$('#answers_invalid').show();
			$('#answers_invalid').append("<span class='glyphicon glyphicon-warning-sign'></span><b> Chưa chọn đáp án đúng ! </b><br/>");
		}

		$.each(content, function(key, value) {
		  	if(value ==''){
			  	$('#answers_invalid').show();
			  	$('#answers_invalid').append("<span class='glyphicon glyphicon-warning-sign'></span> <b>Giá trị nhập không được để trống ở vị trí số "+(key+1)+"</b><br/>");
			  	content_validate = false;
			}
		});

		if(status != undefined && content_validate == true){
			return true;
		}

		return false;
	}


	$("#content").on("click", '.remove-input', function(e){
		 $(this).parent().remove();
		 

	});
    <?php if(pzk_request()->getSoftwareId() == 1) { ?>
	    setInputTinymce(2);
    <?php } else { ?>
        setInputTinymce();
    <?php } ?>

</script>
<style>
	#answers_invalid{display:none;}
	#content .input-group .form-control {width:91%}
	.element-input{position:relative;}
	.remove-input{position: absolute;top:0;right:15px;padding-top:6px;}
</style>
