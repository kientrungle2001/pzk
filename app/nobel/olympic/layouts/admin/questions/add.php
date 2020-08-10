<?php 
$categories = _db()->select('*')->from('categories')->result(); 
$categories = buildArr($categories,'parent',0);
$questionTypes = _db()->select('*')->from('questiontype')->result();
?>
<form id="questionsAddForm" role="form" method="post" action="<?php echo BASE_REQUEST . '/admin_questions/addPost' ?>">
    <input type="hidden" name="software" value="<?php echo pzk_request()->getSoftwareId(); ?>" />
  	<input type="hidden" name="id" value="" />
  	<div class="form-group col-xs-12">
	  	<div class="col-xs-2">
	    	<label for="name">Câu hỏi</label>
	    </div>
	    <div class="col-xs-10">
	    	<textarea id="name" class="form-control tinymce_input" rows="5" name="name"></textarea>
	    </div>
 	</div>
 	
 	<div class="form-group col-xs-12">
	  	<div class="col-xs-2">
	    	<label for="type">Loại câu hỏi</label>
	    </div>
	    <div class="col-xs-10">
		    <select class="form-control" id="type" name="type" onchange="request_question()">
		        <option value="">-- Loại câu hỏi --</option>
				<?php $question_types = $data->getQuestionType();?>
				<?php if(isset($question_types)):?>
					<?php foreach($question_types as $key	=>$value):?>
						<option value="<?=$value['question_type']?>" data-request="<?=$value['request']?>" type_id="<?=$value['id']?>" class="padding-left-10"> <?=$value['name']?></option>
					<?php endforeach;?>
				<?php endif;?>
			</select>
		</div>
  	</div>
  	
  	<input type="hidden" id="type_id" name="type_id" />
  	
  	<div class="form-group col-xs-12">
  		<div class="col-xs-2">
	    	<label for="request">Yêu cầu</label>
	    </div>
	    <div class="col-xs-10">
	    	<input type="text" id="type_id" name="exnum" />
	    </div>
  	</div>
	
	<div class="form-group col-xs-12">
  		<div class="col-xs-2">
	    	<label for="request">Bài Tập</label>
	    </div>
	    <div class="col-xs-10">
	    	<textarea id="request" style="background-color:#EEEEEE" class="form-control" rows="2" name="request"></textarea>
	    </div>
  	</div>
  	
  	<div class="form-group col-xs-12">
	  	<div class="col-xs-2">
	    	<label for="topic_id">Loại chủ đề</label>
	    </div>
	    <div class="col-xs-10">
		    <select multiple="multiple" class="form-control" id="topic_id" name="topic_id[]">
		        <?php  $topics = $data->getTopics(); ?>
				<?php if(isset($topics)):?>
					<?php foreach($topics as $key =>$value):?>
						<option value="<?=$value['id']?>" class="padding-left-10"> <?=$value['name']?></option>
					<?php endforeach;?>
				<?php endif;?>
			</select>
		</div>
  	</div>
  	
    <div class="form-group col-xs-12">
        <div class="col-xs-2">
        	<label for="level">Mức độ câu hỏi</label>
        </div>
        <div class="col-xs-10">
	        <select class="form-control" id="level" name="level" placeholder="Loại" value="<?php echo @$item['level']?>">
	            <option value="">-- Chọn mức độ câu hỏi --</option>
	            <option value="<?=EASY;?>">Dễ</option>
	            <option value="<?=NORMAL?>">Bình thường</option>
	            <option value="<?=HARD?>">Khó</option>
	            <option value="<?=VERYHARD?>">Rất khó</option>
                <option value="<?=SUPERHARD?>">Nâng cao</option>
	        </select>
        </div>
        <script>
            $('#type').val('<?php echo @$item['type']?>');
        </script>
    </div>
  	<div class="form-group col-xs-12">
  		<div class="col-xs-2">
	    	<label for="categoryIds">Danh mục</label>
	    </div>
	    <div class="col-xs-10">
		    <select multiple="multiple" class="form-control" id="categoryIds" name="categoryIds[]" placeholder="Danh mục" value="<?php echo @$item['categoryIds']?>" style="height: 300px">
			<?php foreach($categories as $cat): ?>
			<?php 
			$tab = '&nbsp;&nbsp;&nbsp;&nbsp;';	
			$tabs = str_repeat($tab, $cat['level']);
			$catName = $tabs.$cat['name'];
			?>
			<option value="<?php echo @$cat['id']?>"><?php echo $catName ?></option>
			<?php endforeach; ?>
			</select>
		</div>
  	</div>
  	<div class="col-xs-12">
  		<div class="col-xs-4 col-xs-offset-2">
		  	<button type="submit" class="btn btn-primary"> <span class="glyphicon glyphicon-save"></span> Cập nhật</button>
		  	<a class="btn btn-default" href="<?php echo BASE_REQUEST . '/admin_questions/index' ?>">Quay lại</a>
		</div>
  	</div>
</form>
<?php 
$addValidator = json_encode(pzk_controller()->addValidator);
?>
<script>
	$('#questionsAddForm').validate(<?php echo $addValidator ?>);
	//setTinymce();
	setInputTinymce();
	function request_question(){
		var data_request = $('#type option:selected').attr('data-request');
		$('#request').val(data_request);

		var type_id = $('#type option:selected').attr('type_id');
		$('#type_id').val(type_id);
	}
</script>