<?php 
	include('config/db_connect.php');
	$claimID = $temp = $result = $topic = $array = $claim_fk = $IclaimID = $thesisST = $reasonST = $ruleST = $NewOld = $oldClaim = $subject = $targetP = $supportMeans = $supportforID = $supportID = $example = $URL =  $rd = $reason =  $flagType = $flagURL = $flagSource = $flagID = $inferenceIDFlagger= $active = '';
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


?> <center><?php

while($details = $activity->fetch_assoc())
	{
		?> 
<p><b>Claim ID:</b>  <?php echo $details['claimID']; ?> </p>
			<p><b>Support Means:</b>  <?php echo $details['supportMeans']; ?> </p></font>



<?php //------------ ONE
if( $details['supportMeans'] == "Inference")
{ ?>
	<b>Thesis Statement:</b>  <?php echo $details['thesisST']; ?>			<!-- Trigger/Open The Modal -->
<button id="myBtnT">Flag Thesis</button>
<BR><br>
			<b>Reason Statement:</b>  <?php echo $details['reasonST']; ?>
			<button id="myBtnR">Flag Reason</button>
<br><br>
			<b>Rule Statement:</b>  <?php echo $details['ruleST']; ?>
<button id="myBtnE">Flag Rule & Example</button>

<?php } ?>
  

 <?php // ------------- TWO
if( $details['supportMeans'] == "Perception")
{ ?>
	<p><b>Url of perception:</b>  <?php echo $details['URL']; ?> </p>
	<button id="myBtnPerTes">Flag Perception</button>

			
<?php } ?>

   <?php // ------------- THREE
if( $details['supportMeans'] == "Testimony")
{ ?>
	<p><b>Research Document:</b>  <?php echo $details['rd']; ?> </p>
	<p><b>Summary:</b>  <?php echo $details['summary']; ?> </p>
	<button id="myBtnPerTes">Flag Testimony</button>

			
<?php } 




	session_start();
		$_SESSION['varname'] = $details['claimID'];
		$addPage = 'no';
		$_SESSION['addPage'] = $addPage;

$supportMeans = $details['supportMeans'];
	}//end while loop
			} //end isset check
	
	// close connection
//	mysqli_close($conn);

include('config/db_connect.php');
	



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
		// Colorcode *specific* parts of the flag limb. 
		// IF flag = x, y, z, text = ruleflag/red. if flag = u, m, v, text = reasonflag/red. 

?>



</div>

	</div>
	
</head>



<body>


<!-- The Modal -->
<div id="myModalT" class="modal">

  <!-- Modal content -->
  <div class="modal-content">

    <span class="close">&times;</span>
    <center>
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
</form>
</div>
</div>


<!-- The Modal -->
<div id="myModalR" class="modal">

  <!-- Modal content -->
  <div class="modal-content">

    <span class="close">&times;</span>
    <center>
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

<!-- The Modal -->
<div id="myModalE" class="modal">

  <!-- Modal content -->
  <div class="modal-content">

    <span class="close">&times;</span>
    <center>
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
</form>
</div>
</div>
			
 
		
<!-- The Modal -->
<div id="myModalPerTes" class="modal">

  <!-- Modal content -->
  <div class="modal-content">

    <span class="close">&times;</span>
    <center>
<form method="POST" id = "myForm" action="insert.php">

<div id="some-div">
    <img src = "https://i.ibb.co/YfHKPmM/question.png">
  
  <span id="explain-element">  <font = #000000> Either link to a currently unflagged claim or generate a new claim with the identical subject as the flagee statement asserting that this subject either <br>(a) is not known to possess the flagee thesis statement's target property or <br>(b) does not possess the flagee thesis statement's target property. </font>
  </span>
</div>
<html>
<p style="color:#000000";><font = #000000>
<br>What are you flagging it for?<br> </font>
	


	 <?php // ------------- TWO
if( $supportMeans == "Perception")
{ ?>
	
	<br><u>Perception Flags</u><br>
				<select name="flagType">
		  	<option value="" selected>Select...</option>
  			<option value="ContactObject">No contact with object from sense organ</option>
  			<option value="Verbal">Relies on language</option>
  			<option value="Errant">Errant</option>
  			<option value="Ambiguous">Ambiguous</option>
  			</select><br>

<?php } ?>

   <?php // ------------- THREE
