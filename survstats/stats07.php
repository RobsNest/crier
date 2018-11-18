<?php
session_start();
$warning = "";

#Check the session var, if not set send to index
$valid = $_SESSION["SurveyStats"];
if($valid != "Logged In") {
	header('Location: index.php');
}else{
	#renew the session var
	$_SESSION["SurveyStats"] = "Logged In";
}

#Create and Check the database connection.
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
	<title>A Survey For Cumberland Residents <?php echo $participantID?></title>
  	
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />	
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

</head>

<body bgcolor="#FFFFFF" text="#000000" topmargin="0" >

<br /><center><?php echo $participantID?></center><br />

<center>
<div class="displayBlk">
<p align="center" class="formtext">Statistical Purposes</p>

	<b>1.</b> The City of Cumberland shares information on a regular basis with citizens about programs, projects and decisions in the city.  Which of these forms of information sharing do you use (check all that apply)?
<?php
$sql = "SELECT id FROM StatisticalPurposes WHERE q39a = 'City_Of_Cumberland_Website'";
if ($result = mysqli_query($db, $sql)) {
    $City_Of_Cumberland_Website = mysqli_num_rows($result);
    mysqli_free_result($result);
}
$sql = "SELECT id FROM StatisticalPurposes WHERE q39b = 'City_Council_Meetings'";
if ($result = mysqli_query($db, $sql)) {
    $City_Council_Meetings = mysqli_num_rows($result);
    mysqli_free_result($result);
}
$sql = "SELECT id FROM StatisticalPurposes WHERE q39c = 'Cumberland_Times-News'";
if ($result = mysqli_query($db, $sql)) {
    $Cumberland_Times_News = mysqli_num_rows($result);
    mysqli_free_result($result);
}
$sql = "SELECT id FROM StatisticalPurposes WHERE q39d = 'WCBC_Radio'";
if ($result = mysqli_query($db, $sql)) {
    $WCBC_Radio = mysqli_num_rows($result);
    mysqli_free_result($result);
}
$sql = "SELECT id FROM StatisticalPurposes WHERE q39e = 'Allegany_Radio_Magic_WQZK'";
if ($result = mysqli_query($db, $sql)) {
    $Allegany_Radio_Magic_WQZK = mysqli_num_rows($result);
    mysqli_free_result($result);
}
$sql = "SELECT id FROM StatisticalPurposes WHERE q39f = 'Froggy_Radio_WTBO'";
if ($result = mysqli_query($db, $sql)) {
    $Froggy_Radio_WTBO = mysqli_num_rows($result);
    mysqli_free_result($result);
}
?>


	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center" valign="top">
	<td align="left">City of Cumberland Website</td><td align="right"> <?php echo $City_Of_Cumberland_Website?></td>
	</tr><tr align="center" valign="top">
	<td align="left">City Council Meetings</td><td align="right"><?php echo $City_Council_Meetings?></td>
	</tr><tr align="center" valign="top">
	<td align="left">Cumberland Times News</td><td align="right"><?php echo $Cumberland_Times_News?></td>
	</tr><tr align="center" valign="top">
	<td align="left">WCBC Radio</td><td align="right"><?php echo $WCBC_Radio?></td>
	</tr><tr align="center" valign="top">
	<td align="left">Allegany Radio Magic WQZK</td><td align="right"><?php echo $Allegany_Radio_Magic_WQZK?></td>
	</tr><tr align="center" valign="top">
	<td align="left"><b>*</b>Froggy Radio WTBO</td><td align="right"><?php echo $Froggy_Radio_WTBO?></td>
	</tr></table>
	
	<br />
	
	<b>2.</b> Is Facebook a source of significant information that you receive about the community?
