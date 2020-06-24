
<?php 

  include('config/db_connect.php');
  $sql = 'SELECT thesisST, reasonST, ruleST, supportMeans, subject, targetP, claimID FROM claimsdb';
  // get the result set (set of rows)
  $result = mysqli_query($conn, $sql);
  // fetch the resulting rows as an array // was $result
  $claimsdb = mysqli_fetch_all($result, MYSQLI_ASSOC);
  
  // close connection
 

?><br><button class="button" id="myBtn">DETAILS</button>

<div class="header">
  <a href="#default" class="logo">Vada Claims</a>
  <div class="header-right">
    <a class="active" href="#home">Home</a>
    <a href="#contact">Contact</a>
    <a href="#about">About</a>
  </div>
</div>


<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">

    <span class="close">&times;</span>
    <center>

<?php echo "HELLO!";?>
</div></div>


<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span2 = document.getElementsByClassName("close")[0];
// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span2.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

</script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<style>


/* FUNCTIONAL - Needed for the tree diagram */
@import url("https://fonts.googleapis.com/css?family=Questrial");
.wrapper {
  position: absolute;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  text-align: center;
  overflow: auto;
    /*& [type="checkbox"], & .more {
      display: none;
    }

    & input:checked ~ ul *{
      display: none;
    }

    & input:checked ~ ul .more{
      display: block;
    }*/
}
.wrapper ul {
  position: relative;
  display: block;
  margin: 0 auto;
  white-space: nowrap;
  list-style: none;
}
.wrapper ul li {
  display: inline-block;
  vertical-align: top;
}

/* MAKE-UP - Pure esthetics*/
::-webkit-scrollbar-button {
  display: none;
}

::-webkit-scrollbar {
  width: 2px;
  height: 2px;
}

::-webkit-scrollbar-thumb {
  background: white;
  border: 1px solid white;
  cursor: pointer;
}

::-webkit-scrollbar-track {
  background: transparent;
  width: calc(2px * 2);
  border: 2px solid rgba(26, 26, 26, 0);
}

::-webkit-scrollbar-track-piece {
  background: transparent;
  width: calc(2px / 2);
  border: 2px solid rgba(26, 26, 26, 0);
}

body {
  scrollbar-face-color: white;
  scrollbar-track-color: transparent;
}

@media (min-width: 480px) {
  :root {
    font-size: calc(0.75rem + ((1vw - 4.8px) * 0.5556));
  }
}
@media (min-width: 1920px) {
  :root {
    font-size: 20px;
  }
}
div, ul, li {
  position: relative;
  display: inline-block;
  vertical-align: top;
  box-sizing: border-box; 
  margin: 0;
  padding: 0;
}
div:before, div:after, ul:before, ul:after, li:before, li:after {
  content: '';
  position: absolute;
/*  display: block; 
  box-sizing: border-box;*/
}

body {
  color: white;
  font-family: 'Questrial', sans-serif;
  background: #333;
}
body .message {
  position: absolute;
  right: 0.5vw;
  bottom: 1vw;
  max-width: 30vw;
  font-size: 0.75vmin;
  font-family: "Open Sans", sans-serif;
  color: white;
}
body .message a {
  color: inherit;
  text-decoration: none;
  border-bottom: 1px solid #444;
}
body .message a:hover {
  border-width: 3px;
}
body .wrapper ul > li {
  margin: 1em 0;
  padding: 1em;
  line-height: 1.5em;
  transition: all 0.5s ease;
}
body .wrapper ul > li:before {
  top: 0;
  left: 0;
  width: 100%;
  height: 1px;
  background: grey;
}
body .wrapper ul > li:first-of-type:before {
  left: 50%;
  width: 50%;
}
body .wrapper ul > li:last-of-type:before {
  width: 50%;
}
body .wrapper ul > li:only-of-type:before {
  width: 10%;
  left: 45%;
}
body .wrapper ul > li.noline:before {
  background: transparent;
}
body .wrapper ul > li label {
  padding: 0.5em 1em;
  border: 1px solid grey;
  max-width: 140px; 
  white-space: normal; 
  display: inline-block;
  cursor: pointer;
}
body .wrapper ul [type="checkbox"] {
  display: none;
}
body .wrapper ul .more {
  opacity: 0;
  display: block;
  width: 0;
  height: 0;
  padding: 0;
  margin-left: 50%;
  transition: all 0.25s ease;
}
body .wrapper ul input:checked ~ ul * {
  opacity: 0;
  max-width: 1px;
  max-height: 1px;
  padding: 0;
}
body .wrapper ul input:checked ~ ul .more {
  opacity: 1;
  width: 100%;
  height: 100%;
  max-width: 100%;
  max-height: 100%;
  margin-left: 0;
  transition: all 0.01s;
}
div.a {
    width: 100%;
    word-wrap: break-word;
}




