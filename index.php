
<?php include('config/db_connect.php'); ?>
  <link rel="stylesheet" href="./style.css"> 


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<?php include('templates/header.php');
?>
<center>

<!-- <table style=\"width:60%\">
  <tr><th> --> 

<h1>Welcome!</h1>

This is a website for discussion and learning that is based on Indian traditions of epistemology, logic and debate. Users can create new claims using protocols of <i>vāda</i> and <i>pramāṇavāda</i>, or participate in and observe pre-existing debates.

 <br><br><br>
 
<h3>Topics to select from:</h3>
<?php

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
<a href="ajaxindex.php?topic=<?php echo $root2['topic']?>"><button> <?php echo $root2['topic'] ?></button></a>
        
<?php   
} 
echo "<BR><BR><BR><BR><BR>Want to start a new topic? <BR>";
?>

    
<a class="brand-text" href="add.php"><button>Add New Claim</button></a><br><br>

    <footer> 

    	Vada Project <a class="brand-text" href="privpolicy.php" style=" color : #fff; ">Privacy Policy</a>

    </footer>

<!-- style=" color : #fff; " -->