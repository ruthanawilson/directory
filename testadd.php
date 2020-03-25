<?php

	include('config/db_connect.php');

	$email = $title = $ingredients = $inferenceIDFlagged = $flagType = $inferenceIDFlagger = $flagID = $active = '';
	$inferenceID = $temp = $result = $array = $claim_fk = $claimID = $IclaimID = $thesisST = $reasonST = $ruleST = $NewOld = $oldClaim = $subject = $targetP = $supportMeans = $supportforID = $supportID = $example = $URL =  $rd = $reason =  $flagType = $flagURL = $flagSource = $flagID = $active ='';


	if(isset($_POST['submit'])){
		
		
			$flagType = mysqli_real_escape_string($conn, $_POST['flagType']);
			$active = mysqli_real_escape_string($conn, $_POST['active']);
			$inferenceIDFlagged = mysqli_real_escape_string($conn, $_POST['inferenceIDFlagged']);

			// create sql
	$sql1 = "INSERT INTO claimsdb(subject, targetP, supportMeans, supportID, example, URL, reason, rd) VALUES('$subject', '$targetP', '$supportMeans', '$supportID','$example','$URL','$reason', '$rd')";

	$sql2 = "INSERT INTO inferencedb(inferenceID, thesisST, reasonST,ruleST, claimID) VALUES('$inferenceID', '$thesisST','$reasonST','$ruleST', '$claimID')";

	$sql3 = "INSERT INTO flagsdb(inferenceIDFlagged, flagType, inferenceIDFlagger, active) VALUES('$inferenceIDFlagged', '$flagType','$inferenceIDFlagger','$active')";
			
			// save to db and check
			if(mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2) && mysqli_query($conn, $sql3)){
				// success
				header('Location: index.php');
			} else {
				echo 'query error: '. mysqli_error($conn);
			}
				

			
	
	} // end POST check

?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header.php'); ?>
<center>
	<section class="container grey-text">
		<h4 class="center">Add a Pizza</h4>
		<form class="white" action="testadd.php" method="POST">

			<label>Your FlagType</label>
			<input type="text" name="flagType" value="<?php echo htmlspecialchars($flagType) ?>">
		
			<label>Pizza Title</label>
			<input type="text" name="inferenceIDFlagger" value="<?php echo htmlspecialchars($inferenceIDFlagger) ?>">
			
			<label>Ingredients (comma separated)</label>
			<input type="text" name="active" value="<?php echo htmlspecialchars($active) ?>">

			<div class="center">


			<div class="center">
				<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
			</div>
		</form>
	</section>

	<?php include('templates/footer.php'); ?>

</html>