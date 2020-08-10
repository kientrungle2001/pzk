<?php 
$banner = $data->getItem();
$time = time();
$key = md5(SECRETKEY . '-' . $banner['id'] . '-' . $time);
?>
 <div class="responsiveImage">
 <a target="<?php echo @$banner['target']?>" href="/banner/bannerPost?id=<?php echo @$banner['id']?>&utm_source=<?php echo @$banner['website']?>&utm_campaign=<?php echo @$banner['campaign']?>"><img src="<?php echo @$banner['image']?>" style="width:<?php echo @$banner['width']?>; height:<?php echo @$banner['height']?>; display: inline-block;"></a>
 </div>
 <script type="text/javascript">
	$.ajax({
		url: '/banner.php',
		data: {id: <?php echo @$banner['id']?>,t: <?php echo $time ?>, k: '<?php echo $key ?>' }
	});
 </script>