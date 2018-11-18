<?php
session_start();

date_default_timezone_set('America/New_York');
$warning = "A valid email address is required for validation purposes.";
$focus = "email";
$email = "";
$ip = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
$ipcity = "";
$entDate = date('Y-m-d');
$botChk = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
	require 'includes/fun.inc.php';
	if (empty($_POST["email"])) {
    	$botChk = "A Valid e-mail is required";
    	$warning = "You must enter a valid e-mail.";
	}else{
		$email = test_input($_POST["email"]);
		// check if e-mail address is well-formed
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    		$botChk = "Invalid e-mail format";
			$warning = "Invalid E-Mail Format"; 
		}
	}

	#phone is not needed, it is used as a Bot Checker.
   	#the input field is hidden using main.css
 	$phone = test_input($_POST["phone"]);
	if($phone != "") {
		$botChk .= "Bot Alert";
		$warning = "Hmmm. Somehing isn't quite right!";
	}

	if($botChk == "") {
		#Create and Check the database connection.
    	require 'includes/dbstuff.inc.php';
		$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
		if ($db->connect_error) {
			die("Connection failed: " . $db->connect_error);
		}
		#Get IP City
		$ipcity = get_city();

		#Insert into database
		$sql = "INSERT INTO participant (email, ip, ipcity,  entdate)
				VALUES ('$email', '$ip', '$ipcity', '$entDate')";

		if ($db->query($sql) === TRUE) {
    		$warning = "New Record Inserted";
			#Get the id
			$last_id = $db->insert_id;
			#Set a Session Variable
			$_SESSION["participantID"] = $last_id;
			header('Location: survey01.php');
		}else{
    		$warning = "Error: " . $db->error;
		}
		$db->close();
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>A Survey For Cumberland Residents</title>
  	
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />	
	<meta name=”description” content=”Cumberland citizens opportunity to weigh in on issues of significance.” />
	<link rel="icon" type="image/png" href="images/icon.png" />
	<link rel="stylesheet" type="text/css" id="stylesheet" href="css/main.css" />

<script language="javascript" type="text/JavaScript">
<!--
function validate(inform) {
	var msg='';
    if(inform.email.value=='')
	        msg = "* A Valid E-Mail Address\n\n";

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

<br /><br /><br />

<center>
<div class="displayBlk">
<center><a href="index.php" class="formtext">Survey Participant</a></center>
<br />
<form name="theform" id="theform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data" onsubmit="return validate(this);">
	<table align="center" cellpadding="3">
	<tr align="center">
	<td align="right">
	<div class="formtext"><font color="#FF0000">*</font>E-Mail:</div>
	</td><td align="left">
	<input type="email" id="email" name="email" size="42" maxlength="100" value="<?php echo $email?>" class="forminput" />
	<input type="text" id="phone" name="phone" size="21" maxlength="22" />
	</td></tr>
	</table>
	<table align="center" cellpadding="3">
	<tr align="center">
	<td align="right">

    </td><td align="left">
	</td>
	</tr></table>
	<center><input type="image" src="images/saveOff.png" onmouseover="this.src='images/saveOn.png'" onmouseout="this.src='images/saveOff.png'" value="submit" name="submit" /></center>
	<br />
	<center><div class="formtext"><?php echo $warning?></div></center>
</form>
</div>
</center>

<br /><br /><br />

</body>
</html>
