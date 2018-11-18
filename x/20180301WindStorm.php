<?php
session_start();

include("includes/edit.inc.php");
include("includes/poll.inc.php");

date_default_timezone_set('America/New_York');
$today = date('l F jS Y');
$visitorIp = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
$webpage = "Wind Storm";
include("includes/logit.inc.php");
writeLog($visitorIP, $webpage);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Severe Wind Storm Warning - The Cumberland Crier - <?php echo $today?></title>
  	
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
<img src="images/articles/toons/WashHands210x239.png" width="210" height="239" />
</div>
<br />

<div class="article">
<center><b>West Virginia Teachers<br />Walkout Over Pay</b></center>
<img src="images/articles/TeacherStrike.png" width="210" height="115" />
CHARLESTON, W.Va. (AP) — West Virginia public school teachers launched a statewide walkout Thursday that canceled classes in all 55 counties, protesting over pay hikes signed by the governor hours earlier that the teachers say don’t go far enough.
<br /><br />
Thousands of teachers and support staff converged at the gold domed Capitol in Charleston on Thursday, seeking to pressure lawmakers who are still considering other proposals for them. It was their first statewide strike since 1990 in West Virginia, where teacher pay ranks 48th in the nation.
<br /><br />
The walkout is scheduled for two days, and teachers say they’re willing to go longer if need be.
<br /><br />
Chants of “Do your job so I can do mine” reverberated throughout the Capitol halls, along with other slogans including “55 strong” — a reference to the state’s 55 counties.
<br /><br />
Gov. Jim Justice on Wednesday night signed a 2 percent raise next year for teachers, followed by 1 percent raises the following two years. But teachers say the increases are too stingy. They also complain about projected increases in health insurance costs.
<br /><br />
“You have all these state employees out here who are furious,” said Melanie Pinkerman, a counselor at Huntington High School and one of those protesting. She held up a protest sign mocking the governor, joined by other demonstrators outside the House of Delegates chambers.
<br /><br />
Justice on Wednesday night signed a 2 percent raise next year for teachers, followed by 1 percent raises the following two years. The average teacher salary in West Virginia is $45,622, well below the national average is $58,353. When the teachers last struck statewide in 1990, their pay ranked 49th in the nation.
<br /><br />
Health insurances costs also remained a big sticking point. The Public Employees Insurance Agency, or PEIA, has agreed to freeze health insurance premiums and rates for the next fiscal year for teachers and other workers. The House passed legislation to transfer $29 million from the rainy day fund to freeze those rates, a move that awaits state Senate action.
<br /><br />
Ted Cheatham, director of that agency, has said that because of medical inflation, about $50 million to $70 million would be needed annually to keep the program functioning as it currently does.
<br /><br />
After a 90-minute debate Thursday, the House also unanimously passed a bill to dedicate the first 20 percent of any general revenue surplus toward a separate fund aimed at stabilizing the Public Employees Insurance Agency, a state entity that administers health care programs for public workers, including teachers.
<br /><br />
Teachers are worried that the solution being proposed is only temporary or worse, especially if the state surplus turns out to be minimal.
<br /><br />
Pinkerman, a single mother with a daughter in college, said she continues to look for jobs in neighboring Ohio and Kentucky, where the pay is better. She said the 4 percent combined raise, which was reduced from a 5 percent overall increase passed by the Senate, “is a huge slap in the face.”
<br /><br />
“College is expensive.There’s always things you have to buy, constantly,” Pinkerman said. “It’s difficult whenever my premium keeps going up. My deductible’s high. It’s just really hard to make it. And I’m not even the worst-case scenario. I only have one child. What about people that have two, three, four, five kids?”
<br /><br />
The teachers’ walkout is expected to continue Friday though many said they are willing to continue striking next week if necessary.
<br /><br />
“If our people tell us to, then that’s what we’ll do,” said Kari Wenck, a fourth-grade teacher at Central City Elementary in Huntington.
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
<center><b>Storm Warning</b></center>
<img src="images/articles/windy.png" width="210" height="129" />
(March 1, 2018) — Marylanders should prepare now for a storm front that is expected to bring rain and possibly damaging winds across much of the state later tonight through Saturday. The National Weather Service is predicting wind gusts of up to 60 miles per hour. The Maryland Emergency Management Agency is actively monitoring this storm and coordinating with state and local partners to ensure readiness.
<br /><br />
“This storm has the potential to knock down trees, cause extended power outages, and cause dangerous debris,” said MEMA Executive Director Russ Strickland. “Make sure to keep devices fully charged in case the power goes out and try to secure any loose objects around your property. If at all possible, do not go out during the height of the storm.”
<br /><br />
Accumulating snow is possible in extreme western Maryland Thursday night into Friday. Other parts of western and central Maryland can expect some frozen precipitation to mix with the rain for part of the storm, but the wind is expected to present the greatest danger. Additionally, tidal flooding is possible along the Chesapeake Bay and Atlantic Ocean on both Friday and Saturday. The National Weather Service is also predicting severe beach erosion for areas of the Eastern Shore and dangerous marine conditions.
<br /><br />
Residents can take the following actions to prepare for high winds and related hazards:
<br /><br />
Check on relatives, neighbors, and friends if possible, especially those who might be seriously affected by a power outage.
<br /><br />
If you must be out during the storm, let family and friends know of your destination, route, and expected arrival time.
<br /><br />
Know how to contact your electric supplier if the power goes out. For a list of power company contacts or to keep track of outages in Maryland, visit mema.maryland.gov.
<br /><br />
If you do not already have one, consider using a car charger to keep devices charged if you lose power for a long time.
<br /><br />
If you use a generator during a power outage, make sure to follow all safety recommendations and never run a generator inside a building or near windows and vents.
<br /><br />
Make sure not to leave pets outside during the storm.
<br /><br />
For more preparedness information, visit mema.maryland.gov or ready.gov.
</div>
<br />

