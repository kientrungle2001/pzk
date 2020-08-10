<?php $item = $data->getItem(); 
?>
<form role="form" method="post" action="<?php echo BASE_REQUEST . '/admin_answers/delPost' ?>">
  <input type="hidden" name="id" value="<?php echo @$item['id']?>" />
  <div class="form-group">
    <label for="value">Bạn có chắc là muốn xóa câu trả lời?</label>
    <input type="text" disabled class="form-control" id="value" name="value" placeholder="Câu trả lời" value="<?php echo @$item['value']?>">
  </div>
  <button type="submit" class="btn btn-primary">Đúng</button>
  <a href="<?php echo BASE_REQUEST . '/admin_questions/detail' ?>/<?php echo @$item['questionId']?>">Không, quay lại</a>
</form>