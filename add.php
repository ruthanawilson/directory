<?php include('config/db_connect.php'); 
?>

<link rel="stylesheet" href="./style.css"> 
<link rel="stylesheet" href="./detailsstyle.css"> 


	<?php include('templates/header.php');
 $claimID = $temp = $result = $topic = $array = $claim_fk = $IclaimID = $thesisST = $reasonST = $ruleST = $NewOld = $oldClaim = $subject = $targetP = $supportMeans = $supportforID = $supportID = $example = $URL =  $rd = $reason =  $flagType = $flagType = $flagTypeT = $flagTypeR = $flagTypeE = $flagURL = $flagSource = $flagID = $inferenceIDFlagger= $grammar = $active = '';
session_start();
 ?>
<center>

 <script src="script/jquery-1.8.1.min.js" type="text/javascript"></script>
<script src="script/my_script.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<br>
	
  <script>
      $(document).ready(function() {
  
$("#submit").click(function(){
  window.alert("Submitted!");
window.location.assign("http://localhost/directory/index.php");

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

<form method="POST" id = "myForm" action="insert.php">

	<?php 
  // $addPage = 'yes';
 // $_SESSION['addPage'] = $addPage;
// get add page variable from another page, hopefully thru post variable. 
// vada recruitment proposal
// firefox working? not working?
// rivals at the leaf level not working? ----> if rival, active = 0
//NA 
// AS IN THE CASE OF : SPACE IN EXAMPLE STATEMENT  
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

 <p style="color:#000000";>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label><u>Subject</u>         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   <u>Target Property </u></label><br>
<textarea class="subject" type="text" id="subject" name = "subject" value="<?php echo htmlspecialchars($subject) ?>">Enter Subject</textarea>     
<textarea class="targetP" type="text" id="targetP" name = "targetP" value="<?php echo htmlspecialchars($targetP) ?>">Enter Target Property</textarea>
      <br>

      <u> <p style="color:grey">Thesis Statement </u><br>
<span class="jsValue3">subject</span> <span class="jsValue4">target</span> 
</p></p>


<p style="color:black"> Is the subject an object or a person? 
<select name="grammar" id="grammar" value="grammar">
<option value="">Choose One</option>
<option value="object">Object</option>
<option value="person">Person</option>
</select> <br>
        
What is your Support Means?
  
<select name="union" id="union" value="union">
<option value="">Choose One</option>
<option value="Inference">Inference</option>
<option value="Testimony">Testimony</option>
<option value="Perception">Perception</option>
<option value="Tarka">Tarka</option>
</select>
</p>






</p>




<div id="hiddenRule"> 

  <div id="some-div">
  <img src = "https://i.imgur.com/o4qSiRD.png">
  <span id="explain-element"> Hint: Your reason statement should answer "Why?". You might think of the reason as what comes after 'because....'.  </span>
  </div>
<p style="color:black"><u>Reason</u><br>
<textarea class="reason" type="text" id="reason" name = "reason" value="<?php echo htmlspecialchars($reason) ?>">Enter Reason Property</textarea>
</p>
  <u> Reason Statement </u><br>
 
 <span class="jsValue5">subject</span>   <span class="jsValue6">reason</span>
<br><br>

<u> Rule and Example Statement </u><br>
Whatever/Whomever

 <!-- Plain Javascript Example -->
  <span class="jsValue">reason</span>,
<span class="jsValue2">target</span>,

as in the case of: </div>
<br>
<textarea id="example" name = "example" value="<?php echo htmlspecialchars($example) ?>">Enter Example</textarea>


<textarea id="transcription" name = "transcription" value="<?php echo htmlspecialchars($transcription) ?>">Transcription </textarea><br>
<textarea id="citation" name = "citation" value="<?php echo htmlspecialchars($citation) ?>">Please include: Author, title, publication, and date of publication.  </textarea><br>
<textarea id="url" name = "url" value="<?php echo htmlspecialchars($url) ?>">Enter URL</textarea><br>
<textarea id="vidtimestamp" name = "vidtimestamp" value="<?php echo htmlspecialchars($vidtimestamp) ?>">Enter timestamp of specified material</textarea>

<script>


// This is for reason
var $jsReason = document.querySelector('.reason');
var $jsValue = document.querySelector('.jsValue');

$jsReason.addEventListener('input', function(event){
  $jsValue.innerHTML = $jsReason.value;
}, false);


//-------------------------
//This is for Targetp

var $jsTargetP = document.querySelector('.targetP');
var $jsValue2 = document.querySelector('.jsValue2');

$jsTargetP.addEventListener('input', function(event){
  $jsValue2.innerHTML = $jsTargetP.value;
}, false);

//-------------------------
//This is for subject

var $jsSubject = document.querySelector('.subject');
var $jsValue3 = document.querySelector('.jsValue3');

$jsSubject.addEventListener('input', function(event){
  $jsValue3.innerHTML = $jsSubject.value;
}, false);

//-------------------------
//This is for the second target property (4)

var $jsTargetP2 = document.querySelector('.targetP');
var $jsValue4 = document.querySelector('.jsValue4');

$jsTargetP2.addEventListener('input', function(event){
  $jsValue4.innerHTML = $jsTargetP2.value;
}, false);



//-------------------------
//This is for the second subject property (5)
var $jsSubject2 = document.querySelector('.subject');
var $jsValue5 = document.querySelector('.jsValue5');

$jsSubject2.addEventListener('input', function(event){
  $jsValue5.innerHTML = $jsSubject2.value;
}, false);

//-------------------------
//This is for the reason (6)
var $jsReason2 = document.querySelector('.reason');
var $jsValue6 = document.querySelector('.jsValue6');

$jsReason2.addEventListener('input', function(event){
  $jsValue6.innerHTML = $jsReason2.value;
}, false);

</script> 
</div> 

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
  var hiddenRule = document.getElementById('hiddenRule');

        reason.style.display = 'none';
        example.style.display = 'none';
        citation.style.display = 'none';
        url.style.display = 'none';
        vidtimestamp.style.display = 'none';
        transcription.style.display = 'none';
        hiddenRule.style.display = 'none';


    if (union.options[union.selectedIndex].value === '') {
        citation.style.display = 'none';
    }
    if (union.options[union.selectedIndex].value === 'Inference') {
        reason.style.display = '';
        example.style.display = '';
        hiddenRule.style.display = '';
        citation.style.display = 'none';
    }


if (union.options[union.selectedIndex].value === 'Perception') {
        url.style.display = '';
        vidtimestamp.style.display = '';
        citation.style.display = '';
    }

if (union.options[union.selectedIndex].value === 'Testimony') {
        transcription.style.display = '';
        citation.style.display = '';
    } 
    
if (union.options[union.selectedIndex].value === 'Tarka') {
        window.alert("A requirement of Tarka is to use the comments feature in the Tarka claim following submission.");
         citation.style.display = 'none';
    } 

}



</script>

<script type="text/javascript">
var union = document.getElementById('union');
union.onchange = checkOtherUnion;
union.onchange();
</script>
<br>
<button onclick="setTimeout(myFunction, 8000)" id="submit">Submit</button>  

<script>

// BELOW IS WHERE SUBMIT BUTTON DISABLED HAPPENS
jQuery("#submit").prop('disabled', true);
    var card = document.getElementById("union");
//support means = union
//var toValidate = jQuery('#subject');
//var toValidateP = jQuery('#targetP');
var toValidate = jQuery('#subject, #targetP');

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




var toValidate2 = jQuery('#union, #grammar');
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


// above IS WHERE SUBMIT BUTTON DISABLED HAPPENS 


//need to bypass insert page 
</script>


</form></center>