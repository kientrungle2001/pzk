<?php
		$language = pzk_global()->get('language');
		$parentId = $data->get('parentId');
		$showQuestions 	= $data->getQuestionCompability(TL, $parentId);
		shuffle($showQuestions);
		$showResult = $data->get('showResult');
		if(count($showQuestions) > 0) {
		$data_criteria	= $data->get('data_criteria');
		
		
		?>
		
<div class="container">
	<style>
		.num-timetl{
			color: white !important;
		font-size: 20px;
		font-weight: bold;
		font-family: "cadena";
		display: inline-block;
		}
	</style>
	<p class="t-weight text-center btn-custom8 textcl">Làm tiếp bài tự luận</p>
	
	<?php if($parentId == 139 or $parentId == 133){ ?>
	<p class="text-center red">(Câu hỏi hiển thị dưới dạng Song ngữ, HS có thể tham khảo mục dịch tiếng Việt nhưng cần làm bài ở nội dung câu hỏi bằng tiếng Anh.)</p>
	<?php } ?>
	<div class="item">
		<div class="item">
			
			<div class="col-md-12 col-xs-12 bgclor form_search_test top10 bot20">
				<div class="col-xs-12 text-center form-group  top20">
				
					<span><b><?php echo $language['time'];?>:</b> </span>
					<div style="margin: 0px auto;" class="time">
						<img src="/Themes/Songngu3/skin/images/watch.png">
						<div id="CountDowntltl" class="num-timetl robotofont"><?=$data_criteria['time']?></div>
					</div>
					
					
			
				</div>
					
				<div class="item" style="z-index: 9">
					<form id="form_question_tl" class="question_content pd-0 item mgb15 form-horizontal" method="post">
						<div class="col-xs-12 margin-top-20">
							<?php 
								$i	= 1;
								$page	= 1;
								$numpage	= numPage(count($showQuestions));
							?>
							
							<fieldset id="idFieldset">  <!-- disabled="1"  -->
							<?php foreach($showQuestions as $key =>$value):?>
								<div class="row step_ answer_box question_page_<?php echo $page?> top20">
									<?php $i++; $page=ceil($i/30);?>
									
										<div class="stt"><?php echo $language['question'];?> <?=$key+1;?> 
										<?php if(pzk_user_special()) :?><br />
									(#<?php echo @$value['id']?>)
									<?php endif; ?>
										</div>

										<div class="item top10">
										<input type="hidden" name="questions[<?=$value['id']?>]" value="<?=$value['id']?>"/>
										<input type="hidden" name="questionType[<?=$value['id']?>]" value="<?=questionTypeOjb($value['questionType'])?>"/>
										<?php 
											$QuestionObj = pzk_obj_once('Education.Question.Type.Compabilitytl');
											
											$questionChoice = _db()->getEntity('Question.Choice');
											$questionChoice->setData($value);
											$QuestionObj->set('question', $questionChoice);
											$QuestionObj->set('type', $questionChoice->get('type'));
											
											$QuestionObj->set('questionId', $value['id']);
											$QuestionObj->set('cacheable', 'false');
											$QuestionObj->set('cacheParams', 'layout, questionId');
											$QuestionObj->display();
										?>
										</div>
								</div>
							<?php endforeach;?>
							</fieldset>
							<input type="hidden" name="question_time" value="<?=$data_criteria['time']?>"/>
							<input type="hidden" id="start_time" name="start_time" value="<?=$_SERVER['REQUEST_TIME'];?>" />
							<input type="hidden" id="during_timetl" name="during_timetl" value="" />
							<input type="hidden" id="testId" name="testId" value="<?= $data_criteria['id'];?>" />
							<input type="hidden" id="parentTest" name="parentTest" value="<?php echo $data_criteria['parentTest'];?>" />

						</div>
						
						<div class="fix_da">
							
							<button id="finish-choicetl" class="btn btn-primary" name="finish-choicetl" onclick="finish_choicetl();" type="button">
								<?= $language['finish']; ?>
							</button>
							
							<?php if($showResult){ ?>	
								<button style="display:none;" id="tlanswers" onclick="return showtlanswers();" class="btn btn-danger" name="show-answers"   type="button">
									<?php echo $language['result'];?>
								</button>
							<?php } ?>
						</div>
						
					</form>
				</div>
			</div>
			
		</div>
	</div>
	
	<div style="display: none" class="item" id="result_score">
					
		<div class="alert alert-warning text-center">
			Chúc mừng bạn đã hoàn thành bài kiểm tra.
		</div>
	
	</div>
	
</div>	
	<script>

	function showtlanswers(){

		$('.showtlanswers').each(function() {
			$(this).show();
		});
	};
	var formdatatl;
	
    function finish_choicetl(){
        
		var time_real = $('.num-timetl').text().split(":");
		
		var start_time = <?=$data_criteria['time']?>;
		
		var during_timetl = parseInt(start_time) - (parseInt(time_real[0])*60 + parseInt(time_real[1]));
		
		
		
		$('#during_timetl').val(during_timetl);
		
    	formdatatl = $('#form_question_tl').serializeForm();
    	$('#idFieldset input').prop( "disabled", true );
		$('#idFieldset textarea').prop( "disabled", true );
    	$('#finish-choicetl').prop( "disabled", true );
		
    	save_choicetl();
		
    	return formdatatl;
    }

	var user_book_id_tl;
	function save_choicetl(){
		if(formdatatl	==	null){
      		alert('Click hoàn thành để xem đáp án !');
      	}else{
			if(user_book_id_tl == undefined){
	        	if(formdatatl == null){
	          		formdatatl = finish_choicetl();
	          	}
	          	$.ajax({
	              	type: "Post",
		            data:{
		            	answers: 	formdatatl		        
		            },
		            url:'<?=BASE_REQUEST?>/compability/saveTl',
		            success: function(results){
		            	if(results){
		            		
		            		$('#finish-choicetl').prop( "disabled", true );
							$('#result_score').show();
							$('#tlanswers').show();
							

		                }
		           	}
	            });
			}
      	}
    }
	
	
  	var CountDowntl = (function ($) {
  	    // Length ms 
  	    var TimeOut = 10000;
  	    // Interval ms
  	    var TimeGap = 1000;
  	    
  	    var CurrentTime = ( new Date() ).getTime();
  	    var EndTime = ( new Date() ).getTime() + TimeOut;
  	    
  	    var GuiTimer = $('#CountDowntltl');
  	    
  	    var Running = true;
  	    
  	    var UpdateTimer = function() {
  	        // Run till timeout
  	        if( CurrentTime + TimeGap < EndTime ) {
  	            setTimeout( UpdateTimer, TimeGap );
  	        }
  	        // CountDowntl if running
  	        if( Running ) {
  	            CurrentTime += TimeGap;
  	            if( CurrentTime >= EndTime ) {
  	                GuiTimer.css('color','red');

  	  	          	finish_choicetl();
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
  	
  	jQuery('#finish-choicetl').on('click',CountDowntl.Pause);

  	// ms
	CountDowntl.Start(<?=$data_criteria['time']*1000?>);
	
  	
	
	
</script>
<style>
	.table-o tr td{ width: 30px;}
</style>
	
	<?php } ?>




