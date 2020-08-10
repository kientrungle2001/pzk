<?php
$fivehighest=$data->getTest();
?>
<h4><span class="label label-primary">Thành viên mới hoạt động:</span></h4>
<?php foreach($fivehighest as $test): ?>
<p class="text-left"><a href="/profile/user?member=<?php echo @$test['userId']?>"><?php echo @$test['username']?></a></p>
<?php endforeach; ?>