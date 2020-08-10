<style>
#hotnew1{
	display:none;
	position:fixed; bottom: 180px; 
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
				<a class="btn btn-danger" rel="/language/en" onclick="select_language('en');return false;" href="#">Tiếng Anh</a> | <a class="btn btn-warning" rel="/language/vn" onclick="select_language('vn');return false;" href="#">Tiếng Việt</a> | <a class="btn btn-success" rel="/language/ev" onclick="select_language('ev');return false;" href="#">Song ngữ</a>		
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
	<a href="http://tdn.thitai.vn/contest/about" target="_blank"><p style="color:white; fontsize:24px!important; text-align:center; margin-top:60px;">Thi<br/>thử<br/>vào<br/>trường<br/>Trần<br/>Đại<br/>Nghĩa<br/>năm<br/>2017</p></a>
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

<div class="container top10">
<marquee>
Chương trình đã được bảo hộ bảo bản quyền bởi cục Sở hữu Trí tuệ Việt Nam. Mọi vi phạm bản quyền chương trình đều bị xử lí theo pháp luật.
</marquee>
</div>

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
	<p class="t-weight text-center btn-custom8 textcl">Đề thi trắc nghiệm</p>
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
	
	<div class="col-md-12 text-center col-xs-12 text-uppercase btn-custom3 pd-10 weight-16 left0">
		<a href="/test/test/22?practice=0&class=5" class="text-color">Đề thi chính thức vào lớp 6 Trường Trần Đại Nghĩa 2015</a>
	</div>
	<div class="col-md-12 text-center col-xs-12 text-uppercase btn-custom3 pd-10 weight-16 left0">
		<a href="/test/test/89?practice=0&class=5" class="text-color">Đề thi chính thức vào lớp 6 Trường Trần Đại Nghĩa 2016</a>
		
	</div>
	<div class="col-md-12 text-center col-xs-12 text-uppercase btn-custom3 pd-10 weight-16 left0">
		<a href="/test/test/127?practice=0&class=5" class="text-color">Đề thi chính thức vào lớp 6 Trường Trần Đại Nghĩa 2017</a>
		
	</div>
	
</div>


<div id="testtl" class="container top20">
	<p class="t-weight text-center btn-custom8 textcl">Đề thi tự luận tham khảo</p>
</div>

<div id="testtl-section" class="container pdbot-60">
	
	<div class="row ajaxchangetl">
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
		
		$(".ajaxchangetl").load(BASE_REQUEST + "/home/showtesttl?class="+numberclass, function() {
			$("#practice-test-section .btn-custom3").css("background-color", '#C6CCDC');
		});
		
		$("#practice-section .btn-custom3").css("background-color", '#A0D4CE');
	});
	
	<?php if(pzk_request('class')) : ?>
		$(".btnclick[data-class=<?php echo intval(pzk_request('class')) ?>]").trigger("click");
	<?php endif; ?>
	$(".nullclass").click(function(){
		alert('Bạn cần đăng nhập để sử dụng chức năng này');
	});

</script>

