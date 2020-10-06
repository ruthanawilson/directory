
<?php include('config/db_connect.php'); ?>
  <link rel="stylesheet" href="./style.css"> 


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<div class="wrapper">
    <ul>
      <li class="noline">

<?php include('templates/header.php');
?>


<BR><BR>

<?php
echo "Topics to select from: <BR><BR>";
$root12 = "SELECT DISTINCT topic
        from claimsdb
        "; // SQL with parameters
$stmt52 = $conn->prepare($root12); 
$stmt52->execute();
$rootresult12 = $stmt52->get_result(); // get the mysqli result
$numhitsroot = mysqli_num_rows($rootresult12);
 while($root2 = $rootresult12->fetch_assoc())
  {

  	?>
<a class="brand-text" style=" color : #fff;" href="ajaxindex.php?topic=<?php echo $root2['topic']?>"> <?php echo $root2['topic'] ?></a>

        
<?php   
} 
echo "<BR><BR>Want to start a new topic? <BR>";
?>

    
<a class="brand-text" href="add.php" style=" color : #fff;">Add New Claim</a><br><br>
    
<a class="brand-text" href="privpolicy.php" style=" color : #fff;">Privacy Policy</a><br><br>