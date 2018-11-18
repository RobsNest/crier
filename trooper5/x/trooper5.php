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
    		background-color: transparent;
		}
	</style>

</head>

<body onload="startGame()">


<script>

var myGamePiece;
var myBackground;
var mySound;
var bkSound;
var myObstacles = [];
var myScore;


function startGame() {
    myGamePiece = new component(45, 30, "chopper.png", 10, 120, "image");
	mySound = new sound("crash.wav");
	bkSound = new sound("helicopter.mp3");
    myGamePiece.gravity = 0.05;
    myBackground = new component(656, 270, "background.png", 0, 0, "background");
    myScore = new component("30px", "Consolas", "black", 280, 40, "text");
    myGameArea.start();
}

var myGameArea = {
    canvas : document.createElement("canvas"),
    start : function() {
        this.canvas.width = 480;
        this.canvas.height = 270;
        this.context = this.canvas.getContext("2d");
        document.body.insertBefore(this.canvas, document.body.childNodes[0]);
        this.frameNo = 0;
        updateGameArea();
        },
	stop : function() {
        clearInterval(this.interval);
	    }, 
    clear : function() {
        this.context.clearRect(0, 0, this.canvas.width, this.canvas.height);
    }
}

function component(width, height, color, x, y, type) {
    this.type = type;
    if (type == "image" || type == "background") {
        this.image = new Image();
        this.image.src = color;
    }
    this.score = 0;
    this.width = width;
    this.height = height;
    this.speedX = 0;
    this.speedY = 0;    
    this.x = x;
    this.y = y;
    this.gravity = 0;
    this.gravitySpeed = 0;
	this.bounce = 0.6;
    this.update = function() {
        ctx = myGameArea.context;
        if (type == "image" || type == "background") {
            ctx.drawImage(this.image, 
                this.x, 
                this.y,
                this.width, this.height);
        	if (type == "background") {
            	ctx.drawImage(this.image, 
                	this.x + this.width, 
                	this.y,
                	this.width, this.height);
        	}

        }else if (this.type == "text") {
            ctx.font = this.width + " " + this.height;
            ctx.fillStyle = color;
            ctx.fillText(this.text, this.x, this.y);
        } else {
            ctx.fillStyle = color;
            ctx.fillRect(this.x, this.y, this.width, this.height);
        }

    }
    this.newPos = function() {
        this.gravitySpeed += this.gravity;
        this.x += this.speedX;
        this.y += this.speedY + this.gravitySpeed;
        if (this.type == "background") {
            if (this.x == -(this.width)) {
                this.x = 0;
            }
        }
        this.hitBottom();
    }
    this.hitBottom = function() {
        var rockbottom = myGameArea.canvas.height - this.height;
        if (this.y > rockbottom) {
            this.y = rockbottom;
			this.gravitySpeed = -(this.gravitySpeed * this.bounce);
        }
    }
    this.crashWith = function(otherobj) {
        var myleft = this.x;
        var myright = this.x + (this.width);
        var mytop = this.y;
        var mybottom = this.y + (this.height);
        var otherleft = otherobj.x;
        var otherright = otherobj.x + (otherobj.width);
        var othertop = otherobj.y;
        var otherbottom = otherobj.y + (otherobj.height);
        var crash = true;
        if ((mybottom < othertop) || (mytop > otherbottom) || (myright < otherleft) || (myleft > otherright)) {
            crash = false;
        }
        return crash;
    }
}

function updateGameArea() {
    var x, height, gap, minHeight, maxHeight, minGap, maxGap;
    for (i = 0; i < myObstacles.length; i += 1) {
        if (myGamePiece.crashWith(myObstacles[i])) {
			bkSound.stop();
			mySound.play();
			bkSound = new sound("taps.mp3");
			bkSound.play();
			myGameArea.stop();
            return;
        } 
    }
    myGameArea.clear();
    myBackground.speedX = -1;
    myBackground.newPos();    
    myBackground.update();
    myGameArea.frameNo += 1;
    if (myGameArea.frameNo == 1 || everyinterval(150)) {
        x = myGameArea.canvas.width;
        minHeight = 20;
        maxHeight = 200;
        height = Math.floor(Math.random()*(maxHeight-minHeight+1)+minHeight);
        minGap = 50;
        maxGap = 200;
        gap = Math.floor(Math.random()*(maxGap-minGap+1)+minGap);
        myObstacles.push(new component(10, height, "red", x, 0));
        myObstacles.push(new component(10, x - height - gap, "red", x, height + gap));
    }
    for (i = 0; i < myObstacles.length; i += 1) {
        myObstacles[i].x += -1;
        myObstacles[i].update();
    }
    myScore.text="SCORE: " + (myGameArea.frameNo - 1);
    myScore.update();
    myGamePiece.newPos();
    myGamePiece.update();
}

function sound(src) {
    this.sound = document.createElement("audio");
    this.sound.src = src;
    this.sound.setAttribute("preload", "auto");
    this.sound.setAttribute("controls", "none");
    this.sound.style.display = "none";
    document.body.appendChild(this.sound);
    this.play = function(){
        this.sound.play();
    }
    this.stop = function(){
	    this.sound.pause();
    }    
}

function everyinterval(n) {
    if ((myGameArea.frameNo / n) % 1 == 0) {return true;}
    return false;
}

function accelerate(n) {
    if (!myGameArea.interval) {
		myGameArea.interval = setInterval(updateGameArea, 20);
    	myGamePiece.image.src = "chopper.png";
	}

    myGamePiece.gravity = n;
    myGamePiece.image.src = "chopperGo.png";
	bkSound.play();
}
</script>
<br />
<center>
<button onmousedown="accelerate(-0.2)" onmouseup="accelerate(0.05)"><b>&nbsp;&nbsp;&nbsp;&nbsp;   |=|=|   START   |=|=|    &nbsp;&nbsp;&nbsp;&nbsp;</b></button>
</center>




</body>
</html>
