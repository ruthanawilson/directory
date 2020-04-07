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


$thesisST= $subject ." " . $targetP. ".";

$reasonST= "Because " . $subject . " " . $reason. ".";

$ruleST= "Whomever " . $reason . " " . $targetP. " as in the case of " . $example. ".";


$c = uniqid (rand (),true);

$supportID =  $c;

		
		$sql1 = "INSERT INTO claimsdb(subject, targetP, supportMeans, supportID, example, URL, reason, rd) VALUES('$subject', '$targetP', '$supportMeans', '$supportID','$example','$URL','$reason', '$rd')";

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


		$sql3 = "INSERT INTO claimsdb(subject, targetP, supportMeans, supportID, example, URL, reason, rd) VALUES('$subject', '$targetP', '$supportMeans', '$supportID','$example','$URL','$reason', '$rd')";

		$sql4 = "INSERT INTO inferencedb(inferenceID, thesisST, reasonST,ruleST, claimID) VALUES('$inferenceID', '$thesisST','$reasonST','$ruleST', '$claimID')";

//		$sql="UPDATE moderator set name='$name', category='$ctgr' where id=1";
if($conn->query($sql)===TRUE){
    echo "DATA updated";
}


			// save to db and check

			if(mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2) && mysqli_query($conn, $sql3) && mysqli_query($conn, $sql4)){
				// success
			} else {
				echo 'query error: '. mysqli_error($conn);
			}
				


		/* $sql5 = "INSERT INTO flagsdb(inferenceIDFlagged, flagType, inferenceIDFlagger, active) VALUES('$inferenceIDFlagged', '$flagType','$inferenceIDFlagger','$active')";

		if(mysqli_query($conn, $sql5)){
				// success
				header('Location: index.php');
			} else {
				echo 'query error: '. mysqli_error($conn);
			}
*/

mysqli_close($conn); ?>