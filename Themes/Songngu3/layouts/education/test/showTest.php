<?php
	$selectedWeek = null; $selectedTest = null;
	$showQuestions 	= $data->get('data_showQuestion');
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
	}
	$data_criteria	= $data->get('data_criteria');
	
	/*$class = pzk_request('class');*/
	$class = pzk_session('lop');
	$type= pzk_request('practice');
	$check =  pzk_session('checkPayment');
	$language = pzk_global()->get('language');
	$lang = pzk_session('language');
	$week2= pzk_request('id');
	
	$practice= pzk_request('practice');
	$weekname = $data->getWeekNameSN($week2,$practice, $check, $class);
	
?>
{children [position=public-header}
<div class="container-fluid bgcontent">			
<div class="container">
	<div class="row">
		<div class="col-md-3 left-navigation hidden-xs col-xs-12">
			<img src="/Themes/Songngu3/skin/images/na-left.png" class="item"/>
			<div class="item na-left" >
				<img src="/Themes/Songngu3/skin/images/na-star.png" />
				<span id="chontu" class="fontsize19">
				<?php 
				if($practice== 1 || $practice == '1'){ 
					echo $language['generaltitle'];
				}else{
					echo $language['weekend'];
					
				}
				
				?>
				
				</span>
			</div>
			
			<ul class="item menu-test" >
				<?php 
				$weeks = $data->getWeekTestSN(1410,$practice, $check, $class);
				?>
				{each $weeks as $week }
					<?php 
					
					$tests = $data->getTestSN($week['id'], $practice, $check, $class);					
					if($practice== 1 || $practice == '1'){  
					
					?>
						<li>
						<b>
							<?php 
							if(pzk_user_special()) { echo '#' . $week['id']; } 
							if(!$lang || $lang == 'vn'){
								echo $week['name'];
							}else{
								echo $week['name_en'];
							}
							?> 
						</b>
						
							<ul class="child-menu-test item">
								{each $tests as $test }
								<?php
									if(!$lang || $lang == 'vn'){
										$testName = $test['name'];
									}else{
										if($test['trial'] == 1){
											$testName = 'Trial test';	
										}else{
											$testName = str_replace("Đề","Test", $test['name_sn']);
										}
										
										
									} 
									
								?>
									<li >
										
										<a  <?php if($data_criteria['id'] == $test['id']) { echo 'class="active"'; } ?> onclick="return check_display({test[trial]}); id = {week[id]};"  data-de="{testName}" class="getdata" href="/practice-examination/class-{class}/week-{week[id]}/examination-{test[id]}" data-type="group">
										<?php if(pzk_user_special()) { echo '#' . $test['id']; } ?> {testName}
										</a>
										
									</li>
								{/each}
							</ul>
						
						</li>
					<?php } else { ?>
						<li>
						<b>
							<?php if(pzk_user_special()) { echo '#' . $week['id']; } 
							if(!$lang || $lang == 'vn'){
								echo $week['name'];
							}else{
								echo $week['name_en'];
							}
							?> 
						</b>
						
						<ul class="child-menu-test">
							{each $tests as $test }
								<?php 
									if(!$lang || $lang == 'vn'){
										$testName = $test['name'];
									}else{
										if($test['trial'] == 1){
											$testName = 'Trial test';	
										}else{
											$testName = str_replace("Đề thi số","Examination No.", $test['name_sn']);
										}
									} 
								?>
								<li>
									
									<a <?php if($data_criteria['id'] == $test['id']) { echo 'class="active"'; } ?> onclick="return check_display({test[trial]});id = {week[id]};" data-id="{week[id]}" data-de="{testName}" class="getdata" href="/test/class-{class}/week-{week[id]}/examination-{test[id]}" data-type="group">
									<?php if(pzk_user_special()) { echo '#' . $test['id']; } ?>
									{testName}</a>
									
								</li>
							{/each}
						</ul>
						
						</li>
					<?php } ?>
				
				{/each}
			</ul>
			
			
		</div>
		
		<div class="col-md-9 content-full col-xs-12 ">
			
			<div class="item fs18 top-content bold">	
				
				{ifvar practice}<a href="/#practice-test">{language[generaltitle]}</a>{else}<a href="/#test">{language[weekend]}</a>{/if}
				&nbsp; &nbsp; > 
				&nbsp; &nbsp; 
				<?php
				if(!$lang || $lang == 'vn'){
						echo $weekname['name'];
					}else{
						echo $weekname['name_en'];
					}
				?>
				
			</div>
			
			<div class="item content-lt">
				<div style="margin: 15px 0px;" class="item ">
					
					
					<div class="name-detail col-md-8 col-xs-12">

						<?php 
							if(!$lang || $lang == 'vn'){
								echo $data_criteria['name']; 
							}else{
								if($data_criteria['name_sn'] == 'Đề dùng thử'){
										$data_criteria['name_sn'] = 'Trial test';
								}	

								if($practice){

									$namedetail = str_replace("Đề","Test", $data_criteria['name_sn']);	
								}else{
									$namedetail = str_replace("Đề thi số","Examination No", $data_criteria['name_sn']);
								}
								
								echo $namedetail;
								
							} 
						
						?>
						
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
								// require_once BASE_DIR . '/lib/recursive.php';
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
											$QuestionObj = pzk_obj_once('Education.Question.Type.'.ucfirst(questionTypeOjb($value['questionType'])));
											$QuestionObj->set('stt', $key+1);
											$QuestionObj->set('questionId', $value['id']);
											//$QuestionObj->setType($value[]);
											$questionChoice = _db()->getEntity('Question.Choice');
											$questionChoice->setData($processQuestions[$value['id']]);
											$QuestionObj->set('question', $questionChoice);
											
											if(0 && file_exists(BASE_DIR .($target = '/3rdparty/Filemanager/source/practice/all/' . $value['id'] . '.mp3'))) {
												$QuestionObj->set('audio', $target);
											}
											
											//debug($processAnswer[$value['id']]);die();
											$answerEntitys = array();
											if(isset($processAnswer[$value['id']])) {
												foreach($processAnswer[$value['id']] as $val) {
														$answerEntity = _db()->getEntity('Question.Choice.Answer');
														$answerEntity->setData($val);
														$answerEntitys[] = $answerEntity;
												}
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
							<input type="hidden" id="testId" name="testId" value="<?=$data_criteria['id'];?>" />

						</div>
						<?php if(0) :?>
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
						<?php endif; ?>
						
					</form>
				</div>
				
				
				<div class="col-md-12 col-sm-12 fix_da hidden-xs">
				<button id="finish-choice" class="btn btn-primary btt-practice" name="finish-choice" onclick="finish_choice();" type="button"><span class="glyphicon glyphicon-ok"></span>
					<?php echo $language['finish'];?>
				</button>
				<?php $check = pzk_session('signActive');
				if(1 || !empty($check)) :?>
				<button id="view-result" class="btn btn-success btt-practice" data-toggle="modal" data-target="#exampleModal" name="view-result" type="button" style="display:none;"><span class="glyphicon glyphicon-list-alt"></span>
					<?php echo $language['score'];?>
				</button>
				<a id="view-rating" class="btn btn-info btt-practice" name="view-rating" type="button" style="display: none;"  href="<?=BASE_REQUEST?>/Home/rating"><span class="glyphicon glyphicon-flag"></span>
					<?php echo $language['rating'];?>
				</a>
				<button id="show-answers" class="btn btn-danger btt-practice disabled" name="show-answers" style='display:none' onclick="show_answers();" type="button"><span class="glyphicon glyphicon-check"></span> <?php echo $language['result'];?>
				</button>		
				<?php endif;?>			
			</div>
			<div class="fix_da col-xs-12 visible-xs">
				<button id="finish-choice-mb" class="btn btn-primary btt-practice col-xs-12 top10" name="finish-choice-mb" onclick="finish_choice();" type="button">
					<?php echo $language['finish'];?>
				</button>
				<?php $check = pzk_session('signActive');
				if(1 || !empty($check)) :?>
				<button id="view-result-mb " class="btn btn-success btt-practice col-xs-12 top10" data-toggle="modal" data-target="#exampleModal" name="view-result-mb" type="button" style="display:none;">
					<?php echo $language['score'];?>
				</button>
				<a id="view-rating-mb" class="btn btn-info btt-practice col-xs-12 top10" name="view-rating-mb" type="button" style="display: none;"  href="<?=BASE_REQUEST?>/Home/rating">
					<?php echo $language['rating'];?>
				</a>
				<button id="show-answers-mb" class="btn btn-danger btt-practice col-xs-12 top10 disabled" name="show-answers-mb" style='display:none' onclick="show_answers();" type="button">
					<?php echo $language['result'];?>
				</button>		
				<?php endif;?>	
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
	           			<div class="col-xs-12 title-blue">
			    			<div class="col-xs-8 question_true control-label"><b><?php echo $language['correct'];?> </b></div> <div class="col-xs-3 num_true"></div><div class="col-xs-1"><span class="glyphicon glyphicon-ok"></span></div>
			    		</div>
			    		<div class="col-xs-12 title-red">
			    			<div class="col-xs-8 question_false control-label"><b><?php echo $language['wrong'];?> </b></div> <div class="col-xs-3 num_false"></div><div class="col-xs-1"><span class="glyphicon glyphicon-remove"></span></div>
			    		</div>
			    		<div class="col-xs-12" style="color: #F0AD4E">
			    			<div class="col-xs-8 question_total control-label"><b><?php echo $language['total'];?> </b></div> <div class="col-xs-3 num_total"><?=$data_criteria['quantity']?></div><div class="col-xs-1"><span class="glyphicon glyphicon-th-list"></span></div>
			    		</div>
						
			    		<div class="line_question pd-top-10"></div>
			    		<div class="col-xs-12 pd-top-10" style="color: #4CAE4C; font-weight:bold;">
			    			<div class="col-xs-8 question_rating control-label"><?php echo $language['rating'];?> </div> <div class="col-xs-3 num_rat"></div><div class="col-xs-1"><span class="glyphicon glyphicon-tree-conifer"></span></div>
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
<script>

	
	<?php $check = pzk_session('checkPayment'); ?>
	function check_display(trial){
		var check = '{check}';
		if(check == 1){
			return true;
		}else{
			if(trial == 1){
				return true;
			}else{
				alert('Bạn cần mua tài khoản để sử dụng nội dung này !');
				return false;
			}
			
		}
	};

	function rating(){
		
		
      		$.ajax({
	          	type: "Post",
		        data:{
		          	answers:formdata,
		        },
		        url:'<?=BASE_REQUEST?>/Ngonngu/ratingTest',
		        success: function(results){
		         	var data = $.parseJSON(results);
		         	
		           	$('.num_true').text(data.total);
		           	var question_total = <?=$data_criteria['quantity']?>;
		           	var num_false = question_total - data.total;
		           	$('.num_false').text(num_false);
		      	}
	        });
	        
      		$('#view-result').show();
      		$('#view-rating').show();
	     	//$('.bs-example-modal-sm').modal('show');
	     	$("#exampleModal").modal('show');
			
	}

               

	(function(d, s, id) {
	    var js, fjs = d.getElementsByTagName(s)[0];
	    if (d.getElementById(id))
	        return;
	    js = d.createElement(s);
	    js.id = id;
	    js.src = "//connect.facebook.net/en_US/all.js";
	    fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
	
	window.fbAsyncInit = function() {
	    FB.init({
	        appId: '474070302757620', //474070302757620 || 908741545853547
	        status: true,
	        xfbml: true,
	        cookie: true
	    });
	};
	
	$(document).ready(function() {
		
	    $('.fb-share').click(function() {
		    
	    	var diem = $('.num_true').text();

	    	var tongcau = $('.num_total').text();

	    	var xephang = $('.num_rat').text();

	    	var strket = '';

	    	if((parseInt(diem) >= 0) &&  (parseInt(diem)<= 5)){
	    		strket = 'Bạn cần nỗ lực nhiều hơn nữa!';
		   	}else if((parseInt(diem) >6) && (parseInt(diem) <= 10)){
		   		strket = 'Bạn đã cố gắng, nhưng chưa đủ!';
			}else if((parseInt(diem) >10) && (parseInt(diem) <= 15)){
		   		strket = 'Bạn đạt mức Trung bình Khá!';
			}else if((parseInt(diem) >15) && (parseInt(diem) <= 23)){
		   		strket = 'Bạn đạt mức Khá!';
			}else if((parseInt(diem) >23) && (parseInt(diem) <= 28)){
		   		strket = 'Bạn đạt mức Giỏi!';
			}else if((parseInt(diem) >28) && (parseInt(diem) <= 30)){
		   		strket = 'Bạn rất xuất sắc!';
			}
	    	
	        FB.ui({
	            method: 'feed',
	            name: 'Kết quả thi thử trắc nghiệm online vào lớp 6 trường THPT Trần Đại Nghĩa',
	            caption: 'Phần mềm Full Look - website : www.nextnobels.com',
	            link: 'http://www.nextnobels.com',
	            picture: 'http://s1.nextnobels.com/Default/skin/nobel/test/media/1.jpg',
	            description: 'Đã đạt : '+diem+'/'+tongcau+' điểm - Xếp thứ hạng : '+xephang+ ' - Chúc mừng bạn <?=pzk_session('username')?> đã hoàn thành bài thi! - '+strket,
	        }, function(response){
					
					
		        });
	    });
	});
	
	var formdata;
	
    function finish_choice(){
        
		var time_real = $('.num-time').text().split(":");
		
		var start_time = <?=$data_criteria['time']?>;
		
		var during_time = parseInt(start_time)*60 - (parseInt(time_real[0])*60 + parseInt(time_real[1]));
		
		$('#during_time').val(during_time);
		
    	formdata = $('#form_question_nn').serializeForm();
    	$('#idFieldset input').prop( "disabled", true );
    	$('#finish-choice').prop( "disabled", true );
		$('#show-answers').show();
		$('#show-answers-mb').show();
    	save_choice();

    	return formdata;
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
		           	var question_total = <?=$data_criteria['quantity']?>;
		           	var num_false = question_total - data.total;
		           	$('.num_false').text(num_false);
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
	
	
	function show_answers(){
		
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
			
	     	$('#show-answers').prop("disabled", true);
	     	$('.explanation').show();
      	}
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
		            	answers: 	formdata,
		            	keybook:"<?=$data_criteria['keybook']?>",
		            	week: "<?php echo pzk_request('id'); ?>"
		            },
		            url:'<?=BASE_REQUEST?>/Ngonngu/saveChoice',
		            success: function(results){
		            	if(results){
		            		//user_book_id = results;
		            		var dataRat = $.parseJSON(results);
		            		user_book_id = dataRat['userbookId'];
		            		var strRat = "";
		            		strRat  =  dataRat['rating']+'/'+dataRat['total'];
		            		$('.num_rat').text(strRat);
		            		get_answers();
		                }
		           	}
	            });
			}
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
	
</script>
