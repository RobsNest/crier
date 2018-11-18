<?php

function test_input($data) {
	$data = trim($data);
	$data = str_replace("'", "", $data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

function get_city() {
	$query = @unserialize(file_get_contents('http://ip-api.com/php/'.$_SERVER['REMOTE_ADDR']));
	if($query && $query['status'] == 'success') {
		$city = $query['city'];
	}else{
		$city = "Not Available";
	}		
	return $city;
}
?>
