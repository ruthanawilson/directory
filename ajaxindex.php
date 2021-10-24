<?php include('config/db_connect.php');
include('templates/header.php');?>
<!--<meta property="fb:app_id" content="910800136088440" /> -->

<link rel="stylesheet" href="./style.css"> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!--
  //support or flag instead of add -->
  <?php  
  if(isset($_GET['topic'])){
   $topic = mysqli_real_escape_string($conn, $_GET['topic']); 
 } //end isset check ?>


 <div class="wrapper">
  <ul>
    <li class="noline">
      <BR><BR>

      <a class="brand-text" href="add.php?topic=<?php echo $topic?>">Add New Claim</a><br><br>
      <h3>TOPIC: <?php echo $topic; ?> <BR> </h3>

    </center>
    <center>
      <?php 



        //changing the centers above is a fun change
        //this code finds ALL claims that are not flaggers (all root claims)
      $root12 = "SELECT DISTINCT claimID
      from claimsdb, flagsdb 
      WHERE claimID NOT IN (SELECT DISTINCT claimIDFlagger FROM flagsdb) AND topic = ?
        "; // SQL with parameters
        $stmt52 = $conn->prepare($root12);
        $stmt52->bind_param("s", $topic);
        $stmt52->execute();
$rootresult12 = $stmt52->get_result(); // get the mysqli result
$numhitsroot = mysqli_num_rows($rootresult12);
while($root2 = $rootresult12->fetch_assoc())
{
 sortclaims($root2['claimID']);

}


$root1 = "SELECT DISTINCT claimID
from claimsdb, flagsdb 
WHERE claimID NOT IN (SELECT DISTINCT claimIDFlagger FROM flagsdb) AND topic = ?
        "; // SQL with parameters
        $stmt5 = $conn->prepare($root1); 
        $stmt5->bind_param("s", $topic);
        $stmt5->execute();
$rootresult1 = $stmt5->get_result(); // get the mysqli result
$numhitsroot = mysqli_num_rows($rootresult1);

while($root = $rootresult1->fetch_assoc())
{
 restoreActivity($root['claimID']);
}






$root2 = "SELECT DISTINCT claimIDFlagger
from flagsdb 
WHERE isRootRival = 1
        "; // SQL with parameters
        $stmt12 = $conn->prepare($root2); 
// $stmt12->bind_param("s", $topic);
        $stmt12->execute();
$rootresult2 = $stmt12->get_result(); // get the mysqli result
$numhitsroot28 = mysqli_num_rows($rootresult2);



while($root2 = $rootresult2->fetch_assoc())
{   
  if($numhitsroot28 > 0)
  {

    $r = "SELECT DISTINCT claimID, topic
    from claimsdb 
    WHERE claimID = ?
        "; // SQL with parameters
        $s = $conn->prepare($r); 
        $s->bind_param("i", $root2['claimIDFlagger']);
        $s->execute();
$rres = $s->get_result(); // get the mysqli result

while($results = $rres->fetch_assoc())
{
  if($results['topic'] == $topic)
       { restoreActivityRIVAL($results['claimID']); } // end of if topic = topic

      } // end of while

    } //end of if numhits

  } // end of while





// leafy tests below


$root2 = "SELECT DISTINCT claimIDFlagger
from flagsdb 
WHERE flagType LIKE 'Thesis Rival'
        "; // SQL with parameters
        $stmt12 = $conn->prepare($root2); 
// $stmt12->bind_param("s", $topic);
        $stmt12->execute();
$rootresult2 = $stmt12->get_result(); // get the mysqli result
$numhitsroot28 = mysqli_num_rows($rootresult2);



while($root2 = $rootresult2->fetch_assoc())
{   
  if($numhitsroot28 > 0)
  {

    $r = "SELECT DISTINCT claimID, topic
    from claimsdb 
    WHERE claimID = ?
        "; // SQL with parameters
        $s = $conn->prepare($r); 
        $s->bind_param("i", $root2['claimIDFlagger']);
        $s->execute();
$rres = $s->get_result(); // get the mysqli result

while($results = $rres->fetch_assoc())
{
  if($results['topic'] == $topic)
       { restoreActivityRIVAL($results['claimID']); } // end of if topic = topic

      } // end of while

    } //end of if numhits

  } // end of while



//leafy tests above




  $root22 = "SELECT DISTINCT claimIDFlagger
  from flagsdb 
  WHERE isRootRival = 1
        "; // SQL with parameters
        $stmt122 = $conn->prepare($root22); 
// $stmt122->bind_param("s", $topic);
        $stmt122->execute();
$rootresult22 = $stmt122->get_result(); // get the mysqli result
$numhitsroot29 = mysqli_num_rows($rootresult22);



