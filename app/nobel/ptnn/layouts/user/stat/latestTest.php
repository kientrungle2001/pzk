<?php
$fivehighest=$data->getTest();
?>
<h4><span class="label label-primary">Thành viên mới hoạt động:</span></h4>
{each $fivehighest as $test}
<p class="text-left"><a href="/profile/user?member={test[userId]}">{test[username]}</a></p>
{/each}