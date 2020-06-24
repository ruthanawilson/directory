 
<!-- Include bootstrap &amp; jQuery -->
<link rel="stylesheet" href="bootstrap.css" />
<script src="jquery-3.3.1.min.js"></script>
<script src="bootstrap.js"></script>
 
<!-- Creating table heading -->
<div class="container">
    <table class="table">
        <tr>
            <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Phone</th>
    <th>Actions</th>
</tr>
<?php
//this file is fine to delete ---------------------------------------------------------------
$id = 377;
  include('config/db_connect.php');
    // Check if user has requested to get detail
    if (isset($_POST["get_data"]))
    {
  include('config/db_connect.php');
        // Get the ID of customer user has selected
        $id = $_POST["id"];
 
 
        // Getting specific customer's detail
        $sql = "SELECT * FROM claimsdb WHERE claimID = '$id'";
      $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_object($result);
    // Important to echo the record in JSON format
        echo json_encode($row);
 
        // Important to stop further executing the script on AJAX by following line
        exit();
    }
?> 
<?php while ($row = mysqli_fetch_object($result)) { ?>
    <tr>
        <td><?php echo $row->claimID; ?></td>        
        <!--Button to display details -->
        <td>
            <button class = "btn btn-primary">
                Details
            </button>
        </td>
    </tr>
<?php } ?>

    </table>
</div>



<!-- Modal -->
<div class = "modal fade" id = "myModal" tabindex = "-1" role = "dialog" aria-hidden = "true">
    
   <div class = "modal-dialog">
      <div class = "modal-content">
          
         <div class = "modal-header">
            <h4 class = "modal-title">
               Customer Detail
            </h4>
 
            <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
               ×
            </button>
         </div>
          
         <div id = "modal-body">
            Press ESC button to exit.
         </div>
          
         <div class = "modal-footer">
            <button type = "button" class = "btn btn-default" data-dismiss = "modal">
               OK
            </button>
         </div>
          
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
    
</div><!-- /.modal -->
<button class = "btn btn-primary" onclick="loadData(this.getAttribute('data-id'));" data-id="<?php echo $row->claimID; ?>">
    Details
</button>
<script>
    function loadData(id) {
        $.ajax({
            url: "ajaxtesting.php",
            method: "POST",
            data: {get_data: 377,
            claimID: claimID},
            success: function (response) {
                console.log(response);
            }
        });
    }

    success: function (response) {
    response = JSON.parse(response);
    console.log(response);
 
    var html = "";
 
    // Displaying city
    html += "<div class='row'>";
        html += "<div class='col-md-6'>City</div>";
        html += "<div class='col-md-6'>" + response.claimID + "</div>";
    html += "</div>";
 
    // And now assign this HTML layout in pop-up body
    $("#modal-body").html(html);
 
    // And finally you can this function to show the pop-up/dialog
    $("#myModal").modal();
}
</script>
