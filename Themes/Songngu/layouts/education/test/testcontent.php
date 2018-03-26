<?php
/*$class = pzk_request('class');*/
$class = pzk_session('lop');
$practice= pzk_request('practice');
$check=  pzk_session('checkPayment');
$week2= pzk_request('id');
$weekname = $data->getWeekNameSN($week2,$practice, $check, $class);

 ?>

<div class="container">
	<div class="row bc-test">
		<div style="font-size: 20px;" class="col-md-10 col-md-offset-1">
			
			Lớp {class} &nbsp; &nbsp; > &nbsp; &nbsp; {ifvar practice}Đề luyện tập{else}Đề thi{/if}
			 
		</div>
		
	</div>
	
</div>

<style>
	.bg-test{background: #b6d452;}
	#menu-test{top: 34px; width: 100%;}
	#menu-test li{float: left; width: 50%}
</style>
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
			
				<div  class="col-md-8 col-sm-8 col-xs-12 ">
				<div class="row bg-test">
					
					<div style="padding-left: 30px; line-height: 44px; font-weight: bold;" class="bg-test fonttest1 col-md-3 col-xs-12">
					<?php if($weekname['trial'] == 1){ 
						echo "Dùng thử"; }
						else { 
							if(pzk_user_special()) { echo '#'.$weekname['id']; }
							echo $weekname['name']; 
							
						}?> 
					<?php if($weekname) { echo ':'; } ?>
					</div>
					
					<ul class="bg-test col-md-5 col-xs-12  <?php if($practice== 1 || $practice == '1'){ echo 'ulhoa'; } else { echo 'ulhoatest';} ?>">
					<?php 
						$tests = $data->getTestSN($week2, $practice, $check, $class);
						if($practice== 1 || $practice == '1'){  ?>
							{each $tests as $test }
							<?php 
								if($test['name_sn']){
									$testName = $test['name_sn'];
								}else $testName = $test['name'];
							?>
								<li >
									
									<a onclick="id = {week[id]};document.getElementById('chonde').innerHTML = '{testName}';"  data-de="{testName}" class="getdata" href="/practice-examination/class-{class}/week-{week2}/examination-{test[id]}" data-type="group"><?php if(pzk_user_special()) { echo '#'.$test['id']; } ?> {testName}</a>
									
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
						<li>
							
							<a  onclick="id = {week[id]};document.getElementById('chonde').innerHTML = '{testName}';" data-id="{week[id]}" data-de="{testName}" class="getdata" href="/test/class-{class}/week-{week2}/examination-{test[id]}" data-type="group"><?php if(pzk_user_special()) { echo '#'.$test['id']; } ?> {testName}</a>
							
						</li>
						{/each}
						<?php } ?>
					</ul>
					
					
					<div class="dropdown bg-test col-md-4 col-xs-12 fonttest3 select-week">
						<button class=" select-week w100p pull-left" id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<?php if($weekname){ echo "Chọn tuần khác"; } else{ echo 'Đề dùng thử';}?>
							<span class="caret"></span>
						</button>
						<ul  id="menu-test" class="dropdown-menu bg-test" aria-labelledby="dLabel">
							<?php 
		    				$weeks = $data->getWeekTestSN(ROOT_WEEK_CATEGORY_ID,$practice, $check, $class);
		    			 ?>
		    			{each $weeks as $week }
							<?php 
							$firsttest= $data->getFirstTestByWeek($week['id'], $practice, $check, $class);
							if($practice== 1 || $practice == '1'){  
							?>
							<li><a href="/practice-examination/class-{class}/week-{week[id]}/examination-{firsttest[id]}"><?php if(pzk_user_special()) { echo '#'.$week['id']; } ?> {week[name]}</a></li>
							<?php } else { ?>
							<li><a href="/test/class-{class}/week-{week[id]}/examination-{firsttest[id]}"><?php if(pzk_user_special()) { echo '#'.$week['id']; } ?> {week[name]}</a></li>
							<?php } ?>
						
						{/each}
						</ul>
					</div>
					
					
					
					</div>
					
					
						
				</div>
				<div class="col-xs-12 col-md-4 col-sm-2  pull-left">
					<div  class="row bdt text-center testmgl0">
						<div class="col-md-2 hidden-xs hidden-sm">
							<img  src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/dongho.png"  class=" wh40 img-responsive"/>
						</div>
						<div class="col-md-10 col-sm-10 col-xs-12">
							<h4 class="robotofont"><span class="hidden-sm hidden-xs hidden-fix">Thời gian làm bài:</span> <strong>45:00</strong></h4>
						</div>
					</div>
				</div>
				
			
		</div>
		<?php } ?> <!-- keet thuc else -->
	</div>
	<div class="row"></div>
