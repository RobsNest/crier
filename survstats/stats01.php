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

</head>

<body bgcolor="#FFFFFF" text="#000000" topmargin="0">

<br /><center><?php echo $participantID?></center><br />

<center>
<div class="displayBlk">
<p align="center" class="formtext">Community Priorities</p>
	<b>1.</b> What do you consider to be the most important issue facing the City of Cumberland?  Rank these issues from 1 to 10 with 1 being the most important to you and 10 being the least important.

<?php
$sql = "SELECT q1a FROM CommunityPriorities";
if ($result = mysqli_query($db, $sql)) {
	$q1aCnt = mysqli_num_rows($result);
    while($row = $result->fetch_assoc()) {
		$q1aTot += intval($row["q1a"]);
	}
	$q1aAvg = $q1aTot / $q1aCnt;
	mysqli_free_result($result);
}
$sql = "SELECT q1b FROM CommunityPriorities";
if ($result = mysqli_query($db, $sql)) {
	$q1bCnt = mysqli_num_rows($result);
    while($row = $result->fetch_assoc()) {
		$q1bTot += intval($row["q1b"]);
	}
	$q1bAvg = $q1bTot / $q1bCnt;
	mysqli_free_result($result);
}
$sql = "SELECT q1c FROM CommunityPriorities";
if ($result = mysqli_query($db, $sql)) {
	$q1cCnt = mysqli_num_rows($result);
    while($row = $result->fetch_assoc()) {
		$q1cTot += intval($row["q1c"]);
	}
	$q1cAvg = $q1cTot / $q1cCnt;
	mysqli_free_result($result);
}
$sql = "SELECT q1d FROM CommunityPriorities";
if ($result = mysqli_query($db, $sql)) {
	$q1dCnt = mysqli_num_rows($result);
    while($row = $result->fetch_assoc()) {
		$q1dTot += intval($row["q1d"]);
	}
	$q1dAvg = $q1dTot / $q1dCnt;
	mysqli_free_result($result);
}
$sql = "SELECT q1e FROM CommunityPriorities";
if ($result = mysqli_query($db, $sql)) {
	$q1eCnt = mysqli_num_rows($result);
    while($row = $result->fetch_assoc()) {
		$q1eTot += intval($row["q1e"]);
	}
	$q1eAvg = $q1eTot / $q1eCnt;
	mysqli_free_result($result);
}
$sql = "SELECT q1f FROM CommunityPriorities";
if ($result = mysqli_query($db, $sql)) {
	$q1fCnt = mysqli_num_rows($result);
    while($row = $result->fetch_assoc()) {
		$q1fTot += intval($row["q1f"]);
	}
	$q1fAvg = $q1fTot / $q1fCnt;
	mysqli_free_result($result);
}
$sql = "SELECT q1g FROM CommunityPriorities";
if ($result = mysqli_query($db, $sql)) {
	$q1gCnt = mysqli_num_rows($result);
    while($row = $result->fetch_assoc()) {
		$q1gTot += intval($row["q1g"]);
	}
	$q1gAvg = $q1gTot / $q1gCnt;
	mysqli_free_result($result);
}
$sql = "SELECT q1h FROM CommunityPriorities";
if ($result = mysqli_query($db, $sql)) {
	$q1hCnt = mysqli_num_rows($result);
    while($row = $result->fetch_assoc()) {
		$q1hTot += intval($row["q1h"]);
	}
	$q1hAvg = $q1hTot / $q1hCnt;
	mysqli_free_result($result);
}
$sql = "SELECT q1i FROM CommunityPriorities";
if ($result = mysqli_query($db, $sql)) {
	$q1iCnt = mysqli_num_rows($result);
    while($row = $result->fetch_assoc()) {
		$q1iTot += intval($row["q1i"]);
	}
	$q1iAvg = $q1iTot / $q1iCnt;
	mysqli_free_result($result);
}
$sql = "SELECT q1j FROM CommunityPriorities";
if ($result = mysqli_query($db, $sql)) {
	$q1jCnt = mysqli_num_rows($result);
    while($row = $result->fetch_assoc()) {
		$q1jTot += intval($row["q1j"]);
	}
	$q1jAvg = $q1jTot / $q1jCnt;
	mysqli_free_result($result);
}

