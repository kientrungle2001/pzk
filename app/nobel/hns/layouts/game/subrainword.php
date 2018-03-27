<?php 
$id=pzk_request('id');
$games= $data->getGames($id); 
?>
<strong><center>Chọn trọng điểm miêu tả</strong><br>
{each $games as $game}
<a href="/Game/playgame?id={game[id]}"><img src="{game[img]}" width="200" height="200" style="margin:10px;" title="{game[game_title]}"></a>
{/each}