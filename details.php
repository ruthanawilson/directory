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



	$sql3 = 'SELECT inferenceIDFlagged, inferenceIDFlagger, flagType, active FROM flagsdb';
	// get the result set (set of rows)
	$result3 = mysqli_query($conn, $sql3);
	// fetch the resulting rows as an array // was $result
	$flagsdb2 = mysqli_fetch_all($result3, MYSQLI_ASSOC);

	
	// close connection
	mysqli_close($conn);
	
?>



<!DOCTYPE html>
<html>
 
	<?php include('templates/header.php'); ?>
<center>
	<div class="container center">

	<?php foreach($flagsdb as $flagsdb): 

		 $color = '';
		 $inferenceIDFlagged = $flagsdb['inferenceIDFlagged'];
		 $active = $flagsdb['active'];
		 	if($inferenceIDFlagged == $inferenceID && $active == '1')
 { $color = "red"; break;}
else{ $color = "green"; } 
endforeach;  ?>
<font color = "<?php echo $color; ?>">	
			<p><b>Inference ID:</b>  <?php echo $inferencedb['inferenceID']; ?> </p>
			<p><b>Thesis Statement:</b>  <?php echo $inferencedb['thesisST']; ?> </p>
			<p><b>Reason Statement:</b>  <?php echo $inferencedb['reasonST']; ?> </p>
			<p><b>Rule Statement:</b>  <?php echo $inferencedb['ruleST']; ?> </p></font>

				<br><u>Thesis Flags</u><br>
				<select name="thesisFlags" onchange="location = this.value;">
		  	<option value="" selected>Select...</option>
  			<option value="thesisRival.php?id=<?php echo $inferencedb['inferenceID']?>">Has Rival</option>
  			<option value="thesisEarly.php?id=<?php echo $inferencedb['inferenceID']?>">Too Early</option>
  			<option value="thesisLate.php?id=<?php echo $inferencedb['inferenceID']?>">Too Late</option>
  			</select><br><br>

		<br><u>Reason Flags</u><br>
				<select name="reasonFlags" onchange="location = this.value;">
		  	<option value="" selected>Select...</option>
  			<option value="reasonUS.php?id=<?php echo $inferencedb['inferenceID']?>">Unestablished Subject</option>
  			<option value="reasonUI.php?id=<?php echo $inferencedb['inferenceID']?>">Itself Unestablished</option>
  			<option value="reasonHostile.php?id=<?php echo $inferencedb['inferenceID']?>">Hostile</option>
  			</select><br><br>

					<br><u>Rule Flags</u><br>
			<select name="ruleFlags" onchange="location = this.value;">
		  	<option value="" selected>Select...</option>
  			<option value="ruleNarrow.php?id=<?php echo $inferencedb['inferenceID']?>">Too Narrow</option>
  			<option value="ruleBroad.php?id=<?php echo $inferencedb['inferenceID']?>">Too Broad</option>
  			<option value="ruleUnest.php?id=<?php echo $inferencedb['inferenceID']?>">Unestablished Universal</option>
  			<option value="ruleContri.php?id=<?php echo $inferencedb['inferenceID']?>">Contrived Universal</option>
		</select><br><br>

<br><u>Perception Flags</u><br>
				<select name="perFlags" onchange="location = this.value;">
		  	<option value="" selected>Select...</option>
  			<option value="thesisRival.php?id=<?php echo $inferencedb['inferenceID']?>">No contact with object from sense organ</option>
  			<option value="thesisEarly.php?id=<?php echo $inferencedb['inferenceID']?>">Relies on language</option>
  			<option value="thesisLate.php?id=<?php echo $inferencedb['inferenceID']?>">Errant</option>
  			<option value="thesisLate.php?id=<?php echo $inferencedb['inferenceID']?>">Ambiguous</option>
  			</select><br><br>

<br><u>Inference Flags</u><br>
				<select name="infFlags" onchange="location = this.value;">
		  	<option value="" selected>Select...</option>
  			<option value="thesisRival.php?id=<?php echo $inferencedb['inferenceID']?>">Reason not in subject</option>
  			<option value="thesisEarly.php?id=<?php echo $inferencedb['inferenceID']?>">Errant information</option>
  			<option value="thesisLate.php?id=<?php echo $inferencedb['inferenceID']?>">Uncertain/Ambiguous</option>
  			</select><br><br>

  			<br><u>Testimony Flags</u><br>
				<select name="testFlags" onchange="location = this.value;">
		  	<option value="" selected>Select...</option>
  			<option value="thesisRival.php?id=<?php echo $inferencedb['inferenceID']?>">No direct familiarity</option>
  			<option value="thesisEarly.php?id=<?php echo $inferencedb['inferenceID']?>">Errant information</option>
  			<option value="thesisLate.php?id=<?php echo $inferencedb['inferenceID']?>">Uncertain/Ambiguous</option>
  			<option value="thesisEarly.php?id=<?php echo $inferencedb['inferenceID']?>">Alternative agendas/motivations</option>
  			<option value="thesisLate.php?id=<?php echo $inferencedb['inferenceID']?>">Misstatement</option>
  			</select><br><br>
	
	</div>

	<?php 
	$empty = '';
	foreach($flagsdb2 as $flagsdb2):
?> <?php
	
		$inferenceIDFlagged = $flagsdb2['inferenceIDFlagged'];
		 $active = $flagsdb2['active'];
		 	if($inferenceIDFlagged == $inferenceID && $active == '1')
{
echo htmlspecialchars('ID being flagged: ' . $flagsdb2['inferenceIDFlagged'] . '<br>'); 

echo htmlspecialchars('Type of flag: ' . $flagsdb2['flagType']. '<br>');  ?>



				<a href ="details.php?id=<?php echo $flagsdb['inferenceIDFlagger']?>"><?php echo htmlspecialchars('ID of FLAGGER for THIS inference: ' . $flagsdb2['inferenceIDFlagger']); ?> </a> <?php
						}

/*						if($inferenceIDFlagger == $inferenceIDFlagged)
	{
	$update = "UPDATE flagsdb SET active='0' WHERE inferenceID='$invar'";
	
if ($conn->query($update) === TRUE) {
    echo "Record updated successfully";
} } */    


		
						if($flagsdb2['inferenceIDFlagged'] == $inferenceID)
						{ 
							$empty = "false";

						}
						?><br><br><?php
	endforeach;
	if($empty = "true")
	{
		echo "This inference has never been flagged.";
	}

?> <br>
	<?php include('templates/footer.php'); ?>

</html>

<!-- <p><h6>Thesis Statement:</h6> <?php echo $claimsdb['subject']; ?> <?php echo $claims['thesis']; ?></p><br>

<p><h6>Reason Statement:</h6> Because <?php echo $claims['subject']; ?> <?php echo $claims['reason']; ?></p><br>

<p><h6>Rule Example:</h6> Whatever <?php echo $claims['reason']; ?>, <?php echo $claims['thesis']; ?>, as in the case of <?php echo $claims['example']; ?></p><br> --> 

