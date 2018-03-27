<?php
$fivehighest=$data->getRegister();
?>
<h4><span class="label label-primary">Thành viên mới nhất:</span></h4>
{each $fivehighest as $register}
<p class="text-left"><a href="/profile/user?member={register[id]}">{register[username]}</a></p>
{/each}