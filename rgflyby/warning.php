<?php
session_start();

date_default_timezone_set('America/New_York');
$today = date('l F jS Y');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Rocky Gap Fly By - <?php echo $today?></title>
  	
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />	
	<link rel="icon" type="image/png" href="chopper.png" />
	<link rel="stylesheet" type="text/css" id="stylesheet" href="style.css" />
	
</head>

<body bgcolor="#FFFFFF">

<br /><br /><br />

<center>
<div class="transoval">
It appears you are using a mobile device. I've spent some time 
getting the touch screen working with this Flight Game 
but I have to admit, it seems a bit touchy to me. If you hold 
the Boost button for a second you should begin to get a feel 
for keeping the helicopter maneuvering through the obstacles.
</div>
</center>

<br />

<center>
<a href="mobile.php" class="warning">Try Rocky Gap Fly By Mobile</center>
</center>

</body>
</html>
