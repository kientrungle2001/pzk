<?php 
$topics = array(
				array(
					"type" => "topic1",
					"name" => "topic 1"
				),
				array(
					"type" => "topic2",
					"name" => "topic 2"
				),
				array(
					"type" => "topic3",
					"name" => "topic 3"
				)
			);
			$words = array(
				array(
					"type" => "topic1",
					"name" => " topic 1"
				),
				array(
					"type" => "topic1",
					"name" => " topic 11"
				),
				array(
					"type" => "topic2",
					"name" => " topic 2"
				),
				array(
					"type" => "topic2",
					"name" => " topic 22"
				),
				array(
					"type" => "topic44",
					"name" => " topic 44"
				),
				array(
					"type" => "topic3",
					"name" => " topic 3"
				),
				array(
					"type" => "topic2",
					"name" => " topic 23"
				),
				array(
					"type" => "topic2",
					"name" => " topic 24"
				),
				array(
					"type" => "topic2",
					"name" => " topic 22"
				),
				array(
					"type" => "topic44",
					"name" => " topic 44"
				),
				array(
					"type" => "topic3",
					"name" => " topic 3"
				),
				array(
					"type" => "topic2",
					"name" => " topic 23"
				),
				array(
					"type" => "topic2",
					"name" => " topic 24"
				)
				,
				array(
					"type" => "topic44",
					"name" => " topic 44"
				),
				array(
					"type" => "topic3",
					"name" => " topic 3"
				),
				array(
					"type" => "topic2",
					"name" => " topic 23"
				),
				array(
					"type" => "topic2",
					"name" => " topic 24"
				)
				,
				array(
					"type" => "topic2",
					"name" => " topic 24"
				)
				,
				array(
					"type" => "topic44",
					"name" => " topic 44"
				),
				array(
					"type" => "topic3",
					"name" => " topic 3"
				),
				array(
					"type" => "topic2",
					"name" => " topic 23"
				),
				array(
					"type" => "topic2",
					"name" => " topic 24"
				)
				,
				array(
					"type" => "topic2",
					"name" => " topic 23"
				),
				array(
					"type" => "topic2",
					"name" => " topic 24"
				)
				
			);
			$jsTopics = json_encode($topics);
			$jsWords = json_encode($words);
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
	.dragtopic {
		float: left;
		margin: 5px;
		height: 100px;
		width: 100px;
		text-align: center;
		border: 1px solid red;
		line-height: 100px;
	}
