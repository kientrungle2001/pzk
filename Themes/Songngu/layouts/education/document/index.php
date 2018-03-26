<?php 
	$language = pzk_global()->get('language');
	$lang = pzk_session('language');
?>
{children [position=public-header]}
{children [position=top-menu]}
<div class="container hidden-xs">
	<p class="t-weight text-center btn-custom8 mgright"><?php echo $language['materials'];?></p>
</div>
<div class="container visible-xs top10">
	<p class="t-weight text-center btn-custom8"><?php echo $language['materials'];?></p>
</div>
{?
$subject = _db()->getTableEntity('categories')->load($data->get('categoryId'));
$subjects = _db()->selectAll()->fromCategories()->whereParent($subject->get('parent'))->result();
?}
<div class="container fivecolumns">
	<div class="row">
		<div class="col-md-10 col-xs-12">
			{children [position=mid-content]}
		</div>
		<div class="col-md-2 col-xs-12 pd-15">
			{children [position=right-banner]}
		</div>
	</div>
</div>