<link rel="stylesheet" href="/default/skin/test/css/question/choice.css">
<script src="<?=BASE_URL?>/js/loadding.js"></script>
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
	$showQuestions 	= $data->getData_showQuestion();
	$data_criteria	= $data->getData_criteria();
?>

<div class="row">
	<h2 class="title-practice"><?=$data_criteria['category_name']?></h2>
</div>

<div class="col-xs-12">
    <div class="col-xs-12 form-group view_practice margin-top-20">
    	<?php if(!empty($data_criteria['category_type'])):?>
    	<div class="col-xs-3 pd-0">
    		<div class="form-control select_type title-blue" ><span> <?=$data_criteria['category_type_name']?> </span></div>
    	</div>
    	<?php endif;?>
    	
    	<div class="col-xs-3 pd-0">
    		<div class="form-control select_type title-blue" ><span> Số câu :</span> <span class="title-red"> <?php if($data_criteria['question_limit'] ==''):?> Tất cả <?php else:?> <?=$data_criteria['question_limit']?> <?php endif;?> </span></div>
    	</div>
    	
    	<div class="col-xs-3 pd-0">
    		<div class="form-control select_type title-blue" ><span> Mức độ :</span> <span class="title-red"> <?php if($data_criteria['question_level'] ==""):?> Tất cả <?php elseif($data_criteria['question_level'] ==1):?> Dễ <?php elseif($data_criteria['question_level'] ==2):?> Bình thường <?php elseif($data_criteria['question_level'] ==3):?> Khó <?php endif;?></span> </div>
    	</div>
    	
    	<div class="col-xs-3 pd-0" style="z-index:10;">
    		<div class="time-count-p">
    			<div class="col-xs-6 margin-top-39 title-time title-blue"><span>Thời gian </span></div>
    			<div class="col-xs-6 margin-top-24">
    				 <div id="countdown" class="num-time title-red"><?=$data_criteria['question_time']?></div>
    			</div>
    		</div>
    	</div>
    </div>
    
    <div class="col-xs-12 border-question" style="z-index: 9">
		<form id="form_question_nn" class="question_content pd-0 form-horizontal" method="post">
			
		    <div class="col-xs-12 margin-top-20">
		    	<?php 
			    	$i	= 1;
			    	$page	= 1;
			    	$numpage	= numPage(count($showQuestions));
		    	?>
		    	
		    	<fieldset id="idFieldset">  <!-- disabled="1"  -->
		    	<?php foreach($showQuestions as $key =>$value):?>
		    		<div class=" step_ answer_box question_page_<?php echo $page?>">
		    			<?php $i++; $page=ceil($i/3);?>
		    			
				    		<div class="order">Câu : <?=$key+1;?></div>
				    		
				    		<input type="hidden" name="questions[<?=$value['id']?>]" value="<?=$value['id']?>"/>
				    		<input type="hidden" name="questionType[<?=$value['id']?>]" value="<?=questionTypeOjb($value['questionType'])?>"/>
				    		<?php 
				    			
					    		$QuestionObj = pzk_obj('education.question.type.'.questionTypeOjb($value['questionType']));
					    		$QuestionObj->setQuestionId($value['id']);
					    		$QuestionObj->setCacheable('true');
					    		$QuestionObj->setCacheParams('layout, questionId');
					    		$QuestionObj->display();
					    	?>
				    </div>
		    	<?php endforeach;?>
		    	</fieldset>
		    	<input type="hidden" name="category_id" value="<?=$data_criteria['category_id']?>"/>
		    	<input type="hidden" name="question_time" value="<?=$data_criteria['question_time']?>"/>
		    	
		    	
		    	
		    </div>
		    
		    <div class="page-view">
		    	<nav>
				  	<ul class="pagination">
				  		
				    	<li class="li_page curent_0">
				      		<a href="javascript:void(0)" onclick="current_page(1)" aria-label="Previous">
				        		<span aria-hidden="true">&laquo;</span>
				      		</a>
				    	</li>
				    	
				    	<?php for($page_i = 1; $page_i <= $numpage; $page_i ++):?>
					    <li class="li_page curent_<?=$page_i?>"><a href="javascript:void(0)" onclick="current_page(<?=$page_i?>)"><?=$page_i?></a></li>
					    <?php endfor;?>
					    
					    <li class="li_page curent_<?=$numpage?>">
					    	<a href="javascript:void(0)" onclick="current_page(<?=$numpage?>)" aria-label="Next">
				        		<span aria-hidden="true">&raquo;</span>
				     	 	</a>
				    	</li>
				    	
				  	</ul>
				</nav>
		    </div>
		    
			<div class="practice-result">
					<button id="finish-choice" class="btn practice-finish" name="finish-choice" onclick="finish_choice();" type="button">
						Hoàn thành 
					</button>
					<button id="show-answers" class="btn practice-view-result" name="show-answers" onclick="show_answers();" type="button">
						Xem đáp án 
					</button>
					<button id="view-result" class="btn btn-success" data-toggle="modal" data-target=".bs-example-modal-sm" name="view-result" type="button" style="display:none;">
						Xem kết quả 
					</button>
			</div>
		</form>
	</div>
