
<strong><center>Chọn trò chơi</strong><br>
<?php $games= $data->getGames(); ?>
<?php foreach($games as $game): ?>
<a href="<?php echo @$game['url']?>"><img height="200" width="200" style="margin:10px;" title="<?php echo @$game['gametype']?>" src="<?php echo @$game['img']?>" ></a>
<?php endforeach; ?>

