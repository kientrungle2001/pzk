<?php
$files = $data->getFiles();
$module = $data->getModule();
$itemId = $data->getItemId();
$curentUrl = pzk_request()->getFile();
?>
<h4>File plugin</h4>
<ul class="nav nav-pills">
<?php foreach($files as $file): ?>
    <?php if(is_file($file)) { $url = urlencode($file); if($curentUrl == $file){ $active ="class='active'";} else {$active='';} ?>
        <li role="presentation" <?php echo $active ?>><a href="/Admin_<?php echo $module ?>/edit/<?php echo $itemId ?>?file=<?php echo BASE_REQUEST ?>"><?php echo $file ?></a></li>
    <?php }?>
<?php endforeach; ?>
</ul>
