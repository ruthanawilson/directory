<?php

	if(isset($_POST['submit']))
	{	
	include('config/db_connect.php');
	$inferenceID = $claimID = $thesisST = $reasonST = $ruleST = $subject = $targetP = $supportMeans = $supportID = $example = $URL = $reason = $rd ='';

$claimID = $claimID;
$subject = $subject;
$targetP = $targetP;
$SupportMeans = $supportMeans;
$supportID = $supportID;
$example = $example;
$URL = $URL;
$reason = $reason;
$rd = $rd;



$thesisST= $subject ." " . $targetP. ".";
$reasonST= "Because " . $subject . " " . $reason. ".";
$ruleST= "Whomever " . $reason . " " . $targetP. " as in the case of " . $example. ".";
		

$sql1 = "INSERT INTO claimsdb2(claimID, subject, targetP, supportMeans, supportID, example, URL, reason, rd) VALUES('$claimID', '$subject','$targetP','$supportMeans', '$supportID','$example','URL','$reason', '$rd')";

$sql2 = "INSERT INTO inferencedb(inferenceID, thesisST, reasonST, ruleST, claimID) VALUES('$inferenceID', '$thesisST','$reasonST','$ruleST', '$claimID')";
//$inferenceIDFlagged = $inferenceID
//$inferenceIDFlagger = '';
//$flagID = '';
//$active = '';
// $inferenceIDFlagger = new auto incremented ID....
// $active = 1, but alter preexisting flags to inactive if flagged.... so if id has a match in inferenceIDFlagged, active = 0. if active = 0, text = red. 
$sql3 = "INSERT INTO flagsdb(inferenceIDFlagged, flagType, inferenceIDFlagger, flagID, active) VALUES('$inferenceIDFlagged', '$flagType','$inferenceIDFlagger','$flagID', '$active')";

mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header.php'); ?>
<div class="content">
<center>

  <section class="container grey-text">
		<h4 class="center">Add Claim</h4>
		<!-- <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST"> -->
		<form action="UntitledRecovery.php" method="POST">
		

			<label>Subject</label><br>
			<textarea id="reason" name = "reason" value="<?php echo htmlspecialchars($reason) ?>">Enter Reason Statement</textarea><br>
			<textarea id="subect" name = "subject" value="<?php echo htmlspecialchars($subject) ?>">Enter subject Statement</textarea><br>

			<div class="center">
				<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
			</div>
		</form>
	</section>

</center>
</div>
	

	<?php include('templates/footer.php'); ?>

</html>