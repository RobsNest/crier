<?php
session_start();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  	
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />	

	<link rel="stylesheet" type="text/css" id="stylesheet" href="../css/main.css" />

</head>

<body bgcolor="#FFFFFF" text="#000000" topmargin="0">

<br /><center><a href="pages.php" class="reports" title="Cycle Through Reports">User Views</a></center>

<table align="center" width="98%">
<?php

$datfile = "visitor.log";
$VisitorCnt = array();
$total = 0;
$usercnt = 0;

$fh = fopen($datfile, 'r') or die("Couldn't open proper file");
while(!feof($fh)) {
    $line = fgets($fh);
    $filemessage = explode("|", $line);
    $ip = $filemessage[1];
	$city = $filemessage[2];
	$state = $filemessage[3];
	$country = $filemessage[4];
	$isp = $filemessage[5];
	$newline = "$ip|$city|$state|$country|$isp";
	if($ip != "66.242.122.236") {
    	$visitorCnt[$newline]++;
	}
}
arsort($visitorCnt);
foreach($visitorCnt as $newline => $views) {
	if($views >= 2) {
		$filemessage = explode("|", $newline);
    	$ip = $filemessage[0];
		$city = $filemessage[1];
		$state = $filemessage[2];
		$country = $filemessage[3];
		$isp = $filemessage[4];
		echo "<tr><td align=\"left\">" . $ip . "</td><td>" . $city . "</td><td>" . $state . "</td><td>" . $country . "</td><td>" . $isp . "</td><td align=\"right\">" . $views . "</td></tr>";
		$total = $total + $views;
		$usercnt++;
	}
}

fclose($fh);

echo "<tr><td></td><td></td><td></td><td></td><td align=\"left\"><b>Page Views</b></td><td align=\"right\"><b>" . $total . "</b></td></tr>";
echo "<tr><td></td><td></td><td></td><td></td><td align=\"left\"><b>Active Readers</b></td><td align=\"right\"><b>" . $usercnt . "</b></td></tr></table>";

?>
</body>
</html>
