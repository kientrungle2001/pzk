<style>
.entry-title {
	font-size: 16px;
	padding: 0;
	margin: 0;
}
</style>
{item = $data->getItem()}
<?php echo pzk_theme_html_open_tag('container') ?>
<?php echo pzk_theme_html_open_tag('row') ?>
<div class="col-md-9">
<img src="<?php echo @$item['img']?>" class="img-responsive hidden" />
<h2 class="text-justify"><?php echo @$item['title']?></h2>
<div class="text-justify">
<?php echo @$item['content']?>
</div>
</div>
<div class="col-md-3">
{relateds = $data->getRelateds()}
<div class="row">
<?php foreach($relateds as $related): ?>
<a href="/<?php echo @$related['alias']?>">
<div class="col-sm-12 thumbnail">
	<img src="<?php echo @$related['img']?>" class="img-responsive img-thumbnail" />
	<h3 class="entry-title"><?php echo @$related['title']?></h3>
</div>
</a>

<?php endforeach; ?>
</div>
</div>
<?php echo pzk_theme_html_close_tag('row') ?>
<?php echo pzk_theme_html_close_tag('container') ?>