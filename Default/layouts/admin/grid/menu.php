<?php
return false;
$controller = pzk_request()->getController();
$action = pzk_request()->getAction();
$multiple = pzk_request()->getMultiple();
$setting = pzk_controller();
$updateData = $setting->updateData;
?>

<ul class="nav nav-stack">
    <li class="panel-default">
        <div class="panel-heading"><b>Menu</b></div>
    </li>
	<li class="success <?php if($action =='index') { echo 'active'; } ?>">

    <a href="<?php echo BASE_REQUEST . '/' ?><?php echo $controller ?>/index"><span class="glyphicon glyphicon-list"></span> Danh sách</a>
    </li>
	<?php if(isset($setting->addFields) && $setting->addFields) { ?>
    <li class="success <?php if($action =='add' && !$multiple) { echo 'active'; } ?>">
	<a href="<?php echo BASE_REQUEST . '/' ?><?php echo $controller ?>/add"><span class="glyphicon glyphicon-plus"></span> Thêm mới</a>
    </li>
	<?php if(0): ?>
	<li class="success <?php if($action =='add' && $multiple) { echo 'active'; } ?>">
	<a href="<?php echo BASE_REQUEST . '/' ?><?php echo $controller ?>/add?multiple=1"><span class="glyphicon glyphicon-plus"></span> <span class="glyphicon glyphicon-plus"></span> Thêm nhiều</a>
    </li>
	<?php endif; ?>
	<?php } ?>
    <?php
    if($setting->menuLinks) {
        foreach($setting->menuLinks as $val) {
            $tam = explode('/', $val['href']);
            $controllerlink = $tam[1];
            $linkaction = end($tam);
            ?>
			<li class="success">
            <a class="<?php if($action == $linkaction && $controller == $controllerlink) { echo 'active'; } ?>" href="<?php echo @$val['href']?>"><?php echo @$val['name']?></a>
			</li>
		<?php
        }
    }
    ?>
</ul>

<?php if($updateData && pzk_request()->getAction()=='index') { ?>
<div id="showmenucate">
    <?php
        foreach ($updateData as $item) {
            $fieldObj = pzk_obj('Core.Db.Grid.Menu.' . ucfirst($item['type']));
            foreach($item as $key=>$val) {
                $fieldObj->set($key, $val);
            }
            $fieldObj->display();

        }

    ?>

</div>
<?php } ?>
<br />