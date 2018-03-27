<?php $item = $data->getItem(); ?>
<form role="form" method="post" action="{url /admin_answers/editPost}">
  <input type="hidden" name="id" value="{item[id]}" />
  <input type="hidden" name="questionId" value="{item[questionId]}" />
  <div class="form-group">
    <label for="value">Câu trả lời</label>
    <input type="text" class="form-control" id="value" name="value" placeholder="Câu trả lời" value="{item[value]}">
  </div>
  <div class="form-group"><?php 
		$selected0 = ''; $selected1 = ''; 
		$selectedField = 'selected'.$item['valueTrue'];
		$$selectedField = 'selected';
		?>
    <label for="valueTrue">Câu trả lời đúng</label>
    <select class="form-control" id="valueTrue" name="valueTrue" placeholder="Chọn câu trả lời" value="{item[status]}">
		<option value="0" {selected0}>Sai</option>
		<option value="1" {selected1}>Đúng</option>
	</select>
  </div>
  <button type="submit" class="btn btn-primary">Cập nhật</button>
  <a href="{url /admin_questions/detail}/{item[questionId]}">Quay lại</a>
</form>