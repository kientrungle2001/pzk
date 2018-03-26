<?php
	
	$test 				=	$data->getItem();
	
	$questions 			=	$data->getQuestions();
	
	$questionIds 		=	array_map(function($question) {
		return $question['id'];
	}, $questions);
	
	$indexedQuestions	= 	array_combine($questionIds, $questions);
	
	$answers 			= 	$data->getQuestionsAnswers($questionIds);
	
	$session 			=	pzk_session();
	$request 			=	pzk_request();
	$class 				= 	$session->get('lop');
	$language 			= 	pzk_global()->get('language');
	$lang 				= 	$session->get('language');
	$homework			=	$request->get('homework');
	$subject			=	$request->get('subject');
	$topic				=	$request->get('topic');
	$subjectEntity		=	_db()->getTableEntity('categories')->load($subject);
	
?>
<div class="container-fluid bgcontent">			
<div class="container">
	<div class="row">
		<div class="content-full col-xs-12 ">
			
			<div class="item fs18 top-content bold">	
				
				<a href="/#practice">Phiếu bài tập</a> &nbsp; &nbsp; > &nbsp; &nbsp; <a href="/practice/class-{class}/subject-{subjectEntity.get('alias')}-{subjectEntity.get('id')}">Môn {subjectEntity.get('name')}</a>
				&nbsp; &nbsp; > 
				&nbsp; &nbsp; 
				{test[name]}
				
			</div>
			
			<div class="item content-lt">
				<!-- Tiêu đề, đồng hồ -->
				<div style="margin: 15px 0px;" class="item ">
					<div class="name-detail col-md-8 col-xs-12">
					{test[name]}
					</div>
					<div class="col-md-4 col-xs-12 pr0 relative">
					
						<div onclick="fullscreen();" style="position: absolute; right: -1px; top: -15px; z-index: 999999;" class="btn btn-primary hidden-xs">
							<i  class="fa fa-arrows-alt fa-1x" aria-hidden="true"></i>
						</div>
					
						<img style="top: 0px; right: 0px; width: 100%;" class="absolute"  src="/Themes/Songngu3/skin/images/canh.png"/>
						<div style="margin: 0px auto; margin-top: 26%;" class="time">
							<img  src="<?=BASE_SKIN_URL?>/Themes/Songngu3/skin/images/watch.png"/>
							<div id="countdown" class="num-time robotofont"><strong><?=$test['time']?></strong></div>
						</div>
					</div>
					
					
					
				</div>
				<!-- Kết thúc Tiêu đề, đồng hồ -->
				
				<!-- form làm bài -->
				<div class="item border-question" style="z-index: 9">
					<form id="form_question_nn" class="question_content pd-0 item mgb15 form-horizontal bgclor" method="post">
						<div class="item margin-top-20 scrollquestion">
							<?php 
								$i	= 1;
								$page	= 1;
								$numpage	= numPage(count($indexedQuestions));
								$content = $test['content'];
								$parts = $data->getTestParts($content);
								if(!$parts) echo '<div style="padding: 15px;">'.$content.'</div>';
							?>
							
							<fieldset id="idFieldset">  <!-- disabled="1"  -->
							<?php foreach($questions as $index => $question):
								echo '<div style="padding: 15px;">';
								$data->displayTestPart($parts, $index, $question);
								echo '</div>';
								?>
								<div class="item step_ answer_box question_page_<?php echo $page?> ">
									<?php $i++; $page = ceil($i/30);?>
									
										<div class="col-xs-12">
										<input type="hidden" name="questionIds[<?=$question['id']?>]" value="<?=$question['id']?>"/>
										<input type="hidden" name="questionTypes[<?=$question['id']?>]" value="<?=questionTypeOjb($question['questionType'])?>"/>
										<?php 
											$QuestionObj = pzk_obj_once('Education.Question.Type.'.ucfirst(questionTypeOjb($question['questionType'])));
											$QuestionObj->set('stt', $index+1);
											$QuestionObj->set('questionId', $question['id']);
											$questionChoice = _db()->getEntity('Question.Choice');
											$questionChoice->setData($indexedQuestions[$question['id']]);
											$QuestionObj->set('question', $questionChoice);
											
											$answerEntitys = array();
											if(isset($answers[$question['id']])) {
												foreach($answers[$question['id']] as $val) {
													$answerEntity = _db()->getEntity('Question.Choice.Answer');
													$answerEntity->setData($val);
													$answerEntitys[] = $answerEntity;
												}
											}
											
											$QuestionObj->set('answers', $answerEntitys);
											
											$QuestionObj->set('cacheable', 'false');											
											$QuestionObj->set('cacheParams', 'layout, questionId');
											if($question['questionType'] == '4') {
												$QuestionObj->set('layout', 'education/question/tuluan');
											}
											$QuestionObj->display();
										?>
										</div>
								</div>
							<?php endforeach;?>
							</fieldset>
							<input type="hidden" name="question_time" value="<?=$test['time']?>"/>
							<input type="hidden" id="start_time" name="start_time" value="<?=$_SERVER['REQUEST_TIME'];?>" />
							<input type="hidden" id="during_time" name="during_time" value="" />
							<input type="hidden" id="testId" name="testId" value="<?=$test['id'];?>" />
						</div>
						
					</form>
				</div>
			<!-- kết thúc form -->
			<div class="col-md-12 col-sm-12 fix_da">
				<button id="finish-choice" class="btn btn-primary btt-practice" 
					onclick="finish_choice(); return false;">
					<span class="glyphicon glyphicon-ok"></span>
					<span class="btn-finish">Nộp bài</span>
				</button>

				<button id="view-result" class="btn btn-success btt-practice" 
						data-toggle="modal" data-target="#exampleModal" 
						style="display:none;"
					<span class="glyphicon glyphicon-list-alt"></span>
					Xem kết quả
				</button>
				<button id="show-answers" class="btn btn-danger btt-practice" style="display:none" onclick="show_answers();">
					<span class="glyphicon glyphicon-check"></span> 
					Xem đáp án
				</button>
			</div>
				
			</div>
			
		</div>
	</div>
	
