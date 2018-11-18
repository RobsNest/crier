<?php
session_start();

include("includes/edit.inc.php");
include("includes/poll.inc.php");

date_default_timezone_set('America/New_York');
$today = date('l F jS Y');
$visitorIp = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
$webpage = "Shooting Suspect";
include("includes/logit.inc.php");
writeLog($visitorIP, $webpage);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Local Law Enforcement Searching For Shooting Suspect - The Cumberland Crier - <?php echo $today?></title>
  	
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />	
	<meta name=”description” content=”News, Weather and Topics of Interest for the people of Cumberland Maryland and the surronding region. Your new hometown newspaper.” />
	<link rel="icon" type="image/png" href="images/crier.png" />
	<link rel="stylesheet" type="text/css" id="stylesheet" href="css/main.css" />

	<script>
    	function textCounter(textarea, countdown, maxlimit) {
        	textareaid = document.getElementById(textarea);
        	if (textareaid.value.length > maxlimit)
          		textareaid.value = textareaid.value.substring(0, maxlimit);
        	else
          		document.getElementById(countdown).value = '('+(maxlimit-textareaid.value.length)+' characters available)';
      	}
   	</script>
   	<style>
   		#plaintextcount { border: 0; color: #000000; background-color: transparent; }
   	</style>

<style type="text/css">
body
{
background-image:url('images/crier.png');
background-attachment:fixed;
background-repeat:no-repeat;
background-position:bottom left;
}
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

<style>
* {
    box-sizing: border-box;
}

/* Create two unequal columns that floats next to each other */
.column {
    float: left;
    padding: 3px;
}

.left {
  width: 90%;
}

.right {
  width: 10%;
  align: right;
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}
</style>

</head>

<body bgcolor="#FFFFFF" text="#000000" topmargin="0" onload="document.theForm.handle.focus()">
<div id="pagetop">
<table align="center" width="93%" border="0"><tr align="center" valign="middle">
<td align="center" width="40%">
<a href="https://www.cumberlandcrier.com" class="titletext">The Cumberland Crier</a>
<br /><br />
<a href="https://www.cumberlandcrier.com" class="tandt"><?php echo $today?>  </a><span class="tandt" id="myclock"></span>
<script type="text/javascript" src="js/clock.js"></script>
</td><td align="left" width="*"><div class="info">
<?php printIntro(); ?>
</div>
</td>
<td align="center" width="135">
<a href="midatlantic.php"><img src="http://images.intellicast.com/WxImages/RadarLoop/shd_None_anim.gif" alt="Mid Atlantic Radar" border="0" width="150" height="97" title="Cumberland Area Weather" /></a></center>
<?php
  $json_string = file_get_contents("http://api.wunderground.com/api/ef6be0c646ab41f3/geolookup/conditions/q/MD/Cumberland.json");
  $parsed_json = json_decode($json_string);
  $temp_f = $parsed_json->{'current_observation'}->{'temp_f'};
  $json_string = file_get_contents("http://api.wunderground.com/api/ef6be0c646ab41f3/forecast/q/MD/Cumberland.json");
  $parsed_json = json_decode($json_string);
  $forecast = $parsed_json->{'forecast'}->{'fctext'};
?>
<a href="national.php" class="tandt" title="Current temperature is <?php echo $temp_f?>&deg; in Cumberland, Md."><?php echo $temp_f?>&deg;</a>
</td></tr></table>
</div>

<br /><br /><br /><br /><br />

<table align="center" width="95%" border="0"><tr align="center" valign="top">
<td align="left" width="25%">
<div class="menuleft">
<center><a href="trebor.php" title="Contact Trebor to talk about promotional opportunities with The Cumberland Crier today."><img src="images/BoraRonnoc.png" alt="Contact Trebor to talk about promotional opportunities with The Cumberland Crier today." border="0" width="90" height="135" /></a><br />
<a href="mailto:trebor@cumberlandcrier.com" class="pub">Trebor Ronnoc; Publisher</a><br />
<a href="mailto:trebor@cumberlandcrier.com" class="pub">trebor@cumberlandcrier.com</a>
<?php printLinks(); ?>
</div>
</td>


<!--********************************************************-->
<!--*                    Column ONE                        *-->
<!--********************************************************-->
<td align="center" width="25%">
<img src="images/smSpacer.png" width="35" height="35" />
<hr width="60%" color="#C0C0C0" />
<!--  6yy will do it
<div class="article">
<center><b></b></center>
<img src="images/articles/" width="210" height="" />
</div>
<br />

-->

<div class="article">
<center><b>Laugh A Little</b></center>
<img src="images/articles/toons/wifitoon.jpg" width="210" height="210" />
</div>
<br />

