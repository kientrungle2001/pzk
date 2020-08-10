<?php
$gameType = $data->getGameType();
$gameTopic = $data->getGameTopic();
$gameTopic = buildArr($gameTopic, 'parent', 0);
$post = pzk_request();
$getGameType = $post->getGameType();
$getTopic = $post->getGameTopic();
?>
<div class="well">
    <form name="form_game" method="get" >
        <div class="row">
            <div class="col-md-4">
                <label for="">Chọn Trò chơi</label>
                <?php if(isset($gameType)) { ?>
                    <select class="form-control input-sm" name="gameType" id="">
                        <option value="">Chọn Trò chơi</option>
                        <?php foreach($gameType as $topic): ?>
                        <option <?php if(isset($getGameType) && ($getGameType == $topic['gamecode'])){ echo 'selected';} ?> value="<?php echo @$topic['gamecode']?>"><?php echo $topic['game_type']; ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php } ?>

            </div>

            <?php if($gameTopic){ ?>
                <div class="col-md-4">
                    <div class="form-group">
                        <label  for="">Chọn chủ đề</label>
                        <select class="form-control input-sm" name="gameTopic" id="">
                            <option value="">-- Chọn chủ đề </option>
                            <?php foreach($gameTopic as $parent): ?>
                            <option <?php if(isset($getTopic) && ($getTopic == $parent['id'])){ echo 'selected';} ?> value="<?php echo $parent['id']; ?>" >
                                <?php echo str_repeat('--', $parent['level']);  ?>
                                <?php echo $parent['game_topic']; ?>
                            </option>
                            <?php endforeach; ?>

                        </select>
                    </div>
                </div>
            <?php } ?>
            <div class="col-md-4">
                <div class="form-group">

                    <button style="margin-top: 20px;" name="done"  class="btn btn-primary">
                        <span class="glyphicon glyphicon glyphicon-play" aria-hidden="true"></span> Bắt đầu làm bài
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>