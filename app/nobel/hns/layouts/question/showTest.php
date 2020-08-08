<link rel="stylesheet" href="/Default/skin/nobel/test/css/question/choice.css">
<script src="<?=BASE_URL?>/js/loadding.js"></script>
    <style>
        #left {
            background-image: url('/Default/skin/nobel/test/media/bg_test_page.jpg');
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

<div class="row margin-top-20">
	<div class="col-xs-6 text-center">
		<a class="btn btn-primary" href="<?=BASE_REQUEST?>/Practice">Practice (Luyện tập)</a>
	</div>
	<div class="col-xs-6 text-center">
		<a class="btn btn-danger" href="<?=BASE_REQUEST?>/Online-Examination">Online Test (Thi trực tuyến)</a>
	</div>
</div>

<div class="row margin-top-20">
	<h2 class="title-practice">THI THỬ TRẮC NGHIỆM ONLINE VÀO LỚP 6 THPT TRẦN ĐẠI NGHĨA</h2>
</div>

<div class="col-xs-12 form_search_test margin-top-10">
	<div class="col-xs-12 form-group  margin-top-20">
	
		<div class="col-xs-9 pd-0">
    		<div class="form-control select_type title-blue" ><span> <?=$data_criteria['name']?> </span></div>
    	</div>
		
		<div class="col-xs-3 pd-0" style="z-index:10;">
    		<div class="time-count-p">
    			<div class="col-xs-6 margin-top-39 title-time title-blue"><span>Thời gian </span></div>
    			<div class="col-xs-6 margin-top-24">
    				 <div id="countdown" class="num-time title-red"><?=$data_criteria['time']?></div>
    			</div>
    		</div>
    	</div>
	</div>
		
	<div class="col-xs-12 border-question" style="z-index: 9">
		<form id="form_question_nn" class="question_content pd-0 form-horizontal" method="post">
			<div class="col-xs-12 margin-top-20" style="overflow-x: hidden; height:800px;">
				<?php 
			    	$i	= 1;
			    	$page	= 1;
			    	$numpage	= numPage(count($showQuestions));
		    	?>
		    	
		    	<fieldset id="idFieldset">  <!-- disabled="1"  -->
		    	<?php foreach($showQuestions as $key =>$value):?>
		    		<div class=" step_ answer_box question_page_<?php echo $page?>">
		    			<?php $i++; $page=ceil($i/30);?>
		    			
				    		<div class="order">Câu : <?=$key+1;?></div>
				    		
				    		<input type="hidden" name="questions[<?=$value['id']?>]" value="<?=$value['id']?>"/>
				    		<input type="hidden" name="questionType[<?=$value['id']?>]" value="<?=questionTypeOjb($value['questionType'])?>"/>
				    		<?php 
					    		$QuestionObj = pzk_obj('education.question.type.'.questionTypeOjb($value['questionType']));
					    		$QuestionObj->setQuestionId($value['id']);
					    		$QuestionObj->setCacheable('false');
					    		$QuestionObj->setCacheParams('layout, questionId');
					    		$QuestionObj->display();
					    	?>
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
			<div class="practice-result">
					<button id="finish-choice" class="btn btn-primary" name="finish-choice" onclick="finish_choice();" type="button">
						Hoàn thành 
					</button>
                <?php $check = pzk_session()->getSignActive();
                    if(1 || !empty($check)) :?>
                    <button id="view-result" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" name="view-result" type="button" style="display:none;">
						Xem kết quả 
					</button>
					
					<a id="view-rating" class="btn btn-info" name="view-rating" type="button" style="display: none;" href="<?=BASE_REQUEST?>/Ngonngu/rating">
						Xếp hạng 
					</a>
					
					<button id="show-answers" class="btn btn-danger" name="show-answers" onclick="show_answers();" type="button">
						Xem đáp án 
					</button>
					
                <?Php endif;?>
			</div>
			
		</form>
	</div>
</div>

<div class="modal fade" role="dialog" id="exampleModal" aria-labelledby="gridSystemModalLabel" aria-hidden="true">
	<div class="modal-dialog">
      	<div class="modal-content">
        	<div class="modal-header">
          		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          		<h3 class="modal-title text-center title-blue" id="gridSystemModalLabel"><b>Kết quả bài làm</b></h3>
        	</div>
	        <div class="modal-body">
	          	<div class="container-fluid">
	           		<div class="row">
	           			<div class="col-xs-12 title-blue">
			    			<div class="col-xs-8 question_true control-label"><b>Số câu trả lời đúng </b></div> <div class="col-xs-3 num_true"></div><div class="col-xs-1"><span class="glyphicon glyphicon-ok"></span></div>
			    		</div>
			    		<div class="col-xs-12 title-red">
			    			<div class="col-xs-8 question_false control-label"><b>Số câu trả lời sai </b></div> <div class="col-xs-3 num_false"></div><div class="col-xs-1"><span class="glyphicon glyphicon-remove"></span></div>
			    		</div>
			    		<div class="col-xs-12" style="color: #F0AD4E">
			    			<div class="col-xs-8 question_total control-label"><b>Tổng số câu </b></div> <div class="col-xs-3 num_total"><?=$data_criteria['quantity']?></div><div class="col-xs-1"><span class="glyphicon glyphicon-th-list"></span></div>
			    		</div>
			    		<div class="line_question pd-top-10"></div>
			    		<div class="col-xs-12 pd-top-10" style="color: #4CAE4C; font-weight:bold;">
			    			<div class="col-xs-8 question_rating control-label">Xếp hạng </div> <div class="col-xs-3 num_rat"></div><div class="col-xs-1"><span class="glyphicon glyphicon-tree-conifer"></span></div>
			    		</div>
		    		</div>
	          	</div>
	        </div>
	        <div class="modal-footer">
	        	<a href="javascript:void(0)" class="btn fb-share"></a>
	        </div>
      	</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal  id="exampleModal"-->
<!-- 
<div class="modal fade bs-example-modal-lg" id="ratingModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
    	<div class="modal-content">
    		<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        	<h3 class="modal-title text-center title-blue" id="myModalLabel">Thứ hạng bài test của bạn : <?=pzk_session()->getUsername()?></h3>
	      	</div>
	      	<div class="modal-body">
	      		<div class="container-fluid">
	           		<div class="row">
		      			
		      		</div>
		      	</div>
	      	</div>
	      	<div class="modal-footer">
	        	wefwef
	        </div>
    	</div>
	</div>
</div>
-->
  


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
	        appId: '474070302757620', //474070302757620 || 908741545852277
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
	            description: 'Đã đạt : '+diem+'/'+tongcau+' điểm - Xếp thứ hạng : '+xephang+ ' - Chúc mừng bạn <?=pzk_session()->getUsername()?> đã hoàn thành bài thi! - '+strket,
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
		            	keybook:"<?=$data_criteria['keybook']?>"
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