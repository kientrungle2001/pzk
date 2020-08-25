<?php
$items = $data->getItems();
?>
{ifprop listType=row}
<?php foreach($items as $item): ?>
<article class="row post top10">
	<?php if($data->getShowThumbnail() !== 'false') { ?>
	<div class="col-xs-3">
		<a href="/document/chitiet/<?php echo @$item['id']?>">
		<img class="img-responsive img-thumbnail" src="<?php echo BASE_URL. @createThumb($item['img'], 200, 200) ; ?>" />
			</a>
	</div>
	<div class="col-xs-9">
		<a href="/document/chitiet/<?php echo @$item['id']?>">
			<<?php echo $data->getTitleTag()?> class="entry-title"> <?php echo @$item['title']?></<?php echo $data->getTitleTag()?>>
		</a>
		<?php if($data->getShowBrief() !== 'false') { ?>
		<<?php echo $data->getBriefTag()?> class="article-summary">
		<?php if($data->getBriefLength()): ?>
			<?php echo cut_words($item['brief'], $data->getBriefLength()); ?>
		<?php else: ?>
		<?php echo @$item['brief']?>
		<?php endif; ?>
		
		</<?php echo $data->getBriefTag()?>>
		<?php } ?>
	</div>
	<?php } else { ?>
	<div class="col-xs-12">
		<a href="/document/chitiet/<?php echo @$item['id']?>">
			<<?php echo $data->getTitleTag()?> class="entry-title"> <?php echo @$item['title']?></<?php echo $data->getTitleTag()?>>
		</a>
		<?php if($data->getShowBrief() !== 'false') { ?>
		<<?php echo $data->getBriefTag()?> class="article-summary"><?php echo @$item['brief']?></<?php echo $data->getBriefTag()?>>
		<?php } ?>
	</div>
	<?php } ?>
	
</article>
<?php endforeach; ?>
<?php else: ?>
<ul class="<?php echo $data->getUlClass()?>">
<?php foreach($items as $item): ?>
<li class="<?php echo $data->getLiClass()?>"><a href="/document/chitiet/<?php echo @$item['id']?>">
			<<?php echo $data->getTitleTag()?> class="entry-title"> <?php echo @$item['title']?></<?php echo $data->getTitleTag()?>>
		</a></li>
<?php endforeach; ?>
</ul>
<?php endif; ?>