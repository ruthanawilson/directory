// <?php include('templates/header.php'); ?>
<main>



/// display
<div id="songname"><?php echo "$songname <br/> $songlyrics"; ?></div>


	<h1>Signup</h1>

	// this is where i start the signup page which will be separate 
<form action ="includes/signup.inc.php" method="post">
<input type ="text" name = "mailuid" placeholder="Email">
<input type ="password" name = "pwd" placeholder="Password">
<input type ="password" name = "pwd-repeat" placeholder="Password Repeat">
<button type ="submit" name="signup-submit">Signup</button>
</form>
</main>
// <?php include('templates/footer.php'); ?>