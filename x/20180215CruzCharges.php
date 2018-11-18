<?php
session_start();

include("includes/edit.inc.php");
include("includes/poll.inc.php");

date_default_timezone_set('America/New_York');
$today = date('l F jS Y');
$visitorIp = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
$webpage = "Cruz Charges";
include("includes/logit.inc.php");
writeLog($visitorIP, $webpage);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Florida Shooting Suspect Facing Seventeen Charges  - The Cumberland Crier - <?php echo $today?></title>
  	
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
<center><b>Suspects Disturbing<br />Social Media Posts</b></center>
<img src="images/articles/nikolas-cruz.jpg" width="210" height="157" />
PARKLAND, Fla. (AP) — The suspect in a deadly rampage at a Florida high school is a troubled teenager who posted disturbing material on social media before the shooting spree that killed at least 17 people, according to a law enforcement official and former schoolmates.
<br /><br />
Broward County Sheriff Scott Israel said the 19-year-old suspect, Nikolas Cruz, had been expelled from Marjory Stoneman Douglas High School for “disciplinary reasons.”
<br /><br />
“I don’t know the specifics,” the sheriff said.
<br /><br />
However, Victoria Olvera, a 17-year-old junior, said Cruz was expelled last school year after a fight with his ex-girlfriend’s new boyfriend. She said Cruz had been abusive to his girlfriend.
<br /><br />
School officials said Cruz was attending another school in Broward County after his expulsion.
<br /><br />
Cruz’s mother Lynda Cruz died of pneumonia on Nov. 1 neighbors, friends and family members said, according to the Sun Sentinel. Cruz and her husband, who died of a heart attack several years ago, adopted Nikolas and his biological brother, Zachary, after the couple moved from Long Island in New York to Broward County.
<br /><br />
The boys were left in the care of a family friend after their mother died, family member Barbara Kumbatovich, of Long Island, said.
<br /><br />
Unhappy there, Nikolas Cruz asked to move in with a friend’s family in northwest Broward. The family agreed and Cruz moved in around Thanksgiving. According to the family’s lawyer, who did not identify them, they knew that Cruz owned the AR-15 but made him keep it locked up in a cabinet. He did have the key, however.
<br /><br />
Jim Lewis said the family is devastated and didn’t see this coming. They are cooperating with authorities, he said.
<br /><br />
Broward County Mayor Beam Furr said during an interview with CNN that the shooter was getting treatment at a mental health clinic for a while, but that he hadn’t been back to the clinic for more than a year.
<br /><br />
“It wasn’t like there wasn’t concern for him,” Furr said.
<br /><br />
“We try to keep our eyes out on those kids who aren’t connected ... Most teachers try to steer them toward some kind of connections. ... In this case, we didn’t find a way to connect with this kid,” Furr said.
<br /><br />
Israel said investigators were dissecting the suspect’s social media posts.
<br /><br />
“And some of the things that have come to mind are very, very disturbing,” he added without elaborating.
<br /><br />
Daniel Huerfano, a student who fled Wednesday’s attack, said he recognized Cruz from an Instagram photo in which Cruz posed with a gun in front of his face. Huerfano recalled Cruz as a shy student and remembered seeing him walking around with his lunch bag.
<br /><br />
“He was that weird kid that you see ... like a loner,” he added.
<br /><br />
Dakota Mutchler, a 17-year-old junior, said he used to be close friends with Cruz but hadn’t seen him in more than a year following his expulsion from school.
<br /><br />
“He started progressively getting a little more weird,” Mutchler said.
<br /><br />
Mutchler recalled Cruz posting on Instagram about killing animals and said he had talked about doing target practice in his backyard with a pellet gun.
<br /><br />
“He started going after one of my friends, threatening her, and I cut him off from there,” Mutchler said.
<br /><br />
“I think everyone had in their minds if anybody was going to do it, it was going to be him,” Mutchler said.
<br /><br />
Broward County School District Superintendent Robert Runcie told reporters on Wednesday afternoon that he did not know of any threats posed by Cruz to the school.
<br /><br />
“Typically you see in these situations that there potentially could have been signs out there,” Runcie said. “I would be speculating at this point if there were, but we didn’t have any warnings. There weren’t any phone calls or threats that we know of that were made.”
<br /><br />
However, a teacher told The Miami Herald that Cruz may have been identified as a potential threat to other students. Jim Gard, a math teacher who said Cruz had been in his class last year, said he believes the school had sent out an email warning teachers that Cruz shouldn’t be allowed on campus with a backpack.
<br /><br />
“There were problems with him last year threatening students, and I guess he was asked to leave campus,” Gard said.
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
<center><b>Cruz Facing<br />Seventeen Charges</b></center>
<img src="images/articles/NikolasCruz210x255.png" width="210" height="255" />
PARKLAND, Fla. (AP) — An orphaned 19-year-old with a troubled past and his own AR-15 rifle was charged with 17 counts of premeditated murder Thursday morning after being questioned for hours by state and federal authorities following the deadliest school shooting in the U.S. in five years.
<br /><br />
Fourteen wounded survivors were hospitalized as bodies were recovered from inside and around Marjory Stoneman Douglas High School.
<br /><br />
Nikolas Cruz, still wearing a hospital gown after being treated for labored breathing, and weighing in at 5-foot-7 and 131 pounds, was ordered held without bond and booked into jail.
<br /><br />
His former classmates thought they were having another drill Wednesday afternoon when a fire alarm sounded, requiring them to file out of their classrooms.
<br /><br />
That’s when police say Cruz, equipped with a gas mask, smoke grenades and multiple magazines of ammunition, opened fire with a semi-automatic weapon, killing 17 people and sending hundreds of students fleeing into the streets.
<br /><br />
It was the nation’s deadliest school shooting since a gunman attacked an elementary school in Newtown, Connecticut, more than five years ago. The overall death toll differs by how such shootings are defined, but Everytown For Gun Safety has tallied 290 school shootings in America since 2013, and this attack makes 18 so far this year.
<br /><br />
President Donald Trump’s reaction focused on Cruz’s mental health.
<br /><br />
“So many signs that the Florida shooter was mentally disturbed, even expelled from school for bad and erratic behavior. Neighbors and classmates knew he was a big problem. Must always report such instances to authorities, again and again!” Trump tweeted Thursday.
<br /><br />
Authorities offered no immediate details about a possible motive, except to say that Cruz had been kicked out of the high school, which has about 3,000 students. Students who knew him described a volatile teenager whose strange behavior had caused others to end friendships with him.
<br /><br />
Cruz’s mother Lynda Cruz died of pneumonia on Nov. 1 neighbors, friends and family members said, according to the Sun Sentinel . Cruz and her husband, who died of a heart attack several years ago, adopted Nikolas and his biological brother, Zachary, after the couple moved from Long Island in New York to Broward County.
<br /><br />
The boys were left in the care of a family friend after their mother died, said family member Barbara Kumbatovich, of Long Island.
<br /><br />
Unhappy there, Nikolas Cruz asked to move in with a friend’s family in northwest Broward. That family agreed and Cruz moved in around Thanksgiving. According to the family’s lawyer, who did not identify them, they knew that Cruz owned the AR-15 but made him keep it locked up in a cabinet. He did have the key, however.
<br /><br />
Attorney Jim Lewis said the family is devastated and didn’t see this coming. They are cooperating with authorities, he said.
<br /><br />
Victoria Olvera, a 17-year-old junior, said Cruz was expelled last school year because he got into a fight with his ex-girlfriend’s new boyfriend. She said he had been abusive to the girl.
<br /><br />
“I think everyone had in their minds if anybody was going to do it, it was going to be him,” she said.
<br /><br />
Cruz was taken into custody without a fight about an hour after the shooting in a residential neighborhood about a mile away. He had multiple magazines of ammunition, authorities said.
<br /><br />
“It’s catastrophic. There really are no words,” said Broward County Sheriff Scott Israel.
<br /><br />
The sheriff said 12 bodies were found inside the building, two others outside and another a short distance away from the school.
<br /><br />
Sen. Bill Nelson told CNN that Cruz had pulled the fire alarm “so the kids would come pouring out of the classrooms into the hall.”
<br /><br />
“And there the carnage began,” said Nelson, who said he was briefed by the FBI.
<br /><br />
Frantic parents rushed to the school to find SWAT team members and ambulances surrounding the huge campus and emergency workers treating the wounded on sidewalks. Students who had taken shelter inside classrooms began leaving in a single-file line with their hands over their heads as officers urged them to evacuate quickly.
<br /><br />
Hearing loud bangs as the shooter fired, many of the students hid under desks or in closets, and barricaded doors.
<br /><br />
“We were in the corner, away from the windows,” said freshman Max Charles, who said he heard five gunshots. “The teacher locked the door and turned off the light. I thought maybe I could die or something.”
<br /><br />
Charles said he passed four dead students and one dead teacher on his way out, and was relieved to finally find his mother.
<br /><br />
“I was happy that I was alive,” Max said. “She was crying when she saw me.”
<br /><br />
Noah Parness, a 17-year-old junior, said he was among students calmly walking to their fire-drill areas outside when he suddenly heard popping sounds.
<br /><br />
“We saw a bunch of teachers running down the stairway, and then everybody shifted and broke into a sprint,” Parness said. “I hopped a fence.”
<br /><br />
The scene was reminiscent of the Newtown attack, which shocked even a country numbed by the regularity of school shootings. The Dec. 14, 2012, assault at Sandy Hook Elementary School killed 26 people: 20 first-graders and six staff members. The 20-year-old gunman, who also fatally shot his mother in her bed, then killed himself.
<br /><br />
Not long after Wednesday’s attack in Florida, Michael Nembhard was sitting in his garage on a cul-de-sac when he saw a young man in a burgundy shirt walking down the street. In an instant, a police cruiser pulled up, and officers jumped out with guns drawn.
<br /><br />
“All I heard was ‘Get on the ground! Get on the ground!’” Nembhard said. He said Cruz did as he was told.
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
