<?php
$fivehighest=$data->getLatest();
?>
<h4><span class="label label-primary">Bài viết mới nhất:</span></h4>
{each $fivehighest as $latest}
<p class="text-left"><a href="/featured/detail?id={latest[id]}">{latest[title]}</a></p>
{/each}