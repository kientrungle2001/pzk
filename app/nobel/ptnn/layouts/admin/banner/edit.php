<?php $item = $data->getItem(); 
$row = pzk_validator()->getEditingData();
if($row) {
	$item = array_merge($item, $row);
}
$parents = _db()->select('*')->from('banner')->result();
?>
<form role="form" method="post" action="{url /admin_banner/editPost}">
  <input type="hidden" name="id" value="{item[id]}" />
  <div class="form-group">
    <label for="title">Tên banner</label>
    <input type="text" class="form-control" id="title" name="title" placeholder="Tên banner" value="{item[title]}">
  </div>
<div class="form-group">
    <label for="ngaytao">Ngày tạo</label>
    <input type="date" class="form-control" id="ngaytao" name="ngaytao" placeholder="Ngày tạo" value="{item[ngaytao]}">
  </div>
  <div class="form-group">
    <label for="url">URL</label>
    <input type="text" class="form-control" id="url" name="url" placeholder="Ngày tạo" value="{item[url]}">
  </div>
  <div class="form-group">
    <label for="code">Code</label>
    <input type="text" class="form-control" id="code" name="code" placeholder="Nhập lại code" value="{item[code]}">
		  </div>
  <button type="submit" class="btn btn-primary">Cập nhật</button>
  <a href="{url /admin_banner/index}">Quay lại</a>
</form>