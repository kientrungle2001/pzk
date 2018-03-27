<?php 
	$item = $data->getItem(); 
	$question_types = $data->getQuestionType();
	
	$categories = _db()->select('*')->from('categories')->result(); 
	$categories = buildArr($categories,'parent',0);
	$categoryIds = explode(',', $item['categoryIds']);
?>
<form id="questionsEditForm" role="form" method="post" action="{url /admin_questions/editAllCatePost}">
  	<input type="hidden" name="id" value="{item[id]}" />
    <input type="hidden" name="software" value="<?php echo pzk_request('softwareId'); ?>" />
  	<div class="form-group col-xs-12">
  		<div class="col-xs-2">
	    	<label for="name">Câu hỏi</label>
	    </div>
	    <div class="col-xs-10">
	    	<textarea id="name" class="form-control tinymce_input" rows="2" name="name" aria-required="true" aria-invalid="false"><?=$item["name"];?></textarea>
	    </div>
  	</div>
  	
  	<div class="form-group col-xs-12">
	  	<div class="col-xs-2">
	    	<label for="type">Loại câu hỏi</label>
	    </div>
	    <div class="col-xs-10">
		    <select id="type" name="type" class="form-control input-sm" onchange="request_question()">
				<?php if(isset($question_types)):?>
					<?php foreach($question_types as $key	=>$value):?>
						<option value="<?=$value['question_type']?>" data-request="<?=$value['request']?>" type_id="<?=$value['id']?>" class="padding-left-10"><?=$value['name']?></option>
					<?php endforeach;?>
				<?php endif;?>
			</select>
		</div>
		<script type="text/javascript">
			$('#type'). val('{item[type]}');
		</script>
 	</div>
 	
 	<input type="hidden" id="type_id" name="type_id" value="<?=$item['type_id'];?>"/>
 	
 	<div class="form-group col-xs-12">
  		<div class="col-xs-2">
	    	<label for="request">Yêu cầu</label>
	    </div>
	    <div class="col-xs-10">
	    	<textarea id="request" style="background-color:#EEEEEE" class="form-control" rows="2" name="request"><?=$item["request"];?></textarea>
	    </div>
  	</div>
	
	<div class="form-group col-xs-12">
  		<div class="col-xs-2">
	    	<label for="request">Yêu cầu</label>
	    </div>
	    <div class="col-xs-10">
	    	<input type="text" id="type_id" value="<?=$item['exnum']; ?>" name="exnum" />
	    </div>
  	</div>
 	
 	<div class="form-group col-xs-12">
	  	<div class="col-xs-2">
	    	<label for="topic_id">Loại chủ đề</label>
	    </div>
	    <div class="col-xs-10">
	    	
		    <select multiple="multiple" id="topic_id" name="topic_id[]" class="form-control input-sm">
		    	
		    	<?php 
		    		$topics = $data->getTopics();
		    		$array_topic = explode(',', $item['topic_id']);
		    	?>
				<?php if(isset($topics)):?>
					<?php foreach($topics as $key =>$value):?>
						<?php 
						$selected = '';
						if(in_array($value['id'], $array_topic)){
							
							$selected = 'selected="selected"';
						}
						?>
						<option value="<?=$value['id']?>" <?=$selected?>  class="padding-left-10"> <?=$value['name']?></option>
					<?php endforeach;?>
				<?php endif;?>
			</select>
		</div>
 	</div>
  	
    <div class="form-group col-xs-12">
    	<div class="col-xs-2">
        	<label for="level">Độ khó</label>
        </div>
        <div class="col-xs-10">
	        <select class="form-control input-sm" id="level" name="level" >
	            <option value="">-- Chọn mức độ câu hỏi --</option>
	            <option <?php if($item['level'] ==EASY) { echo 'selected="selected"'; } ?> value="<?=EASY?>">Dễ</option>
	            <option <?php if($item['level'] ==NORMAL) { echo 'selected="selected"'; } ?> value="<?=NORMAL?>">Bình thường</option>
	            <option <?php if($item['level'] ==HARD) { echo 'selected="selected"'; } ?> value="<?=HARD?>">Khó</option>
	            <option <?php if($item['level'] ==VERYHARD) { echo 'selected="selected"'; } ?> value="<?=VERYHARD?>">Rất Khó</option>
	            <option <?php if($item['level'] ==SUPERHARD) { echo 'selected="selected"'; } ?> value="<?=SUPERHARD?>">Nâng Cao</option>
	        </select>
        </div>
    </div>
	
  	<div class="form-group col-xs-12">
  		<div class="col-xs-2">
    		<label for="categoryIds">Danh mục</label>
    	</div>
    	<div class="col-xs-10">
	    	<select multiple="multiple" class="form-control" id="categoryIds" name="categoryIds[]" placeholder="Danh mục" value="{item[categoryIds]}" style="height: 300px">
			{each $categories as $cat}
			<?php 
			$tab = '&nbsp;&nbsp;&nbsp;&nbsp;';	
			$tabs = str_repeat($tab, $cat['level']);
			$catName = $tabs.$cat['name'];
			$selected = '';
			if(in_array($cat['id'], $categoryIds)) {
				$selected = 'selected="selected"';
			}
			?>
			<option {selected} value="{cat[id]}">{catName}</option>
			{/each}
			</select>
		</div>
  	</div>
  	<div class="col-xs-12">
  		<div class="col-xs-4 col-xs-offset-2">
		  	<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Cập nhật</button>
		  	<a class="btn btn-default" href="{url /admin_questions/index}">Quay lại</a>
	  	</div>
  	</div>
</form>
<?php 
	$editValidator = json_encode(pzk_controller()->editValidator);
	?>
	<script>
	$('#questionsEditForm').validate({editValidator});
	setInputTinymce();
	function request_question(){
		var data_request = $('#type option:selected').attr('data-request');
		$('#request').val(data_request);

		var type_id = $('#type option:selected').attr('type_id');
		$('#type_id').val(type_id);
	}
</script>