</div>
</div>

<img class="item mgt-60" src="/Themes/Songngu3/skin/images/bottom-content.png"/>

<div class="modal fade" role="dialog" id="exampleModal" aria-labelledby="gridSystemModalLabel" aria-hidden="true">
	<div class="modal-dialog">
      	<div class="modal-content">
        	<div class="modal-header">
          		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          		<h3 class="modal-title text-center title-blue" id="gridSystemModalLabel"><b><?php echo $language['final'];?></b></h3>
        	</div>
	        <div class="modal-body">
	          	<div class="container-fluid">
	           		<div class="row">
	           			<div class="col-xs-12" style="color: #F0AD4E">
			    			<div class="col-xs-8 question_total control-label"><b>Tổng số câu </b></div> 
							<div class="col-xs-3 num_total"><?=$test['quantity']?></div><div class="col-xs-1"><span class="glyphicon glyphicon-th-list"></span></div>
			    		</div>
						
						<div class="line_question pd-top-10"></div>
						
						<div class="col-xs-12 title-blue">
			    			<div class="col-xs-8 question_true control-label"><b>Số câu chấm tự động </b></div> 
							<div class="col-xs-3 num_auto"></div>
							<div class="col-xs-1"><span class="glyphicon glyphicon-ok"></span></div>
			    		</div>
						<div class="col-xs-12 title-blue">
			    			<div class="col-xs-8 question_true control-label"><b>Số câu đúng </b></div> 
							<div class="col-xs-3 num_true"></div>
							<div class="col-xs-1"><span class="glyphicon glyphicon-ok"></span></div>
			    		</div>
			    		<div class="col-xs-12 title-red">
			    			<div class="col-xs-8 question_false control-label"><b>Số câu sai </b></div> 
							<div class="col-xs-3 num_false"></div>
							<div class="col-xs-1"><span class="glyphicon glyphicon-remove"></span></div>
			    		</div>
			    		
						<div class="col-xs-12 title-blue">
			    			<div class="col-xs-8 question_true control-label"><b>Điểm </b></div> 
							<div class="col-xs-3 mark_auto"></div>
							<div class="col-xs-1"><span class="glyphicon glyphicon-ok"></span></div>
			    		</div>
						
						<div class="line_question pd-top-10"></div>
						
						<div class="col-xs-12 title-blue">
			    			<div class="col-xs-8 question_true control-label"><b>Số câu giáo viên chấm </b></div> 
							<div class="col-xs-3 num_teacher"></div>
							<div class="col-xs-1"><span class="glyphicon glyphicon-ok"></span></div>
			    		</div>
						
						<div class="col-xs-12 title-blue">
			    			<div class="col-xs-8 question_true control-label"><b>Trạng thái </b></div> 
							<div class="col-xs-3 mark_teacher_status">Chưa chấm</div>
							<div class="col-xs-1"><span class="glyphicon glyphicon-ok"></span></div>
			    		</div>
						
						<div class="col-xs-12 title-blue">
			    			<div class="col-xs-8 question_true control-label"><b>Điểm </b></div> 
							<div class="col-xs-3 mark_teacher"></div>
							<div class="col-xs-1"><span class="glyphicon glyphicon-ok"></span></div>
			    		</div>
			    		
						
						
		    		</div>
	          	</div>
	        </div>
	        <div class="modal-footer">
				<button class="btn btn-danger" name="show-answers" onclick="show_answers();$('#exampleModal').modal('hide');" type="button"><span class="glyphicon glyphicon-check"></span> <?php echo $language['result'];?>
				</button>		
	        	<a href="javascript:void(0)" class="btn fb-share"></a>
	        </div>
      	</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal  id="exampleModal"-->



