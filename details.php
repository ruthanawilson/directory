<?php 
	include('config/db_connect.php');
	$claimID = $temp = $result = $topic = $array = $claim_fk = $IclaimID = $thesisST = $reasonST = $ruleST = $NewOld = $oldClaim = $subject = $targetP = $supportMeans = $supportforID = $supportID = $example = $URL =  $rd = $reason =  $flagType = $flagTypeT = $flagTypeR = $flagTypeE = $flagURL = $flagSource = $flagID = $inferenceIDFlagger= $active = '';
	?> <center><?php include('templates/header.php');
	// check GET request id param
	if(isset($_GET['id'])){
		
		// escape sql chars
		$claimID = mysqli_real_escape_string($conn, $_GET['id']);
		// make sql


?><link rel="stylesheet" href="./style.css"> 
  <link rel="stylesheet" href="./detailsstyle.css"> 

<?php

$act = "SELECT * FROM claimsdb WHERE claimID = ?"; // SQL with parameters
$s = $conn->prepare($act); 
$s->bind_param("i", $claimID);
$s->execute();
$activity = $s->get_result(); // get the mysqli result
} //end isset check
	
	// close connection
//	mysqli_close($conn);
 
include('config/db_connect.php');
	

?> <center><?php

while($details = $activity->fetch_assoc())
	{
session_start();
		$_SESSION['varname'] = $details['claimID'];
		$addPage = 'no';
		$_SESSION['addPage'] = $addPage;
		$topic = $details['topic']; 

		?> 
<p><b>Claim ID:</b>  <?php echo $details['claimID']; ?> </p>
			<p><b>Support Means:</b>  <?php echo $details['supportMeans']; ?> </p></font>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:red;"> (Subject) </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="color:blue;"> (Target Property) </span><br>
  <b>Thesis Statement:</b> <span style="color:red;"> <?php echo $details['subject']; ?> </span> <span style="color:blue;"><?php
  echo $details['targetP']; ?> </span>


<?php //------------ ONE
if( $details['supportMeans'] == "Inference")
{ ?>



<br>
<BR><br>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="color:red;"> (Subject) </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="color:orange;">(Reason Property) </span><br>
      <b>Reason Statement:</b> 
<span style="color:red;"> <?php echo $details['subject']; ?> </span> <span style="color:orange;"><?php
  echo $details['reason']; ?> </span>
      
      <br><br>




      <b>Rule Statement:</b> Whomever/Whatever <span style="color:orange;"> <?php echo $details['reason']; ?> </span> <span style="color:blue;"><?php
  echo $details['targetP']; ?></span>, as in the case of <span style="color:purple;"> <?php echo $details['example']; ?> </span> 

<br><br>

			<!-- Trigger/Open The Modal -->
<button class="openmodal myBtn">Flag Thesis, Reason, or Rule/Example</button>

<!-- The Modal -->
<div class="modal myModal">

<!-- Modal content -->
<div class="modal-content">
<span class="close">&times;</span>
<form method="POST" id = "myForm" action="insert.php">


<html>
<p style="color:#000000";><font = #000000>


<br>Are you flagging the Thesis property, the Reason property, or the Rule and Example property?<br> </font>
  <select name="tre" id="tre" value="tre">
        <option value="" selected>Select...</option>
        <option value="thesis">Thesis</option>
        <option value="reason">Reason</option>
        <option value="rule">Rule</option> </select>


<br>What are you flagging it for?<br>
	<select name="flagTypeT" id="flagTypeT" value="flagType">
		  	<option value="" selected>Select...</option>
  			<option value="thesisRival">Has Rival</option>
  			<option value="TooEarly">Too Early</option>
  			<option value="TooLate">Too Late</option>
        </select>


  <select name="flagTypeR" id="flagTypeR" value="flagType">
        <option value="" selected>Select...</option>
        <option value="reasonUnestablishedSubject">Unestablished Subject</option>
        <option value="reasonItselfUnestablished">Itself Unestablished</option>
        <option value="reasonHostile">Hostile</option>
        </select>

  <select name="flagTypeE" id="flagTypeE" value="flagType">
        <option value="" selected>Select...</option>
        <option value="ruleNarrow">Too Narrow</option>
        <option value="ruleBroadCounterexample">Too Broad (Counterexample)</option>
        <option value="ruleBroadUnestablishedUniversal">Too Broad (Unestabilshed Universal)</option>
       <option value="ruleContri">Contrived Universal</option>
      </select>

  			
<?php flagging(); ?>

<!-- //------------------------- -->

<script type="text/javascript">

var union = document.getElementById('tre');
union.onchange = checkOtherUnion;
union.onchange();

function checkOtherUnion() {
    var union = this;
    var thesis = document.getElementById('flagTypeT');
    var reason = document.getElementById('flagTypeR');
    var example = document.getElementById('flagTypeE');
    if (union.options[union.selectedIndex].value === 'thesis') {
        thesis.style.display = '';
    } else {
        thesis.style.display = 'none';
    }


if (union.options[union.selectedIndex].value === 'reason') {
        reason.style.display = '';
    } else {
        reason.style.display = 'none';
      
    }

if (union.options[union.selectedIndex].value === 'rule') {
        example.style.display = '';
    } else {
        example.style.display = 'none';
       
    }

}
</script>

<!-- //------------------------- -->



<div class="center">
				<button onclick="setTimeout(myFunction, 5000)" id="submit">Submit</button>	
					</div>

</p>
</form></div>
</div>
<!--------------------------------------------------------------------------------------------------------------------------->

<?php }  // end inference check ?>
  <?php

  if( $details['supportMeans'] == "Tarka")
{ ?>


<BR><br><?php
echo'Tarka is an element of conversation used to discuss errors in debate form and communication with moderators.<br><br>'; ?>
      <b>Claim: </b><br>  <?php echo $details['subject']; ?><?php echo " ".$details['targetP']; 

 echo'<br><br><br>Please explain argument in the comments section below.';
}

  // ------------- TWO
if( $details['supportMeans'] == "Perception")
{ ?>
	<p><b>Url of perception:</b>  <?php echo $details['URL']; ?> </p>
	

<button class="openmodal myBtn">Flag Perception</button>

<!-- The Modal -->
<div class="modal myModal">

<!-- Modal content -->
<div class="modal-content">
<span class="close">&times;</span>
<form method="POST" id = "myForm" action="insert.php">


<html>
<p style="color:#000000";><font = #000000>
<br>What are you flagging it for?<br> </font>
	

	<br><u>Perception Flags</u><br>
				<select name="flagType" id="flagType" value="flagType">
		  	<option value="" selected>Select...</option>
  			<option value="NoSenseObjectContact">No Sense-Object Contact</option>
  			<option value="DependsOnWords">Depends on Words</option>
  			<option value="Errant">Errant</option>
  			<option value="Ambiguous">Ambiguous</option>
  			</select><br>

<?php flagging(); ?>

<div class="center">
<button onclick="setTimeout(myFunction, 5000)" id="submit">Submit</button>	
					</div>

</p>
</form>
</div>
</div>


		<!--------------------------------------------------------------------------------------------------------------------------->
	
<?php } // end perception check ?>

   <?php // ------------- THREE
if( $details['supportMeans'] == "Testimony")
{ ?>
  
  	<br><br><p><b>Transcription:</b>  <?php echo $details['transcription']; ?>  <br><br> <p><b>Citation:</b>  <?php echo $details['citation']; ?> </p>
	

<button class="openmodal myBtn">Flag Testimony</button>

<!-- The Modal -->
<div class="modal myModal">

<!-- Modal content -->
<div class="modal-content">
<span class="close">&times;</span>
<form method="POST" id = "myForm" action="insert.php">


<html>
<p style="color:#000000";><font = #000000>
<br>What are you flagging it for?<br> </font>
	
<br><u>Testimony Flags</u><br>
				<select name="flagType" id="flagType" value="flagType">
		  	<option value="" selected>Select...</option>
  			<option value="NoDirectFamiliarity">No direct familiarity</option>
  			<option value="ErrantInfo">Errant information</option>
  			<option value="Ambiguous">Ambiguous</option>
  			<option value="Faithless">Faithless</option>
  			<option value="Misstatement">Misstatement</option>
  			</select><br>

<?php flagging(); ?>

<div class="center">

				<button onclick="setTimeout(myFunction, 5000)" id="submit">Submit</button>	

			<?php 	/* // if submit, then 

		if(empty($supportMeans))
{
	header("Location: ../directory/details.php?id=" . $claimIDFlagged ."?sf=empty");
	exit();
} else {
	header("Location: ../directory/details.php?id=" . $claimIDFlagged ."?sf=success");
} */ 
?> 


					</div>

</p>
</form>
</div>
</div>

			
<?php } // end testimony check 



	}//end while loop
