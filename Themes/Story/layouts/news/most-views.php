<h3 class="mgtop-5 text-center">Bài viết được quan tâm</h3>
<ul class="list-unstyled">
<?php  $items = $data->getItems(); ?>
<?php foreach($items as $item): ?>
<li class="top20"><a href="newsdetail.php?id=<?php echo @$item['id']?>&parentid=<?php echo @$item['categoryId']?>" ><?php echo @$item['title']?></a></li>
<?php endforeach; ?>
</ul>