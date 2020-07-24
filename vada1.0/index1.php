<?php 
	include('config/db_connect.php');
	$sql = 'SELECT thesisST, reasonST, ruleST, supportMeans, claimID FROM claimsdb';
	// get the result set (set of rows)
	$result = mysqli_query($conn, $sql);
	// fetch the resulting rows as an array // was $result
	$claimsdb = mysqli_fetch_all($result, MYSQLI_ASSOC);
	
	// close connection
	mysqli_close($conn);


?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header.php'); ?>

	<center> <b> Claims  </b> 
	<br><a class="brand-text" href="add.php">Add Claim</a>
	</center>

	<div class="container">
		<div class="row">
			<center>
			<?php foreach($claimsdb as $claimsdb): ?>

				<div class="col s6 m4">
					<div class="card z-depth-0">
						<div class="card-content center">
								<br><br>
	<?php echo htmlspecialchars('Thesis statement: ' . $claimsdb['thesisST']);
		  echo nl2br("\r\n");
		  echo htmlspecialchars('Support Means : ' . $claimsdb['supportMeans']);
					 ?>
			</div>

		<div class="card-action right-align">
<a class="brand-text" href="details.php?id=<?php echo $claimsdb['claimID']?>">details</a>
							
						</div>
					</div>
				</div>

			<?php endforeach; ?>

		</div>
	</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</body>
</html>



<br><br><br>

</center>

	<?php include('templates/footer.php'); ?>

</html>