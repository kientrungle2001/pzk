<style>
#hotnew{
	display:none; position:fixed; right:3px; bottom: 200px; 
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
.newbox2 {
    position: fixed;
    right: 5px;
    bottom: 10px;
    width: 350px;
    height: 415px;
    margin: 0px !important;
    z-index: 9999;
    /*background: url(../media/img.png) no-repeat;*/
    background-size: 50%;
    -webkit-box-shadow: 1px 1px 10px 0px rgba(50, 50, 50, 0.75);
    -moz-box-shadow: 1px 1px 10px 0px rgba(50, 50, 50, 0.75);
    box-shadow: 1px 1px 10px 0px rgba(50, 50, 50, 0.75);
    background-color: #fff;
    background-position: bottom right;
}
.achievement{
	text-align: center;
}
.title-achievement{
	font-size: 14px;
	position:absolute;
	z-index:10;
	text-transform: uppercase;
    border: 1px dotted #ec2064;
	padding: 10px 5px;
	background: white;
	width: 235px;
	left: 40px;
	top: -22px;
}
.alert-dismissible .close{
	right: -4px !important;
}
.alert-dismissible{
	padding-right: 15px !important;
}
.box-achie{
	position: relative;
	border: 1px dotted #ec2064;
	border-bottom: none;
	margin-bottom: 10px;
}
.child-box-achie{
	 border-bottom: 1px dotted #ec2064;
	 padding: 10px;;
	 font-weight: bold;
	 
}
</style>
<div onclick='return opentb();' id='hotnew' class='tinmoi hidden-xs'>Xem thành tích</div>
<div class="alert alerttb newbox2 alert-dismissible hidden-xs">
  <button onclick='return closetb();' type="button" class="close" ><span aria-hidden="true">&times;</span></button>
  <div class='achievement'>
	<img style='width: 80px; margin-bottom: 28px;' src="/Themes/Songngu/skin/media/cup.png" /><br>
	<div class='box-achie item'>
		<?php
		$week = date('W');
		$year = date('Y');
		
		if($week > 1){
			$weekActive = $week -1;
		}else{
			$weekActive = 52;
			$year = $year - 1;
		}
		
		$achievementByTree = $data->getOneAchievement($weekActive, $year, pzk_session('lop'), 'tree desc');
		
		
		
		
		?>
		<b class ='title-achievement'>Bảng thành tích tuần <?php echo $weekActive; ?><br><span style='font-weight: normal;text-transform: lowercase;'>(<?php $date = startEndDateOfWeek($weekActive-1, $year, true); echo $date['startdate'].' đến '. $date['enddate']; ?>)</span></b> 
		<p style="height: 25px;"></p>
		<?php if($achievementByTree){ ?>
		 <div class='child-box-achie item'>
			<img  style='float: left; width: 50px;' src="/Themes/Songngu/skin/media/achievement1.png" />
			<span style='color: #00d0ce;'>Học sinh chăm chỉ nhất</span></br>
			<b><?=$achievementByTree['name'];?></b></br>
			<span>(<?=$achievementByTree['username'];?>)</span>
		 </div>
		<?php } ?>
		<?php 
		$achievementByFlower = $data->getOneAchievement($weekActive, $year, pzk_session('lop'), 'flower desc');
		if($achievementByFlower){
		?>
		 <div class='child-box-achie item'>
			<img  style='float: left; width: 50px;' src="/Themes/Songngu/skin/media/achievement2.png" />
			<span style='color: #009db3;'>Học sinh luyện tập hiệu quả nhất</span></br>
			<b><?=$achievementByFlower['name'];?></b></br>
			<span>(<?=$achievementByFlower['username'];?>)</span>
		 </div>
		 <?php } ?>
		 
		<?php 
		$achievementByApple = $data->getOneAchievement($weekActive, $year, pzk_session('lop'), 'apple desc');
		if($achievementByApple){
		?>
		 <div class='child-box-achie item'>
			<img  style='float: left; width: 50px;' src="/Themes/Songngu/skin/media/achievement3.png" />
			<span style='color: #ff3b06;'>Học sinh làm đề thi tốt nhất</span></br>
			<b><?=$achievementByApple['name'];?></b></br>
			<span>(<?=$achievementByApple['username'];?>)</span>
		 </div>
		<?php } ?>
	</div>
	 <p>Xem chi tiết <a href='/home/achievement' style="color: #ec2064; text-decoration: "><b>TẠI ĐÂY</b></a></p>
  </div>
  <div>
		
  </div>
</div>
<script>
function closetb() {
	
	$('.alerttb').hide();
	$('#hotnew').show();
	localStorage.setItem("sessionAlert", "1");
	
}
function opentb() {
	$('.alerttb').show();
	$('#hotnew').hide();
}
$( document ).ready(function() {
    var check = localStorage.getItem("sessionAlert");
	
	if(check == 1) {
		$('.newbox2').hide();
		$('#hotnew').show();
		setInterval(function(){ 
			localStorage.clear(); 
		}, 1800000);
	}
	
});
</script>