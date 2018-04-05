<?php 
$signActive = pzk_session('checkPayment');
$language = pzk_global()->get('language');
$languagevn = pzk_global()->get('languagevn');
$memberlang = pzk_session('paymentLanguages');
$lang = pzk_session('language');
$login = pzk_session('userId');


?>

<div id="carousel-example-generic" class="carousel item slide" data-ride="carousel">


<style style="text/css">
/*
.example1 {
 height: 50px;	
 overflow: hidden;
 width: 100%; float: left;
}
.example1 h4 {
 color: white;
 position: absolute;
 width: 100%;
 height: 100%;
 margin: 0;
 line-height: 50px;
 text-align: center;
 /* Starting position */
 -moz-transform:translateX(100%);
 -webkit-transform:translateX(100%);	
 transform:translateX(100%);
 /* Apply animation to this element */	
 -moz-animation: example1 20s linear infinite;
 -webkit-animation: example1 20s linear infinite;
 animation: example1 20s linear infinite;
}
/* Move it (define the animation) */
@-moz-keyframes example1 {
 0%   { -moz-transform: translateX(100%); }
 100% { -moz-transform: translateX(-100%); }
}
@-webkit-keyframes example1 {
 0%   { -webkit-transform: translateX(100%); }
 100% { -webkit-transform: translateX(-100%); }
}
@keyframes example1 {
 0%   { 
 -moz-transform: translateX(100%); /* Firefox bug fix */
 -webkit-transform: translateX(100%); /* Firefox bug fix */
 transform: translateX(100%); 		
 }
 100% { 
 -moz-transform: translateX(-100%); /* Firefox bug fix */
 -webkit-transform: translateX(-100%); /* Firefox bug fix */
 transform: translateX(-100%); 
 }
}
*/
</style>

<!-- HTML -->	
<!--div  style="position: absolute; top: 5px; z-index: 99;" class="example1">
<h4>HỌC HÈ CÙNG FULL LOOK (GIẢM 30% GIÁ GỐC) </h4>
</div-->

  
<ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
	<li data-target="#carousel-example-generic" data-slide-to="3"></li>
  </ol>
  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
		<div class="relative item">
			<?php if(!$lang || $lang == 'vn'){ ?>
				<img class="item" src="/Themes/Songngu3/skin/images/slider.png" />
			<?php }else{ ?>
				<img class="item" src="/Themes/Songngu3/skin/images/slider12.png" />
			<?php } ?>
			<div class="absolute hidden-xs language">
				<span onclick="select_en();"><img src="/Themes/Songngu3/skin/images/en.png" /><?=$language['en']?></span>
				<span onclick="select_vn();"><img src="/Themes/Songngu3/skin/images/vn.png" /><?=$language['vn']?></span>
				<span onclick="select_ev();"><img src="/Themes/Songngu3/skin/images/ev.png" /><?=$language['ev']?></span>
			</div>
			<div class="absolute visible-xs language language-xs">
				<span onclick="select_en();"><img src="/Themes/Songngu3/skin/images/en.png" /><?=$language['en']?></span>
				<span onclick="select_vn();"><img src="/Themes/Songngu3/skin/images/vn.png" /><?=$language['vn']?></span>
				<span onclick="select_ev();"><img src="/Themes/Songngu3/skin/images/ev.png" /><?=$language['ev']?></span>
			</div>
		</div>
    </div>
	<!--div class="item">
		<img class="item" src="/Themes/Songngu3/skin/images/banner20-11.jpg" />
	</div-->
    <div class="item">
			<?php if(!$lang || $lang == 'vn' ){ ?>
				 <img class="item" src="/Themes/Songngu3/skin/images/slider2.png" />
			<?php }else{ ?>
				<img class="item" src="/Themes/Songngu3/skin/images/slider2.png" />
			<?php } ?>
     
    </div>
   <div class="item">
			<?php if(!$lang || $lang == 'vn'){ ?>
				 <img class="item" src="/Themes/Songngu3/skin/images/slider3.png" />
			<?php }else{ ?>
				<img class="item" src="/Themes/Songngu3/skin/images/slider32.png" />
			<?php } ?>
    </div>
	 <div class="item">
      <?php if(!$lang || $lang == 'vn'){ ?>
				 <img class="item" src="/Themes/Songngu3/skin/images/slider4do2.png" />
			<?php }else{ ?>
				<img class="item" src="/Themes/Songngu3/skin/images/slider4d2.png" />
			<?php } ?>
    </div>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<!--div class="item mgt30">
<div class="container">
	<marquee>
	Chương trình đã được bảo hộ bản quyền bởi cục Sở hữu Trí tuệ Việt Nam. Mọi vi phạm bản quyền chương trình đều bị xử lí theo pháp luật.
	</marquee>
	
</div>
</div-->

<div class="container top10">

