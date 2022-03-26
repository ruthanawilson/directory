
<?php 
include('config/db_connect.php');

$flagType = $union = $subject = $targetP = $topic = $supportMeans = $example = $url = $reason = $thesisST = $reasonST = $ruleST = $vidtimestamp = $citation = $transcription = $supportMeans = $example = $url = $reason = $thesisST = $reasonST = $ruleST = $vidtimestamp = $citation = $transcription = $claimIDFlagged = $flaggingSupport = ' ';
$supportMeans = mysqli_real_escape_string($conn, $_POST['union']);



$subject = mysqli_real_escape_string($conn, $_POST['subject']);
$targetP = mysqli_real_escape_string($conn, $_POST['targetP']);
$claimIDFlagged = mysqli_real_escape_string($conn, $_POST['claimIDFlaggedINSERT']);
?><script> window.alert($claimIDFlagged); </script> <?php

//pulled from our details page. it is the claimID of the claim being flagged.

$FOS = mysqli_real_escape_string($conn, $_POST['FOS']);

$topic = mysqli_real_escape_string($conn, $_POST['topic']);
$topic = trim($topic);
$topic = preg_replace('/[^\w\s]/', '', $topic);

if($FOS == 'flagging' || $FOS == 'supporting'){ ///////////// NUMBER ONE


}
else
{
    
$c = uniqid (rand (),true);

$supportID =  $c;

		$sql_AP = "INSERT INTO claimsdb(subject, targetP, supportMeans, supportID, example, URL, reason, thesisST, reasonST, ruleST, topic, active, vidtimestamp, citation, transcription, COS) VALUES('$subject', '$targetP', 'NA', 'NA','$NA','NA','NA', 'NA','NA','NA', '$topic', '1', 'NA','NA','NA', 'claim')";
//THIS IS THE ORIGINAL CLAIM FROM THE ADD PAGE
	
			if(mysqli_query($conn, $sql_AP)){
				// success
			} else {
				echo 'query error: '. mysqli_error($conn);
			}

} // end of FOS
// NOW WE'RE CHECKING TO SEE IF THE DETAILS PAGE IS ADDING A FLAG OR A SUPPORT 



//SIMPLE. 
$reason = mysqli_real_escape_string($conn, $_POST['reason']);
$example = mysqli_real_escape_string($conn, $_POST['example']);
$url = mysqli_real_escape_string($conn, $_POST['url']);

$transcription = mysqli_real_escape_string($conn, $_POST['transcription']);
$citation = mysqli_real_escape_string($conn, $_POST['citation']);

$author = mysqli_real_escape_string($conn, $_POST['author']);
$title = mysqli_real_escape_string($conn, $_POST['title']);
$publication = mysqli_real_escape_string($conn, $_POST['publication']);
$date = mysqli_real_escape_string($conn, $_POST['date']);

$citation = $author . ', ' . $title . ', ' . $publication . ', ' . $date;

$vidtimestamp = mysqli_real_escape_string($conn, $_POST['vidtimestamp']);

$grammar = mysqli_real_escape_string($conn, $_POST['grammar']);
?><script> window.alert($grammar); </script> <?php


 if($grammar == "person")
{ 
$ruleST= "Whomever " . $reason . " " . $targetP. ", as in the case of " . $example;	
}
else {
$ruleST= "Whatever " . $reason . " " . $targetP. ", as in the case of " . $example;
} 

$thesisST= $subject . " " . $targetP;

$reasonST= $subject . " " . $reason;



if($flagType == 'Thesis Rival')
{ $active = '0'; }
else
{
$active = '1'; 	
}
//On page 2




if($FOS == 'flagging' || $FOS == 'supporting'){ //////////////// TWO
	
	$COS = "";
	//are we making a claim or support? - this is making a support for an existing claim or a new claim
$flagType = mysqli_real_escape_string($conn, $_POST['flagType']);
$flagTypeT = mysqli_real_escape_string($conn, $_POST['flagTypeT']);
$flagTypeR = mysqli_real_escape_string($conn, $_POST['flagTypeR']);
$flagTypeE = mysqli_real_escape_string($conn, $_POST['flagTypeE']);

//something wrong with main flagtype because perception is flagtype yet it is not triggered 
if(strlen("$flagType") > 2 ) //does flagtype have a value from inference, testimony, or perception? then keep it.
{$flagType = $flagType; 

if($flagType != "supporting")
{ $flaggingSupport =  "true"; }

}
elseif(strlen("$flagTypeT") > 2) //does flagtype have a value from thesis? then keep it.
{$flagType = $flagTypeT;
$COS = "claim";
}
elseif(strlen("$flagTypeR") > 2) //does flagtype have a value from a reason pramana? then keep it.
{$flagType = $flagTypeR;
$flaggingSupport =  "true"; }
elseif(strlen("$flagTypeE") > 2) //does flagtype have a value from example pramana? then keep it.
{$flagType = $flagTypeE; 
$flaggingSupport =  "true";}
else
  {$flagType = "ERROR: User did not select flag type when entering claim.";}
} //end of FOS








