<?php

?>

<!DOCTYPE html>
<html>
<head>

<style type="text/css">
.slideshow { height: 300px; width: 225px; margin: auto }
.slideshow img { padding: 5px; border: 0px solid #ccc; background-image: url("../crier/images/paper.jpg"); box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); }
</style>

<!-- include jQuery library -->
<script type="text/javascript" src="js/jquery.min.js"></script>

<!-- include Cycle plugin -->
<script type="text/javascript" src="js/jquery.cycle.all.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('.slideshow').cycle({
		fx: 'shuffle' // choose your transition type, ex: fade, scrollUp, shuffle, etc...
	});
});
</script>

</head>
<body>
	<div class="slideshow">
		<img src="images/05.jpg" width="500" height="375" />
		<img src="images/04.jpg" width="500" height="375" />
		<img src="images/03.jpg" width="500" height="375" />
		<img src="images/02.jpg" width="500" height="375" />
		<img src="images/01.jpg" width="500" height="375" />
		<img src="images/00.jpg" width="500" height="375" />
	</div>
</body>
</html>
