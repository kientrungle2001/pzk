<?php
$fivehighest=$data->getRegister();
?>
<h4><span class="label label-primary">Thành viên mới nhất:</span></h4>
<?php foreach($fivehighest as $register): ?>
<p class="text-left"><a href="/profile/user?member=<?php echo @$register['id']?>"><?php echo @$register['username']?></a></p>
<?php endforeach; ?>