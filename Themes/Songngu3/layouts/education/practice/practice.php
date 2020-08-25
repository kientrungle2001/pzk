

<?php
	$language =pzk_global()->getLanguage();
	$languagevn = pzk_global()->getLanguagevn();
	$lang = pzk_session('language');
	
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

<div class="item text-center">
   
    <?php echo $language['copyright'];?>
    
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
		<?php echo $language['weekend-title'];?>  <?php //if(pzk_session('lop')){ echo ' - '; echo $language['classnumber']; echo pzk_session('lop');}?></br>
		-----
	</div>
	</div>
</div>



<div class="item bg2">

	<div id="practice-test-section" class="container mgt-25 mgb-100">
		<div class="row">
			<?php $data->displayChildren('[position=showCompability]') ?>
		</div>
	</div>
	
	
	<!-- thi am giay -->
	
	<?php $data->displayChildren('[position=thithu]') ?>


</div>

<div class="item bg3">
	<div class=" text-center white fs30 cadena mgb30 mgt60 item">
	
		<?php echo $language['funcorner'];?></br>
		-----
	</div>
	<div class="container ">
		<div class="col-md-6 col-xs-12">
			<div class="col-md-6 col-xs-12">
				<img class="item" src="/Themes/Songngu3/skin/images/quatang.png" />
			</div>
			<div class="col-md-6 col-xs-12 ">
				<div class="white uppercase  bold mgb5 fs30">
					<?=$language['gift'];?>:
				</div>
				<div class="white mgb10">
					<?php echo $language['inmarch'];?>: FROZEN - Let It Go Sing-along, a song from Walt Disney.
				</div>
				<a href="/gift">
					<?php if(!$lang || $lang == 'vn' ){ ?>
						<img src="/Themes/Songngu3/skin/images/nhanngay.png" />
					<?php } else { ?>
						<img src="/Themes/Songngu3/skin/images/seemore.png" />
					<?php } ?>
				</a>
			</div>
		</div>
		
		<div class="col-md-6 col-xs-12">
			<div class="col-md-6 col-xs-12">
				<img class="item" src="/Themes/Songngu3/skin/images/startgame.png" />
			</div>
			<div class="col-md-6 col-xs-12">
				<div class="white uppercase cadena mgb5 fs30">
					Games:
				</div>
				<div class="white mgb10">
					WORD RAIN: Choose the words that belong to the animal topic?
				</div>
				<a href="/game">
				<?php if(!$lang || $lang == 'vn' ){ ?>
					<img src="/Themes/Songngu3/skin/images/choingay.png" />
				<?php } else { ?>
					<img src="/Themes/Songngu3/skin/images/playnow.png" />
				<?php } ?>
				</a>
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

<div class="item">
	<?php if(!$lang || $lang == 'vn' ){ ?>
		<img class="item hidden-xs" src="/Themes/Songngu3/skin/images/lydo.png" />
	<?php } else { ?>
		<img class="item hidden-xs" src="/Themes/Songngu3/skin/images/6lido2.png" />
	<?php } ?>
	<?php if(!$lang || $lang == 'vn' ){ ?>
		<img class="item visible-xs" src="/Themes/Songngu3/skin/images/mb_lydo.png" />
	<?php } else { ?>
		<img class="item visible-xs" src="/Themes/Songngu3/skin/images/mb_lydo2.png" />
	<?php } ?>
</div>

<div class="item relative bg5">
	<div class="container mgb70">
		<div class="col-md-6 col-xs-12">
			<div class="text-center item mgt70 mgb20 uppercase title_color fs30 cadena"><?php echo $language['advisory'];?></div>
			<div class="bgeaf formdk item">
				<p><?php echo $language['fullname'];?>:</p>
				<input id="tv_name" name="" class="item" />
				<p><?php echo $language['tel'];?>:</p>
				<input id="tv_phone" name="phone" class="item" />
				<p><?php echo $language['email'];?>:</p>
				<input id="tv_email" name="email" class="item" />
				<div onclick="dangkituvan();" class="item pointer text-center">
					<?php if(!$lang || $lang == 'vn' ){ ?>
						<img src="/Themes/Songngu3/skin/images/dangki.png" />
					<?php } else { ?>
						<img src="/Themes/Songngu3/skin/images/dangki2.png" />
					<?php } ?>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-xs-12">
			<div class="text-center item mgt70 mgb20 uppercase title_color fs30 cadena"><?php echo $language['tuition'];?></div>
			<div class="bgeaf box-mua item">
				<div class="inline-block middle">
					<?= $language['pack1'];?>
				</div>
				<div class="inline-block pull-right middle">
					<a href="/home/detail?tab8=1">
					<?php if(!$lang || $lang == 'vn' ){ ?>
						<img src="/Themes/Songngu3/skin/images/muangay.png" />
					<?php } else { ?>
						<img src="/Themes/Songngu3/skin/images/buynow.png" />
					<?php } ?>
					</a>
				</div>
			</div>
			<div class="bgeaf box-mua item">
				<div class="inline-block middle">
					<?= $language['pack2'];?>
				</div>
				<div class="inline-block pull-right middle">
					<a href="/home/detail?tab8=1">
					<?php if(!$lang || $lang == 'vn' ){ ?>
						<img src="/Themes/Songngu3/skin/images/muangay.png" />
					<?php } else { ?>
						<img src="/Themes/Songngu3/skin/images/buynow.png" />
					<?php } ?>
					</a>
				</div>
			</div>
			<div class="bgeaf box-mua item">
				<div class="inline-block middle">
				<?= $language['pack3'];?>
				</div>
				<div class="inline-block pull-right middle">
					<a href="/home/detail?tab8=1">
					<?php if(!$lang || $lang == 'vn' ){ ?>
						<img src="/Themes/Songngu3/skin/images/muangay.png" />
					<?php } else { ?>
						<img src="/Themes/Songngu3/skin/images/buynow.png" />
					<?php } ?>
					</a>
				</div>
			</div>
			<div class="bgeaf box-mua item">
				<div class="inline-block middle">
				<?= $language['pack4'];?>
				</div>
				<div class="inline-block pull-right middle">
					<a href="/home/detail?tab8=1">
					<?php if(!$lang || $lang == 'vn' ){ ?>
						<img src="/Themes/Songngu3/skin/images/muangay.png" />
					<?php } else { ?>
						<img src="/Themes/Songngu3/skin/images/buynow.png" />
					<?php } ?>
					</a>
				</div>
			</div>
		</div>
	</div>
	<div style="bottom: 10px; font-size: 20px; width: 100%; font-weight: bold;" class="absolute text-center hidden-xs">
	Ưu đãi về giá (2/4/2018 – 2/5/2018): Gói 3. Chỉ còn 350k/6 tháng; Gói 4. Chỉ còn 500k/12 tháng.
	</div>
	<div style="bottom: 10px; width: 100%; font-weight: bold;" class="absolute text-center visible-xs">
	Ưu đãi về giá (2/4/2018 – 2/5/2018): Gói 3. Chỉ còn 350k/6 tháng; Gói 4. Chỉ còn 500k/12 tháng.
	</div>
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
		$(".btnclick[data-class=<?php echo pzk_request('class') ?>]").trigger("click");
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



