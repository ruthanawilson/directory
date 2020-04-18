<?php 
	include('config/db_connect.php');
	// check GET request id param
	if(isset($_GET['id'])){ //also the flag name
		
		// escape sql chars
		$inferenceID = mysqli_real_escape_string($conn, $_GET['id']); //get the flag name too
		// make sql
		$sql = "SELECT * FROM inferencedb WHERE inferenceID = $inferenceID";
		// get the query result
		$result = mysqli_query($conn, $sql);
		// fetch result in array format
		$inferencedb = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
	}
?>


<!DOCTYPE html>
<html>
 
	<?php include('templates/header.php'); ?>
<center>
	<div class="container center">
		<?php if ($inferencedb): ?>

			<p><b>Inference ID:</b>  <?php echo $inferencedb['inferenceID']; ?> </p>
			<p><b>Thesis Statement:</b>  <?php echo $inferencedb['thesisST']; ?> </p>
			<p><b>Reason Statement:</b>  <?php echo $inferencedb['reasonST']; ?> </p>
			<?php $inferenceIDFlagged = $inferencedb['inferenceID']; 
				//echo $inferenceIDFlagged;
			session_start();
			$_SESSION['varname'] = $inferenceIDFlagged;
echo $_SESSION['varname'];

 // $inferenceIDFlagger = mysqli_insert_id($conn);
 // echo "meow" . $inferenceIDFlagger;

				 $order = "SELECT * from inferencedb ORDER BY inferenceID DESC LIMIT 1";
				 $nice = mysqli_query($conn, $order);

 	?>

			<p><b>Rule Statement:</b>  <?php echo $inferencedb['ruleST']; ?> </p>
			<center>Either link to a currently unflagged claim or generate a new claim with the identical subject as the flagee statement asserting that this subject either <br>(a) is not known to possess the flagee thesis statement's target property or <br>(b) does not possess the flagee thesis statement's target property.

			<?php 

//$order = "SELECT * from inferencedb ORDER BY inferenceID DESC LIMIT 1";
//				 $nice = mysqli_query($conn, $order);


	$inference = "SELECT * from inferencedb ORDER BY inferenceID DESC LIMIT 1";
	 $queryinference = mysqli_query($conn, $inference);
	 if($row = $queryinference->fetch_assoc()) {
      $invar = $row['inferenceID']; }
 				
	$claim= "SELECT * from claimsdb ORDER BY claimID DESC LIMIT 1";
	 $queryclaim = mysqli_query($conn, $claim);
if($row = $queryclaim->fetch_assoc()) {
      $clvar = $row['claimID']; }

echo $invar;
echo $clvar;
//	$inference = "SELECT * from inferencedb ORDER BY inferenceID DESC LIMIT 1";
//	 $queryinference = mysqli_query($conn, $inference);
?>

</center>



</center>

		<?php else: ?>
			<h5>Claim not found.</h5>
		<?php endif ?>

	<?php include('templates/footer.php'); ?>

</html>

<?php
	include('config/db_connect.php');
	$inferenceID = $temp = $result = $array = $claim_fk = $claimID = $IclaimID = $thesisST = $reasonST = $ruleST = $NewOld = $oldClaim = $subject = $targetP = $supportMeans = $supportforID = $supportID = $example = $URL =  $rd = $reason =  $flagType = $flagURL = $flagSource = $flagID = $inferenceIDFlagger= $active = '';
	echo '22j ' . $inferenceIDFlagged; 

//$name=$_POST["name"];
//$ctgr=$_POST["ctgr"];

			

			/*$flagType = mysqli_real_escape_string($conn, $_POST['flagType']);
			$reason = mysqli_real_escape_string($conn, $_POST['reason']);
			$example = mysqli_real_escape_string($conn, $_POST['example']);
			$URL = mysqli_real_escape_string($conn, $_POST['url']);
			$rd = mysqli_real_escape_string($conn, $_POST['rd']);
			$subject = mysqli_real_escape_string($conn, $_POST['subject']);
			$supportMeans = mysqli_real_escape_string($conn, $_POST['union']);
			$targetP = mysqli_real_escape_string($conn, $_POST['targetP']);
*/



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



/*var flagType=$("#flagType").val();
var reason=$("#reason").val();
var example=$("#example").val();
var url=$("#url").val();
var rd=$("#rd").val();
var subject=$("#subject").val();
var supportMeans=$("#supportMeans").val();
var targetP=$("#targetP").val();
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
if(isset($_POST['flag']))
	{	


	}
	// Colorcode *specific* parts of the flag limb. 
		// IF flag = x, y, z, text = ruleflag/red. if flag = u, m, v, text = reasonflag/red. 



	// display pramana for each flag in db, including condition for supportmeans in claimsdb for the displa

	// testimony- summary of argument/timestamp/excerpt. also, description. 



	// Use UPDATE in mysql to change flag to 'active = 0' when flagged. 

	// flags are clearly explained

// ----------- Finished! ------------
	// Perception/testimony development.
		// done!
	

	// Link claimIDs and inferenceIDs. 
		//select claimID from claimdb of last entry, update claim id in inferenceID on last entry 
		// done!!
				

	// Fix isset POST command. 
		// done!!!!!!


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
<div class="content">
<center>
<b>Add claim to flag this as "Thesis Rival"</b>
		<br>	
			<!-- Trigger/Open The Modal -->
<button id="myBtn">Add Claim</button>



</center>
</div>
	

	<?php include('templates/footer.php'); ?>
</head>



<body>


<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">

    <span class="close">&times;</span>
    <center>
<form method="POST" id = "myForm" action="insert.php">
			
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

<textarea id="reason" name = "reason" value="<?php echo htmlspecialchars($reason) ?>">Enter Reason Statement</textarea><br>
<textarea id="example" name = "example" value="<?php echo htmlspecialchars($example) ?>">Enter Example Statement</textarea><br>
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

</body>


</html>

<!-- <p><h6>Thesis Statement:</h6> <?php echo $claimsdb['subject']; ?> <?php echo $claims['thesis']; ?></p><br>

<p><h6>Reason Statement:</h6> Because <?php echo $claims['subject']; ?> <?php echo $claims['reason']; ?></p><br>

<p><h6>Rule Example:</h6> Whatever <?php echo $claims['reason']; ?>, <?php echo $claims['thesis']; ?>, as in the case of <?php echo $claims['example']; ?></p><br> --> 