while($root22 = $rootresult22->fetch_assoc())
{   
  if($numhitsroot29 > 0)
  {

    $r2 = "SELECT DISTINCT claimID, topic
    from claimsdb 
    WHERE claimID = ?
        "; // SQL with parameters
        $s2 = $conn->prepare($r2); 
        $s2->bind_param("i", $root22['claimIDFlagger']);
        $s2->execute();
$rres2 = $s2->get_result(); // get the mysqli result

while($results2 = $rres2->fetch_assoc())
{
  if($results2['topic'] == $topic)
       { sortclaimsRIVAL($results2['claimID']); } // end of if topic = topic

      } // end of while

    } //end of if numhits

  } // end of while

//duplicate

//starts two chains of recursion. one with normal root claims. the other with root rivals. the rivals, of course, are put into the rival recursion.

  function sortclaims($claimid)
  {

    include('config/db_connect.php');

// THIS IS SIMPLY FOR DISPLAY OF SUBJECT/TARGETP BELOW

    $dis = "SELECT DISTINCT subject, targetP, active, supportMeans, reason, example, citation
    from claimsdb
    where ? = claimID

        "; // SQL with parameters
        $st = $conn->prepare($dis); 
        $st->bind_param("i", $claimid);
        $st->execute();
$disp = $st->get_result(); // get the mysqli result


// SIMPLY FOR DISPLAY ABOVE THIS POINT



//below is for rivals
$flag = "SELECT DISTINCT flagType, claimIDFlagger, claimIDFlagged
from flagsdb
        WHERE ? = claimIDFlagger"; // SQL with parameters
        $stmt4 = $conn->prepare($flag); 
        $stmt4->bind_param("i", $claimid);
        $stmt4->execute();
$result2 = $stmt4->get_result(); // get the mysqli result
$numhitsflag = mysqli_num_rows($result2);
//IF THIS CLAIM IS A FLAGGER this obtains the FLAGGER'S flagtype's and flagged. 
//this is to find rival claims..this is literally JUST used for rivals. 
//rivals have to be flaggers and flagged. 


$resultFlagType = $r = $d = '';
while($flagge = $result2->fetch_assoc())
{
  $resultFlagType = $flagge['flagType'];
  $r = $flagge['claimIDFlagger'];

  $d = $flagge['claimIDFlagged'];
}
//above is for rivals



if($resultFlagType == "Thesis Rival")
{
  echo " <br> The flag " . $r . " has a rival!: " . "<br>";
      //ECHO "START 1";
  sortclaimsRival($r);
      //ECHO "END 1";
      // for THIS claimid - check for flaggers that aren't rival .. sort claim those

      //ECHO "START 2";
  sortclaimsRival($d);
      //ECHO "END 2";
      // for the CORRESPONDING claimid - check for flaggers that aren't rival .. sort claim those.
}
else {

  ?>
  <li> <label for="<?php echo $claimid; ?>"><?php 
  while($d = $disp->fetch_assoc())
  {



    if($resultFlagType == "supporting")
    {
      echo "<img height = '45' width = '32' src='https://i.imgur.com/JCHZjr3.png'> <br>";
      echo $d['supportMeans'] . "<br>"; 
      if($d['supportMeans'] == "Inference")
        { echo "Reason: " . $d['subject'] . " " . $d['reason'] . ", as in the case of " . $d['example'] . "<BR>";
      
    }

    if($d['supportMeans'] == "Testimony" || $d['supportMeans'] == "Perception")
      { echo "Citation: " . $d['citation'] . "<BR>";

  } 
}
elseif($resultFlagType == '')
  { echo "<h1>Thesis</h1>";  echo "<br>" . $d['subject'] . ' ' . $d['targetP'] . "<br>";}
else
{

  echo "<img src='https://i.imgur.com/cbVKcmX.png'> <br>";

  echo"<br> Flagged: " . $resultFlagType . "<br>";
  echo "<h1>Thesis</h1>";
  echo "<br>" . $d['subject'] . ' ' . $d['targetP'] . "<br>";
}
echo $claimid . "<br>";

//add is subject person or object to inference div

  // FONT CHANGING
if($d['active'] == 1)
{ //$font = 'seagreen'; 
// echo "<img width='50' height='50' src='https://i.imgur.com/2Jcq3kT.png'> <br>! This claim is uncontested. <br>";
}
else 
{ //$font = '#B7B802'; 
echo "<img src='https://i.imgur.com/Zg0ijAM.png'> <br>"; } 


// ------------------------- BELOW is modal code
createModal($claimid);
// ------------------------- ABOVE is modal code

} //end of while statement 

?> </label><input id="<?php echo $claimid; ?>" type="checkbox"> <ul> <span class="more">&hellip;</span>



  <?php








//below is to continue recursion
  $sql1 = "SELECT DISTINCT claimIDFlagger
  from claimsdb, flagsdb
        WHERE ? = claimIDFlagged AND flagType NOT LIKE 'Thesis Rival'"; // SQL with parameters
        $stmt1 = $conn->prepare($sql1); 
        $stmt1->bind_param("i", $claimid);
        $stmt1->execute();
$result1 = $stmt1->get_result(); // get the mysqli result
$numhits1 = mysqli_num_rows($result1);
//IF A CLAIM IS FLAGGED IT obtains flaggers that aren't rivals
//if its a thesis rival it will show up in the query above
//this is when the claim is the flagged. this is what gets pushed in the recursion.

while($user = $result1->fetch_assoc())
{
 if($numhits1 == 0)
  { }

else { sortclaims($user['claimIDFlagger']); }

} // end while loop
// recursion finished here

?></ul><?php

      } //end of else statement 

} // end of function





