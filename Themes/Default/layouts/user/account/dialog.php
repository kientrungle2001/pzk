<?php if(!pzk_session()->get('userId')): ?>
<div class="modal fade bs-example-modal-lg sharp" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-lg sharp">
    	<div class="modal-content sharp">
	    		<div class="modal-header sharp">
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        	<h4 class="modal-title text-center" id="myModalLabel">Đăng nhập - Đăng ký́</h4>
		      	</div>
		      	<div class="modal-body">
			    	<div class="container-fluid">
			    		<div class="row">
			    			<form id="loginForm" class="login form-horizontal" onsubmit="return pzk_{data.id}.login()" method="post">
				    			<div class="form-group">
				    			<div class="col-md-2 text-center">
							  		<h4><strong>Đăng nhập :</strong></h4>
							  	</div>
							  	<div class="col-md-4 col-sm-4 col-xs-6 control-group">
							  		<input type="text" class="form-control sharp" id="userlogin" name="userlogin" placeholder="Tên đăng nhập">
							  	</div>
							  	<div class="col-md-4 col-sm-4 col-xs-6 control-group">
							  		<input type="password" class="form-control sharp" id="userpassword" name="userpassword" placeholder="Mật khẩu">
							  	</div>
							  	<div class="col-md-2 col-sm-2 col-xs-12">
							  		<button type="submit" id="usersubmit" class="btn btn-primary sharp">Đăng nhập</button>
							  	</div>
								</div>
			    			</form>
			    		</div>
			    		<div class="row">
			    			<form id="loginFBForm" class="login form-horizontal" >
					    		<div class="form-group top10">
					    			<div class="col-md-3  text-center">
								  		<label class="login-title" for="userlogin">Đăng nhập bằng tài khoản:</label>
								  	</div>
								  	<div class="col-md-2 col-sm-4 col-xs-6 control-group">
								  		<img width="122px" height="42px" onclick="return pzk_{data.id}.LoginFB()" alt="Đăng nhập bằng tài khoản facebook" src="<?php echo BASE_URL.'/Default/skin/nobel/test/media/facebook.png'; ?>" data-toggle="tooltip" data-placement="top" title="Đăng nhập bằng tài khoản Facebook">
								  	</div>
								  	<div class="col-md-2 col-sm-4 col-xs-6 control-group">
								  		<img width="117px" height="43px" onclick="return pzk_{data.id}.LoginGoogle()" src="<?php echo BASE_URL.'/Default/skin/nobel/test/media/google.png'; ?>" data-toggle="tooltip" data-placement="top" title="Đăng nhập bằng tài khoản Gmail">
								  	</div>
								  	
								</div>
					    	</form>
			    		</div>
			    		<div class="row">
			    			<form id="registerForm" class="register form-horizontal top20" onsubmit="return pzk_{data.id}.register()">
					    		<div class="form-group top10">
					    			<div class="col-md-2 text-center">
								  		<h4><strong>Đăng ký :</strong></h4>
								  	</div>
								  	
								  	<div class="col-md-4 top10">
								  		<label for="username">Tên đăng nhập :</label> <span class="validate">(*)</span>
							    		<input type="text" class="form-control sharp" id="username" name="username" placeholder="Tên đăng nhập" data-toggle="tooltip" data-placement="top" title="Tên đăng nhập tối thiểu phải 6 ký tự, không có ký tự đặc biệt">
							    	</div>
							    	<div class="col-md-4  top10">
							    		<label for="password1">Mật khẩu :</label> <span class="validate">(*)</span>
							    		<input type="password" class="form-control sharp" id="password1" name="password1" placeholder="Mật khẩu" data-toggle="tooltip" data-placement="top" title="Mật khẩu phải lớn hơn 6 ký tự và không chứa khoảng trắng"/>
							    	</div>		    	
							    	<div class="col-md-2 top10">
	                                    <label for="sex">Giới tính</label>
	                                    <select id="sex" class="form-control sharp" name="sex" data-toggle="tooltip" data-placement="top" title="Lựa chọn giới tính">
		                                    <option value="1" class="pd-5">Nam</option>
		                                    <option value="0" class="pd-5">Nữ</option>
	                                    </select>
	                                </div>

							    	<div class="clearfix"></div>
							    	<div class="col-md-4 col-md-offset-2 top10">
								  		<label for="name">Họ và tên :</label> <span class="validate">(*)</span>
							    		<input type="text" class="form-control sharp" id="name" name="name" placeholder="Họ và tên" data-toggle="tooltip" data-placement="top" title="">
							    	</div>
									<div class="col-md-4  top10">
								  		<label for="email">Email :</label> <span class="validate">(*)</span>
							    		<input type="text" class="form-control sharp" id="email" name="email" placeholder="Email" data-toggle="tooltip" data-placement="top" title="Email của bạn">
							    	</div>
							    	<div class="col-md-2 top10">
								  		<label for="phone">Điện thoại :</label> <span class="validate">(*)</span>
							    		<input type="text" class="form-control sharp" id="phone" name="phone" placeholder="Điện thoại" data-toggle="tooltip" data-placement="top" title="Điện thoại phải là số">
							    	</div>
							    	<div class="clearfix"></div>
							    	<div class="col-md-4 col-md-offset-2 top10">
							    		<label>Ngày sinh :</label> <span class="validate">(*)</span>
										<div class="clearfix"></div>
							    		
							    			<div class="col-md-4 col-sm-4 col-xs-4" style="padding-left: 0;">
									    		<select id="day" class="form-control sharp" title="Ngày" name="birthday_day" style="padding-left: 0px;" aria-label="Ngày" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
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
											<div class="col-md-4 col-sm-4 col-xs-4" style="padding-left: 0; padding-right: 0;">
												<select id="month" class="form-control sharp col-md-4" title="Tháng" name="birthday_month" aria-label="Tháng" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
													<option selected="1">Tháng</option>
													<?php for($m = 1; $m <= 12; $m++):?>
														<?php if($m< 10){ ?>
															<option value="<?php echo '0'.$m;?>"><?=$m?></option>
														<?php }else{ ?>
															<option value="<?=$m;?>"><?=$m?></option>
														<?php } ?>
													<?php endfor;?>
												</select>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-4" style="padding-right: 0;">
												<select id="year" class="form-control sharp col-md-4" title="Năm" name="birthday_year" aria-label="Năm" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
													<option selected="1">Năm</option>
													<?php 
													$y = date("Y");
													for($i = $y; $i > 1905; $i--):?>
													<option value="<?=$i;?>"><?=$i;?></option>
													<?php endfor;?>
												</select>
											</div>
										
							    		<input type="hidden" id="birthday" class="birthday" name="birthday" value=""/>
							    	</div>
							    	<div class="col-md-2 col-sm-4 col-xs-12 top10 ">
							    		<label for="areacode">Tỉnh/ TP :</label>  <span class="validate">(*)</span>
							    				<select id="areacode" class="form-control sharp" title="Tỉnh/ Thành phố" name="areacode" aria-label="Tỉnh/tp" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
													<?php 
														$areacode=_db()->getEntity('User.Account.User');
														$areas= $areacode->loadArea();
													?>
													{each $areas as $area}
													<option value="<?php echo $area['id']; ?>"><?php   echo $area['name']; ?></option>
													{/each}
												
												</select>
								    	
							    	</div>						    	
							    	<div class="col-md-4 col-sm-8 col-xs-12 top10">
							    		<label for="captcha">Nhập mã bảo mật:</label>  <span class="validate">(*)</span>
							    		<div class="row"> 
								    		<div class="col-md-5 col-sm-5 col-xs-5 top3">
								    			<img src="<?php echo "/3rdparty/captcha/random_image.php";  ?> "/>
								    		</div>
								    		<div class="col-md-7 col-sm-7 col-xs-7">
								    			<input  type="captcha" class="form-control sharp" id="captcha" name="captcha" placeholder="captcha" value=""/>
								    		</div>
								    	</div>
							    	</div>
							    	<div class="clearfix"></div>
							    	<div class="col-md-12 col-md-offset-2 top10 ">
							    		<div class="checkbox">
										  <label><input type="checkbox" name="chkagree" id= "chkagree" value="1">Tôi đồng ý với các điều khoản sử dụng </label><a target="blank" href="http://nextnobels.com/dieu-khoan-su-dung">(xem chi tiết về điều khoản) </a>

										</div>
							    	</div>
							    	<div class="clearfix"></div>
							    	<div class="col-md-2 col-md-offset-2 top10">
							    		<button type="submit" id="registerButton" onclick="return pzk_{data.id}.set_birthday()" class="btn btn-primary sharp">Đăng ký</button>
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