<?php
$fivehighest=$data->getLatest();
?>
<h4><span class="label label-primary">Bài viết mới nhất:</span></h4>
<?php foreach($fivehighest as $latest): ?>
<p class="text-left"><a href="/featured/detail?id=<?php echo @$latest['id']?>"><?php echo @$latest['title']?></a></p>
<?php endforeach; ?>