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
$warning = "Reveal the Secret if you know the key.";
$handle ="Secret Squirell";
$secretCrypt = "Lorem ipsum dolor sit amet, maximus commodo non vel nunc. Nam sodales aliquam ex, eget varius leo condimentum eget. Donec aliquam accumsan lacinia.";

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
	#plaintextcount { border: 0; color: #FFFFFF; background-color: #000000; }
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
background-position:center;
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
	<br /><br /><br />
	<center>
	<div class="decryptBtn">
	<a href="button.php" class="viewlink" alt="Decrypt Secret" title="Decrypt Secret">Decrypt Secret</a>
	</div>
	</center>
	<br /><br /><br />
	<center>
	<div class="decryptBtn">
	<a href="button.php" class="viewlink" alt="Decrypt Secret" title="Decrypt Secret">Encrypt Secret</a>
	</div>
	</center>
	<br /><br /><br />
	<center>
	<div class="decryptBtn">
	<a href="button.php" class="viewlinkO" alt="Decrypt Secret" title="Decrypt Secret">Decrypt Secret</a>
	</div>
	</center>
	<br /><br /><br />
	<center>
	<div class="decryptBtn">
	<a href="button.php" class="viewlinkO" alt="Decrypt Secret" title="Decrypt Secret">Encrypt Secret</a>
	</div>
	</center>
	<br /><br /><br />
</div>
</center>

<br /><br /><br />

<center>
<a href="working.php" class="viewlink" alt="The Secrets" title="The Secrets">The Secrets</a>
</center>

<br /><br /><br /><br /><br /><br /><br />

</body>
</html>
