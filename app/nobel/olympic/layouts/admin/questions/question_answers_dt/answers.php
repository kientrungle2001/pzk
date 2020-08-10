<?php
$item = $data->getItem();
$itemAnswers = $data->getItemAnswers();
?>
<div class="row"><div class="col-xs-12"><span class="title-ptnn">Yêu cầu :</span> <?php echo @$item['request']?></div></div>

<div class="row"><div class="col-xs-12"><span class="title-ptnn">Câu hỏi :</span> <?php echo @$item['name']?></div></div>

<div class="row title-ptnn"><div class="col-xs-12"> Đáp án : </div></div>
	 
<form role="form" method="post" action="<?php echo BASE_REQUEST . '/admin_questions/edit_tnPost' ?>">
 	<input type="hidden" name="id" value="<?php echo @$item['id']?>" />
  	<?php if($itemAnswers == null):?>
  	<div id="content">
  		<div class="col-xs-3 margin-top-10">
		    <div class="input-group">
		      	<span class="input-group-addon">
		      		<input class="status_value" type="radio" name="status" value="0"/>
		      	</span>
		      	<input type="text" name="content[]" class="form-control"/>
		    </div>
		</div>		
  	
  		<div class="col-xs-3 margin-top-10">
		    <div class="input-group">
		      	<span class="input-group-addon">
		      		<input class="status_value" type="radio" name="status" value="1"/>
		      	</span>
		      	<input type="text" name="content[]" class="form-control"/>
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
    
    
    <?php else :?>
    <div id="content">
  		<div class="col-xs-3 margin-top-10">
		    <div class="input-group">
		      	<span class="input-group-addon">
		      		<input class="status_value" type="radio" name="status" <?php if($itemAnswers[0]['status'] == 1){ echo 'checked = "1"';}?> value="0"/>
		      	</span>
		      	<input type="text" name="content[]" class="form-control content_value" value="<?=$itemAnswers[0]['content']?>"/>
		    </div>
		</div>		
  	
  		<div class="col-xs-3 margin-top-10">
		    <div class="input-group">
		      	<span class="input-group-addon">
		      		<input class="status_value" type="radio" name="status" <?php if($itemAnswers[1]['status'] == 1){ echo 'checked = "1"';}?> value="1"/>
		      	</span>
		      	<input type="text" name="content[]" class="form-control content_value" value="<?=$itemAnswers[1]['content']?>"/>
		    </div>
		</div>		
  	</div>
  	<?php foreach($itemAnswers as $key => $value):?>
  		<?php if($value['status'] ==1):?>
	  		<div class="row title-ptnn"><div class="col-xs-12 margin-top-10">Câu hoàn chỉnh  : </div></div>
			<div class="form-group col-xs-12">
				<textarea id="content_full" class="form-control" rows="2" name="content_full" aria-required="true" aria-invalid="false"><?=$value['content_full']?></textarea>
		    </div>
		    
		    <div class="row title-ptnn"><div class="col-xs-12 margin-top-10">Giải thích  : </div></div>
			<div class="form-group col-xs-12">
				<textarea id="recommend" class="form-control" rows="2" name="recommend" aria-required="true" aria-invalid="false"><?=$value['recommend']?></textarea>
		    </div>
  		<?php endif;?>
	<?php endforeach;?>
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

<style>
	#answers_invalid{display:none;}
</style>
