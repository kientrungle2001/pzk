	<style type="text/css">
		.character-cell, .input-cell {
			width: 			60px;
			height: 		40px;
			display: 		block;
			margin-right: 	20px;
			border: 		1px solid black;
			text-align: 	center;
			float: 			left;
			line-height: 	100%;
		}
		.character {
			line-height: 	100%;
			height: 		100%;
			width: 			60px;
			height: 		40px;
			border: 		1px solid blue;
			cursor: 		pointer;
		}
		#character-board {
			margin-top: 	30px;
		}
		.clear {
			clear: both;
		}
	</style>

<div id="game">
		<div id="player"></div>
		<div id="point"></div>
		<div id="live"></div>
		<div id="timing"></div>
		<div id="board">
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
		</div>
		
	</div>
	<script type="text/javascript">
	
	// word dang chay
	var word = null;
	
	// khoi tao game
	function initGame(w) {
		word = w;
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
	
	// kiem tra xem da ket thuc chua
	function checkFinish () {
		var result = $('#input-board').text();
		if(result == word) {
			alert('CONGRATULATIONS! you are awesome!');
			for(var i = 0; i < finishListeners.length; i++) {
			
				// xem co su kien gi xay ra khong
				finishListeners[i]();
			}
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
	
	var words = ['APPLE', 'MANGO', 'BANANA'];
	wordIndex = 0;
	words.shuffle();
	initGame(words[wordIndex]);
	finishListeners.push(function() {
		wordIndex++;
		if(wordIndex == words.length) {
			wordIndex = 0;
		}
		initGame(words[wordIndex]);
	});
	</script>