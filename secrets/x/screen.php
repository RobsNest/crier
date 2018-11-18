<?php
session_start();

date_default_timezone_set('America/New_York');
$expDate = date('YmdHis', strtotime('+7 days'));
$entDate = date('M jS Y');
$focus = "privatekey";
$handle = "";
$privateKey = "";
$secretText = "";
$secretCrypt = "";

$id = $_GET['secret'];
$warning = "Reveal the Secret if you know the Private Key.";
$handle ="Secret Squirell";
$secretCrypt = "RHlhYUNqRGx2S1JUVDZ4bHdlMGRBdmdWZGNoR2lNOHExNlhjcGZnOUFEY0xOaHpaOVlsRitqNUd2S1JOQVZUWUl6QVowekowdmxNZTVJVDlvSTdtOW9tbld6ek9mSXdmYWR5bGlBR2FFYkE9";

if($_POST['action'] == "encrypt") {
	#Create and Check the database connection.
    require 'includes/dbstuff.inc.php';
	$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	if ($db->connect_error) {
		die("Connection failed: " . $db->connect_error);
	}

	$handle = mysqli_real_escape_string($db, $_POST['handle']);
    $privateKey = mysqli_real_escape_string($db, $_POST['privatekey']);
	$secretText = mysqli_real_escape_string($db, $_POST['plaintext']);
	$secretText = filter_var($secretText, FILTER_SANITIZE_STRING);

	#phone is not needed, it is used as a Bot Checker.
   	#the input field is hidden using main.css
	$phone = mysqli_real_escape_string($db, $_POST['phone']);

	if($phone == "") {
		#Encrypt $secretText to $secretCrypt
		require 'includes/fun.inc.php';
		$secretCrypt = encrypt_decrypt('encrypt', $secretText, $privateKey);
		
		#Get a col number of 1 or 2
		$col = get_col();

		#Insert into database
		$sql = "INSERT INTO secrets (handle, expdate, entdate, secretcrypt, col)
				VALUES ('$handle', '$expDate', '$entDate','$secretCrypt', '$col')";

		if ($db->query($sql) === TRUE) {
    		$warning = "New Secret Encrypted  successfully: $col";
		} else {
    		$warning = "Error: " . $sql . "<br>" . $db->error;
		}
	
		header( 'Location: working.php' ) ;

	}else{
	    #Something is in the $phone Bot Checker
		header( 'Location: https://www.cumberlandcrier.com/secrets' ) ;
    }
	$db->close();
}

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


</head>

<body bgcolor="#FFFFFF" text="#000000" topmargin="0" onload="document.theform.<?php echo $focus?>.focus()">
<table height="200" width="100%" border="0"><tr><td></td></tr></table>

<center>
<div class="secrets">
<form name="theform" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data" onsubmit="return validate(this);">
<input type="hidden" name="action" value="encrypt" />
	<table align="center" cellpadding="3">
	<tr align="center">
	<td align="right">
	<div class="formtext">Name/Handle:</div>
	</td><td align="left">
	<input type="text" id="handle" name="handle" size="42" maxlength="100" value="<?php echo $handle?>" class="forminput" readonly autocomplete="off" />
	</td></tr>
	<tr align="center">
	<td align="right">
	<div class="formtext"><font color="#FF0000">*</font>Private Key:</div>
	</td><td align="left">
	<input type="passwd" id="privatekey" name="privatekey" size="42" maxlength="100" value="<?php echo $privateKey?>" class="forminput" autocomplete="off" />
	</td></tr>
	<tr align="center" valign="top">
	<td align="right">
	<div class="formtext">Secret:</div>
	</td><td align="left">
	<input type="text" id="phone" name="phone" size="21" maxlength="22" />
        <textarea readonly class="forminput" id="plaintext" name="plaintext" rows="5" cols="38" maxlength="255" onKeyDown="textCounter('plaintext', 'plaintextcount',255);" onKeyUp="textCounter('plaintext', 'plaintextcount',255);" ><?php echo $secretCrypt?></textarea><br/>
    	<input id="plaintextcount" readonly type="text" size="30"/>
	</td></tr>
	</table>

	<div style="clear: both"></div> 

	<center><input type="image" src="images/DecryptSecretOff.png" onmouseover="this.src='images/DecryptSecretOn.png'" onmouseout="this.src='images/DecryptSecretOff.png'" value="submit" name="submit" /></center>
	<div align="right" class="idtxt"><?php echo $id?></div>
	<center><div class="formtext"><?php echo $warning?></div></center?
</form>
</div>
</center>

<br /><br /><br />

<center>
<a href="working.php" class="viewlink" alt="The Secrets" title="The Secrets">The Secrets</a>
</center>

<br /><br /><br /><br /><br /><br /><br />

</body>
</html>
