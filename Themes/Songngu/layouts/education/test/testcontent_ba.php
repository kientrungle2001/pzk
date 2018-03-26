<?php
/*$class = pzk_request('class');*/
$class = pzk_session('lop');
$practice= pzk_request('practice');
$check=  pzk_session('checkPayment');
$week2= pzk_request('id');
$weekname = $data->getWeekNameSN($week2,$practice, $check, $class);

 ?>
<div class="container hidden-xs">
	<p class="t-weight text-center btn-custom8 mgright textcl">Làm {ifvar practice}bài luyện tập{else}đề thi{/if} - Lớp <?php echo $class; ?></p>
</div>
<div class="container visible-xs top10">
	<p class="t-weight text-center btn-custom8 textcl">Làm {ifvar practice}bài luyện tập{else}đề thi{/if} - Lớp <?php echo $class; ?></p>
</div>

<div class="container">
	<div class="row bot20">
		<div class="col-md-1 col-xs-1"></div>
		<?php if(!pzk_session('userId')){ ?>
		<div class="col-xs-12 pd-0">
			<h3 class="pd-top-15" style="width: 100%; text-align: center;">Bạn phải <a rel="{_SERVER[REQUEST_URI]}" class="login_required" data-toggle="modal" data-target=".bs-example-modal-lg" style="cursor:pointer;">Đăng nhập</a> thì mới được thi thử</h3>
		</div>
		<?php }else{ ?>
		<!-- sau khi đã đăng nhập -->
		<div class="col-md-10 col-xs-10">
			
				<div class="dropdown col-md-8 col-sm-8 col-xs-12 mgleft pd0 mg0">
					<button class="btn fix_hover btn-default col-md-12 col-sm-12 col-xs-12 sharp" type="button"><span id="chonde" class="fontsize19"> <?php if(!$week2 || $check == 0){
						echo "Chọn Đề";
					}else{
						echo @$weekname['name']; 
					}
					
					?></span><img class="img-responsive imgwh hidden-xs hidden-sm pull-right" src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/icon1.png" /></span>
					</button>
						<ul class="dropdown-menu col-md-12 col-sm-12 col-xs-12" style="top:40px; max-height:350px; overflow-y: scroll;">
		    			<?php 
		    				$weeks = $data->getWeekTestSN(ROOT_WEEK_CATEGORY_ID,$practice, $check, $class);
		    			 ?>
		    			{each $weeks as $week }
		    			
		    			<li class="left20" style="color:#d9534f;"><h5><strong><?php if(pzk_user_special()): ?>#{week[id]} - <?php endif; ?>{week[name]}</strong></h5>
							
						<?php 
							$tests = $data->getTestSN($week['id'], $practice, $check, $class);
							if($practice== 1 || $practice == '1'){  ?>
								{each $tests as $test }
								<?php 
	                                if($test['name_sn']){
	                                    $testName = $test['name_sn'];
	                                }else $testName = $test['name'];
	                            ?>
									<li style="padding-left: 40px;">
										
										<a onclick="id = {week[id]};document.getElementById('chonde').innerHTML = '{testName}';"  data-de="{testName}" class="getdata" href="/practice-examination/class-{class}/week-{week[id]}/examination-{test[id]}" data-type="group"><?php if(pzk_user_special()): ?>#{test[id]} - <?php endif; ?>{testName}</a>
										
									</li>
								{/each}
						<?php
							}else{
						 ?>						
							{each $tests as $test }
							<?php 
                                if($test['name_sn']){
                                    $testName = $test['name_sn'];
                                }else $testName = $test['name'];
                            ?>
							<li style="padding-left: 40px;">
								
								<a onclick="id = {week[id]};document.getElementById('chonde').innerHTML = '{testName}';" data-id="{week[id]}" data-de="{testName}" class="getdata" href="/test/class-{class}/week-{week[id]}/examination-{test[id]}" data-type="group"><?php if(pzk_user_special()): ?>#{test[id]} - <?php endif; ?>{testName}</a>
								
							</li>
							{/each}
							<?php } ?>
							
						</li>
						{/each}
						</ul>
				</div>
				<div class="col-xs-12 col-md-4 col-sm-2 bd pull-right mgleft">
					<div class="row text-center">
						<div class="col-md-3 hidden-xs hidden-sm">
							<img  src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/dongho.png"  class=" wh40 img-responsive"/>
						</div>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<h4 class="robotofont"><strong>45:00</strong></h4>
						</div>
					</div>
				</div>
			
		</div>
		<?php } ?> <!-- keet thuc else -->
	</div>
	<div class="row"></div>