//look to see if it is an instance of a claim being flagged. which one? find preexisting flagType, if any. if it has a flagtype, check if thesisrival: if yes, then error. if no, continue..)
		
//THIS IS NOW CREATING THE SUPPORT THAT GOES WITH OUR CLAIM FROM A NEW CLAIM FROM THE ADD PAGE
if($FOS == 'flagging' || $FOS == 'supporting'){ ///////////THREE
}
else
{

	$order_support12 = "SELECT * from claimsdb ORDER BY claimID DESC LIMIT 1";
				 $nice112 = mysqli_query($conn, $order_support12);

 				if($row112 = $nice112->fetch_assoc()) {
      $claimIDFlagged = $row112['claimID']; 
      echo $claimIDFlagged;
  		}



$sql_support2 = "INSERT INTO claimsdb(subject, targetP, supportMeans, supportID, example, URL, reason, thesisST, reasonST, ruleST, topic, active, vidtimestamp, citation, transcription, COS) VALUES('$subject', '$targetP', '$supportMeans', '$supportID','$example','$url','$reason', '$thesisST','$reasonST','$ruleST', '$topic', '$active', '$vidtimestamp','$citation','$transcription', 'support')";
	
			if(mysqli_query($conn, $sql_support2)){
				// success
			} else {
				echo 'query error: '. mysqli_error($conn);
			}

	$order_support1 = "SELECT * from claimsdb ORDER BY claimID DESC LIMIT 1";
				 $nice11 = mysqli_query($conn, $order_support1);

 				if($row11 = $nice11->fetch_assoc()) {
      $claimIDFlagger = $row11['claimID']; 
      echo $claimIDFlagger;
  		}


// ---------------------------------------------------------- THIS IS LINKING THE TWO TOGETHER
 // this function below inserts into database
	  $sql5_support1 = "INSERT INTO flagsdb(claimIDFlagged, flagType, claimIDFlagger, isRootRival) VALUES('$claimIDFlagged', 'supporting','$claimIDFlagger','0')";



if(mysqli_query($conn, $sql5_support1)){
				// success
			//	header('Location: insert.php');
			} else {
				echo 'query error: '. mysqli_error($conn);
			}




	
}//end of addpage = yes 
// add page? no add page?

//if this was a new claim from the add page, it would NOT be flagging anything. but since it's NOT from the add page, it is flagging. thus, this is the flagger.
			//we have to go grab the new claimID because it was generated in this very page. 
if($FOS == "flagging" || $flaggingSupport == "true")
{ 
		// $sql1 = "INSERT INTO claimsdb(subject, targetP, supportMeans, supportID, example, URL, reason, thesisST, reasonST, ruleST, topic, active, vidtimestamp, citation, transcription, COS) VALUES('$subject', '$targetP', '$supportMeans', '$supportID','$example','$url','$reason', '$thesisST','$reasonST','$ruleST', '$topic', '$active', '$vidtimestamp','$citation','$transcription', '$COS')";



		$sql1 = "INSERT INTO claimsdb(subject, targetP, supportMeans, supportID, example, URL, reason, thesisST, reasonST, ruleST, topic, active, vidtimestamp, citation, transcription, COS) VALUES('$subject', '$targetP', 'NA', 'NA','$NA','NA','NA', 'NA','NA','NA', '$topic', '$active', 'NA','NA','NA', 'claim')";
	
			if(mysqli_query($conn, $sql1)){
				// success
			} else {
				echo 'query error: '. mysqli_error($conn);
			}


 				$order = "SELECT * from claimsdb ORDER BY claimID DESC LIMIT 1";
				 $nice = mysqli_query($conn, $order);

 				if($row = $nice->fetch_assoc()) {
      $claimIDFlagger = $row['claimID']; 
      echo $claimIDFlagger;
  		}

 $isRootRival = 0;
 // this function below inserts into database
	  $sql5 = "INSERT INTO flagsdb(claimIDFlagged, flagType, claimIDFlagger, isRootRival) VALUES('$claimIDFlagged', '$flagType','$claimIDFlagger','$isRootRival')";

if(mysqli_query($conn, $sql5)){
				// success
			//	header('Location: insert.php');
			} else {
				echo 'query error: '. mysqli_error($conn);
			}





////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// im working here

			if($flagType == 'Thesis Rival') //need to see if this is a trigger 
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
				//header('Location: insert.php');
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
	$temp = $claimIDFlagged;
	$claimIDFlagged = $claimIDFlagger;
	$claimIDFlagger = $temp;


} //end of if flagtype == thesisRival



