
<?php 
$parentId = $data->getParentId();
$parents = _db()->select('*')->from('banner')->result();
$row = pzk_validator()->getEditingData();
?>
<form role="form" method="post" action="<?php echo BASE_REQUEST . '/admin_banner/addPost' ?>">
  <input type="hidden" name="id" value="" />
  <div class="form-group">
    <label for="title">Tên banner</label>
    <input type="text" class="form-control" id="title" name="title" placeholder="Tên tin tức" value="<?php echo @$row['title']?>">
  </div>
  <div class="form-group">
    <label for="ngaytao">Ngày tạo</label>
    <input type="date" class="form-control" id="ngaytao" name="ngaytao" placeholder="Nhập nội dung" value="<?php echo @$row['ngaytao']?>">
  </div>
  <div class="form-group">
    <label for="url">URL</label>
    <input type="text" class="form-control" id="url" name="url" placeholder="Nhập nội dung" value="<?php echo @$row['url']?>">
  </div>
  <div class="form-group">
    <label for="code">Code</label>
    <input type="text" class="form-control" id="code" name="code" placeholder="Nhập code" value="<?php echo @$row['code']?>">
  </div>
      <button type="submit" class="btn btn-primary">Cập nhật</button>
  <a href="<?php echo BASE_REQUEST . '/admin_banner/index' ?>">Quay lại</a>

</form>
  
  