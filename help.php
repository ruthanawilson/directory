<?php	


include('config/db_connect.php');
$claimIDFlagger = 374;
$claimIDFlagged = 373;
$root1 = "SELECT DISTINCT claimID
        from claimsdb, flagsdb 
            WHERE claimID NOT IN (SELECT DISTINCT claimIDFlagger FROM flagsdb) AND claimID = ?
        "; // SQL with parameters
$stmt5 = $conn->prepare($root1); 
$stmt5->bind_param("i", $claimIDFlagger);
$stmt5->execute();
$rootresult1 = $stmt5->get_result(); // get the mysqli result
$numhitsroot = mysqli_num_rows($rootresult1);
// END CHECKING TO SEE IF IT IS A ROOT CLAIM

while($j = $rootresult1->fetch_assoc())
{
	echo $j['claimID']; 
	if($j['claimID'] == $claimIDFlagger)
		{ $isRootRival = '1';
		echo $isRootRival; }
}
	$temp = $claimIDFlagged;
	$claimIDFlagged = $claimIDFlagger;
	$claimIDFlagger = $temp;

//	$flagrival = "INSERT INTO flagsdb(claimIDFlagged, flagType, claimIDFlagger, active, isRootRival) VALUES('$claimIDFlagged', '$flagType','$claimIDFlagger','$active','$isRootRival')";

/*if(mysqli_query($conn, $flagrival)){
				// success
				header('Location: index.php');
			} else {
				echo 'query error: '. mysqli_error($conn);
			}
*/

$ob = "SELECT flagID from flagsdb ORDER BY flagID DESC LIMIT 1";
				 $new = mysqli_query($conn, $ob);

 				if($res = $new ->fetch_assoc()) {
      $flagID = $res['flagID']; 
  	}
  	
$flagID = $flagID - 1;


	 $update2 = "UPDATE flagsdb 
SET isRootRival = 1
WHERE flagID = ? "; // SQL with parameters
$stmt9 = $conn->prepare($update2); 
$stmt9->bind_param("i", $flagID);
$stmt9->execute();
$result9 = $stmt9->get_result(); 
?>