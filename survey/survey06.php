<?php
session_start();

date_default_timezone_set('America/New_York');
$warning = "";
$focus = "email";
$botChk = "";

$participantID = intval($_SESSION["participantID"]); 
$_SESSION["participantID"] = $participantID;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	#Get and test the form input
	require 'includes/fun.inc.php';
 	$q35 = test_input($_POST["q35"]);
 	$q36 = test_input($_POST["q36"]);
 	$q37 = test_input($_POST["q37"]);
 	$q38 = test_input($_POST["q38"]);

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

		#Insert into database
		$sql = "INSERT INTO CurrentOfficials (id, q35, q36, q37, q38)
				VALUES ('$participantID', '$q35', '$q36', '$q37', '$q38')";

		if ($db->query($sql) === TRUE) {
    		$warning = "New Record Inserted";
			header( 'Location: survey07.php' ) ;
		}else{
    		$warning = "Error: " . $db->error;
		}
	}
	$db->close();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>A Survey For Cumberland Residents <?php echo $participantID?></title>
  	
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />	
	<meta name=”description” content=”Cumberland citizens opportunity to weigh in on issues of significance.” />
	<link rel="icon" type="image/png" href="images/icon.png" />
	<link rel="stylesheet" type="text/css" id="stylesheet" href="css/main.css" />

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
	#q37count { border: 0; color: #000000; background-color: transparent; }
</style>

<script>
	function textCounter2(textarea, countdown, maxlimit) {
       	textareaid = document.getElementById(textarea);
       	if (textareaid.value.length > maxlimit)
       		textareaid.value = textareaid.value.substring(0, maxlimit);
       	else
       		document.getElementById(countdown).value = '('+(maxlimit-textareaid.value.length)+' characters available)';
   	}
</script>
<style>
	#q38count { border: 0; color: #000000; background-color: transparent; }
</style>


<script type="text/javascript">
window.addEventListener('keydown',function(e){if(e.keyIdentifier=='U+000A'||e.keyIdentifier=='Enter'||e.keyCode==13){if(e.target.nodeName=='INPUT'&&e.target.type=='text'){e.preventDefault();return false;}}},true);
</script>

</head>

<body bgcolor="#FFFFFF" text="#000000" topmargin="0" onload="document.theform.<?php echo $focus?>.focus()">

<br /><br /><br />

<center>
<div class="displayBlk">
<p align="center" class="formtext">Current Officials</p>
<form name="theform" id="theform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="participantID" value="<?php echo $participantID?>" />
<input type="text" id="phone" name="phone" size="21" maxlength="22" />

	<b>1.</b>  Give the current City Council members (Seth Bernard, David Caporale, Rock Cioni and Eugene Frazier) a grade on how well you believe they are working for the City of Cumberland and achieving what you expect them to achieve.

	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="left">
	<td align="left">
	<input type="radio" name="q35" value="A_Excellent">A (Excellent)
	</td></tr>
	<tr align="left">
	<td align="left">
	<input type="radio" name="q35" value="B_Great">B (Great)
	</td></tr>
	<tr align="left">
	<td align="left">
	<input type="radio" name="q35" value="C_Averate">C (Average)
	</td></tr>
	<tr align="left">
	<td align="left">
	<input type="radio" name="q35" value="D_Poor">D (Poor)
	</td></tr>
	<tr align="left">
	<td align="left">
	<input type="radio" name="q35" value="F_Failure">F (Failure)
	</td></tr>
	</table>

	<br />
	
	<b>2.</b> Give current Mayor of Cumberland, Brian Grim, a grade on how well you believe he has performed as Mayor during his seven years of elected service, to date.
	
	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="left">
	<td align="left">
	<input type="radio" name="q36" value="A_Excellent">A (Excellent)
	</td></tr>
	<tr align="left">
	<td align="left">
	<input type="radio" name="q36" value="B_Great">B (Great)
	</td></tr>
	<tr align="left">
	<td align="left">
	<input type="radio" name="q36" value="C_Averate">C (Average)
	</td></tr>
	<tr align="left">
	<td align="left">
	<input type="radio" name="q36" value="D_Poor">D (Poor)
	</td></tr>
	<tr align="left">
	<td align="left">
	<input type="radio" name="q36" value="F_Failure">F (Failure)
	</td></tr>
	</table>
	
	<br />
	

	<b>3.</b> If you have never been a candidate for local elected office, what would have to occur for you to be interested in seeking an elected position of leadership such as Mayor or City Council member?

	<br />

	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="left">
        <textarea class="forminput" id="q37" name="q37" rows="5" cols="42" maxlength="1000" onKeyDown="textCounter('q37', 'q37count',1000);" onKeyUp="textCounter('q37', 'q37count',1000);" ><?php echo $q37?></textarea><br/>
    	<input id="q37count" readonly type="text" size="30"/>
	</td></tr></table>
	
	<br />

	<b>4.</b> Please provide thoughts, ideas and comments about any priorities that you wish to see addressed in the City of Cumberland.

	<br />

	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="left">
        <textarea class="forminput" id="q38" name="q38" rows="5" cols="42" maxlength="1000" onKeyDown="textCounter2('q38', 'q38count',1000);" onKeyUp="textCounter2('q38', 'q38count',1000);" ><?php echo $q38?></textarea><br/>
    	<input id="q38count" readonly type="text" size="30"/>
	</td></tr></table>
	
	<br />

	<center><input type="image" src="images/saveOff.png" onmouseover="this.src='images/saveOn.png'" onmouseout="this.src='images/saveOff.png'" value="submit" name="submit" /></center>
	<br />
	<center><div class="formtext"><?php echo $warning?></div></center>
</form>
</div>
</center>

<br /><br /><br />

</body>
</html>
