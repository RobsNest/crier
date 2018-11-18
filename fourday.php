<?php
session_start();

include("includes/edit.inc.php");

date_default_timezone_set('America/New_York');
$today = date('l F jS Y');
$visitorIp = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
$webpage = "Weather-Four Day";
include("includes/logit.inc.php");
writeLog($visitorIP, $webpage);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Four Day Forecast - The Cumberland Crier - <?php echo $today?></title>
  	
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

<?php
  $json_string = file_get_contents("http://api.wunderground.com/api/ef6be0c646ab41f3/forecast10day/q/MD/Cumberland.json");
  $parsed_json = json_decode($json_string);
  
  $day1 = $parsed_json->{'forecast'}->{'txt_forecast'}->{'forecastday'}[2]->{'title'};
  $icon1 = $parsed_json->{'forecast'}->{'txt_forecast'}->{'forecastday'}[2]->{'icon_url'};
  $fcst1 = $parsed_json->{'forecast'}->{'txt_forecast'}->{'forecastday'}[2]->{'fcttext'};
  $temph1 = $parsed_json->{'forecast'}->{'simpleforecast'}->{'forecastday'}[1]->{'high'}->{'fahrenheit'};
  $templ1 = $parsed_json->{'forecast'}->{'simpleforecast'}->{'forecastday'}[1]->{'low'}->{'fahrenheit'};
  
  $day2 = $parsed_json->{'forecast'}->{'txt_forecast'}->{'forecastday'}[4]->{'title'};
  $icon2 = $parsed_json->{'forecast'}->{'txt_forecast'}->{'forecastday'}[4]->{'icon_url'};
  $fcst2 = $parsed_json->{'forecast'}->{'txt_forecast'}->{'forecastday'}[4]->{'fcttext'};
  $temph2 = $parsed_json->{'forecast'}->{'simpleforecast'}->{'forecastday'}[2]->{'high'}->{'fahrenheit'};
  $templ2 = $parsed_json->{'forecast'}->{'simpleforecast'}->{'forecastday'}[2]->{'low'}->{'fahrenheit'};
  
  $day3 = $parsed_json->{'forecast'}->{'txt_forecast'}->{'forecastday'}[6]->{'title'};
  $icon3 = $parsed_json->{'forecast'}->{'txt_forecast'}->{'forecastday'}[6]->{'icon_url'};
  $fcst3 = $parsed_json->{'forecast'}->{'txt_forecast'}->{'forecastday'}[6]->{'fcttext'};
  $temph3 = $parsed_json->{'forecast'}->{'simpleforecast'}->{'forecastday'}[3]->{'high'}->{'fahrenheit'};
  $templ3 = $parsed_json->{'forecast'}->{'simpleforecast'}->{'forecastday'}[3]->{'low'}->{'fahrenheit'};
  
  $day4 = $parsed_json->{'forecast'}->{'txt_forecast'}->{'forecastday'}[8]->{'title'};
  $icon4 = $parsed_json->{'forecast'}->{'txt_forecast'}->{'forecastday'}[8]->{'icon_url'};
  $fcst4 = $parsed_json->{'forecast'}->{'txt_forecast'}->{'forecastday'}[8]->{'fcttext'};
  $temph4 = $parsed_json->{'forecast'}->{'simpleforecast'}->{'forecastday'}[4]->{'high'}->{'fahrenheit'};
  $templ4 = $parsed_json->{'forecast'}->{'simpleforecast'}->{'forecastday'}[4]->{'low'}->{'fahrenheit'};
?>

<center><a href="midatlantic.php" class="tandt">Four Day Forecast</a></center>
<br />
<table align="center" width="95%" cellpadding="7" border="0"><tr valign="top">
<td align="center" width="25%" bgcolor="#D5FDD5">
<?php echo $day1?><br />
<img src="<?php echo $icon1?>" /><br />
<div class="info" align="center"><b>Low: <?php echo $templ1?> &nbsp; - &nbsp; Hi: <?php echo $temph1?></b><br /></div>
<div class="info" align="left"><?php echo $fcst1?></div>
</td>
<td align="center" width="25%" bgcolor="#E0DADA">
<?php echo $day2?><br />
<img src="<?php echo $icon2?>" /><br />
<div class="info" align="center"><b>Low: <?php echo $templ2?> &nbsp; - &nbsp; Hi: <?php echo $temph2?></b><br /></div>
<div class="info" align="left"><?php echo $fcst2?></div>
</td>
<td align="center" width="25%" bgcolor="#D2D3F8">
<?php echo $day3?><br />
<img src="<?php echo $icon3?>" /><br />
<div class="info" align="center"><b>Low: <?php echo $templ3?> &nbsp; - &nbsp; Hi: <?php echo $temph3?></b><br /></div>
<div class="info" align="left"><?php echo $fcst3?></div>
</td>
<td align="center" width="25%" bgcolor="#FACFFB">
<?php echo $day4?><br />
<img src="<?php echo $icon4?>" /><br />
<div class="info" align="center"><b>Low: <?php echo $templ4?> &nbsp; - &nbsp; Hi: <?php echo $temph4?></b><br /></div>
<div class="info" align="left"><?php echo $fcst4?></div>
</td></tr></table>

<!--<textarea class="forminput" rows="22" cols="109"><?php echo $json_string?></textarea>-->

</td>
</tr></table>
<br /><br /><br /><br />
<div id="bottom">
<?php printAds(); ?>
</div>
</body>
</html>
