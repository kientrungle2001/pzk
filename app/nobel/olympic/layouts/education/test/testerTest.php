 <script src="https://code.createjs.com/createjs-2015.05.21.min.js"></script>
<?php
	$class = pzk_request()->get('class');
	$lessons = $data->getDataLessons();
	$tests = $data->getTestByClass($class);
	$subTopicId = $data->getSubTopicId();
	$keybook = $data->getKeybook();
?>
<div class='bg-white pdb50'>
<div class="container mgb50 left-content">
	
	<div style="color: #<?=$lessons['color'];?>" class='breadcum'>
	
	<img src="<?= $lessons['img'];?>"/>
	
	<?= $lessons['name']; ?>
	</div>
	
	<div class="item" style="margin-top: 30px;" class="criteria">
		
		<div class="col-xs-12 bd_lesson">
			<form class="form_search_practice" style="margin: 15px 0px" id="post_practice" >
			
				<div class="col-xs-12 form-group">
					<div class='row'> 
						<div class="col-md-4 pd-0">
							<select onchange="clearTimer(this)" id="lessons" name="lesson" class="form-control select_type mgt5 title-blue" style="text-align:left;" >
								<option value = ''>Chọn đề</option>
								<?php if($tests) : ?>
									<?php $i=1; foreach($tests as $key =>$value):?>
									<?php if($i == 1) { ?>
										<option lessontype="<?php echo $value['questiontype']; ?>" class="pd-left-10" value="<?=$value['id']?>"><?=$value['name']?> </option>
									<?php } else { ?>
										<option class="pd-left-10" value="tktest"><?=$value['name']?> </option>
									<?php } ?>
									<?php $i++; endforeach;?>
								<?php endif;?>
							</select>
						</div>
						<div class='col-xs-12 col-md-4 title-red'>
							
							<div class='circle'> <span class="glyphicon glyphicon-time"> </span>  
							<div id="countdown" class ='num_time '> 45:00 </div> 
							<input type='hidden' name='lessonTime' id="lessonTime" />
							</div>
						</div>
						<div class='col-xs-12 col-md-4'>
							<button id="start_lesson" onclick="getLesson(this)"  type="button" class="btn col-xs-12 col-md-6 start_lesson btn-primary">Bắt đầu làm bài</button>
						</div>
					</div>
				    
				</div>
			</form>
		</div>
		<div id="resultLesson" class='col-xs-12'>
		
		</div>
	</div>
	<script>
	
		var CountDown = (function ($) {
      	    // Length ms 
      	    var TimeOut = 10000;
      	    // Interval ms
      	    var TimeGap = 1000;
			var timer = false;
      	    
      	    var CurrentTime = ( new Date() ).getTime();
      	    var EndTime = ( new Date() ).getTime() + TimeOut;
			
			
      	    
      	    var GuiTimer = $('#countdown');
      	    
      	    var Running = true;
      	    
      	    var UpdateTimer = function() {
      	        // Run till timeout
      	        if( CurrentTime + TimeGap < EndTime ) {
      	            timer = setTimeout( UpdateTimer, TimeGap );
      	        }
      	        // Countdown if running
      	        if( Running ) {
      	            CurrentTime += TimeGap;
      	            if( CurrentTime >= EndTime ) {
      	                GuiTimer.css('color','red');
						
						if (typeof(Factorys) !== 'undefined') {
							var game = Factorys.getGame();
							game.endGame();
						}
						
						if (typeof(Factory) !== 'undefined') {
							var game = Factory.getGame();
							game.over();
						}
						
						//var timer = Factory.getTime();
						//timer.stopCount();
						
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
				if(timer) {
					clearTimeout(timer);
				}
				
      	    };
      	    
      	    var Start = function( Timeout ) {
				Running = true;
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
      	
      	//nguoi dung chon select
		function clearTimer(that) {
			if (typeof(Factorys) !== 'undefined') {
				var timer = Factorys.getTime();
				timer.stopCount();
			}
			if (typeof(Factory) !== 'undefined') {
				var timer = Factory.getTiming();
				timer.clearTime();
			}
			$('#start_lesson').removeAttr('disabled');
			CountDown.Pause();
			
			var testId = $("#lessons option:selected").val();
			
			if(testId) {
				if(testId == 'tktest') {
					alert('Bạn phải mua tài khoản mới truy cập được');
					$("#lessons").val("<?=$tests[0]['id']?>");
				}else {
					$.ajax({
						type: "POST",
						url: "{url}/test/getTime",
						data:{testId:testId},
						success: function(data) {
							$('#countdown').text(data+':00');
							$('#lessonTime').val(data);
						}
					});
				}
			}else {
				alert('Bạn phải chọn đề!');
				$('#lessons').focus();
			}
			
		};
		function getLesson(that) {
			var testId = $('#lessons').val();	
			$(that).prop( "disabled", true );
			var currentclass = '<?=$class?>';
			if(testId) {
				$.ajax({
					type: "POST",
					url: "{url}/test/setTest",
					data:{testId:testId, currentclass:currentclass},
					success: function(data) {
						$('#resultLesson').show();
						$('#resultLesson').html(data);
						
						//set time count down
						var time = $('#lessonTime').val();
						var timecount = time*60*1000;
						CountDown.Start(timecount);
					}
				});
			}else {
				alert('Bạn phải chọn đề!');
				$('#lessons').focus();
			}
			
		};
		
		
		
		function finish() {
			CountDown.Pause();
			var clickGame = Factory.getGame();
			clickGame.destroyPlayer();
			
			var dragGame = Factorys.getGame();
			dragGame.endGame();
			
			var time_real = $('.num_time').text().split(":");
    		
    		var start_time = $('#lessonTime').val();
			
			$('#question_time').val(start_time);
    		
    		var during_time = parseInt(start_time)*60 - (parseInt(time_real[0])*60 + parseInt(time_real[1]));
    		
    		$('#during_time').val(during_time);
			
			var testId = $("#lessons option:selected").val();
			$('#testId').val(testId);
            
    		formdata = $('#form_question').serializeForm();
    		$('#idFieldset input').prop( "disabled", true );
    		$('#idFieldset .remove-input').prop( "disabled", true );
    		$('#idFieldset .add-sub-input-test').prop( "disabled", true );
    		$('#finish-choice').prop( "disabled", true );
    		$('#idFieldset textarea').prop( "disabled", true );
    		get_answers();
    		return formdata;
			
		};
		function get_answers(){
			var category_root = '';
	       	if(formdata	==	null){
	      		alert('Click hoàn thành để xem đáp án !');
	      	}else{
	      		$.ajax({
		          	type: "Post",
			        data:{
			          	answers:formdata,
			        },
			        url:'<?=BASE_REQUEST?>/test/finish',
			        success: function(results){
						if(results == 0) {
							alert('Lỗi người dùng');
						}else {
							var data = $.parseJSON(results);	
							//$('.num_true').text(data.total);
							$('.testScore').text(data.testScore);
							var question_total = data.totalQuestions;
							totaltrue = data.total;
							//$('input[name=totaltrue]').val(totaltrue);
							//var num_false = question_total - data.total;
							//$('.num_false').text(num_false);
							//$('.num_total').text(question_total);
							$('#view-results').show();
			           	}
			      	}
		        });
				
		        
	      	}
	   	};
		function show_answers(){
            
        	if(formdata	==	null){
      			alert('Click hoàn thành để xem đáp án !');
      		}else{
      			$.ajax({
	              	type: "Post",
		            data:{
		            	answers:formdata
		            },
		            url:'<?=BASE_REQUEST?>/test/finish',
		            success: function(results){
		            	var data = $.parseJSON(results);
		            	$.each(data, function(i, item) {
			            	
			            	if(item.superType == 'choice'){
			            		$('.answers_'+item.questionId+'_'+item.value).css('color', '#3e9e00');
				           		$('.answers_'+item.questionId+'_'+item.value).css('font-weight', 'bold');
				           		$('.answers_'+item.questionId+'_'+item.value).append('<span class="has-success glyphicon glyphicon-ok"></span>');
				            }			            
							if(item.superType == 'fill_word'){
					        	var data_value = item.value;
				            	$.each(data_value, function(j, data_value) {
			            			$('.answer_full_'+item.questionId).append(data_value.content);
					            	$('.answer_full_'+item.questionId).css('color', '#5cb85c');
					            	$('.answer_full_'+item.questionId).show();
				            	});
					        }	
							
							
		            	});

		            	$('.explanation').removeClass('hidden');
		           	}
	            });
				
	     		$('#show-answers').prop("disabled", true);
      		}
       	};
		
		
		
		

		
	</script>

	
	
</div>	
</div>