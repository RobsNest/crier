<?
session_start();

$visitorIp = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
$webpage = "GameRoom";
include("includes/logit.inc.php");
writeLog($visitorIP, $webpage);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />	
	<link rel="stylesheet" type="text/css" id="stylesheet" href="css/main.css" />


<style type="text/css">
body
{
background-image:url('images/bg.png');
background-attachment:fixed;
background-repeat:no-repeat;
background-position:top right;
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
	function ShowDecrypt(URL) {
	day = new Date();
	id = day.getTime();
	eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=1,resizable=0,width=500,height=305');");
	}
// End -->
</script>

</head>

<body bgcolor="#000000" text="#FFFFFF" topmargin="0">

<div class="gameboard">
<table cellpadding="14" bgcolor="#000040" border="1"><tr align="center">
<td align="center">
<a href="pacman/Pacman.html" target="_blank" class="game"> Pacman </a><br />
</td>
<td align="center">
<a href="chess/" target="_blank" class="game">Chess </a><br />
</td>
<td align="center">
<a href="spaceinvaders/" target="_blank" class="game">Space Invaders</a><br />
</td>
<td align="center">
<a href="tetris/" target="_blank" class="game">Tetris</a><br />
</td>
<td align="center">
<a href="asteroids/" target="_blank" class="game">Asteroids</a><br />
</td>
</tr></table>
</div>

</body>
</html>
