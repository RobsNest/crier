<?php
session_start();

date_default_timezone_set('America/New_York');
$warning = "";
$focus = "email";
$email = "";
$ipcity = "";
$botChk = "";
$q1a = 0;
$q1b = 0;
$q1c = 0;
$q1d = 0;
$q1e = 0;
$q1f = 0;
$q1g = 0;
$q1h = 0;
$q1i = 0;
$q1j = 0;

$participantID = $_GET["id"]; 
$_SESSION["participantID"] = $participantID;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	#Get and test the form input
	require 'includes/fun.inc.php';
 	$q1a = test_input($_POST["q1a"]);
 	$q1b = test_input($_POST["q1b"]);
 	$q1c = test_input($_POST["q1c"]);
 	$q1d = test_input($_POST["q1d"]);
 	$q1e = test_input($_POST["q1e"]);
 	$q1f = test_input($_POST["q1f"]);
 	$q1g = test_input($_POST["q1g"]);
 	$q1h = test_input($_POST["q1h"]);
 	$q1i = test_input($_POST["q1i"]);
 	$q1j = test_input($_POST["q1j"]);
 	$q2 = test_input($_POST["q2"]);
 	$q3 = test_input($_POST["q3"]);
 	$q3comment = test_input($_POST["q3comment"]);
 	$q4 = test_input($_POST["q4"]);
 	$q4comment = test_input($_POST["q4comment"]);
 	$q5 = test_input($_POST["q6"]);
 	$q5comment = test_input($_POST["q5comment"]);
 	$q6 = test_input($_POST["q6"]);
 	$q6comment = test_input($_POST["q6comment"]);
 	$q7 = test_input($_POST["q7"]);
 	$q7comment = test_input($_POST["q7comment"]);
 	$q8 = test_input($_POST["q8"]);
 	$q8comment = test_input($_POST["q8comment"]);
 	$q51 = test_input($_POST["q51"]);
 	$q51comment = test_input($_POST["q51comment"]);

	#phone is not needed, it is used as a Bot Checker.
   	#the input field is hidden using main.css
 	$phone = test_input($_POST["phone"]);
	if($phone != "") {
		$botChk .= "Bot Alert";
		$warning = "Hmmm. Somehing isn't quite right!";
	}

	if($botChk == "") {
		#Create and Check the database connection.
    	require 'includes/dbstuff.inc.php';
		$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
		if ($db->connect_error) {
			die("Connection failed: " . $db->connect_error);
		}

		#Insert into database
		$sql = "INSERT INTO CommunityPriorities (id, q1a, q1b, q1c, q1d, q1e, q1f, q1g, q1h, q1i, q1j,
							q2, q3, q3comment, q4, q4comment, q5, q5comment, q6, q6comment,
							q7, q7comment, q8, q8comment, q51, q51comment)
				VALUES ('$participantID','$q1a', '$q1b', '$q1c', '$q1d', '$q1e', '$q1f', '$q1g', '$q1h', '$q1i', '$q1j',
						'$q2', '$q3', '$q3comment', '$q4', '$q4comment', '$q5', '$q5comment',
						'$q6', '$q6comment', '$q7', '$q7comment', '$q8', '$q8comment',
						'$q51', '$q51comment')";

		if ($db->query($sql) === TRUE) {
    		$warning = "New Record Inserted";
			header( 'Location: survey02.php' ) ;
		}else{
    		$warning = "Error: " . $db->error;
		}
	}
	$db->close();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>A Survey For Cumberland Residence. <?php echo $participantID?></title>
  	
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />	
	<meta name=”description” content=”A Survey for Mayor Grim.” />
	<link rel="icon" type="image/png" href="images/icon.png" />
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
<script language="javascript" type="text/JavaScript">
<!--
function validate(inform) {
	var msg='';
    if(inform.email.value=='')
	        msg = "* A Valid E-Mail Address\n\n";

	if(msg != '') {
	    msg = "Please fill out the required field:\n\n" + msg + "is required. Thank you.";
		alert(msg);
		return false;
	}
return true;
}
//-->
</script>

