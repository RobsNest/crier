<?php
session_start();

date_default_timezone_set('America/New_York');
$focus = "privatekey";

$handle = "";
$privateKey = "";
$secretText = "";
$secretCrypt = "";
$warning = "Reveal the Secret if you know the Private Key.";


#Create and Check the database connection.
require 'includes/dbstuff.inc.php';
$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($db->connect_error) {
	die("Connection failed: " . $db->connect_error);
}

$id = mysqli_real_escape_string($db, $_POST['id']);
$privateKey = mysqli_real_escape_string($db, $_POST['privatekey']);

$sql = "SELECT id, handle, expdate, entdate, secretcrypt FROM secrets WHERE id = '$id'";
$result = $db->query($sql);

if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	$handle = $row["handle"];
	$entDate = $row["entdate"];
	$secretCrypt = $row["secretcrypt"];
	
	require 'includes/fun.inc.php';
	$plainText = encrypt_decrypt('decrypt', $secretCrypt, $privateKey);
}

$db->close();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Reveal the Secret if you know the Private Key. <?php echo $today?></title>
  	
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />	
	<meta name=”description” content=”Secrets; An Encrypted Message Board. Encrypt your Secret and covet the Private Key.” />
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

<body bgcolor="#000000" text="#FFFFFF" topmargin="0" onload="document.theform.<?php echo $focus?>.focus()">
<table height="200" width="100%" border="0"><tr><td></td></tr></table>

<center>
<div class="secrets">
<table align="center" width="100%" border="0"><tr valign="top">
<td align="left"><div class="hand"><?php echo $handle?></div></td>
<td align="right"><div class="hand"><?php echo $entDate?></div></td>
</tr></table>
<hr />
<?php echo $plainText?>
<br />
<div align="right" class="idtxt"><?php echo $id?></div>
<center><div class="decryptBtn"><a href="secrets.php" class="viewlink" alt="The Secrets" title="The Secrets">Close</a></div></center>
</div>
<br />
</center>



<br /><br /><br />

<center>
<a href="secrets.php" class="viewlink" alt="The Secrets" title="The Secrets">The Secrets</a>
</center>

<br /><br /><br /><br /><br /><br /><br />

</body>
</html>
