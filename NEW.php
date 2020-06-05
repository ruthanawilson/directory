
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










/*
 OR flagType LIKE 'thesisRival'
 $order1 = "SELECT DISTINCT claimID
        from claimsdb, flagsdb 
             IF (claimID NOT IN (SELECT DISTINCT claimIDFlagger FROM flagsdb))
BEGIN
   SELECT DISTINCT claimID
        from claimsdb, flagsdb 
END

ELSE IF (flagType LIKE 'thesisRival')
BEGIN
   SELECT DISTINCT claimID
        from claimsdb, flagsdb END
ELSE 
BEGIN
   PRINT 'none'
END
        ";*/
        //this code finds ALL claims that are not flaggers (all root claims)
$root1 = "SELECT DISTINCT claimID
        from claimsdb, flagsdb 
            WHERE claimID NOT IN (SELECT DISTINCT claimIDFlagger FROM flagsdb)
        "; // SQL with parameters
$stmt5 = $conn->prepare($root1); 
$stmt5->execute();
$rootresult1 = $stmt5->get_result(); // get the mysqli result
$numhitsroot = mysqli_num_rows($rootresult1);

 while($root = $rootresult1->fetch_assoc())
  {
         sortclaims($root['claimID']);
  }




$root2 = "SELECT DISTINCT claimIDFlagger
        from flagsdb 
            WHERE isRootRival = 1;
        "; // SQL with parameters
$stmt12 = $conn->prepare($root2); 
$stmt12->execute();
$rootresult2 = $stmt12->get_result(); // get the mysqli result
$numhitsroot2 = mysqli_num_rows($rootresult2);

while($root2 = $rootresult2->fetch_assoc())
  { 
         sortclaimsRIVAL($root2['claimIDFlagger']);
       //  echo "RIVAL";
  }
/*
// ------------------above is new

        // this code finds ALL flags that are thesisRival
$root2 = "SELECT DISTINCT claimIDFlagger
        from claimsdb, flagsdb
        where flagType LIKE 'thesisRival'
        "; 
$stmt6 = $conn->prepare($root2); 
$stmt6->execute();
$rootresult2 = $stmt6->get_result(); // get the mysqli result
$numhitsroot2 = mysqli_num_rows($rootresult2);
echo 'first check' . $numhitsroot2;

  // this finds our answers to the second query, and passes them through 'rivalrootcheck'
 while($answer = $rootresult2->fetch_assoc())
  {
    echo nl2br(" \r\n-------------------------\r\n");
    echo $answer['claimIDFlagger'] . '<--';
    echo nl2br("\r\n");
    rivalRootCheck($answer['claimIDFlagger']);
  }

  // this is the rivalrootcheck, a function that repeats the code inside of it
function rivalRootCheck($claimid)
{
  include('config/db_connect.php');

        // this code finds all the FLAGGED claims (counterrivals) from each of the rival flaggers we found in the above query.
  $rivalroot = "SELECT DISTINCT claimIDFlagged 
  from claimsdb, flagsdb 
  where claimIDFlagger = ? AND EXISTS (SELECT claimIDFlagged from flagsdb)
        "; 
$stmt7 = $conn->prepare($rivalroot); 
$stmt7->bind_param("i", $claimid);
$stmt7->execute();
$rootresult3 = $stmt7->get_result(); // get the mysqli result
$numhitsroot3 = mysqli_num_rows($rootresult3);  
      echo nl2br("\r\n");
      //this displays how many counterrivals (flags) there are.. there can be more than one since a rival flag can also be flagging another claim (i.e, its not a root)
echo 'result...' . $numhitsroot3;
      echo nl2br("\r\n");


//this function should check all the answers, find if the counterrivaling flags have rivals, and if they don't..  
// should i just make another column to indicate if its a root rival????? 
// simple - if rivaling, & if a root, then root rival = true.  
       while($a = $rootresult3->fetch_assoc())
  {
   // echo $numhitsroots3 . 'HELLO';
    echo nl2br("\r\n");
    echo $a['claimIDFlagged'] . '<-- INSIDE ';
    echo nl2br("\r\n");
//if inside's has more than 2, then don't display.
    /* --------- if($numhitsroots3 == 2 )
    {
      echo 'NEW RESULTS!';

$rival2root = "SELECT DISTINCT claimIDFlagged 
  from claimsdb, flagsdb 
  where claimIDFlagger = ? AND EXISTS (SELECT claimIDFlagged from flagsdb)

        "; 
$stmt8 = $conn->prepare($rival2root); 
$stmt8->bind_param("i", $a['claimIDFlagged']);
$stmt8->execute();
$rootresult4 = $stmt8->get_result(); // get the mysqli result
$numhitsroot4 = mysqli_num_rows($rootresult4);  



    } // end of if statement -------- 
  }

}
*/
// ---------------------------- ALL CODE ABOVE THIS IS JUST FOR THE ROOT RIVALS! 

