<strong><center>Chọn chủ đề:</strong><br>
<?php $games= $data->getGames(); ?>
{each $games as $game}
<a href="/game/subrainword?id={game[id]}"><img height="200" width="200" style="margin:10px;"title="{game[game_title]}" src="{game[img]}"></a>
{/each}