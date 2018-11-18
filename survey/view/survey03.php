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
 	$q14 = test_input($_POST["q14"]);
 	$q14comment = test_input($_POST["q14comment"]);
 	$q15 = test_input($_POST["q15"]);
 	$q15comment = test_input($_POST["q15comment"]);
 	$q16 = test_input($_POST["q16"]);
 	$q16comment = test_input($_POST["q16comment"]);
 	$q17 = test_input($_POST["q17"]);
 	$q17comment = test_input($_POST["q17comment"]);
 	$q18 = test_input($_POST["q18"]);
 	$q18comment = test_input($_POST["q18comment"]);

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
		$sql = "INSERT INTO CityTaxes (id, q14, q14comment, q15, q15comment, q16, q16comment,
							q17, q17comment, q18, q18comment)
				VALUES ('$participantID', '$q14', '$q14comment', '$q15', '$q15comment', '$q16', '$q16comment',
						'$q17', '$q17comment', '$q18', '$q18comment')";

		if ($db->query($sql) === TRUE) {
    		$warning = "New Record Inserted";
			header( 'Location: survey04.php' ) ;
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
	<title>A Survey For Cumberland Residence. <?php echo $participantID?></title>
  	
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />	
	<meta name=”description” content=”A Survey for Mayor Grim.” />
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

<script type="text/javascript">
window.addEventListener('keydown',function(e){if(e.keyIdentifier=='U+000A'||e.keyIdentifier=='Enter'||e.keyCode==13){if(e.target.nodeName=='INPUT'&&e.target.type=='text'){e.preventDefault();return false;}}},true);
</script>

</head>

<body bgcolor="#FFFFFF" text="#000000" topmargin="0" onload="document.theform.<?php echo $focus?>.focus()">

<br /><br /><br />

<center>
<div class="displayBlk">
<p align="center" class="formtext">City Taxes</p>
<form name="theform" id="theform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="participantID" value="<?php echo $participantID?>" />
<input type="text" id="phone" name="phone" size="21" maxlength="22" />

	<b>1.</b> Would you support a tax rate increase to fund critical infrastructure needs in Cumberland, including, but not limited to water lines, street paving and bridge replacements?
	
	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<input type="radio" name="q14" value="Yes">Yes
	</td><td align="center">
	<input type="radio" name="14" value="No">No
	</td></tr></table>

	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">Additional Comment:
	</td><td align="left">
	<input type="text" id="q14comment" name="q14comment" size="42" maxlength="500" class="forminput" autocomplete="off" />
	</td></tr></table>
	
	<br />
	
	<b>2.</b> Would you support a tax rate cut, even if it meant reductions in police officers, firefighters and services such as street paving and winter snow plowing?
	
	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<input type="radio" name="q15" value="Yes">Yes
	</td><td align="center">
	<input type="radio" name="q15" value="No">No
	</td></tr></table>

	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">Additional Comment:
	</td><td align="left">
	<input type="text" id="q15comment" name="q15comment" size="42" maxlength="500" class="forminput" autocomplete="off" />
	</td></tr></table>
	
	<br />
	
	<b>3.</b> Do you support closing the Constitution Park Pool and city ball fields as a method of reducing expenses and ultimately reducing the tax rate?
	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<input type="radio" name="q16" value="Yes">Yes
	</td><td align="center">
	<input type="radio" name="q16" value="No">No
	</td></tr></table>

	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">Additional Comment:
	</td><td align="left">
	<input type="text" id="q16comment" name="q16comment" size="42" maxlength="500" class="forminput" autocomplete="off" />
	</td></tr></table>
	
	<br />
	
	<b>4.</b> The current city administration has kept the city’s finances “in the black,” preventing annual deficits every year.  Do you prefer that the city remain “in the black,” no matter the actions that are required?
	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<input type="radio" name="q17" value="Yes">Yes
	</td><td align="center">
	<input type="radio" name="q17" value="No">No
	</td></tr></table>

	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">Additional Comment:
	</td><td align="left">
	<input type="text" id="q17comment" name="q17comment" size="42" maxlength="500" class="forminput" autocomplete="off" />
	</td></tr></table>
	
	<br />
	
	<b>5.</b> Should the City of Cumberland plan to cut the tax rate “at all cost,” no matter the impact?
	
	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<input type="radio" name="q18" value="Yes">Yes
	</td><td align="center">
	<input type="radio" name="q18" value="No">No
	</td></tr></table>
	
	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">Additional Comment:
	</td><td align="left">
	<input type="text" id="q18comment" name="q18comment" size="42" maxlength="500" class="forminput" autocomplete="off" />
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
