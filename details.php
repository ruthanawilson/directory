<?php 
	include('config/db_connect.php');
	// check GET request id param
	if(isset($_GET['id'])){
		
		// escape sql chars
		$claimID = mysqli_real_escape_string($conn, $_GET['id']);
		// make sql
		$sql = "SELECT * FROM claimsdb WHERE claimID = $claimID";
		// get the query result
		$result = mysqli_query($conn, $sql);
		// fetch result in array format
		$claimsdb = mysqli_fetch_assoc($result);
		mysqli_free_result($result);

		}

	$sql2 = 'SELECT claimIDFlagged, claimIDFlagger, flagType, active FROM flagsdb';
	// get the result set (set of rows)
	$result2 = mysqli_query($conn, $sql2);
	// fetch the resulting rows as an array // was $result
	$flagsdb = mysqli_fetch_all($result2, MYSQLI_ASSOC);



	$sql3 = 'SELECT claimIDFlagged, claimIDFlagger, flagType, active FROM flagsdb';
	// get the result set (set of rows)
	$result3 = mysqli_query($conn, $sql3);
	// fetch the resulting rows as an array // was $result
	$flagsdb2 = mysqli_fetch_all($result3, MYSQLI_ASSOC);

	
	// close connection
//	mysqli_close($conn);
	
?>



<!DOCTYPE html>
<html>
 
	<?php include('templates/header.php'); ?>
<center>
	<div class="container center">

	<?php foreach($flagsdb as $flagsdb): 

		 $color = '';
		 $claimIDFlagged = $flagsdb['claimIDFlagged'];
		 $active = $flagsdb['active'];
		 	if($claimIDFlagged == $claimID && $active == '1')
 { $color = "red"; break;}
else{ $color = "green"; } 
endforeach;  ?>
<font color = "<?php echo $color; ?>">	
			<p><b>Claim ID:</b>  <?php echo $claimsdb['claimID']; ?> </p>
			<p><b>Support Means:</b>  <?php echo $claimsdb['supportMeans']; ?> </p></font>



<?php //------------ ONE
if( $claimsdb['supportMeans'] == "Inference")
{ ?>
	<p><b>Thesis Statement:</b>  <?php echo $claimsdb['thesisST']; ?> </p>
			<p><b>Reason Statement:</b>  <?php echo $claimsdb['reasonST']; ?> </p>
			<p><b>Rule Statement:</b>  <?php echo $claimsdb['ruleST']; ?> </p>
<?php } ?>
  

 <?php // ------------- TWO
if( $claimsdb['supportMeans'] == "Perception")
{ ?>
	<p><b>Url of perception:</b>  <?php echo $claimsdb['URL']; ?> </p>
			
<?php } ?>

   <?php // ------------- THREE
if( $claimsdb['supportMeans'] == "Testimony")
{ ?>
	<p><b>Research Document:</b>  <?php echo $claimsdb['rd']; ?> </p>
	<p><b>Summary:</b>  <?php echo $claimsdb['summary']; ?> </p>
	<p><b>Description:</b>  <?php echo $claimsdb['description']; ?> </p>
			
<?php } 


	$empty = '';
	foreach($flagsdb2 as $flagsdb2):
?> 
<?php
	
		$claimIDFlagged = $flagsdb2['claimIDFlagged'];
		 $active = $flagsdb2['active'];
		 	if($claimIDFlagged == $claimID && $active == '1')
{
?> 

<a href ="details.php?id=<?php echo $flagsdb['claimIDFlagger']?>"><?php echo htmlspecialchars(' Being flagged by: ' . $flagsdb2['claimIDFlagger']); ?> </a> 

<?php	
echo nl2br("\r\n");
echo htmlspecialchars('Type of flag: ' . $flagsdb2['flagType'] ); 
echo nl2br("\r\n");

}

/*						if($inferenceIDFlagger == $inferenceIDFlagged)
	{
	$update = "UPDATE flagsdb SET active='0' WHERE inferenceID='$invar'";
	
if ($conn->query($update) === TRUE) {
    echo "Record updated successfully";
} } */    


		
						if($flagsdb2['claimIDFlagged'] == $claimID)
						{ 
							$empty = "false";

						}
					
	endforeach;
	if($empty = "true")
	{
//		echo "This claim has never been flagged.";
	}

?> 

<center>
	<div class="container center">
		<?php if ($claimsdb): ?>

			<?php $claimIDFlagged = $claimsdb['claimID']; 
		session_start();
			$_SESSION['varname'] = $claimIDFlagged;


?>


</center>

		<?php else: ?>
			<h5>Claim not found.</h5>
		<?php endif ?>


</html>

