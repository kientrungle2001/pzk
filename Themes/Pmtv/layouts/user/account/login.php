<?php
    if(pzk_session('login')){

?>
	<div class="row box top-20">
		<div class="box-inner col-xs-12">
			<div class="box-content border-purple">
				<div class="text-center">
					<img class="img-circle" src="<?php echo pzk_session('avatar'); ?>" /><br />
					<strong>Xin chào, <?php echo pzk_session('username'); ?></strong>
				</div>
				<ul class="user-board">
					<li><a href="/Profile/detail">Trang cá nhân</a></li>
					<li><a href="/home/about">Mua sản phẩm</a></li>
					<li><a href="/account/logout">Thoát</a></li>
				</ul>
			</div>
		</div>
	</div>
<?php } else{   
?>
    <div class="row box login-box">
    <div class="box-inner col-xs-12">
	
	<h3 class="text-center text-uppercase bgcolor1-bold color-white padding-10 font-large top-5">Đăng nhập<br />&nbsp;</h3>
	<div class="box-content border-purple">
	<form class="form" method="post"  action="/Account/loginPost" >
	<?php 
      
       echo @$data->get('error');
       $request = pzk_element('request');
       ?>
	   <div class="form-group">
			<label for="userlogin">Tên đăng nhập:</label>
			<input class="form-control" type="text" name="userlogin" value="">
		</div>

		<div class="form-group">
			<label for="userpassword">Mật khẩu:</label>
			<input class="form-control" type="password" name="userpassword" value="">
		</div>
		
		<div class="checkbox">
			<label><input type="checkbox"> Ghi nhớ</label><a href="/account/forgotpassword" class="text-right" style="float:right;">Quên mật khẩu</a>
		  </div>
      <div class="text-center">
	  <button type="submit" name="submitlogin" class="btn btn-default site-bgcolor color-white">Đăng nhập</button>
	  </div>
	  
	</form>
   </div>
  
  </div>
  </div>
  <?php 
}
  ?>