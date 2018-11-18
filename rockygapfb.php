<?php
session_start();

require_once 'rgflyby/Mobile_Detect.php';
$detect = new Mobile_Detect;
if ( $detect->isMobile() ) {
	header('Location: rgflyby/warning.php');
    exit;
}


include("includes/edit.inc.php");

date_default_timezone_set('America/New_York');
$today = date('l F jS Y');
$visitorIp = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
$webpage = "Rocky Gap Fly By";
include("includes/logit.inc.php");
writeLog($visitorIP, $webpage);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Rocky Gap Fly By, A Javascript Game - RobsNest Software & Server Designs  - <?php echo $today?></title>
  	
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />	
	<meta name=”description” content=”Trooper 5; A Javascript Game with a Cumberland Maryland flavor.” />
	<link rel="icon" type="image/png" href="images/crier.png" />
	<link rel="stylesheet" type="text/css" id="stylesheet" href="css/main.css" />

<style type="text/css">
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

<body bgcolor="#000000" text="#000000" topmargin="0">

<br /><br />

<table align="center"><tr>
<td align="center" width="75%" background="rgflyby/wallpaper.png" fixed>
<br />
<center><a href="rgflyby/rgflyby.php" class="tandt" target="display">Rocky Gap Fly By</a></center>
<br />
<center>
<iframe name="display" id="display" src="rgflyby/rgflyby.php" width="520" height="420" 
frameborder="0" scrolling="auto">Your broswer does not support inline frames</iframe>
</center>
</td>
</tr></table>

<div id="bottom">
<a href="https://robsnest.net/development" class="robsnest">Rob's Freelance Web Service</a>
</div>
</body>
</html>
