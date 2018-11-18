<?php
session_start();

date_default_timezone_set('America/New_York');
$today = date('l F jS Y');

$visitorIp = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
$webpage = "Chat - $visitorIp";
include("../includes/logit.inc.php");
writeLog($visitorIP, $webpage);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Chat Room BETA - The Cumberland Crier - <?php echo $today?></title>
  	
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />	
	<meta name=”description” content=”Cumberland Crier Chat Room Beta Test.” />
	<link rel="icon" type="image/png" href="../images/crier.png" />

	<link rel="stylesheet" type="text/css" href="cb_style.css">
	<link rel="stylesheet" type="text/css" id="stylesheet" href="../css/main.css" />

	<script type="text/javascript" src="ajax.js"></script>
	<script type="text/javascript" src="chatbox.js"></script>
</head>

<body background="../images/bgTile.jpg" topmargin="0" onbeforeunload="signInForm.signInButt.name='signOut';signInOut()" onload="hideShow('hide');document.theForm.userName.focus()">

<table align="center" width="100%" cellpadding="4"><tr>
<td align="left"><img src="../images/head.png" width="22" height="22" /></td>
<td align="center"><a href="chatroom.php" title="Refresh Chat" class="chatroom">Cumberland Crier Chat</a></td>
<td align="right"><img src="../images/head.png" width="22" height="22" /></td>
</tr></table>

<table align="center" border="1" cellspacing="1" cellpadding="1">
<tr><td align="left">
	<form onsubmit="signInOut();return false" id="signInForm" name="theForm">
		<input id="userName" name="userName" type="text">
		<input id="signInButt" name="signIn" type="submit" value="Sign in">
		<span id="signInName">User name</span>
	</form>
</td><td>&nbsp;</td></tr>
<tr><td align="left"
	<div id="chatBox"></div>
</td><td align="left">
	<div id="usersOnLine"></div>
</td></tr>
<tr><td align="left" style="white-space: nowrap">
	<form onsubmit="sendMessage();return false" id="messageForm">
		<input id="message" type="text">
		<input id="send" type="submit" value="Send">
	</form>
</td><td align="left">
		<div id="serverRes"></div>
</td></tr></table>


<div id="bottom">
<table align="center" width="100%" cellpadding="4"><tr>
<td align="left"><img src="../images/head.png" width="22" height="22" /></td>
<td align="center"></td>
<td align="right"><img src="../images/head.png" width="22" height="22" />&nbsp;</td>
</tr></table>
</div>
</body>
</html>
