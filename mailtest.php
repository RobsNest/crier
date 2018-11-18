<?php
session_start();

include("includes/edit.inc.php");

$focus = "email";
date_default_timezone_set('America/New_York');
$expDate = date('YmdHis', strtotime('+1 day'));
$endDate = date('l F jS Y H:i:s', strtotime('1 day'));

$today = date('l F jS Y');
$visitorIp = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
$webpage = "Classified Creator";
include("includes/logit.inc.php");
writeLog($visitorIP, $webpage);


function Notify_Rob($email) {
	$msg = "A new Classified Ad from $email\n";
	mail("robsdigs@gmail.com","New Classified",$msg);
}

function Check_Input($input) {
	$input = trim($input);
	$input = stripslashes($input);
	$input = htmlspecialchars($input);
	#str_replace("'", "", $input);
	#str_replace("`", "", $input);
	#$db->real_escape_string($input);

	return $input;
}

if($_POST['action'] == "createad") {
	#Create and Check the database connection.
	require 'includes/dbstuff.inc.php';
	$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

	if ($db->connect_error) {
		die("Connection failed: " . $db->connect_error);
	}	 

	$email = mysqli_real_escape_string($db, $_POST['email']);
	$category = mysqli_real_escape_string($db, $_POST['category']);
	$adtext = mysqli_real_escape_string($db, $_POST['plaintext']);
	$adtext = filter_var($adtext, FILTER_SANITIZE_STRING);
	$viewable = "Yes";

	#phone is not needed, it is used as a bot checker.
	#the input field is hidden using main.css
	$phone = Check_Input($_POST['phone']);
	
	if($phone == "") {
		#Insert into database
		$sql = "INSERT INTO classifieds (expDate, viewable, email, category, ad)
				VALUES ('$expDate', '$viewable', '$email', '$category', '$adtext')";

		if ($db->query($sql) === TRUE) {
    		$warning = $warning .  "New record created successfully";
			include("includes/mailer.inc.php");
			NotifyRob();
		} else {
    		$warning = $warning . "Error: " . $sql . "<br>" . $db->error;
		}
		$db->close();
	
		header( 'Location: classifieds.php' ) ;
		#$warning = $warning . "<font class=\"formtext\">Connected: $expDate - $email - $category - $adtext</font>";
	}else{
		#Something is in the botchk $phone
		header( 'Location: https://www.cumberlandcrier.com' ) ;
	}
}else{
	$email = "";
	$adtext = "";
	$warning = "<font class=\"formtext\">Create your free classified ad today.<br />Will expire: $endDate</font>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Classified Creator - The Cumberland Crier - <?php echo $today?></title>
  	
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />	
	<meta name=”description” content=”Classified Create your free classified ad on The Cumberland Crier with our Classified Creator.” />

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

<script type="text/javascript">
<!--
function validate() {
      
	if( document.theForm.email.value == "" ) {
		alert( "A valid Email is required." );
		document.theForm.email.focus() ;
		return false;
	}
        var emailID = document.theForm.email.value;
        atpos = emailID.indexOf("@");
        dotpos = emailID.lastIndexOf(".");
         
        if (atpos < 1 || ( dotpos - atpos < 2 )) {
            alert("Please enter a Valid EMail Address.")
            document.theForm.email.focus() ;
            return false;
         }

	if( document.theForm.category.value == "-1" ) {
		alert( "A Category must be chosen." );
		return false;
	}
	if( document.theForm.plaintext.value == "" ) {
		alert( "Ad text is really the point don't you think?" );
		return false;
	}
	
	return( true );
}
//-->
</script>

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


</head>

<body bgcolor="#FFFFFF" text="#000000" topmargin="0"onload="document.theForm.<?php echo $focus?>.focus()">
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
<center><img src="images/BoraRonnoc.png" alt="Bora Ronnoc" border="0" width="90" height="135" /><br />
<a href="mailto:trebor@cumberlandcrier.com" class="pub">Trebor Ronnoc; Publisher</a><br />
<a href="mailto:trebor@cumberlandcrier.com" class="pub">trebor@cumberlandcrier.com</a>
<?php printLinks(); ?>
</div>
</td>
<td align="center" width="75%">
<hr width="60%" color="#C0C0C0" />
<!--********************Main Display Area********************-->

<br />
<form action="classifiedcreator.php" name="theForm" method="post" enctype="multipart/form-data"  onsubmit="return(validate());"> 
<input type="hidden" name="action" value="createad" />
	<table align="center" cellpadding="3">
	<tr align="center">
	<td align="right">
	&nbsp;
	</td><td align="left">
	<div class="formtext">A valid e-mail address is needed only for technical purposes.<br />Remember to include your contact information within your ad.</div>
	</td></tr>
	<tr align="center">
	<td align="right">
	<div class="formtext"><font color="#FF0000">*</font>Email:</div>
	</td><td align="left">
	<input type="text" id="email" name="email" size="42" maxlength="100" value="<?php echo $email?>" />
	</td></tr>
	<tr align="center">
	<td align="right">
	<div class="formtext"><font color="#FF0000">*</font>Category:</div>
	</td><td align="left">
	<select name="category" id="category">
		<option value="-1">Choose</option>
		<option value="Appliances">Applicances</option>
		<option value="Cars & Trucks">Cars & Trucks</option>
		<option value="Electronics">Electronics</option>
		<option value="Help wanted">Help Wanted</option>
		<option value="In Search Of">In Search Of</option>
		<option value="Miscellaneous">Miscellaneous</option>
		<option value="Pets & Animals">Pets & Animals</option>
	</select>
	</td></tr>
	<tr align="center" valign="top">
	<td align="right">
	<div class="formtext"><font color="#FF0000">*</font>Ad Content:</div>
	</td><td align="left">
	<input type="text" id="phone" name="phone" size="21" maxlength="22" />
        <textarea id="plaintext" name="plaintext" rows="3" cols="44" maxlength="132" onKeyDown="textCounter('plaintext', 'plaintextcount',132);" onKeyUp="textCounter('plaintext', 'plaintextcount',132);" ><?php echo $adtext?></textarea><br/>
    	<input id="plaintextcount" readonly type="text" size="30"/>
	</td></tr>
	</table>
	<center><input type="image" src="images/CreateClassifiedOff.png" onmouseover="this.src='images/CreateClassifiedOn.png'" onmouseout="this.src='images/CreateClassifiedOff.png'" value="submit" name="submit" /></center>
	<br />
	<center><?php echo $warning?>
</form>

<!--*******************End Main Display**********************-->
</td>
</tr></table>

<div id="bottom">
<?php printAds(); ?>
</div>
</body>
</html>
