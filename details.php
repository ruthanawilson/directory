<?php 
	include('config/db_connect.php');
	// check GET request id param
	if(isset($_GET['id'])){
		
		// escape sql chars
		$inferenceID = mysqli_real_escape_string($conn, $_GET['id']);
		// make sql
		$sql = "SELECT * FROM inferencedb WHERE inferenceID = $inferenceID";
		// get the query result
		$result = mysqli_query($conn, $sql);
		// fetch result in array format
		$inferencedb = '';
		$inferencedb = mysqli_fetch_assoc($result);
		mysqli_free_result($result);

		}

	$sql2 = 'SELECT inferenceIDFlagged, inferenceIDFlagger, flagType, active FROM flagsdb';
	// get the result set (set of rows)
	$result2 = mysqli_query($conn, $sql2);
	// fetch the resulting rows as an array // was $result
	$flagsdb = mysqli_fetch_all($result2, MYSQLI_ASSOC);
	
	// close connection
	mysqli_close($conn);
	
?>



<!DOCTYPE html>
<html>
 
	<?php include('templates/header.php'); ?>
<center>
	<div class="container center">


		<?php if ($inferencedb):


		 //	if($flagsdb['inferenceIDFlagged'] == $inferenceID && $flagsdb['active'] == '1')
// { ?>	<html><font color="red"> }
	
			<p><b>Inference ID:</b>  <?php echo $inferencedb['inferenceID']; ?> </p>
			<p><b>Thesis Statement:</b>  <?php echo $inferencedb['thesisST']; ?> </p></font>
			<p><b>Reason Statement:</b>  <?php echo $inferencedb['reasonST']; ?> </p>
			<p><b>Rule Statement:</b>  <?php echo $inferencedb['ruleST']; ?> </p></html>
					
<html>

				<br><u>Thesis Flags</u><br>
				<select name="thesisFlags" onchange="location = this.value;">
		  	<option value="" selected>Select...</option>
  			<option value="thesisRival.php?id=<?php echo $inferencedb['inferenceID']?>">Has Rival</option>
  			<option value="thesisEarly.php?id=<?php echo $inferencedb['inferenceID']?>">Too Early</option>
  			<option value="thesisLate.php?id=<?php echo $inferencedb['inferenceID']?>">Too Late</option>
  			</select><br><br><br>



		<br><u>Reason Flags</u><br>
				<select name="reasonFlags" onchange="location = this.value;">
		  	<option value="" selected>Select...</option>
  			<option value="reasonUS.php?id=<?php echo $inferencedb['inferenceID']?>">Unestablished Subject</option>
  			<option value="reasonUI.php?id=<?php echo $inferencedb['inferenceID']?>">Itself Unestablished</option>
  			<option value="reasonHostile.php?id=<?php echo $inferencedb['inferenceID']?>">Hostile</option>
  			</select><br><br><br>


					<br><u>Rule Flags</u><br>
			<select name="ruleFlags" onchange="location = this.value;">
		  	<option value="" selected>Select...</option>
  			<option value="ruleNarrow.php?id=<?php echo $inferencedb['inferenceID']?>">Too Narrow</option>
  			<option value="ruleBroad.php?id=<?php echo $inferencedb['inferenceID']?>">Too Broad</option>
  			<option value="ruleUnest.php?id=<?php echo $inferencedb['inferenceID']?>">Unestablished Universal</option>
  			<option value="ruleContri.php?id=<?php echo $inferencedb['inferenceID']?>">Contrived Universal</option>
		</select><br><br><br>


<!--

<select name="forma" onchange="location = this.value;">
 <option value="choose">Choose One</option>
 <option value="thesisRival.php?id=<?php echo $inferencedb['inferenceID']?>">thesisRival</option>
 <option value="thesisLate.php?id=<?php echo $inferencedb['inferenceID']?>">thesisLate</option>
 <option value="thesisEarly.php">thesisEarly</option>
</select>
--> 


</center>


		<?php else: ?>
			<h5>Claim not found.</h5>
		<?php endif ?>
	
	</div>
	<?php foreach($flagsdb as $flagsdb): ?>

	<center>
		<?php
if($flagsdb['inferenceIDFlagged'] == $inferenceID && $flagsdb['active'] == '1')
{
				echo htmlspecialchars('ID being flagged: ' . $flagsdb['inferenceIDFlagged']); 
	?><html> <br></html>
	<?php				echo htmlspecialchars('Type of flag: ' . $flagsdb['flagType']); 
		


 ?>

				<html> <br></html>
			
			
		

				<a href ="details.php?id=<?php echo $flagsdb['inferenceIDFlagger']?>"><?php echo htmlspecialchars('ID of FLAGGER for THIS inference: ' . $flagsdb['inferenceIDFlagger']); ?> </a> <?php
						}
					//	else{
				//			echo "This entry has never been flagged!";
				//		}

	endforeach;

?> <br><br>
	<?php include('templates/footer.php'); ?>

</html>

<!-- <p><h6>Thesis Statement:</h6> <?php echo $claimsdb['subject']; ?> <?php echo $claims['thesis']; ?></p><br>

<p><h6>Reason Statement:</h6> Because <?php echo $claims['subject']; ?> <?php echo $claims['reason']; ?></p><br>

<p><h6>Rule Example:</h6> Whatever <?php echo $claims['reason']; ?>, <?php echo $claims['thesis']; ?>, as in the case of <?php echo $claims['example']; ?></p><br> --> 

