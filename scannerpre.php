<?php
session_start();

$channel = "scanchan01.php";
$url = "https://www.broadcastify.com/listen/ctid/1189";
$title = "Allegany County Fire - LTR Passport";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<link rel="stylesheet" type="text/css" id="stylesheet" href="css/main.css" />
	<meta http-equiv="refresh" content="3;URL='<?php echo $channel?>'" />
</head>

<body bgcolor="#FFFFFF" text="#000000" topmargin="0">

<br /><br />

<center>
<iframe name="broadcastify" id="broadcastify" src="<?php echo $url?>" width="250" height="200" 
frameborder="1" scrolling="auto">Your broswer does not support inline frames</iframe>
</center>

<div id="bottom">
<table align="center" width="310" background="images/bgTile.jpg"><tr><td>
<table align="center" width="100%" cellpadding="0"><tr>
<td align="left"><img src="images/head.png" width="22" height="22" /></td>
<td align="center"><!--<div class="scanner"><?php echo $title?>--></div></td>
<td align="right"><img src="images/head.png" width="22" height="22" /></td>
</tr></table>
<center><img src="images/speaker.png" width="250" height="250" border="0" /><center>
<table align="center" width="100%" cellpadding="0"><tr>
<td align="left"><img src="images/head.png" width="22" height="22" /></td>
<td align="right"><img src="images/head.png" width="22" height="22" /></td>
</tr></table>
</td></tr></table>
</div>

</body>
</html>
