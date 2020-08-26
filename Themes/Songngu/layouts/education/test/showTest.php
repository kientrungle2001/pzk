<?php
	$selectedWeek = null; $selectedTest = null;
	$showQuestions 	= $data->getData_showQuestion();
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
	$data_criteria	= $data->getData_criteria();
	
	/*$class = pzk_request()->getClass();*/
	$class = pzk_session('lop');
	$type= pzk_request()->getPractice();
	$check=  pzk_session('checkPayment');
	
	$language = pzk_global()->getLanguage();
	$lang = pzk_session('language');
	$week2= pzk_request()->getId();
	
	$practice= pzk_request()->getPractice();
	$weekname = $data->getWeekNameSN($week2,$practice, $check, $class);
	
?>
<?php $data->displayChildren('[position=public-header') ?>

<div class="container">
	<div class="row bc-test">
		<div style="font-size: 20px;" class="col-md-10 col-md-offset-1 pd0">
			
			Lớp <?php echo $class ?> &nbsp; &nbsp; > &nbsp; &nbsp; <?php if(${'practice'}): ?>Đề luyện tập<?php else: ?>Đề thi<?php endif; ?>
			 
		</div>
		
	</div>
	
</div>

<div class="container">
	<div class="row bot20">
		<div class="col-md-1 col-xs-1"></div>
		<div class="col-md-10 pd0 col-xs-10">
			
				<div  class="col-md-8 col-sm-8 col-xs-12 ">
				<div class="row bg-test">
					
					<div style="padding-left: 30px; line-height: 44px; font-weight: bold; font-size: 20px;" class="bg-test col-md-3 col-xs-12">
					<?php if($weekname['trial'] == 1){ echo "Dùng thử"; }else { echo $weekname['name']; }?> 
					<?php if($weekname) { echo ':'; } ?>
					</div>
					
					<ul style="margin: 5px 0px; padding-left: 0px; border-right: 2px solid #89a334;" class="bg-test col-md-5 col-xs-12 ulhoa">
					<?php 
						$tests = $data->getTestSN($week2, $practice, $check, $class);
						if($practice== 1 || $practice == '1'){  ?>
							<?php foreach($tests as $test ): ?>
							<?php 
								if($test['name_sn']){
									$testName = $test['name_sn'];
								}else $testName = $test['name'];
							?>
								<li >
									
									<a <?php if($data_criteria['id'] == $test['id']) { echo 'class="active"'; } ?> onclick="id = <?php echo @$week['id']?>;document.getElementById('chonde').innerHTML = '<?php echo $testName ?>';"  data-de="<?php echo $testName ?>" class="getdata" href="/practice-examination/class-<?php echo $class ?>/week-<?php echo $week2 ?>/examination-<?php echo @$test['id']?>" data-type="group"><?php echo $testName ?></a>
									
								</li>
							<?php endforeach; ?>
					<?php
						}else{
					 ?>						
						<?php foreach($tests as $test ): ?>
						<?php 
							if($test['name_sn']){
								$testName = $test['name_sn'];
							}else $testName = $test['name'];
						?>
						<li>
							
							<a <?php if($data_criteria['id'] == $test['id']) { echo 'class="active"'; } ?> onclick="id = <?php echo @$week['id']?>;document.getElementById('chonde').innerHTML = '<?php echo $testName ?>';" data-id="<?php echo @$week['id']?>" data-de="<?php echo $testName ?>" class="getdata" href="/test/class-<?php echo $class ?>/week-<?php echo $week2 ?>/examination-<?php echo @$test['id']?>" data-type="group"><?php echo $testName ?></a>
							
						</li>
						<?php endforeach; ?>
						<?php } ?>
					</ul>
					
					
					<div class="dropdown bg-test col-md-4 col-xs-12 select-week">
						<button class=" select-week w100p pull-right" id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<?php if($weekname){ echo "Chọn tuần khác"; } else{ echo 'Đề dùng thử';}?>
							<span class="caret"></span>
						</button>
						<ul  id="menu-test" class="dropdown-menu bg-test" aria-labelledby="dLabel">
							<?php 
		    				$weeks = $data->getWeekTestSN(ROOT_WEEK_CATEGORY_ID,$practice, $check, $class);
		    			 ?>
		    			<?php foreach($weeks as $week ): ?>
							<?php 
							$firsttest= $data->getFirstTestByWeek($week['id'], $practice, $check, $class);	
							if($practice== 1 || $practice == '1'){  
							
							?>
							<li><a href="/practice-examination/class-<?php echo $class ?>/week-<?php echo @$week['id']?>/examination-<?php echo @$firsttest['id']?>"><?php echo @$week['name']?></a></li>
							<?php } else { ?>
							<li><a href="/test/class-<?php echo $class ?>/week-<?php echo @$week['id']?>/examination-<?php echo @$firsttest['id']?>"><?php echo @$week['name']?></a></li>
							<?php } ?>
						
						<?php endforeach; ?>
						</ul>
					</div>
					
					
					
					</div>
					
					
						
				</div>
				<div class="col-xs-12 col-md-4 col-sm-2  pull-right mgleft">
					<div style="margin-left: 0px;" class="row bdt text-center">
						<div class="col-md-2 hidden-xs hidden-sm">
							<img  src="<?=BASE_SKIN_URL?>/Default/skin/nobel/Themes/Story/media/dongho.png"  class=" wh40 img-responsive"/>
						</div>
						<div class="col-md-10 col-sm-10 col-xs-12">
							<h4 class="robotofont">Thời gian làm bài: <div style="font-weight: bold;" id="countdown" class="num-time title-red"><?=$data_criteria['time']?></div>
							</h4>
						</div>
					</div>
				</div>
				
			
		</div>
	</div>

