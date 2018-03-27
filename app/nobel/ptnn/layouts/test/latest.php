<?php
$fivehighest=$data->getLatest();
?>
<h4><span class="label label-primary">Bài kiểm tra mới nhất:</span></h4>
{each $fivehighest as $latest}
<p class="text-left"><a href="/Ngonngu/test/{latest[id]}">{latest[name]}</a></p>
{/each}