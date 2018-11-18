<?php
session_start();

include("includes/edit.inc.php");
include("includes/poll.inc.php");

date_default_timezone_set('America/New_York');
$today = date('l F jS Y');
$visitorIp = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
$webpage = "Cumberland Crier";
include("includes/logit.inc.php");
writeLog($visitorIP, $webpage);

$searchStr = "maryland+marijuana";
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
<?php
  $json_string = file_get_contents("http://api.wunderground.com/api/ef6be0c646ab41f3/geolookup/conditions/q/MD/Cumberland.json");
  $parsed_json = json_decode($json_string);
  $temp_f = $parsed_json->{'current_observation'}->{'temp_f'};
  $temp_str = $parsed_json->{'current_observation'}->{'temperature_string'};
  $condition = $parsed_json->{'current_observation'}->{'weather'};
  $icon = $parsed_json->{'current_observation'}->{'icon_url'};
  $json_string = file_get_contents("http://api.wunderground.com/api/ef6be0c646ab41f3/forecast/q/MD/Cumberland.json");
  $parsed_json = json_decode($json_string);
  $fcttext = $parsed_json->{'forecast'}->{'txt_forecast'}->{'forecastday'}[0]->{'fcttext'};
?>
<a href="midatlantic.php"><img src="http://images.intellicast.com/WxImages/RadarLoop/shd_None_anim.gif" alt="Mid Atlantic Radar" border="0" width="150" height="97" title="<?php echo $fcttext?>" /></a></center>
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
<table align="center" width="60%" border="0"><tr valign="top">
<td align="left" width="50%">
<a href=national.php" class="miniweather" title="National Radar"><?php echo $temp_str?></a><br />
<a href="midatlantic.php" class="miniweather" title="Mid Atlantic Radar" target="_parent"><img src="<?php echo $icon?>"width="75" height="75" border="0" /></a><br />
<a href="fourday.php" class="miniweather" title="Four Day Forecast"><?php echo $condition?></a>
</td></tr></table>
<br />