<div class="modal fade" role="dialog" id="completeModal" aria-labelledby="gridSystemModalLabel" aria-hidden="true">
	<div class="modal-dialog">
      	<div class="modal-content">
        	<div class="modal-header bg-success">
          		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          		<h3 class="modal-title text-center title-blue" id="gridSystemModalLabel"><b>Thông báo</b></h3>
        	</div>
	        <div class="modal-body">
	          	<div class="container-fluid">
	           		<div class="row">
						<div class="col-xs-12">
							<img src="http://www.pngall.com/wp-content/uploads/2017/05/Congratulation-Free-PNG-Image.png" class="img-responsive" />
							<h2 class="text-center text-success">Bạn đã hoàn thành bài thi.</h2>
							<h3 class="text-center text-danger">Kết quả sẽ được công bố vào ngày <?php echo date('d/m/Y', strtotime($test['resultDate']));?></h3>
						</div>
		    		</div>
	          	</div>
	        </div>
	        <div class="modal-footer">
				<button class="btn btn-danger" name="show-answers" onclick="$('#completeModal').modal('hide');" type="button"><span class="glyphicon glyphicon-check"></span> Đóng
				</button>
	        </div>
      	</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal  id="exampleModal"-->


<script>
	
	var formdata;
	
    function finish_choice(){
        
		var time_real = $('.num-time').text().split(":");
		
		var start_time = <?=$test['time']?>;
		
		var during_time = parseInt(start_time)*60 - (parseInt(time_real[0])*60*60 + parseInt(time_real[1])*60+parseInt(time_real[2]));
		
		$('#during_time').val(during_time);
		
    	formdata = $('#form_question_nn').serializeForm();
    	$('#idFieldset input, #idFieldset textarea').prop( "disabled", true );
    	$('#finish-choice .btn-finish').text('Đã nộp');
		$('#finish-choice').prop( "disabled", true );
		$('#show-answers').hide();
		$('#show-answers-mb').hide();
    	save_choice(function () {
			show_completed();
		});
		
    	return formdata;
    }
	
	function finished_choice() {
		formdata = $('#form_question_nn').serializeForm();
    	$('#idFieldset input, #idFieldset textarea').prop( "disabled", true );
    	$('#finish-choice .btn-finish').text('Đã nộp');
		$('#finish-choice').prop( "disabled", true );
		$('#show-answers').show();
		$('#show-answers-mb').show();
		$('#view-result').hide();
      	$('#view-rating').hide();
		show_answers();
		show_result_only();
		return formdata;
	}
	
	function show_result_only() {
		$.ajax({
			type: "Post",
			data:{
				answers:formdata,
			},
			url:'<?=BASE_REQUEST?>/Practice/showHomeworkResult',
			success: function(results){
				var data = $.parseJSON(results);
				
				var num_total	=	data.num_total;
				var num_true	=	data.num_true;
				var num_false 	= 	data.num_false;
				var num_auto	=	data.num_auto;
				var num_teacher = 	data.num_teacher;
				
				var mark_auto	=	data.mark_auto;
				var mark_teacher=	data.mark_teacher;
				var mark_teacher_status = !!data.mark_teacher_status? 'Đã chấm': 'Chưa chấm';
				
				//
				$('.num_total').text(num_total);
				$('.num_auto').text(num_auto);
				$('.num_true').text(num_true);
				$('.num_false').text(num_false);
				$('.num_teacher').text(num_teacher);
				$('.mark_auto').text(mark_auto);
				$('.mark_teacher').text(mark_teacher);
				$('.mark_teacher_status').text(mark_teacher_status);
				CountDown.Pause();
			}
		});
	}

	function show_result(){
		
       	if(formdata	==	null){
      		alert('Click hoàn thành để xem đáp án !');
      	}else{
      		$.ajax({
	          	type: "Post",
		        data:{
		          	answers:formdata,
		        },
		        url:'<?=BASE_REQUEST?>/Practice/showHomeworkResult',
		        success: function(results){
		         	var data = $.parseJSON(results);
		         	
		           	var num_total	=	data.num_total;
		           	var num_true	=	data.num_true;
					var num_false 	= 	data.num_false;
					var num_auto	=	data.num_auto;
					var num_teacher = 	data.num_teacher;
					
					var mark_auto	=	data.mark_auto;
					var mark_teacher=	data.mark_teacher;
					var mark_teacher_status = !!data.mark_teacher_status? 'Đã chấm': 'Chưa chấm';
					
					//
					$('.num_total').text(num_total);
					$('.num_auto').text(num_auto);
					$('.num_true').text(num_true);
					$('.num_false').text(num_false);
					$('.num_teacher').text(num_teacher);
					$('.mark_auto').text(mark_auto);
					$('.mark_teacher').text(mark_teacher);
					$('.mark_teacher_status').text(mark_teacher_status);
					
		      	}
	        });
      		$('#view-result').show();
      		$('#view-rating').show();
	     	//$('.bs-example-modal-sm').modal('show');
	     	$("#exampleModal").modal('show');
			$('#view-result-mb').show();
      		$('#view-rating-mb').show();
	     	//$('.bs-example-modal-sm').modal('show');
	     	$("#exampleModal-mb").modal('show');
      	}
   	}
	
	function show_completed() {
		$("#completeModal").modal('show');
	}
	
	
	function show_answers(){
		
       	if(formdata	==	null){
      		alert('Click hoàn thành để xem đáp án !');
      	}else{
      		$.ajax({
	          	type: "Post",
		        data:{
		          	answers:formdata,
		        },
		        url:'<?=BASE_REQUEST?>/Practice/showHomeworkAnswersChoice',
		        success: function(results){
		         	var data = $.parseJSON(results);
		         	var user_answer = '';
		         	
		           	$.each(data, function(i, item) {
						
						// trắc nghiệm
		           		if(item.superType == 'choice') {
							show_result_choice(item);
						}
						
						// tự luận điền đáp án đúng
		           		if(item.superType =='tuluan' && item.auto){
			           		show_result_tuluan_auto(item);
						}
		           	});

					$('.explanation').removeClass('hidden');
					
					$(".popover-content img").each(function() {
						if($(this).width() > 100) {
							$(this).addClass('img-responsive');
						}
					});
		      	}
	        });
			
	     	// $('#show-answers').prop("disabled", true);
	     	$('.explanation').show();
      	}
   	}
	
	function show_result_choice(item) {
		$('.answers_'+item.questionId+'_'+item.value).css('color', '#5cb85c');
		$('.answers_'+item.questionId+'_'+item.value).css('font-weight', 'bold');
		$('.answers_'+item.questionId+'_'+item.value).append('<span class="has-success glyphicon glyphicon-ok"></span>');
	}
	
	function show_result_tuluan_auto(item) {
		$('.answers_full_'+item.questionId).css('color', '#3e9e00');
		for(var k in item.value.i) {
			var $user_answer 	=  	$('input[name^= "answers['+item.questionId+'_i]['+k+']"]');
			var user_answer		=	$user_answer.val();
			var teacher_answer = ''+item.value.i[k];
			var wrong = true;
			var teacher_answers = teacher_answer.split('|');
			for(var l = 0; l < teacher_answers.length;l++) {
				if($.trim(teacher_answers[l].toLowerCase()) == $.trim(user_answer.toLowerCase())) {
					wrong = false;
				}
			}
			if(wrong) {
				$user_answer.css('border', '2px solid red');
			} else {
				$user_answer.css('border', '2px solid green');
			}
		}
		
		
	}
	
	function save_choice(callback){
		if(formdata	==	null){
      		alert('Click hoàn thành để xem đáp án !');
      	}else{
			if(formdata == null){
				formdata = finish_choice();
			}
			$.ajax({
				type: "Post",
				data:{
					userData: 	formdata,
					homework: 	"<?= $homework ?>",
					subject:	"<?= $subject ?>",
					topic:		"<?= $topic ?>"
				},
				url:'<?=BASE_REQUEST?>/Compability/saveMixedTest',
				success: function(results){
					if(callback) {
						callback();
					}
				}
			});
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
			var Hours = Time.getUTCHours();
  	        var Minutes = Time.getUTCMinutes();
  	        var Seconds = Time.getSeconds();
  	        
  	        GuiTimer.html( 
				(Hours < 10 ? '0' : '') + Hours 
  	            + ':' 
  	            + (Minutes < 10 ? '0' : '') + Minutes 
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
  	CountDown.Start(<?=$test['time']*60*1000?>);
	
</script>
