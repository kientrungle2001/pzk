<?php
$tests 	= $data->getTests();
$test	= $data->getTest();
$testId = $data->getTestId();
$doTestPostUrl = $data->getDoTestPostUrl();
if(!$doTestPostUrl) {
	$doTestPostUrl = '/test/doTest/';
}
 ?>

<div class="container">
	<div class="row">
		<div class="col-md-1 col-xs-1"></div>
		<?php if(empty($tests)):?>
			<strong>Không có bài test nào</strong>
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
		<form class="form_search_test" style="margin: 15px 0px" action="<?=BASE_REQUEST?><?php echo $doTestPostUrl ?>?practice=<?php echo $data->getPractice()?>&class=<?php echo $data->getClass()?>" method="post" onsubmit = "return check_select_test()">
		    <input type="hidden" id="question_time" name = "question_time" value = "<?php echo $test->getTime()?>"/>
			<div class="row form-group">
		    	<div class="col-xs-9 pd-0">
		    		<select id="test" name="test" class="form-control select_type title-blue" onchange = "get_time_test(this.options[this.selectedIndex].getAttribute('data_time'))" >
		    			<?php if($test):?>
							<option value="<?php echo $test->getId()?>" select="selected" data_time="--:--"><?php echo $test->getName()?> </option>
						<?php else:?>
							<option value="" data_time="--:--">Chọn đề</option>
						<?php endif;?>
						<?php foreach ($tests as $testEntity):?>
							<option value="<?php echo $testEntity->getId()?>" data_time="<?php echo $testEntity->getTime()?>"><?php echo $testEntity->getName()?> - Số câu <?php echo $testEntity->getQuantity()?></option>
						<?php endforeach;?>
					</select>
		    	</div>
		    	
		    	
		    	<div class="col-xs-3 pd-0" style="z-index:10;">
		    		<div class="row time-count-p">
		    			<div class="col-xs-6 margin-top-39 title-time title-blue"><span>Thời gian </span></div>
		    			<div class="col-xs-6 margin-top-24">
		    				 <div class="num-time title-red">--:--</div>
		    			</div>
		    		</div>
		    	</div>
		    </div>
		    
		    <div class="row border-question text-center" style="z-index: 9">
				<div class="col-xs-12">
					<button style="margin-top: 88px; width: 280px; margin-left: 6px;" class="btn btn-custom91" type="submit"><span class="" style="font-size:36px;">START NOW</span></button>
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
		var test_id = '<?php echo $testId ?>';
		$(function() {
			$('#test').val(test_id);
			$('#test').change();
		});
		
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