<?php
$controller = pzk_request()->getController();
$action = pzk_request()->getAction();
$setting = pzk_controller();
?>

<div class="list-group rightmenu">
    <div class="panel-default">
        <div class="panel-heading"><b>Menu</b></div>
    </div>

    <a class="list-group-item <?php if($action =='index') { echo 'active'; } ?>" href="<?php echo BASE_REQUEST . '/' ?><?php echo $controller ?>/index">Danh sách</a>

</div>
