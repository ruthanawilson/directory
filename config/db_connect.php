<?php

//connect to database
$conn = mysqli_connect('localhost', 'leafy', 'vada', 'vada_project');

//check connection
if(!$conn){
	echo 'Connection Error: ' . mysqli_connect_error();
}

?>