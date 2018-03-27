<<!DOCTYPE html>
<html>
<head>
<title></title>
 <script src="https://code.createjs.com/createjs-2015.05.21.min.js"></script>
<script>
	
  function init() {
	  var stage = new createjs.Stage("hookword");
	  var circle = new createjs.Shape();
	  var polygon = new createjs.Shape();
	circle.graphics.beginFill("DeepSkyBlue").drawCircle(0, 0, 50);
	circle.x = 450;
	circle.y = 0;
	stage.addChild(circle);
	var polygon = new createjs.Shape();
	polygon.graphics.beginStroke("black");
	polygon.graphics.moveTo(435, 50).lineTo(465, 50).lineTo(450, 70).lineTo(435, 50);
	stage.addChild(polygon);
	stage.update();
  }
</script>
</head>
<body>
<body onload="init();">
  <canvas id="hookword" width="900" height="500" style="border: 1px solid red;"></canvas>
</body>
</body>
</html>