function sortclaimsRIVAL($claimid)
{
  include('config/db_connect.php');

// BELOW IS SIMPLY FOR DISPLAY OF SUBJECT/TARGETP
//these aren't passed through the function so they must be obtained every interation
  $dis = "SELECT DISTINCT subject, targetP, active, supportMeans, reason, example
  from claimsdb
  where ? = claimID
  "; 
  $st = $conn->prepare($dis); 
  $st->bind_param("i", $claimid);
  $st->execute();
  $disp = $st->get_result(); 
// ABOVE IS SIMPLY FOR DISPLAY

//BELOW IS JUST TO DISPLAY THE RIVAL PAIR
  $sql1 = "SELECT DISTINCT claimIDFlagger
  from claimsdb, flagsdb
  where ? = claimIDFlagged AND flagType LIKE 'Thesis Rival'
  ";
  $stmt1 = $conn->prepare($sql1); 
  $stmt1->bind_param("i", $claimid);
  $stmt1->execute();
  $result1 = $stmt1->get_result(); 
  $numhits1 = mysqli_num_rows($result1);
//above looks for normal non-rival flags for this rivaling claim.
  while($user = $result1->fetch_assoc())
    { $rivaling = $user['claimIDFlagger']; 
 } // end while loop
//ABOVE IS JUST TO DISPLAY RIVAL PAIR

 ?>


 <li> <label for="<?php echo $claimid; ?>"><?php 
 while($d = $disp->fetch_assoc())
 {

  echo "<img width='100' height='20' src='https://i.imgur.com/GDcQPD3.png'> <br><br>";


  if($d['active'] == 1)
{ //echo "<img width='50' height='50' src='https://i.imgur.com/2Jcq3kT.png'> <br>! This claim is uncontested. <br>"; 
}
else 
 { echo "<img src='https://i.imgur.com/Zg0ijAM.png'> <br>";}




echo "<h4>Contests #" . $rivaling . "</h4>"; 
echo "<h1>Thesis</h1>" ;
echo $d['subject'] . ' ' . $d['targetP'];
echo "<BR>" . $claimid;
//--------------------------- BELOW is modal code
createModal($claimid);
//--------------------------- ABOVE is modal code

} // end of display fetching loop


?>

</label><input id="<?php echo $claimid; ?>" type="checkbox"><ul> <span class="more">&hellip;</span>
  <!--</font>-->
  <?php
//below finds the flagger and continues the recursion by pushing it back to sortclaims recursion
  $sql1 = "SELECT DISTINCT claimIDFlagger
  from claimsdb, flagsdb
  where ? = claimIDFlagged AND flagType NOT LIKE 'Thesis Rival'
  ";
  $stmt1 = $conn->prepare($sql1); 
  $stmt1->bind_param("i", $claimid);
  $stmt1->execute();
  $result1 = $stmt1->get_result(); 
  $numhits1 = mysqli_num_rows($result1);
//above looks for normal non-rival flags for this rivaling claim.
  while($user = $result1->fetch_assoc())
  {
    if($numhits1 == 0)
      { }
    else {
     sortclaims($user['claimIDFlagger']); }
 } // end while loop

//it's pushed - now the function is finished!

 ?></ul><?php 

} // end of rivalfunction












function doesThesisFlag ($claimid)
{
  include('config/db_connect.php');
  $answer = 'false';
  $act2 = "SELECT DISTINCT claimIDFlagger
  from flagsdb
  WHERE claimIDFlagged = ? and flagType NOT LIKE 'supporting'"; 
  $s2 = $conn->prepare($act2); 
  $s2->bind_param("i", $claimid);
  $s2->execute();
  $activity2 = $s2->get_result(); 
  $nh2 = mysqli_num_rows($activity2);
  while($supports = $activity2->fetch_assoc())
  {

    $new = "SELECT DISTINCT active
    from claimsdb
    WHERE claimID = ?"; 
    $snew = $conn->prepare($new); 
    $snew->bind_param("i", $supports['claimIDFlagger']);
    $snew->execute();
    $activitynew = $snew->get_result(); 
    while($SCHECK = $activitynew->fetch_assoc())
    {
      if($SCHECK['active'] == 1)
      {
        $answer = 'true';
      } //end of if

    } //end of while
} //end of while
   //       echo '<script type="text/javascript">alert("active: ' . $claimid . "support number" . $answer . '");</script>';

          return $answer;

} //end of function



