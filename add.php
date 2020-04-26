<?php include('config/db_connect.php'); ?>



<!DOCTYPE html>
<html>
 
	<?php include('templates/header.php');
	$claimID = $temp = $result = $topic = $array = $claim_fk = $IclaimID = $thesisST = $reasonST = $ruleST = $NewOld = $oldClaim = $subject = $targetP = $supportMeans = $supportforID = $supportID = $example = $URL =  $rd = $reason =  $flagType = $flagURL = $flagSource = $flagID = $inferenceIDFlagger= $active = '';
session_start();
 ?>
<center>
		<script src="script/jquery-1.8.1.min.js" type="text/javascript"></script>
<script src="script/my_script.js" type="text/javascript"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>

	$(document).ready(function() {
	
$("#submit").click(function(){




 $.post( $("#myForm").attr("action"), 
         $("#myForm :input").serializeArray(), 
         function(info){ $("#result").html(info); 
  });
clearInput();
		});

	$("#myForm").submit( function() {
  return false;	
});

	function clearInput() {
	$("#myForm :input").each( function() {
	   $(this).val('');
	});
}
});


</script>

		<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}

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
</style>

	<?php include('templates/header.php'); ?>
<br>
<b>Add claim </b>
		<br>	
			<!-- Trigger/Open The Modal -->
<button id="myBtn">Add Claim</button>


</div>

	</div>
	
</head>



<body>


<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">

    <span class="close">&times;</span>
    <center>
<form method="POST" id = "myForm" action="insert.php">

	<?php $addPage = 'yes';
  $_SESSION['addPage'] = $addPage;
   ?>
			
<label>Topic</label><br>
        <select name="topic">
        <option value="" selected>Select...</option>
        <option value="Abortion">Abortion</option>
        <option value="Religion">Religion</option>
        <option value="Personhood">Personhood</option>
        <option value="Trans Rights">Trans Rights</option>
        <option value="Immigration">Immigration</option>
        <option value="Gun Control">Gun Control</option>
        </select><br>

<label>Subject</label><br>
<input type="text" name="subject" value="<?php echo htmlspecialchars($subject) ?>"><br>

<label>Target Property</label><br>
<input type="text" name="targetP" value="<?php echo htmlspecialchars($targetP) ?>"> <br>

<style>

	body {
  padding: 50px 10px;
  margin: 0 auto;
  max-width: 900px;
}

#explain-element {
  border: 1px solid #ccc;
  display: none;
  font-size: 10px;
  margin-top: 10px;
  padding: 5px;
  text-transform: uppercase;
}

#some-div:hover #explain-element {
  display: block;
}
</style>

			<label>Support Means</label><br>
<select name="union" id="union">
<option value="choose">Choose One</option>
<option value="Inference">Inference</option>
<option value="Testimony">Testimony</option>
<option value="Perception">Perception</option>
</select>
<br>


<textarea id="reason" name = "reason" value="<?php echo htmlspecialchars($reason) ?>">Enter Reason Statement</textarea><br>
<textarea id="example" name = "example" value="<?php echo htmlspecialchars($example) ?>">Enter Example Statement</textarea><br>
<textarea id="url" name = "URL" value="<?php echo htmlspecialchars($URL) ?>">Enter URL</textarea><br>
<textarea id="rd" name = "rd" value="<?php echo htmlspecialchars($rd) ?>">Enter Speech/Research Document</textarea><br>
<!-- for testimony -->
<textarea id="summary" name = "summary" value="<?php echo htmlspecialchars($summary) ?>">Summary of Argument/Excerpt. Include timestamps for video, if applicable. </textarea><br>

<textarea id="description" name = "description" value="<?php echo htmlspecialchars($description) ?>">Description</textarea><br>

<script type="text/javascript">

var union = document.getElementById('union');
union.onchange = checkOtherUnion;
union.onchange();

function checkOtherUnion() {
    var union = this;
    var reason = document.getElementById('reason');
    var example = document.getElementById('example');
    var url = document.getElementById('url');
 	var rd = document.getElementById('rd');
    if (union.options[union.selectedIndex].value === 'Inference') {
        reason.style.display = '';
        example.style.display = '';
    } else {
        reason.style.display = 'none';
        example.style.display = 'none';
    }


if (union.options[union.selectedIndex].value === 'Perception') {
        url.style.display = '';
    } else {
        url.style.display = 'none';
      
    }

if (union.options[union.selectedIndex].value === 'Testimony') {
        rd.style.display = '';
        summary.style.display = '';
        description.style.display = '';
    } else {
        rd.style.display = 'none';
        summary.style.display = 'none';
        description.style.display = 'none';
      
    }

}
</script>


<br>


			<div class="center">
				<button id="submit">Submit</button>	
					</div>
		</form>
	</section>

  </div>

</div>

<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
<?php include('templates/footer.php'); ?>
</body>

</html>