<div class="article">
<center><b>Trump Supports Stronger<br />Background Checks</b></center>
<img src="images/articles/BackgroundCheck.jpg" width="210" height="140" />
Feb. 19 (UPI) -- The White House said Monday that President Donald Trump is supportive of efforts to help strengthen background checks for gun purchases.
<br /><br />
Trump spoke to Sen. John Cornyn on Friday about the bipartisan bill he and Sen. Chris Murphy introduced to strengthen how state and federal governments report offenses that could prohibit people from buying a gun.
<br /><br />
"While discussions are ongoing and revisions are being considered, the president is supportive of efforts to improve the federal background check system," a statement from the White House said.
<br /><br />
The White House said Trump will take part in a "listening session" Wednesday with high school student and teachers after 17 people were gunned down at Marjory Stoneman Douglas High School in Parkland, Fla.
<br /><br />
A 19-year-old former student is charged with the Valentine's Day slayings. His weapon was an AR-15 assault rifle.
</div>
<br />


<a href="cgandc.php" target="_blank"><img src="images/roaming/cgandcColor195x89.png" width="195" height="89" /></a>
<br /><br />



</td>




<!--********************************************************-->
<!--*                    Column TWO                        *-->
<!--********************************************************-->
<td align="center" width="25%">
<center>
<a href="https://www.facebook.com/criereditor/" title="Follow Us on Facebook" target="_blank"><img src="images/smFacebook.png" alt="Follow Us on Facebook" width="35" height="35" border="0" /></a>
<a href="https://twitter.com/ClandCrier" title="Follow Us on Twitter" target="_blank"><img src="images/smTwitter.png" alt="Follow Us on Twitter" width="35" height="35" border="0" /></a>
<a href="https://plus.google.com" title="Follow Us on Google +" target="_blank"><img src="images/smGplus.png" alt="Follow Us on Google +" width="35" height="35" border="0" /></a>
<a href="https://www.linkedin.com/" title="Follow Us on Linked In" target="_blank"><img src="images/smLinkedIn.png" alt="Follow Us on Linked In" width="35" height="35" border="0" /></a>
</center>
<hr width="60%" color="#C0C0C0" />
<!-- 6yy should do it
<div class="article">
<center><b></b></center>
<img src="images/articles/" width="210" height="" />
</div>
<br />

-->

<div class="article">
<center><b>Shooting Suspect Wanted</b></center>
<img src="images/articles/CodyFisher.jpg" width="210" height="212" />
LOCAL LAW ENFORCEMENT is seeking the whereabouts of Cody Fisher 33 of Cumberland in connection with a shooting that occurred at a South Cumberland residence last evening. Fisher may be traveling in a 2000 black Chevy Cavalier coupe bearing PA registration KJE0784. Fisher is considered armed and dangerous. 
<br /><br />
If you have any information on his location please call the police immediately. 
<br /><br />
Cumberland City Police<br />
301-777-1600<br /><br />
Allegany Co Sheriffs Patrol<br />
301-777-5959<br /><br />
Maryland State Police<br />
301-729-2101
</div>
<br />

<div class="article">
<center><b>Mayor Brian Grim<br />To Seek Another Term</b></center>
<img src="images/articles/briandowntown.jpg" width="210" height="136" />
The decision about whether to seek a third term has been on my mind for the past year and has been a personal and difficult one to make.  While the rigors of the position are stressful and ceaseless, the results of decisions made at City Hall have lasting impacts on the City of Cumberland.  My time in office has been marked by working to solve problems instead of kicking challenges down the road.
<br /><br />
During my tenure, we have restored the city’s bottom line from years of deficits to consistent growth.  The City has remained “in the black,” having ended the temptations of tax anticipation notes.  I believe that the improvements made in the city budget must be sustained and tax rates be reduced as soon as possible, in coordination with tax base growth.
<br /><br />
Economic Development has been a theme, with focus placed on job creation, business investment and tax base growth.  Without tax base growth, residents will continue to be faced with higher tax rates or decreased services.  Increasing the tax base is essential, given that Cumberland is a city of half its former population, but is still supporting double the infrastructure that we need.  I believe that tax base growth through efforts like the Maryland Avenue Redevelopment project are necessary!
<br /><br />
Focus has been placed on blight removal and neighborhood reinvestment with creation of programs such as Neighborhoods Matter.  Eyesores have been removed by demolition or repurposing, such as the former East Side School and the city’s own former Parks and Recreation Warehouse.
<br /><br />
The City paved more streets in my first term than in the previous decade.  We continue paving around the city; from White Avenue and Oldtown Road to Washington Street, Piedmont Avenue and Henderson Avenue, we have reinvested with limited resources, without dramatically increasing city debt.
<br /><br />
Public safety remains a concern as some have called for tax rate cuts and that would require service reductions.  With a high volume of calls annually, I do not believe we are able to shoulder the demand of these services with further personnel reductions.  Our best solution will be greater collaboration with Allegany County to get a better bang for the tax dollar of Cumberland citizens; we pay County taxes too!
<br /><br />
Soon, I will encourage adjustment to the wages of the Mayor and City Council of Cumberland, to encourage candidates to seek the offices and more fairly compensate officials for their time.  I will ask that the current wages, set in 1978 (before I was born), be amended to minimum wage.  This change would not take effect until after the election and swearing-in of officials in 2019.
<br /><br />
My family instilled in me a commitment to community.  I consider serving in elected office as civic service, but I don’t believe that these positions of responsibility are to be taken lightly nor are incumbents entitled to retain them.  I have worked tirelessly to fulfill my responsibilities and remain proud of what has been accomplished in Cumberland in these past few years.
<br /><br />
Despite the challenges of the position and the need for more engagement from the silent majority, my love of Cumberland wins out; I will run for the position of Mayor in 2018 and conduct a campaign based upon accomplishments during my tenure.  I will not make promises that I cannot keep.  Expect the truth from my campaign, no matter how blunt it may be.  I will continue to “Be Bold” in efforts to move the city forward.  Please get involved online at ReElectTheMayor.com.
<br /><br />
Mayor Brian K. Grim
</div>
<br />