function noSupports ($claimid)
{  include('config/db_connect.php');

    $result = 'no active supports';

    $act2 = "SELECT DISTINCT claimIDFlagger
  from flagsdb
  WHERE claimIDFlagged = ? and flagType LIKE 'supporting'"; 
  $s2 = $conn->prepare($act2); 
  $s2->bind_param("i", $claimid);
  $s2->execute();
  $activity2 = $s2->get_result(); 
  $nh2 = mysqli_num_rows($activity2);
  while($supports = $activity2->fetch_assoc())
  {


  $new = "SELECT DISTINCT active
  from claimsdb
  WHERE claimID = ?"; 
  $snew = $conn->prepare($new); 
  $snew->bind_param("i", $supports['claimIDFlagger']);
  $snew->execute();
  $activitynew = $snew->get_result(); 
  $everyInactiveSupport = 'true';

    while($SCHECK = $activitynew->fetch_assoc())
  {
// echo '<script type="text/javascript">alert("active: ' . $SCHECK['active'] . '");</script>';

    if($SCHECK['active'] == 1)
    {

      $result = "There is an active";
      // can you just break here?
    }
    

  } //end of second while loop


} // end of first while loop



    if($result != "There is an active")
    {
//echo '<script type="text/javascript">alert("ITS HAPPENING: ' . $result . '");</script>';


     $act = "UPDATE claimsdb 
        SET active = 0
        WHERE claimID = ? 
        
    ";
    $upd = $conn->prepare($act); 
    $upd->bind_param("i", $claimid);
    $upd->execute();   
   
    }//end of if statement





} // end of function


function restoreActivity ($claimid)
{
  include('config/db_connect.php');




//////////////////////////////////////////////////////// grabs supports for initial claim NUMBER ONE ON DIAGRAM, RED
  $act2 = "SELECT DISTINCT claimIDFlagger
  from flagsdb
  WHERE claimIDFlagged = ? and flagType LIKE 'supporting'"; 
  $s2 = $conn->prepare($act2); 
  $s2->bind_param("i", $claimid);
  $s2->execute();
  $activity2 = $s2->get_result(); 
  $nh2 = mysqli_num_rows($activity2);
  while($supports = $activity2->fetch_assoc())
  {

//claimid is the original claim. supportsClaimIDFLAGGER is the support. check to see if all the supports are inactive. OR if ONE support is active!!!!!!!!!!!!!!!

  

  $new = "SELECT DISTINCT active
  from claimsdb
  WHERE claimID = ?"; 
  $snew = $conn->prepare($new); 
  $snew->bind_param("i", $supports['claimIDFlagger']);
  $snew->execute();
  $activitynew = $snew->get_result(); 
  $everyInactiveSupport = 'true';
  while($SCHECK = $activitynew->fetch_assoc())
  {

//  echo '<script type="text/javascript">alert("active: ' . $SCHECK['active'] . "support number" . $supports['claimIDFlagger'] . '");</script>';


//are supports active? we only need one to reactivate the claim.
    if($SCHECK['active'] == '1' && doesThesisFlag($claimid) == 'false' ) //i have a suspicion that this isn't working/triggering
    {




      global $everyInactiveSupport;
      $everyInactiveSupport = 'false';


      $act = "UPDATE claimsdb 
      SET active = 1
      WHERE claimID = ? 
"; // SQL with parameters
$upd = $conn->prepare($act); 
$upd->bind_param("i", $claimid);
$upd->execute();

    } // end of if



  } //end of while loop

//are all supports inactive? claim is inactive.
/*  if($everyInactiveSupport == 'true')
  {
    $act = "UPDATE claimsdb 
    SET active = 0
    WHERE claimID = ? 
"; // SQL with parameters
$upd = $conn->prepare($act); 
$upd->bind_param("i", $claimid);
$upd->execute();
 } // end of second if statement 
*/


 if(doesThesisFlag($supports['claimIDFlagger']) == 'false' )
{

$act = "UPDATE claimsdb 
    SET active = 1
    WHERE claimID = ? 
"; // SQL with parameters
$upd = $conn->prepare($act); 
$upd->bind_param("i", $supports['claimIDFlagger']);
$upd->execute();
}

      
 if(doesThesisFlag($claimid) == 'false' )
 {
 
  noSupports($claimid);
 }


if($nh2 == 0)
    { }
  else { restoreActivity($supports['claimIDFlagger']); }
//supports get pushed into the recursive process. every time. 



//$SUPPORTS ENDED HERE BEFORE

// also, for all supports, if they have ONE (active) flag, then they're inactive. THIS IS ALREADY DONE.
// for all supports, if theres a flag but its inactive, the support is active. !!!!!!!!!!!!! THIS IS THE CODE BELOW






///////////////////////////////////////////////////////// NUMBER TWO ON DIAGRAM, ORANGE
                                        //below grabs all flaggers for the support and JUST the support. not the claims.  - act3, s3, activity3
                                        
                                        //below is for rivals


$a = "SELECT DISTINCT claimIDFlagger
from flagsdb
WHERE claimIDFlagged = ? and flagType LIKE 'Thesis Rival'"; 
$si = $conn->prepare($a); 
$si->bind_param("i", $supports['claimIDFlagger']);
$si->execute();
$sim = $si->get_result(); 
while($mi = $sim->fetch_assoc())
{ 
    restoreActivityRIVAL($mi['claimIDFlagger']);

    //below should get the companion rival
  
    $a2 = "SELECT DISTINCT claimIDFlagger
from flagsdb
WHERE claimIDFlagged = ? and flagType LIKE 'Thesis Rival'"; 
$si2 = $conn->prepare($a2); 
$si2->bind_param("i", $mi['claimIDFlagger']);
$si2->execute();
$sim2 = $si2->get_result(); 
while($mi2 = $sim2->fetch_assoc())
{ 

    restoreActivityRIVAL($mi2['claimIDFlagger']);

} //end of first while

    
} //end of second while
//echo '<script type="text/javascript">alert("claim id: ' . $claimid . "support number" . $supports['claimIDFlagger'] . "mi" . $mi['claimIDFlagger'] .  '");</script>';

//above is for rivals

                                        
  $act3 = "SELECT DISTINCT claimIDFlagger
  from flagsdb
  WHERE claimIDFlagged = ? and flagType NOT LIKE 'Thesis Rival'
  "; 
  $s3 = $conn->prepare($act3); 
  $s3->bind_param("i", $supports['claimIDFlagger']);
  $s3->execute();
  $activity3 = $s3->get_result(); 
  $nh = mysqli_num_rows($activity3);

 // echo '<script type="text/javascript">alert("alert: ' . $supports['claimIDFlagger'] . '");</script>';

  while($activeflags = $activity3->fetch_assoc())
  {
   if($nh == 0)
    { } 
  else { restoreActivity($activeflags['claimIDFlagger']); }

                                    ///////////////////////////////////////////////////////////////////////////////////

                                            $h = "SELECT DISTINCT active
                                            from claimsdb
                                            WHERE ? = claimID"; // SQL with parameters
                                            $noce = $conn->prepare($h); 
                                            $noce->bind_param("i", $activeflags['claimIDFlagger']);
                                            $noce->execute();
                                          $res = $noce->get_result(); // get the mysqli result
                                          $numh = mysqli_num_rows($res);
                                          //checks the active status of the flagger


                                          $everyInactive = 'false';
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
                                    $upd->bind_param("i", $supports['claimIDFlagger']);
                                    $upd->execute();
                                          
                                        } // end of if
                                      } //end of while loop


                                     /* if($everyInactive == 'true')
                                      {

                                    //echo "ANSWER" . $everyInactive;
                                    // BELOW CHANGES THE ACTIVE STATE OF OTHER CLAIMS
                                        $act = "UPDATE claimsdb 
                                        SET active = 1
                                        WHERE claimID = ? 
                                    "; // SQL with parameters
                                    $upd = $conn->prepare($act); 
                                    $upd->bind_param("i", $supports['claimIDFlagger']);
                                    $upd->execute();
                                     } // end of second if statement */

                                    } // end of while loop

                                    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////


  } // end of while loop


