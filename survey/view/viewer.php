<?php
session_start();

date_default_timezone_set('America/New_York');

#Connect to & Check the database connection
require '../includes/dbstuff.inc.php';
$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($db->connect_error) {
	die("Connection failed: " . $db->connect_error);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Survey Viewer</title>
  	
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />	
	<link rel="icon" type="image/png" href="../images/icon.png" />
	<link rel="stylesheet" type="text/css" id="stylesheet" href="../css/main.css" />

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

<body bgcolor="#000000" text="#FFFFFF" topmargin="0">

<center><a href="index.php" class="formtext">Survey Participant</a></center>
<br />

<center>
<?php
$del_stmt = $db->prepare("DELETE FROM secrets WHERE id=?");
$del_stmt->bind_param("i", $id);

$sql = "SELECT id, ip, ipcity, entdate FROM participant ORDER BY id DESC";
$result = $db->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
	#Display Secret
	echo "<table align=\"center\" width=\"100%\" border=\"0\"><tr valign=\"top\">";
	echo "<td align=\"left\"><div class=\"hand\">" . $row["handle"] . "</div></td>";
	echo "<td align=\"right\"><div class=\"hand\">" . $row["entdate"] . "</div></td>";
	echo "</tr></table>";
	echo "<hr />";
	echo $row["secretcrypt"];
	echo "<br />";
	echo "<div align=\"right\" class=\"idtxt\">" . $row["expdate"] . $row["id"] . "</div>";
	echo "<center><div class=\"decryptBtn\"><a href=\"reveal.php?secret=" . $row["id"] . "\" class=\"viewlink\" alt=\"Reveal Secret\" title=\"Reveall Secret\">Reveal Secret</a></div></center>";

}
?>
</center>

<?php $db->close();?>

</body>
</html>
