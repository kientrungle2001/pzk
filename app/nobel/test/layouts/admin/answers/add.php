<form role="form" method="post" action="{url /admin_answers/addPost}">
  <input type="hidden" name="id" value="" />
  <input type="hidden" name="questionId" value="{prop questionId}" />
  <div class="form-group">
    <label for="value">Tên câu trả lời</label>
    <input type="text" class="form-control" id="value" name="value" placeholder="Tên câu trả lời" value="{_REQUEST[name]}">
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
  <a href="{url /admin_questions/detail}/{prop questionId}">Quay lại</a>
  </div>
</form>