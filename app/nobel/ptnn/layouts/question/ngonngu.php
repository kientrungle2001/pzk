<style>
	.left-content { 
		clear:both;
    	background-image: url('/default/skin/nobel/ptnn/media/bg_practive_page.jpg');
        background-size: 99.5%;
        background-repeat: no-repeat;
        min-height: 1400px;
    }
    .guide{padding: 10px 20px 0px 20px;}
</style>
<?php
	$category = $data->getCategory();
	
	$data_topics = $data->getData_topics();
	
	$category_id = $data->getCategoryId();
?>
<div class="left-content">
	<div class="guide">
	<?php 
		$obj = pzk_obj('education.question.video');
		$obj->display();
	?>
	</div>
	<div class="criteria">
		<div class="row">
			<h2 class="title-practice"><?=$category['name']?></h2>
		</div>
		<div class="col-xs-12">
			<form class="form_search_practice" style="margin: 15px 0px" id="post_practice" action="/Ngonngu/doQuestion/" method="post" onsubmit = "return check_select_test()">
				<input type="hidden" name="category_id" value="<?=$category_id?>"/>
				<input type="hidden" name="category_name" value="<?=$category['name']?>"/>
				<div class="col-xs-12 form-group">
					<div class="col-xs-5 pd-0">
				        <select id="category_type" name="category_type" class="form-control select_type title-blue" style="text-align:left" onchange="get_list_exercise()">
				        	<option value="<?=$category['id']?>">Chọn dạng về <?=$category['name']?></option>
				        	<?php if(!empty($category['child'])):?>
								<?php foreach($category['child'] as $key =>$value):?>
									<option class="pd-left-10" value="<?=$value['id']?>"><?=$value['name']?> </option>
								<?php endforeach;?>
							<?php endif;?>
						</select>
					</div>
				    
				    <div class="col-xs-4 pd-0">
				        <select id="topic" name="topic" class="form-control select_type title-blue" onchange="get_list_exercise()">
							<option value="">Chủ đề </option>
							<?php foreach($data_topics as $key =>$value):?>
								<option class="pd-left-10" value="<?=$value['id']?>"> <?=$value['name']?> </option>
							<?php endforeach;?>
						</select>
					</div>
				    
		            <div class="col-xs-3 pd-0" style="z-index:10;">
			    		<div class="time-count-p">
			    			<div class="col-xs-6 margin-top-39 title-time title-blue text-center"><span>Thời gian </span></div>
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
			    		<div class="clearfix margin-top-10 class_exercise">
			    			<div class="col-xs-2 pd-0">
			    				<h3 class="pd-top-5">Bài làm</h3>
			    			</div>
			    		</div>
				    </div>
			    </div>
			</form>
		</div>
	</div>
</div>

<script>
	var category_type = "";
	var topic = "";
	function check_select_test(){
		category_type 	= $('#category_type').val();
		topic			= $('#topic').val();

		if(category_type !=="" && topic !==""){
			return true;
		}else if(category_type == ""){
			alert("Bạn hãy chọn dạng bài tập !");
		}else if(topic == ""){
			alert("Bạn hãy chọn chủ đề !");
		}
		return false;
	}

	
	function get_list_exercise(){
		category_type 	= $('#category_type').val();
		topic			= $('#topic').val();
		
		if(/* category_type !=="" && */ topic !== ""){
			$('.class_exercise').html('');
			$.ajax({
              	type: "Post",
	            data:{
	            	category_type: 	category_type,
	            	topic:			topic
	            },
	            url:'/Ngonngu/getExercise',
	            success: function(results){
	            	if(results !== undefined){
						for(i = 1; i<= results; i++){
	            			var html = 	'<div class="col-xs-2">\
	    								<button class="btn btn-do-practice" type="submit" value="'+i+'" name="exercise_no">Bài tập '+i+'</button>\
	    								</div>';
	    					$('.class_exercise').append(html);
						}
		            }
	           	}
            });
            return true;
		}else{
			return false;
		}
	}
</script>