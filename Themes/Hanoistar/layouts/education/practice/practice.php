

<?php
	$language =pzk_global()->get('language');
	$languagevn = pzk_global()->get('languagevn');
	$lang = 'vn';
	
?>
<?php $data->displayChildren('[position=public-header]') ?>




<div id="practice" class="item">
	<div class="container">
		<div style="margin-bottom: 15px;" class="text-center btnclick textlt">
		<?php echo $language['practice'];?> <?php //if(pzk_session('lop')){ echo ' - '; echo $language['classnumber']; echo pzk_session('lop');}?></br>
		-----
		</div>
	</div>
</div>

<div class="container top10">

<div class="item">
    <marquee behavior="scroll" direction="left" scrollamount="5" style="width:100%; height:100%; vertical-align:middle; cursor:pointer;" onmouseover="javascript:this.setAttribute('scrollamount','0');" onmouseout="javascript:this.setAttribute('scrollamount','5');">
    <?php echo $language['copyright'];?>
    </marquee>
 </div>

</div>

<?php ?>
<div class="container mgb30" id="subject">
	<div id="practice-section" class="row fivecolumns">
		<?php $data->displayChildren('[position=show-subject]') ?>
	</div>
</div>
<div id="practice-test" class="item">
	<div class="relative item">
		<img class="item" src="/Themes/Songngu3/skin/images/bg1.png" />
		<div  class="item visible-xs hfix"></div>
		<div class="t-weight deluyentap textlt item text-center absolute">
		Đề khảo sát theo định kì</br>
		-----
	</div>
	</div>
</div>



<div class="item bg2">
	<div class="t-weight text-center textlt mgb15 item">Đề thi trực tuyến<br>
		-----
		</div>
	<div class="container pdb80">
		<div class="row">
			<?php $data->displayChildren('[position=test-compability]') ?>
		</div>
	</div>

</div>

<div class="item bg3">
	<div class=" text-center white fs30 cadena mgb30 mgt60 item">
	
		Góc tư vấn</br>
		-----
	</div>
	<div class="container ">
		<div class="col-md-6 col-xs-12">
			<div class="col-md-6 col-xs-12">
				<img style="max-width: 150px;" class="item" src="/Themes/Hanoistar/skin/images/baccumeo.png" />
			</div>
			<div class="col-md-6 col-xs-12 ">
				<div class="white uppercase cadena bold mgb5 fs30">
					<a href="/tuvan">học tập</a>
				</div>
				<div class="white mgb10">
					&nbsp;
				</div>
			</div>
		</div>
		
		<div class="col-md-6 col-xs-12">
			<div class="col-md-6 col-xs-12">
				<img style="max-width: 120px;" class="item" src="/Themes/Hanoistar/skin/images/cocaheo.png" />
			</div>
			<div class="col-md-6 col-xs-12">
				<div class="white uppercase cadena mgb5 fs30">
					<a href="/tuvan">tâm lý</a>
				</div>
				<div class="white mgb10">
					
				</div>
			</div>
		</div>
		<div class="item h145"></div>
	</div>
</div>

<div class="item bg4">
	<div class=" text-center  fs30 cadena mgt10 item">
	<?php echo $language['halloffame'];?></br>
	- - - - -
	</div>
	
	<?php $data->displayChildren('[position=box-achievement]') ?>

</div>

