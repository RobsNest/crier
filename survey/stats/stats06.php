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
<p align="center" class="formtext">Current Officials</p>

	<b>1.</b>  Give the current City Council members (Seth Bernard, David Caporale, Rock Cioni and Eugene Frazier) a grade on how well you believe they are working for the City of Cumberland and achieving what you expect them to achieve.
<?php
$sql = "SELECT id FROM CurrentOfficials WHERE q35 = 'A_Excellent'";
if ($result = mysqli_query($db, $sql)) {
    $A_Excellent = mysqli_num_rows($result);
    mysqli_free_result($result);
}
$sql = "SELECT id FROM CurrentOfficials WHERE q35 = 'B_Great'";
if ($result = mysqli_query($db, $sql)) {
    $B_Great = mysqli_num_rows($result);
    mysqli_free_result($result);
}
$sql = "SELECT id FROM CurrentOfficials WHERE q35 = 'C_Averate'";
if ($result = mysqli_query($db, $sql)) {
    $C_Averate = mysqli_num_rows($result);
    mysqli_free_result($result);
}
$sql = "SELECT id FROM CurrentOfficials WHERE q35 = 'D_Poor'";
if ($result = mysqli_query($db, $sql)) {
    $D_Poor = mysqli_num_rows($result);
    mysqli_free_result($result);
}
$sql = "SELECT id FROM CurrentOfficials WHERE q35 = 'F_Failure'";
if ($result = mysqli_query($db, $sql)) {
    $F_Failure = mysqli_num_rows($result);
    mysqli_free_result($result);
}
?>
	<br />

    <table align="center" cellpadding="3" width="40%" border="0">
	<tr align="center" valign="top">
	<td align="left">A_Excellent</td><td align="right"> <?php echo $A_Excellent?></td>
	<tr align="center" valign="top">
	<td align="left">B_Great</td><td align="right"> <?php echo $B_Great?></td>
	<tr align="center" valign="top">
	<td align="left">C_Average</td><td align="right"> <?php echo $C_Averate?></td>
	<tr align="center" valign="top">
	<td align="left">D_Poor</td><td align="right"> <?php echo $D_Poor?></td>
	</tr><tr align="center" valign="top">
    <td align="left">F_Failure</td><td align="right"><?php echo $F_Failure?></td>
	 </tr></table>
	
	
	
	<br />
	
	<b>2.</b> Give current Mayor of Cumberland, Brian Grim, a grade on how well you believe he has performed as Mayor during his seven years of elected service, to date.
<?php
$sql = "SELECT id FROM CurrentOfficials WHERE q36 = 'A_Excellent'";
if ($result = mysqli_query($db, $sql)) {
    $A_Excellent = mysqli_num_rows($result);
    mysqli_free_result($result);
}
$sql = "SELECT id FROM CurrentOfficials WHERE q36 = 'B_Great'";
if ($result = mysqli_query($db, $sql)) {
    $B_Great = mysqli_num_rows($result);
    mysqli_free_result($result);
}
$sql = "SELECT id FROM CurrentOfficials WHERE q36 = 'C_Averate'";
if ($result = mysqli_query($db, $sql)) {
    $C_Averate = mysqli_num_rows($result);
    mysqli_free_result($result);
}
$sql = "SELECT id FROM CurrentOfficials WHERE q36 = 'D_Poor'";
if ($result = mysqli_query($db, $sql)) {
    $D_Poor = mysqli_num_rows($result);
    mysqli_free_result($result);
}
$sql = "SELECT id FROM CurrentOfficials WHERE q36 = 'F_Failure'";
if ($result = mysqli_query($db, $sql)) {
    $F_Failure = mysqli_num_rows($result);
    mysqli_free_result($result);
}
?>
	
	<br />

    <table align="center" cellpadding="3" width="40%" border="0">
	<tr align="center" valign="top">
	<td align="left">A_Excellent</td><td align="right"> <?php echo $A_Excellent?></td>
	<tr align="center" valign="top">
	<td align="left">B_Great</td><td align="right"> <?php echo $B_Great?></td>
	<tr align="center" valign="top">
	<td align="left">C_Average</td><td align="right"> <?php echo $C_Averate?></td>
	<tr align="center" valign="top">
	<td align="left">D_Poor</td><td align="right"> <?php echo $D_Poor?></td>
	</tr><tr align="center" valign="top">
    <td align="left">F_Failure</td><td align="right"><?php echo $F_Failure?></td>
	 </tr></table>
	
	<br />
	

	<b>3.</b> If you have never been a candidate for local elected office, what would have to occur for you to be interested in seeking an elected position of leadership such as Mayor or City Council member?

	<br />
	
	<center><a href="comments.php?t=CurrentOfficials&f=q37" class="commlink">View Comments</a></center>
	
	<br />

	<b>4.</b> Please provide thoughts, ideas and comments about any priorities that you wish to see addressed in the City of Cumberland.

	<br />

	<center><a href="comments.php?t=CurrentOfficials&f=q38" class="commlink">View Comments</a></center>
	
	<br />
	<table align="center"><tr align="center" valign="top">
    <td align="right"><a href="stats05.php" class="prevLink" title="Previous" alt="Previous"></a></td>
    <td align="right"><a href="stats07.php" class="nextLink" title="Next" alt="Next"></a></td>
    </tr></table>
	<br />
	<center><div class="formtext"><?php echo $warning?></div></center>
</form>
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
