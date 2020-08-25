<?php
$items = $data->getItems();
?>
{ifprop listType=row}
<?php foreach($items as $item): ?>
<article class="row post">
	<?php if($data->getShowThumbnail() !== 'false') { ?>
	<div class="col-xs-3">
		<a href="/<?php echo @$item['alias']?>">
		<img class="img-responsive img-thumbnail" src="<?php echo BASE_URL. @createThumb($item['img'], 480, 480) ; ?>" />
			</a>
	</div>
	<div class="col-xs-9">
		<a href="/<?php echo @$item['alias']?>">
			<<?php echo $data->getTitleTag()?> class="entry-title text-justify"> <?php echo @$item['title']?></<?php echo $data->getTitleTag()?>>
		</a>
		<?php if($data->getShowBrief() !== 'false') { ?>
		<<?php echo $data->getBriefTag()?> class="article-summary text-justify"><?php echo @$item['brief']?></<?php echo $data->getBriefTag()?>>
		<?php } ?>
	</div>
	<?php } else { ?>
	<div class="col-xs-12">
		<a href="/<?php echo @$item['alias']?>">
			<<?php echo $data->getTitleTag()?> class="entry-title text-justify"> <?php echo @$item['title']?></<?php echo $data->getTitleTag()?>>
		</a>
		<?php if($data->getShowBrief() !== 'false') { ?>
		<<?php echo $data->getBriefTag()?> class="article-summary text-justify"><?php echo @$item['brief']?></<?php echo $data->getBriefTag()?>>
		<?php } ?>
	</div>
	<?php } ?>
	
</article>
<br />
<?php endforeach; ?>
<?php else: ?>
<ul class="<?php echo $data->getUlClass()?>">
<?php foreach($items as $item): ?>
<li class="<?php echo $data->getLiClass()?>"><a href="/<?php echo @$item['alias']?>">
			<<?php echo $data->getTitleTag()?> class="entry-title"> <?php echo @$item['title']?></<?php echo $data->getTitleTag()?>>
		</a></li>
<?php endforeach; ?>
</ul>
<?php endif; ?>