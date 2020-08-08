<?php
	$questionId = pzk_request()->getGameTopic();
	
	$allwords = $data->getPairWords($questionId);
	
	$topics = $data->setTopics($allwords);
	$words = $data->setWords($allwords);
	if($topics) {
	shuffle($words);
	$jsTopics = json_encode($topics);
	$jsWords = json_encode($words);
?>
   <script src="https://code.createjs.com/createjs-2015.05.21.min.js"></script>
    
    <script>
		
		function playSound() {
				createjs.Sound.registerSound({src:BASE_URL+"/Default/skin/nobel/game/audio/M-GameBG.ogg", id:"sound"});
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
						var j = i % 5;
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
						var topic = new Topic(t.name, t.type, i*120+ 55);
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
				
				var that = this;
				Factorys.getBoard().init();
				
				Factorys.getBoard().display();
				
				
				this.timePlay = createjs.Ticker.on("tick", function () { that.checkEnd(); });
			},
			checkEnd: function() {
				//alert(1);
				
				var board = Factorys.getBoard();
				var timer = Factorys.getTime();
				var score = board.score;
				var live = board.live;
				var time = board.time;
				
				if(score == 18 ) {
					
					
					var txtScore = new createjs.Text("Congratulations! You have won!", "bold 16px Lato", "orange");
					txtScore.textAlign = "center";
					txtScore.x = 380;
					txtScore.y = 100;
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
					
					createjs.Ticker.removeAllEventListeners();
					
					
				}else if(live == 4) {
					
					
					var txtScore = new createjs.Text("You have exceeded wrong word limit!", "bold 16px Lato", "orange");
					txtScore.textAlign = "center";
					txtScore.x = 380;
					txtScore.y = 100;
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
				
					createjs.Ticker.removeAllEventListeners();
					
				}else if(time == 180) {
					this.endGame();
				}
			},
			endGame: function() {
				
				this.destroy = true;
				this.endTime = '<?=$_SERVER['REQUEST_TIME'];?>';
				var board = Factorys.getBoard();
				var txtScore = new createjs.Text("Time's up! ", "bold 16px Lato", "orange");
				txtScore.textAlign = "center";
				txtScore.x = 360;
				txtScore.y = 100;
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
			txtLive: null,
			appleFalse: [],
			score: 0,
			live: 0,
			time: 0,
			timePlay: false,
			txtTime: null,
			init: function() {
				this.canvas = document.getElementById('canvas');
                this.stage = new createjs.Stage(this.canvas);
				
				bitmap2 = new createjs.Bitmap(BASE_URL+"/Default/skin/test/game/images/cay.png");
                        bitmap2.x = 700;
                        bitmap2.y = 0;
                        this.stage.addChild(bitmap2);
				
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
				this.displayGreenApple();
				this.displayScore();
				this.displayLive();
				this.displayTime();
				this.stage.update();
			},
			//sound
			soundFalse: function () {
				createjs.Sound.alternateExtensions = ["mp3"];
				createjs.Sound.registerSound(BASE_URL+"/Default/skin/nobel/game/audio/Game-Break.ogg", "sound2");

			},
			//sound
			soundTrue: function () {
				createjs.Sound.alternateExtensions = ["mp3"];
				createjs.Sound.registerSound(BASE_URL+"/Default/skin/nobel/game/audio/Game-Spawn.ogg", "sound1");

			},
			soundBg: function() {
				that = this;
				createjs.Sound.addEventListener("fileload", function() {
					that.soundBd = createjs.Sound.registerSound({src:BASE_URL+"/Default/skin/nobel/game/audio/M-GameBG.ogg", id:"sound"});
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
			displayGreenApple:function() {
				apple1 = new createjs.Bitmap(BASE_URL+"/Default/skin/test/game/images/green-apple.png");
				apple1.x = 863;
				apple1.y = 260;
				this.stage.addChild(apple1);
				this.appleFalse.push(apple1);
				
				apple2 = new createjs.Bitmap(BASE_URL+"/Default/skin/test/game/images/green-apple.png");	
				apple2.x = 896;
				apple2.y = 260;
				this.stage.addChild(apple2);
				this.appleFalse.push(apple2);
				
				apple3 = new createjs.Bitmap(BASE_URL+"/Default/skin/test/game/images/green-apple.png");	
				apple3.x = 929;
				apple3.y = 260;
				this.stage.addChild(apple3);
				this.appleFalse.push(apple3);
				
				apple4 = new createjs.Bitmap(BASE_URL+"/Default/skin/test/game/images/green-apple.png");	
				apple4.x = 962;
				apple4.y = 260;
				this.stage.addChild(apple4);
				this.appleFalse.push(apple4);				
			},
			displayScore: function () {
				this.txtScore = new createjs.Text("Correct words: 0", "bold 16px Lato", "orange");
				this.txtScore.textAlign = "center";
				this.txtScore.x = 100;
				this.txtScore.y = 15;
				this.stage.addChild(this.txtScore);
				
			},
			displayLive: function () {
				this.txtLive = new createjs.Text("Wrong words : 0", "bold 16px Lato", "orange");
				this.txtLive.textAlign = "center";
				this.txtLive.x = 650;
				this.txtLive.y = 15;
				this.stage.addChild(this.txtLive);
				
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
				this.time = time;
				this.stage.removeChild(this.txtTime);
				this.txtTime = new createjs.Text("Time: "+time, "bold 16px Lato", "orange");
				this.txtTime.textAlign = "center";
				this.txtTime.x = 375;
				this.txtTime.y = 15;
				
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
			var label = new createjs.Text(txt, "14px Lato", "orange");
			label.textAlign="center";
			label.x += 50;
			label.y += 40;
			var circle = new createjs.Shape();
			circle.graphics.setStrokeStyle(1).beginStroke("#ffca65").beginFill("white").drawRect(0,0, 100, 100);

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
			apples:[],
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
							score.addApple();
							apple = new createjs.Bitmap(BASE_URL+"/Default/skin/test/game/images/images.png");						
							
							var items = [
										[830,45],[860,75],[890,45], [920,75], [950,45], [980,75], [1010,45],
										[800, 135],[860, 135],[890,105],[920,135],[950,105],[980, 135],[1010,105],
										[1040,135],[830,165],[890,165],[950,165],[1110,165]
										];
							
							var j = score.apple-1;
							
							
							apple.x = items[j][0];
							apple.y = items[j][1];
							
							board.stage.addChild(apple);
							
									
							
							score.addScore();
							
							var nscore = score.score;
							var txtScore = new createjs.Text("Correct words: "+score.score, "bold 16px Lato", "orange");
							txtScore.textAlign = "center";
							txtScore.x = 100;
							txtScore.y = 15;
							board.score = score.score;
							board.stage.removeChild(board.txtScore);
							board.txtScore = txtScore;
							board.stage.addChild(txtScore);
							
							
						}else {
							if(this.x > 550) {
								board.live = board.live + 1;
								var score = Factorys.getScore();
								
								var nscore = score.score;
								var txtScore = new createjs.Text("Correct words: "+score.score, "bold 16px Lato", "orange");
								txtScore.textAlign = "center";
								txtScore.x = 100;
								txtScore.y = 15;
								board.score = score.score;
								board.stage.removeChild(board.txtScore);
								board.txtScore = txtScore;
								board.stage.addChild(txtScore);
								
								
								apple = board.appleFalse[0];
								//apple.x = 800 - score.fapple*25;
								//apple.y = 450;
								board.stage.removeChild(apple);
								
								board.appleFalse.shift();
								
								
								
								
								var txtLive = new createjs.Text("Wrong words : "+board.live, "bold 16px Lato", "orange");
								txtLive.textAlign = "center";
								txtLive.x = 650;
								txtLive.y = 15;
								
								board.stage.removeChild(board.txtLive);
								board.txtLive = txtLive;
								board.stage.addChild(txtLive);
								
								createjs.Sound.play("sound2");
							}
							this.x = this.homeX;
							this.y = this.homeY;
							
						}
					
					}else {
						if(this.x > 500){
							board.live = board.live + 1;
							var score = Factorys.getScore();
							var nscore = score.score;
							var txtScore = new createjs.Text("Correct words: "+score.score, "bold 16px Lato", "orange");
							txtScore.textAlign = "center";
							txtScore.x = 100;
							txtScore.y = 15;
							board.score = score.score;
							board.stage.removeChild(board.txtScore);
							board.txtScore = txtScore;
							board.stage.addChild(txtScore);
							
							
							apple = board.appleFalse[0];
							//apple.x = 800 - score.fapple*25;
							//apple.y = 450;
							board.stage.removeChild(apple);
							board.appleFalse.shift();
						
						
							var txtLive = new createjs.Text("Wrong words : "+board.live, "bold 16px Lato", "orange");
								txtLive.textAlign = "center";
								txtLive.x = 650;
								txtLive.y = 15;
								
								board.stage.removeChild(board.txtLive);
								board.txtLive = txtLive;
								board.stage.addChild(txtLive);
							
							createjs.Sound.play("sound2");
						}
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
				var label2 = new createjs.Text(txt, "bold 14px Lato", "orange");
				label2.textAlign = "center";
				label2.x += 50;
				label2.y += 40;

				var box = new createjs.Shape();
				box.graphics.setStrokeStyle(2).beginStroke("orange").rect(0, 0, Factorys.topicHeight, Factorys.topicWidth);
				var topic = new createjs.Container();
				topic.x = 650;
				topic.y = height;
						
				topic.addChild(box, label2);
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
			apple: 0,
			napple: 0,
			fapple: 0,
			addScore: function() {
				this.score ++;
			},
			subScore:function() {
				this.score --;
			},
			addApple: function() {
				this.apple ++;
			},
			addNapple: function() {
				this.napple ++;
			},
			resApple: function() {
				this.apple = 0;
			},
			addFapple: function() {
				this.fapple ++;
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
				this.value = 1;
			
			},
			getTime: function() {
				return this.value;
			}
		};

		$(function() {
			Factorys.getGame().start();
			
			//resize canvas
			//resize canvas
			/*var w = $('#resultLesson').width();
				if( w > 1140) {
					$('#canvas').width(1140);
				}else {
					$('#canvas').width(w);
				}	
			
			$(window).resize(function() {
				var w = $('#resultLesson').width();
				if( w > 1140) {
					$('#canvas').width(1140);
				}else {
					$('#canvas').width(w);
				}		
				
			});*/
				
		});	
    </script>
	<style>
		.bggame{background: #f5f5f5; border-radius: 5px; background: url('<?=BASE_URL."/Default/skin/test/game/images/test_bg3.jpg"?>');background-size: cover;}
		.bdrd5{border-radius: 5px;}
		

	</style>
<div class='container'>
	<div id='resultLesson' class='item bggame mgb15'>	
		<canvas style='width: 100% !important;'  id="canvas" width="1150" height="500"></canvas> 
	</div>
	
</div>
<?php } else { ?>
Chưa có dữ liệu
<?php } ?>