<?php
session_start();
#Community Issues
date_default_timezone_set('America/New_York');
$warning = "";
$focus = "email";
$botChk = "";

$participantID = intval($_SESSION["participantID"]); 
$_SESSION["participantID"] = $participantID;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	#Get and test the form input
	require 'includes/fun.inc.php';
 	$q19 = test_input($_POST["q19"]);
 	$q19comment = test_input($_POST["q19comment"]);
 	$q20 = test_input($_POST["q20"]);
 	$q20comment = test_input($_POST["q20comment"]);
	
	$q21 = test_input($_POST["q21"]);
	if(isset($_POST['q22a'])) {
		$q22a = test_input($_POST["q22a"]);
	}else{
		$q22a = "";
	}
	if(isset($_POST['q22b'])) {
		$q22b = test_input($_POST["q22b"]);
	}else{
		$q22b = "";
	}
	if(isset($_POST['q22c'])) {
		$q22c = test_input($_POST["q22c"]);
	}else{
		$q22c = "";
	}
	if(isset($_POST['q22d'])) {
		$q22d = test_input($_POST["q22d"]);
	}else{
		$q22d = "";
	}
	if(isset($_POST['q22e'])) {
		$q22e = test_input($_POST["q22e"]);
	}else{
		$q22e = "";
	}
	if(isset($_POST['q22f'])) {
		$q22f = test_input($_POST["q22f"]);
	}else{
		$q22f = "";
	}
	if(isset($_POST['q22g'])) {
		$q22g = test_input($_POST["q22g"]);
	}else{
		$q22g = "";
	}
	if(isset($_POST['q22h'])) {
		$q22h = test_input($_POST["q22h"]);
	}else{
		$q22h = "";
	}
	if(isset($_POST['q22i'])) {
		$q22i = test_input($_POST["q22i"]);
 		$q22icomment = test_input($_POST["q22icomment"]);
	}else{
		$q22i = "";
		$q22icomment = "";
	}

 	$q23 = test_input($_POST["q23"]);
 	$q23comment = test_input($_POST["q23comment"]);
 	$q24 = test_input($_POST["q24"]);
 	$q24comment = test_input($_POST["q24comment"]);
 	$q25 = test_input($_POST["q25"]);
 	$q25comment = test_input($_POST["q25comment"]);
 	$q26 = test_input($_POST["q26"]);
 	$q26comment = test_input($_POST["q26comment"]);
 	$q27 = test_input($_POST["q27"]);
 	$q27comment = test_input($_POST["q27comment"]);
 	$q28 = test_input($_POST["q28"]);
 	$q28comment = test_input($_POST["q28comment"]);
 	$q29 = test_input($_POST["q29"]);
 	$q29comment = test_input($_POST["q29comment"]);
 	$q30 = test_input($_POST["q30"]);
 	$q30comment = test_input($_POST["q30comment"]);
 	$q50 = test_input($_POST["q50"]);
 	$q50comment = test_input($_POST["q50comment"]);

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
		$sql = "INSERT INTO CurrentIssues (id, q19, q19comment, q20, q20comment, q21,
							q22a, q22b, q22c, q22d, q22e, q22f, q22g, q22h, q22i, q22icomment,
							q23, q23comment, q24, q24comment, q25, q25comment, q26, q26comment,
							q27, q27comment, q28, q28comment, q29, q29comment, q30, q30comment,
							q50, q50comment)
				VALUES ('$participantID', '$q19', '$q19comment', '$q20', '$q20comment', '$q21', 
						'$q22a', '$q22b', '$q22c', '$q22d', '$q22e', '$q22f', '$q22g', '$q22h',
						'$q22i', '$q22icomment', '$q23', '$q23comment', '$q24', '$q24comment',
						'$q25', '$q25comment', '$q26', '$q26comment', '$q27', '$q27comment',
						'$q28', '$q28comment', '$q29', '$q29comment', '$q30', '$q30comment',
						'$q50', '$q50comment')";

		if ($db->query($sql) === TRUE) {
    		$warning = "New Record Inserted";
			header( 'Location: survey05.php' ) ;
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
<p align="center" class="formtext">Current Issues</p>
<form name="theform" id="theform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="participantID" value="<?php echo $participantID?>" />
<input type="text" id="phone" name="phone" size="21" maxlength="22" />

	<b>1.</b> The City is working to invest in several publicly identified “opportunity sites” for new economic development in Cumberland, which will create jobs, bring new businesses and increase the tax base.  If a developer offered to purchase your home/property from you for 200% of its assessable value (double its worth), would you be willing to sell it for new businesses to come to Cumberland?
	
	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<input type="radio" name="q19" value="Yes">Yes
	</td><td align="center">
	<input type="radio" name="19" value="No">No
	</td></tr></table>

	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">Additional Comment:
	</td><td align="left">
	<input type="text" id="q19comment" name="q19comment" size="42" maxlength="500" class="forminput" autocomplete="off" />
	</td></tr></table>
	
	<br />
	
	<b>2.</b> The City of Cumberland is actively engaged in growing the city’s tax base to prevent tax rate increases and allow for tax rate cuts.  Tax base growth will generate more income to fund infrastructure and operating needs of the city.  One such project is the Maryland Avenue Redevelopment Project. Do you support this project?
	
	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<input type="radio" name="q20" value="Yes">Yes
	</td><td align="center">
	<input type="radio" name="q20" value="No">No
	</td></tr></table>

	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">Additional Comment:
	</td><td align="left">
	<input type="text" id="q20comment" name="q20comment" size="42" maxlength="500" class="forminput" autocomplete="off" />
	</td></tr></table>
	
	<br />
	
	<b>3.</b> How frequently do you visit Downtown Cumberland to dine and shop?
	
	<br />

	<table align="center" cellpadding="3" width="90%" border="0">
	<tr align="center" valign="top">
	<td align="center">
	<input type="radio" name="q21" value="Every_Week">Every Week
	</td><td align="center">
	<input type="radio" name="q21" value="Once_Per_Month">Once Per Month
	</td><td align="center">
	<input type="radio" name="q21" value="A_Few_Times_Per_Year">A Few Times Per Year
	</td><td align="center">
	<input type="radio" name="q21" value="Only_For_Events">Only For Events
	</td><td align="center">
	<input type="radio" name="q21" value="Never">Never
	</td></tr></table>

	<br />
	
	<b>4.</b> What issue(s) of concern prevent you from more frequently visiting Downtown Cumberland?  (check all that apply)
	
	<br />

	<table align="center" cellpadding="3" width="90%" border="0">
	<tr align="center">
	<td align="left">
	<input type="checkbox" name="q22a" value="Limited_Business_Choices" />Limited Business Choices
	</td><td align="left">
	<input type="checkbox" name="q22b" value="Businesses_Are_Not_Open" />Businesses Are Not Open
	</td></tr>
	<tr align="center">
	<td align="left">
	<input type="checkbox" name="q22c" value="No_Parking" />No Parking
	</td><td align="left">
	<input type="checkbox" name="q22d" value="Crime_Concerns" />Crime Concerns
	</td></tr>
	<tr align="center">
	<td align="left">
	<input type="checkbox" name="q22e" value="Uninteresting_Sales" />Uninteresting Sales
	</td><td align="left">
	<input type="checkbox" name="q22f" value="Uninteresting_Events" />Uninteresting Events
	</td></tr>
	<tr align="center">
	<td align="left">
	<input type="checkbox" name="q22g" value="Lack_Of_Transportation" />Lack Of Transportation
	</td><td align="left">
	<input type="checkbox" name="q22h" value="Visually_Unappealing" />Visually Unappealing
	</td></tr></table>

	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">
	<input type="checkbox" name="q22i" value="Other" />Other:(Specify)
	</td><td align="left">
	<input type="text" id="q22icomment" name="q22icomment" size="42" maxlength="500" class="forminput" autocomplete="off" />
	</td></tr></table>
	
	<br />
	
	<b>5.</b> Do you support current plans to open the Downtown Cumberland Mall to vehicular traffic, even if that means changes to outdoor dining and events like the Annual Tree Lighting?

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<input type="radio" name="q23" value="Yes">Yes
	</td><td align="center">
	<input type="radio" name="q23" value="No">No
	</td></tr></table>
	
	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">Additional Comment:
	</td><td align="left">
	<input type="text" id="q23comment" name="q23comment" size="42" maxlength="500" class="forminput" autocomplete="off" />
	</td></tr></table>
	
	<br />
	
	<b>6.</b> The Mayor and City Council earn annual stipends for their service of $7,200 (Mayor) and $4,800 (City Council).  These wages were set in 1978 and have not been increased since then.  Do you support changing these rates to minimum wage if the increased cost for all five officials were kept to $30,000 ($0.66 per citizen)?

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<input type="radio" name="q24" value="Yes">Yes
	</td><td align="center">
	<input type="radio" name="q24" value="No">No
	</td></tr></table>
	
	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">Additional Comment:
	</td><td align="left">
	<input type="text" id="q24comment" name="q24comment" size="42" maxlength="500" class="forminput" autocomplete="off" />
	</td></tr></table>
	
	<br />

	<b>7.</b> When you have the opportunity to shop and dine at a locally owned store or restaurant (like Downtown Dollar, The Book Centre, Oscar’s or Patrick’s) or visit a chain store or restaurant (like Dollar General, Barnes & Noble, Golden Corral or Olive Garden), which do you prefer?

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<input type="radio" name="q25" value="Locally_Owned">Locally Owned
	</td><td align="center">
	<input type="radio" name="q25" value="Chain_Store">Chain Store
	</td></tr></table>
	
	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">Additional Comment:
	</td><td align="left">
	<input type="text" id="q25comment" name="q25comment" size="42" maxlength="500" class="forminput" autocomplete="off" />
	</td></tr></table>
	
	<br />

	<b>8.</b> Should enforcement of less significant laws be ignored by police in an effort to focus only and entirely on more significant laws?

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<input type="radio" name="q26" value="Yes">Yes
	</td><td align="center">
	<input type="radio" name="q26" value="No">No
	</td></tr></table>
	
	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">Additional Comment:
	</td><td align="left">
	<input type="text" id="q26comment" name="q26comment" size="42" maxlength="500" class="forminput" autocomplete="off" />
	</td></tr></table>
	
	<br />

	<b>9.</b> Do you believe that all laws should be enforced fairly and uniformly?

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<input type="radio" name="q27" value="Yes">Yes
	</td><td align="center">
	<input type="radio" name="q27" value="No">No
	</td></tr></table>
	
	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">Additional Comment:
	</td><td align="left">
	<input type="text" id="q27comment" name="q27comment" size="42" maxlength="500" class="forminput" autocomplete="off" />
	</td></tr></table>
	
	<br />

	<b>10.</b> Do you believe that the City of Cumberland is currently headed in the right direction?

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<input type="radio" name="q28" value="Yes">Yes
	</td><td align="center">
	<input type="radio" name="q28" value="No">No
	</td></tr></table>
	
	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">Additional Comment:
	</td><td align="left">
	<input type="text" id="q28comment" name="q28comment" size="42" maxlength="500" class="forminput" autocomplete="off" />
	</td></tr></table>
	
	<br />

	<b>11.</b> Do you believe that the quality of living in the City of Cumberland has improved or declined within the past ten years?

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<input type="radio" name="q29" value="Improved">Improved
	</td><td align="center">
	<input type="radio" name="q29" value="Declined">Declined
	</td></tr></table>
	
	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">Additional Comment:
	</td><td align="left">
	<input type="text" id="q29comment" name="q29comment" size="42" maxlength="500" class="forminput" autocomplete="off" />
	</td></tr></table>
	
	<br />

	<b>12.</b> The City of Cumberland’s parking budget (MPA) will experience annual deficits beginning in 2018.  The City is reducing operational and maintenance costs through cuts, to the absolute minimum.  Do you support balancing the parking budget with increased parking fees or supplementing it with general tax revenues?

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<input type="radio" name="q30" value="Increase_Parking_Fees">Increase Parking Fees
	</td><td align="center">
	<input type="radio" name="q30" value="Supplement_With_Tax_Dollars">Supplement With Tax Dollars
	</td></tr></table>
	
	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">Additional Comment:
	</td><td align="left">
	<input type="text" id="q30comment" name="q30comment" size="42" maxlength="500" class="forminput" autocomplete="off" />
	</td></tr></table>
	
	<br />

	<b>13.</b> Do you support the use of city resources  for programming to assist in the fight against the opioid epidemic?

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<input type="radio" name="q50" value="Yes">Yes
	</td><td align="center">
	<input type="radio" name="q50" value="No">No
	</td></tr></table>
	
	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">Additional Comment:
	</td><td align="left">
	<input type="text" id="q50comment" name="q50comment" size="42" maxlength="500" class="forminput" autocomplete="off" />
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
