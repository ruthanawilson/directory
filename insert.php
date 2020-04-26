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
session_start();

$thesisST= $subject ." " . $targetP. ".";

$reasonST= "Because " . $subject . " " . $reason. ".";

$ruleST= "Whomever " . $reason . " " . $targetP. " as in the case of " . $example. ".";


$c = uniqid (rand (),true);

$supportID =  $c;

		
		$sql1 = "INSERT INTO claimsdb(subject, targetP, supportMeans, supportID, example, URL, reason, rd, summary, description, thesisST, reasonST, ruleST, topic) VALUES('$subject', '$targetP', '$supportMeans', '$supportID','$example','$URL','$reason', '$rd', '$summary', '$description','$thesisST','$reasonST','$ruleST', '$topic')";

	//	$sql2 = "INSERT INTO inferencedb(inferenceID, thesisST, reasonST,ruleST, claimID) VALUES('$inferenceID', '$thesisST','$reasonST','$ruleST', '$claimID')";


			$temp = $targetP;
			$targetP = $reason; 
			$reason = $temp;
			

$thesisST= $subject ." " . $targetP. ".";
$reasonST= "Because " . $subject . " " . $reason. ".";
$ruleST= "Whomever " . $reason . " " . $targetP. " as in the case of " . $example. ".";
$flagType = 'thesisRival';
$active = '1'; //alter preexisting flags to inactive if flagged.... so if id has a match in inferenceIDFlagged, active = 0. if active = 0, text = red. 
// $inferenceIDFlagger = new auto incremented ID....


		$sql2 = "INSERT INTO claimsdb(subject, targetP, supportMeans, supportID, example, URL, reason, rd, summary, description, thesisST, reasonST, ruleST, topic) VALUES('$subject', '$targetP', '$supportMeans', '$supportID','$example','$URL','$reason', '$rd', '$summary', '$description','$thesisST','$reasonST','$ruleST', '$topic')";

//		$sql4 = "INSERT INTO inferencedb(inferenceID, thesisST, reasonST,ruleST, claimID) VALUES('$inferenceID',  '$claimID')";
 

			// save to db and check

			if(mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2)){
				// success
			} else {
				echo 'query error: '. mysqli_error($conn);
			}
			$addPage = $_SESSION['addPage'];	
if($addPage == 'no')
{
//$flagType = 'thesisRival';
$active = '1'; //alter preexisting flags to inactive if flagged.... so if id has a match in inferenceIDFlagged, active = 0. if active = 0, text = red. 


 				$order = "SELECT * from claimsdb ORDER BY claimID DESC LIMIT 1";
				 $nice = mysqli_query($conn, $order);

 				if($row = $nice->fetch_assoc()) {
      $claimIDFlagger = $row['claimID']; }


//On page 2
$claimIDFlagged = $_SESSION['varname'];
 
 // this function below inserts into database
	 $sql5 = "INSERT INTO flagsdb(claimIDFlagged, flagType, claimIDFlagger, active) VALUES('$claimIDFlagged', '$flagType','$claimIDFlagger','$active')";


//		$inference = "SELECT * from inferencedb ORDER BY inferenceID DESC LIMIT 1";
//	 $queryinference = mysqli_query($conn, $inference);

//	$sql = "UPDATE flagsdb SET active='0' WHERE inferenceID="$inference"";
	

		if(mysqli_query($conn, $sql5)){
				// success
				header('Location: index.php');
			} else {
				echo 'query error: '. mysqli_error($conn);
			}

}
mysqli_close($conn); ?>