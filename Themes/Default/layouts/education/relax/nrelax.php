<div class="container relax hidden-xs">
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
<div class="container top20">
	<div class="col-md-5 col-xs-5">
		{children [position=top-left-left]}
	</div>
	<div class="col-md-7 col-xs-7">
		<div class="row">
			<div class="col-md-8 col-xs-8">
				{children [position=top-right-left]}
			</div>
			<div class="col-md-4 col-xs-4">
				<div class="row">
					<div onclick="return false;" class="col-md-12 col-xs-12 full padding5 flclick pointer">
						<div class="col-md-8">
						<p class="top10">FULL LOOK</p>
						</div>
						<div class="col-md-4">
						<a href="{? echo FL_URL ?}"><img class="image-responsive center-block" src="<?=BASE_SKIN_URL?>/Default/skin/nobel/test/Themes/Default/media/full.png"></a>
						</div>
					</div>
					<div onclick="return false;" class="col-md-12 col-xs-12 full padding5 vvclick pointer">
						<div class="col-md-8">
						<p class="top10">Luyện viết văn miêu tả</p>
						</div>
						<div class="col-md-4">
						<a href="{? echo NOBEL_URL ?}"><img class="image-responsive center-block" src="<?=BASE_SKIN_URL?>/Default/skin/nobel/test/Themes/Default/media/vietvan.png"></a>
						</div>
					</div>
					<div onclick="return false;" class="col-md-12 col-xs-12 full padding5 allclick pointer">
						<div class="col-md-8">
						<p class="top10">Khảo sát năng lực toàn diện</p>
						</div>
						<div class="col-md-4">
						<a href="{? echo NOBEL_URL ?}"><img class="image-responsive center-block" src="<?=BASE_SKIN_URL?>/Default/skin/nobel/test/Themes/Default/media/khaosat.png"></a>
						</div>
					</div>
					<div onclick="return false;" class="col-md-12 col-xs-12 full padding5 tvclick pointer">
						<div class="col-md-8">
						<p class="top10">Tiếng việt vui</p>
						</div>
						<div class="col-md-4">
						<a href="{? echo NOBEL_URL ?}"><img class="image-responsive center-block" src="<?=BASE_SKIN_URL?>/Default/skin/nobel/test/Themes/Default/media/tiengvietvui.png"></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	
</div>
<div class="container fivecolumns">
	<div class="item top20 text-center">
		<div onclick='showsub(138); return false;' class="btn-custom20 sharp col-md-3 col-xs-2 divbold mgr3" >Bài hát</div>
		<div  onclick='showsub(139); return false;' class=" btn-custom20 sharp col-md-3 col-xs-2 divbold mgr3">Thơ</div>
		<div  onclick='showsub(140); return false;' class=" btn-custom20 sharp col-md-3 col-xs-2 divbold mgr3">Truyện</div>
		<div  onclick='showsub(141); return false;' class=" btn-custom20 sharp col-md-3 col-xs-2 divbold">Bài viết</div>
	</div>
</div>
<div class="container top20 text-justify" id="chitiet">
	{children [position=showdetail]}
</div>
<script>
function chitiet(id){
	$("#chitiet").load(BASE_REQUEST + "/relax/ajaxdetail?id="+id);
}
function showsub(id){
	$("#chitiet").load(BASE_REQUEST + "/relax/showsubject?id="+id);
}
$(".flclick").click(function(){
		window.location = BASE_REQUEST+'/home';
});	
$(".vvclick").click(function(){
		window.location = BASE_REQUEST+'/home';
});	
$(".allclick").click(function(){
		window.location = BASE_REQUEST+'/home';
});	
$(".tvclick").click(function(){
		window.location = BASE_REQUEST+'/home';
});	
</script>