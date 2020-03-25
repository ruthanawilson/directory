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
	$inferenceID = $temp = $result = $array = $claim_fk = $claimID = $IclaimID = $thesisST = $reasonST = $ruleST = $NewOld = $oldClaim = $subject = $targetP = $supportMeans = $supportforID = $supportID = $example = $URL =  $rd = $reason =  $flagType = $flagURL = $flagSource = $flagID = $active ='';

	if(isset($_POST['submit']))
	{	$conn = mysqli_connect('localhost', 'leafy', 'vada', 'vada_project');


		{
			// escape sql chars
			$subject = mysqli_real_escape_string($conn, $_POST['subject']);
			$thesis = mysqli_real_escape_string($conn, $_POST['thesis']);
			$reason = mysqli_real_escape_string($conn, $_POST['reason']);
			$example = mysqli_real_escape_string($conn, $_POST['example']);


 $thesisST = mysqli_real_escape_string($conn, $_POST['thesisST']);
 $reasonST = mysqli_real_escape_string($conn, $_POST['reasonST']);
 $ruleST = mysqli_real_escape_string($conn, $_POST['ruleST']);

			$NewOld = mysqli_real_escape_string($conn, $_POST['NewOld']);
			$oldClaim = mysqli_real_escape_string($conn, $_POST['oldClaim']);
			$targetP = mysqli_real_escape_string($conn, $_POST['targetP']);
			$supportMeans = mysqli_real_escape_string($conn, $_POST['supportMeans']);

			$supportforID = mysqli_real_escape_string($conn, $_POST['supportforID']);
		
			$URL = mysqli_real_escape_string($conn, $_POST['URL']);
		

if ($SupportMeansID == $InferenceID && $SupportMeansID == $claimID)
{
$thesisST= $subject ." " . $targetP. ".";
}

$reasonST= "Because " . $subject . " " . $reason. ".";

if ($SupportMeansID == $SupportForID)
{
$ruleST= "Whomever " . $reason . " " . $targetP. " as in the case of " . $example. ".";
}

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
			

			if ($SupportMeansID == $InferenceID && $SupportMeansID == $claimID)
{
$thesisST= $subject ." " . $targetP. ".";
}
//else
//{
//}

//if ($SupportForID == $InferenceID && $SupportMeansID != $claimID)
//{
$reasonST= "Because " . $subject . " " . $reason. ".";
//}


if ($SupportMeansID == $SupportForID)
{
$ruleST= "Whomever " . $reason . " " . $targetP. " as in the case of " . $example. ".";
}


		$sql3 = "INSERT INTO claimsdb(subject, targetP, supportMeans, supportID, example, URL, reason, rd) VALUES('$subject', '$targetP', '$supportMeans', '$supportID','$example','$URL','$reason','$rd')";


			$sql4 = "INSERT INTO inferencedb(inferenceID, thesisST, reasonST, ruleST, claimID) VALUES('$inferenceID', '$thesisST','$reasonST','$ruleST', '$claimID')";

$flagType = 'thesisRival';
//$inferenceIDFlagged = $inferenceID
//$inferenceIDFlagger = '';
//$flagID = '';
//$active = '';
// $inferenceIDFlagger = new auto incremented ID....
// $active = 1, but alter preexisting flags to inactive if flagged.... so if id has a match in inferenceIDFlagged, active = 0. if active = 0, text = red. 
//$sql5 = "INSERT INTO flagsdb(inferenceIDFlagged, flagType, inferenceIDFlagger, flagID, active) VALUES('$inferenceIDFlagged', '$flagType','$inferenceIDFlagger','$flagID', '$active')";


			// save to db and check

$conn = mysqli_connect('localhost', 'leafy', 'vada', 'vada_project');

			if(mysqli_query($conn, $sql1)){
				// success
				header('Location: add.php');
			} else {
			echo 'query error: '. mysqli_error($conn); }


			if(mysqli_query($conn, $sql2)){
				// success
				header('Location: add.php');
			} else {
			echo 'query error: '. mysqli_error($conn); }


			if(mysqli_query($conn, $sql3)){
				// success
				header('Location: add.php');
			} else {
				echo 'query error: '. mysqli_error($conn);	}


			if(mysqli_query($conn, $sql4)){
				// success
				header('Location: add.php');
			} else {
				echo 'query error: '. mysqli_error($conn); }

				if(mysqli_query($conn, $sql5)){
				// success
				header('Location: add.php');
			} else {
				echo 'query error: '. mysqli_error($conn); }


		
	} // end POST check
}// Close connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header.php'); ?>
<div class="content">
<center>
<b>Add Claim</b>
		<form class="white" action="index.php" method="POST">
			

			<label>Subject</label><br>
			<input type="text" name="subject" value="<?php echo htmlspecialchars($subject) ?>"><br>

			<label>Target Property</label><br>
			<input type="text" name="targetP" value="<?php echo htmlspecialchars($targetP) ?>"> <br>

			<label>Support Means</label><br>
<select name="union" id="union">
<option value="choose">Choose One</option>
<option value="inference">Inference</option>
<option value="testimony">Testimony</option>
<option value="perception">Perception</option>
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
    if (union.options[union.selectedIndex].value === 'inference') {
        reason.style.display = '';
        example.style.display = '';
    } else {
        reason.style.display = 'none';
        example.style.display = 'none';
    }


if (union.options[union.selectedIndex].value === 'perception') {
        url.style.display = '';
    } else {
        url.style.display = 'none';
      
    }

if (union.options[union.selectedIndex].value === 'testimony') {
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

