<?php
$item = $data->getItem();
?>
<h3><?php echo html_escape($item['title'])?></h3>
<div>
<?php echo $item['content']?>
</div>