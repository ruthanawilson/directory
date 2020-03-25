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
		mysqli_close($conn);
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
				echo $inferenceIDFlagged;
 ?>

			<p><b>Rule Statement:</b>  <?php echo $inferencedb['ruleST']; ?> </p>
			<center>Either link to a currently unflagged claim or generate a new claim with the identical subject as the flagee statement asserting that this subject either <br>(a) is not known to possess the flagee thesis statement's target property or <br>(b) does not possess the flagee thesis statement's target property.</center>



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
	if(isset($_POST['submit']))
	{	


			// escape sql chars
			
			$flagType = mysqli_real_escape_string($conn, $_POST['flagType']);

			$reason = mysqli_real_escape_string($conn, $_POST['reason']);
			$example = mysqli_real_escape_string($conn, $_POST['example']);
			$URL = mysqli_real_escape_string($conn, $_POST['url']);
			$rd = mysqli_real_escape_string($conn, $_POST['rd']);
			$subject = mysqli_real_escape_string($conn, $_POST['subject']);
			$supportMeans = mysqli_real_escape_string($conn, $_POST['union']);
			$targetP = mysqli_real_escape_string($conn, $_POST['targetP']);

$thesisST= $subject ." " . $targetP. ".";

$reasonST= "Because " . $subject . " " . $reason. ".";

$ruleST= "Whomever " . $reason . " " . $targetP. " as in the case of " . $example. ".";


$c = uniqid (rand (),true);

$supportID =  $c;


//			$thesisSt = $subject . $thesis;
//			$reasonSt = $subject . $reason;
//			$ruleSt = "Whatever " . $reason . $thesis . " as in the case of" . $example;
		//	echo $thesisSt;
		//	echo htmlspecialchars($reasonSt);
		//	$thesisSt = mysqli_real_escape_string($conn, $_POST['thesisSt']);
		//	$reasonSt = mysqli_real_escape_string($conn, $_POST['reasonSt']);
		//	$ruleSt = mysqli_real_escape_string($conn, $_POST['ruleSt']);
		//		INSERT INTO statements
		// VALUES ("A001","Jodi","London","075-1248798");

// thesis st and reason st differentiation 
		
		$sql1 = "INSERT INTO claimsdb(subject, targetP, supportMeans, supportID, example, URL, reason, rd) VALUES('$subject', '$targetP', '$supportMeans', '$supportID','$example','$URL','$reason', '$rd')";

		$sql2 = "INSERT INTO inferencedb(inferenceID, thesisST, reasonST,ruleST, claimID) VALUES('$inferenceID', '$thesisST','$reasonST','$ruleST', '$claimID')";


			$temp = $targetP;
			$targetP = $reason; 
			$reason = $temp;
			

$thesisST= $subject ." " . $targetP. ".";

$reasonST= "Because " . $subject . " " . $reason. ".";

$ruleST= "Whomever " . $reason . " " . $targetP. " as in the case of " . $example. ".";


$flagType = 'thesisRival';
$active = '1'; //alter preexisting flags to inactive if flagged.... so if id has a match in inferenceIDFlagged, active = 0. if active = 0, text = red. 
// $inferenceIDFlagger = new auto incremented ID....


		$sql3 = "INSERT INTO claimsdb(subject, targetP, supportMeans, supportID, example, URL, reason, rd) VALUES('$subject', '$targetP', '$supportMeans', '$supportID','$example','$URL','$reason', '$rd')";

		$sql4 = "INSERT INTO inferencedb(inferenceID, thesisST, reasonST,ruleST, claimID) VALUES('$inferenceID', '$thesisST','$reasonST','$ruleST', '$claimID')";

			// save to db and check

			if(mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2) && mysqli_query($conn, $sql3) && mysqli_query($conn, $sql4) && mysqli_query($conn, $sql5)){
				// success
				header('Location: index.php');
			} else {
				echo 'query error: '. mysqli_error($conn);
			}
				


}// Close connection

		/* $sql5 = "INSERT INTO flagsdb(inferenceIDFlagged, flagType, inferenceIDFlagger, active) VALUES('$inferenceIDFlagged', '$flagType','$inferenceIDFlagger','$active')";

		if(mysqli_query($conn, $sql5)){
				// success
				header('Location: index.php');
			} else {
				echo 'query error: '. mysqli_error($conn);
			}
*/

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header.php'); ?>
<div class="content">
<center>
<b>Add claim to flag this inference "Thesis Rival"</b>
			<form action="thesisRival.php" method="POST">
			

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
    } else {
        rd.style.display = 'none';
      
    }

}
</script>


<br>


			<div class="center">
				<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
			</div>
		</form>
	</section>

</center>
</div>
	

	<?php include('templates/footer.php'); ?>

</html>

<!-- <p><h6>Thesis Statement:</h6> <?php echo $claimsdb['subject']; ?> <?php echo $claims['thesis']; ?></p><br>

<p><h6>Reason Statement:</h6> Because <?php echo $claims['subject']; ?> <?php echo $claims['reason']; ?></p><br>

<p><h6>Rule Example:</h6> Whatever <?php echo $claims['reason']; ?>, <?php echo $claims['thesis']; ?>, as in the case of <?php echo $claims['example']; ?></p><br> --> 

