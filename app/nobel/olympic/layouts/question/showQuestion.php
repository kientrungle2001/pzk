<link rel="stylesheet" href="/default/skin/nobel/ptnn/css/question/choice.css">
<script src="<?=BASE_URL?>/js/loadding.js"></script>
<?php
$showQuestions = $data->getData_showQuestion ();
$question_topic = $data->getData_question_topic ();
$data_criteria = $data->getData_criteria ();
?>

<?php if(!empty($data_criteria['category_type'])):?>
<div class="row">
	<h2 class="title-practice"><?=$data_criteria['category_type_name']?> <?php if(!empty($data_criteria['question_topic'])) echo "- " .$question_topic[0]['name'];?></h2>
</div>
<?php else:?>
<div class="row">
	<h2 class="title-practice"><?=$data_criteria['category_name']?></h2>
</div>
<?php endif;?>
<div class="row">
	<h3 class="title-practice text-center"> Bài tập <?=$data_criteria['num_exercise'];?></h3>
</div>
<div class="col-xs-12 margin-top-20">
	<div class="time-count-p text-center">
    	<div class="title-time title-blue"><span>Thời gian </span></div>
    	<div id="countdown" class="num-time title-red"><?=$data_criteria['question_time']?></div>
    </div>
</div>
<div class="col-xs-12">
	<form id="form_question_nn" class="form-horizontal" method="post">
		
		<fieldset id="idFieldset"><!-- disabled="1"  -->
			<div class="col-xs-12 margin-top-20">
				<?php
                $i	= 1;
                $page	= 1;
                $numpage	= count($showQuestions);
                ?>
				
		    	<?php foreach($showQuestions as $key =>$value):?>
		    	<div class=" step_ answer_box question_page_<?php echo $page?>">
                    <?php $i++; $page=ceil($i/1);?>
			    			
		    		<div class="order">Câu : <?=$key+1;?></div>
					<input type="hidden" name="questions[<?=$value['id']?>]" value="<?=$value['id']?>" /> 
					<input type="hidden" name="questionType[<?=$value['id']?>]" value="<?=$value['type']?>" />
		    		<?php
						$QuestionObj = pzk_obj ( 'education.question.type.' . setSuperType ( $value ['type'] ) );
						$QuestionObj->setQuestionId ( $value ['id'] );
						$QuestionObj->display ();
					?>
				</div>
		    	<?php endforeach;?>
		    </div>
		    <input type="hidden" name="category_root" value="<?=$data_criteria['category_id'];?>" />
			<input type="hidden" name="category_id" value="<?=$data_criteria['category_type'];?>" /> 
			<input type="hidden" name="question_time" value="<?=$data_criteria['question_time']?>" />
			<input type="hidden" name="totaltrue" />
			<input type="hidden" name="num_exercise" value="<?=$data_criteria['num_exercise']?>"/>
		</fieldset>
		
		<input type="hidden" name="question_time" value="<?=$data_criteria['question_time']?>"/>
    	<input type="hidden" id="start_time" name="start_time" value="<?=$_SERVER['REQUEST_TIME'];?>" />
    	<input type="hidden" id="during_time" name="during_time" value="" />
		
		<?php if(count($showQuestions) > 1) { ?>
        <div class="col-xs-12 pd-top-40">
            <button type="button" onclick="Back()" class="btn btn-default"><span class="glyphicon glyphicon-backward"></span> Quay lại</button>
            <button type="button" onclick="Next()" class="btn btn-default"><span class="glyphicon glyphicon-forward"></span> Tiếp </button>
        </div>
        <?php } ?>
        
		<div class="practice-result margin-top-10">
			<button id="finish-choice" class="btn btn-primary" name="finish-choice" onclick="finish_choice();" type="button">
				Hoàn thành 
			</button>
			<button id="view-result" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" name="view-result" type="button" style="display:none;">
				Xem kết quả 
			</button>
			<button id="show-answers" class="btn btn-danger" name="show-answers" onclick="show_answers();" type="button">
				Xem đáp án 
			</button>
			<button id="review-request" class="btn btn-default" name="review-request" onclick="review_request();" type="button">
				Yêu cầu chấm
			</button>
			<button id="save-choice" class="group_button section_cate" name="save-choice" onclick="save_choice();" type="button"><span class="glyphicon glyphicon glyphicon-save" aria-hidden="true"></span>
				Lưu vào vở bài tập
			</button>
		</div>
	</form>
