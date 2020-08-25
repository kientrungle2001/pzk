<?php 
	$language = pzk_global()->getLanguage();
	$lang = pzk_session('language');
?>
<?php $data->displayChildren('[position=public-header]') ?>		
<?php $data->displayChildren('[position=top-menu]') ?>
<div class="container hidden-xs">
	<p class="t-weight text-center btn-custom8 mgright"><?php echo $language['materials'];?></p>
</div>
<div class="container visible-xs top10">
	<p class="t-weight text-center btn-custom8"><?php echo $language['materials'];?></p>
</div>
<div class="container fivecolumns">
	<div class="row">
		<div class="col-md-10 col-xs-12">
			<?php $data->displayChildren('[position=index-content]') ?>
		</div>
		<div class="col-md-2 col-xs-12 pd-15">
			<?php $data->displayChildren('[position=right-banner]') ?>
		</div>
	</div>
</div>