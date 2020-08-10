<strong><center>Chọn chủ đề:</strong><br>
<?php $games= $data->getGames(); ?>
<?php foreach($games as $game): ?>
<a href="/game/subrainword?id=<?php echo @$game['id']?>"><img height="200" width="200" style="margin:10px;"title="<?php echo @$game['game_title']?>" src="<?php echo @$game['img']?>"></a>
<?php endforeach; ?>