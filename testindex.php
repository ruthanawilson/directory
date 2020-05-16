
<?php 
  include('config/db_connect.php');
  $sql = 'SELECT thesisST, reasonST, ruleST, supportMeans, claimID FROM claimsdb';
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


  
  <?php include('templates/header.php'); ?>

  <br>
  </center>


  <!-- begin of foreach --> 
  <div class="container">
    <div class="row">
      <center>
      <?php  /*foreach($claimsdb as $claimsdb): ?>

        <div class="col s6 m4">
          <div class="card z-depth-0">
            <div class="card-content center">
                <br><br>
               <?php  // $sql = 'SELECT thesisST, reasonST, ruleST, supportMeans, claimID FROM claimsdb WHERE topic = personhood'; ?> 
  <?php echo htmlspecialchars('Thesis statement: ' . $claimsdb['thesisST']);
      echo nl2br("\r\n");
      echo htmlspecialchars('Support Means : ' . $claimsdb['supportMeans']);
// if they aren't flagging anything, top row. 
// if those claims from the top row are being flagged, second row, break between claim changes, display those flaws.
// ------------- new theory


// parse through each claim & display. for each: is it being flagged? display that flag. is that being flagged? display. is that being flagged? display. 
// ----------- maybe a recursive function with sql queries? if claim isnt flagging, look for all flagging statements for that inference and display. if result > 1, run queries for those x flags until 0.      



/*orderclaims($claimsdb['claimID']);

function orderclaims($claimid)
{  //  claimidflagger must equal null
        
// find flagged
        $order = "SELECT claimID from claimsdb, flagsdb
        WHERE claimsdb.$claimid = flagsdb.claimIDFlagged 
        ORDER BY claimID DESC LIMIT 1";
//found the value - display it
         $nice = mysqli_query($conn, $order);
        if($row = $nice->fetch_assoc()) {
      $next = $row['claimID']; }
// before functions finished, it runs the value and checks it again
      if($next != NULL){
      orderclaims($next); }
      echo $next;
}     
    */
// direction after completing this.. make banner, design add page. 
// troubleshoot more minor errors by using it more. 
// potentially adding user notes for claim submissions
// pushing to 000webhost or potential KSU webhost

// note - if having a rival, it should be on the same line (should also be red)
   /* ?>

<div class="card-action right-align">
<a class="brand-text" href="details.php?id=<?php echo $claimsdb['claimID']?>" style="color:#fff;">details</a>
                 </div>
   
            </div>
          </div>
        </div>

      <?php endforeach; 


    </div>
  </div>*/



      #-------------------------------------------------------------------------?>
  <!-- end of foreach --> 





<?php
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

      // -------------- function below



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
?>
  <ul> <li> <label for="<?php $claimid ?>"> <?php echo $claimid; ?></label><input id="<?php $claimid ?>" type="checkbox">
      <ul> <span class="more">&hellip;</span>

<?php
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
?>

  <ul> <li> <label for="item1">1</label><input id="item1" type="checkbox">
      
  <ul> <span class="more">&hellip;</span>
      
  <li><label for="item1.1">1.1</label><input id="item1.1" type="checkbox"></li>
                <li><label for="item1.2">1.2</label><input id="item1.2" type="checkbox"></li>
              </ul>
            </li>
            <li><label for="item2">2</label><input id="item2" type="checkbox">
              <ul>
                <span class="more">&hellip;</span>
                <li> <label for="item2.1">2.1</label><input id="item2.1" type="checkbox">
                  <ul>
                    <span class="more">&hellip;</span>
                    <li>
                      <label for="item2.1.1">2.1.1</label><input id="item2.1.1" type="checkbox">
                      <ul>
                        <span class="more">&hellip;</span>
                        <li><label for="item2.1.1.1">2.1.1.1</label><input id="item2.1.1.1" type="checkbox"></li>
                      
                      </ul>
                    </li>
                  </ul>
                </li>
                <li><label for="item2.2">2.2</label><input id="item2.2" type="checkbox"></li>
              </ul>
             </li>
 

               </ul>
             </li>
        </ul>
      </li>
    </ul>
</div>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script><script  src="./script.js"></script>
 <!-- <?php include('templates/footer.php'); ?> -->
</body>
</html>
<?php mysqli_close($conn); ?>