<div class="item cadena bgsn">
	<img class="item" src="/Themes/Hanoistar/skin/images/topbirthday.png" />
	<div class=" text-center textsn fs30  mgt10 item">
	<?php echo $language['birthday'];?></br>
	- - - - -
	</br>
	</div>
	
	<?php 
	$userSn = _db()->select('*')->fromUser()->whereStatus(1)->likeBirthday('%'.date('-m-d'))->result();
	if(count($userSn) > 0){
	?>
	
	<div class="container textsn cadena">
	
	<div id="carousel-sn" class="carousel carousel-sn slide" data-ride="carousel-sn">
	  <!-- Indicators -->
	  <ol class="carousel-indicators">
	  <?php if($userSn){ 
		$countuser = count($userSn);
		if($countuser > 1){
		$i=1;
		for($i=0; $i<$countuser; $i++){
			?>
		<li data-target="#carousel-sn" data-slide-to="<?=$i;?>" class="<?php if($i==0){ echo 'active';}?>"></li>
		<?php } } } ?>
	  </ol>

	  <!-- Wrapper for slides -->
	  <div style="padding-top: 55px;" class="carousel-inner" role="listbox">
	  
		<?php if($userSn){ 
		$i=1;
		foreach($userSn as $user){
		?>
		<div class="item <?php if($i == 1){ echo 'active';} ?>">

			<div class="col-md-1 hidden-xs"></div>
			<div class="col-xs-12 col-md-5">
				<div class="pull-left mgr10 relative">
					<img style="max-width: 70px;" class="pull-left" src="/Themes/Hanoistar/skin/images/avata.png" />
					<img style="top: -54px; left: -20px; z-index: 99999;" class="absolute" src="/Themes/Hanoistar/skin/images/musn.png" />
				</div>
				<div class="pull-left">
				<b class="text-uppercase"><?=$user['name'];?></b></br>
				<?=$user['address'];?>
				</div>
			</div>
			
			<div class="col-xs-12 col-md-5">
				<p><b>Gửi lời chúc tới tài khoản:</b></p>
				<textarea id="textSn-<?=$user['id'];?>" style="border-radius: 5px; height: 150px;" class="item"></textarea>
				<div class="text-center item mgt15">
				<img onclick="chucsn(<?=$user['id'];?>)" class="pointer" id="guingay" src="/Themes/Hanoistar/skin/images/guingay.png" /></div>
			</div>
			<div class="col-md-1 hidden-xs"></div>
			<div style="height: 55px;" class="relative hidden-xs item">
				<img  style="bottom: 0px; left: 0px;" class="absolute" src="/Themes/Hanoistar/skin/images/hopqua.png" />
			</div>	
		 
		</div>
		
		<?php $i++; } } ?>
		
		
	  </div>
	  <?php if($i > 2) { ?>	
	  <!-- Controls -->
	  <a class="left carousel-control" href="#carousel-sn" role="button" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	  </a>
	  <a class="right carousel-control" href="#carousel-sn" role="button" data-slide="next">
		<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	  </a>
	  <?php } ?>
	</div>
	
	<script>
	$('.carousel-sn').carousel();
	function chucsn(userid){
		<?php if(pzk_session('userId')){ ?>
		if(userid){
			var textSn = $("#textSn-"+userid).val();
			if(!textSn){
				alert('Hãy nhập lời chúc');
				return false;
			}else{
				var userchuc = <?php echo pzk_session('userId'); ?>;
				$.ajax({
				  method: "POST",
				  url: "/home/saveSn",
				  data: { userId: userid, text: textSn, userchuc: userchuc }
				})
				  .done(function( msg ) {
					alert('Gửi thành công');
					$("#textSn-"+userid).val('');
				  });
				}
			
		}
		<?php }else{ ?>
			var state = confirm("Bạn phải đăng nhập để gửi chúc mừng!");
			if(state == true){
				$("#LoginModal").modal();
			}
		<?php } ?>
	}
	</script>
		
	</div>	
	<?php }else{ ?>
		<div class='text-center'>Không có ai sinh nhật hôm nay!</div>
	<?php } ?>

</div>