<script type="text/javascript">
window.addEventListener('keydown',function(e){if(e.keyIdentifier=='U+000A'||e.keyIdentifier=='Enter'||e.keyCode==13){if(e.target.nodeName=='INPUT'&&e.target.type=='text'){e.preventDefault();return false;}}},true);
</script>

<style type="text/css">
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

<body bgcolor="#FFFFFF" text="#000000" topmargin="0" onload="document.theform.<?php echo $focus?>.focus()">

<br />
<center><?php echo $participantID?></center>
<br />

<center>
<div class="displayBlk">
<p align="center" class="formtext">Community Priorities</p>
<form name="theform" id="theform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data" onsubmit="return validate(this);">
<input type="hidden" name="participantID" value="<?php echo $participantID?>" />
<input type="text" id="phone" name="phone" size="21" maxlength="22" />
	<b>1.</b> What do you consider to be the most important issue facing the City of Cumberland?  Rank these issues from 1 to 10 with 1 being the most important to you and 10 being the least important.
	
	<br /><br />

	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">
	<input type="number" id="q1a" name="q1a" size="2" min="1" max="10" class="forminputnum" autocomplete="off" />
	</td><td align="left">
	Crime, Drug Use & Overdoses
	</td></tr>

	<tr align="center">
	<td align="right">
	<input type="number" id="q1b" name="q1b" size="2" min="1" max="10" class="forminputnum" autocomplete="off" />
	</td><td align="left">
	Business Recruitment
	</td></tr>

	<tr align="center">
	<td align="right">
	<input type="number" id="q1c" name="q1c" size="2" min="1" max="10" class="forminputnum" autocomplete="off" />
	</td><td align="left">
	Street Paving	
	</td></tr>

	<tr align="center">
	<td align="right">
	<input type="number" id="q1d" name="q1d" size="2" min="1" max="10" class="forminputnum" autocomplete="off" />
	</td><td align="left">
	Population Growth
	</td></tr>

	<tr align="center">
	<td align="right">
	<input type="number" id="q1e" name="q1e" size="2" min="1" max="10" class="forminputnum" autocomplete="off" />
	</td><td align="left">
	Water Line Replacements
	</td></tr>

	<tr align="center">
	<td align="right">
	<input type="number" id="q1f" name="q1f" size="2" min="1" max="10" class="forminputnum" autocomplete="off" />
	</td><td align="left">
	Job Creation
	</td></tr>

	<tr align="center">
	<td align="right">
	<input type="number" id="q1g" name="q1g" size="2" min="1" max="10" class="forminputnum" autocomplete="off" />
	</td><td align="left">
	Tax Base Growth
	</td></tr>

	<tr align="center">
	<td align="right">
	<input type="number" id="q1h" name="q1h" size="2" min="1" max="10" class="forminputnum" autocomplete="off" />
	</td><td align="left">
	Reduce Taxes
	</td></tr>

	<tr align="center">
	<td align="right">
	<input type="number" id="q1i" name="q1i" size="2" min="1" max="10" class="forminputnum" autocomplete="off" />
	</td><td align="left">
	Bridge Replacements
	</td></tr>

	<tr align="center">
	<td align="right">
	<input type="number" id="q1j" name="q1j" size="2" min="1" max="10" class="forminputnum" autocomplete="off" />
	</td><td align="left">
	Increasing Police Force
	</td></tr>

	</table>

	<br />

	<b>2.</b> Do you consider city efforts to invest in infrastructure or economic development to be more important?
	
	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<input type="radio" name="q2" value="Infrastructure">Infrastructure
	</td><td align="center">
	<input type="radio" name="q2" value="Economic_Development">Economic Development
	</td></tr></table>

	<br />

	<b>3.</b> Since 2010, the City of Cumberland has paved 20% of the city streets, more than in any decade in recent history.  Do you support paving more streets, even if that means adding to the debt of the City of Cumberland?

	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<input type="radio" name="q3" value="Yes">Yes
	</td><td align="center">
	<input type="radio" name="q3" value="No">No
	</td></tr></table>

	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">Additional Comment:
	</td><td align="left">
	<input type="text" id="q3comment" name="q3comment" size="42" maxlength="500" class="forminput" autocomplete="off" />
	</td></tr></table>
	
	<br />
	
	<b>4.</b> City public safety employees have asked for wage increases every year for the past several years.  Do you support increasing the wage of public safety employees, even if that means tax rate increases to do so?	

	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<input type="radio" name="q4" value="Yes">Yes
	</td><td align="center">
	<input type="radio" name="q4" value="No">No
	</td></tr></table>

	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">Additional Comment:
	</td><td align="left">
	<input type="text" id="q4comment" name="q4comment" size="42" maxlength="500" class="forminput" autocomplete="off" />
	</td></tr></table>
	
	<br />
	
	<b>5.</b> The City of Cumberland supported the redevelopment of the Footer Dye Works building in Downtown Cumberland but invested no funds whatsoever into the project.  The developer expects to have invested private funds of approximately $10 million into the building by the time it is complete.  Do you support the redevelopment of the Footer Dye Works Building?

	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<input type="radio" name="q5" value="Yes">Yes
	</td><td align="center">
	<input type="radio" name="q5" value="No">No
	</td></tr></table>

	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">Additional Comment:
	</td><td align="left">
	<input type="text" id="q5comment" name="q5comment" size="42" maxlength="500" class="forminput" autocomplete="off" />
	</td></tr></table>
	
	<br />
	
	<b>6.</b> The City of Cumberland provided support to the State Highway Administration to install the new “Michigan Left” at the intersection of Virginia Avenue and Industrial Boulevard to reduce the wait time at the traffic lights within that intersection.  Are you satisfied with the outcome of that project?
	
	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<input type="radio" name="q6" value="Yes">Yes
	</td><td align="center">
	<input type="radio" name="q6" value="No">No
	</td></tr></table>

	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">Additional Comment:
	</td><td align="left">
	<input type="text" id="q6comment" name="q6comment" size="42" maxlength="500" class="forminput" autocomplete="off" />
	</td></tr></table>
	
	<br />
	
	<b>7.</b> Do you consider bicycle safety and promoting the City of Cumberland as a safe place for cycling to be important?
	
	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<input type="radio" name="q7" value="Yes">Yes
	</td><td align="center">
	<input type="radio" name="q7" value="No">No
	</td></tr></table>

	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">Additional Comment:
	</td><td align="left">
	<input type="text" id="q7comment" name="q7comment" size="42" maxlength="500" class="forminput" autocomplete="off" />
	</td></tr></table>
	
	<br />
	
	<b>8.</b> Do you consider preservation and maintenance of historic structures in the City of Cumberland to be important?

	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<input type="radio" name="q8" value="Yes">Yes
	</td><td align="center">
	<input type="radio" name="q8" value="No">No
	</td></tr></table>

	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">Additional Comment:
	</td><td align="left">
	<input type="text" id="q8comment" name="q8comment" size="42" maxlength="500" class="forminput" autocomplete="off" />
	</td></tr></table>

	<br />

	<b>9.</b> Do you support the use of eminent domain for the purposes of economic development?	

	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<input type="radio" name="q51" value="Yes">Yes
	</td><td align="center">
	<input type="radio" name="q51" value="No">No
	</td></tr></table>

	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">Additional Comment:
	</td><td align="left">
	<input type="text" id="q51comment" name="q51comment" size="42" maxlength="500" class="forminput" autocomplete="off" />
	</td></tr></table>
	<br />
	<center><input type="image" src="images/saveOff.png" onmouseover="this.src='images/saveOn.png'" onmouseout="this.src='images/saveOff.png'" value="submit" name="submit" /></center>
	<br />
	<center><div class="formtext"><?php echo $warning?></div></center>
</form>
</div>
</center>

<br /><br /><br />

</body>
</html>