</div>
<div class="container">
	<div class="row bot20">
		<div class="col-md-1 col-xs-1"></div>
		<div class="change col-md-10 col-xs-10 bd-div bgclor imgbg">

			<div class="row">
				<div class="col-md-2 col-xs-2"></div>
				<div class="col-md-8 top50 left20 ">
					<?php if($practice==0){ ?>
					<div class="panel panel-default top10">
						<div class="panel-heading" style="background-color: white;">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse2" class="roboto">
								<h4 class="panel-title text-center text-uppercase">
									<strong>Hướng dẫn làm bài kiểm tra toàn diện</strong>
								</h4>
							</a>
						</div>
						<div id="collapse2" class="panel-collapse collapse roboto">
							<div class="left10 top20 blue">
								<strong>Bước 1: </strong> <span>Click chuột vào mục  </span><strong>Chọn Đề</strong>
							</div>
							<div class="left10 top20 blue">
								<strong>Bước 2: </strong> <span>Click chuột để chọn 1 đề </span>
							</div>
							<div class="left10 top20 blue">
								<strong>Bước 3: </strong> <span>Thực hiện làm bài kiểm tra ( thời gian làm bài là 45phút): </span>
								<ul>
									<li>Click chuột để tích chọn đáp án đúng</li>
								<li>Click chuột vào biểu tượng loa để nghe câu hỏi bằng tiếng anh</li>
								</ul>
							</div>
							<div class="left10 top20 blue">
								<strong>Bước 4: </strong> <span>Để hoàn thành bài kiểm tra: Click chuột vào nút </span><img src="<?=BASE_SKIN_URL?>/Themes/Songngu/skin/media/hoanthanh.jpg"/>
							</div>
							<div class="left10 top20 blue bot10">
								<strong>Bước 5: </strong> <span>Để xem kết quả và đáp án: Click chuột vào nút </span><img src="<?=BASE_SKIN_URL?>/Themes/Songngu/skin/media/xemdapan.jpg"/>
							</div>
						</div>
					</div>
					<?php }else{ ?>
					<div class="panel panel-default top10">
						<div class="panel-heading" style="background-color: white;">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse3" class="roboto">
								<h4 class="panel-title text-center text-uppercase">
									<strong>Hướng dẫn làm đề luyện tập</strong>
								</h4>
							</a>
						</div>
						<div id="collapse3" class="panel-collapse collapse roboto">
							<div class="left10 top20 blue">
								<strong>Bước 1: </strong> <span>Click chuột vào mục  </span><strong>Chọn Đề</strong>
							</div>
							<div class="left10 top20 blue">
								<strong>Bước 2: </strong> <span>Click chuột để chọn 1 đề </span>
							</div>
							<div class="left10 top20 blue">
								<strong>Bước 3: </strong> <span>Thực hiện làm bài luyện tập ( thời gian làm bài là 45phút) : </span>
								<ul>
									<li class="top10">Click chuột để tích chọn đáp án đúng</li>
									<li class="top10">Click chuột vào biểu tượng loa để nghe câu hỏi bằng tiếng anh</li>
								</ul>
							</div>
							<div class="left10 top20 blue">
								<strong>Bước 4: </strong> <span>Để hoàn thành bài luyện tập: Click chuột vào nút </span><img src="<?=BASE_SKIN_URL?>/Themes/Songngu/skin/media/hoanthanh.jpg"/>
							</div>
							<div class="left10 top20 blue bot10">
								<strong>Bước 5: </strong> <span>Để xem kết quả và đáp án: Click chuột vào nút </span><img src="<?=BASE_SKIN_URL?>/Themes/Songngu/skin/media/xemdapan.jpg"/>
							</div>
						</div>
					</div>
					<?php } ?>
				</div>
				<div class="col-md-2 col-xs-2"></div>
			</div>

		</div>
		<div class="col-md-1 col-xs-1"></div>
	</div>
</div>
