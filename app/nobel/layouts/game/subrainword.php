<?php 
$id=pzk_request()->getId();
$games= $data->getGames($id); 
?>
<strong><center>Chọn trọng điểm miêu tả</strong><br>
<?php foreach($games as $game): ?>
<a href="/game/playgame?id=<?php echo @$game['id']?>"><img src="<?php echo @$game['img']?>" width="200" height="200" style="margin:10px;" title="<?php echo @$game['game_title']?>"></a>
<?php endforeach; ?>