<?php $dataTest = $data->getTest();?>

<style>
	#left { 
    	background-image: url('/default/skin/test/media/bg_practive_page.png');
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
	<div class="row">
		<h2 class="title-test"> Thi Thử </h2>
	</div>
	<div class="col-xs-12">
		<form class="form_search_test" style="margin: 15px 0px" action="<?=BASE_REQUEST?>/Ngonngu/doTest/" method="post" onsubmit = "return check_select_test()">
			
		    <div class="col-xs-12 form-group">
		    	<?php if(!empty($dataTest)):?>
		    	<div class="col-xs-3 pd-0">
		    		<select id="test" name="test" class="form-control select_type title-blue" onchange = "get_time_test(this.options[this.selectedIndex].getAttribute('data_time'))" >
						<option value="" data_time="--:--">Chọn đề</option>
						<?php foreach ($dataTest as $key => $test):?>
							<option value="<?=$test['id'];?>" data_time="<?=$test['time'];?>"><?=$test['name'];?> - Số câu <?=$test['quantity']?></option>
						<?php endforeach;?>
					</select>
		    	</div>
		    	<input type="hidden" name = "question_time" value = ""/>
		    	<?php endif;?>
		    	
		    	<div class="col-xs-3 col-xs-offset-6 pd-0" style="z-index:10;">
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