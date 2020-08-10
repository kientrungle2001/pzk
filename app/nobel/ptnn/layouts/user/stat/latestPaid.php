<?php
$fivepaid=$data->getPaid();
?>
<h4><span class="label label-primary">Thành viên vừa mới mua tài khoản:</span></h4>
<?php foreach($fivepaid as $paid): ?>
<p class="text-left"><a href="/profile/user?member=<?php echo @$paid['userId']?>"><?php echo @$paid['username']?></a></p>
<?php endforeach; ?>