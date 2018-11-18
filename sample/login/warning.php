<?php
session_start();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Invalid Login Attempt</title>
  	
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />	
	<link rel="icon" type="image/png" href="images/stop.png" />
	<link rel="stylesheet" type="text/css" id="stylesheet" href="css/main.css" />

<style type="text/css">
div#header{
top: 0;
left: 0;
width: 100%;
height: 3cm;
}
@media screen{
	body>div#header{
	position: fixed;
	}
}
* html div#content{
    height: 100%;
    overflow: auto;
}
</style>

</head>
<body bgcolor="#FFFFFF" text="#000000" topmargin="0">
<table height="120" width="100%" border="0"><tr><td></td></tr></table>
<center>
<div class="displayBlk">
<br />
<center><a href="index.php" class="formtext">Secured Page Login Example</a></center>
<br />
<center><a href="index.php" class="formtext"><font color="#FF0000">Warning Page</font></a></center>
<br />
<center><a href="index.php" class="formtext">Invalid Login Attempt</a></center>
<br />
<center><a href="login.php" class="emlink">You Must Login</a></center>
<br />
</div>
</center>
</body>
</html>
