

<?php
	$language =pzk_global()->get('language');
	$languagevn = pzk_global()->get('languagevn');
	$lang = pzk_session('language');
	
?>
{children [position=public-header]}

<div class="container top10">

<div class="item">
    <marquee behavior="scroll" direction="left" scrollamount="5" style="width:100%; height:100%; vertical-align:middle; cursor:pointer;" onmouseover="javascript:this.setAttribute('scrollamount','0');" onmouseout="javascript:this.setAttribute('scrollamount','5');">
    <?php echo pzk_config('site_notification');?>
    </marquee>
 </div>

</div>


<div id="test" class="item">

	<div class="relative item">
		<img class="item" src="/Themes/Songngu3/skin/images/bg1.png" />
		<div  class="item visible-xs hfix"></div>
		<div class="t-weight deluyentap textlt item text-center absolute">
		Bộ đề trắc nghiệm</br>
		-----
	</div>
	</div>

</div>



<div class="item bg2">

	<div id="test-section" class="container mgt-25 ">
		<div class="row">
			{children [position=test-place]}
		</div>
	</div>
	
</div>
<div class="item bg2">
	<div id="test-compability" class="container ">
		<div class="t-weight text-center textlt mgb15 item">Thi thử trực tuyến
		</br>
		-----
		</div>
	</div>
	<div id="test-compability-section" class="container pdb80">
		<div class="row">
			{children [position=extra-compability]}
		</div>
	</div>
</div>


<div class="item bg6">
{children [position=bottom-slide]}

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
		<div class="col-md-3 col-xs-12"> <b class="fff223 fs28" >{users[c]}</b> <span class="fs16 white"> <?php echo $language['member']; ?> </span>	</div>		
		<div class="col-md-3 col-xs-12"> <b class="fff223 fs28" >{users5Months[c]}</b> <span class="fs16 white">
		 
		<?php echo $language['new-member']; ?>
		</span>	</div>	
		<div class="col-md-3 col-xs-12"> <b class="fff223 fs28" >{usersOnline[c]}</b> <span class="fs16 white">
		<?php echo $language['online-now']; ?>
		
		 </span>	</div>		
		<div class="col-md-3 col-xs-12"> <span class="fs16 white">
		<?php echo $language['latest-member']; ?>: </span><b class="white">{user[username]}</b></div>
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



