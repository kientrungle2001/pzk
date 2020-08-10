<?php
$fivehighest=$data->getLatest();
?>
<h4><span class="label label-primary">Bài kiểm tra mới nhất:</span></h4>
<?php foreach($fivehighest as $latest): ?>
<p class="text-left"><a href="/Ngonngu/test/<?php echo @$latest['id']?>"><?php echo @$latest['name']?></a></p>
<?php endforeach; ?>