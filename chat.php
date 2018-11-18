<?php
session_start();

include("includes/edit.inc.php");

date_default_timezone_set('America/New_York');
$today = date('l F jS Y');
$visitorIp = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
$webpage = "Chat Room";
include("includes/logit.inc.php");
writeLog($visitorIP, $webpage);

$chatintro = "
	<br /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; *******Chat Room Beta Test*******<br />
	<br />
	This... \"Chat Room\" is our way at Cumberland Crier to see if our readers have any interest in Local Live Chat. 
	There are no <i>bells or whistles</i> but it is functional. If it gains any interest we will direct more 
	resources towards development.<br />
	<br />
	Once signed in, the box on the right will contain a list of currently signed in chatters. This box is where messages are 
	displayed, and below is where you will type your messages to the other signed in users. You can make up any name you 
	like to sign in with.<br />";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Chat Room BETA Test - The Cumberland Crier - <?php echo $today?></title>
  	
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />	
	<link rel="icon" type="image/png" href="images/crier.png" />
	<link rel="stylesheet" type="text/css" id="stylesheet" href="css/main.css" />

	<script type="text/javascript" src="chatbox/ajax.js"></script>
	<script type="text/javascript" src="chatbox/chatbox.js"></script>
	<link rel="stylesheet" type="text/css" href="chatbox/cb_style.css">


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
<script language="JavaScript" type="text/javascript">
<!-- Begin
	function ShowChat(URL) {
	day = new Date();
	id = day.getTime();
	eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=1,scroolbars=yes,location=0,statusbar=0,menubar=1,resizable=0,width=800,height=500');");
	}
// End -->
</script>

</head>
<body bgcolor="#FFFFFF" text="#000000" topmargin="0" onbeforeunload="signInForm.signInButt.name='signOut';signInOut()" onload="hideShow('hide');document.theForm.userName.focus()">
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
<a href="national.php"><img src="http://images.intellicast.com/WxImages/RadarLoop/shd_None_anim.gif" alt="Mid Atlantic Radar" border="0" width="150" height="97" title="Mid Atlantic Radar" /></a></center>
<?php
  $json_string = file_get_contents("http://api.wunderground.com/api/ef6be0c646ab41f3/geolookup/conditions/q/MD/Cumberland.json");
  $parsed_json = json_decode($json_string);
  $temp_f = $parsed_json->{'current_observation'}->{'temp_f'};
  $json_string = file_get_contents("http://api.wunderground.com/api/ef6be0c646ab41f3/forecast/q/MD/Cumberland.json");
  $parsed_json = json_decode($json_string);
  $forecast = $parsed_json->{'forecast'}->{'fctext'};
?>
<a href="https://www.wunderground.com/weather-forecast/zmw:21502.1.99999" target="_blank" class="tandt" title="Current temperature is <?php echo $temp_f?>&deg; in Cumberland, Md."><?php echo $temp_f?>&deg;</a>
</td></tr></table>
</div>

<br /><br /><br /><br /><br />

<table align="center" width="95%" border="0"><tr align="center" valign="top">
<td align="left" width="25%">
<div class="menuleft">
<center><img src="images/BoraRonnoc.png" alt="Bora Ronnoc" border="0" width="90" height="135" /><br />
<a href="mailto:trebor@cumberlandcrier.com" class="pub">Trebor Ronnoc; Publisher</a><br />
<a href="mailto:trebor@cumberlandcrier.com" class="pub">trebor@cumberlandcrier.com</a>
<?php printLinks(); ?>
</div>
</td>
<td align="center" width="75%">
<center>
<a href="https://www.facebook.com/criereditor/" title="Follow Us on Facebook" target="_blank"><img src="images/smFacebook.png" alt="Follow Us on Facebook" width="35" height="35" border="0" /></a>
<a href="https://twitter.com/ClandCrier" title="Follow Us on Twitter" target="_blank"><img src="images/smTwitter.png" alt="Follow Us on Twitter" width="35" height="35" border="0" /></a>
<a href="https://plus.google.com" title="Follow Us on Google +" target="_blank"><img src="images/smGplus.png" alt="Follow Us on Google +" width="35" height="35" border="0" /></a>
<a href="https://www.linkedin.com/" title="Follow Us on Linked In" target="_blank"><img src="images/smLinkedIn.png" alt="Follow Us on Linked In" width="35" height="35" border="0" /></a>
</center>

<table align="center" border="0" cellspacing="5" cellpadding="5">
<tr><td align="left">
	<form onsubmit="signInOut();return false" id="signInForm" name="theForm">
		<input id="userName" name="userName" type="text">
		<input id="signInButt" name="signIn" type="submit" value="Sign In">
		<span id="signInName">User name</span>
	</form>
</td><td>&nbsp;</td></tr>
<tr><td align="left"
	<div id="chatBox"><?php echo $chatintro?></div>
</td><td align="left">
	<div id="usersOnLine"></div>
</td></tr>
<tr><td align="left" style="white-space: nowrap">
	<form onsubmit="sendMessage();return false" id="messageForm">
		<input id="message" type="text" autocomplete="off">
		<input id="send" type="submit" value="Send">
	</form>
</td><td align="left">
		<div id="serverRes"></div>
</td></tr></table>


</td>
</tr></table>
<br /><br /><br /><br />
<div id="bottom">
<?php printAds(); ?>
</div>
</body>
</html>
