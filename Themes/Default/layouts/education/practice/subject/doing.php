<div class="container fulllook3">
	<div class="row">
		<div class="col-md-1">&nbsp;</div>			
		<div class="col-xs-11 col-md-11 ">
			<div class="pd-20 text-center">
				<a href="<?=FL_URL?>"><h1>FULL LOOK</h1></a>	
				<h3 class="hidden-xs">Phần mềm Khảo sát và Phát triển năng lực toàn diện bằng tiếng Anh</h3>
				<?php echo partial('Themes/Default/layouts/home/aboutbtn');?>
			</div>
		</div>
	</div>
</div>	
{children [position=top-menu]}


<?php  
	$category_id 		= 	$data->get('categoryId');
	$topicId			=	$data->get('topicId');
	$check				= 	$data->get('checkPayment');
	$class 				= 	$data->get('class');
	$exercise_number	=	$data->get('exerciseNumber');
	
	$category 			= 	$data->getCategory();
	$topics				= 	$data->getTopicTree();
	
	$data_criteria		= 	array(
		'question_limit'	=> 	5,
		'question_time'		=>	10,
		'keybook'			=>	pzk_session('keybook')
	);

?>
<style>
.text-wrap {
	white-space: normal !important;
}


</style>
<div class="container">
	<p class="t-weight text-center btn-custom8 mgright textcl">Luyện tập - Lớp {class}</p>
</div>
<h3 class="text-center text-uppercase"><strong>{category[name]}</strong></h3>
<div class="container">
	<div class="item">
		<div class="col-xs-12">
			<div class="row">
				<div class="col-xs-12 col-md-10 pull-left mgleft">
					{children [position=choice]}
					<div class="dropdown col-md-4 col-xs-12 mgleft">
						<button class="btn fix_hover btn-default col-md-12 col-sm-12 col-xs-12 sharp" type="button">
						<span id="chonde" class="fontsize19"> Chọn chủ đề</span>
						<img class="img-responsive imgwh hidden-xs hidden-sm pull-right" src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/icon1.png" />
						</button>
						<ul id="topics" class="dropdown-menu col-md-12 col-sm-12 col-xs-12" style="top:35px; max-height:350px; overflow-y: scroll;">
						{each $topics as $topic}
							<li id="topic-{topic[id]}" <?php if($topicId == $topic['id']):?>class="active"<?php endif;?>><a class="text-wrap" href="#" onclick="reload_exercises({topic[id]}); return false;"><?php echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $topic['level']); ?><?php if(pzk_user_special()):?>#{topic[id]} - <?php endif;?>{topic[name]}</a></li>
						{/each}
						</ul>
					</div>	
					<div class="dropdown col-md-3 col-xs-12 mgleft">
						<div class="menu-hover">
							<button class="blink-exercises btn fix_hover btn-default col-md-12 col-sm-12 col-xs-12 sharp" type="button">
								<span id="chonde" class="fontsize19"> Chọn bài</span>
								<img class="img-responsive imgwh hidden-xs hidden-sm pull-right" src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/icon1.png" />
							</button>
							<ul id="exercises" class="dropdown-menu col-md-12 col-sm-12 col-xs-12" style="top:35px; max-height:350px; overflow-y: scroll;">
								
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-2 col-xs-12 bd">
					<div class="row">
						<div class="col-md-3 col-xs-2 hidden-xs"></div>
						<div class="col-md-3 col-xs-4 hidden-xs">
							<img  src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/dongho.png"  class=" wh40 img-responsive"/>
						</div>
						<div class="col-md-3 col-xs-4">
							<h4 id="countdown" class="text-center num-time robotofont"><strong><?=$data_criteria['question_time']?></strong></h4>

						</div>
						<div class="col-md-3 col-xs-2"></div>
					</div>
				</div>
			</div>
			<h2  class="text-center alert alert-warning blink-exercises" role="alert">Chọn chủ đề sau đó chọn bài để bắt đầu làm bài</h2>
		</div>
	</div>
