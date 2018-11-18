<?php
session_start();

date_default_timezone_set('America/New_York');
$warning = "";
$focus = "email";
$botChk = "";

$participantID = intval($_SESSION["participantID"]); 
$_SESSION["participantID"] = $participantID;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	#Get and test the form input
	require 'includes/fun.inc.php';
	if(isset($_POST['q39a'])) {
		$q39a = test_input($_POST["q39a"]);
	}else{
		$q39a = "";
	}
	if(isset($_POST['q39b'])) {
		$q39b = test_input($_POST["q39b"]);
	}else{
		$q39b = "";
	}
	if(isset($_POST['q39c'])) {
		$q39c = test_input($_POST["q39c"]);
	}else{
		$q39c = "";
	}
	if(isset($_POST['q39d'])) {
		$q39d = test_input($_POST["q39d"]);
	}else{
		$q39d = "";
	}
	if(isset($_POST['q39e'])) {
		$q39e = test_input($_POST["q39e"]);
	}else{
		$q39e = "";
	}
	if(isset($_POST['q22f'])) {
		$q39f = test_input($_POST["q39f"]);
	}else{
		$q39f = "";
	}

 	$q40 = test_input($_POST["q40"]);
 	$q40comment = test_input($_POST["q40comment"]);
 	$q41 = test_input($_POST["q41"]);
 	$q42 = test_input($_POST["q42"]);
 	$q43 = test_input($_POST["q43"]);
 	$q44 = test_input($_POST["q44"]);
 	$q45 = test_input($_POST["q45"]);

	if(isset($_POST['q46a'])) {
		$q46a = test_input($_POST["q46a"]);
	}else{
		$q46a = "";
	}
	if(isset($_POST['q46b'])) {
		$q46b = test_input($_POST["q46b"]);
	}else{
		$q46b = "";
	}
	if(isset($_POST['q46c'])) {
		$q46c = test_input($_POST["q46c"]);
	}else{
		$q46c = "";
	}
	if(isset($_POST['q46d'])) {
		$q46d = test_input($_POST["q46d"]);
	}else{
		$q46d = "";
	}
	if(isset($_POST['q46e'])) {
		$q46e = test_input($_POST["q46e"]);
	}else{
		$q46e = "";
	}
	if(isset($_POST['q46f'])) {
		$q46f = test_input($_POST["q46f"]);
	}else{
		$q46f = "";
	}
	if(isset($_POST['q46g'])) {
		$q46g = test_input($_POST["q46g"]);
	}else{
		$q46g = "";
	}


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
		$sql = "INSERT INTO StatisticalPurposes (id, q39a, q39b, q39c, q39d, q39e, q39f,
							q40, q40comment, q41, q42, q43, q44, q45, q46a, q46b, q46c,
							q46d, q46e, q46f, q46g)
				VALUES ('$participantID', '$q39a', '$q39b', '$q39c', '$q39d', '$q39e', '$q39f', 
						'$q40', '$q40comment', '$q41', '$q42', '$q43', '$q44', '$q45', '$q46a',
						'$q46b', '$q46c', '$q46d', '$q46e', '$q46f', '$q46g')";

		if ($db->query($sql) === TRUE) {
    		$warning = "New Record Inserted";
			header( 'Location: thankyou.php' ) ;
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
	<title>A Survey For Cumberland Residents <?php echo $participantID?></title>
  	
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />	
	<meta name=”description” content=”Cumberland citizens opportunity to weigh in on issues of significance.” />
	<link rel="icon" type="image/png" href="images/icon.png" />
	<link rel="stylesheet" type="text/css" id="stylesheet" href="css/main.css" />

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

<script type="text/javascript">
window.addEventListener('keydown',function(e){if(e.keyIdentifier=='U+000A'||e.keyIdentifier=='Enter'||e.keyCode==13){if(e.target.nodeName=='INPUT'&&e.target.type=='text'){e.preventDefault();return false;}}},true);
</script>

</head>

<body bgcolor="#FFFFFF" text="#000000" topmargin="0" onload="document.theform.<?php echo $focus?>.focus()">

<br /><br /><br />

<center>
<div class="displayBlk">
<p align="center" class="formtext">Statistical Purposes</p>
<form name="theform" id="theform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="participantID" value="<?php echo $participantID?>" />
<input type="text" id="phone" name="phone" size="21" maxlength="22" />

	<b>1.</b> The City of Cumberland shares information on a regular basis with citizens about programs, projects and decisions in the city.  Which of these forms of information sharing do you use (check all that apply)?
	
	<br />

	<table align="center" cellpadding="3" width="80%" border="0">
	<tr align="left">
	<td align="left">
	<input type="checkbox" name="q39a" value="City_Of_Cumberland_Website" />City of Cumberland Website
	</td></tr>
	<tr align="left">
	<td align="left">
	<input type="checkbox" name="q39b" value="City_Council_Meetings" />City Council Meetings
	</td></tr>
	<tr align="left">
	<td align="left">
	<input type="checkbox" name="q39c" value="Cumberland_Times-News" />Cumberland Times-News
	</td></tr>
	<tr align="left">
	<td align="left">
	<input type="checkbox" name="q39d" value="WCBC_Radio" />WCBC Radio
	</td></tr>
	<tr align="left">
	<td align="left">
	<input type="checkbox" name="q39e" value="Allegany_Radio_Magic_WQZK" />Allegany Radio (Magic/WQZK)
	</td></tr>
	<tr align="left">
	<td align="left">
	<input type="checkbox" name="q39f" value="Froggy_Radio_WTBO" />Froggy Radio (WTBO)
	</td></tr></table>
	
	<br />
	
	<b>2.</b> Is Facebook a source of significant information that you receive about the community?
	
	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<input type="radio" name="q40" value="Yes">Yes
	</td><td align="center">
	<input type="radio" name="q40" value="No">No
	</td></tr></table>

	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">Additional Comment:
	</td><td align="left">
	<input type="text" id="q40comment" name="q40comment" size="42" maxlength="500" class="forminput" autocomplete="off" />
	</td></tr></table>
	
	<br />
	
	<b>3.</b> Approximately how many City Council meetings have you attended in the past 10 years?
	
	<br />

	<table align="center" cellpadding="3" width="80%" border="0">
	<tr align="left">
	<td align="left">
	<input type="radio" name="q41" value="0">0
	</td></tr>
	<tr align="left">
	<td align="left">
	<input type="radio" name="q41" value="1-5">1-5
	</td></tr>
	<tr align="left">
	<td align="left">
	<input type="radio" name="q41" value="6-10">6-10
	</td></tr>
	<tr align="left">
	<td align="left">
	<input type="radio" name="q41" value="10+">10+
	</td></tr></table>
	
	<br />
	
	<b>4.</b> Please identify which area of Cumberland you reside in.
	
	<br />

	<table align="center" cellpadding="3" width="80%" border="0">
	<tr align="left">
	<td align="left">
	<input type="radio" name="q42" value="North_End">North End
	</td></tr>
	<tr align="left">
	<td align="left">
	<input type="radio" name="q42" value="South_End">South End
	</td></tr>
	<tr align="left">
	<td align="left">
	<input type="radio" name="q42" value="East_Side">East Side
	</td></tr>
	<tr align="left">
	<td align="left">
	<input type="radio" name="q42" value="West_Side">West Side
	</td></tr></table>
	
	<br />
	
	<b>5.</b> Please identify the category of your age.

	<br />

	<table align="center" cellpadding="3" width="80%" border="0">
	<tr align="left">
	<td align="left">
	<input type="radio" name="q43" value="0-18">0-18
	</td></tr>
	<tr align="left">
	<td align="left">
	<input type="radio" name="q43" value="19-35">19-35
	</td></tr>
	<tr align="left">
	<td align="left">
	<input type="radio" name="q43" value="36-50">36-50
	</td></tr>
	<tr align="left">
	<td align="left">
	<input type="radio" name="q43" value="51-65">51-65
	</td></tr>
	<tr align="left">
	<td align="left">
	<input type="radio" name="q43" value="65+">65+
	</td></tr></table>
	
	<br />
	
	<b>6.</b> Are you a homeowner or do you rent your home?
	
	<br />

	<table align="center" cellpadding="3" width="80%" border="0">
	<tr align="left">
	<td align="left">
	<input type="radio" name="q44" value="Homeowner">Homeowner
	</td></tr>
	<tr align="left">
	<td align="left">
	<input type="radio" name="q44" value="Renter_Tenant">Renter/Tenant
	</td></tr></table>
	
	<br />

	<b>7.</b> <i>Optional</i> If you plan to vote in the Primary Election on June 26, for which Mayoral candidate do you plan to vote?
	
	<br />

	<table align="center" cellpadding="3" width="80%" border="0">
	<tr align="left">
	<td align="left">
	<input type="radio" name="q45" value="Lawrence_Becker">Lawrence Becker
	</td></tr>
	<tr align="left">
	<td align="left">
	<input type="radio" name="q45" value="Raymond_Dye">Raymond Dye
	</td></tr>
	<tr align="left">
	<td align="left">
	<input type="radio" name="q45" value="Georgez_Merling">George Merling
	</td></tr>
	<tr align="left">
	<td align="left">
	<input type="radio" name="q45" value="Brian_K._Grim">Brian K. Grim
	</td></tr>
	<tr align="left">
	<td align="left">
	<input type="radio" name="q45" value="David_Smith">David Smith
	</td></tr>
	<tr align="left">
	<td align="left">
	<input type="radio" name="q45" value="Raymond_Morriss">Raymond Morriss
	</td></tr>
	<tr align="left">
	<td align="left">
	<input type="radio" name="q45" value="Robin_Hood_Constitution">Robin Hood Constitution
	</td></tr>
	<tr align="left">
	<td align="left">
	<input type="radio" name="q45" value=" I_don’t_vote"> I don’t vote
	</td></tr></table>
	<br />

	<b>8.</b> <i>Optional</i> If you plan to vote in the General Election in November, for which TWO City Council candidates do you plan to vote?

	<br />

	<table align="center" cellpadding="3" width="80%" border="0">
	<tr align="left">
	<td align="left">
	<input type="checkbox" name="q46a" value="Wayne_Hedrick" />Wayne Hedrick
	</td></tr>
	<tr align="left">
	<td align="left">
	<input type="checkbox" name="q46b" value="Buck_Taylor" />Buck Taylor
	</td></tr>
	<tr align="left">
	<td align="left">
	<input type="checkbox" name="q46c" value="Seth_Bernard" />Seth Bernard
	</td></tr>
	<tr align="left">
	<td align="left">
	<input type="checkbox" name="q46d" value="Rock_Cioni" />Rock Cioni
	</td></tr>
	<tr align="left">
	<td align="left">
	<input type="checkbox" name="q46e" value="John_Fetchero" />John Fetchero
	</td></tr>
	<tr align="left">
	<td align="left">
	<input type="checkbox" name="q46f" value="Sylvester_Young" />Sylvester Young
	</td></tr>
	<tr align="left">
	<td align="left">
	<input type="checkbox" name="q46g" value="I_don’t_vote" />I don’t vote
	</td></tr></table>
	
	<br />

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
