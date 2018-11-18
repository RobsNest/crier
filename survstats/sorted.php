<?php
session_start();

#Check the session var, if not set send to index
$valid = $_SESSION["SurveyStats"];
if($valid != "Logged In") {
	header('Location: index.php');
}

date_default_timezone_set('America/New_York');

#Connect to & Check the database connection
require '../includes/dbstuff.inc.php';
$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($db->connect_error) {
	die("Connection failed: " . $db->connect_error);
}

$sql = "SELECT id FROM participant";
if ($result = mysqli_query($db, $sql)) {
	$pCnt = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM CommunityPriorities";
if ($result = mysqli_query($db, $sql)) {
	$cpCnt = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM NeighborhoodImpacts";
if ($result = mysqli_query($db, $sql)) {
	$niCnt = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM CityTaxes";
if ($result = mysqli_query($db, $sql)) {
	$ctCnt = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM CurrentIssues";
if ($result = mysqli_query($db, $sql)) {
	$ciCnt = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM FuturePriorities";
if ($result = mysqli_query($db, $sql)) {
	$fpCnt = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM CurrentOfficials";
if ($result = mysqli_query($db, $sql)) {
	$coCnt = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM StatisticalPurposes";
if ($result = mysqli_query($db, $sql)) {
	$spCnt = mysqli_num_rows($result);
	mysqli_free_result($result);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Survey Stats</title>
  	
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />	
	<link rel="icon" type="image/png" href="../images/icon.png" />
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
<br />
<center><a href="participants.php" class="formtext">Survey Statistics</a></center>

<div class="cntBlk">
<table align="center" width="90%" border="0"><tr valign="top" align="center">
<td align="center"><a href="#" class="tablink">Participants</a><br /><b><?php echo $pCnt?></b></td>
<td align="center"><a href="stats01.php" class="tablink">Community Priorities</a><br /><b><?php echo $cpCnt?></b></td>
<td align="center"><a href="stats02.php" class="tablink">Neighborhood Impacts</a><br /><b><?php echo $niCnt?></b></td>
<td align="center"><a href="stats03.php" class="tablink">City Taxes</a><br /><b><?php echo $ctCnt?></b></td>
<td align="center"><a href="stats04.php" class="tablink">Current Issues</a><br /><b><?php echo $ciCnt?></b></td>
<td align="center"><a href="stats05.php" class="tablink">Future Priorities</a><br /><b><?php echo $fpCnt?></b></td>
<td align="center"><a href="stats06.php" class="tablink">Current Officials</a><br /><b><?php echo $coCnt?></b></td>
<td align="center"><a href="stats07.php" class="tablink">Statistical Purposes</a><br /><b><?php echo $spCnt?></b></td>
</tr></table>
</div>

<table align="center" width="90%" border="0">
<tr align="center">
<td align="center"><a href="participants.php" class="tablink">ID</a></td>
<td align="center"><a href="sortem.php" class="tablink">E-Mail</a></td>
<td align="center"><a href="sortip.php" class="tablink">IP</a></td>
<td align="center"><a href="participants.php" class="tablink">IP City</a></td>
<td align="center"><a href="participants.php" class="tablink">Entry Date</a></td>
</tr>

<?php

$bgcolor = "#C0FFFF";
$sql = "SELECT id, email, ip, ipcity, entdate FROM participant ORDER BY entdate ASC";
$result = $db->query($sql);

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		echo "<tr valign=\"top\" bgcolor=\"$bgcolor\">";
		echo "<td align=\"center\">
								<div class=\"dropdown\">
								  <button class=\"dropbtn\">" . $row["id"] . "</button>
								    <div class=\"dropdown-content\">
								    <a href=\"survey01.php?id=" . $row["id"] . "\">Community Priorities</a>
								    <a href=\"survey02.php?id=" . $row["id"] . "\">Neighborhood Impacts</a>
								    <a href=\"survey03.php?id=" . $row["id"] . "\">City Taxes</a>
								    <a href=\"survey04.php?id=" . $row["id"] . "\">Current Issues</a>
								    <a href=\"survey05.php?id=" . $row["id"] . "\">Future Priorities</a>
								    <a href=\"survey06.php?id=" . $row["id"] . "\">Current Officials</a>
								    <a href=\"survey07.php?id=" . $row["id"] . "\">Statistical Purposes</a>
								  </div>
							  </div>
							</td>";
		echo "<td align=\"center\">" . $row["email"] . "</td>";
		echo "<td align=\"center\">" . $row["ip"] . "</td>";
		echo "<td align=\"center\">" . $row["ipcity"] . "</td>";
		echo "<td align=\"center\">" . $row["entdate"] . "</td>";
		echo "</tr>";
		if($bgcolor == "#C0FFFF") {
			$bgcolor = "#FFC0FF";
		}else{
			$bgcolor = "#C0FFFF";
		}
	}
}
?>
</table>
<?php $db->close();?>
<br /><br /><br />
</body>
</html>
