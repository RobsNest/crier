<?php
session_start();

require_once 'rgflyby/Mobile_Detect.php';
$detect = new Mobile_Detect;
if ( $detect->isMobile() ) {
    header('Location: trooper5/warning.php');
	exit;
}

include("includes/edit.inc.php");

date_default_timezone_set('America/New_York');
$today = date('l F jS Y');
$visitorIp = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
$webpage = "Trooper 5";
include("includes/logit.inc.php");
writeLog($visitorIP, $webpage);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Trooper 5, A Javascript Game - The Cumberland Crier - <?php echo $today?></title>
  	
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />	
	<meta name=”description” content=”Trooper 5; A Javascript Game with a Cumberland Maryland flavor.” />
	<link rel="icon" type="image/png" href="images/crier.png" />
	<link rel="stylesheet" type="text/css" id="stylesheet" href="css/main.css" />

<style type="text/css">
body
{
background-image:url('images/crier.png');
background-attachment:fixed;
background-repeat:no-repeat;
background-position:bottom left;
}
div#header{
top: 0;
left: 0;
width: 100%;
height: 3cm;
}
@media screen{
	body>div#header{
	position: fixed;
	}
}
* html div#content{
    height: 100%;
    overflow: auto;
}
</style>

</head>

<body bgcolor="#FFFFFF" text="#000000" topmargin="0">
<div id="pagetop">
<table align="center" width="93%" border="0"><tr align="center" valign="middle">
<td align="center" width="40%">
<a href="https://www.cumberlandcrier.com" class="titletext">The Cumberland Crier</a>
<br /><br />
<a href="https://www.cumberlandcrier.com" class="tandt"><?php echo $today?>  </a><span class="tandt" id="myclock"></span>
<script type="text/javascript" src="js/clock.js"></script>
</td><td align="left" width="*"><div class="info">
<?php printIntro(); ?>
</div></td>
<td align="center" width="135">
<a href="midatlantic.php"><img src="http://images.intellicast.com/WxImages/RadarLoop/shd_None_anim.gif" alt="Mid Atlantic Radar" border="0" width="150" height="97" title="Mid Atlantic Radar" /></a></center>
<?php
  $json_string = file_get_contents("http://api.wunderground.com/api/ef6be0c646ab41f3/geolookup/conditions/q/MD/Cumberland.json");
  $parsed_json = json_decode($json_string);
  $temp_f = $parsed_json->{'current_observation'}->{'temp_f'};
  $json_string = file_get_contents("http://api.wunderground.com/api/ef6be0c646ab41f3/forecast/q/MD/Cumberland.json");
  $parsed_json = json_decode($json_string);
  $forecast = $parsed_json->{'forecast'}->{'fctext'};
?>
<a href="midatlantic.php" class="tandt" title="Current temperature is <?php echo $temp_f?>&deg; in Cumberland, Md."><?php echo $temp_f?>&deg;</a>
</td></tr></table>
</div>

<br /><br /><br /><br /><br /><br />
<table align="center" width="95%" border="0"><tr align="center" valign="top">
<td align="left" width="25%">
<div class="menuleft">
<center><img src="images/BoraRonnoc.png" alt="Bora Ronnoc" border="0" width="90" height="135" /><br />
<a href="mailto:trebor@cumberlandcrier.com" class="pub">Trebor Ronnoc; Publisher</a><br />
<a href="mailto:trebor@cumberlandcrier.com" class="pub">trebor@cumberlandcrier.com</a>
<?php printLinks(); ?>
</div>
</td>
<td align="center" width="75%" background="trooper5/tableBG.png" fixed>

<center><a href="trooper5/trooper5.php" class="tandt" target="display">Trooper 5</a></center>

<center>
<iframe name="display" id="display" src="trooper5/trooper5.php" width="520" height="420" 
frameborder="0" scrolling="auto">Your broswer does not support inline frames</iframe>
</center>

</td>
</tr></table>

<div id="bottom">
<?php printAds(); ?>
</div>
<script type="text/javascript"> var infolinks_pid = 3107332; var infolinks_wsid = 0; </script> <script type="text/javascript" src="//resources.infolinks.com/js/infolinks_main.js"></script>
</body>
</html>
