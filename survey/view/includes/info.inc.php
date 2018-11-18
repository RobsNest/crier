<?php

function GetCity() {
	$query = @unserialize(file_get_contents('http://ip-api.com/php/'.$_SERVER['REMOTE_ADDR']));
	if($query && $query['status'] == 'success') {
		$city = $query['city'];
	}else{
		$city = "Not Available";
	}		
	return $city;
}

?>
