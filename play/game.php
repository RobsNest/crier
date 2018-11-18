<?php
session_start();

date_default_timezone_set('America/New_York');
$today = date('l F jS Y');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>The Game - <?php echo $today?></title>
  	
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />	
	<link rel="icon" type="image/png" href="images/play.png" />
	<link rel="stylesheet" type="text/css" id="stylesheet" href="css/main.css" />
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<style>
		canvas {
    		border: 1px solid #d3d3d3;
    		background-color: #f1f1f1;
		}
	</style>

</head>

<body bgcolor="#FFFFFF" text="#000000" onload="startGame()">

<script>
var redGamePiece, blueGamePiece, yellowGamePiece;

function startGame() {
    redGamePiece = new component(75, 75, "red", 10, 10);
    yellowGamePiece = new component(75, 75, "yellow", 50, 60);    
    blueGamePiece = new component(75, 75, "blue", 10, 220);
    myGameArea.start();
}

var myGameArea = {
    canvas : document.createElement("canvas"),
    start : function() {
        this.canvas.width = 480;
        this.canvas.height = 270;
        this.context = this.canvas.getContext("2d");
        document.body.insertBefore(this.canvas, document.body.childNodes[0]);
        this.interval = setInterval(updateGameArea, 20);
    },
    clear : function() {
        this.context.clearRect(0, 0, this.canvas.width, this.canvas.height);
    }
}

function component(width, height, color, x, y) {
    this.width = width;
    this.height = height;
    this.x = x;
    this.y = y;    
    this.update = function(){
        ctx = myGameArea.context;
        ctx.fillStyle = color;
        ctx.fillRect(this.x, this.y, this.width, this.height);
    }
}

function updateGameArea() {
    myGameArea.clear();
    redGamePiece.x += 1;
    yellowGamePiece.x += 1;    
    yellowGamePiece.y += 1;        
    blueGamePiece.x += 1;        
    blueGamePiece.y -= 1;            
    redGamePiece.update();
    yellowGamePiece.update();        
    blueGamePiece.update();
}
</script>


<p>The Game; I hope.</p>



</body>
</html>
