<?php
session_start();

include("includes/edit.inc.php");
include("includes/poll.inc.php");

date_default_timezone_set('America/New_York');
$today = date('l F jS Y');
$visitorIp = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
$webpage = "Sheriffs Patrol";
include("includes/logit.inc.php");
writeLog($visitorIP, $webpage);

$searchStr = "recreational+marijuana";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'includes/fun.inc.php';
	$searchq = test_input($_POST["searchq"]);
	$searchStr = urlencode($searchq);
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>News, Weather and Topics of Interest - The Cumberland Crier - <?php echo $today?></title>
  	
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />	
	<meta name=”description” content=”News, Weather and Topics of Interest for the people of Cumberland Maryland and the surronding region. Your new hometown newspaper.” />
	<link rel="icon" type="image/png" href="images/crier.png" />
	<link rel="stylesheet" type="text/css" id="stylesheet" href="css/main.css" />


	<script>
    	function textCounter(textarea, countdown, maxlimit) {
        	textareaid = document.getElementById(textarea);
        	if (textareaid.value.length > maxlimit)
          		textareaid.value = textareaid.value.substring(0, maxlimit);
        	else
          		document.getElementById(countdown).value = '('+(maxlimit-textareaid.value.length)+' characters available)';
      	}
   	</script>
   	<style>
   		#plaintextcount { border: 0; color: #000000; background-color: transparent; }
   	</style>

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

<style>
* {
    box-sizing: border-box;
}

/* Create two unequal columns that floats next to each other */
.column {
    float: left;
    padding: 3px;
}

.left {
  width: 90%;
}

.right {
  width: 10%;
  align: right;
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}
</style>

</head>

<body bgcolor="#FFFFFF" text="#000000" topmargin="0" onload="document.theForm.searchq.focus()">
<div id="pagetop">
<table align="center" width="93%" border="0"><tr align="center" valign="middle">
<td align="center" width="40%">
<a href="https://www.cumberlandcrier.com" class="titletext">The Cumberland Crier</a>
<br /><br />
<a href="https://www.cumberlandcrier.com" class="tandt"><?php echo $today?>  </a><span class="tandt" id="myclock"></span>
<script type="text/javascript" src="js/clock.js"></script>
</td><td align="left" width="*"><div class="info">
<?php printIntro(); ?> 
</div>
</td>
<td align="center" width="135">
<a href="midatlantic.php"><img src="http://images.intellicast.com/WxImages/RadarLoop/shd_None_anim.gif" alt="Mid Atlantic Radar" border="0" width="150" height="97" title="Cumberland Area Weather" /></a></center>
<?php
  $json_string = file_get_contents("http://api.wunderground.com/api/ef6be0c646ab41f3/geolookup/conditions/q/MD/Cumberland.json");
  $parsed_json = json_decode($json_string);
  $temp_f = $parsed_json->{'current_observation'}->{'temp_f'};
  $json_string = file_get_contents("http://api.wunderground.com/api/ef6be0c646ab41f3/forecast/q/MD/Cumberland.json");
  $parsed_json = json_decode($json_string);
  $forecast = $parsed_json->{'forecast'}->{'fctext'};
?>
<a href="national.php" class="tandt" title="Current temperature is <?php echo $temp_f?>&deg; in Cumberland, Md."><?php echo $temp_f?>&deg;</a>
</td></tr></table>
</div>

<br /><br /><br /><br /><br />

<table align="center" width="95%" border="0"><tr align="center" valign="top">
<td align="left" width="25%">
<div class="menuleft">
<center><a href="trebor.php" title="Contact Trebor to talk about promotional opportunities with The Cumberland Crier today."><img src="images/BoraRonnoc.png" alt="Contact Trebor to talk about promotional opportunities with The Cumberland Crier today." border="0" width="90" height="135" /></a><br />
<a href="mailto:trebor@cumberlandcrier.com" class="pub">Trebor Ronnoc; Publisher</a><br />
<a href="mailto:trebor@cumberlandcrier.com" class="pub">trebor@cumberlandcrier.com</a>
<?php printLinks(); ?>
</div>
</td>


<!--********************************************************-->
<!--*                    Column ONE                        *-->
<!--********************************************************-->
<td align="center" width="25%">
<img src="images/smSpacer.png" width="35" height="35" />
<hr width="60%" color="#C0C0C0" />
<a href="sliderz/cumberland.html" target="_blank"><img src="images/roaming/Sliderz210x112.png" width="210" height="112" /></a>
<br /><br />

