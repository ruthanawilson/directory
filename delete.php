function restoreActivity ($claimid)
{
include('config/db_connect.php');





//THIS CODE BELOW CHECKS ALL THE SUPPORTS OF THE CLAIM 

$act2 = "SELECT DISTINCT claimIDFlagger
        from flagsdb
        WHERE claimIDFlagged = ? and flagType LIKE 'supporting'"; 
$s2 = $conn->prepare($act2); 
$s2->bind_param("i", $claimid);
$s2->execute();
$activity2 = $s2->get_result(); 
$nh2 = mysqli_num_rows($activity2);



//above grabs all SUPPORTS for a claim.  - act2, s2, $activity2


  while($supports = $activity2->fetch_assoc())
  {

//claimid is the original claim. supportsClaimIDFLAGGER is the support. check to see if all the supports are inactive. OR if ONE support is active!!!!!!!!!!!!!!!

 if($nh2 == 0)
  { }
   else { restoreActivity($supports['claimIDFlagger']); }



$new = "SELECT DISTINCT active
        from claimsdb
        WHERE claimID = ?"; 
$snew = $conn->prepare($new); 
$snew->bind_param("i", $supports['claimIDFlagger']);
$snew->execute();
$activitynew = $snew->get_result(); 


$everyInactive = 'false';
  
     while($SCHECK = $activitynew->fetch_assoc())
  {


    
    if($SCHECK['active'] == 1)
    {
      global $everyInactive;
      $everyInactive = 'false';
  //    echo $everyInactive;
      $act = "UPDATE claimsdb 
SET active = 1
WHERE claimID = ? 
"; // SQL with parameters
$upd = $conn->prepare($act); 
$upd->bind_param("i", $claimid);
$upd->execute();
    } // end of if
  } //end of while loop


  if($everyInactive == 'true')
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






  } // end of while loop


// also, for all supports, if they have ONE (active) flag, then they're inactive. THIS IS ALREADY DONE.
// for all supports, if theres a flag but its inactive, the support is active. !!!!!!!!!!!!! THIS IS THE CODE BELOW








    //below grabs all flaggers for the support  - act3, s3, activity3
$act3 = "SELECT DISTINCT claimIDFlagger
        from flagsdb
        WHERE claimIDFlagged = ?"; 
$s3 = $conn->prepare($act3); 
$s3->bind_param("i", $supports['claimIDFlagger']);
$s3->execute();
$activity3 = $s3->get_result(); 
$nh = mysqli_num_rows($activity3);

  
     while($activeflags = $activity3->fetch_assoc())
  {

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


  if($everyInactive == 'true')
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
 } // end of second if statement

} // end of while loop

////////////////////////////////////////////////////////////////////////////////////////////////////////////////




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



$act90 = "SELECT DISTINCT claimIDFlagger
        from flagsdb
        WHERE claimIDFlagged = ? and flagType NOT LIKE 'Thesis Rival' and flagType NOT LIKE 'supporting'"; 
$s90 = $conn->prepare($act90); 
$s90->bind_param("i", $claimid);
$s90->execute();
$activity90 = $s90->get_result(); 

//above grabs all flaggers for non-rival root claims
// all tooearly or toolate //$activity
// OR all reason/rule flags


while($activestatus = $activity90->fetch_assoc())
  { 


//////////////////////////////////////////// COME BACK
    $h = "SELECT DISTINCT active
        from claimsdb
        WHERE ? = claimID"; // SQL with parameters
      $noce = $conn->prepare($h); 
      $noce->bind_param("i", $activestatus['claimIDFlagger']);
      $noce->execute();
      $res = $noce->get_result(); // get the mysqli result
     
    while($r = $res->fetch_assoc())
  { 




$everyInactive = 'true';
    
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
    } // end of if


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



}//end of while statement


 restoreActivity($activestatus['claimIDFlagger']); 
    
    
//THIS ABOVE CHANGES THE ACTIVE STATE OF OTHER CLAIMS
  




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

