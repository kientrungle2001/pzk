<style>
	#left { 
    	background-image: url('/Default/skin/test/media/bg_practive_page.jpg');
        background-size: 99.5%;
        background-repeat: no-repeat;
        min-height: 1350px;
        margin-top: 3px;
    }
</style>

<?php  
	
	$category = $data->getCategory();
	$category_id = $data->getCategoryId();
	$category_name = $data->getCategoryName();
?>
<div class="guide">
	<!-- Video slide guide -->
</div>

<div class="criteria">
	<div class="row margin-top-20">
		<div class="col-xs-6 text-center">
			<a class="btn btn-primary" href="<?=BASE_REQUEST?>/Practice">Practice (Luyện tập)</a>
		</div>
		<div class="col-xs-6 text-center">
			<a class="btn btn-danger" href="<?=BASE_REQUEST?>/Online-Examination">Online Test (Thi trực tuyến)</a>
		</div>
	</div>
	
	<div class="col-xs-12 margin-top-20">
		<?php if(pzk_session()->getUserId()): ?>
			<p><marquee>Mỗi một bài làm hiện thị tối đa 20 câu hỏi, sau khi hoàn thành bạn hãy bấm vào "Làm tiếp các câu mới" để chọn các câu khác trong cùng môn học</marquee></p>
		<?php endif; ?>
	</div>

	<?php if(empty($category)):?>
	
	<?php else:?>
	<div class="row">
		<h2 class="title-practice"><?=$category_name['name']?></h2>
	</div>
	<div class="col-xs-12">
		<form class="form_search_practice" style="margin: 15px 0px" action="<?=BASE_REQUEST?>/Ngonngu/doQuestion/" method="post">
			<input type="hidden" name="category_id" value="<?=$category_id?>"/>
			<input type="hidden" name="category_name" value="<?=$category_name['name']?>"/>
		    <div class="col-xs-12 form-group">
		    	
		    	<?php if(!empty($category['child'])):?>
		    	<div class="col-xs-4 pd-0">
		    		<select id="category_type" name="category_type" class="form-control select_type title-blue" onchange="return changeNumberQuestion(this)"  style="text-align:left;">
						<option value="<?=$category_name['id']?>"><?=$category_name['name']?></option>
						<?php foreach ($category['child'] as $key => $child):?>
						
						<?php if((strpos($child['name'], 'Listening') !== false && $childName = 'Listening') || (strpos($child['name'], 'Observation') !== false && $childName = 'Observation')):?>
							<option disabled="disabled" value="<?=$child['id'];?>"><?=$child['name'];?></option>
							<?php 
							if($childName == 'Observation') {
								$dataCategoryCurrent =  $data->getCategoryCurrentObservation();
							} else {
								$dataCategoryCurrent =  $data->getCategoryCurrent();
							}
							?>
							<?php foreach($dataCategoryCurrent['child'] as $k =>$value):?>
								<option child="{childName}" value="<?=$value['id'];?>">&nbsp;&nbsp;&nbsp;&nbsp;<?=$value['name'];?></option>
							<?php endforeach;?>
						<?php else:?>	
							<option value="<?=$child['id'];?>"><?=$child['name'];?></option>
						<?php endif;?>
						<?php endforeach;?>
					</select>
		    	</div>
		    	
		    	<script>
					function changeNumberQuestion(ele){
						var child = $(ele).find(':selected').attr('child');
						if( child == 'Listening' || child == 'Observation'){
							$('#number_question option:not(:first)').addClass('hidden');
							$('#number_question option:first').html('Tất cả');
							$('#number_question option:first').val(0);
							$('#number_question option:first').attr('selected', true);
							$('#number_question').val(0);
						}else{
							$('#number_question option').removeClass('hidden');
							$('#number_question option:first').val('<?=NUMBER_QUESTION20?>');
						}
					}

		    	</script>
		    	<?php endif;?>
		    	
		    	<div class="col-xs-2 pd-0">
		    		<select id="number_question" name="number_question" class="form-control select_type title-blue">
						<option value="<?=NUMBER_QUESTION20?>">Số câu</option>
						<option value="<?=NUMBER_QUESTION5;?>"><?=NUMBER_QUESTION5;?></option>
						<option value="<?=NUMBER_QUESTION10;?>"><?=NUMBER_QUESTION10;?></option>
						<option value="<?=NUMBER_QUESTION15;?>"><?=NUMBER_QUESTION15;?></option>
						<option value="<?=NUMBER_QUESTION20;?>"><?=NUMBER_QUESTION20;?></option>
					</select>
		    	</div>
		    	
		    	<div class="col-xs-3 pd-0">
		    		<select id="level" name="level" class="form-control select_type title-blue">
						<option value=""> Mức độ</option>
						<option value=""> Tất cả</option>
					</select>
		    	</div>
		    	
		    	<div class="col-xs-3 pd-0" style="z-index:10;">
		    		<div class="time-count-p">
		    			<div class="col-xs-6 margin-top-39 title-time title-blue"><span>Thời gian </span></div>
		    			<div class="col-xs-6 margin-top-24">
		    				 <select id="work_time" name="work_time" class="form-control num-time">
								<option value="<?=WORK_TIME15;?>"><?=WORK_TIME15;?></option>
								<option value="<?=WORK_TIME30;?>"><?=WORK_TIME30;?></option>
								<option value="<?=WORK_TIME45;?>"><?=WORK_TIME45;?></option>
								<option value="<?=WORK_TIME60;?>"><?=WORK_TIME60;?></option>
							</select>
		    			</div>
		    		</div>
		    	</div>
		    </div>
		    
		    <div class="col-xs-12 border-question" style="z-index: 9">
		    	<div class="question_content pd-0">
		    		<div class="clearfix margin-top-10">
		    			<div class="col-xs-2 pd-0">
		    				<h3 class="pd-top-5">Bài làm</h3>
		    			</div>
		    			<div class="col-xs-5 pd-0">
		    				<button class="btn btn-block btn-do-practice" type="submit">( Nhấp chuột vào đây để bắt đầu làm bài )</button>
		    			</div>
		    		</div>
			    	<div class="margin-top-10">
		    			
		    		</div>
			    </div>
		    </div>
		</form>
	</div>
	<?php endif;?>
</div>