/*
*/
?>

<!DOCTYPE html>
<html>
	<head>
		<script src="script/jquery-1.8.1.min.js" type="text/javascript"></script>
<script src="script/my_script.js" type="text/javascript"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>

// BELOW IS WHERE SUBMIT BUTTON DISABLED HAPPENS
jQuery("#submit").prop('disabled', true);
    var card = document.getElementById("union");
//support means = union
//var toValidate = jQuery('#subject');
//var toValidateP = jQuery('#targetP');
var toValidate = jQuery('#subject, #targetP');

//var toValidate2 = jQuery('#union');
    validTextArea = false;

toValidate.keyup(function () {

    if (jQuery(this).val().length > 0) {
        jQuery(this).data('valid', true);
    } else {
        jQuery(this).data('valid', false);
    }

        toValidate.each(function () {
        if (jQuery(this).data('valid') == true) {
            validTextArea = true;

        } else {
            validTextArea = false;
        }

if (validTextArea == true && validDropDown == true) {
        jQuery("#submit").prop('disabled', false);

    } else {
                 
        jQuery("#submit").prop('disabled', true);
      }

    });


});











//var clientCode = document.querySelector("#clientCode");
//clientCode.addEventListener("change", clientChangeHandler. false);




var toValidate2 = jQuery('#union, #grammar');
    validDropDown = false;


