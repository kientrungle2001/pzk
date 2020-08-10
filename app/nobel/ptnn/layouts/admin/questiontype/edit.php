<?php 
	$item = $data->getItem();
?>
<form id="questionsEditForm" role="form" method="post" action="<?php echo BASE_REQUEST . '/admin_questiontype/editPost' ?>">

	<input type="hidden" name="id" value="<?php echo @$item['id']?>" />
  
  	<div class="form-group col-xs-12">
	  	<div class="col-xs-2">
	    	<label for="name">Dạng câu hỏi</label>
	    </div>
	    <div class="col-xs-8">
	    	<input type="text" class="form-control" id="name" name="name" placeholder="Tên dạng câu hỏi" value="<?php echo @$item['name']?>"/>
	    </div>
 	</div>
  
  	<div class="form-group col-xs-12">
	  	<div class="col-xs-2">
	    	<label for="request">Yêu cầu</label>
	    </div>
	    <div class="col-xs-8">
	    	<textarea class="form-control" id="request" name="request" rows="2"><?php echo @$item['request']?></textarea>
	    </div>
 	</div>
	
	<div class="form-group col-xs-12">
	  	<div class="col-xs-2">
	    	<label for="question_type">Mã dạng câu hỏi</label>
	    </div>
	    <div class="col-xs-4">
	    	<input type="text" class="form-control" id="question_type" name="question_type" value="<?php echo @$item['question_type']?>" />
	    </div>
 	</div>
 	
 	<div class="form-group col-xs-12">
 		<div class="col-xs-2">
 			<label for="group_question">Dạng bài tập</label><br>
 		</div>
 		<div class="col-xs-4">
	        <select id="group_question" name="group_question" class="form-control input-sm">
				<option value="<?=QUESTION_WORDS?>"><?=QUESTION_WORDS?></option>
				<option value="<?=QUESTION_PHRASE?>"><?=QUESTION_PHRASE?></option>
				<option value="<?=QUESTION_PASSAGE?>"><?=QUESTION_PASSAGE?></option>
				<option value="<?=QUESTION_CITATION?>"><?=QUESTION_CITATION?></option>
	 		</select>
	 	</div>
	 	
	 	<script type="text/javascript">
			$('#group_question').val('<?php echo @$item['group_question']?>');
		</script>
 	</div>
 	
 	
	<div class="form-group col-xs-12">
  		<div class="col-xs-3 col-xs-offset-2">
		  	<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span>Cập nhật</button>
		  	<a class="btn btn-default margin-left-10" href="<?php echo BASE_REQUEST . '/admin_questiontype/index' ?>">Quay lại</a>
		</div>
	</div>
</form>
<?php 
$editValidator = json_encode(pzk_controller()->editValidator);
?>
<script>
$('#questionsEditForm').validate(<?php echo $editValidator ?>);
</script>