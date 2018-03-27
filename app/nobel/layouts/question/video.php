<?php
$id = pzk_request()->getSegment(3);
$video = $data->getVideo($id);
//debug($video);die();
if(isset($video)) {

    $time = $_SERVER['REQUEST_TIME'];
    $username = pzk_session('username');
    if(!$username) $username = false;
    $token = md5($time.$username . SECRETKEY);
    ?>
    <link href="/default/skin/ptnn/css/video-js.css" rel="stylesheet">
    <script src="/default/skin/ptnn/js/video.js"></script>

    <div  class="item slider">
        <div style=" margin-left: 2%; width: 96%; box-shadow: -2px -2px 2px 0px #18081c;">
            <video id="video" class="video-js vjs-default-skin" controls preload="auto"  width="100%" >
                <source src="/video.php?id={video[id]}&token={token}&time={time}" type='video/mp4' />
            </video>
        </div>
    </div>
    <script>

        $(document).ready(function(){
            //$('body').bind('contextmenu',function() { return false; });
        });

    </script>
<?php } ?>