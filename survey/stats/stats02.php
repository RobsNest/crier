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
<p align="center" class="formtext">Neighborhood Impacts</p>

	<b>1.</b> The City has engaged in aggressive blight removal efforts in recent years, allocating in excess of $100,000.00 per year to removing blighted, uninhabitable, fire damaged and neighborhood nuisance properties.  Do you support continued efforts to eradicate blighted properties from city neighborhoods?
<?php
$sql = "SELECT id FROM NeighborhoodImpacts WHERE q9 = 'Yes'";
if ($result = mysqli_query($db, $sql)) {
	$yes = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM NeighborhoodImpacts WHERE q9 = 'No'";
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

	<center><a href="comments.php?t=NeighborhoodImpacts&f=q9comment" class="commlink">View Comments</a></center>

	<br />
	
	<b>2.</b> The City implemented a curbside recycling program three years ago at no additional cost to city residents.  Do you utilize the recycling program?	
<?php
$sql = "SELECT id FROM NeighborhoodImpacts WHERE q10 = 'Yes'";
if ($result = mysqli_query($db, $sql)) {
	$yes = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM NeighborhoodImpacts WHERE q10 = 'No'";
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

	<center><a href="comments.php?t=NeighborhoodImpacts&f=q10comment" class="commlink">View Comments</a></center>

	<br />
	
	<b>3.</b> The housing vacancy rate in Cumberland has been identified at approximately 20%, meaning that approximately one out of every five houses in the city is empty.  Do you support aggressive efforts to “right size” the housing inventory to encourage more investment, reduce unnecessary housing capacity and encourage more quality housing?
<?php
$sql = "SELECT id FROM NeighborhoodImpacts WHERE q11 = 'Yes'";
if ($result = mysqli_query($db, $sql)) {
	$yes = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM NeighborhoodImpacts WHERE q11 = 'No'";
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

	<center><a href="comments.php?t=NeighborhoodImpacts&f=q11comment" class="commlink">View Comments</a></center>

	<br />
	
	<b>4.</b> In recent years, the City of Cumberland has engaged in efforts to build new housing throughout Cumberland, ranging from townhomes to single family units.  Do you believe that more new quality housing construction is needed?
<?php
$sql = "SELECT id FROM NeighborhoodImpacts WHERE q12 = 'Yes'";
if ($result = mysqli_query($db, $sql)) {
	$yes = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM NeighborhoodImpacts WHERE q12 = 'No'";
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

	<center><a href="comments.php?t=NeighborhoodImpacts&f=q12comment" class="commlink">*View Comments</a></center>

	<br />
	
	<b>5.</b> What is the most significant problem facing your neighborhood today?
	
	<br /><br />

	<center><a href="comments.php?t=NeighborhoodImpacts&f=q13" class="commlink">View Comments</a></center>

	<br />
	
	<br />
	<table align="center"><tr align="center" valign="top">
    <td align="right"><a href="stats01.php" class="prevLink" title="Previous" alt="Previous"></a></td>
    <td align="right"><a href="stats03.php" class="nextLink" title="Next" alt="Next"></a></td>
    </tr></table>
	<br />
	<center><div class="formtext"><?php echo $warning?></div></center>
</div>
</center>
<br /><center><a href="participants.php" class="formtext">Return To List</a></center><br />
<div id="preload">
<img src="images/prevOn.png" width="1" height="1" alt="Previous" />
<img src="images/nextOn.png" width="1" height="1" alt="Next" />
</div>
<?php $db->close();?>
</body>
</html>