?>

	<br /><br />

	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">
	<input type="number" id="q1a" name="q1a" value="<?php echo intval($q1aAvg)?>" size="2" min="1" max="10" class="forminputnum" autocomplete="off" />
	</td><td align="left">
	Crime, Drug Use & Overdoses
	</td></tr>

	<tr align="center">
	<td align="right">
	<input type="number" id="q1b" name="q1b" value="<?php echo intval($q1bAvg)?>" size="2" min="1" max="10" class="forminputnum" autocomplete="off" />
	</td><td align="left">
	Business Recruitment
	</td></tr>

	<tr align="center">
	<td align="right">
	<input type="number" id="q1c" name="q1c" value="<?php echo intval($q1cAvg)?>" size="2" min="1" max="10" class="forminputnum" autocomplete="off" />
	</td><td align="left">
	Street Paving	
	</td></tr>

	<tr align="center">
	<td align="right">
	<input type="number" id="q1d" name="q1d" value="<?php echo intval($q1dAvg)?>" size="2" min="1" max="10" class="forminputnum" autocomplete="off" />
	</td><td align="left">
	Population Growth
	</td></tr>

	<tr align="center">
	<td align="right">
	<input type="number" id="q1e" name="q1e" value="<?php echo intval($q1eAvg)?>" size="2" min="1" max="10" class="forminputnum" autocomplete="off" />
	</td><td align="left">
	Water Line Replacements
	</td></tr>

	<tr align="center">
	<td align="right">
	<input type="number" id="q1f" name="q1f" value="<?php echo intval($q1fAvg)?>" size="2" min="1" max="10" class="forminputnum" autocomplete="off" />
	</td><td align="left">
	Job Creation
	</td></tr>

	<tr align="center">
	<td align="right">
	<input type="number" id="q1g" name="q1g" value="<?php echo intval($q1gAvg)?>" size="2" min="1" max="10" class="forminputnum" autocomplete="off" />
	</td><td align="left">
	Tax Base Growth
	</td></tr>

	<tr align="center">
	<td align="right">
	<input type="number" id="q1h" name="q1h" value="<?php echo intval($q1hAvg)?>" size="2" min="1" max="10" class="forminputnum" autocomplete="off" />
	</td><td align="left">
	Reduce Taxes
	</td></tr>

	<tr align="center">
	<td align="right">
	<input type="number" id="q1i" name="q1i" value="<?php echo intval($q1iAvg)?>" size="2" min="1" max="10" class="forminputnum" autocomplete="off" />
	</td><td align="left">
	Bridge Replacements
	</td></tr>

	<tr align="center">
	<td align="right">
	<input type="number" id="q1j" name="q1j" value="<?php echo intval($q1jAvg)?>" size="2" min="1" max="10" class="forminputnum" autocomplete="off" />
	</td><td align="left">
	Increasing Police Force
	</td></tr>

	</table>

	<br />

	<b>2.</b> Do you consider city efforts to invest in infrastructure or economic development to be more important?
	
	<br />
