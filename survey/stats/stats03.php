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
<p align="center" class="formtext">City Taxes</p>

	<b>1.</b> Would you support a tax rate increase to fund critical infrastructure needs in Cumberland, including, but not limited to water lines, street paving and bridge replacements?
<?php
$sql = "SELECT id FROM CityTaxes WHERE q14 = 'Yes'";
if ($result = mysqli_query($db, $sql)) {
	$yes = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM CityTaxes WHERE q14 = 'No'";
if ($result = mysqli_query($db, $sql)) {
	$no = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM CityTaxes";
if ($result = mysqli_query($db, $sql)) {
    $ctCnt = mysqli_num_rows($result);
    mysqli_free_result($result);
}
$diff = $ctCnt - $yes;
?>
	
	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	Yes <?php echo $yes?>
	</td><td align="center">
	<b>*</b>No <?php echo $no?> / <?php echo $diff?>
	</td></tr></table>

	<center><a href="comments.php?t=CityTaxes&f=q14comment" class="commlink">View Comments</a></center>

	<br />
	
	<b>2.</b> Would you support a tax rate cut, even if it meant reductions in police officers, firefighters and services such as street paving and winter snow plowing?
<?php
$sql = "SELECT id FROM CityTaxes WHERE q15 = 'Yes'";
if ($result = mysqli_query($db, $sql)) {
	$yes = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM CityTaxes WHERE q15 = 'No'";
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

	<center><a href="comments.php?t=CityTaxes&f=q15comment" class="commlink">View Comments</a></center>

	<br />
	
	<b>3.</b> Do you support closing the Constitution Park Pool and city ball fields as a method of reducing expenses and ultimately reducing the tax rate?
<?php
$sql = "SELECT id FROM CityTaxes WHERE q16 = 'Yes'";
if ($result = mysqli_query($db, $sql)) {
	$yes = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM CityTaxes WHERE q16 = 'No'";
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

	<center><a href="comments.php?t=CityTaxes&f=q16comment" class="commlink">View Comments</a></center>

	<br />
	
	<b>4.</b> The current city administration has kept the city’s finances “in the black,” preventing annual deficits every year.  Do you prefer that the city remain “in the black,” no matter the actions that are required?
<?php
$sql = "SELECT id FROM CityTaxes WHERE q17 = 'Yes'";
if ($result = mysqli_query($db, $sql)) {
	$yes = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM CityTaxes WHERE q17 = 'No'";
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

	<center><a href="comments.php?t=CityTaxes&f=q17comment" class="commlink">View Comments</a></center>

	<br />
	
	<b>5.</b> Should the City of Cumberland plan to cut the tax rate “at all cost,” no matter the impact?
<?php
$sql = "SELECT id FROM CityTaxes WHERE q18 = 'Yes'";
if ($result = mysqli_query($db, $sql)) {
	$yes = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM CityTaxes WHERE q18 = 'No'";
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
	
	<center><a href="comments.php?t=CityTaxes&f=q18comment" class="commlink">View Comments</a></center>

	<br />
	<table align="center"><tr align="center" valign="top">
    <td align="right"><a href="stats02.php" class="prevLink" title="Previous" alt="Previous"></a></td>
    <td align="right"><a href="stats04.php" class="nextLink" title="Next" alt="Next"></a></td>
    </tr></table>
	<br />


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
