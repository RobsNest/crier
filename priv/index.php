<?php
session_start();

include("../includes/edit.inc.php");

date_default_timezone_set('America/New_York');
$today = date('l F jS Y');
$visitorIp = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
$webpage = "Visitor Log";
include("../includes/logit.inc.php");
writeLog($visitorIP, $webpage);

$fileToRead = "visitor.log";

$infile = fopen($fileToRead, "r") or die("Unable to open input file!");
$data = fread($infile, filesize($fileToRead));
fclose($infile);
#$data = str_replace("\n", "<br />", $data);

$linecount = 0;
$handle = fopen($fileToRead, "r");
while(!feof($handle)){
  $line = fgets($handle);
  $linecount++;
}

fclose($handle);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Admin Panel - The Cumberland Crier - <?php echo $today?></title>
  	
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />	

	<link rel="icon" type="image/png" href="../images/crier.png" />
	<link rel="stylesheet" type="text/css" id="stylesheet" href="../css/main.css" />

<script language="JavaScript" type="text/javascript">
<!-- Begin
    function ShowQueue(URL) {
	    day = new Date();
	    id = day.getTime();
		eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=1,resizable=0,width=450,height=650');");

    }
// End -->
</script>

<style type="text/css">
body
{
background-image:url('../images/crier.png');
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

<body bgcolor="#FFFFFF" text="#000000" topmargin="0">
<div id="pagetop">
<table align="center" width="93%" border="0"><tr align="center" valign="middle">
<td align="center" width="40%">
<a href="https://www.cumberlandcrier.com" class="titletext">The Cumberland Crier</a>
<br /><br />
<a href="index.php" class="tandt"><?php echo $today?>  </a><span class="tandt" id="myclock"></span>
<script type="text/javascript" src="../js/clock.js"></script>
</td><td align="left" width="*"><div class="info">
<br /><br />
<?php printIntro(); ?>
</div>
<br />
</td>
<td align="center" width="135">
<a href="../midatlantic.php"><img src="http://images.intellicast.com/WxImages/RadarLoop/shd_None_anim.gif" alt="Mid Atlantic Radar" border="0" width="150" height="97" title="Mid Atlantic Radar" /></a></center>
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
<td align="center" width="100%">
<hr width="60%" color="#C0C0C0" />

<table align="center" width="75%"><tr align="center">
<td align="center" width="20%"><a href="pollqueue.php" target="display" class="reports">Poll Queue</a></td>
<td align="center" width="20%"><a href="pages.php" target="display" class="reports">Views</a></td>
<td align="center" width="20%"><a href="articleEditor.php" target="_blank" class="reports">Editor</a></td>
<td align="center" width="20%"><a href="https://www.cumberlandcrier.com/priv/db/" target="_blank" class="reports">Database</a></td>
<td align="center" width="20%"><a href="classqueue.php" target="display" class="reports">Classified Queue</a></td>
</tr></table>

<br />

<center>
<iframe name="display" id="display" src="pages.php" width="950" height="350" 
frameborder="1" scrolling="auto">Your broswer does not support inline frames</iframe>
</center>

<?php

?>

</td>
</tr></table>

</body>
</html>
