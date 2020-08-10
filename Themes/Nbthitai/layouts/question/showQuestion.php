<?php
	$showQuestions 	= $data->get('data_showQuestion');
	
	//debug($showQuestions);die();
	// xu li questions
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
		//debug($processAnswer);die();	
	}
	
	
	$data_criteria	= $data->get('data_criteria');
	$category = $data->get('category');
	$category_id = $data->get('categoryId');
	$category_name = $data->get('categoryName');
	$class= intval(pzk_request('class'));
	$de= clean_value(pzk_request('de'));
	$subject = intval(pzk_request()->getSegment(3));
	$parentSubject = 0;
	if($subject) {
		$subjectEntity = _db()->getTableEntity('categories')->load($subject);
		$parentSubject = $subjectEntity->get('parent');
	}
	$practices = $data->getPractices($class,$subject);
?>
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
<?php $data->displayChildren('[position=top-menu]') ?>
<?php if(pzk_session('login')) { ?>
<div class="container">
	<p class="t-weight text-center btn-custom8 mgright textcl">Luyện tập - Lớp <?php echo $class; ?></p>
</div>

<?php if(!empty($data_criteria['category_type'])):?>
<div class="container top40 hidden-xs">
	<h2 class="title-practice text-center"><?=$data_criteria['category_type_name']?></h2>
</div>
<div class="container visible-xs">
	<h2 class="title-practice text-center"><?=$data_criteria['category_type_name']?></h2>
</div>
<?php else:?>
<div class=" container top40">
	<h2 class="title-practice text-center"><?=$data_criteria['category_name']?></h2>
</div>
<?php endif;?>
<div class="container">
	<div id="question-wrapper">
	<div class="row form-group view_practice margin-top-20">	
		<div class="col-xs-12 col-sm-10 col-md-7 col-md-offset-1 pull-left">
				<?php $data->displayChildren('[position=choice]') ?>
			<div class="dropdown col-md-6 col-sm-6 col-xs-6 nomgin">
				<button class="btn fix_hover btn-default dropdown-toggle col-md-12 sharp" type="button" data-toggle="dropdown"><span id="chonde" class="fontsize19" style="width: 240px; overflow: hidden; float: left; display: block;">
				<?php if($parentSubject == 87 || $parentSubject == 88) { ?>
					<?php echo $de ?>
				<?php } else { ?>
					Bài <?php echo $de ?>
				<?php } ?>
				</span><span class="pull-right"><img class="img-responsive imgwh" src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/icon1.png" /></span>
				</button>
					<ul class="dropdown-menu col-md-12 nomgin2">
					
					<?php if($parentSubject == 87 || $parentSubject == 88 || $parentSubject == 164) {
						if($parentSubject == 87) {
							$dataCategoryCurrent =  $data->get('categoryCurrent');
						} else if($parentSubject == 88) {
							$dataCategoryCurrent =  $data->get('categoryCurrentObservation');
						} else if ($parentSubject == 164) {
							$dataCategoryCurrent =  $data->get('categoryCurrentEnglish');
						}
						
						if(@$dataCategoryCurrent['child'])
						foreach($dataCategoryCurrent['child'] as $k =>$value):?>
						<li><a onclick="subject = <?php echo @$value['id']?>;document.getElementById('chonde').innerHTML = '<?php echo @$value['name']?>';" data-de="<?php echo @$value['name']?>" class="getdata" href="/practice/doQuestion/<?php echo @$value['id']?>?class=5&de=<?php echo @$value['name']?>"><?php echo @$value['name']?></a></li>
					<?php endforeach;
					} else { ?>
						<?php for($i = 1; $i <= $practices; $i++){ ?>
							<li><a onclick="document.getElementById('chonde').innerHTML = '<?php echo "Bài ".$i; ?>';" data-de="<?php echo $i; ?>" class="getdata" href="/practice/class-5/subject-<?php echo $subjectEntity->get('alias')?>-<?php echo $subject ?>/examination-<?php echo $i ?>"><?php echo "Bài ".$i;?></a></li>
						<?php }?>
					<?php } ?>
					</ul>
			</div>
		</div>
		
		<div class="col-xs-3 col-md-3 bd">
			<div class="row">
				<div class="col-md-3 col-md-offset-3 col-xs-4 hidden-xs">
					<img  src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/dongho.png"  class="wh40 img-responsive"/>
				</div>
				<div class="col-md-3 col-xs-4">
					<div class="col-md-3 col-xs-4">
							<h4 id="countdown" class="text-center num-time robotofont"><strong><?=$data_criteria['question_time']?></strong></h4>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="show-question-wrapper">
		<div class="row">
		<div class="col-md-1 col-xs-1"></div>
		<div class="change col-md-10 col-xs-10 bd-div bgclor">
			<div class="content">
				<form id="form_question_nn" class="question_content pd-0 form-horizontal top20" method="post">
					<?php $dataRow = $data->get('dataRow'); ?>
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
						<?php foreach($showQuestions as $key =>$value):?>
							<div class="step_ answer_box question_page_<?php echo $page?>">
								<?php $i++; $page=ceil($i/$data_criteria['question_limit']);?>
								
									<div class="order">Câu : <?=$key+1;?>
									<?php if(pzk_user_special()) :?><br />
									(#<?php echo @$value['id']?>)
									<?php endif; ?>
									</div>
									
									<input type="hidden" name="questions[<?=$value['id']?>]" value="<?=$value['id']?>"/>
									<input type="hidden" name="questionType[<?=$value['id']?>]" value="<?=questionTypeOjb($value['questionType'])?>"/>
									<?php 
										
										$QuestionObj = pzk_obj_once('Education.Question.Type.'.ucfirst(questionTypeOjb($value['questionType'])));
										$QuestionObj->set('questionId', $value['id']);
										
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
										
										if(CACHE_MODE && CACHE_QUESTION_MODE && CACHE_ANSWER_MODE){
											$QuestionObj->set('cacheable', 'true');
										}else{
											$QuestionObj->set('cacheable', 'false');
										}
										$QuestionObj->set('index', $i-1);
										$QuestionObj->set('subject', $subject);
										$QuestionObj->set('de', $de);
										if(file_exists(BASE_DIR .($target = '/3rdparty/Filemanager/source/practice/all/' . $value['id'] . '.mp3'))) {
											$QuestionObj->set('audio', $target);
										} else {
											if(file_exists(BASE_DIR .($audio = '/3rdparty/Filemanager/source/practice/' . $subject. '/' . $de . '/' . ($i-1) . '.mp3'))) {
												$QuestionObj->set('audio', $audio);
												if(!file_exists(BASE_DIR .($target = '/3rdparty/Filemanager/source/practice/all/' . $value['id'] . '.mp3'))) {
													copy(BASE_DIR . $audio, BASE_DIR .$target);
												}
											}
											
											if(file_exists(BASE_DIR .($audio = '/3rdparty/Filemanager/source/practice/Observation/' . $subject. '/' . ($i-1) . '.mp3'))) {
												$QuestionObj->set('audio', $audio);
												if(!file_exists(BASE_DIR .($target = '/3rdparty/Filemanager/source/practice/all/' . $value['id'] . '.mp3'))) {
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
						<input type="hidden" name="category_id" value="<?=$data_criteria['category_id']?>"/>
						<input type="hidden" name="question_time" value="<?=$data_criteria['question_time']?>"/>
						
						<input type="hidden" id="start_time" name="start_time" value="<?=$_SERVER['REQUEST_TIME'];?>" />
							<input type="hidden" id="during_time" name="during_time" value="" />
						
						
						
					</div>
					
					<!--<div class="page-view">
						<nav>
							<ul class="pagination pull-right">
								
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
					</div> -->
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
							<button type="button" class="btn btn-sm btn-danger pull-left" onclick="window.location='/?class=<?php echo $class ?>'"> Chọn luyện tập các môn khác <span class="glyphicon glyphicon-arrow-left"></span></button>
							<button id="show-answers-on-dialog" class="btn btn-danger" name="show-answers" onclick="show_answers(); $('#exampleModal').modal('hide');" type="button">
								Xem đáp án 
							</button>
							<button type="button" class="btn btn-sm btn-success pull-right" onclick="window.location = '/practice/detail/<?php echo $subject ?>?class=<?php echo $class ?>&de=1'"><span class="glyphicon glyphicon-arrow-right"></span> Làm bài khác</button>
						</div>
					</div>
				</div>
			</div>
		<div class="col-md-1 col-xs-1"></div>
		</div>
		
	</div>
	</div>
</div>

<!-- End Modal popover view-result -->

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
<?php } else { ?>
<div class='container'>
		
		<div class="col-md-10 col-xs-10 bd-div bgclor form_search_test top10 bot20 imgbg col-md-offset-1">
						<form class="form_search_test" style="margin: 15px 0px"  method="post" onsubmit="return check_select_test()">
				<div class="col-xs-12 border-question" style="z-index: 9">
					<div class="question_content pd-0 margin-top-20">
						<div class="clearfix margin-top-10">
							<div class="col-xs-12 pd-0">
								<h3 class="pd-top-15" style="width: 100%; text-align: center;">Bạn phải <a rel="<?=$_SERVER["REQUEST_URI"];?>" class="login_required" data-toggle="modal" data-target=".bs-example-modal-lg" style="cursor:pointer;">Đăng nhập</a> thì mới truy cập được</h3>
							</div>
							<div class="col-xs-5 pd-0">
								
							</div>
						</div>
						<div class="margin-top-10">
							
						</div>
					</div>
				</div>
			</form>
						</div>
		</div>

<?php } ?>