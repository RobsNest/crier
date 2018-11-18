<?php
session_start();

include("includes/poll.inc.php");

date_default_timezone_set('America/New_York');
$today = date('l F jS Y');
$visitorIp = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
$webpage = "Poll Votes";
include("../includes/logit.inc.php");
writeLog($visitorIP, $webpage);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Poll Votes - <?php echo $today?></title>

<link rel="icon" type="image/png" href="../images/crier.png" />
<link rel="stylesheet" type="text/css" id="stylesheet" href="../css/main.css" />

<style>
* {
    box-sizing: border-box;
}

/* Create two unequal columns that floats next to each other */
.column {
    float: left;
    padding: 3px;
}

.left {
  width: 90%;
}

.right {
  width: 10%;
  align: right;
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}
</style>
</head>
<body bgcolor="#FFFFFF" text="#000000" topmargin="0">
<center><a href="pollqueue.php" class="tandt">Poll Votes</a></center>

<center>
<div class="pollquestion">
<br />
<center>Results So Far</center>

<?php
$pollCnt = LoadArray();
$total = 0;
foreach($pollCnt as $option => $votes) {
    if(strlen($option) > 1) {
	    echo "<div class=\"row\"><div class=\"column left\"><b>" . $option . "</div><div class=\"column right\">" . $votes . "</b></div></div>";
		$total += $votes;
    }
}
echo "<hr /><div class=\"row\"><div class=\"column left\"><b>Total Votes</div><div class=\"column right\">" . $total . "</b></div></div>";
?>
</div>
</center>
<br />


</body>
</html>
