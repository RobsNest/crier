<?php
session_start();

$futureDate = date('Y-m-d', strtotime('+27 days'));
$today = date('Y-m-d');
$fileToRead = "visitor.log";

$infile = fopen($fileToRead, "r") or die("Unable to open input file!");
$data = fread($infile, filesize($fileToRead));
fclose($infile);
#$data = str_replace("\n", "<br />", $data);

$linecount = 0;
$handle = fopen($fileToRead, "r");
while(!feof($handle)){
  $line = fgets($handle);
  $linecount++;
}

fclose($handle);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />	
	<link rel="stylesheet" type="text/css" id="stylesheet" href="../css/main.css" />


</head>

<body topmargin="0">

<br />
<center><b>Visitors: <?php echo $linecount?></b></center>
<br />
<table align="center"><tr valign="top">
<td align="left">
	<textarea class="forminput" id="notes" name="notes" rows="12" cols="100" ><?php echo $data?></textarea>
</td>
</tr></table>
<script language="JavaScript" type="text/javascript">
<!-- Begin
var textarea = document.getElementById('notes');
textarea.scrollTop = textarea.scrollHeight;
// End -->
</script>

<?php

$datfile = "visitor.log";
$pageCnt = array();

$fh = fopen($datfile, 'r') or die("Couldn't open proper file");
while(!feof($fh)) {
    $line = fgets($fh);
    $filemessage = explode("|", $line);
    $webpage = $filemessage[6];
    $pageCnt[$webpage]++;
	echo $webpage . " - ";
	echo $pageCnt[$webpage];
	echo "<br />";
}
fclose($fh);

?>

</body>
</html>
