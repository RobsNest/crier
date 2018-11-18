<?php

function LoadArray() {
	$datfile = "../polltally.dat";
	$pollCnt = array();
	$fh = fopen($datfile, 'r') or die("Couldn't open $datfile");
	while(!feof($fh)) {
    	$line = fgets($fh);
    	$fields = explode("|", $line);
    	$option = $fields[0];
    	$cnt = $fields[1];
    	$pollCnt[$option] = $cnt;
	}
	fclose($fh);
	return $pollCnt;
}

function CountVote($vote) {
	$pollCnt = LoadArray();
    foreach($pollCnt as $option => $votes) {
		if($vote == $option) {
			$cnt = $votes + 1;
			$pollCnt[$option] = $cnt;
		}
	}
	$datfile = "polltally.dat";
    $fh = fopen($datfile, 'w') or die("Couldn't open $datfile");
	foreach($pollCnt as $option => $votes) {
		if(strlen($option) > 1) {
			$line = "$option|$votes\n";
			fwrite($fh, $line);
		}   
	}   
	fclose($fh);
}
?>
