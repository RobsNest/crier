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
	<title>The Cumberland Crier - <?php echo $today?></title>
  	
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />	

	<link rel="icon" type="image/png" href="../images/crier.png" />
	<link rel="stylesheet" type="text/css" id="stylesheet" href="../css/main.css" />

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
<a href="https://www.cumberlandcrier.com" class="tandt"><?php echo $today?>  </a><span class="tandt" id="myclock"></span>
<script type="text/javascript" src="../js/clock.js"></script>
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
<center><img src="../images/BoraRonnoc.png" alt="Bora Ronnoc" border="0" width="90" height="135" /><br />
<a href="mailto:trebor@cumberlandcrier.com" class="pub">Trebor Ronnoc; Publisher</a><br />
<a href="mailto:trebor@cumberlandcrier.com" class="pub">trebor@cumberlandcrier.com</a>
<?php printLinks(); ?>
</div>
</td>
<td align="center" width="75%">
<hr width="60%" color="#C0C0C0" />

<center><a href="index.php" class="titletext">Visitor Log</a></center>

<br />

<?php $linecount--;?>
<center><b>Page Views: <?php echo $linecount?></b></center>
<table align="center"><tr valign="top">
<td align="left">
	<textarea class="forminput" id="notes" name="notes" rows="12" cols="72" ><?php echo $data?></textarea>
</td>
</tr></table>
<script language="JavaScript" type="text/javascript">
<!-- Begin
var textarea = document.getElementById('notes');
textarea.scrollTop = textarea.scrollHeight;
// End -->
</script>

<br />

<center><b>Page Counts</b></center>
<table align="center">
<?php

$datfile = "visitor.log";
$pageCnt = array();

$fh = fopen($datfile, 'r') or die("Couldn't open proper file");
while(!feof($fh)) {
    $line = fgets($fh);
    $filemessage = explode("|", $line);
    $webpage = $filemessage[6];
    $pageCnt[$webpage]++;
}
arsort($pageCnt);
foreach($pageCnt as $page => $visits) {
	echo "<tr><td align=\"left\">" . $page . "</td><td align=\"right\">" . $visits . "</td></tr>";
	$total = $total + $visits;	
}

fclose($fh);

$total--;
echo "<tr><td align=\"left\"><b>Total</b></td><td align=\"right\"><b>" . $total . "</b></td></tr></table>";

?>

<center><b>Visitor Count</b></center>
<table align="center">
<?php

$datfile = "visitor.log";
$pageCnt = array();
$total = 0;

$fh = fopen($datfile, 'r') or die("Couldn't open proper file");
while(!feof($fh)) {
    $line = fgets($fh);
    $filemessage = explode("|", $line);
    $ip = $filemessage[1];
    $visitorCnt[$ip]++;
}
arsort($visitorCnt);
foreach($visitorCnt as $ip => $views) {
	echo "<tr><td align=\"left\">" . $ip . "</td><td align=\"right\">" . $views . "</td></tr>";
	$total = $total + $views;	
}

fclose($fh);

$total--;
echo "<tr><td align=\"left\"><b>Total</b></td><td align=\"right\"><b>" . $total . "</b></td></tr></table>";

?>

</td>
</tr></table>

</body>
</html>
