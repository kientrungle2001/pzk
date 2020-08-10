<?php if(!pzk_session()->get('userId')): ?>
<div id="LoginModal" class="modal fade bs-example-modal-lg sharp" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  	<div class="modal-dialog mainbox">
    	<div class="modal-content sharp">
	    		<div class="modal-header sharp" style="background: url('/Themes/pmtv/skin/media/news-heading-background.png'); background-position: top right; ">
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        	<h4 style="color: white;" class="modal-title text-center" id="myModalLabel"><strong>ĐĂNG NHẬP TÀI KHOẢN</strong></h4>
		      	</div>
		      	<div class="modal-body">
			    	<div class="container-fluid">
			    		<div class="row">
			    			<form id="loginForm" class="login form-horizontal" onsubmit="return pzk_<?php echo @$data->id?>.login()" method="post">
				    			
								<div style="margin-bottom: 25px" class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input  type="text" class="form-control" id="userlogin" name="userlogin" placeholder="Tên đăng nhập" >                                        
                                </div>
                                
                            	<div style="margin-bottom: 25px" class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input  type="password" class="form-control" id="userpassword" name="userpassword" placeholder="Mật khẩu">
                                </div>
                                <div style="margin-top:10px" class="form-group">
                                    <div class="col-sm-12 controls">
                                      <button type="submit" id="usersubmit" class="btn btn-primary sharp site-bgcolor">Đăng nhập</button>
                                      <a class="register_head site-color" href="javascript:void(0)" data-toggle="modal" data-target="#RegisterModal"><span class="glyphicon glyphicon-user"></span> Đăng ký</a></br>
                                    </div>
                                </div>

			    			</form>
			    		</div>
			    		
			    	</div>

			    	
			    </div>
    	</div>
  	</div>
</div>

<div id="RegisterModal" class="modal fade bs-example-modal-lg sharp" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-lg sharp">
    	<div class="modal-content sharp">
	    		<div class="modal-header sharp" style="background: url('/Themes/pmtv/skin/media/news-heading-background.png'); background-position: top right; ">
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        	<h4 class="modal-title text-center" style="color: white;" id="myModalLabel"><strong>ĐĂNG KÝ TÀI KHOẢN</strong></h4>
		      	</div>
		      	<div class="modal-body loginform" >
			    	<div class="container-fluid">
			    		<div class="row">
			    			<form id="registerForm" class="register form-horizontal top20" onsubmit="return pzk_<?php echo @$data->id?>.register()">
								<div class="form-group">
									<label class="control-label col-sm-2 hidden-xs" for="username">Tên đăng nhập:</label>
									<div class="col-sm-4">
									  <input id="username" name="username" class="form-control" placeholder="Tên đăng nhập">
									</div>
									<label class="control-label col-sm-2 hidden-xs" for="name">Họ và tên:</label>
									<div class="col-sm-4">
									  <input id="name" name="name" class="form-control" placeholder="Họ và tên">
									</div>
								  </div>
								  <div class="form-group">
									<label class="control-label col-sm-2 hidden-xs" for="password">Mật khẩu:</label>
									<div class="col-sm-4"> 
									  <input id="password1" type="password" name="password" class="form-control" placeholder="Mật khẩu">
									</div>
									<label class="control-label col-sm-2 hidden-xs" for="email">Email:</label>
									<div class="col-sm-4"> 
									  <input id="email" name="email" class="form-control" placeholder="Email">
									</div>
								  </div>
								  
								  <div class="form-group">
									<label class="control-label col-sm-2 hidden-xs" for="password">Nhập lại Mật khẩu:</label>
									<div class="col-sm-4"> 
									  <input type="password" name="password" class="form-control" placeholder="Nhập lại mật khẩu">
									</div>
									<label class="control-label col-sm-2 hidden-xs" for="class">Lớp:</label>
									<div class="col-sm-4"> 
									  <input id="class" name="class" class="form-control" placeholder="Lớp">
									</div>
								  </div>
								  
								  <div class="form-group">
									<label class="control-label col-sm-2 hidden-xs" for="areacode">Tỉnh/Thành phố:</label>
									<div class="col-sm-4"> 
									  <select id="areacode" name="areacode" class="form-control" placeholder="Tỉnh Thành Phố">
									  </select>
									  <script type="text/javascript">
										$('#areacode').template('/Default/skin/areacode.html', '/Default/skin/areacode.json');
										</script>
									</div>
									<label class="control-label col-sm-2 hidden-xs" for="phone">Điện thoại:</label>
									<div class="col-sm-4"> 
									  <input id="phone" name="phone" class="form-control" placeholder="Điện thoại">
									</div>
								  </div>
								  <div class="form-group">
									<div class="col-sm-12 text-center">
										<input type="checkbox" id="chkagree" name="chkagree" /><label>Tôi đồng ý với các <a href="/dieu-khoan-su-dung">điều khoản sử dụng</a> của Happy Way </label>
									</div>
								  </div>
								  <div class="form-group"> 
									<div class="col-sm-12 text-center">
									  <button type="submit" class="btn btn-default site-bgcolor color-white">Đăng ký</button>
									</div>
								  </div>
					    	</form>
			    		</div>
			    	</div>

			    	
			    </div>
    	</div>
  	</div>
</div>
<script type="text/javascript">
 $(".register_head").on("click", function () {
      $('#LoginModal').modal('hide');
 });
</script>
<?php endif; ?>