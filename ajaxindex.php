
<?php 

  include('config/db_connect.php');
  $sql = 'SELECT thesisST, reasonST, ruleST, supportMeans, subject, targetP, claimID FROM claimsdb';
  // get the result set (set of rows)
  $result = mysqli_query($conn, $sql);
  // fetch the resulting rows as an array // was $result
  $claimsdb = mysqli_fetch_all($result, MYSQLI_ASSOC);
  
  // close connection
 

?>

  <link rel="stylesheet" href="./style.css"> 


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>








<div class="wrapper">
    <ul>
      <li class="noline">

<?php include('templates/header.php');
?>


<BR><BR>
         CLAIMS
          <br>
<a class="brand-text" href="add.php" style=" color : #fff;">Add New Claim</a><br><br>






Claims displayed as a <font color = "seagreen"> green font </font> mean that they are currently active. <br> Claims displayed as a <font color = "#FFFF99"> yellow font </font> mean that the are currently inactive. <br>




         <!-- partial:index.partial.html -->

  <br>
  </center>

<center>
      <?php   //changing the centers above is a fun change

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






function sortclaimsRIVAL($claimid)
{
 restoreactivity($claimid);
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
// THIS IS SIMPLY FOR DISPLAY OF SUBJECT/TARGETP BELOW

$dis = "SELECT DISTINCT subject, targetP, active
        from claimsdb
        where ? = claimID
         
        "; // SQL with parameters
$st = $conn->prepare($dis); 
$st->bind_param("i", $claimid);
$st->execute();
$disp = $st->get_result(); // get the mysqli result


// SIMPLY FOR DISPLAY ABOVE THIS POINT

?>


 <li> <label for="<?php echo $claimid; ?>"><?php 
while($d = $disp->fetch_assoc())
{
  // FONT CHANGING
 if($d['active'] == 1)
{ $font = 'seagreen';

 }
else {
  $font = '#FFFF99'; } ?>

<font color = "<?php echo $font; ?>"> 
<?php    // END FONT CHANGING


/*?><h2>Let the borders collapse:</h2>

<table>
  <tr>
    <th>Firstname</th>
  </tr> </table>
<?php
*/
 echo $claimid;
echo "RIVALS";
echo nl2br("\r\n");      
  ?>  <div class='a'> <?php

  echo $d['subject'] . ' ';
// echo nl2br("\r\n");
  echo $d['targetP'];


/*  $subject = wordwrap($d['subject'], 8, "\n", true);
$targetP = wordwrap($d['targetP'], 8, "\n", true);
  echo $subject;
  echo $targetP;*/
/// ------------------------------------------------------------------- BELOW is modal code
  ?> </div> <?php 
createModal($claimid);
  /// ------------------------- ABOVE is modal code

}


 ?>

<!-- <a class="brand-text" style=" color : #fff;" href ="add.php">Link</a> -->
 </label><input id="<?php echo $claimid; ?>" type="checkbox">
      <ul> <span class="more">&hellip;</span>



<?php

while($user = $result1->fetch_assoc())
{

 if($numhits1 == 0)
  { }
   else { sortclaims($user['claimIDFlagger']); }
    

} // end while loop

?></ul><?php

} // end of rivalfunction









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


    
  //    echo nl2br("\r\n");
    //  echo $activestatus['claimIDFlagger'];
      //echo nl2br("\r\n");

