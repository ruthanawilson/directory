<?php include('config/db_connect.php'); ?>



<!DOCTYPE html>
<html>
   <link rel="stylesheet" href="./style.css"> 

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
<br>
<b>Add claim </b>
	
</head>



<body>


<form method="POST" id = "myForm" action="insert.php">

	<?php $addPage = 'yes';
  $_SESSION['addPage'] = $addPage;
   ?>
			
<label>Topic</label><br>       
<input type="text" name="topic" value="<?php echo htmlspecialchars($topic) ?>"><br>

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
<option value="Tarka">Tarka</option>
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
    } else {
        rd.style.display = 'none';
        summary.style.display = 'none';
        
      
    }

}
</script>


<br>


			<div class="center">
				<button id="submit">Submit</button>	
					</div>
		</form>

</body>

</html>
