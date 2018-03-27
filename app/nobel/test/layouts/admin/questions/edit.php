<?php 
	$item = $data->getItem(); 
	$categories = _db()->select('*')->from('categories')->result();
    $tests = _db()->select('*')->from('tests')->result();
	$categories = buildArr($categories,'parent',0);
	$categoryIds = explode(',', $item['categoryIds']);
?>
<form id="questionsEditForm" role="form" method="post" action="{url /admin_questions/editAllCatePost}">
  	<input type="hidden" name="id" value="{item[id]}" />
  	<div class="form-group col-xs-12">
  		<div class="col-xs-2">
	    	<label for="name">Câu hỏi</label>
	    </div>
	    <div class="col-xs-10">
	    	<textarea id="name" class="form-control tinymce" rows="2" name="name" aria-required="true" aria-invalid="false"><?=$item["name"];?></textarea>
	    </div>
  	</div>
  	
 	<div class="form-group col-xs-12">
  		<div class="col-xs-2">
	    	<label for="request">Yêu cầu</label>
	    </div>
	    <div class="col-xs-10">
	    	<textarea id="request"  class="form-control" rows="2" name="request"><?=$item["request"];?></textarea>
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
            <label for="classes">Chọn lớp </label>
        </div>
        <div class="col-xs-10">
            <input class="form-control" id="classes" type="text" name="classes" value="<?=$item['classes']?>"/>
        </div>
    </div>

    <div class="form-group col-xs-12">
        <div class="col-xs-2">
            <label for="trial">Dạng người dùng</label>
        </div>
        <div class="col-xs-10">
            <input value="1" type="radio" <?php if($item['trial'] == 1) { echo 'checked'; } ?>  name="trial"/>Dùng thử
            <input value="0" type="radio" <?php if($item['trial'] == 0) { echo 'checked'; } ?>  name="trial"/> Mất phí
        </div>
    </div>
    
    <div class="form-group col-xs-12">
        <div class="col-xs-2">
            <label for="questionType">Câu hỏi dạng</label>
        </div>
        <div class="col-xs-10">
            <input value="<?=QUESTION_TYPE_CHOICE?>" type="radio" <?php if($item['questionType'] == QUESTION_TYPE_CHOICE) { echo 'checked'; } ?> name="questionType"/>Trắc nghiệm
            <input value="<?=QUESTION_TYPE_FILL?>" type="radio"   <?php if($item['questionType'] == QUESTION_TYPE_FILL) { echo 'checked'; } ?> name="questionType"/> Tự luận điền đáp án
            <input value="<?=QUESTION_TYPE_FILL_JOIN?>" type="radio"   <?php if($item['questionType'] == QUESTION_TYPE_FILL_JOIN) { echo 'checked'; } ?> name="questionType"/> Tự luận điền từ
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

    <div class="form-group col-xs-12">
        <div class="col-xs-2">
            <label for="testId">Chọn đề thi</label>
        </div>
        <div class="col-xs-10">
            <select multiple class="form-control" id="testId" name="testId[]" placeholder="Đề thi" >
                <?php $arTestId = explode(',', $item['testId']); ?>
                {each $tests as $val}
                <?php
                $selected = '';
                if(in_array($val['id'], $arTestId)) {
                    $selected = 'selected="selected"';
                }
                ?>
                <option {selected} value="{val[id]}">{val[name]}</option>
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
    <?php if(pzk_request('softwareId') == 1) { ?>
        setTinymce(2);
    <?php } else { ?>
        setTinymce();
    <?php } ?>
	

</script>