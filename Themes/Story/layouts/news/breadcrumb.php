<?php
$item = $data->getItem();
$categories = $data->getCategories();
$categoryTag = $data->getCategoryTag();
$newsTag = $data->getNewsTag();
$delimiter = $data->getDelimiter();
$first = true;
?>
<div class="container">
	<ol class = "breadcrumb top20">
		<li><a href = "/home/news">Tin tức</a></li>
	   <?php foreach($categories as $cat): ?>
	   <?php  if($first) { $first = false; continue; }?>
	   <li><?php echo $cat->getName()?></li>
	   <?php endforeach; ?>
	   <li class="active"><?php echo @$item['title']?></li>
	</ol>
</div>