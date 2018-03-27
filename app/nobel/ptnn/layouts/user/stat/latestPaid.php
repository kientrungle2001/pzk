<?php
$fivepaid=$data->getPaid();
?>
<h4><span class="label label-primary">Thành viên vừa mới mua tài khoản:</span></h4>
{each $fivepaid as $paid}
<p class="text-left"><a href="/profile/user?member={paid[userId]}">{paid[username]}</a></p>
{/each}