<?php
$items = $data->getItems();
$item0 = $items[0];
$item1 = $items[1];
$item2 = $items[2];
$item3 = $items[3];
$item4 = $items[4];
$item5 = $items[5];
$item6 = $items[6];
$item7 = $items[7];
$item8 = $items[8];
$item9 = $items[9];
$item10 = $items[10];
$item11 = $items[11];
?>
<style>
.row-no-padding [class*=col-] {
	padding: 0;
}
.responsive-box {
	overflow: hidden;
	position: relative;
}
.responsive-box img, .responsive-box h2 {
	position: absolute;
	color: #fff;
}
.responsive-box img {
	opacity: 1;
}
.responsive-box img:hover {
	opacity: 0.9;
}
.responsive-box h2 {
	font-size: 16px;
	padding: 15px;
	margin: 0;
	background: #555;
	bottom: 0;
	width: 100%;
	opacity: 0.5;
}
.responsive-box:hover h2 {
	opacity: 1;
}
.topbt15 {
	margin-top: 15px;
}
</style>
<div class="row row-no-padding topbt15">
	<div class="col-sm-12">
		<div class="col-sm-4">
			<a href="/<?php echo @$item0['alias']?>">
			<div class="responsive-box" data-ratio="0.4" data-bgcolor="#fff">
				<img src="<?php echo @$item0['img']?>"
					class="img-responsive" />
				<h2><?php echo @$item0['title']?></h2>
			</div>
			</a>
			<a href="/<?php echo @$item1['alias']?>">
			<div class="responsive-box" data-ratio="0.8" data-bgcolor="#fff">
				<img src="<?php echo @$item1['img']?>"
					class="img-responsive" />
				<h2><?php echo @$item1['title']?></h2>
			</div>
			</a>
			<a href="/<?php echo @$item2['alias']?>">
			<div class="responsive-box" data-ratio="0.4" data-bgcolor="#fff">
				<img src="<?php echo @$item2['img']?>"
					class="img-responsive" />
				<h2><?php echo @$item2['title']?></h2>
			</div>
			</a>
			<a href="/<?php echo @$item3['alias']?>">
			<div class="responsive-box" data-ratio="0.4" data-bgcolor="#fff">
				<img src="<?php echo @$item3['img']?>"
					class="img-responsive" />
				<h2><?php echo @$item3['title']?></h2>
			</div>
			</a>
		</div>
		
		<div class="col-sm-4">
			<a href="/<?php echo @$item4['alias']?>">
			<div class="responsive-box" data-ratio="0.5" data-bgcolor="#fff">
				<img src="<?php echo @$item4['img']?>"
					class="img-responsive" />
				<h2><?php echo @$item4['title']?></h2>
			</div>
			</a>
			<a href="/<?php echo @$item5['alias']?>">
			<div class="responsive-box" data-ratio="0.5" data-bgcolor="#fff">
				<img src="<?php echo @$item5['img']?>"
					class="img-responsive" />
				<h2><?php echo @$item5['title']?></h2>
			</div>
			</a>
			<a href="/<?php echo @$item6['alias']?>">
			<div class="responsive-box" data-ratio="0.5" data-bgcolor="#fff">
				<img src="<?php echo @$item6['img']?>"
					class="img-responsive" />
				<h2><?php echo @$item6['title']?></h2>
			</div>
			</a>
			<a href="/<?php echo @$item7['alias']?>">
			<div class="responsive-box" data-ratio="0.5" data-bgcolor="#fff">
				<img src="<?php echo @$item7['img']?>"
					class="img-responsive" />
				<h2><?php echo @$item7['title']?></h2>
			</div>
			</a>
		</div>
		
		<div class="col-sm-4">
			<a href="/<?php echo @$item8['alias']?>">
			<div class="responsive-box" data-ratio="0.4" data-bgcolor="#fff">
				<img src="<?php echo @$item8['img']?>"
					class="img-responsive" />
				<h2><?php echo @$item8['title']?></h2>
			</div>
			</a>
			<a href="/<?php echo @$item9['alias']?>">
			<div class="responsive-box" data-ratio="0.7" data-bgcolor="#fff">
				<img src="<?php echo @$item9['img']?>"
					class="img-responsive" />
				<h2><?php echo @$item9['title']?></h2>
			</div>
			</a>
			<a href="/<?php echo @$item10['alias']?>">
			<div class="responsive-box" data-ratio="0.4" data-bgcolor="#fff">
				<img src="<?php echo @$item10['img']?>"
					class="img-responsive" />
				<h2><?php echo @$item10['title']?></h2>
			</div>
			</a>
			<a href="/<?php echo @$item11['alias']?>">
			<div class="responsive-box" data-ratio="0.5" data-bgcolor="#fff">
				<img src="<?php echo @$item11['img']?>"
					class="img-responsive" />
				<h2><?php echo @$item11['title']?></h2>
			</div>
			</a>
		</div>
	</div>
</div>
<script type="text/javascript">
setInterval(function() {
	jQuery('.responsive-box').each(function(index, item){
		var $item = jQuery(item);
		var bgcolor = $item.data('bgcolor');
		var ratio = parseFloat($item.data('ratio'));
		$item.width('100%');
		$item.height($item.width() * ratio);
		$item.css('background', bgcolor);
	});
}, 10);

</script>
{ifprop listType=row}
<div class="row">
<?php foreach($items as $item): ?>
<div class="col-sm-12">
<article class="row post topbt15">
	<?php if($data->get('showThumbnail') !== 'false') { ?>
	<div class="col-sm-4">
		<a href="/<?php echo @$item['alias']?>">
		<img class="img-responsive img-thumbnail" src="<?php echo BASE_URL. @createThumb($item['img'], 480, 480) ; ?>" />
			</a>
	</div>
	<div class="col-sm-8">
		<a href="/<?php echo @$item['alias']?>">
			<<?php echo $data->get('titleTag')?> class="entry-title text-justify"> <?php echo @$item['title']?></<?php echo $data->get('titleTag')?>>
		</a>
		<?php if($data->get('showBrief') !== 'false') { ?>
		<<?php echo $data->get('briefTag')?> class="article-summary text-justify"><?php echo @$item['brief']?></<?php echo $data->get('briefTag')?>>
		<?php } ?>
	</div>
	<?php } else { ?>
	<div class="col-sm-12">
		<a href="/<?php echo @$item['alias']?>">
			<<?php echo $data->get('titleTag')?> class="entry-title text-justify"> <?php echo @$item['title']?></<?php echo $data->get('titleTag')?>>
		</a>
		<?php if($data->get('showBrief') !== 'false') { ?>
		<<?php echo $data->get('briefTag')?> class="article-summary text-justify"><?php echo @$item['brief']?></<?php echo $data->get('briefTag')?>>
		<?php } ?>
	</div>
	<?php } ?>
	
</article>
</div>
<?php endforeach; ?>
</div>
<?php else: ?>
<ul class="<?php echo $data->get('ulClass')?>">
<?php foreach($items as $item): ?>
<li class="<?php echo $data->get('liClass')?>"><a href="/<?php echo @$item['alias']?>">
			<<?php echo $data->get('titleTag')?> class="entry-title"> <?php echo @$item['title']?></<?php echo $data->get('titleTag')?>>
		</a></li>
<?php endforeach; ?>
</ul>
<?php endif; ?>