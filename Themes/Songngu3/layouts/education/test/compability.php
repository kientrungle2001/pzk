	
	<?php 
		$language = pzk_global()->get('language');
		$lang = pzk_session('language');
		$parentId = $data->get('parentId');
		$class = $data->get('class');
		$ngoisao = $data->get('ngoisao');
		$showQuestions 	= $data->getQuestionCompability(TN, $parentId);
		shuffle($showQuestions);
		$processQuestions = array();
		$arrQuestionIds = array();
		if(count($showQuestions) > 0) { 
		
		foreach($showQuestions as $question) {
			$processQuestions[$question['id']] = $question;
			$arrQuestionIds[] = $question['id'];
		}
		//xu li cau tra loi
		$answers = _db()->useCache(1800)
			->selectAll()
			->from('answers_question_tn')
			->where(array('in', 'question_id', $arrQuestionIds))
			->result();
		$processAnswer = array();
		foreach($answers as $val) {
			$processAnswer[$val['question_id']][] = $val;
		}	
		
		$data_criteria	= $data->get('data_criteria');
		$parentTest = $data->getTestById($parentId);	
		$otherTest = $data->getOtherTest($parentId);
	
	?>
	
<div class="container-fluid bgcontent">	
<div class="container">
	<div class="row">
		<div class="col-md-3 left-navigation hidden-xs col-xs-12">
			<img src="/Themes/Songngu3/skin/images/na-left.png" class="item"/>
			<div class="item na-left" >
				<img src="/Themes/Songngu3/skin/images/na-star.png" />
				<span id="chontu" class="fontsize19">
				
				<?php echo $language['examination']; ?>
				
				</span>
			</div>
			<?php if($otherTest){ ?>
			<ul class="item menu-test" >
				<?php foreach($otherTest as $test){ ?>
					<li><a href="/Compability/test/{class}/{test[id]}">
					<?php 
					if ($lang == 'en' || $lang == 'ev'){
						echo $test['name_en'];
					}else{
						echo $test['name'];
					} ?>
					</a></li>
				<?php } ?>
			</ul>
			<?php } ?>
			
			
		</div>
		
		<div class="col-md-9 content-full col-xs-12 ">
		
			<div class="item fs18 top-content bold">	
				{language[examination]}
				&nbsp; &nbsp; > 
				&nbsp; &nbsp; 
				<?php 
					if ($lang == 'en' || $lang == 'ev'){
						echo $parentTest['name_en'];
					}else{
						echo $parentTest['name'];
					} ?>
				
			</div>
			
				<div class="item content-lt">
				<div style="margin: 15px 0px;" class="item ">
					
					
					<div class="name-detail col-md-8 col-xs-12">

						<?= $language['choice-test'];?>
						
					</div>
					
					<div class="col-md-4 col-xs-12 pr0 relative">
					
						<div onclick="fullscreen();" style="position: absolute; right: -1px; top: -15px; z-index: 999999;" class="btn btn-primary hidden-xs">
							<i  class="fa fa-arrows-alt fa-1x" aria-hidden="true"></i>
						</div>
					
						<img style="top: 0px; right: 0px; width: 100%;" class="absolute"  src="/Themes/Songngu3/skin/images/canh.png"/>
						<div style="margin: 0px auto; margin-top: 26%;" class="time">
							<img  src="<?=BASE_SKIN_URL?>/Themes/Songngu3/skin/images/watch.png"/>
							<div id="countdown" class="num-time robotofont"><strong><?=$data_criteria['question_time']?></strong></div>
						</div>
					</div>
			
				</div>
				
					<div class="item border-question" style="z-index: 9">
						<form id="form_question_nn" class="question_content pd-0 item mgb15 form-horizontal bgclor" method="post">
							<div class="item margin-top-20 scrollquestion">
							<?php 
								$i	= 1;
								$page	= 1;
								$numpage	= numPage(count($showQuestions));
							?>
							
							<fieldset id="idFieldset">  <!-- disabled="1"  -->
							<?php foreach($showQuestions as $key =>$value):?>
								<div class="item step_ answer_box question_page_<?php echo $page?> ">
									<?php $i++; $page=ceil($i/30);?>
									
										<div class="col-xs-12">
										<input type="hidden" name="questions[<?=$value['id']?>]" value="<?=$value['id']?>"/>
										<input type="hidden" name="questionType[<?=$value['id']?>]" value="<?=questionTypeOjb($value['questionType'])?>"/>
										<?php 
											$QuestionObj = pzk_obj('Education.Question.Type.'.ucfirst(questionTypeOjb($value['questionType'])));
											$QuestionObj->set('stt', $key+1);
											$QuestionObj->set('questionId', $value['id']);
											//$QuestionObj->setType($value[]);
											$questionChoice = _db()->getEntity('Question.Choice');
											$questionChoice->setData($processQuestions[$value['id']]);
											$QuestionObj->set('question', $questionChoice);
											
											//debug($processAnswer[$value['id']]);die();
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
								<input type="hidden" id="parentTest" name="parentTest" value="<?php echo $data_criteria['parentTest'];?>" />

							</div>
							
							<div class="fix_da">
								
										<button id="finish-choice" class="btn btn-primary" name="finish-choice" onclick="finish_choice();" type="button">
											<?= $language['finish']; ?>
										</button>
										
										<?php if(!$ngoisao){ ?>
											<button id="show-answers" class="btn show-answers btn-danger btt-practice" name="show-answers" style='display:none' onclick="show_answers(this);" type="button"><span class="glyphicon glyphicon-check"></span> <?php echo $language['result'];?>
											</button>	
											<button id="view-result-mb" class="btn btn-success btt-practice" data-toggle="modal" data-target="#exampleModal" name="view-result-mb" type="button" style="display:none; font-size: 20px;">
												<?php echo $language['score'];?>
											</button>
										<?php } ?>
										
										<button onclick="showTl('<?= $parentId;?>'); return false;" style='display:none; font-size: 20px;' id='testtl' class='btn btnshowTl btn-info'><?= $language['do-essay-test'];?></button>

								
							</div>
							
						</form>
					</div>
					<!---start tu luan-->
					<div class="item" id="showTl">
					
					</div>
					<!--show cach cham diem-->
					
					<div style="display: none" class="item" id="result_score">
					<?php if($ngoisao ==1){ ?>
						<div class="alert alert-warning text-center">
							Chúc mừng bạn đã hoàn thành bài thi.
						</div>
					<?php } ?>
					</div>
						
				</div>
			</div>
		</div>
	</div>
</div>

<img class="item mgt-60" src="/Themes/Songngu3/skin/images/bottom-content.png"/>		

<?php if(!$ngoisao){ ?>
<div class="modal fade" role="dialog" id="exampleModal" aria-labelledby="gridSystemModalLabel" aria-hidden="true">
	<div class="modal-dialog">
      	<div class="modal-content">
        	<div class="modal-header">
          		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          		<h3 class="modal-title text-center title-blue" id="gridSystemModalLabel"><b>
					<?= $language['result-choice'];?>
				</b></h3>
        	</div>
	        <div class="modal-body">
				<div class="container-fluid">
					<div class="row">
						<div class="col-xs-12 title-blue">
							<div class="col-xs-8 question_true control-label">
							<b><?php echo $language['correct'];?> </b></div> 
							<div class="col-xs-3 num_true"></div>
							<div class="col-xs-1"><span class="glyphicon glyphicon-ok"></span></div>
						</div>
						<div class="col-xs-12 title-red">
							<div class="col-xs-8 question_false control-label"><b><?php echo $language['wrong'];?> </b></div> <div class="col-xs-3 num_false"></div><div class="col-xs-1"><span class="glyphicon glyphicon-remove"></span></div>
						</div>
						<div class="col-xs-12" style="color: #F0AD4E">
							<div class="col-xs-8 question_total control-label">
							<b><?php echo $language['total'];?> </b></div> 
							<div class="col-xs-3 num_total"><?=$data_criteria['quantity']?></div>
							<div class="col-xs-1"><span class="glyphicon glyphicon-th-list"></span>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="col-xs-8"> 
								<?= $language['thitl'];?>
							</div>
						</div>
					</div>
				</div>		
	        </div>
	        <div class="modal-footer">
				<button class="btn btn-danger show-answers" name="show-answers" onclick="show_answers();$('#exampleModal').modal('hide');" type="button"><span class="glyphicon glyphicon-check"></span> <?php echo $language['result'];?>
				</button>
				<button onclick="showTl('<?= $parentId;?>'); return false;"  class='btn btnshowTl btn-info'><?= $language['do-essay-test'];?></button>
	        </div>
      	</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal  id="exampleModal"-->
<?php } ?>	
	
<script>
	function showTl(parentId){
		$('#exampleModal').modal('hide');
		<?php if($ngoisao){ ?>
		var timeNs = <?=$data_criteria['time']?>;
		var timeTn = $('#during_time').val();
		var timeTl = parseInt(timeNs)*60 - parseInt(timeTn);
		
		<?php } ?>
		 $('html, body').animate({
			scrollTop: $("#showTl").offset().top
		}, 2000);
		if(parentId){
			$.ajax({
					type: "Post",
					<?php if($ngoisao){ ?>
					data:{
						parentId:parentId, timeTl:timeTl
					},
					<?php } else { ?>
					data:{
						parentId:parentId
					},
					<?php } ?>
					url:'<?=BASE_REQUEST?>/Compability/showtl',
					success: function(results){
						$('#showTl').html(results);
						$('.btnshowTl').prop( "disabled", true );
					}
				});
		}		
	}

	var formdata;
	
    function finish_choice(){
        
		var time_real = $('.num-time').text().split(":");
		
		var start_time = <?=$data_criteria['time']?>;
		
		var during_time = parseInt(start_time)*60 - (parseInt(time_real[0])*60 + parseInt(time_real[1]));
		
		$('#during_time').val(during_time);
		
    	formdata = $('#form_question_nn').serializeForm();
    	$('#idFieldset input').prop( "disabled", true );
    	$('#finish-choice').prop( "disabled", true );
		<?php if(!$ngoisao){ ?>
		$('#show-answers').show();
		$('#view-result-mb').show();
		<?php } ?>
		$('#testtl').show();
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
		            url:'<?=BASE_REQUEST?>/Compability/saveChoice',
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
		        url:'<?=BASE_REQUEST?>/Ngonngu/showAnswersChoice',
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
	
	function show_answers(that){
		
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
		         	var input_value_fill = '';
		         	
		           	$.each(data, function(i, item) {
		           		$('.answers_'+item.questionId+'_'+item.value).css('color', '#5cb85c');
		           		$('.answers_'+item.questionId+'_'+item.value).css('font-weight', 'bold');
		           		$('.answers_'+item.questionId+'_'+item.value).append('<span class="has-success glyphicon glyphicon-ok"></span>');
						
		           		if(item.superType =='fill' || item.superType =='join'){
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

					$('.explanation').removeClass('hidden');
					
		           	$('.num_true').text(data.total);
		           	var question_total = <?=$data_criteria['quantity']?>;
		           	var num_false = question_total - data.total;
		           	$('.num_false').text(num_false);
					$(".popover-content img").each(function() {
						if($(this).width() > 100) {
							$(this).addClass('img-responsive');
						}
					});
		      	}
	        });
			$(that).prop("disabled", true);
	     	$('.show-answers').prop("disabled", true);
	     	$('.explanation').show();
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
	// $(document).unbind("keydown", disableF5);
	/* OR jQuery >= 1.7 */
	// $(document).off("keydown", disableF5);
	
	
</script>
<?php } ?>

</div>


