<?php
$item = $data->getItem();
$categories = $data->getCategories();
$categoryTag = $data->getCategoryTag();
$newsTag = $data->getNewsTag();
$delimiter = $data->getDelimiter();
?>
<div id="breadcrumbs-container" class="container">
	<div class="row">
		<div class="col-xs-12">
		<a href="/"><<?php echo $categoryTag ?> class="breadcrumbs">Trang chủ</<?php echo $categoryTag ?>></a> <?php echo $delimiter ?>
		<?php foreach($categories as $cat): ?>
			<a href="/<?php echo $cat->getalias()?>"><<?php echo $categoryTag ?> class="breadcrumbs"><?php echo $cat->getName()?></<?php echo $categoryTag ?>></a> <?php echo $delimiter ?>
		<?php endforeach; ?>
			<a href="/<?php echo @$item['alias']?>"><<?php echo $newsTag ?> class="breadcrumbs"><?php echo @$item['title']?></<?php echo $newsTag ?>></a>
		</div>
	</div>
</div>