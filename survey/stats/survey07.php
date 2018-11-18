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

$sel_stmt = $db->prepare("SELECT q39a, q39b, q39c, q39d, q39e, q39f, q40, q40comment,
							q41, q42, q43, q44, q45, q46a, q46b, q46c, q46d, q46e, q46f
							FROM StatisticalPurposes WHERE id=?");
$sel_stmt->bind_param("i", $id);

$sel_stmt->execute();

$sel_stmt->bind_result($q39a, $q39b, $q39c, $q39d, $q39e, $q39f, $q40, $q40comment,
						$q41, $q42, $q43, $q44, $q45, $q46a, $q46b, $q46c, $q46d, $q46e,
						$q46f);
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
	
	<br />

	<table align="center" cellpadding="3" width="80%" border="0">
	<tr align="left">
	<td align="left">
	<?php echo $q39a?>
	</td></tr>
	<tr align="left">
	<td align="left">
	<?php echo $q39b?>
	</td></tr>
	<tr align="left">
	<td align="left">
	<?php echo $q39c?>
	</td></tr>
	<tr align="left">
	<td align="left">
	<?php echo $q39d?>
	</td></tr>
	<tr align="left">
	<td align="left">
	<?php echo $q39e?>
	</td></tr>
	<tr align="left">
	<td align="left">
	<?php echo $q39f?>
	</td></tr></table>
	
	<br />
	
	<b>2.</b> Is Facebook a source of significant information that you receive about the community?
	
	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<?php echo $q40?>
	</td></tr></table>

	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">
	</td><td align="left">
	<?php echo $q40comment?>
	</td></tr></table>
	
	<br />
	
	<b>3.</b> Approximately how many City Council meetings have you attended in the past 10 years?
	
	<br />

	<table align="center" cellpadding="3" width="80%" border="0">
	<tr align="center">
	<td align="center">
	<?php echo $q41?>
	</td></tr></table>
	
	<br />
	
	<b>4.</b> Please identify which area of Cumberland you reside in.
	
	<br />

	<table align="center" cellpadding="3" width="80%" border="0">
	<tr align="center">
	<td align="center">
	<?php echo $q42?>
	</td></tr></table>
	
	<br />
	
	<b>5.</b> Please identify the category of your age.

	<br />

	<table align="center" cellpadding="3" width="80%" border="0">
	<tr align="center">
	<td align="center">
	<?php echo $q43?>
	</td></tr></table>
	
	<br />
	
	<b>6.</b> Are you a homeowner or do you rent your home?
	
	<br />

	<table align="center" cellpadding="3" width="80%" border="0">
	<tr align="left">
	<td align="left">
	<?php echo $q44?>
	</td></tr></table>
	
	<br />

	<b>7.</b> <i>Optional</i> If you plan to vote in the Primary Election on June 26, for which Mayoral candidate do you plan to vote?
	
	<br />

	<table align="center" cellpadding="3" width="80%" border="0">
	<tr align="left">
	<td align="left">
	<?php echo $q45?>
	</td></tr></table>
	<br />

	<b>8.</b> <i>Optional</i> If you plan to vote in the General Election in November, for which TWO City Council candidates do you plan to vote?

	<br />

	<table align="center" cellpadding="3" width="80%" border="0">
	<tr align="left">
	<td align="left">
	<?php echo $q46a?>
	</td></tr>
	<tr align="left">
	<td align="left">
	<?php echo $q46b?>
	</td></tr>
	<tr align="left">
	<td align="left">
	<?php echo $q46c?>
	</td></tr>
	<tr align="left">
	<td align="left">
	<?php echo $q46d?>
	</td></tr>
	<tr align="left">
	<td align="left">
	<?php echo $q46e?>
	</td></tr>
	<tr align="left">
	<td align="left">
	<?php echo $q46f?>
	</td></tr>
	<tr align="left">
	<td align="left">
	<?php echo $q46g?>
	</td></tr></table>
	
	<br />
	<table align="center"><tr align="center" valign="top">
	<td align="right"><a href="survey06.php?id=<?php echo $id?>" class="prevLink" title="Previous" alt="Previous"></a></td>
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
<img src="images/nextOn.png" width="1" height="1" alt="Next" />
</div>

</body>
</html>
