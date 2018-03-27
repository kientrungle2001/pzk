<div class="item bg_section">
    <?php
    $video = $data->getVideo();
    //debug($video);die();
    if(isset($video)) {

        $time = $_SERVER['REQUEST_TIME'];
        $username = pzk_session('username');
        if(!$username) $username = false;
        $token = md5($time.$username . SECRETKEY);
        ?>
        <script src="http://releases.flowplayer.org/js/flowplayer-3.2.13.min.js"></script>

        <div  class="item slider">
            <div style=" margin-left: 2%; width: 96%; box-shadow: -2px -2px 2px 0px #18081c;">
                <a href="/video.php?id={video[id]}&token={token}&time={time}" style="display:block;width:100%;height:500px;" id="player"></a>
            </div>
        </div>
        <script>
        
			flowplayer("player", "http://releases.flowplayer.org/swf/flowplayer-3.2.18.swf", {
				clip: {
					// these two configuration variables does the trick
					autoPlay: false,
					autoBuffering: true // <- do not place a comma here
				}
			});
            $(document).ready(function(){
                $('.slider').bind('contextmenu',function() { return false; });
            });

        </script>
    <?Php } ?>
<div  class="well item well-sm">
<form class="form-inline " action="/category/question/<?php echo $data->getParentCategoryId(); ?>" method="post">
    <?php
    $cateEp = $data->getEpcate();
    $curentCateId = $data->getParentCategoryId();
    $topics = $data->getTopicByCategoryId($curentCateId);
    $configCategory = $data->getConfigCategory();
    $config_filter = $data->getConfigFilter();
    ?>
    <input type="hidden" name="id_category" value="<?php  echo $curentCateId; ?>"/>
    <div class="row">
        <div class="col-md-8">
            <label for="">Chọn dạng</label>
            {each $cateEp as $val}
            <a <?php if($curentCateId == $val['id']) { echo "class='active_type'"; } ?> href="<?php echo pzk_request()->build($val['router'].'/'.$val['id']); ?>">{val[name]}</a>
            {/each}
            <?php if(isset($configCategory[$curentCateId])) {
              foreach($configCategory[$curentCateId] as $item) {
            ?>
            <input class="form-control" type="radio" value="<?php echo $item['category_id']; ?>" name="categoryId2"/>{item[name]}
            <?Php }} ?>

        </div>

        <?php if(isset($config_filter)) { ?>
            <div class="col-md-4">
                <div class="form-group">
                    <label  for="">Chọn cách làm</label>
                    <select style="float: left; width: 100%;" class="form-control input-sm" name="make" id="">
                        <option value="">Chọn cách làm ...</option>
                        {each $config_filter as $topic}
                        <option value="{topic[id]}"><?php echo $topic['name']; ?></option>
                        {/each}
                    </select>
                </div>
            </div>
        <?php } ?>

        <?php if($topics){ ?>
            <div class="col-md-4">
                <div class="form-group">
                    <label  for="">Chủ đề</label>
                    <select class="form-control input-sm" name="subject" id="">
                        <option value="">Chọn chủ đề ...</option>
                        {each $topics as $topic}
                        <option value="{topic[id]}"><?php echo $topic['name']; ?></option>
                        {/each}
                    </select>
                </div>
            </div>
        <?php } ?>
    </div>

    <table class="tb_lesson table-bordered">
        <thead>
        <tr>
            <th>Số câu</th>
            <th>Thời gian</th>
            <th>Mức độ</th>
            <th rowspan="2">
                <button type="submit" name="done" id="bt-start" class="btn btn-primary">
                    <span class="glyphicon glyphicon glyphicon-play" aria-hidden="true"></span> Bắt đầu làm bài
                </button>

        </tr>
        <tr>
            <th>
                <select class="form-control  input-sm" name="number" id="">
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </th>
            <th>
                <select class="form-control  input-sm" name="time" id="">
                    <option value="3">3 phút</option>
                    <option value="4">4 phút</option>
                    <option value="5">5 phút</option>
                </select>
            </th>
            <th>
                <select class="form-control  input-sm" name="level">
                    <option value="1">Dễ</option>
                    <option value="2">Bình thường</option>
                    <option value="3">Khó</option>
                </select>
            </th>
        </tr>
        </thead>
    </table>
</form>
</div>
    {children all}
</div>
