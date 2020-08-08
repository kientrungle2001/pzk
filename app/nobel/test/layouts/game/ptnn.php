<?php
$post = pzk_request();
$getGameType = $post->getGameType();
$getTopic = $post->getGameTopic();

if($getGameType && $getTopic) {

    $dataWord = $data->getWordGame($getGameType, $getTopic, 'game');
    if($dataWord){
        $arrWordTrue = explode(',', $dataWord['datatrue']);
        $arrWordTrue = array_map('trim',$arrWordTrue);
        $datatrue = json_encode($arrWordTrue);

        $arrWord = explode(',', $dataWord['dataword']);
        $arrWord = array_map('trim', $arrWord);
        $totalword = count($arrWord);
        shuffle($arrWord);
        $arrWord = array_chunk($arrWord, 5);
        $totalCustomData = count($arrWord)-1;
        $allWord = json_encode($arrWord);
        ?>
		<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <script src="<?php echo BASE_URL; ?>/Default/skin/nobel/libgame/createjs-2015.05.21.min.js"></script>
        
        <script id="editable">



            // define a new TextLink class that extends / subclasses Text, and handles drawing a hit area
            // and implementing a hover color.
            function TextLink(text, font, color, hoverColor) {
                // this super class constructor reference is automatically created by createjs.extends:
                this.Text_constructor(text, font, color);
                this.hoverColor = hoverColor;
                this.hover = false;
                this.hitArea = new createjs.Shape();
                this.textBaseline = "top";

                this.addEventListener("rollover", this);
                this.addEventListener("rollout", this);
            }
            createjs.extend(TextLink, createjs.Text);

            // use the same approach with draw:
            TextLink.prototype.draw = function (ctx, ignoreCache) {
                // save default color, and overwrite it with the hover color if appropriate:
                var color = this.color;
                if (this.hover) {
                    this.color = this.hoverColor;
                }

                // call Text's drawing method to do the real work of drawing to the canvas:
                // this super class method reference is automatically created by createjs.extends for methods overridden in the subclass:
                this.Text_draw(ctx, ignoreCache);

                // restore the default color value:
                this.color = color;

                // update hit area so the full text area is clickable, not just the characters:
                this.hitArea.graphics.clear().beginFill("#FFF").drawRect(0, 0, this.getMeasuredWidth(), this.getMeasuredHeight());
            };

            // set up the handlers for mouseover / out:
            TextLink.prototype.handleEvent = function (evt) {
                this.hover = (evt.type == "rollover");
            };

            // set up the inheritance relationship: TextLink extends Text.
            createjs.promote(TextLink, "Text");

            RainWord = {
                dataWord : null,
                dataTrue : null,
                canvas: null,
                stage: null,
                //loader bar
                WALL_THICKNESS: 15,
                SCORE_BOARD_HEIGHT: 40,
                loaderBar: null,
                loadInterval: null,
                LOADER_WIDTH: 400,
                percentLoaded: 0,
                //
                allword: <?php echo $totalword; ?>,//tong so tu trong game
                stopCustomData: <?php echo $totalCustomData; ?>,
                live: 3,
                score: 0,
                scoreTxt: null,
                livesTxt: null,
                button: null,
                txt: null,
                starfield: null,
                bitmap: null,
                rand: null,
                //end game
                end:false,
                sprite: null,
                clickFalse: [],
                wordDel: [],
                clickTrue: [],
                //start
                start: false,
                i: 0,//dem so lan de quy ham CustomData()

                init: function(dataword, dataTrue) {
                    that = this;
                    var myArray = ['1', '2', '3'];
                    this.rand = myArray[Math.floor(Math.random() * myArray.length)];
                    this.dataWord = dataword;
                    this.dataTrue = dataTrue;
                    this.canvas = document.getElementById('canvas');
                    this.stage = new createjs.Stage(this.canvas);
                    this.stage.enableMouseOver(40);

                    //draw sky
                    //this.skys();
                    this.bitmap = new createjs.Bitmap(BASE_URL+"/Default/skin/test/game/images/play1.png");
                    this.bitmap.x = 0;
                    this.bitmap.y = 0;

                    this.stage.addChild(this.bitmap);
                    this.preload();
                    this.insSoundBg();

                    this.buildStart();
                    var data = {
                        images: [BASE_URL+"/Default/skin/test/game/art/spritesheet_sparkle.png"],
                        frames: {width: 21, height: 23, regX: 10, regY: 11}
                    };

                    //this.buildWalls();
                    // set up an animation instance, which we will clone
                    this.sprite = new createjs.Sprite(new createjs.SpriteSheet(data));

                    this.display();
                    // start the tick and point it at the window so we can do some work before updating the stage:

                },
                tick: function(event) {

                    var l = this.stage.getNumChildren();
                    for (var i=l-1; i>0; i--) {
                        var sparkle = this.stage.getChildAt(i);

                        // apply gravity and friction
                        sparkle.vY += 2;
                        sparkle.vX *= 0.98;

                        // update position, scale, and alpha:
                        sparkle.x += sparkle.vX;
                        sparkle.y += sparkle.vY;
                        sparkle.scaleX = sparkle.scaleY = sparkle.scaleX+sparkle.vS;
                        sparkle.alpha += sparkle.vA;

                        //remove sparkles that are off screen or not invisble
                        if (sparkle.alpha <= 0 || sparkle.y > canvas.height) {
                            this.stage.removeChildAt(i);
                        }
                    }


                },
                //display
                display: function() {
                    var that = this;
                    createjs.Ticker.setFPS(60);
                    createjs.Ticker.addEventListener("tick", function (e) {
                        if (!that.end) {
                            // Actions carried out when the Ticker is not paused.
                            if(that.live == 0 || that.allword == 0) {
                                that.end = true;
                                that.endGame();

                            }
                            that.stage.update();
                        }
                    });
                },
                preload: function () {
                    var that = this;
                    var preload = new createjs.LoadQueue(true);
                    preload.installPlugin(createjs.Sound);
                    preload.addEventListener("fileload", function() {that.playSound();});
                },
                buildWalls: function() {
                    var wall = new createjs.Shape();
                    wall.graphics.beginFill('#c6e9fc');
                    wall.graphics.drawRect(0, 0, this.WALL_THICKNESS, this.canvas.height);
                    this.stage.addChild(wall);
                    wall = new createjs.Shape();
                    wall.graphics.beginFill('#c6e9fc');
                    wall.graphics.drawRect(0, 0, this.WALL_THICKNESS, this.canvas.height);
                    wall.x = this.canvas.width - this.WALL_THICKNESS;
                    this.stage.addChild(wall);
                    wall = new createjs.Shape();
                    wall.graphics.beginFill('#c6e9fc');
                    wall.graphics.drawRect(0, 0, this.canvas.width, this.WALL_THICKNESS);
                    wall.y = this.canvas.height - this.WALL_THICKNESS;

                    this.stage.addChild(wall);
                },
                buildMessageBoard: function () {
                    var board = new createjs.Shape();
                    board.graphics.beginFill('#c6e9fc');
                    board.graphics.drawRect(0, 0, this.canvas.width, this.SCORE_BOARD_HEIGHT);
                    this.stage.addChild(board);

                    this.livesTxt = new createjs.Text('lives: ' + this.live, '20px Open Sans', '#ff7700');
                    this.livesTxt.textAlign = "right";
                    this.livesTxt.y = board.y + 8;
                    this.livesTxt.x = this.canvas.width - this.WALL_THICKNESS;
                    this.stage.addChild(this.livesTxt);

                    this.scoreTxt = new createjs.Text('score: ' + this.score, '20px Open Sans', '#ff7700');
                    this.scoreTxt.y = board.y + 8;
                    this.scoreTxt.x = this.WALL_THICKNESS;
                    this.stage.addChild(this.scoreTxt);

                    var messageTxt = new createjs.Text('Rain word', 'bold 20px Open Sans',
                        '#ff7700');
                    messageTxt.textAlign = 'center';
                    messageTxt.y = board.y + 8;
                    messageTxt.x = this.canvas.width / 2;
                    this.stage.addChild(messageTxt);
                },
                buildStart: function() {
                    this.stage.enableMouseOver(40);
                    var that = this;
                    var background = new createjs.Shape();
                    background.name = "background";
                    background.graphics.beginFill("#c6dfe9").drawRoundRect(0, 0, 170, 70, 10);

                    var label = new createjs.Text("Start", "bold 55px Open Sans", "#305958");
                    label.name = "label";
                    label.textAlign = "center";
                    label.textBaseline = "middle";
                    label.x = 170/2;
                    label.y = 70/2;

                    this.button = new createjs.Container();
                    this.button.name = "button";
                    this.button.x = 365;
                    this.button.y = 292;
                    this.button.addChild(background, label);
                    // setting mouseChildren to false will cause events to be dispatched directly from the button instead of its children.
                    // button.mouseChildren = false;
                    this.button.addEventListener("click", function(event) {
                        that.stage.removeChild(that.button);
                        that.stage.removeChild(that.bitmap);
                        that.buildMessageBoard();

                        that.bitmap = new createjs.Bitmap(BASE_URL+"/Default/skin/test/game/images/background_"+that.rand+".png");
                        that.bitmap.x = 0;
                        that.bitmap.y = 40;
                        that.stage.addChild(that.bitmap);
						
						
						
                        //draw load
                        //that.skys();
                        //that.randomStar();
                        that.soundTrue();
                        that.builLoaderBar();
                        that.startLoad();
                        that.soundFalse();
                        that.display();
                    });
                    this.stage.addChild(this.button);

                },

                skys: function() {
                    // draw the sky
                    var that = this;
                    var sky = new createjs.Shape();
                    sky.graphics.beginLinearGradientFill(["#204", "#003", "#000"], [0, 0.15, 0.6], 0, this.canvas.height, 0, 0);
                    sky.graphics.drawRect(0, 40, this.canvas.width, this.canvas.height);
                    this.stage.addChild(sky);
                    // create a Shape instance to draw the vectors stars in, and add it to the stage:
                    this.starfield = new createjs.Shape();
                    this.stage.addChild(this.starfield);

                    // set up the cache for the star field shape, and make it the same size as the canvas:
                    this.starfield.cache(0, 0, this.canvas.width, this.canvas.height);
                    createjs.Ticker.addEventListener("tick", function(){that.randomStar();});
                    createjs.Ticker.setFPS(30);
                },
                randomStar: function() {
                    // draw a vector star at a random location:
                    this.starfield.graphics.beginFill(createjs.Graphics.getRGB(0xFFFFFF, Math.random())).drawPolyStar(Math.random() * this.canvas.width, Math.random() * this.canvas.height, Math.random() * 4 + 1, 5, 0.93, Math.random() * 360);

                    // draw the new vector onto the existing cache, compositing it with the "source-overlay" composite operation:
                    this.starfield.updateCache("source-overlay");

                    // if you omit the compositeOperation param in updateCache, it will clear the existing cache, and draw into it:
                    // in this demo, that has the effect of showing just the star that was drawn each tick.
                    // shape.updateCache();

                    // because the vector star has already been drawn to the cache, we can clear it right away:
                    this.starfield.graphics.clear();
                },

                //loader bar
                builLoaderBar: function() {
                    this.loaderBar = new createjs.Shape();
                    this.loaderBar.x = this.stage.canvas.width/2 - 200;
                    this.loaderBar.y = this.stage.canvas.height/2 -100;
                    this.loaderBar.graphics.setStrokeStyle(2);
                    this.loaderBar.graphics.beginStroke('red');
                    this.loaderBar.graphics.drawRect(0, 0, this.LOADER_WIDTH, 40);
                    this.stage.addChild(this.loaderBar);
                },
                startLoad: function() {
                    var that = this;
                    this.loadInterval = setInterval(function(){that.updateLoad();}, 50);// chu y
                },
                updateLoaderBar: function() {
                    this.loaderBar.graphics.clear();
                    this.loaderBar.graphics.beginFill('orange');
                    this.loaderBar.graphics.drawRect(0, 0, this.LOADER_WIDTH * this.percentLoaded, 40);
                    this.loaderBar.graphics.endFill();
                    this.loaderBar.graphics.setStrokeStyle(0.3);
                    this.loaderBar.graphics.beginStroke("red");
                    this.loaderBar.graphics.drawRect(0, 0, this.LOADER_WIDTH, 40);
                    this.loaderBar.graphics.endStroke();

                },
                updateLoad: function() {
                    var that =  this;
                    this.percentLoaded += .025;
                    this.updateLoaderBar();
                    if (this.percentLoaded >= 1) {
                        clearInterval(this.loadInterval);
                        this.stage.removeChild(this.loaderBar);
                        //mua chu
                        var data = this.dataWord;

                        this.customData(data);
                    }
                },

                customData: function(data) {
                    if(this.end == true) return false;
                    var that = this;
                    var dataJson = data[that.i];
                    this.rainWord(dataJson);
                    this.i++;
                    if(this.i > this.stopCustomData) return false;
                    setTimeout(function(){

                        if(that.i > that.stopCustomData) return false;
                        that.customData(data);
                    }, 8000);
                },
                //rain word
                rainWord: function(dataword){

                    that = this;
                    for(i = 0; i < dataword.length; i++) {
                        //setInterval(function(){ this. = that.dataWord[i]; }, 3000);

                        var word = dataword[i];
                        var widthW = word.length*10;
                        //var txt = new createjs.Text(word, 'bold 25px Arial');
                        var color = "red";
                        var checkmau = i % 4;
                        switch(checkmau) {
                            case 0:
                                color = "red";
                                break;
                            case 1:
                                color = "blue";
                                break;
                            case 2:
                                color = "orange";
                                break;
                            case 3:
                                color = "red";
                                break;
                            default:
                                color = "red";
                        }

                        var txt = new TextLink(word, "bold 18px Open Sans", color, "orange");
                        txt.cursor = 'pointer';
                        var j = i +1;
                        if(j == 6) {
                            j = 1;
                        }
                        txt.x = (j * 170)-110  ;
                        txt.y = 35 + Math.floor((Math.random() * 10) + 2)*15;
                        this.stage.addChild(txt);
                        txt.addEventListener('click', function (e) {
                            var valWord = e.target.text;
                            that.onLetterClick(valWord);
                            //remove tween
                            createjs.Tween.removeTweens(e.target);
                            //-- cau
                            that.checkEndWord();
                            //remove text
                            that.stage.removeChild(e.target);
                            that.clickText(e);
                        });

                        var checkTrue = this.dataTrue.indexOf(txt.text);
                        if(checkTrue >= 0) {
                            createjs.Tween.get(txt).to({ alpha:1, y: this.stage.canvas.height+10 },15000 + Math.random()*900).call(function(){that.handleComplete(txt.text);});
                        }else {
                            createjs.Tween.get(txt).to({ alpha:1, y: this.stage.canvas.height+10 },15000 + Math.random()*900).call(function(){that.checkEndWord();});
                        }
                    }
                },
                addSparkles: function(count, x, y, speed) {
                    //create the specified number of sparkles
                    for (var i = 0; i < count; i++) {
                        // clone the original sparkle, so we don't need to set shared properties:
                        var sparkle = this.sprite.clone();

                        // set display properties:
                        sparkle.x = x;
                        sparkle.y = y;
                        //sparkle.rotation = Math.random()*360;
                        sparkle.alpha = Math.random() * 0.5 + 0.5;
                        sparkle.scaleX = sparkle.scaleY = Math.random() + 0.3;

                        // set up velocities:
                        var a = Math.PI * 2 * Math.random();
                        var v = (Math.random() - 0.5) * 30 * speed;
                        sparkle.vX = Math.cos(a) * v;
                        sparkle.vY = Math.sin(a) * v;
                        sparkle.vS = (Math.random() - 0.5) * 0.2; // scale
                        sparkle.vA = -Math.random() * 0.05 - 0.01; // alpha

                        // start the animation on a random frame:
                        sparkle.gotoAndPlay(Math.random() * sparkle.spriteSheet.getNumFrames());

                        // add to the display list:
                        this.stage.addChild(sparkle);
                    }
                },
                clickText: function(e) {
                    that = this;
                    img = new Image();
                    img.src = BASE_URL+"/Default/skin/nobel/game/art/bubbles.png";
                    var data = {
                        framerate: 10,
                        images: [img],
                        frames: {width:64, height:64, regX:32, regY:32},
                        animations: {
                            'explode': [0, 10]
                        }
                    };

                    var spritesheet = new createjs.SpriteSheet(data);
                    var animation = new createjs.Sprite(spritesheet, 'explode');
                    animation.x = e.stageX;
                    animation.y = e.stageY;
                    this.stage.addChild(animation);
                    setTimeout(function(){  that.stage.removeChild(animation); }, 200);

                },
                //chu dung roi xuong dat
                handleComplete: function (txt) {
                    //Tween complete
                    this.checkEndWord();
                    this.wordDel.push(txt);
                    if(this.live > 0 ) {
                        createjs.Sound.play("sound2");
                        this.live --;
                    }

                    this.livesTxt.text = "lives: " + this.live;

                },
                // chu sai roi xuong dat
                checkEndWord: function() {
                    if(this.allword > 0) {
                        this.allword --;
                    }
                },
                //click vao word
                onLetterClick: function(valWord) {
                    var checkTrue = this.dataTrue.indexOf(valWord);
                    var board = new createjs.Shape();
                    board.graphics.drawRect(0, 0, this.canvas.width, this.SCORE_BOARD_HEIGHT);
                    if(checkTrue >= 0) {
                        createjs.Sound.play("sound1");
                        this.clickTrue.push(valWord);
                        this.score = this.score + 1;
                        this.scoreTxt.text = "score: " + this.score;

                    }else {
                        createjs.Sound.play("sound2");
                        this.clickFalse.push(valWord);
                        if(this.live > 0) {
                            this.live --;
                        }
                        this.livesTxt.text = "lives: " + this.live;

                    }
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
                insSoundBg: function() {
                    var that = this;
                    createjs.Sound.alternateExtensions = ["mp3"];	// add other extensions to try loading if the src file extension is not supported
                    createjs.Sound.registerSound(BASE_URL+"/Default/skin/nobel/game/audio/soundBg.ogg", "sBg");  // register sound, which preloads by default
                    //createjs.Sound.onLoadComplete = this.playSound();  // add a callback for when load is completed
                    createjs.Sound.addEventListener("fileload", function(){that.playSound();}); // add an event listener for when load is completed

                },
                playSound: function () {
                    instance = createjs.Sound.play('sBg');
                    instance.volume = 0.2;
                },
                pauseSound: function() {
                    createjs.Sound.stop();
                },
                //end game
                endGame: function() {
                    var that = this;
                    this.pauseSound();

                    //this.stage.removeContainer();
                    this.stage.removeAllChildren();

                    //var msg ="Điểm của bạn: " + this.score +' mang '+ this.live;
                    //var gameOverTxt = new createjs.Text(msg, "22px Arial", '#ff7700');
                    //gameOverTxt.textAlign = 'center';
                    //gameOverTxt.textBaseline = 'middle';
                    //gameOverTxt.x = this.stage.canvas.width / 2;
                    //gameOverTxt.y = this.stage.canvas.height / 2;
                    //this.stage.addChild(gameOverTxt);
                    //this.display();
                    var gamecode = "<?php echo $getGameType; ?>";
                    var gameTopic = "<?php echo $getTopic; ?>";
                    var check = 1;
                    $.ajax({
                        type: "POST",
                        url: '/Game/save',
                        data: {score:that.score, live:that.live, gamecode:gamecode, gameTopic:gameTopic, check:check},
                        success: function(data) {
                            if(data) {


                                var rate = JSON.parse(data);
                                if(that.clickFalse.length > 0) {
                                    var wordFalse = that.clickFalse;
                                    wordFalse.toString();
                                    document.getElementById("clickFlase").innerHTML = wordFalse;
                                    document.getElementById("showWordFalse").style.display = 'block';

                                    $('#showGame').show();
                                }
                               if(that.wordDel.length > 0 ) {
                                   var wordTrue = that.wordDel;
                                   wordTrue.toString();
                                   document.getElementById("wordDel").innerHTML = wordTrue;
                                   document.getElementById("showWordTrue").style.display = 'block';

                                   $('#showGame').show();
                               }
                                if(that.clickTrue.length > 0 ) {
                                    var wordTrue = that.clickTrue;
                                    wordTrue.toString();
                                    document.getElementById("clickTrue").innerHTML = wordTrue;
                                    document.getElementById("showWord").style.display = 'block';
                                    $('#showGame').show();
                                }

                                var msg ="Xếp hạng: " + rate.rating +'/'+ rate.total;
                                canvas = document.getElementById('canvas');
                                stage = new createjs.Stage(canvas);
                                var bitmap = new createjs.Bitmap(BASE_URL+"/Default/skin/test/game/images/background_"+that.rand+".png");
                                bitmap.x = 0;
                                bitmap.y = 0;

                                stage.addChild(bitmap);
								var gameOver = new createjs.Text("GAME OVER", "40px Open Sans", '#ff7700');
								gameOver.textAlign = 'center';
                                gameOver.textBaseline = 'middle';
                                gameOver.x = stage.canvas.width / 2;
                                gameOver.y = stage.canvas.height / 2-140;
								
                                var score = "Score: "+that.score;
                                var gamescore = new createjs.Text(score, "20px Open Sans", '#ff7700');
                                gamescore.textAlign = 'center';
                                gamescore.textBaseline = 'middle';
                                gamescore.x = stage.canvas.width / 2;
                                gamescore.y = stage.canvas.height / 2-60;
								
								var live = "Live: "+that.live;
								var gameLive = new createjs.Text(live, "20px Open Sans", '#ff7700');
                                gameLive.textAlign = 'center';
                                gameLive.textBaseline = 'middle';
                                gameLive.x = stage.canvas.width / 2;
                                gameLive.y = stage.canvas.height / 2-30;
								
                                var gameOverTxt = new createjs.Text(msg, "20px Open Sans", '#ff7700');
                                gameOverTxt.textAlign = 'center';
                                gameOverTxt.textBaseline = 'middle';
                                gameOverTxt.x = stage.canvas.width / 2;
                                gameOverTxt.y = stage.canvas.height / 2;
								
								stage.addChild(gameOver);
                                stage.addChild(gameLive);
                                stage.addChild(gamescore);
                                stage.addChild(gameOverTxt);
                                createjs.Ticker.setFPS(60);
                                createjs.Ticker.addEventListener("tick", function (e) {
                                    stage.update();
                                });
                            }
                        }
                    });
                    return false;
                }
            };


            function pauseSound() {
                RainWord.pauseSound();
            }
            function reloadPage() {
                history.go(0);
            }






        </script>
		
        <div class="container" >
			<div class='row'>
			<div class='col-md-9 col-xs-12 mgb15'>
				
				<strong class="item" style="margin: 10px 0px;">
					<?php echo $dataWord['question']; ?>
				</strong>
				
				<canvas style='width: 100% !important;' id="canvas" width='900px' height="570">
				</canvas>
				
				<button class="btn btn-primary" onclick="reloadPage();">
				<span class="glyphicon glyphicon-play-circle" aria-hidden="true"></span> Play again</button>

				<!--button  onclick="pauseSound();" class="playSound btn btn-warning"><span class="glyphicon glyphicon-volume-up" aria-hidden="true"></span> Mute</button-->
				
				<button id="showGame" style="display:none;"  type="button" class="btn btn-danger" data-toggle="modal" data-target=".showGame"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Game results</button>
				
			</div>
			<?php $rank = $data->getRate($getGameType, $getTopic); if($rank) { ?>
			<div class='col-md-3 col-xs-12'>
				<h4>Rating</h4>
				<style>
				.tablerate{
					width: 100%;
					border: 1px solid #cccccc;
					
				}
				.tablerate tr td{
					text-align: center;
					border: 1px solid #cccccc;
					padding: 6px;
				}
				.tablerate tr th{
					text-align: center;
					border: 1px solid #cccccc;
					padding: 3px;
				}
				</style>
				<table class='tablerate'>
					<tr>
						<th>Username</th>
						<th>Score</th>
						<th>live</th>
					</tr>
					<?php foreach($rank as $item) { ?>
					<tr>
						<td>
							<?php echo $item['username']; ?>
						</td>
						<td><?php echo $item['score']; ?></td>
						<td><?php echo $item['live']; ?></td>		
					</tr>
					<?php } ?>
				</table>
			</div>	
			<?php } ?>
			</div>
			
            <!-- Large modal -->
            
			</div>	
            <div class="modal fade showGame" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="gridSystemModalLabel">Game results</h4>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-success" >
                                <b id="showWord" style="color: black; display:none;" >Correct words clicked: <span style="color:red;" id="clickTrue"></span></b><br>
                                <b id="showWordFalse" style="color: black; display:none;" >Wrong words clicked: <span style="color:red;" id="clickFlase"></span> </b> <br>
                                <b id="showWordTrue" style="color: black; display:none;" >Correct Words unclicked: <span style="color:red;" id="wordDel"></span></b> </br>
								<p>Note: Double click on the word to see translate into Vietnamese</p>		
                            
							</div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
		<script>
			var gameRunning = true;
            $(function() {
                RainWord.init(<?php echo $allWord; ?>, <?php echo $datatrue;?>);
				
				/*/resize canvas
				var w = $('#resultLesson').width();
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
    <?php } } ?>