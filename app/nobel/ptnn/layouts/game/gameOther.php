<?php
$post = pzk_request();
$getGameType = $post->getGameType();
$getTopic = $post->getGameTopic();
$game = $data->getFrameGame($getGameType, "game");
$linkgame = $game['linkgame'];
if($linkgame) {
?>
<iframe src="<?php echo $linkgame ?>" name="Englishacorn" width="760" height="200" frameborder="0" scrolling="no" ></iframe>
<?php } ?>