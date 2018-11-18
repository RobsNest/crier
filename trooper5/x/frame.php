<?php
session_start();

date_default_timezone_set('America/New_York');
$today = date('l F jS Y');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>The Game - <?php echo $today?></title>
  	
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />	
	<link rel="icon" type="image/png" href="images/play.png" />
	<link rel="stylesheet" type="text/css" id="stylesheet" href="css/main.css" />
	

</head>

<body bgcolor="#FFFFFF" text="#000000">

<br /><br /><br />

<center>
<iframe name="display" id="display" src="gravity.php" width="650" height="550" 
frameborder="1" scrolling="auto">Your broswer does not support inline frames</iframe>
</center>


</body>
</html>