.button {
  background-color: #d3d3d3; 
  border: none;
  font-color: white;
  padding: 7px 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  font-family: 'Questrial', sans-serif;
}








  /* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}








/* Style the header with a grey background and some padding */
.header {
  overflow: hidden;
  background-color: grey;
  padding: 20px 10px;
}

/* Style the header links */
.header a {
  float: center;
  color: black;
  text-align: center;
  padding: 12px;
  text-decoration: none;
  font-size: 18px;
  line-height: 25px;

  border-radius: 4px;
}

/* Style the logo link (notice that we set the same value of line-height and font-size to prevent the header to increase when the font gets bigger */
.header a.logo {
  font-size: 25px;
  font-weight: bold;
}

/* Change the background color on mouse-over */
.header a:hover {
  background-color: #ddd;
  color: black;
}

/* Style the active/current link*/
.header a.active {
  background-color: seagreen;
  color: white;
}

/* Float the link section to the right */
.header-right {
  float: right;
}

  .header-right {
    float: none;
  }
}



</style>


<BR><BR>
         CLAIMS
          <br>
<a class="brand-text" href="add.php" style=" color : #fff;">Add Claim</a><br><br>
Claims displayed as a <font color = "seagreen"> green font </font> mean that they are currently active. <br> Claims displayed as a <font color = "#FFFF99"> yellow font </font> mean that the are currently inactive. <br>




         <!-- partial:index.partial.html -->

  <br>
  </center>

<center>
      <?php   //changing the centers above is a fun change

        //this code finds ALL claims that are not flaggers (all root claims)
$root1 = "SELECT DISTINCT claimID
        from claimsdb, flagsdb 
            WHERE claimID NOT IN (SELECT DISTINCT claimIDFlagger FROM flagsdb)
        "; // SQL with parameters
$stmt5 = $conn->prepare($root1); 
$stmt5->execute();
$rootresult1 = $stmt5->get_result(); // get the mysqli result
$numhitsroot = mysqli_num_rows($rootresult1);

 while($root = $rootresult1->fetch_assoc())
  {
         sortclaims($root['claimID']);
  }




$root2 = "SELECT DISTINCT claimIDFlagger
        from flagsdb 
            WHERE isRootRival = 1;
        "; // SQL with parameters
$stmt12 = $conn->prepare($root2); 
$stmt12->execute();
$rootresult2 = $stmt12->get_result(); // get the mysqli result
$numhitsroot2 = mysqli_num_rows($rootresult2);

while($root2 = $rootresult2->fetch_assoc())
  { 
         sortclaimsRIVAL($root2['claimIDFlagger']);
       //  echo "RIVAL";
  }






function sortclaimsRIVAL($claimid)
{
 restoreactivity($claimid);
include('config/db_connect.php');
  $sql1 = "SELECT DISTINCT claimIDFlagger
        from claimsdb, flagsdb
        where ? = claimIDFlagged AND flagType NOT LIKE 'thesisRival'
         
        "; // SQL with parameters
$stmt1 = $conn->prepare($sql1); 
$stmt1->bind_param("i", $claimid);
$stmt1->execute();
$result1 = $stmt1->get_result(); // get the mysqli result
$numhits1 = mysqli_num_rows($result1);
//echo $numhits1;


?>

<!-- <label> -->
  <li> <label for="<?php echo $claimid; ?>"><?php 
 echo $claimid . "  <u> RIVAL </u> ";?>
<!-- <a class="brand-text" style=" color : #fff;" href ="add.php">Link</a> -->
 </label><input id="<?php echo $claimid; ?>" type="checkbox">
      <ul> <span class="more">&hellip;</span>
<!-- </label> -->
<?php

while($user = $result1->fetch_assoc())
{

 if($numhits1 == 0)
  { }
   else { sortclaims($user['claimIDFlagger']); }
    

} // end while loop

?></ul><?php

} // end of rivalfunction