</div>

<!-- Modal popover view-result -->
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-sm" id="myModal">
	    <div class="modal-content" style="background: linear-gradient(0deg, #eca76f, white);border-color: #81691c;">
	    	<div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title title-blue" id="exampleModalLabel">Kết quả bài làm </h4>
	      	</div>
	    	<div class="modal-body">
	    		<div class="row" style="color:#81691c;font-weight: bold;">
		    		 <div class="col-xs-8 question_true control-label">Số câu trả lời đúng </div> <div class="col-xs-4 num_true title-blue"></div>
		    		 <div class="col-xs-8 question_false control-label">Số câu trả lời sai </div> <div class="col-xs-4 num_false title-red"></div>
		    		 <div class="col-xs-8 question_total control-label">Tổng số câu </div> <div class="col-xs-4 num_total"><?=$data_criteria['question_limit']?></div>
	    		</div>
	    	</div>
	    	<div class="modal-footer">
		        <button type="button" class="btn btn-sm btn-danger" onclick="history.back()"><span class="glyphicon glyphicon-arrow-left"></span> Chọn lại</button>
		        <button type="button" class="btn btn-sm btn-success" onclick="location.reload()"><span class="glyphicon glyphicon-repeat"></span> Làm lại</button>
	      	</div>
	    </div>
 	</div>
</div>
<!-- End Modal popover view-result -->

<script>
	
	var formdata;
	
    function finish_choice(){
        
    	formdata = $('#form_question_nn').serializeForm();
    	$('#idFieldset').prop( "disabled", true );
    	$('#finish-choice').prop( "disabled", true );
    	return formdata;
    }
    
	function show_answers(){
            
       	if(formdata	==	null){
      		alert('Click hoàn thành để xem đáp án !');
      	}else{
      		$.ajax({
	          	type: "Post",
		        data:{
		          	answers:formdata,
		        },
		        url:'<?=BASE_REQUEST?>/Ngonngu/showAnswersChoice',
		        success: function(results){
		         	var data = $.parseJSON(results);
		         	var input_value_fill = '';
		           	$.each(data, function(i, item) {
			           	
		           		$('.answers_'+item.questionId+'_'+item.value).css('color', '#3e9e00');
		           		$('.answers_'+item.questionId+'_'+item.value).append('<span class="has-success glyphicon glyphicon-ok"></span>');
						if(item.superType =='fill' || item.superType =='join' ){
			           		$('.answers_full_'+item.questionId).css('color', '#3e9e00');
			           		
							input_value_fill =  $('input[name^= "answers['+item.questionId+']"]').val();
							if(input_value_fill == item.value_fill){
			           			$('.answers_full_'+item.questionId).append('<span class="has-success glyphicon glyphicon-ok"></span>');
							}else{
								$('.remove-input_'+item.questionId).append('<span class="title-red glyphicon glyphicon-remove"></span>');
								$('.answers_full_'+item.questionId).append('<span class="has-success"><b>'+item.value_fill+'<b></span>');
							}
						}
		           	});
		           	$('.num_true').text(data.total);
		           	var question_total = <?=$data_criteria['question_limit']?>;
		           	var num_false = question_total - data.total;
		           	$('.num_false').text(num_false);
		      	}
	        });
				
	     	$('#show-answers').prop("disabled", true);
	     	$('#view-result').show();
	     	$('.bs-example-modal-sm').modal('show');
      	}
   	}
	
	var page_i = 1;
	
	function current_page(page_i){
		
	 	$('.answer_box').removeClass('active');
	   	$('.question_page_'+page_i).addClass('active');
	   	
	   	$('.li_page').removeClass('active');
		$('.curent_'+page_i).addClass('active');
	}
	
	current_page(page_i);
	
  	/* jQuery(document).ajaxStart(function () {
   		//show ajax indicator
		ajaxindicatorstart('Trò đợi một lát !','form_question_nn');
  	}).ajaxStop(function () {
		//hide ajax indicator
		ajaxindicatorstop('form_question_nn');
  	}); */

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
	
</script>