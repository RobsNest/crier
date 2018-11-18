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
 	$q9 = test_input($_POST["q9"]);
 	$q9comment = test_input($_POST["q9comment"]);
 	$q10 = test_input($_POST["q10"]);
 	$q10comment = test_input($_POST["q10comment"]);
 	$q11 = test_input($_POST["q11"]);
 	$q11comment = test_input($_POST["q11comment"]);
 	$q12 = test_input($_POST["q12"]);
 	$q12comment = test_input($_POST["q12comment"]);
 	$q13 = test_input($_POST["q13"]);

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
		$sql = "INSERT INTO NeighborhoodImpacts (id, q9, q9comment, q10, q10comment, q11, q11comment,
							q12, q12comment, q13)
				VALUES ('$participantID', '$q9', '$q9comment', '$q10', '$q10comment', '$q11', '$q11comment',
						'$q12', '$q12comment', '$q13')";

		if ($db->query($sql) === TRUE) {
    		$warning = "New Record Inserted";
			header( 'Location: survey03.php' ) ;
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
	#q13count { border: 0; color: #000000; background-color: transparent; }
</style>
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

<script type="text/javascript">
window.addEventListener('keydown',function(e){if(e.keyIdentifier=='U+000A'||e.keyIdentifier=='Enter'||e.keyCode==13){if(e.target.nodeName=='INPUT'&&e.target.type=='text'){e.preventDefault();return false;}}},true);
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
<p align="center" class="formtext">Neighborhood Impacts</p>
<form name="theform" id="theform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data" onsubmit="return validate(this);">
<input type="hidden" name="participantID" value="<?php echo $participantID?>" />
<input type="text" id="phone" name="phone" size="21" maxlength="22" />

	<b>1.</b> The City has engaged in aggressive blight removal efforts in recent years, allocating in excess of $100,000.00 per year to removing blighted, uninhabitable, fire damaged and neighborhood nuisance properties.  Do you support continued efforts to eradicate blighted properties from city neighborhoods?
	
	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<input type="radio" name="q9" value="Yes">Yes
	</td><td align="center">
	<input type="radio" name="q9" value="No">No
	</td></tr></table>

	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">Additional Comment:
	</td><td align="left">
	<input type="text" id="q9comment" name="q9comment" size="42" maxlength="500" class="forminput" autocomplete="off" />
	</td></tr></table>
	
	<br />
	
	<b>2.</b> The City implemented a curbside recycling program three years ago at no additional cost to city residents.  Do you utilize the recycling program?	

	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<input type="radio" name="q10" value="Yes">Yes
	</td><td align="center">
	<input type="radio" name="q10" value="No">No
	</td></tr></table>

	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">Additional Comment:
	</td><td align="left">
	<input type="text" id="q10comment" name="q10comment" size="42" maxlength="500" class="forminput" autocomplete="off" />
	</td></tr></table>
	
	<br />
	
	<b>3.</b> The housing vacancy rate in Cumberland has been identified at approximately 20%, meaning that approximately one out of every five houses in the city is empty.  Do you support aggressive efforts to “right size” the housing inventory to encourage more investment, reduce unnecessary housing capacity and encourage more quality housing?
	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<input type="radio" name="q11" value="Yes">Yes
	</td><td align="center">
	<input type="radio" name="q11" value="No">No
	</td></tr></table>

	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">Additional Comment:
	</td><td align="left">
	<input type="text" id="q11comment" name="q11comment" size="42" maxlength="500" class="forminput" autocomplete="off" />
	</td></tr></table>
	
	<br />
	
	<b>4.</b> In recent years, the City of Cumberland has engaged in efforts to build new housing throughout Cumberland, ranging from townhomes to single family units.  Do you believe that more new quality housing construction is needed?
	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<input type="radio" name="q12" value="Yes">Yes
	</td><td align="center">
	<input type="radio" name="q12" value="No">No
	</td></tr></table>

	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">Additional Comment:
	</td><td align="left">
	<input type="text" id="q12comment" name="q12comment" size="42" maxlength="500" class="forminput" autocomplete="off" />
	</td></tr></table>
	
	<br />
	
	<b>5.</b> What is the most significant problem facing your neighborhood today?
	
	<br />

	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="left">
        <textarea class="forminput" id="q13" name="q13" rows="5" cols="42" maxlength="1000" onKeyDown="textCounter('q13', 'q13count',1000);" onKeyUp="textCounter('q13', 'q13count',1000);" ><?php echo $q13?></textarea><br/>
    	<input id="q13count" readonly type="text" size="30"/>
	</td></tr></table>
	
	<br />
	
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
