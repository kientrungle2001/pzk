<?php
$controller = pzk_request('controller');
$action = pzk_request('action');
$setting = pzk_controller();
$config = pzk_request()->get('config');
?>

<ul class="nav nav-pills nav-stacked">
	<li class="panel-default">
        <div class="panel-heading"><b>Cấu hình</b></div>
    </li>
    <?php
    if($setting->get('menuLinks')) {
        foreach($setting->get('menuLinks') as $val) {
            $tam = explode('=', $val['href']);
            $linkaction = end($tam);
            ?>
			<li class="<?php if($config == $linkaction) { echo 'active'; } ?>">
            <a href="<?php echo @$val['href']?>"><?php echo @$val['name']?></a>
			</li>
		<?php
        }
    }
    ?>
</ul>
<br />