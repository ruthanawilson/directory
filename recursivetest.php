
<?php 
  include('config/db_connect.php');
  $sql = 'SELECT thesisST, reasonST, ruleST, supportMeans, claimID FROM claimsdb';
  // get the result set (set of rows)
  $result = mysqli_query($conn, $sql);
  // fetch the resulting rows as an array // was $result
  $cdb = mysqli_fetch_all($result, MYSQLI_ASSOC);
  
  

foreach($cdb as $cdb): ?>

        <div class="col s6 m4">
          <div class="card z-depth-0">
            <div class="card-content center">
                <br><br>
               <?php  // $sql = 'SELECT thesisST, reasonST, ruleST, supportMeans, claimID FROM claimsdb WHERE topic = personhood'; ?> 
  <?php echo htmlspecialchars('Thesis statement: ' . $cdb['thesisST']);
      echo nl2br("\r\n");
      echo htmlspecialchars('Claimid : ' . $cdb['claimID']);

 endforeach;      
/*orderclaims($claimsdb['claimID']);

function orderclaims($claimid)
{ */
 echo nl2br("\r\n");
echo "------------------------QUERY TESTING---------------------------------";
echo nl2br("\r\n");     

 $order1 = "SELECT DISTINCT claimID
        from claimsdb, flagsdb
        WHERE claimID NOT IN (SELECT DISTINCT claimIDFlagger FROM flagsdb)
        ";

         $nice2 = mysqli_query($conn, $order1);

$numhits2 = mysqli_num_rows($nice2);

 $arrflagger = Array();
echo nl2br("\r\n");
      echo "Everthing below is a result from the recursion";
      echo nl2br("\r\n");
 while($row = $nice2->fetch_assoc()) {
          $arrflagger[] = $row['claimID'];
      sortclaims($row['claimID']);

        }
        echo "Recursion finished";
 echo nl2br("\r\n");


echo "------------------------QUERY TESTING---------------------------------";
echo nl2br("\r\n");
print "Your search yielded $numhits2 results for root claims. Results below.";
for($i = 0; $i<$numhits2; $i++)
{

 echo nl2br("\r\n");
echo $arrflagger[$i];
  $tester = $arrflagger[3];

}
echo nl2br("\r\n");
  echo "The test subject:";
  echo nl2br("\r\n");
  echo $tester;

  echo nl2br("\r\n");
  echo "Test subject^^";
     // if($next != NULL){
      //orderclaims($next); }
      //echo $next;
// }   




function sortclaims($claimid)
{

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
echo $claimid;
echo nl2br("\r\n");
while($user = $result1->fetch_assoc())
{
 if($numhits1 == 0)
  {
   // echo $claimid . "hello?";
   echo nl2br("\r\n");
 }
   
   else { sortclaims($user['claimIDFlagger']); }
    

} // end while loop

} // end of function

// starting --------------------------- 
  echo nl2br("\r\n");
echo "------------------------QUERY TESTING---------------------------------";
echo nl2br("\r\n");   
echo nl2br("\r\n");

/*$stmt = $dbh->prepare("SELECT DISTINCT claimIDFlagger
        from claimsdb, flagsdb
        WHERE :tester IN (SELECT DISTINCT claimIDFlagged FROM flagsdb)");
$stmt->bindParam(':tester', $tester);
$stmt->execute();
*/

 $sql = "SELECT DISTINCT claimIDFlagger
        from claimsdb, flagsdb
        WHERE ? = claimIDFlagged"; // SQL with parameters
$stmt = $conn->prepare($sql); 
$stmt->bind_param("i", $tester);
$stmt->execute();
$result = $stmt->get_result(); // get the mysqli result
$numhits = mysqli_num_rows($result);
 print "Your search yielded $numhits results for matching a single claim to the claims flagging it. Results below. ";
 echo nl2br("\r\n");
while($user = $result->fetch_assoc())
{

echo $user['claimIDFlagger'];
echo nl2br("\r\n");
} // fetch data  




 echo nl2br("\r\n");
  
  //$arr = Array();

 //while($row = $nice->fetch_assoc()) {
   //       $arr[] = $row['claimIDFlagger'];

 //     $next = $row['claimID']; 
     //   }


 echo nl2br("\r\n");

/*for($i = 0; $i<$numhits; $i++)
{

 echo nl2br("\r\n");
echo $arr[$i];
  
}*/
     // if($next != NULL){
      //orderclaims($next); }
      //echo $next;
// }   




/// SPECIFIC INSTANCE
/* (inside recursive function)
 $order4 = "SELECT DISTINCT claimIDFlagger
        from claimsdb, flagsdb
        WHERE '".$tester."'  IN (SELECT DISTINCT claimIDFlagger FROM flagsdb)";

         $nice3 = mysqli_query($conn, $order4);

$numhits3 = mysqli_num_rows($nice3);
print "Your search yielded $numhits2 results";

 echo nl2br("\r\n");

 $arrflagged = Array();

 while($row = $nice3->fetch_assoc()) {
          $arrflagged[] = $row['claimIDFlagger'];

 //     $next = $row['claimID']; 
        }

 echo nl2br("\r\n");
echo "SPACE";
 echo nl2br("\r\n");

for($i = 0; $i<$numhits3; $i++)
{

 echo nl2br("\r\n");
echo $arrflagged[$i];
  
}


//END OF SPECIFIC INSTANCE
*/
?>