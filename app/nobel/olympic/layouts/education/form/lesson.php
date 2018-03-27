<script src="https://code.createjs.com/createjs-2015.05.21.min.js"></script>
<?php
	
	$lessons = $data->getDataLessons();
	$lessonTime = $data->getLessonTime();
	$subTopicId = $data->getSubTopicId();
	$dataParent = $data->getParentById($lessons['parent']);
	$keybook = $data->getKeybook();
?>
<div class='bg-white pdb50'>
	
<div id="flat" class="container left-content">
	<div class='breadcum'>
	<span style="color: #<?=$dataParent['color'];?>" >
	<img src="<?= $dataParent['img'];?>"/>
	&nbsp;<?= $dataParent['name']; ?> &nbsp; > </span> &nbsp;
	<?= $lessons['name']; ?>
	</div>
	
		
	<div class='item center'>
		<a href="<?=BASE_REQUEST.'/'.$lessons['router'].'/'.$lessons['id'].'#flat'?>" class='bt-lesson' onclick='showtailieu();'>		<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> 		Bài giảng</a><a href="<?=BASE_REQUEST.'/'.$lessons['router'].'/'.$lessons['id'].'#flat'?>" class='bt-lesson' onclick='showluyen();'><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Luyện tập</a>
	</div>	
		
	<div id="baigiang" class="guide an">
		<h2 class="title-practice title-lesson">Bài giảng</h2>
		<?php
		$document = $data->getDocumentById($lessons['id']);
		if($document) {
		?>
		<script type="text/javascript" src="http://s1.demo.nextnobels.com/3rdparty/jquery.gdocsviewer.v1.0/jquery.gdocsviewer.min.js"></script> 
		<script type="text/javascript">
		 $(document).ready(function() {
		  $('#embedURL').gdocsViewer({width: '100%'});
		 });
		</script>
		<a href="<?=$document['file'];?>" id="embedURL">&nbsp;</a>
		<?php } 
		
		$obj = pzk_obj ( 'education.question.video' );
		$obj->display ();
		
		?>
	</div>
	
	<div id='luyentap' class="item an criteria ">
		<h2 class="title-practice mgb10 title-lesson">Luyện tập</h2>
		
		<div class="col-xs-12 bd_lesson">
			<form class="form_search_practice" style="margin: 15px 0px" id="post_practice" >
				<input id='category_root' type='hidden' name='category_root' value='<?= $lessons['id']; ?>'>
				<div class="col-xs-12 form-group">
					<div class='row'> 
						<div class="col-md-4 pd-0">
							<select onchange="clearTimer(this)" id="lessons" name="lesson" class="form-control select_type mgt5 title-blue" style="text-align:left;" >
								<option value = ''>Chọn bài</option>
								<?php if($lessons['child']):?>
									<?php foreach($lessons['child'] as $key =>$value):?>
										<option lessontype="<?php echo $value['questiontype']; ?>" class="pd-left-10" value="<?=$value['id']?>"><?=$value['name']?> </option>
									<?php endforeach;?>
								<?php endif;?>
							</select>
						</div>
						<div class='col-xs-12 col-md-4 title-red'>
							
							<div class='circle'> <span class="glyphicon glyphicon-time"> </span>  
							<div id="countdown" class ='num_time '> <?= $lessonTime; ?>:00 </div> 
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
			$('#countdown').text('15:00');
			var lessonType = $("#lessons option:selected").attr('lessontype');
		};
		function getLesson(that) {
			var lessonId = $('#lessons').val();	
			var category_root = $('#category_root').val();
			$(that).prop( "disabled", true );
			if(lessonId) {
				$.ajax({
					type: "POST",
					url: "{url}/form/setLesson",
					data:{lessonId:lessonId, category_root:category_root},
					success: function(data) {
						$('#resultLesson').show();
						$('#resultLesson').html(data);
						
						//set time count down
						var timecount = 15*60*1000;
						CountDown.Start(timecount);
					}
				});
			}else {
				alert('Bạn phải chọn bài!');
				$('#lessons').focus();
			}
			
		};
		
		
		
		function finish_choice() {
			CountDown.Pause();
			var time_real = $('.num_time').text().split(":");
    		
    		var start_time = 15;
    		
    		var during_time = parseInt(start_time)*60 - (parseInt(time_real[0])*60 + parseInt(time_real[1]));
    		
    		$('#during_time').val(during_time);
            
    		formdata = $('#form_question_nn').serializeForm();
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
			        url:'<?=BASE_REQUEST?>/form/showAnswersChoice',
			        success: function(results){
			         	var data = $.parseJSON(results);	
			           	$('.num_true').text(data.total);
			           	var question_total = data.totalQuestions;
			           	totaltrue = data.total;
			           	$('input[name=totaltrue]').val(totaltrue);
			           	var num_false = question_total - data.total;
			           	$('.num_false').text(num_false);
			           	$('.num_total').text(question_total);
						$('#view-results').show();
			           	
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
		            url:'<?=BASE_REQUEST?>/form/showAnswersChoice',
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
		
		
		var user_book_id = false;
		var saved = false;
        function save_choice(){
			if(user_book_id == false){
				
	        	if(formdata == null){
					
	          		formdata = finish_choice();
	        		alert('Click hoàn thành để lưu bài tập !');
	          	}else{
					var keybook = '<?php echo $keybook; ?>';
		          	$.ajax({
		              	type: "Post",
			            data:{answers:formdata, totaltrue: totaltrue, keybook:keybook},
			            url:'<?=BASE_REQUEST?>/form/saveChoice',
			            success: function(results){
			            	if(results){
			                   	user_book_id	=	results;
			                   	saved			= 	true;
			                	$('#save-choice').prop( "disabled", true );
								if(results !== 'undefined' && results != "0"){
			                   		alert('Lưu bài tập thành công');
								} else{
									alert('Lỗi người dùng');
								}
			                }
			           	}
		            });
	          	}
			}
        };
		

		
		
	</script>

	
	
</div>	
</div>
<script>
function showtailieu(){
			$('#baigiang').show();
			$('#luyentap').hide();
		}
		function showluyen(){
			$('#baigiang').hide();
			$('#luyentap').show();
		}
</script>