<div class="article">
<center><b>Car Crashes Into House</b></center>
<img src="images/articles/carcrash.png" width="210" height="223" />
Early Sunday morning  at approximately 2:53 AM Deputies of The Allegany County Sheriff's Office responded to the 500 block of National Highway in LaVale for a reported motor vehicle crash into a house.
<br /><br />
Deputies determined that a van, being operated by 50 year old Christopher Morgan of Cumberland was traveling E/B on National Highway at an apparent high rate of speed. The operator lost control of the vehicle and struck a bridge causing significant damage to the vehicle. The vehicle continued out of control and collided into a retaining wall and porch attached to a residence.
<br /><br />
Morgan appeared impaired and was offered field sobriety tests. He then became irate and disorderly during the tests and attempted to resist arrest. 
<br /><br />
Pursuant to the investigation Morgan was subsequently charged with the following:
<br /><br />
Disorderly Conduct<br />
Resisting Arrest<br />
Failing to Obey a Lawful Order<br />
Intoxicated Public Disturbance<br />
DUI<br />
DWI<br />
Negligent Driving<br />
Reckless Driving<br />
Failure to Drive Right of Center<br />
Failing to Display Registration Card<br />
Driving Vehicle in Excess Speed<br />
Failure to Control Speed to Avoid a Collision<br />
Failure to Reduce Speed on Curve<br />
Failure to Reduce Speed in Dangerous Weather<br />
Unsafe Lane Change<br />
Failing to Provide Insurance<br />
Failing to Carry Registration Card<br />
<br /><br />
Morgan was taken before an Allegany County District Court Commissioner and released on his own recognizance
</div>
<br />

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
<center><b>Boone Street Shooting</b></center>
<img src="images/articles/PoliceLights210x112.png" width="210" height="112" />
On Wednesday February 21st at 10:06 PM, the Cumberland Police and the Cumberland Fire Department ambulance responded to the intersection of Boone Street and Oak Street in Cumberland for a reported shooting. When CPD Officers arrived at the scene they discovered a 36 year old male sitting on the porch steps of a private residence on Boone Street, suffering from a gunshot wound. CFD Medics arrived shortly after and began emergency treatment of the victim. The victim was later transported to the Western Maryland Regional Medical Center for further treatment.
<br /><br />
Investigators with the Allegany County Combined Criminal Investigation Unit (C3I) also responded to the scene to assist in the investigation. The scene was processed by Evidence Collection Technicians with the Maryland State Police Crime Lab Forensic Sciences Division.
<br /><br />
Investigators learned that there had been an argument between a male and female that took place out in the street. The victim was in the immediate vicinity during the argument. Sometime during the ensuing altercation, a shotgun the male subject had in his possession discharged, striking the victim. The male and the female then entered a black colored Chevrolet Cavalier and fled the scene together.
<br /><br />
Through interviews of the victim and witnesses, as well as evidence recovered from the scene during the execution of a search warrant, Investigators were able to identify the suspect. An arrest warrant was obtained for 33 year old Cody Michael Fisher, of Cumberland. Fisher is being charged with Attempted Murder, 1st Degree Assault, and numerous firearm related charges.
<br /><br />
Investigators are asking anyone who may have information on the whereabouts of Fisher to contact the Cumberland Police, at 301-777-1600, the C3I Unit, at 301-777-0326, or their local law enforcement agency. If callers wish to remain anonymous, they can call the Allegany/Mineral County Crime Solvers at 301-722-4300, and could become eligible for a reward of up to $1500.00 for information leading to an arrest in this case.
<br /><br />
The investigation is continuing by the Cumberland Police and C3I.
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
02/23/2018<br />
&bull; <br />
<br />

