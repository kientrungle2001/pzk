<?php
$item = $data->getItem();
$categories = $data->getCategories();
$categoryTag = $data->get('categoryTag');
$delimiter = $data->get('delimiter');
?>
<div class="row">
<?php foreach($categories as $cat): ?>
	<a href="/<?php  echo $cat->get('alias') ?>"><<?php echo $categoryTag ?> class="breadcrumbs"><?php  echo $cat->get('name') ?></<?php echo $categoryTag ?>></a> <?php echo $delimiter ?>
<?php endforeach; ?>
</div>