toValidate2.change(function () {


  if (jQuery(this)[0].selectedIndex == 1 || jQuery(this)[0].selectedIndex == 2 || jQuery(this)[0].selectedIndex == 3 || jQuery(this)[0].selectedIndex == 4|| jQuery(this)[0].selectedIndex == 5) {
        jQuery(this).data('valid', true);
    } else {
        jQuery(this).data('valid', false);
    }



        toValidate2.each(function () {
        if (jQuery(this).data('valid') == true) {
            validDropDown = true;
                        
        } else {
            validDropDown = false;
   //           window.alert(jQuery(this)[0].selectedIndex);

        }

if (validTextArea == true && validDropDown == true) {
        jQuery("#submit").prop('disabled', false);

    } else {
                  
        jQuery("#submit").prop('disabled', true);
      }

    });

if (validTextArea == true && validDropDown == true) {
        jQuery("#submit").prop('disabled', false);

    } else {
              
        jQuery("#submit").prop('disabled', true);
      }

});


// above IS WHERE SUBMIT BUTTON DISABLED HAPPENS 

	$(document).ready(function() {
	
$("#submit").click(function(){
  window.alert("Submitted!");
  /*
  if (union.options[union.selectedIndex].value === 'Tarka') {
window.alert("HEY GIRLLLLL!");
$newid = $claimID++; 
window.location.assign("details.php?id=<?php echo $newid ?>");
  } 
  else
  { window.location.assign("ajaxindex.php?topic=<?php echo $topic?>"); }

  */
  
 $.post( $("#myForm").attr("action"), 
         $("#myForm :input").serializeArray(), 
         function(info){ $("#result").html(info); 
  });
clearInput();

		});

	$("#myForm").submit( function() {
  return false;	
});

	function clearInput() {
	$("#myForm :input").each( function() {
	   $(this).val('');

	});
}
});


</script>
<?php
		
?>



</div>

	</div>
	
</head>



<body>

		

<script>
			
var modals = document.getElementsByClassName('modal');
// Get the button that opens the modal
var btns = document.getElementsByClassName("openmodal");
var spans=document.getElementsByClassName("close");
for(let i=0;i<btns.length;i++){
    btns[i].onclick = function() {
        modals[i].style.display = "block";
    }
}
for(let i=0;i<spans.length;i++){
    spans[i].onclick = function() {
        modals[i].style.display = "none";
    }
}

</script>





