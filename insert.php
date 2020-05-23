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

$thesisST= $subject ." " . $targetP. ".";

$reasonST= "Because " . $subject . " " . $reason. ".";

$ruleST= "Whomever " . $reason . " " . $targetP. " as in the case of " . $example. ".";


$c = uniqid (rand (),true);

$supportID =  $c;

		
		$sql1 = "INSERT INTO claimsdb(subject, targetP, supportMeans, supportID, example, URL, reason, rd, summary, description, thesisST, reasonST, ruleST, topic) VALUES('$subject', '$targetP', '$supportMeans', '$supportID','$example','$URL','$reason', '$rd', '$summary', '$description','$thesisST','$reasonST','$ruleST', '$topic')";

	
$active = '1'; 

			if(mysqli_query($conn, $sql1)){
				// success
			} else {
				echo 'query error: '. mysqli_error($conn);
			}
			$addPage = $_SESSION['addPage'];	
if($addPage == 'no')
{

$active = '1';

 				$order = "SELECT * from claimsdb ORDER BY claimID DESC LIMIT 1";
				 $nice = mysqli_query($conn, $order);

 				if($row = $nice->fetch_assoc()) {
      $claimIDFlagger = $row['claimID']; }


//On page 2
$claimIDFlagged = $_SESSION['varname'];
 
 // this function below inserts into database
	 $sql5 = "INSERT INTO flagsdb(claimIDFlagged, flagType, claimIDFlagger, active) VALUES('$claimIDFlagged', '$flagType','$claimIDFlagger','$active')";

	 $update = "UPDATE flagsdb 
SET active = 0
WHERE claimIDFlagged = ? "; // SQL with parameters
$stmt2 = $conn->prepare($update); 
$stmt2->bind_param("i", $claimIDFlagged);
$stmt2->execute();
$result2 = $stmt2->get_result(); // get the mysqli result

if($flagType = 'thesisRival')
{
	$temp = $claimIDFlagged;
	$claimIDFlagged = $claimIDFlagger;
	$claimIDFlagger = $temp;
	//$active = 0;
	$flagrival = "INSERT INTO flagsdb(claimIDFlagged, flagType, claimIDFlagger, active) VALUES('$claimIDFlagged', '$flagType','$claimIDFlagger','$active')";

	if(mysqli_query($conn, $flagrival)){
				// success
				header('Location: index.php');
			} else {
				echo 'query error: '. mysqli_error($conn);
			}
}

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

		if(mysqli_query($conn, $sql5)){
				// success
				header('Location: index.php');
			} else {
				echo 'query error: '. mysqli_error($conn);
			}

}
mysqli_close($conn); ?>