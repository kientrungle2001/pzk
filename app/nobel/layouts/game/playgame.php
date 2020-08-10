 <html>
<head>
    <title>Text Animation</title>
    <style>
        canvas{border: 1px solid #bbb;}
        .subdiv{width: 320px;}
        .text{margin: auto; width: 290px;}
		
    </style>
<?php $word= $data->getWord();?>
<script type="text/javascript">
        var can, ctx, step = 0, steps = 0, delay = 10;
        function init() {
            can = document.getElementById("MyCanvas1");
			ctx = can.getContext("2d");	
			ctx.fillStyle = "white";
			ctx.font = "14pt Verdana";
			RunTextTopBottom();
        }
		// su kien nhap chuot 		
			can.onmousedown = mouseDown;
			can.onmouseup = mouseUp;
			can.onmousemove = mouseMove;
		function RunTextTopBottom(){
			base_image = new Image();
			base_image.src = '/3rdparty/uploads/gamebg.jpg';
			ctx.drawImage(base_image, 0, 0, 870,600);
			soundEfx = new Audio();
			soundEfx.src= '/3rdparty/uploads/videos/soundtrack.mp3';
			soundEfx.play();
			step++;
			steps = can.height;//cho step tang dan tu 0->chieu cao
			//ctx.clearRect(0, 0, can.width, can.height);// xoa nhung anh khi chu da di qua
            ctx.save();	
            ctx.translate(350, step);//chuyen dong
			<?php foreach($word as $game): ?>
					ctx.fillText("<?php echo @$game['game_title']?>", <?php echo rand(-350,350);?>, <?php echo rand(0,350);?>);
			<?php endforeach; ?>
			ctx.restore(); // in chu ra game va luu lai
            if (step == steps)
                step = 0;
            if (step < steps)
                var t = setTimeout('RunTextTopBottom()', delay);//vong lap game cho chu chay den het chieu cao
		function mouseDown(e){
			var x = e.pageX - this.offsetLeft;
			var y = e.pageY - this.offsetTop;
			
		}
		function mouseMove(e){
			
		}
		function mouseUp(e){
			
		}
		}
		
    </script>
</head>
<body onload="init();">
    <div class="subdiv">
        <canvas id="MyCanvas1" width="870" height="600">
  This browser or document mode doesn't support canvas object</canvas>
    </div>
</body>
</html><!–more–>