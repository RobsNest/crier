<?php
session_start();

include("includes/edit.inc.php");
include("includes/poll.inc.php");

date_default_timezone_set('America/New_York');
$today = date('l F jS Y');
$visitorIp = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
$webpage = "West Side Bridges";

include("includes/logit.inc.php");
writeLog($visitorIP, $webpage);

#Create and Check the database connection.
require 'includes/dbstuff.inc.php';
$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($db->connect_error) {
	die("Connection failed: " . $db->connect_error);
}

if($_POST['action'] == "castvote") {
	$vote = mysqli_real_escape_string($db, $_POST['options']);
	$handle = mysqli_real_escape_string($db, $_POST['handle']);
    $handle = filter_var($handle, FILTER_SANITIZE_STRING);
	$comment = mysqli_real_escape_string($db, $_POST['plaintext']);
    $comment = filter_var($comment, FILTER_SANITIZE_STRING);

	#phone is not needed, it is used as a bot checker.
    #the input field is hidden using main.css
    $phone = mysqli_real_escape_string($db, $_POST['phone']);
	if($phone) {
    	#Something is in the $phone Bot Check Field
		header( 'Location: https://www.cumberlandcrier.com' );
	}else{
		if($vote) {
			#Something with cookies?
			$cookieName = "CumberlandBridges";
			$cookieValue = $today;
			if(!isset($_COOKIE[$cookieName])) {
				CountVote($vote);                
			}
			setcookie($cookieName, $cookieValue, time() + (3600 * 1), "/");
		}

		if($comment) {
			#Get next column number
			#from a text file start
			#with column 2 so 2 and 3
			#have comments before col 1
			$datfile = "pollcolumn.dat";
			$fh = fopen($datfile, 'r') or die("Couldn't open $datfile");
			$col = fgets($fh);
			fclose($fh);
			$column = $col;
			$datfile = "pollcolumn.dat";
			$fh = fopen($datfile, 'w') or die("Couldn't open $datfile");
			if($col >= 3) {
				$col = 1;
			}else{
				$col = $col + 1;
			}
			fwrite($fh, $col);
			fclose($fh);

			#$column = rand(2, 3);

			$viewable = "Yes";
			if($handle == "") {
				$handle = "Anonymous";
			}

			$sql = "INSERT INTO polls (col, viewable,  handle, comment) 
						VALUES ('$column', '$viewable', '$handle', '$comment')";

			if ($db->query($sql) === TRUE) {
				$warning = "New record created successfully <br />";
			}else{
            	$warning = "Error: " . $sql . "<br>" . $db->error;
	        }
	        #$db->close();
		}

		#header( 'Location: https://www.cumberlandcrier.com/poll.php' );
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Poll - Cumberland's West Side Bridges - The Cumberland Crier - <?php echo $today?></title>
  	
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
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
      google_ad_client: "ca-pub-4129424170235377",
	      enable_page_level_ads: true
		    });
			</script>
</head>

<body bgcolor="#FFFFFF" text="#000000" topmargin="0" onload="document.theForm.handle.focus()">
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
<center><img src="images/BoraRonnoc.png" alt="Trebor Ronnoc" border="0" width="90" height="135" /><br />
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

<?php
$sql = "SELECT id, col, viewable, handle, comment FROM polls WHERE col = '3' ORDER BY id DESC";
$result = $db->query($sql);
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		if($row["viewable"] == "Yes") {
        	echo "<div class=\"article\"><b>" . $row["handle"] . "</b><br />" . $row["comment"] . "<br /></div><br />";
       	}
	}
}
?>





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

<div class="pollquestion">
<form action="poll.php" name="theForm" method="post" 
enctype="multipart/form-data"  onsubmit="return(validate());">
<input type="hidden" name="action" value="castvote" />
Name <b>/</b> Handle:
<input type="text" class="forminput" id="handle" name="handle" size="21" maxlength="50" value="<?php echo $handle?>" />
<br /><br />Comment:
<input type="text" id="phone" name="phone" size="21" maxlength="22" />
<textarea id="plaintext" name="plaintext" class="forminput" rows="3" cols="24" maxlength="500" onKeyDown="textCounter('plaintext', 'plaintextcount',500);" onKeyUp="textCounter('plaintext', 'plaintextcount',500);" ></textarea><br/>
<input id="plaintextcount" readonly type="text" size="25"/>
<center><input type="image" src="images/postcommentOff.png" 
onmouseover="this.src='images/postcommentOn.png'" 
onmouseout="this.src='images/postcommentOff.png'" 
value="submit" name="submit" /></center>
</form>
<br />
<center><a href="poll.php" class="pub"><b>Refresh Comments</b></a></center>
</div>
<br />

<a href="chat.php"><img src="images/roaming/chatroombetatest210x174.png" width="210" height="174" /></a>
<br /><br />

<?php
$sql = "SELECT id, col, viewable, handle, comment FROM polls WHERE col = '2' ORDER BY id DESC";
$result = $db->query($sql);
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		if($row["viewable"] == "Yes") {
        	echo "<div class=\"article\"><b>" . $row["handle"] . "</b><br />" . $row["comment"] . "<br /></div><br />";
       	}
	}
}
?>



</td>




<!--********************************************************-->
<!--*                  Column Three                        *-->
<!--********************************************************-->
<td align="center" width="25%">
<img src="images/smSpacer.png" width="35" height="35" />
<hr width="60%" color="#C0C0C0" />

<div class="pollquestion">
Do you believe CSX should replace their three damaged bridges in Cumberland's West Side at Washington Street, Fayette Street and Cumberland Street or should the City of Cumberland assume ownership and replace them with tax dollars to quicken the replacement timeline?
<br /><br />
<form action="poll.php" name="theVote" method="post" 
enctype="multipart/form-data"  onsubmit="return(validate());">
<input type="hidden" name="action" value="castvote" />
<input type="radio" name="options" value="CSX"> <b>CSX should replace the bridges.</b><br>
<br />
<input type="radio" name="options" value="Cumberland"> <b>Cumberland should assume ownership.</b><br>
<br />
<input type="radio" name="options" value="Undecided"> <b>Undecided</b><br>
<input type="text" id="phone" name="phone" size="21" maxlength="22" />
<br />
<center><input type="image" src="images/voteOff.png" 
onmouseover="this.src='images/voteOn.png'" 
onmouseout="this.src='images/voteOff.png'" 
value="submit" name="submit" /></center>
</form>
<br />
<center>Results So Far</center>

<?php
$pollCnt = LoadArray();
foreach($pollCnt as $option => $votes) {
    if(strlen($option) > 1) {
	    echo "<div class=\"row\"><div class=\"column left\"><b>" . $option . "</div><div class=\"column right\">" . $votes . "</b></div></div>";
    }
}
?>
</div>
<br />


<?php
$sql = "SELECT id, col, viewable, handle, comment FROM polls WHERE col = '1' ORDER BY id DESC";
$result = $db->query($sql);
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		if($row["viewable"] == "Yes") {
        	echo "<div class=\"article\"><b>" . $row["handle"] . "</b><br />" . $row["comment"] . "<br /></div><br />";
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

</body>
</html>