</div>
<!-- Modal popover view-result -->
<div class="modal fade" role="dialog" id="exampleModal" aria-labelledby="gridSystemModalLabel" aria-hidden="true">
  	<div class="modal-dialog">
	    <div class="modal-content">
	    	<div class="modal-header">
          		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          		<h3 class="modal-title text-center title-blue" id="gridSystemModalLabel"><b>Kết quả bài làm</b></h3>
        	</div>
        	
	    	<div class="modal-body">
	    		<div class="row">
	    			<div class="col-xs-12 title-blue">
		    		 	<div class="col-xs-8 question_true control-label">Số điểm đạt được </div> <div class="col-xs-4 num_true title-blue"></div>
		    		</div>
		    		<!--  <div class="col-xs-12 title-red">
		    		 	<div class="col-xs-8 question_false control-label">Số câu trả lời sai </div> <div class="col-xs-4 num_false title-red"></div>
		    		</div>
		    		-->
		    		<div class="col-xs-12" style="color: #F0AD4E">
		    		 	<div class="col-xs-8 question_total control-label">Tổng số câu </div> <div class="col-xs-4 num_total"></div>
		    		</div>
	    		</div>
	    	</div>
	    	<div class="modal-footer">
		        <button type="button" class="btn btn-sm btn-danger pull-left" onclick="history.back()"> Chọn luyện tập các môn khác <span class="glyphicon glyphicon-arrow-left"></span></button>
		        <button type="button" class="btn btn-sm btn-success pull-right" onclick="location.reload()"><span class="glyphicon glyphicon-arrow-right"></span> Làm tiếp câu mới trong <?=$data_criteria['category_name']?></button>
	      	</div>
	    </div>
 	</div>
</div>
<!-- End Modal popover view-result -->


