<?php $item = $data->getItem(); ?>
<form role="form" method="post" action="<?php echo BASE_REQUEST . '/admin_answers/editPost' ?>">
  <input type="hidden" name="id" value="<?php echo @$item['id']?>" />
  <input type="hidden" name="questionId" value="<?php echo @$item['questionId']?>" />
  <div class="form-group">
    <label for="value">Câu trả lời</label>
    <input type="text" class="form-control" id="value" name="value" placeholder="Câu trả lời" value="<?php echo @$item['value']?>">
  </div>
  <div class="form-group"><?php 
		$selected0 = ''; $selected1 = ''; 
		$selectedField = 'selected'.$item['valueTrue'];
		$$selectedField = 'selected';
		?>
    <label for="valueTrue">Câu trả lời đúng</label>
    <select class="form-control" id="valueTrue" name="valueTrue" placeholder="Chọn câu trả lời" value="<?php echo @$item['status']?>">
		<option value="0" <?php echo $selected0 ?>>Sai</option>
		<option value="1" <?php echo $selected1 ?>>Đúng</option>
	</select>
  </div>
  <button type="submit" class="btn btn-primary">Cập nhật</button>
  <a href="<?php echo BASE_REQUEST . '/admin_questions/detail' ?>/<?php echo @$item['questionId']?>">Quay lại</a>
</form>