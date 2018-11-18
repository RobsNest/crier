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

<br /><center><a href="pages.php" class="reports" title="Cycle Through Reports">Raw Data</a></center>
<table align="center" width="50%%">
<?php

$datfile = "visitor.log";
$pageCnt = array();

$fh = fopen($datfile, 'r') or die("Couldn't open proper file");
while(!feof($fh)) {
    $line = fgets($fh);
    $filemessage = explode("|", $line);
    $ip = $filemessage[1];
	if($ip != "66.242.122.236") {
    	$webpage = $filemessage[6];
    	$pageCnt[$webpage]++;
	}
}
arsort($pageCnt);
foreach($pageCnt as $page => $visits) {
	if($page) {
		echo "<tr><td align=\"left\">" . $page . "</td><td align=\"right\">" . $visits . "</td></tr>";
		$total = $total + $visits;
	}
}

fclose($fh);

echo "<tr><td align=\"left\">&nbsp;</td><td align=\"right\">&nbsp;</td></tr>";
echo "<tr><td align=\"left\"><b>Total</b></td><td align=\"right\"><b>" . $total . "</b></td></tr></table>";

?>


</td>
</tr></table>

</body>
</html>
