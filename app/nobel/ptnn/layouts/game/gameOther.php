<?php
$post = pzk_request();
$getGameType = $post->get('gameType');
$getTopic = $post->get('gameTopic');
$game = $data->getFrameGame($getGameType, "game");
$linkgame = $game['linkgame'];
if($linkgame) {
?>
<iframe src="{linkgame}" name="Englishacorn" width="760" height="200" frameborder="0" scrolling="no" ></iframe>
<?php } ?>