$everyInactive = 'true';
//echo $everyInactive;
  while($r = $res->fetch_assoc())
  {  
    
    if($r['active'] == 1)
    {
      global $everyInactive;
      $everyInactive = 'false';
  //    echo $everyInactive;
      $act = "UPDATE claimsdb 
SET active = 0
WHERE claimID = ? 
"; // SQL with parameters
$upd = $conn->prepare($act); 
$upd->bind_param("i", $claimid);
$upd->execute();
    }
  }


  if($everyInactive == 'true')
  {
  
//echo "ANSWER" . $everyInactive;
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

function createModal($claimid)
{

    // Check if user has requested to get detail
    if (isset($_POST["get_data"]))
    {
        // Get the ID of customer user has selected
        $id = $_POST["id"];

         include('config/db_connect.php');

        // Getting specific customer's detail
        $sql = "SELECT * FROM claimsdb WHERE claimID='$id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_object($result);

        // Important to echo the record in JSON format
        echo json_encode($row);

        // Important to stop further executing the script on AJAX by following line
        exit();
    }

    // Connecting with database and executing query
    include('config/db_connect.php');
     $sql = "SELECT * FROM claimsdb WHERE claimID = '$claimid'";
    $result = mysqli_query($conn, $sql);
?>

<!-- Include bootstrap & jQuery 
<link rel="stylesheet" href="bootstrap.css" />-->
<script src="jquery-3.3.1.min.js"></script> 
<script src="bootstrap.js"></script>

<!-- Creating table heading -->
<div class="container">
  
  
        <!-- Display dynamic records from database -->
        <?php while ($row = mysqli_fetch_object($result)) { ?>
            <button class = "btn btn-primary" onclick="loadData(this.getAttribute('data-id'));" data-id="<?php echo $row->claimID; ?>">
                Details
            </button>
        <?php } ?>
  
</div>

<script>
    function loadData(id) {
        console.log(id);
        $.ajax({
            url: "adnanindex.php",
            method: "POST",
            data: {get_data: 1, id: id},
            success: function (response) {
                response = JSON.parse(response);
                console.log(response);
                var html = "";

                // Displaying city
//                html += "<div class='row'>";
 //                   html += "<div class='col-md-6'></div>";
                    html += "<div class='col-md-6'>" + "Support Means: " + response.supportMeans + "<BR> ClaimID: " + response.claimID + "</div><BR>";

                if(response.supportMeans == 'Testimony')
                {
                  html += "<BR> Subject: " + response.subject + "<BR> Target Property: " + response.targetP + "URL: " + response.URL + " <BR> Research doc: " + response.rd;
                }

                if(response.supportMeans == 'Perception')
                {
                 html += "<BR> Subject: " + response.subject + "<BR> Target Property: " + response.targetP + "Summary: " + response.summary;
                }
                
                if(response.supportMeans == 'Inference')
                {
                  html += "Thesis: " + response.thesisST + " <BR> Reason: " + response.reasonST + "<BR> Rule & Example: " + response.ruleST;
               
                }

                html += " <BR> <a href=\"details.php?id=" + response.claimID + "\" class = \"button\">  FLAG THIS CLAIM! </a> </div>";

                // add author as additional column "Source/Name"
                // combine summary/descrption
                // for perception: description, the url, 
                //subject targetp on details page not just popup
                // And now assign this HTML layout in pop-up body
                $("#modal-body").html(html);

                $("#myModal").modal();



            }
        });
    }
</script>

<!-- Modal -->
<div class = "modal fade" id = "myModal" tabindex = "-1" role = "dialog" aria-hidden = "true">
   
   <div class = "modal-dialog">
      <div class = "modal-content">
         
         <div class = "modal-header">
            <h4 class = "modal-title">
               Claims Details
            </h4>

<!--            <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
               ×
            </button> -->
         </div>
         
         <div id = "modal-body">
            Press ESC button to exit.

            response.claimID
         </div>
         
         <div class = "modal-footer">
           <!-- <button type = "button" class = "btn btn-default" data-dismiss = "modal">
               OK
            </button> -->
         </div>
         
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
   
</div><!-- /.modal -->



<?php

} 

function sortclaims($claimid)
{
 restoreactivity($claimid);

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

$flag = "SELECT DISTINCT flagType, claimIDFlagger, claimIDFlagged
        from flagsdb
        WHERE ? = claimIDFlagger"; // SQL with parameters
$stmt4 = $conn->prepare($flag); 
$stmt4->bind_param("i", $claimid);
$stmt4->execute();
$result2 = $stmt4->get_result(); // get the mysqli result
$numhitsflag = mysqli_num_rows($result2);

// THIS IS SIMPLY FOR DISPLAY OF SUBJECT/TARGETP BELOW

$dis = "SELECT DISTINCT subject, targetP, active
        from claimsdb
        where ? = claimID
         
        "; // SQL with parameters
$st = $conn->prepare($dis); 
$st->bind_param("i", $claimid);
$st->execute();
$disp = $st->get_result(); // get the mysqli result


// SIMPLY FOR DISPLAY ABOVE THIS POINT

?>

  <li> <label for="<?php echo $claimid; ?>"><?php 
while($d = $disp->fetch_assoc())
{
  // FONT CHANGING
 if($d['active'] == 1)
{ $font = 'seagreen';

 }
else {
  $font = '#FFFF99'; } ?>

<font color = "<?php echo $font; ?>"> 
<?php    // END FONT CHANGING


/*?><h2>Let the borders collapse:</h2>

<table>
  <tr>
    <th>Firstname</th>
  </tr> </table>
<?php
*/
 echo $claimid;

echo nl2br("\r\n");      
  ?>  <div class='a'> <?php

  echo $d['subject'] . ' ';
// echo nl2br("\r\n");
  echo $d['targetP'];


/*  $subject = wordwrap($d['subject'], 8, "\n", true);
$targetP = wordwrap($d['targetP'], 8, "\n", true);
  echo $subject;
  echo $targetP;*/
/// ------------------------------------------------------------------- BELOW is modal code
  ?> </div> <?php 
createModal($claimid);
  /// ------------------------- ABOVE is modal code

}


 ?>

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


while($user = $result1->fetch_assoc())
{
 if($numhits1 == 0)
  { }
   
   else { sortclaims($user['claimIDFlagger']); }
    
} // end while loop
restoreactivity($claimid);
?></ul><?php
} // end of function
//account for null instances in the active/inactive setting and updating algorithm 
// reimpleplement recursion independently for active/inactive
// reexamine root rivals and troubleshoot multiple instances of it

//input by topic and filter through unique urls
//add recursion to activity function
//validate all inputs for injection
?>





<!-- partial 
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
  <script  src="./script.js"></script>-->
 </body>
</html>
<?php mysqli_close($conn); ?>