<div class="item">
    <marquee behavior="scroll" direction="left" scrollamount="5" style="width:100%; height:100%; vertical-align:middle; cursor:pointer;" onmouseover="javascript:this.setAttribute('scrollamount','0');" onmouseout="javascript:this.setAttribute('scrollamount','5');">
    <strong class="red">Full Look – Phần mềm Khảo sát & Phát triển Năng lực dành cho HS ôn thi vào lớp 6</strong>
    </marquee>
 </div>

</div>

<div class="item">
	<div class="container hidden-xs menu2">
		<a href="/home/detail">
		<?php if(!$lang || $lang == 'vn' ){ ?>
			<img src="/Themes/Songngu3/skin/images/gioithieusanpham2.png" />
		<?php } else { ?>
			<img src="/Themes/Songngu3/skin/images/gioithieusanpham22.png" />
		<?php } ?>
		
		</a>
		<a href="#">
		<?php if(!$lang || $lang == 'vn' ){ ?>
			<img src="/Themes/Songngu3/skin/images/dungthu2.png" />
		<?php } else { ?>
			<img src="/Themes/Songngu3/skin/images/dungthu22.png" />
		<?php } ?>
		
		</a>
		<a href="/home/detail?tab8=1">
		<?php if(!$lang || $lang == 'vn' ){ ?>
			<img src="/Themes/Songngu3/skin/images/muasp2.png" />
		<?php } else { ?>
			<img src="/Themes/Songngu3/skin/images/muasp22.png" />
		<?php } ?>
		</a>
		<a href="/huong-dan-su-dung-song-ngu">
		<?php if(!$lang || $lang == 'vn' ){ ?>
			<img src="/Themes/Songngu3/skin/images/huongdansd2.png" />
		<?php } else { ?>
			<img src="/Themes/Songngu3/skin/images/huongdansd22.png" />
		<?php } ?>
		
		</a>
		<a href="javascript:void(0);" data-toggle="modal" data-target="#home-review" >
		<?php if(!$lang || $lang == 'vn' ){ ?>
			<img src="/Themes/Songngu3/skin/images/danhgia2.png" />
		<?php } else { ?>
			<img src="/Themes/Songngu3/skin/images/danhgia22.png" />
		<?php } ?>
		
		</a>
	</div>
	<div class="container visible-xs mb-menu2 mgt10">
		<a class="color1" href="/home/detail"><?=$language['introduction']?></a>
		<a class="color2" href="#"><?=$language['trial']?></a>
		<a class="color3" href="/home/detail?tab8=1"><?=$language['buy']?></a>
		<a class="color4" href="/huong-dan-su-dung-song-ngu"><?=$language['guide']?>	</a>
		<a class="color5" data-toggle="modal" data-target="#home-review"  href="javascript:void(0);"><?=$language['commentary']?></a>
	</div>
</div>


<!-- Modal -->
<div id="home-review" class="modal fade" role="dialog">
  <div class="modal-dialog  modal-lg">

    <!-- Modal content-->
    <div class="modal-content bg-review">
		<button style="color: white;opacity: 1;width: 30px;font-size: 30px;position: absolute;right: 0px;" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<div class="box-review">
			<div class="review-top">		
				<div class="item">
				<b>Full Look (Song ngữ Anh - Việt)</b> là phần mềm học tập được tạo ra với tất cả tâm huyết của chúng tôi nhằm hướng tới một nền giáo dục phát triển năng lực cho người học, đồng thời giúp học sinh Việt Nam từng bước tiếp cận chương trình tiếng Anh tích hợp với chi phí thấp nhất, hiệu quả nhất.

				Vì thế chúng tôi rất mong nhận được sự đóng góp ý kiến quý báu từ các chuyên gia, các bậc phụ huynh và các em học sinh để chương trình được hoàn thiện. Để lại lời nhận xét góp ý hay động viên của quý vị dưới đây : 
				</div>
				<textarea id="v_content" class="item"></textarea>
				Trân trọng cảm ơn!

			</div>
			<div class="review-footer item text-center">
				<div onclick="vote();" class="send-review"> GỬI ĐÁNH GIÁ</div>
			</div>
			<img class="absolute hidden-xs girl-review" src="/Themes/Songngu3/skin/images/girl-review.png" />
			<img class="absolute hidden-xs bui" src="/Themes/Songngu3/skin/images/bui.png" />
		</div>
       
    </div>

  </div>
</div>
<script>
	function vote() {
		<?php if(pzk_session('userId')){ 
			
		?>
			var content = $("#v_content").val();
			
			if(content ==''){
				$("#v_content").focus();
				return false;
			}
			
			$.ajax({
					url:BASE_REQUEST + '/home/vote',
					method: "POST",
					data:{
						content: content,
						
					}, 
					success:function(result){
						if(result == 1){
							$("#v_content").val('');
							alert('Gửi đánh giá thành công!');
							$('#home-review').modal('hide');
						}
					}
				});
			return false;
		<?php }else { ?>
			var state = confirm("<?php echo $language['login'];?>");
			if(state == true){
				$('#home-review').modal('hide');
				$("#LoginModal").modal();
		}
		<?php } ?>
	}
</script>
