<?php $dataTest = $data->getTest();?>

<style>
	#left { 
    	background-image: url('/Default/skin/nobel/test/media/bg_practive_page.jpg');
        background-size: 99.5%;
        background-repeat: no-repeat;
        min-height: 1350px;
        margin-top: 3px;
    }
</style>

<div class="guide">
	<!-- Video slide guide -->
</div>

<div class="criteria">
	<?php if(empty($dataTest)):?>
	
	<?php else:?>
	
	<div class="row margin-top-20">
		<div class="col-xs-6 text-center">
			<a class="btn btn-primary" href="<?=BASE_REQUEST?>/Practice">Practice (Luyện tập)</a>
		</div>
		<div class="col-xs-6 text-center">
			<a class="btn btn-danger" href="<?=BASE_REQUEST?>/Online-Examination">Online Test (Thi trực tuyến)</a>
		</div>
	</div>
	
	<div class="row margin-top-5">
		<h2 class="title-test margin-top-5"> THI THỬ TRẮC NGHIỆM ONLINE VÀO LỚP 6 THPT TRẦN ĐẠI NGHĨA  </h2>
		<h4 class="text-center">Full Look còn phù hợp với học sinh lớp 6 khi học Toán và Khoa học bằng tiếng Anh</h4>
		<?php if(pzk_session()->getUserId()): ?>
		<p style="padding-left:20px; padding-right: 20px;"><marquee>Để tra nghĩa một từ, bạn hãy click chuột hai lần vào từ đó - Tham khảo phần dịch và lí giải bằng tiếng Việt trong mục "Xem đáp án".</marquee></p>
		<?php endif; ?>
	</div>
	<div class="col-xs-12 margin-top-20">
		<?php if(!pzk_session()->getUserId()): ?>
			<form class="form_search_test" style="margin: 15px 0px" action="<?=BASE_REQUEST?>/Ngonngu/doTest/" method="post" onsubmit = "return check_select_test()">
				<div class="col-xs-12 border-question" style="z-index: 9">
					<div class="question_content pd-0 margin-top-20">
						<div class="clearfix margin-top-10">
							<div class="col-xs-12 pd-0">
								<h3 class="pd-top-15" style="width: 100%; text-align: center;">Bạn phải <a rel="<?php echo @$_SERVER['REQUEST_URI']?>" class="login_required" data-toggle="modal" data-target=".bs-example-modal-lg" style="cursor:pointer;">Đăng nhập</a> thì mới được thi thử</h3>
							</div>
							<div class="col-xs-5 pd-0">
								
							</div>
						</div>
						<div class="margin-top-10">
							
						</div>
					</div>
				</div>
			</form>
		<?php else: ?>
		<form class="form_search_test" style="margin: 15px 0px" action="<?=BASE_REQUEST?>/Ngonngu/doTest/" method="post" onsubmit = "return check_select_test()">
			<?php $testDetail = $data->getTestDetail();?>
		    <div class="col-xs-12 form-group">
		    	<?php if(!empty($dataTest)):?>
		    	<div class="col-xs-9 pd-0">
		    		<select id="test" name="test" class="form-control select_type title-blue" onchange = "get_time_test(this.options[this.selectedIndex].getAttribute('data_time'))" >
		    			<?php if(is_array($testDetail) && $testDetail !== 0):?>
							<option value="<?=$testDetail['id']?>" select="selected" data_time="--:--"><?=$testDetail['name']?> </option>
						<?php else:?>
							<option value="" data_time="--:--">Chọn đề</option>
						<?php endif;?>
						<?php foreach ($dataTest as $key => $test):?>
							<option value="<?=$test['id'];?>" data_time="<?=$test['time'];?>"><?=$test['name'];?> - Số câu <?=$test['quantity']?></option>
						<?php endforeach;?>
					</select>
		    	</div>
		    	<input type="hidden" name = "question_time" value = ""/>
		    	<?php endif;?>
		    	
		    	<div class="col-xs-3 pd-0" style="z-index:10;">
		    		<div class="time-count-p">
		    			<div class="col-xs-6 margin-top-39 title-time title-blue"><span>Thời gian </span></div>
		    			<div class="col-xs-6 margin-top-24">
		    				 <div class="num-time title-red">--:--</div>
		    			</div>
		    		</div>
		    	</div>
		    </div>
		    
		    <div class="col-xs-12 border-question" style="z-index: 9">
		    	<div class="question_content pd-0">
		    		<div class="clearfix margin-top-10">
		    			<div class="col-xs-2 pd-0">
		    				<h3 class="pd-top-15">Bài làm</h3>
		    			</div>
		    			<div class="col-xs-5 pd-0">
		    				<button class="btn click-test" type="submit"> <span class="text-click-test">( Nhấp chuột vào đây để bắt đầu làm bài )</span> <span class="icon-play"></span>  </button>
		    			</div>
		    		</div>
			    	<div class="margin-top-10">
		    			
		    		</div>
			    </div>
		    </div>
		</form>
		<?php endif; ?>
	</div>
	<?php endif;?>
	
	<script>
		var test_id = "";
		function check_select_test(){
			test_id = $('#test').val();

			if(test_id !==""){
				return true;
			}else{
				alert("Bạn hãy chọn đề thi !");
			}
			return false;
		}

		function get_time_test(data_time){
			$('.num-time').text(data_time);
		}
	</script>
	
</div>