<!--News API Goes Below-->
<?php
$newsJSON = file_get_contents("https://newsapi.org/v2/top-headlines?sources=reuters&apiKey=01ff08fee2714d12964a19a23270209c");
#$newsJSON = file_get_contents("https://newsapi.org/v2/top-headlines?sources=breitbart-news&apiKey=01ff08fee2714d12964a19a23270209c");
#$newsJSON = file_get_contents("https://newsapi.org/v2/top-headlines?sources=cnn&apiKey=01ff08fee2714d12964a19a23270209c");
#$newsJSON = file_get_contents("https://newsapi.org/v2/top-headlines?sources=fox-news&apiKey=01ff08fee2714d12964a19a23270209c");
#$newsJSON = file_get_contents("https://newsapi.org/v2/top-headlines?sources=ars-technica&apiKey=01ff08fee2714d12964a19a23270209c");
#$newsJSON = file_get_contents("https://newsapi.org/v2/everything?q=politics&apiKey=01ff08fee2714d12964a19a23270209c");
#$newsJSON = file_get_contents("https://newsapi.org/v2/top-headlines?sources=the-next-web&apiKey=01ff08fee2714d12964a19a23270209c");
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
<center><b>Marijuana can help cure the opioid epidemic</b></center>
<img src="images/articles/marijuana.jpg" width="210" height="143" />
The chronic has reached critical mass. A new Quinnipiac poll shows the highest number of respondents ever have less and less of a problem with you getting high. Sixty-three percent polled support cannabis legalization, and 93% approve of medical marijuana with a meager 5% opposing. There's no fuzzy math here, it's very straight forward and Attorney General Jeff Sessions and his anti-pot crusade are on the losing side of the argument.
<br /><br />
The Senate Health Committee recently unanimously approved an anti-opioid bill that's desperately seeking to combat the health crisis that has taken more American lives since 2000 than during World War II. There are a number of elements and amendments that mostly center on shorter term pain prescriptions, finding non habit-forming alternatives and stopping drugs at the border.
<br /><br />
As plain as the green on your reefer, two studies show a direct correlation between marijuana and opioid use. One shows states with legal cannabis have 2.2 million fewer daily opioids prescribed and the other a 25% drop in opioid overdose deaths in places with medical pot laws.
<br /><br />
What does Jefferson Beauregard Sessions say about that? He kind of shrugs and says he doesn't think that will be sustained in the long run. Jeff Sessions won't be sustained in the long run because his ass-backward anti-liberty thinking is the very thing that's getting people killed!
<br /><br />
The more we study cannabis, the more it can be refined and used to treat medical conditions. And boredom. The longer we protract the immoral drug war, the more decimation we'll see in inner cities and rural communities that are hit hardest by supply-side drug combat that has been proven fruitless.
<br /><br />
Jeff Sessions needs to do the right thing and admit he is wrong, but he won't, so instead he has to go. Hopefully the next AG will be a force for good and not a cesspool of backward-thinking, bad drug policy.
<br /><br /><center><a href="https://www.foxbusiness.com/politics/marijuana-can-help-cure-the-opioid-epidemic-kennedy" class="pub"><b>Read More</b></a></center><br />
</div>
<br /><br />
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
<img src="images/articles/ScamAlert210x118.png" width="210" height="118" />
Scam Alert: Fake Potomac Edison Call. 
<br /><br />
On July 3, 2018 the Allegany County Sheriff’s Office took a complaint from a local business owner. The owner had received a call which they believed to be from Potomac Edison Electric Company. The Fraudulent Representative informed the owner that they were several months behind on their Electric Bill and a Technician was en route to shut of their Electric Service. The Fraudulent Representative told the owner that they could not use a credit card to make the payment, and explained how they could avoid having the Electric Service shut off by paying via money order at one of two local pharmacies. The Fraudulent Representative even provided telephone numbers for the owner to call back in case they have any questions and would answer the phone “Potomac Edison”. Investigation revealed that the suspects were using “Spoofing” technology to make it appear that the call was coming from Potomac Edison. These callers typically call from other countries to avoid prosecution for fraud.
<br /><br />
If you receive a call from a Utility Company claiming that you are behind in payments and your utility is about to be shut off unless you pay via money order, it is possibly a scam. Do not use the numbers provided by the Fraudulent Representative. Call your local representative and verify the information.
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

<a href="sliderz/cumberland.html" target="_blank"><img src="images/roaming/Sliderz210x112.png" width="210" height="112" /></a>
<br /><br />

<div class="article">
<center><b>Rocky Gap Fun Fair</b></center>
<img src="images/articles/funfair.png" width="210" height="140" />
<br /><br />
Rocky Gap State Park will host a children’s Fun Fair this Saturday, June 30, from 1pm to 3pm. The Fun Fair is sponsored by the Volunteer Team and will take place above the public beaches at the Ranger Station area. The gate admission applies to all visitors, but children are all guaranteed to win prizes. Join the Park for a day outdoors and some fun games. For information, please contact the Friends of Rocky Gap State Park page on Facebook.
</div>
<br />

<a href="cgandc.php" target="_blank"><img src="images/roaming/cgandcColor195x89.png" width="195" height="89" /></a>
<br /><br />

<div class="article">
<center><b>Wanted By Sheriff's Patrol</b></center>
<img src="images/articles/TheSubject02.png" width="210" height="170" />
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

<a href="secrets/" target="_blank"><img src="fixed/secrets205x74.png" width="205" height="74" /></a>
<br /><br />

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

<a href="rgflyby.php"><img src="images/roaming/rgFlyBy210x104.png" width="210" height="104" /></a>
<br /><br />

<a href="chat.php"><img src="images/roaming/chatroombetatest210x174.png" width="210" height="174" /></a>
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
<div id="preload"><img src="images/voteOn.png" width="1" height="1" /></div>
<div id="preload"><img src="images/SearchOn.png" width="1" height="1" /></div>
</body>
</html>
