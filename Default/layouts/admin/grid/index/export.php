<?php
$exportFields = $data->getExportFields();

$controller = pzk_request()->getController();

if($exportFields){
?>
<a style="margin-right: 10px;" href="<?php echo BASE_REQUEST ?>/<?php echo $controller ?>/exportExcel" class="btn  btn-sm pull-right btn-success">
	<span class="glyphicon glyphicon-export"></span>
	Export
</a>

<?php } ?>