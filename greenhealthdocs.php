<?php
session_start();

date_default_timezone_set('America/New_York');
$today = date('l F jS Y');
$visitorIp = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
$webpage = "Green Health Docs";
include("includes/logit.inc.php");
writeLog($visitorIP, $webpage);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Rep #023 Green Health Docs - <?php echo $today?></title>
  	
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />	
	<meta name=”description” content=”Carpet Steam Cleaning at its finest! Contact Eddie McPartland at 301-777-8840 and schedule your appointment today.” />
	<link rel="icon" type="image/png" href="images/crier.png" />
	<link rel="stylesheet" type="text/css" id="stylesheet" href="css/main.css" />

</head>

<body bgcolor="#FFFFFF" text="#000000" topmargin="0">

<br /><br /><br /><br /><br />

<center><a href="https://www.cumberlandcrier.com"><img src="images/ads/GreenHealthDocs650x169.png" alt="Green Health Docs" title="Mention Sales Rep #023" width="650" height="169" border="0" /></a></center>
</body>
</html>
