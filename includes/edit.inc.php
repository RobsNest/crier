<?php

function printAds() {
print <<<MainAds
	<table align="center" width="95%" border="0"><tr align="center" valign="bottom">
	<td align="center" width="25%"></td>
	<td align="center" width="25%">
	<a href="secrets/" target="_blank"><img src="fixed/secrets205x74.png" width="205" height="74" /></a>
	</td>
	<td align="center" width="25%"><a href="rockygap.php" target="_blank" title="Rocky Gap Casino & Resort"><img src="fixed/rockygap.png" alt="Rocky Gap Casino" border="0" width="195" height="60" /></a></td>
	<td align="center" width="25%">
	<a href="ejsteamer.php" title="EJ Steamer Carpet Cleaner"><img src="fixed/ejSteamer195x99.png"alt="Advertise Here" border="0" width="195" height="99" /></a>
	</td>
	</tr></table>

MainAds;
}

function printLinks() {
print <<<LeftLinks
<br /><br />
<a href="classifieds.php" class="pub"><b>&bull;Classified Ads</b></a>
<br /><br />
<a href="gameroom.php" class="pub"><b>&bull;Game Room</b></a>
<br /><br />
<a href="obituaries.php" class="pub"><b>&bull;Obituaries</b></a>
<br /><br />
<a href="trooper5.php" class="pub"><b>&bull;Trooper 5</b></a>
<br /><br />
<a href="national.php" class="pub"><b>&bull;Weather</b></a>
LeftLinks;
}

function printIntro() {
print <<<TopIntro
&nbsp;&nbsp;&nbsp;&nbsp;<b>News, Weather and Topics of Interest</b> for the people of Cumberland Maryland and the surrounding region.  Your <i>FREE</i> hometown newspaper.<br />
TopIntro;
}

?>