</div>


				
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12 bd-div bgclor form_search_test top10 bot20">
			
				
			<div class="row border-question" style="z-index: 9">
				<form id="form_question_nn" class="question_content pd-0 item mgb15 form-horizontal bgclor" method="post">
					<div class="col-xs-12 margin-top-20 scrollquestion">
						<?php 
							$i	= 1;
							$page	= 1;
							$numpage	= numPage(count($showQuestions));
						?>
						
						<fieldset id="idFieldset">  <!-- disabled="1"  -->
						<?php foreach($showQuestions as $key =>$value):?>
							<div class="row step_ answer_box question_page_<?php echo $page?> top20 left20">
								<?php $i++; $page=ceil($i/30);?>
								
									<div class="order"><?php echo $language['question'];?> <?=$key+1;?>
									<?php if(pzk_user_special()) :?><br />
									(#<?php echo @$value['id']?>)
									<?php endif; ?>
									</div>
									<div class="col-md-12 top10">
									<input type="hidden" name="questions[<?=$value['id']?>]" value="<?=$value['id']?>"/>
									<input type="hidden" name="questionType[<?=$value['id']?>]" value="<?=questionTypeOjb($value['questionType'])?>"/>
									<?php 
										$QuestionObj = pzk_obj_once('Education.Question.Type.'.ucfirst(questionTypeOjb($value['questionType'])));
										
										$QuestionObj->setQuestionId($value['id']);
										//$QuestionObj->setType($value[]);
										$questionChoice = _db()->getEntity('Question.Choice');
										$questionChoice->setData($processQuestions[$value['id']]);
										$QuestionObj->setQuestion($questionChoice);
										
										//debug($processAnswer[$value['id']]);die();
										$answerEntitys = array();
										foreach($processAnswer[$value['id']] as $val) {
												$answerEntity = _db()->getEntity('Question.Choice.Answer');
												$answerEntity->setData($val);
												$answerEntitys[] = $answerEntity;
										}
										
										$QuestionObj->setAnswers($answerEntitys);
										
										$QuestionObj->setCacheable('false');
										$QuestionObj->setCacheParams('layout, questionId');
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
		</div>
		<div class="col-md-12 col-sm-12 fix_da hidden-xs">
			<button id="finish-choice" class="btn btn-primary" name="finish-choice" onclick="finish_choice();" type="button"><span class="glyphicon glyphicon-ok"></span>
				<?php echo $language['finish'];?>
			</button>
			<?php $check = pzk_session('signActive');
			if(1 || !empty($check)) :?>
			<button id="view-result" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" name="view-result" type="button" style="display:none;"><span class="glyphicon glyphicon-list-alt"></span>
				<?php echo $language['score'];?>
			</button>
			<a id="view-rating" class="btn btn-info" name="view-rating" type="button" style="display: none;"  href="<?=BASE_REQUEST?>/Home/rating"><span class="glyphicon glyphicon-flag"></span>
				<?php echo $language['rating'];?>
			</a>
			<button id="show-answers" class="btn btn-danger disabled" name="show-answers" style='display:none' onclick="show_answers();" type="button"><span class="glyphicon glyphicon-check"></span> <?php echo $language['result'];?>
			</button>		
			<?php endif;?>			
		</div>
		<div class="fix_da col-xs-12 visible-xs">
			<button id="finish-choice-mb" class="btn btn-primary col-xs-12 top10" name="finish-choice-mb" onclick="finish_choice();" type="button">
				<?php echo $language['finish'];?>
			</button>
			<?php $check = pzk_session('signActive');
			if(1 || !empty($check)) :?>
			<button id="view-result-mb" class="btn btn-success col-xs-12 top10" data-toggle="modal" data-target="#exampleModal" name="view-result-mb" type="button" style="display:none;">
				<?php echo $language['score'];?>
			</button>
			<a id="view-rating-mb" class="btn btn-info col-xs-12 top10" name="view-rating-mb" type="button" style="display: none;"  href="<?=BASE_REQUEST?>/Home/rating">
				<?php echo $language['rating'];?>
			</a>
			<button id="show-answers-mb" class="btn btn-danger col-xs-12 top10 disabled" name="show-answers-mb" style='display:none' onclick="show_answers();" type="button">
				<?php echo $language['result'];?>
			</button>		
			<?php endif;?>	
		</div>
	</div>
</div>


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
		            	week: "<?php echo pzk_request()->getId(); ?>"
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

<?php if($selectedWeek && $selectedTest): ?>
<script type="text/javascript">
$(function(){
	$('#chonde').text('<?php echo @$selectedWeek['name']?> - <?php echo @$selectedTest['name_sn']?>');
});

</script>
<?php endif;?>