<?php 
$id=pzk_request('id');
$gallerys=$data->getSubgallery($id); 

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html lang="en">
<head>
    <link rel="stylesheet" href="/3rdparty/nivo-slider/Themes/default/default.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="/3rdparty/nivo-slider//Themes/light/light.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="/3rdparty/nivo-slider//Themes/dark/dark.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="/3rdparty/nivo-slider//Themes/bar/bar.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="/3rdparty/nivo-slider//nivo-slider.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="/3rdparty/nivo-slider/demo/style.css" type="text/css" media="screen" />
</head>
<body>
    <div id="wrapper">
        <div class="slider-wrapper theme-default">
            <div id="slider" class="nivoSlider">
			<?php foreach($gallerys as $gallery): ?>
                <img src="<?php echo @$gallery['url']?>" data-thumb="<?php echo @$gallery['url']?>" alt="" />
              <?php endforeach; ?>   				
            </div>
        </div>
    </div>
    <script type="text/javascript" src="/3rdparty/nivo-slider/demo/scripts/jquery-1.9.0.min.js"></script>
    <script type="text/javascript" src="/3rdparty/nivo-slider/jquery.nivo.slider.js"></script>
    <script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider();
    });
    </script>
</body>
</html>