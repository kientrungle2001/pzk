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
<?php $data->displayChildren('[position=top-menu]') ?>
<div class="container">
	<p class="t-weight text-center btn-custom8 mgright">Tài liệu học tập</p>
</div>
<div class="container fivecolumns">
	<div class="row">
		<div class="col-md-2 col-xs-12">
			<?php $data->displayChildren('[position=left-banner]') ?>
		</div>
		<div class="col-md-8 col-xs-12">
			<?php $data->displayChildren('[position=index-content]') ?>
		</div>
		<div class="col-md-2 col-xs-12 pd-15">
			<?php $data->displayChildren('[position=right-banner]') ?>
		</div>
	</div>
</div>