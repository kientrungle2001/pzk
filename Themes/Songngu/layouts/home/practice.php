<style>
#hotnew1{
	display:none; position:fixed; bottom: 180px; 
	webkit-box-shadow: 1px 1px 10px 0px rgba(50, 50, 50, 0.75);
    -moz-box-shadow: 1px 1px 10px 0px rgba(50, 50, 50, 0.75);
    box-shadow: 1px 1px 10px 0px rgba(50, 50, 50, 0.75);
    background-color: #fff;
    background-position: bottom right;
	padding: 6px 10px;
	border-radius: 3px;
	webkit-border-radius: 3px;
	cursor: pointer;
}
</style>
<?php
	$language =pzk_global()->get('language');
	$languagevn = pzk_global()->get('languagevn');
	$lang = pzk_session('language');
?>
<?php $data->displayChildren('[position=public-header]') ?>
<?php $data->displayChildren('[position=top-menu]') ?>
<div id="practice" class="container top10">
	<p class="t-weight text-center btnclick btn-custom8 textcl"><?php echo $language['practice'];?></p>
</div>
<?php ?>
<div class="container" id="subject">
	<div id="practice-section" class="row fivecolumns">
		<?php $data->displayChildren('[position=show-subject]') ?>
	</div>
</div>
<div id="practice-test" class="container top20">
	<p class="t-weight text-center btn-custom8 textcl"><?php echo $language['general'];?></p>
</div>
<div id="practice-test-section" class="container pdbot-60">
	<div class="row">
		<?php $data->displayChildren('[position=practice-place]') ?>
	</div>
</div>
<div id="test" class="container top20">
	<p class="t-weight text-center btn-custom8 textcl"><?php echo $language['weekend'];?></p>
</div>
<div id="test-section" class="container pdbot-60">
	<div class="row">
		<?php $data->displayChildren('[position=test-place]') ?>
	</div>
</div>
<?php $data->displayChildren('[position=bottom-slide]') ?>			
<script>	
	<?php if(pzk_request('class')) : ?>
		$(".btnclick[data-class=<?php echo pzk_request('class') ?>]").trigger("click");
	<?php endif; ?>
	$(".subjectclick").click(function(){
		<?php if(pzk_session('userId')): ?>
			var numbersubject = $(this).data("subject");
			var alias = $(this).data("alias");
			window.location = BASE_REQUEST+'/practice/class-'+numberclass+'/subject-'+alias+'-'+numbersubject;
		<?php else: ?>
			alert('<?php echo $language['login'];?>');
		<?php endif; ?>
	});
</script>