if( $supportMeans == "Testimony")
{ ?>

<br><u>Testimony Flags</u><br>
				<select name="flagType">
		  	<option value="" selected>Select...</option>
  			<option value="NoDirect">No direct familiarity</option>
  			<option value="ErrantInfo">Errant information</option>
  			<option value="Uncertain">Uncertain/Ambiguous</option>
  			<option value="AlternativeAgendas">Alternative agendas/motivations</option>
  			<option value="Misstatement">Misstatement</option>
  			</select><br>
			
<?php }  ?>






<?php flagging(); ?>

<div class="center">
				<button id="submit">Submit</button>	
					</div>

</p>
</form>
</div>
</div>
		










			
<script>
// Get the modal
var modal = document.getElementById("myModalT");
var btn = document.getElementById("myBtnT");
var span = document.getElementsByClassName("close")[0];
btn.onclick = function() {
  modal.style.display = "block";
}

span.onclick = function() {
  modal.style.display = "none";
}
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>


<script>
// Get the modal
var modal = document.getElementById("myModalR");
var btn = document.getElementById("myBtnR");
var span = document.getElementsByClassName("close")[0];
btn.onclick = function() {
  modal.style.display = "block";
}

span.onclick = function() {
  modal.style.display = "none";
}
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

<script>
// Get the modal
var modal = document.getElementById("myModalE");
var btn = document.getElementById("myBtnE");
var span = document.getElementsByClassName("close")[0];
btn.onclick = function() {
  modal.style.display = "block";
}

span.onclick = function() {
  modal.style.display = "none";
}
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

<script>
// Get the modal
var modal = document.getElementById("myModalPerTes");
var btn = document.getElementById("myBtn");
var span = document.getElementsByClassName("close")[0];
btn.onclick = function() {
  modal.style.display = "block";
}

span.onclick = function() {
  modal.style.display = "none";
}
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>





<?php function flagging()
{ $claimID = $temp = $result = $topic = $array = $claim_fk = $IclaimID = $thesisST = $reasonST = $ruleST = $NewOld = $oldClaim = $subject = $targetP = $supportMeans = $supportforID = $supportID = $example = $URL =  $rd = $reason =  $flagType = $flagURL = $flagSource = $flagID = $inferenceIDFlagger= $active = '';
?>
<html> <p style="color:#000000";>
<label>Topic</label><br>
        <select name="topic">
        <option value="" selected>Select...</option>
        <option value="Abortion">Abortion</option>
        <option value="Religion">Religion</option>
        <option value="Personhood">Personhood</option>
        <option value="Trans Rights">Trans Rights</option>
        <option value="Immigration">Immigration</option>
        <option value="Gun Control">Gun Control</option>
        </select><br>


<label>Subject</label><br>
			<input type="text" name="subject" value="<?php echo htmlspecialchars($subject) ?>"><br>

			<label>Target Property</label><br>
			<input type="text" name="targetP" value="<?php echo htmlspecialchars($targetP) ?>"> <br>
  			
	

			<label>What is your Support Means?</label><br>
<select name="union" id="union">
<option value="choose">Choose One</option>
<option value="Inference">Inference</option>
<option value="Testimony">Testimony</option>
<option value="Perception">Perception</option>
</select>
<br>

<textarea id="reason" name = "reason" value="<?php echo htmlspecialchars($reason) ?>">Enter Reason Property</textarea><br>
<textarea id="example" name = "example" value="<?php echo htmlspecialchars($example) ?>">Enter Example</textarea><br>
<textarea id="url" name = "URL" value="<?php echo htmlspecialchars($URL) ?>">Enter URL</textarea><br>
<textarea id="rd" name = "rd" value="<?php echo htmlspecialchars($rd) ?>">Enter Speech/Research Document</textarea><br>
<!-- for testimony -->
<textarea id="summary" name = "summary" value="<?php echo htmlspecialchars($summary) ?>">Summary of Argument/Excerpt. Include timestamps for video, if applicable. </textarea><br>


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
        description.style.display = '';
    } else {
        rd.style.display = 'none';
        summary.style.display = 'none';
       
    }

}
</script>
</p>
<?php } // end of flagging function ?>
