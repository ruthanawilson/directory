<?php
include('config/db_connect.php');



$flagType = mysqli_real_escape_string($conn, $_POST['flagType']);


$reason = mysqli_real_escape_string($conn, $_POST['reason']);
$topic = mysqli_real_escape_string($conn, $_POST['topic']);
$example = mysqli_real_escape_string($conn, $_POST['example']);
$url = mysqli_real_escape_string($conn, $_POST['url']);
$rd = mysqli_real_escape_string($conn, $_POST['rd']);
$subject = mysqli_real_escape_string($conn, $_POST['subject']);
$supportMeans = mysqli_real_escape_string($conn, $_POST['union']);
$targetP = mysqli_real_escape_string($conn, $_POST['targetP']);
$summary = mysqli_real_escape_string($conn, $_POST['summary']);

			
session_start();

$thesisST= $subject . " " . $targetP. ".";

$reasonST= "Because " . $subject . " " . $reason. ".";

$ruleST= "Whomever " . $reason . " " . $targetP. " as in the case of " . $example. ".";

$c = uniqid (rand (),true);

$supportID =  $c;

if($flagType == 'thesisRival')
	{ $active = 0; }
else
{
$active = '1'; 	
}

//see if it is an instance of a claim being flagged. which one? find preexisting flagType, if any. if it has a flagtype, check if thesisrival: if yes, then error. if no, continue..)
		
		$sql1 = "INSERT INTO claimsdb(subject, targetP, supportMeans, supportID, example, URL, reason, rd, summary, description, thesisST, reasonST, ruleST, topic, active) VALUES('$subject', '$targetP', '$supportMeans', '$supportID','$example','$URL','$reason', '$rd', '$summary', '$description','$thesisST','$reasonST','$ruleST', '$topic', '$active')";

	
			if(mysqli_query($conn, $sql1)){
				// success
			} else {
				echo 'query error: '. mysqli_error($conn);
			}
			$addPage = $_SESSION['addPage'];	


//if this was a new claim from the add page, it would NOT be flagging anything. but since it's NOT from the add page, it is flagging. thus, this is the flagger.
			//we have to go grab the new claimID because it was generated in this very page. 
if($addPage == 'no')
{

 				$order = "SELECT * from claimsdb ORDER BY claimID DESC LIMIT 1";
				 $nice = mysqli_query($conn, $order);

 				if($row = $nice->fetch_assoc()) {
      $claimIDFlagger = $row['claimID']; 
      echo $claimIDFlagger;
  		}

//On page 2
$claimIDFlagged = $_SESSION['varname']; //pulled from our details page. it is the claimID of the claim being flagged.
 $isRootRival = 0;
 // this function below inserts into database
	  $sql5 = "INSERT INTO flagsdb(claimIDFlagged, flagType, claimIDFlagger, isRootRival) VALUES('$claimIDFlagged', '$flagType','$claimIDFlagger','$isRootRival')";

if(mysqli_query($conn, $sql5)){
				// success
				//header('Location: index.php');
			} else {
				echo 'query error: '. mysqli_error($conn);
			}

//this below just updates our newly-flagged claim to be inactive. 
	 $update = "UPDATE claimsdb 
SET active = 0
WHERE claimID = ? "; // SQL with parameters
$stmt2 = $conn->prepare($update); 
$stmt2->bind_param("i", $claimIDFlagged);
$stmt2->execute();
$result2 = $stmt2->get_result(); // get the mysqli result

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
} //END OF WHILE STATEMENT 
//we found a root. its been designated, swapped values, and the additional flag for reciprocity is added. however... the original root isn't rootrival =1 (fix happens below) but flagtype value is still the same. 
	$temp = $claimIDFlagged;
	$claimIDFlagged = $claimIDFlagger;
	$claimIDFlagger = $temp;

	$flagrival = "INSERT INTO flagsdb(claimIDFlagged, flagType, claimIDFlagger, isRootRival) VALUES('$claimIDFlagged', '$flagType','$claimIDFlagger', '$isRootRival')";

if(mysqli_query($conn, $flagrival)){
				// success
				//header('Location: index.php');
			} else {
				echo 'query error: '. mysqli_error($conn);
			}



$fix = "SELECT flagID from flagsdb ORDER BY flagID DESC LIMIT 1";
				 $i = mysqli_query($conn, $fix);

 				if($res = $i->fetch_assoc()) {
      $flagID = $res['flagID']; 
  	}

if($numhitsroot == 1)
		{ 
	
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
	
} //end of if statement 

} //end of if flagtype == thesisRival
		

 }////end of addpage = no


mysqli_close($conn); ?>