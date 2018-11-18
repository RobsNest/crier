<?php
session_start();

include("includes/edit.inc.php");

date_default_timezone_set('America/New_York');
$today = date('l F jS Y');
$visitorIp = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
$webpage = "Weather-MA";
include("includes/logit.inc.php");
writeLog($visitorIP, $webpage);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Weather Forecast with Mid-Atlantic Radar - The Cumberland Crier - <?php echo $today?></title>
  	
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />	
	<meta name=”description” content=”Cumberland, Marylands best Weather at a glance with Mid-Atlantic Radar” />

	<link rel="icon" type="image/png" href="images/crier.png" />
	<link rel="stylesheet" type="text/css" id="stylesheet" href="css/main.css" />

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

<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script> (adsbygoogle = window.adsbygoogle || []).push({
google_ad_client: "ca-pub-4129424170235377",
enable_page_level_ads: true
});
</script>

</head>

<body bgcolor="#FFFFFF" text="#000000" topmargin="0">
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
<a href="national.php"><img src="http://images.intellicast.com/WxImages/RadarLoop/usa_None_anim.gif" alt="Mid Atlantic Radar" border="0" width="150" height="97" title="National Radar" /></a></center>
<?php
  $json_string = file_get_contents("http://api.wunderground.com/api/ef6be0c646ab41f3/geolookup/conditions/q/MD/Cumberland.json");
  $parsed_json = json_decode($json_string);
  $temp_f = $parsed_json->{'current_observation'}->{'temp_f'};
  $temp_str = $parsed_json->{'current_observation'}->{'temperature_string'};
  $condition = $parsed_json->{'current_observation'}->{'weather'};
  $wind = $parsed_json->{'current_observation'}->{'wind_string'};
  $icon = $parsed_json->{'current_observation'}->{'icon_url'};
  $forecast = $parsed_json->{'current_observation'}->{'forecast_url'};
  $obtime = $parsed_json->{'current_observation'}->{'observation_time'};
  $json_string = file_get_contents("http://api.wunderground.com/api/ef6be0c646ab41f3/forecast/q/MD/Cumberland.json");
  $parsed_json = json_decode($json_string);
  $fcttext = $parsed_json->{'forecast'}->{'txt_forecast'}->{'forecastday'}[0]->{'fcttext'};
?>
<a href="national.php" class="tandt" title="Current temperature is <?php echo $temp_f?>&deg; in Cumberland, Md."><?php echo $temp_f?>&deg;</a>
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
<hr width="60%" color="#C0C0C0" />

<table align="center" width="90%" border="0"><tr valign="top">
<td align="left" width="50%">
<?php echo $temp_str?> <br />
<a href="fourday.php" title="Four Day Forecast" target="_parent"><img src="<?php echo $icon?>"width="75" height="75" border="0" /></a><br />
<?php echo $condition?> <br />
<br />
Wind: <?php echo $wind?> <br />
<a class="subtext" href="fourday.php" target="_parent" title="Four Day Forecast"><?php echo $obtime?></a>
<br />
<a class="fourday" href="fourday.php" target="_parent" title="Four Day Forecast">Four Day Forecast</a>
</td>
<td align="left" width="50%">
<a href="national.php"><img src="http://images.intellicast.com/WxImages/RadarLoop/shd_None_anim.gif" alt="National Radar" border="0" width="400" height="258" title="Mid-Atlantic Radar" /></a>
</td>
</tr></table>
<table align="center" width="95%" border="0"><tr align="center" valign="top"><td align="left">
<?php echo $fcttext?>
<br /><br />
</td></tr></table>
</td>
</tr></table>
<br /><br /><br /><br />
<div id="bottom">
<?php printAds(); ?>
</div>
<script type="text/javascript"> var infolinks_pid = 3107332; var infolinks_wsid = 0; </script> <script type="text/javascript" src="//resources.infolinks.com/js/infolinks_main.js"></script>
</body>
</html>
