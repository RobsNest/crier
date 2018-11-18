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

$sel_stmt = $db->prepare("SELECT q1a, q1b, q1c, q1d, q1e, q1f, q1g, q1h, q1i, q1j, q2, q3, q3comment,
			q4, q4comment, q5, q5comment, q6, q6comment, q7, q7comment,
			q8, q8comment, q51, q51comment FROM CommunityPriorities WHERE id=?");
$sel_stmt->bind_param("i", $id);

$sel_stmt->execute();

$sel_stmt->bind_result($q1a, $q1b, $q1c, $q1d, $q1e, $q1f, $q1g, $q1h, $q1i, $q1j,
			$q2, $q3, $q3comment, $q4, $q4comment, $q5, $q5comment, $q6, $q6comment,
			$q7, $q7comment, $q8, $q8comment, $q51, $q51comment);
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
<p align="center" class="formtext">Community Priorities</p>
	<b>1.</b> What do you consider to be the most important issue facing the City of Cumberland?  Rank these issues from 1 to 10 with 1 being the most important to you and 10 being the least important.
	
	<br /><br />

	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">
	<input type="number" id="q1a" name="q1a" value="<?php echo $q1a?>" size="2" min="1" max="10" class="forminputnum" autocomplete="off" />
	</td><td align="left">
	Crime, Drug Use & Overdoses
	</td></tr>

	<tr align="center">
	<td align="right">
	<input type="number" id="q1b" name="q1b" value="<?php echo $q1b?>" size="2" min="1" max="10" class="forminputnum" autocomplete="off" />
	</td><td align="left">
	Business Recruitment
	</td></tr>

	<tr align="center">
	<td align="right">
	<input type="number" id="q1c" name="q1c" value="<?php echo $q1c?>" size="2" min="1" max="10" class="forminputnum" autocomplete="off" />
	</td><td align="left">
	Street Paving	
	</td></tr>

	<tr align="center">
	<td align="right">
	<input type="number" id="q1d" name="q1d" value="<?php echo $q1d?>" size="2" min="1" max="10" class="forminputnum" autocomplete="off" />
	</td><td align="left">
	Population Growth
	</td></tr>

	<tr align="center">
	<td align="right">
	<input type="number" id="q1e" name="q1e" value="<?php echo $q1e?>" size="2" min="1" max="10" class="forminputnum" autocomplete="off" />
	</td><td align="left">
	Water Line Replacements
	</td></tr>

	<tr align="center">
	<td align="right">
	<input type="number" id="q1f" name="q1f" value="<?php echo $q1f?>" size="2" min="1" max="10" class="forminputnum" autocomplete="off" />
	</td><td align="left">
	Job Creation
	</td></tr>

	<tr align="center">
	<td align="right">
	<input type="number" id="q1g" name="q1g" value="<?php echo $q1g?>" size="2" min="1" max="10" class="forminputnum" autocomplete="off" />
	</td><td align="left">
	Tax Base Growth
	</td></tr>

	<tr align="center">
	<td align="right">
	<input type="number" id="q1h" name="q1h" value="<?php echo $q1h?>" size="2" min="1" max="10" class="forminputnum" autocomplete="off" />
	</td><td align="left">
	Reduce Taxes
	</td></tr>

	<tr align="center">
	<td align="right">
	<input type="number" id="q1i" name="q1i" value="<?php echo $q1i?>" size="2" min="1" max="10" class="forminputnum" autocomplete="off" />
	</td><td align="left">
	Bridge Replacements
	</td></tr>

	<tr align="center">
	<td align="right">
	<input type="number" id="q1j" name="q1j" value="<?php echo $q1j?>" size="2" min="1" max="10" class="forminputnum" autocomplete="off" />
	</td><td align="left">
	Increasing Police Force
	</td></tr>

	</table>

	<br />

	<b>2.</b> Do you consider city efforts to invest in infrastructure or economic development to be more important?
	
	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<?php echo $q2?>
	</td></tr></table>

	<br />

	<b>3.</b> Since 2010, the City of Cumberland has paved 20% of the city streets, more than in any decade in recent history.  Do you support paving more streets, even if that means adding to the debt of the City of Cumberland?

	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<?php echo $q3?>
	</td></tr></table>

	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">
	</td><td align="left">
	<?php echo $q3comment?>
	</td></tr></table>
	
	<br />
	
	<b>4.</b> City public safety employees have asked for wage increases every year for the past several years.  Do you support increasing the wage of public safety employees, even if that means tax rate increases to do so?	

	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<?php echo $q4?>
	</td></tr></table>

	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">
	</td><td align="left">
	<?php echo $q4comment?>
	</td></tr></table>
	
	<br />
	
	<b>5.</b> The City of Cumberland supported the redevelopment of the Footer Dye Works building in Downtown Cumberland but invested no funds whatsoever into the project.  The developer expects to have invested private funds of approximately $10 million into the building by the time it is complete.  Do you support the redevelopment of the Footer Dye Works Building?

	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<?php echo $q5?>
	</td></tr></table>

	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">
	</td><td align="left">
	<?php echo $q5comment?>
	</td></tr></table>
	
	<br />
	
	<b>6.</b> The City of Cumberland provided support to the State Highway Administration to install the new “Michigan Left” at the intersection of Virginia Avenue and Industrial Boulevard to reduce the wait time at the traffic lights within that intersection.  Are you satisfied with the outcome of that project?
	
	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<?php echo $q6?>
	</td></tr></table>

	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">
	</td><td align="left">
	<?php echo $q6comment?>
	</td></tr></table>
	
	<br />
	
	<b>7.</b> Do you consider bicycle safety and promoting the City of Cumberland as a safe place for cycling to be important?
	
	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<?php echo $q7?>
	</td></tr></table>

	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">
	</td><td align="left">
	<?php echo $q7comment?>
	</td></tr></table>
	
	<br />
	
	<b>8.</b> Do you consider preservation and maintenance of historic structures in the City of Cumberland to be important?

	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<?php echo $q8?>
	</td></tr></table>

	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">
	</td><td align="left">
	<?php echo $q8comment?>
	</td></tr></table>

	<br />

	<b>9.</b> The City of Cumberland has not used the governmental power of eminent domain at any time in recent history, including by the current administration. Do you support the use of eminent domain for the purposes of economic development?	

	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<?php echo $q51?>
	</td></tr></table>

	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">
	</td><td align="left">
	<?php echo $q51comment?>
	</td></tr></table>
	<br />
	<table align="center"><tr align="center" valign="top">
	<td align="left"><img src="images/prevNot.png" width="74" height="43"/></td>
	<td align="right"><a href="survey02.php?id=<?php echo $id?>" class="nextLink" title="Next" alt="Next"></a></td>
	</tr></table>
	<br />
	<center><div class="formtext"><?php echo $warning?></div></center>
</div>
</center>
<br /><center><a href="participants.php" class="formtext">Return To List</a></center><br />
<div id="preload">
<img src="images/nextOn.png" width="1" height="1" alt="Next" />
</div>
</body>
</html>