<?php
$sql = "SELECT id FROM CommunityPriorities WHERE q2 = 'Infrastructure'";
if ($result = mysqli_query($db, $sql)) {
	$infrastructure = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM CommunityPriorities WHERE q2 = 'Economic_Development'";
if ($result = mysqli_query($db, $sql)) {
	$economic_development = mysqli_num_rows($result);
	mysqli_free_result($result);
}
?>
	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	Infrastructure: <?php echo $infrastructure?> 
	</td><td align="center">
	Economic Development: <?php echo $economic_development?>
	</td></tr></table>

	<br />

	<b>3.</b> Since 2010, the City of Cumberland has paved 20% of the city streets, more than in any decade in recent history.  Do you support paving more streets, even if that means adding to the debt of the City of Cumberland?

<?php
$sql = "SELECT id FROM CommunityPriorities WHERE q3 = 'Yes'";
if ($result = mysqli_query($db, $sql)) {
	$yes = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM CommunityPriorities WHERE q3 = 'No'";
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

	<center><a href="comments.php?t=CommunityPriorities&f=q3comment" class="commlink">View Comments</a></center>

	<br />
	
	<b>4.</b> City public safety employees have asked for wage increases every year for the past several years.  Do you support increasing the wage of public safety employees, even if that means tax rate increases to do so?	
<?php
$sql = "SELECT id FROM CommunityPriorities WHERE q4 = 'Yes'";
if ($result = mysqli_query($db, $sql)) {
	$yes = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM CommunityPriorities WHERE q4 = 'No'";
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

	<center><a href="comments.php?t=CommunityPriorities&f=q4comment" class="commlink">View Comments</a></center>

	<br />
	
	<b>5.</b> The City of Cumberland supported the redevelopment of the Footer Dye Works building in Downtown Cumberland but invested no funds whatsoever into the project.  The developer expects to have invested private funds of approximately $10 million into the building by the time it is complete.  Do you support the redevelopment of the Footer Dye Works Building?
<?php
$sql = "SELECT id FROM CommunityPriorities WHERE q5 = 'Yes'";
if ($result = mysqli_query($db, $sql)) {
	$yes = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM CommunityPriorities WHERE q5 = 'No'";
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

	<center><a href="comments.php?t=CommunityPriorities&f=q5comment" class="commlink">View Comments</a></center>

	<br />
	
	<b>6.</b> The City of Cumberland provided support to the State Highway Administration to install the new “Michigan Left” at the intersection of Virginia Avenue and Industrial Boulevard to reduce the wait time at the traffic lights within that intersection.  Are you satisfied with the outcome of that project?
<?php
$sql = "SELECT id FROM CommunityPriorities WHERE q6 = 'Yes'";
if ($result = mysqli_query($db, $sql)) {
	$yes = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM CommunityPriorities WHERE q6 = 'No'";
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

	<center><a href="comments.php?t=CommunityPriorities&f=q6comment" class="commlink">View Comments</a></center>

	<br />
	
	<b>7.</b> Do you consider bicycle safety and promoting the City of Cumberland as a safe place for cycling to be important?
<?php
$sql = "SELECT id FROM CommunityPriorities WHERE q7 = 'Yes'";
if ($result = mysqli_query($db, $sql)) {
	$yes = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM CommunityPriorities WHERE q7 = 'No'";
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

	<center><a href="comments.php?t=CommunityPriorities&f=q7comment" class="commlink">View Comments</a></center>

	<br />
	
	<b>8.</b> Do you consider preservation and maintenance of historic structures in the City of Cumberland to be important?
<?php
$sql = "SELECT id FROM CommunityPriorities WHERE q8 = 'Yes'";
if ($result = mysqli_query($db, $sql)) {
	$yes = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM CommunityPriorities WHERE q8 = 'No'";
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

	<center><a href="comments.php?t=CommunityPriorities&f=q8comment" class="commlink">View Comments</a></center>

	<br />

	<b>9.</b> The City of Cumberland has not used the governmental power of eminent domain at any time in recent history, including by the current administration. Do you support the use of eminent domain for the purposes of economic development?	
<?php
$sql = "SELECT id FROM CommunityPriorities WHERE q51 = 'Yes'";
if ($result = mysqli_query($db, $sql)) {
	$yes = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM CommunityPriorities WHERE q51 = 'No'";
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

	<center><a href="comments.php?t=CommunityPriorities&f=q51comment" class="commlink">View Comments</a></center>

	<br />

	<table align="center"><tr align="center" valign="top">
	<td align="left"><img src="images/prevNot.png" width="74" height="43"/></td>
	<td align="right"><a href="stats02.php" class="nextLink" title="Next" alt="Next"></a></td>
	</tr></table>
	<br />
	<center><div class="formtext"><?php echo $warning?></div></center>
</div>
</center>
<br /><center><a href="participants.php" class="formtext">Return To List</a></center><br />
<div id="preload">
<img src="images/nextOn.png" width="1" height="1" alt="Next" />
</div>

<?php $db->close();?>

</body>
</html>
