<?php
$item = $data->getItem();
$categories = $data->getCategories();
$categoryTag = $data->get('categoryTag');
$newsTag = $data->get('newsTag');
$delimiter = $data->get('delimiter');
?>
<div class="container">
	<div class="row">
		<div class="col-xs-12">
		<?php foreach($categories as $cat): ?>
			<a href="/<?php echo $cat->get('alias')?>"><<?php echo $categoryTag ?> class="breadcrumbs"><?php echo $cat->get('name')?></<?php echo $categoryTag ?>></a> <?php echo $delimiter ?>
		<?php endforeach; ?>
			<a href="/<?php echo @$item['alias']?>"><<?php echo $newsTag ?> class="breadcrumbs"><?php echo @$item['title']?></<?php echo $newsTag ?>></a>
		</div>
	</div>
</div>