<div class="container boder nomg contentheight robotofont">
	<?php 
		$camp = $data->get('camp');
		$showQuestions 	= $data->getQuestionByTrytest(TN, $camp);
		
		if(count($showQuestions) > 0) { 
		
		// xu li questions
		$arrQuestionIds = array();
		
		foreach($showQuestions as $question) {
			$arrQuestionIds[] = $question['id'];
		}
		//xu li cau tra loi
		$answers = _db()->useCache(1800)
			->useCacheKey('questionOf_'.TN . '_' . $camp)
			->selectAll()
			->from('answers_question_tn')
			->where(array('in', 'question_id', $arrQuestionIds))
			->result();
		$processAnswer = array();
		foreach($answers as $val) {
			$processAnswer[$val['question_id']][] = $val;
		}	
		
		$data_criteria	= $data->get('data_criteria');
		$userInfo = $data->get('userInfo'); 
	
	?>
	
		<h3 class="text-center"> Thông tin chi tiết của thí sinh </h3>
		<div class='well'>
			<div class='row'>
				<div class='col-md-3 col-xs-12'>Họ và tên: {userInfo[name]}</div>
				<div class='col-md-3 col-xs-12'>Username: {userInfo[username]}</div>
				<div class='col-md-3 col-xs-12'>Email: {userInfo[email]}</div>
				<div class='col-md-3 col-xs-12'>Phone: {userInfo[phone]}</div>
			</div>
			
		</div>

	
	<p class="t-weight text-center btn-custom8 textcl">Đề thi thử dạng trắc nghiệm vào lớp 6 Trần Đại Nghĩa</p>
	
	<div class='text-center'>
		(Đề thi gồm: <?=$data_criteria['quantity'];?> câu. Thời gian làm bài: <?= $data_criteria['time'];?> phút. Làm đúng mỗi câu được 2 điểm)
		<br><span class='red'>(Lưu ý: bạn chỉ được làm bài thi một lần. Hãy kiểm tra kỹ trước khi ấn hoàn thành!)</span>
	</div>
	
	<div class="item">
		<div class="item">
			<div class="col-md-1 col-xs-1"></div>
			<div class="col-md-10 col-xs-10 bd-div bgclor form_search_test top10 bot20">
				<div class="col-xs-12 text-center form-group  top20">

					<span><b>Thời gian:</b> </span>
					
					<div id="countdown" class="num-time title-red"><?=$data_criteria['time']?></div>

				</div>
					
				<div class="col-xs-12 border-question" style="z-index: 9">
					<form id="form_question_nn" class="question_content pd-0 item mgb15 form-horizontal bd-div bgclor" method="post">
						<div class="col-xs-12 margin-top-20">
							<?php 
								$i	= 1;
								$page	= 1;
								$numpage	= numPage(count($showQuestions));
							?>
							
							<fieldset id="idFieldset">  <!-- disabled="1"  -->
							<?php foreach($showQuestions as $key =>$value):?>
								<div class="row step_ answer_box question_page_<?php echo $page?> top20 left20">
									<?php $i++; $page=ceil($i/30);?>
									
										<div class="order col-md-12">Câu : <?=$key+1;?></div>
										<div class="col-md-12 top10">
										<input type="hidden" name="questions[<?=$value['id']?>]" value="<?=$value['id']?>"/>
										<input type="hidden" name="questionType[<?=$value['id']?>]" value="<?=questionTypeOjb($value['questionType'])?>"/>
										<?php 
											$QuestionObj = pzk_obj_once('Education.Question.Type.Choice2');
											
											$questionChoice = _db()->getEntity('Question.Choice');
											$questionChoice->setData($value);
										
											$QuestionObj->set('question', $questionChoice);
										
											$QuestionObj->set('type', $questionChoice->get('type'));
											
											$QuestionObj->set('questionId', $value['id']);
											
											//answer
											$answerEntitys = array();
											foreach($processAnswer[$value['id']] as $val) {
												$answerEntity = _db()->getEntity('Question.Choice.Answer');
												$answerEntity->setData($val);
												$answerEntitys[] = $answerEntity;
											}
											$QuestionObj->set('answers', $answerEntitys);
											
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
							<input type="hidden" id="during_time" name="during_time" value="" />
							<input type="hidden" id="testId" name="testId" value="<?php echo $data_criteria['id'];?>" />
							<input type="hidden" id="camp" name="camp" value="<?php echo $data_criteria['camp'];?>" />

						</div>
						
						<div class="fix_da">
							
									<button id="finish-choice" class="btn btn-primary" name="finish-choice" onclick="finish_choice();" type="button">
										Hoàn thành 
									</button>
								
									<a style='display:none;' id='testtl' href ="<?=BASE_REQUEST;?>/trytest/showtl/{camp}" class='btn btn-info'>Thi tự luận</a>

							
						</div>
						
					</form>
				</div>
			</div>
			<div class="col-md-1 col-xs-1"></div>
		</div>
	</div>

<div class="modal fade" role="dialog" id="exampleModal" aria-labelledby="gridSystemModalLabel" aria-hidden="true">
	<div class="modal-dialog">
      	<div class="modal-content">
        	<div class="modal-header">
          		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          		<h3 class="modal-title text-center title-blue" id="gridSystemModalLabel"><b>
					Thông báo hoàn thành bài thi trắc nghiệm
				</b></h3>
        	</div>
	        <div class="modal-body">
	          	Chúc mừng bạn đã thi xong bài trắc nghiệm. Hãy click vào nút "Thi tự luận" để bắt đầu bài thi tự luận
	        </div>
	        <div class="modal-footer">
				<a href ="<?=BASE_REQUEST;?>/trytest/showtl/{camp}" class='btn btn-info'>Thi tự luận</a>
	        </div>
      	</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal  id="exampleModal"-->
	
	
<script>

	var formdata;
	
    function finish_choice(){
        
		var time_real = $('.num-time').text().split(":");
		
		var start_time = <?=$data_criteria['time']?>;
		
		var during_time = parseInt(start_time)*60 - (parseInt(time_real[0])*60 + parseInt(time_real[1]));
		
		$('#during_time').val(during_time);
		
    	formdata = $('#form_question_nn').serializeForm();
    	$('#idFieldset input').prop( "disabled", true );
    	$('#finish-choice').prop( "disabled", true );
		
    	save_choice();

    	return formdata;
    }

	

	var user_book_id;
	function save_choice(){
		if(formdata	==	null){
      		alert('Click hoàn thành để xem đáp án !');
      	}else{
			if(user_book_id == undefined){
	        	if(formdata == null){
	          		formdata = finish_choice();
	          	}
	          	$.ajax({
	              	type: "Post",
		            data:{
		            	answers: 	formdata
		            },
		            url:'<?=BASE_REQUEST?>/trytest/saveChoice',
		            success: function(results){
		            	if(results){
							
		            		get_answers();
							
		                }
		           	}
	            });
			}
      	}
    }
	
	function get_answers(){
		
       	if(formdata	==	null){
      		alert('Click hoàn thành để xem đáp án !');
      	}else{
      		$.ajax({
	          	type: "Post",
		        data:{
		          	answers:formdata,
		        },
		        url:'<?=BASE_REQUEST?>/trytest/showAnswersChoice',
		        success: function(results){
		         	var data = $.parseJSON(results);
		         	
		           	$('.num_true').text(data.total);
		           	var question_total = <?=$data_criteria['quantity'];?>;
		           	var num_false = question_total - data.total;
		           	$('.num_false').text(num_false);
		      	}
	        });
      		$('#view-result').show();
			$('#testtl').show();
			$("#exampleModal").modal('show');
      	}
   	}
	
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
  	CountDown.Start(<?=$data_criteria['time']*60*1000?>);
	
	// slight update to account for browsers not supporting e.which
	function disableF5(e) { if ((e.which || e.keyCode) == 116) e.preventDefault(); };
	// To disable f5
		/* jQuery < 1.7 */
	$(document).bind("keydown", disableF5);
	/* OR jQuery >= 1.7 */
	$(document).on("keydown", disableF5);

	// To re-enable f5
		/* jQuery < 1.7 */
	$(document).unbind("keydown", disableF5);
	/* OR jQuery >= 1.7 */
	$(document).off("keydown", disableF5);
	
</script>
<?php } ?>

</div>