//this needs to be checking thesis flags for root claims

/*
  while($TETL = $activity ->fetch_assoc())
  {

// grabs all active statuses for all the supports of the claim
$act37 = "SELECT DISTINCT active
        from claimsdb
        WHERE claimID = ?"; 
$s37 = $conn->prepare($act37); 
$s37->bind_param("i", $TETL['claimIDFlagger']);
$s37->execute();
$activity37 = $s37->get_result(); 
$nh = mysqli_num_rows($activity37);
  
     while($ChAc = $activity37->fetch_assoc())
  {

$allSupportsInactive = '';

if($ChAc['active'] = '1')
{
$allSupportsInactive = 'false';
}
else{
  $allSupportsInactive = 'true';

}// end of else


 if($allSupportsInactive == 'true')
  {
  
//echo "ANSWER" . $everyInactive;
// BELOW CHANGES THE ACTIVE STATE OF OTHER CLAIMS
$act = "UPDATE claimsdb 
SET active = 0
WHERE claimID = ? 
"; // SQL with parameters
$upd = $conn->prepare($act); 
$upd->bind_param("i", $claimid);
$upd->execute();
 } // end of second if statement

*/

 // } // end of while for active



 //check for if there is at least one active support for root claims





//  }// end of while for the flaggers

//  }//end of while for the supports to get their flaggers

//above grabs all flaggers for the support  - act3, s3, activity3


//GRABS ALL FLAGS OF ORIGINAL CLAIM ---------------------------- BLUE ON DIAGRAM, 3
 $act90 = "SELECT DISTINCT claimIDFlagger
 from flagsdb
 WHERE claimIDFlagged = ? and flagType NOT LIKE 'Thesis Rival' and flagType NOT LIKE 'supporting'"; 
 $s90 = $conn->prepare($act90); 
 $s90->bind_param("i", $claimid);
 $s90->execute();
 $activity90 = $s90->get_result(); 
 $nh90 = mysqli_num_rows($activity90);

