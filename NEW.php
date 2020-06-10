
<?php 

error_reporting(E_ALL);
ini_set('display_errors', 1);

  include('config/db_connect.php');
  $sql = 'SELECT thesisST, reasonST, ruleST, supportMeans, subject, targetP, claimID FROM claimsdb';
  // get the result set (set of rows)
  $result = mysqli_query($conn, $sql);
  // fetch the resulting rows as an array // was $result
  $claimsdb = mysqli_fetch_all($result, MYSQLI_ASSOC);
  
  // close connection
 

?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="./style.css">

</head>
<body>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</body>
</html>



<br><br><br>

</center>
<!-- MEOW -->

<div class="wrapper">
    <ul>
      <li class="noline">
         CLAIMS
          <br>
<a class="brand-text" href="add.php" style=" color : #fff;">Add Claim</a><br><br>
Claims displayed as a <font color = "seagreen"> green font </font> mean that they are currently active. <br> Claims displayed as a <font color = "#FFFF99"> yellow font </font> mean that the are currently inactive. <br>




         <!-- partial:index.partial.html -->

  <br>
  </center>


  <!-- begin of foreach --> 
  <div class="container">
    <div class="row">
      <center>
      <?php  




restoreactivity(336);

restoreactivity(337);

function restoreactivity ($claimid)
{
include('config/db_connect.php');
$act = "SELECT DISTINCT claimIDFlagger
        from flagsdb
        WHERE claimIDFlagged = ?"; // SQL with parameters
$s = $conn->prepare($act); 
$s->bind_param("i", $claimid);
$s->execute();
$activity = $s->get_result(); // get the mysqli result



while($activestatus = $activity->fetch_assoc())
  { 
    $h = "SELECT DISTINCT active
        from claimsdb
        WHERE ? = claimID"; // SQL with parameters
      $noce = $conn->prepare($h); 
      $noce->bind_param("i", $activestatus['claimIDFlagger']);
      $noce->execute();
      $res = $noce->get_result(); // get the mysqli result
      $numh = mysqli_num_rows($res);


    
      echo nl2br("\r\n");
      echo $activestatus['claimIDFlagger'];
      echo nl2br("\r\n");

$everyInactive = 'true';
echo $everyInactive;
  while($r = $res->fetch_assoc())
  {  
    
    if($r['active'] == 1)
    {
      global $everyInactive;
      $everyInactive = 'false';
      echo $everyInactive;
    }
  }


  if($everyInactive == 'true')
  {
  
echo "ANSWER" . $everyInactive;
// BELOW CHANGES THE ACTIVE STATE OF OTHER CLAIMS
$act = "UPDATE claimsdb 
SET active = 1
WHERE claimID = ? 
"; // SQL with parameters
$upd = $conn->prepare($act); 
$upd->bind_param("i", $claimid);
$upd->execute();
 } // end of second if statement
     } //end first while loop

//THIS ABOVE CHANGES THE ACTIVE STATE OF OTHER CLAIMS
  
  }  // end function


?>

<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script><script  src="./script.js"></script>
 </body>
</html>
<?php mysqli_close($conn); ?>
