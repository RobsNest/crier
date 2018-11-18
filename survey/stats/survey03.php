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

$sel_stmt = $db->prepare("SELECT q14, q14comment, q15, q15comment, q16, q16comment, q17, q17comment, 
		q18, q18comment FROM CityTaxes WHERE id=?");
$sel_stmt->bind_param("i", $id);

$sel_stmt->execute();

$sel_stmt->bind_result($q14, $q14comment, $q15, $q15comment, $q16, $q16comment, $q17, $q17comment, 
						$q18, $q18comment);
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
<p align="center" class="formtext">City Taxes</p>

	<b>1.</b> Would you support a tax rate increase to fund critical infrastructure needs in Cumberland, including, but not limited to water lines, street paving and bridge replacements?
	
	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<?php echo $q14?>
	</td></tr></table>

	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">
	</td><td align="left">
	<?php echo $q14comment?>
	</td></tr></table>
	
	<br />
	
	<b>2.</b> Would you support a tax rate cut, even if it meant reductions in police officers, firefighters and services such as street paving and winter snow plowing?
	
	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<?php echo $q15?>
	</td></tr></table>

	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">
	</td><td align="left">
	<?php echo $q15comment?>
	</td></tr></table>
	
	<br />
	
	<b>3.</b> Do you support closing the Constitution Park Pool and city ball fields as a method of reducing expenses and ultimately reducing the tax rate?
	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<?php echo $q16?>
	</td></tr></table>

	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">
	</td><td align="left">
	<?php echo $q16comment?>
	</td></tr></table>
	
	<br />
	
	<b>4.</b> The current city administration has kept the city’s finances “in the black,” preventing annual deficits every year.  Do you prefer that the city remain “in the black,” no matter the actions that are required?
	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<?php echo $q17?>
	</td></tr></table>

	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">
	</td><td align="left">
	<?php echo $q17comment?>
	</td></tr></table>
	
	<br />
	
	<b>5.</b> Should the City of Cumberland plan to cut the tax rate “at all cost,” no matter the impact?
	
	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<?php echo $q18?>
	</td></tr></table>
	
	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">
	</td><td align="left">
	<?php echo $q18comment?>
	</td></tr></table>
	
	<br />
	<table align="center"><tr align="center" valign="top">
    <td align="right"><a href="survey02.php?id=<?php echo $id?>" class="prevLink" title="Previous" alt="Previous"></a></td>
    <td align="right"><a href="survey04.php?id=<?php echo $id?>" class="nextLink" title="Next" alt="Next"></a></td>
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