/*
  while($root = $rootresult1->fetch_assoc())
  {
                if ($numhitsroot2 != 0)
                {
      while($root2 = $rootresult2->fetch_assoc())
      {


sortclaimsRival($root2['claimIDFlagger']);
      // for THIS claimid - check for flaggers that aren't rival .. sort claim those
      sortclaimsRival($root2['claimIDFlagged']);

}
                }


         sortclaims($root['claimID']);
  }



$order2 = "SELECT DISTINCT claimID
        from claimsdb, flagsdb 
            WHERE IF flagtype = thesisRival
            ";

         $nice2 = mysqli_query($conn, $order1);

$numhits2 = mysqli_num_rows($nice2);

 
      echo nl2br("\r\n");
   //   echo "Everthing below is a result from the recursion";
      echo nl2br("\r\n");

$i = -1;
$arrflagtype = Array();


 while($row = $nice2->fetch_assoc()) {
   
        }
//        echo "Recursion finished";


      // -------------- function below

*/
function sortclaimsRIVAL($claimid)
{

include('config/db_connect.php');
  $sql1 = "SELECT DISTINCT claimIDFlagger
        from claimsdb, flagsdb
        where ? = claimIDFlagged AND flagType NOT LIKE 'thesisRival'
         
        "; // SQL with parameters
$stmt1 = $conn->prepare($sql1); 
$stmt1->bind_param("i", $claimid);
$stmt1->execute();
$result1 = $stmt1->get_result(); // get the mysqli result
$numhits1 = mysqli_num_rows($result1);
//echo $numhits1;
?>

<!-- <label> -->
  <li> <label for="<?php echo $claimid; ?>"><?php 
 echo $claimid . "  <u> RIVAL </u> ";?>
<!-- <a class="brand-text" style=" color : #fff;" href ="add.php">Link</a> -->
 </label><input id="<?php echo $claimid; ?>" type="checkbox">
      <ul> <span class="more">&hellip;</span>
<!-- </label> -->
<?php

while($user = $result1->fetch_assoc())
{

 if($numhits1 == 0)
  { }
   else { sortclaims($user['claimIDFlagger']); }
    

} // end while loop

?></ul><?php

} // end of rivalfunction




function sortclaims($claimid)
{

include('config/db_connect.php');
  $sql1 = "SELECT DISTINCT claimIDFlagger
        from claimsdb, flagsdb
        WHERE ? = claimIDFlagged AND flagType NOT LIKE 'thesisRival'"; // SQL with parameters
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

$flag = "SELECT DISTINCT flagType, claimIDFlagger, claimIDFlagged
        from flagsdb
        WHERE ? = claimIDFlagger"; // SQL with parameters
$stmt4 = $conn->prepare($flag); 
$stmt4->bind_param("i", $claimid);
$stmt4->execute();
$result2 = $stmt4->get_result(); // get the mysqli result
$numhitsflag = mysqli_num_rows($result2);
//echo $i;
//if($i > -1)
//{
//echo $arrflagtype[$i-1];
//}

?>


  <li> <label for="<?php echo $claimid; ?>"><?php 

/* if( active = 1 for this $claimid)
{ font = green; }
else
  font = yellow;

  ... <font = $font>

  query = where claimid = claimidflagged 
  if active =1
  claim id active set = 0; 

  // unless the case of NULL*/
 echo $claimid . "    ";?>
<!-- <a class="brand-text" style=" color : #fff;" href ="add.php">Link</a> -->
 </label><input id="<?php echo $claimid; ?>" type="checkbox">
      <ul> <span class="more">&hellip;</span>




<?php


  while($flagge = $result2->fetch_assoc())
  {

 if($flagge['flagType'] == "thesisRival")
      {
      echo nl2br("\r\n");
      echo "RIVAL";
      echo nl2br("\r\n");
      sortclaimsRival($flagge['claimIDFlagger']);
      // for THIS claimid - check for flaggers that aren't rival .. sort claim those
      sortclaimsRival($flagge['claimIDFlagged']);
      // for the CORRESPONDING claimid - check for flaggers that aren't rival .. sort claim those.
      }
  }

//echo $claimid;
  //    echo nl2br("\r\n");

// echo $claimid;
// 1. rival as active - brainstorm first
// 2. fixing more dropdowns details in tree diagram
// 3. incorparate details of popup

while($user = $result1->fetch_assoc())
{
 if($numhits1 == 0)
  { }
   
   else { sortclaims($user['claimIDFlagger']); }
    
} // end while loop

?></ul><?php
} // end of function
?>

<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script><script  src="./script.js"></script>
 </body>
</html>
<?php mysqli_close($conn); ?>
