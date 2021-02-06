<?php include('config/db_connect.php'); 



?>



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
			

   <?php   
  if(isset($_GET['topic'])){

?> <label>Topic</label><br>       
<input type="text" name="topic" value="<?php echo $_GET['topic'] ?>" readonly><br>

<?php 

}
else{
?>
<label>Topic</label><br>       
<input type="text" name="topic" value="<?php echo htmlspecialchars($topic) ?>"><br>
<?php }
?>

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
<label> Is the subject an object or a person? </label><br>
<select name="grammar" id="grammar" value="grammar">
<option value="">Choose One</option>
<option value="object">Object</option>
<option value="person">Person</option>
</select> <br>
        
  <label>What is your Support Means?</label><br>

			<label>Support Means</label><br>
<select name="union" id="union">
<option value="choose">Choose One</option>
<option value="Tarka">Tarka</option>
<option value="Inference">Inference</option>
<option value="Testimony">Testimony</option>
<option value="Perception">Perception</option>
</select>
<br>
<br>
<textarea id="reason" name = "reason" value="<?php echo htmlspecialchars($reason) ?>">Enter Reason Property</textarea><br>
<textarea id="example" name = "example" value="<?php echo htmlspecialchars($example) ?>">Enter Example</textarea><br>
<textarea id="url" name = "URL" value="<?php echo htmlspecialchars($URL) ?>">Enter URL</textarea><br>
<!--<textarea id="rd" name = "rd" value="<?php //echo htmlspecialchars($rd) ?>">Enter Speech/Research Document</textarea><br> -->
<!-- for perception -->
<!-- for testimony -->
<textarea id="transcription" name = "transcription" value="<?php echo htmlspecialchars($transcription) ?>">Transcription </textarea><br>
<textarea id="citation" name = "citation" value="<?php echo htmlspecialchars($citation) ?>">Enter citation. Please include: Author, title, publication, and date of publication.  </textarea><br>
<textarea id="timestamp" name = "timestamp" value="<?php echo htmlspecialchars($timestamp) ?>">Enter timestamp of specified material</textarea><br>
</p>
<?php  // end of flagging function ?>

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
        timestamp.style.display = '';
        citation.style.display = '';
    } else {
        url.style.display = 'none';
        timestamp.style.display = 'none';
        citation.style.display = 'none';
    }

if (union.options[union.selectedIndex].value === 'Testimony') {
        transcription.style.display = '';
        citation.style.display = '';
    } else {
        transcription.style.display = 'none';
        citation.style.display = 'none';
       
    }
if (union.options[union.selectedIndex].value === 'Tarka') {
        window.alert("A requirement of Tarka is to use the Facebook comments feature in the Tarka claim following submission.");
    } else {
       
    }

}
</script>




<script type="text/javascript">

var union = document.getElementById('union');
union.onchange = checkOtherUnion;
union.onchange();
</script>

<br>


			<div class="center">
				<button id="submit">Submit</button>	
					</div>
		</form>

<script>
// BELOW IS WHERE SUBMIT BUTTON DISABLED HAPPENS
jQuery("#submit").prop('disabled', true);
    var card = document.getElementById("union");
//support means = union
//var toValidate = jQuery('#subject');
//var toValidateP = jQuery('#targetP');
var toValidate = jQuery('#subject, #targetp');

//var toValidate2 = jQuery('#union');
    validTextArea = false;

toValidate.keyup(function () {

    if (jQuery(this).val().length > 0) {
        jQuery(this).data('valid', true);
    } else {
        jQuery(this).data('valid', false);
    }

        toValidate.each(function () {
        if (jQuery(this).data('valid') == true) {
            validTextArea = true;

        } else {
            validTextArea = false;
        }

if (validTextArea == true && validDropDown == true) {
        jQuery("#submit").prop('disabled', false);

    } else {
                 
        jQuery("#submit").prop('disabled', true);
      }

    });


});



//var clientCode = document.querySelector("#clientCode");
//clientCode.addEventListener("change", clientChangeHandler. false);




var toValidate2 = jQuery('#union');
    validDropDown = false;


toValidate2.change(function () {


  if (jQuery(this)[0].selectedIndex == 1 || jQuery(this)[0].selectedIndex == 2 || jQuery(this)[0].selectedIndex == 3 || jQuery(this)[0].selectedIndex == 4|| jQuery(this)[0].selectedIndex == 5) {
        jQuery(this).data('valid', true);
    } else {
        jQuery(this).data('valid', false);
    }



        toValidate2.each(function () {
        if (jQuery(this).data('valid') == true) {
            validDropDown = true;
                        
        } else {
            validDropDown = false;
   //           window.alert(jQuery(this)[0].selectedIndex);

        }

if (validTextArea == true && validDropDown == true) {
        jQuery("#submit").prop('disabled', false);

    } else {
                  
        jQuery("#submit").prop('disabled', true);
      }

    });

if (validTextArea == true && validDropDown == true) {
        jQuery("#submit").prop('disabled', false);

    } else {
              
        jQuery("#submit").prop('disabled', true);
      }

});



