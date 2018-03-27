 
 <?php
	$documentId = $data->get('documentId');
	$gameCode = $data->get('gameCode');
	$cateId = $data->get('cateId');
	
	$allwords = $data->getPairWords($documentId, $gameCode);
	if($allwords) {
		$arrWords = array();
		foreach($allwords as $val){
			$arrWords = array_merge($arrWords,$val);
		}
		
		$allTrueWord = $data->getAllTopic($arrWords);
		
	//shuffle($allwords);
	$mutilData = array();
	foreach($allwords as $key => $item) {
		$topics = $data->setTopics($item);
		$words = $data->setWords($item);
		shuffle($words);
		$jsTopics = json_encode($topics);
		$jsWords = json_encode($words);
		
		$mutilData[$key]['topic'] = $jsTopics;
		$mutilData[$key]['word'] = $jsWords;
	}
	$countStage = count($mutilData);
	$page = 0;
	if($data->get('pageGame')) {
		$page = $data->get('pageGame')- 1;
	}
	
	if(isset($mutilData[$page]['topic']) && isset($mutilData[$page]['word'])) {
?>
   
    
    <script>
		var finish = false;
		function playSound() {
				createjs.Sound.registerSound({src:BASE_URL+"/Default/skin/nobel/game/audio/M-GameBG.ogg", id:"sound"});
				createjs.Sound.play("sound");
			}	
		Factorys = {
			dragRadius: 40,
			topicHeight: 100,
			topicWidth: 50,
			game: false,
			score: false,
			time: false,
			cells: false,
			board: false,
			topics: false,
			page: false,
			
			getPage: function() {
				if(!this.page) {
					this.page = new Page();
				}
				return this.page;
			},
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
					dataWords = <?php echo $mutilData[$page]['word']; ?>; 
					
					this.cells = [];
					var h = 0;
					for(var i = 0; i < dataWords.length; i++) {
						
						tam = dataWords[i];
						var cell = new Cell(tam.name, tam.type, 45, 60*i + 58);
						this.cells.push(cell);
					}	
				}
				
				return this.cells;
			},
			getTopics: function () {
				if(!this.topics) {
					var dataTopics = <?php echo $mutilData[$page]['topic'];?>;
					this.topics = [];
					for(var i = 0; i<dataTopics.length; i++) {
						var t = dataTopics[i];
						var topic = new Topic(t.name, t.type, i);
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
			timeCheck: false,
			startTime: 0,
			endTime: 0,
			start: function() {
				
				if (typeof timer != 'undefined') {

					timer.stopCount();
				}
			
				var that = this;
				Factorys.getBoard().init();
				
				Factorys.getBoard().display();
				
				this.timeCheck = createjs.Ticker.on("tick", function () { that.checkEnd(); });
			},
			checkEnd: function() {
				//alert(1);
				
				var board = Factorys.getBoard();
				var timer = Factorys.getTime();
				var score = board.score;
				var live = board.live;
				var time = board.time;
				
				if(score == 6 ) {
					var pageGame = $('#pageGame').val();
					if(pageGame < <?php echo $countStage; ?>){
						board.boardAlertMes("Congratulations! You have won!", 380, 100);
					}
					
					board.removeCells();
					board.clearTime();
					
					var score = board.score;
					var time = timer.value;
					this.endTime = parseInt(this.startTime) + parseInt(time);
					timer.stopCount();
				
					gameScoreByPage[pageGame-1] = score;
					trueWordByPages[pageGame-1] = board.trueWords;
					
					if(pageGame == <?php echo $countStage; ?> && finish == false){
						this.saveData();
					
					}
					
					this.clearCheckTime();
					board.clearAllEvent();
					
					
				}else if(live == 4) {
					var pageGame = $('#pageGame').val();
					
					if(pageGame < <?php echo $countStage; ?>){
						board.boardAlertMes("You have exceeded wrong word limit!", 380, 100);
					}
					
					board.removeCells();
					
					board.clearTime();
					
					var score = board.score;
					var time = timer.value;
					this.endTime = parseInt(this.startTime) + parseInt(time);
					timer.stopCount();
				
					gameScoreByPage[pageGame-1] = score;
					trueWordByPages[pageGame-1] = board.trueWords;
					
					if(pageGame == <?php echo $countStage; ?> && finish == false){
						this.saveData();
					
					}
					//stop tick
					this.clearCheckTime();
					board.clearAllEvent();
					
				}else if(time == 100) {
					this.endGame();
				}
			},
			endGame: function() {
				var pageGame = $('#pageGame').val();
				
				this.destroy = true;
				//this.endTime = '<?=$_SERVER['REQUEST_TIME'];?>';
				var board = Factorys.getBoard();
				
				if(pageGame < <?php echo $countStage; ?>){
					board.boardAlertMes("Time's up! ", 380, 100);
				}
				
				board.removeCells();
				board.clearTime();
				
				var score = board.score;
				//var time = timer.value;
				//this.endTime = parseInt(this.startTime) + parseInt(time);
				timer.stopCount();
				
				
				gameScoreByPage[pageGame-1] = score;
				trueWordByPages[pageGame-1] = board.trueWords;
				
				if(pageGame == <?php echo $countStage; ?> && finish == false){
					this.saveData();
				
				}
				
				this.clearCheckTime();
				board.clearAllEvent();
			},
			clearCheckTime: function() {
				createjs.Ticker.off('tick', this.timeCheck);
			},
			saveData: function() {
				var board = Factorys.getBoard();
				finish = true;
				var documentId = "<?php echo $documentId; ?>";
				var gameCode = "<?php echo $gameCode; ?>";
				var totalWord = "<?php echo $countStage*6; ?>";
				var cateId = "<?php echo $cateId; ?>";
				$.ajax({
					type: "Post",
					data:{score:gameScoreByPage, totalWord: totalWord, cateId:cateId, trueWords: trueWordByPages, documentId:documentId, gameCode:gameCode},
					url:'<?=BASE_REQUEST?>/Game/saveGameVocabunary',
					dataType: 'json',
					success: function(data){
						
						board.finishGame(data.score, data.totalWord, data.trueWords);
						
					}
				});
			},
			resetGame: function() {
				var board = Factorys.getBoard();
				board.removeAll();
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
			trueWords: [],
			timePlay: false,
			txtTime: null,
			page: 0,
			
			init: function() {
				this.canvas = document.getElementById('canvas');
                this.stage = new createjs.Stage(this.canvas);
				
				bitmap2 = new createjs.Bitmap(BASE_URL+"/Default/skin/test/game/images/cay2.png");
                        bitmap2.x = 630;
                        bitmap2.y = 50;
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
			falseSound: function() {
				createjs.Sound.play("sound2");
			},
			trueSound: function() {
				createjs.Sound.play("sound1");
			},
			boardAlertMes: function(text, x, y) {
				var txtScore = new createjs.Text(text, "bold 16px Lato", "orange");
					txtScore.textAlign = "center";
					txtScore.x = x;
					txtScore.y = y;
					this.stage.removeChild(this.txtMes);
					this.txtMes = txtScore;
					this.stage.addChild(txtScore); 
					this.stage.update();
			},
			boardAlertScore: function(score, x, y) {
				var txtScore = new createjs.Text("Correct words: "+score, "bold 16px Lato", "orange");
				txtScore.textAlign = "center";
				txtScore.x = x;
				txtScore.y = y;
				this.score = score;
				this.stage.removeChild(this.txtScore);
				this.txtScore = txtScore;
				this.stage.addChild(txtScore);
				this.stage.update();
			},
			boardAlertLive: function(live, x, y) {
				var txtLive = new createjs.Text("Wrong words : "+live, "bold 16px Lato", "orange");
				txtLive.textAlign = "center";
				txtLive.x = x;
				txtLive.y = y;
				
				this.stage.removeChild(this.txtLive);
				this.txtLive = txtLive;
				this.stage.addChild(txtLive);
				this.stage.update();
			},
			removeCells: function() {
				//xoa cell
				var cells = Factorys.getCells();
				for(var i = 0; i < cells.length; i++) {
					this.stage.removeChild(cells[i].shapes[i]);
				}
				this.stage.update();
			},
			clearAllEvent: function() {
				this.stage.removeAllEventListeners();
			},
			addMess: function(text, x, y) {
				alert = new createjs.Text(text, "bold 16px Lato", "orange");
				alert.textAlign = "center";
				alert.x = x;
				alert.y = y;
				this.stage.addChild(alert);
				this.stage.update();
			},
			clearData: function(){
				gameScoreByPage = [];
				trueWordByPages = [];
			},
			finishGame: function(score, totalWord, trueWords) {
				this.removeAll();
			
				totalWord = totalWord;
				score = score;
				var wrongWords = $(<?php echo json_encode($allTrueWord); ?>).not(JSON.parse(trueWords)).get();
				trueWords = JSON.parse(trueWords).toString();

				this.addMess("Finish game", 450, 25);
				this.addMess("Score: "+score+'/'+totalWord, 450, 60);
				this.addMess("True words: "+trueWords, 450, 90);
				this.addMess("Wrong words: "+wrongWords, 450, 120);
				
				this.clearData();
				
			},
			removeAll: function() {
				
				this.clearTime();
				this.stage.removeAllChildren();
				this.clearAllEvent();
				
			},
			display: function() {
				//that = this;
				
				this.displayShapes();
				this.displayTopics();
				this.displayGreenApple();
				this.displayScore();
				this.displayLive();
				this.displayTime();
				this.replayGame();
				var pageGame = $('#pageGame').val();
				if(pageGame < <?php echo $countStage; ?>) {
					this.nextPage();
				
				}
				if(pageGame > 1) {
					this.previewPage();
				}
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
			createLabel: function(text, x, y) {
				var label = new createjs.Text(text, "bold 14px Open Sans", "#305958");
				label.name = "label";
				label.textAlign = "center";
				label.textBaseline = "middle";
				label.x = x;
				label.y = y;
				return label;
			},
			createButton: function(color, x, y, z, name) {
				var background = new createjs.Shape();
				background.name = name;
				background.graphics.beginFill(color).drawRoundRect(0, 0, x, y, z);
				return background;
			},
			nextPage: function() {
				
				var background = this.createButton("#c6dfe9", 80, 32, 10, "background");
				var label = this.createLabel("Next", 40, 16);

				button = new createjs.Container();
				button.name = "page 1";
				button.x = 390;
				button.y = 424;
				button.page = 1;
				button.addChild(background, label);
				button.addEventListener('click', function(event){
					that = this;
					var pageGame = $('#pageGame').val();
					pageGame ++;
					$('#pageGame').val(pageGame);
					if(pageGame < <?php echo $countStage+1; ?>){
						var id = "<?php echo $documentId; ?>";
						var type = "<?php echo $gameCode; ?>";
						var cateId = "<?php echo $cateId; ?>";
						$.ajax({
							type: "Post",
							data:{page:pageGame, id:id, type:type, cateId:cateId},
							url:'<?=BASE_REQUEST?>/Game/pageVdragimg',
							success: function(data){
								if(!trueWordByPages[pageGame-2]){
									gameScoreByPage[pageGame-2] = 0;
									trueWordByPages[pageGame-2] = [];
								}
								$("#resGame").html(data);
							}
						});
					
					}else {
						alert('khong con');
						that.stage.removeChild(this);
					}
				});
				this.stage.addChild(button);
			},
			replayGame: function() {
				
				var background = this.createButton("#c6dfe9", 80, 32, 10, "background");
				var label = this.createLabel("Replay", 40, 16);

				button = new createjs.Container();
				button.name = "page 1";
				button.x = 200;
				button.y = 424;
				button.page = 1;
				button.addChild(background, label);
				button.addEventListener('click', function(event){
					that = this;
					var pageGame = $('#pageGame').val();
					if(pageGame < <?php echo $countStage+1; ?>){
						var id = "<?php echo $documentId; ?>";
						var type = "<?php echo $gameCode; ?>";
						var cateId = "<?php echo $cateId; ?>";
						$.ajax({
							type: "Post",
							data:{page:pageGame, id:id, type:type, cateId:cateId},
							url:'<?=BASE_REQUEST?>/Game/pageVdragimg',
							success: function(data){
								$("#resGame").html(data);
							}
						});
					
					}else {
						alert('Không còn!');
						that.stage.removeChild(this);
					}
				});
				this.stage.addChild(button);
			},
			previewPage: function() {

				var background = this.createButton("#c6dfe9", 80, 32, 10, "background");
				var label = this.createLabel("Prev", 40, 16);

				button = new createjs.Container();
				button.name = "page 1";
				button.x = 295;
				button.y = 424;
				button.page = 1;
				button.addChild(background, label);
				button.addEventListener('click', function(event){
					var pageGame = $('#pageGame').val();
					pageGame --;
					$('#pageGame').val(pageGame);
					//page = pageGame;
					var id = "<?php echo $documentId; ?>";
					var type = "<?php echo $gameCode; ?>";
					var cateId = "<?php echo $cateId; ?>";
					$.ajax({
		              	type: "Post",
			            data:{page:pageGame, id:id, type:type, cateId:cateId},
			            url:'<?=BASE_REQUEST?>/Game/pageVdragimg',
			            success: function(data){
							
			            	$("#resGame").html(data);
							
			           	}
		            });
					
				});
				this.stage.addChild(button);
			
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
				apple1 = new createjs.Bitmap(BASE_URL+"/Default/skin/test/game/images/green-apple1.png");
				apple1.x = 755;
				apple1.y = 185;
				this.stage.addChild(apple1);
				this.appleFalse.push(apple1);
				
				apple2 = new createjs.Bitmap(BASE_URL+"/Default/skin/test/game/images/green-apple1.png");	
				apple2.x = 785;
				apple2.y = 185;
				this.stage.addChild(apple2);
				this.appleFalse.push(apple2);
				
				apple3 = new createjs.Bitmap(BASE_URL+"/Default/skin/test/game/images/green-apple1.png");	
				apple3.x = 815;
				apple3.y = 185;
				this.stage.addChild(apple3);
				this.appleFalse.push(apple3);
				
				apple4 = new createjs.Bitmap(BASE_URL+"/Default/skin/test/game/images/green-apple1.png");	
				apple4.x = 845;
				apple4.y = 185;
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
			clearTime: function() {
				createjs.Ticker.off('tick', this.timePlay);
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
			var label = new createjs.Text(txt, "22px Lato", "orange");
			label.textAlign="center";
			label.x += 100;
			label.y += 15;
			var circle = new createjs.Shape();
			circle.graphics.setStrokeStyle(1).beginStroke("#ffca65").beginFill("white").drawRect(0,0, 200, 50);

			var shape = new createjs.Container();
			shape.homeX = width;//Math.random() * (650 - 20) + 20;
			shape.homeY = height;//Math.random() * (500 - 20) + 2;
			shape.x = shape.homeX;
			shape.y = shape.homeY;
			shape.type = type;
			shape.name = txt;
			
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
				
					var board = Factorys.getBoard();
					
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
							board.trueWords.push(this.name);
							board.trueSound();
							this.off("pressmove", this);
			
							board.stage.removeChild(this);
							board.stage.removeChild(objtopic);
							
							var score = Factorys.getScore();
							score.addApple();
							apple = new createjs.Bitmap(BASE_URL+"/Default/skin/test/game/images/images.png");						
							
							var items = [
										[730,75],[755,100],[780,75], [805,100], [830,75], [855,100], [880,75],
										[720, 110],[760, 125],[890,105],[795,125],[750,150],[780, 150],[820,125],
										[850,125],[810,150],[890,165],[950,165],[1110,165]
										];
							
							var j = score.apple-1;
							
							
							apple.x = items[j][0];
							apple.y = items[j][1];
							
							board.stage.addChild(apple);
							
							score.addScore();
							
							board.boardAlertScore(score.score, 100, 15);
							
							
						}else {
							if(this.x > 250){
								board.live = board.live + 1;
									
								var score = Factorys.getScore();
								
								board.boardAlertScore(score.score, 100, 15);
								
								apple = board.appleFalse[0];
								//apple.x = 800 - score.fapple*25;
								//apple.y = 450;
								board.stage.removeChild(apple);
								
								board.appleFalse.shift();
								
								board.boardAlertLive(board.live, 650, 15);
								board.falseSound();
							}
							this.x = this.homeX;
							this.y = this.homeY;
							
						}
					
					}else {
						if(this.x > 250){
							board.live = board.live + 1;
						
							var score = Factorys.getScore();
							
							board.boardAlertScore(score.score, 100, 15);
							
							apple = board.appleFalse[0];
							board.stage.removeChild(apple);
							board.appleFalse.shift();
						
							board.boardAlertLive(board.live, 650, 15);
							board.falseSound();
						}
						this.x = this.homeX;
						this.y = this.homeY;
						
					}
					
				});
	
				
			},
			check: function(obj1,obj2) {
				  var pt = obj1.globalToLocal(obj2.x, obj2.y);
				  var h1 = -50;
				  var h2 = 50;
				  var w1 = -200;
				  var w2 = 200;
				  
				  if(pt.x > w2 || pt.x < w1) return false;
				  if(pt.y > h2 || pt.y < h1) return false;
				  
				  return true;
			}
			
		};
		
		//class topic
		Topic = function (src, type, i) {
				
				img = new createjs.Bitmap(src);
				
				var targetWidth = 160; 
				var targetHeight = 55; 
				img.scaleX = targetWidth / img.image.width; 
				img.scaleY = targetHeight / img.image.height; 
				
				img.x = 0;
				img.y = 0;
				
				var box = new createjs.Shape();
				box.graphics.setStrokeStyle(2).beginStroke("orange").rect(0, 0, 160, 55);
				var topic = new createjs.Container();
				
				var topics = [
					[450,60],[450,120],[450,180], [450,240], [450,300], [450,360], [450,365],
					[300,365],[180, 365],[55,365],[795,125],[750,150],[780, 150],[820,125],
					[850,125],[810,150],[890,165],[950,165],[1110,165]
				];

				
				topic.x = topics[i][0];
				topic.y = topics[i][1];
						
				topic.addChild(box, img);
				this.topic = topic;
				this.type = type;
		};
		Topic.prototype = {
			topic: null,
			type: null,
			
		};
		//page
		Page = function() {
			
		};
		Page.prototype = {
			page: 0,
			addPage: function() {
				this.page ++;
			},
			subPage: function() {
				this.page --;
			}
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
			//resize
			/*var w = $('#resGame').innerWidth();
				if( w > 940) {
					$('#canvas').innerWidth(940);
				}else {
					$('#canvas').innerWidth(w);
				}	
			
			$(window).resize(function() {
				var w = $('#resGame').innerWidth();
				if( w > 940) {
					$('#canvas').innerWidth(940);
				}else {
					$('#canvas').innerWidth(w);
				}		
				
			});*/
			
			Factorys.getGame().start();
			
				
		});	
    </script>
	<style>
		.bggame{background: #f5f5f5; border-radius: 5px; background: url('<?=BASE_URL."/Default/skin/test/game/images/test_bg3.jpg"?>');background-size: cover;}
		.bdrd5{border-radius: 5px;}
		

	</style>
	<?php 
		$domain = $_SERVER['SERVER_NAME'];
		if($domain == 's1.nextnobels.com'){
			echo "<div class='alert alert-info mgb0'>";
				echo "Drag Vietnamese words into corresponding photos.";
			echo "</div>";
		}else if($domain == 'fulllooksongngu.com') {
			if(pzk_session('language') == 'en') {
				echo "<div class='alert alert-info mgb0'>";
					echo "Drag Vietnamese words into corresponding photos.";
				echo "</div>";
			}elseif(pzk_session('language') == 'vn'){
				echo "<div class='alert alert-info mgb0'>";
					echo "Kéo từ Tiếng Việt vào hình tương ứng.";
				echo "</div>";
			}elseif(pzk_session('language') == 'ev') {
				echo "<div class='alert alert-info mgb0'>";
					echo "Drag Vietnamese words into corresponding photos.";
				echo "</div>";
			}else{
				echo "<div class='alert alert-info mgb0'>";
					echo " Kéo từ Tiếng Việt vào hình tương ứng.";
				echo "</div>";
			}
		}
	?>
	<div id='resultLesson' class='item bggame mgb15'>	
		<canvas style='width: 100% !important;'  id="canvas" width="940" height="500"></canvas> 
	</div>
	

<?php } else { ?>
	Chưa có dữ liệu
	<img class='item' src="<?php echo BASE_URL; ?>/Default/skin/nobel/test/themes/default/media/bg_game.jpg" />
	<?php } } else { ?>
	Chưa có dữ liệu
	<img class='item' src="<?php echo BASE_URL; ?>/Default/skin/nobel/test/themes/default/media/bg_game.jpg" />
<?php } ?>