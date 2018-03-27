<?php 
$banner = $data->getItem();
$time = time();
$key = md5(SECRETKEY . '-' . $banner['id'] . '-' . $time);
?>
 <div class="responsiveImage">
 <a target="{banner[target]}" href="/banner/bannerPost?id={banner[id]}&utm_source={banner[website]}&utm_campaign={banner[campaign]}"><img src="{banner[image]}" style="width:{banner[width]}; height:{banner[height]}; display: inline-block;"></a>
 </div>
 <script type="text/javascript">
	$.ajax({
		url: '/banner.php',
		data: {id: {banner[id]},t: {time}, k: '{key}' }
	});
 </script>