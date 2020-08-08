<?php
$words = $data->getWords();
$allWords = array();
foreach($words as $val) {
	$allWords[] = $val[0];
}
$allWords = json_encode($allWords);
$documentId = $data->getDocumentId();
$gameCode = $data->getGameCode();
$cateId = $data->getCateId();
if(count($words) > 0){
 ?>
 
 <?php 
		$domain = $_SERVER['SERVER_NAME'];
		if($domain == 's1.nextnobels.com'){
			echo "<div class='alert alert-info'>";
				echo "Click on the word you choose in order or drag from below into the box above.";
			echo "</div>";
		}else if($domain == 'fulllooksongngu.com') {
			if(pzk_session('language') == 'en') {
				echo "<div class='alert alert-info'>";
					echo "Click on the word you choose in order or drag from below into the box above.";
				echo "</div>";
			}elseif(pzk_session('language') == 'vn'){
				echo "<div class='alert alert-info'>";
					echo "Click vào từ mà bạn chọn theo thứ tự từ đúng hoặc dùng chuột kéo từ bên dưới vào ô trống bên trên.";
				echo "</div>";
			}elseif(pzk_session('language') == 'ev') {
				echo "<div class='alert alert-info'>";
					echo "Click on the word you choose in order or drag from below into the box above.";
				echo "</div>";
			}else{
				echo "<div class='alert alert-info'>";
					echo "Click vào từ mà bạn chọn theo thứ tự từ đúng hoặc dùng chuột kéo từ bên dưới vào ô trống bên trên.";
				echo "</div>";
			}
		}
	?>
	<script type="text/javascript">
	pzk.load('/Default/skin/nobel/test/css/game.css');
	</script>

<div id="game">
		<div id="player"></div>
		<div id="point"></div>
		<div id="live"></div>
		<div id="timing"></div>
		<div id="board">
			<div id="image-board">
				<img id="game-image" src="" />
			</div>
			<div id="input-board">
				<div class="input-cell"></div>
				<div class="input-cell"></div>
				<div class="input-cell"></div>
				<div class="input-cell"></div>
				<div class="input-cell"></div>
				<div class="clear"></div>
			</div>
			<div id="character-board">
				<div class="character-cell">
					<div class="character">
						A
					</div>
				</div>
				<div class="character-cell">
					<div class="character">
						P
					</div>
				</div>
				<div class="character-cell">	
					<div class="character">
						P
					</div>
				</div>
				<div class="character-cell">
					<div class="character">
						L
					</div>
				</div>
				<div class="character-cell">
					<div class="character">
						E
					</div>
				</div>
				<div class="clear"></div>
			</div>
			<div id="navigation-board" class="text-center">
				<!--a href="#" class="btn btn-default" onclick="prevGame(); return false;">Previous</a-->
				<a href="#" class="btn btn-warning" onclick="nextGame(); return false;">Skip</a>
				<br /><br />
			</div>
		</div>
		
	</div>
	<script type="text/javascript">
	
	// word dang chay
	var word = null;
	var gameImage = null;
	var trueWords = [];
	// khoi tao game
	function initGame(w) {
		word = w[0];
		gameImage = w[1];
		var chars = [];
		for(var i = 0; i < word.length; i++) {
			chars.push(word[i]);
		}
		chars.shuffle();
		var characterHtml = '';
		for(var i = 0; i < chars.length; i++) {
			characterHtml += '<div class="character-cell"><div class="character">' + chars[i] + '</div></div>';
		}
		characterHtml += '<div class="clear"></div>';
		$('#character-board').html(characterHtml);
		var inputHtml = '<div class="input-cell"></div>'.repeat(chars.length);
		inputHtml += '<div class="clear"></div>';
		$('#input-board').html(inputHtml);
		/*
		var maxLength = (chars.length * 100);
		if(maxLength > 600) {
			maxLength = 600;
		}
		$('#input-board').width(maxLength + 'px');
		$('#character-board').width(maxLength + 'px');
		*/
		$('#image-board').html(gameImage);
		if(mobilecheck()) {
			$('#image-board').find('img').addClass('img-responsive');
		}
		
		// khoi tao su kien
		initEvents();
	
	}
	
	// keo tha
	function initEvents() {
	
		$( ".character").draggable({
		  cancel: "a.ui-icon", // clicking an icon won't initiate dragging
		  revert: "invalid", // when not dropped, the item will revert back to its initial position
		  containment: "document",
		  helper: "clone",
		  cursor: "move"
		});
		
		$(".input-cell, .character-cell").droppable({
		  accept: ".character",
		  activeClass: "ui-state-highlight",
		  drop: function( event, ui ) {
			moveCharater(this, ui.draggable );
		  }
		});
		
		$( ".character").click(function() {
			var $self = $(this);
			if($self.parent().hasClass('input-cell')) {
				$('.character-cell:empty:first').append($self);
			} else if($self.parent().hasClass('character-cell')) {
				$('.input-cell:empty:first').append($self);
				checkFinish();
			}
		});
	
	}
	
	// tha vao
	function moveCharater(target, elem) {
		if($(target).children().length == 0) {
			$(target).append(elem);
		}
		checkFinish();
	}
	finishListeners = [];
	totalFinished = 0;
	// kiem tra xem da ket thuc chua
	function checkFinish () {
		var result = $('#input-board').text();
		if(result == word) {
			//load audio true
			sound = new Audio('/Default/skin/nobel/test/themes/default/media/audio/Game-Spawn.mp3');
			sound.loop = false;	
			sound.play();
			$('#input-board .input-cell').css('border-color', 'green');
			for(var i = 0; i < finishListeners.length; i++) {
			
				// xem co su kien gi xay ra khong
				finishListeners[i]();
			}
			totalFinished++;
			trueWords.push(word);
		} else if(result.length == word.length) {
			//load audio false
			sound = new Audio('/Default/skin/nobel/test/themes/default/media/audio/Game-Break.mp3');
			sound.loop = false;	
			sound.play();
			$('#input-board .input-cell').css('border-color', 'red');
		} else {
			$('#input-board .input-cell').css('border-color', 'black');
		}
	}
	// shuffle
	Array.prototype.shuffle = function() {
	  var i = this.length, j, temp;
	  if ( i == 0 ) return this;
	  while ( --i ) {
		 j = Math.floor( Math.random() * ( i + 1 ) );
		 temp = this[i];
		 this[i] = this[j];
		 this[j] = temp;
	  }
	  return this;
	}
	
	var words = [['APPLE', '/3rdparty/Filemanager/source/apple.jpg'], ['MANGO', '/3rdparty/Filemanager/source/mango.jpg'], ['BANANA', '/3rdparty/Filemanager/source/banana.jpg']];
	words = <?php echo json_encode($data->getWords());?>;
	wordIndex = 0;
	words.shuffle();
	initGame(words[wordIndex]);
	finishListeners.push(function() {
		nextGame();
	});
	
	function nextGame() {
		setTimeout(function() {
			if(wordIndex == words.length - 1) {
				
				
				var documentId = "<?php echo $documentId; ?>";
				var gameCode = "<?php echo $gameCode; ?>";
				var totalWord = words.length;
				var score = trueWords.length;
				var cateId = "<?php echo $cateId; ?>";
				var wrongWords = $(<?php echo $allWords; ?>).not(trueWords).get();
				$.ajax({
					type: "Post",
					data:{score:score, totalWord: totalWord, cateId: cateId, trueWords: trueWords, documentId:documentId, gameCode:gameCode},
					url:'<?=BASE_REQUEST?>/Game/saveGameVocabunary',
					dataType: 'json',
					success: function(data){
						$('#board').html('<h4>Finish Game: '+totalFinished + '/' + words.length +' mission completed!</h4><br /><h4>True words: '+trueWords.join(', ')+'</h4><br /><h4>Wrong words: '+wrongWords.join(', ')+'</h4>');
					}
				});
				return false;
			}
			wordIndex++;
			initGame(words[wordIndex]);	
		}, 1500);
		
	}
	function prevGame() {
		setTimeout(function() {
			if(wordIndex == 0) return false;
			wordIndex--;
			initGame(words[wordIndex]);
		}, 1500);
	}
	</script>
	
	
	
	<?php }else { ?>
	Chưa có dữ liệu
	<img class='item' src="<?php echo BASE_URL; ?>/Default/skin/nobel/test/themes/default/media/bg_game.jpg" />
<?php } ?>