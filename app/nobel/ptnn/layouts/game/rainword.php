﻿<?php
$post = pzk_request();
$gameType = $post->get('gameType');
$topic = $post->get('gameTopic');
$dataWord = $data->getWordGame($gameType, $topic);
if($dataWord){
$arrWordTrue = explode(',', $dataWord['datatrue']);
$arrWordTrue = array_map('trim',$arrWordTrue);
$datatrue = json_encode($arrWordTrue, JSON_UNESCAPED_UNICODE);

$arrWord = explode(',', $dataWord['dataword']);
$arrWord = array_map('trim', $arrWord);
$totalword = count($arrWord);

$arrWord = array_chunk($arrWord, 5);
$totalCustomData = count($arrWord)-1;
$allWord = json_encode($arrWord);
?>
<script src="<?php echo BASE_URL; ?>/default/skin/nobel/libgame/createjs-2015.05.21.min.js"></script>
<style>
    #canvas {
        border: 1px solid red;
    }
</style>
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



    var gameRunning = true;
    $(function() {
        RainWord.init(<?php echo $allWord; ?>, <?php echo $datatrue;?>);

    });

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
        sky: null,
        starfield: null,
        bitmap: null,
        //end game
        end:false,
        //start
        start: false,
        i: 0,//dem so lan de quy ham CustomData()

        init: function(dataword, dataTrue) {
            this.dataWord = dataword;
            this.dataTrue = dataTrue;
            this.canvas = document.getElementById('canvas');
            this.stage = new createjs.Stage(this.canvas);
            //draw sky
            //this.skys();
            this.bitmap = new createjs.Bitmap(BASE_URL+"/default/skin/nobel/game/images/homegame.png");
            this.bitmap.x = 0;
            this.bitmap.y = 0;

            this.stage.addChild(this.bitmap);
            this.preload();
            this.insSoundBg();

            this.buildStart();
            //this.buildWalls();

            this.display();

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

            this.livesTxt = new createjs.Text('lives: ' + this.live, '20px Times', '#ff7700');
            this.livesTxt.textAlign = "right";
            this.livesTxt.y = board.y + 10;
            this.livesTxt.x = this.canvas.width - this.WALL_THICKNESS;
            this.stage.addChild(this.livesTxt);

            this.scoreTxt = new createjs.Text('score: ' + this.score, '20px Times', '#ff7700');
            this.scoreTxt.y = board.y + 10;
            this.scoreTxt.x = this.WALL_THICKNESS;
            this.stage.addChild(this.scoreTxt);

            var messageTxt = new createjs.Text('Rain word', '20px Times',
                '#ff7700');
            messageTxt.textAlign = 'center';
            messageTxt.y = board.y + 10;
            messageTxt.x = this.canvas.width / 2;
            this.stage.addChild(messageTxt);
        },
        buildStart: function() {
            var that = this;
            var background = new createjs.Shape();
            background.name = "background";
            background.graphics.beginFill("#337ab7").drawRoundRect(0, 0, 140, 40, 10);

            var label = new createjs.Text("Bắt đầu", "bold 18px Arial", "#FFFFFF");
            label.name = "label";
            label.textAlign = "center";
            label.textBaseline = "middle";
            label.x = 130/2;
            label.y = 40/2;

            this.button = new createjs.Container();
            this.button.name = "button";
            this.button.x = 350;
            this.button.y = 150;
            this.button.addChild(background, label);
            // setting mouseChildren to false will cause events to be dispatched directly from the button instead of its children.
            // button.mouseChildren = false;
            this.button.addEventListener("click", function(event) {
                that.stage.removeChild(that.button);

                that.stage.enableMouseOver(40);
                //that.bitmap = new createjs.Bitmap(BASE_URL+"/default/skin/nobel/game/images/test5.png");
                //that.bitmap.x = 0;
                //that.bitmap.y = 40;

                //that.stage.addChild(that.bitmap);
                that.builLoaderBar();


                that.startLoad();
                that.buildMessageBoard();
                //draw load
                that.skys();
                that.randomStar();
                //that.stageBegin();

                that.soundTrue();
                that.soundFalse();
                that.display();
            });
            this.stage.addChild(this.button);

        },

        skys: function() {
            // draw the sky
            var that = this;
            this.sky = new createjs.Shape();
            this.sky.graphics.beginLinearGradientFill(["#204", "#003", "#000"], [0, 0.15, 0.6], 0, this.canvas.height, 0, 0);
            this.sky.graphics.drawRect(0, 40, this.canvas.width, this.canvas.height);
            this.stage.addChild(this.sky);
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
            this.loaderBar.graphics.beginStroke('#000');
            this.loaderBar.graphics.drawRect(0, 0, this.LOADER_WIDTH, 40);
            this.stage.addChild(this.loaderBar);
        },
        startLoad: function() {
            var that = this;
            this.loadInterval = setInterval(function(){that.updateLoad();}, 50);// chu y
        },
        updateLoaderBar: function() {
            this.loaderBar.graphics.clear();
            this.loaderBar.graphics.beginFill('#00ff00');
            this.loaderBar.graphics.drawRect(0, 0, this.LOADER_WIDTH * this.percentLoaded, 40);
            this.loaderBar.graphics.endFill();
            this.loaderBar.graphics.setStrokeStyle(2);
            this.loaderBar.graphics.beginStroke("#000");
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

                var txt = new TextLink(word, "bold 18px Arial", color, "#ffffff");
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
                });

                var checkTrue = this.dataTrue.indexOf(txt.text);
                if(checkTrue >= 0) {
                    createjs.Tween.get(txt).to({ alpha:1, y: this.stage.canvas.height+10 },15000 + Math.random()*900).call(function(){that.handleComplete();});
                }else {
                    createjs.Tween.get(txt).to({ alpha:1, y: this.stage.canvas.height+10 },15000 + Math.random()*900).call(function(){that.checkEndWord();});
                }
            }
        },
        //chu dung roi xuong dat
        handleComplete: function () {
            //Tween complete
            this.checkEndWord();

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

                this.score = this.score + 1;
                this.scoreTxt.text = "score: " + this.score;

            }else {
                createjs.Sound.play("sound2");
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
            var gamecode = 'mutu';
            var check = 1;
            $.ajax({
                type: "POST",
                url: '/game/save',
                data: {score:that.score, live:that.live, gamecode:gamecode, check:check},
                success: function(data) {
                    if(data) {


                        var rate = JSON.parse(data);
                        var msg ="Xếp hạng: " + rate.rating +'/'+ rate.total;
                        canvas = document.getElementById('canvas');
                        stage = new createjs.Stage(canvas);
                        var bitmap = new createjs.Bitmap(BASE_URL+"/default/skin/nobel/game/images/homegame.png");
                        bitmap.x = 0;
                        bitmap.y = 0;

                        stage.addChild(bitmap);
                        var score = "Điểm của bạn: "+that.score+' mạng '+that.live;
                        var gamescore = new createjs.Text(score, "22px Arial", '#ff7700');
                        gamescore.textAlign = 'center';
                        gamescore.textBaseline = 'middle';
                        gamescore.x = stage.canvas.width / 2;
                        gamescore.y = stage.canvas.height / 2+40;
                        var gameOverTxt = new createjs.Text(msg, "20px Arial", '#ff7700');
                        gameOverTxt.textAlign = 'center';
                        gameOverTxt.textBaseline = 'middle';
                        gameOverTxt.x = stage.canvas.width / 2;
                        gameOverTxt.y = stage.canvas.height / 2 + 12;
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

<div class="item" >
    <div class="request">
        <strong class="item" style="margin: 10px 0px;">
            <?php echo $dataWord['question']; ?>
        </strong>
    </div>
    <canvas id="canvas" width="900" height="600">
    </canvas>
    <button class="btn btn-primary" onclick="reloadPage();">Chơi lại</button>

    <button  onclick="pauseSound();" class="playSound btn btn-primary">Stop Sound</button>
</div>
<?php } ?>