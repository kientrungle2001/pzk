<?php $item = $data->getItem(); 
?>
<form role="form" method="post" action="{url /admin_answers/delPost}">
  <input type="hidden" name="id" value="{item[id]}" />
  <div class="form-group">
    <label for="value">Bạn có chắc là muốn xóa câu trả lời?</label>
    <input type="text" disabled class="form-control" id="value" name="value" placeholder="Câu trả lời" value="{item[value]}">
  </div>
  <button type="submit" class="btn btn-primary">Đúng</button>
  <a href="{url /admin_questions/detail}/{item[questionId]}">Không, quay lại</a>
</form>