<?php
$sql = "SELECT id FROM StatisticalPurposes WHERE q40 = 'Yes'";
if ($result = mysqli_query($db, $sql)) {
	$yes = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM StatisticalPurposes WHERE q40 = 'No'";
if ($result = mysqli_query($db, $sql)) {
	$no = mysqli_num_rows($result);
	mysqli_free_result($result);
}
?>
	
	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	Yes <?php echo $yes?>
	</td><td align="center">
	No <?php echo $no?>
	</td></tr></table>
	
	<br />

	<center><a href="comments.php?t=StatisticalPurposes&f=q40comment" class="commlink">View Comments</a></center>

	<br />
	
	<b>3.</b> Approximately how many City Council meetings have you attended in the past 10 years?
<?php
$sql = "SELECT id FROM StatisticalPurposes WHERE q41 = '0'";
if ($result = mysqli_query($db, $sql)) {
	$cnt0 = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM StatisticalPurposes WHERE q41 = '1-5'";
if ($result = mysqli_query($db, $sql)) {
	$cnt1_5 = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM StatisticalPurposes WHERE q41 = '6-10'";
if ($result = mysqli_query($db, $sql)) {
	$cnt6_10 = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM StatisticalPurposes WHERE q41 = '10+'";
if ($result = mysqli_query($db, $sql)) {
	$cnt10plus = mysqli_num_rows($result);
	mysqli_free_result($result);
}
?>
	
	<br />

	<table align="center" cellpadding="3" width="40%" border="0">
	<tr align="center" valign="top">
	<td align="left">0</td><td align="right"> <?php echo $cnt0?></td>
	</tr><tr align="center" valign="top">
	<td align="left">1-5</td><td align="right"><?php echo $cnt1_5?></td>
	</tr><tr align="center" valign="top">
	<td align="left">6-10</td><td align="right"><?php echo $cnt6_10?></td>
	</tr><tr align="center" valign="top">
	<td align="left">10+</td><td align="right"><?php echo $cnt10plus?></td>
	</tr></table>
	
	<br />
	
	<b>4.</b> Please identify which area of Cumberland you reside in.
<?php
$sql = "SELECT id FROM StatisticalPurposes WHERE q42 = 'North_End'";
if ($result = mysqli_query($db, $sql)) {
    $North_End = mysqli_num_rows($result);
    mysqli_free_result($result);
}
$sql = "SELECT id FROM StatisticalPurposes WHERE q42 = 'South_End'";
if ($result = mysqli_query($db, $sql)) {
    $South_End = mysqli_num_rows($result);
    mysqli_free_result($result);
}
$sql = "SELECT id FROM StatisticalPurposes WHERE q42 = 'East_Side'";
if ($result = mysqli_query($db, $sql)) {
    $East_Side = mysqli_num_rows($result);
    mysqli_free_result($result);
}
$sql = "SELECT id FROM StatisticalPurposes WHERE q42 = 'West_Side'";
if ($result = mysqli_query($db, $sql)) {
    $West_Side = mysqli_num_rows($result);
    mysqli_free_result($result);
}
?>

	<br />

	<table align="center" cellpadding="3" width="40%" border="0">
	<tr align="center" valign="top">
	<td align="left">North End</td><td align="right"> <?php echo $North_End?></td>
	</tr><tr align="center" valign="top">
	<td align="left">South End</td><td align="right"><?php echo $South_End?></td>
	</tr><tr align="center" valign="top">
	<td align="left">East Side</td><td align="right"><?php echo $East_Side?></td>
	</tr><tr align="center" valign="top">
	<td align="left">West Side</td><td align="right"><?php echo $West_Side?></td>
	</tr></table>

	<br />
	
	<b>5.</b> Please identify the category of your age.
<?php
$sql = "SELECT id FROM StatisticalPurposes WHERE q43 = '0-18'";
if ($result = mysqli_query($db, $sql)) {
    $cnt0_18 = mysqli_num_rows($result);
    mysqli_free_result($result);
}
$sql = "SELECT id FROM StatisticalPurposes WHERE q43 = '19-35'";
if ($result = mysqli_query($db, $sql)) {
    $cnt19_35 = mysqli_num_rows($result);
    mysqli_free_result($result);
}
$sql = "SELECT id FROM StatisticalPurposes WHERE q43 = '36-50'";
if ($result = mysqli_query($db, $sql)) {
    $cnt36_50 = mysqli_num_rows($result);
    mysqli_free_result($result);
}
$sql = "SELECT id FROM StatisticalPurposes WHERE q43 = '51-65'";
if ($result = mysqli_query($db, $sql)) {
    $cnt51_65 = mysqli_num_rows($result);
    mysqli_free_result($result);
}
$sql = "SELECT id FROM StatisticalPurposes WHERE q43 = '65+'";
if ($result = mysqli_query($db, $sql)) {
    $cnt65plus = mysqli_num_rows($result);
    mysqli_free_result($result);
}
?>

	<br />

	<table align="center" cellpadding="3" width="40%" border="0">
	<tr align="center" valign="top">
	<td align="left">0-18</td><td align="right"> <?php echo $cnt0_18?></td>
	<tr align="center" valign="top">
	<td align="left">19-35</td><td align="right"> <?php echo $cnt19_35?></td>
	<tr align="center" valign="top">
	<td align="left">36-50</td><td align="right"> <?php echo $cnt36_50?></td>
	<tr align="center" valign="top">
	<td align="left">51-65</td><td align="right"> <?php echo $cnt51_65?></td>
	<tr align="center" valign="top">
	<td align="left">65+</td><td align="right"> <?php echo $cnt65plus?></td>
	</tr></table>

	<br />
	
	<b>6.</b> Are you a homeowner or do you rent your home?
<?php
$sql = "SELECT id FROM StatisticalPurposes WHERE q44 = 'Homeowner'";
if ($result = mysqli_query($db, $sql)) {
    $Homeowner = mysqli_num_rows($result);
    mysqli_free_result($result);
}
$sql = "SELECT id FROM StatisticalPurposes WHERE q44 = 'Renter_Tenant'";
if ($result = mysqli_query($db, $sql)) {
    $Renter_Tenant = mysqli_num_rows($result);
    mysqli_free_result($result);
}
?>

	<br />

	<table align="center" cellpadding="3" width="40%" border="0">
	<tr align="center" valign="top">
	<td align="left">Homeowner</td><td align="right"> <?php echo $Homeowner?></td>
	<tr align="center" valign="top">
	<td align="left">Renter/Tenant</td><td align="right"> <?php echo $Renter_Tenant?></td>
	</tr></table>

	<br />

	<b>7.</b> <i>Optional</i> If you plan to vote in the Primary Election on June 26, for which Mayoral candidate do you plan to vote?
<?php
$sql = "SELECT id FROM StatisticalPurposes WHERE q45 = 'Lawrence_Becker'";
if ($result = mysqli_query($db, $sql)) {
    $Lawrence_Becker = mysqli_num_rows($result);
    mysqli_free_result($result);
}
$sql = "SELECT id FROM StatisticalPurposes WHERE q45 = 'Raymond_Dye'";
if ($result = mysqli_query($db, $sql)) {
    $Raymond_Dye = mysqli_num_rows($result);
    mysqli_free_result($result);
}
$sql = "SELECT id FROM StatisticalPurposes WHERE q45 = 'Georgez_Merling'";
if ($result = mysqli_query($db, $sql)) {
    $Georgez_Merling = mysqli_num_rows($result);
    mysqli_free_result($result);
}
$sql = "SELECT id FROM StatisticalPurposes WHERE q45 = 'Brian_K._Grim'";
if ($result = mysqli_query($db, $sql)) {
    $Brian_K_Grim = mysqli_num_rows($result);
    mysqli_free_result($result);
}
$sql = "SELECT id FROM StatisticalPurposes WHERE q45 = 'David_Smith'";
if ($result = mysqli_query($db, $sql)) {
    $David_Smith = mysqli_num_rows($result);
    mysqli_free_result($result);
}
$sql = "SELECT id FROM StatisticalPurposes WHERE q45 = 'Raymond_Morriss'";
if ($result = mysqli_query($db, $sql)) {
    $Raymond_Morriss = mysqli_num_rows($result);
    mysqli_free_result($result);
}
$sql = "SELECT id FROM StatisticalPurposes WHERE q45 = 'Robin_Hood_Constitution'";
if ($result = mysqli_query($db, $sql)) {
    $Robin_Hood_Constitution = mysqli_num_rows($result);
    mysqli_free_result($result);
}
$sql = "SELECT id FROM StatisticalPurposes WHERE q45 = 'I_don’t_vote'";
if ($result = mysqli_query($db, $sql)) {
    $I_dont_vote = mysqli_num_rows($result);
    mysqli_free_result($result);
}
?>

	<br />

	<table align="center" cellpadding="3" width="40%" border="0">
	<tr align="center" valign="top">
	<td align="left">Lawrence Becker</td><td align="right"> <?php echo $Lawrence_Becker?></td>
	<tr align="center" valign="top">
	<td align="left">Raymond Dye</td><td align="right"> <?php echo $Raymond_Dye?></td>
	<tr align="center" valign="top">
	<td align="left">George Merling</td><td align="right"> <?php echo $Georgez_Merling?></td>
	<tr align="center" valign="top">
	<td align="left">Brian K. Grim</td><td align="right"> <?php echo $Brian_K_Grim?></td>
	<tr align="center" valign="top">
	<td align="left">David Smith</td><td align="right"> <?php echo $David_Smith?></td>
	<tr align="center" valign="top">
	<td align="left">Raymond Morriss</td><td align="right"> <?php echo $Raymond_Morriss?></td>
	<tr align="center" valign="top">
	<td align="left">Robin Hood Constitution</td><td align="right"> <?php echo $Robin_Hood_Constitution?></td>
	<tr align="center" valign="top">
	<td align="left">I don’t vote</td><td align="right"> <?php echo $I_dont_vote?></td>
	</tr></table>

	<br />

	<b>8.</b> <i>Optional</i> If you plan to vote in the General Election in November, for which TWO City Council candidates do you plan to vote?
<?php
$sql = "SELECT id FROM StatisticalPurposes WHERE q46a = 'Wayne_Hedrick'";
if ($result = mysqli_query($db, $sql)) {
    $Wayne_Hedrick = mysqli_num_rows($result);
    mysqli_free_result($result);
}
$sql = "SELECT id FROM StatisticalPurposes WHERE q46b = 'Buck_Taylor'";
if ($result = mysqli_query($db, $sql)) {
    $Buck_Taylor = mysqli_num_rows($result);
    mysqli_free_result($result);
}
$sql = "SELECT id FROM StatisticalPurposes WHERE q46c = 'Seth_Bernard'";
if ($result = mysqli_query($db, $sql)) {
    $Seth_Bernard = mysqli_num_rows($result);
    mysqli_free_result($result);
}
$sql = "SELECT id FROM StatisticalPurposes WHERE q46d = 'Rock_Cioni'";
if ($result = mysqli_query($db, $sql)) {
    $Rock_Cioni = mysqli_num_rows($result);
    mysqli_free_result($result);
}
$sql = "SELECT id FROM StatisticalPurposes WHERE q46e = 'John_Fetchero'";
if ($result = mysqli_query($db, $sql)) {
    $John_Fetchero = mysqli_num_rows($result);
    mysqli_free_result($result);
}
$sql = "SELECT id FROM StatisticalPurposes WHERE q46f = 'Sylvester_Young'";
if ($result = mysqli_query($db, $sql)) {
    $Sylvester_Young = mysqli_num_rows($result);
    mysqli_free_result($result);
}
$sql = "SELECT id FROM StatisticalPurposes WHERE q46g = 'I_don’t_vote'";
if ($result = mysqli_query($db, $sql)) {
    $I_dont_vote = mysqli_num_rows($result);
    mysqli_free_result($result);
}
?>

	<br />

	<table align="center" cellpadding="3" width="40%" border="0">
	<tr align="center" valign="top">
	<td align="left">Wayne Hedrick</td><td align="right"> <?php echo $Wayne_Hedrick?></td>
	<tr align="center" valign="top">
	<td align="left">Buck Taylor</td><td align="right"> <?php echo $Buck_Taylor?></td>
	<tr align="center" valign="top">
	<td align="left">Seth Bernard</td><td align="right"> <?php echo $Seth_Bernard?></td>
	<tr align="center" valign="top">
	<td align="left">Rock Cioni</td><td align="right"> <?php echo $Rock_Cioni?></td>
	<tr align="center" valign="top">
	<td align="left">John Fetchero</td><td align="right"> <?php echo $John_Fetchero?></td>
	<tr align="center" valign="top">
	<td align="left">Sylvester Young</td><td align="right"> <?php echo $Sylvester_Young?></td>
	<tr align="center" valign="top">
	<td align="left">I don’t vote</td><td align="right"> <?php echo $I_dont_vote?></td>
	</tr></table>
	
	<br />
	<table align="center"><tr align="center" valign="top">
	<td align="right"><a href="stats06.php" class="prevLink" title="Previous" alt="Previous"></a></td>
	<td align="left"><img src="images/nextNot.png" width="74" height="43"/></td>
	</tr></table>
	<br />
	
	
	<br />
	<center><div class="formtext"><?php echo $warning?></div></center>
</div>
</center>
<br /><center><a href="participants.php" class="formtext">Return To List</a></center><br />
<div id="preload">
<img src="images/prevOn.png" width="1" height="1" alt="Previous" />
</div>
<?php $db->close();?>
</body>
</html>
