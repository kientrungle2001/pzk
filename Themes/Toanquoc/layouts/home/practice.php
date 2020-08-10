<div class="container fulllook2 text-left">
	<div class="row">
		<div class="col-md-1">&nbsp;</div>			
		<div class="col-xs-11 col-md-11 ">
			<div class="pd-90 text-right">
				<h1><a href="<?=FL_URL?>">FULL LOOK</a></h1>	
				<h3>Phần mềm Khảo sát và Phát triển năng lực toàn diện bằng tiếng Anh</h3>
				<?php echo partial('Themes/Default/layouts/home/aboutbtn');?>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="row fivecolumns nomgleft mgright5">
	<button onclick ="return false;" rel="#A0D4CE" data-class="3" type="button" class="btn btnclick  btn-custom5  sharp <?php echo $btnActive ?> col-md-2 col-xs-6 fsize">Lớp 3</button>
	
	<button onclick ="return false;" data-class="4" rel="#B6D452" type="button" class="btn btnclick btn-custom6 sharp <?php echo $btnActive ?> col-md-2 col-xs-6 fsize">Lớp 4</button>
	
	<button onclick ="return false;" data-class="5" rel="#E0C7A3" type="button" class="btn btnclick btn-custom7  sharp <?php echo $btnActive ?> col-md-2 col-xs-6 fsize">Lớp 5</button>
	
	<button onclick ="return false;"  type="button" class="btn btn-custom9 quatang sharp <?php echo $btnActive ?> col-md-2 col-xs-6 fsize">Quà tặng</button>
	
	<button href="home/game" rel="#E0C7A3" type="button" class="btn btn-custom10  sharp <?php echo $btnActive ?> col-md-2 col-xs-6 fsize">Game</button>
	</div>
</div>

<div class="container top10">
	<p class="t-weight text-center btnclick btn-custom8 textcl">Luyện tập</p>
</div>
<div class="container" id="subject">
	<div class="row fivecolumns">
		<?php $data->displayChildren('[position=show-subject]') ?>
	</div>
</div>
<div class="container top20">
	<p class="t-weight text-center btn-custom8 textcl">Đề luyện tập</p>
</div>
<div class="container pdbot-60">
	<div class="row ajaxchangepractice">
		<?php $numberclass = pzk_request('class'); ?>
		<?php if(!$numberclass):?>
		<?php for($i = 18; $i>1; $i--){ ?>
		<div class="col-md-2 text-center col-xs-2 text-uppercase btn-custom3 pd-10 weight-16 widthfix">
			<a onclick ="return false;" class="nullclass" href="" class="text-color">Đề <?php echo $i; ?></a>
		</div>
		<?php } ?>
		<div class="col-md-2 text-center col-xs-2 text-uppercase btn-custom3 pd-10 weight-16 widthfix">
			<a href="" class="text-color">...</a>
		</div>
		<?php else:?>
		<?php $data->displayChildren('[position=practice-place]') ?>
		<?php endif; ?>
	</div>
</div>
<div class="container top20">
	<p class="t-weight text-center btn-custom8 textcl">Đề thi</p>
</div>
<div class="container pdbot-60">
	<div class="row ajaxchange">
		<?php $numberclass = pzk_request()->getInt('class'); ?>
		<?php if(!$numberclass):?>
		<?php for($i = 18; $i>1; $i--){ ?>
		<div class="col-md-2 text-center col-xs-2 text-uppercase btn-custom3 pd-10 weight-16 widthfix">
			<a onclick ="return false;" class="nullclass" href="" class="text-color">Đề <?php echo $i; ?></a>
		</div>
		<?php } ?>
		<div class="col-md-2 text-center col-xs-2 text-uppercase btn-custom3 pd-10 weight-16 widthfix">
			<a href="" class="text-color">...</a>
		</div>
		<?php else:?>
		<?php $data->displayChildren('[position=test-place]') ?>
		<?php endif; ?>
	</div>
</div>
<?php $data->displayChildren('[position=bottom-slide]') ?>			
<script>
	numberclass = 3;
	$(".btnclick").click(function(){
		numberclass = $(this).data("class");
		var color = $(this).attr("rel");
		var numclass = $(this).data("class");
		$(".ajaxchange").load(BASE_REQUEST + "/home/showtestnumber?class="+numclass, function() {
			$(".btn-custom3").css("background-color", color);
		});
		$(".ajaxchangepractice").load(BASE_REQUEST + "/home/showpracticenumber?class="+numclass, function() {
			$(".btn-custom3").css("background-color", color);
		});
		$(".btn-custom3").css("background-color", color);
	});
	$(".subjectclick").click(function(){
		<?php if(pzk_session('userId')): ?>
			var numbersubject = $(this).data("subject");
			window.location = BASE_REQUEST+'/practice/detail/'+numbersubject+'?class='+numberclass;
		<?php else: ?>
			alert('Bạn cần đăng nhập để sử dụng chức năng này');
		<?php endif; ?>
	});
	$(".quatang").click(function(){
		window.location = BASE_REQUEST+'/home/relax';
	});
	// neu co request class
		// trigger nut bam chon lop click
			//$(".btnclick[data-class="+class+"]").click();
	<?php if($class = pzk_request()->getInt('class')) : ?>
		$(".btnclick[data-class=<?php echo $class ?>]").trigger("click");
	<?php endif; ?>
	$(".nullclass").click(function(){
		alert('Bạn cần chọn lớp trước');
	});
</script>

