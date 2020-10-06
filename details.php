<?php 
	include('config/db_connect.php');
	$claimID = $temp = $result = $topic = $array = $claim_fk = $IclaimID = $thesisST = $reasonST = $ruleST = $NewOld = $oldClaim = $subject = $targetP = $supportMeans = $supportforID = $supportID = $example = $URL =  $rd = $reason =  $flagType = $flagURL = $flagSource = $flagID = $inferenceIDFlagger= $active = '';
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
			<!-- Trigger/Open The Modal -->
<button class="openmodal myBtn">Flag Thesis</button>

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
<br>What are you flagging it for?<br> </font>
	<select name="flagType" >
		  	<option value="" selected>Select...</option>
  			<option value="thesisRival">Thesis - Has Rival</option>
  			<option value="thesisEarly">Thesis - Too Early</option>
  			<option value="thesisLate">Thesis - Late</option>
  			
  			</select><br>
<?php flagging(); ?>

<div class="center">
				<button id="submit">Submit</button>	
					</div>

</p>
</form></div>
</div>
<!--------------------------------------------------------------------------------------------------------------------------->


<BR><br>
			<b>Reason Statement:</b>  <?php echo $details['reasonST']; ?>
			


			<button class="openmodal myBtn">Flag Reason</button>

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
<br>What are you flagging it for?<br> </font>
	<select name="flagType" >
		  	<option value="" selected>Select...</option>
  			<option value="reasonUS">Reason - Unestablished Subject</option>
  			<option value="reasonUI">Reason - Itself Unestablished</option>
  			<option value="reasonHostile">Reason - Hostile</option>
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


<br><br>
			<b>Rule Statement:</b>  <?php echo $details['ruleST']; ?>
<button class="openmodal myBtn">Flag Rule & Example</button>

<!-- The Modal -->
<div class="modal myModal">

<!-- Modal content -->
<div class="modal-content">
<span class="close">&times;</span>
<form method="POST" id = "myForm" action="insert.php">

<div id="some-div">
    <img src = "https://i.ibb.co/YfHKPmM/question.png">
  <p style="color:#000000";><font = #000000>
  <span id="explain-element"> <?php echo '<span style="color:red;"> Either link to a currently unflagged claim or generate a new claim with the identical subject as the flagee statement asserting that this subject either <br>(a) is not known to possess the flagee thesis statements target property or <br>(b) does not possess the flagee thesis statements target property.</span>';?>
  </span>
</div>
<html>

<br>What are you flagging it for?<br> </font>
	<select name="flagType" >
		  	<option value="" selected>Select...</option>
  			<option value="ruleNarrow">Rule - Too Narrow</option>
  			<option value="ruleBroad">Rule - Too Broad</option>
  			<option value="ruleUnest">Rule - Unestablished Universal</option>
  			<option value="ruleContri">Rule - Contrived Universal</option>

  			</select><br>
<?php flagging(); ?>

<div class="center">
				<button id="submit">Submit</button>	
					</div>

</p>
</form></div>
</div>

<!--------------------------------------------------------------------------------------------------------------------------->

<?php }  // end inference check ?>
  

 <?php // ------------- TWO
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
				<select name="flagType">
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
	<p><b>Research Document:</b>  <?php echo $details['rd']; ?> </p>
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
				<select name="flagType">
		  	<option value="" selected>Select...</option>
  			<option value="NoDirect">No direct familiarity</option>
  			<option value="ErrantInfo">Errant information</option>
  			<option value="Uncertain">Uncertain/Ambiguous</option>
  			<option value="AlternativeAgendas">Alternative agendas/motivations</option>
  			<option value="Misstatement">Misstatement</option>
  			</select><br>

<?php flagging(); ?>

<div class="center">
				<button id="submit">Submit</button>	
					</div>

</p>
</form>
</div>
</div>

			
<?php } // end testimony check 



	}//end while loop
			

echo "<BR> hello <BR>";
	$fullURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		if (strpos($fullURL, "sf=empty") == true) {
			echo "ERROR: COULDN'T BE SUBMITTED. YOU DIDN'T CHOOSE A SUPPORT MEANS.";
		}
		elseif (strpos($fullURL, "sf=success") == true) {
			echo "SUCCESSFULLY SUBMITTED!";
		}
		
//		after 'sumbit' but before it reaches post. 
/*if(empty($supportMeans))
{
	header("Location: ../directory/details.php?id=" . $claimIDFlagged ."?sf=empty");
	exit();
} else {
	header("Location: ../directory/details.php?id=" . $claimIDFlagged ."?sf=success");
}*/

?>

<!DOCTYPE html>
<html>
	<head>
		<script src="script/jquery-1.8.1.min.js" type="text/javascript"></script>
<script src="script/my_script.js" type="text/javascript"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>




	$(document).ready(function() {
	
$("#submit").click(function(){


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
{ $claimID = $temp = $result = $topic = $array = $claim_fk = $IclaimID = $thesisST = $reasonST = $ruleST = $NewOld = $oldClaim = $subject = $targetP = $supportMeans = $supportforID = $supportID = $example = $URL =  $rd = $reason =  $flagType = $flagURL = $flagSource = $flagID = $inferenceIDFlagger= $active = '';
?>
<html> <p style="color:#000000";>
 <?php global $topic;
 $topic = $topic; ?> 

<label>Topic (Read only)</label><br>
			<input type="text" name="topic" value="<?php echo htmlspecialchars($topic) ?>" readonly><br>


<label>Subject</label><br>
			<input type="text" name="subject" value="<?php echo htmlspecialchars($subject) ?>"><br>

			<label>Target Property</label><br>
			<input type="text" name="targetP" value="<?php echo htmlspecialchars($targetP) ?>"> <br>
  			
	

			<label>What is your Support Means?</label><br>
<select name="union" id="union">
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

}
</script>
<?