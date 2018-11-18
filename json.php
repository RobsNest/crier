<?php
session_start();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>JSON Testing</title>
  	
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />	

</head>

<body bgcolor="#FFFFFF" text="#000000">
<!--Google News API Goes Below-->
<?php
$newsJSON = file_get_contents("https://newsapi.org/v2/top-headlines?sources=google-news&apiKey=01ff08fee2714d12964a19a23270209c");

$jsonIterator = new RecursiveIteratorIterator(
    new RecursiveArrayIterator(json_decode($newsJSON, TRUE)),
	    RecursiveIteratorIterator::SELF_FIRST);

foreach ($jsonIterator as $key => $val) {
    if(is_array($val)) {
        #echo "$key:<br />";
    } else {
		if($key == "title") {
			echo "$val<br /><br />";
		}
		if($key == "description") {
			echo "$val<br />";
		}
		if($key == "url") {
			$url = "<a href=\"$val\">Read Article</a>";
			echo "$url<hr>";
		}
        #echo "$key => $val<br />";
    }
}
?>

</body>
</html>
