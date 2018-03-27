
<strong><center>Chọn trò chơi</strong><br>
<?php $games= $data->getGames(); ?>
{each $games as $game}
<a href="{game[url]}"><img height="200" width="200" style="margin:10px;" title="{game[gametype]}" src="{game[img]}" ></a>
{/each}

