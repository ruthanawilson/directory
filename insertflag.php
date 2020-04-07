<?php
include('config/db_connect.php');

$flagType = 'thesisRival';
$active = '1'; //alter preexisting flags to inactive if flagged.... so if id has a match in inferenceIDFlagged, active = 0. if active = 0, text = red. 
$inferenceIDFlagger =  last_insert_id();

  //  $inferenceIDFlagger = mysqli_insert_id($conn);

	 $sql5 = "INSERT INTO flagsdb(inferenceIDFlagged, flagType, inferenceIDFlagger, active) VALUES('$inferenceIDFlagged', '$flagType','$inferenceIDFlagger','$active')";

		if(mysqli_query($conn, $sql5)){
				// success
				header('Location: index.php');
			} else {
				echo 'query error: '. mysqli_error($conn);
			}


mysqli_close($conn); ?>
 