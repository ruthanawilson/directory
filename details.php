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



<?php //------------ ONE
if( $details['supportMeans'] == "Inference")
{ ?>



	<b>Thesis Statement:</b>  <?php echo $details['thesisST']; ?>	

<BR><br>
      <b>Reason Statement:</b>  <?php echo $details['reasonST']; ?>
      
      <br><br>
      <b>Rule Statement:</b>  <?php echo $details['ruleST']; ?>
<br><br>

			<!-- Trigger/Open The Modal -->
<button class="openmodal myBtn">Flag Thesis, Reason, or Rule/Example</button>

<!-- The Modal -->
<div class="modal myModal">

<!-- Modal content -->
<div class="modal-content">
<span class="close">&times;</span>
<form method="POST" id = "myForm" action="insert.php">

<div id="some-div">
    <img src = "https://i.ibb.co/YfHKPmM/question.png">
  
  <span id="explain-element">  <font = #000000> Either link to a currently unflagged claim or generate a new claim with the identical subject as the flagee statement asserting that this subject either <br>(a) is not known to possess the flagee thesis statement's target property or <br>(b) does not possess the flagee thesis statement's target property. </font>
  </span>
</div>
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
        <option value="ruleBroad">Too Broad</option>
        <option value="ruleUnestablishedUniversal">Unestablished Universal</option>
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
				<button id="submit">Submit</button>	
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

 echo'<br><br><br>Please explain argument in the Facebook comments section below.';
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

<div id="some-div">
    <img src = "https://i.ibb.co/YfHKPmM/question.png">
  
  <span id="explain-element">  <font = #000000>   <span id="explain-element"> <?php echo '<span style="color:red;"> Either link to a currently unflagged claim or generate a new claim with the identical subject as the flagee statement asserting that this subject either <br>(a) is not known to possess the flagee thesis statements target property or <br>(b) does not possess the flagee thesis statements target property.</span>';?> </font>
  </span>
</div>
<html>
<p style="color:#000000";><font = #000000>
<br>What are you flagging it for?<br> </font>
	

	<br><u>Perception Flags</u><br>
				<select name="flagType" id="flagType" value="flagType">
		  	<option value="" selected>Select...</option>
  			<option value="ContactObject">No contact with object from sense organ</option>
  			<option value="Verbal">Relies on language</option>
  			<option value="Errant">Errant</option>
  			<option value="Ambiguous">Ambiguous</option>
  			</select><br>

<?php flagging(); ?>

<div class="center">
				<button id="submit">Submit</button>	
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
<p><b>Research Document:</b> <a href="<?php echo $details['rd']; ?>"> <?php echo $details['rd']; ?> </a> </p>
  
  	<p><b>Summary:</b>  <?php echo $details['summary']; ?> </p>
	

<button class="openmodal myBtn">Flag Testimony</button>

<!-- The Modal -->
<div class="modal myModal">

<!-- Modal content -->
<div class="modal-content">
<span class="close">&times;</span>
<form method="POST" id = "myForm" action="insert.php">

<div id="some-div">
    <img src = "https://i.ibb.co/YfHKPmM/question.png">
  
  <span id="explain-element">    <span id="explain-element"> <?php echo '<span style="color:red;"> Either link to a currently unflagged claim or generate a new claim with the identical subject as the flagee statement asserting that this subject either <br>(a) is not known to possess the flagee thesis statements target property or <br>(b) does not possess the flagee thesis statements target property.</span>';?>
  </span>
</div>
<html>
<p style="color:#000000";><font = #000000>
<br>What are you flagging it for?<br> </font>
	
<br><u>Testimony Flags</u><br>
				<select name="flagType" id="flagType" value="flagType">
		  	<option value="" selected>Select...</option>
  			<option value="NoDirectFamiliarity">No direct familiarity</option>
  			<option value="ErrantInfo">Errant information</option>
  			<option value="Uncertain">Uncertain/Ambiguous</option>
  			<option value="AlternativeAgendas">Alternative agendas/motivations</option>
  			<option value="Misstatement">Misstatement</option>
  			</select><br>

<?php flagging(); ?>

<div class="center">

				<button id="submit">Submit</button>	

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
var toValidate = jQuery('#subject, #targetp');

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




var toValidate2 = jQuery('#union');
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





/*



PHIL 4460: Applied Study of Indian Theories of Knowledge and Debate
In this Major Themes course, students will gain familiarity with contemporary social epistemological crises identified in mainstream western philosophy, with structural forms of epistemic injustice identified in feminist philosophy and critical race theory, and with classical Indian theories of knowledge and debate. In their final paper projects, students will apply or assess applications of classical Indian theories of knowledge and debate either to these contemporary epistemological problems or to contemporary or classical philosophical problems of their choosing. 

*/

/*
var selectElem = document.getElementById('select')
var pElem = document.getElementById('p')

// When a new <option> is selected
selectElem.addEventListener('change', function() {
  var index = selectElem.selectedIndex;
  // Add that data to the <p>
  pElem.innerHTML = 'selectedIndex: ' + index;
})
*/


/*
    if (jQuery(this).val().selectedIndex == 1 || jQuery(this).val().selectedIndex == 2 || jQuery(this).val().selectedIndex == 3 || jQuery(this).val().selectedIndex == 4) {
        jQuery(this).data('valid', true);
    } else {
        jQuery(this).data('valid', false);
    } */

/*if(card.selectedIndex == 0) {
valid = false;
}
else
{valid = true; 
}*/





  


    /*

    if (valid === true) {
        jQuery("#submit").prop('disabled', false);
    } else {
        jQuery("#submit").prop('disabled', true);
    } */








    

/*





var ddl = document.getElementById("cardtype");
 var selectedValue = ddl.options[ddl.selectedIndex].value;
    if (selectedValue == "selectcard")
   {
    alert("Please select a card type");
   }
   */
// above IS WHERE SUBMIT BUTTON DISABLED HAPPENS 

	$(document).ready(function() {
	
$("#submit").click(function(){
  window.alert("Submitted!");
window.location.assign("ajaxindex.php?topic=<?php echo $topic?>");

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
		// Colorcode *specific* parts of the flag limb. -IF flag = x, y, z, text = ruleflag/red. if flag = u, m, v, text = reasonflag/red. 

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
{ $claimID = $temp = $result = $topic = $array = $claim_fk = $IclaimID = $thesisST = $reasonST = $ruleST = $NewOld = $oldClaim = $subject = $targetP = $supportMeans = $supportforID = $supportID = $example = $URL =  $rd = $reason =  $flagType = $flagType = $flagTypeT = $flagTypeR = $flagTypeE = $flagURL = $flagSource = $flagID = $inferenceIDFlagger= $grammar = $active = '';
?>
<html> <p style="color:#000000";>
 <?php global $topic;
 $topic = $topic; ?> 

<label>Topic (Read only)</label><br>
			<input type="text" name="topic" value="<?php echo htmlspecialchars($topic) ?>" readonly><br>


<label>Subject</label><br>
			<input type="text" name="subject" id="subject" value="<?php echo htmlspecialchars($subject) ?>"><br>

			<label>Target Property</label><br>
			<input type="text" name="targetP" id="targetP" value="<?php echo htmlspecialchars($targetP) ?>"> <br>

<label> Is the subject an object or a person? </label><br>
<select name="grammar" id="grammar" value="grammar">
<option value="">Choose One</option>
<option value="object">Object</option>
<option value="person">Person</option>
</select> <br>
  			
	<label>What is your Support Means?</label><br>

<!--
  <div class="dropdown">
  <button onclick="myFunction()" class="dropbtn">Dropdown</button>
  <div id="union" name="union" value = "union" class="dropdown-content" selectBoxOptions="Canada;Denmark;Finland;Germany;Mexico">>
  </div>
</div> -->
<select name="union" id="union" value="union">
<option value="">Choose One</option>
<option value="Inference">Inference</option>
<option value="Testimony">Testimony</option>
<option value="Perception">Perception</option>
<option value="Tarka">Tarka</option>
</select>
<br>
<textarea id="reason" name = "reason" value="<?php echo htmlspecialchars($reason) ?>">Enter Reason Property</textarea><br>
<textarea id="example" name = "example" value="<?php echo htmlspecialchars($example) ?>">Enter Example</textarea><br>
<textarea id="url" name = "URL" value="<?php echo htmlspecialchars($URL) ?>">Enter URL</textarea><br>
<textarea id="rd" name = "rd" value="<?php echo htmlspecialchars($rd) ?>">Enter Speech/Research Document</textarea><br>
<!-- for testimony -->
<textarea id="summary" name = "summary" value="<?php echo htmlspecialchars($summary) ?>">Summary of Argument/Excerpt. Include timestamps for video, if applicable. </textarea><br>


</p>
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
    if (union.options[union.selectedIndex].value === 'Inference') {
        reason.style.display = '';
        example.style.display = '';
    } else {
        reason.style.display = 'none';
        example.style.display = 'none';
    }


if (union.options[union.selectedIndex].value === 'Perception') {
        url.style.display = '';
    } else {
        url.style.display = 'none';
      
    }

if (union.options[union.selectedIndex].value === 'Testimony') {
        rd.style.display = '';
        summary.style.display = '';
    } else {
        rd.style.display = 'none';
        summary.style.display = 'none';
       
    }
if (union.options[union.selectedIndex].value === 'Tarka') {
        window.alert("A requirement of Tarka is to use the Facebook comments feature in the Tarka claim following submission.");
    } else {
       
    }

}
</script>
<?