<script>
	
		var formdata;
		var totaltrue;
        function finish_choice(){

        	var time_real = $('.num-time').text().split(":");
    		
    		var start_time = <?=$data_criteria['question_time']?>;
    		
    		var during_time = parseInt(start_time)*60 - (parseInt(time_real[0])*60 + parseInt(time_real[1]));
    		
    		$('#during_time').val(during_time);
            
    		formdata = $('#form_question_nn').serializeForm();
    		$('#idFieldset input').prop( "disabled", true );
    		$('#idFieldset .remove-input').prop( "disabled", true );
    		$('#idFieldset .add-sub-input-test').prop( "disabled", true );
    		$('#finish-choice').prop( "disabled", true );
    		$('#idFieldset textarea').prop( "disabled", true );
    		get_answers();
    		return formdata;
        }
        
		var user_book_id;
		var saved = false;
        function save_choice(){
			if(user_book_id == undefined){
	        	if(formdata == null){
	          		//formdata = finish_choice();
	        		alert('Click hoàn thành để lưu bài tập !');
	          	}else{
		          	$.ajax({
		              	type: "Post",
			            data:{
			            	answers:formdata,
			            	totaltrue: totaltrue,
			            	keybook:"<?=$data_criteria['keybook']?>"
			            },
			            url:'/Ngonngu/saveChoice',
			            success: function(results){
			            	if(results){
			                   	user_book_id	=	results;
			                   	saved			= 	true;
			                	$('#save-choice').prop( "disabled", true );
			                   	$('#btt_fill_sendmark').prop( "disabled", false );
								if(results !== 'undefined' && results != "0"){
			                   		alert('Lưu bài tập thành công');
								} else{
									alert('Lỗi người dùng');
								}
			                }
			           	}
		            });
	          	}
			}
        }

		function get_answers(){
			var category_root = '';
	       	if(formdata	==	null){
	      		alert('Click hoàn thành để xem đáp án !');
	      	}else{
	      		$.ajax({
		          	type: "Post",
			        data:{
			          	answers:formdata,
			        },
			        url:'<?=BASE_REQUEST?>/Ngonngu/showAnswersChoice',
			        success: function(results){
			         	var data = $.parseJSON(results);	
			           	$('.num_true').text(data.total);
			           	var question_total = data.totalQuestions;
			           	totaltrue = data.total;
			           	$('input[name=totaltrue]').val(totaltrue);
			           	//var num_false = question_total - data.total;
			           	//$('.num_false').text(num_false);
			           	$('.num_total').text(question_total);
			           	category_root = data.category_root;
			           	if(category_root == '96'){
				      		$('#view-result').show();
					     	$('#exampleModal').modal('show');
				        }
			      	}
		        });
				
		        
	      	}
	   	}

        function show_answers(){
            
        	if(formdata	==	null){
      			alert('Click hoàn thành để xem đáp án !');
      		}else{
      			$.ajax({
	              	type: "Post",
		            data:{
		            	answers:formdata
		            },
		            url:'/Ngonngu/showAnswersChoice',
		            success: function(results){
		            	var data = $.parseJSON(results);
		            	$.each(data, function(i, item) {
			            	
			            	if(item.superType == 'choice'){
			            		$('.answers_'+item.questionId+'_'+item.value).css('color', '#3e9e00');
				           		$('.answers_'+item.questionId+'_'+item.value).css('font-weight', 'bold');
				           		$('.answers_'+item.questionId+'_'+item.value).append('<span class="has-success glyphicon glyphicon-ok"></span>');
				            }
				            
				            if(item.superType == 'fill_two'){
					            var data_value = item.value;
				            	$.each(data_value, function(j, data_value) {
						            if(data_value.status == 1){
										var fill_two_true = $('.fill_two_true_'+data_value.question_id+'_'+data_value.id).val();
										if(fill_two_true.trim() == data_value.content){
											$('.check_'+data_value.question_id+'_'+data_value.id).removeClass('hidden');
										}
						            }else{
						            	var fill_two_false = $('.fill_two_false_'+data_value.question_id+'_'+data_value.id).val();
						            	if(fill_two_false.trim() == data_value.content){
						            		$('.check_'+data_value.question_id+'_'+data_value.id).removeClass('hidden');
						            	}
							        }
				            	});
					        }

					        if(item.superType == 'fill_many'){
					        	var data_value = item.value;
					        	var data_content = "";
				            	$.each(data_value, function(j, data_value) {
					            	if(j ==0){
						            	data_content = data_value.content ;
					            	}else{
				            			data_content = data_content+', '+data_value.content ;
					            	}
				            	});
				            	$('.answer_full_'+item.questionId).append(data_content);
				            	$('.answer_full_'+item.questionId).css('color', '#5cb85c');
				            	$('.answer_full_'+item.questionId).show(); 
					        }

					        if(item.superType == 'fill_many_text'){
					        	var data_value = item.value;
					        	var data_content = "";
				            	$.each(data_value, function(j, data_value) {
					            	if(j ==0){
						            	data_content = data_value.content ;
					            	}else{
				            			data_content = data_content+'<br/>'+data_value.content ;
					            	}
				            	});
				            	$('.answer_full_'+item.questionId).append(data_content);
				            	$('.answer_full_'+item.questionId).css('color', '#5cb85c');
				            	$('.answer_full_'+item.questionId).show();
								
					        }

					        if(item.superType == 'choice_ex'){
								
					        	var data_value = item.value;
				            	$.each(data_value, function(j, data_value) {
				            		if(data_value.status == 1){
				            			$('.answer_full_'+item.questionId).append(data_value.content+'<br/>'+data_value.content_full);
						            	$('.answer_full_'+item.questionId).css('color', '#5cb85c');
						            	$('.answer_full_'+item.questionId).show();
					            	}
				            	});
				            	
					        }

					        if(item.superType == 'fill_one_text'){
					        	var data_value = item.value;
				            	$.each(data_value, function(j, data_value) {
			            			$('.answer_full_'+item.questionId).append(data_value.content);
					            	$('.answer_full_'+item.questionId).css('color', '#5cb85c');
					            	$('.answer_full_'+item.questionId).show();
				            	});
					        }

					        if(item.superType == 'fill_table'){
					        	var data_value = item.value;
				            	$.each(data_value, function(j, data_value) {
			            			$('.answer_full_'+item.questionId).append(data_value.content);
					            	$('.answer_full_'+item.questionId).css('color', '#5cb85c');
					            	$('.answer_full_'+item.questionId).show();
				            	});
					        }
		            	});

		            	$('.explanation').removeClass('hidden');
		           	}
	            });
				
	     		$('#show-answers').prop("disabled", true);
      		}
       	}

		function review_request(){
			if(formdata	==	null){
      			alert('Click hoàn thành để lưu bài tập!');
      		}else{
          		if(!saved){
          			alert('Click lưu bài tập trước khi gửi yêu cầu chấm!');
              	}else{
	      			$.ajax({
		              	type: "Post",
			            data:{
			            	user_book_id: user_book_id,
			            	keybook:"<?=$data_criteria['keybook']?>" 
			            },
			            url:'/Ngonngu/requestChoice',
			            success: function(results){
							if(results == 1){
								alert('Gửi yêu cầu chấm thành công!');
							}else if(results == 0){
								alert('Gửi yêu cầu chấm lỗi!');
							}
			            }
	      			});
              	}
      		}
		}
		
        function addInputRow(key){
            var div = document.createElement('div');

            div.className = 'col-xs-3 element-input';

            div.innerHTML = '<div class="input-group" style="margin-bottom: 10px; width:100%;" >\
	    					<input type="text" name="answers['+key+'][]" class="form-control content_value"/>\
	        			</div>\
	        			<div class="remove-input"  style="margin-bottom: 10px;" ><a href="javascript:void(0)" class="color_delete" title="Xóa"><span class="glyphicon glyphicon-remove-circle"></span></a></div>';

            $('.itemAnswer_'+key).append(div);
        }
		
        function addInputRowText(key){
            var div = document.createElement('div');

            div.className = 'col-xs-10 element-input margin-top-10';

            div.innerHTML = '<textarea type="text" name="answers['+key+'][]" class="form-control content_value"> </textarea>\
	        			<div class="remove-input"  style="margin-bottom: 10px;" ><a href="javascript:void(0)" class="color_delete" title="Xóa"><span class="glyphicon glyphicon-remove-circle"></span></a></div>';

            $('.itemAnswer_'+key).append(div);
        }

        function addInputRowTableText(key, ikey){
        	var div = document.createElement('div');

            div.className = 'col-xs-4 element-input';

            div.innerHTML = '<input type="text" name="answers['+key+']['+ikey+'][]" class="form-control content_value"/>\
	        			<div class="remove-input"  style="margin-bottom: 10px;" ><a href="javascript:void(0)" class="color_delete" title="Xóa"><span class="glyphicon glyphicon-remove-circle"></span></a></div>';

            $('.itemAnswer_'+key+'_'+ikey).append(div);

        }

        $(".nobel-list-md").on("click", '.remove-input', function(e){
            $(this).parent().remove();
        });
		
        var CountDown = (function ($) {
      	    // Length ms 
      	    var TimeOut = 10000;
      	    // Interval ms
      	    var TimeGap = 1000;
      	    
      	    var CurrentTime = ( new Date() ).getTime();
      	    var EndTime = ( new Date() ).getTime() + TimeOut;
      	    
      	    var GuiTimer = $('#countdown');
      	    
      	    var Running = true;
      	    
      	    var UpdateTimer = function() {
      	        // Run till timeout
      	        if( CurrentTime + TimeGap < EndTime ) {
      	            setTimeout( UpdateTimer, TimeGap );
      	        }
      	        // Countdown if running
      	        if( Running ) {
      	            CurrentTime += TimeGap;
      	            if( CurrentTime >= EndTime ) {
      	                GuiTimer.css('color','red');

      	              	finish_choice();
      	            }
      	        }
      	        // Update Gui
      	        var Time = new Date();
      	        Time.setTime( EndTime - CurrentTime );
      	        var Minutes = Time.getMinutes();
      	        var Seconds = Time.getSeconds();
      	        
      	        GuiTimer.html( 
      	            (Minutes < 10 ? '0' : '') + Minutes 
      	            + ':' 
      	            + (Seconds < 10 ? '0' : '') + Seconds );
      	    };
      	    
      	    var Pause = function() {
      	        Running = false;
      	    };
      	    
      	    var Start = function( Timeout ) {
      	        TimeOut = Timeout;
      	        CurrentTime = ( new Date() ).getTime();
      	        EndTime = ( new Date() ).getTime() + TimeOut;
      	        UpdateTimer();
      	    };

      	    return {
      	        Pause: Pause,
      	        Start: Start
      	    };
      	})(jQuery);
      	
      	jQuery('#finish-choice').on('click',CountDown.Pause);
		
      	// ms
      	CountDown.Start(<?=$data_criteria['question_time']*60*1000?>);

      	// next pages question
      	
      	var currentpage=0;

        function Next(){
            var numpage=<?php echo $numpage ?>;
            if(currentpage < numpage){
                currentpage++;
            }
            $('.answer_box').removeClass('active');
            $('.question_page_'+currentpage).addClass('active');
        }
        function Back(){
            var numpage=<?php echo $numpage ?>;
            if(currentpage >1){
                currentpage--;
            }
            $('.answer_box').removeClass('active');
            $('.question_page_'+currentpage).addClass('active');
        }
        Next();
    </script>