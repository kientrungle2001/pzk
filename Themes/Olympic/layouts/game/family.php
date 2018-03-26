<style>
.num_time{
	font-size: 20px;
}
#alert-game{
	width: 400px;
}
</style>
<div class='container'>
<div id='kq' class='item'> 
		
	</div> 

<div id='boxgame' class = 'text-center'>
	<div class ='btn btn-primary mgb10'> Thời gian </br> <div id="countdown" class ='num_time '> 3:00 </div></div>	
	</br>
	<div id='team' onclick = "getQuestionStart();" rel='1' class='btn btn-info'> Đội một bắt đầu </div>
	 
</div>
<input id='score1' type="hidden" name='score1' value='0' />
<input id='score2' type="hidden" name='score2' value='0'/>
<input type = "hidden" name="questionIds" /> 
<div id="alert-game"></div>
<div id='resQuestion' class ='family'>
	
</div>

</div>

<script>


	var team = 1;
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
					$('.num_time').css('color','red');
					Running = false;					
					if(timer) {
						clearTimeout(timer);
					}
					if(team <= 2){
						team2start(team);
						team = team + 1;		
					}
					
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
      	
	function getQuestion(){
		
		var questionId = $("input[name='questionId']").val();
		var questionIds = $("input[name='questionIds']").val();
		var ids = questionId+','+questionIds;
		var answer = $("input[name='answers["+questionId+"]']:checked").val();
		if(answer) {
			$.ajax({
				type: "Post",
				data: {questionId:questionId, answer:answer},
				url:'<?=BASE_REQUEST?>/game/checkAnswer',
				success: function(data){
					if(data ==1){
						var team = $('#team').attr('rel');
						if(team == 1) {
							var score1 = $('#score1').val();
							var c1 = parseInt(score1) + 1;
							$('#score1').val(c1);
						}else if (team == 2) {
							var score2 = $('#score2').val();
							var c2 = parseInt(score2) + 1;
							$('#score2').val(c2);
						}
						$('#alert-game').show();
						$('#alert-game').html('Đúng');
						$('#alert-game').addClass('alert alert-warning');
						$.ajax({
							type: "Post",
							data: {ids:ids},
							url:'<?=BASE_REQUEST?>/game/getNewQuestion',
							success: function(data){
								$("input[name='questionIds']").val(ids);
								
								$('#team').attr('disabled', true);
								
								setTimeout(function(){ 
									//$('#alert-game').html('Câu tiếp theo');
									$('#alert-game').removeClass();
									$('#alert-game').hide();
									$('#resQuestion').html(data);
								}, 500);
								
								
							}
						});
					}else {
						$('#alert-game').show();
						$('#alert-game').html('Sai! chọn đáp án đúng để trả lời câu tiếp theo');
						$('#alert-game').addClass('alert alert-warning');
					}
					
				}
			});
		}else {
			alert('Bạn hãy chọn đáp án!');
		}
	}

	function nextQuestion(){
		$('#alert-game').hide();
		var questionId = $("input[name='questionId']").val();
		var questionIds = $("input[name='questionIds']").val();
		var ids = questionId+','+questionIds;
		if(ids) {
			$.ajax({
				type: "Post",
				data: {ids:ids},
				url:'<?=BASE_REQUEST?>/game/getNewQuestion',
				success: function(data){
					$("input[name='questionIds']").val(ids);
					$('#resQuestion').html(data);		
				}
			});
		}
	}
	
	function getQuestionStart() {
		var ids = $("input[name='questionIds']").val();
		$.ajax({
			type: "Post",
			data: {ids:ids},
			url:'<?=BASE_REQUEST?>/game/getQuestion',
			success: function(data){
				$('#resQuestion').html(data);
				$('#team').attr('disabled', true);
				var timecount = 1*30*1000;
				CountDown.Start(timecount);
			}
		});
	}
	
	function team2start(team) {
		if(team == 1) {
			$('#resQuestion').html('');
			$('#alert-game').hide();
			$('.num_time').css('color','white');
			//$("input[name='questionIds']").val('');
			var score1 = $('#score1').val();
			$('#kq').append("<div class ='col-md-2 alert alert-warning pull-left'>Đội 1: "+score1+" câu đúng</div> ");
			$('#team').attr('rel', 2);
			$('#team').html('Đội hai bắt đầu');
			$('#team').removeAttr('disabled');	
		}else if(team == 2) {
			$('#resQuestion').html('');
			$('#alert-game').hide();
			var score1 = $('#score1').val();
			var score2 = $('#score2').val();
			$('#kq').append("<div class ='col-md-2 alert alert-warning pull-right'>Đội 2: "+score2+" câu đúng</div> ");
			if(score1 < score2) {
				$('#boxgame').html('');
				$('#boxgame').append("<div class='item alert alert-success'><h3>Chúc mừng đội 2 đã thắng!</h3></div>");
			}else if(score1 > score2) {
				$('#boxgame').html('');
				$('#boxgame').append("<div class='item alert alert-success'><h3>Chúc mừng đội 1 đã thắng!</h3></div>");
			}else {
				$('#boxgame').html('');
				$('#boxgame').append("<div class='item alert alert-success'><h3>Hai đội ngang tài</h3></div>");
			}
			$('#boxgame').append("</br><div onclick = reload(); class='btn btn-primary'>Chơi lại</div>");
		}
		
		
	}
	function reload() {
		location.reload();
	}
	
	
</script>