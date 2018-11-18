<?
session_start();

$focus = "handle";
$expDate = date('Y-m-d', strtotime('+27 days'));
$entDate = date('Y-m-d H:i:s');

function encrypt_decrypt($action, $string, $password) {
	$output = false;

	$encrypt_method = "AES-256-CBC";
    $secret_key = $password;
    $secret_iv = 'This is my secret iv';

    // hash
    $key = hash('sha256', $secret_key);
									     
   	// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
	$iv = substr(hash('sha256', $secret_iv), 0, 16);

	if( $action == 'encrypt' ) {
		$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
		$output = base64_encode($output);
	}else if( $action == 'decrypt' ){
		$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
	}
    return $output;
}

function Check_Input($input) {
	$input = trim($input);
	$input = stripslashes($input);
	$input = htmlspecialchars($input);
	
	#For some reason the below line eats $input
	#$input = mysql_real_escape_string($input);
	
	return $input;
}

if($_POST['action'] == "encrypt") {

	$handle = Check_Input($_POST['handle']);
	#$secret = Check_Input($_POST['secret']);
	$password = Check_Input($_POST['secret']);
	$indate = Check_Input($_POST['expdate']);
	$expDate = date('Y-m-d', strtotime($indate));
	#$salt = 'R0b5N3st!';
	$plaintext = Check_Input($_POST['plaintext']);
	
	include("captcha/securimage.php");
	$img = new Securimage();
	$valid = $img->check($_POST['code']);
	if($valid == true) {
		#Encrypt the plaintext variable
		#include("includes/cryptastic.php");
		#$cryptastic = new cryptastic;
		#$key = $cryptastic->pbkdf2($secret, $salt, 1000, 32);
		#$encrypted = $cryptastic->encrypt($plaintext, $key, true);
		
		$encrypted = encrypt_decrypt('encrypt', $plaintext, $password);

		#Insert into database
		require 'includes/dbstuff.inc.php';
		$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die
			('Error connecting to database');
		mysql_select_db($dbname) or die(mysql_error());

		$query = "INSERT INTO messages(handle, expdate, encrypted) VALUES
			('$handle', '$expDate', '$encrypted')";
		mysql_query($query) or die(mysql_error());
		mysql_close($conn);
		header( 'Location: display.php' ) ;
	}else{
		$warning = "<font color=\"#FF0000\" size=\"-6\">The Captcha Code was incorrect.</font>";
		$encrypted = $plaintext;
		$code = "";
		$focus = "code";
	}
}else{
	$handle = "";
	$secret = "";
	$encrypted = "";
	$warning = "<font color=\"#FFFFFF\" class=\"formtext\">Create an Encrypted Post.</font>";
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />	
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
	#plaintextcount { border: 0; color: #FFFFFF; background-color: #000000; }
</style>
<script language="javascript" type="text/JavaScript">
<!--
function validate(inform) {

	var msg='';
	if(inform.handle.value=='')
		msg = msg + "* A Handle (Made up name)\n\n";
	if(inform.expdate.value=='')
		msg = msg + "* Expiration Date\n\n";
	if(inform.plaintext.value=='')
		msg = msg + "* A Message to encrypt\n\n";
	if(inform.code.value=='')
		msg = msg + "* Captcha\n\n";


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
background-image:url('images/FlyingEquations.jpg');
background-attachment:fixed;
background-repeat:no-repeat;
background-position:bottom left;
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

<br />

<table align="center" width="90%" border="1" bgcolor="#000000"><tr><td>
<form name="theform" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data" onsubmit="return validate(this);">
<input type="hidden" name="action" value="encrypt" />
	<table align="center" cellpadding="3">
	<tr align="center">
	<td align="right">
	<div class="formtext"><font color="#FF0000">*</font>Handle:</div>
	</td><td align="left">
	<input type="text" id="handle" name="handle" size="42" maxlength="100" value="<?php echo $handle?>" class="forminput" />
	</td></tr>
	<tr align="center">
	<td align="right">
	<div class="formtext"><font color="#FF0000">*</font>Secret Key:</div>
	</td><td align="left">
	<input type="passwd" id="secret" name="secret" size="42" maxlength="100" value="<?php echo $secret?>" class="forminput" />
	</td></tr>
	<tr align="center">
	<td align="right">
	<div class="formtext"><font color="#FF0000">*</font>Expiration Date:</div>
	</td><td align="left">
	<input type="text" id="expdate" name="expdate" size="42" maxlength="100" value="<?php echo $expDate?>" class="forminput" />
	</td></tr>
	<tr align="center" valign="top">
	<td align="right">
	<div class="formtext"><font color="#FF0000">*</font>Message To Encrypt:</div>
	</td><td align="left">
	<input type="text" id="botchk" name="botchk" size="21" maxlength="22" />
        <textarea class="forminput" id="plaintext" name="plaintext" rows="5" cols="38" maxlength="255" onKeyDown="textCounter('plaintext', 'plaintextcount',255);" onKeyUp="textCounter('plaintext', 'plaintextcount',255);" ><?php echo $encrypted?></textarea><br/>
    	<input id="plaintextcount" readonly type="text" size="30"/>
	</td></tr>
	</table>
	<table align="center"><tr><td> 
	<div style="width: 260px; float: left; height: 90px"> 
        <img id="siimage" align="left" style="padding-right: 5px; border: 0" src="captcha/securimage_show.php?sid=db2ad6595305c95648a42e60c7fef17b" /> 
        <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="19" height="19" id="SecurImage_as3" align="middle"> 
			    <param name="allowScriptAccess" value="sameDomain" /> 
			    <param name="allowFullScreen" value="false" /> 
			    <param name="movie" value="captcha/securimage_play.swf?audio=captcha/securimage_play.php&bgColor1=#777&bgColor2=#fff&iconColor=#000&roundedCorner=5" /> 
			    <param name="quality" value="high" /> 
			    <param name="bgcolor" value="#ffffff" /> 
			    <embed src="captcha/securimage_play.swf?audio=captcha/securimage_play.php&bgColor1=#777&bgColor2=#fff&iconColor=#000&roundedCorner=5" quality="high" bgcolor="#ffffff" width="19" height="19" name="SecurImage_as3" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /> 
			  </object> 
        <a tabindex="-1" style="border-style: none" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = 'captcha/securimage_show.php?sid=' + Math.random(); return false"><img src="captcha/images/refresh.gif" alt="Reload Image" border="0" onclick="this.blur()" align="bottom" /></a> 
	</div> 
	<div style="clear: both"></div> 
	</td></tr></table>
	<table align="center" cellpadding="3">
	<tr align="center" valign="top">
	<td align="left">
	<div class="formtext"><font color="#FF0000">*</font>Captcha:</div>
	</td><td align="left">
	<input type="text" id="code" name="code" class="forminput" size="15" />
	</td></tr></table>
	<br />
	<center><input type="image" src="images/encryptItOff.png" onmouseover="this.src='images/encryptItOn.png'" onmouseout="this.src='images/encryptItOff.png'" value="submit" name="submit" /></center>
	<center><?php echo $warning?>
</form>
<br />
</td</tr></table>

</body>
</html>