<div class="item bg6">
<?php $data->displayChildren('[position=bottom-slide]') ?>

	<div class=" fff223 text-center  fs30 cadena mgt10 item">
		<?php echo $language['statistic'];?></br>
		- - - - -
	</div>
	<?php 
	$users = null;
	if(!($users = pzk_layoutcache('users_count'))) {
		$users = _db()->select('count(*) as c')->fromUser()->whereStatus(1)->result_one();
		pzk_layoutcache('users_count', $users);
	}
	
	$users5Months = null;
	if(!($users5Months = pzk_layoutcache('users_5months_count'))){
		
		$users5Months = _db()->select('count(*) as c')->fromUser()->whereStatus(1)->gtRegistered(date("Y-m-d H:i:s",strtotime("-5 month")))->result_one();
		pzk_layoutcache('users_5months_count', $users5Months);
	}
	
	$usersOnline = null;
	if(!($usersOnline = pzk_layoutcache('users_online_count'))) {
		$usersOnline = _db()->select('count(*) as c')->fromLogin_log()->gtTime(date("Y-m-d H:i:s",strtotime("-1 hour")))->result_one();
		pzk_layoutcache('users_online_count', $usersOnline);
	}
	$user = null;
	if(!($user = pzk_layoutcache('user_lastest'))) {
		$user = _db()->select('username')->fromUser()->whereStatus(1)->orderBy('id desc')->result_one();
		pzk_layoutcache('user_lastest', $user);
	}
	
	?>
	<div class="container mgb50">
		<div class="col-md-3 col-xs-12"> <b class="fff223 fs28" ><?php echo @$users['c']?></b> <span class="fs16 white"> <?php echo $language['member']; ?> </span>	</div>		
		<div class="col-md-3 col-xs-12"> <b class="fff223 fs28" ><?php echo @$users5Months['c']?></b> <span class="fs16 white">
		 
		<?php echo $language['new-member']; ?>
		</span>	</div>	
		<div class="col-md-3 col-xs-12"> <b class="fff223 fs28" ><?php echo @$usersOnline['c']?></b> <span class="fs16 white">
		<?php echo $language['online-now']; ?>
		
		 </span>	</div>		
		<div class="col-md-3 col-xs-12"> <span class="fs16 white">
		<?php echo $language['latest-member']; ?>: </span><b class="white"><?php echo @$user['username']?></b></div>
	</div>
	
</div>	
		
<script>	
	<?php if(pzk_request('class')) : ?>
		$(".btnclick[data-class=<?php echo intval(pzk_request('class')) ?>]").trigger("click");
	<?php endif; ?>
	$(".subjectclick").click(function(){
		<?php if(pzk_session('userId')): ?>
			var numbersubject = $(this).data("subject");
			var alias = $(this).data("alias");
			var memclass = $(this).data("class");
			window.location = BASE_REQUEST+'/practice/class-'+memclass+'/subject-'+alias+'-'+numbersubject;
		<?php else: ?>
			var state = confirm("<?php echo $language['login'];?>");
			if(state == true){
				$("#LoginModal").modal();
			}
		<?php endif; ?>
	});
	
	function validEmail(email){
		if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {  
			return true;
		}  else {
			return false;
		}
		
	}
	
	function validPhone(phone){
		if (/^[0-9\-\+]{9,15}$/.test(phone)) {  
			return true;
		}  else {
			return false;
		}
		
	}
	
	function dangkituvan() {
		var name = $("#tv_name").val();
		if(name ==''){
			$("#tv_name").focus();
			return false;
		}
		
		var phone = $("#tv_phone").val();
		if(phone ==''){
			$("#tv_phone").focus();
			return false;
		}else{
			if(!validPhone(phone)) {
				alert('Số điện thoại không đúng định dạng');
				$("#tv_phone").focus();
				return false;
			}
		}
		
		var email = $("#tv_email").val();
		if(email ==''){
			$("#tv_email").focus();
			return false;
		}else{
			if(!validEmail(email)) {
				alert('Email không đúng định dạng');
				$("#tv_email").focus();
				return false;
			}
		}
		
		
		$.ajax({
				url:BASE_REQUEST + '/home/dangki',
				method: "POST",
				data:{
					name: name,
					email: email,
					phone: phone
				}, 
				success:function(result){
					if(result == 1){
						$("#tv_phone").val('');
						$("#tv_email").val('');
						$("#tv_name").val('');
						alert('Bạn đã đăng kí tư vấn thành công!');
					}
				}
			});
		return false;
	}
</script>



