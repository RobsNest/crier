<?php
session_start();

include("includes/edit.inc.php");
include("includes/poll.inc.php");

date_default_timezone_set('America/New_York');
$today = date('l F jS Y');
$visitorIp = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
$webpage = "Teacher Strike";
include("includes/logit.inc.php");
writeLog($visitorIP, $webpage);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Deal Reached To End West Virginia Teachers Strike - The Cumberland Crier - <?php echo $today?></title>
  	
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
<img src="images/articles/toons/Instagram210x223.png" width="210" height="223" />
</div>
<br />

<div class="article">
<center><b>Opioid Overdoses<br />Up Thirty Percent</b></center>
<img src="images/articles/OverDose.jpg" width="210" height="144" />
NEW YORK (AP) — Emergency rooms saw a big jump in overdoses from opioids last year — the latest evidence the nation’s drug crisis is getting worse.
<br /><br />
A government report released Tuesday shows overdoses from opioids increased 30 percent late last summer, compared to the same three-month period in 2016. The biggest jumps were in the Midwest and in cities, but increases occurred nationwide.
<br /><br />
The report did not differentiate between prescription pain pills, heroin, fentanyl and other opioids.
<br /><br />
The Centers for Disease Control and Prevention recently started using a new system to track ER overdoses and found the rate of opioid overdoses rose from 14 to 18 per 100,000 ER visits over a year.
<br /><br />
Almost all those overdoses were not fatal. Opioids were involved in two-thirds of all overdose deaths in 2016.
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
<center><b>Deal Reached To End<br />West Virginia Teacher Strike</b></center>
<img src="images/articles/TeacherStrike.jpg" width="210" height="140" />
CHARLESTON, W.Va. (AP) — West Virginia’s striking teachers cheered and applauded Tuesday as lawmakers acted to end a nine-day classroom walkout, agreeing to grant them 5 percent pay hikes that are also being extended to all state workers.
<br /><br />
A huge crowd of teachers packing the Capitol chanted jubilantly, sang John Denver’s “Take Me Home, Country Roads” and some even wept for joy at the settlement. It came on the ninth day of a crippling strike that idled hundreds of thousands of students, forced parents to scramble for child care and cast a spotlight on government dysfunction in one of the poorest states in the country.
<br /><br />
The West Virginia teachers, some of the lowest-paid in the nation, appeared to have strong public backing throughout their walkout.
<br /><br />
“We love our kids!” teachers chanted, hugging one another and cheering.
<br /><br />
“We overcame, we overcame!” said one teacher, Danielle Harris, calling it a victory for students as well. “It shows them how democracy is supposed to work, that you don’t just bow down and lay down for anybody. They go the best lesson that they could ever had even though they were out of school.”
<br /><br />
Teachers walked off the job Feb. 22, balking at a bill signed by Gov. Jim Justice to raise their pay 2 percent in the first year as they also complained about rising health insurance costs. Justice responded last week with an offer to raise teacher pay 5 percent, gaining swift House approval though the Senate countered with 4 percent — a number rejected by the teacher unions, extending their walkout.
<br /><br />
“I believe in you and I love our kids,” Justice told teachers after Tuesday’s agreement on 5 percent was announced. He planned a news conference later Tuesday.
<br /><br />
Several county school systems announced they would be reopening Wednesday. It wasn’t immediately clear whether all 55 county school systems would reopen. A state Department of Education spokeswoman didn’t return an email message.
<br /><br />
Missed school days will be made up, either at the end of the school year or by shortening spring break, depending on decisions by individual counties.
<br /><br />
After a six-member conference committee agreed to the raises, the House of Delegates subsequently passed 5 percent raises for teachers, school service personnel and state troopers on a 99-0 vote. The Senate followed, voting 34-0.
<br /><br />
State teachers haven’t had a salary increase in four years.
<br /><br />
Senate Finance Chairman Craig Blair said to pay for the raises, lawmakers will seek to cut state spending by $20 million, taking funds from general government services and Medicaid. Other state workers who also would get 5 percent raises under the deal will have to wait for a budget bill to pass.
<br /><br />
“The winners in this are the students of West Virginia and the educators across West Virginia who finally see a true investment in education,” West Virginia Education Association President Dale Lee said.
<br /><br />
Senate Majority Leader Ryan Ferns, R-Ohio, said talks with the governor’s office lasted into early Tuesday identifying cuts everyone could agree to.
<br /><br />
“These are deep cuts,” Blair said. “This has been the fiscally responsible thing to do, in my opinion, to get us to the point we’re at today.”
<br /><br />
Justice said additional budget cuts by his staff will fund the raises. Blair said that if the governor’s estimates of increased revenue estimates from Justice come to fruition, supplemental appropriations could take place.
<br /><br />
“This is very positive,” said Tina Workman, a second-grade teacher from Midland Trail Elementary in Kanawha County who has been at the Capitol each day with other striking teachers. “We are surprised, but we aren’t putting all of our eggs from the chickens in one basket. We want it signed, sealed and delivered. Because seven days ago we were told the same thing, and we’re still here.”
<br /><br />
A show of support by thousands of teachers and supporters on Monday didn’t sway lawmakers in time to avoid a ninth day of cancelled classes for the school system’s 277,000 students and 35,000 employees. The Capitol was briefly closed Monday after 5,000 people entered the building, posing security concerns. It was reopened an hour later, and teachers vented their frustration over the lack of progress.
<br /><br />
With 17.9 percent of West Virginians living below official poverty levels, teachers, bus drivers and other volunteers are collecting food for students who rely on free breakfasts and lunches. Teachers also are sharing stories of donating their time, money or food. At least two GoFundMe pages have been launched in support of the walkout.
<br /><br />
Rachel Stringer, a stay-at-home mom from Cross Lanes, said her biggest challenge is making sure her children don’t forget what they’ve learned this school year. Despite the long layoff, Stringer supports the teachers.
<br /><br />
“They deserve to be paid,” she said. “They deserve to be able to have insurance.”
</div>
<br />


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
In light of the recent School shooting in Parkland, Florida; Are you in favor
of passing more Gun Control Legislation?
<form action="poll.php" name="theVote" method="post" 
enctype="multipart/form-data"  onsubmit="return(validate());">
<input type="hidden" name="action" value="castvote" />
<input type="radio" name="options" value="Yes"> <b>Yes</b><br>
<input type="radio" name="options" value="No"> <b>No</b><br>
<input type="radio" name="options" value="Undecided"> <b>Undecided</b><br>
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
03/06/2018<br />
&bull; <br />
<br />

-->

<img src="images/arrestreport/BuppertJordanHope.jpg" width="210" height="157" />
Buppert, Jordan Hope<br />
03/06/2018<br />
&bull; CDS POSS W/INT TO DIST<br />
<br />

<img src="images/arrestreport/BowmanMandyNichole.jpg" width="210" height="157" />
wman, Mandy Nichole<br />
03/06/2018<br />
&bull; VOP<br />
<br />

<img src="images/arrestreport/HainesJustinEdward.jpg" width="210" height="157" />
Haines, Justin Edward<br />
03/06/2018<br />
&bull; VOP<br />
<br />




</div>
<br />

<a href="greenhealthdocs.php"><img src="images/roaming/GreenHealthDocs195x123.png" width="195" height="123" /></a>
<br /><br />

<a href="rgflyby.php"><img src="images/roaming/rgFlyBy210x104.png" width="210" height="104" /></a>
<br /><br />

<a href="chat.php"><img src="images/roaming/chatroombetatest210x174.png" width="210" height="174" /></a>
<br /><br />



</td>
</tr></table>

<br /><br /><br /><br /><br />

<div id="bottom">
<?php printAds(); ?>
</div>

</body>
</html>