<!--News API Goes Below-->
<?php
#$newsJSON = file_get_contents("https://newsapi.org/v2/top-headlines?sources=fox-news&apiKey=01ff08fee2714d12964a19a23270209c");
#$newsJSON = file_get_contents("https://newsapi.org/v2/top-headlines?sources=ars-technica&apiKey=01ff08fee2714d12964a19a23270209c");
#$newsJSON = file_get_contents("https://newsapi.org/v2/everything?q=hillary%20clinton&apiKey=01ff08fee2714d12964a19a23270209c");
$newsJSON = file_get_contents("https://newsapi.org/v2/top-headlines?sources=the-next-web&apiKey=01ff08fee2714d12964a19a23270209c");
$jsonIterator = new RecursiveIteratorIterator(
    new RecursiveArrayIterator(json_decode($newsJSON, TRUE)),
	    RecursiveIteratorIterator::SELF_FIRST);

foreach ($jsonIterator as $key => $val) {
    if(is_array($val)) {
        #echo "$key:<br />";
    } else {
		if($key == "title") {
			echo "<div class=\"article\">";
			echo "<b>$val</b><br /><br />";
		}
		if($key == "description") {
			echo "$val<br />";
		}
		if($key == "url") {
			$url = "<br /><center><a href=\"$val\" class=\"pub\"><b>Read More</b></a></center>";
			echo "$url<br />";
			echo "</div><br /><br />";
		}
    }
}
?>


<div class="article">
<center><b>Assault Involving Firearm</b></center><br />
On Monday the 18th, at approximately 0529 Hours, Deputies were dispatched to 32902 National Pike in Little Orleans, Maryland for a reported assault and a firearm was involved.
<br /><br />
Upon our arrival, Deputies set up a perimeter with the assistance of MSP and all occupants were ordered to exit onto the front yard and complied. Three individuals exited the residence and were identified as a 28 year old male, a 48yr old female and the suspect, Robert L Steele, Jr. 52 yrs old. National Hwy. Little Orleans, Md. All three were detained and the residence was searched for persons and firearms. Behind the front door, where Steele Jr. was previously standing, was a .410 Caliber shotgun. The firearm was found with a barrel mounted flashlight activated and the firearm safety was in the off position.
<br /><br />
Upon speaking with the victim, it was determined that this is the firearm that was used in the assault. The victim stated his father (Steele, Jr.) picked up this firearm and loaded it in the heat of an argument between the two, and his father (Steele, Jr.) pointed it directly at him and threatened to kill him. The victim was able to get to his room and call 911 for help. During this time, Steele Jr continued to threaten him with the firearm until arrival of police.
<br /><br />
During the course of the investigation, Steele, Jr. began yelling threats to the victim including threats of killing, inflicting harm, and removing him from the residence.
<br /><br />
Steele Jr. was placed under arrest and transported to the District Court to be formally charged and appear before a court commissioner.
<br /><br />
Robert Steele Jr., was charged with the following charges:
<br /><br />
Assault 1st degree, Assault 2nd degree, and several firearms charges are pending.
<br /><br />
Steele was Held without bond pending his next court appearance.
<br /><br />
</div>

</td>




<!--********************************************************-->
<!--*                    Column TWO                        *-->
<!--********************************************************-->
<td align="center" width="25%">
<center>
<a href="https://www.facebook.com/criereditor/" title="Follow Us on Facebook" target="_blank"><img src="images/smFacebook.png" alt="Follow Us on Facebook" width="35" height="35" border="0" /></a>
<a href="https://twitter.com/ClandCrier" title="Follow Us on Twitter" target="_blank"><img src="images/smTwitter.png" alt="Follow Us on Twitter" width="35" height="35" border="0" /></a>
<a href="https://plus.google.com" title="Follow Us on Google +" target="_blank"><img src="images/smGplus.png" alt="Follow Us on Google +" width="35" height="35" border="0" /></a>
<a href="https://www.linkedin.com/" title="Follow Us on Linked In" target="_blank"><img src="images/smLinkedIn.png" alt="Follow Us on Linked In" width="35" height="35" border="0" /></a>
</center>
<hr width="60%" color="#C0C0C0" />
<div class="article">
<center><b>Wanted By Sheriff's Patrol</b></center>
<img src="images/articles/TheSubject.png" width="210" height="186" />
The Allegany County Sheriffs Patrol is seeking the public’s assistance in identifying the subject in this screen capture.
<br /><br />
Please call one of the numbers listed below if you have any information. Your identity will remain anonymous. 
<br /><br />
Patrol Office 301-777-1585<br />
M-F 8am - 4pm<br />
Patrol Dispatch 301-777-5959<br />
Anytime.<br />
</div>
<br />

