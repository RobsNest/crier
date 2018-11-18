<?php
session_start();
$warning = "";

#Check the session var, if not set send to index
$valid = $_SESSION["SurveyStats"];
if($valid != "Logged In") {
	#header('Location: index.php');
	$warning = "Not Logged In!";
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

<br /><center><?php echo $warning?></center><br />

<center>
<div class="displayBlk">
<p align="center" class="formtext">Community Priorities</p>
	<b>1.</b> What do you consider to be the most important issue facing the City of Cumberland?  Rank these issues from 1 to 10 with 1 being the most important to you and 10 being the least important.
<?php
$sql = "SELECT q1a FROM CommunityPriorities";
if ($result = mysqli_query($db, $sql)) {
	$q1aCnt = mysqli_num_rows($result);
	echo "*" . $q1aCnt . "*<br />";
    while($row = $result->fetch_assoc()) {
		$q1aTot += intval($row["q1a"]);
	}
	echo "*" . $q1aTot . "*<br />";
	$q1aAvg = $q1aTot / $q1aCnt;
	mysqli_free_result($result);
}
$sql = "SELECT q1b FROM CommunityPriorities";
if ($result = mysqli_query($db, $sql)) {
	$q1bCnt = mysqli_num_rows($result);
	echo "*" . $q1bCnt . "*<br />";
    while($row = $result->fetch_assoc()) {
		$q1bTot += intval($row["q1b"]);
	}
	echo "*" . $q1bTot . "*<br />";
	$q1bAvg = $q1bTot / $q1bCnt;
	mysqli_free_result($result);
}
?>

	<br /><br />

	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">
	<input type="number" id="q1a" name="q1a" value="<?php echo intval($q1aAvg)?>" size="2" min="1" max="10" class="forminputnum" autocomplete="off" />
	</td><td align="left">
	Crime, Drug Use & Overdoses
	</td></tr>

	<tr align="center">
	<td align="right">
	<input type="number" id="q1b" name="q1b" value="<?php echo intval($q1bAvg)?>" size="2" min="1" max="10" class="forminputnum" autocomplete="off" />
	</td><td align="left">
	Business Recruitment
	</td></tr>

	<tr align="center">
	<td align="right">
	<input type="number" id="q1c" name="q1c" value="<?php echo intval($q1cAvg)?>" size="2" min="1" max="10" class="forminputnum" autocomplete="off" />
	</td><td align="left">
	Street Paving	
	</td></tr>

	<tr align="center">
	<td align="right">
	<input type="text" id="q1d" name="q1d" value="<?php echo $q1dAvg?>" size="2" min="1" max="10" class="forminputnum" autocomplete="off" />
	</td><td align="left">
	Population Growth
	</td></tr>

	<tr align="center">
	<td align="right">
	<input type="number" id="q1e" name="q1e" value="<?php echo $q1eAvg?>" size="2" min="1" max="10" class="forminputnum" autocomplete="off" />
	</td><td align="left">
	Water Line Replacements
	</td></tr>

	<tr align="center">
	<td align="right">
	<input type="number" id="q1f" name="q1f" value="<?php echo $q1fAvg?>" size="2" min="1" max="10" class="forminputnum" autocomplete="off" />
	</td><td align="left">
	Job Creation
	</td></tr>

	<tr align="center">
	<td align="right">
	<input type="number" id="q1g" name="q1g" value="<?php echo $q1gAvg?>" size="2" min="1" max="10" class="forminputnum" autocomplete="off" />
	</td><td align="left">
	Tax Base Growth
	</td></tr>

	<tr align="center">
	<td align="right">
	<input type="number" id="q1h" name="q1h" value="<?php echo $q1hAvg?>" size="2" min="1" max="10" class="forminputnum" autocomplete="off" />
	</td><td align="left">
	Reduce Taxes
	</td></tr>

	<tr align="center">
	<td align="right">
	<input type="number" id="q1i" name="q1i" value="<?php echo $q1iAvg?>" size="2" min="1" max="10" class="forminputnum" autocomplete="off" />
	</td><td align="left">
	Bridge Replacements
	</td></tr>

	<tr align="center">
	<td align="right">
	<input type="number" id="q1j" name="q1j" value="<?php echo $q1jAvg?>" size="2" min="1" max="10" class="forminputnum" autocomplete="off" />
	</td><td align="left">
	Increasing Police Force
	</td></tr>

	</table>

	<br />

	<b>9.</b> The City of Cumberland has not used the governmental power of eminent domain at any time in recent history, including by the current administration. Do you support the use of eminent domain for the purposes of economic development?	
<?php
$sql = "SELECT id FROM CommunityPriorities WHERE q51 = 'Yes'";
if ($result = mysqli_query($db, $sql)) {
	$yes = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM CommunityPriorities WHERE q51 = 'No'";
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

	<center><a href="comments.php?t=CommunityPriorities&f=q51comment" class="commlink">View Comments</a></center>

	<br />

	<table align="center"><tr align="center" valign="top">
	<td align="left"><img src="images/prevNot.png" width="74" height="43"/></td>
	<td align="right"><a href="stats02.php" class="nextLink" title="Next" alt="Next"></a></td>
	</tr></table>
	<br />
	<center><div class="formtext"><?php echo $warning?></div></center>
</div>
</center>
<br /><center><a href="participants.php" class="formtext">Return To List</a></center><br />
<div id="preload">
<img src="images/nextOn.png" width="1" height="1" alt="Next" />
</div>

<?php $db->close();?>

</body>
</html>