-->

<img src="images/arrestreport/McConnellJosephWilliam.jpg" width="210" height="157" />
McConnell, Joseph William<br />
02/23/2018<br />
&bull; Fugitive From Justice<br />
<br />

<img src="images/arrestreport/HouseBrandonJoseph.jpg" width="210" height="157" />
House, Brandon Joseph<br />
02/23/2018<br />
&bull; CDS: POSSESS-NOT MARIJUANA<br />
&bull; CDS ADMIN EQUIP POSS/DIST<br />
<br />

<img src="images/arrestreport/LarueSethRonald.jpg" width="210" height="157" />
Larue, Seth Ronald<br />
02/23/2018<br />
&bull; Driving on Suspended License<br />
<br />

<img src="images/arrestreport/BuskirkAndrewPatrick.jpg" width="210" height="157" />
Buskirk, Andrew Patrick<br />
02/23/2018<br />
&bull; Theft Less Than $100.00<br />
<br />

<img src="images/arrestreport/KellerTravisSteven.jpg" width="210" height="157" />
Keller, Travis Steven<br />
02/23/2018<br />
&bull; BURGLARY-FIRST DEGREE<br />
<br />

<img src="images/arrestreport/TallmanNathanMichael.jpg" width="210" height="157" />
Tallman, Nathan Michael<br />
02/23/2018<br />
&bull; DISTURB PEACE HINDER PASSG<br />
&bull; DISORDERLY CONDUCT<br />
&bull; FAIL OBEY RENBLE/LAWFL<br />
&bull; CONTRIBUTE TO COND OF CHLD<br />
&bull; (Manipulate),Attempt to Manipulate any Veh. Device with Malicious Intent<br />
<br />

<img src="images/arrestreport/WilliamsBlakeONeal.jpg" width="210" height="157" />
Williams, Blake O'Neal<br />
02/22/2018<br />
&bull; CDS: POSS W/I DIST: NARC<br />
<br />

<img src="images/arrestreport/ScardinaAshleyNicole.jpg" width="210" height="157" />
Scardina, Ashley Nicole<br />
02/21/2018<br />
&bull; THEFT LESS THAN $100.00<br />
&bull; Theft $100.00 to under $1,500.00<br />
&bull; Failure to Appear<br />
<br />

<img src="images/arrestreport/ButlerCharlesOrville.jpg" width="210" height="157" />
Butler, Charles Orville<br />
02/21/2018<br />
&bull; Violation of Probation<br />
&bull; MAL DEST PROP/VALU - $500<br />
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
