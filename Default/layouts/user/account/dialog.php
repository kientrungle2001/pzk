<?php if(!pzk_session()->get('userId')): ?>
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-lg">
    	<div class="modal-content">
	    		<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        	<h4 class="modal-title text-center" id="myModalLabel">Đăng nhập - Đăng ký́</h4>
		      	</div>
		      	<div class="modal-body">
			    	<form id="loginForm" class="login form-horizontal" onsubmit="return pzk_{data.id}.login()" method="post">
			    		<div class="form-group margin-top-10">
			    			<div class="col-xs-2">
						  		<label class="login-title" for="userlogin">Đăng nhập :</label>
						  	</div>
						  	<div class="col-xs-4 control-group">
						  		<input type="text" class="form-control" id="userlogin" name="userlogin" placeholder="Tên đăng nhập">
						  	</div>
						  	<div class="col-xs-4 control-group">
						  		<input type="password" class="form-control" id="userpassword" name="userpassword" placeholder="Mật khẩu">
						  	</div>
						  	<div class="col-xs-2">
						  		<button type="submit" id="usersubmit" class="btn btn-primary">Đăng nhập</button>
						  	</div>
						</div>
			    	</form>

			    	<form id="loginFBForm" class="login form-horizontal" >
			    		<div class="form-group margin-top-10">
			    			<div class="col-xs-3">
						  		<label class="login-title" for="userlogin">Đăng nhập bằng tài khoản:</label>
						  	</div>
						  	<div class="col-xs-2 control-group">
						  		<img width="122px" height="42px" onclick="return pzk_{data.id}.LoginFB()" alt="Đăng nhập bằng tài khoản facebook" src="<?php echo BASE_URL.'/default/skin/nobel/test/media/facebook.png'; ?>" data-toggle="tooltip" data-placement="top" title="Đăng nhập bằng tài khoản Facebook">
						  	</div>
						  	<div class="col-xs-2 control-group">
						  		<img width="117px" height="43px" onclick="return pzk_{data.id}.LoginGoogle()" src="<?php echo BASE_URL.'/default/skin/nobel/test/media/google.png'; ?>" data-toggle="tooltip" data-placement="top" title="Đăng nhập bằng tài khoản Gmail">
						  	</div>
						  	
						</div>
			    	</form>
			    	
			    	<form id="registerForm" class="register form-horizontal margin-top-20" onsubmit="return pzk_{data.id}.register()">
				    		<div class="form-group margin-top-10">
				    			<div class="col-xs-2">
							  		<label class="login-title">Đăng ký :</label>
							  	</div>
							  	<div class="col-xs-4 margin-top-10">
							  		<label for="name">Họ và tên :</label> <span class="validate">(*)</span>
						    		<input type="text" class="form-control" id="name" name="name" placeholder="Họ và tên" data-toggle="tooltip" data-placement="top" title="">
						    	</div>
							  	<div class="col-xs-4 margin-top-10">
							  		<label for="username">Tên đăng nhập :</label> <span class="validate">(*)</span>
						    		<input type="text" class="form-control" id="username" name="username" placeholder="Tên đăng nhập" data-toggle="tooltip" data-placement="top" title="Tên đăng nhập tối thiểu phải 6 ký tự, không có ký tự đặc biệt">
						    	</div>
						    			    	
						    	<div class="col-xs-2 margin-top-10">
                                    <label for="sex">Giới tính</label>
                                    <select id="sex" class="form-control" name="sex" data-toggle="tooltip" data-placement="top" title="Lựa chọn giới tính">
	                                    <option value="1" class="pd-5">Nam</option>
	                                    <option value="0" class="pd-5">Nữ</option>
                                    </select>
                                </div>

						    	<div class="clearfix"></div>
								<div class="col-xs-4 col-xs-offset-2 margin-top-10">
							  		<label for="email">Email :</label> <span class="validate">(*)</span>
						    		<input type="text" class="form-control" id="email" name="email" placeholder="Email" data-toggle="tooltip" data-placement="top" title="Email của bạn">
						    	</div>
						    	<div class="col-xs-4  margin-top-10">
						    		<label for="password1">Mật khẩu :</label> <span class="validate">(*)</span>
						    		<input type="password" class="form-control" id="password1" name="password1" placeholder="Mật khẩu" data-toggle="tooltip" data-placement="top" title="Mật khẩu phải lớn hơn 6 ký tự và không chứa khoảng trắng"/>
						    	</div>				    	
						    							    	
						    	<div class="col-xs-2 margin-top-10">
							  		<label for="phone">Điện thoại :</label> <span class="validate">(*)</span>
						    		<input type="text" class="form-control" id="phone" name="phone" placeholder="Điện thoại" data-toggle="tooltip" data-placement="top" title="Điện thoại phải là số">
						    	</div>
						    	<div class="clearfix"></div>
						    	<div class="col-xs-4 col-xs-offset-2 margin-top-10">
						    		<label>Ngày sinh :</label> <span class="validate">(*)</span>
						    		<div class="date clearfix">
						    			<div class="col-xs-4">
								    		<select id="day" class="form-control" title="Ngày" name="birthday_day" style="padding-left: 0px;" aria-label="Ngày" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
												<option selected="1">Ngày</option>
												<?php for($d = 1; $d <=31; $d++):?>
													<?php if($d < 10){ ?>
													<option value="<?php echo '0'.$d;?>"><?php echo '0'.$d;?></option>
													<?php }else{ ?>
													<option value="<?=$d;?>"><?=$d;?></option>
													<?php } ?>
												<?php endfor;?>
											</select>
										</div>
										<div class="col-xs-4">
											<select id="month" class="form-control col-xs-4" title="Tháng" name="birthday_month" aria-label="Tháng" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
												<option selected="1">Tháng</option>
												<?php for($m = 1; $m <= 12; $m++):?>
													<?php if($m< 10){ ?>
														<option value="<?php echo '0'.$m;?>">Tháng <?=$m?></option>
													<?php }else{ ?>
														<option value="<?=$m;?>">Tháng <?=$m?></option>
													<?php } ?>
												<?php endfor;?>
											</select>
										</div>
										<div class="col-xs-4">
											<select id="year" class="form-control col-xs-4" title="Năm" name="birthday_year" aria-label="Năm" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
												<option selected="1">Năm</option>
												<?php 
												$y = date("Y");
												for($i = $y; $i > 1905; $i--):?>
												<option value="<?=$i;?>"><?=$i;?></option>
												<?php endfor;?>
											</select>
										</div>
									</div>
						    		<input type="hidden" id="birthday" class="birthday" name="birthday" value=""/>
						    	</div>
						    	<div class="col-xs-2  margin-top-10 ">
						    		<label for="areacode">Tỉnh/ TP :</label>  <span class="validate">(*)</span>
						    				<select id="areacode" class="form-control" title="Tỉnh/ Thành phố" name="areacode" aria-label="Tỉnh/tp" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
												<?php 
													$areacode=_db()->getEntity('User.Account.User');
													$areas= $areacode->loadArea();
												?>
												{each $areas as $area}
												<option value="<?php echo $area['id']; ?>"><?php   echo $area['name']; ?></option>
												{/each}
											
											</select>
							    	
						    	</div>						    	
						    	<div class="col-xs-4  margin-top-10">
						    		<label for="captcha">Nhập mã bảo mật:</label>  <span class="validate">(*)</span>
						    		<div class="row"> 
							    		<div class="col-xs-5 margin-top-3">
							    			<img src="<?php echo "/3rdparty/captcha/random_image.php";  ?> "/>
							    		</div>
							    		<div class="col-xs-7">
							    			<input  type="captcha" class="form-control" id="captcha" name="captcha" placeholder="captcha" value=""/>
							    		</div>
							    	</div>
						    	</div>
						    	<div class="clearfix"></div>
						    	<div class="col-xs-2 col-xs-offset-2 margin-top-33">
						    		<button type="submit" id="registerButton" onclick="return pzk_{data.id}.set_birthday()" class="btn btn-primary">Đăng ký</button>
						    	</div>
						  	</div>
				    	</form>
			    	
			    	<div id="register_successful">
			    		<label class="login-title">Đăng ký thành công - vui lòng đăng nhập vào email để kích hoạt tài khoản !</label>
			    	</div>
			    	<div id="register_successful11">
			    		<label  class="login-title">Bạn đã đăng ký tài khoản thành công ! </label>
			    	</div>
			    </div>
    	</div>
  	</div>
</div>
<?php endif; ?>