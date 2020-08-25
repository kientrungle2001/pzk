<?php
$controller = pzk_controller();
$testName = $data->getTestName();
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <b>Import dữ liệu</b>
    </div>
    <div class="panel-body borderadmin">
<form enctype="multipart/form-data" method="post">
	<h2><?=$testName;?></h2>
    <div class="form-group clearfix">
        <label for="imports">Chọn file(excel)</label>
        <input name="file" type="file"/>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Cập nhật" />
        <a class="btn btn-default" href="<?php echo BASE_REQUEST . '/Admin' ?>_<?php echo @$controller->module?>/index"><span class="glyphicon glyphicon-refresh"></span> Quay lại</a>
    </div>
</form>
</div>
</div>