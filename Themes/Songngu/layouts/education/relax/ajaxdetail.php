<?php  $item = $data->getItem(); ?>
<?php $datacontent = @explode('=====',$item[content]);
 ?>
	<h2 class="text-center"><?php echo @$item['title']?></h2>
	<p class="text-justify"><?php echo @$item['brief']?></p>
	<p class="text-justify"><?=$datacontent[0];?></p>
	<?php if(strlen($datacontent[1]) > 10) { ?>
	<div class='text-center'>
		<button id='phude' style='width: 140px; font-size: 16px; font-weight: bold;' class='btn btn-success' >Phụ đề</button>
	</div>
	<div style='display: none;' class='text-center' id='show_pd'>
		<?= $datacontent[1]; ?>
	</div>
	<?php } ?>
	<?php if(strlen($datacontent[2]) > 5) { ?>
	<div class = 'text-justify'>
		<b style='font-size: 16px;'>Question</b><br>
		<?=@$datacontent[2];?>
	</div>
	
	<?php } ?>
	
	<?php if(strlen(@$datacontent[3]) > 5) { ?>
		<div class='item'>
			<button id='dich' style='width: 140px; font-size: 16px; font-weight: bold;' class='btn btn-success' >Dịch</button>
		</div>
		<div style='display: none;' class='pull-left' id='show_dich'>
			<?= $datacontent[3]; ?>
		</div>
	<?php } ?>
	<script>
		
	$('#phude').click(function(){
		$('#show_pd').toggle();
	});
	$('#dich').click(function(){
		$('#show_dich').toggle();
	});

</script>


<?php $data->displayChildren('[position=comment]') ?>

<div id="fb-root"></div>
<script>
(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.3&appId=1428443070812396";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
		FB.XFBML.parse();
</script>
	<div class="fb-comments cmface" data-href="http://s1.nextnobels.com/relax/home/<?php echo @$item['id']?>" data-numposts="5"></div>

<style>
.cmface{width: 100%;}
.cmface span{width: 100% !important;}
.cmface span iframe {width: 100% !important;}
</style>