<?php function flagging()
{ ?> <div class = 'scroll'> <?php $claimID = $temp = $result = $topic = $array = $claim_fk = $IclaimID = $thesisST = $reasonST = $ruleST = $NewOld = $oldClaim = $subject = $targetP = $supportMeans = $supportforID = $supportID = $example = $URL =  $rd = $reason =  $flagType = $flagType = $flagTypeT = $flagTypeR = $flagTypeE = $flagURL = $flagSource = $flagID = $inferenceIDFlagger= $grammar = $active = '';
?>
<html> <p style="color:#000000";>
 <?php global $topic;
 $topic = $topic; ?> 

<label>Topic (Read only)</label><br>
			<input type="text" name="topic" value="<?php echo htmlspecialchars($topic) ?>" readonly><br>


&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label><u>Subject</u>         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   <u>Target Property </u></label><br>
<textarea class="subject" type="text" id="subject" name = "subject" value="<?php echo htmlspecialchars($subject) ?>">Enter Subject</textarea>			
<textarea class="targetP" type="text" id="targetP" name = "targetP" value="<?php echo htmlspecialchars($targetP) ?>">Enter Target Property</textarea>
			<br>

      <u> <p style="color:grey">Thesis Statement </u><br>
<span class="jsValue3">subject</span> <span class="jsValue4">target</span> 
</p></p>


<p style="color:black"> Is the subject an object or a person? 
<select name="grammar" id="grammar" value="grammar">
<option value="">Choose One</option>
<option value="object">Object</option>
<option value="person">Person</option>
</select> <br>
  			
What is your Support Means?
  
<select name="union" id="union" value="union">
<option value="">Choose One</option>
<option value="Inference">Inference</option>
<option value="Testimony">Testimony</option>
<option value="Perception">Perception</option>
<option value="Tarka">Tarka</option>
</select>
</p>






</p>




<div id="hiddenRule"> 

  <div id="some-div">
  <img src = "https://i.imgur.com/o4qSiRD.png">
  <span id="explain-element"> Hint: Your reason statement should answer "Why?". You might think of the reason as what comes after 'because....'.  </span>
  </div>
<p style="color:black"><u>Reason</u><br>
<textarea class="reason" type="text" id="reason" name = "reason" value="<?php echo htmlspecialchars($reason) ?>">Enter Reason Property</textarea>
</p>
  <u> Reason Statement </u><br>
 
 <span class="jsValue5">subject</span>   <span class="jsValue6">reason</span>
<br><br>
<div id="some-div">
  <img src = "https://i.imgur.com/o4qSiRD.png">
  <span id="explain-element"> Hint: The example cannot be the same as the subject.  </span>
  </div>
<u> Rule and Example Statement </u><br>
Whatever/Whomever

 <!-- Plain Javascript Example -->
  <span class="jsValue">reason</span>,
<span class="jsValue2">target</span>,

as in the case of: 
<br>
<textarea id="example" name = "example" value="<?php echo htmlspecialchars($example) ?>">Enter Example</textarea>
  
</div>


<div id="perceptionHint">
    <div id="some-div">
  <img src = "https://i.imgur.com/o4qSiRD.png">
  <span id="explain-element"> Hint: Perception MUST be audio or video.  </span>
  </div>

</div>
<div id="hiddenTranscription">


<u>Transcription</u>

<div id="some-div">
  <img src = "https://i.imgur.com/o4qSiRD.png">
  <span id="explain-element"> Hint: The transcription MUST be a quotation from the source with no additional dialogue.  </span>
  </div>

  </div>
<textarea id="transcription" name = "transcription" value="<?php echo htmlspecialchars($transcription) ?>">Transcription </textarea><br>
<div id="hiddenCitation">
<u>Citation</u>

<div id="some-div">
  <img src = "https://i.imgur.com/o4qSiRD.png">
  <span id="explain-element"> Please include as applicable: author, title, publication, date of publication, and URL. </span>
  </div>
  </div>
  <textarea id="citation" name = "citation" value="<?php echo htmlspecialchars($citation) ?>">Citation</textarea><br>

<div id="hiddenURL">
<u>URL</u>
  </div>
<textarea id="url" name = "url" value="<?php echo htmlspecialchars($url) ?>">Enter URL</textarea><br>

<div id="hiddenTS">
<u>Timestamp of content</u>
  </div>
<textarea id="vidtimestamp" name = "vidtimestamp" value="<?php echo htmlspecialchars($vidtimestamp) ?>">Enter timestamp of specified material</textarea>

<script>


// This is for reason
var $jsReason = document.querySelector('.reason');
var $jsValue = document.querySelector('.jsValue');

$jsReason.addEventListener('input', function(event){
  $jsValue.innerHTML = $jsReason.value;
}, false);


//-------------------------
//This is for Targetp

var $jsTargetP = document.querySelector('.targetP');
var $jsValue2 = document.querySelector('.jsValue2');

$jsTargetP.addEventListener('input', function(event){
  $jsValue2.innerHTML = $jsTargetP.value;
}, false);

//-------------------------
//This is for subject

var $jsSubject = document.querySelector('.subject');
var $jsValue3 = document.querySelector('.jsValue3');

$jsSubject.addEventListener('input', function(event){
  $jsValue3.innerHTML = $jsSubject.value;
}, false);

//-------------------------
//This is for the second target property (4)

var $jsTargetP2 = document.querySelector('.targetP');
var $jsValue4 = document.querySelector('.jsValue4');

$jsTargetP2.addEventListener('input', function(event){
  $jsValue4.innerHTML = $jsTargetP2.value;
}, false);



//-------------------------
//This is for the second subject property (5)
var $jsSubject2 = document.querySelector('.subject');
var $jsValue5 = document.querySelector('.jsValue5');

$jsSubject2.addEventListener('input', function(event){
  $jsValue5.innerHTML = $jsSubject2.value;
}, false);

//-------------------------
//This is for the reason (6)
var $jsReason2 = document.querySelector('.reason');
var $jsValue6 = document.querySelector('.jsValue6');

$jsReason2.addEventListener('input', function(event){
  $jsValue6.innerHTML = $jsReason2.value;
}, false);

</script> 
</div> 
<?php } // end of flagging function ?>

