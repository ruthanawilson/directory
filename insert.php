<?php
include('config/db_connect.php');

			$flagType = $_POST['flagType'];
			$reason = $_POST['reason'];
			$example = $_POST['example'];
			$URL = $_POST['url'];
			$rd = $_POST['rd'];
			$subject = $_POST['subject'];
			$supportMeans = $_POST['union'];
			$targetP = $_POST['targetP'];
			$summary = $_POST['summary'];
			$description = $_POST['description'];
session_start();

$thesisST= $subject ." " . $targetP. ".";

$reasonST= "Because " . $subject . " " . $reason. ".";

$ruleST= "Whomever " . $reason . " " . $targetP. " as in the case of " . $example. ".";


$c = uniqid (rand (),true);

$supportID =  $c;

		
		$sql1 = "INSERT INTO claimsdb(subject, targetP, supportMeans, supportID, example, URL, reason, rd, summary, description) VALUES('$subject', '$targetP', '$supportMeans', '$supportID','$example','$URL','$reason', '$rd', '$summary', '$description')";

		$sql2 = "INSERT INTO inferencedb(inferenceID, thesisST, reasonST,ruleST, claimID) VALUES('$inferenceID', '$thesisST','$reasonST','$ruleST', '$claimID')";


			$temp = $targetP;
			$targetP = $reason; 
			$reason = $temp;
			

$thesisST= $subject ." " . $targetP. ".";
$reasonST= "Because " . $subject . " " . $reason. ".";
$ruleST= "Whomever " . $reason . " " . $targetP. " as in the case of " . $example. ".";
$flagType = 'thesisRival';
$active = '1'; //alter preexisting flags to inactive if flagged.... so if id has a match in inferenceIDFlagged, active = 0. if active = 0, text = red. 
// $inferenceIDFlagger = new auto incremented ID....


		$sql3 = "INSERT INTO claimsdb(subject, targetP, supportMeans, supportID, example, URL, reason, rd, summary, description) VALUES('$subject', '$targetP', '$supportMeans', '$supportID','$example','$URL','$reason', '$rd', '$summary', '$description')";
		
		$sql4 = "INSERT INTO inferencedb(inferenceID, thesisST, reasonST,ruleST, claimID) VALUES('$inferenceID', '$thesisST','$reasonST','$ruleST', '$claimID')";
 

			// save to db and check

			if(mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2) && mysqli_query($conn, $sql3) && mysqli_query($conn, $sql4)){
				// success
			} else {
				echo 'query error: '. mysqli_error($conn);
			}
				

	$claim= "SELECT * from claimsdb ORDER BY claimID DESC LIMIT 1";
	 $queryclaim = mysqli_query($conn, $claim);
if($row = $queryclaim->fetch_assoc()) {
      $clvar = $row['claimID']; }


$inference = "SELECT * from inferencedb ORDER BY inferenceID DESC LIMIT 1";
	 $queryinference = mysqli_query($conn, $inference);
	 if($row = $queryinference->fetch_assoc()) {
      $invar = $row['inferenceID']; }


	$sql = "UPDATE inferencedb SET claimID='$clvar' WHERE inferenceID='$invar'";
	// end of claimid link
if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
}



		/* $sql5 = "INSERT INTO flagsdb(inferenceIDFlagged, flagType, inferenceIDFlagger, active) VALUES('$inferenceIDFlagged', '$flagType','$inferenceIDFlagger','$active')";

		if(mysqli_query($conn, $sql5)){
				// success
				header('Location: index.php');
			} else {
				echo 'query error: '. mysqli_error($conn);
			}
*/


$flagType = 'thesisRival';
$active = '1'; //alter preexisting flags to inactive if flagged.... so if id has a match in inferenceIDFlagged, active = 0. if active = 0, text = red. 


 				$order = "SELECT * from inferencedb ORDER BY inferenceID DESC LIMIT 1";
				 $nice = mysqli_query($conn, $order);

 				if($row = $nice->fetch_assoc()) {
      $inferenceIDFlagger = $row['inferenceID']; }


//On page 2
$inferenceIDFlagged = $_SESSION['varname'];
 
 // this function below inserts into database
	 $sql5 = "INSERT INTO flagsdb(inferenceIDFlagged, flagType, inferenceIDFlagger, active) VALUES('$inferenceIDFlagged', '$flagType','$inferenceIDFlagger','$active')";


//		$inference = "SELECT * from inferencedb ORDER BY inferenceID DESC LIMIT 1";
//	 $queryinference = mysqli_query($conn, $inference);

//	$sql = "UPDATE flagsdb SET active='0' WHERE inferenceID="$inference"";
	

		if(mysqli_query($conn, $sql5)){
				// success
				header('Location: index.php');
			} else {
				echo 'query error: '. mysqli_error($conn);
			}


mysqli_close($conn); ?>