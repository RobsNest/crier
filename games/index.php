<?
session_start();
$visitorIp = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
$webpage = "Game Room";
include("includes/logit.inc.php");
writeLog($visitorIP, $webpage);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>The Game Room</title>
  	
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />	
<meta name=”description” content=”A collection of Video Games from a day gone by.” />
	<link rel="icon" type="image/png" href="images/gamesIcon.png" />
	<link rel="stylesheet" type="text/css" id="stylesheet" href="css/main.css" />

<style type="text/css">
body
{
background-image:url('images/gametime.png');
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

<body bgcolor="#000000" text="#FFFFFF" topmargin="0">

<table align="center"cellpadding="8"><tr align="center" valign="middle">
<td align="center"><a href="https://www.cumberlandcrier.com/games" class="heading">The Game Room</a></td>
</tr></table>

<center>
<iframe name="gameroom" id="gameroom" src="gameroom.php" width="725" height="400" frameborder="1" scrolling="auto">Your broswer does not support inline frames</iframe>
</center>

<div id="bottom">
<center><a href="http://www.cumberlandcrier.com/" class="subtext" title="RobsNest">Cumberland Crier</a></center>
</div>
</body>
</html>
