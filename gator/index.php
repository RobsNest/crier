<?php
session_start();

date_default_timezone_set('America/New_York');
$today = date('l F jS Y');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>NaviGator, the delivery persons friend- <?php echo $today?></title>
  	
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />	
	<meta name=”description” content=”NaviGator, the delivery persons friend.” />
	<link rel="icon" type="image/png" href="images/Gator.png" />
	<link rel="stylesheet" type="text/css" id="stylesheet" href="css/main.css" />

</head>

<body bgcolor="#FFFFFF" text="#000000">
<div id="pagetop">
<center><a href="index.php"><img src="images/naviGator216x100.png" alt="NaviGator" width="216" height="100" /></a></center>
</div>

<br /><br /><br /><br />
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



<div id="bottom">

</div>
</body>
</html>
