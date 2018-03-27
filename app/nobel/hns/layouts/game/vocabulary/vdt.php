<?php 
	$dataWords = $data->getDataWords();
	
	$documentId = $data->get('documentId');
	$gameCode = $data->get('gameCode');
	$cateId = $data->get('cateId');
	//debug($dataWords);
	if($dataWords != FALSE) {
		$allWords = array();
		foreach($dataWords as $val) {
			$allWords[] = $val['trueWord'];
		}
		$allWords = json_encode($allWords);
		$allStage = count($dataWords);
		shuffle($dataWords);
		$jsonDataWords = json_encode($dataWords);
		
?>
<style type="text/css">
	.picture-board {
		position: 	relative;
		float: left;
		width: 50%;
		margin: 15px 25%;
		
	}
	.selected {
		border: 1px solid red;
	}
	#fillWord{
		text-align: center;
		margin-bottom: 15px;
	}
	.alertVdt{
		width: 200px !important;
		margin: 0px auto 8px auto;
		padding: 5px 10px;
		color: #3c763d;
		background-color: #dff0d8;
		text-align:center;
		font-weight:bold;
		border-radius: 3px;
	}
	.inputvdt{
		margin: 10px 25%;
		width: 50%;
		height: 45px;
		padding: 3px 12px;
		font-size: 25px;
		color: #555;
		background-color: #fff;
		background-image: none;
		border: 1px solid #ccc;
		border-radius: 4px;
		-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
		box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
		-webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
		-o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
		transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
	}
</style>
<?php 
		$domain = $_SERVER['SERVER_NAME'];
		if($domain == 's1.nextnobels.com'){
			echo "<div class='alert alert-info mgb0'>";
				echo "Listen to the speakers and write down words in the box.";
			echo "</div>";
		}else if($domain == 'fulllooksongngu.com') {
			if(pzk_session('language') == 'en') {
				echo "<div class='alert alert-info mgb0'>";
					echo "Listen to the speakers and write down words in the box.";
				echo "</div>";
			}elseif(pzk_session('language') == 'vn'){
				echo "<div class='alert alert-info mgb0'>";
					echo "Nghe loa đọc và gõ từ vừa nghe được vào ô trống.";
				echo "</div>";
			}elseif(pzk_session('language') == 'ev') {
				echo "<div class='alert alert-info mgb0'>";
					echo "Listen to the speakers and write down words in the box.";
				echo "</div>";
			}else{
				echo "<div class='alert alert-info mgb0'>";
					echo " Nghe loa đọc và gõ từ vừa nghe được vào ô trống.";
				echo "</div>";
			}
		}
	?>
	<style>
		#fillWord {
			background: url('<?php echo BASE_URL.'/Default/skin/test/game/images/game5.png'; ?>');
			height: 600px;
		}
	</style>
<div class='item' id="fillWord">
	
