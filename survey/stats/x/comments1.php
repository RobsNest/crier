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

$table = $_GET['t'];
$question = $_GET['f'];

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

<center><div class="formtext"><?php echo $warning?></div></center>
<center><a href="javascript:history.back()" class="formtext"><?php echo $table?></a></center>
<center><?php echo $question?></center>
<center>
<div class="displayBlk">
<?php
#$sql = "SELECT ? FROM ?";
#$sel_stmt->bind_param("ss", $question, $table);
$sql = "SELECT q37 FROM CurrentOfficials";

$result = $db->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
		if(strlen($row["q37"]) > 3) {
			echo $row["q37"] . "<br /><hr><br />";
		}
	}
}
?>
</div>
</center>
<br />
<center><a href="participants.php" class="formtext">Return To List</a></center>
<br />
<center><a href="javascript:history.back()" class="formtext"><?php echo $table?></a></center>
<br /><br /><br />
<?php $db->close();?>
</body>
</html>
