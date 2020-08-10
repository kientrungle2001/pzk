<?php $item = $data->getItem(); 
?>
<form role="form" method="post" action="<?php echo BASE_REQUEST . '/admin_questions/delPost' ?>">
  <input type="hidden" name="id" value="<?php echo @$item['id']?>" />
  <div class="form-group">
    <label for="name">Bạn có chắc là muốn xóa câu hỏi?</label>
    <input type="text" disabled class="form-control" id="name" name="name" placeholder="Tên người dùng" value="<?php echo @$item['name']?>">
  </div>
  <button type="submit" class="btn btn-primary">Đúng</button>
  <a href="<?php echo BASE_REQUEST . '/admin_questions/index' ?>">Không, quay lại</a>
</form>