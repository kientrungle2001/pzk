<?php
	$lessonId = $data->getLessonId();
	$rootCateId = $data->getRootcateId();
	$lessonType = $data->getLessonType();
	
	$topics = $data->setTopics();
	$words = $data->setWords();
	if($topics) {
	shuffle($words);
	$jsTopics = json_encode($topics);
	$jsWords = json_encode($words);
?>
   
    
    <script>
		
		function playSound() {
				createjs.Sound.registerSound({src:BASE_URL+"/default/skin/nobel/game/audio/M-GameBG.ogg", id:"sound"});
				createjs.Sound.play("sound");
			}
		Factorys = {
			dragRadius: 40,
			topicHeight: 100,
			topicWidth: 100,
			game: false,
			score: false,
			time: false,
			cells: false,
			board: false,
			topics: false,
			
			getGame: function() {
				if(!this.game) {
					this.game = new Game();
				}
				return this.game;
			},
			getBoard: function() {
				if(!this.board) {
					this.board = new Board();
				}
				return this.board;
			},
			getScore: function() {
				if(!this.score) {
					this.score = new Score();
				}
				return this.score;
			},
			getTime: function() {
				if(!this.time) {
					this.time = new Time();
				}
				return this.time;
			},
			getCells: function () {
				if(!this.cells) {
					dataWords = <?php echo $jsWords; ?>;
					this.cells = [];
					var h = 0;
					for(var i = 0; i < dataWords.length; i++) {
						var j = i % 6;
						if(j == 0){
							h++;
						}
						
						tam = dataWords[i];
						var cell = new Cell(tam.name, tam.type, j*110 + 50, 110*h - 60);
						this.cells.push(cell);
					}	
				}
				//console.log(this.cells);		
				return this.cells;
			},
			getTopics: function () {
				if(!this.topics) {
					var dataTopics = <?php echo $jsTopics; ?>;
					this.topics = [];
					for(var i = 0; i<dataTopics.length; i++) {
						var t = dataTopics[i];
						var topic = new Topic(t.name, t.type, i*120+ 10);
						this.topics.push(topic);
					}
				}
				return this.topics;
			}
			
		};
	
		//class game
		Game = function() {
			
		};
		Game.prototype = {
			destroy: false,
			timePlay: false,
			startTime: 0,
			endTime: 0,
			start: function() {
				this.startTime = '<?=$_SERVER['REQUEST_TIME'];?>';
				var that = this;
				Factorys.getBoard().init();
				Factorys.getBoard().display();
				//count time	
				Factorys.getTime().count();
				
				this.timePlay = createjs.Ticker.on("tick", function () { that.checkEnd(); });
			},
			checkEnd: function() {
				//alert(1);
				
				var board = Factorys.getBoard();
				var timer = Factorys.getTime();
				var score = board.score;
				var live = board.live;
				
				if(score == 10 ) {
					
					CountDown.Pause();
					
					var txtScore = new createjs.Text("qua bai", "bold 16px Lato", "orange");
					txtScore.textAlign = "center";
					txtScore.x = 100;
					txtScore.y = 8;
					board.stage.removeChild(board.txtMes);
					board.txtMes = txtScore;
					board.stage.addChild(txtScore); 
					//xoa cell
					var cells = Factorys.getCells();
					for(var i = 0; i < cells.length; i++) {
						board.stage.removeChild(cells[i].shapes[i]);
					}
					board.stage.update();
					var score = board.score;
					var time = timer.value;
					this.endTime = parseInt(this.startTime) + parseInt(time);
					timer.stopCount();
					var lessonId = '<?php echo $lessonId; ?>';
					var lessonType = '<?php echo $lessonType; ?>';
					this.saveData(score, time, this.startTime, this.endTime, lessonId, lessonType);
					createjs.Ticker.removeAllEventListeners();
					
					
				}else if(live == 4) {
					
					CountDown.Pause();
					var txtScore = new createjs.Text("lam sai", "bold 16px Lato", "orange");
					txtScore.textAlign = "center";
					txtScore.x = 100;
					txtScore.y = 8;
					board.stage.removeChild(board.txtMes);
					board.txtMes = txtScore;
					
					board.stage.addChild(txtScore); 
					//xoa cell
					var cells = Factorys.getCells();
					for(var i = 0; i < cells.length; i++) {
						board.stage.removeChild(cells[i].shapes[i]);
					}
					board.stage.update();
					
					var score = board.score;
					var time = timer.value;
					this.endTime = parseInt(this.startTime) + parseInt(time);
					timer.stopCount();
					var lessonId = '<?php echo $lessonId; ?>';
					var lessonType = '<?php echo $lessonType; ?>';
					this.saveData(score, time, this.startTime, this.endTime, lessonId, lessonType);
					createjs.Ticker.removeAllEventListeners();
					
				}
			},
			endGame: function() {
				
				this.destroy = true;
				this.endTime = '<?=$_SERVER['REQUEST_TIME'];?>';
				var board = Factorys.getBoard();
				var txtScore = new createjs.Text("Het time lam bai", "bold 16px Lato", "orange");
				txtScore.textAlign = "center";
				txtScore.x = 200;
				txtScore.y = 8;
				board.stage.removeChild(board.txtMes);
				board.txtMes = txtScore;
				board.stage.addChild(txtScore); 
				//xoa cell
				var cells = Factorys.getCells();
				for(var i = 0; i < cells.length; i++) {
					board.stage.removeChild(cells[i].shapes[i]);
				}
				board.stage.update();
				var score = board.score;
				var time = timer.value;
				this.endTime = parseInt(this.startTime) + parseInt(time);
				timer.stopCount();
				var lessonId = '<?php echo $lessonId; ?>';
				var lessonType = '<?php echo $lessonType; ?>';
				this.saveData(score, time, this.startTime, this.endTime, lessonId, lessonType);
				createjs.Ticker.removeAllEventListeners();
			},
			saveData: function(score, time, startTime, endTime, lessonId, lessonType) {
				$.ajax({
		              	type: "Post",
			            data:{time:time, score: score, startTime:startTime, endTime:endTime, lessonId, lessonType},
			            url:'<?=BASE_REQUEST?>/form/saveWord',
			            success: function(data){
			            	
			           	}
		            });
			}
		};
		
		//class Board
		Board = function() {
			
		};
		Board.prototype = {
			stage:null, 
			canvas:null,
			soundBd: false,
			cells: null,
			topics: null,
			txtScore: null,
			txtMes: null,
			score: 0,
			live: 0,
			time: 0,
			timePlay: false,
			txtTime: null,
			init: function() {
				this.canvas = document.getElementById('canvas');
                this.stage = new createjs.Stage(this.canvas);
				
				
                this.stage.enableMouseOver();
				//outside
				this.stage.mouseMoveOutside = true;
				//enable touch
				createjs.Touch.enable(this.stage);
				
				//sound
				this.soundTrue();
				this.soundFalse();
				//this.soundBg();
				
				var cells = Factorys.getCells();
				this.cells = cells;
				
				var topics = Factorys.getTopics();
				this.topics = topics;
				
				
				//console.log(timer.value);	
			},
			display: function() {
				//that = this;
				
				this.displayShapes();
				this.displayTopics();
				this.displayScore();
				//this.displayTime();
				this.stage.update();
			},
			//sound
			soundFalse: function () {
				createjs.Sound.alternateExtensions = ["mp3"];
				createjs.Sound.registerSound(BASE_URL+"/default/skin/nobel/game/audio/Game-Break.ogg", "sound2");

			},
			//sound
			soundTrue: function () {
				createjs.Sound.alternateExtensions = ["mp3"];
				createjs.Sound.registerSound(BASE_URL+"/default/skin/nobel/game/audio/Game-Spawn.ogg", "sound1");

			},
			soundBg: function() {
				that = this;
				createjs.Sound.addEventListener("fileload", function() {
					that.soundBd = createjs.Sound.registerSound({src:BASE_URL+"/default/skin/nobel/game/audio/M-GameBG.ogg", id:"sound"});
					createjs.Sound.play("sound");
			
				});
				
				
			},
			
			displayShapes: function () {
				that = this;
				for(var i = 0; i < this.cells.length; i++) {
					this.cells[i].drag(i);
					this.stage.addChild(this.cells[i].shapes[i]);
				}
				
			},
			displayTopics: function() {
				for(var i = 0; i < this.topics.length; i++) {
					this.stage.addChild(this.topics[i].topic);
				}
				
			},
			displayScore: function () {
				this.txtScore = new createjs.Text("Score: 0", "bold 16px Lato", "orange");
				this.txtScore.textAlign = "center";
				this.txtScore.x = 40;
				this.txtScore.y = 8;
				this.stage.addChild(this.txtScore);
				
			},
			displayTime: function () {
				var that = this;
				var timer = Factorys.getTime();
				timer.count();
	
				this.timePlay = createjs.Ticker.on("tick", function () { that.callTime(); });
			},
			callTime: function() {
				timer = Factorys.getTime();
				var time = timer.value;
				this.stage.removeChild(this.txtTime);
				this.txtTime = new createjs.Text("Time: "+time, "bold 16px Lato", "orange");
				this.txtTime.textAlign = "center";
				this.txtTime.x = 200;
				this.txtTime.y = 8;
				
				this.stage.addChild(this.txtTime);
				this.stage.update();
			},
			buttonSound: function() {
				var imageUnchecked = new createjs.Bitmap('checkboxen.jpg');
				imageUnchecked.sourceRect = new createjs.Rectangle(0, 0, 34, 29);

				var imageChecked = new createjs.Bitmap('checkboxen.jpg');
				imageChecked.sourceRect = new createjs.Rectangle(34, 0, 34, 29);
			}	
		
		};
		//class cell
		Cell = function(txt, type, width, height) {
			var label = new createjs.Text(txt, "14px Lato", "#fff");
			label.textAlign="center";
			label.x += 50;
			label.y += 40;
			var circle = new createjs.Shape();
			circle.graphics.setStrokeStyle(2).beginStroke("black").beginFill("red").drawRect(0,0, 100, 100);

			var shape = new createjs.Container();
			shape.homeX = width;//Math.random() * (650 - 20) + 20;
			shape.homeY = height;//Math.random() * (500 - 20) + 2;
			shape.x = shape.homeX;
			shape.y = shape.homeY;
			shape.type = type;
			shape.addChild(circle, label);
			//shape.setBounds(100, 100, Factorys.dragRadius*2, Factorys.dragRadius*2);
			this.shapes.push(shape);
			
		};
		Cell.prototype = {
			shapes: [],
			drag: function(i) {
				var that = this;
				var board = Factorys.getBoard();
				this.shapes[i].on("pressmove", function(evt) {
				
					this.x = evt.stageX;
					this.y = evt.stageY;
					board.stage.update();
					
					
				});
				
				//khi nguoi dung bo drag
				this.shapes[i].on("pressup", function (evt) {
					//var that4 = this;
					//console.log(that);
					var board = Factorys.getBoard();
					//dragger = this;//evt.currentTarget;
					
					
					var type = this.type; 
					
					objtopics = Factorys.getTopics();
					
					var objtopic = false;
					for(var i = 0; i < objtopics.length; i++) {
						if(objtopics[i].type == type) {
							objtopic = objtopics[i].topic;
							break;
						}
					}
					if(objtopic) {
						if (that.check(this, objtopic)) {
							createjs.Sound.play("sound1");
							this.off("pressmove", this);
							//dragger.removeEventListener("pressmove");
							board.stage.removeChild(this);
							var score = Factorys.getScore();		
							score.addScore();
							
							var txtScore = new createjs.Text("Score: "+score.score, "bold 16px Lato", "orange");
							txtScore.textAlign = "center";
							txtScore.x = 40;
							txtScore.y = 8;
							board.score = score.score;
							board.stage.removeChild(board.txtScore);
							board.txtScore = txtScore;
							board.stage.addChild(txtScore);
							
						}else {
							board.live = board.live + 1;
							createjs.Sound.play("sound2");
							this.x = this.homeX;
							this.y = this.homeY;
							
						}
					
					}else {
						board.live = board.live + 1;
						createjs.Sound.play("sound2");
						this.x = this.homeX;
						this.y = this.homeY;
					}
					board.stage.update();
					
				});
	
				
			},
			check: function(obj1,obj2) {
				  var pt = obj1.globalToLocal(obj2.x, obj2.y);
				  var h1 = -50;
				  var h2 = 50;
				  var w1 = -100;
				  var w2 = 100;
				  
				  if(pt.x > w2 || pt.x < w1) return false;
				  if(pt.y > h2 || pt.y < h1) return false;
				  
				  return true;
			}
			
		};
		
		//class topic
		Topic = function (txt, type, height) {
				var label2 = new createjs.Text(txt, "bold 14px Lato", "#000");
				label2.textAlign = "center";
				label2.x += 50;
				label2.y += 40;

				var box = new createjs.Shape();
				box.graphics.setStrokeStyle(2).beginStroke("black").rect(0, 0, Factorys.topicHeight, Factorys.topicWidth);
				var topic = new createjs.Container();
				topic.x = 768;
				topic.y = height;
						
				topic.addChild(label2, box);
				this.topic = topic;
				this.type = type;
		};
		Topic.prototype = {
			topic: null,
			type: null,
			
		};
		
		//class Score
		Score = function () {
			
		};
		Score.prototype = {
			score: 0,
			addScore: function() {
				this.score ++;
			}
		};
		
		//class Time
		Time = function() {
			
		};
		Time.prototype = {
			value: 1,
			id: false,
			count: function() {
				that = this;
				that.id = setInterval(function() {
					that.value ++;
					
				}, 1000);
			},
			stopCount: function() {
				
				clearInterval(this.id);
			
			},
			getTime: function() {
				return this.value;
			}
		};

		$(function() {
			Factorys.getGame().start();
			
			//resize canvas
			//resize canvas
			var w = $('#resultLesson').width();
				if( w > 870) {
					$('#canvas').width(870);
				}else {
					$('#canvas').width(w);
				}	
			
			$(window).resize(function() {
				var w = $('#resultLesson').width();
				if( w > 870) {
					$('#canvas').width(870);
				}else {
					$('#canvas').width(w);
				}		
				
			});
				
		});	
    </script>
	
<div>
    <canvas id="canvas" width="870" height="500"></canvas> 
</div>
<?php } else { ?>
Chưa có dữ liệu
<?php } ?>