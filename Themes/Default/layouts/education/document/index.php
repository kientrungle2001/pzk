<div class="container document hidden-xs">
	<div class="row">
		<div class="col-md-1">&nbsp;</div>			
		<div class="col-xs-11 col-md-11 ">
			<div class="pd-20 text-left">
				<a href="<?=FL_URL?>"><h1>FULL LOOK</h1></a>	
				<h3 class="hidden-xs">Phần mềm Khảo sát và Phát triển năng lực toàn diện bằng tiếng Anh</h3>
				<?php echo partial('Themes/Default/layouts/home/aboutbtn');?>
			</div>
		</div>
	</div>
</div>
<div class="container top50 visible-xs">
	<div class="row">
		<div class="col-md-1">&nbsp;</div>			
		<div class="col-xs-11 col-md-11 ">
			<div class="pd-20 text-left">
				<a href="<?=FL_URL?>"><h1>FULL LOOK</h1></a>	
			</div>
		</div>
	</div>
</div>	
{children [position=top-menu]}
<div class="container">
	<p class="t-weight text-center btn-custom8 mgright">Tài liệu học tập</p>
</div>
{?
$subject = _db()->getTableEntity('categories')->load($data->get('categoryId'), 1800);
$subjects = _db()->useCache(1800)->selectAll()->fromCategories()->whereParent($subject->get('parent'))->result();
?}
<div class="container fivecolumns">
	<div class="row">
		<div class="col-md-2 col-xs-12 pd-15">
			{children [position=left-banner]}
		</div>
		<div class="col-md-8 col-xs-12">
			{children [position=mid-content]}
		</div>
		<div class="col-md-2 col-xs-12 pd-15">
			{children [position=right-banner]}
		</div>
	</div>
</div>