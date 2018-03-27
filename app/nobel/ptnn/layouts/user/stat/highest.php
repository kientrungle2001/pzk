<?php
$fivehighest=$data->getHighest();
?>
<h4><span class="label label-primary">Thành viên có thứ hạng cao nhất:</span></h4>
{each $fivehighest as $highest}
<p class="text-left"><a href="/profile/user?member={highest[id]}">{highest[username]}</a>:{highest[point]}</p>
{/each}