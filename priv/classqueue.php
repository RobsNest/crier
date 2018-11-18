<?php
session_start();

date_default_timezone_set('America/New_York');
$today = date('l F jS Y');
$visitorIp = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
$webpage = "Classified Queue";
include("../includes/logit.inc.php");
writeLog($visitorIP, $webpage);

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
<title>Queue Classified - <?php echo $today?></title>

<link rel="icon" type="image/png" href="../images/crier.png" />
<link rel="stylesheet" type="text/css" id="stylesheet" href="../css/main.css" />

<body bgcolor="#FFFFFF" text="#000000" topmargin="0">
<center><div class="tandt">Classified Queue</div></center>

<?php
$color = "#C0FFC0";

$sql = "SELECT id, expDate, viewable, email, category, ad FROM classifieds";
$result = $db->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
	while($row = $result->fetch_assoc()) {
		echo "<table bgcolor=\"$color\" align=\"center\" width=\"100%\"><tr>";
		echo "<td align=\"left\"><div class=\"queuetext\">" . $row["id"] . "</div></td>";
		echo "<td align=\"center\"><div class=\"queuetext\">" . $row["email"] . "</div></td>";
		echo "<td align=\"center\"><div class=\"queuetext\">" . $row["expDate"] . "</div></td>";
		echo "<td align=\"right\"><a href=\"classview.php?id=" . $row["id"] . "&viewable=" . $row["viewable"] . "\"><div class=\"queuetext\">" . $row["viewable"] . "</div></a><td></tr></table>";
		echo "<table bgcolor=\"$color\" align=\"center\" width=\"100%\">";
		echo "<tr><td align=\"left\"><div class=\"queuetext\">" . $row["category"] . "<br />" . $row["ad"] . "</div></td></tr>";
		echo "</table>";
		if($color == "#C0FFC0") {
			$color = "#C0C0C0";
		}else{
			$color = "#C0FFC0";
		}
	}
}else{
	echo "No Classified Ads.";
}
?>

</body>
</html>
