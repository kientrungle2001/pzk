<?php
$exportFields = $data->get('exportFields');

$controller = pzk_request()->get('controller');

if($exportFields){
?>
<a style="margin-right: 10px;" href="{url}/{controller}/exportExcel" class="btn  btn-sm pull-right btn-success">
	<span class="glyphicon glyphicon-export"></span>
	Export
</a>

<?php } ?>