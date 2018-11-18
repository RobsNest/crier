<?php
session_start();

$visitorIp = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
$webpage = "ESA K9 Registration";
include("includes/logit.inc.php");
writeLog($visitorIP, $webpage);

header("Location: http://esak9registration.org/");
?>
