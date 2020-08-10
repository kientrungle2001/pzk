<?php $item = $data->getItem(); 
$parents = _db()->select('*')->from('banner')->result();
?>
<form role="form" method="post" action="<?php echo BASE_REQUEST . '/admin_banner/delPost' ?>">
  <input type="hidden" name="id" value="<?php echo @$item['id']?>" />
  <div class="form-group">
    <label for="name">Bạn có chắc là muốn xóa banner này?</label>
    <input type="text" disabled class="form-control" id="name" name="name" placeholder="Tên danh mục" value="<?php echo @$item['title']?>">
  </div>
  
  <button type="submit" class="btn btn-primary">Đúng</button>
  <a href="<?php echo BASE_REQUEST . '/admin_banner/index' ?>">Không, quay lại</a>
</form>