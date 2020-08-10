<form role="form" method="post" action="<?php echo BASE_REQUEST . '/admin_answers/addPost' ?>">
  <input type="hidden" name="id" value="" />
  <input type="hidden" name="questionId" value="<?php echo @$data->questionId?>" />
  <div class="form-group">
    <label for="value">Tên câu trả lời</label>
    <input type="text" class="form-control" id="value" name="value" placeholder="Tên câu trả lời" value="<?php echo @$_REQUEST['name']?>">
  </div>
  <div class="form-group clearfix">
	<label for="valueTrue">Trạng thái</label>
    <select class="form-control" id="valueTrue" name="valueTrue" placeholder="Câu trả lời đúng">
		<option value="0">Sai</option>
		<option value="1">Đúng</option>
	</select>
  </div>
  <div class="form-group">
  <button type="submit" class="btn btn-primary">Cập nhật</button>
  <a href="<?php echo BASE_REQUEST . '/admin_questions/detail' ?>/<?php echo @$data->questionId?>">Quay lại</a>
  </div>
</form>