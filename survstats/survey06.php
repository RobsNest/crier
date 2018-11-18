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

$sel_stmt = $db->prepare("SELECT q35, q36, q37, q38 FROM CurrentOfficials WHERE id=?");
$sel_stmt->bind_param("i", $id);

$sel_stmt->execute();

$sel_stmt->bind_result($q35, $q36, $q37, $q38);
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
<p align="center" class="formtext">Current Officials</p>

	<b>1.</b>  Give the current City Council members (Seth Bernard, David Caporale, Rock Cioni and Eugene Frazier) a grade on how well you believe they are working for the City of Cumberland and achieving what you expect them to achieve.

	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<?php echo $q35?>
	</td></tr>
	</table>

	<br />
	
	<b>2.</b> Give current Mayor of Cumberland, Brian Grim, a grade on how well you believe he has performed as Mayor during his seven years of elected service, to date.
	
	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<?php echo $q36?>
	</td></tr>
	</table>
	
	<br />
	

	<b>3.</b> If you have never been a candidate for local elected office, what would have to occur for you to be interested in seeking an elected position of leadership such as Mayor or City Council member?

	<br />

	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="left">
	<?php echo $q37?>
	</td></tr></table>
	
	<br />

	<b>4.</b> Please provide thoughts, ideas and comments about any priorities that you wish to see addressed in the City of Cumberland.

	<br />

	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="left">
	<?php echo $q38?>
	</td></tr></table>
	
	<br />
	<table align="center"><tr align="center" valign="top">
    <td align="right"><a href="survey05.php?id=<?php echo $id?>" class="prevLink" title="Previous" alt="Previous"></a></td>
    <td align="right"><a href="survey07.php?id=<?php echo $id?>" class="nextLink" title="Next" alt="Next"></a></td>
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

</body>
</html>
