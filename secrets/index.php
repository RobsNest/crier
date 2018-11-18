<?php
session_start();

date_default_timezone_set('America/New_York');
$today = date('M jS Y');
$now = date('YmdHis');

$visitorIp = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
$webpage = "Secrets";
include("../includes/logit.inc.php");
writeLog($visitorIP, $webpage);


$id = "3";
$handle ="Secret Squirell";
$cryptText = "RHlhYUNqRGx2S1JUVDZ4bHdlMGRBdmdWZGNoR2lNOHExNlhjcGZnOUFEY0xOaHpaOVlsRitqNUd2S1JOQVZUWUl6QVowekowdmxNZTVJVDlvSTdtOW9tbld6ek9mSXdmYWR5bGlBR2FFYkE9";

#Connect to & Check the database connection
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
	<title>Reveal A Secret; if you know the Private Key. <?php echo $today?></title>
  	
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />	
	<meta name=”description” content=”Secrets; An Encrypted Message Board. Reveal A Secret, if you know the Private Key.” />
	<link rel="icon" type="image/png" href="images/suit.png" />
	<link rel="stylesheet" type="text/css" id="stylesheet" href="css/main.css" />

<style type="text/css">
body
{
background-image:url('images/suit.png');
background-attachment:fixed;
background-repeat:no-repeat;
background-position:top center;
}
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
<table height="200" width="100%" border="0"><tr><td></td></tr></table>

<center>
<div class="secretsBtn">
<a href="encrypt.php" class="secretslink" alt="Encrypt My Secret" title="Encrypt My Secret">Encrypt My Secret</a>
</div>
</center>

<br />

<center>
<div class="intro">
If you know the <i>Private Key</i> you can reveal the <i>Encrypted Secret</i>.
</div>
</center>

<br />

<center>
<?php
$del_stmt = $db->prepare("DELETE FROM secrets WHERE id=?");
$del_stmt->bind_param("i", $id);

$sql = "SELECT id, handle, expdate, entdate, secretcrypt FROM secrets ORDER BY expdate DESC";
$result = $db->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
	while($row = $result->fetch_assoc()) {
		if($row["expdate"] < $now) {
			$id = $row["id"];
			$del_stmt->execute();
		}else{
			#Display Secret
			echo "<div class=\"secrets\">";
			echo "<table align=\"center\" width=\"100%\" border=\"0\"><tr valign=\"top\">";
			echo "<td align=\"left\"><div class=\"hand\">" . $row["handle"] . "</div></td>";
			echo "<td align=\"right\"><div class=\"hand\">" . $row["entdate"] . "</div></td>";
			echo "</tr></table>";
			echo "<hr />";
			echo $row["secretcrypt"];
			echo "<br />";
			echo "<div align=\"right\" class=\"idtxt\">" . $row["expdate"] . $row["id"] . "</div>";
			echo "<center><div class=\"decryptBtn\"><a href=\"reveal.php?secret=" . $row["id"] . "\" class=\"viewlink\" alt=\"Reveal Secret\" title=\"Reveall Secret\">Reveal Secret</a></div></center>";
			echo "</div><br />";

		}
	}
}else{
	echo "Be the first to Encrypt A Secret";
}
?>
</center>




<?php $db->close();?>

<br /><br /><br />

<center>
<a href="secrets.php" class="viewlink" alt="Refresh Secrets" title="Refresh Secrets">Refresh Secrets</a>
</center>

<br /><br /><br /><br /><br /><br /><br />

</body>
</html>
