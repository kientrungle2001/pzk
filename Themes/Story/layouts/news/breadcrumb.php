<?php
$item = $data->getItem();
$categories = $data->getCategories();
$categoryTag = $data->get('categoryTag');
$newsTag = $data->get('newsTag');
$delimiter = $data->get('delimiter');
$first = true;
?>
<div class="container">
	<ol class = "breadcrumb top20">
		<li><a href = "/home/news">Tin tức</a></li>
	   <?php foreach($categories as $cat): ?>
	   <?php  if($first) { $first = false; continue; }?>
	   <li><?php echo $cat->get('name')?></li>
	   <?php endforeach; ?>
	   <li class="active"><?php echo @$item['title']?></li>
	</ol>
</div>