<!--News API Goes Below-->
<?php
#$newsJSON = file_get_contents("https://newsapi.org/v2/top-headlines?country=us&apiKey=01ff08fee2714d12964a19a23270209c");
#$newsJSON = file_get_contents("https://newsapi.org/v2/everything?q=cumberland%20maryland&apiKey=01ff08fee2714d12964a19a23270209c");
#$newsJSON = file_get_contents("https://newsapi.org/v2/everything?q=rocky%20gap%20casino&apiKey=01ff08fee2714d12964a19a23270209c");
#$newsJSON = file_get_contents("https://newsapi.org/v2/everything?q=western%20maryland%20health%20system&apiKey=01ff08fee2714d12964a19a23270209c");
$newsJSON = file_get_contents("https://newsapi.org/v2/top-headlines?sources=google-news&apiKey=01ff08fee2714d12964a19a23270209c");

$jsonIterator = new RecursiveIteratorIterator(
    new RecursiveArrayIterator(json_decode($newsJSON, TRUE)),
	    RecursiveIteratorIterator::SELF_FIRST);

foreach ($jsonIterator as $key => $val) {
    if(is_array($val)) {
        #echo "$key:<br />";
    } else {
		if($key == "title") {
			echo "<div class=\"article\">";
			echo "<b>$val</b><br /><br />";
		}
		if($key == "description") {
			echo "$val<br />";
		}
		if($key == "url") {
			$url = "<br /><center><a href=\"$val\" class=\"pub\"><b>Read More</b></a></center>";
			echo "$url<br />";
			echo "</div><br /><br />";
		}
    }
}
?>

<a href="rgflyby.php"><img src="images/roaming/rgFlyBy210x104.png" width="210" height="104" /></a>
<br /><br />

<a href="cgandc.php" target="_blank"><img src="images/roaming/cgandcColor195x89.png" width="195" height="89" /></a>
<br /><br /><br />

<center>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="DR8KNRMXBTUBY">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
</center>

</td>




<!--********************************************************-->
<!--*                  Column Three                        *-->
<!--********************************************************-->
<td align="center" width="25%">
<img src="images/smSpacer.png" width="35" height="35" />
<hr width="60%" color="#C0C0C0" />
<div class="pollquestion">
Do you beieve Marijuana should be legalized for recreational 
purposes?<br /><br />
<form action="poll.php" name="theVote" method="post" 
enctype="multipart/form-data"  onsubmit="return(validate());">
<input type="hidden" name="action" value="castvote" />
<input type="radio" name="options" value="Yes"> <b>Yes</b><br>
<input type="radio" name="options" value="No"> <b>No</b><br>
<input type="radio" name="options" value="Undecided"> <b>Undecided</b><br>
<input type="text" id="phone" name="phone" size="21" maxlength="22" />
<br />
<center><input type="image" src="images/voteOff.png" 
onmouseover="this.src='images/voteOn.png'" 
onmouseout="this.src='images/voteOff.png'" 
value="submit" name="submit" /></center>
</form>
<br />
<center><a href="poll.php" class="pub"><b>View Results</b></a></center>
</div>

<center><hr width="60%"><br /><div class="tandt">Create Your Own Column</div></center>
<center><div class="tandt">Enter A Topic</div></center>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="theForm" method="post" enctype="multipart/form-data"  onsubmit="return(validate());"> 
<input type="hidden" name="action" value="searchq" />
	<table align="center" cellpadding="3">
	<tr align="center">
	<td align="center">
	<input type="text" class="forminput" id="searchq" name="searchq" size="30" maxlength="50" value="" />
	<input type="image" src="images/searchOff.png" 
	onmouseover="this.src='images/searchOn.png'" 
	onmouseout="this.src='images/searchOff.png'" 
	value="submit" name="submit" />
	</td></tr></table>
</form>

<br />

<!--News API Search-->
<?php

$newsJSON = file_get_contents("https://newsapi.org/v2/everything?q=" . $searchStr . "&apiKey=01ff08fee2714d12964a19a23270209c");


$jsonIterator = new RecursiveIteratorIterator(
    new RecursiveArrayIterator(json_decode($newsJSON, TRUE)),
	    RecursiveIteratorIterator::SELF_FIRST);

foreach ($jsonIterator as $key => $val) {
    if(is_array($val)) {
        #echo "$key:<br />";
    } else {
		if($key == "title") {
			echo "<div class=\"article\">";
			echo "<b>$val</b><br /><br />";
		}
		if($key == "description") {
			echo "$val<br />";
		}
		if($key == "url") {
			$url = "<br /><center><a href=\"$val\" class=\"pub\"><b>Read More</b></a></center>";
			echo "$url<br />";
			echo "</div><br /><br />";
		}
    }
}
?>
</td>
</tr></table>

<br /><br /><br /><br /><br />

<div id="bottom">
<?php printAds(); ?>
</div>
<script type="text/javascript"> var infolinks_pid = 3107332; var infolinks_wsid = 0; </script> <script type="text/javascript" src="//resources.infolinks.com/js/infolinks_main.js"></script>
</body>
</html>
