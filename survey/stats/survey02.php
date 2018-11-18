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

$sel_stmt = $db->prepare("SELECT q9, q9comment, q10, q10comment, q11, q11comment, q12, q12comment, 
		q13 FROM NeighborhoodImpacts WHERE id=?");
$sel_stmt->bind_param("i", $id);

$sel_stmt->execute();

$sel_stmt->bind_result($q9, $q9comment, $q10, $q10comment, $q11, $q11comment, $q12, $q12comment, $q13);
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
<p align="center" class="formtext">Neighborhood Impacts</p>

	<b>1.</b> The City has engaged in aggressive blight removal efforts in recent years, allocating in excess of $100,000.00 per year to removing blighted, uninhabitable, fire damaged and neighborhood nuisance properties.  Do you support continued efforts to eradicate blighted properties from city neighborhoods?
	
	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<?php echo $q9?>
	</td></tr></table>

	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">
	</td><td align="left">
	<?php echo $q9comment?>
	</td></tr></table>
	
	<br />
	
	<b>2.</b> The City implemented a curbside recycling program three years ago at no additional cost to city residents.  Do you utilize the recycling program?	

	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<?php echo $q10?>
	</td></tr></table>

	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">
	</td><td align="left">
	<?php echo $q10comment?>
	</td></tr></table>
	
	<br />
	
	<b>3.</b> The housing vacancy rate in Cumberland has been identified at approximately 20%, meaning that approximately one out of every five houses in the city is empty.  Do you support aggressive efforts to “right size” the housing inventory to encourage more investment, reduce unnecessary housing capacity and encourage more quality housing?
	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<?php echo $q11?>
	</td></tr></table>

	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">
	</td><td align="left">
	<?php echo $q11comment?>
	</td></tr></table>
	
	<br />
	
	<b>4.</b> In recent years, the City of Cumberland has engaged in efforts to build new housing throughout Cumberland, ranging from townhomes to single family units.  Do you believe that more new quality housing construction is needed?
	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<?php echo $q12?>
	</td></tr></table>

	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">
	</td><td align="left">
	<?php echo $q12comment?>
	</td></tr></table>
	
	<br />
	
	<b>5.</b> What is the most significant problem facing your neighborhood today?
	
	<br />

	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="left">
	<?php echo $q13?>
	</td></tr></table>
	
	<br />
	
	<br />
	<table align="center"><tr align="center" valign="top">
    <td align="right"><a href="survey01.php?id=<?php echo $id?>" class="prevLink" title="Previous" alt="Previous"></a></td>
    <td align="right"><a href="survey03.php?id=<?php echo $id?>" class="nextLink" title="Next" alt="Next"></a></td>
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
</body>
</html>