</div>
<div class="container">
	<div class="item bot20">
		
		<div class="change col-md-10 col-md-offset-1 bd-div bgclor imgbg">

			<div class="row">
				<div class="col-md-3 col-xs-3"></div>
				<div class="col-md-6 top50 left20 ">
					<?php if($practice==0){ ?>
					<div class="panel panel-default">
						<div class="panel-heading" style="background-color: #9fc7c8;">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse2" class="roboto">
								<h3 class="panel-title text-center text-uppercase">
									<strong style="color: #363636;">Hướng dẫn làm đề kiểm tra</strong>
								</h3>
							</a>
						</div>
						<div id="collapse2" class="panel-collapse tcolor collapse roboto">
							<div class="left10 top20 ">
								<strong>Bước 1: </strong> <span>Chọn 1 đề trong 2 đề ở mục  </span><strong>Tuần</strong>
							</div>
							<div class="left10 top20">
								<strong>Bước 2: </strong> <span>Thực hiện làm bài </span>
								<br/>
								<br/>
								<ul class="ul-test">
									<li>Thời gian làm bài là 45 phút</li>
									<li>Click để tích chọn đáp án đúng</li>
									<li>Click vào <strong>biểu tượng loa</strong> để nghe câu hỏi bằng tiếng Anh</li>
	
		
								</ul>
							</div>
							<div class="left10 top20 ">
								<strong>Bước 3: </strong> Hoàn thành bài: Click vào nút <strong> Hoàn thành  </strong>
								
							</div>
							<div class="left10 top20">
								<strong>Bước 4: </strong> <span>Xem kết quả và đáp án: Click vào nút <strong> Xem đáp án</strong> 
							</div>
							<br/>
							
						</div>
					</div>
					<?php }else{ ?>
					<div class="panel panel-default">
						<div class="panel-heading" style="background-color: #9fc7c8;">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse2" class="roboto">
								<h3 class="panel-title text-center text-uppercase">
									<strong style="color: #363636;">Hướng dẫn làm đề luyện tập</strong>
								</h3>
							</a>
						</div>
						<div id="collapse2" class="panel-collapse tcolor collapse roboto">
							<div class="left10 top20 ">
								<strong>Bước 1: </strong> <span>Chọn 1 đề trong 2 đề ở mục  </span><strong>Tuần</strong>
							</div>
							<div class="left10 top20">
								<strong>Bước 2: </strong> <span>Thực hiện làm bài </span>
								<br/>
								<br/>
								<ul class="ul-test">
									<li>Thời gian làm bài là 45 phút</li>
									<li>Click để tích chọn đáp án đúng</li>
									<li>Click vào <strong>biểu tượng loa</strong> để nghe câu hỏi bằng tiếng Anh</li>
	
		
								</ul>
							</div>
							<div class="left10 top20 ">
								<strong>Bước 3: </strong> Hoàn thành bài: Click vào nút <strong> Hoàn thành  </strong>
								
							</div>
							<div class="left10 top20">
								<strong>Bước 4: </strong> <span>Xem kết quả và đáp án: Click vào nút <strong> Xem đáp án</strong> 
							</div>
							<br/>
							
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