</div>
<div class="container">
	<div class="item bot20">
		<div class="change col-xs-12 bd-div bgclor">
			<?php 
			$showQuestions 		= $data->getQuestions();
			$data_criteria['question_limit']	=	count($showQuestions);
			$processQuestions 	= array();
			$arrQuestionIds 	= array();
			if(count($showQuestions) > 0) {
				foreach($showQuestions as $question) {
					$processQuestions[$question['id']] = $question;
					$arrQuestionIds[] = $question['id'];
				}
				//xu li cau tra loi
				$answers 		= _db()->useCache(1800)
					->selectAll()
					->from('answers_question_tn')
					->where(array('in', 'question_id', $arrQuestionIds))
					->result();
				$processAnswer 	= array();
				foreach($answers as $val) {
					$processAnswer[$val['question_id']][] = $val;
				}	
				//debug($processAnswer);die();	
			}
			?>
			<div class="content">
				<form id="form_question_nn" class="question_content pd-0 form-horizontal top20" method="post">
					<?php $dataRow = $data->get('topic'); ?>
						<?php if($dataRow['isSort'] == 1):?>
						<div class="col-xs-12 margin-top-20">
							<?=$dataRow['content']?>
						</div>
						<div class="col-xs-12 margin-top-20 explanation hidden">
							<?=$dataRow['recommend']?>
						</div>
						<?php endif;?>
						
					<div class="col-xs-12 margin-top-20 scrollquestion">
						
						<?php 
							$i	= 1;
							$page	= 1;
							$numpage	= numPage(count($showQuestions));
						?>
						
						<fieldset id="idFieldset">  <!-- disabled="1"  -->
						<?php foreach($showQuestions as $questionIndex =>$question):?>
							<div class="step_ answer_box question_page_<?php echo $page?>">
								<?php $i++; $page=ceil($i/$data_criteria['question_limit']);?>
								
									<div class="order">Câu : <?=$questionIndex+1;?>
									<?php if(pzk_user_special()) :?><br />
									(#{question[id]})
									<?php endif; ?>
									</div>
									
									<input type="hidden" name="questions[<?=$question['id']?>]" value="<?=$question['id']?>"/>
									<input type="hidden" name="questionType[<?=$question['id']?>]" value="<?=questionTypeOjb($question['questionType'])?>"/>
									<?php 
										
										$QuestionObj 	= pzk_obj_once('Education.Question.Type.'.ucfirst(questionTypeOjb($question['questionType'])));
										$QuestionObj->set('questionId', $question['id']);
										
										$questionChoice = _db()->getEntity('Question.Choice');
										$questionChoice->setData($processQuestions[$question['id']]);
										$QuestionObj->set('question', $questionChoice);
										
										//debug($processAnswer[$question['id']]);die();
										$answerEntitys = array();
										foreach($processAnswer[$question['id']] as $val) {
												$answerEntity = _db()->getEntity('Question.Choice.Answer');
												$answerEntity->setData($val);
												$answerEntitys[] = $answerEntity;
										}
										
										$QuestionObj->set('answers', $answerEntitys);
										
										if(CACHE_MODE && CACHE_QUESTION_MODE && CACHE_ANSWER_MODE){
											$QuestionObj->set('cacheable', 'true');
										}else{
											$QuestionObj->set('cacheable', 'false');
										}
										$QuestionObj->set('index', $i-1);
										$QuestionObj->set('subject', $category_id);
										$QuestionObj->set('de', $exercise_number);
										if(file_exists(BASE_DIR .($target = '/3rdparty/Filemanager/source/practice/all/' . $question['id'] . '.mp3'))) {
											$QuestionObj->set('audio', $target);
										} else {
											if(file_exists(BASE_DIR .($audio = '/3rdparty/Filemanager/source/practice/' . $category_id. '/' . $exercise_number . '/' . ($i-1) . '.mp3'))) {
												$QuestionObj->set('audio', $audio);
												if(!file_exists(BASE_DIR .($target = '/3rdparty/Filemanager/source/practice/all/' . $question['id'] . '.mp3'))) {
													copy(BASE_DIR . $audio, BASE_DIR .$target);
												}
											}
											
											if(file_exists(BASE_DIR .($audio = '/3rdparty/Filemanager/source/practice/Observation/' . $category_id. '/' . ($i-1) . '.mp3'))) {
												$QuestionObj->set('audio', $audio);
												if(!file_exists(BASE_DIR .($target = '/3rdparty/Filemanager/source/practice/all/' . $question['id'] . '.mp3'))) {
													copy(BASE_DIR . $audio, BASE_DIR .$target);
												}
											}
										}
										
										
										$QuestionObj->set('cacheParams', 'layout, questionId');
										$QuestionObj->display();
									?>
							</div>
						<?php endforeach;?>
						</fieldset>
						<input type = 'hidden' name='exercise_number' value = '<?=$de?>'/>
						<input type="hidden" name="category_id" value="{category_id}"/>
						<input type="hidden" name="question_time" value="<?=$data_criteria['question_time']?>"/>
						
						<input type="hidden" id="start_time" name="start_time" value="<?=$_SERVER['REQUEST_TIME'];?>" />
							<input type="hidden" id="during_time" name="during_time" value="" />
						
						
						
					</div>
					
					<div class="fix_da">
						
							<button id="finish-choice" class="btn btn-primary" name="finish-choice" onclick="finish_choice();" type="button">
								Hoàn thành 
							</button>
							<button id="view-result" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" name="view-result" type="button" style="display:none;">
								Xem kết quả 
							</button>
							<button id="show-answers" class="btn btn-danger" name="show-answers" onclick="show_answers();" type="button" style="display:none;">
								Xem đáp án 
							</button>
						
					</div>
				</form>
			</div>
		
		</div>
	</div>
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
						<div class="col-xs-8 question_true control-label">Số câu trả lời đúng </div> <div class="col-xs-4 num_true title-blue"></div>
					</div>
					<div class="col-xs-12 title-red">
						<div class="col-xs-8 question_false control-label">Số câu trả lời sai </div> <div class="col-xs-4 num_false title-red"></div>
					</div>
					<div class="col-xs-12" style="color: #F0AD4E">
						<div class="col-xs-8 question_total control-label">Tổng số câu </div> <div class="col-xs-4 num_total"><?=$data_criteria['question_limit']?></div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-danger pull-left" onclick="window.location='/?class={class}'"> Chọn luyện tập các môn khác <span class="glyphicon glyphicon-arrow-left"></span></button>
				<button id="show-answers-on-dialog" class="btn btn-danger" name="show-answers" onclick="show_answers(); $('#exampleModal').modal('hide');" type="button">
					Xem đáp án 
				</button>
				<button type="button" class="btn btn-sm btn-success pull-right" onclick="window.location = '/practice/detail/{subject}?class={class}&de=1'"><span class="glyphicon glyphicon-arrow-right"></span> Làm bài khác</button>
			</div>
		</div>
	</div>
</div>
		

<script>
	
	function reload_exercises(topicId){
		
		$('#topics li').removeClass('active');
		$('#topic-'+topicId).addClass('active');
		
		$.ajax({
			url: '/practice/exercises/' + topicId,
			type: 'post',
			data: {
				topicId: topicId,
				class: {class},
				check: <?php if($check):?>1<?php else: ?>0<?php endif;?>
			},
			dataType: 'json',
			success: function(resp) {
				var exercises = resp.exercises;
				$('#exercises').html('');
				for(var i = 0; i < exercises; i++) {
					var activeClass = '';
					if(i+1 == {exercise_number} && topicId == {topicId})	activeClass = 'class="active"';
					$('#exercises').append('<li '+activeClass+'><a href="/practice/class-{class}/subject-{category[alias]}-{category[id]}/topic-'+resp.alias+'-'+resp.id+'/examination-'+(i + 1)+'">Bài ' + (i + 1) + '</a></li>');
				}
				$('#exercises').stop(true, true).delay(100).fadeIn();
			}
		});
	}
	
	$('.menu-hover').hover(function() {
	  $('#exercises').stop(true, true).delay(200).fadeIn();
	}, function() {
	  $('#exercises').stop(true, true).delay(200).fadeOut();
	});
	
	$(function(){
		reload_exercises({topicId});
		setTimeout(function(){
			$('#exercises').stop(true, true).delay(200).fadeOut();
		}, 200);
		 
	});
	
</script>


<script>
	
	var formdata;
	
    function finish_choice(){
        
		var time_real = $('.num-time').text().split(":");
		
		var start_time = <?=$data_criteria['question_time'];?>;
		
		var during_time = parseInt(start_time)*60 - (parseInt(time_real[0])*60 + parseInt(time_real[1]));
		
		$('#during_time').val(during_time);
		
    	formdata = $('#form_question_nn').serializeForm();
    	$('#idFieldset input').prop( "disabled", true );
    	$('#finish-choice').prop( "disabled", true );
    	get_answers();
    	save_question();
    	return formdata;
    }


    function save_question(){
        
    	if(formdata	==	null){
      		alert('Click hoàn thành để xem đáp án !');
      	}else{
      		$.ajax({
	          	type: "Post",
		        data:{
		          	answers:formdata,
					keybook:"<?=$data_criteria['keybook']?>"
		        },
		        url:'<?=BASE_REQUEST?>/home/saveQuestion'
	        });
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
					async: false,
			        success: function(results){
			         	var data = $.parseJSON(results);
			         	
			           	$('.num_true').text(data.total);
			           	var question_total = <?=$data_criteria['question_limit']?>;
			           	var num_false = question_total - data.total;
			           	$('.num_false').text(num_false);
			      	}
		        });
	      		$('#view-result').show();
				$('#show-answers').show();
		     	$('#exampleModal').modal('show');
	      	}
	   	}
    
    show_answers_showed = false;
	function show_answers(){
        if(show_answers_showed) return false;
		show_answers_showed = true;
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
		           		$('.answers_'+item.questionId+'_'+item.value).css('font-weight', 'bold');
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

		           	$('.explanation').removeClass('hidden');
					
		           	$('.num_true').text(data.total);
		           	var question_total = <?=$data_criteria['question_limit']?>;
		           	var num_false = question_total - data.total;
		           	$('.num_false').text(num_false);
					$(".popover-content img").each(function() {
						if($(this).width() > 100) {
							$(this).addClass('img-responsive');
						}
					});

		      	}
	        });
				
	     	$('#show-answers').prop("disabled", true);
	     	$('.explanation').show();
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
