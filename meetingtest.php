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
         CLAIMS<br>
<a class="brand-text" href="add.php" style=" color : #fff;">Add Claim</a>


         <!-- partial:index.partial.html -->

  <br>
  </center>


  <!-- begin of foreach --> 
  <div class="container">
    <div class="row">
      <center>
      <?php  

// direction after completing this.. make banner, design add page. 
// troubleshoot more minor errors by using it more. 
// potentially adding user notes for claim submissions
// pushing to 000webhost or potential KSU webhost

// note - if having a rival, it should be on the same line (should also be red)

      #-------------------------------------------------------------------------

 $order1 = "SELECT DISTINCT claimID
        from claimsdb, flagsdb
        WHERE claimID NOT IN (SELECT DISTINCT claimIDFlagger FROM flagsdb) 
        ";

         $nice2 = mysqli_query($conn, $order1);

$numhits2 = mysqli_num_rows($nice2);

 
      echo nl2br("\r\n");
   //   echo "Everthing below is a result from the recursion";
      echo nl2br("\r\n");

$i = -1;
$arrflagtype = Array();


 while($row = $nice2->fetch_assoc()) {
      sortclaims($row['claimID']);
        }
//        echo "Recursion finished";


      // -------------- function below



function sortclaims($claimid)
{
  global $i;
include('config/db_connect.php');
  $sql1 = "SELECT DISTINCT claimIDFlagger
        from claimsdb, flagsdb
        WHERE ? = claimIDFlagged"; // SQL with parameters
$stmt1 = $conn->prepare($sql1); 
$stmt1->bind_param("i", $claimid);
$stmt1->execute();
$result1 = $stmt1->get_result(); // get the mysqli result
$numhits1 = mysqli_num_rows($result1);
//echo $numhits1;
?>

<?php // if flagType = 'thesisRival' then just echo the claim.. without formatting 
//echo '420';
//echo $user['flagType'];


   // echo $user['flagType'];

$flag = "SELECT DISTINCT flagType
        from flagsdb
        WHERE ? = claimIDFlagger"; // SQL with parameters
$stmt4 = $conn->prepare($flag); 
$stmt4->bind_param("i", $claimid);
$stmt4->execute();
$result2 = $stmt4->get_result(); // get the mysqli result

//echo $i;
//if($i > -1)
//{
//echo $arrflagtype[$i-1];
//}

?>


  <li> <label for="<?php echo $claimid; ?>"><?php 


 echo $claimid . "    ";?>
<a class="brand-text" style=" color : #fff;" href ="add.php">Link</a>
 </label><input id="<?php echo $claimid; ?>" type="checkbox">
      <ul> <span class="more">&hellip;</span>

        
<?php
while($flagge = $result2->fetch_assoc())
{
 
      echo nl2br("\r\n");
echo $flagge['flagType'];
      echo nl2br("\r\n");
echo $claimid;
      echo nl2br("\r\n");
}
// echo $claimid;
// 1. rival as active - brainstorm first
// 2. fixing more dropdowns details in tree diagram
// 3. incorparate details of popup

while($user = $result1->fetch_assoc())
{

 if($numhits1 == 0)
  {
   // echo $claimid . "hello?";
  
 }
   
   else { 
   // $arrflagtype[] = $user['flagType'];
    // $i=$i+1;
    
    sortclaims($user['claimIDFlagger']);
    
     }
    

} // end while loop

?></ul><?php
} // end of function
?>

<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script><script  src="./script.js"></script>
 </body>
</html>
<?php mysqli_close($conn); ?>