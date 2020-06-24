<?php
include('config/db_connect.php');
$claimID = $temp = $result = $topic = $array = $claim_fk = $IclaimID = $thesisST = $reasonST = $ruleST = $NewOld = $oldClaim = $subject = $targetP = $supportMeans = $supportforID = $supportID = $example = $URL =  $rd = $reason =  $flagType = $flagURL = $flagSource = $flagID = $inferenceIDFlagger= $active = '';
$c = uniqid (rand (),true);

$supportID =  $c;
$flagType = "thesisRival";
$claimIDFlagged = 424;
echo "HELLO";
$order = "SELECT * from claimsdb ORDER BY claimID DESC LIMIT 1";
				 $nice = mysqli_query($conn, $order);

 				if($row = $nice->fetch_assoc()) {
      $claimIDFlagger = $row['claimID']; 
      echo $claimIDFlagger;
  		}
if($flagType == 'thesisRival')
{
echo "HELLO";
	//$active = 0;
// CHECKING TO SEE IF IT IS A ROOT CLAIM
	$root1 = "SELECT DISTINCT claimID
        from claimsdb, flagsdb 
            WHERE claimID NOT IN (SELECT DISTINCT claimIDFlagger FROM flagsdb) AND claimID = ?
        "; // SQL with parameters
$stmt5 = $conn->prepare($root1); 
$stmt5->bind_param("i", $claimIDFlagged); //used to be flagger. this was an issue!
$stmt5->execute();
$rootresult1 = $stmt5->get_result(); // get the mysqli result
$numhitsroot = mysqli_num_rows($rootresult1);
echo $numhitsroot;


// END CHECKING TO SEE IF IT IS A ROOT CLAIM

while($j = $rootresult1->fetch_assoc())
{
	echo $j['claimID']; 
	if($numhitsroot == 1)
		{ 
			$isRootRival = '1';
		echo $isRootRival; 
	}
}
//we found a root. its been designated, swapped values, and the additional flag for reciprocity is added. however... the original root isn't rootrival =1 (fix happens below) but flagtype value is still the same. 
	$temp = $claimIDFlagged;
	$claimIDFlagged = $claimIDFlagger;
	$claimIDFlagger = $temp;

	$flagrival = "INSERT INTO flagsdb(claimIDFlagged, flagType, claimIDFlagger, isRootRival) VALUES('$claimIDFlagged', '$flagType','$claimIDFlagger', '$isRootRival')";

if(mysqli_query($conn, $flagrival)){
				// success
				header('Location: index.php');
			} else {
				echo 'query error: '. mysqli_error($conn);
			}



$fix = "SELECT flagID from flagsdb ORDER BY flagID DESC LIMIT 1";
				 $i = mysqli_query($conn, $fix);

 				if($res = $i->fetch_assoc()) {
      $flagID = $res['flagID']; 
  	}


	 $fix2 = "UPDATE flagsdb 
SET isRootRival = 1
WHERE flagID = ? "; // SQL with parameters
$stmt10 = $conn->prepare($fix2); 
$stmt10->bind_param("i", $flagID);
$stmt10->execute();
$result10 = $stmt10->get_result(); // get the mysqli result
	
$flagID = $flagID - 1;

 $fix3 = "UPDATE flagsdb 
SET isRootRival = 1
WHERE flagID = ? "; // SQL with parameters
$stmt11 = $conn->prepare($fix3); 
$stmt11->bind_param("i", $flagID);
$stmt11->execute();
$result11 = $stmt11->get_result(); // get the mysqli result
	


} //end of if flagtype == thesisRival


//2. if additional rival claim - restricted. 
// change foreach to be query..change intro query to be a prepared statement
// have page load into center...

		


mysqli_close($conn); ?>