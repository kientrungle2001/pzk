<?php
$columns = $data->getColumns();
//debug($columns);die();
?>

<div class="row">
<?php foreach($columns as $column): ?>
<div class="col-xs-<?php echo @$column['col']?>">
    <?php $data->displayChildren('[column='.$column['index'].']');?>
</div>
<?php endforeach; ?>
</div>