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
        <script src="http://releases.flowplayer.org/js/flowplayer-3.2.13.min.js"></script>

        <div  class="item slider">
            <div style=" margin-left: 2%; width: 96%; box-shadow: -2px -2px 2px 0px #18081c;">
                <a class="item" href="/video.php?id={video[id]}&token={token}&time={time}" style="display:block;width:100%;height:500px;" id="player"></a>
            </div>
        </div>
        <script>

            flowplayer("player",  {
                    src:"http://releases.flowplayer.org/swf/flowplayer-3.2.18.swf",
                    wmode: "opaque" // This allows the HTML to hide the flash content
                },
                {
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
    <?php } ?>
