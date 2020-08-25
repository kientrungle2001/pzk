<?php
$item = $data->getItem();
$categories = $data->getCategories();
$categoryTag = $data->getCategoryTag();
$newsTag = $data->getNewsTag();
$delimiter = $data->getDelimiter();
?>
<div class="row">
<?php foreach($categories as $cat): ?>
	<a href="/<?php echo $cat->getalias()?>"><<?php echo $categoryTag ?> class="breadcrumbs"><?php echo $cat->getName()?></<?php echo $categoryTag ?>></a> <?php echo $delimiter ?>
<?php endforeach; ?>
	<a href="/<?php echo @$item['alias']?>"><<?php echo $newsTag ?> class="breadcrumbs"><?php echo @$item['title']?></<?php echo $newsTag ?>></a>
</div>