<?php
session_start();

$warning = "";

#Check the session var, if not set send to index
$valid = $_SESSION["SurveyStats"];
if($valid != "Logged In") {
	header('Location: index.php');
}else{
	#renew the session var
	$_SESSION["SurveyStats"] = "Logged In";
}


#Create and Check the database connection.
require 'includes/dbstuff.inc.php';
$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($db->connect_error) {
	die("Connection failed: " . $db->connect_error);
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

</head>

<body bgcolor="#FFFFFF" text="#000000" topmargin="0">

<br /><center><?php echo $participantID?></center><br />

<center>
<div class="displayBlk">
<p align="center" class="formtext">Current Issues</p>

	<b>1.</b> The City is working to invest in several publicly identified “opportunity sites” for new economic development in Cumberland, which will create jobs, bring new businesses and increase the tax base.  If a developer offered to purchase your home/property from you for 200% of its assessable value (double its worth), would you be willing to sell it for new businesses to come to Cumberland?
<?php
$sql = "SELECT id FROM CurrentIssues WHERE q19 = 'Yes'";
if ($result = mysqli_query($db, $sql)) {
	$yes = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM CurrentIssues WHERE q19 = 'No'";
if ($result = mysqli_query($db, $sql)) {
	$no = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM CurrentIssues";
if ($result = mysqli_query($db, $sql)) {
    $ciCnt = mysqli_num_rows($result);
    mysqli_free_result($result);
}
$diff = $ciCnt - $yes;
?>
	
	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	Yes <?php echo $yes?>
	</td><td align="center">
	<b>*</b>No <?php echo $no?> / <?php echo $diff?>
	</td></tr></table>

	<center><a href="comments.php?t=CurrentIssues&f=q19comment" class="commlink">View Comments</a></center>

	<br />
	
	<b>2.</b> The City of Cumberland is actively engaged in growing the city’s tax base to prevent tax rate increases and allow for tax rate cuts.  Tax base growth will generate more income to fund infrastructure and operating needs of the city.  One such project is the Maryland Avenue Redevelopment Project. Do you support this project?
<?php
$sql = "SELECT id FROM CurrentIssues WHERE q20 = 'Yes'";
if ($result = mysqli_query($db, $sql)) {
	$yes = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM CurrentIssues WHERE q20 = 'No'";
if ($result = mysqli_query($db, $sql)) {
	$no = mysqli_num_rows($result);
	mysqli_free_result($result);
}
?>
	
	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	Yes <?php echo $yes?>
	</td><td align="center">
	No <?php echo $no?>
	</td></tr></table>

	<center><a href="comments.php?t=CurrentIssues&f=q20comment" class="commlink">View Comments</a></center>

	<br />
	
	<b>3.</b> How frequently do you visit Downtown Cumberland to dine and shop?
<?php
$sql = "SELECT id FROM CurrentIssues WHERE q21 = 'Every_Week'";
if ($result = mysqli_query($db, $sql)) {
	$Every_Week = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM CurrentIssues WHERE q21 = 'Once_Per_Month'";
if ($result = mysqli_query($db, $sql)) {
	$Once_Per_Month = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM CurrentIssues WHERE q21 = 'A_Few_Times_Per_Year'";
if ($result = mysqli_query($db, $sql)) {
	$A_Few_Times_Per_Year = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM CurrentIssues WHERE q21 = 'Only_For_Events'";
if ($result = mysqli_query($db, $sql)) {
	$Only_For_Events = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM CurrentIssues WHERE q21 = 'Never'";
if ($result = mysqli_query($db, $sql)) {
	$Never = mysqli_num_rows($result);
	mysqli_free_result($result);
}
?>
	
	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center" valign="top">
	<td align="left">Every Week</td><td align="right"> <?php echo $Every_Week?></td>
	</tr><tr align="center" valign="top">
	<td align="left">Once Per Month</td><td align="right"><?php echo $Once_Per_Month?></td>
	</tr><tr align="center" valign="top">
	<td align="left">A Few Times Per Year</td><td align="right"><?php echo $A_Few_Times_Per_Year?></td>
	</tr><tr align="center" valign="top">
	<td align="left">Only For Events</td><td align="right"><?php echo $Only_For_Events?></td>
	</tr><tr align="center" valign="top">
	<td align="left">Never</td><td align="right"><?php echo $Never?></td>
	</tr></table>

	<br />
	
	<b>4.</b> What issue(s) of concern prevent you from more frequently visiting Downtown Cumberland?  (check all that apply)
<?php
$sql = "SELECT id FROM CurrentIssues WHERE q22a = 'Limited_Business_Choices'";
if ($result = mysqli_query($db, $sql)) {
	$Limited_Business_Choices = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM CurrentIssues WHERE q22b = 'Businesses_Are_Not_Open'";
if ($result = mysqli_query($db, $sql)) {
	$Businesses_Are_Not_Open = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM CurrentIssues WHERE q22c = 'No_Parking'";
if ($result = mysqli_query($db, $sql)) {
	$No_Parking = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM CurrentIssues WHERE q22d = 'Crime_Concerns'";
if ($result = mysqli_query($db, $sql)) {
	$Crime_Concerns = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM CurrentIssues WHERE q22e = 'Uninteresting_Sales'";
if ($result = mysqli_query($db, $sql)) {
	$Uninteresting_Sales = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM CurrentIssues WHERE q22f = 'Uninteresting_Events'";
if ($result = mysqli_query($db, $sql)) {
	$Uninteresting_Events = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM CurrentIssues WHERE q22g = 'Lack_Of_Transportation'";
if ($result = mysqli_query($db, $sql)) {
	$Lack_Of_Transportation = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM CurrentIssues WHERE q22h = 'Visually_Unappealing'";
if ($result = mysqli_query($db, $sql)) {
	$Visually_Unappealing = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM CurrentIssues WHERE q22i = 'Other'";
if ($result = mysqli_query($db, $sql)) {
	$Other = mysqli_num_rows($result);
	mysqli_free_result($result);
}
?>
	
	<br />

	<table align="center" cellpadding="3" width="90%" border="0">
	<tr align="center">
	<td align="left">
	Limited Business Choices <?php echo $Limited_Business_Choices?>
	</td><td align="left">
	Businesses Are Not Open <?php echo $Businesses_Are_Not_Open?>
	</td></tr>
	<tr align="center">
	<td align="left">
	No Parking <?php echo $No_Parking?>
	</td><td align="left">
	Crime Concerns <?php echo $Crime_Concerns?>
	</td></tr>
	<tr align="center">
	<td align="left">
	Uninteresting Sales<?php echo $Uninteresting_Sales?>
	</td><td align="left">
	Uninteresting Events <?php echo $Uninteresting_Events?>
	</td></tr>
	<tr align="center">
	<td align="left">
	Lack Of Transportation <?php echo $Lack_Of_Transportation?>
	</td><td align="left">
	Visually Unappealing <?php echo $Visually_Unappealing?>
	</td></tr></table>

	<table align="center" cellpadding="3" width="90%" border="0">
	<tr align="center">
	<td align="left">
	Other <?php echo $Other?>&nbsp;&nbsp;&nbsp;
	<a href="comments.php?t=CurrentIssues&f=q22icomment" class="commlink">Other Comments</a>
	</td><td align="left">
	</td></tr></table>
	
	<br />
	
	<b>5.</b> Do you support current plans to open the Downtown Cumberland Mall to vehicular traffic, even if that means changes to outdoor dining and events like the Annual Tree Lighting?
<?php
$sql = "SELECT id FROM CurrentIssues WHERE q23 = 'Yes'";
if ($result = mysqli_query($db, $sql)) {
	$yes = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM CurrentIssues WHERE q23 = 'No'";
if ($result = mysqli_query($db, $sql)) {
	$no = mysqli_num_rows($result);
	mysqli_free_result($result);
}
?>

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	Yes <?php echo $yes?>
	</td><td align="center">
	No <?php echo $no?>
	</td></tr></table>
	
	<center><a href="comments.php?t=CurrentIssues&f=q23comment" class="commlink">View Comments</a></center>

	<br />
	
	<b>6.</b> The Mayor and City Council earn annual stipends for their service of $7,200 (Mayor) and $4,800 (City Council).  These wages were set in 1978 and have not been increased since then.  Do you support changing these rates to minimum wage if the increased cost for all five officials were kept to $30,000 ($0.66 per citizen)?
<?php
$sql = "SELECT id FROM CurrentIssues WHERE q24 = 'Yes'";
if ($result = mysqli_query($db, $sql)) {
	$yes = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM CurrentIssues WHERE q24 = 'No'";
if ($result = mysqli_query($db, $sql)) {
	$no = mysqli_num_rows($result);
	mysqli_free_result($result);
}
?>

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	Yes <?php echo $yes?>
	</td><td align="center">
	No <?php echo $no?>
	</td></tr></table>
	
	<center><a href="comments.php?t=CurrentIssues&f=q24comment" class="commlink">View Comments</a></center>

	<br />

	<b>7.</b> When you have the opportunity to shop and dine at a locally owned store or restaurant (like Downtown Dollar, The Book Centre, Oscar’s or Patrick’s) or visit a chain store or restaurant (like Dollar General, Barnes & Noble, Golden Corral or Olive Garden), which do you prefer?
<?php
$sql = "SELECT id FROM CurrentIssues WHERE q25 = 'Locally_Owned'";
if ($result = mysqli_query($db, $sql)) {
	$Locally_Owned = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM CurrentIssues WHERE q25 = 'Chain_Store'";
if ($result = mysqli_query($db, $sql)) {
	$Chain_Store = mysqli_num_rows($result);
	mysqli_free_result($result);
}
?>

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	Locally Owned <?php echo $Locally_Owned?>
	</td><td align="center">
	Chain Store <?php echo $Chain_Store?>
	</td></tr></table>
	
	<center><a href="comments.php?t=CurrentIssues&f=q25comment" class="commlink">View Comments</a></center>

	<br />

	<b>8.</b> Should enforcement of less significant laws be ignored by police in an effort to focus only and entirely on more significant laws?
<?php
$sql = "SELECT id FROM CurrentIssues WHERE q26 = 'Yes'";
if ($result = mysqli_query($db, $sql)) {
	$yes = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM CurrentIssues WHERE q26 = 'No'";
if ($result = mysqli_query($db, $sql)) {
	$no = mysqli_num_rows($result);
	mysqli_free_result($result);
}
?>

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	Yes <?php echo $yes?>
	</td><td align="center">
	No <?php echo $no?>
	</td></tr></table>
	
	<center><a href="comments.php?t=CurrentIssues&f=q26comment" class="commlink">View Comments</a></center>

	<br />

	<b>9.</b> Do you believe that all laws should be enforced fairly and uniformly?
<?php
$sql = "SELECT id FROM CurrentIssues WHERE q27 = 'Yes'";
if ($result = mysqli_query($db, $sql)) {
	$yes = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM CurrentIssues WHERE q27 = 'No'";
if ($result = mysqli_query($db, $sql)) {
	$no = mysqli_num_rows($result);
	mysqli_free_result($result);
}
?>

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	Yes <?php echo $yes?>
	</td><td align="center">
	No <?php echo $no?>
	</td></tr></table>
	
	<center><a href="comments.php?t=CurrentIssues&f=q27comment" class="commlink">View Comments</a></center>

	<br />

	<b>10.</b> Do you believe that the City of Cumberland is currently headed in the right direction?
<?php
$sql = "SELECT id FROM CurrentIssues WHERE q28 = 'Yes'";
if ($result = mysqli_query($db, $sql)) {
	$yes = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM CurrentIssues WHERE q28 = 'No'";
if ($result = mysqli_query($db, $sql)) {
	$no = mysqli_num_rows($result);
	mysqli_free_result($result);
}
?>

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	Yes <?php echo $yes?>
	</td><td align="center">
	No <?php echo $no?>
	</td></tr></table>
	
	<center><a href="comments.php?t=CurrentIssues&f=q28comment" class="commlink">View Comments</a></center>

	<br />

	<b>11.</b> Do you believe that the quality of living in the City of Cumberland has improved or declined within the past ten years?
<?php
$sql = "SELECT id FROM CurrentIssues WHERE q29 = 'Improved'";
if ($result = mysqli_query($db, $sql)) {
	$Improved = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM CurrentIssues WHERE q29 = 'Declined'";
if ($result = mysqli_query($db, $sql)) {
	$Declined = mysqli_num_rows($result);
	mysqli_free_result($result);
}
?>

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	Improved <?php echo $Improved?>
	</td><td align="center">
	Declined <?php echo $Declined?>
	</td></tr></table>
	
	<center><a href="comments.php?t=CurrentIssues&f=q29comment" class="commlink">View Comments</a></center>

	<br />

	<b>12.</b> The City of Cumberland’s parking budget (MPA) will experience annual deficits beginning in 2018.  The City is reducing operational and maintenance costs through cuts, to the absolute minimum.  Do you support balancing the parking budget with increased parking fees or supplementing it with general tax revenues?
<?php
$sql = "SELECT id FROM CurrentIssues WHERE q30 = 'Increase_Parking_Fees'";
if ($result = mysqli_query($db, $sql)) {
	$Increase_Parking_Fees = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM CurrentIssues WHERE q30 = 'Supplement_With_Tax_Dollars'";
if ($result = mysqli_query($db, $sql)) {
	$Supplement_With_Tax_Dollars = mysqli_num_rows($result);
	mysqli_free_result($result);
}
?>

	<table align="center" cellpadding="3" width="95%" border="0">
	<tr align="center">
	<td align="center">
	Increase Parking Fees <?php echo $Increase_Parking_Fees?>
	Supplement With Tax Dollars <?php echo $Supplement_With_Tax_Dollars?>
	</td></tr></table>
	
	<center><a href="comments.php?t=CurrentIssues&f=q30comment" class="commlink">View Comments</a></center>

	<br />

	<b>13.</b> Do you support the use of city resources  for programming to assist in the fight against the opioid epidemic?
<?php
$sql = "SELECT id FROM CurrentIssues WHERE q50 = 'Yes'";
if ($result = mysqli_query($db, $sql)) {
	$yes = mysqli_num_rows($result);
	mysqli_free_result($result);
}
$sql = "SELECT id FROM CurrentIssues WHERE q50 = 'No'";
if ($result = mysqli_query($db, $sql)) {
	$no = mysqli_num_rows($result);
	mysqli_free_result($result);
}
?>

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	Yes <?php echo $yes?>
	</td><td align="center">
	No <?php echo $no?>
	</td></tr></table>
	
	<center><a href="comments.php?t=CurrentIssues&f=q50comment" class="commlink">View Comments</a></center>

	<br />
	<table align="center"><tr align="center" valign="top">
    <td align="right"><a href="stats03.php" class="prevLink" title="Previous" alt="Previous"></a></td>
    <td align="right"><a href="stats05.php" class="nextLink" title="Next" alt="Next"></a></td>
    </tr></table>
	<br />
	<center><div class="formtext"><?php echo $warning?></div></center>
</div>
</center>
<br /><center><a href="participants.php" class="formtext">Return To List</a></center><br />
<div id="preload">
<img src="images/prevOn.png" width="1" height="1" alt="Previous" />
<img src="images/nextOn.png" width="1" height="1" alt="Next" />
</div>
<?php $db->close();?>
</body>
</html>
