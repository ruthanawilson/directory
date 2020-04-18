<?php

//connect to database
$conn = mysqli_connect('localhost', 'id13241729_leafy', 'VN#B2pRU7xb_/s=[', 'id13241729_vada_project');

//check connection
if(!$conn){
	echo 'Connection Error: ' . mysqli_connect_error();
}

?>