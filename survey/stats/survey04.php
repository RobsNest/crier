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


$participantID = intval($_GET["id"]);
$id = intval($participantID);
$_SESSION["participantID"] = $participantID;

#Create and Check the database connection.
require 'includes/dbstuff.inc.php';
$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($db->connect_error) {
	die("Connection failed: " . $db->connect_error);
}

$sel_stmt = $db->prepare("SELECT q19, q19comment, q20, q20comment, q21, q22a, q22b, q22c, q22d,
		q22e, q22f, q22g, q22h, q22i, q22icomment, q23, q23comment, q24, q24comment, q25, q25comment,
		q26, q26comment, q27, q27comment, q28, q28comment, q29, q29comment, q30, q30comment,
		q50, q50comment FROM CurrentIssues WHERE id=?");
$sel_stmt->bind_param("i", $id);

$sel_stmt->execute();

$sel_stmt->bind_result($q19, $q19comment, $q20, $q20comment, $q21, $q22a, $q22b, $q22c, $q22d,
				$q22e, $q22f, $q22g, $q22h, $q22i, $q22icomment, $q23, $q23comment, $q24, $q24comment,
				$q25, $q25comment, $q26, $q26comment, $q27, $q27comment, $q28, $q28comment,
				$q29, $q29comment, $q30, $q30comment, $q50, $q50comment);
$sel_stmt->store_result();
$sel_stmt->fetch();

$db->close();

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
	
	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<?php echo $q19?>
	</td></tr></table>

	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">
	</td><td align="left">
	<?php echo $q19comment?>
	</td></tr></table>
	
	<br />
	
	<b>2.</b> The City of Cumberland is actively engaged in growing the city’s tax base to prevent tax rate increases and allow for tax rate cuts.  Tax base growth will generate more income to fund infrastructure and operating needs of the city.  One such project is the Maryland Avenue Redevelopment Project. Do you support this project?
	
	<br />

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<?php echo $q20?>
	</td></tr></table>

	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">
	</td><td align="left">
	<?php echo $q20comment?>
	</td></tr></table>
	
	<br />
	
	<b>3.</b> How frequently do you visit Downtown Cumberland to dine and shop?
	
	<br />

	<table align="center" cellpadding="3" width="90%" border="0">
	<tr align="center" valign="top">
	<td align="center">
	<?php echo $q21?>
	</td></tr></table>

	<br />
	
	<b>4.</b> What issue(s) of concern prevent you from more frequently visiting Downtown Cumberland?  (check all that apply)
	
	<br />

	<table align="center" cellpadding="3" width="90%" border="0">
	<tr align="center">
	<td align="left">
	<?php echo $q22a?>
	</td><td align="left">
	<?php echo $q22b?>
	</td></tr>
	<tr align="center">
	<td align="left">
	<?php echo $q22c?>
	</td><td align="left">
	<?php echo $q22d?>
	</td></tr>
	<tr align="center">
	<td align="left">
	<?php echo $q22e?>
	</td><td align="left">
	<?php echo $q22f?>
	</td></tr>
	<tr align="center">
	<td align="left">
	<?php echo $q22g?>
	</td><td align="left">
	<?php echo $q22h?>
	</td></tr></table>

	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">
	<?php echo $q22i?>
	</td><td align="left">
	<?php echo $q22icomment?>
	</td></tr></table>
	
	<br />
	
	<b>5.</b> Do you support current plans to open the Downtown Cumberland Mall to vehicular traffic, even if that means changes to outdoor dining and events like the Annual Tree Lighting?

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<?php echo $q23?>
	</td></tr></table>
	
	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">
	</td><td align="left">
	<?php echo $q23comment?>
	</td></tr></table>
	
	<br />
	
	<b>6.</b> The Mayor and City Council earn annual stipends for their service of $7,200 (Mayor) and $4,800 (City Council).  These wages were set in 1978 and have not been increased since then.  Do you support changing these rates to minimum wage if the increased cost for all five officials were kept to $30,000 ($0.66 per citizen)?

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<?php echo $q24?>
	</td></tr></table>
	
	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">
	</td><td align="left">
	<?php echo $q24comment?>
	</td></tr></table>
	
	<br />

	<b>7.</b> When you have the opportunity to shop and dine at a locally owned store or restaurant (like Downtown Dollar, The Book Centre, Oscar’s or Patrick’s) or visit a chain store or restaurant (like Dollar General, Barnes & Noble, Golden Corral or Olive Garden), which do you prefer?

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<?php echo $q25?>
	</td></tr></table>
	
	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">
	</td><td align="left">
	<?php echo $q25comment?>
	</td></tr></table>
	
	<br />

	<b>8.</b> Should enforcement of less significant laws be ignored by police in an effort to focus only and entirely on more significant laws?

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<?php echo $q26?>
	</td></tr></table>
	
	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">
	</td><td align="left">
	<?php echo $q26comment?>
	</td></tr></table>
	
	<br />

	<b>9.</b> Do you believe that all laws should be enforced fairly and uniformly?

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<?php echo $q27?>
	</td></tr></table>
	
	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">
	</td><td align="left">
	<?php echo $q27comment?>
	</td></tr></table>
	
	<br />

	<b>10.</b> Do you believe that the City of Cumberland is currently headed in the right direction?

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<?php echo $q28?>
	</td></tr></table>
	
	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">
	</td><td align="left">
	<?php echo $q28comment?>
	</td></tr></table>
	
	<br />

	<b>11.</b> Do you believe that the quality of living in the City of Cumberland has improved or declined within the past ten years?

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<?php echo $q29?>
	</td></tr></table>
	
	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">
	</td><td align="left">
	<?php echo $q29comment?>
	</td></tr></table>
	
	<br />

	<b>12.</b> The City of Cumberland’s parking budget (MPA) will experience annual deficits beginning in 2018.  The City is reducing operational and maintenance costs through cuts, to the absolute minimum.  Do you support balancing the parking budget with increased parking fees or supplementing it with general tax revenues?

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<?php echo $q30?>
	</td></tr></table>
	
	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">
	</td><td align="left">
	<?php echo $q30comment?>
	</td></tr></table>
	
	<br />

	<b>13.</b> Do you support the use of city resources  for programming to assist in the fight against the opioid epidemic?

	<table align="center" cellpadding="3" width="60%" border="0">
	<tr align="center">
	<td align="center">
	<?php echo $q50?>
	</td></tr></table>
	
	<table align="center" cellpadding="3" border="0">
	<tr align="center">
	<td align="right">
	</td><td align="left">
	<?php echo $q50comment?>
	</td></tr></table>
	
	<br />
	<table align="center"><tr align="center" valign="top">
    <td align="right"><a href="survey03.php?id=<?php echo $id?>" class="prevLink" title="Previous" alt="Previous"></a></td>
    <td align="right"><a href="survey05.php?id=<?php echo $id?>" class="nextLink" title="Next" alt="Next"></a></td>
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
</body>
</html>
