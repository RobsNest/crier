<?php
session_start();

date_default_timezone_set('America/New_York');
$today = date('l F jS Y');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Play - <?php echo $today?></title>
  	
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />	
	<meta name=”description” content=”NaviGator, the delivery persons friend.” />
	<link rel="icon" type="image/png" href="images/play.png" />
	<link rel="stylesheet" type="text/css" id="stylesheet" href="css/main.css" />

</head>

<body bgcolor="#FFFFFF" text="#000000">
<div id="pagetop">
<center><a href="index.php" class="title">Play</a></center>
</div>

<br /><br /><br />
<br /><hr width="55%" /><br />



<br /><hr width="55%" /><br />
<table align="center" width="65%"><tr valign="middle">
<td align="center">
<p>Image to use:</p>

<img id="scream" width="220" height="277"
src="images/the_scream.jpg" alt="The Scream">

</td><td align="center">

<p>Canvas:</p>

<canvas id="myCanvas" width="240" height="297"
style="border:1px solid #d3d3d3;">
Your browser does not support the HTML5 canvas tag.
</canvas>

</td></tr></table>

<script>
window.onload = function() {
   var canvas = document.getElementById("myCanvas");
   var ctx = canvas.getContext("2d");
   var img = document.getElementById("scream");
   ctx.drawImage(img, 10, 10);
   };
</script>


<br /><hr width="55%" /><br />

<center>
<canvas id="theCanvas" width="600" height="400" style="border:1px solid #000000;">
Your browser does not support the canvas element.
</canvas>
</center>


<script>
var canvas = document.getElementById("theCanvas");
var ctx = canvas.getContext("2d");
ctx.font = "30px Arial";
ctx.fillText("I Love Vivi!",10,50);
</script>

<script>
var canvas = document.getElementById("theCanvas");
var ctx=canvas.getContext("2d");
ctx.font="30px Comic Sans MS";
ctx.fillStyle = "red";
ctx.textAlign = "center";
ctx.fillText("Hey VIVIAN!", canvas.width/1.5, canvas.height/2);
</script>

<script>
var canvas = document.getElementById("theCanvas");
var ctx = canvas.getContext("2d");
ctx.moveTo(120,120);
ctx.lineTo(600,400);
ctx.stroke();

ctx.moveTo(120,120);
ctx.lineTo(120,300);
ctx.stroke();

ctx.moveTo(120,120);
ctx.lineTo(400, 120);
ctx.stroke();

</script>







<br /><hr width="55%" /><br />

<center><div id="map" style="width:70%;height:400px;"></div></center>

<script>
function myMap() {
	var mapCanvas = document.getElementById("map");
	var myCenter=new google.maps.LatLng(39.651739,-78.757948);
	var mapOptions = {
		center: myCenter, 
		zoom: 15,
		mapTypeId: google.maps.MapTypeId.HYBRID,
		disableDefaultUI: true	
	};
	var map = new google.maps.Map(mapCanvas, mapOptions);
	google.maps.event.addListener(map, 'click', function(event) {
		placeMarker(map, event.latLng);
	});
}
function placeMarker(map, location) {
	var marker = new google.maps.Marker({
	position: location,
	map: map
	});
	var infowindow = new google.maps.InfoWindow({
		content: 'Latitude: ' + location.lat() + '<br>Longitude: ' + location.lng()
	});
	infowindow.open(map,marker);
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBlKfDWnATthjTn4xf_vJHAv-gmsOmzVBE&callback=myMap"></script>

<br /><hr width="55%" /><br />

<table align="center" border="1"><tr valign="middle">
<td align="center">

<svg height="60" width="200">
	<text x="0" y="15" fill="red" transform="rotate(30 20,40)">I love Vivi!</text>
</svg>

</td><td align="center">

<svg width="100" height="100">
	<circle cx="50" cy="50" r="40" stroke="green" stroke-width="4" fill="yellow" />
</svg>

</td><td align="center">

<svg height="400" width="450">
<path id="lineAB" d="M 100 350 l 150 -300" stroke="red"
   stroke-width="3" fill="none" />
<path id="lineBC" d="M 250 50 l 150 300" stroke="red"
    stroke-width="3" fill="none" />
<path d="M 175 200 l 150 0" stroke="green" stroke-width="3"
    fill="none" />
<path d="M 100 350 q 150 -300 300 0" stroke="blue"
    stroke-width="5" fill="none" />
<!-- Mark relevant points -->
<g stroke="black" stroke-width="3" fill="black">
<circle id="pointA" cx="100" cy="350" r="3" />
<circle id="pointB" cx="250" cy="50" r="3" />
<circle id="pointC" cx="400" cy="350" r="3" />
</g>
<!-- Label the points -->
<g font-size="30" font-family="sans-serif" fill="black" stroke="none"
   text-anchor="middle">
<text x="100" y="350" dx="-30">A</text>
<text x="250" y="50" dy="-10">B</text>
<text x="400" y="350" dx="30">C</text>
</g>
</svg>
</td></tr><tr valign="middle"><td align="center">

</td><td align="center">

<svg height="150" width="400">
	<defs>
		<linearGradient id="grad3" x1="0%" y1="0%" x2="100%" y2="0%">
			<stop offset="0%" style="stop-color:rgb(255,255,0);stop-opacity:1" />
			<stop offset="100%" style="stop-color:rgb(255,0,0);stop-opacity:1" />
		</linearGradient>
	</defs>
	<ellipse cx="200" cy="70" rx="85" ry="55" fill="url(#grad3)" />
	<text fill="#ffffff" font-size="45" font-family="Verdana" x="150" y="86">VIVI</text>
</svg>
</td><td align="center">

</td></tr><tr valign="middle"><td align="center">

<svg height="210" width="200">
	<polygon points="100,10 40,198 190,78 10,78 160,198"
    	style="fill:lime;stroke:purple;stroke-width:5;fill-rule:evenodd;" />
</svg>

</td><td align="center">

<svg height="80" width="300">
	<g fill="none" stroke="black" stroke-width="4">
		<path stroke-dasharray="5,5" d="M5 20 l215 0" />
		<path stroke-dasharray="10,10" d="M5 40 l215 0" />
		<path stroke-dasharray="20,10,5,5,5,10" d="M5 60 l215 0" />
	</g>
</svg>

</td><td align="center">

<svg height="180" width="500">
	<polyline points="0,40 40,40 40,80 80,80 80,120 120,120 120,160"
    	style="fill:white;stroke:red;stroke-width:4" />
</svg>

</tr><tr valign="middle"></table>



<br /><hr width="55%" /><br />

<div id="bottom">
<a href="index.php" class="title">The Bottom</a>
</div>
</body>
</html>
