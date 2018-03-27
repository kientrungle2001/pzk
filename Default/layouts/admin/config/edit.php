<?php
$controller = pzk_controller();
$fieldSettings = pzk_request()->get('config') . 'FieldSettings';
$addFieldSettings = $controller->$fieldSettings;
$row = array();
$storeType = pzk_session()->get('storeType');
if($storeType == 'app') {
	$row = pzk_app_store()->get('config');
} else {
	$row = pzk_site_store()->get('config');
}



?>

<div class="panel panel-default">
    <div class="panel-heading">
        <b><?php echo $controller->addLabel; ?></b>
    </div>
    <div class="panel-body borderadmin">
    	<strong>Cấu hình cho: </strong>
    	<select id="storeType" name="storeType" onchange="window.location='{url /admin}_{controller.module}/changeStoreType?config={? echo pzk_request()->get('config'); ?}&storeType=' + this.value;">
    		<option value="site">Trang web</option>
    		<option value="app">Ứng dụng</option>
    	</select>
    	<script type="text/javascript">
			$('#storeType').val('{storeType}');
    	</script>
        <form id="{controller.module}AddForm" role="form" enctype="multipart/form-data" method="post" action="{url /admin}_{controller.module}/writePost?config={? echo pzk_request()->get('config'); ?}">
            <input type="hidden" name="id" value="" />

                {each $addFieldSettings as $field}
                {?
                if ($field['type'] == 'text' || $field['type'] == 'date' || $field['type'] == 'email' || $field['type'] == 'password') {
                $fieldObj = pzk_obj('Core.Db.Grid.Edit.Input');
                } else {
                $fieldObj = pzk_obj('Core.Db.Grid.Edit.' . ucfirst($field['type']));
                }

                foreach($field as $key => $val) {
                $fieldObj->set($key, $val);
                }
                $fieldObj->set('value', @$row[$field['index']]);
                $fieldObj->display();
                ?}
                {/each}

            <div class="form-group">
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-saved"></span> Cập nhật</button>
                <a class="btn btn-default" href="{url /admin}_{controller.module}/index"><span class="glyphicon glyphicon-refresh"></span> Quay lại</a>
            </div>
        </form>
    </div>
</div>
<script>
$(function() {
	setTinymce();
});

</script>