//above grabs all flaggers for non-rival root claims
// all tooearly or toolate //$activity
// *AND* all support flags because while it doesn't occur for the first run through, when a support is put into the parameters, it'll check all reason/rule flags


 while($activestatus = $activity90->fetch_assoc())
 { 

  if($nh90 == 0)
    { }
  else { 

    restoreActivity($activestatus['claimIDFlagger']); }


// echo '<script type="text/javascript">alert("active: ' . $activestatus['claimIDFlagger'] .  '");</script>';



//////////////////////////////////////////// COME BACK
  $h90 = "SELECT DISTINCT active
  from claimsdb
        WHERE ? = claimID"; // SQL with parameters
        $noce90 = $conn->prepare($h90); 
        $noce90->bind_param("i", $activestatus['claimIDFlagger']);
        $noce90->execute();
      $res90 = $noce90->get_result(); // get the mysqli result

      while($r90 = $res90->fetch_assoc())
      { 

//grabs active status of all flaggers of original claim: is it active?
 // $activestatus['claimiDflagger'] <--- flagtype like "suppporting"


        if($r90['active'] == 1)
        {
          $act = "UPDATE claimsdb 
          SET active = 0
          WHERE claimID = ? 
"; // SQL with parameters
$upd = $conn->prepare($act); 
$upd->bind_param("i", $claimid);
$upd->execute();
        } // end of if
        else{

          $act = "UPDATE claimsdb 
          SET active = 1
          WHERE claimID = ? 
"; // SQL with parameters
$upd = $conn->prepare($act); 
$upd->bind_param("i", $claimid);
$upd->execute();
        }

   // if($everyInactive == 'true')
    //{
    //we don't want to set this back to active, even if there's no thesis flags, because it may still have no ACTIVE support. restoration should happen earlier in the code. if not, it should probably go here.
   // } // end of second if statement



}//end of while statement



//below is for rivals

$a = "SELECT DISTINCT claimIDFlagger
from flagsdb
WHERE claimIDFlagged = ? and flagType LIKE 'Thesis Rival'"; 
$si = $conn->prepare($a); 
$si->bind_param("i", $claimid);
$si->execute();
$sim = $si->get_result(); 
while($mi = $sim->fetch_assoc())
{ 
  restoreActivityRIVAL($mi['claimIDFlagger']);
}

//above is for rivals


 } //end while loop



}  // end function


function noSupportsRival ($claimidA)
{  include('config/db_connect.php');

    $result = 'no active supports';

    $act2 = "SELECT DISTINCT claimIDFlagger
  from flagsdb
  WHERE claimIDFlagged = ? and flagType LIKE 'supporting'"; 
  $s2 = $conn->prepare($act2); 
  $s2->bind_param("i", $claimidA);
  $s2->execute();
  $activity2 = $s2->get_result(); 
  $nh2 = mysqli_num_rows($activity2);
  while($supports = $activity2->fetch_assoc())
  {


  $new = "SELECT DISTINCT active
  from claimsdb
  WHERE claimID = ?"; 
  $snew = $conn->prepare($new); 
  $snew->bind_param("i", $supports['claimIDFlagger']);
  $snew->execute();
  $activitynew = $snew->get_result(); 
  $everyInactiveSupport = 'true';

    while($SCHECK = $activitynew->fetch_assoc())
  {
// echo '<script type="text/javascript">alert("active: ' . $SCHECK['active'] . '");</script>';

    if($SCHECK['active'] == 1)
    {

      $result = "There is an active";
      return 'true';
      // can you just break here?
    }
    

  } //end of second while loop


} // end of first while loop

//rivalA : supportless --> rivalb should be active. does rivalb have active TE/TL? 

//rivalB : needs to be active AND it doesn't have a too early / too late AND needs at least one support itself

    if($result != "There is an active" ) 
    {
//echo '<script type="text/javascript">alert("ITS HAPPENING: ' . $result . '");</script>';

  return 'false';
   
    }//end of if statement

} // end of function



function doesThesisFlagRival ($claimid)
{
  include('config/db_connect.php');
  $answer = 'false';
  

  $act2 = "SELECT DISTINCT claimIDFlagger
  from flagsdb
  WHERE claimIDFlagged = ? AND (flagType LIKE 'Too Early' OR flagType LIKE 'Too Late')
  "; 
  $s2 = $conn->prepare($act2); 
  $s2->bind_param("i", $claimid);
  $s2->execute();
  $activity2 = $s2->get_result(); 
  $nh2 = mysqli_num_rows($activity2);
  while($supports = $activity2->fetch_assoc())
  {

    $new = "SELECT DISTINCT active
    from claimsdb
    WHERE claimID = ?"; 
    $snew = $conn->prepare($new); 
    $snew->bind_param("i", $supports['claimIDFlagger']);
    $snew->execute();
    $activitynew = $snew->get_result(); 
    while($SCHECK = $activitynew->fetch_assoc())
    {
      if($SCHECK['active'] == 1)
      {
        $answer = 'true';
      } //end of if

    } //end of while
} //end of while


          return $answer;

} //end of function