</style>
<script>
	// random array
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
	
	// factory drag
	dragFactory = {
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
				this.game = new dragGame();
			}
			return this.game;
		},
		getBoard: function() {
			if(!this.board) {
				this.board = new dragBoard(3, 4);
			}
			return this.board;
		},
		getWords: function() {
			if(!this.words) {
				var pairs = [["M\u1eb9","\u00a0B\u1ea7m"],["Ch\u1ebft","Hy sinh"],["Chi\u1ebfu","Soi"],["Nh\u00ecn","Li\u1ebfc"],["Heo","L\u1ee3n",""],["Gan d\u1ea1","Can \u0111\u1ea3m"]];
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
				this.player = new dragPlayer('Noname', '20');
			}
			return this.player;
		},
		getPoint: function() {
			if(!this.point) {
				this.point = new dragPoint(0);
			}
			return this.point;
		},
		getLive: function() {
			if(!this.live) {
				this.live = new dragLive(3);
			}
			return this.live;
		},
		getTiming: function() {
			if(!this.timing) {
				this.timing = new dragTiming(0);
			}
			return this.timing;
		},
		getSound: function() {
			if(!this.sound) {
				this.sound = new dragSound(0);
			}
			return this.sound;
		}
	}
	
	dragGame = function() {
		
	};
	dragGame.prototype = {
		playing: false,
		startTime: 0,
		endTime: 0,
		init: function() {
			// Khởi tạo
			this.board = dragFactory.getBoard();
			//this.player = dragFactory.getPlayer();
			//this.point = dragFactory.getPoint();
			//this.live = dragFactory.getLive();
			//this.timing = dragFactory.getTiming();
			//this.sound = dragFactory.getSound();
			this.playing = false;
		},
		start: function() {
			//time start
			this.startTime = '<?=$_SERVER['REQUEST_TIME'];?>';
			// Khởi tạo bảng
			this.board.init();
			// Xóa điểm cũ đi
			//this.point.init();
			//this.timing.init();
			//this.live.init();
			
			this.board.display();
			//this.point.display();
			//this.live.display();
			//this.player.display();
			//this.timing.display();
			//this.sound.playing();
			this.playing = true;
		},
		begin: function() {
			this.board.notify('Bạn đã sẵn sàng chơi chưa?');
			this.board.addAction('Bắt đầu', function(){
				dragFactory.getGame().start();
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
			this.saveData();
			//this.board.addAction('Chơi lại', function(){
			//	dragFactory.getGame().begin();
			//});
			
		},
		over: function() {
			this.playing = false;
			this.board.notify('Rất tiếc, bạn đã thua cuộc');
			
			this.saveData();
			//this.board.addAction('Chơi lại', function(){
			//	dragFactory.getGame().begin();
			//});
		},
		saveData: function() {
			var score =  dragFactory.getPoint().value;
			var time = dragFactory.getTiming().value;
			this.endTime = parseInt(this.startTime) + parseInt(time);
			

			$.ajax({
					type: "Post",
					data:{time:time, score: score, startTime:this.startTime, endTime:this.endTime, lessonId, lessonType},
					url:'<?=BASE_REQUEST?>/form/saveWord',
					success: function(data){
							
					}
				});
			}
			
	};
	
	dragBoard = function(h, v){
		this.h = h;
		this.v = v;
	};

	dragBoard.prototype = {
		h:false,
		v: false,
		cells: false,
		init: function() {
			this.cells = dragFactory.getCells();
			var words = dragFactory.getWords();
			for(var i = 0; i < this.h; i++) {
				for(var j = 0; j < this.v; j++) {
					this.cells[i][j] = new Cell(i, j, words[i*this.v+j]);
				}
			}
			
		},
		display: function() {
			$('#dragBoard').html('');
			for(var i = 0; i < this.h; i++) {
				for(var j = 0; j < this.v; j++) {
					this.cells[i][j].display();
				}
				$('#dragBoard').append('<div class="clear"></div>');
			}
		},
		notify: function(text) {
			$('#dragBoard').html('<h1>'+text+'</h1>');
		},
		addAction(txt, callback) {
			var button = $('<button>'+txt+'</button>');
			button.click(callback);
			$('#dragBoard').append(button);
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
			$('#dragBoard').append('<div class="cell drag cell-'+this.x+'-'+this.y+'" ><div class="word">'+this.word.w+'</div></div>');
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
	
	dragPlayer = function(name, age) {
		this.name = name;
		this.age = age;
	};
	dragPlayer.prototype = {
		name: 'Huunv',
		age: 26,
		play: function(x, y) {
			var game = dragFactory.getGame();
			var cells = dragFactory.getCells();
			var selectedCell = cells[x][y];
			selectedCell.select();
			var prev = game.prev;
			
			if(prev) {
				if(selectedCell.match(prev)) {
					prev.hide();
					selectedCell.hide();
					if(dragFactory.getGame().isEnd()) {
						dragFactory.getGame().finish();
						
					}
				} else {
					prev.deselect();
					selectedCell.deselect();
					dragFactory.getLive().decrease();
					dragFactory.getLive().display();
					if(dragFactory.getGame().isOver()) {
						dragFactory.getGame().over();
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
	}

	dragScore = function(name, age) {
		this.name = name;
		this.age = age;
	};
	dragScore.prototype = {
		name: 'Huunv',
		age: 26,
	}

	dragTime = function(name, age) {
		this.name = name;
		this.age = age;
	};
	dragTime.prototype = {
		name: 'Huunv',
		age: 26,
	}

	dragLive = function(name, age) {
		this.name = name;
		this.age = age;
	};
	dragLive.prototype = {
		name: 'Huunv',
		age: 26,
	}
</script>

<div class = 'container' id='dragdrop'>
	<div class = 'row'>
		<div class = 'col-md-8 col-sm-8 col-xs-12'>
			<div id = 'dragPlayer'></div>
			<div id = 'dragScore'></div>
			<div id = 'dragLive'></div>
			<div id = 'dragTime'></div>
			<div id = 'dragBoard'></div> 
		</div>
		<div class='col-md-1 col-sm-2 col-xs-12'>
			<div >
				<div id = 'dragtopic' class = 'dragtopic'> topic 1 </div>
				
			</div>
		</div>
	</div>	
</div>

<script type="text/javascript">
	var game = dragFactory.getGame();
	//console.log(game);
	game.init();
	game.begin();
	game.start();
	
	
	$(function() {
		
	 
		// let the gallery items be draggable
		$( ".drag" ).draggable({
			
		});
		$('#dragtopic').data('outside',1).droppable({
			accept    : '.drag',
			out        : function(){
				$(this).data('outside',1);
			},
			over    : function(){
				$(this).data('outside',0);
			}
		});
		$('body').droppable({
			accept    : '.drag',
			drop    : function(event, ui){
				if($('#droppable').data('outside')==1){
					alert('Dropped outside!');
				}else{
					alert('Dropped inside!');
				}
			}
		});
		
	});
    	
</script>