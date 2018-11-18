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
<p align="center" class="formtext">Future Priorities</p>

	<b>1.</b> Do you believe that the City of Cumberland should take ownership of the CSX bridges on the West Side of Cumberland at Washington Street, Cumberland Street and Fayette Street, including the costs of replacement and maintenance, if CSX continues to refuse to replace them?
<?php
$sql = "SELECT id FROM FuturePriorities WHERE q31 = 'Yes'";
if ($result = mysqli_query($db, $sql)) {
	$yes = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM FuturePriorities WHERE q31 = 'No'";
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

	<center><a href="comments.php?t=FuturePriorities&f=q31comment" class="commlink">*View Comments</a></center>

	<br />
	
	<b>2.</b> Do you believe that the City of Cumberland should invest in building more recreational opportunities for youth, including playgrounds, community centers and a skate plaza?
<?php
$sql = "SELECT id FROM FuturePriorities WHERE q32 = 'Yes'";
if ($result = mysqli_query($db, $sql)) {
	$yes = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM FuturePriorities WHERE q32 = 'No'";
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

	<center><a href="comments.php?t=FuturePriorities&f=q32comment" class="commlink">View Comments</a></center>

	<br />

	<b>3.</b> Do you think that the City of Cumberland should continue to apply for state and federal grants for projects, even if those grants come with “strings attached?”
<?php
$sql = "SELECT id FROM FuturePriorities WHERE q33 = 'Yes'";
if ($result = mysqli_query($db, $sql)) {
	$yes = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM FuturePriorities WHERE q33 = 'No'";
if ($result = mysqli_query($db, $sql)) {
	$no = mysqli_num_rows($result);
	mysqli_free_result($result);
}
?>

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	Yes <?php echo $yes?>
	</td><td align="center">
	No <?php echo $no?>
	</td></tr></table>
	
	<center><a href="comments.php?t=FuturePriorities&f=q33comment" class="commlink">View Comments</a></center>

	<br />

	<b>4.</b> Are you satisfied with the level of service that you receive from Allegany County government for the amount of dollars that you pay in county taxes?
<?php
$sql = "SELECT id FROM FuturePriorities WHERE q34 = 'Yes'";
if ($result = mysqli_query($db, $sql)) {
	$yes = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM FuturePriorities WHERE q34 = 'No'";
if ($result = mysqli_query($db, $sql)) {
	$no = mysqli_num_rows($result);
	mysqli_free_result($result);
}
?>

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	Yes <?php echo $yes?>
	</td><td align="center">
	No <?php echo $no?>
	</td></tr></table>
	
	<center><a href="comments.php?t=FuturePriorities&f=q34comment" class="commlink">View Comments</a></center>

	<br />
	<table align="center"><tr align="center" valign="top">
    <td align="right"><a href="stats04.php" class="prevLink" title="Previous" alt="Previous"></a></td>
    <td align="right"><a href="stats06.php" class="nextLink" title="Next" alt="Next"></a></td>
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
