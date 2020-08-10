<?php
$class = intval(pzk_request('class'));
$type= intval(pzk_request('practice'));
if($type == 0){
	$dataTest = $data->get('test');
}
if($type==1){
	$dataTest = $data->get('practice');
}
$doTestPostUrl = $data->get('doTestPostUrl');
if(!$doTestPostUrl) {
	$doTestPostUrl = '/test/doTest/';
}
 ?>
<div class="container">
	<p class="t-weight text-center btn-custom8 mgright textcl">Làm <?php if(${'type'}): ?>bài luyện tập<?php else: ?>đề thi<?php endif; ?> - Lớp <?php echo $class; ?></p>
</div>
<div class="guide">
	<!-- Video slide guide -->
</div>
<div class="container">
	<div class="row">
		<div class="col-md-1 col-xs-1"></div>
		<?php if(empty($dataTest)):?>
	
		<?php else:?>
		<div class="col-md-10 col-xs-10 bd-div bgclor form_search_test top10 bot20 imgbg">
			<?php if(!pzk_session('userId')): ?>
			<form class="form_search_test" style="margin: 15px 0px" action="<?=BASE_REQUEST?><?php echo $doTestPostUrl ?>" method="post" onsubmit = "return check_select_test()">
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
		<form class="form_search_test" style="margin: 15px 0px" action="<?=BASE_REQUEST?><?php echo $doTestPostUrl ?>?practice=<?php echo $type ?>&class=<?php echo $class ?>" method="post" onsubmit = "return check_select_test()">
			<?php 
			$isInList = false;
			$testDetail = $data->get('testDetail');
			if($testDetail) {
				foreach($dataTest as $test) {
					if($testDetail['id'] == $test['id']) {
						$isInList = true;
					}
				}
			}
			
			?>
		    <div class="col-xs-12 form-group">
		    	<?php if(!empty($dataTest)):?>
		    	<div class="col-xs-9 pd-0">
		    		<select id="test" name="test" class="form-control select_type title-blue" onchange = "get_time_test(this.options[this.selectedIndex].getAttribute('data_time'))" >
		    			<?php if(is_array($testDetail) && $isInList):?>
							<option value="<?=$testDetail['id']?>" select="selected" data_time="--:--"><?=$testDetail['name']?> </option>
						<?php else:?>
							<option value="" data_time="--:--">Chọn đề</option>
						<?php endif;?>
						<?php foreach ($dataTest as $key => $test):?>
							<option value="<?=$test['id'];?>" data_time="<?=$test['time'];?>"><?=$test['name'];?> - Số câu <?=$test['quantity']?></option>
						<?php endforeach;?>
					</select>
		    	</div>
		    	<input type="hidden" id="question_time" name = "question_time" value = "<?=$test['time'];?>"/>
		    	<?php endif;?>
		    	
		    	<div class="col-xs-3 pd-0" style="z-index:10;">
		    		<div class="time-count-p">
		    			<div class="col-xs-6 margin-top-39 title-time title-blue"><span>Thời gian </span></div>
		    			<div class="col-xs-6 margin-top-24">
		    				 <div class="num-time title-red"><?=$test['time'];?></div>
		    			</div>
		    		</div>
		    	</div>
		    </div>
		    
		    <div class="col-xs-12 border-question" style="z-index: 9">
		    	<div class="question_content pd-0">
		    			<div class="col-md-12 col-xs-12 text-center pd-0">
							<button style='margin-top: 88px; width: 280px; margin-left: 6px;' class="btn btn-custom91" type="submit"><span class="" style="font-size:36px;">START NOW<span></button>
		    			</div>
			    	<div class="margin-top-10">
		    			
		    		</div>
			    </div>
		    </div>
		</form>
		<?php endif; ?>
		<?php endif;?>
		</div>
		<div class="col-md-1 col-xs-1"></div>
	</div>
</div>
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
			$('#question_time').val(data_time);
		}
</script>