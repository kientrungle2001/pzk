<?php 
$categories = _db()->select('*')->from('categories')->result(); 
$categories = buildArr($categories,'parent',0);
$tests = _db()->select('*')->from('tests')->result();

?>
<form id="questionsAddForm" role="form" method="post" action="<?php echo BASE_REQUEST . '/admin_questions/addPost' ?>">
  	<input type="hidden" name="id" value="" />
  	<div class="form-group col-xs-12">
	  	<div class="col-xs-2">
	    	<label for="name">Câu hỏi</label>
	    </div>
	    <div class="col-xs-10">
	    	<textarea id="name" class="form-control tinymce" rows="5" name="name"></textarea>
	    </div>
 	</div>

  	<div class="form-group col-xs-12">
  		<div class="col-xs-2">
	    	<label for="request">Yêu cầu</label>
	    </div>
	    <div class="col-xs-10">
	    	<textarea id="request" class="form-control" rows="2" name="request"></textarea>
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
                <option value="<?=SUPERHARD?>">Nâng cao</option>
            </select>
        </div>
    </div>

    <div class="form-group col-xs-12">
        <div class="col-xs-2">
            <label for="trial">Dạng người dùng</label>
        </div>
        <div class="col-xs-10">
            <input value="1" type="radio"  name="trial"/>Dùng thử
            <input value="0" type="radio" checked  name="trial"/> Mất phí
        </div>
    </div>
    
    <div class="form-group col-xs-12">
        <div class="col-xs-2">
            <label for="questionType">Câu hỏi dạng</label>
        </div>
        <div class="col-xs-10">
            <input value="<?=QUESTION_TYPE_CHOICE?>" type="radio" checked name="questionType"/>Trắc nghiệm
            <input value="<?=QUESTION_TYPE_FILL?>" type="radio" name="questionType"/> Tự luận điền đáp án
            <input value="<?=QUESTION_TYPE_FILL_JOIN?>" type="radio" name="questionType"/> Tự luận điền từ
        </div>
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

    <div class="form-group col-xs-12">
        <div class="col-xs-2">
            <label for="testId">Chọn đề thi</label>
        </div>
        <div class="col-xs-10">
            <select multiple class="form-control" id="testId" name="testId[]" placeholder="Đề thi" >
                <?php foreach($tests as $val): ?>
                <option value="<?php echo @$val['id']?>"><?php echo @$val['name']?></option>
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
    <?php if(pzk_request()->getSoftwareId() == 1) { ?>
        setTinymce(2);
    <?php } else { ?>
        setTinymce();
    <?php } ?>
</script>