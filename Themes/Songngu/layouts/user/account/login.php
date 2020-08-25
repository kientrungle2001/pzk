<?php if(!pzk_session()->getUserId()): ?>

<div id="LoginModal" class="modal fade bs-example-modal-lg sharp" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  	<div class="modal-dialog mainbox">
    	<div class="modal-content sharp" style=" border-color: #337ab7;border-style: solid; border-width: 3px;">
	    		<div class="modal-header sharp" style="background-color:#337ab7; ">
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
                                      <button type="submit" id="usersubmit" class="btn btn-primary sharp">Đăng nhập</button>
                                      <a class="register_head" href="javascript:void(0)" data-toggle="modal" data-target="#RegisterModal"><span class="glyphicon glyphicon-user"></span> Đăng ký tài khoản</a></br>
                                    </div>
                                </div>

			    			</form>
			    		</div>
			    		<div class="row">
			    			<form id="loginFBForm" class="login form-horizontal" >

								<div style="margin-bottom: 25px" class="input-group">
                                    <label class="login-title" for="userlogin">Hoặc đăng nhập bằng:</label>
                                </div>
								<div class="form-group">
                                    <div class="col-sm-12 controls">
                                    	<input type="image" onclick="return pzk_<?php echo @$data->id?>.LoginFB()" alt="Đăng nhập bằng tài khoản facebook" src="<?php echo BASE_URL.'/Default/skin/nobel/test/media/facebook.png'; ?>" data-toggle="tooltip" data-placement="top" title="Đăng nhập bằng tài khoản Facebook" >
										<input type="image"  onclick="return pzk_<?php echo @$data->id?>.LoginGoogle()" src="<?php echo BASE_URL.'/Default/skin/nobel/test/media/google.png'; ?>" data-toggle="tooltip" data-placement="top" title="Đăng nhập bằng tài khoản Gmail" >
                                      
                                    </div>
                                    
                                </div>

					    		
					    	</form>
			    		</div>
			    		
			    	</div>

			    	
			    </div>
    	</div>
  	</div>
</div>
<?php endif; ?>
<script>
	
 $(".register_head").on("click", function () {
      $('#LoginModal').modal('hide');

 });
</script>