/////////////////////////////////////////////////////////////////////////////////////////////aight im done working






$COS = "support";

$sql_support3 = "INSERT INTO claimsdb(subject, targetP, supportMeans, supportID, example, URL, reason, thesisST, reasonST, ruleST, topic, active, vidtimestamp, citation, transcription, COS) 
VALUES('$subject', '$targetP', '$supportMeans', '$supportID','$example','$url','$reason', '$thesisST','$reasonST','$ruleST', '$topic', '$active', '$vidtimestamp','$citation','$transcription', '$COS')";

	
			if(mysqli_query($conn, $sql_support3)){
				// success
			} else {
				echo 'query error: '. mysqli_error($conn);
			}




//this below just updates our newly-flagged claim to be inactive. 
			if($flagType !== 'supporting') //if we're adding a support it isn't inactivating anything 
			{
	 $update = "UPDATE claimsdb 
SET active = 0
WHERE claimID = ? "; // SQL with parameters
$stmt2 = $conn->prepare($update); 
$stmt2->bind_param("i", $claimIDFlagged);
$stmt2->execute();
$result2 = $stmt2->get_result(); // get the mysqli result 
} 
$claimIDFlagged = $claimIDFlagger;

	$order_support3 = "SELECT * from claimsdb ORDER BY claimID DESC LIMIT 1";
				 $nice1 = mysqli_query($conn, $order_support3);

 				if($row1 = $nice1->fetch_assoc()) {
      $claimIDFlagger = $row1['claimID']; 
      echo $claimIDFlagger;
  		}



 // this function below inserts into database
	  $sql5_support = "INSERT INTO flagsdb(claimIDFlagged, flagType, claimIDFlagger, isRootRival) VALUES('$claimIDFlagged', 'supporting','$claimIDFlagger','0')";

if(mysqli_query($conn, $sql5_support)){
				// success
			//	header('Location: insert.php');
			} else {
				echo 'query error: '. mysqli_error($conn);
			}










 }



 // if its adding support, it isn't flagging or creating a new claim.... JUST a new support and its relation to the claim

if($FOS == "supporting")
{
	$supportingSubject = $supportingTargetP = '';

	//because there is a field currently that is pulling a new subject and target property, we have to get the old one from the claim thats being flagged. 

$act = "SELECT * FROM claimsdb WHERE claimID = ?"; // SQL with parameters
$s = $conn->prepare($act); 
$s->bind_param("i", $claimIDFlagged);
$s->execute();
$activity = $s->get_result(); // get the mysqli result

while($end = $activity->fetch_assoc())
  { $supportingSubject =  $end['subject'];
	$supportingTargetP =  $end['targetP'];
  }

  


		$sql1 = "INSERT INTO claimsdb(subject, targetP, supportMeans, supportID, example, URL, reason, thesisST, reasonST, ruleST, topic, active, vidtimestamp, citation, transcription, COS) VALUES('$supportingSubject', '$supportingTargetP', '$supportMeans', '$supportID','$example','$url','$reason', '$thesisST','$reasonST','$ruleST', '$topic', '$active', '$vidtimestamp','$citation','$transcription', 'support')";

	
			if(mysqli_query($conn, $sql1)){
				// success
			} else {
				echo 'query error: '. mysqli_error($conn);
			}




	$order_support_else = "SELECT * from claimsdb ORDER BY claimID DESC LIMIT 1";
				 $nice2 = mysqli_query($conn, $order_support_else);

 				if($row2 = $nice2->fetch_assoc()) {
      $claimIDFlagger = $row2['claimID']; 
      echo $claimIDFlagger;
  		}




 // this function below inserts into database
	  $sql5_support_else = "INSERT INTO flagsdb(claimIDFlagged, flagType, claimIDFlagger, isRootRival) VALUES('$claimIDFlagged', 'supporting','$claimIDFlagger','$isRootRival')";

if(mysqli_query($conn, $sql5_support_else)){
				// success
			//	header('Location: insert.php');
			} else {
				echo 'query error: '. mysqli_error($conn);
			}


	}//end of addpage check








mysqli_close($conn);
 ?>