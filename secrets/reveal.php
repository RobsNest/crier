<?php
session_start();

date_default_timezone_set('America/New_York');
$focus = "privatekey";

$handle = "";
$privateKey = "";
$secretCrypt = "";

$id = $_GET['secret'];
$warning = "Reveal the Secret if you know the Private Key.";

#Create and Check the database connection.
require 'includes/dbstuff.inc.php';
$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($db->connect_error) {
	die("Connection failed: " . $db->connect_error);
}

$sql = "SELECT id, handle, expdate, entdate, secretcrypt FROM secrets WHERE id = '$id'";
$result = $db->query($sql);

if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	$handle = $row["handle"];
	$entDate = $row["entdate"];
	$secretCrypt = $row["secretcrypt"];
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

<script>
	function textCounter(textarea, countdown, maxlimit) {
       	textareaid = document.getElementById(textarea);
       	if (textareaid.value.length > maxlimit)
       		textareaid.value = textareaid.value.substring(0, maxlimit);
       	else
       		document.getElementById(countdown).value = '('+(maxlimit-textareaid.value.length)+' characters available)';
   	}
</script>
<style>
	#plaintextcount { border: 0; color: #FFFFFF; background-color: transparent; }
</style>
<script language="javascript" type="text/JavaScript">
<!--
function validate(inform) {

	var msg='';
	if(inform.privatekey.value=='')
		msg = msg + "* A Private Key\n\n";

	if(msg != '') {
		msg = "Please fill out the required field:\n\n" + msg + "is required. Thank you.";
		alert(msg);
		return false;
}
return true;
}
//-->
</script>


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
<?php echo $secretCrypt?>
<br />
<form name="theform" action="decrypt.php" method="post" enctype="multipart/form-data" onsubmit="return validate(this);">
<input type="hidden" name="action" value="decrypt" />
<input type="hidden" name="id" value="<?php echo $id?>" />
<table align="center"><tr><td><div class="formtext"><font color="#FF0000">*</font>Private Key:</div></td>
<td><input type="passwd" id="privatekey" name="privatekey" size="25" maxlength="100" value="<?php echo $privateKey?>" class="forminput" autocomplete="off" /></td></tr></table>
<center><input type="image" src="images/DecryptSecretOff.png" onmouseover="this.src='images/DecryptSecretOn.png'" onmouseout="this.src='images/DecryptSecretOff.png'" value="submit" name="submit" /></center>
<div align="right" class="idtxt"><?php echo $id?></div>
<center><div class="formtext"><?php echo $warning?></div></center?
</form>
</div>
</center>

<br /><br /><br />

<center>
<a href="secrets.php" class="viewlink" alt="The Secrets" title="The Secrets">The Secrets</a>
</center>

<br /><br /><br /><br /><br /><br /><br />

</body>
</html>
