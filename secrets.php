<?php
session_start();

$visitorIp = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
$webpage = "Secrets";
include("includes/logit.inc.php");
writeLog($visitorIP, $webpage);

header("Location: https://www.cumberlandcrier.com/secrets");
?>
