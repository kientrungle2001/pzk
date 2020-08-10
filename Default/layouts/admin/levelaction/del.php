<?php $item = $data->getItem();
?>
<form role="form" method="post" action="<?php echo BASE_REQUEST . '/admin_levelaction/delPost' ?>">
    <input type="hidden" name="id" value="<?php echo @$item['id']?>" />
    <div class="form-group">
        <label for="name">Bạn có chắc muốn xóa ?</label>
        <input type="text" disabled class="form-control" id="action_type" name="action_type"  value="<?php echo @$item['action_type']?>" />
    </div>
    <button type="submit" class="btn btn-primary">Đúng</button>
    <a href="<?php echo BASE_REQUEST . '/admin_levelaction/index' ?>">Không, quay lại</a>
</form>