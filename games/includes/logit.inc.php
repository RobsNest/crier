<?php

function writeLog($visitorIP, $webpage) {
	$logDate = date('Y-m-d H:i:s');
	$log = '/home/robsdigs/html/priv/visitor.log';
	$fh = fopen($log, 'a') or die('Cannot open file:  '.$log);
	#$query = @unserialize(file_get_contents('http://ip-api.com/php/'.$visitorIP));
	$query = @unserialize(file_get_contents('http://ip-api.com/php/'.$_SERVER['REMOTE_ADDR']));
	if($query && $query['status'] == 'success') {
		$country = $query['countryCode'];
		$city = $query['city'];
		$state = $query['regionName'];
		$isp = $query['isp'];
		$visitorIP = $query['query'];
		$line = "$logDate|$visitorIP|$city|$state|$country|$isp|$webpage\n";
		fwrite($fh, $line);
	}else{
		$line = "$logDate|$visitorIP|$webpage|An error occured! Crapper!\n";
		fwrite($fh, $line);
	}		
	fclose($fh);
}

?>
