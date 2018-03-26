{children [position=public-header]}
{children [position=top-menu]}
<div class="container top20">
	<div class="col-md-6 col-sm-6 col-xs-12 top10">
		{children [position=top-left-left]}
	</div>
	<div class="col-md-6 col-sm-6 col-xs-12 top10">
		{children [position=top-right-left]}
	</div>	
</div>
<div class="container top20">
	<div class="item text-center">
		<button onclick='showsub(138); return false;' class="col-md-3 col-sm-3 col-xs-6 sharp divbold btn-custom20">Bài hát</button>
		<button onclick='showsub(139); return false;' class="col-md-3 col-sm-3 col-xs-6 sharp divbold btn-custom20">Thơ</button>
		<button onclick='showsub(140); return false;' class="col-md-3 col-sm-3 col-xs-6 sharp divbold btn-custom20">Truyện</button>
		<button onclick='showsub(141); return false;' class="col-md-3 col-sm-3 col-xs-6 sharp divbold btn-custom20">Bài viết</button>
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