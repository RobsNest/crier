<?php
session_start();

include("includes/edit.inc.php");
include("includes/poll.inc.php");

date_default_timezone_set('America/New_York');
$today = date('l F jS Y');
$visitorIp = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
$webpage = "Police Corruption";
include("includes/logit.inc.php");
writeLog($visitorIP, $webpage);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Jury deliberation begins in Baltimore Police Corruption Trial - The Cumberland Crier - <?php echo $today?></title>
  	
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
<center><a href="scanner.php" title="Allegany County Emergency Scanner - Beta"><img src="images/BoraRonnoc.png" alt="Trebor" border="0" width="90" height="135" /></a><br />
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
<img src="images/articles/toons/doingItWrong.jpg" width="210" height="278" />
</div>
<br />

<div class="article">
<center><b>Baltimore Police<br />Corruption Trial</b></center>
<img src="images/articles/BaltimorePolice.jpg" width="210" height="77" />
BALTIMORE (AP) — Jurors started deliberating Thursday in a case involving one of the worst U.S. police corruption scandals in recent memory after hearing nearly three weeks of testimony from drug dealers, a crooked bail bondsman and disgraced Baltimore detectives who detailed astonishing levels of police misconduct.
<br /><br />
The two detectives on trial face robbery, extortion and racketeering charges that could land them up to life in prison if convicted. The trial in a federal courthouse has been dominated by testimony of four ex-detectives who worked alongside the defendants in an elite unit known as the Gun Trace Task Force.
<br /><br />
Those former detectives pleaded guilty to corruption charges about their time on the squad, which was once praised as a group of hard-charging officers chipping away at the tide of illegal guns on city streets. They testified on behalf of the government in the hopes of shaving years off their prison sentences.
<br /><br />
The former law enforcers testified that the unit was actually made up of thugs with badges who broke into homes, stole cash, resold looted narcotics and lied under oath to cover their tracks. Wearing lockup jumpsuits, the ex-detectives admitted to everything from armed home invasions to staging fictitious crime scenes and routinely defrauding their department with bogus overtime claims.
<br /><br />
Assistant U.S. Attorney Leo Wise described the two detectives on trial as “hunters” who “preyed upon the weak and the vulnerable” when their rogue police unit wasn’t scouring the city trying to find large-scale drug dealers to rob. He said the evidence, which included calls recorded by the FBI that captured their voices, was “overwhelming.”
<br /><br />
Defense attorney Jenifer Wicks delivered a fiery closing argument on behalf of Detective Marcus Taylor. She told jurors the government went to the “depths of the criminal underworld” to find a parade of “professional liars” as witnesses.
<br /><br />
“It’s deplorable and it’s nauseating,” Wicks said, asserting there was insufficient evidence to convict Taylor of anything.
<br /><br />
In a rebuttal, Wise said investigators did indeed tour the unsavory depths of Baltimore’s underworld - and it was there they found Taylor and Detective Daniel Hersl.
<br /><br />
Hersl’s lead attorney, William Purpura, did not deny that his 48-year-old client took money — an act that “embarrassed” the city and the detective’s family — but that didn’t rise to charges of robbery or extortion.
<br /><br />
He attacked the veracity of the four disgraced detectives, noting that they’ve admitted to lying for years to juries, judges, colleagues and their families.
<br /><br />
“They want that ‘get out of jail free’ card,” Purpura said during his closing arguments.
<br /><br />
The detectives on trial did not testify.
<br /><br />
The out-of-control unit’s onetime supervisor, Sgt. Wayne Jenkins, also did not testify. Jenkins was portrayed as a wildly corrupt officer leading his unit on a tireless quest to shake down citizens and locate “monsters” - bigtime drug dealers with lots of loot to rob.
<br /><br />
His subordinates testified that he occasionally posed as a federal agent, encouraged his officers to keep BB guns to plant as weapons, and kept duffel bags in his police car with grappling hooks, ski masks even a machete to ramp up their illegal activities.
<br /><br />
In mid-November, a Philadelphia police officer became the ninth law enforcement agent indicted in the federal investigation. Prosecutors allege he conspired with task force member Jemell Rayam to sell heroin and cocaine seized in Baltimore.
<br /><br />
It’s not clear when the ex-detectives who pleaded guilty will be sentenced by a federal judge.
<br /><br />
The ongoing federal investigation speaks to a dark side of police authority in Baltimore at a delicate time for the beleaguered department.
<br /><br />
A monitoring team is overseeing court-ordered reforms as part of a federal consent decree reached between Baltimore and the U.S. Justice Department due to discriminatory and unconstitutional policing. The mid-Atlantic city is also fresh off a new annual per-capita homicide record as the starkly divided city had 343 killings in 2017, roughly 56 killings per 100,000 people.
<br /><br />
Even public defenders, who routinely question police testimony, were shocked by the sordid revelations exposed at the trial, saying there could be a few thousand tainted cases stretching back to 2008. So far, roughly 125 cases involving the eight indicted Baltimore law enforcers have been dropped.
<br /><br />
“This was an ongoing criminal enterprise for many years,” said Debbie Katz Levi, head of special litigation for Baltimore’s Office of the Public Defender. “We don’t believe that that this was merely a rogue unit, but rather a symbol of a flawed culture in need of serious reform.”
<br /><br />
The jury asked two questions Thursday but did not reach a decision. They will return Monday.
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
<center><b>Armed Robbery<br />in Wiley Ford</b></center>
<img src="images/articles/PoliceLights210x112.png" width="210" height="112" />
WILEY FORD, W.Va. — Police were searching late Thursday for the man who robbed Press Auto Mart on state Route 28 at gunpoint.
<br /><br />
An unknown amount of money was taken.
<br /><br />
The incident was reported about 8:50 p.m., and officers from the Cumberland Police Department were first at the scene, securing it until the arrival of West Virginia authorities.
<br /><br />
In scanner broadcasts, police said the suspect was wearing a dark hoodie, blue jeans and a solid-colored dark wrap over his face.
<br /><br />
The suspect reportedly fled south on Route 28 in a dark-colored sedan.
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

