<style>
	#left { 
    	background-image: url('/default/skin/test/media/bg_practive_page.png');
        background-size: 99.5%;
        background-repeat: no-repeat;
        min-height: 1350px;
        margin-top: 3px;
    }
</style>

<?php  
	
	$category = $data->getCategory();
	$category_id = $data->getCategoryId();
?>
<div class="guide">
	<!-- Video slide guide -->
</div>

<div class="criteria">
	<?php if(empty($category)):?>
	
	<?php else:?>
	<div class="row">
		<h2 class="title-practice"><?=$category['name']?></h2>
	</div>
	<div class="col-xs-12">
		<form class="form_search_practice" style="margin: 15px 0px" action="<?=BASE_REQUEST?>/Ngonngu/doQuestion/" method="post">
			<input type="hidden" name="category_id" value="<?=$category_id?>"/>
			<input type="hidden" name="category_name" value="<?=$category['name']?>"/>
		    <div class="col-xs-12 form-group">
		    	<?php if(!empty($category['child'])):?>
		    	<div class="col-xs-3 pd-0">
		    		<select id="category_type" name="category_type" class="form-control select_type title-blue">
						<option value="">Chọn dạng</option>
						<?php foreach ($category['child'] as $key => $child):?>
						<option value="<?=$child['id'];?>"><?=$child['name'];?></option>
						<?php endforeach;?>
					</select>
		    	</div>
		    	<?php endif;?>
		    	
		    	<div class="col-xs-3 pd-0">
		    		<select id="number_question" name="number_question" class="form-control select_type title-blue">
						<option value="15">Số câu</option>
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