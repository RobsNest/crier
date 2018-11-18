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

<body bgcolor="#FFFFFF" text="#000000" topmargin="0">

<center><a href="index.php" class="formtext">Survey Viewer</a></center>

<br />

<table align="center" width="90%" border="0">
<tr align="center">
<td align="center"><b>ID</b></td>
<td align="center"><b>IP</b></td>
<td align="center"><b>IP City</b></td>
<td align="center"><b>Entry Date</b></td>
<td></td>
</tr>

<?php

$bgcolor = "#C0FFFF";
$sql = "SELECT id, ip, ipcity, entdate FROM participant ORDER BY id DESC";
$result = $db->query($sql);

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		echo "<tr valign=\"top\" bgcolor=\"$bgcolor\">";
		echo "<td align=\"center\">" . $row["id"] . "</td>";
		echo "<td align=\"center\"><a href=\"survey01.php?id=" . $row["id"] . "\">" . $row["ip"] . "</a></td>";
		echo "<td align=\"center\">" . $row["ipcity"] . "</td>";
		echo "<td align=\"center\">" . $row["entdate"] . "</td>";
		echo "<td align=\"center\"><a href=\"delete.php?id=" . $row["id"] . "\">DELETE</a></td>";
		echo "</tr>";
		if($bgcolor == "#C0FFFF") {
			$bgcolor = "#FFC0FF";
		}else{
			$bgcolor = "#C0FFFF";
		}
	}
}
?>
</table>
<?php $db->close();?>
<br /><br /><br />
</body>
</html>
