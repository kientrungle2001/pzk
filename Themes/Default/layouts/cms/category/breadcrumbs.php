<?php
$item = $data->getItem();
$categories = $data->getCategories();
$categoryTag = $data->getCategoryTag();
$delimiter = $data->getDelimiter();
?>
<div class="container">
	<div class="row">
		<div class="col-xs-12">
		<?php foreach($categories as $cat): ?>
			<a href="/<?php  echo $cat->getalias() ?>"><<?php echo $categoryTag ?> class="breadcrumbs"><?php  echo $cat->getName() ?></<?php echo $categoryTag ?>></a> <?php echo $delimiter ?>
		<?php endforeach; ?>
		</div>
	</div>
</div>