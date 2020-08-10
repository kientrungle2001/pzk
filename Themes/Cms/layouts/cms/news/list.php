<?php
$items = $data->getItems();
?>
{ifprop listType=row}
<?php foreach($items as $item): ?>
<article class="row post">
	<?php if($data->get('showThumbnail') !== 'false') { ?>
	<div class="col-xs-3">
		<a href="/<?php echo @$item['alias']?>">
		<img class="img-responsive img-thumbnail" src="<?php echo BASE_URL. @createThumb($item['img'], 480, 480) ; ?>" />
			</a>
	</div>
	<div class="col-xs-9">
		<a href="/<?php echo @$item['alias']?>">
			<<?php echo $data->get('titleTag')?> class="entry-title text-justify"> <?php echo @$item['title']?></<?php echo $data->get('titleTag')?>>
		</a>
		<?php if($data->get('showBrief') !== 'false') { ?>
		<<?php echo $data->get('briefTag')?> class="article-summary text-justify"><?php echo @$item['brief']?></<?php echo $data->get('briefTag')?>>
		<?php } ?>
	</div>
	<?php } else { ?>
	<div class="col-xs-12">
		<a href="/<?php echo @$item['alias']?>">
			<<?php echo $data->get('titleTag')?> class="entry-title text-justify"> <?php echo @$item['title']?></<?php echo $data->get('titleTag')?>>
		</a>
		<?php if($data->get('showBrief') !== 'false') { ?>
		<<?php echo $data->get('briefTag')?> class="article-summary text-justify"><?php echo @$item['brief']?></<?php echo $data->get('briefTag')?>>
		<?php } ?>
	</div>
	<?php } ?>
	
</article>
<br />
<?php endforeach; ?>
<?php else: ?>
<ul class="<?php echo $data->get('ulClass')?>">
<?php foreach($items as $item): ?>
<li class="<?php echo $data->get('liClass')?>"><a href="/<?php echo @$item['alias']?>">
			<<?php echo $data->get('titleTag')?> class="entry-title"> <?php echo @$item['title']?></<?php echo $data->get('titleTag')?>>
		</a></li>
<?php endforeach; ?>
</ul>
<?php endif; ?>