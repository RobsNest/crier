<?php
session_start();

include("../includes/edit.inc.php");

date_default_timezone_set('America/New_York');
$today = date('l F jS Y');

#Create and Check the database connection.
require '../includes/dbstuff.inc.php';
$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($db->connect_error) {
	die("Connection failed: " . $db->connect_error);
}

#$db->close();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Article Editor - The Cumberland Crier - <?php echo $today?></title>
  	
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />	
	<meta name=”description” content=”News, Weather and Topics of Interest for the people of Cumberland Maryland and the surronding region. Your new hometown newspaper.” />
	<link rel="icon" type="image/png" href="../images/crier.png" />
	<link rel="stylesheet" type="text/css" id="stylesheet" href="../css/main.css" />

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

<body bgcolor="#FFFFFF" text="#000000" topmargin="0" onload="document.theForm.handle.focus()">
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
<a href="../midatlantic.php"><img src="http://images.intellicast.com/WxImages/RadarLoop/shd_None_anim.gif" alt="Mid Atlantic Radar" border="0" width="150" height="97" title="Cumberland Area Weather" /></a></center>
<?php
  $json_string = file_get_contents("http://api.wunderground.com/api/ef6be0c646ab41f3/geolookup/conditions/q/MD/Cumberland.json");
  $parsed_json = json_decode($json_string);
  $temp_f = $parsed_json->{'current_observation'}->{'temp_f'};
  $json_string = file_get_contents("http://api.wunderground.com/api/ef6be0c646ab41f3/forecast/q/MD/Cumberland.json");
  $parsed_json = json_decode($json_string);
  $forecast = $parsed_json->{'forecast'}->{'fctext'};
?>
<a href="../national.php" class="tandt" title="Current temperature is <?php echo $temp_f?>&deg; in Cumberland, Md."><?php echo $temp_f?>&deg;</a>
</td></tr></table>
</div>

<br /><br /><br /><br /><br />

<table align="center" width="95%" border="0"><tr align="center" valign="top">
<td align="left" width="25%">
<div class="menuleft">
<center><img src="../images/BoraRonnoc.png" alt="Trebor Ronnoc" border="0" width="90" height="135" /><br />
<a href="mailto:trebor@cumberlandcrier.com" class="pub">Trebor Ronnoc; Publisher</a><br />
<a href="mailto:trebor@cumberlandcrier.com" class="pub">trebor@cumberlandcrier.com</a>
<?php printLinks(); ?>
</div>
</td>


<!--********************************************************-->
<!--*                    Column One                        *-->
<!--********************************************************-->
<td align="center" width="25%">
<hr width="60%" color="#C0C0C0" />

<form name="theform" id="theform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data" onsubmit="return validate(this);">
<input type="hidden" name="col" value="1" />
Title:<br />
<input type="text" class="forminput" id="title" name="title" size="30" maxlength="50" value="<?php echo $handle?>" />
<br /><br />Article:<br />
<textarea id="article" name="article" class="forminput" rows="21" cols="30" maxlength="500" onKeyDown="textCounter('plaintext', 'plaintextcount',500);" onKeyUp="textCounter('plaintext', 'plaintextcount',500);" ></textarea><br/>
<input id="plaintextcount" readonly type="text" size="25"/>
<center><input type="image" src="../images/postcommentOff.png" 
onmouseover="this.src='../images/postcommentOn.png'" 
onmouseout="this.src='../images/postcommentOff.png'" 
value="submit" name="submit" /></center>
</form>

</td>




<!--********************************************************-->
<!--*                    Column TWO                        *-->
<!--********************************************************-->
<td align="center" width="25%">
<hr width="60%" color="#C0C0C0" />

<form name="theform" id="theform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data" onsubmit="return validate(this);">
<input type="hidden" name="col" value="2" />
Title:<br />
<input type="text" class="forminput" id="title" name="title" size="30" maxlength="50" value="<?php echo $handle?>" />
<br /><br />Article:<br />
<textarea id="article" name="article" class="forminput" rows="21" cols="30" maxlength="500" onKeyDown="textCounter('plaintext', 'plaintextcount',500);" onKeyUp="textCounter('plaintext', 'plaintextcount',500);" ></textarea><br/>
<input id="plaintextcount" readonly type="text" size="25"/>
<center><input type="image" src="../images/postcommentOff.png" 
onmouseover="this.src='../images/postcommentOn.png'" 
onmouseout="this.src='../images/postcommentOff.png'" 
value="submit" name="submit" /></center>
</form>

</td>




<!--********************************************************-->
<!--*                  Column Three                        *-->
<!--********************************************************-->
<td align="center" width="25%">
<hr width="60%" color="#C0C0C0" />

<form name="theform" id="theform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data" onsubmit="return validate(this);">
<input type="hidden" name="col" value="3" />
Title:<br />
<input type="text" class="forminput" id="title" name="title" size="30" maxlength="50" value="<?php echo $handle?>" />
<br /><br />Article:<br />
<textarea id="article" name="article" class="forminput" rows="21" cols="30" maxlength="500" onKeyDown="textCounter('plaintext', 'plaintextcount',500);" onKeyUp="textCounter('plaintext', 'plaintextcount',500);" ></textarea><br/>
<input id="plaintextcount" readonly type="text" size="25"/>
<center><input type="image" src="../images/postcommentOff.png" 
onmouseover="this.src='../images/postcommentOn.png'" 
onmouseout="this.src='../images/postcommentOff.png'" 
value="submit" name="submit" /></center>
</form>

</td>
</tr></table>

<br /><br /><br /><br /><br />

<div id="bottom">
</div>

</body>
</html>
