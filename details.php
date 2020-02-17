<?php 
	include('config/db_connect.php');
	// check GET request id param
	if(isset($_GET['inferenceID'])){
		
		// escape sql chars
		$id = mysqli_real_escape_string($conn, $_GET['inferenceID']);
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
		<?php if($inferencedb): ?>
			<p><h6>The subject is:</h6> <?php echo $inferenceID['thesisST']; ?> </p><br>
			<p><h6>The thesis is:</h6> <?php echo $claims['thesis']; ?></p><br>
			<p><h6>The reason is:</h6> <?php echo $claims['reason']; ?></p><br>
			<p><h6>The example is:</h6> <?php echo $claims['example']; ?></p><br>
			<p>Created at: <?php echo date($claims['createdAt']); ?></p>

</center>



<p><h6>Thesis Statement:</h6> <?php echo $claims['subject']; ?> <?php echo $claims['thesis']; ?></p><br>

<p><h6>Reason Statement:</h6> Because <?php echo $claims['subject']; ?> <?php echo $claims['reason']; ?></p><br>

<p><h6>Rule Example:</h6> Whatever <?php echo $claims['reason']; ?>, <?php echo $claims['thesis']; ?>, as in the case of <?php echo $claims['example']; ?></p><br>
	




		<?php else: ?>
			<h5>Claim not found.</h5>
		<?php endif ?>
	</div>


	<?php include('templates/footer.php'); ?>

</html>