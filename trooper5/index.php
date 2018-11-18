<?php
session_start();

date_default_timezone_set('America/New_York');
$today = date('l F jS Y');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Trooper 5 - <?php echo $today?></title>
  	
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />	
	<link rel="icon" type="image/png" href="chopper.png" />
	<link rel="stylesheet" type="text/css" id="stylesheet" href="css/main.css" />
	
<style type="text/css">
body
{
background-image:url('images/cumberland.jpg');
background-attachment:fixed;
background-repeat:no-repeat;
background-position:center;
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

<body bgcolor="#FFFFFF" text="#000000">

<br /><br />
<center><a href="trooper5.php" class="title" target="display">Trooper 5</a></center>
<br /><br />

<center>
<iframe name="display" id="display" src="trooper5.php" width="520" height="420" 
frameborder="0" scrolling="auto">Your broswer does not support inline frames</iframe>
</center>

</body>
</html>