<script type="text/javascript">


var union = document.getElementById('union');
union.onchange = checkOtherUnion;
union.onchange();

function checkOtherUnion() {
    var union = this;
    var reason = document.getElementById('reason');
    var example = document.getElementById('example');
    var url = document.getElementById('url');
 	var rd = document.getElementById('rd');
  var hiddenRule = document.getElementById('hiddenRule');

 var hiddenURL = document.getElementById('hiddenURL');
 var hiddenTS = document.getElementById('hiddenTS');
 var hiddenCitation = document.getElementById('hiddenCitation');
var hiddenTranscription = document.getElementById('hiddenTranscription');
var perceptionHint = document.getElementById('perceptionHint');

        reason.style.display = 'none';
        example.style.display = 'none';
        citation.style.display = 'none';
        url.style.display = 'none';
        vidtimestamp.style.display = 'none';
        transcription.style.display = 'none';
        hiddenRule.style.display = 'none';


        hiddenURL.style.display = 'none';
        hiddenTS.style.display = 'none';
        hiddenCitation.style.display = 'none';
        hiddenTranscription.style.display = 'none';
        perceptionHint.style.display = 'none';

    if (union.options[union.selectedIndex].value === '') {
        citation.style.display = 'none';
    }
    if (union.options[union.selectedIndex].value === 'Inference') {
        reason.style.display = '';
        example.style.display = '';
        hiddenRule.style.display = '';
        citation.style.display = 'none';
    }


if (union.options[union.selectedIndex].value === 'Perception') {
        perceptionHint.style.display = '';
        url.style.display = '';
        vidtimestamp.style.display = '';
        citation.style.display = '';
        hiddenURL.style.display = '';
        hiddenTS.style.display = '';
        hiddenCitation.style.display = '';
    }

if (union.options[union.selectedIndex].value === 'Testimony') {
        transcription.style.display = '';
        citation.style.display = '';
        hiddenCitation.style.display = '';
        hiddenTranscription.style.display = '';
    } 
    
if (union.options[union.selectedIndex].value === 'Tarka') {
        window.alert("A requirement of Tarka is to use the comments feature in the Tarka claim following submission.");
         citation.style.display = 'none';
    } 

}



</script>


 <!-- 
     <div id="hyvor-talk-view"></div>
<script type="text/javascript">
    var HYVOR_TALK_WEBSITE = 3313; // DO NOT CHANGE THIS
    var HYVOR_TALK_CONFIG = {
        url: false,
        id: false
    };
</script>
<script async type="text/javascript" src="//talk.hyvor.com/web-api/embed"></script>

--> 


<!--
<div class="x">
<div id="disqus_thread"></div>
<script>
    /**
    *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
    *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
    
    var disqus_config = function () {
    this.page.url = document.write(window.location.href);  // Replace PAGE_URL with your page's canonical URL variable
    this.page.identifier = document.write(window.location.href); // Replace PAGE_IDENTIFIER with your page's unique identifier variable
    };
    
    (function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = 'https://vadaproject.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
 </div>

-->
<br>