<?php
	include('config/db_connect.php');
	$claimID = $temp = $result = $topic = $array = $claim_fk = $IclaimID = $thesisST = $reasonST = $ruleST = $NewOld = $oldClaim = $subject = $targetP = $supportMeans = $supportforID = $supportID = $example = $URL =  $rd = $reason =  $flagType = $flagURL = $flagSource = $flagID = $inferenceIDFlagger= $active = '';


$addPage = 'no';
$_SESSION['addPage'] = $addPage;

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



	// display pramana for each flag in db, including condition for supportmeans in claimsdb for the displa

	// testimony- summary of argument/timestamp/excerpt. also, description. 



	// Use UPDATE in mysql to change flag to 'active = 0' when flagged. 

	// flags are clearly explained


?>

		<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
</style>

	<?php include('templates/header.php'); ?>
<br>
<b>Add claim to flag claim number </b>
		<br>	
			<!-- Trigger/Open The Modal -->
<button id="myBtn">Add Claim</button>


</div>

	</div>
	
</head>



<body>


<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">

    <span class="close">&times;</span>
    <center>
<form method="POST" id = "myForm" action="insert.php">
			
 
				<div id="some-div">
    <img src = "https://i.ibb.co/YfHKPmM/question.png">
  
  <span id="explain-element">
   Either link to a currently unflagged claim or generate a new claim with the identical subject as the flagee statement asserting that this subject either <br>(a) is not known to possess the flagee thesis statement's target property or <br>(b) does not possess the flagee thesis statement's target property.
  </span>
</div>

<style>

	body {
  padding: 50px 10px;
  margin: 0 auto;
  max-width: 900px;
}

#explain-element {
  border: 1px solid #ccc;
  display: none;
  font-size: 10px;
  margin-top: 10px;
  padding: 5px;
  text-transform: uppercase;
}

#some-div:hover #explain-element {
  display: block;
}
</style>
<?php //------------ ONE
if( $claimsdb['supportMeans'] == "Inference")
{ ?>
<br><u>Thesis Flags</u><br>
<select name="thesisFlags" >
		  	<option value="" selected>Select...</option>
  			<option value="thesisRival">Has Rival</option>
  			<option value="thesisEarly">Too Early</option>
  			<option value="thesisLate">Too Late</option>
  			</select><br>

		<br><u>Reason Flags</u><br>
				<select name="reasonFlags" >
		  	<option value="" selected>Select...</option>
  			<option value="reasonUS">Unestablished Subject</option>
  			<option value="reasonUI">Itself Unestablished</option>
  			<option value="reasonHostile">Hostile</option>
  			</select><br>

					<br><u>Rule Flags</u><br>
			<select name="ruleFlags">
		  	<option value="" selected>Select...</option>
  			<option value="ruleNarrow">Too Narrow</option>
  			<option value="ruleBroad">Too Broad</option>
  			<option value="ruleUnest">Unestablished Universal</option>
  			<option value="ruleContri">Contrived Universal</option>
		</select><br>


<!-- <br><u>Inference Flags</u><br>
				<select name="infFlags">
		  	<option value="" selected>Select...</option>
  			<option value="ReasonSub">Reason not in subject</option>
  			<option value="ErrantInfo">Errant information</option>
  			<option value="Uncertain">Uncertain/Ambiguous</option>
  			</select><br>
-->


<?php } ?>
  

 <?php // ------------- TWO
if( $claimsdb['supportMeans'] == "Perception")
{ ?>
	
	<br><u>Perception Flags</u><br>
				<select name="perFlags">
		  	<option value="" selected>Select...</option>
  			<option value="ContactObject">No contact with object from sense organ</option>
  			<option value="Verbal">Relies on language</option>
  			<option value="Errant">Errant</option>
  			<option value="Ambiguous">Ambiguous</option>
  			</select><br>

<?php } ?>

   <?php // ------------- THREE
if( $claimsdb['supportMeans'] == "Testimony")
{ ?>

<br><u>Testimony Flags</u><br>
				<select name="testFlags">
		  	<option value="" selected>Select...</option>
  			<option value="NoDirect">No direct familiarity</option>
  			<option value="ErrantInfo">Errant information</option>
  			<option value="Uncertain">Uncertain/Ambiguous</option>
  			<option value="AlternativeAgendas">Alternative agendas/motivations</option>
  			<option value="Misstatement">Misstatement</option>
  			</select><br>
			
<?php }  ?>

				
<!-- ---------------------   -->

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
  			
	

			<label>Support Means</label><br>
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

<textarea id="description" name = "description" value="<?php echo htmlspecialchars($description) ?>">Description</textarea><br>

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
        description.style.display = 'none';
      
    }

}
</script>


<br>


			<div class="center">
				<button id="submit">Submit</button>	
					</div>
		</form>
	</section>

  </div>

</div>

<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
<?php include('templates/footer.php'); ?>
</body>

</html>