</div>

	<script type="text/javascript">
	
	
	FillWord = {
		maxStage: <?php echo $allStage;?>,
		stage: 0,
		score: 0,
		question_audios: {},
		current_sound: null,
		current_sound_url: null,
		trueWords: [],
		dataWords: <?php echo $jsonDataWords; ?>,
		startGame: function() {
			if(this.stage == this.maxStage) {
				that = this;
				endStage = this.maxStage -1;
				href = this.dataWords[endStage].href;
				if(typeof question_audios[href] != 'undefined') {
					current_sound = question_audios[href]; 
					current_sound.pause();
					current_sound.onended();
					current_sound.currentTime = 0;
				}
				$.ajax({
					method: "post",
					url: "/game/saveGameVocabunary",
					data: { score: that.score, trueWords: that.trueWords, cateId:<?php echo $cateId; ?>, documentId: <?php echo $documentId; ?>, totalWord: <?php echo $allStage; ?>, gameCode:'<?php echo $gameCode;?>'},
					
				});
				var wrongWords = $(<?php echo $allWords; ?>).not(this.trueWords).get();
				$('#fillWord').empty();
				$('#fillWord').append('<br><div class="alert alert-success"><b>Finish game!</b><br>Correct answers:<b> '+this.score+' / '+ this.maxStage+'</b></br><p>Correct words: '+this.trueWords.join(', ')+'</p><p>Wrong words: '+wrongWords.join(', ')+'</p></div>');
				
				
			}else{
				href = this.dataWords[this.stage].href;
				hreffix = this.dataWords[this.stage].hreffix;
				trueWord = this.dataWords[this.stage].trueWord;
				this.buildGame(href, trueWord);
				$thisspan = $('#fillWord span');
				this.read_question($thisspan, href);
				//this.prevGame(href);
				this.nextGame(href);
			}	
		},
		buildGame: function(href, trueWord) {
			$('#fillWord').append('<span class="btn btn-default glyphicon glyphicon-volume-up" onclick="FillWord.read_question(this, '+hreffix+');return false;"></span></br>');
			$('#fillWord').append('<input class="inputvdt" rel='+escape(trueWord)+' onblur="return FillWord.checkFillWord(this, '+hreffix+'); return false;" type="text" /></br> <p class="alertVdt " style="display:none;"></p>');
			
		},
		
		read_question: function(elem, url) {
			if(this.current_sound) {
				this.current_sound.pause();
				this.current_sound.currentTime = 0;
				this.current_sound.onended();
			}
			if(this.current_sound_url == url) {
				$(elem).removeClass('glyphicon-volume-up').addClass('glyphicon-volume-off');
				this.current_sound_url = null;
				sound = this.question_audios[url]; 
				sound.play();
				sound.onended = function() {
					$(elem).removeClass('glyphicon-volume-off').addClass('glyphicon-volume-up');
				};
				return ;
			} else {
				this.current_sound_url = url;
			}
			$(elem).removeClass('glyphicon-volume-up').addClass('glyphicon-volume-off');
			if(typeof this.question_audios[url] == 'undefined') {
				sound = new Audio(url);
				sound.loop = false;	
				this.question_audios[url] = sound;
				sound.onended = function() {
					$(elem).removeClass('glyphicon-volume-off').addClass('glyphicon-volume-up');
				};
			}
			this.current_sound = this.question_audios[url];
			this.question_audios[url].play();
		},
		
		
		nextGame: function() {
			$('#fillWord').append('<button class="btn btn-success">Submit</button> <button class="btn btn-warning" onclick="FillWord.nextStage()">Skip</button>');
		},
		prevGame: function() {
			$('#fillWord').append('<button onclick="FillWord.prevStage()">Prev</button>');
		},
		setNextStage: function() {
			this.stage = this.stage +1;
		},
		setPrevStage: function() {
			this.stage = this.stage -1;
		},
		clearBoad: function() {
			$('#fillWord').empty();
		},
		setScore: function() {
			this.score = this.score + 1;
		},
		setTrueWords: function(word) {
			this.trueWords.push(word); 
		},
		checkFillWord: function (that, url){
			that2 = this;
			
			userInput = $(that).val();
			if(userInput != '') {
				userInput = userInput.toLowerCase();
				userInput = escape(userInput);
				trueWord = $(that).attr('rel');
				if(userInput == trueWord) {
					$(that).prop('disabled', true);
					//load audio true
					sound = new Audio('/Default/skin/nobel/test/themes/default/media/audio/Game-Spawn.mp3');
					sound.loop = false;	
					sound.play();
					if(typeof this.question_audios[url] != 'undefined') {
						current_sound = this.question_audios[url]; 
						current_sound.pause();
						current_sound.onended();
						current_sound.currentTime = 0;
					}
					$('input.inputvdt').css('border', 'solid 1px blue');
					$('p.alertVdt').css('background-color', '#dff0d8');
					$('p.alertVdt').html('Correct!');
					$('p.alertVdt').show();
					setTimeout(function(){ 
						$('p.alertVdt').hide();
						that2.setNextStage();
						that2.setScore();
						that2.setTrueWords(unescape(userInput));
						that2.clearBoad();
						that2.startGame();
					}, 2000);
					
				}else {
					sound = new Audio('/Default/skin/nobel/test/themes/default/media/audio/Game-Break.mp3');
					sound.loop = false;	
					sound.play();
					if(typeof this.question_audios[url] != 'undefined') {
						current_sound = this.question_audios[url]; 
						current_sound.pause();
						current_sound.onended();
						current_sound.currentTime = 0;
					}
					
					$('input.inputvdt').css('border', 'solid 1px red');
					$('p.alertVdt').css('background-color', '#ec971f');
					$('p.alertVdt').html('Wrong! Try again!');
					$('p.alertVdt').show();
					setTimeout(function(){ 
						$('p.alertVdt').hide();
					}, 2000);
				}
			}
		},
		nextStage: function (url) {
			if(typeof this.question_audios[url] != 'undefined') {
				current_sound = this.question_audios[url]; 
				current_sound.pause();
				current_sound.onended();
				current_sound.currentTime = 0;
			}
					
			this.setNextStage();
			this.clearBoad();
			this.startGame();
		},
		prevStage: function (url) {
			if(typeof this.question_audios[url] != 'undefined') {
						current_sound = this.question_audios[url]; 
						current_sound.pause();
						current_sound.onended();
						current_sound.currentTime = 0;
					}
					
					this.setPrevStage();
					this.clearBoad();
					this.startGame();
		}
		
		
	};
	
	$(function() {
		FillWord.startGame();

	});
	
	</script>
	<?php } else { ?>
		Chưa có dữ liệu
	<img class='item' src="<?php echo BASE_URL; ?>/Default/skin/nobel/test/themes/default/media/bg_game.jpg" />
	<?php } ?>