<?php

function get_col() {
	$datfile = "includes/column.dat";
	$fh = fopen($datfile, 'r') or die("Couldn't open $datfile");
	$c = fgets($fh);
	fclose($fh);
	$col = $c;
	$datfile = "includes/column.dat";
	$fh = fopen($datfile, 'w') or die("Couldn't open $datfile");
	if($c == 2) {
		$c = 1;
	}else{
		$c = 2;
	}
	fwrite($fh, $c);
	fclose($fh);

    return $col;
}


function encrypt_decrypt($action, $string, $password) {
	$output = false;

	$encrypt_method = "AES-256-CBC";
    $secret_key = $password;
    $secret_iv = 'This is my secret iv';

    // hash
    $key = hash('sha256', $secret_key);
									     
   	// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
	$iv = substr(hash('sha256', $secret_iv), 0, 16);

	if( $action == 'encrypt' ) {
		$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
		$output = base64_encode($output);
	}else if( $action == 'decrypt' ){
		$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
	}
    return $output;
}

?>
