<?php
session_start();

date_default_timezone_set('America/New_York');
$expDate = date('YmdHis', strtotime('+3 days'));
$entDate = date('M jS Y');
$warning = "Create an Encrypted Secret";
$focus = "handle";
$handle = "";
$privateKey = "";
$secretText = "";
$secretCrypt = "";
$dataChk = "";

if($_POST['action'] == "encrypt") {
	#Create and Check the database connection.
    require 'includes/dbstuff.inc.php';
	$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	if ($db->connect_error) {
		die("Connection failed: " . $db->connect_error);
	}

	$handle = mysqli_real_escape_string($db, $_POST['handle']);
	if($handle == "") {
		$dataChk .= "Handle";
		$warning = "A handle or made up name is required.";
	}
    $privateKey = $_POST['privatekey'];
	if($privateKey == "") {
		$dataChk .= "Private Key";
		$warning = "A Private Key is required.";
	}
	$secretText = mysqli_real_escape_string($db, $_POST['plaintext']);
	$secretText = filter_var($secretText, FILTER_SANITIZE_STRING);
	if($secretText == "") {
		$dataChk .= "Secret Text";
		$warning = "A Secret to Encrypt is required.";
	}
	#phone is not needed, it is used as a Bot Checker.
   	#the input field is hidden using main.css
	$phone = mysqli_real_escape_string($db, $_POST['phone']);
	if($phone != "") {
		$dataChk .= "Bot Alert";
		$warning = "Hmmm. Somehing isn't quite right!";
	}
	if($dataChk == "") {
		#Encrypt $secretText to $secretCrypt
		require 'includes/fun.inc.php';
		$secretCrypt = encrypt_decrypt('encrypt', $secretText, $privateKey);
		#Insert into database
		$sql = "INSERT INTO secrets (handle, expdate, entdate, secretcrypt)
				VALUES ('$handle', '$expDate', '$entDate','$secretCrypt')";

		if ($db->query($sql) === TRUE) {
    		$warning = "New Secret Encrypted  successfully: $col";
			$handle = "";
			$privateKey = "";
			$secretText = "";
			$secretCrypt = "";
		}else{
    		$warning = "Error: " . $sql . "<br>" . $db->error;
		}
		header( 'Location: secrets.php' ) ;
	}
	$db->close();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Encrypt Your Secret; and covet the Private Key. <?php echo $today?></title>
  	
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
	if(inform.handle.value=='')
		msg = msg + "* A Handle (Made up name)\n\n";
	if(inform.privatekey.value=='')
		msg = msg + "* A Private Key\n\n";
	if(inform.plaintext.value=='')
		msg = msg + "* A Secret to Encrypt\n\n";

	if(msg != '') {
		msg = "Please fill out the required field:\n\n" + msg + "are required. Thank you.";
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
<form name="theform" id="theform" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data" onsubmit="return validate(this);">
<input type="hidden" name="action" value="encrypt" />
	<table align="center" cellpadding="3">
	<tr align="center">
	<td align="right">
	<div class="formtext"><font color="#FF0000">*</font>Name/Handle:</div>
	</td><td align="left">
	<input type="text" id="handle" name="handle" size="42" maxlength="100" value="<?php echo $handle?>" class="forminput" autocomplete="off" />
	</td></tr>
	<tr align="center">
	<td align="right">
	<div class="formtext"><font color="#FF0000">*</font>Private Key:</div>
	</td><td align="left">
	<input type="passwd" id="privatekey" name="privatekey" size="42" maxlength="100" value="<?php echo $privateKey?>" class="forminput" autocomplete="off" />
	</td></tr>
	<tr align="center" valign="top">
	<td align="right">
	<div class="formtext"><font color="#FF0000">*</font>Secret:</div>
	</td><td align="left">
	<input type="text" id="phone" name="phone" size="21" maxlength="22" />
        <textarea class="forminput" id="plaintext" name="plaintext" rows="5" cols="38" maxlength="255" onKeyDown="textCounter('plaintext', 'plaintextcount',255);" onKeyUp="textCounter('plaintext', 'plaintextcount',255);" ><?php echo $secretCrypt?></textarea><br/>
    	<input id="plaintextcount" readonly type="text" size="30"/>
	</td></tr>
	</table>
	<center><input type="image" src="images/EncryptSecretOff.png" onmouseover="this.src='images/EncryptSecretOn.png'" onmouseout="this.src='images/EncryptSecretOff.png'" value="submit" name="submit" /></center>
	<br />
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
