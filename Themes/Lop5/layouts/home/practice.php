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
<div class="container fulllook2 text-left hidden-xs">
	<div class="row">
		<div class="col-md-1">&nbsp;</div>			
		<div class="col-xs-11 col-md-11">
			<div class="pd-90 text-right">
				<h1><a href="<?=FL_URL?>">FULL LOOK</a></h1>
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
<div class="" style="margin-left:15px !important;">
<?php $data->displayChildren('[position=top-menu]') ?>
</div>
<?php if(!pzk_request()->isMobileAndTablet()):?>
<div onclick='return opentb1();' id='hotnew1' class='tinmoi1 hidden-xs'>Hiện banner</div>
<div class="hbanner2 alert1 newbox1 hidden-xs" style='width:90px; position:fixed; left:0; top:53px; background-color:#0072BC; height:550px;'>
	<button onclick='return closetb1();' type="button" class="close" ><span style="color:white; z-index:9999;" aria-hidden="true">&times;</span></button>
	<a href="http://tdn.thitai.vn/contest/news/111"><p style="color:white; fontsize:24px!important; text-align:center; margin-top:60px;">Gói<br/>xem<br/>đề<br/>và<br/>đáp<br/>án<br/>thi<br/>thử<br/>trắc<br/>nghiệm<br/>và<br/>tự<br/>luận<br/>đợt<br/>1,2</p></a>
</div>
<script>
function closetb1() {
	$('.alert1').hide();
	$('#hotnew1').show();
	
}
function opentb1() {
	$('.alert1').show();
	$('#hotnew1').hide();
}

</script>
<?php endif; ?>
<div id="practice" class="container top10">
	<p class="t-weight text-center btnclick btn-custom8 textcl">Luyện tập</p>
</div>
<?php ?>
<div class="container" id="subject">
	<div id="practice-section" class="row fivecolumns">
		<?php $data->displayChildren('[position=show-subject]') ?>
	</div>
</div>

<div id="practice-test" class="container top20">
	<p class="t-weight text-center btn-custom8 textcl">Bài luyện tập tổng hợp</p>
</div>
<div id="practice-test-section" class="container pdbot-60">
	<div class="row ajaxchangepractice">
		<?php $numberclass = intval(pzk_request('class')); ?>
		<?php if(!$numberclass):?>
		<?php for($i = 18; $i>1; $i--){ ?>
		<div class="col-md-2 text-center col-xs-3 text-uppercase btn-custom3 pd-10 weight-16 widthfix">
			<a onclick ="return false;" class="nullclass" href="" class="text-color">Đề <?php echo $i; ?></a>
		</div>
		<?php } ?>
		<div class="col-md-2 text-center col-xs-3 text-uppercase btn-custom3 pd-10 weight-16 widthfix">
			<a href="" class="text-color nullclass">...</a>
		</div>
		<?php else:?>
		<?php $data->displayChildren('[position=practice-place]') ?>
		<?php endif; ?>
	</div>
</div>

<div id="test" class="container top20">
	<p class="t-weight text-center btn-custom8 textcl">Đề thi</p>
</div>

<div id="test-section" class="container pdbot-60">
	
	<div class="row ajaxchange">
		<?php $numberclass = intval(pzk_request('class')); ?>
		<?php if(!$numberclass):?>
		<?php for($i = 18; $i>1; $i--){ ?>
		<div class="col-md-2 text-center col-xs-3 text-uppercase btn-custom3 pd-10 weight-16 widthfix">
			<a onclick ="return false;" class="nullclass" href="" class="text-color">Đề <?php echo $i; ?></a>
		</div>
		<?php } ?>
		<div class="col-md-2 text-center col-xs-3 text-uppercase btn-custom3 pd-10 weight-16 widthfix">
			<a href="" class="text-color nullclass">...</a>
		</div>
		<?php else:?>
		<?php $data->displayChildren('[position=test-place]') ?>
		<?php endif; ?>
	</div>
	
	
</div>


<div id="testtl" class="container top20">
	<p class="t-weight text-center btn-custom8 textcl">Đề tự luận</p>
</div>

<div id="testtl-section" class="container pdbot-60">
	
	<div class="row ajaxchange">
		<?php $numberclass = intval(pzk_request('class')); ?>
		<?php if(!$numberclass):?>
		<?php for($i = 18; $i>1; $i--){ ?>
		<div class="col-md-2 text-center col-xs-3 text-uppercase btn-custom3 pd-10 weight-16 widthfix">
			<a onclick ="return false;" class="nullclass" href="" class="text-color">Đề <?php echo $i; ?></a>
		</div>
		<?php } ?>
		<div class="col-md-2 text-center col-xs-3 text-uppercase btn-custom3 pd-10 weight-16 widthfix">
			<a href="" class="text-color nullclass">...</a>
		</div>
		<?php else:?>
		<?php $data->displayChildren('[position=testtl-place]') ?>
		<?php endif; ?>
	</div>
	
	
</div>

<div class="col-md-12 text-center col-xs-12 text-uppercase btn-custom3 pd-10 weight-16 left0">
	<a href="/test/test/22?practice=0&class=5" class="text-color">Đề thi chính thức vào lớp 6 Trường Trần Đại Nghĩa 2015</a>
</div>
<div class="col-md-12 text-center col-xs-12 text-uppercase btn-custom3 pd-10 weight-16 left0">
	<a href="/test/test/89?practice=0&class=5" class="text-color">Đề thi chính thức vào lớp 6 Trường Trần Đại Nghĩa 2016</a>
</div>

<?php $data->displayChildren('[position=bottom-slide]') ?>	
		
<script>
	numberclass = 5;
	$(".btnclick").click(function(){
		numberclass = $(this).data("class");
		var color = $(this).attr("rel");
		var jumping = $(this).data("jumping");
		window.location.hash = '#' + jumping;
		$(window).scrollTop($(window).scrollTop() - 50);
		var numclass = $(this).data("class");
	});
	$(function() {
		$(".ajaxchange").load(BASE_REQUEST + "/home/showtestnumber?class="+numberclass, function() {
			$("#test-section .btn-custom3").css("background-color", '#E0C7A3');
		});
		$(".ajaxchangepractice").load(BASE_REQUEST + "/home/showpracticenumber?class="+numberclass, function() {
			$("#practice-test-section .btn-custom3").css("background-color", '#B6D452');
		});	
		$("#practice-section .btn-custom3").css("background-color", '#A0D4CE');
	});
	
	$(".subjectclick").click(function(){
		<?php if(pzk_session('userId')): ?>
			var numbersubject = $(this).data("subject");
			var alias = $(this).data("alias");
			window.location = BASE_REQUEST+'/practice/class-'+numberclass+'/subject-'+alias+'-'+numbersubject;
		<?php else: ?>
			alert('Bạn cần đăng nhập để sử dụng chức năng này');
		<?php endif; ?>
	});
	$(".tailieu").click(function(){
		window.location = BASE_REQUEST+'/document/home';
	});
	$(".quatang").click(function(){
		window.location = BASE_REQUEST+'/gift';
	});
	$(".game").click(function(){
		window.location = BASE_REQUEST+'/game';
	});
	
	<?php if(pzk_request('class')) : ?>
		$(".btnclick[data-class=<?php echo intval(pzk_request('class')) ?>]").trigger("click");
	<?php endif; ?>
	$(".nullclass").click(function(){
		alert('Bạn cần đăng nhập để sử dụng chức năng này');
	});

</script>

