<?php $item = $data->getItem(); 
$parents = _db()->select('*')->from('categories')->result();
$parents = buildArr($parents, 'parent', 0);
?>
<form role="form" method="post" action="<?php echo BASE_REQUEST . '/admin_category/delPost' ?>">
  <input type="hidden" name="id" value="<?php echo @$item['id']?>" />
  <div class="form-group">
    <label for="name">Bạn có chắc là muốn xóa thư mục?</label>
    <input type="text" disabled class="form-control" id="name" name="name" placeholder="Tên danh mục" value="<?php echo @$item['name']?>">
  </div>
  <div class="form-group">
    <label for="parent">Danh mục cha</label>
    <select class="form-control" disabled id="parent" name="parent" placeholder="Danh mục cha" value="<?php echo @$item['parent']?>">
		<option value="0">Danh mục gốc</option>
		<?php foreach($parents as $parent): ?>
			<?php 
			$selected = '';
			if($parent['id'] == $item['parent']) { $selected = 'selected'; }?>
			<option value="<?php echo @$parent['id']?>" <?php echo $selected ?>><?php echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $parent['level']); ?><?php echo @$parent['name']?></option>
		<?php endforeach; ?>
	</select>
  </div>
  <button type="submit" class="btn btn-primary">Đúng</button>
  <a href="<?php echo BASE_REQUEST . '/admin_category/index' ?>">Không, quay lại</a>
</form>