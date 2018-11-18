<?php
session_start();

include("includes/edit.inc.php");

date_default_timezone_set('America/New_York');
$today = date('l F jS Y');
$now = date('YmdHis');

$visitorIp = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
$webpage = "Free Classified Ads";
include("includes/logit.inc.php");
writeLog($visitorIP, $webpage);

#Connect to & Check the database connection
require 'includes/dbstuff.inc.php';
$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($db->connect_error) {
	die("Connection failed: " . $db->connect_error);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Classified Ads - The Cumberland Crier - <?php echo $today?></title>
  	
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />	
	<meta name=”description” content=”News, Weather and Topics of Interest for the people of Cumberland Maryland and the surronding region. Your new hometown newspaper.” />
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
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
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
<br /><br />
<?php printIntro(); ?>
<br />
<center><a href="classifiedcreator.php"><input type="image" src="images/CreateClassifiedOff.png" onmouseover="this.src='images/CreateClassifiedOn.png'" onmouseout="this.src='images/CreateClassifiedOff.png'" value="submit" name="submit" /></a></center>
</div></td>
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

<br /><br /><br /><br /><br /><br />

<table align="center" width="95%" border="0"><tr align="center" valign="top">
<td align="left" width="25%">
<div class="menuleft">
<center><img src="images/BoraRonnoc.png" alt="Bora Ronnoc" border="0" width="90" height="135" /><br />
<a href="mailto:trebor@cumberlandcrier.com" class="pub">Trebor Ronnoc; Publisher</a><br />
<a href="mailto:trebor@cumberlandcrier.com" class="pub">trebor@cumberlandcrier.com</a>
<?php printLinks(); ?>
</div>
</td>


<!--********************************************************-->
<!--*                    Column One                        *-->
<!--********************************************************-->
<td align="center" width="25%">
<img src="images/smSpacer.png" width="35" height="35" />
<hr width="60%" color="#C0C0C0" />

<div class="article">
Create your <b>Free</b> Classified Ad on www.cumberlandcrier.com today.
</div>
<br />

<?php
$del_stmt = $db->prepare("DELETE FROM classifieds WHERE id=?");
$del_stmt->bind_param("i", $id);

$sql = "SELECT id, expDate, viewable, email, category, ad FROM classifieds WHERE category = 'Appliances'";
$result = $db->query($sql);
echo "<div class=\"article\"><center><b>Appliances</b></center><hr>";
if ($result->num_rows > 0) {
    // output data of each row
	while($row = $result->fetch_assoc()) {
		if($row["expDate"] < $now) {
			$id = $row["id"];
			$del_stmt->execute();
		}else{
			if($row["viewable"] == "Yes") {
				echo $row["ad"] . "<br /><hr>";
			}
		}
	}
}else{
	echo "Be the first to post a free Classified Ad in Appliances";
}
echo "</div><br />";
?>

<?php
$del_stmt = $db->prepare("DELETE FROM classifieds WHERE id=?");
$del_stmt->bind_param("i", $id);

$sql = "SELECT id, expDate, viewable, email, category, ad FROM classifieds WHERE category = 'Cars & Trucks'";
$result = $db->query($sql);
echo "<div class=\"article\"><center><b>Cars & Trucks</b></center><hr>";
if ($result->num_rows > 0) {
    // output data of each row
	while($row = $result->fetch_assoc()) {
		if($row["expDate"] < $now) {
			$id = $row["id"];
			$del_stmt->execute();
		}else{
			if($row["viewable"] == "Yes") {
				echo $row["ad"] . "<br /><hr>";
			}
		}
	}
}else{
	echo "Be the first to post a free Classified Ad in Cars & Trucks.";
}
echo "</div><br />";
?>

<a href="chat.php"><img src="images/roaming/chatroombetatest210x174.png" width="210" height="174" /></a>
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
You get 132 characters and 3 full days of display Absolutely Free.
</div>
<br />

<a href="newad.php"><img src="images/roaming/ColorAndGraphics195x113.png" width="195" height="113" /></a>
<br /><br />

<?php
$del_stmt = $db->prepare("DELETE FROM classifieds WHERE id=?");
$del_stmt->bind_param("i", $id);

$sql = "SELECT id, expDate, viewable, email, category, ad FROM classifieds WHERE category = 'Electronics'";
$result = $db->query($sql);
echo "<div class=\"article\"><center><b>Electronics</b></center><hr>";
if ($result->num_rows > 0) {
    // output data of each row
	while($row = $result->fetch_assoc()) {
		if($row["expDate"] < $now) {
			$id = $row["id"];
			$del_stmt->execute();
		}else{
			if($row["viewable"] == "Yes") {
				echo $row["ad"] . "<br /><hr>";
			}
		}
	}
}else{
	echo "Be the first to post a free Classified Ad in Electronics";
}
echo "</div><br />";
?>

<!--
<?php
$del_stmt = $db->prepare("DELETE FROM classifieds WHERE id=?");
$del_stmt->bind_param("i", $id);

$sql = "SELECT id, expDate, viewable, email, category, ad FROM classifieds WHERE category = 'Help Wanted'";
$result = $db->query($sql);
echo "<div class=\"article\"><center><b>Help Wanted</b></center><hr>";
if ($result->num_rows > 0) {
    // output data of each row
	while($row = $result->fetch_assoc()) {
		if($row["expDate"] < $now) {
			$id = $row["id"];
			$del_stmt->execute();
		}else{
			if($row["viewable"] == "Yes") {
				echo $row["ad"] . "<br /><hr>";
			}
		}
	}
}else{
	echo "Be the first to post a free Classified Ad in Help Wanted.";
}
echo "</div><br />";
?>
-->

</td>




<!--********************************************************-->
<!--*                  Column Three                        *-->
<!--********************************************************-->
<td align="center" width="25%">
<img src="images/smSpacer.png" width="35" height="35" />
<hr width="60%" color="#C0C0C0" />

<div class="article">
Readership is increasing everyday. Create your <b>Free</b> Classified Ad.
</div>
<br />

<?php
$del_stmt = $db->prepare("DELETE FROM classifieds WHERE id=?");
$del_stmt->bind_param("i", $id);

$sql = "SELECT id, expDate, viewable, email, category, ad FROM classifieds WHERE category = 'Miscellaneous'";
$result = $db->query($sql);
echo "<div class=\"article\"><center><b>Miscellaneous</b></center><hr>";
if ($result->num_rows > 0) {
    // output data of each row
	while($row = $result->fetch_assoc()) {
		if($row["expDate"] < $now) {
			$id = $row["id"];
			$del_stmt->execute();
		}else{
			if($row["viewable"] == "Yes") {
				echo $row["ad"] . "<br /><hr>";
			}
		}
	}
}else{
	echo "Be the first to post a free Classified Ad in Miscellaneous";
}
echo "</div><br />";
?>


<?php
$del_stmt = $db->prepare("DELETE FROM classifieds WHERE id=?");
$del_stmt->bind_param("i", $id);

$sql = "SELECT id, expDate, viewable, email, category, ad FROM classifieds WHERE category = 'Pets & Animals'";
$result = $db->query($sql);
echo "<div class=\"article\"><center><b>Pets & Animals</b></center><hr>";
if ($result->num_rows > 0) {
    // output data of each row
	while($row = $result->fetch_assoc()) {
		if($row["expDate"] < $now) {
			$id = $row["id"];
			$del_stmt->execute();
		}else{
			if($row["viewable"] == "Yes") {
				echo $row["ad"] . "<br /><hr>";
			}
		}
	}
}else{
	echo "Be the first to post a free Classified Ad in Pets & Animals";
}
echo "</div><br />";
?>


</td>
</tr></table>

<?php $db->close();?>

<br /><br /><br /><br /><br />

<div id="bottom">
<?php printAds(); ?>
</div>

</body>
</html>