function restoreActivityRIVAL ($claimid)
{
//below finds the flagger and continues the recursion by pushing it back to normal restore activity function 
  // IN ADDITION below is to check active status of flagging claims OF INITIAL RIVAL 

  $everyInactiveA = 'true';

  $everyInactiveB = 'true';

  include('config/db_connect.php');
      
//  echo '<script type="text/javascript">alert("active: ' . $claimid . '");</script>';

//  noSupports($claimid);

//noSupports($nodeFlaggers, $rivaling);

// set of all too-early and too-late 
  $sql188 = "SELECT DISTINCT claimIDFlagger
  from claimsdb, flagsdb
  where ? = claimIDFlagged AND flagType NOT LIKE 'Thesis Rival'
  ";
  $stmt188 = $conn->prepare($sql188); 
  $stmt188->bind_param("i", $claimid);
  $stmt188->execute();
  $result188 = $stmt188->get_result(); 
  $numhits1 = mysqli_num_rows($result188);
//above looks for normal non-rival flags for this rivaling claim.
  while($user = $result188->fetch_assoc())
  {

    $nodeFlaggers = $user['claimIDFlagger'];
    if($numhits1 == 0)
      { }
   else { restoreActivity($nodeFlaggers); } //end of  restoreactivity push FOR THIS SIDE OF THE RIVAL PAIR. the rival companion is pushed to restoreactivity at the bottom of this function.
 }
//above it finds rival A's flaggers.


//below is to check active status of flagging claims OF RIVAL COMPANION
 $rivaling = '';
// finds the companion 
 $sql12 = "SELECT DISTINCT claimIDFlagger
 from claimsdb, flagsdb
 where ? = claimIDFlagged AND flagType LIKE 'Thesis Rival'
 ";
 $stmt12 = $conn->prepare($sql12); 
 $stmt12->bind_param("i", $claimid);
 $stmt12->execute();
 $result12 = $stmt12->get_result(); 
 $numhits1 = mysqli_num_rows($result12);
//found rival pair!
 while($user = $result12->fetch_assoc())
{ $rivaling = $user['claimIDFlagger'];  //$rivaling is Rival B.
 } // end while loop

//above finds rival A's companion, aka rival b.

 //above is to check active status of flagging claims OF RIVAL COMPANION




//this is finding the flaggers for rival B
  $sql167 = "SELECT DISTINCT claimIDFlagger
  from claimsdb, flagsdb
  where ? = claimIDFlagged AND flagType NOT LIKE 'Thesis Rival'
  ";
  $stmt167 = $conn->prepare($sql167); 
  $stmt167->bind_param("i", $rivaling);
  $stmt167->execute();
  $result167 = $stmt167->get_result(); 
  $numhits167 = mysqli_num_rows($result167);
//above looks for normal non-rival flags for this rivaling claim.
  while($userRIVALING = $result167->fetch_assoc())
  {
    if($numhits167 == 0)
      { }
    else {restoreActivity($userRIVALING['claimIDFlagger']); }


 } // end of outer while loop

///////////////////////////////////////////// start of checking for supports and then putting the results in recursion

/*


  $rivalsupports = "SELECT DISTINCT claimIDFlagger
  from claimsdb, flagsdb
  where ? = claimIDFlagged AND flagType LIKE 'supporting'
  ";
  $stmtsupports = $conn->prepare($rivalsupports); 
  $stmtsupports->bind_param("i", $rivaling);
  $stmtsupports->execute();
  $resultsupports = $stmtsupports->get_result(); 
  $numhitsSupports = mysqli_num_rows($resultsupports);
//above looks for normal non-rival flags for this rivaling claim.
  while($rivalsupporting = $resultsupports->fetch_assoc())
  {
                echo '<script type="text/javascript">alert("active: ' . $rivalsupporting['claimIDFlagger'] .  '");</script>';

    if($numhitsSupports == 0)
      { }
    else {restoreActivity($rivalsupporting['claimIDFlagger']); }

} // end of while 

  $rivalsupports2 = "SELECT DISTINCT claimIDFlagger
  from claimsdb, flagsdb
  where ? = claimIDFlagged AND flagType LIKE 'supporting'
  ";
  $stmtsupports2 = $conn->prepare($rivalsupports2); 
  $stmtsupports2->bind_param("i", $claimid);
  $stmtsupports2->execute();
  $resultsupports2 = $stmtsupports2->get_result(); 
  $numhitsSupports2 = mysqli_num_rows($resultsupports2);
//above looks for normal non-rival flags for this rivaling claim.
  while($rivalsupporting2 = $resultsupports2->fetch_assoc())
  {

            echo '<script type="text/javascript">alert("active: ' . $rivalsupporting2['claimIDFlagger'] .  '");</script>';

    if($numhitsSupports2 == 0)
      { }
    else {restoreActivity($rivalsupporting2['claimIDFlagger']); }


} // end of while
*/
///////////////////////////////////////////// end of checking for supports and then putting the results in recursion


$statusA = '';
$statusB = '';
if(noSupportsRival($claimid) == 'true' && doesThesisFlagRival($claimid) == 'false')
{
  $statusA = 'unchallenged';
}
else{
  $statusA = 'challenged';
}


if(noSupportsRival($rivaling) == 'true' && doesThesisFlagRival($rivaling) == 'false')
{
  $statusB = 'unchallenged';
}
else{
  $statusB = 'challenged';
}



 // echo "CLAIM ID:" . $claimid . noSupportsRival($claimid) . doesThesisFlagRival($claimid) . "<BR> ACTIVE B: " . $rivaling . noSupportsRival($rivaling) . doesThesisFlagRival($rivaling) . "<BR><BR><BR><BR><BR><BR><BR><BR>";

//  echo "CLAIM ID:" . $claimid . $rivaling . "<BR> ACTIVE B: " . $statusB . "<BR> ACTIVE A: " . $statusA . "<BR><BR><BR><BR><BR><BR><BR><BR>";


 if($statusA == 'unchallenged' && $statusB == 'unchallenged' || $statusA == 'challenged' && $statusB == 'challenged')
 {
  $act = "UPDATE claimsdb 
  SET active = 0
  WHERE claimID = ? 
"; // SQL with parameters
$upd = $conn->prepare($act); 
$upd->bind_param("i", $claimid);
$upd->execute();


$act = "UPDATE claimsdb 
SET active = 0
WHERE claimID = ? 
"; // SQL with parameters
$upd = $conn->prepare($act); 
$upd->bind_param("i", $rivaling);
$upd->execute();

}

//if its true, there are no flags. 
//if false, there are flags.
if($statusA == 'unchallenged' && $statusB == 'challenged')
{
  $act = "UPDATE claimsdb 
  SET active = 1
  WHERE claimID = ? 
"; // SQL with parameters
$upd = $conn->prepare($act); 
$upd->bind_param("i", $claimid);
$upd->execute();


$act = "UPDATE claimsdb 
SET active = 0
WHERE claimID = ? 
"; // SQL with parameters
$upd = $conn->prepare($act); 
$upd->bind_param("i", $rivaling);
$upd->execute();

}

if($statusB == 'unchallenged' && $statusA == 'challenged')
{
  $act = "UPDATE claimsdb 
  SET active = 0
  WHERE claimID = ? 
"; // SQL with parameters
$upd = $conn->prepare($act); 
$upd->bind_param("i", $claimid);
$upd->execute();


$act = "UPDATE claimsdb 
SET active = 1
WHERE claimID = ? 
"; // SQL with parameters
$upd = $conn->prepare($act); 
$upd->bind_param("i", $rivaling);
$upd->execute();

}




 } //end of function



 function createModal($claimid)
 {
  include('config/db_connect.php');

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
 html += "<div class='col-md-6'><p style=\"color:black\">" + response.ts + "<BR> ClaimID: " + response.claimID +  "</div><BR><p style=\"color:black\">";


 if(response.supportMeans == 'NA')
 {
  html +=  "<BR> Claim: " + response.subject + " " + response.targetP;
}

if(response.supportMeans == 'Testimony')
{
  html +=  "Transcription: " + response.transcription + " <BR><br><br> Citation: " + response.citation;
}

if(response.supportMeans == 'Perception')
{
 html += " <BR> URL: " + response.URL + " <BR> Timestamp: " + response.timestamp + " <BR> Citation: " + response.citation;
}

if(response.supportMeans == 'Inference')
{
  html += " <BR> Reason: " + response.reasonST + "<BR> Rule & Example: " + response.ruleST;

}
if(response.supportMeans == 'Tarka')
{
  html += "Tarka is an element of conversation used to discuss errors in debate form and communication with moderators.";

}

html += " <BR> <div class = \"modal-content-a\"> <a href=\"details.php?id=" + response.claimID + "\" class = \"button\">  DETAILS PAGE </a> </div></div>";

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
    <div class = "modal-content-a">
      <b>Claim Details</b> <br>
      <div class = "modal-content-b">

       <div class = "modal-header">
        <h4 class = "modal-title">

        </h4>

<!--            <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
               ×
             </button> -->
           </div>

           <div id = "modal-body">

            Press ESC button to exit.

            response.claimID
          </div>
        </div> <!-- modal-content-b -->        

        <!--         <BR> <a href="details.php?id=<?php echo $claimid; ?>" class = "button">FLAG THIS CLAIM! </a> </div>  -->

           <!-- <button type = "button" class = "btn btn-default" data-dismiss = "modal">
               OK
             </button> -->


           </div><!-- /.modal-content-a-->
         </div><!-- /.modal-dialog -->

       </div><!-- /.modal -->



       <?php

} // end of function

?>



</html>
<?php mysqli_close($conn); ?>