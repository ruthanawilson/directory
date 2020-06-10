<?php
include('config/db_connect.php');

			$flagType = $_POST['flagType'];
		//	$addPage = $_POST['addPage'];
			$reason = $_POST['reason'];
			$topic = $_POST['topic'];
			$example = $_POST['example'];
			$URL = $_POST['url'];
			$rd = $_POST['rd'];
			$subject = $_POST['subject'];
			$supportMeans = $_POST['union'];
			$targetP = $_POST['targetP'];
			$summary = $_POST['summary'];
			$description = $_POST['description'];
		//	$flagType = $_POST['flagType'];
session_start();

$thesisST= $subject . " " . $targetP. ".";

$reasonST= "Because " . $subject . " " . $reason. ".";

$ruleST= "Whomever " . $reason . " " . $targetP. " as in the case of " . $example. ".";


$c = uniqid (rand (),true);

$supportID =  $c;

$active = '1'; 

		
		$sql1 = "INSERT INTO claimsdb(subject, targetP, supportMeans, supportID, example, URL, reason, rd, summary, description, thesisST, reasonST, ruleST, topic, active) VALUES('$subject', '$targetP', '$supportMeans', '$supportID','$example','$URL','$reason', '$rd', '$summary', '$description','$thesisST','$reasonST','$ruleST', '$topic', '$active')";

	
			if(mysqli_query($conn, $sql1)){
				// success
			} else {
				echo 'query error: '. mysqli_error($conn);
			}
			$addPage = $_SESSION['addPage'];	
if($addPage == 'no')
{

 				$order = "SELECT * from claimsdb ORDER BY claimID DESC LIMIT 1";
				 $nice = mysqli_query($conn, $order);

 				if($row = $nice->fetch_assoc()) {
      $claimIDFlagger = $row['claimID']; }


//On page 2
$claimIDFlagged = $_SESSION['varname'];
 $isRootRival = 0;
 // this function below inserts into database
// fix this code to where thesisrival works here as well 
	 $sql5 = "INSERT INTO flagsdb(claimIDFlagged, flagType, claimIDFlagger, isRootRival) VALUES('$claimIDFlagged', '$flagType','$claimIDFlagger','$isRootRival')";

if(mysqli_query($conn, $sql5)){
				// success
				header('Location: index.php');
			} else {
				echo 'query error: '. mysqli_error($conn);
			}

	 $update = "UPDATE claimsdb 
SET active = 0
WHERE claimID = ? "; // SQL with parameters
$stmt2 = $conn->prepare($update); 
$stmt2->bind_param("i", $claimIDFlagged);
$stmt2->execute();
$result2 = $stmt2->get_result(); // get the mysqli result

if($flagType == 'thesisRival')
{

	//$active = 0;
// CHECKING TO SEE IF IT IS A ROOT CLAIM
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

	$flagrival = "INSERT INTO flagsdb(claimIDFlagged, flagType, claimIDFlagger, isRootRival) VALUES('$claimIDFlagged', '$flagType','$claimIDFlagger', $isRootRival')";

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
	


}//does rival also have to be an inference as supp =
// rival can be supported by either inference, testimony, or perception.

//question - can a claim be flagged as has a rival more than once?
// only one rival per claim. 
//1. thesis and counterthesis - pair identification
//2. if additional rival claim - restricted. 
//thesis will suddenl flag the counter thesis

//
//question - specific details of how a claim would be seen as in active 'limbo'
//question - 
// change foreach to be query..change intro query to be a prepared statement
// have page load into center...

		

}
mysqli_close($conn); ?>