function restoreactivity ($claimid)
{
include('config/db_connect.php');
$act = "SELECT DISTINCT claimIDFlagger
        from flagsdb
        WHERE claimIDFlagged = ?"; // SQL with parameters
$s = $conn->prepare($act); 
$s->bind_param("i", $claimid);
$s->execute();
$activity = $s->get_result(); // get the mysqli result



while($activestatus = $activity->fetch_assoc())
  { 
    $h = "SELECT DISTINCT active
        from claimsdb
        WHERE ? = claimID"; // SQL with parameters
      $noce = $conn->prepare($h); 
      $noce->bind_param("i", $activestatus['claimIDFlagger']);
      $noce->execute();
      $res = $noce->get_result(); // get the mysqli result
      $numh = mysqli_num_rows($res);


    
  //    echo nl2br("\r\n");
    //  echo $activestatus['claimIDFlagger'];
      //echo nl2br("\r\n");

$everyInactive = 'true';
//echo $everyInactive;
  while($r = $res->fetch_assoc())
  {  
    
    if($r['active'] == 1)
    {
      global $everyInactive;
      $everyInactive = 'false';
  //    echo $everyInactive;
      $act = "UPDATE claimsdb 
SET active = 0
WHERE claimID = ? 
"; // SQL with parameters
$upd = $conn->prepare($act); 
$upd->bind_param("i", $claimid);
$upd->execute();
    }
  }


  if($everyInactive == 'true')
  {
  
//echo "ANSWER" . $everyInactive;
// BELOW CHANGES THE ACTIVE STATE OF OTHER CLAIMS
$act = "UPDATE claimsdb 
SET active = 1
WHERE claimID = ? 
"; // SQL with parameters
$upd = $conn->prepare($act); 
$upd->bind_param("i", $claimid);
$upd->execute();
 } // end of second if statement
     } //end first while loop

//THIS ABOVE CHANGES THE ACTIVE STATE OF OTHER CLAIMS
  
  }  // end function


function sortclaims($claimid)
{
 restoreactivity($claimid);

include('config/db_connect.php');
  $sql1 = "SELECT DISTINCT claimIDFlagger
        from claimsdb, flagsdb
        WHERE ? = claimIDFlagged AND flagType NOT LIKE 'thesisRival'"; // SQL with parameters
$stmt1 = $conn->prepare($sql1); 
$stmt1->bind_param("i", $claimid);
$stmt1->execute();
$result1 = $stmt1->get_result(); // get the mysqli result
$numhits1 = mysqli_num_rows($result1);
//echo $numhits1;

$flag = "SELECT DISTINCT flagType, claimIDFlagger, claimIDFlagged
        from flagsdb
        WHERE ? = claimIDFlagger"; // SQL with parameters
$stmt4 = $conn->prepare($flag); 
$stmt4->bind_param("i", $claimid);
$stmt4->execute();
$result2 = $stmt4->get_result(); // get the mysqli result
$numhitsflag = mysqli_num_rows($result2);

// THIS IS SIMPLY FOR DISPLAY OF SUBJECT/TARGETP BELOW

$dis = "SELECT DISTINCT subject, targetP, active
        from claimsdb
        where ? = claimID
         
        "; // SQL with parameters
$st = $conn->prepare($dis); 
$st->bind_param("i", $claimid);
$st->execute();
$disp = $st->get_result(); // get the mysqli result


// SIMPLY FOR DISPLAY ABOVE THIS POINT

?>

  <li> <label for="<?php echo $claimid; ?>"><?php 
while($d = $disp->fetch_assoc())
{
  // FONT CHANGING
 if($d['active'] == 1)
{ $font = 'seagreen';

 }
else {
  $font = '#FFFF99'; } ?>

<font color = "<?php echo $font; ?>"> 
<?php    // END FONT CHANGING


/*?><h2>Let the borders collapse:</h2>

<table>
  <tr>
    <th>Firstname</th>
  </tr> </table>
<?php
*/
 echo $claimid;

echo nl2br("\r\n");      
  ?>  <div class='a'> <?php

  echo $d['subject'] . ' ';
// echo nl2br("\r\n");
  echo $d['targetP'];


/*  $subject = wordwrap($d['subject'], 8, "\n", true);
$targetP = wordwrap($d['targetP'], 8, "\n", true);
  echo $subject;
  echo $targetP;*/

  ?> </div> <?php
?>  <br><button class="button" id="myBtn">DETAILS</button>

<?php
}


 ?>

<!-- <a class="brand-text" style=" color : #fff;" href ="add.php">Link</a> -->
 </label><input id="<?php echo $claimid; ?>" type="checkbox">
      <ul> <span class="more">&hellip;</span>



<?php

  while($flagge = $result2->fetch_assoc())
  {
 if($flagge['flagType'] == "thesisRival")
      {
      echo nl2br("\r\n");
      echo "RIVAL";
      echo nl2br("\r\n");
      sortclaimsRival($flagge['claimIDFlagger']);
      // for THIS claimid - check for flaggers that aren't rival .. sort claim those
      sortclaimsRival($flagge['claimIDFlagged']);
      // for the CORRESPONDING claimid - check for flaggers that aren't rival .. sort claim those.
      }
  }


while($user = $result1->fetch_assoc())
{
 if($numhits1 == 0)
  { }
   
   else { sortclaims($user['claimIDFlagger']); }
    
} // end while loop
restoreactivity($claimid);
?></ul><?php
} // end of function