<a href="chat.php"><img src="images/roaming/chatroombetatest210x174.png" width="210" height="174" /></a>
<br /><br />

<a href="newad.php"><img src="images/roaming/Roaming195x75.png" width="195" height="75" /></a>
<br /><br />


</td>




<!--********************************************************-->
<!--*                  Column Three                        *-->
<!--********************************************************-->
<td align="center" width="25%">
<img src="images/smSpacer.png" width="35" height="35" />
<hr width="60%" color="#C0C0C0" />
<div class="pollquestion">
If the election for Cumberland Mayor were held today and Brian Grim
decided to seek a third term, for whom would you cast a vote?
<form action="poll.php" name="theVote" method="post" 
enctype="multipart/form-data"  onsubmit="return(validate());">
<input type="hidden" name="action" value="castvote" />
<input type="radio" name="options" value="Lawrence Becker"> <b>Lawrence Becker</b><br>
<input type="radio" name="options" value="Raymond Dye"> <b>Raymond Dye</b><br>
<input type="radio" name="options" value="George Merling"> <b>George Merling</b><br>
<input type="radio" name="options" value="David Smith"> <b>David Smith</b><br>
<input type="radio" name="options" value="Mayor Grim"> <b>Mayor Grim</b><br>
<input type="text" id="phone" name="phone" size="21" maxlength="22" />
<br />
<center><input type="image" src="images/voteOff.png" 
onmouseover="this.src='images/voteOn.png'" 
onmouseout="this.src='images/voteOff.png'" 
value="submit" name="submit" /></center>
</form>
<br />
<center><a href="poll.php" class="pub"><b>View Results</b></a></center>
</div>
<br />


<div class="article">
<center><b>Arrest Report</b></center>
<!--  6yy will do it
<img src="images/arrestreport/" width="210" height="157" />
<br />
02/09/2018<br />
&bull; <br />
<br />

-->

<img src="images/arrestreport/WillisonBealKaylaRachelle.jpg" width="210" height="157" />
Willison-Beal, Kayla Rachelle<br />
02/10/2018<br />
&bull; THEFT LESS THAN $100.00<br />
<br />

<img src="images/arrestreport/RaygorBrianVictor.jpg" width="210" height="157" />
Raygor, Brian Victor<br />
02/10/2018<br />
&bull; BURGLARY/2ND DEGREE/GENERAL<br />
&bull; OBSTRUCTING & HINDERING<br />
&bull; HGV USE/FEL-VIOL CRIME<br />
<br />

<img src="images/arrestreport/McCrayJasonArthur.jpg" width="210" height="157" />
McCray, Jason Arthur<br />
02/10/2018<br />
&bull; CDS: POSS W/I DIST: NARC<br />
&bull; ATTEMPT-CDS POSSESS - LG AMT<br />
&bull; CDS: POSSESS-NOT MARIJUANA<br />
<br />

<img src="images/arrestreport/JohnsonMichaelLee.jpg" width="210" height="157" />
Johnson, Michael Lee<br />
02/10/2018<br />
&bull; Attempt by driver to elude police<br />
&bull; Driving while suspended<br />
<br />

<img src="images/arrestreport/BakerSeanAvery.jpg" width="210" height="157" />
Baker, Sean Avery<br />
02/10/2018<br />
&bull; THEFT LESS THAN $100.00<br />
<br />

<img src="images/arrestreport/BrantScottAnthony.jpg" width="210" height="157" />
Brant, Scott Anthony<br />
02/10/2018<br />
&bull; CDS: POSS W/I DIST: NARC<br />
&bull; CDS: POSSESS-NOT MARIJUANA<br />
&bull; CDS: POSSûMARIJUANA 10 GM+<br />
<br />

<img src="images/arrestreport/BaierJenniferLynn.jpg" width="210" height="157" />
Baier, Jennifer Lynn<br />
02/10/2018<br />
&bull; DISORDERLY CONDUCT<br />
&bull; FAIL OBEY RENBLE/LAWFL<br />
&bull; DISTURB PEACE - LOUD NOISE<br />
&bull; RESIST/INTERFERE WITH ARREST<br />
<br />


</div>
<br />

<a href="greenhealthdocs.php"><img src="images/roaming/GreenHealthDocs195x123.png" width="195" height="123" /></a>
<br /><br />

</td>
</tr></table>

<br /><br /><br /><br /><br />

<div id="bottom">
<?php printAds(); ?>
</div>

</body>
</html>
