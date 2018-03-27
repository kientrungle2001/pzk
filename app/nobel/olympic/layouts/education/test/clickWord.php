<?php
	$pairs = $data->getClickWord();
	
	//debug(json_encode($pairs));die();
	if($pairs) {
?>
<style type="text/css">
	.cell {
		float: left;
		width: 100px;
		height: 100px;
		text-align: center;
		border: 1px solid black;
		margin: 5px;
		border-radius: 50px;
	}
	.cell .word {
		padding-top: 40px;
	}
	.clear {
		clear: both;
	}
</style>
<script type="text/javascript">
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
Factory = {
	game: false,
	board: false,
	words: false,
	cells: false,
	point: false,
	player: false,
	live: false,
	timing: false,
	sound: false,
	getGame: function() {
		if(!this.game) {
			this.game = new Game();
		}
		return this.game;
	},
	getBoard: function() {
		if(!this.board) {
			this.board = new Board(3, 4);
		}
		return this.board;
	},
	getWords: function() {
		if(!this.words) {
			var pairs = <?php echo json_encode($pairs); ?>;
			var h = this.getBoard().h;
			var v = this.getBoard().v;
			this.words = new Array(h * v);
			for(var k = 0; k < this.words.length/2; k++) {
				this.words[2 * k] = new Word(pairs[k][0], pairs[k][1]);	
				this.words[2 * k + 1] = new Word(pairs[k][1], pairs[k][0]);
			}
			this.words.shuffle();
		}
		return this.words;
	},
	getCells: function() {
		if(!this.cells) {
			var h = this.getBoard().h;
			var v = this.getBoard().v;
			this.cells = new Array(h);
			
			for(var i = 0; i < h; i++) {
				this.cells[i] = new Array(v);
			}	
		}
		return this.cells;
	},
	getPlayer: function() {
		if(!this.player) {
			this.player = new Player('Noname', '20');
		}
		return this.player;
	},
	getPoint: function() {
		if(!this.point) {
			this.point = new Point(0);
		}
		return this.point;
	},
	getLive: function() {
		if(!this.live) {
			this.live = new Live(3);
		}
		return this.live;
	},
	getTiming: function() {
		if(!this.timing) {
			this.timing = new Timing(0);
		}
		return this.timing;
	},
	getSound: function() {
		if(!this.sound) {
			this.sound = new Sound(0);
		}
		return this.sound;
	}
}

Game = function(){
	
};
Game.prototype = {
	playing: false,
	startTime: 0,
	endTime: 0,
	init: function() {
		// Khởi tạo
		this.board = Factory.getBoard();
		this.point = Factory.getPoint();
		this.player = Factory.getPlayer();
		this.live = Factory.getLive();
		this.timing = Factory.getTiming();
		this.sound = Factory.getSound();
		this.playing = false;
	},
	start: function() {
		//time start
		this.startTime = '<?=$_SERVER['REQUEST_TIME'];?>';
		// Khởi tạo bảng
		this.board.init();
		// Xóa điểm cũ đi
		this.point.init();
		this.timing.init();
		this.live.init();
		
		this.board.display();
		this.point.display();
		this.live.display();
		this.player.display();
		this.timing.display();
		this.sound.playing();
		this.playing = true;
	},
	begin: function() {
		this.board.notify('Bạn đã sẵn sàng chơi chưa?');
		this.board.addAction('Bắt đầu', function(){
			Factory.getGame().start();
		});
	},
	isEnd: function() {
		return this.point.value >= this.board.h * this.board.v / 2; 
	},
	isOver: function() {
		return this.live.value <=0;
	},
	finish: function() {
		this.playing = false;
		this.board.notify('Chúc mừng bạn đã thắng trong cuộc thi này');
		this.saveScore();
		//this.board.addAction('Chơi lại', function(){
		//	Factory.getGame().begin();
		//});
		
	},
	over: function() {
		this.playing = false;
		this.board.notify('Rất tiếc, bạn đã thua cuộc');
		this.saveScore();
		
		//this.board.addAction('Chơi lại', function(){
		//	Factory.getGame().begin();
		//});
	},
	destroyPlayer: function() {
		this.playing = false;
		this.board.notify('Đã nộp bài');
		this.saveScore();
	},
	saveScore: function() {
		var score =  Factory.getPoint().value;
		$('input#clickScore').val(score);
	}
};
Board = function(h, v){
	this.h = h;
	this.v = v;
};

Board.prototype = {
	h:false,
	v: false,
	cells: false,
	init: function() {
		this.cells = Factory.getCells();
		var words = Factory.getWords();
		for(var i = 0; i < this.h; i++) {
			for(var j = 0; j < this.v; j++) {
				this.cells[i][j] = new Cell(i, j, words[i*this.v+j]);
			}
		}
		
	},
	display: function() {
		$('#board').html('');
		for(var i = 0; i < this.h; i++) {
			for(var j = 0; j < this.v; j++) {
				this.cells[i][j].display();
			}
			$('#board').append('<div class="clear"></div>');
		}
	},
	notify: function(text) {
		$('#board').html('<h1>'+text+'</h1>');
	},
	addAction(txt, callback) {
		var button = $('<button>'+txt+'</button>');
		button.click(callback);
		$('#board').append(button);
	}
};
Cell = function(x, y, w){
	this.word = w;
	this.x = x;
	this.y = y;
};
Cell.prototype = {
	show: function() {
		$('.cell-'+this.x+'-'+this.y).css({opacity: 0, visibility: "visible"}).animate({opacity: 1}, 'slow');
	},
	hide: function() {
		$('.cell-'+this.x+'-'+this.y).css({opacity: 1, visibility: "visible"}).animate({opacity: 0}, 'slow');
	},
	display: function() {
		$('#board').append('<div class="cell cell-'+this.x+'-'+this.y+'" onclick="Factory.getPlayer().play('+this.x+','+this.y+')"><div class="word">'+this.word.w+'</div></div>');
	},
	select: function() {
		$('.cell-'+this.x+'-'+this.y).css('border', '1px solid blue');
	},
	deselect: function() {
		$('.cell-'+this.x+'-'+this.y).css('border', '1px solid black');
	},
	match: function(c) {
		return c.word.match(this.word);
	}
};
Word = function(w, m){
	this.m = m;
	this.w = w;
};
Word.prototype = {
	match: function(w) {
		return this.m == w.w;
	}
};
Player = function(name, age) {
	this.name = name;
	this.age = age;
};
Player.prototype = {
	name: 'Lê Trung Kiên',
	age: 30,
	play: function(x, y) {
		var game = Factory.getGame();
		var cells = Factory.getCells();
		var selectedCell = cells[x][y];
		selectedCell.select();
		var prev = game.prev;
		var sound = Factory.getSound();
		if(prev) {
			if(selectedCell.match(prev)) {
				sound.success();
				Factory.getPoint().increase();
				Factory.getPoint().display();
				prev.hide();
				selectedCell.hide();
				if(Factory.getGame().isEnd()) {
					Factory.getGame().finish();
					sound.stop();
					sound.endSuccess();
				}
			} else {
				sound.fail();
				prev.deselect();
				selectedCell.deselect();
				Factory.getLive().decrease();
				Factory.getLive().display();
				if(Factory.getGame().isOver()) {
					sound.stop();
					sound.endFail();
					Factory.getGame().over();
				}
			}
			game.prev = null;
		} else {
			game.prev = selectedCell;
		}
	},
	display: function() {
		$('#clickWordPlayer').html('<strong>Người chơi: </strong><span>'+this.name+'</span> - <strong>Tuổi: </strong><span>'+this.age+'</span>');
	}
};
Point = function(value) {
	this.value = value;
};
Point.prototype = {
	value: false,
	init: function() {
		this.value = 0;
	},
	display: function() {
		$('#point').html('<strong>Điểm: </strong><span>'+this.value+'</span>');
	},
	increase: function() {
		this.value++;
	}
};

Live = function(value) {
	this.value = value;
};
Live.prototype = {
	value: false,
	init: function() {
		this.value = 4;
	},
	display: function() {
		$('#live').html('<strong>Số mạng: </strong><span>'+this.value+'</span>');
	},
	decrease: function() {
		this.value--;
	}
};

Timing = function(value) {
	this.value = value;
};
Timing.prototype = {
	value: false,
	init: function() {
		this.value = 1;
	},
	display: function() {
		var that = this;
		$('#timing').html('<strong>Thời gian: </strong><span>'+that.value+'</span>');
		that.id = setInterval(function() {
			$('#timing').html('<strong>Thời gian: </strong><span>'+that.value+'</span>');
			that.increase();
			if(Factory.getGame().playing == false) {
				clearInterval(that.id);
			}
		}, 1000);
		
	},
	clearTime: function() {
		clearInterval(this.id);
	},
	increase: function() {
		this.value++;
	}
};
Sound = function() {
	
};

Sound.prototype = {
	background: false,
	success: function() {
		var sound = new Audio('109663__grunz__success-low.wav');
		sound.play();
	},
	fail: function() {
		var sound = new Audio('249616__vincentm400__function-fail.mp3');
		sound.play();
	},
	playing: function() {
		if(!this.background) {
			var sound = new Audio('265549__vikuserro__cheap-flash-game-tune.mp3');
			sound.loop = true;
			sound.volume = 0.2;
			this.background = sound;
		}
		this.background.play();
	},
	stop: function() {
		//CountDown.Pause();
		this.background.pause();
	},
	endFail: function() {
		var sound = new Audio('135831__davidbain__end-game-fail.wav');
		sound.play();
	},
	endSuccess: function() {
		var sound = new Audio('166540__qubodup__success-quest-complete-rpg-sound.flac');
		sound.play();
		sound.play();
	}
};
</script>
<div class = 'mgb15' id="game">
	<!-- div id="clickWordPlayer" class="hidden"></div -->
	<div id="point"></div>
	<div id="live" class="hidden"></div>
	<div id="timing" class="hidden"></div>
	<div id="board"></div>
	<input id='clickScore' type='hidden' name ='clickScore' />
</div>
<script type="text/javascript">
	var game = Factory.getGame();
	game.init();
	game.begin();
	game.start();
</script>
	<?php } else { ?>
		Chưa có dữ liệu
	<?php } ?>