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
        <link href="/default/skin/ptnn/css/video-js.css" rel="stylesheet">
        <script src="/default/skin/ptnn/js/video.js"></script>

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
            <?php foreach($cateEp as $val): ?>
            <a <?php if($curentCateId == $val['id']) { echo "class='active_type'"; } ?> href="<?php echo pzk_request()->build($val['router'].'/'.$val['id']); ?>"><?php echo @$val['name']?></a>
            <?php endforeach; ?>
            <?php if(isset($configCategory[$curentCateId])) {
              foreach($configCategory[$curentCateId] as $item) {
            ?>
            <input class="form-control" type="radio" value="<?php echo $item['category_id']; ?>" name="categoryId2"/><?php echo @$item['name']?>
            <?Php }} ?>

        </div>

        <?php if(isset($config_filter)) { ?>
            <div class="col-md-4">
                <div class="form-group">
                    <label  for="">Chọn cách làm</label>
                    <select style="float: left; width: 100%;" class="form-control input-sm" name="make" id="">
                        <option value="">Chọn cách làm ...</option>
                        <?php foreach($config_filter as $topic): ?>
                        <option value="<?php echo @$topic['id']?>"><?php echo $topic['name']; ?></option>
                        <?php endforeach; ?>
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
                        <?php foreach($topics as $topic): ?>
                        <option value="<?php echo @$topic['id']?>"><?php echo $topic['name']; ?></option>
                        <?php endforeach; ?>
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
    <?php $data->displayChildren('all') ?>

</div>
