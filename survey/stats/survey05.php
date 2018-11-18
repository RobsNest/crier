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


$participantID = intval($_GET["id"]);
$id = intval($participantID);
$_SESSION["participantID"] = $participantID;

#Create and Check the database connection.
require 'includes/dbstuff.inc.php';
$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($db->connect_error) {
	die("Connection failed: " . $db->connect_error);
}

$sel_stmt = $db->prepare("SELECT q31, q31comment, q32, q32comment, q33, q33comment,
						q34, q34comment FROM FuturePriorities WHERE id=?");
$sel_stmt->bind_param("i", $id);

$sel_stmt->execute();

$sel_stmt->bind_result($q31, $q31comment, $q32, $q32comment, $q33, $q33comment,	$q34, $q34comment);
$sel_stmt->store_result();
$sel_stmt->fetch();

$db->close();


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

	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<?php echo $q31?>
	</td></tr></table>

	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">
	</td><td align="left">
	<?php echo $q31comment?>
	</td></tr></table>
	
	<br />
	
	<b>2.</b> Do you believe that the City of Cumberland should invest in building more recreational opportunities for youth, including playgrounds, community centers and a skate plaza?
	
	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<?php echo $q32?>
	</td></tr></table>

	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">
	</td><td align="left">
	<?php echo $q32comment?>
	</td></tr></table>
	
	<br />
	

	<b>3.</b> Do you think that the City of Cumberland should continue to apply for state and federal grants for projects, even if those grants come with “strings attached?”

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<?php echo $q33?>
	</td></tr></table>
	
	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">
	</td><td align="left">
	<?php echo $q33comment?>
	</td></tr></table>
	
	<br />

	<b>4.</b> Are you satisfied with the level of service that you receive from Allegany County government for the amount of dollars that you pay in county taxes?

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<?php echo $q34?>
	</td></tr></table>
	
	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">
	</td><td align="left">
	<?php echo $q34comment?>
	</td></tr></table>
	
	<br />
	<table align="center"><tr align="center" valign="top">
    <td align="right"><a href="survey04.php?id=<?php echo $id?>" class="prevLink" title="Previous" alt="Previous"></a></td>
    <td align="right"><a href="survey06.php?id=<?php echo $id?>" class="nextLink" title="Next" alt="Next"></a></td>
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

</body>
</html>
