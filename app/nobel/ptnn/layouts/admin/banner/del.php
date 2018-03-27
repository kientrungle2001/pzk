<?php $item = $data->getItem(); 
$parents = _db()->select('*')->from('banner')->result();
?>
<form role="form" method="post" action="{url /admin_banner/delPost}">
  <input type="hidden" name="id" value="{item[id]}" />
  <div class="form-group">
    <label for="name">Bạn có chắc là muốn xóa banner này?</label>
    <input type="text" disabled class="form-control" id="name" name="name" placeholder="Tên danh mục" value="{item[title]}">
  </div>
  
  <button type="submit" class="btn btn-primary">Đúng</button>
  <a href="{url /admin_banner/index}">Không, quay lại</a>
</form>