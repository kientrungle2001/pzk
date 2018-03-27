<?php 
$imagesAndWords = $data->getImagesAndWords();
if(count($imagesAndWords) > 0) {
?>
<?php 
		$domain = $_SERVER['SERVER_NAME'];
		if($domain == 's1.nextnobels.com'){
			echo "<div class='alert alert-info' >";
				echo "Drag words on the top into place marked in the diagram.";
			echo "</div>";
		}else if($domain == 'fulllooksongngu.com') {
			if(pzk_session('language') == 'en') {
				echo "<div class='alert alert-info'>";
					echo "Drag words on the top into place marked in the diagram.";
				echo "</div>";
			}elseif(pzk_session('language') == 'vn'){
				echo "<div class='alert alert-info'>";
					echo "Kéo các từ bên trên vào vị trí được đánh dấu trong sơ đồ.";
				echo "</div>";
			}elseif(pzk_session('language') == 'ev') {
				echo "<div class='alert alert-info'>";
					echo "Drag words on the top into place marked in the diagram.";
				echo "</div>";
			}else{
				echo "<div class='alert alert-info'>";
					echo "Kéo các từ bên trên vào vị trí được đánh dấu trong sơ đồ.";
				echo "</div>";
			}
		}
	?>
<style type="text/css">
	.picture-board {
		position: 	relative;
		width:		795px;
		height:		725px;
	}
	.selected {
		border: 1px solid red;
	}
</style>
<div id="dragToPartGameNav">
	<span class="btn btn-warning top10 sharp" onclick="dragNextGame(); return false;">Skip</span>
</div>
<div id="dragToPartGame">
	
</div>
<img class='item' src="<?=BASE_URL;?>/Default/skin/test/game/images/game6.png" />
	<script type="text/javascript">
	
	function copyTextToClipboard(text) {
		var $temp = $("<textarea>")
		$("body").append($temp);
		$temp.val(text).select();
		document.execCommand("copy");
		$temp.remove();
	}
	
	LEFT_KEY 	= 	37;
	RIGHT_KEY 	= 	39;
	UP_KEY 		= 	38;
	DOWN_KEY 	= 	40;
	WORD_WIDTH 	= 	21;
	WORD_HEIGHT	= 	52;
	FONT_FAMILY	=	'Courier';
	FONT_SIZE	=	37;
	TYPE_STRING =	'string';
	gameIndex 	= 	0;
	totalFinished	= 0;
	$.fn.dragToPartGame = function(options /*method*/, value) {
		var keys = ['font-size', 'font-family', 'width', 'height', 'top', 'left'];
		var common_keys = ['font-size', 'font-family', 'height'];
		
		if(typeof options == TYPE_STRING) {
			var method = options;
			if(method == 'changeCss') {
				this.find('.picture-board .resizable-box').css(value);
			} else if(method == 'remove') {
				this.find('.selected').remove();
			} else if(method == 'export') {
				var rs = [];
				this.find('.resizable-box').each(function(boxIndex, box) {
					var $box = $(box);
					var row = {};
					row.text = $box.text();
					row.css = {};
					$.each(keys, function(index, key) {
						row.css[key]	= $box.css(key);
					});
					rs.push(row);
				});
				copyTextToClipboard(JSON.stringify(rs));
				alert('Data copied!');
				return rs;
			}
			return this;
		}
		
		// This is the easiest way to have default options.
        var settings = $.extend({
            // These are the defaults.
            'font-size': 	'37px',
			'font-family':	'Courier',
			'word-width':	'21px',
			'word-height':	'52px',
			'words':		[],
			'src':			''
        }, options );
		
		this.append('<div class="picture-board"><img style="position: absolute; top: 0; left: 0;" src="' + settings.src + '" /></div>');
		var words = settings.words;
		var wrongWords = 0;
		for(var i = 0; i < words.length; i++) {
			var word = words[i];
			if(!!word.wrong) {
				wrongWords++;
			}
			var $words = this.appendWord(word);
			for(var key in word.css) {
				if($words[0])
					$words[0].css(key, word.css[key]);
				if(key != 'top' && key != 'left')
				$words[1].css(key, word.css[key]);
			}
		}
		
		function rearrangeWords() {
			var totalLeft = 0;
			var totalTop = 0;
			var totalRemaining = 0;
			$('.picture-board > .draggable-box').each(function(index, draggableBox){
				var text = $(draggableBox).text();
				$(draggableBox).css('left', totalLeft + 'px');
				$(draggableBox).css('top', totalTop + 'px');
				totalLeft += text.length * WORD_WIDTH + 20;
				if(totalLeft > 600) {
					totalLeft = 0;
					totalTop += 30;
				}
				totalRemaining++;
				
			});
			
			if(totalRemaining == wrongWords) {
				totalFinished++;
				dragNextGame();
			}
			
		}
		
		rearrangeWords();
		$( ".relative-box, .picture-board" ).droppable({
		  drop: function( event, ui ) {
			var $self = $(this);
			var $draggable = $(ui.draggable);
			if($self.attr('class') == $draggable.parent().attr('class')) {
				return false;
			}
			  
			
			if($self.hasClass('relative-box')) {
				$draggable.css({position: 'absolute', top: 0, left: 0});
				if($draggable.text() == $self.attr('rel')) {
					$self.append($draggable);
					
					//load audio true
					sound = new Audio('/Default/skin/nobel/test/themes/default/media/audio/Game-Spawn.mp3');
					sound.loop = false;	
					sound.play();
					rearrangeWords();
					//alert('Right!');
				} else {
					
					sound = new Audio('/Default/skin/nobel/test/themes/default/media/audio/Game-Break.mp3');
					sound.loop = false;	
					sound.play();
					rearrangeWords();
					//alert('Wrong! Try again!');
				}
				
			} else {
				$self.append($draggable);
				$draggable.css({position: 'absolute', top: 0, left: 0});
				rearrangeWords();
			}
		  }
		});
		
		this.click(function(evt) {
			if($(evt.target).hasClass('selected')) return true;
			$(this).find('.selected').removeClass('selected');
		});
	};
	var total = 0;
	$.fn.appendWord = function(word, top = 0, left = 0) {
		var $word = null; 
		if(!word.wrong) {
			$word = $('<div class="resizable-box" style="position: absolute; z-index: 1; font-family: '+FONT_FAMILY+'; font-size: '+FONT_SIZE+'px; left: '+left+'px; top: '+top+'px; width: '+(word.text.length * WORD_WIDTH)+'px; height: '+WORD_HEIGHT+'px" rel="'+word.text+'"><div class="relative-box" style="position: relative; font-family: '+FONT_FAMILY+'; font-size: '+FONT_SIZE+'px; width: '+(word.text.length * WORD_WIDTH)+'px; height: '+WORD_HEIGHT+'px" rel="'+word.text+'"></div></div>');	
			this.find('.picture-board').append($word);
		}
		
		
		var $word2 = null; 
		$word2 = $('<span class="draggable-box" style="position: absolute; z-index: 9;font-family: '+FONT_FAMILY+'; font-size: '+FONT_SIZE+'px; top: 0; left: '+total+'px">'+word.text+'</span>');
		total += (word.text.length * WORD_WIDTH) + 20;
		$word2.draggable({ containment: ".picture-board", scroll: false });
		this.find('.picture-board').append($word2);
		return [$word, $word2];
	};
	
	var games = <?php echo json_encode($data->getImagesAndWords());?>;
	function dragNextGame() {
		if(gameIndex < games.length - 1) {
			gameIndex++;
			dragRunGame(gameIndex);
		} else {
			$('#dragToPartGame').html('<h4>Finish Game: ' + totalFinished + '/' + games.length + ' missions completed!</h4>');
			$('#dragToPartGameNav').html('');
		}
		
	}
	function dragRunGame(index) {
		$('#dragToPartGame').html('');
		$('#dragToPartGame').dragToPartGame({words: games[gameIndex].words, src: games[gameIndex].src});
	}
	dragRunGame(gameIndex);
	
	
	</script>
	
<?php }else { ?>
	Chưa có dữ liệu
	<img class='item' src="<?php echo BASE_URL; ?>/Default/skin/nobel/test/themes/default/media/bg_game.jpg" />
<?php } ?>