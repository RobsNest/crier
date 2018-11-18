<?php
session_start();

$warning = "Valid Login Credentials Are Required.";
$focus = "user";
$gooduser = "gooduser";
$goodpw = "5escr3T!";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	require 'includes/fun.inc.php';
	$username = test_input($_POST["user"]);
	$password = test_input($_POST["password"]);
	if($username == $gooduser && $password == $goodpw) {
		#Set the session var
		$_SESSION["ValidLogin"] = "Logged In";
		header('Location: validuser.php');
	}else{
		header('Location: warning.php');
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Secured Page Login Example</title>
  	
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />	
	<link rel="icon" type="image/png" href="images/stop.png" />
	<link rel="stylesheet" type="text/css" id="stylesheet" href="css/main.css" />

<script language="javascript" type="text/JavaScript">
<!--
function validate(inform) {
	var msg='';
    
	if(inform.password.value=='')
	        msg = "* A Valid Password\n\n";

	if(inform.user.value=='')
	        msg = "* A Valid Username\n\n";
	
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

<body bgcolor="#FFFFFF" text="#000000" topmargin="0" onload="document.theform.<?php echo $focus?>.focus()">
<table height="120" width="100%" border="0"><tr><td></td></tr></table>

<center>
<div class="introBlk">
<center><a href="index.php" class="formtext">Secured Page Login Example</a></center>
<br />
<center><a href="validuser.php" class="emlink">The secured Page</a></center>
<br />
<form name="theform" id="theform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data" onsubmit="return validate(this);">
	<table align="center" cellpadding="3">
	<tr align="center">
	<td align="right">
	<div class="formtext"><font color="#FF0000">*</font>Username:</div>
	</td><td align="left">
	<input type="text" id="user" name="user" size="18" maxlength="22" class="forminput" autocomplete="off" />
	</td></tr>
	<tr align="center">
	<td align="right">
	<div class="formtext"><font color="#FF0000">*</font>Password:</div>
	</td><td align="left">
	<input type="password" id="password" name="password" size="18" maxlength="22" class="forminput" readonly onfocus="this.removeAttribute('readonly');" />
	</td></tr>
	</table>
	<br />
	<center><input type="image" src="images/loginOff.png" onmouseover="this.src='images/loginOn.png'" onmouseout="this.src='images/loginOff.png'" value="submit" name="submit" /></center>
	<br />
	<center><div class="formtext"><?php echo $warning?></div></center>
</form>
</div>
</center>

<div id="preload"><img src="images/loginOn.png" width="1" height="1" alt="Survey" /></div>
</body>
</html>
