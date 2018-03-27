
<form id="questionsAddForm" role="form" method="post" action="{url /admin_questiontype/addPost}">
  	<input type="hidden" name="id" value="" />
  	<div class="form-group col-xs-12">
	  	<div class="col-xs-2">
	    	<label for="name">Dạng câu hỏi</label>
	    </div>
	    <div class="col-xs-8">
	    	<input type="text" class="form-control" id="name" name="name" placeholder="Tên dạng câu hỏi" />
	    </div>
 	</div>
 	
 	<div class="form-group col-xs-12">
	  	<div class="col-xs-2">
	    	<label for="request">Yêu cầu</label>
	    </div>
	    <div class="col-xs-8">
	    	<textarea class="form-control" id="request" name="request" rows="2"></textarea>
	    </div>
 	</div>
 	
 	<div class="form-group col-xs-12">
	  	<div class="col-xs-2">
	    	<label for="question_type">Mã dạng câu hỏi</label>
	    </div>
	    <div class="col-xs-4">
	    	<input type="text" class="form-control" id="question_type" name="question_type" placeholder="Mã dạng câu hỏi" />
	    </div>
 	</div>
 	
 	<div class="form-group col-xs-12">
 		<div class="col-xs-2">
 			<label for="group_question">Dạng bài tập</label><br>
 		</div>
 		<div class="col-xs-4">
	        <select id="group_question" name="group_question" class="form-control input-sm">
	        	<option value="">-- Nhóm dạng bài tập --</option>
				<option value="<?=QUESTION_WORDS?>"><?=QUESTION_WORDS?></option>
				<option value="<?=QUESTION_PHRASE?>"><?=QUESTION_PHRASE?></option>
				<option value="<?=QUESTION_PASSAGE?>"><?=QUESTION_PASSAGE?></option>
				<option value="<?=QUESTION_CITATION?>"><?=QUESTION_CITATION?></option>
	 		</select>
	 	</div>
 	</div>
	
  	<div class="form-group col-xs-12">
  		<div class="col-xs-3 col-xs-offset-2">
		  	<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span>Thêm</button>
		  	<a class="btn btn-default margin-left-10" href="{url /admin_questions/index}">Hủy</a>
	  	</div>
  	</div>
</form>
<?php 
$addValidator = json_encode(pzk_controller()->addValidator);
?>
<script>
	$('#questionsAddForm').validate({addValidator});
</script>