<div class="item bg_section">
    <?php
    $video = $data->getVideo();
    //debug($video);die();
    if(isset($video)) {

        $time = $_SERVER['REQUEST_TIME'];
        $username = pzk_session()->getUsername();
        if(!$username) $username = false;
        $token = md5($time.$username . SECRETKEY);
        ?>
        <link href="/default/skin/nobel/ptnn/css/video-js.css" rel="stylesheet">
        <script src="/default/skin/nobel/ptnn/js/video.js"></script>

        <div  class="item slider">
            <div style=" margin-left: 2%; width: 96%; box-shadow: -2px -2px 2px 0px #18081c;">
                <video id="video" class="video-js vjs-default-skin" controls preload="auto"  width="100%" >
                    <source src="/video.php?id=<?php echo @$video['id']?>&token=<?php echo $token ?>&time=<?php echo $time ?>" type='video/mp4' />
                </video>
            </div>
        </div>
        <script>

            $(document).ready(function(){
                //$('body').bind('contextmenu',function() { return false; });
            });

        </script>
    <?Php } ?>

<form class="item" style="margin: 15px 0px;" action="/fill/fill/<?php echo $data->getParentCategoryId(); ?>" method="post">
    <?php
    $cateEp = $data->getEpcate();
    $curentCateId = $data->getParentCategoryId();
    $topics = $data->getTopicByCategoryId($curentCateId);
    ?>
    <input type="hidden" name="id_category" value="<?php  echo $curentCateId; ?>"/>
    <div class="col-md-10">
        <label for="">Chọn dạng</label>
        <?php foreach($cateEp as $val): ?>
        <a <?php if($curentCateId == $val['id']) { echo "class='active_type'"; } ?> href="<?php echo pzk_request()->build($val['router'].'/'.$val['id']); ?>"><?php echo @$val['name']?> |</a>
        <?php endforeach; ?>
    </div>
    <?php if($topics){ ?>
    <div class="col-md-6">
        <label for="">Chủ đề</label>
        <select name="subject" id="">
            <option value="">Chọn chủ đề ...</option>
            <?php foreach($topics as $topic): ?>
            <option value="<?php echo @$topic['id']?>"><?php echo $topic['name']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <?php } ?>


    <br>
    <table class="tb_lesson" border="1px" cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th>Số câu</th>
            <th>Thời gian</th>
            <th>Mức độ</th>
            <th rowspan="2"><input type="submit" name="submit" value="Bắt đầu làm bài"></th>

        </tr>
        <tr>
            <th>
                <select name="number" id="">
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </th>
            <th>
                <select name="time" id="">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select> phút
            </th>
            <th>
                <select name="level">
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
