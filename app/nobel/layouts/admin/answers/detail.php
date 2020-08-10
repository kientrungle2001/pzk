<?php
$item = $data->getItem();
?>
<h3><?php echo @$item['name']?></h3>
<?php $data->displayChildren('all') ?>