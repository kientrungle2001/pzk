<?php
$fivehighest=$data->getHighest();
?>
<h4><span class="label label-primary">Thành viên có thứ hạng cao nhất:</span></h4>
<?php foreach($fivehighest as $highest): ?>
<p class="text-left"><a href="/profile/user?member=<?php echo @$highest['id']?>"><?php echo @$highest['username']?></a>:<?php echo @$highest['point']?></p>
<?php endforeach; ?>