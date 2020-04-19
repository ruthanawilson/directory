<?php 
	include('config/db_connect.php');
	$sql = 'SELECT thesisST, reasonST, ruleST, claimID FROM claimsdb';
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

	<h4 class="center grey-text">Claims</h4>

	<div class="container">
		<div class="row">
			<center>
			<?php foreach($claimsdb as $claimsdb): ?>

				<div class="col s6 m4">
					<div class="card z-depth-0">
						<div class="card-content center">
								<br><br>
							<?php echo htmlspecialchars('Thesis statement: ' . $claimsdb['thesisST']); ?>
					

		</select>
<br>

						

		<!--  if too narrow then post[ruleNarrow = 1] for claimsdb[id] --> 

		<!--  if too broad then post[ruleBroad = 1] for claimsdb[id]... etc 

				<br><u>Thesis Flags</u><br>
			<select name="supportMeans">
		  	<option value="" selected>Select...</option>
  			<option value="1">Has Rival</option>
  			<option value="2">Too Early</option>
  			<option value="3">Too Late</option>


<select class="myselect">
  			<option data-url="thesisRival.php">thesisRival</option>
   			<option data-url="thesisLate.php">thesisLate</option>
   				</select>

<br><u>Reason Flags</u><br>
			<select name="supportMeans">
		  	<option value="" selected>Select...</option>
  			<option value="1">Unestablished Subject</option>
  			<option value="2">Itself Unestablished</option>
  			<option value="3">Hostile</option>
		</select><br><br><br>

					<br><u>Rule Flags</u><br>
			<select name="flagstate">
		  	<option value="" selected>Select...</option>
  			<option value="(<a href="flagadd.php?id=<?php echo $inferencedb['inferenceID']?>">flagadd</a>)">Too Narrow</option>
  			<option value="2">Too Broad</option>
  			<option value="3">Unestablished Universal</option>
  			<option value="3">Contrived Universal</option>
		</select><br><br><br>


	--> 



							</ul>




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



<!-- <center>
<div id="content">Hi</div>

<script type="text/javascript">
$(document).ready(function(){
    var about_me = "add.php";
    $('#content').click(function(){
        $('#content').load(about_me);
    });
});
</script>
-->

</body>
</html>



<br><br><br>







</center>

<!--    
<div id="topmenu" >Page1 | Page2 | Page 3
<ul><center>
      <a href="#">Home</a>
      <a href="#">Argumentation</a>
      <a href="#">About</a>
      <a href="#">Logic Guide</a>
    </ul>
    </div>
<div>
  <form action="includes/login.inc.php" method="post">
    <input type="text" name="mailuid" placeholder="Email...">
    <input type="password" name="pwd" placeholder="Password...">
    <button type ="submit" name="login-submit">Login</button>

  </form>
<center><a href="includes/signup.php">Not registered? Signup!</a>


  <form action="includes/login.inc.php" method="post">
    <button type ="submit" name="logout-submit">Logout</button>

  </form>

	<p>You are logged out!</p>
	<p> You are logged in!</p>
         <input type="text" id="textInput" value="" hidden/>
<script>
    $( "#options" ).change(function() {
        $("#textInput").show();
    });
</script>
 -->


	<?php include('templates/footer.php'); ?>

</html>