<a href="chat.php"><img src="images/roaming/chatroombetatest210x174.png" width="210" height="174" /></a>
<br /><br />

<div class="article">
<center><b>Arrest Report</b></center>
<!--  6yy will do it
<img src="images/arrestreport/" width="210" height="157" />
<br />
01/30/2018<br />
&bull; <br />
<br />

-->

<img src="images/arrestreport/TrinksDwayneHenry.jpg" width="210" height="157" />
Trinks Jr, Dwayne Henry<br />
01/30/2018<br />
&bull; 	Probation Violation x 2<br />
<br />

<img src="images/arrestreport/FugateBrentEric.jpg" width="210" height="157" />
Fugate, Brent Eric<br />
01/30/2018<br />
&bull; VIOLATE EXPARTE/PROT ORDER<br />
&bull; THEFT: LESS $1,000 Value<br />
&bull; ASSAULT-SEC DEGREE<br />
<br />

<img src="images/arrestreport/WilliamsChristopherDon.jpg" width="210" height="157" />
Williams, Christopher Don<br />
01/30/2018<br />
&bull; THEFT LESS THAN $100.00<br />
<br />

<img src="images/arrestreport/MayhewGeorgeEdward.jpg" width="210" height="157" />
Mayhew II, George Edward<br />
01/30/2018<br />
&bull; THEFT: LESS $1,000 Value<br />
<br />

<img src="images/arrestreport/GrapesShannonNicole.jpg" width="210" height="157" />
Grapes, Shannon Nicole<br />
01/30/2018<br />
&bull; Violation probation<br />
<br />

<img src="images/arrestreport/ThomasMatthewRyan.jpg" width="210" height="157" />
Thomas, Matthew Ryan<br />
01/30/2018<br />
&bull; Violation Protective order<br />
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
