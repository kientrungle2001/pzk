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
{children [position=public-header]}
{children [position=top-menu]}

<div class="container top10">
<marquee>
Chương trình đã được bảo hộ bản quyền bởi cục Sở hữu Trí tuệ Việt Nam. Mọi vi phạm bản quyền chương trình đều bị xử lí theo pháp luật.<!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php 
$cate = pzk_session('categoryIds');
if($cate){ ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bạn chỉ được sử dụng phần luyện tập môn Lịch sử và Địa Lý, để làm các môn khác vui lòng mua tài khoản <a href="/home/about">tại đây</a>.
<?php } ?>
-->
</marquee>
</div>

<div id="practice" class="container top10">
	<p class="t-weight text-center btnclick btn-custom8 textcl"><?php echo $language['practice'];?> - <?php echo $language['classnumber'];?> <?php echo pzk_session('lop');?></p>
</div>
<?php ?>
<div class="container" id="subject">
	<div id="practice-section" class="row fivecolumns">
		{children [position=show-subject]}
	</div>
</div>
<div id="practice-test" class="container top20">
	<p class="t-weight text-center btn-custom8 textcl"><?php echo $language['generaltitle'];?> - <?php echo $language['classnumber'];?> <?php echo pzk_session('lop');?></p>
</div>
<div id="practice-test-section" class="container pdbot-60">
	<div class="row">
		{children [position=practice-place]}
	</div>
</div>
<div id="test" class="container top20">
	<p class="t-weight text-center btn-custom8 textcl"><?php echo $language['weekend'];?> - <?php echo $language['classnumber'];?> <?php echo pzk_session('lop');?></p>
</div>
<div id="test-section" class="container pdbot-60">
	<div class="row">
		{children [position=test-place]}
	</div>
</div>
{children [position=bottom-slide]}			
<script>	
	<?php if(pzk_request('class')) : ?>
		$(".btnclick[data-class=<?php echo pzk_request('class') ?>]").trigger("click");
	<?php endif; ?>
	$(".subjectclick").click(function(){
		<?php if(pzk_session('userId')): ?>
			var numbersubject = $(this).data("subject");
			var alias = $(this).data("alias");
			var memclass = $(this).data("class");
			window.location = BASE_REQUEST+'/practice/class-'+memclass+'/subject-'+alias+'-'+numbersubject;
		<?php else: ?>
			alert('<?php echo $language['login'];?>');
		<?php endif; ?>
	});
</script>

{children [position=box-achievement]}
